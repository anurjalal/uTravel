<?php include 'base.php' ?>
<?php startblock('konten') ?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="js/jquery.min.js" type="text/javascript"></script>
<?php
if(isset($_POST['hapusall']))
	{

$db->query("truncate table hutang");
$db->query("truncate table kas");
$db->query("truncate table pembelian");
$db->query("truncate table penjualan");
$db->query("truncate table piutang");
}
?>

<center>
<h3>Dashboard</h3>
<table width="300" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Jumlah Penjualan</td>
		<td><strong><?php echo  $count = $db->countOfAll("penjualan");?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Jumlah Pembelian</td>
		<td><strong><?php echo  $count = $db->countOfAll("pembelian");?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Jumlah Customer</td>
		<td><strong><?php echo $count = $db->countOfAll("customer");?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Jumlah Supplier</td>
		<td><strong><?php echo $count = $db->countOfAll("supplier");?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<br/>
	<form name="hapusall" method="post" id="hapusall" action="">
	<table>
	<tr>
		<td><strong>Apakah anda ingin menghapus semua data transaksi ?</td>
	</tr>
	</table>
	<br/>
	<table>
	<tr>
		<td><input type="submit" style="height:50px;width:100px;margin-left:20px" name="hapusall" value="Hapus" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS SEMUA DATA TRANSAKSI ... ?')"></td>
	</tr>
    </form>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

</table>
<?php endblock() ?>
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_awal'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('tgl_akhir'),
		format : "DD-MM-YYYY",
    });
</script>
