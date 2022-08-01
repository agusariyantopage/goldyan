
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
              <li class="breadcrumb-item active">Area</li>
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
              <h3>Data Area</h3>
            </div> 
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah</button>
              
              <table id="example1" class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>Kode Area</td>
                    <td>Area</td>
                    <td>Provinsi</td>
                    <td>Perubahan Terakhir</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $sql="select regional.*,provinsi from regional,provinsi where regional.id_provinsi=provinsi.id_provinsi";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
?>                 
                <tr>
                  <td><?= $kolom['kode']; ?></td>
                  <td><?= $kolom['regional']; ?></td>
                  <td><?= $kolom['provinsi']; ?></td>
                  <td><?= $kolom['diubah_pada']; ?></td>
                  <td>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_regional']; ?>"><i class="fas fa-edit"></i></button>
                    <!--<button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/regional.php?aksi=hapus&id=<?= $kolom['id_regional']; ?>"><i class="fas fa-trash"></i></a></button>-->
                  </td>
                </tr>
<!-- Modal Edit -->
<div class="modal fade" id="editModal<?= $kolom['id_regional']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Ubah Area</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/regional.php" method='post'>
          <input type="hidden" name="aksi" value="ubah">
          <input type="hidden" name="id" value="<?= $kolom['id_regional']; ?>">
          <label for="id_provinsi">Provinsi</label>
            <select class="form-control" name="id_provinsi" id="id_provinsi" required>
              <option value="<?= $kolom['id_provinsi']; ?>"><?= $kolom['provinsi']; ?></option>
              <?php
                $sql1="select * from provinsi";
                $query1=mysqli_query($koneksi,$sql1);
                while($kolom1=mysqli_fetch_array($query1)){
                  echo "<option value=$kolom1[id_provinsi]>$kolom1[provinsi]</option>";
                }
              ?>
            </select>
          <label for="kode">Kode</label>
          <input type="text" value="<?= $kolom['kode']; ?>" required class="form-control" name="kode">
          <label for="regional">Area</label>
          <input type="text" value="<?= $kolom['regional']; ?>" required class="form-control" name="regional">
        
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

  <!-- Modal Untuk Tambah Area -->
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Area Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/regional.php" method="post">
          <input type="hidden" name="aksi" value="tambah">
          <label for="id_provinsi">Provinsi</label>
            <select class="form-control" name="id_provinsi" id="id_provinsi" required>
              <option value="">-- Pilih Provinsi --</option>
              <?php
                $sql1="select * from provinsi";
                $query1=mysqli_query($koneksi,$sql1);
                while($kolom1=mysqli_fetch_array($query1)){
                  echo "<option value=$kolom1[id_provinsi]>$kolom1[provinsi]</option>";
                }
              ?>
            </select>
          <label for="kode">Kode</label>
          <input type="text" required class="form-control" name="kode">
          <label for="regional">Area</label>
          <input type="text" required class="form-control" name="regional">        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
