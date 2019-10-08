<?php
include "dbkoneksi2.php";

$line = $db->queryUniqueObject("SELECT hargabeli from hrgbeli where tipe_produk='".$_POST['tipe']."' and nama_supplier='".$_POST['nama_supplier']."' and tgl_akhir>=now() and tgl_awal<=now() order by tgl_awal desc");
//$line2 = $db->queryUniqueObject("SELECT hargajual from hrgjual where tipe_produk='".$_POST['tipe']."' and tgl_akhir>=now() and tgl_awal<=now() order by tgl_awal desc");

if ($line)
{
$hargabeli=$line->hargabeli;
}

if($line!=NULL)
{

$arr = array ("hargabeli"=>"$hargabeli");
echo json_encode($arr);

}

else
{
$arr1 = array ("hargabeli"=>"0");
echo json_encode($arr1);

}
?>
