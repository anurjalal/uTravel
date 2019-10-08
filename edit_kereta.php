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
	$id_kereta_asli = mysql_real_escape_string($_POST['id_kereta_asli']);
	$kode_kereta = mysql_real_escape_string($_POST['kode_kereta']);	
	$nama_kereta = mysql_real_escape_string($_POST['nama_kereta']);
	$kelas = mysql_real_escape_string($_POST['kelas']);
	if($id_kereta!="" && $nama_kereta!="" ) {
		// proses tambah data mahasiswa
		
	$update = mysql_query("UPDATE masterkereta SET 
			id_kereta = '$id_kereta',
			kode_kereta = '$kode_kereta',
			nama_kereta = '$nama_kereta',
			kelas = '$kelas'
			WHERE id_kereta= '$id_kereta_asli'
			");
    if($update){
	echo "<script>window.location.assign('masteringkereta.php')</script>";
	}
	
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-edituser" method="post">
	<p align="center"><strong>Edit Kereta</strong></p>
				 <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line = $db->queryUniqueObject("SELECT * FROM masterkereta WHERE id_kereta='$id'");
				  }
				  ?>
	<center>
	<table>
	<tr>
	<td>
	<strong>ID Kereta
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_kereta" class="input-medium" name="id_kereta" value="<?php echo $line->id_kereta?>">
			<input style="height: 30px" type="hidden" id="id_kereta_asli" class="input-medium" name="id_kereta_asli" value="<?php echo $line->id_kereta?>">
	
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
			<input style="height: 30px" type="text" id="nama_kereta" class="input-medium" name="nama_kereta" value="<?php echo $line->nama_kereta?>">
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
			<input style="height: 30px" type="text" id="kelas" class="input-medium" name="kelas" value="<?php echo $line->kelas?>">
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
			<input style="height: 30px" type="text" id="kode_kereta" class="input-medium" name="kode_kereta" value="<?php echo $line->kode_kereta?>">
	</td>
	</tr>	
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringkereta.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>