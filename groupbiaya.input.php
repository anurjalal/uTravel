<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$kd_beban = $_POST['id'];
// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM groupbiaya WHERE kd_beban='$kd_beban'");
} else {
	// deklarasikan variabel
	$kd_beban = $_POST['KD_BEBAN'];
	$nm_beban = $_POST['NM_BEBAN'];
	$kategori = $_POST['KATEGORI'];
	
	// validasi agar tidak ada data yang kosong
	if($kd_beban!="" && $nm_beban!="") {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as jumlah FROM groupbiaya WHERE kd_beban='$kd_beban'");
	$data=mysql_fetch_assoc($query);
	$jml_beban=$data['jumlah'];
		if($jml_beban == 0) {
			mysql_query("INSERT INTO groupbiaya VALUES('$kd_beban','$nm_beban','$kategori')");
			//mysql_query("INSERT INTO mstcust VALUES('$kd_cust','$nm_cust','$ktp','$tgl_lahir','$almt_cust')");
		// proses ubah data mahasiswa
		} else {
			mysql_query("UPDATE groupbiaya SET 
			kd_beban = '$kd_beban',
			nm_beban = '$nm_beban',
			kategori = '$kategori'
			WHERE kd_beban = '$kd_beban'
			");
		}
	}
}

// tutup koneksi ke database mysql
koneksi_tutup();

?>
