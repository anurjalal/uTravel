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
if (isset($_GET['id'])){
$no_penjualan = $_GET['id'];
$no_piutang = $db->queryUniqueValue("select no_piutang from piutang where no_penjualan='".$no_penjualan."' and kredit!=0");	
$db->execute("UPDATE penjualan set no_invoice='',tgl_invoice='',statusdibayar='',tgl_dibayar='' where no_penjualan='$no_penjualan'");
$db->execute("delete from kas where no_piutang='$no_piutang'");
$db->execute("delete from piutang where no_penjualan='$no_penjualan' AND kredit!=0");
echo "<script>window.location.assign('masteringterimapiutangpernopenjualan.php');</script>";
}
echo "<script>window.location.assign('masteringterimapiutangpernopenjualan.php');</script>";
?>
<?php endblock()   ?>
    