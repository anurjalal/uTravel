<?php
// panggil file koneksi.php
require 'koneksi.php';
include_once "db.php";
// buat koneksi ke database mysql
koneksi_buka();

// tangkap variabel kd_mhs
$kd_sup = $_POST['id'];

// query untuk menampilkan mahasiswa berdasarkan kd_mhs
$data = mysql_fetch_array(mysql_query("SELECT * FROM mstsup WHERE kd_sup=".$kd_sup));

// jika kd_mhs > 0 / form ubah data
if($kd_sup> 0) { 
	$kd_sup = $data['KD_SUP'];
	$nm_sup = $data['NM_SUP'];
	$alm_sup = $data['ALM_SUP'];
	$telp_sup = $data['TELP_SUP'];
	$fax_sup = $data['FAX_SUP'];
	$kota_sup = $data['KOTA_SUP'];
	$contact_sup = $data['CONTACT_SUP'];
	$status = $data['STATUS'];

//form tambah data
} else {
	$kd_sup = "";
	$nm_sup = "";
	$alm_sup = "";
	$telp_sup = "";
	$fax_sup = "";
	$kota_sup = "";
	$contact_sup = "";
	$status = "";
}

?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-supplier">
	<div class="control-group">
		<label class="control-label" for="kd_sup">Kode Supplier</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kd_sup" class="input-medium" name="kd_sup" value="<?php $max = $db->maxOfAll("kd_sup","mstsup"); $maxsup = str_pad($max+1, 5, '0', STR_PAD_LEFT); if($kd_sup==0){echo $maxsup;} else{echo $kd_sup;} ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="nm_sup">Nama Supplier</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="nm_sup" class="input-large" name="nm_sup" value="<?php echo $nm_sup ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="alm_sup">Alamat Supplier</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="alm_sup" class="input-large"  name="alm_sup" value="<?php echo $alm_sup ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="telp_sup">Telepon Supplier</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="telp_sup" class="input-medium"  name="telp_sup" value="<?php echo $telp_sup ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="fax_sup">Fax Supplier</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="fax_sup" class="input-medium"  name="fax_sup" value="<?php echo $fax_sup ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kota_sup">Kota</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kota_sup" class="input-medium"  name="kota_sup" value="<?php echo $kota_sup ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_sup">Contact Person</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="contact_sup" class="input-medium"  name="contact_sup" value="<?php echo $contact_sup ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="status">Status</label>
		<div class="controls">
		<select class="input-medium" name="status" value="<?php echo $status;?>">
						<option value="1" <?php if($status=="1"){echo "selected";}?>>Aktif</option>
						<option value="0" <?php if($status=="0"){echo "selected";}?>>Tidak Aktif</option>
		</select>
		</div>
	</div>
</form>

<?php
// tutup koneksi ke database mysql
koneksi_tutup();
?>
