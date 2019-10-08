<?php
include "dbwilayah.php";

$line = $db->queryUniqueObject("SELECT * from hrgbeliaksesoris h WHERE h.deskripsi='".$_POST['deskripsi']."' and h.motor='".$_POST['motor']."'");
$hrg_beli=$line->HRG_BELI;

if($line!=NULL)
{

$arr = array ("hrg_beli"=>"$hrg_beli");
echo json_encode($arr);

}
else
{
$arr1 = array ("no"=>"no");
echo json_encode($arr1);

}
?>