<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$id_hotel = $_POST['id'];
// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM masterhotel WHERE id_hotel='$id_hotel'");
}


// tutup koneksi ke database mysql
koneksi_tutup();

?>
