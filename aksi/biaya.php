<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            $x1=$_POST['biaya'];
            $sql="insert into biaya (biaya,dibuat_pada,diubah_pada) values('$x1',DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=biaya');
        }
        else if($_POST['aksi']=='ubah'){
            $x0=$_POST['id'];
            $x1=$_POST['biaya'];
            $sql="update biaya set biaya='$x1',diubah_pada=DEFAULT where id_biaya=$x0";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=biaya');
        }
    }

    if(!empty($_GET['aksi'])){
        $x0=$_GET['id'];
        $sql="delete from biaya where id_biaya=$x0";
        mysqli_query($koneksi,$sql);
        header('location:../index.php?p=biaya');
    }
?>