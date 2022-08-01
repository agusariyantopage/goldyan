<?php
    $tanggal=$_GET['tanggal'];
?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Jadwal <?= $tanggal; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
              <li class="breadcrumb-item"><a href="index.php?p=jadwal">Jadwal</a></li>
              <li class="breadcrumb-item active"><?= $tanggal; ?></li>
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
              <h3>Data Jadwal <?= $tanggal; ?></h3>
            </div> 
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalKolektorByArea">
              <i class="fas fa-map-marked-alt"></i> Setup Kolektor Per-Area</button>
              <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-copy"></i> Salin Kolektor</button>
              <a target="blank" href="pdf/output/jadwal_kolektor.php?tanggal=<?= $tanggal; ?>"><button type="button" class="btn btn-warning mb-2"><i class="fas fa-print"></i> Cetak Jadwal</button></a>
              

              <table class="table table-bordered table-striped table-sm">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    
                    <td>No</td>
                    <td>Klien</td>
                    <td>Area</td>
                    <td>Kolektor</td>
                    <td>Status</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   //$sql="select jadwal.*,id_regional,client.nama as nama_client,karyawan.nama as kolektor from jadwal,client,karyawan where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and tanggal='$tanggal' order by nama_client";
   $sql="select jadwal.*,client.id_regional,client.nama as nama_client,karyawan.nama as kolektor,regional.regional from jadwal,client,karyawan,regional where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and client.id_regional=regional.id_regional and tanggal='$tanggal' order by nama_client";
   $query=mysqli_query($koneksi,$sql);
   $no=0;
   while($kolom=mysqli_fetch_array($query)){
     $no++;
?>                 
                <tr>                  
                  <td><?= $no; ?></td>
                  <td><?= $kolom['nama_client']; ?></td>
                  <td><?= $kolom['regional']; ?></td>
                  <td><?= $kolom['kolektor']; ?></td>
                  <td>
                        <?php
                            if ($kolom['status']=='Pending') {
                              echo "<span class='badge badge-warning'>";
                            } elseif($kolom['status']=='Kosong') {
                              echo "<span class='badge badge-danger'>";
                            } else {
                              echo "<span class='badge badge-success'>";
                            }
                           echo $kolom['status']; 
                           echo "</span>";
                        ?>   
                  </td>                  
                  <td>                   
                  <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_jadwal']; ?>"><i class="fas fa-edit"></i></button>
                    
                  </td>
                </tr>
                <!-- Edit Modal -->                
                <div class="modal fade" id="editModal<?= $kolom['id_jadwal']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Ubah Kolektor</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/jadwal.php" method='post'>
                          <input type="hidden" name="aksi" value="ubah-kolektor">
                          <input type="hidden" name="id_jadwal" value="<?= $kolom['id_jadwal']; ?>">
                          <input type="hidden" name="tanggal" value="<?= $kolom['tanggal']; ?>">
                          <label for="nama_client">Nama Klien</label>
                          <input type="text" value="<?= $kolom['nama_client']; ?>" readonly required class="form-control" name="nama_client">
                          <label for="id_karyawan">Kolektor</label>
                          <select name="id_karyawan" class="form-control">
                            <option value="<?= $kolom['id_karyawan']; ?>"><?= $kolom['kolektor']; ?></option>
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
                        <button type="submit" class="btn btn-primary">Ubah</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
           
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

<!-- Modal Kolektor By Area -->
<div class="modal fade" id="modalKolektorByArea" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Ubah Kolektor Per Area</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/jadwal.php" method='post'>
          <input type="hidden" name="aksi" value="ubah-kolektor-area">          
          <input type="hidden" name="tanggal" value="<?= $tanggal; ?>">
          
          <label for="id_regional">Regional</label>
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
        <button type="submit" class="btn btn-primary">Ubah</button>
        </form>
      </div>
    </div>
  </div>
</div>