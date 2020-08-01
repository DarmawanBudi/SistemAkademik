<?php
include '../koneksidb.php';

if($_GET['act']== 'tambahinstruktur'){
    $id_instruktur = $_POST['id_instruktur'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $kelamin = $_POST['kelamin'];
    $hp = $_POST['hp'];
    $id_program = $_POST['id_program'];
    $folder = "../aset/img/";
    $namafile = $id_instruktur.".jpg";
    $tap = $_FILES['foto']['tmp_name'];

    $id = '';

    if(!empty($_POST["id_prog"])){

     foreach($_POST["id_prog"] as $program){

      $id .= $program . ' ';

     }
    }

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO instruktur VALUES('$id_instruktur' , '$username' , '$password' , '$nama' , '$email' , '$kelamin' , '$hp' , '$id')");

    if ($querytambah) {
        # credirect ke page index
        
        if(!empty($tap)){
            move_uploaded_file($tap,$folder.$namafile);
        }
        header("location:../instruktur/data_instruktur.php");
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif($_GET['act'] == 'updateinstruktur'){
    $id_instruktur = $_POST['id_instruktur'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $kelamin = $_POST['kelamin'];
    $hp = $_POST['hp'];
    $id_program = $_POST['id_program'];
    $folder = "../aset/img/";
    $namafile = $id_instruktur.".jpg";
    $tap = $_FILES['foto']['tmp_name'];
    $id = '';

    if(!empty($_POST["id_prog"])){

     foreach($_POST["id_prog"] as $program){

      $id .= $program . ' ';

     }
    }

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE instruktur SET username='$username', password='$password',  nama='$nama', email='$email', kelamin='$kelamin', hp='$hp', id_program='$id' WHERE id_instruktur='$id_instruktur'");

    if ($queryupdate) {
        # credirect ke page index
        
        if(!empty($tap)){
            move_uploaded_file($tap,$folder.$namafile);
        }
        header("location:../instruktur/data_instruktur.php");
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteinstruktur'){
    $id_instruktur = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM instruktur WHERE id_instruktur = '$id_instruktur'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../instruktur/data_instruktur.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>