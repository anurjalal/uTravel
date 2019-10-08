<?php include 'base.php'?>
<?php startblock('konten') ?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<?php
$saldoawal = $db->queryUniqueValue("SELECT sum(saldo_awal) FROM hutangsaldoawal where tgl_terbentuk between CONCAT_WS(' ', DATE(now()), '00:00:00') and now()");
$mutasi = $db->queryUniqueValue("SELECT sum(debit) - sum(kredit) FROM hutang where tgl_transaksi between CONCAT_WS(' ', DATE(now()), '00:00:00') and now()");
$saldoakhir = $saldoawal + $mutasi;

?>
<h3>
	Hutang Dagang
	<br/>
	<span class="add-on"><i class="fa fa-search" style="margin-top: 5px;"></i></span>
	<input style="height: 30px" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian.."><br/>
</h3>
<h4>
	<strong>Saldo Awal Hutang</strong>
	<input style="height: 30px;margin-top: 7px" class="saldoawalhutang" name="saldoawalhutang" type="text" value="<?php echo $saldoawal;?>" readonly="">
	<br/>
	<strong>Mutasi Hutang</strong>
	<input style="height: 30px;margin-top: 7px" class="mutasihutang" name="mutasihutang" type="text" value="<?php echo $mutasi;?>" readonly="">
	<br/>
	<strong>Saldo Akhir Hutang</strong>
	<input style="height: 30px;margin-top: 7px" class="saldoakhirhutang" name="saldoakhirhutang" type="text" value="<?php echo $saldoakhir;?>" readonly="">
	<br/>
</h4>
<div id="data-hutang"></div>
<script src="jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="aplikasihutang.js"></script>
<?php endblock() ?>