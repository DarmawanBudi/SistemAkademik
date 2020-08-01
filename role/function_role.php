<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahrole'){
    $id_role = $_POST['id_role'];
    $role = $_POST['role'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO role VALUES('$id_role' , '$role')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../role/data_role.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updaterole'){
    $id_role = $_POST['id_role'];
    $role = $_POST['role'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE role SET role='$role' WHERE id_role='$id_role' ");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../role/data_role.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleterole'){
    $id_role = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM role WHERE id_role = '$id_role'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../role/data_role.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>