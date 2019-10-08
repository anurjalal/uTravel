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
			$nama_supplier=mysql_real_escape_string($_POST['nama_supplier']);
			if ($nama_supplier)
			{
			$id_supplier = $db->queryUniqueValue("select id_supplier from supplier where nama_supplier='$nama_supplier'");
			}
			else
			{
			$id_supplier = '';	
			}
			$tgl_awalbeli=mysql_real_escape_string($_POST['tgl_awalbeli']);
			$tgl_awalbeli=strtotime($tgl_awalbeli);
			$tgl_awalbeli=date('Y-m-d H:i:s', $tgl_awalbeli);
			$tgl_akhirbeli=mysql_real_escape_string($_POST['tgl_akhirbeli']);
			$tgl_akhirbeli=strtotime($tgl_akhirbeli);
			$tgl_akhirbeli=date('Y-m-d H:i:s', $tgl_akhirbeli);
			$hargabeli=mysql_real_escape_string($_POST['hargabeli']);

			$insert2 = $db->query("INSERT INTO hrgbeli(kd_produk,tipe_produk,id_supplier,nama_supplier,tgl_awal,tgl_akhir,hargabeli) VALUES('$kd_produk','$tipe_produk',$id_supplier,'$nama_supplier','$tgl_awalbeli','$tgl_akhirbeli',$hargabeli)");
			if($insert2){
			echo "<script>window.location.assign('masterhargabeli.php')</script>";
			}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-addhargabeli" method="post">
	<p align="center"><strong>Tambah Harga Beli</strong></p>
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
	<strong>Supplier
	</td>
	<td>
	<input style="height: 30px" type="text" id="nama_supplier" class="input-medium"  name="nama_supplier" value="" onfocus="setSupplier(this)">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
		<strong>Tipe Produk</strong>
	</td>
	<td>
	<select style="height: 30px"  name="tipe_produk" id="tipe_produk" class="input-medium" required>
	 <option value="">Tidak ada</option>
	 <option value="pesawat">Pesawat</option>
	 <option value="kereta">Kereta</option>
	 <option value="kereta">Hotel</option>
		</select>
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Tanggal Start Harga Beli</strong>
	</td>
	<td>
	<input style="height: 30px" type="text" id="tgl_awalbeli" class="input-medium" name="tgl_awalbeli" value="<?php echo date('d-m-Y');?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Tanggal Akhir Harga Beli</strong>
	</td>
	<td>
	<input style="height: 30px" type="text" id="tgl_akhirbeli" class="input-medium" name="tgl_akhirbeli" value="<?php echo date('31-12-Y');?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td><strong>Harga Beli
	</td>
	<td>
	<input style="height: 30px" type="text" id="hargabeli" class="input-medium" name="hargabeli" value="">
	</td>
	</tr>
	</table>
	<br/>
	<input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masterhargabeli.php");'>
	<input type="submit" style="height:50px;width:100px" name="Submit" value="Save">
	</center>
</form>
<?php endblock() ?>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.min.js"></script>
<script>
function setSupplier(value)
		{
		//var counter = value.id.match(/\d+/);
		$('#nama_supplier').autocomplete("check_supplier.php", {
	        selectFirst: true});
		}
</script>
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_awalbeli'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('tgl_akhirbeli'),
		format : "DD-MM-YYYY",
    });
</script>
