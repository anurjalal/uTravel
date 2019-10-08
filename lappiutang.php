<html>

<title> Laporan Piutang </title>

<head>
<font face="courier" size=3><b>LAPORAN PIUTANG</b></font>

<?php
include ('publicfunction.php');


echo "<br>";
echo "<br>";

?>

</head>

<body>
<?php
include ('connectdb.php');
echo "KAS MASUK";
echo "<table border=1 style='border-collapse: collapse;' width=100%>";
echo "<tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
      <th width=20%><font face=\"courier\" size=2> NAMA CUSTOMER </font></th>
      <th width=13%><font face=\"courier\" size=2> KODE PENJUALAN </font></th>
      <th width=10%><font face=\"courier\" size=2> NAMA CUSTOMER </font></th>
      <th width=20%><font face=\"courier\" size=2> KAS MASUK </font></th>
      </tr>";

//$myquery1="SELECT * FROM trjual WHERE tgl_nota = '$today'";
$myquery1="SELECT * FROM kas
           WHERE kredit=0 and no_penjualan<>''";
$myresult1=mysql_query($myquery1);

$myrows=mysql_num_rows($myresult1);
$myquery2="SELECT sum(debit) as subtotal FROM kas";
$myresult2=mysql_query($myquery2);
$datakas2=mysql_fetch_array($myresult2);
for ($i=0;$i<$myrows;$i++){
      $datakas=mysql_fetch_array($myresult1);

     
      echo "<tr>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datakas['NO_PENJUALAN']."</font></td>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".date('d-m-Y',strtotime($datakas['TGL_PENJUALAN']))."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datakas['NM_CUST']."</font></td>";
	  echo "<td width=20%><font face=\"Courier\" size=2><b>".number_format($datakas['DEBIT'],2,'.',',')."</font></td>";


      echo "</tr>";
      
}

;
echo "</table>";
echo "<table border=1 style='border-collapse: collapse;' width=100%>";
echo "<tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
      <th width=20%><font face=\"courier\" size=2> NO. KWITANSI </font></th>
      <th width=13%><font face=\"courier\" size=2> TGL MASUK </font></th>
      <th width=10%><font face=\"courier\" size=2> DARI </font></th>
      <th width=20%><font face=\"courier\" size=2> KAS MASUK </font></th>
      </tr>";

//$myquery1="SELECT * FROM trjual WHERE tgl_nota = '$today'";
$myquery3="SELECT * FROM kas
           WHERE kredit=0 and no_kwt<>'' and no_penjualan=''";
$myresult3=mysql_query($myquery3);

$myrows3=mysql_num_rows($myresult3);

for ($i=0;$i<$myrows3;$i++){
      $datakas3=mysql_fetch_array($myresult3);

     
      echo "<tr>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datakas3['NO_KWT']."</font></td>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".date('d-m-Y',strtotime($datakas3['TGL_MASUK']))."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datakas3['DARI']."</font></td>";
	  echo "<td width=20%><font face=\"Courier\" size=2><b>".number_format($datakas3['DEBIT'],2,'.',',')."</font></td>";


      echo "</tr>";
      
}

;
echo "</table>";      
echo "<font face=\"Courier\" size=4><b><p align='right'>TOTAL KAS MASUK ".$datakas2['subtotal']."</font></b></p></td>";            
echo "KAS KELUAR";
echo "<table border=1 style='border-collapse: collapse;' width=100%>";
echo "<tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
      <th width=20%><font face=\"courier\" size=2> KODE PEMBELIAN </font></th>
      <th width=13%><font face=\"courier\" size=2> TGL PEMBELIAN </font></th>
      <th width=13%><font face=\"courier\" size=2> SUPPLIER </font></th>
      <th width=20%><font face=\"courier\" size=2> KAS KELUAR </font></th>
      </tr>";

//$myquery1="SELECT * FROM trjual WHERE tgl_nota = '$today'";
$myquery4="SELECT * FROM kas
           WHERE debit=0 and no_pembelian<>''";
$myresult4=mysql_query($myquery4);

$myrows4=mysql_num_rows($myresult4);
$myquery5="SELECT sum(kredit) as subtotal FROM kas";
$myresult5=mysql_query($myquery5);
$datakas5=mysql_fetch_array($myresult5);
for ($i=0;$i<$myrows4;$i++){
      $datakas4=mysql_fetch_array($myresult4);

     
      echo "<tr>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datakas4['NO_PEMBELIAN']."</font></td>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".date('d-m-Y',strtotime($datakas4['TGL_PEMBELIAN']))."</font></td>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>ASTRA INTERNASIONAL</font></td>";
	  echo "<td width=20%><font face=\"Courier\" size=2><b>".number_format($datakas4['KREDIT'],2,'.',',')."</font></td>";


      echo "</tr>";
      
}

;
echo "</table>";
echo "<table border=1 style='border-collapse: collapse;' width=100%>";
echo "<tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
      <th width=20%><font face=\"courier\" size=2> NO. BKU </font></th>
      <th width=13%><font face=\"courier\" size=2> TGL KELUAR </font></th>
      <th width=13%><font face=\"courier\" size=2> KEPADA </font></th>
      <th width=20%><font face=\"courier\" size=2> KAS KELUAR </font></th>
      </tr>";

//$myquery1="SELECT * FROM trjual WHERE tgl_nota = '$today'";
$myquery6="SELECT * FROM kas
           WHERE debit=0 and no_bku<>'' and no_pembelian=''";
$myresult6=mysql_query($myquery6);

$myrows6=mysql_num_rows($myresult6);

for ($i=0;$i<$myrows6;$i++){
      $datakas6=mysql_fetch_array($myresult6);

     
      echo "<tr>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datakas6['NO_BKU']."</font></td>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".date('d-m-Y',strtotime($datakas6['TGL_KELUAR']))."</font></td>";
	  echo "<td width=20%><font face=\"Courier\" size=2><b>".$datakas6['KEPADA']."</font></td>";
	  echo "<td width=20%><font face=\"Courier\" size=2><b>".number_format($datakas6['KREDIT'],2,'.',',')."</font></td>";


      echo "</tr>";
      
}

;
echo "</table>";
echo "<font face=\"Courier\" size=4><b><p align='right'>TOTAL KAS KELUAR ".$datakas5['subtotal']."</font></b></td>";            

?>

</body>

</html>
