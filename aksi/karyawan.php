<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){       
            $id_kelas_karyawan=$_POST['id_kelas_karyawan'];
            $nama=$_POST['nama'];
            $alamat=$_POST['alamat'];
            $email=$_POST['email'];
            $handphone=$_POST['handphone'];
            $username=$_POST['email'];
            $password=$_POST['password'];
            
            $sql="insert into karyawan (id_karyawan, id_kelas_karyawan, nama, alamat, email, handphone, username, password, dibuat_pada, diubah_pada) values(DEFAULT, $id_kelas_karyawan,'$nama','$alamat','$email','$handphone','$username','$password',DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);
            // echo $sql;
            header('location:../index.php?p=karyawan');
        }
        else if($_POST['aksi']=='ubah'){
            $id_karyawan=$_POST['id_karyawan'];
            $id_kelas_karyawan=$_POST['id_kelas_karyawan'];
            $nama=$_POST['nama'];
            $alamat=$_POST['alamat'];
            $email=$_POST['email'];
            $handphone=$_POST['handphone'];
            $username=$_POST['username'];
            $password=$_POST['password'];

            $sql="update karyawan set id_kelas_karyawan=$id_kelas_karyawan,nama='$nama',alamat='$alamat',email='$email',handphone='$handphone',username='$username',password='$password',diubah_pada=DEFAULT where id_karyawan=$id_karyawan";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=karyawan');
        }
        else if($_POST['aksi']=='login') {
            $username =$_POST['username'];
            $password =$_POST['password'];
            
            $sql="select * from karyawan where username='$username' and password='$password'";
            $query=mysqli_query($koneksi,$sql);
            //echo $sql;
            $sukses=mysqli_num_rows($query);
        
            if($sukses>=1){
                $user=mysqli_fetch_array($query);
                $_SESSION['backend_user_id']       =$user['id_karyawan'];
                $_SESSION['backend_user_nama']     =$user['nama'];
                $_SESSION['backend_user_akses']    =$user['id_kelas_karyawan'];
                $_SESSION['status_proses']         =''; 

                $sql2="update karyawan set terakhir_login=DEFAULT where id_karyawan=$_SESSION[backend_user_id]";
                mysqli_query($koneksi,$sql2);   
                header("location:../index.php");                
            } else {                       
                header("location:../login.php?msg=gagal-login");                
            }
        
        }
    }

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='logout'){
            $sql="UPDATE karyawan SET terakhir_login=DEFAULT WHERE id_karyawan=$_SESSION[backend_user_id]";
            mysqli_query($koneksi,$sql);
            session_destroy();            
            header('location:../login.php');
        }
        else if(_GET['aksi']=='hapus'){
            $x0=$_GET['id'];
            $sql="delete from karyawan where id_karyawan=$x0";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=karyawan');
        }    
    }
?>