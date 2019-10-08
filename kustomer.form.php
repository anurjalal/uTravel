<?php
// panggil file koneksi.php
require 'koneksi.php';
include_once "db.php";
// buat koneksi ke database mysql
koneksi_buka();

// tangkap variabel kd_mhs
$kd_cust = $_POST['id'];

// query untuk menampilkan mahasiswa berdasarkan kd_mhs
$data = mysql_fetch_array(mysql_query("SELECT * FROM mstcust WHERE kd_cust=".$kd_cust));

// jika kd_mhs > 0 / form ubah data
if($kd_cust> 0) { 
	$kd_cust = $data['KD_CUST'];
	$nm_cust = $data['NM_CUST'];
	$ktp = $data['KTP'];
	$tgl_lahir = $data['TGL_LAHIR'];
	//$tgl_lahir=strtotime($tgl_lahir);
	//$tgl_lahir=date('Y-m-d H:i:s', $tgl_lahir);
	$almt_cust = $data['ALMT_CUST'];
	$email = $data['EMAIL'];
	$kelurahan = $data['KELURAHAN'];
	$kecamatan = $data['KECAMATAN'];
	$kota_cust = $data['KOTA_CUST'];
	$provinsi = $data['PROVINSI'];
	$kodepos = $data['KODEPOS'];
	$telp1_cust = $data['TELP1_CUST'];
	$telp2_cust = $data['TELP2_CUST'];
	$agama = $data['AGAMA'];
	$pekerjaan = $data['PEKERJAAN'];
	$status = $data['STATUS'];
	
//form tambah data
} else {
	$kd_cust = "";
	$nm_cust = "";
	$ktp = "";
	$tgl_lahir = "";
	$almt_cust = "";
	$email = "";
	$kelurahan = "";
	$kecamatan = "";
	$kota_cust = "";
	$provinsi = "";
	$kodepos = "";
	$telp1_cust = "";
	$telp2_cust = "";
	$agama = "";
	$pekerjaan = "";
	$status = "";
}

?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-kustomer">
	<div class="control-group">
		<label class="control-label" for="kd_cust">Kode Kustomer</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kd_cust" class="input-medium" name="kd_cust" value="<?php $max = $db->maxOfAll("kd_cust","mstcust"); $maxcust = str_pad($max+1, 5, '0', STR_PAD_LEFT); if($kd_cust==0){echo $maxcust;} else{echo $kd_cust;} ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="nm_cust">Nama Kustomer</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="nm_cust" class="input-large" name="nm_cust" value="<?php echo $nm_cust ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="ktp">KTP</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="ktp" class="input-medium"  name="ktp" value="<?php echo $ktp ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="tgl_lahir" class="input-medium" placeholder="dd-mm-yyyy" name="tgl_lahir" value="<?php if ($tgl_lahir) {$date = DateTime::createFromFormat('Y-m-d H:i:s',$tgl_lahir); echo $date->format('d-m-Y');} else {echo "";}?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="almt_cust">Alamat Kustomer</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="almt_cust" class="input-large"  name="almt_cust" value="<?php echo $almt_cust ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="email" class="input-large"  name="email" value="<?php echo $email ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kelurahan">Kelurahan</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kelurahan" class="input-medium"  name="kelurahan" value="<?php echo $kelurahan ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kecamatan">Kecamatan</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kecamatan" class="input-medium"  name="kecamatan" value="<?php echo $kecamatan ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kota_cust">Kota</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kota_cust" class="input-medium"  name="kota_cust" value="<?php echo $kota_cust ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="provinsi">Provinsi</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="provinsi" class="input-medium"  name="provinsi" value="<?php echo $provinsi ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kodepos">Kode Pos</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="kodepos" class="input-medium"  name="kodepos" value="<?php echo $kodepos ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="telp1_cust">Telepon 1</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="telp1_cust" class="input-medium"  name="telp1_cust" value="<?php echo $telp1_cust ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="telp2_cust">Telepon 2</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="telp2_cust" class="input-medium"  name="telp2_cust" value="<?php echo $telp2_cust ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="agama">Agama</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="agama" class="input-medium"  name="agama" value="<?php echo $agama ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="pekerjaan">Pekerjaan</label>
		<div class="controls">
			<input style="height: 30px" type="text" id="pekerjaan" class="input-medium"  name="pekerjaan" value="<?php echo $pekerjaan ?>">
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
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_lahir'),
		format : "DD-MM-YYYY",
    });
</script>