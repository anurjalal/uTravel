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
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
function getKodeGabungan()
{
var kdbeban = $('#kd_beban').val();
var kdsubbeban = $('#kd_subbeban').val();
$('#kd_gabungan').val(kdbeban+"."+kdsubbeban);
}
</script>
<?php
	if(isset($_POST['kd_beban']))
		{
			$id = $_GET['id'];
			$kd_gabungan=mysql_real_escape_string($_POST['kd_gabungan']);
			$kd_beban=mysql_real_escape_string($_POST['kd_beban']);
			$kd_subbeban=mysql_real_escape_string($_POST['kd_subbeban']);
			$nm_subbeban=mysql_real_escape_string($_POST['nm_subbeban']);
			$kategori=mysql_real_escape_string($_POST['kategori']);
			$update = $db->query("UPDATE subgroupbiaya set kd_gabungan='$kd_gabungan',kd_beban='$kd_beban',kd_subbeban='$kd_subbeban',nm_subbeban='$nm_subbeban',kategori='$kategori' where kd_gabungan='$id'");
            if($update){
			echo "<script>window.location.assign('mastersubgroup.php')</script>";
			}
		}
?>
<style type="text/css">
  label{margin-left: 150px}
</style>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-editsubgroupbiaya" method="post">
	<p align="center"><strong>Edit Sub Group Accounting</strong></p>
				  <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line = $db->queryUniqueObject("SELECT * FROM subgroupbiaya WHERE kd_gabungan='$id'");
				  }
				  ?>
	<center>
	<table>
	<tr>
	<td>
	<strong>Kode Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_beban" class="input-medium" name="kd_beban" value="<?php echo $line->KD_BEBAN;?>" onKeyUp="getKodeGabungan()">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode Sub Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_subbeban" class="input-large" name="kd_subbeban" value="<?php echo $line->KD_SUBBEBAN;?>" onKeyUp="getKodeGabungan()">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Kode Gabungan
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_gabungan" class="input-medium" name="kd_gabungan" value="<?php echo $line->KD_GABUNGAN;?>" readonly="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Sub Beban
	</td>
	<td>
			<input style="height: 30px" type="text" id="nm_subbeban" class="input-medium" name="nm_subbeban" value="<?php echo $line->NM_SUBBEBAN;?>">
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
			<input style="height: 30px" type="text" id="kategori" class="input-large" name="kategori" value="<?php echo $line->KATEGORI;?>">
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("mastersubgroup.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.min.js"></script>
<script>
$(document).ready(function(){
	$("#kd_beban").autocomplete("kodebeban.php", {
        selectFirst: true});			
			});
</script>