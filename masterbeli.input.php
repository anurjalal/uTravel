<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$kode = $_POST['id'];

// proses menghapus data mahasiswa
if(isset($_POST['hapushargabeli'])) {
	mysql_query("DELETE FROM hrgbeli WHERE kd_hrgbeli='$kode'");
}
koneksi_tutup();

?>
