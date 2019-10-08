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
	var hutangtotal = $("#hutangtotal").val();
	var chklength = chk_arr.length;
	var total_hutang = 0;
	for (i=1;i<=chklength;i=i+1)
		{
			var jml_hutang = "#jml_hutang"+i;
			var ceklist = "ceklist"+i;
			var checkbox = document.getElementById(ceklist);
			if (checkbox.checked==true)
			{
			checkbox.value=1;
			total_hutang = total_hutang + parseFloat($(jml_hutang).val());
			}
		}
	var hutang_sekarang = hutangtotal - total_hutang;
	$("#hutang_sekarang").val(hutang_sekarang);
}

</script>
<script type="text/javascript" src="lib/jquery-latest.js"></script>


<?php
if(isset($_POST['hutang_sekarang']))
	{
		$id_supplier=mysql_real_escape_string($_POST['idsupplier']);
		$nama_supplier = $db->queryUniqueValue("select nama_supplier from supplier where id_supplier='$id_supplier'");
		$hutang_sekarang=mysql_real_escape_string($_POST['hutang_sekarang']);
		$dibayar_dengan=mysql_real_escape_string($_POST['dibayar_dengan']);
		$username = $_SESSION['LOGIN_NAME'];
		$kd_beban_kas = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Kas'");
		$kd_beban_bank = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Bank'");
		$kd_beban_hutang = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Hutang Dagang'");
		$i=0;
		$no_po_line=$_POST['no_po'];
		$j = 1;
		$no_hutang_skrng = $db->queryUniqueValue("select max(no_hutang) from hutang");
		foreach($no_po_line as $no_po)
		{
		$ceklist=$_POST['ceklist'][$i];
		if ($ceklist==1)
		{
		$no_hutang = $no_hutang_skrng + $j;			
		$no_po=$_POST['no_po'][$i];
		$tgl_po=$_POST['tgl_po'][$i];
		$tgl_po = strtotime($tgl_po);
		$tgl_po = date('Y-m-d H:i:s', $tgl_po);
		$no_invoice=$_POST['no_invoice'][$i];
		$jml_hutang=$_POST['jml_hutang'][$i];
		if ($no_invoice!='')
		{
		$db->execute("UPDATE pembelian set no_invoice='$no_invoice',tgl_invoice=NOW(),statusdibayar='LUNAS',tgl_dibayar=NOW() where no_po='$no_po'");
		}
		else
		{
		$db->execute("UPDATE pembelian set statusdibayar='LUNAS',tgl_dibayar=NOW() where no_po='$no_po'");
		}		
		if($dibayar_dengan=="Kas")
		{
		if($hutang_sekarang>=0)
		{
		$no_kas = 'K.' . $no_hutang . 'BAYARHUTANG';
		$keterangan = 'Pembayaran Hutang ke ' . $nama_supplier . ' untuk No. PO ' . $no_po;
		$db->query("insert into kas (no_kas,no_hutang,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_hutang',NOW(),'$keterangan','$kd_beban_kas',$jml_hutang,'$username',NOW())");
		$db->execute("INSERT INTO hutang(no_hutang,no_po,tgl_po,id_supplier,nama_supplier,debit,username,tgl_transaksi) values ('$no_hutang','$no_po','$tgl_po','$id_supplier','$nama_supplier',$jml_hutang,'$username',NOW())");		
		$db->execute("UPDATE hutang set status='LUNAS',username='$username',tgl_transaksi=NOW() where no_po='$no_po'");		
		}
		}
		else if ($dibayar_dengan=="Bank")
		{
		if($hutang_sekarang>=0)
		{
		$no_kas = 'K.' . $no_hutang . 'BAYARHUTANG';
		$keterangan = 'Pembayaran Hutang ke ' . $nama_supplier . ' untuk No. PO ' . $no_po;
		$db->query("insert into kas (no_kas,no_hutang,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_hutang',NOW(),'$keterangan','$kd_beban_bank',$jml_hutang,'$username',NOW())");
		$db->execute("INSERT INTO hutang(no_hutang,no_po,tgl_po,id_supplier,nama_supplier,debit,username,tgl_transaksi) values ('$no_hutang','$no_po','$tgl_po','$id_supplier','$nama_supplier',$jml_hutang,'$username',NOW())");
		$db->execute("UPDATE hutang set status='LUNAS',username='$username',tgl_transaksi=NOW() where no_po='$no_po'");		
		}			
		}
		}

		$i++;
		$j++;
		}
		echo "<script>window.location.assign('formhutang.php');</script>";
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="pembayaranhutang" method="post" action="">
	<p align="center"><strong><font size="3">Pembayaran Hutang</strong></font></p>
				  <?php
				  if(isset($_POST['id_supplier']))
				  {
					$id_supplier=mysql_real_escape_string($_POST['id_supplier']);
					$nama_supplier = $db->queryUniqueValue("select nama_supplier from supplier where id_supplier='$id_supplier'");
					$hutang = $db->queryUniqueValue("select sum(kredit) - sum(debit) from hutang where id_supplier='".$id_supplier."'");
					?>
					<input type="hidden" value="<?php echo $hutang?>" id="hutangtotal" name="hutangtotal">
					<input type="hidden" value="<?php echo $id_supplier?>" id="idsupplier" name="idsupplier">
					<?php
					//$no_invoice = $db->queryUniqueValue("select max(no_invoice) from pembelian");
					$db->query("SELECT * FROM hutang WHERE id_supplier='$id_supplier' and debit=0 and status!='LUNAS'");
					$i = 1;
					while ($line_hutang = $db->fetchNextObject()) {
					$no_invoice = $db->queryUniqueValue("select no_invoice from pembelian where no_po='".$line_hutang->no_po."'");
					?>
		    <p align="center">
				<table>
		            <tr>
								<td><div align="left"><strong>No. PO</strong></div></td>
								<td><input style="height: 30px;width: 50px;margin-bottom: 0px" type="text" id="no_po<?php echo $i?>" class="no_po<?php echo $i?>"  name="no_po[]" value="<?php echo $line_hutang->no_po; ?>"></td>
								<td><div align="left" style="margin-left: 20px"><strong>Tgl PO</strong></div></td>
								<td><input style="height: 30px;width: 100px;margin-bottom: 0px" type="text" id="tgl_po<?php echo $i?>" class="tgl_po<?php echo $i?>"  name="tgl_po[]" value="<?php echo date('d-m-Y',strtotime($line_hutang->tgl_po)) ?>"></td>
								<td><div align="left"><strong>Tgl Jatuh Tempo</strong></div></td>
								<td><input style="height: 30px;width: 100px;margin-bottom: 0px" type="text" id="tgl_jatuh_tempo<?php echo $i?>" class="tgl_jatuh_tempo<?php echo $i?>" name="tgl_jatuh_tempo[]" value="<?php echo date('d-m-Y',strtotime($line_hutang->tgl_jatuh_tempo)); ?>"></td>								
								<td><div align="left" style="margin-left: 20px"><strong>Jumlah Hutang</strong></div></td>
								<td><input style="height: 30px;width: 100px;margin-bottom: 0px" type="text" id="jml_hutang<?php echo $i?>" class="jml_hutang<?php echo $i?>" name="jml_hutang[]" value="<?php echo $line_hutang->jml_hutang; ?>"></td>					
								<td><div align="left" style="margin-left: 20px"><strong>No. Invoice</strong></div></td>
								<td><input style="height: 30px;width: 60px;margin-bottom: 0px" id="no_invoice<?php echo $i?>" class="no_invoice<?php echo $i?>" name="no_invoice[]" type="text" value="<?php echo $no_invoice;?>"></td>								
								<td><input style="margin-top: 0px;margin-bottom: 3px;width: 30px;height: 30px;" onclick="updateTotaldiskon()" type="checkbox" id="ceklist<?php echo $i?>" class="ceklist<?php echo $i?>" name="ceklist[]"><strong>Bayar</strong></input></td>
		            
					</tr>
		            </table>
				   </p>
				  <?php $i++;//$no_invoice++;
				  } } ?>
				  <div class="container">
					<p align="center" class="pembayaranhutang">
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
								<td><strong>Hutang Sekarang</strong></td>
								<td><input style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="hutang_sekarang" id="hutang_sekarang" type="text" readonly value="<?php echo $hutang;?>"></td>
							</tr>
                                
                                
						</table>
                        <br>
						<table>
					  <tr>
              <td><input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("formhutang.php");'></td>
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
        field: document.getElementById('tgl_po'),
		format : "DD-MM-YYYY",
    });
</script>
