<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            $x1=$_POST['kode'];
            $x2=$_POST['regional'];
            $x3=$_POST['id_provinsi'];
            $sql="insert into regional (kode,regional,id_provinsi,dibuat_pada,diubah_pada) values('$x1','$x2',$x3,DEFAULT,DEFAULT)";
            echo $sql;
            mysqli_query($koneksi,$sql);
            //header('location:../index.php?p=regional');
        }
        else if($_POST['aksi']=='ubah'){
            $x0=$_POST['id'];
            $x1=$_POST['kode'];
            $x2=$_POST['regional'];
            $x3=$_POST['id_provinsi'];
            $sql="update regional set kode='$x1',regional='$x2',id_provinsi=$x3,diubah_pada=DEFAULT where id_regional=$x0";
            mysqli_query($koneksi,$sql);
            echo $sql;
            header('location:../index.php?p=regional');
        }
    }

    if(!empty($_GET['aksi'])){
        $x0=$_GET['id'];
        $sql="delete from regional where id_regional=$x0";
        mysqli_query($koneksi,$sql);
        header('location:../index.php?p=regional');
    }
?>