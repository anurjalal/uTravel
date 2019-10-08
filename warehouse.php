<?php include 'basewarehouse.php' ?>
<?php startblock('konten') ?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<center>
<h3>Dashboard</h3>
<table width="300" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="167">&nbsp;</td>
		<td width="133">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Jumlah Stok Batu Masuk</td>
		<td><strong><?php echo  $count = $db->queryUniqueValue("select count(*) from stok where status='IN'");?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Jumlah Stok Batu Keluar</td>
		<td><strong><?php echo  $count = $db->queryUniqueValue("select count(*) from stok where status='OUT'");?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Jumlah Stok Tools</td>
		<td><strong><?php echo  $count = $db->queryUniqueValue("select count(*) from stok where status='TOOLS'");?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
</center>
<?php endblock() ?>