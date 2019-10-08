<html>

<title> Laporan Piutang </title>

<head>
<font face="courier" size=3><b>LAPORAN PIUTANG</b></font>
<br> <br>
<?php

include ('publicfunction.php');


echo "<table border=1 style='border-collapse:collapse' width=100%>";


?>

</head>

<body>
<br>
<?php
include_once ('db.php');

include ('connectdb.php');

$myquery1="SELECT * FROM piutang where kredit=0 order by nama_customer";
$myresult1=mysql_query($myquery1);
$datapurchase1=mysql_fetch_array($myresult1);
$myquery2="SELECT sum(debit) - sum(kredit) as subtotal FROM piutang";
$myresult2=mysql_query($myquery2);
$datapurchase2=mysql_fetch_array($myresult2);
$total=0;
$no_piutang = '';
echo "</font>";
$myrows1=mysql_num_rows($myresult1);
$myresult1=mysql_query($myquery1);
for ($i=0;$i<$myrows1;$i++){
      $datapurchase1=mysql_fetch_array($myresult1);
	  $myquery3="SELECT * from piutang where kredit<>0 and no_penjualan=" . $datapurchase1['no_penjualan'];
	  $myresult3=mysql_query($myquery3);
      echo "<tr>";
	  if($no_piutang<>$datapurchase1['no_piutang'])
	  {
	  echo "<tr style='background-color:#ccccff;-webkit-print-color-adjust:exact' >
      <th width=12.5%><font face=\"courier\" size=3> NO PIUTANG </font></th>
	  <th width=12.5%><font face=\"courier\" size=3> NAMA CUSTOMER </font></th>	  
	  <th width=12.5%><font face=\"courier\" size=3> NO PENJUALAN </font></th>
	  <th width=12.5%><font face=\"courier\" size=3> TGL PENJUALAN </font></th>
	  <th width=12.5%><font face=\"courier\" size=3> TGL JATUH TEMPO </font></th>
	  <th width=12.5%><font face=\"courier\" size=3> JUMLAH </font></th>
	        </tr>";
	  echo "<td width=12.5%><font face=\"Courier\" size=3>".$datapurchase1['no_piutang']."</font></td>";
	  }
	  else
	  {
		  echo "";
	  }
	  if($no_piutang<>$datapurchase1['no_piutang'])
	  {
	  echo "<td width=12.5%><font face=\"Courier\" size=3>".$datapurchase1['nama_customer']."</font></td>";
	  }
	  else
	  {
		  echo "";
	  }	  
	  if($no_piutang<>$datapurchase1['no_piutang'])
	  {
	  echo "<td width=12.5%><font face=\"Courier\" size=3>".$datapurchase1['no_penjualan']."</font></td>";
	  }
	  else
	  {
		  echo "";
	  }
	  if($no_piutang<>$datapurchase1['no_piutang'])
	  {
	  echo "<td width=12.5%><font face=\"Courier\" size=3>".date('d-m-Y',strtotime($datapurchase1['tgl_penjualan']))."</font></td>";
	  }
	  else
	  {
		  echo "";
	  }	  
	  if($no_piutang<>$datapurchase1['no_piutang'])
	  {
	  echo "<td width=12.5%><font face=\"Courier\" size=3>";if ($datapurchase1['tgl_jatuh_tempo']!='0000-00-00 00:00:00') { echo date('d-m-Y',strtotime($datapurchase1['tgl_jatuh_tempo'])); } else {echo "CASH";} echo"</font></td>";
	  }
	  else
	  {
		  echo "";
	  }
	  if($no_piutang<>$datapurchase1['no_piutang'])
	  {
	  echo "<td align='right' width=12.5%><font face=\"Courier\" size=3>".number_format($datapurchase1['debit'],0,',','.')."</font></td></tr><tr style='background-color:#00ffff;-webkit-print-color-adjust:exact'><th width=12.5%><font face=\"courier\" size=2> NO PIUTANG </font></th><th width=12.5%><font face=\"courier\" size=2> NO PENJUALAN </font></th><th width=12.5%><font face=\"courier\" size=2> TGL PENJUALAN </font></th><th width=12.5%><font face=\"courier\" size=2> TGL TRANSAKSI </font></th><th width=12.5% colspan=2><font face=\"courier\" size=2> TELAH DIBAYAR </font></th></td></tr>";
	  }
	  else
	  {
		  echo "";
	  }

      while($data = mysql_fetch_array($myresult3)) {

      echo "<td width=12.5%><font face=\"Courier\" size=2>".$data['no_piutang']."</font></td>";
      echo "<td width=12.5%><font face=\"Courier\" size=2>".$data['no_penjualan']."</font></td>";
	  echo "<td width=12.5%><font face=\"Courier\" size=2>".date('d-m-Y', strtotime($data['tgl_penjualan']))."</font></td>";
	  echo "<td width=12.5%><font face=\"Courier\" size=2>".date('d-m-Y', strtotime($data['tgl_transaksi']))."</font></td>";
	  echo "<td width=12.5% colspan=2 align=right><font face=\"Courier\" size=2>".number_format($data['kredit'],0,',','.')."</font></td>";
      echo "</tr>";
	  
	  }
	  $no_piutang=$datapurchase1['no_piutang'];
	  
}
echo "</table>";
echo "<font face=\"Courier\" size=4><b><p align='right'>GRAND TOTAL ".number_format($datapurchase2['subtotal'],0,',','.')."</font></b></td>";            

?>

</body>

</html>
