 <?php
  // Hitung Nilai Umum 
  $sql1 = "select count(id_jadwal) as jumlah_transaksi,sum(harga*jumlah) as total_transaksi,sum(jumlah) as jumlah_jirigen,sum(jumlah_liter) as jumlah_liter from jadwal where status='selesai'";
  $query1 = mysqli_query($koneksi, $sql1);
  $data1 = mysqli_fetch_array($query1);

  $jumlah_transaksi = $data1['jumlah_transaksi'];
  $total_transaksi = $data1['total_transaksi'];
  $jumlah_jirigen = $data1['jumlah_jirigen'];
  $jumlah_liter = $data1['jumlah_liter'];

  $sql2 = "select count(*) as jumlah_client from client";
  $query2 = mysqli_query($koneksi, $sql2);
  $data2 = mysqli_fetch_array($query2);
  $jumlah_client = $data2['jumlah_client'];

  ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Dashboard</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item active"><a href="#">Home</a></li>

           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <!-- Small boxes (Stat box) -->
       <div class="row">
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-info">
             <div class="inner">
               <h3><?= number_format($jumlah_transaksi); ?></h3>

               <p>Jumlah Transaksi</p>
             </div>
             <div class="icon">
               <i class="ion ion-bag"></i>
             </div>
             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-success">
             <div class="inner">
               <h3><?= number_format($total_transaksi); ?></h3>

               <p>Total Transaksi</p>
             </div>
             <div class="icon">
               <i class="ion ion-stats-bars"></i>
             </div>
             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-warning">
             <div class="inner">
               <h3><?= number_format($jumlah_jirigen, 2); ?></h3>

               <p>Jumlah Minyak Curah (Jirigen)</p>
             </div>
             <div class="icon">
               <i class="fas fa-oil-can"></i>
             </div>
             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-danger">
             <div class="inner">
               <h3><?= number_format($jumlah_client); ?></h3>

               <p>Jumlah Mitra</p>
             </div>
             <div class="icon">
               <i class="ion ion-person-add"></i>
             </div>
             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
       </div>
       <div class="row">
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-warning">
             <div class="inner">
               <h3><?= number_format($jumlah_liter, 2); ?></h3>

               <p>Jumlah Minyak Curah (Liter)</p>
             </div>
             <div class="icon">
               <i class="fas fa-oil-can"></i>
             </div>
             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
       </div>
       <h5>Peta Sebaran Collecting</h5>
       <!-- /.row -->
       <!-- Small boxes (Stat box) -->
       <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAzSYdai-ut80wfkpMBzJcIGS0M-p-qPQ&callback=myMap"></script>-->
       <script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=myMap"></script>

       <script>
         function initialize() {
           // Function Tambah Map
           function addMarker(lat, lng, nama) {
             var marker = new google.maps.Marker({
               position: new google.maps.LatLng(lat, lng),
               title: nama,
               map: peta
             });
           }

           var propertiPeta = {
             center: new google.maps.LatLng(-1.011488, 113.382355),
             zoom: 6,
             mapTypeId: google.maps.MapTypeId.ROADMAP
           };

           var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

           <?php
            $sql_maps = "select * from client where latitude IS NOT NULL and longitude IS NOT NULL";
            $query_maps = mysqli_query($koneksi, $sql_maps);
            while ($maps = mysqli_fetch_array($query_maps)) {
              $lat = $maps['latitude'];
              $lon = $maps['longitude'];
              $nama = $maps['nama'];
              echo "addMarker($lat, $lon,'$nama');";
            }

            ?>
           //addMarker(0.4340027759053944, 109.28424488134809,"RC Medan");
           //echo 'addMarker(-2.580866871455998, 111.60236001154902,"Rocket Chicken Pangkalan Bun 1 (500)");';
           // addMarker(-2.8387566615844246, 114.57965479962704,"RC Cilacap");
           //addMarker(-2.8387566615844246, 116.20563128905708,"RC Cilacap");

         }



         // event jendela di-load  
         google.maps.event.addDomListener(window, 'load', initialize);
       </script>

       <div id="googleMap" style="width:100%;height:380px;"></div>

     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->