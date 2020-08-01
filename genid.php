
<?php
function kode_auto($tabel,$id,$inisial,$index,$panjang)
{
	include("koneksidb.php");
	$sql="select max(".$id.") as max_id from ".$tabel." where $id like '$inisial%'";
	$data=mysqli_query($koneksi,$sql);
	$hasil=mysqli_fetch_array($data);
	$id_max=$hasil['max_id'];
	  if($index=='' && $panjang=='')
  {
  	$no_urut	= (int) $id_max;
  }else{
	$no_urut	= (int) substr($id_max, $index, $panjang);//memotong string
  }
  $no_urut	= $no_urut + 1;
  if($index=='' && $panjang=='')
  {
	  $id_baru  = $no_urut;
  }else{
  	$id_baru	= $inisial . sprintf("%0$panjang"."s", $no_urut);
  }
  return $id_baru;
}


function rupiah_format($duit)
{
$jum=strlen($duit);
$hasil="";
$a=0;
	

for ($i=1; $i<$jum+1; $i++)
{
	$a=$i-1;
	if($mod==3)
	{
		$mod=1;
		$hasil=substr($duit, -$i, -$a).chr(46).$hasil;
		//echo "-a".$hasil;
	}
	else
	{
		if ($a==0)
		{
		$a=-1;
		}
		$hasil=substr($duit, -$i, -$a).$hasil;
		$mod++;
		//echo "-b".$hasil;
	}
}
$hasil="Rp ".$hasil.",-";
return $hasil;
}

?>