<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$no_terima = $_POST['id'];
//$no_mesin = $_POST['name'];

// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM trbeli WHERE no_terima='$no_terima'");
}
// tutup koneksi ke database mysql
koneksi_tutup();

?>
