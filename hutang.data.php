<?php
// panggil berkas koneksi.php
require 'koneksi.php';
include 'db.php';
// buat koneksi ke database mysql
koneksi_buka();
?>
<script type="text/javascript">
    $(document).ready(function () {
	$( ".jatuhtempo" ).each(function(){
		var currentdate = new Date();
		var parts = $(this).html().split("-");
		
		var jatuhtempo = new Date(parts[2], parts[1] - 1, parts[0]);
		var idharga = $(this).attr("name");
		var nameharga = "#harga"+idharga;
		var harga = parseInt($(nameharga).html());
		if ( currentdate.getTime()>jatuhtempo.getTime() && harga>0 )
		{
			$( this ).parent().css('background-color', '#F08080');
		}
	});
    });
</script>
<style type="text/css" media="screen">
.table {
    border-collapse: collapse;
    width: 100%;
}
.table td {
    overflow: hidden;
	word-wrap: break-word;
    font-weight: bold;
    color: #333;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
.table th {
    font-weight: bold;
    color: #333;
    background-color: #F0F0F0;
	text-align:center;
	border: 1px solid #ccc;
}

.table tbody {
    overflow-y: scroll;
    overflow-x: hidden;
    height: 250px;
    display: block;
}
.table thead {
    display:table;
    width: calc(100% - 16px);
    table-layout:fixed;
	border-top: 1px solid #ccc;
	border: 1px solid #ccc;
}
.table tbody tr {
    table-layout: fixed;
    display:table;
    width:100%;
}
.table td.harga {
  text-align: right;
}
.inside {
    border-collapse: collapse;
    width: 100%;
}
.inside tbody {
    height: 100px;
    display: block;
}
</style>
<table class="table" cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th>Kode Supplier</th>
		<th>Nama Supplier</th>
        <th>Alamat</th>
        <th>Jatuh Tempo</th>
        <th>Hutang</th>
    </tr>
</thead>
<tbody class="header">
    <?php
        $a = 
        $i = 1;
        $jml_per_halaman = 50; // jumlah data yg ditampilkan perhalaman
        //$jml_data = mysql_num_rows(mysql_query("SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_BELI, MAX(tgl_start) AS MaxDateTime FROM hrgbeli GROUP BY kd_tipe) b on b.kd_tipe=m.kd_tipe inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe"));
        $jml_data = mysql_num_rows(mysql_query("SELECT * FROM supplier"));
		$jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
			$query = mysql_query("
                SELECT * FROM supplier
                WHERE nama_supplier LIKE '%$kunci%'
                OR almt_supplier LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            //$query = mysql_query("SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_BELI, MAX(tgl_start) AS MaxDateTime FROM hrgbeli GROUP BY kd_tipe) b on b.kd_tipe=m.kd_tipe inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
			$query = mysql_query("SELECT * FROM supplier LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
		// query ketika tidak ada parameter halaman maupun pencarian
        } else {
            //$query = mysql_query("SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_BELI, MAX(tgl_start) AS MaxDateTime FROM hrgbeli GROUP BY kd_tipe) b on b.kd_tipe=m.kd_tipe inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe LIMIT 0, $jml_per_halaman");
            $query = mysql_query("SELECT * FROM supplier LIMIT 0, $jml_per_halaman");
			$halaman = 1; //tambahan
        }
		$i = 1;
        while($data = mysql_fetch_array($query)) {
        $jatuh_tempo = $db->queryUniqueValue('select max(tgl_jatuh_tempo) from hutang where nama_supplier="'.$data["nama_supplier"].'"');
		$hutang = $db->queryUniqueValue('select sum(kredit) - sum(debit) from hutang where nama_supplier="'.$data["nama_supplier"].'"');
        // tampilkan data mahasiswa selama masih ada
    ?>
    <tr>
		<td><?php echo $data['id_supplier'] ?></td>
        <td><?php echo $data['nama_supplier'] ?></td>
        <td><?php echo $data['almt_supplier'] ?></td>
        <td class="jatuhtempo" name="<?php echo $i?>"><?php if ($jatuh_tempo) { echo date('d-m-Y',strtotime($jatuh_tempo));} ?></td>
		<td class="harga" id="harga<?php echo $i?>"><?php echo number_format($hutang,0,'','.'); ?></td>

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
    $no_hal_tampil = 50; // lebih besar dari 3
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
