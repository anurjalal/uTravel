<?php
session_start();
if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Administrator'){
include 'base.php'; }
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Sales'){
include 'basesales.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Kasir'){
include 'basekasir.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Finance'){
include 'basefinance.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Warehouse'){
include 'basewarehouse.php';}
?>
<?php startblock('konten') ?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
function updateTotaldiskon()
{
	var chk_arr =  document.getElementsByName("ceklist[]");
	var piutangtotal = $("#piutangtotal").val();
	var chklength = chk_arr.length;
	var total_piutang = 0;
	for (i=1;i<=chklength;i=i+1)
		{
			var jml_piutang = "#jml_piutang"+i;
			var ceklist = "ceklist"+i;
			var checkbox = document.getElementById(ceklist);
			if (checkbox.checked==true)
			{
			checkbox.value=1;
			total_piutang = total_piutang + parseFloat($(jml_piutang).val());
			}
		}
	var piutang_sekarang = piutangtotal - total_piutang;
	$("#piutang_sekarang").val(piutang_sekarang);
}
</script>
<script type="text/javascript" src="lib/jquery-latest.js"></script>


<?php
if(isset($_POST['piutang_sekarang']))
	{
		$id_customer=mysql_real_escape_string($_POST['idcustomer']);
		$nama_customer = $db->queryUniqueValue("select nama_customer from customer where id_customer='$id_customer'");
		$piutang_sekarang=mysql_real_escape_string($_POST['piutang_sekarang']);
		$dibayar_dengan=mysql_real_escape_string($_POST['dibayar_dengan']);
		$username = $_SESSION['LOGIN_NAME'];
		$kd_beban_kas = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Kas'");
		$kd_beban_bank = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Bank'");
		$kd_beban_piutang = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Piutang'");
		$i=0;
		$j = 1;
		$no_penjualan_line=$_POST['no_penjualan'];
		$no_piutang_skrng = $db->queryUniqueValue("select max(no_piutang) from piutang");
		foreach($no_penjualan_line as $no_penjualan)
		{
		$ceklist=$_POST['ceklist'][$i];
		if ($ceklist==1)
		{
		$no_piutang = $no_piutang_skrng + $j;			
		$no_penjualan=$_POST['no_penjualan'][$i];
		$tgl_penjualan=$_POST['tgl_penjualan'][$i];
		$tgl_penjualan = strtotime($tgl_penjualan);
		$tgl_penjualan = date('Y-m-d H:i:s', $tgl_penjualan);
		$no_invoice=$_POST['no_invoice'][$i];
		$jml_piutang=$_POST['jml_piutang'][$i];
		if ($no_invoice!='')
		{
		$db->execute("UPDATE penjualan set no_invoice='$no_invoice',tgl_invoice=NOW(),statusdibayar='LUNAS',tgl_dibayar=NOW() where no_penjualan='$no_penjualan'");
		}
		else
		{
		$db->execute("UPDATE penjualan set statusdibayar='LUNAS',tgl_dibayar=NOW() where no_penjualan='$no_penjualan'");			
		}
		if($dibayar_dengan=="Kas")
		{
		if($piutang_sekarang>=0)
		{
		$no_kas = 'K.' . $no_piutang . 'TERIMAPIUTANG';
		$keterangan = 'Penerimaan Piutang ke ' . $nama_customer . ' untuk No. Penjualan ' . $no_penjualan;
		$db->query("insert into kas (no_kas,no_piutang,tgl_masuk,keterangan,kd_beban,debit,username,tgl_transaksi) values('$no_kas','$no_piutang',NOW(),'$keterangan','$kd_beban_kas',$jml_piutang,'$username',NOW())");		
		$db->execute("INSERT INTO piutang(no_piutang,no_penjualan,tgl_penjualan,id_customer,nama_customer,kredit,username,tgl_transaksi) values ('$no_piutang','$no_penjualan','$tgl_penjualan','$id_customer','$nama_customer',$jml_piutang,'$username',NOW())");				
		$db->execute("UPDATE piutang set status='LUNAS',username='$username',tgl_transaksi=NOW() where no_penjualan='$no_penjualan'");		
		}
		}
		else if ($dibayar_dengan=="Bank")
		{
		if($piutang_sekarang>=0)
		{
		$no_kas = 'K.' . $no_piutang . 'TERIMAPIUTANG';
		$keterangan = 'Penerimaan Piutang ke ' . $nama_customer . ' untuk No. Penjualan ' . $no_penjualan;
		$db->query("insert into kas (no_kas,no_piutang,tgl_masuk,keterangan,kd_beban,debit,username,tgl_transaksi) values('$no_kas','$no_piutang',NOW(),'$keterangan','$kd_beban_bank',$jml_piutang,'$username',NOW())");		
		$db->execute("INSERT INTO piutang(no_piutang,no_penjualan,tgl_penjualan,id_customer,nama_customer,kredit,username,tgl_transaksi) values ('$no_piutang','$no_penjualan','$tgl_penjualan','$id_customer','$nama_customer',$jml_piutang,'$username',NOW())");				
		$db->execute("UPDATE piutang set status='LUNAS',username='$username',tgl_transaksi=NOW() where no_penjualan='$no_penjualan'");		
		}			
		}
		}

		$i++;
		$j++;
		}
		echo "<script>window.location.assign('formpiutang.php');</script>";
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="penerimaanpiutang" method="post" action="">
	<p align="center"><strong><font size="3">Penerimaan Piutang</strong></font></p>
				  <?php
					if(isset($_POST['id_customer']))
					{
					$id_customer=mysql_real_escape_string($_POST['id_customer']);
					$nama_customer = $db->queryUniqueValue("select nama_customer from customer where id_customer='$id_customer'");
					$piutang = $db->queryUniqueValue("select sum(debit) - sum(kredit) from piutang where id_customer='".$id_customer."'");
					?>
					<input type="hidden" value="<?php echo $piutang?>" id="piutangtotal" name="piutangtotal">
					<input type="hidden" value="<?php echo $id_customer?>" id="idcustomer" name="idcustomer">
					<?php
					$no_invoice = $db->queryUniqueValue("select max(no_invoice) from penjualan");
					$db->query("SELECT * FROM piutang WHERE id_customer='$id_customer' and kredit=0 and status!='LUNAS'");
					$i = 1;
					while ($line_piutang = $db->fetchNextObject()) {
					$no_invoice_lama = $db->queryUniqueValue("select no_invoice from penjualan where no_penjualan='".$line_piutang->no_penjualan."'");					
					?>
		    <p align="center">
				<table>
		            <tr>
								<td><div align="left"><strong>No. Penjualan</strong></div></td>
								<td><input style="height: 30px;width: 50px;margin-bottom: 0px" type="text" id="no_penjualan<?php echo $i?>" class="no_penjualan<?php echo $i?>"  name="no_penjualan[]" value="<?php echo $line_piutang->no_penjualan; ?>"></td>
								<td><div align="left" style="margin-left: 20px"><strong>Tgl Penjualan</strong></div></td>
								<td><input style="height: 30px;width: 100px;margin-bottom: 0px" type="text" id="tgl_penjualan<?php echo $i?>" class="tgl_penjualan<?php echo $i?>"  name="tgl_penjualan[]" value="<?php echo date('d-m-Y',strtotime($line_piutang->tgl_penjualan)) ?>"></td>
								<td><div align="left"><strong>Tgl Jatuh Tempo</strong></div></td>
								<td><input style="height: 30px;width: 100px;margin-bottom: 0px" type="text" id="tgl_jatuh_tempo<?php echo $i?>" class="tgl_jatuh_tempo<?php echo $i?>" name="tgl_jatuh_tempo[]" value="<?php echo date('d-m-Y',strtotime($line_piutang->tgl_jatuh_tempo)); ?>"></td>								
								<td><div align="left" style="margin-left: 20px"><strong>Jumlah Piutang</strong></div></td>
								<td><input style="height: 30px;width: 100px;margin-bottom: 0px" type="text" id="jml_piutang<?php echo $i?>" class="jml_piutang<?php echo $i?>" name="jml_piutang[]" value="<?php echo $line_piutang->jml_piutang; ?>"></td>					
								<td><div align="left" style="margin-left: 20px"><strong>No. Invoice</strong></div></td>
								<td><input style="height: 30px;width: 60px;margin-bottom: 0px" id="no_invoice<?php echo $i?>" class="no_invoice<?php echo $i?>" name="no_invoice[]" type="text" value="<?php if($no_invoice_lama!='') {echo $no_invoice_lama;} else {echo $no_invoice;$no_invoice++;}?>"></td>								
								<td><input style="margin-top: 0px;margin-bottom: 3px;width: 30px;height: 30px;" onclick="updateTotaldiskon()" type="checkbox" id="ceklist<?php echo $i?>" class="ceklist<?php echo $i?>" name="ceklist[]"><strong>Bayar</strong></input></td>
		            </table>
				   </p>
				  <?php $i++;$no_invoice++;} } ?>
				  <div class="container">
					<p align="center" class="penerimaanpiutang">
						<table>
						<tr>
							<td><div align="left"><strong>Tanggal Pembayaran</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="tgl_pembayaran" class="tgl_pembayaran" name="tgl_pembayaran" type="text" value="<?php echo date('d-m-Y');?>"></td>
							<td><div align="left" style="margin-left: 20px"><strong>Pembayaran dengan</strong></div></td>
							<td>
							<select style="height: 30px;margin-bottom: 0px;text-align:right" name="dibayar_dengan" id="dibayar_dengan" class="dibayar_dengan" required>
							<option value="">Tidak ada</option>
							<option value="Kas">Kas</option>
							<option value="Bank">Bank</option>
							</select>
							</td>							
						</tr>
					  </table>
					  </p>
					  </div>
					  <br/>
						<p align="center">
							<table>
							<tr>
								<td><strong>Piutang Sekarang</strong></td>
								<td><input style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="piutang_sekarang" id="piutang_sekarang" type="text" readonly value="<?php echo $piutang;?>"></td>
							</tr>                    
						</table>
                        <br>
						<table>
                            <br>
					  <tr>
              <td><input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("formpiutang.php");'></td>
              <td><input type="button" style="height:50px;width:100px" name="Reset" value="Reset" onclick='window.location.reload(true);'></td>
			  <td><input type="submit" style="height:50px;width:100px" name="Submit" value="Save" ></td>
					  </tr>
					</table>
				</p>
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
		field: document.getElementById('tgl_pembayaran1'),
		format : "DD-MM-YYYY",
		});
    var picker = new Pikaday({
        field: document.getElementById('tgl_penjualan'),
		format : "DD-MM-YYYY",
		});
</script>
