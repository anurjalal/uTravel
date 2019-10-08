<?php
// panggil berkas koneksi.php
require 'koneksi.php';
include 'db.php';
// buat koneksi ke database mysql
koneksi_buka();
?>
<script type="text/javascript">
    $(document).ready(function () {
		$( ".statusganti" ).each(function(){
		var value = $(this).html();
		if ( value == 'LUNAS' )
		{
			$( this ).parent().css('background-color', '#F08080');
		}
	});
});
	function toggle(value){
		var state = document.getElementById(value).style.display;
		if (state=='block')
		{
			document.getElementById(value).style.display = 'none';
		}
		else
		{
			document.getElementById(value).style.display = 'block';
		}
	}
    
    
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
    background-color: #FFFFFF;
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
       
       <form action="bayarhutang_per_pesanan.php" method ="post">
<table class="table" cellpadding="0" cellspacing="0">
<thead>
    <tr>
		<th>No. PO</th>		
        <th>Tanggal PO</th>
        <th>Nama Supplier</th>	    
        <th>Jumlah Hutang</th>
        <th>Tanggal Jatuh tempo</th>
     <!--    <th>No. Invoice</th> -->
        <th>Status</th>
        <th>Bayar</th>
    </tr>
</thead>
    
<tbody class="header">
    
    <?php
        $i = 1;
        $jml_per_halaman = 50; // jumlah data yg ditampilkan perhalaman
        //$jml_data = mysql_num_rows(mysql_query("SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_BELI, MAX(tgl_start) AS MaxDateTime FROM hrgbeli GROUP BY kd_tipe) b on b.kd_tipe=m.kd_tipe inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe"));
        $jml_data = mysql_num_rows(mysql_query("SELECT * FROM pembelian"));
		$jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
			$query = mysql_query("
                SELECT * FROM pembelian
                WHERE no_po LIKE '%$kunci%'
                OR nama_supplier LIKE '%$kunci%'
                OR statusdibayar LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            //$query = mysql_query("SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_BELI, MAX(tgl_start) AS MaxDateTime FROM hrgbeli GROUP BY kd_tipe) b on b.kd_tipe=m.kd_tipe inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
			$query = mysql_query("SELECT * FROM pembelian LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
		// query ketika tidak ada parameter halaman maupun pencarian
        } else {
            //$query = mysql_query("SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_BELI, MAX(tgl_start) AS MaxDateTime FROM hrgbeli GROUP BY kd_tipe) b on b.kd_tipe=m.kd_tipe inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe LIMIT 0, $jml_per_halaman");
            $query = mysql_query("SELECT * FROM pembelian LIMIT 0, $jml_per_halaman");
			$halaman = 1; //tambahan
        }
        while($data = mysql_fetch_array($query)) {
			//$dpp = $db->queryUniqueValue("select sum(hrg_beli) from trbelidetail where no_fa='".$data['NO_FA']."'");
        // tampilkan data mahasiswa selama masih ada
    ?>
    <tr>
		    <td><?php echo $data['no_po'] ?></td>			
			<td><?php echo date('d-m-Y',strtotime($data['tgl_po'])) ?></td>
			<td><?php echo $data['nama_supplier'] ?></td>
            <td><?php echo $data['hargabelitotal'] ?></td>
            <td><?php echo date('d-m-Y',strtotime($data['tgl_jatuh_tempo'])) ?></td>
          <!--   <td><?php if ($data['no_invoice'] == ""){
                echo " <a href= 'create_no_invoice_pembelian.php?no_po=$data[no_po]'>Masukkan Invoice</a>" ;}
                else if ($data['no_invoice'] != ""){
                    echo $data['no_invoice'];
                }
            ?> </td> -->
          
            <td class="statusganti"><?php echo $data['statusdibayar'] ?></td>
		<td>
		<?php if ($data['statusdibayar']!='LUNAS') {
            ?>
            
            <a href="bayarhutang_per_pesanan.php?id=<?php echo $data['no_po']?>" id="<?php echo $data['no_po']?>"> 
                <i><small>BAYAR</small></i>
        </a>
            
		
		<?php } elseif ($data['statusdibayar']=='LUNAS') { ?>
            
            <a href="batalkanpembayaran.php?id=<?php echo $data['no_po']?>" id="<?php echo $data['no_po']?>" onclick="return confirm('ANDA YAKIN AKAN MEMBATALKAN PEMBAYARAN INI ... ?')"> 
                <i><small>BATAL</small></i>
        </a>
        
   <?php } ?> 
	
		</td>
    </tr>
    <?php
        $i++;
        }
    ?>
</tbody>
</table>
    </form>
       
        
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
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_awal'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('tgl_akhir'),
		format : "DD-MM-YYYY",
    });
</script>
