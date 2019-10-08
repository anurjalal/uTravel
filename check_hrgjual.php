<?php
include "dbkoneksi2.php";

$line = $db->queryUniqueObject("SELECT hrg_jual,hrg_jual_mk from hrgjual where nama_barang='".$_POST['nama_barang']."' and tgl_akhir>=now() and tgl_awal<=now() order by tgl_awal desc");
if ($line)
{
$hrg_jual=$line->hrg_jual;
$hrg_jual_mk=$line->hrg_jual_mk;
}

if($line!=NULL)
{

$arr = array ("hrg_jual"=>"$hrg_jual","hrg_jual_mk"=>"$hrg_jual_mk");
echo json_encode($arr);

}
else
{
$arr1 = array ("hrg_jual"=>"0","hrg_jual_mk"=>"0");
echo json_encode($arr1);

}
?>
