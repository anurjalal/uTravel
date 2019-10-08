<?php include 'base.php' ?>
<?php startblock('konten') ?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript">
	function terimaleasing(value)
	{
		var counter = value.match(/\d+/);
		var idleasing = $("#idleasing").val();
		var no_kwt = $("#no_kwt").val();
		var tgl_kwt = $("#tgl_kwt").val();
		var leasing = $("#leasing").val();
		var jenis = document.getElementById("kasbank");
		var kasbank = jenis.options[jenis.selectedIndex].text;
		var tgl_kasbank = $("#tgl_kasbank").val();
		var nonota = $("#nonota"+counter).val();
		var namacustomer = $("#namacustomer"+counter).val();
		var kodecustomer = $("#kodecustomer"+counter).val();
		var piutang = $("#piutang"+counter).val();
		window.open("kwitansilease.php?id="+idleasing+"&baris="+counter+"&no_kwt="+no_kwt+"&tgl_kwt="+tgl_kwt+"&leasing="+leasing+"&kasbank="+kasbank+"&tgl_kasbank="+tgl_kasbank+"&nonota="+nonota+"&namacustomer="+namacustomer+"&kodecustomer="+kodecustomer+"&piutang="+piutang);
	}
</script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.min.js"></script>


<?php
 		$id=$_GET['id'];
		if (!empty($_GET['baris']) && is_string($_GET['baris']))
		{
			$baris = $_GET['baris'];
			$no_kwt = $_GET['no_kwt'];
			$tgl_kwt = $_GET['tgl_kwt'];
			$tgl_kwt = strtotime($tgl_kwt);
			$tgl_kwt = date('Y-m-d H:i:s', $tgl_kwt);
			$leasing = $_GET['leasing'];
			$kd_lease = $db->queryUniqueValue("select kd_lease from mstlease where nm_lease='$leasing'");
			$kasbank = $_GET['kasbank'];
			$tgl_kasbank = $_GET['tgl_kasbank'];
			$tgl_kasbank = strtotime($tgl_kasbank);
			$tgl_kasbank = date('Y-m-d H:i:s', $tgl_kasbank);
			$kd_jual = 'KREDIT';
			$nonota = $_GET['nonota'];
			$namacustomer = $_GET['namacustomer'];
			$kodecustomer = $_GET['kodecustomer'];
			$piutang = $_GET['piutang'];
			$username = $_SESSION['LOGIN_NAME'];
			$uangmuka = $db->queryUniqueValue("select uangmuka from leasing where no_nota='$nonota'");
			if($piutang>0) 
    		{
		    	$kwitansi = $db->query("insert into kwitansi (no_kwt,tgl_kwt,nama,leasing,kas_bank,tgl_kb,kd_jual,no_penjualan,jumlah,username) values('$no_kwt','$tgl_kwt','$namacustomer','$leasing','$kasbank','$tgl_kasbank','$kd_jual','$nonota','$piutang','$username')");
				$db->query("UPDATE leasing set status='LUNAS' where no_nota='$nonota'");
				$db->query("insert into transaksi (kd_transaksi,kd_buku_besar,keterangan,leasing,no_rangka,no_mesin,debit,kredit,tgl_transaksi,username) values('$nonota',4,'Piutang dibayar Leasing','$leasing','$norangka','$nomesin',0,$piutang,NOW(),'$username')");
				$db->query("INSERT INTO piutang(kd_lease,debit,kredit,kd_tipe,no_rangka,no_mesin,no_penjualan,username,tgl_transaksi,keterangan) values ('$kd_lease',0,$piutang,'$kdtipe1','$norangka','$nomesin','$nonota','$username',NOW(),'Piutang dibayar Leasing')");
				if($kasbank=="Kas")
				{
				$db->query("insert into transaksi (kd_transaksi,no_kwt,kd_buku_besar,keterangan,kd_sales,no_rangka,no_mesin,debit,kredit,tgl_transaksi,username) values('$nonota','$no_kwt',1,'Uang Kas dari Pembayaran Leasing','$kd_sales','$norangka','$nomesin',$piutang,0,NOW(),'$username')");
				$db->query("insert into kas (no_penjualan,no_kwt,tgl_masuk,kd_tipe,no_rangka,no_mesin,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$nonota','$no_kwt','$tgl_kwt','$kd_tipe','$norangka','$nomesin',$piutang,0,1,'$username',NOW(),'Uang Kas dari Pembayaran Leasing')");
				if($uangmuka>0)
				{
				$db->query("insert into transaksi (kd_transaksi,no_kwt,kd_buku_besar,keterangan,kd_sales,no_rangka,no_mesin,debit,kredit,tgl_transaksi,username) values('$nonota','$no_kwt',1,'Pengembalian Uang Muka Leasing','$kd_sales','$norangka','$nomesin',0,$uangmuka,NOW(),'$username')");
				$db->query("insert into kas (no_penjualan,no_kwt,tgl_masuk,kd_tipe,no_rangka,no_mesin,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$nonota','$no_kwt','$tgl_kwt','$kd_tipe','$norangka','$nomesin',0,$uangmuka,1,'$username',NOW(),'Pengembalian Uang Muka Leasing')");	
				}
				}
				elseif ($kasbank=="Bank")
				{
				$db->query("insert into transaksi (kd_transaksi,no_kwt,kd_buku_besar,keterangan,kd_sales,no_rangka,no_mesin,debit,kredit,tgl_transaksi,username) values('$nonota','$no_kwt',2,'Uang Bank dari Pembayaran Leasing','$kd_sales','$norangka','$nomesin',$piutang,0,NOW(),'$username')");
				$db->query("insert into kas (no_penjualan,no_kwt,tgl_masuk,kd_tipe,no_rangka,no_mesin,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$nonota','$no_kwt','$tgl_kwt','$kd_tipe','$norangka','$nomesin',$piutang,0,2,'$username',NOW(),'Uang Bank dari Pembayaran Leasing')");
				if($uangmuka>0)
				{
				$db->query("insert into transaksi (kd_transaksi,no_kwt,kd_buku_besar,keterangan,kd_sales,no_rangka,no_mesin,debit,kredit,tgl_transaksi,username) values('$nonota','$no_kwt',2,'Pengembalian Uang Muka Leasing','$kd_sales','$norangka','$nomesin',0,$uangmuka,NOW(),'$username')");
				$db->query("insert into kas (no_penjualan,no_kwt,tgl_masuk,kd_tipe,no_rangka,no_mesin,debit,kredit,kd_beban,username,tgl_transaksi,keterangan) values('$nonota','$no_kwt','$tgl_kwt','$kd_tipe','$norangka','$nomesin',0,$uangmuka,2,'$username',NOW(),'Pengembalian Uang Muka Leasing')");	
				}
				}				
			}
			if($kwitansi)
			{
			echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Pembayaran Customer [$namacustomer] dari Leasing [$leasing] sebesar [$piutang] berhasil</font></div> ";
			echo "<script>window.open('kuitansileasing.php?id=$no_kwt');</script>";
			}

		}
?>
<style type="text/css">
table.db-table 		{ border-right:1px solid #ccc; border-bottom:1px solid #ccc; }
table.db-table th	{ background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
table.db-table td	{ padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
</style> 
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="salesform" method="post" id="form1" action="" onSubmit="updateTotaldiskon()" >
    <p align="center"><strong>Kwitansi Penerimaan</strong></p>
				  <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  }
				?>
		<input name="idleasing" type="hidden" id="idleasing" value="<?php echo $id; ?>" readonly="">
		<table>
                    <tr>
					  <td><div align="left"><strong>No. Kwitansi</strong></div></td>
					  <td><input style="height: 30px;margin-top: 7px" name="no_kwt" type="text" id="no_kwt" value="<?php $max = $db->maxOfAll("no_kwt","kwitansi"); $maxkwt = str_pad($max+1, 5, '0', STR_PAD_LEFT); if($no_kwt==0){echo $maxkwt;} else{echo $no_kwt;} ?>"></td>
					</tr>
					<tr>
					  <td><div align="left"><strong>Tanggal Kwitansi</strong></div></td>
					  <td><input style="height: 30px;margin-top: 7px" type="text" id="tgl_kwt" name="tgl_kwt" value="<?php echo date('d-m-Y');?>" style="width:80px"></td>
                    </tr>
					<?php
				      $nm_lease = $db->queryUniqueValue("SELECT nm_lease from mstlease WHERE kd_lease='$id'");
				      $line2 = $db->queryUniqueObject("SELECT * FROM leasing WHERE kd_lease='$id'");			
					  
				    ?>
					<tr>
                      <td><div align="left"><strong>Leasing</strong></td>
                      <td><input style="height: 30px;margin-top: 7px" name="leasing" type="text" id="leasing" value="<?php echo $nm_lease; ?>" readonly="">
					</tr>
					  <tr>
					  <td><div align="left"><strong>Kas/Bank</strong></div></td>
					  <td><select style="height: 30px;margin-top: 7px;width:206px" id="kasbank" name="kasbank">
						<option value="Kas">Kas</option>
						<option value="Bank">Transfer Bank</option>
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
						<th style="width:30px">No. Penjualan</th>
						<th style="width:50px">Tanggal Penjualan</th>
						<th style="width:50px">Nama Customer</th>
						<th style="width:50px">Piutang</th>
						<th style="width:40px">Aksi</th>
					</tr>
					</thead>
					<tbody>
					<?php 
					$query=mysql_query("SELECT distinct(t.no_nota),l.no_nota as NO_NOTA,l.tgl_kredit as TGL_KREDIT,l.kd_cust as KD_CUST,l.jumlah as PIUTANG from leasing l left join trjual t on t.no_nota=l.no_nota where l.kd_lease='$id' and l.status='BELUM'");
					$i = 1;
					while($data = mysql_fetch_assoc($query)) {
					$namacust = $db->queryUniqueValue("select nm_cust from mstcust where kd_cust='".$data['KD_CUST']."'");
					$lunas = $db->queryUniqueValue("select status from leasing where no_nota='".$data['NO_NOTA']."'");
					?>
					<tr>
					        <td><?php echo $i ?></td>
							<td><input id="nonota<?php echo $i ?>" name="nonota<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:130px" type="text" value="<?php echo $data['NO_NOTA'] ?>" readonly=""></td>
							<td><input id="tglkredit<?php echo $i ?>" name="tglkredit<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:100px" type="text" value="<?php echo date('Y-m-d', strtotime(str_replace('-','/', $data['TGL_KREDIT']))) ?>" readonly=""></td>
							<td><input id="namacustomer<?php echo $i ?>" name="namacustomer<?php echo $i ?>" style="height: 30px;margin-top: 7px" type="text" value="<?php echo $namacust?>" readonly=""></td>
							<input id="kodecustomer<?php echo $i ?>" name="kodecustomer<?php echo $i ?>" style="height: 30px;margin-top: 7px" type="hidden" value="<?php echo $data['KD_CUST']?>" readonly="">
							<td><input id="piutang<?php echo $i ?>" name="piutang<?php echo $i ?>" style="height: 30px;margin-top: 7px;width:110px" type="text" value="<?php echo $data['PIUTANG']?>" readonly=""></td>
							<td><input type="submit" style="height:30px;width:60px;" <?php if($lunas=="LUNAS"){ echo "disabled=disabled";}else {echo "";}?> name="terimaleasing<?php echo $i ?>" onclick="terimaleasing(this.name)" value="Terima"></td>
					</tr>
					<?php
					$i++;
					}
					?>
					</tbody>
					</table>
               </form>
			  </td>
             </tr>
            </table>
<?php endblock() ?>
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_kwt'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('tgl_kasbank'),
		format : "DD-MM-YYYY",
    });
</script>