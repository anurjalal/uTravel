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
	if(isset($_POST['nama_customer']))
		{
	$id_customer = mysql_real_escape_string($_POST['id_customer']);
	$nama_customer = mysql_real_escape_string($_POST['nama_customer']);
	$almt_customer = mysql_real_escape_string($_POST['almt_customer']);
	$telp_customer = mysql_real_escape_string($_POST['telp_customer']);
	$fax_customer = mysql_real_escape_string($_POST['fax_customer']);
	$kota_customer = mysql_real_escape_string($_POST['kota_customer']);
	$cp_customer = mysql_real_escape_string($_POST['cp_customer']);
	$status = mysql_real_escape_string($_POST['status']);
	
	// validasi agar tidak ada data yang kosong
	if($id_customer!="" && $nama_customer!="") {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as id_customer FROM customer WHERE id_customer='$id_customer'");
	$data=mysql_fetch_assoc($query);
	$jml_cust=$data['id_customer'];
		if($jml_cust == 0) {
            $insert = mysql_query("INSERT INTO customer(id_customer,nama_customer,almt_customer,telp_customer,fax_customer,kota_customer,cp_customer,status) VALUES('$id_customer','$nama_customer','$almt_customer','$telp_customer','$fax_customer','$kota_customer','$cp_customer','$status')");
			if($insert){
			echo "<script>window.location.assign('masteringkustomer.php')</script>";
			}
		}
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-addcustomer" method="post">
<p align="center"><strong>Tambah Kustomer</strong></p>
	<center>
	<table>
	<tr>
	<td>
	<strong>ID Kustomer
	</td>
	<td>
			<input style="height: 30px" type="text" id="id_customer" class="input-medium" name="id_customer" value="<?php $max = $db->maxOfAll("id_customer","customer"); $maxcust = $max+1; if($id_customer==0){echo $maxcust;} else{echo $id_customer;} ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama Kustomer
	</td>
	<td>
			<input style="height: 30px" type="text" id="nama_customer" class="input-large" name="nama_customer" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Alamat Kustomer
	<td>
			<input style="height: 30px" type="text" id="almt_customer" class="input-large"  name="almt_customer" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Telepon Kustomer
	<td>
			<input style="height: 30px" type="text" id="telp_customer" class="input-medium"  name="telp_customer" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Fax Kustomer
	<td>
			<input style="height: 30px" type="text" id="fax_customer" class="input-medium"  name="fax_customer" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Kota Kustomer
	<td>
			<input style="height: 30px" type="text" id="kota_customer" class="input-medium"  name="kota_customer" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Kontak Person
	<td>
			<input style="height: 30px" type="text" id="cp_customer" class="input-medium"  name="cp_customer" value="">
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
				<option value="1">Aktif</option>
				<option value="0">Tidak Aktif</option>
			</select>
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringkustomer.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>