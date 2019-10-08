<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$id_kereta = $_POST['id'];
// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM masterkereta WHERE id_kereta='$id_kereta'");
}


// tutup koneksi ke database mysql
koneksi_tutup();

?>
