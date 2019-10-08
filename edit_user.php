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
	if($kd_user!="" && $nm_user!="" && $login_name!="" && $pwd!='' && $idgroup!=='') {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as jumlah FROM userlog WHERE kd_user='$kd_user'");
	$data=mysql_fetch_assoc($query);
	$jml_user=$data['jumlah'];
	if($jml_user == 1) {	
	$update = mysql_query("UPDATE userlog SET 
			kd_user = '$kd_user',
			nm_user = '$nm_user',
			login_name = '$login_name',
			pwd = '$password_md5',
			idgroup = '$idgroup',
			user_status = '$user_status'
			WHERE kd_user = '$kd_user'
			");
    if($update){
	echo "<script>window.location.assign('masteringuser.php')</script>";
	}
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
				  $line = $db->queryUniqueObject("SELECT * FROM userlog WHERE kd_user='$id'");
				  }
				  ?>
	<center>
	<table>
	<tr>
	<td>
	<strong>Kode User
	</td>
	<td>
			<input style="height: 30px" type="text" id="kd_user" class="input-medium" name="kd_user" value="<?php echo $line->KD_USER ?>">
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
			<input style="height: 30px" type="text" id="nm_user" class="input-medium" name="nm_user" value="<?php echo $line->NM_USER ?>">
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
			<input style="height: 30px" type="text" id="login_name" class="input-medium" name="login_name" value="<?php echo $line->LOGIN_NAME ?>">
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
			<input style="height: 30px" type="password" id="pwd" class="input-medium" name="pwd" value="<?php echo $line->PWD ?>">
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
			<select style="height: 30px;width:206px" id="idgroup" name="idgroup">
						<option value="">Tidak ada</option>
						<option value="Administrator" <?php if($line->IDGROUP=="Administrator"){echo "selected";}?>>Administrator</option>
						<option value="Sales" <?php if($line->IDGROUP=="Sales"){echo "selected";}?>>Sales</option>
						<option value="Kasir" <?php if($line->IDGROUP=="Kasir"){echo "selected";}?>>Kasir</option>
						<option value="Finance" <?php if($line->IDGROUP=="Finance"){echo "selected";}?>>Finance</option>
						<option value="Warehouse" <?php if($line->IDGROUP=="Warehouse"){echo "selected";}?>>Warehouse</option>
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
						<option value="1" <?php if($line->USER_STATUS=="1"){echo "selected";}?>>Aktif</option>
						<option value="0" <?php if($line->USER_STATUS=="0"){echo "selected";}?>>Tidak Aktif</option>
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