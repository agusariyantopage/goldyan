<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            $x1=$_POST['provinsi'];
            $sql="insert into provinsi (provinsi,dibuat_pada,diubah_pada) values('$x1',DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=provinsi');
        }
        else if($_POST['aksi']=='ubah'){
            $x0=$_POST['id'];
            $x1=$_POST['provinsi'];
            $sql="update provinsi set provinsi='$x1',diubah_pada=DEFAULT where id_provinsi=$x0";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=provinsi');
        }
    }

    if(!empty($_GET['aksi'])){
        $x0=$_GET['id'];
        $sql="delete from provinsi where id_provinsi=$x0";
        mysqli_query($koneksi,$sql);
        header('location:../index.php?p=provinsi');
    }
?>