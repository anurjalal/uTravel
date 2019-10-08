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
	function setHargaMakanan(val) {
		{
		var tipe = val.value;
		$.post('check_hrgbeli.php', {tipe: tipe.toUpperCase()},
			function(data){
				$("#hargabeli").val(data.hargabeli.toUpperCase());
				$("#hargajual").val(data.hargajual.toUpperCase());
			}, 'json');
		setHarga();
		}
	}
	function setHarga()
			{
			var jumlah = document.getElementById("jumlah").value;
			var hargabeli = document.getElementById("hargabeli").value;
			var hargakardus = document.getElementById("hargakardus").value;
			var hargajual = document.getElementById("hargajual").value;
			var total = Number(hargabeli) + Number(hargakardus);
			$("#total").val(Number(total));
			var margin = Number(hargajual) - Number(total);
			if (margin>0)
			{
			$("#margin").val(Number(margin));
			}
			var hargajualtotal = Number(hargajual) * Number(jumlah);
			$("#hargajualtotal").val(Number(hargajualtotal));
			var margintotal = Number(margin) * Number(jumlah);
			if (margintotal>0)
			{
			$("#margintotal").val(Number(margintotal));
			}
}
</script>


<?php
	if(isset($_POST['no_penjualan']))
		{
			$username = $_SESSION['LOGIN_NAME'];
			$nama_customer=mysql_real_escape_string($_POST['nama_customer']);
			$jumlah_customer = $db->queryUniqueValue("select count(id_customer) from customer where nama_customer='$nama_customer'");
			if ($jumlah_customer==0)
			{
			$db->query("insert into customer (nama_customer,username,tgl_transaksi) values('$nama_customer','$username',NOW())");
			}
			$id_customer = $db->queryUniqueValue("select id_customer from customer where nama_customer='$nama_customer'");
			$no_penjualan=mysql_real_escape_string($_POST['no_penjualan']);
			$tgl_penjualan=mysql_real_escape_string($_POST['tgl_penjualan']);
			$tgl_penjualan=strtotime($tgl_penjualan);
			$tgl_penjualan=date('Y-m-d H:i:s', $tgl_penjualan);
			$tipe=mysql_real_escape_string($_POST['tipe']);
			$jumlah=mysql_real_escape_string($_POST['jumlah']);
			$tgl_kirim=mysql_real_escape_string($_POST['tgl_kirim']);
			$tgl_kirim=strtotime($tgl_kirim);
			$tgl_kirim=date('Y-m-d H:i:s', $tgl_kirim);
			$hargabeli=mysql_real_escape_string($_POST['hargabeli']);
			$hargakardus=mysql_real_escape_string($_POST['hargakardus']);
			$total=mysql_real_escape_string($_POST['total']);
			$hargajual=mysql_real_escape_string($_POST['hargajual']);
			$hargajualtotal=mysql_real_escape_string($_POST['hargajualtotal']);
			$margin=mysql_real_escape_string($_POST['margin']);
			$margintotal=mysql_real_escape_string($_POST['margintotal']);
			$db->execute("INSERT INTO penjualan(no_penjualan,tgl_penjualan,tipe,jumlah,tgl_kirim,hargabeli,hargakardus,total,hargajual,hargajualtotal,margin,margintotal,username,tgl_transaksi) values ('$no_penjualan','$tgl_penjualan','$tipe','$jumlah','$tgl_kirim',$hargabeli,$hargakardus,$total,$hargajual,$hargajualtotal,$margin,$margintotal,'$username',NOW())");
			echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Penjualan dengan No. Penjualan [ $no_penjualan ] Berhasil Ditambahkan</font></div> ";
			echo "<script>window.location.assign('masteringpenjualan.php');</script>";
			//}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="penjualan" method="post" action="">
	<p align="center"><font size="3"><strong>Pencatatan Penjualan</strong></font></p>
	<?php $tambahline = 1;?>
		<p align="center">
			<table>
			        <tr>
			        <td><div align="left"><strong>Nama Customer</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="nama_customer" class="nama_customer"  name="nama_customer" value="" onfocus="setCustomer(this)" required></td>
			        <td><div align="left" style="margin-left: 20px"><strong>No. Penjualan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" name="no_penjualan" type="text" id="no_penjualan" value="<?php $maxterima = $db->queryUniqueValue("select MAX(CAST(no_penjualan AS SIGNED)) as no_penjualan from penjualan"); if ($maxterima == NULL) {$maxterima = 1; echo $maxterima;} else {$maxterimabaru = $maxterima + 1; echo $maxterimabaru;} ?>"></td>
			        <td><div align="left" style="margin-left: 20px"><strong>Tanggal Penjualan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="tgl_penjualan" name="tgl_penjualan" value="<?php echo date('d-m-Y');?>"></td>
			        </tr>
			        <tr>
			        <td><div align="left"><strong>Jenis Makanan</strong></div></td>
			        <td>
			        <select style="height: 30px;margin-bottom: 0px;text-align:right" onchange="setHargaMakanan(this)" name="tipe" id="tipe" class="tipe" required>
			        <option value="">Tidak ada</option>
			        <option value="Snack">Snack</option>
			        <option value="Makanan">Makanan</option>
			        <option value="Prasmanan">Prasmanan</option>
			        </td>
							<td><div align="left" style="margin-left: 20px"><strong>Qty/Jumlah</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="jumlah" class="jumlah" name="jumlah" type="text" value="" onkeyup="setHarga()"></td>
			        <td><div align="left" style="margin-left: 20px"><strong>Tanggal Kirim</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="tgl_kirim" class="tgl_kirim" name="tgl_kirim" type="text" value=""></td>
			        </tr>
			        <tr>
			        <td><div align="left"><strong>Harga Beli</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="hargabeli" name="hargabeli" value="" onkeyup="setHarga()"></td>
			        <td><div align="left" style="margin-left: 20px"><strong>Harga Kardus</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="hargakardus" name="hargakardus" value="" onkeyup="setHarga()"></td>
			        <td><div align="left" style="margin-left: 20px"><strong>Total</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="total" name="total" value=""></td>
			        </tr>
			        <tr>
			        <td><div align="left"><strong>Harga Jual</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="hargajual" name="hargajual" value="" onkeyup="setHarga()"></td>
			        <td><div align="left" style="margin-left: 20px"><strong>Total Harga Jual</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="hargajualtotal" name="hargajualtotal" value=""></td>
			        </tr>
			        <tr>
			        <td><div align="left"><strong>Margin</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="margin" name="margin" value=""></td>
			        <td><div align="left" style="margin-left: 20px"><strong>Total Margin</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="margintotal" name="margintotal" value=""></td>
			        </tr>
							<tr>
			        <td><div align="left"><strong>Dengan Pajak</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="margin" name="margin" value=""></td>
			        <td><div align="left" style="margin-left: 20px"><strong>Total Margin</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="margintotal" name="margintotal" value=""></td>
			        </tr>
			        </table>
			        <br/>
			        <table>
			        <tr>
			          <td><input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringpenjualan.php");'></td>
			          <td><input type="button" style="height:50px;width:100px" name="Reset" value="Reset" onclick='window.location.reload(true);'></td>
			          <td><input type="submit" style="height:50px;width:100px" name="Submit" value="Save" ></td>
			        </tr>
			      </table>
			    </form>
			  </td>
			</tr>
			</table>
		</p>
<?php endblock() ?>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.min.js"></script>
<script>
function setCustomer(value)
		{
		//var counter = value.id.match(/\d+/);
		$('#nama_customer').autocomplete("check_customer.php", {
	        selectFirst: true});
		}
</script>
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_penjualan'),
		format : "DD-MM-YYYY",
    });
		var picker = new Pikaday({
				field: document.getElementById('tgl_kirim'),
		format : "DD-MM-YYYY",
		});
</script>
