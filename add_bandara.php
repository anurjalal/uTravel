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
	$query = mysql_query("SELECT count(*) as jumlah FROM masterbandara WHERE id_bandara='$id_bandara'");
	$data=mysql_fetch_assoc($query);
	$jml_bandara=$data['jumlah'];
	if($jml_bandara == 0) {	
	$insert = mysql_query("INSERT INTO masterbandara VALUES('$id_bandara','$kode','$nama','$kode_kota','$nama_kota','$nama_negara','$kode_negara','$timezone','$lat','$lon','$jumlah_bandara')");
    if($insert){
	echo "<script>window.location.assign('masteringbandara.php')</script>";
	}
	}
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-user" method="post">
	<p align="center"><strong>Tambah Bandara</strong></p>
	<center>
	<table>
	<?php
	$query = mysql_query("SELECT max(id_bandara)+1 as maxid FROM masterbandara");
	$data=mysql_fetch_assoc($query);
	$maxid=$data['maxid'];
	?>
	<tr>
	<td>
	<strong>ID Bandara
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_bandara" class="input-medium" name="id_bandara" value="<?php echo $maxid?>">
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
			<input style="height: 30px" type="text" id="kode" class="input-medium" name="kode" value="">
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
			<input style="height: 30px" type="text" id="nama" class="input-medium" name="nama" value="">
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
			<input style="height: 30px" type="text" id="kode_kota" class="input-medium" name="kode_kota" value="">
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
			<input style="height: 30px" type="text" id="nama_kota" class="input-medium" name="nama_kota" value="">
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
			<input style="height: 30px" type="text" id="nama_negara" class="input-medium" name="nama_negara" value="">
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
			<input style="height: 30px" type="text" id="kode_negara" class="input-medium" name="kode_negara" value="">
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
			<input style="height: 30px" type="text" id="timezone" class="input-medium" name="timezone" value="">
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
			<input style="height: 30px" type="text" id="lat" class="input-medium" name="lat" value="">
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
			<input style="height: 30px" type="text" id="lon" class="input-medium" name="lon" value="">
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
			<input style="height: 30px" type="text" id="jumlah_bandara" class="input-medium" name="jumlah_bandara" value="">
	</td>
	</tr>	
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringbandara.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>