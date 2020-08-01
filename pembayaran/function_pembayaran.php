<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahpembayaran'){
    $nota = $_POST['nota'];
    $nis = $_POST['nis'];
    $nominal = $_POST['nominal'];
    $tanggal = date('Y-m-d');
    
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO pembayaran VALUES('$nota' , '$nis' , '$nominal' , '$tanggal')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../pembayaran/data_pembayaran.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act'] == 'updatepembayaran'){
    $nota = $_POST['nota'];
    $id_siswa = $_POST['id_siswa'];
    $nominal = $_POST['nominal'];
    $tanggal = $_POST['tanggal'];
    
    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE pembayaran SET nota='$nota', id_siswa='$id_siswa', nominal='$nominal', tanggal='$tanggal' WHERE nota='$nota'");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../pembayaran/data_pembayaran.php");
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deletepembayaran'){
    $nota = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM pembayaran WHERE nota = '$nota'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../pembayaran/data_pembayaran.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>