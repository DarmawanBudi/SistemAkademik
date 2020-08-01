<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahprogram'){
    $id_program = $_POST['id_program'];
    $nama_program = $_POST['nama_program'];
    $keterangan = $_POST['keterangan'];
    $sesi = $_POST['sesi'];
    $biaya = $_POST['biaya'];
    
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO program VALUES('$id_program' , '$nama_program' , '$keterangan' , '$sesi' , '$biaya')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../program/data_program.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act'] == 'updateprogram'){
    $id_program = $_POST['id_program'];
    $nama_program = $_POST['nama_program'];
    $keterangan = $_POST['keterangan'];
    $sesi = $_POST['sesi'];
    $biaya = $_POST['biaya'];
    
    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE program SET nama_program='$nama_program', keterangan='$keterangan',  sesi='$sesi', biaya='$biaya' WHERE id_program='$id_program'");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../program/data_program.php");
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteprogram'){
    $id_program = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM program WHERE id_program = '$id_program'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../program/data_program.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>