
<?php
// panggil file koneksi.php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();

// tangkap variabel kd_mhs
$kd_beban = $_POST['id'];

// query untuk menampilkan mahasiswa berdasarkan kd_mhs
$data = mysql_fetch_array(mysql_query("SELECT * FROM groupbiaya WHERE kd_beban='$kd_beban'"));
	$kd_beban = $data['KD_BEBAN'];
	$nm_beban = $data['NM_BEBAN'];
	$kategori = $data['KATEGORI'];
?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-groupbiaya">
	<div class="control-group">
		<label class="control-label" for="kd_beban">Kode Beban</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kd_beban" class="input-medium" name="kd_beban" value="<?php echo $kd_beban ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="nm_beban">Nama Beban</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="nm_beban" class="input-medium" name="nm_beban" value="<?php echo $nm_beban ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kategori">Kategori</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kategori" class="input-medium" name="kategori" value="<?php echo $kategori ?>">
		</div>
	</div>
</form>

<?php
// tutup koneksi ke database mysql
koneksi_tutup();
?>
