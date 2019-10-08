<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();

// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM customer WHERE id_customer=".$_POST['hapus']);
}

// tutup koneksi ke database mysql
koneksi_tutup();

?>
