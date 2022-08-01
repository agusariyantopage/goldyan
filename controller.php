<?php
    $BASE_URL="http://localhost/goldyan/";

    if(empty($_GET['p'])){
        $title  ="App CV Goldyan Nor Versi 1.0"; 
        $konten="konten/home.php";    
    }

    // (START) Menu Master Data
    else if($_GET['p']=='provinsi'){
        $title  ="Data Provinsi";
        $konten="konten/provinsi.php";
    }
    else if($_GET['p']=='regional'){
        $title  ="Data Regional";
        $konten="konten/regional.php";
    }
    else if($_GET['p']=='client'){
        $title  ="Data Client";
        $konten="konten/client.php";
    } 
    else if($_GET['p']=='karyawan'){
        $title  ="Data Karyawan";
        $konten="konten/karyawan.php";
    } 
    else if($_GET['p']=='harga'){
        $title  ="Data Perubahan Harga";
        $konten="konten/harga.php";
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
    else if($_GET['p']=='realisasi'){
        $title  ="Data Realisasi Penjadwalan Collecting";
        $konten="konten/realisasi.php";
    }
    else if($_GET['p']=='jadwal-kolektor'){
        $title  ="Data Jadwal Collecting";
        $konten="konten/jadwal-kolektor.php";
    }

    // Menu Laporan
    else if($_GET['p']=='laporan'){
        $title  ="Laporan";
        $konten="konten/laporan.php";
    }
?>