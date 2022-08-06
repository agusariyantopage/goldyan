<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            
            $tanggal=$_POST['tanggal'];
            $id_karyawan=$_POST['id_karyawan'];
            $id_biaya=$_POST['id_biaya'];
            $jumlah=$_POST['jumlah'];

            $sql="INSERT INTO biaya_histori(id_biaya_histori, tanggal, id_biaya, id_karyawan, jumlah, dibuat_pada, diubah_pada) VALUES (DEFAULT, '$tanggal', $id_biaya, $id_karyawan, $jumlah, DEFAULT, DEFAULT)";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=pengeluaran');
        }
        else if($_POST['aksi']=='ubah'){
            $id_biaya_histori=$_POST['id_biaya_histori'];
            $tanggal=$_POST['tanggal'];
            $id_karyawan=$_POST['id_karyawan'];
            $id_biaya=$_POST['id_biaya'];
            $jumlah=$_POST['jumlah'];
            
            $sql="UPDATE biaya_histori SET tanggal='$tanggal',id_biaya=$id_biaya,id_karyawan=$id_karyawan,jumlah=$jumlah,diubah_pada=DEFAULT WHERE id_biaya_histori=$id_biaya_histori";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=pengeluaran');
        }
    }

    if(!empty($_GET['aksi'])){
        $x0=$_GET['id'];
        $sql="delete from biaya_histori where id_biaya_histori=$x0";
        mysqli_query($koneksi,$sql);
        header('location:../index.php?p=pengeluaran');
    }
?>