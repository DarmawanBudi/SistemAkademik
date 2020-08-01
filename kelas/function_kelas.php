<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahkelas'){
    $id_kelas = $_POST['id_kelas'];
    $id_program = $_POST['id_program'];
    $id_waktu = $_POST['id_waktu'];
    $id_ruang = $_POST['id_ruang'];
    $id_instruktur = $_POST['id_instruktur'];
    $keterangan_kelas = $_POST['keterangan_kelas'];
    $tanggal = $_POST['tanggal'];
    
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO kelas VALUES('$id_kelas' , '$id_program' , '$id_waktu' , '$id_ruang' , '$id_instruktur' , '$keterangan_kelas' , '$tanggal')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:../kelas/data_kelas.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act'] == 'updatekelas'){
    $id_kelas = $_POST['id_kelas'];
    $id_waktu = $_POST['id_waktu'];
    $id_ruang = $_POST['id_ruang'];
    $id_instruktur = $_POST['id_instruktur'];
    $keterangan_kelas = $_POST['keterangan_kelas'];
    $tanggal = $_POST['tanggal'];
    
    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE kelas SET id_waktu='$id_waktu',  id_ruang='$id_ruang', id_instruktur='$id_instruktur', keterangan_kelas='$keterangan_kelas', tanggal='$tanggal' WHERE id_kelas='$id_kelas'");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../kelas/data_kelas.php");
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deletekelas'){
    $id_kelas = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas = '$id_kelas'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../kelas/data_kelas.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
// elseif($_GET['act'] == 'gabungkelas'){
//     $id_kelas = $_POST['id_kelas'];
//     $siswa = $_POST['siswa'];

//     if (isset($siswa)) {
//         for ($i=0; $i < count($siswa) ; $i++){
//             $querygabung =  mysqli_query($koneksi, "INSERT INTO detail_kelas (id_kelas,nis) VALUES('$id_kelas' , '$siswa[$i]')");
//         }
//     }
//     //query update
    

//     if ($querygabung) {
//         # credirect ke page index
//         header("location:../kelas/data_kelas.php");
//     }
//     else{
//         echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
//     }
// }
elseif($_GET['act']== 'gabungkelas'){
    $id_kelas = $_POST['id_kelas'];
    $nis = $_POST['nis'];
    
    if (isset($nis)) {
        for ($i=0; $i < count($nis) ; $i++) { 
            $querygabung = mysqli_query($koneksi, "INSERT INTO detail_kelas (id_kelas,nis) VALUE ('$id_kelas','$nis[$i]')"); 
            $querydaftar = mysqli_query($koneksi, "UPDATE siswa SET status = 'Active' WHERE nis = '$nis[$i]' ");
        }
    }


    if ($querygabung) {
        # redirect ke index.php
        header("location:../kelas/data_kelas.php");
    }
    else{
        echo "ERROR, data gagal diinput ". mysqli_error($koneksi);
    }

}
?>