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
	var counter = $('.penerimaanpiutang').length;
	var piutang = $('#jumlah_piutang').val();
	var total_piutang = 0;
	for (i=1;i<=counter;i=i+1)
		{
			var jumlah_yg_dibayar = "#jumlah_yg_dibayar"+i;

			total_piutang = total_piutang + parseFloat($(jumlah_yg_dibayar).val());
		}
	var piutang_sekarang = piutang - total_piutang;
	$("#piutang_sekarang").val(piutang_sekarang);
}

</script>
<script type="text/javascript">
		jQuery(document).ready(function($){
		updateTotaldiskon();
		});
</script>

<?php
if(isset($_POST['piutang_sekarang']))
	{
        $no_penjualan = $_GET['id'];
		$id_customer=mysql_real_escape_string($_POST['idcustomer']);
		$nama_customer=mysql_real_escape_string($_POST['nama_customer']);
		$jumlah_piutang=mysql_real_escape_string($_POST['jumlah_piutang']);
		$piutang_sekarang=mysql_real_escape_string($_POST['piutang_sekarang']);
		$username=$_SESSION['LOGIN_NAME'];
		$kd_beban_kas=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Kas'");
		$kd_beban_bank=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Bank'");
		$kd_beban_biaya_bunga=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Biaya Bunga'");
		$kd_beban_biaya_denda=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Biaya Denda'");
		$kd_beban_piutang=$db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Piutang'");
		$tgl_pembayaran=$_POST['tgl_pembayaran'];
		$jumlah_yg_dibayar=$_POST['jumlah_yg_dibayar'];
		$biaya_bunga=$_POST['biaya_bunga'];
		$biaya_denda=$_POST['biaya_denda'];
		$dibayar_dengan=$_POST['dibayar_dengan'];
		$no_tanda_terima=$_POST['no_tanda_terima'];
		$no_invoice=$_POST['no_invoice'];
		$tgl_invoice=$_POST['tgl_invoice'];
		$tgl_invoice=strtotime($tgl_invoice);
		$tgl_invoice=date('Y-m-d H:i:s', $tgl_invoice);
		$tgl_dibayar=$_POST['tgl_dibayar'];
		$tgl_dibayar=strtotime($tgl_dibayar);
		$tgl_dibayar=date('Y-m-d H:i:s', $tgl_dibayar);
		$tgl_penjualan=$_POST['tgl_penjualan'];		
		$tgl_penjualan= strtotime($tgl_penjualan);
		$tgl_penjualan= date('Y-m-d H:i:s', $tgl_penjualan);
		if ($no_invoice!='')
		{
		$db->execute("UPDATE penjualan set no_invoice='$no_invoice',tgl_invoice='$tgl_invoice',statusdibayar='LUNAS',tgl_dibayar='$tgl_pembayaran' where no_penjualan='$no_penjualan'");
		}
		else
		{
		$db->execute("UPDATE penjualan set statusdibayar='LUNAS',tgl_dibayar=NOW() where no_penjualan='$no_penjualan'");			
		}
		$no_piutang_skrng = $db->queryUniqueValue("select max(no_piutang) from piutang");
		$no_piutang = $no_piutang_skrng + 1;
		if($dibayar_dengan=="Kas")
		{
		if($biaya_bunga>0)
		{
		$no_kas = 'K.' . $no_piutang . 'BUNGA';
		$keterangan = 'Penerimaan Biaya Bunga dari ' . $nama_customer . 'dengan No. Piutang ' . $no_piutang;
		$db->query("insert into kas (no_kas,no_piutang,tgl_masuk,keterangan,kd_beban,debit,username,tgl_transaksi) values('$no_kas','$no_piutang','$tgl_dibayar','$keterangan','$kd_beban_kas',$biaya_bunga,'$username',NOW())");
		}
		if($biaya_denda>0)
		{
		$no_kas = 'K.' . $no_piutang . 'DENDA';
		$keterangan = 'Penerimaan Biaya Denda ke ' . $nama_customer . ' dengan No. Piutang ' . $no_piutang;
		$db->query("insert into kas (no_kas,no_piutang,tgl_masuk,keterangan,kd_beban,debit,username,tgl_transaksi) values('$no_kas','$no_piutang','$tgl_dibayar','$keterangan','$kd_beban_kas',$biaya_denda,'$username',NOW())");
		}
		if($piutang_sekarang>=0&&$jumlah_piutang!=0)
		{
		$no_kas = 'K.' . $no_penjualan . 'TERIMAPIUTANG';
		$keterangan = 'Penerimaan piutang dari ' . $nama_customer . ' dengan No. Penjualan ' . $no_penjualan;
		$db->query("insert into kas (no_kas,no_piutang,tgl_masuk,keterangan,kd_beban,debit,username,tgl_transaksi) values('$no_kas','$no_piutang','$tgl_dibayar','$keterangan','$kd_beban_kas',$jumlah_yg_dibayar,'$username',NOW())");
		$db->execute("INSERT INTO piutang(no_piutang,no_penjualan,tgl_penjualan,id_customer,nama_customer,kredit,username,tgl_transaksi) values ('$no_piutang','$no_penjualan','$tgl_penjualan','$id_customer','$nama_customer',$jumlah_yg_dibayar,'$username',NOW())");
		$db->execute("UPDATE piutang set status='LUNAS',username='$username',tgl_transaksi=NOW() where no_penjualan='$no_penjualan'");		
		}
		}
		else if ($dibayar_dengan=="Bank")
		{
			if($biaya_bunga>0)
			{
			$no_kas = 'K.' . $no_piutang . 'BUNGA';
			$keterangan = 'Penerimaan Biaya Bunga dari ' . $nama_customer . ' dengan No. Piutang ' . $no_piutang;
			$db->query("insert into kas (no_kas,no_piutang,tgl_masuk,keterangan,kd_beban,debit,username,tgl_transaksi) values('$no_kas','$no_piutang','$tgl_dibayar','$keterangan','$kd_beban_bank',$biaya_bunga,'$username',NOW())");
			}
			if($biaya_denda>0)
			{
			$no_kas = 'K.' . $no_piutang . 'DENDA';
			$keterangan = 'Penerimaan Biaya Denda ke ' . $nama_customer . ' dengan No. Piutang ' . $no_piutang;
			$db->query("insert into kas (no_kas,no_piutang,tgl_masuk,keterangan,kd_beban,debit,username,tgl_transaksi) values('$no_kas','$no_piutang','$tgl_dibayar','$keterangan','$kd_beban_bank',$biaya_denda,'$username',NOW())");
			}
			if($piutang_sekarang>=0&&$jumlah_piutang!=0)
			{
			$no_kas = 'K.' . $no_penjualan . 'TERIMAPIUTANG';
			$keterangan = 'Penerimaan piutang dari ' . $nama_customer . ' dengan No. Penjualan ' . $no_penjualan;
			$db->query("insert into kas (no_kas,no_piutang,tgl_masuk,keterangan,kd_beban,debit,username,tgl_transaksi) values('$no_kas','$no_piutang','$tgl_dibayar','$keterangan','$kd_beban_bank',$jumlah_yg_dibayar,'$username',NOW())");
			$db->execute("INSERT INTO piutang(no_piutang,no_penjualan,tgl_penjualan,id_customer,nama_customer,kredit,username,tgl_transaksi) values ('$no_piutang','$no_penjualan','$tgl_penjualan','$id_customer','$nama_customer',$jumlah_yg_dibayar,'$username',NOW())");
			$db->execute("UPDATE piutang set status='LUNAS',username='$username',tgl_transaksi=NOW() where no_penjualan='$no_penjualan'");			
			}
			}
				echo "<script>window.open('cetakinvoice.php?id=$no_invoice');window.location.assign('masteringterimapiutangpernopenjualan.php');</script>";		
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="penerimaanpiutang" method="post" action="">
	<p align="center"><strong><font size="3">Penerimaan Piutang</strong></font></p>
				  <?php
					if(isset($_GET['id']))
					{  
				    $no_penjualan =$_GET['id'];
                    $line = $db->queryUniqueObject("SELECT * FROM piutang WHERE no_penjualan='$no_penjualan'");
                    $line_invoice = $db->queryUniqueObject("SELECT * FROM penjualan WHERE no_penjualan='$no_penjualan'");
					$id_customer = $line->id_customer;
					$piutang = $db->queryUniqueValue("select sum(debit) - sum(kredit) from piutang where no_penjualan='".$no_penjualan."'");
					$no_invoice = $db->queryUniqueValue("select max(no_invoice) from penjualan");
					$jml_piutang = 0;
					$query = mysql_query("SELECT hrgjualdgnpajak FROM penjualan WHERE id_customer='".$id_customer."' and no_penjualan='".$no_penjualan."'");
					$data = mysql_fetch_assoc($query);
					$jml_piutang += $data['hrgjualdgnpajak'];
					}
					?>
		    <p align="center">
							<input type="hidden" id="tgl_penjualan" name="tgl_penjualan" value= "<?php echo $line->tgl_penjualan ; ?>">
							<input type="hidden" id= "idcustomer" name="idcustomer" value="<?php echo $id_customer ; ?>">

				<table>
		            <tr>
							<td><div align="left"><strong>Nama Customer</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" type="text" id="nama_customer" class="nama_customer"  name="nama_customer" value="<?php echo $line->nama_customer; ?>" required></td>
		            </tr>
					<tr>
							<td><div align="left" ><strong>Jumlah Piutang</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" name="jumlah_piutang" type="text" id="jumlah_piutang" value="<?php echo $piutang; ?>" readonly></td>
					</tr>
		            </table>
				   </p>
				  <div class="container">
					<p align="center" class="penerimaanpiutang">
						<table>
							<tr>
							<td align="left" style="height: 30px;margin-bottom: 0px"><strong>Jumlah yang dibayarkan</strong></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="jumlah_yg_dibayar1" class="jumlah_yg_dibayar1" name="jumlah_yg_dibayar" type="text" value="<?php echo $jml_piutang;?>" onBlur="updateTotaldiskon()"></td>
							</tr>
							<tr>
							<td><div align="left"><strong>Biaya Bunga</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="biaya_bunga1" class="biaya_bunga1" name="biaya_bunga" type="text" value="0"></td>
							<td><div align="left" style="margin-left: 20px"><strong>Biaya Denda</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="biaya_denda1" class="biaya_denda1" name="biaya_denda" type="text" value="0"></td>
						</tr>
						<tr>
							<td><div align="left"><strong>Pembayaran dengan </strong></div></td>
							<td>
							<select style="height: 30px;margin-bottom: 0px;text-align:right" name="dibayar_dengan" id="dibayar_dengan1" class="dibayar_dengan1" required>
							<option value="">Tidak ada</option>
							<option value="Kas">Kas</option>
							<option value="Bank">Bank</option>
							</select>
							</td>

							<td><div align="right"><strong>Tgl. Dibayar </strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="tgl_dibayar1" class="tgl_dibayar1" name="tgl_dibayar" type="text" value="<?php echo date('d-m-Y'); ?>"></td>
						
						</tr>
						<tr>
							<td><div align="left"><strong>No. Invoice</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="no_invoice1" class="no_invoice1" name="no_invoice" type="text" value="<?php echo $line_invoice->no_invoice?>"></td>
							<td><div align="left" style="margin-left: 20px"><strong>Tgl. Invoice</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" id="tgl_invoice1" class="tgl_invoice1" name="tgl_invoice" type="text" value="<?php if($line_invoice->tgl_invoice!=''){echo date('d-m-Y',strtotime($line_invoice->tgl_invoice));}?>"></td>
						</tr>
					  </table>
					  </p>
					  </div>
					  <br/>
						<p align="center">
							<table>
							<tr>
								<td><strong>Piutang Sekarang</strong></td>
								<td><input style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="piutang_sekarang" id="piutang_sekarang" type="text" readonly value=""></td>
							</tr>
                               
					
						</table>
						<br>
						<table>
					  <tr>
              <td><input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringterimapiutangpernopenjualan.php");'></td>
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
        field: document.getElementById('tgl_pembayaran'),
		format : "DD-MM-YYYY",
    });
</script>
