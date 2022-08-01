<?php
    
?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Realisasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>              
              <li class="breadcrumb-item active">Realisasi</li>
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
              <h3>Data Realisasi Collecting</h3>
            </div> 
            <div class="card-body"> 
              <table id="example1_desc" class="table table-bordered table-striped table-sm">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    
                    <td>No</td>
                    <td>Klien</td>
                    <td>Metode Bayar</td>
                    <td>Kolektor</td>
                    <td>Jumlah</td>
                    <td>Subtotal</td>
                    <td>Status</td>                    

                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   //$sql="select jadwal.*,id_regional,client.nama as nama_client,karyawan.nama as kolektor from jadwal,client,karyawan where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and tanggal='$tanggal' order by nama_client";
   $sql="select jadwal.*,client.id_regional,client.nama as nama_client,karyawan.nama as kolektor,regional.regional from jadwal,client,karyawan,regional where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and client.id_regional=regional.id_regional and status!='Pending' order by tanggal";
   $query=mysqli_query($koneksi,$sql);
   $no=0;
   while($kolom=mysqli_fetch_array($query)){
     $no++;
?>                 
                <tr>                  
                  <td><?= $no; ?></td>
                  <td><?= $kolom['nama_client']; ?> (<?= $kolom['regional']; ?>)</td>
                  <td><?= $kolom['metode_bayar']; ?></td>
                  <td><?= $kolom['kolektor']; ?></td>
                  <td><?= number_format($kolom['jumlah'],2); ?> x <?= number_format($kolom['harga']); ?></td>
                  <td><?= number_format($kolom['jumlah']*$kolom['harga']); ?></td>                  
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
                        <h5 class="modal-title" id="editModalLabel">Ubah Data Realisasi</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/jadwal.php" method='post'>
                          <input type="hidden" name="aksi" value="ubah-realisasi">
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
                          <label for="metode_bayar">Metode Bayar</label>
                          <select name="metode_bayar" class="form-control" required>
                            <option><?= $kolom['metode_bayar']; ?></option>      
                            <option>KAS</option>      
                            <option>OVO</option>      
                          </select>
                          
                          <label for="jumlah">Jumlah (Jirigen)</label>
                          <input type="number" value="<?= $kolom['jumlah']; ?>" required class="form-control" name="jumlah">
                          <label for="status">Status</label>
                          <select name="status" class="form-control" required>
                          <option><?= $kolom['status']; ?></option>      
                            <option>Pending</option>      
                            <option>Selesai</option>      
                            <option>Kosong</option>      
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