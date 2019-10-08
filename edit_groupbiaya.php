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
	if(isset($_POST['kd_beban']))
		{
		$kd_beban = mysql_real_escape_string($_POST['KD_BEBAN']);
		$nm_beban = mysql_real_escape_string($_POST['NM_BEBAN']);
		$kategori = mysql_real_escape_string($_POST['KATEGORI']);
		$update = mysql_query("UPDATE groupbiaya SET 
			kd_beban = '$kd_beban',
			nm_beban = '$nm_beban',
			kategori = '$kategori'
			WHERE kd_beban = '$kd_beban'
			");
        if($update){
		echo "<script>window.location.assign('masteringgroupbiaya.php')</script>";
		}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-groupbiaya" method="post">
	<p align="center"><strong>Tambah Group Biaya</strong></p>
				  <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line = $db->queryUniqueObject("SELECT * FROM groupbiaya WHERE kd_beban='$id'");
				  }
				  ?>	
	<center>
	<table>
	<tr>
	<td>
	<strong>Kode Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_beban" class="input-medium" name="kd_beban" value="<?php echo $line->KD_BEBAN;?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="nm_beban" class="input-medium" name="nm_beban" value="<?php echo $line->NM_BEBAN;?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kategori
	</td>
	<td>
			<input style="height: 30px" type="text" id="kategori" class="input-medium" name="kategori" value="<?php echo $line->KATEGORI;?>">
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringgroupbiaya.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>