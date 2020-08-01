<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahuser'){
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_role = $_POST['role'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO tb_user VALUES('$id_user' , '$username' , '$password' , '$user_role')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../user/data_user.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updateuser'){
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE tb_user SET username='$username' , password='$password' , user_role='$role' WHERE id_user='$id_user' ");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../user/data_user.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteuser'){
    $id_user = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user = '$id_user'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../user/data_user.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>