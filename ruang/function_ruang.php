<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahruang'){
    $id_ruang = $_POST['id_ruang'];
    $ruang = $_POST['ruang'];
    
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO ruang VALUES('$id_ruang' , '$ruang')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../ruang/data_ruang.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act'] == 'updateruang'){
    $id_ruang = $_POST['id_ruang'];
    $ruang = $_POST['ruang'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE ruang SET ruang='$ruang' WHERE id_ruang='$id_ruang'");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../ruang/data_ruang.php");
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteruang'){
    $id_ruang = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM ruang WHERE id_ruang = '$id_ruang'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../ruang/data_ruang.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>