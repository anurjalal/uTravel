<?php
include "dbkoneksi2.php";

$line = $db->queryUniqueObject("SELECT kode_barang,tipe,merk,hrg_beli from hrgbeli where nama_barang='".$_POST['nama_barang']."' and tgl_akhir>=now() and tgl_awal<=now() order by tgl_awal desc");
$line2 = $db->queryUniqueObject("SELECT (sum(debit)-sum(kredit))/sum(jumlah) as hrg_rata from persediaan where nama_barang='".$_POST['nama_barang']."'");

if ($line)
{
$kode_barang = $line->kode_barang;
$tipe = $line->tipe;
$merk = $line->merk;
$hrg_beli=$line2->hrg_rata;
}

if($line!=NULL)
{

$arr = array ("kode_barang"=>"$kode_barang","tipe"=>"$tipe","merk"=>"$merk","hrg_beli"=>"$hrg_beli");
echo json_encode($arr);

}
else
{
$arr1 = array ("kode_barang"=>"","tipe"=>"","merk"=>"","hrg_beli"=>"0");
echo json_encode($arr1);

}
?>
