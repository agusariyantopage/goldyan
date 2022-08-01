
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Laporan Rekapitulasi Per Regional
                    </div>
                    <div class="card-body">
                        <form action="pdf/output/rekap_per_provinsi.php" method="GET" target="blank">
                        <label for="awal">Tanggal Awal</label>
                        <input type="date" name="awal" class="form-control" required>
                        <label for="akhir">Tanggal Akhir</label>
                        <input type="date" name="akhir" class="form-control" required>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Cetak</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Laporan Rekapitulasi Per Area
                    </div>
                    <div class="card-body">
                        <form action="pdf/output/rekap_per_area.php" method="GET" target="blank">
                        <label for="awal">Tanggal Awal</label>
                        <input type="date" name="awal" class="form-control" required>
                        <label for="akhir">Tanggal Akhir</label>
                        <input type="date" name="akhir" class="form-control" required>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Cetak</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Laporan Rekapitulasi Umum
                    </div>
                    <div class="card-body">
                        <form action="pdf/output/rekap_umum.php" method="GET" target="blank">
                        <label for="awal">Tanggal Awal</label>
                        <input type="date" name="awal" class="form-control" required>
                        <label for="akhir">Tanggal Akhir</label>
                        <input type="date" name="akhir" class="form-control" required>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Cetak</button>
                        </form>
                    </div>
                </div>
            </div>

            
            
        </div>
             
        
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

