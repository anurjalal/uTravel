
<?php
// panggil file koneksi.php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();

// tangkap variabel kd_mhs
$kd_user = $_POST['id'];

// query untuk menampilkan mahasiswa berdasarkan kd_mhs
$data = mysql_fetch_array(mysql_query("SELECT * FROM userlog WHERE kd_user='$kd_user'"));
	$kd_user = $data['KD_USER'];
	$nm_user = $data['NM_USER'];
	$login_name = $data['LOGIN_NAME'];
	$pwd = $data['PWD'];
	$idgroup = $data['IDGROUP'];
	$user_status = $data['USER_STATUS'];
	
?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-user">
	<div class="control-group">
		<label class="control-label" for="kd_user">Kode User</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kd_user" class="input-medium" name="kd_user" value="<?php echo $kd_user ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="nm_user">Nama User</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="nm_user" class="input-medium" name="nm_user" value="<?php echo $nm_user ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="login_name">Login Name</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="login_name" class="input-medium" name="login_name" value="<?php echo $login_name ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="pwd">Password</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="pwd" class="input-medium" name="pwd" value="<?php echo $pwd ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="idgroup">ID Group</label>
		<div class="controls">
			<select style="height: 30px;width:206px" id="idgroup" name="idgroup" value="<?php echo $idgroup;?>">
						<option value="">Tidak ada</option>
						<option value="Administrator" <?php if($idgroup=="Administrator"){echo "selected";}?>>Administrator</option>
						<option value="Sales" <?php if($idgroup=="Sales"){echo "selected";}?>>Sales</option>
						<option value="Kasir" <?php if($idgroup=="Kasir"){echo "selected";}?>>Kasir</option>
						<option value="Finance" <?php if($idgroup=="Finance"){echo "selected";}?>>Finance</option>
						<option value="Warehouse" <?php if($idgroup=="Warehouse"){echo "selected";}?>>Warehouse</option>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="user_status">Status</label>
		<div class="controls">
		<select class="input-medium" name="user_status" value="<?php echo $user_status;?>">
						<option value="1" <?php if($user_status=="1"){echo "selected";}?>>Aktif</option>
						<option value="0" <?php if($user_status=="0"){echo "selected";}?>>Tidak Aktif</option>
		</select>
		</div>
	</div>
</form>

<?php
// tutup koneksi ke database mysql
koneksi_tutup();
?>
