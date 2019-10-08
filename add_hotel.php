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
	$nama_hotel = mysql_real_escape_string($_POST['nama_hotel']);	
	$nama_kota = mysql_real_escape_string($_POST['nama_kota']);
	
	if($id_hotel!="" && $nama_hotel!="" ) {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as jumlah FROM masterhotel WHERE id_hotel='$id_hotel'");
	$data=mysql_fetch_assoc($query);
	$jml_hotel=$data['jumlah'];
	if($jml_hotel == 0) {	
	$insert = mysql_query("INSERT INTO masterhotel VALUES('$id_hotel','$nama_hotel','$nama_kota')");
    if($insert){
	echo "<script>window.location.assign('masteringhotel.php')</script>";
	}
	}
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-user" method="post">
	<p align="center"><strong>Tambah Hotel</strong></p>
	<center>
	<table>
	<?php
	$query = mysql_query("SELECT max(id_hotel)+1 as maxid FROM masterhotel");
	$data=mysql_fetch_assoc($query);
	$maxid=$data['maxid'];
	?>
	<tr>
	<td>
	<strong>ID Hotel
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_hotel" class="input-medium" name="id_hotel" value="<?php echo $maxid?>">
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
			<input style="height: 30px" type="text" id="nama_hotel" class="input-medium" name="nama_hotel" value="">
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
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringhotel.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>