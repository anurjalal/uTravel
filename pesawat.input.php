<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$id_maskapai = $_POST['id'];
// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM masterpesawat WHERE id_maskapai='$id_maskapai'");
}


// tutup koneksi ke database mysql
koneksi_tutup();

?>
