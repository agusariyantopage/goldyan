
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
              <li class="breadcrumb-item active">Karyawan</li>
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
              <h3>Data Karyawan</h3>
            </div> 
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah</button>
              
              <table id="example1" class="table table-bordered table-striped table-sm">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>Nama Karyawan</td>
                    <td>Jabatan</td>
                    <td>Email</td>
                    <td>No. Kontak</td>
                    <td>Dibuat Pada</td>
                    <td>Perubahan Terakhir</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $sql="select karyawan.*,kelas_karyawan from karyawan,kelas_karyawan where karyawan.id_kelas_karyawan=kelas_karyawan.id_kelas_karyawan";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
?>                 
                <tr>
                  <td><?= $kolom['nama']; ?></td>
                  <td><?= $kolom['kelas_karyawan']; ?></td>
                  <td><?= $kolom['email']; ?></td>
                  <td><?= $kolom['handphone']; ?></td>
                  <td><?= $kolom['dibuat_pada']; ?></td>
                  <td><?= $kolom['diubah_pada']; ?></td>
                  <td>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_karyawan']; ?>"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/karyawan.php?aksi=hapus&id=<?= $kolom['id_karyawan']; ?>"><i class="fas fa-trash"></i></a></button>
                  </td>
                </tr>
<!-- Modal Edit -->
<div class="modal fade" id="editModal<?= $kolom['id_karyawan']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Ubah Karyawan</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/karyawan.php" method='post'>
            <input type="hidden" name="aksi" value="ubah">
            <input type="hidden" name="id_karyawan" value="<?= $kolom['id_karyawan']; ?>">
            <label for="nama">Nama Karyawan</label>
            <input type="text" required class="form-control" name="nama" value="<?= $kolom['nama']; ?>">
            <label for="id_kelas_karyawan">Jabatan</label>
            <select class="form-control" name="id_kelas_karyawan" id="id_kelas_karyawan" required>
              <option value="<?= $kolom['id_kelas_karyawan']; ?>"><?= $kolom['kelas_karyawan']; ?></option>
              <?php
                $sql1="select * from kelas_karyawan";
                $query1=mysqli_query($koneksi,$sql1);
                while($kolom1=mysqli_fetch_array($query1)){
                  echo "<option value=$kolom1[id_kelas_karyawan]>$kolom1[kelas_karyawan]</option>";
                }
              ?>
            </select>

            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" rows="5" required><?= $kolom['alamat']; ?></textarea>    
                  
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="<?= $kolom['email']; ?>">

            <label for="handphone">Nomor Kontak</label>
            <input type="text" class="form-control" name="handphone" value="<?= $kolom['handphone']; ?>">

            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?= $kolom['username']; ?>">        

            <label for="password">Password</label>
            <input value="<?= $kolom['password']; ?>" type="password" class="form-control" name="password" >  
        
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

  <!-- Modal Untuk Tambah Karyawan -->
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/karyawan.php" method="post" autocomplete="off">
            <input type="hidden" name="aksi" value="tambah">
            <label for="nama">Nama Karyawan</label>
            <input type="text" required class="form-control" name="nama">
            <label for="id_kelas_karyawan">Jabatan</label>
            <select class="form-control" name="id_kelas_karyawan" id="id_kelas_karyawan" required>
              <option value="">-- Pilih Jabatan --</option>
              <?php
                $sql1="select * from kelas_karyawan";
                $query1=mysqli_query($koneksi,$sql1);
                while($kolom1=mysqli_fetch_array($query1)){
                  echo "<option value=$kolom1[id_kelas_karyawan]>$kolom1[kelas_karyawan]</option>";
                }
              ?>
            </select>

            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" rows="5" required></textarea>    

            <label for="handphone">Nomor Kontak</label>
            <input type="text" class="form-control" name="handphone">
                  
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email">

            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="" autocomplete="off">        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
