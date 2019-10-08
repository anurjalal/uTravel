<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$id_bandara = $_POST['id'];
// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM masterbandara WHERE id_bandara='$id_bandara'");
}


// tutup koneksi ke database mysql
koneksi_tutup();

?>
