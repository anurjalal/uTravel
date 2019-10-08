<?php include 'base.php'?>
<?php startblock('konten') ?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<?php
$saldoawal = $db->queryUniqueValue("SELECT sum(saldo_awal) FROM piutangsaldoawal where tgl_terbentuk between CONCAT_WS(' ', DATE(now()), '00:00:00') and now()");
$mutasi = $db->queryUniqueValue("SELECT sum(debit) - sum(kredit) FROM piutang where tgl_transaksi between CONCAT_WS(' ', DATE(now()), '00:00:00') and now()");
$saldoakhir = $saldoawal + $mutasi;
?>
<h3>
	Piutang Usaha
	<br/>
	<span class="add-on"><i class="fa fa-search" style="margin-top: 5px;"></i></span>
	<input style="height: 30px" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian.."><br/>
</h3>
<h4>
	<strong>Saldo Awal Piutang</strong>
	<input style="height: 30px;margin-top: 7px" class="saldoawalpiutang" name="saldoawalpiutang" type="text" value="<?php echo $saldoawal;?>" readonly="">
	<br/>
	<strong>Mutasi Piutang</strong>
	<input style="height: 30px;margin-top: 7px" class="mutasipiutang" name="mutasipiutang" type="text" value="<?php echo $mutasi;?>" readonly="">
	<br/>
	<strong>Saldo Akhir Piutang</strong>
	<input style="height: 30px;margin-top: 7px" class="saldoakhirpiutang" name="saldoakhirpiutang" type="text" value="<?php echo $saldoakhir;?>" readonly="">
</h4>
<div id="data-piutang"></div>
<script src="jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="aplikasipiutang.js"></script>
<?php endblock() ?>