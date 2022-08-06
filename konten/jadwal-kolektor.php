
<?php
  $id_user=$_SESSION['backend_user_id'];
?>
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
              <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><i class="fas fa-clock"></i> Pending</a></li>
                  <li class="nav-item"><a class="nav-link" href="#riwayat" data-toggle="tab"><i class="fa fa-history"></i> Riwayat</a></li>
                  
                </ul>
            </div> 
            <div class="card-body">
              
             <!-- <a href="index.php?p=jadwal-kolektor"><button type="button" class="btn btn-warning mb-2"><i class="fas fa-clock"></i> Pending</button></a>
              <a href="index.php?p=jadwal-kolektor"><button type="button" class="btn btn-success mb-2"><i class="fa fa-history"></i> Riwayat</button></a>
              <a href="index.php?p=jadwal-kolektor"><button type="button" class="btn btn-danger mb-2"><i class="fa fa-times"></i> Kosong  </button></a> -->
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <!-- Kepala Tabel -->
                    <thead>
                      <tr>                      
                        <td>Aksi</td>   
                        <td>Update Terakhir</td>
                        <td>Nama Mitra</td>
                        <td>Tanggal Terjadwal</td>                        
                      </tr>
                    </thead>
                    <!-- Isi Tabel -->
                    <?php
                      //$sql="select jadwal.*,id_regional,client.nama as nama_client,karyawan.nama as kolektor from jadwal,client,karyawan where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and tanggal='$tanggal' order by nama_client";
                      $sql1="select * from harga order by id_harga desc";
                      $query1=mysqli_query($koneksi,$sql1);
                      $data1=mysqli_fetch_array($query1);

                      if($_SESSION['backend_user_akses']==1){ 
                        $sql="select jadwal.*,client.latitude,client.longitude,client.id_regional,client.nama as nama_client,karyawan.nama as kolektor,regional.regional from jadwal,client,karyawan,regional where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and client.id_regional=regional.id_regional and status='Pending' order by nama_client";
                      } else {
                        $sql="select jadwal.*,client.latitude,client.longitude,client.id_regional,client.nama as nama_client,karyawan.nama as kolektor,regional.regional from jadwal,client,karyawan,regional where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and client.id_regional=regional.id_regional and status='Pending' and jadwal.id_karyawan=$id_user order by nama_client";
                      }  
                      //echo $sql;
                      $query=mysqli_query($koneksi,$sql);
                      $no=0;
                      while($kolom=mysqli_fetch_array($query)){
                        $no++;
                    ?>                 
                      <tr>
                        <td>                  
                        <button type="button" class="btn btn-link prosestransaksi" data-toggle="modal" data-target="#prosesModal" data-id="<?= $kolom['id_jadwal']; ?>"><i class="fas fa-calculator"></i></button>                            
                        </td>
                        <td><?= $kolom['diubah_pada'];; ?></td>
                        <td><?= $kolom['nama_client']; ?> (<?= $kolom['regional']; ?>)</td>
                        <td><?= $kolom['tanggal']; ?></td>                                    
                        
                      </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="prosesModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Proses Transaksi</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <div class="card">
                                <div class="card-header bg-warning"><?= $kolom['nama_client']; ?></div>
                                <div class="card-body">
                                  <form onsubmit="return confirm('Apakah yakin semua data sudah benar?');" action="aksi/jadwal.php" method="POST">
                                  <input type="hidden" name="aksi" value="tambah-pembelian">
                                  <input type="hidden" name="id_jadwal" value="<?= $kolom['id_jadwal']; ?>">
                                  <label for="tanggal">Tanggal Terjadwal</label>
                                  <input type="date" class="form-control" value="<?= $kolom['tanggal']; ?>" readonly>
                                  <label for="jumlah">Jumlah (Jirigen)</label>
                                  <input type="number" step=".01" id="jumlah" name="jumlah" class="form-control" required>
                                  <label for="harga">Harga Per Jirigen</label>
                                  <input type="number" name="harga" id="harga" max="<?= $data1['harga']; ?>" class="form-control" required>
                                  <label for="total">Total</label>
                                  <input type="number" name="total" id="total" value="0" class="form-control" required readonly>
                                  <label for="metode_bayar">Metode Pembayaran</label>
                                  <select name="metode_bayar" class="form-control" required> 
                                    <option value="KAS">KAS</option>
                                    <option value="OVO">OVO</option>
                                  </select>
                                  <label for="catatan">Catatan</label>
                                  <textarea name="catatan" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="card-footer">
                                  <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Proses</button></form>
                                  
                                  <a href="aksi/jadwal.php?aksi=collecting-kosong&token=<?= md5($kolom['id_jadwal']); ?>" onclick="return confirm('Apakah Yakin Transaksi Ini Dikosongkan??')"><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Kosong</button></a>
                                  <a target="blank" href="https://www.google.com/maps?q=<?= $kolom['latitude']; ?>,<?= $kolom['longitude']; ?>"><button type="button" class="btn btn-success"> <i class="fas fa-map"></i> Peta</button></a>
                                  
                                </div>
                              </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              
                                
                              </div>
                            </div>
                          </div>
                        </div>   
                          <?php
                            }
                          ?>                
                    </table>
                </div> <!-- Tutup div tab pending -->  
                
                <!-- Div Tab Riwayat -->
                <div class="tab-pane" id="riwayat">
                  <div class="table-responsive">
                    <table id="example1_desc" class="table table-bordered table-striped table-sm">
                    <!-- Kepala Tabel -->
                    <thead>
                      <tr>                      
                        <td>Tanggal Proses</td>
                        <td>Nama Mitra</td>
                        <td>Metode Bayar</td>                        
                        <td>Petugas</td> 
                        <td>Rincian</td> 
                        <td>Total</td> 
                        <td>Aksi</td> 
                          
                      </tr>
                    </thead>
                    <!-- Isi Tabel -->
                    <?php
                      //$sql="select jadwal.*,id_regional,client.nama as nama_client,karyawan.nama as kolektor from jadwal,client,karyawan where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and tanggal='$tanggal' order by nama_client";
                      
                      if($_SESSION['backend_user_akses']==1){
                        $sql="select jadwal.*,client.id_regional,client.nama as nama_client,karyawan.nama as kolektor,regional.regional from jadwal,client,karyawan,regional where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and client.id_regional=regional.id_regional and status!='Pending' order by tanggal desc limit 100";
                      } else {
                        $sql="select jadwal.*,client.id_regional,client.nama as nama_client,karyawan.nama as kolektor,regional.regional from jadwal,client,karyawan,regional where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and client.id_regional=regional.id_regional and status!='Pending' and jadwal.id_karyawan=$id_user order by tanggal desc limit 100";
                      }
                      //echo $sql;
                      $query=mysqli_query($koneksi,$sql);
                      $no=0;
                      while($kolom=mysqli_fetch_array($query)){
                        $no++;
                    ?>                 
                      <tr>                  
                        <td><?= $kolom['tanggal_proses'];; ?></td>
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
                      </tr>
                          <?php
                            }
                          ?>                
                    </table>
                  </div>
                </div>
                
              </div> <!-- Tutup div tab content -->

            </div> 
          </div>
        </div>
      </row>
             
        
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script>
 // for (i = 1; i < 3; i++) {
  function hitung_total(evt){   
      var inputJumlah="jumlah";
      var jumlah=document.getElementById(inputJumlah).value;

      //var inputHarga="harga["+i+"]";      
      var inputHarga="harga";      
      var harga=document.getElementById(inputHarga).value;
      
      var subtotal=jumlah*harga;
      
      //var inputTotal="total["+i+"]";
      var inputTotal="total";
      //document.getElementById(inputTotal).value=subtotal;
      document.getElementById(inputTotal).value=subtotal;
      //document.getElementById("total").value=h2;
    }
    
    document.getElementById('jumlah').addEventListener("mouseup", function (evt) {
      hitung_total();      
    }, false);
    document.getElementById('jumlah').addEventListener("keyup", function (evt) {
      hitung_total();      
    }, false);
    document.getElementById('harga').addEventListener("mouseup", function (evt) {
      hitung_total();      
    }, false);
    document.getElementById('harga').addEventListener("keyup", function (evt) {
      hitung_total();      
    }, false);
    
 // } 
   
</script>