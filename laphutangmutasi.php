<html>

<title> Laporan Hutang </title>

<head>
<font face="courier" size=3><b>LAPORAN HUTANG</b></font>
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

$myquery1="SELECT * FROM hutang where debit=0 order by nama_supplier";
$myresult1=mysql_query($myquery1);
$datapurchase1=mysql_fetch_array($myresult1);
$myquery2="SELECT sum(kredit) - sum(debit) as subtotal FROM hutang";
$myresult2=mysql_query($myquery2);
$datapurchase2=mysql_fetch_array($myresult2);
$total=0;
$no_hutang = '';
echo "</font>";
$myrows1=mysql_num_rows($myresult1);
$myresult1=mysql_query($myquery1);
for ($i=0;$i<$myrows1;$i++){
      $datapurchase1=mysql_fetch_array($myresult1);
	  $myquery3="SELECT * from hutang where debit<>0 and no_po=" . $datapurchase1['no_po'];
	  $myresult3=mysql_query($myquery3);	
      echo "<tr>";
	  if($no_hutang<>$datapurchase1['no_hutang'])
	  {
	  echo "<tr style='background-color:#ccccff;-webkit-print-color-adjust:exact' >
      <th width=12.5%><font face=\"courier\" size=3> NO HUTANG </font></th>
	  <th width=12.5%><font face=\"courier\" size=3> NAMA SUPPLIER </font></th>	  
	  <th width=12.5%><font face=\"courier\" size=3> NO PO </font></th>
	  <th width=12.5%><font face=\"courier\" size=3> TGL PO </font></th>
	  <th width=12.5%><font face=\"courier\" size=3> TGL JATUH TEMPO </font></th>
	  <th width=12.5%><font face=\"courier\" size=3> JUMLAH </font></th>
	        </tr>";
	  echo "<td width=12.5%><font face=\"Courier\" size=3>".$datapurchase1['no_hutang']."</font></td>";
	  }
	  else
	  {
		  echo "";
	  }
	  if($no_hutang<>$datapurchase1['no_hutang'])
	  {
	  echo "<td width=12.5%><font face=\"Courier\" size=3>".$datapurchase1['nama_supplier']."</font></td>";
	  }
	  else
	  {
		  echo "";
	  }	  	  
	  if($no_hutang<>$datapurchase1['no_hutang'])
	  {
	  echo "<td width=12.5%><font face=\"Courier\" size=3>".$datapurchase1['no_po']."</font></td>";
	  }
	  else
	  {
		  echo "";
	  }

	  if($no_hutang<>$datapurchase1['no_hutang'])
	  {
	  echo "<td width=12.5%><font face=\"Courier\" size=3>".date('d-m-Y',strtotime($datapurchase1['tgl_po']))."</font></td>";
	  }
	  else
	  {
		  echo "";
	  }
	  if($no_hutang<>$datapurchase1['no_hutang'])
	  {
	  echo "<td width=12.5%><font face=\"Courier\" size=3>".date('d-m-Y',strtotime($datapurchase1['tgl_jatuh_tempo']))."</font></td>";
	  }
	  else
	  {
		  echo "";
	  }
	  if($no_hutang<>$datapurchase1['no_hutang'])
	  {
	  echo "<td align='right' width=12.5%><font face=\"Courier\" size=3>".number_format($datapurchase1['kredit'],0,',','.')."</font></td></tr><tr style='background-color:#00ffff;-webkit-print-color-adjust:exact'><th width=12.5%><font face=\"courier\" size=2> NO HUTANG </font></th><th width=12.5%><font face=\"courier\" size=2> NO PO </font></th><th width=12.5%><font face=\"courier\" size=2> TGL PO</font></th><th width=12.5%><font face=\"courier\" size=2> TGL TRANSAKSI </font></th><th width=12.5% colspan=2><font face=\"courier\" size=2> TELAH DIBAYAR </font></th></td></tr>";
	  }
	  else
	  {
		  echo "";
	  }

      while($data = mysql_fetch_array($myresult3)) {

      echo "<td width=12.5%><font face=\"Courier\" size=2>".$data['no_hutang']."</font></td>";
      echo "<td width=12.5%><font face=\"Courier\" size=2>".$data['no_po']."</font></td>";
	  echo "<td width=12.5%><font face=\"Courier\" size=2>".date('d-m-Y', strtotime($data['tgl_po']))."</font></td>";
	  echo "<td width=12.5%><font face=\"Courier\" size=2>".date('d-m-Y', strtotime($data['tgl_transaksi']))."</font></td>";
	  echo "<td width=12.5% colspan=2 align=right><font face=\"Courier\" size=2>".number_format($data['debit'],0,',','.')."</font></td>";
      echo "</tr>";
	  
	  }
	  $no_hutang=$datapurchase1['no_hutang'];
	  
}
echo "</table>";
echo "<font face=\"Courier\" size=4><b><p align='right'>GRAND TOTAL ".number_format($datapurchase2['subtotal'],0,',','.')."</font></b></td>";            

?>

</body>

</html>
