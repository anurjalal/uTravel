<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$kd_gabungan = $_POST['hapussubgroup'];
// proses menghapus data mahasiswa
if(isset($_POST['hapussubgroup'])) {
	mysql_query("DELETE FROM SUBGROUPBIAYA WHERE kd_gabungan='$kd_gabungan'");
}
koneksi_tutup();

?>
