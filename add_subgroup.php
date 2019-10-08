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
function getKodeGabungan()
{
var kdbeban = $('#kd_beban').val();
var kdsubbeban = $('#kd_subbeban').val();
$('#kd_gabungan').val(kdbeban+"."+kdsubbeban);
}
</script>	
<?php
	if(isset($_POST['kd_beban']))
		{
			$kd_gabungan=mysql_real_escape_string($_POST['kd_gabungan']);
			$kd_beban=mysql_real_escape_string($_POST['kd_beban']);
			$kd_subbeban=mysql_real_escape_string($_POST['kd_subbeban']);
			$nm_subbeban=mysql_real_escape_string($_POST['nm_subbeban']);
			$kategori=mysql_real_escape_string($_POST['kategori']);
			$insert = $db->query("INSERT INTO subgroupbiaya(kd_gabungan,kd_beban,kd_subbeban,nm_subbeban,kategori) values('$kd_gabungan','$kd_beban','$kd_subbeban','$nm_subbeban','$kategori')");
            if($insert){
			echo "<script>window.location.assign('mastersubgroup.php')</script>";
			}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-subgroup" method="post">
	<p align="center"><strong>Tambah Sub Group Accounting</strong></p>
	<center>
	<table>
	<tr>
	<td>
	<strong>Kode Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_beban" class="input-medium" name="kd_beban" value="" onKeyUp="getKodeGabungan()">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode Sub Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_subbeban" class="input-large" name="kd_subbeban" value="" onKeyUp="getKodeGabungan()">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode Gabungan
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_gabungan" class="input-medium" name="kd_gabungan" value="" readonly="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Sub Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="nm_subbeban" class="input-medium" name="nm_subbeban" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kategori
	</td>
	<td>
			<input style="height: 30px" type="text" id="kategori" class="input-large" name="kategori" value="">
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("mastersubgroup.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.min.js"></script>
<script>
$(document).ready(function(){
	$("#kd_beban").autocomplete("kodebeban.php", {
        selectFirst: true});			
			});
</script>