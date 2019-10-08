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
	if(isset($_POST['nama_supplier']))
		{
	$id_supplier = mysql_real_escape_string($_POST['id_supplier']);
	$nama_supplier = mysql_real_escape_string($_POST['nama_supplier']);
	$almt_supplier = mysql_real_escape_string($_POST['almt_supplier']);
	$telp_supplier = mysql_real_escape_string($_POST['telp_supplier']);
	$fax_supplier = mysql_real_escape_string($_POST['fax_supplier']);
	$kota_supplier = mysql_real_escape_string($_POST['kota_supplier']);
	$cp_supplier = mysql_real_escape_string($_POST['cp_supplier']);
	$status = mysql_real_escape_string($_POST['status']);

	// validasi agar tidak ada data yang kosong
	if($id_supplier!="" && $nama_supplier!="") {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as id_supplier FROM supplier WHERE id_supplier='$id_supplier'");
	$data=mysql_fetch_assoc($query);
	$jml_sup=$data['id_supplier'];
		if($jml_sup == 1) {
            $update = mysql_query("UPDATE supplier SET
			id_supplier = '$id_supplier',
			nama_supplier = '$nama_supplier',
			almt_supplier = '$almt_supplier',
			telp_supplier = '$telp_supplier',
			fax_supplier = '$fax_supplier',
			kota_supplier = '$kota_supplier',
			cp_supplier = '$cp_supplier',
			status = '$status'
			WHERE id_supplier = '$id_supplier'
			");
			if($update){
			echo "<script>window.location.assign('masteringsupplier.php')</script>";
			}
		}
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-editsupplier" method="post">
<p align="center"><strong>Edit Supplier</strong></p>
				 <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line = $db->queryUniqueObject("SELECT * FROM supplier WHERE id_supplier='$id'");
				  }
				  ?>
	<center>
	<table>
	<tr>
	<td>
	<strong>Kode Supplier
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_supplier" class="input-medium" name="id_supplier" value="<?php echo $line->id_supplier ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
  <tr>
	<td>
	<strong>Nama Supplier
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama_supplier" class="input-large" name="nama_supplier" value="<?php echo $line->nama_supplier ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Alamat Supplier
	<td>
			<input style="height: 30px" type="text" id="almt_supplier" class="input-large"  name="almt_supplier" value="<?php echo $line->almt_supplier ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Telepon Supplier
	<td>
			<input style="height: 30px" type="text" id="telp_supplier" class="input-medium"  name="telp_supplier" value="<?php echo $line->telp_supplier ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Fax Supplier
	<td>
			<input style="height: 30px" type="text" id="fax_supplier" class="input-medium"  name="fax_supplier" value="<?php echo $line->fax_supplier ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Kota
	<td>
			<input style="height: 30px" type="text" id="kota_supplier" class="input-medium"  name="kota_supplier" value="<?php echo $line->kota_supplier ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Contact Person
	<td>
			<input style="height: 30px" type="text" id="cp_supplier" class="input-medium"  name="cp_supplier" value="<?php echo $line->cp_supplier ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Status
	<td>
			<select class="input-medium" name="status">
						<option value="1" <?php if($line->status=="1"){echo "selected";}?>>Aktif</option>
						<option value="0" <?php if($line->status=="0"){echo "selected";}?>>Tidak Aktif</option>
			</select>
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringsupplier.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>
