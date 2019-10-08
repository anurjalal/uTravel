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
	if(isset($_POST['kode']))
	{
	$id_bandara = mysql_real_escape_string($_POST['id_bandara']);
	$id_bandara_asli = mysql_real_escape_string($_POST['id_bandara_asli']);
	$kode = mysql_real_escape_string($_POST['kode']);
	$nama = mysql_real_escape_string($_POST['nama']);
	$kode_kota = mysql_real_escape_string($_POST['kode_kota']);
	$nama_kota = mysql_real_escape_string($_POST['nama_kota']);
	$nama_negara = mysql_real_escape_string($_POST['nama_negara']);
	$kode_negara = mysql_real_escape_string($_POST['kode_negara']);
	$timezone = mysql_real_escape_string($_POST['timezone']);
	$lat = mysql_real_escape_string($_POST['lat']);
	$lon = mysql_real_escape_string($_POST['lon']);
	$jumlah_bandara = mysql_real_escape_string($_POST['jumlah_bandara']);
	if($id_bandara!="" && $kode!="" ) {
		// proses tambah data mahasiswa
		
	$update = mysql_query("UPDATE masterbandara SET 
			id_bandara = '$id_bandara',
			kode = '$kode',
			nama = '$nama',
			kode_kota = '$kode_kota',
			nama_kota = '$nama_kota',
			nama_negara = '$nama_negara',
			kode_negara = '$kode_negara',
			timezone = '$timezone',
			lat = '$lat',
			lon = '$lon',
			jumlah_bandara = '$jumlah_bandara'
			WHERE id_bandara= '$id_bandara_asli'
			");
    if($update){
	echo "<script>window.location.assign('masteringbandara.php')</script>";
	}
	
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-edituser" method="post">
	<p align="center"><strong>Edit Bandara</strong></p>
				 <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line = $db->queryUniqueObject("SELECT * FROM masterbandara WHERE id_bandara='$id'");
				  }
				  ?>
	<center>
	<table>
	<tr>
	<td>
	<strong>ID Bandara
	</td>
	<td>
			<input style="height: 30px" type="hidden" id="id_bandara_asli" class="input-medium" name="id_bandara_asli" value="<?php echo $line->id_bandara?>">	
			<input style="height: 30px" type="text" id="id_bandara" class="input-medium" name="id_bandara" value="<?php echo $line->id_bandara?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode
	</td>
	<td>
			<input style="height: 30px" type="text" id="kode" class="input-medium" name="kode" value="<?php echo $line->kode?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama" class="input-medium" name="nama" value="<?php echo $line->nama?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode Kota
	</td>
	<td>
			<input style="height: 30px" type="text" id="kode_kota" class="input-medium" name="kode_kota" value="<?php echo $line->kode_kota?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Kota
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama_kota" class="input-medium" name="nama_kota" value="<?php echo $line->nama_kota?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Negara
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama_negara" class="input-medium" name="nama_negara" value="<?php echo $line->nama_negara?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode Negara
	</td>
	<td>
			<input style="height: 30px" type="text" id="kode_negara" class="input-medium" name="kode_negara" value="<?php echo $line->kode_negara?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Timezone
	</td>
	<td>
			<input style="height: 30px" type="text" id="timezone" class="input-medium" name="timezone" value="<?php echo $line->timezone?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Latitude
	</td>
	<td>
			<input style="height: 30px" type="text" id="lat" class="input-medium" name="lat" value="<?php echo $line->lat?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Longitude
	</td>
	<td>
			<input style="height: 30px" type="text" id="lon" class="input-medium" name="lon" value="<?php echo $line->lon?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Jumlah Bandara
	</td>
	<td>
			<input style="height: 30px" type="text" id="jumlah_bandara" class="input-medium" name="jumlah_bandara" value="<?php echo $line->jumlah_bandara?>">
	</td>
	</tr>	
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringbandara.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>