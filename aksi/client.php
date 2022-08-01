<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){            
            $id_regional=$_POST['id_regional'];
            $nama=$_POST['nama'];
            $alamat=$_POST['alamat'];
            $email=$_POST['email'];
            $handphone=$_POST['handphone'];
            $nama_bank=$_POST['nama_bank'];
            $nomor_rekening=$_POST['nomor_rekening'];
            
            $sql="insert into client (id_client, id_regional, nama, alamat, email, handphone, nama_bank, nomor_rekening, dibuat_pada, diubah_pada) values(DEFAULT,$id_regional,'$nama','$alamat','$email','$handphone','$nama_bank','$nomor_rekening',DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=client');
        }
        else if($_POST['aksi']=='ubah'){
            $id_client=$_POST['id_client'];
            $id_regional=$_POST['id_regional'];
            $nama=$_POST['nama'];
            $alamat=$_POST['alamat'];
            $email=$_POST['email'];
            $handphone=$_POST['handphone'];
            $nama_bank=$_POST['nama_bank'];
            $nomor_rekening=$_POST['nomor_rekening'];
            $latitude=$_POST['latitude'];
            $longitude=$_POST['longitude'];

            $sql="update client set id_regional=$id_regional,nama='$nama',alamat='$alamat',email='$email',handphone='$handphone',nama_bank='$nama_bank',nomor_rekening='$nomor_rekening',latitude='$latitude',longitude='$longitude',diubah_pada=DEFAULT where id_client=$id_client";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=client');
        }
    }

    if(!empty($_GET['aksi'])){
        $x0=$_GET['id'];
        $sql="delete from client where id_client=$x0";
        mysqli_query($koneksi,$sql);
        header('location:../index.php?p=client');
    }
?>