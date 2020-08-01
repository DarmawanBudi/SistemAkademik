<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahsiswa'){
    $nis = $_POST['nis'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jenis = $_POST['jenis'];
    $tempat = $_POST['tempat'];
    $lahir = $_POST['lahir'];
    $agama = $_POST['agama'];
    $hp = $_POST['hp'];
    $status_sekolah = $_POST['status_sekolah'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $kerja = $_POST['kerja'];
    $status = "Daftar";
    $id_program = $_POST['id_program'];
    $folder = "../aset/img/";
    $namafile = $nis.".jpg";                    //$nis. fungsi . untuk menghubungkan
    $tap = $_FILES['foto']['tmp_name'];         //tmp_name untuk mengupload bentuk fisik dari foto

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO siswa VALUES('$nis' , '$username' , '$password' , '$nama' , '$email' , '$jenis' , '$tempat' , '$lahir' , '$agama' , '$hp' , '$status_sekolah' , '$asal_sekolah' , '$kerja' , '$status' , '$id_program')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        if(move_uploaded_file($tap,$folder.$namafile))
        {
            header("location:../siswa/data_siswa.php");
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
elseif($_GET['act'] == 'updatesiswa'){
    $nis = $_POST['nis'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jenis = $_POST['jenis'];
    $tempat = $_POST['tempat'];
    $lahir = $_POST['lahir'];
    $agama = $_POST['agama'];
    $hp = $_POST['hp'];
    $status_sekolah = $_POST['status_sekolah'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $kerja = $_POST['kerja'];
    $status = "Daftar";
    $prog = $_POST['id_program'];
    $folder = "../aset/img/";
    $namafile = $nis.".jpg";                //$nis. fungsi . untuk menghubungkan
    $tap = $_FILES['foto']['tmp_name'];     //tmp_name untuk mengupload bentuk fisik dari foto

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE siswa SET username='$username', password='$password',  nama='$nama', email='$email', jenis='$jenis', tempat='$tempat', lahir='$lahir', agama='$agama', hp='$hp', status_sekolah='$status_sekolah', asal_sekolah='$asal_sekolah', kerja='$kerja', status='$status', prog='$prog' WHERE nis='$nis'");

    if ($queryupdate) {
        # credirect ke page index
        
        if(!empty($tap)){
            move_uploaded_file($tap,$folder.$namafile);
        }
        header("location:../siswa/data_siswa.php");
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deletesiswa'){
    $nis = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM siswa WHERE nis = '$nis'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../siswa/data_siswa.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
elseif($_GET['act'] == 'bayarsiswa'){
    $nota = $_POST['nota'];
    $nis = $_POST['nis'];
    $nominal = $_POST['nominal'];
    $tanggal = date('Y-m-d');
    $keterangan = $_POST['keterangan'];

    //query bayar
    $querybayar = mysqli_query($koneksi, "INSERT INTO pembayaran VALUE ('$nota','$nis','$nominal','$tanggal','$keterangan')");

    if ($querybayar) {
        header("location:../siswa/data_siswa.php");
    }
}
?>