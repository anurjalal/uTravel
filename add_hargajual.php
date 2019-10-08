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

<?php
	if(isset($_POST['tipe_produk']))
		{
			$kd_produk=mysql_real_escape_string($_POST['kd_produk']);
			$tipe_produk=mysql_real_escape_string($_POST['tipe_produk']);
			$nama_customer=mysql_real_escape_string($_POST['nama_customer']);
			if ($nama_customer)
			{
			$id_customer = $db->queryUniqueValue("select id_customer from customer where nama_customer='$nama_customer'");
			}
			else
			{
			$id_customer = '';	
			}
			$tgl_awaljual=mysql_real_escape_string($_POST['tgl_awaljual']);
			$tgl_awaljual=strtotime($tgl_awaljual);
			$tgl_awaljual=date('Y-m-d H:i:s', $tgl_awaljual);
			$tgl_akhirjual=mysql_real_escape_string($_POST['tgl_akhirjual']);
			$tgl_akhirjual=strtotime($tgl_akhirjual);
			$tgl_akhirjual=date('Y-m-d H:i:s', $tgl_akhirjual);
			$hargajual=mysql_real_escape_string($_POST['hargajual']);

			$insert2 = $db->query("INSERT INTO hrgjual(kd_produk,tipe_produk,id_customer,nama_customer,tgl_awal,tgl_akhir,hargajual) VALUES('$kd_produk','$tipe_produk','$id_customer','$nama_customer','$tgl_awaljual','$tgl_akhirjual',$hargajual)");
			if($insert2){
			echo "<script>window.location.assign('masterhargajual.php')</script>";
			}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-addhargajual" method="post">
	<p align="center"><strong>Tambah Harga Jual</strong></p>
	<center>
	<table>
	<tr>
	<td>
	<strong>Kode Produk
	</td>
	<td>
	<input style="height: 30px" type="text" id="kd_produk" class="input-medium"  name="kd_produk" value="">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Customer
	</td>
	<td>
	<input style="height: 30px" type="text" id="nama_customer" class="input-medium"  name="nama_customer" value="" onfocus="setCustomer(this)">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<strong>Tipe Produk
	</td>
	<td>
	<select style="height: 30px"  name="tipe_produk" id="tipe_produk" class="input-medium" required>
	<option value="">Tidak ada</option>
	<option value="pesawat">Pesawat</option>
	<option value="kereta">Kereta</option>
	<option value="hotel">Hotel</option>
		</select>
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td><strong>Tanggal Start Harga Jual
	</td>
	<td>
	<input style="height: 30px" type="text" id="tgl_awaljual" class="input-medium" name="tgl_awaljual" value="<?php echo date('d-m-Y');?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td><strong>Tanggal Akhir Harga Jual
	</td>
	<td>
	<input style="height: 30px" type="text" id="tgl_akhirjual" class="input-medium" name="tgl_akhirjual" value="<?php echo date('31-12-Y');?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td><strong>Harga Jual
	</td>
	<td>
	<input style="height: 30px" type="text" id="hargajual" class="input-medium" name="hargajual" value="">
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masterhargajual.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
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
        field: document.getElementById('tgl_awaljual'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('tgl_akhirjual'),
		format : "DD-MM-YYYY",
    });
</script>
