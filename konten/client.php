
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Client</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
              <li class="breadcrumb-item active">Client</li>
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
              <h3>Data Client</h3>
            </div> 
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah</button>
              
              <table id="example1" class="table table-bordered table-striped table-sm">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>Nama Client</td>
                    <td>Regional</td>
                    <td>Email</td>
                    <td>No. Kontak</td>
                    <td>Dibuat Pada</td>
                    <td>Perubahan Terakhir</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $sql="select client.*,regional from client,regional where client.id_regional=regional.id_regional";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
?>                 
                <tr>
                  <td><?= $kolom['nama']; ?></td>
                  <td><?= $kolom['regional']; ?></td>
                  <td><?= $kolom['email']; ?></td>
                  <td><?= $kolom['handphone']; ?></td>
                  <td><?= $kolom['dibuat_pada']; ?></td>
                  <td><?= $kolom['diubah_pada']; ?></td>
                  <td>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_client']; ?>"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/client.php?aksi=hapus&id=<?= $kolom['id_client']; ?>"><i class="fas fa-trash"></i></a></button>
                  </td>
                </tr>
<!-- Modal Edit -->
<div class="modal fade" id="editModal<?= $kolom['id_client']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Ubah Client</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/client.php" method='post'>
            <input type="hidden" name="aksi" value="ubah">
            <input type="hidden" name="id_client" value="<?= $kolom['id_client']; ?>">
            <label for="nama">Nama Client</label>
            <input type="text" required class="form-control" name="nama" value="<?= $kolom['nama']; ?>">
            <label for="id_regional">Regional</label>
            <select class="form-control" name="id_regional" id="id_regional" required>
              <option value="<?= $kolom['id_regional']; ?>"><?= $kolom['regional']; ?></option>
              <?php
                $sql1="select * from regional";
                $query1=mysqli_query($koneksi,$sql1);
                while($kolom1=mysqli_fetch_array($query1)){
                  echo "<option value=$kolom1[id_regional]>$kolom1[regional]</option>";
                }
              ?>
            </select>

            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" rows="5" required><?= $kolom['alamat']; ?></textarea>    
                  
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="<?= $kolom['email']; ?>">

            <label for="handphone">Nomor Kontak</label>
            <input type="text" class="form-control" name="handphone" value="<?= $kolom['handphone']; ?>">

            <label for="nama_bank">Nama Bank</label>
            <input type="text" class="form-control" name="nama_bank" value="<?= $kolom['nama_bank']; ?>">        

            <label for="nomor_rekening">Nomor Rekening Bank</label>
            <input value="<?= $kolom['nomor_rekening']; ?>" type="text" class="form-control" name="nomor_rekening" >  
            
            <label for="latitude">Latitude</label>
            <input value="<?= $kolom['latitude']; ?>" type="text" class="form-control" name="latitude" > 

            <label for="longitude">Longitude</label>
            <input value="<?= $kolom['longitude']; ?>" type="text" class="form-control" name="longitude" >  
        
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

  <!-- Modal Untuk Tambah Client -->
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Client Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/client.php" method="post">
            <input type="hidden" name="aksi" value="tambah">
            <label for="nama">Nama Client</label>
            <input type="text" required class="form-control" name="nama">
            <label for="id_regional">Regional</label>
            <select class="form-control" name="id_regional" id="id_regional" required>
              <option value="">-- Pilih Regional --</option>
              <?php
                $sql1="select * from regional";
                $query1=mysqli_query($koneksi,$sql1);
                while($kolom1=mysqli_fetch_array($query1)){
                  echo "<option value=$kolom1[id_regional]>$kolom1[regional]</option>";
                }
              ?>
            </select>

            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" rows="5" required></textarea>    
                  
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email">

            <label for="handphone">Nomor Kontak</label>
            <input type="text" class="form-control" name="handphone">

            <label for="nama_bank">Nama Bank</label>
            <input type="text" class="form-control" name="nama_bank">        

            <label for="nomor_rekening">Nomor Rekening Bank</label>
            <input type="text" class="form-control" name="nomor_rekening">        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
