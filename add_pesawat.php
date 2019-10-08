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
	if(isset($_POST['kode_maskapai']))
	{
	$id_maskapai = mysql_real_escape_string($_POST['id_maskapai']);
	$kode_maskapai = mysql_real_escape_string($_POST['kode_maskapai']);
	$nama_maskapai = mysql_real_escape_string($_POST['nama_maskapai']);
	$kelas = mysql_real_escape_string($_POST['kelas']);
	if($id_maskapai!="" && $nama_maskapai!="" ) {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as jumlah FROM masterpesawat WHERE id_maskapai='$id_maskapai'");
	$data=mysql_fetch_assoc($query);
	$jml_maskapai=$data['jumlah'];
	if($jml_maskapai == 0) {	
	$insert = mysql_query("INSERT INTO masterpesawat VALUES('$id_maskapai','$kode_maskapai','$nama_maskapai','$kelas')");
    if($insert){
	echo "<script>window.location.assign('masteringpesawat.php')</script>";
	}
	}
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-user" method="post">
	<p align="center"><strong>Tambah Pesawat</strong></p>
	<center>
	<table>
	<?php
	$query = mysql_query("SELECT max(id_maskapai)+1 as maxid FROM masterpesawat");
	$data=mysql_fetch_assoc($query);
	$maxid=$data['maxid'];
	?>
	<tr>
	<td>
	<strong>ID Maskapai
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_maskapai" class="input-medium" name="id_maskapai" value="<?php echo $maxid?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode Maskapai
	</td>
	<td>
			<input style="height: 30px" type="text" id="kode_maskapai" class="input-medium" name="kode_maskapai" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Maskapai
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama_maskapai" class="input-medium" name="nama_maskapai" value="">
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
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringpesawat.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>