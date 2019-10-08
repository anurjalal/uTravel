<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$no_nota = $_POST['id'];
//$no_mesin = $_POST['name'];

// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM trjual WHERE no_nota='$no_nota'");
}
// tutup koneksi ke database mysql
koneksi_tutup();

?>
