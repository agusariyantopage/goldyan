<?php
    session_start();
    include "../koneksi.php";
    $tgl=date("Y-m-d");

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            $tanggal=$_POST['tanggal'];
            $id_karyawan=$_POST['id_karyawan'];
            $id_regional=$_POST['id_regional'];
            $sql1="select * from client where id_regional=$id_regional";
            $query1=mysqli_query($koneksi,$sql1);
            while($kolom1=mysqli_fetch_array($query1)){
                $id_client=$kolom1['id_client'];                
                $catatan="";               
                $dibuat_oleh="Admin";
                $status="Pending";
                $sql2="select * from jadwal where tanggal='$tanggal' and id_client=$id_client";
                $query2=mysqli_query($koneksi,$sql2);
                $ketemu2=mysqli_num_rows($query2);
                if($ketemu2<=0){
                    $sql="insert into jadwal (tanggal, id_client, id_karyawan, catatan, harga, dibuat_pada, diubah_pada, dibuat_oleh, status) values('$tanggal',$id_client,$id_karyawan,'$catatan',DEFAULT,DEFAULT,DEFAULT,'$dibuat_oleh','$status')";
                    mysqli_query($koneksi,$sql);
                    //echo $sql;
                }                
            }
            $location='location:../index.php?p=jadwal-detail&tanggal='.$tanggal;
            header($location);
        }
        else if($_POST['aksi']=='ubah-kolektor'){
            $id_jadwal=$_POST['id_jadwal'];
            $id_karyawan=$_POST['id_karyawan'];
            $tanggal=$_POST['tanggal'];
            
            $sql="update jadwal set id_karyawan=$id_karyawan,diubah_pada=DEFAULT where id_jadwal=$id_jadwal";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            $location='location:../index.php?p=jadwal-detail&tanggal='.$tanggal;
            header($location);
        }
        else if($_POST['aksi']=='tambah-pembelian'){
            $id_jadwal=$_POST['id_jadwal'];
            $jumlah=$_POST['jumlah'];
            $jumlah_liter=$_POST['jumlah_liter'];
            $metode_bayar=$_POST['metode_bayar'];
            $catatan=$_POST['catatan'];
            $status="Selesai";

            $sql="update jadwal set jumlah=$jumlah,jumlah_liter=$jumlah_liter,metode_bayar='$metode_bayar',catatan='$catatan',status='$status',tanggal_proses='$tgl',diubah_pada=DEFAULT where id_jadwal=$id_jadwal";
            //echo $sql;
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='SUKSES PROSES SIMPAN';                    
            }

            $location='location:../index.php?p=jadwal-kolektor';
            header($location);

        }

        else if($_POST['aksi']=='ubah-kolektor-area'){
            $id_regional=$_POST['id_regional'];
            $id_karyawan=$_POST['id_karyawan'];
            $tanggal=$_POST['tanggal'];
            
            $sql1="select * from client where id_regional=$id_regional";
            //echo $sql1;
            $query1=mysqli_query($koneksi,$sql1);
            while($kolom1=mysqli_fetch_array($query1)){
                $id_client=$kolom1['id_client'];
                $sql="update jadwal set id_karyawan=$id_karyawan,diubah_pada=DEFAULT where tanggal='$tanggal' and id_client=$id_client";   
                //echo $sql;             
                mysqli_query($koneksi,$sql);
            }
                
            $location='location:../index.php?p=jadwal-detail&tanggal='.$tanggal;
            header($location);
        }
        else if($_POST['aksi']=='ubah-realisasi'){
            $id_jadwal=$_POST['id_jadwal'];
            $tanggal=$_POST['tanggal'];
            $id_karyawan=$_POST['id_karyawan'];
            $metode_bayar=$_POST['metode_bayar'];
            $jumlah=$_POST['jumlah'];
            $jumlah_liter=$_POST['jumlah_liter'];
            $status=$_POST['status'];
            $sql="update jadwal set tanggal='$tanggal',id_karyawan=$id_karyawan,metode_bayar='$metode_bayar',jumlah=$jumlah,jumlah_liter=$jumlah_liter,status='$status',diubah_pada=DEFAULT where id_jadwal=$id_jadwal";   
            echo $sql;             
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=realisasi');
        }
    }

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $x0=$_GET['id'];
            $sql="delete from jadwal where id_jadwal=$x0 and status='Pending'";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=jadwal');
        }
        else if($_GET['aksi']=='collecting-kosong'){    
            $id_jadwal=$_GET['token'];
            $sql="update jadwal set status='Kosong',diubah_pada=DEFAULT,tanggal_proses='$tgl' where md5(id_jadwal)='$id_jadwal'";
            mysqli_query($koneksi,$sql);
            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='SUKSES PROSES SIMPAN';                    
            }
            header('location:../index.php?p=jadwal-kolektor');

        }
    }
?>