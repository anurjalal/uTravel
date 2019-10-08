<?php
include "dbcustomer.php";

$line = $db->queryUniqueObject("SELECT * FROM groupbiaya WHERE nm_beban ='".$_POST['nm_beban']."'");
$kd_beban=$line->KD_BEBAN;

if($line!=NULL)
{

$arr = array ("kd_beban"=>"$kd_beban");
echo json_encode($arr);

}
else
{
$arr1 = array ("no"=>"no");
echo json_encode($arr1);

}
?>