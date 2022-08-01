<?php
    // Variabel Koneksi
    $ip_address = $_SERVER['SERVER_ADDR'];
    //echo $ip_address;
    if($ip_address=='203.175.9.48'){
        $servername     ="localhost";
        $database       ="golc4556_app";
        $username       ="golc4556_app";
        $password       ="Diazka@2019";
    } else {
        $servername     ="localhost";
        $database       ="dbgoldyan";
        $username       ="root";
        $password       ="";
    }

    
    // Koneksi Ke Database
    $koneksi =mysqli_connect($servername,$username,$password,$database);

    
    // Cek apakah koneksi berhasil
    if(!$koneksi){
        die("koneksi Ke Database Gagal :".mysqli_connect_error());
    } else {
        //echo "Koneksi Ke Database Berhasil";
    }

?>