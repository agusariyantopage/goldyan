
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Jadwal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
              <li class="breadcrumb-item active">Jadwal</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <row>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3>Data Jadwal</h3>
            </div> 
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah</button>
              
              <table id="example1" class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>Tanggal</td>
                    <td>Total Jadwal</td>
                    <td>Total Pending</td>
                    <td>Total Selesai</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $sql="select tanggal,COUNT(id_jadwal) as total_jadwal,COUNT(CASE WHEN status = 'Pending' THEN 1 END) as total_pending,COUNT(CASE WHEN status != 'Pending' THEN 1 END) as total_selesai from jadwal GROUP by tanggal";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
?>                 
                <tr>
                  <td><?= $kolom['tanggal']; ?></td>
                  <td><?= $kolom['total_jadwal']; ?></td>
                  <td><?= $kolom['total_pending']; ?></td>
                  <td><?= $kolom['total_selesai']; ?></td>
                  <td>                   
                    <button type="button" class="btn btn-link"><a href="index.php?p=jadwal-detail&tanggal=<?= $kolom['tanggal']; ?>"><i class="fas fa-edit"></i></a></button>
                  </td>
                </tr>
           
<?php
  }
?>                
              </table>
            </div> 
          </div>
        </div>
      </row>
             
        
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Untuk Tambah Regional -->
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/jadwal.php" method="post">
          <input type="hidden" name="aksi" value="tambah">
          <label for="tanggal">Tanggal</label>
          <input type="date" required class="form-control" name="tanggal">
          <label for="id_regional">Area</label>
          <select name="id_regional" class="form-control">
            <?php
              $sql2="select * from regional order by regional";
              $query2=mysqli_query($koneksi,$sql2);
              while($kolom2=mysqli_fetch_array($query2)){
                  echo "<option value='$kolom2[id_regional]'>$kolom2[regional]</option>"; 
              }
            ?>
          </select>
          <label for="id_karyawan">Kolektor</label>
          <select name="id_karyawan" class="form-control">
            <?php
              $sql1="select * from karyawan where id_kelas_karyawan=3 order by nama";
              $query1=mysqli_query($koneksi,$sql1);
              while($kolom1=mysqli_fetch_array($query1)){
                  echo "<option value='$kolom1[id_karyawan]'>$kolom1[nama]</option>"; 
              }
            ?>
          </select>
               
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
