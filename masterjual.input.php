<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$kode = $_POST['id'];

// proses menghapus data mahasiswa
if(isset($_POST['hapushargajual'])) {
	mysql_query("DELETE FROM hrgjual WHERE kd_hrgjual='$kode'");
}
koneksi_tutup();

?>
