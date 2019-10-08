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
		var jatuhtempo = new Date($(this).html());
		if ( currentdate.getTime()>jatuhtempo.getTime() )
		{
			$( this ).parent().css('background-color', '#F08080');
		}
	});
    });
</script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function bayarhutang(value)
	{
		var counter = value.match(/\d+/);
		var no_bku = $("#no_bku").val();
		var tgl_bku = $("#tgl_bku").val();
		var jenis = document.getElementById("kasbank");
		var kasbank = jenis.options[jenis.selectedIndex].text;
		var tgl_kasbank = $("#tgl_kasbank").val();
		var kd_sup = $("#kd_sup"+counter).val();
		var no_faktur = $("#no_faktur"+counter).val();
		var no_fakturastra = $("#no_fakturastra"+counter).val();
		var tgl_fa = $("#tgl_fa"+counter).val();
		var tgl_jt = $("#tgl_jt"+counter).val();
		var jumlah = $("#jumlah"+counter).val();
		var bayar = $("#bayar"+counter).val();
		if (bayar)
		{
			bayar = bayar;
		}
		else
		{
			bayar = 0;
		}
		var biaya_bunga = $("#biaya_bunga"+counter).val();
		if (biaya_bunga)
		{
			biaya_bunga = biaya_bunga;
		}
		else
		{
			biaya_bunga = 0;
		}
		var biaya_denda = $("#biaya_denda"+counter).val();
		if (biaya_denda)
		{
			biaya_denda = biaya_denda;
		}
		else
		{
			biaya_denda = 0;
		}
		var berhasil = $.ajax({
		url: "pengeluaranhutang.php?baris="+counter+"&no_bku="+no_bku+"&tgl_bku="+tgl_bku+"&kasbank="+kasbank+"&tgl_kasbank="+tgl_kasbank+"&kd_sup="+kd_sup+"&no_faktur="+no_faktur+"&no_fakturastra="+no_fakturastra+"&tgl_fa="+tgl_fa+"&tgl_jt="+tgl_jt+"&jumlah="+jumlah+"&bayar="+bayar+"&biaya_bunga="+biaya_bunga+"&biaya_denda="+biaya_denda,
		type: "POST",
		success: function(){
		alert("Hutang Dealer Berhasil Dibayar");
		},
		error: function(){
		alert("Hutang Dealer Tidak Berhasil Dibayar");
		}
		});
		//window.open("pengeluaranhutang.php?baris="+counter+"&no_bku="+no_bku+"&tgl_bku="+tgl_bku+"&kasbank="+kasbank+"&tgl_kasbank="+tgl_kasbank+"&kd_sup="+kd_sup+"&no_faktur="+no_faktur+"&no_fakturastra="+no_fakturastra+"&tgl_fa="+tgl_fa+"&tgl_jt="+tgl_jt+"&jumlah="+jumlah+"&bayar="+bayar+"&biaya_bunga="+biaya_bunga+"&biaya_denda="+biaya_denda);
		window.location.assign("masteringpengeluaranhutang.php");
		if (berhasil)
		{
		window.open("bkudealerreport.php?id="+no_bku);
		}
	}
</script> 
<?php
 		$id=$_GET['id'];
		if (!empty($_GET['baris']) && is_string($_GET['baris']))
		{
			$baris = $_GET['baris'];
			$no_bku = $_GET['no_bku'];
			$tgl_bku = $_GET['tgl_bku'];
			$tgl_bku = strtotime($tgl_bku);
			$tgl_bku = date('Y-m-d H:i:s', $tgl_bku);
			$kasbank = $_GET['kasbank'];
			$tgl_kasbank = $_GET['tgl_kasbank'];
			$tgl_kasbank = strtotime($tgl_kasbank);
			$tgl_kasbank = date('Y-m-d H:i:s', $tgl_kasbank);
			$no_sup = $_GET['kd_sup'];
			$no_faktur = $_GET['no_faktur'];
			$no_fakturastra = $_GET['no_fakturastra'];
			$tgl_fa = $_GET['tgl_fa'];
			$tgl_fa = strtotime($tgl_fa);
			$tgl_fa = date('Y-m-d H:i:s', $tgl_fa);
			$tgl_jt = $_GET['tgl_jt'];
			$tgl_jt = strtotime($tgl_jt);
			$tgl_jt = date('Y-m-d H:i:s', $tgl_jt);
			$jumlah = $_GET['jumlah'];
			$bayar = $_GET['bayar'];
			$biaya_bunga = $_GET['biaya_bunga'];
			$biaya_denda = $_GET['biaya_denda'];
			$username = $_SESSION['LOGIN_NAME'];
			$kd_beban_kas = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Kas'");
			$kd_beban_bank = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Bank'");
			$kd_beban_biaya_bunga = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Biaya Bunga'");
			$kd_beban_biaya_denda = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Biaya Denda'");
			$kd_beban_hutang = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Hutang Dagang'");
				if($kasbank=="Kas")
				{
				if($biaya_bunga==0)
				{
				$db->query("update hutang set status_bunga='BELUM' where no_purchasing = '$no_faktur'");
				}
				else if($biaya_bunga>0)
				{
				$db->query("insert into transaksi (no_bku,kd_buku_besar,keterangan,debit,kredit,tgl_transaksi,username) values('$no_bku','$kd_beban_kas','Kas Bayar Biaya Bunga',0,$biaya_bunga,'$tgl_bku','$username')");
				$db->query("insert into kas (no_bku,tgl_keluar,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$no_bku','$tgl_bku',0,$biaya_bunga,'$kd_beban_kas','$username','$tgl_bku','Bayar Biaya Bunga')");
				$db->query("insert into transaksi (no_bku,kd_buku_besar,keterangan,debit,kredit,tgl_transaksi,username) values('$no_bku','$kd_beban_biaya_bunga','Biaya Bunga',0,$biaya_bunga,'$tgl_bku','$username')");
				$db->query("insert into biaya (no_bku,tgl_transaksi,debit,kredit,kd_beban,username,keterangan) values('$no_bku','$tgl_bku',$biaya_bunga,0,'$kd_beban_biaya_bunga','$username','Biaya Bunga')");
				}
				if($biaya_denda>0)
				{
				$db->query("insert into transaksi (no_bku,kd_buku_besar,keterangan,debit,kredit,tgl_transaksi,username) values('$no_bku','$kd_beban_kas','Kas Bayar Biaya Denda',0,$biaya_denda,'$tgl_bku','$username')");
				$db->query("insert into kas (no_bku,tgl_keluar,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$no_bku','$tgl_bku',0,$biaya_denda,'$kd_beban_kas','$username','$tgl_bku','Bayar Biaya Denda')");
				$db->query("insert into transaksi (no_bku,kd_buku_besar,keterangan,debit,kredit,tgl_transaksi,username) values('$no_bku','$kd_beban_biaya_denda','Biaya Denda',0,$biaya_denda,'$tgl_bku','$username')");
				$db->query("insert into biaya (no_bku,tgl_transaksi,debit,kredit,kd_beban,username,keterangan) values('$no_bku','$tgl_bku',$biaya_denda,0,'$kd_beban_biaya_denda','$username','Biaya Denda')");					
				}
				}
				else if ($kasbank=="Bank")
				{
				if($biaya_bunga==0)
				{
				$db->query("update hutang set status_bunga='BELUM' where no_purchasing = '$no_faktur'");
				}					
				else if($biaya_bunga>0)
				{
				$db->query("insert into transaksi (no_bku,kd_buku_besar,keterangan,debit,kredit,tgl_transaksi,username) values('$no_bku','$kd_beban_bank','Bank Bayar Biaya Bunga',0,$biaya_bunga,'$tgl_bku','$username')");
				$db->query("insert into kas (no_bku,tgl_keluar,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$no_bku','$tgl_bku',0,$biaya_bunga,'$kd_beban_bank','$username','$tgl_bku','Bayar Biaya Bunga')");
				$db->query("insert into transaksi (no_bku,kd_buku_besar,keterangan,debit,kredit,tgl_transaksi,username) values('$no_bku','$kd_beban_biaya_bunga','Biaya Bunga',0,$biaya_bunga,'$tgl_bku','$username')");
				$db->query("insert into biaya (no_bku,tgl_transaksi,debit,kredit,kd_beban,username,keterangan) values('$no_bku','$tgl_bku',$biaya_bunga,0,'$kd_beban_biaya_bunga','$username','Biaya Bunga')");
				}
				if($biaya_denda>0)
				{
				$db->query("insert into transaksi (no_bku,kd_buku_besar,keterangan,debit,kredit,tgl_transaksi,username) values('$no_bku','$kd_beban_bank','Bank Bayar Biaya Denda',0,$biaya_denda,'$tgl_bku','$username')");
				$db->query("insert into kas (no_bku,tgl_keluar,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$no_bku','$tgl_bku',0,$biaya_denda,'$kd_beban_bank','$username','$tgl_bku','Bayar Biaya Denda')");
				$db->query("insert into transaksi (no_bku,kd_buku_besar,keterangan,debit,kredit,tgl_transaksi,username) values('$no_bku','$kd_beban_biaya_denda','Biaya Denda',0,$biaya_denda,'$tgl_bku','$username')");
				$db->query("insert into biaya (no_bku,tgl_transaksi,debit,kredit,kd_beban,username,keterangan) values('$no_bku','$tgl_bku',$biaya_denda,0,'$kd_beban_biaya_denda','$username','Biaya Denda')");					
				}
				}
			if($bayar>0 and $bayar<=$jumlah) 
    		{
				$tgl_pembelian = $db->queryUniqueValue("select tgl_purchasing from trbeli where no_purchasing='$no_faktur'");
		    	$bku = $db->query("insert into bku (no_bku,tgl_bku,kas_bank,tgl_kb,faktur,fakturastra,tgl_jt,kd_sup,bayar,username,tgl_transaksi) values('$no_bku','$tgl_bku','$kasbank','$tgl_kasbank','$no_faktur','$no_fakturastra','$tgl_jt','$kd_sup',$bayar,'$username','$tgl_bku')");
				$db->query("insert into transaksi (kd_transaksi,kd_buku_besar,keterangan,debit,kredit,tgl_transaksi,username) values('$no_faktur','$kd_beban_hutang','Hutang Dealer dibayar',$bayar,0,'$tgl_bku','$username')");
				$db->execute("INSERT INTO hutang(kd_sup,debit,kredit,no_purchasing,tgl_purchasing,no_fa,tgl_fa,tgl_jt,username,tgl_transaksi,status,keterangan,kd_beban) values ('$kd_sup',$bayar,0,'$no_faktur','$tgl_pembelian','$no_fakturastra','$tgl_fa','$tgl_jt','$username','$tgl_bku','BAYAR','Hutang Dealer dibayar','$kd_beban_hutang')");
				$jumlahhutang = $db->queryUniqueValue("select sum(debit) - sum(kredit) from hutang where no_purchasing='$no_faktur'");
				if ($jumlahhutang==0)
				{
					$db->query("UPDATE hutang set status='LUNAS' where no_purchasing='$no_faktur'");
				}
				if($kasbank=="Kas")
				{
				$db->query("insert into transaksi (kd_transaksi,no_bku,kd_buku_besar,keterangan,kd_sup,debit,kredit,tgl_transaksi,username) values('$no_faktur','$no_bku','$kd_beban_kas','Kas Bayar Hutang Dealer','$kd_sup',0,$bayar,'$tgl_bku','$username')");
				$db->query("insert into kas (no_pembelian,tgl_pembelian,no_bku,tgl_keluar,kd_sup,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$no_faktur','$tgl_fa','$no_bku','$tgl_bku','$kd_sup',0,$bayar,'$kd_beban_kas','$username','$tgl_bku','Kas Bayar Hutang Dealer')");
				}
				else if ($kasbank=="Bank")
				{
				$db->query("insert into transaksi (kd_transaksi,no_bku,kd_buku_besar,keterangan,kd_sup,debit,kredit,tgl_transaksi,username) values('$no_faktur','$no_bku','$kd_beban_bank','Bank Bayar Hutang Dealer','$kd_sup',0,$bayar,'$tgl_bku','$username')");
				$db->query("insert into kas (no_pembelian,tgl_pembelian,no_bku,tgl_keluar,kd_sup,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$no_faktur','$tgl_fa','$no_bku','$tgl_bku','$kd_sup',0,$bayar,'$kd_beban_bank','$username','$tgl_bku','Bank Bayar Hutang Dealer')");	
				}
			if($bku)
			{
				echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Pembayaran Hutang untuk Pembelian [$no_faktur] sebesar [$bayar] berhasil</font></div> ";
			}				
			}
			else if($bayar>0 and $bayar>$jumlah) 
    		{
			if($bku)
			{
				echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Jumlah yang dibayar lebih besar daripada Hutang</font></div> ";
			}				
			}
		}
?>
<style type="text/css">
table.db-table 		{ border-right:1px solid #ccc; border-bottom:1px solid #ccc; }
table.db-table th	{ background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
table.db-table td	{ padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
</style>
				  <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  }
				  ?>
		<table>
                    <tr>
					  <td><div align="left"><strong>No. BKU</strong></div></td>
					  <td><input style="height: 30px;margin-top: 7px" name="no_bku" type="text" id="no_bku" value="<?php $max = $db->maxOfAll("no_bku","bku"); $maxbku = str_pad($max+1, 5, '0', STR_PAD_LEFT); echo $maxbku; ?>"></td>
					</tr>
					<tr>
					  <td><div align="left"><strong>Tanggal BKU</strong></div></td>
					  <td><input style="height: 30px;margin-top: 7px" type="text" id="tgl_bku" name="tgl_bku" value="<?php echo date('d-m-Y');?>" style="width:80px"></td>
                    </tr>
					  <tr>
					  <td><div align="left"><strong>Kas/Bank</strong></div></td>
					  <td><select style="height: 30px;margin-top: 7px;width:206px" id="kasbank" name="kasbank">
						<option value="Kas">Kas</option>
						<option value="Bank">Bank</option>
					  </select>
					  </tr>
					  <tr>
					  <td><div align="left"><strong>Tanggal Kas/Bank</strong></div></td>
					  <td><input style="height: 30px;margin-top: 7px" type="text" id="tgl_kasbank" name="tgl_kasbank" value="<?php echo date('d-m-Y');?>" style="width:80px"></td>
                      </tr>
				   </table>
					<table class="db-table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th style="width:10px">No</th>
						<th style="width:30px">No. Pembelian</th>
						<th style="width:30px">No. Faktur Astra</th>
						<th style="width:30px">Tgl. Faktur</th>
						<th style="width:50px">Jatuh Tempo</th>
						<th style="width:50px">Hutang</th>
						<th style="width:50px">Bayar</th>
						<th style="width:50px">Biaya Bunga</th>
						<th style="width:50px">Biaya Denda</th>
						<th style="width:40px">Aksi</th>
					</tr>
					</thead>
					<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 5; // jumlah data yg ditampilkan perhalaman
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  }
        $jml_data = mysql_num_rows(mysql_query("SELECT * from hutang where status='BELUM' and fee<>1 and bbn<>1 and ppn<>1"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mysql_query("
                SELECT * from hutang where status='BELUM' and fee<>1 and bbn<>1 and ppn<>1
                AND no_penjualan LIKE '%$kunci%'
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mysql_query("SELECT * from hutang where status='BELUM' and fee<>1 and bbn<>1 and ppn<>1 LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mysql_query("SELECT * from hutang where status='BELUM' and fee<>1 and bbn<>1 and ppn<>1 LIMIT 0, $jml_per_halaman");
            $halaman = 1; //tambahan
        }
        while($data = mysql_fetch_array($query)) {
					$kd_sup=$db->queryUniqueValue("select kd_sup from trbeli where no_purchasing='".$data['NO_PURCHASING']."'");
					$balance=$db->queryUniqueValue("select sum(kredit) - sum(debit) from hutang where no_purchasing='".$data['NO_PURCHASING']."'");
					// tampilkan data mahasiswa selama masih ada
    ?>
		<tr>
					        <td><?php echo $i ?></td>
							<input id="kd_sup<?php echo $i ?>" name="kd_sup<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:130px" type="hidden" value="<?php echo $kd_sup ?>" readonly="">
							<td><input id="no_faktur<?php echo $i ?>" name="no_faktur<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:130px" type="text" value="<?php echo $data['NO_PURCHASING'] ?>" readonly=""></td>
							<td><input id="no_fakturastra<?php echo $i ?>" name="no_fakturastra<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:130px" type="text" value="<?php echo $data['NO_FA'] ?>" readonly=""></td>
							<td><input id="tgl_fa<?php echo $i ?>" name="tgl_fa<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:100px" type="text" value="<?php echo date('Y-m-d', strtotime(str_replace('-','/', $data['TGL_FA']))) ?>" readonly=""></td>
							<td><input id="tgl_jt<?php echo $i ?>" name="tgl_jt<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:100px" type="text" value="<?php echo date('Y-m-d', strtotime(str_replace('-','/', $data['TGL_JT']))) ?>" readonly=""></td>
							<td class="jatuhtempo" style='display:none'><?php echo $data['TGL_JT']?></td>
							<td><input id="jumlah<?php echo $i ?>" name="jumlah<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:110px" type="text" value="<?php echo $balance?>" readonly=""></td>
							<td><input id="bayar<?php echo $i ?>" name="bayar<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:110px" type="text" value=""></td>
							<td><input id="biaya_bunga<?php echo $i ?>" name="biaya_bunga<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:110px" type="text" value=""></td>
							<td><input id="biaya_denda<?php echo $i ?>" name="biaya_denda<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:110px" type="text" value=""></td>
							<td><input type="submit" style="height:30px;width:50px;" <?php if($data['STATUS']=="LUNAS"){ echo "disabled=disabled";}else {echo "";}?> name="bayarhutang<?php echo $i ?>" onclick="bayarhutang(this.name)" value="Bayar"></td>
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
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_bku'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('tgl_kasbank'),
		format : "DD-MM-YYYY",
    });
</script>