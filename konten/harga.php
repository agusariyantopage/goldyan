
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Harga</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
              <li class="breadcrumb-item active">Harga</li>
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
              <h3>Data Harga</h3>
            </div> 
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah</button>
              
              <table class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>                    
                    <td>Tanggal</td>
                    <td>Perubahan Terakhir</td>
                    <td>Harga</td>                    
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $sql="select * from harga order by id_harga desc limit 100";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
?>                 
                <tr>
                  <td><?= $kolom['tanggal']; ?></td>
                  <td><?= $kolom['diubah_pada']; ?></td>
                  <td align='right'><?= number_format($kolom['harga']); ?></td>                  
                </tr>
               
<?php
  }
?>                
              </table>
              NB : Pastikan sudah mengupdate harga sebelum melakukan proses penjadwalan,Harga yang digunakan adalah harga terakhir  
            </div> 
          </div>
        </div>
      </row>
           
        
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Untuk Tambah Harga -->
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Harga Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/harga.php" method="post">
          <input type="hidden" name="aksi" value="tambah">
          <label for="tanggal">Tanggal</label>          
          <input type="date" name="tanggal" class="form-control" required>
          <label for="harga">Harga</label>
          <input type="number" required class="form-control" name="harga">        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
