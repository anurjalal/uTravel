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
	if(isset($_POST['kd_user']))
	{
	$kd_user = mysql_real_escape_string($_POST['kd_user']);
	$nm_user = mysql_real_escape_string($_POST['nm_user']);
	$login_name = mysql_real_escape_string($_POST['login_name']);
	$pwd = mysql_real_escape_string($_POST['pwd']);
	//$password_hash = password_hash($pwd, PASSWORD_BCRYPT);
	$password_md5 = md5($pwd);
	$idgroup = mysql_real_escape_string($_POST['idgroup']);
	$user_status = mysql_real_escape_string($_POST['user_status']);
	if($kd_user!="" && $nm_user!="" ) {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as jumlah FROM userlog WHERE kd_user='$kd_user'");
	$data=mysql_fetch_assoc($query);
	$jml_user=$data['jumlah'];
	if($jml_user == 0) {	
	$insert = mysql_query("INSERT INTO userlog VALUES('$kd_user','$nm_user','$login_name','$password_md5','$idgroup','$user_status')");
    if($insert){
	echo "<script>window.location.assign('masteringuser.php')</script>";
	}
	}
	}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-user" method="post">
	<p align="center"><strong>Tambah User</strong></p>
	<center>
	<table>
	<tr>
	<td>
	<strong>Kode User
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_user" class="input-medium" name="kd_user" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Nama User
	</td>
	<td>
			<input style="height: 30px" type="text" id="nm_user" class="input-medium" name="nm_user" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Login Name
	</td>
	<td>
			<input style="height: 30px" type="text" id="login_name" class="input-medium" name="login_name" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Password
	</td>
	<td>
			<input style="height: 30px" type="password" id="pwd" class="input-medium" name="pwd" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>ID Group
	</td>
	<td>
			<select style="height: 30px;width:206px" id="idgroup" name="idgroup" value="">
						<option value="">Tidak ada</option>
						<option value="Administrator">Administrator</option>
						<option value="Sales">Sales</option>
						<option value="Kasir">Kasir</option>
						<option value="Finance">Finance</option>
						<option value="Warehouse">Warehouse</option>
			</select>
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
    <tr>
	<td>
	<strong>Status
	</td>
	<td>
			<select class="input-medium" name="user_status">
				<option value="1">Aktif</option>
				<option value="0">Tidak Aktif</option>
			</select>
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringuser.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>