<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$id_stasiun = $_POST['id'];
// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM masterstasiun WHERE id_stasiun='$id_stasiun'");
}


// tutup koneksi ke database mysql
koneksi_tutup();

?>
