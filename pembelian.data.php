<?php
// panggil berkas koneksi.php
require 'koneksi.php';
// buat koneksi ke database mysql
koneksi_buka();
?>
<script type="text/javascript">
    $(document).ready(function () {
		$( ".statusganti" ).each(function(){
		var value = $(this).html();
		if ( value == 'PARTIAL' )
		{
			$( this ).parent().css('background-color', '#FFFF00');
		}
		else if ( value == 'RECEIVEABLE' )
		{
			$( this ).parent().css('background-color', '#F08080');
		}
		else if ( value == 'COMPLETE' )
		{
			$( this ).parent().css('background-color', '#98FB98');
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
<style type="text/css">
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
        <th width="7%">Detail</th>
        <th>No. Purchasing</th>
		<th>Tgl. Purchasing</th>
        <th>No. Faktur</th>
		<th>Tgl. Faktur</th>
        <th>No. Shipping</th>
        <th>Tgl. Shipping</th>
		<th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody class="header">
    <?php 
        $i = 1;
        $jml_per_halaman = 50; // jumlah data yg ditampilkan perhalaman
        //$jml_data = mysql_num_rows(mysql_query("SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_BELI, MAX(tgl_start) AS MaxDateTime FROM hrgbeli GROUP BY kd_tipe) b on b.kd_tipe=m.kd_tipe inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe"));
        $jml_data = mysql_num_rows(mysql_query("SELECT * FROM trbeli"));
		$jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
			$query = mysql_query("
                SELECT * FROM trbeli 
                WHERE NO_PURCHASING LIKE '%$kunci%'
                OR NO_SHIPPING LIKE '%$kunci%'
                OR NO_FA LIKE '%$kunci%'
                OR STATUS LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            //$query = mysql_query("SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_BELI, MAX(tgl_start) AS MaxDateTime FROM hrgbeli GROUP BY kd_tipe) b on b.kd_tipe=m.kd_tipe inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
			$query = mysql_query("SELECT * FROM trbeli LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
		// query ketika tidak ada parameter halaman maupun pencarian
        } else {
            //$query = mysql_query("SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_BELI, MAX(tgl_start) AS MaxDateTime FROM hrgbeli GROUP BY kd_tipe) b on b.kd_tipe=m.kd_tipe inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe LIMIT 0, $jml_per_halaman");
            $query = mysql_query("SELECT * FROM trbeli LIMIT 0, $jml_per_halaman");
			$halaman = 1; //tambahan
        }
        while($data = mysql_fetch_array($query)) {
        // tampilkan data mahasiswa selama masih ada
    ?>
    <tr>
        <?php 
		$sql = mysql_query("SELECT * from trbelidetail where no_fa='".$data['NO_FA']."'");
	    $shipping = '<tr>
	   <th>Kode</th>
	   <th>Tipe</th>
	   <th>Nama Tipe</th>
	   <th>No. Rangka</th>
	   <th>No. Mesin</th>
	   <th width="7%">Warna</th>
	   <th width="7%">Diterima</th>
	   </tr>';
		$j = 1;
		if(mysql_num_rows($sql))
	    {
	    while($rs=mysql_fetch_array($sql))
	    {
	   /*$id = 1;*/
       	   	$sql2 = mysql_query("SELECT nm_warna from mstwarna where kd_warna='".$rs['KD_WARNA']."'");
			$rs2=mysql_fetch_array($sql2);
	   $shipping.= "
	   <tr>
	   <td>".$rs['KD_ASTRA']."</td>
       <td>".$rs['KD_TIPE']."</td>
       <td>".$rs['NM_TIPE']."</td>
       <td>".$rs['NO_RANGKA']."</td>
	   <td>".$rs['NO_MESIN']."</td>
	   <td width='7%'>".$rs2['nm_warna']."</td>
		
	   ";
	   if($rs['STATUS']=='WAITING')
	   {
	   $shipping.= "<td width='7%'>0</td></tr>";
	   }
	   else if ($rs['STATUS']=='RECEIVED')
	   {
	   $shipping.= "<td width='7%'>1</td></tr>";
	   }
	   $j++;
	  /*$id++;*/
	   }
	  };
	  echo "<td width='7%'><a href='#' onclick=\"toggle('shipping$i');return false;\" class='btn btn-process btn-sm'>Detail</a></td>";?>
		<td><?php echo $data['NO_PURCHASING'] ?></td>
		<td><?php echo date('d-m-Y',strtotime($data['TGL_PURCHASING'])) ?></td>
        <td><?php echo $data['NO_FA'] ?></td>
		<td><?php echo date('d-m-Y',strtotime($data['TGL_FA'])) ?></td>
        <td><?php echo $data['NO_SHIPPING'] ?></td>
		<td><?php if ($data['TGL_SHIPPING']==NULL) {echo '';} else {echo date('d-m-Y', strtotime(str_replace('-','/', $data['TGL_SHIPPING'])));} ?></td>
		<td class="statusganti"><?php echo $data['STATUS'] ?></td>
		<?php if ($data['STATUS']=='RECEIVEABLE'||$data['STATUS']=='PARTIAL'){?>
        <td>
            <a href="shippinglist.php?id=<?php echo $data['NO_PURCHASING']?>" id="<?php echo $data['NO_PURCHASING']?>" class="ubah" data-toggle="modal">
                <i class="fa fa-edit"></i>
            </a>
			<!--
            <a href="#" id="<?php echo $data['NO_PURCHASING']?>" class="hapus">
                <i class="fa fa-trash"></i>
            </a>
			-->
        </td>
		<?php } else if ($data['STATUS']=='COMPLETE'){?>
		<td>
		<a href="shippinglistedit.php?id=<?php echo $data['NO_PURCHASING']?>" id="<?php echo $data['NO_PURCHASING']?>" class="ubah" data-toggle="modal">
                <i class="fa fa-edit"></i>
        </a>
		</td>
		<?php } ?>
    </tr>
	<td colspan="12">
	<table class="inside" cellpadding="0" cellspacing="0">
				  <?php echo "<tbody border='1' id='shipping$i' style='display:none'>$shipping</tbody>";?>
	</table>
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