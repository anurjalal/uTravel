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
<?php
	if(isset($_POST['tipe_produk']))
		{
			$kd_hrgbeli=$_GET['id'];
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
			$update2 = $db->query("UPDATE hrgbeli SET kd_produk='$kd_produk',tipe_produk='$tipe_produk',id_supplier='$id_supplier',nama_supplier='$nama_supplier',tgl_awal='$tgl_awalbeli',tgl_akhir = '$tgl_akhirbeli', hargabeli = '$hargabeli' WHERE kd_hrgbeli = '$kd_hrgbeli'");
			if($update2){
			echo "<script>window.location.assign('masterhargabeli.php')</script>";
			}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form class="form-horizontal" id="form-edithargabeli" method="post">
	<p align="center"><strong>Edit Harga Beli</strong></p>
	<center>
				  <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line2 = $db->queryUniqueObject("SELECT * FROM hrgbeli WHERE kd_hrgbeli='$id'");
				  }
				  ?>
	<table>
	<tr>
	<td><strong>Kode Produk</td>
	<td>
	<input style="height: 30px" type="text" id="kd_produk" class="input-medium"  name="kd_produk" value="<?php echo $line2->kd_produk ?>">
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
			<input style="height: 30px" type="text" id="nama_supplier" class="input-medium" name="nama_supplier" value="<?php echo $line2->nama_supplier ?>" onfocus="setSupplier(this)">
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
	<option value="pesawat" <?php if ($line2->tipe_produk=='pesawat') {echo "selected";}?>>Pesawat</option>
	<option value="kereta" <?php if ($line2->tipe_produk=='kereta') {echo "selected";}?>>Kereta</option>
	<option value="hotel" <?php if ($line2->tipe_produk=='hotel') {echo "selected";}?>>Hotel</option>
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td><strong>Tanggal Start Harga Beli
	</td>
	<td>
	<input style="height: 30px" type="text" id="tgl_awalbeli" class="input-medium" name="tgl_awalbeli" value="<?php if ($line2->tgl_awal=='0000-00-00 00:00:00') {echo '';} else {echo date('d-m-Y', strtotime(str_replace('-','/', $line2->tgl_awal)));} ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td><strong>Tanggal Akhir Harga Beli
	</td>
	<td>
	<input style="height: 30px" type="text" id="tgl_akhirbeli" class="input-medium" name="tgl_akhirbeli" value="<?php if ($line2->tgl_akhir=='0000-00-00 00:00:00') {echo '';} else {echo date('d-m-Y', strtotime(str_replace('-','/', $line2->tgl_akhir)));} ?>">
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td><strong>Harga Beli
	</td>
	<td>
	<input style="height: 30px" type="text" id="hargabeli" class="input-medium" name="hargabeli" value="<?php echo $line2->hargabeli ?>">
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
