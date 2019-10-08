<?php
require 'koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
$kd_user = $_POST['id'];
// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM userlog WHERE kd_user='$kd_user'");
} else {
	// deklarasikan variabel
	$kd_user = $_POST['kd_user'];
	$nm_user = $_POST['nm_user'];
	$login_name = $_POST['login_name'];
	$pwd = $_POST['pwd'];
	$idgroup = $_POST['idgroup'];
	$user_status = $_POST['user_status'];
	
	
	// validasi agar tidak ada data yang kosong
	if($kd_user!="" && $nm_user!="" && $login_name!="" && $pwd!='' && $idgroup!=='') {
		// proses tambah data mahasiswa
	$query = mysql_query("SELECT count(*) as jumlah FROM userlog WHERE kd_user='$kd_user'");
	$data=mysql_fetch_assoc($query);
	$jml_user=$data['jumlah'];
		if($jml_user == 0) {
			mysql_query("INSERT INTO userlog VALUES('$kd_user','$nm_user','$login_name','$pwd','$idgroup','$user_status')");
			//mysql_query("INSERT INTO mstcust VALUES('$kd_cust','$nm_cust','$ktp','$tgl_lahir','$almt_cust')");
		// proses ubah data mahasiswa
		} else {
			mysql_query("UPDATE userlog SET 
			kd_user = '$kd_user',
			nm_user = '$nm_user',
			login_name = '$login_name',
			pwd = '$pwd',
			idgroup = '$idgroup',
			user_status = '$user_status'
			WHERE kd_user = '$kd_user'
			");
		}
	}
}

// tutup koneksi ke database mysql
koneksi_tutup();

?>
