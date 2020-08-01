<?php
session_start();
$nama="Susilo";
$_SESSION['asal']="Yogyakarta";
echo "namanya adalah $nama <br>";
echo "<a href='tujuan.php'>Kirim</a>";
?>