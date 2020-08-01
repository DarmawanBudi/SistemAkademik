<script language='javascript'>
function showIn()
{
<?php
include '../koneksidb.php';

$query = "SELECT * FROM program ORDER BY id_program ASC";
$hasil = mysqli_query($koneksi,$query);
while ($data = mysqli_fetch_array($hasil))
{
$prog = $data['id_program'];
echo "if (document.form_tambah.id_program.value == \"".$prog."\")"; // fungsi \ untuk memghilangkan (spasi)
echo "{";
$query2 = "SELECT * FROM instruktur WHERE id_program LIKE '%".$prog."%' ORDER BY id_instruktur ASC";
$hasil2 = mysqli_query($koneksi,$query2);
$content = "document.getElementById('ins').innerHTML = \"";
while ($data2 = mysqli_fetch_array($hasil2))
{
$content .= "<option value='".$data2['id_instruktur']."'>".$data2['username']."</option>";
}
$content .= "\"";
echo $content;
echo "}\n";
}
?>
}
</script>