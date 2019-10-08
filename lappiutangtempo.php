<html>

<title> Laporan Piutang </title>

<head>
<font face="courier" size=3><b>LAPORAN PIUTANG TUNAI TEMPO</b></font>

<?php
include ('publicfunction.php');


echo "<br>";
echo "<br>";

?>

</head>

<body>
<?php
include ('connectdb.php');
include 'db.php'; 



//$myquery1="SELECT * FROM trjual WHERE tgl_nota = '$today'";
$myquery1="SELECT * FROM trjual where SISTEM_BYR='TUNAI TEMPO'";
$myresult1=mysql_query($myquery1);

$myrows=mysql_num_rows($myresult1);
$myquery2="SELECT sum(debit)-sum(kredit) as piutang FROM piutang where kd_lease=''";
$myresult2=mysql_query($myquery2);

$total=mysql_fetch_array($myresult2);
for ($i=0;$i<$myrows;$i++){
      $data=mysql_fetch_array($myresult1);
	  $namacust = $db->queryUniqueValue("select nm_cust from mstcust where kd_cust='".$data['KD_CUST']."'");
	  $kekurangan = $db->queryUniqueValue("select sum(debit - kredit) from piutang where no_penjualan='".$data['NO_NOTA']."'");
		$jt1status = $db->queryUniqueValue("select jt1status from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt1 = $db->queryUniqueValue("select jt1 from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt2status = $db->queryUniqueValue("select jt2status from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt2 = $db->queryUniqueValue("select jt2 from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt3status = $db->queryUniqueValue("select jt3status from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt3 = $db->queryUniqueValue("select jt3 from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt4status = $db->queryUniqueValue("select jt4status from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt4 = $db->queryUniqueValue("select jt4 from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt5status = $db->queryUniqueValue("select jt5status from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt5 = $db->queryUniqueValue("select jt5 from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt6status = $db->queryUniqueValue("select jt6status from tempo where no_nota='".$data['NO_NOTA']."'");
		$jt6 = $db->queryUniqueValue("select jt6 from tempo where no_nota='".$data['NO_NOTA']."'");
		if ($jt1status=='BELUM' and $jt1<>'0000-00-00 00:00:00')
		{
			$jatuhtempo = $jt1;
		}
		else if ($jt2status=='BELUM' and $jt1status=='LUNAS' and $jt2<>'0000-00-00 00:00:00')
		{
			$jatuhtempo = $jt2;
		}
		else if ($jt3status=='BELUM' and $jt2status=='LUNAS' and $jt1status=='LUNAS' and $jt3<>'0000-00-00 00:00:00')
		{
			$jatuhtempo = $jt3;
		}
		else if ($jt4status=='BELUM' and $jt3status=='LUNAS' and $jt2status=='LUNAS' and $jt1status=='LUNAS' and $jt4<>'0000-00-00 00:00:00')
		{
			$jatuhtempo = $jt4;
		}
		else if ($jt5status=='BELUM' and $jt4status=='LUNAS' and $jt3status=='LUNAS' and $jt2status=='LUNAS' and $jt1status=='LUNAS' and $jt5<>'0000-00-00 00:00:00')
		{
			$jatuhtempo = $jt5;
		}
		else if ($jt6status=='BELUM' and $jt5status=='LUNAS' and $jt4status=='LUNAS' and $jt3status=='LUNAS' and $jt2status=='LUNAS' and $jt1status=='LUNAS' and $jt6<>'0000-00-00 00:00:00')
		{
			$jatuhtempo = $jt6;
		}
		else
		{
			$jatuhtempo = '';
		}
	  echo "<table border=1 style='border-collapse: collapse;' width=100%>";

      echo "<tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
        <th><font face=\"courier\" size=3>NO. PENJUALAN</th>
        <th><font face=\"courier\" size=3>TGL. PENJUALAN</th>
        <th><font face=\"courier\" size=3>TGL. JATUH TEMPO</th>
		<th><font face=\"courier\" size=3>NAMA CUSTOMER</th>
		<th><font face=\"courier\" size=3>PIUTANG</th>
      </tr>";
      echo "<tr>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$data['NO_NOTA']."</font></td>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".date('Y-m-d', strtotime(str_replace('-','/', $data['TGL_NOTA'])))."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$jatuhtempo."</font></td>";
	  echo "<td width=20%><font face=\"Courier\" size=2><b>".$namacust."</font></td>";
	  echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($kekurangan,0,',','.')."</font></td>";


      echo "</tr>";
	  echo "</table>";
      $line6 = $db->queryUniqueObject("SELECT * FROM tempo WHERE no_nota='".$data['NO_NOTA']."'");
	  $totalharga = $line6->JT1JUMLAH + $line6->JT2JUMLAH + $line6->JT3JUMLAH + $line6->JT4JUMLAH + $line6->JT5JUMLAH + $line6->JT6JUMLAH;
?>
					  <table border=1 style="border-collapse:collapse">
					  <tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
					  <th><font face="Courier">JATUH TEMPO</th>
					  <th><font face="Courier">JUMLAH</th>
					  <th><font face="Courier">LUNAS</th>

					  <tr>
						<?php if($line6->JT1JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>Jatuh Tempo 1</td>";}else {echo "";}?>
						<?php if($line6->JT1JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>".$line6->JT1JUMLAH."</td>";}else {echo "";}?>
					  	<?php if($line6->JT1STATUS=="LUNAS"){ echo "<td><b><font face=\"Courier\" size=2>Lunas</td>";}else {echo "";}?>
					  </tr>
					  <tr>
						<?php if($line6->JT2JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>Jatuh Tempo 2</td>";}else {echo "";}?>
						<?php if($line6->JT2JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>".$line6->JT2JUMLAH."</td>";}else {echo "";}?>
					  	<?php if($line6->JT2STATUS=="LUNAS"){ echo "<td><b><font face=\"Courier\" size=2>Lunas</td>";}else {echo "";}?>
					  </tr>
					  <tr>
						<?php if($line6->JT3JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>Jatuh Tempo 3</td>";}else {echo "";}?>
						<?php if($line6->JT3JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>".$line6->JT3JUMLAH."</td>";}else {echo "";}?>
					  	<?php if($line6->JT3STATUS=="LUNAS"){ echo "<td><b><font face=\"Courier\" size=2>Lunas</td>";}else {echo "";}?>
					  </tr>
					  <tr>
						<?php if($line6->JT4JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>Jatuh Tempo 4</td>";}else {echo "";}?>
						<?php if($line6->JT4JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>".$line6->JT4JUMLAH."</td>";}else {echo "";}?>
					  	<?php if($line6->JT4STATUS=="LUNAS"){ echo "<td><b><font face=\"Courier\" size=2>Lunas</td>";}else {echo "";}?>
					  </tr>
					  <tr>
						<?php if($line6->JT5JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>Jatuh Tempo 5</td>";}else {echo "";}?>
						<?php if($line6->JT5JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>".$line6->JT5JUMLAH."</td>";}else {echo "";}?>
					  	<?php if($line6->JT5STATUS=="LUNAS"){ echo "<td><b><font face=\"Courier\" size=2>Lunas</td>";}else {echo "";}?>
					  </tr>
					  <tr>
						<?php if($line6->JT6JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>Jatuh Tempo 6</td>";}else {echo "";}?>
						<?php if($line6->JT6JUMLAH>0){ echo "<td><b><font face=\"Courier\" size=2>".$line6->JT6JUMLAH."</td>";}else {echo "";}?>
					  	<?php if($line6->JT6STATUS=="LUNAS"){ echo "<td><b><font face=\"Courier\" size=2>Lunas</td>";}else {echo "";}?>
					  </tr>
					  <tr>
						<?php if($totalharga>0){ echo "<td><b><font face=\"Courier\" size=2>Total</td>";}else {echo "";}?>
						<?php if($totalharga>0){ echo "<td align='right'><b><font face=\"Courier\" size=2>".number_format($totalharga,0,',','.')."</td>";}else {echo "";}?>
					  </tr>
					</table>
<?php
};
?>
<?php echo "<font face=\"Courier\" size=4><b><p align='right'>TOTAL PIUTANG ".number_format($total['piutang'],0,',','.')."</font></b></p></td>";?>            

</body>

</html>
