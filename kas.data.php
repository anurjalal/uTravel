<?php
// panggil berkas koneksi.php
require 'koneksi.php';
include 'db.php';
// buat koneksi ke database mysql
koneksi_buka();
 
?>
 
<!--<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">-->
<style type="text/css">
table.db-table 		{ border-right:1px solid #ccc; border-bottom:1px solid #ccc; }
table.db-table th	{ background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
table.db-table td	{ padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
</style>  
<table style="margin-left:50px" class="db-table" cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th style="width:10px">No</th>
        <th style="width:30px">Kode Penjualan</th>
		<th style="width:50px">Tanggal Penjualan</th>
		<th style="width:50px">Nama Customer</th>
		<th style="width:50px">Kode Pembelian</th>
		<th style="width:50px">Tanggal Pembelian</th>
		<th style="width:50px">Nama Supplier</th>
		<th style="width:50px">Nama Broker</th>
		<th style="width:50px">Tanggal Keluar</th>
		<th style="width:50px">Tanggal Masuk</th>
		<th style="width:50px">Debit</th>
		<th style="width:50px">Kredit</th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 5; // jumlah data yg ditampilkan perhalaman
        $jml_data = mysql_num_rows(mysql_query("SELECT * FROM kas"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mysql_query("
                SELECT * FROM kas 
                WHERE no_penjualan LIKE '%$kunci%'
				OR no_pembelian LIKE '%$kunci%'
				OR nm_cust LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mysql_query("SELECT * FROM kas LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mysql_query("SELECT * FROM kas LIMIT 0, $jml_per_halaman");
            $halaman = 1; //tambahan
        }
        while($data = mysql_fetch_array($query)) {
        // tampilkan data mahasiswa selama masih ada
    	$namasupplier = $db->queryUniqueValue("select nm_sup from mstsup where kd_sup='".$data['KD_SUP']."'");
		$namabroker = $db->queryUniqueValue("select nm_broker from broker where kd_broker='".$data['KD_BROKER']."'");
	?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['NO_PENJUALAN'] ?></td>
        <td><?php if ($data['TGL_PENJUALAN']=='0000-00-00 00:00:00') {echo '';} else {echo date('d-m-Y', strtotime(str_replace('-','/', $data['TGL_PENJUALAN'])));} ?></td>
		<td><?php echo $data['NM_CUST'] ?></td>
		<td><?php echo $data['NO_PEMBELIAN'] ?></td>
		<td><?php if ($data['TGL_PEMBELIAN']=='0000-00-00 00:00:00') {echo '';} else {echo date('d-m-Y', strtotime(str_replace('-','/', $data['TGL_PEMBELIAN'])));} ?></td>
		<td><?php echo $namasupplier ?></td>
		<td><?php echo $namabroker ?></td>
		<td><?php if ($data['TGL_KELUAR']=='0000-00-00 00:00:00') {echo '';} else {echo date('d-m-Y', strtotime(str_replace('-','/', $data['TGL_KELUAR']))) ;} ?></td>
		<td><?php if ($data['TGL_MASUK']=='0000-00-00 00:00:00') {echo '';} else {echo date('d-m-Y', strtotime(str_replace('-','/', $data['TGL_MASUK'])));} ?></td>
		<td><?php echo $data['DEBIT'] ?></td>
		<td><?php echo $data['KREDIT'] ?></td>

    </tr>
    <?php
        $i++;
        }
    ?>
</tbody>
</table>
 
<?php if(!isset($_POST['cari'])) { ?>
<!-- untuk menampilkan menu halaman -->
<div class="pagination pagination-left">
  <ul>
    <?php

    // tambahan
    // panjang pagig yang akan ditampilkan
    $no_hal_tampil = 5; // lebih besar dari 3

    if ($jml_halaman <= $no_hal_tampil) {
        $no_hal_awal = 1;
        $no_hal_akhir = $jml_halaman;
    } else {
        $val = $no_hal_tampil - 2; //3
        $mod = $halaman % $val; //
        $kelipatan = ceil($halaman/$val);
        $kelipatan2 = floor($halaman/$val);

        if($halaman < $no_hal_tampil) {
            $no_hal_awal = 1;
            $no_hal_akhir = $no_hal_tampil;
        } elseif ($mod == 2) {
            $no_hal_awal = $halaman - 1;
            $no_hal_akhir = $kelipatan * $val + 2;
        } else {
            $no_hal_awal = ($kelipatan2 - 1) * $val + 1;
            $no_hal_akhir = $kelipatan2 * $val + 2;
        }

        if($jml_halaman <= $no_hal_akhir) {
            $no_hal_akhir = $jml_halaman;
        }
    }

    for($i = $no_hal_awal; $i <= $no_hal_akhir; $i++) {
        // tambahan
        // menambahkan class active pada tag li
        $aktif = $i == $halaman ? ' active' : '';
    ?>
    <li class="halaman<?php echo $aktif ?>" id="<?php echo $i ?>"><a href="#"><?php echo $i ?></a></li>
    <?php } ?>
  </ul>
</div>
<?php } ?>
 
<?php 
// tutup koneksi ke database mysql
koneksi_tutup(); 
?>