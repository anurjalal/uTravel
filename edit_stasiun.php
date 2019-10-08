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
	if(isset($_POST['nama_stasiun']))
	{
	$id_stasiun = mysql_real_escape_string($_POST['id_stasiun']);
	$id_stasiun_asli = mysql_real_escape_string($_POST['id_stasiun_asli']);
	$nama_stasiun = mysql_real_escape_string($_POST['nama_stasiun']);
	$provinsi = mysql_real_escape_string($_POST['provinsi']);
	$daerah_operasi = mysql_real_escape_string($_POST['daerah_operasi']);
	$kode_stasiun = mysql_real_escape_string($_POST['kode_stasiun']);
	if($id_stasiun!="" && $nama_stasiun!="" ) {
		// proses tambah data mahasiswa
		
	$update = mysql_query("UPDATE masterstasiun SET 
			id_stasiun = '$id_stasiun',
			nama_stasiun = '$nama_stasiun',
			provinsi = '$provinsi',
			daerah_operasi = '$daerah_operasi',
			kode_stasiun = '$kode_stasiun'
			WHERE id_stasiun= '$id_stasiun_asli'
			");
    if($update){
	echo "<script>window.location.assign('masteringstasiun.php')</script>";
	}
	
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-edituser" method="post">
	<p align="center"><strong>Edit Stasiun</strong></p>
				 <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line = $db->queryUniqueObject("SELECT * FROM masterstasiun WHERE id_stasiun='$id'");
				  }
				  ?>
	<center>
	<table>
	<tr>
	<td>
	<strong>ID Stasiun
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_stasiun" class="input-medium" name="id_stasiun" value="<?php echo $line->id_stasiun?>">
			<input style="height: 30px" type="hidden" id="id_stasiun_asli" class="input-medium" name="id_stasiun_asli" value="<?php echo $line->id_stasiun?>">
	
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Stasiun
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama_stasiun" class="input-medium" name="nama_stasiun" value="<?php echo $line->nama_stasiun?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Provinsi
	</td>
	<td>
			<input style="height: 30px" type="text" id="provinsi" class="input-medium" name="provinsi" value="<?php echo $line->provinsi?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Daerah Operasi
	</td>
	<td>
			<input style="height: 30px" type="text" id="daerah_operasi" class="input-medium" name="daerah_operasi" value="<?php echo $line->daerah_operasi?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode Stasiun
	</td>
	<td>
			<input style="height: 30px" type="text" id="kode_stasiun" class="input-medium" name="kode_stasiun" value="<?php echo $line->kode_stasiun?>">
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringstasiun.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>