<?php include 'base.php'?>
<?php startblock('konten') ?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<?php
$saldoawal = $db->queryUniqueValue("SELECT sum(saldo_awal) FROM kassaldoawal where tgl_terbentuk between CONCAT_WS(' ', DATE(now()), '00:00:00') and now()");
$mutasi = $db->queryUniqueValue("SELECT sum(debit) - sum(kredit) FROM kas where tgl_transaksi between CONCAT_WS(' ', DATE(now()), '00:00:00') and now()");
$saldoakhir = $saldoawal + $mutasi;
?>
<h3>
	Kas Dagang
	<br/>
	<span class="add-on"><i class="fa fa-search" style="margin-top: 5px;"></i></span>
	<input style="height: 30px" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian.."><br/>
</h3>
<h4>
	<strong>Saldo Awal Kas</strong>
	<input style="height: 30px;margin-top: 7px" class="saldoawalkas" name="saldoawalkas" type="text" value="<?php echo $saldoawal;?>" readonly="">
	<br/>
	<strong>Mutasi Kas</strong>
	<input style="height: 30px;margin-top: 7px" class="mutasikas" name="mutasikas" type="text" value="<?php echo $mutasi;?>" readonly="">
	<br/>
	<strong>Saldo Akhir Kas</strong>
	<input style="height: 30px;margin-top: 7px" class="saldoakhirkas" name="saldoakhirkas" type="text" value="<?php echo $saldoakhir;?>" readonly="">
</h4>
<div id="data-kas"></div>
<script src="jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="aplikasikas.js"></script>
<?php endblock() ?>