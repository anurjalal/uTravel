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
	var counter = $('.pembayaranhutang').length;
	var hutang = $('#jumlah_hutang').val();
	var total_hutang = 0;
	for (i=1;i<=counter;i=i+1)
		{
			var jumlah_yg_dibayar = "#jumlah_yg_dibayar"+i;

			total_hutang = total_hutang + parseFloat($(jumlah_yg_dibayar).val());
		}
	var hutang_sekarang = hutang - total_hutang;
	$("#hutang_sekarang").val(hutang_sekarang);
}

</script>
<script type="text/javascript" src="lib/jquery-latest.js"></script>
<script type="text/javascript">
		jQuery(document).ready(function($){
		updateTotaldiskon();
		});
</script>

<?php
        
if(isset($_POST['hutang_sekarang']))
	{
        $no_po = $_GET['id'];
		$id_supplier=mysql_real_escape_string($_POST['idsupplier']);
		$nama_supplier=mysql_real_escape_string($_POST['nama_supplier']);
		$jumlah_hutang=mysql_real_escape_string($_POST['jumlah_hutang']);
		$hutang_sekarang=mysql_real_escape_string($_POST['hutang_sekarang']);
		$username=$_SESSION['LOGIN_NAME'];
		$kd_beban_kas=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Kas'");
		$kd_beban_bank=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Bank'");
		$kd_beban_biaya_bunga=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Biaya Bunga'");
		$kd_beban_biaya_denda=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Biaya Denda'");
		$kd_beban_hutang=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Hutang Dagang'");
		$tgl_pembayaran=$_POST['tgl_pembayaran'];
		$jumlah_yg_dibayar=$_POST['jumlah_yg_dibayar'];
		$biaya_bunga=$_POST['biaya_bunga'];
		$biaya_denda=$_POST['biaya_denda'];
		$dibayar_dengan=$_POST['dibayar_dengan'];
		$no_tanda_terima=$_POST['no_tanda_terima'];
		$tgl_invoice=$_POST['tgl_invoice'];
		$tgl_invoice=strtotime($tgl_invoice);
		$tgl_invoice=date('Y-m-d H:i:s', $tgl_invoice);
		$tgl_dibayar=$_POST['tgl_dibayar'];
		$tgl_dibayar=strtotime($tgl_dibayar);
		$tgl_dibayar=date('Y-m-d H:i:s', $tgl_dibayar);
		$tgl_po=$_POST['tgl_po'];
		$tgl_po=strtotime($tgl_po);
		$tgl_po=date('Y-m-d H:i:s', $tgl_po);

		$db->execute("UPDATE pembelian set statusdibayar='LUNAS',tgl_dibayar=NOW() where no_po='$no_po'");			

		$no_hutang_skrng = $db->queryUniqueValue("select max(no_hutang) from hutang");
		$no_hutang = $no_hutang_skrng + 1;
		if($dibayar_dengan=="Kas")
		{
		if($biaya_bunga>0)
		{
		$no_kas = 'K.' . $no_hutang . 'BUNGA';
		$keterangan = 'Pembayaran Biaya Bunga ke ' . $nama_supplier . ' dengan No. Hutang ' . $no_hutang;
		$db->query("insert into kas (no_kas,no_hutang,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_hutang','$tgl_dibayar','$keterangan','$kd_beban_kas',$biaya_bunga,'$username',NOW())");
		}
		if($biaya_denda>0)
		{
		$no_kas = 'K.' . $no_hutang . 'DENDA';
		$keterangan = 'Pembayaran Biaya Denda ke ' . $nama_supplier . ' dengan No. Hutang ' . $no_hutang;
		$db->query("insert into kas (no_kas,no_hutang,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_hutang','$tgl_dibayar','$keterangan','$kd_beban_kas',$biaya_denda,'$username',NOW())");
		}
		if($hutang_sekarang>=0 && $jumlah_hutang!=0)
		{
		$no_kas = 'K.' . $no_hutang . 'BAYARHUTANG';
		$keterangan = 'Pembayaran Hutang ke ' . $nama_supplier . ' dengan No. Pembelian ' . $no_po;
		$db->query("insert into kas (no_kas,no_hutang,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_hutang','$tgl_dibayar','$keterangan','$kd_beban_kas',$jumlah_yg_dibayar,'$username',NOW())");
		$db->execute("INSERT INTO hutang(no_hutang,no_po,tgl_po,id_supplier,nama_supplier,debit,username,tgl_transaksi) values ('$no_hutang','$no_po','$tgl_po','$id_supplier','$nama_supplier',$jumlah_yg_dibayar,'$username',NOW())");
		$db->execute("UPDATE hutang set status='LUNAS',username='$username',tgl_transaksi=NOW() where no_po='$no_po'");		
		
		}
		}
		else if ($dibayar_dengan=="Bank")
		{
			if($biaya_bunga>0)
			{
			$no_kas = 'K.' . $no_hutang . 'BUNGA';
			$keterangan = 'Pembayaran Biaya Bunga ke ' . $nama_supplier . ' dengan No. Hutang ' . $no_hutang;
			$db->query("insert into kas (no_kas,no_hutang,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_hutang','$tgl_dibayar','$keterangan','$kd_beban_bank',$biaya_bunga,'$username',NOW())");
			}
			if($biaya_denda>0)
			{
			$no_kas = 'K.' . $no_hutang . 'DENDA';
			$keterangan = 'Pembayaran Biaya Denda ke ' . $nama_supplier . ' dengan No. Hutang ' . $no_hutang;
			$db->query("insert into kas (no_kas,no_hutang,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_hutang','$tgl_dibayar','$keterangan','$kd_beban_bank',$biaya_denda,'$username',NOW())");
			}
			if($hutang_sekarang>=0 && $jumlah_hutang!=0)
			{
			$no_kas = 'K.' . $no_hutang . 'BAYARHUTANG';
			$keterangan = 'Pembayaran Hutang ke ' . $nama_supplier . ' dengan No. Pembelian ' . $no_po;
			$db->query("insert into kas (no_kas,no_hutang,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_hutang','$tgl_dibayar','$keterangan','$kd_beban_bank',$jumlah_yg_dibayar,'$username',NOW())");
			$db->execute("INSERT INTO hutang(no_hutang,no_po,tgl_po,id_supplier,nama_supplier,debit,username,tgl_transaksi) values ('$no_hutang','$no_po','$tgl_po','$id_supplier','$nama_supplier',$jumlah_yg_dibayar,'$username',NOW())");
			$db->execute("UPDATE hutang set status='LUNAS',username='$username',tgl_transaksi=NOW() where no_po='$no_po'");			
			}
		}
		echo "<script>window.location.assign('masteringbayarhutangpernopo.php');</script>";
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="pembayaranhutang" method="post" action="">
	<p align="center"><strong><font size="3">Pembayaran Hutang</strong></font></p>
				  <?php
					if(isset($_GET['id']))
					{
                    $no_po = $_GET['id'];
					$line= $db->queryUniqueObject("SELECT * FROM hutang WHERE no_po='$no_po'");
					$line_invoice= $db->queryUniqueObject("SELECT * FROM pembelian WHERE no_po='$no_po'");                    
					$id_supplier = $line->id_supplier;
					$hutang = $db->queryUniqueValue("select sum(kredit) - sum(debit) from hutang where no_po='".$no_po."'");
					$jml_hutang = 0;
					$query = mysql_query("SELECT hargabelitotal FROM pembelian WHERE id_supplier='".$id_supplier."' and no_po='".$no_po."'");
					$data = mysql_fetch_assoc($query);
					$jml_hutang += $data['hargabelitotal'];
				    }
					?>
		    <p align="center">
				<table>
								<input type="hidden" id= "tgl_po" name="tgl_po" value="<?php echo $line->tgl_po ; ?>">
								<input type="hidden" id= "idsupplier" name="idsupplier" value="<?php echo $id_supplier ; ?>">

		            <tr>
								<td><div align="left"><strong>Nama Supplier</strong></div></td>
								<td><input style="height: 30px;margin-bottom: 0px" type="text" id="nama_supplier" class="nama_supplier"  name="nama_supplier" value="<?php echo $line->nama_supplier; ?>" required></td>
		            </tr>
					<tr>
								<td><div align="left"><strong>Jumlah Hutang</strong></div></td>
								<td><input style="height: 30px;margin-bottom: 0px" name="jumlah_hutang" type="text" id="jumlah_hutang" value="<?php echo $hutang; ?>" readonly></td>
					</tr>
		            </table>
				   </p>
				  <div class="container">
					<p align="center" class="pembayaranhutang">
						<table>
							<tr>
							<div align="center"><td><strong>Jumlah yang dibayarkan</strong></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="jumlah_yg_dibayar1" class="jumlah_yg_dibayar1" name="jumlah_yg_dibayar" type="text" value="<?php echo $jml_hutang;?>" onBlur="updateTotaldiskon()"></td></div>
							</tr>
							<tr>
							<td><div align="left"><strong>Biaya Bunga</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="biaya_bunga1" class="biaya_bunga1" name="biaya_bunga" type="text" value="0"></td>
							<td><div align="left" style="margin-left: 20px"><strong>Biaya Denda</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="biaya_denda1" class="biaya_denda1" name="biaya_denda" type="text" value="0"></td>
						</tr>
						<tr>
							<td><div align="left"><strong>Pembayaran dengan</strong></div></td>
							<td>
							<select style="height: 30px;margin-bottom: 0px;text-align:right" name="dibayar_dengan" id="dibayar_dengan1" class="dibayar_dengan1" required>
							<option value="">Tidak ada</option>
							<option value="Kas">Kas</option>
							<option value="Bank">Bank</option>
							</select>
							</td>
							<td><div align="left" style="margin-left: 20px"><strong>Tgl. Dibayar</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="tgl_dibayar1" class="tgl_dibayar1" name="tgl_dibayar" type="text" value="<?php echo date('d-m-Y');?>"></td>
						</tr>
						<tr>
							<td><div align="left" style="margin-left: 20px"><strong>Tgl. Invoice</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="tgl_invoice1" class="tgl_invoice1" name="tgl_invoice" type="text" value="<?php if($line_invoice->tgl_invoice!=''){echo date('d-m-Y',strtotime($line_invoice->tgl_invoice));} else {echo date('d-m-Y');}?>"></td>
						</tr>
					  </table>
					  </p>
					  </div>
					  <br/>
						<p align="center">
							<table>
							<tr>
								<td><strong>Hutang Sekarang</strong></td>
								<td><input style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="hutang_sekarang" id="hutang_sekarang" type="text" readonly value=""></td>
							</tr>
                                
                                
						</table>
                        <br>
						<table>
					  <tr>
              <td><input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringbayarhutangpernopo.php");'></td>
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

</script>
