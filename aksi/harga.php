<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            $x1=$_POST['tanggal'];
            $x2=$_POST['harga'];
            $sql="insert into harga (tanggal,harga,dibuat_pada,diubah_pada) values('$x1',$x2,DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);

            $sql1="ALTER TABLE jadwal CHANGE harga harga DECIMAL(17,2) NOT NULL DEFAULT $x2";
            mysqli_query($koneksi,$sql1);

            $sql2="update jadwal set harga = $x2 where status='Pending'";
            mysqli_query($koneksi,$sql2);
            
            header('location:../index.php?p=harga');
        }
        
    }

    if(!empty($_GET['aksi'])){
        $x0=$_GET['id'];
        $sql="delete from harga where id_harga=$x0";
        mysqli_query($koneksi,$sql);
        header('location:../index.php?p=harga');
    }
?>