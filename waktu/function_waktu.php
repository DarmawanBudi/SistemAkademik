<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahwaktu'){
    $id_waktu = $_POST['id_waktu'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];
    
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO waktu VALUES('$id_waktu' , '$mulai' , '$selesai')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../waktu/data_waktu.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act'] == 'updatewaktu'){
    $id_waktu = $_POST['id_waktu'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];
    
    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE waktu SET mulai='$mulai', selesai='$selesai' WHERE id_waktu='$id_waktu'");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../waktu/data_waktu.php");
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deletewaktu'){
    $id_waktu = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM waktu WHERE id_waktu = '$id_waktu'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../waktu/data_waktu.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>