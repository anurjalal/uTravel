<?php
// panggil berkas koneksi.php
require 'koneksi.php';
 
// buat koneksi ke database mysql
koneksi_buka();
 
?>
 
<!--<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">-->
<style type="text/css">
table.db-table 		{ border-right:1px solid #ccc; border-bottom:1px solid #ccc; }
table.db-table th	{ background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
table.db-table td	{ padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
</style>  
<table class="db-table" cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th>No</th>
        <th>ID Hotel</th>
		<th>Nama Hotel</th>
        <th>Nama Kota</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 5; // jumlah data yg ditampilkan perhalaman
        $jml_data = mysql_num_rows(mysql_query("SELECT * FROM masterhotel"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mysql_query("
                SELECT * FROM masterhotel 
                WHERE nama_hotel LIKE '%$kunci%'
                OR nama_kota LIKE '%$kunci%'

            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mysql_query("SELECT * FROM masterhotel LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mysql_query("SELECT * FROM masterhotel LIMIT 0, $jml_per_halaman");
            $halaman = 1; //tambahan
        }
        while($data = mysql_fetch_array($query)) {

        // tampilkan data mahasiswa selama masih ada
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['id_hotel'] ?></td>
        <td><?php echo $data['nama_hotel'] ?></td>
        <td><?php echo $data['nama_kota'] ?></td>

        <td>
            <a href="edit_hotel.php?id=<?php echo $data['id_hotel'] ?>" id="<?php echo $data['id_hotel'] ?>" class="ubah">
                <i class="fa fa-edit"></i>
            </a>
            <a href="#" id="<?php echo $data['id_hotel'] ?>" class="hapus">
                <i class="fa fa-trash"></i>
            </a>
        </td>
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