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
	$nama_stasiun = mysql_real_escape_string($_POST['nama_stasiun']);
	$provinsi = mysql_real_escape_string($_POST['provinsi']);
	$daerah_operasi = mysql_real_escape_string($_POST['daerah_operasi']);
	$kode_stasiun = mysql_real_escape_string($_POST['kode_stasiun']);
	
	if($id_stasiun!="" && $nama_stasiun!="" ) {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as jumlah FROM masterstasiun WHERE id_stasiun='$id_stasiun'");
	$data=mysql_fetch_assoc($query);
	$jml_stasiun=$data['jumlah'];
	if($jml_stasiun == 0) {	
	$insert = mysql_query("INSERT INTO masterstasiun VALUES('$id_stasiun','$nama_stasiun','$provinsi','$daerah_operasi','$kode_stasiun')");
    if($insert){
	echo "<script>window.location.assign('masteringstasiun.php')</script>";
	}
	}
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-user" method="post">
	<p align="center"><strong>Tambah Stasiun</strong></p>
	<center>
	<table>
	<?php
	$query = mysql_query("SELECT max(id_stasiun)+1 as maxid FROM masterstasiun");
	$data=mysql_fetch_assoc($query);
	$maxid=$data['maxid'];
	?>
	<tr>
	<td>
	<strong>ID Stasiun
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_stasiun" class="input-medium" name="id_stasiun" value="<?php echo $maxid?>">
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
	<strong>Nama Stasiun
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama_stasiun" class="input-medium" name="nama_stasiun" value="">
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
			<input style="height: 30px" type="text" id="provinsi" class="input-medium" name="provinsi" value="">
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
			<input style="height: 30px" type="text" id="daerah_operasi" class="input-medium" name="daerah_operasi" value="">
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
			<input style="height: 30px" type="text" id="kode_stasiun" class="input-medium" name="kode_stasiun" value="">
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringstasiun.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>