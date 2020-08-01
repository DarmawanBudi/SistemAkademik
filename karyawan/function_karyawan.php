<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahkaryawan'){
    $id_karyawan = $_POST['id_karyawan'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $kelamin = $_POST['kelamin'];
    $hp = $_POST['hp'];
    $id_role = $_POST['id_role'];
    $folder = "../aset/img/";
    $namafile = $id_karyawan.".jpg";
    $tap = $_FILES['foto']['tmp_name'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO karyawan VALUES('$id_karyawan' , '$username' , '$password' , '$nama' , '$email' , '$kelamin' , '$hp' , '$id_role')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        if(move_uploaded_file($tap,$folder.$namafile))
        {
            header("location:../karyawan/data_karyawan.php");
        }
        else
        {
            echo "foto gagal di upload";
        }
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act'] == 'updatekaryawan'){
    $id_karyawan = $_POST['id_karyawan'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $kelamin = $_POST['kelamin'];
    $hp = $_POST['hp'];
    $id_role = $_POST['id_role'];
    $folder = "../aset/img/";
    $namafile = $id_karyawan.".jpg";
    $tap = $_FILES['foto']['tmp_name'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE karyawan SET username='$username', password='$password',  nama='$nama', email='$email', kelamin='$kelamin', hp='$hp', id_role='$id_role' WHERE id_karyawan='$id_karyawan'");

    if ($queryupdate) {
        if(move_uploaded_file($tap,$folder.$namafile))
        {
            header("location:../karyawan/data_karyawan.php");
        }
        else
        {
            echo "foto gagal di upload";
        }
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deletekaryawan'){
    $id_karyawan = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM karyawan WHERE id_karyawan = '$id_karyawan'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../karyawan/data_karyawan.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>