<html>

<title> Laporan Kas </title>

<head>
<font face="courier" size=3><b>LAPORAN KAS</b></font>

<?php
include ('publicfunction.php');
include_once ('db.php');


echo "<br>";
echo "<br>";

?>

</head>

<body>
<?php
include ('connectdb.php');


//batas
echo "<font face=\"courier\" size=3><b>KAS MASUK";
echo "<table border=1 style='border-collapse: collapse;' width=100%>";
echo "<tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
      <th width=20%><font face=\"courier\" size=2> NO PENJUALAN / NO PIUTANG </font></th>
      <th width=13%><font face=\"courier\" size=2> TGL MASUK </font></th>
      <th width=20%><font face=\"courier\" size=2> KAS MASUK </font></th>
      <th width=20%><font face=\"courier\" size=2> KETERANGAN </font></th>

      </tr>";

//$myquery1="SELECT * FROM trjual WHERE tgl_nota = '$today'";
$myquery1="SELECT * FROM kas
           WHERE kredit=0";
$myresult1=mysql_query($myquery1);

$myrows=mysql_num_rows($myresult1);
$myquery2="SELECT sum(debit) as subtotal FROM kas WHERE kredit=0";
$myresult2=mysql_query($myquery2);
$datakas2=mysql_fetch_array($myresult2);
for ($i=0;$i<$myrows;$i++){
      $datakas=mysql_fetch_array($myresult1);

     
      echo "<tr>";
	  if ($datakas['no_penjualan']!=0)
	  {
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datakas['no_penjualan']."</font></td>";
	  }
	  else
	  {
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datakas['no_piutang']."</font></td>";
	  }		  
      echo "<td width=13%><font face=\"Courier\" size=2><b>".date('d-m-Y',strtotime($datakas['tgl_masuk']))."</font></td>";
	  echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datakas['debit'],0,',','.')."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datakas['keterangan']."</font></td>";


      echo "</tr>";
      
}

;
echo "</table>";
echo "<font face=\"Courier\" size=4><b><p align='right'>TOTAL KAS MASUK ".number_format($datakas2['subtotal'],0,',','.')."</font></b></p></td>";            
echo "<font face=\"courier\" size=3><b>KAS KELUAR";
echo "<table border=1 style='border-collapse: collapse;' width=100%>";
echo "<tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
      <th width=20%><font face=\"courier\" size=2> NO PO / NO HUTANG </font></th>
      <th width=13%><font face=\"courier\" size=2> TGL KELUAR </font></th>
      <th width=20%><font face=\"courier\" size=2> KAS KELUAR </font></th>
      <th width=20%><font face=\"courier\" size=2> KETERANGAN </font></th>

      </tr>";

//$myquery1="SELECT * FROM trjual WHERE tgl_nota = '$today'";
$myquery4="SELECT * FROM kas
           WHERE debit=0";
$myresult4=mysql_query($myquery4);

$myrows4=mysql_num_rows($myresult4);
$myquery5="SELECT sum(kredit) as subtotal FROM kas WHERE debit=0";
$myresult5=mysql_query($myquery5);
$datakas5=mysql_fetch_array($myresult5);
for ($i=0;$i<$myrows4;$i++){
      $datakas4=mysql_fetch_array($myresult4);

     
      echo "<tr>";
	  if ($datakas4['no_po']!=0)
	  {
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datakas4['no_po']."</font></td>";
	  }
	  else
	  {
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datakas4['no_hutang']."</font></td>";
	  }
	  echo "<td width=13%><font face=\"Courier\" size=2><b>".date('d-m-Y',strtotime($datakas4['tgl_keluar']))."</font></td>";
	  echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datakas4['kredit'],0,',','.')."</font></td>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datakas4['keterangan']."</font></td>";


      echo "</tr>";
      
}

;
echo "</table>";
echo "<font face=\"Courier\" size=4><b><p align='right'>TOTAL KAS KELUAR ".number_format($datakas5['subtotal'],0,',','.')."</font></b></td>";            
echo "<font face=\"Courier\" size=4><b><p align='right'>TOTAL KAS SEKARANG ".number_format($datakas2['subtotal']-$datakas5['subtotal'],0,',','.')."</font></b></td>";
?>

</body>

</html>
