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
	$id_maskapai_asli = mysql_real_escape_string($_POST['id_maskapai_asli']);
	$kode_maskapai = mysql_real_escape_string($_POST['kode_maskapai']);
	$nama_maskapai = mysql_real_escape_string($_POST['nama_maskapai']);
	$kelas = mysql_real_escape_string($_POST['kelas']);
	if($id_maskapai!="" && $kode_maskapai!="") {
		// proses tambah data mahasiswa
		
	$update = mysql_query("UPDATE masterpesawat SET 
			id_maskapai = '$id_maskapai',
			kode_maskapai = '$kode_maskapai',
			nama_maskapai = '$nama_maskapai',
			kelas = '$kelas'
			WHERE id_maskapai= '$id_maskapai_asli'
			");
    if($update){
	echo "<script>window.location.assign('masteringpesawat.php')</script>";
	}
	
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-edituser" method="post">
	<p align="center"><strong>Edit User</strong></p>
				 <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line = $db->queryUniqueObject("SELECT * FROM masterpesawat WHERE id_maskapai='$id'");
				  }
				  ?>
	<center>
	<table>
	<tr>
	<td>
	<strong>ID Maskapai
	</td>
	<td>
			<input style="height: 30px" type="hidden" id="id_maskapai_asli" class="input-medium" name="id_maskapai_asli" value="<?php echo $line->id_maskapai ?>">	
			<input style="height: 30px" type="text" id="id_maskapai" class="input-medium" name="id_maskapai" value="<?php echo $line->id_maskapai ?>">
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
			<input style="height: 30px" type="text" id="kode_maskapai" class="input-medium" name="kode_maskapai" value="<?php echo $line->kode_maskapai ?>">
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
			<input style="height: 30px" type="text" id="nama_maskapai" class="input-medium" name="nama_maskapai" value="<?php echo $line->nama_maskapai ?>">
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
			<input style="height: 30px" type="text" id="kelas" class="input-medium" name="kelas" value="<?php echo $line->kelas ?>">
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringpesawat.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>