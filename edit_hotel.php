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
	if(isset($_POST['nama_hotel']))
	{
	$id_hotel = mysql_real_escape_string($_POST['id_hotel']);
	$id_hotel_asli = mysql_real_escape_string($_POST['id_hotel_asli']);
	$nama_hotel = mysql_real_escape_string($_POST['nama_hotel']);	
	$nama_kota = mysql_real_escape_string($_POST['nama_kota']);
	if($id_hotel!="" && $nama_hotel!="" ) {
		// proses tambah data mahasiswa
		
	$update = mysql_query("UPDATE masterhotel SET 
			id_hotel = '$id_hotel',
			nama_hotel = '$nama_hotel',
			nama_kota = '$nama_kota'
			WHERE id_hotel= '$id_hotel_asli'
			");
    if($update){
	echo "<script>window.location.assign('masteringhotel.php')</script>";
	}
	
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-edituser" method="post">
	<p align="center"><strong>Edit Hotel</strong></p>
				 <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line = $db->queryUniqueObject("SELECT * FROM masterhotel WHERE id_hotel='$id'");
				  }
				  ?>
	<center>
	<table>
	<tr>
	<td>
	<strong>ID Hotel
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_hotel" class="input-medium" name="id_hotel" value="<?php echo $line->id_hotel?>">
			<input style="height: 30px" type="hidden" id="id_hotel_asli" class="input-medium" name="id_hotel_asli" value="<?php echo $line->id_hotel?>">	
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Hotel
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama_hotel" class="input-medium" name="nama_hotel" value="<?php echo $line->nama_hotel?>">
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
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringhotel.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>