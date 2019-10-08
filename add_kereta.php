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
	if(isset($_POST['nama_kereta']))
	{
	$id_kereta = mysql_real_escape_string($_POST['id_kereta']);
	$kode_kereta = mysql_real_escape_string($_POST['kode_kereta']);	
	$nama_kereta = mysql_real_escape_string($_POST['nama_kereta']);
	$kelas = mysql_real_escape_string($_POST['kelas']);
	
	if($id_kereta!="" && $nama_kereta!="" ) {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as jumlah FROM masterkereta WHERE id_kereta='$id_kereta'");
	$data=mysql_fetch_assoc($query);
	$jml_kereta=$data['jumlah'];
	if($jml_kereta == 0) {	
	$insert = mysql_query("INSERT INTO masterkereta VALUES('$id_kereta','$kode_kereta','$nama_kereta','$kelas')");
    if($insert){
	echo "<script>window.location.assign('masteringkereta.php')</script>";
	}
	}
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-user" method="post">
	<p align="center"><strong>Tambah Kereta</strong></p>
	<center>
	<table>
	<?php
	$query = mysql_query("SELECT max(id_kereta)+1 as maxid FROM masterkereta");
	$data=mysql_fetch_assoc($query);
	$maxid=$data['maxid'];
	?>
	<tr>
	<td>
	<strong>ID Kereta
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_kereta" class="input-medium" name="id_kereta" value="<?php echo $maxid?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Kereta
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama_kereta" class="input-medium" name="nama_kereta" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kelas
	</td>
	<td>
			<input style="height: 30px" type="text" id="kelas" class="input-medium" name="kelas" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode Kereta
	</td>
	<td>
			<input style="height: 30px" type="text" id="kode_kereta" class="input-medium" name="kode_kereta" value="">
	</td>
	</tr>	
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringkereta.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>