<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengeluaran</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item active">Pengeluaran</li>
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
              <h3>Data Pengeluaran</h3>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i> Tambah</button>

              <table id="example1_desc" class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>Tanggal</td>
                    <td>Petugas</td>
                    <td>Pengeluaran</td>
                    <td>Jumlah</td>
                    <td>Perubahan Terakhir</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
                <?php
                $id_akses=$_SESSION['backend_user_id'];
                if($id_akses == 1){
                  $sql = "select biaya_histori.*,biaya,nama from biaya_histori,biaya,karyawan where biaya_histori.id_biaya=biaya.id_biaya and biaya_histori.id_karyawan=karyawan.id_karyawan";
                } else {
                  $sql = "select biaya_histori.*,biaya,nama from biaya_histori,biaya,karyawan where biaya_histori.id_biaya=biaya.id_biaya and biaya_histori.id_karyawan=karyawan.id_karyawan and biaya_histori.id_karyawan=$id_akses";
                }
                //echo $sql;
                $query = mysqli_query($koneksi, $sql);
                while ($kolom = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?= $kolom['tanggal']; ?></td>
                    <td><?= $kolom['nama']; ?></td>
                    <td><?= $kolom['biaya']; ?></td>
                    <td><?= number_format($kolom['jumlah']); ?></td>
                    <td><?= $kolom['diubah_pada']; ?></td>
                    <td>
                      <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_biaya_histori']; ?>"><i class="fas fa-edit"></i></button>
                    </td>
                  </tr>
                  <!-- Modal Edit -->
                  <div class="modal fade" id="editModal<?= $kolom['id_biaya_histori']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel">Ubah Pengeluaran</h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="aksi/biaya_histori.php" method='post'>
                            <input type="hidden" name="aksi" value="ubah">
                            <input type="hidden" name="id_biaya_histori" value="<?= $kolom['id_biaya_histori']; ?>">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" value="<?= $kolom['tanggal']; ?>" required class="form-control" name="tanggal">

                            <label for="id_karyawan">Karyawan</label>
                            <select name="id_karyawan" class="form-control" required readonly>
                              <option value="<?= $kolom['id_karyawan']; ?>"><?= $kolom['nama']; ?></option>
                              <?php
                              if ($_SESSION['backend_user_akses'] == 1) {
                                $sql_karyawan1 = "select * from karyawan order by nama";
                                $query_karyawan1 = mysqli_query($koneksi, $sql_karyawan1);
                                while ($kombokaryawan1 = mysqli_fetch_array($query_karyawan1)) {
                                  echo "<option value='$kombokaryawan1[id_karyawan]'>$kombokaryawan1[nama]</option>";
                                }
                              }
                              ?>
                            </select>

                            <label for="id_biaya">Jenis Pengeluaran</label>
                            <select name="id_biaya" class="form-control" required>
                              <option value="<?= $kolom['id_biaya']; ?>"><?= $kolom['biaya']; ?></option>
                              <?php
                              $sql_biaya1 = "select * from biaya order by biaya";
                              $query_biaya1 = mysqli_query($koneksi, $sql_biaya1);
                              while ($kombobiaya1 = mysqli_fetch_array($query_biaya1)) {
                                echo "<option value='$kombobiaya1[id_biaya]'>$kombobiaya1[biaya]</option>";
                              }
                              ?>
                            </select>

                            <label for="jumlah">Jumlah</label>
                            <input type="number" value="<?= $kolom['jumlah']; ?>" required class="form-control" name="jumlah">

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

<!-- Modal Untuk Tambah Pengeluaran -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/biaya_histori.php" method="post">
          <input type="hidden" name="aksi" value="tambah">
          <label for="tanggal">Tanggal</label>
          <input type="date" required class="form-control" name="tanggal">

          <label for="id_karyawan">Karyawan</label>
          <select name="id_karyawan" class="form-control" required readonly>
            <option value="<?= $_SESSION['backend_user_id']; ?>"><?= $_SESSION['backend_user_nama']; ?></option>
            <?php
            if ($_SESSION['backend_user_akses'] == 1) {
              $sql_karyawan1 = "select * from karyawan order by nama";
              $query_karyawan1 = mysqli_query($koneksi, $sql_karyawan1);
              while ($kombokaryawan1 = mysqli_fetch_array($query_karyawan1)) {
                echo "<option value='$kombokaryawan1[id_karyawan]'>$kombokaryawan1[nama]</option>";
              }
            }
            ?>
          </select>

          <label for="id_biaya">Jenis Pengeluaran</label>
          <select name="id_biaya" class="form-control" required>
            <option value="">Pilih Jenis Biaya</option>
            <?php
            $sql_biaya1 = "select * from biaya order by biaya";
            $query_biaya1 = mysqli_query($koneksi, $sql_biaya1);
            while ($kombobiaya1 = mysqli_fetch_array($query_biaya1)) {
              echo "<option value='$kombobiaya1[id_biaya]'>$kombobiaya1[biaya]</option>";
            }
            ?>
          </select>

          <label for="jumlah">Jumlah</label>
          <input type="number" required class="form-control" name="jumlah">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>