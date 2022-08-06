<?php
    $BASE_URL="http://localhost/goldyan/";
    $hak_akses=$_SESSION['backend_user_akses'];

    if(empty($_GET['p'])){
        $title  ="App CV Goldyan Nor Versi 1.0"; 
        $konten="konten/home.php";    
    }

    // (START) Menu Master Data
    else if($_GET['p']=='provinsi' && $hak_akses==1){
        $title  ="Data Provinsi";
        $konten="konten/provinsi.php";
    }
    else if($_GET['p']=='regional' && $hak_akses==1){
        $title  ="Data Regional";
        $konten="konten/regional.php";
    }
    else if($_GET['p']=='client' && $hak_akses==1){
        $title  ="Data Client";
        $konten="konten/client.php";
    } 
    else if($_GET['p']=='karyawan' && $hak_akses==1){
        $title  ="Data Karyawan";
        $konten="konten/karyawan.php";
    } 
    else if($_GET['p']=='harga' && $hak_akses==1){
        $title  ="Data Perubahan Harga";
        $konten="konten/harga.php";
    } 
    else if($_GET['p']=='biaya' && $hak_akses==1){
        $title  ="Data Daftar Biaya";
        $konten="konten/biaya.php";
    } 

    // Menu Transaksi
    else if($_GET['p']=='jadwal'){
        $title  ="Data Perencanaan";
        $konten="konten/jadwal.php";
    }
    else if($_GET['p']=='jadwal-detail'){
        $title  ="Data Detail Perencanaan";
        $konten="konten/jadwal-detail.php";
    }
    else if($_GET['p']=='realisasi' && $hak_akses==1){
        $title  ="Data Realisasi Penjadwalan Collecting";
        $konten="konten/realisasi.php";
    }
    else if($_GET['p']=='jadwal-kolektor'){
        $title  ="Data Jadwal Collecting";
        $konten="konten/jadwal-kolektor.php";
    }
    else if($_GET['p']=='pengeluaran'){
        $title  ="Catatan Pengeluaran";
        $konten="konten/pengeluaran.php";
    }

    // Menu Laporan
    else if($_GET['p']=='laporan'){
        $title  ="Laporan";
        $konten="konten/laporan.php";
    }

    // Not Found
    else {
        $title  ="Halaman Tidak Ditemukan";
        $konten="konten/halaman_tidak_ditemukan.php";
    }
?>