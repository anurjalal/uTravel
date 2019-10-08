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
<?php
	if(isset($_POST['kd_beban']))
		{
		$kd_beban = mysql_real_escape_string($_POST['KD_BEBAN']);
		$nm_beban = mysql_real_escape_string($_POST['NM_BEBAN']);
		$kategori = mysql_real_escape_string($_POST['KATEGORI']);
		$insert = mysql_query("INSERT INTO groupbiaya VALUES('$kd_beban','$nm_beban','$kategori')");
        if($insert){
		echo "<script>window.location.assign('masteringgroupbiaya.php')</script>";
		}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-groupbiaya" method="post">
	<p align="center"><strong>Tambah Group Biaya</strong></p>
	<center>
	<table>
	<tr>
	<td>
	<strong>Kode Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_beban" class="input-medium" name="kd_beban" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="nm_beban" class="input-medium" name="nm_beban" value="">
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
			<input style="height: 30px" type="text" id="kategori" class="input-medium" name="kategori" value="">
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringgroupbiaya.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>