<?php
session_start();
if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Administrator'){
include 'base.php'; }
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Sales'){
include 'basesales.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Kasir'){
include 'basekasir.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Finance'){
include 'basefinance.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Warehouse'){
include 'basewarehouse.php';}
?>
<?php startblock('konten') ?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
<?php

$no_po = $_GET['id'];
if (isset( $_GET['id'])){
$no_hutang = $db->queryUniqueValue("select no_hutang from hutang where no_po='".$no_po."' and debit!=0");
$db->execute("UPDATE pembelian set no_invoice='',tgl_invoice='',statusdibayar='',tgl_dibayar='' where no_po='$no_po'");
$db->execute("delete from kas where no_hutang='$no_hutang'");
$db->execute("delete from hutang where no_po='$no_po' AND debit!=0");
echo "<script>window.location.assign('masteringbayarhutangpernopo.php');</script>";
}
echo "<script>window.location.assign('masteringbayarhutangpernopo.php');</script>";
?>
<?php endblock()   ?>
    