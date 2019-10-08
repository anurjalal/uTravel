<html>

<title> UD. ANUGRAH - Print Invoice </title>
<body>
<form action="invoiceprint.php" method="POST">

<?php

include ('connectdb.php');
include ('publicfunction.php');

$mydo=$HTTP_POST_VARS['mydo'];

$queryinvoice="SELECT * FROM trjual WHERE no_faktur='$myinvoice'";
$resultinvoice=mysql_query($queryinvoice);
$datainvoice=mysql_fetch_array($resultinvoice);

$currentcust=$datainvoice['KD_CUST'];

$querycust="SELECT * FROM mstcust WHERE kd_cust='$currentcust'";
$resultcust=mysql_query($querycust);
$datacust=mysql_fetch_array($resultcust);

$queryprint="SELECT * FROM prncount WHERE no_faktur='$myinvoice'";
$resultprint=mysql_query($queryprint);
$dataprint=mysql_fetch_array($resultprint);

$user=$datainvoice['USER'];

$queryuser="SELECT * FROM userlog WHERE login_name='$user'";
$resultuser=mysql_query($queryuser);
$datauser=mysql_fetch_array($resultuser);
$maker=$datauser['NM_USER'];

echo "<table border=0 cellpadding=0 width=750>";
echo "<tr>";
echo "<td width=25%><b><font face=courier size=4>ANUGRAH</font></b></td>";
echo "<td width=30% align=center><b><u><font face=courier size=4>BUKTI TITIPAN</font></u></b></td>";
echo "<td width=45%><font face=courier size=2>Kepada Yth:</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td width=25%><font face=\"courier\" size=2><b>Semarang</b></font></td>";
echo "<td width=30%>&nbsp;</td>";
echo "<td width=45%><font face=\"courier\" size=2><b>".$datacust['NM_CUST']."</b></font></td>";
echo "</tr>";
echo "</table>";

$dateinvoice = dateconvert($datainvoice['TGL_FAKTUR']);

echo "<table border=0 cellpadding=0 width=750><font face=\"courier\" size=2>";
echo "<tr>";
echo "<td width=5%><font face=\"courier\" size=2>No:</font></td>";
echo "<td width=20%><font face=\"courier\" size=2>".$datainvoice['NO_FAKTUR']."</font></td>";
echo "<td width=30%><font face=\"courier\" size=2>Tanggal:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dateinvoice."</font></td>";
echo "<td width=45%><font face=\"courier\" size=2><b>".$datacust['ALM_CUST']."</b></font></td>";
echo "</tr>";

$duedate = dateconvert($datainvoice['DUE_DATE']);

echo "<tr>";
echo "<td width=5%>&nbsp;</td>";
echo "<td width=20%><font face=\"courier\" size=2>".$datainvoice['KD_SALES']."/"
     .$datainvoice['KD_CUST']."</font></td>";
echo "<td width=30%><font face=\"courier\" size=2>Jatuh Tempo: ".$duedate."</font></td>";
echo "<td width=45%><font face=\"courier\" size=2><b>".$datacust['KOTA_CUST']."</b></font></td>";
echo "</tr></table>";

$querydetail="SELECT DISTINCT * FROM trjualdetail WHERE no_faktur='$myinvoice'";
$resultdetail=mysql_query($querydetail);
$myrows=mysql_num_rows($resultdetail);

echo "<hr>";
echo "<table border=0 cellpadding=0 width=750>";
echo "<tr bgcolor=#ccccff>
      <th width=8%><font face=\"courier\" size=2> QTY </font></th>
      <th width=5%> </th>
      <th width=50%><font face=\"courier\" size=2> NAMA BARANG </font></th>
      <th width=11%><font face=\"courier\" size=2> HARGA JUAL </font></th>
      <th width=13%><font face=\"courier\" size=2> JUMLAH </font></th>
      </tr>
      </table>";
echo "<hr>";

echo "<table border=0 cellpadding=0 width=750>";

$total=0;
for ($i=0;$i<$myrows;$i++){
      $datainvoicedetail=mysql_fetch_array($resultdetail);
      $currentitem=$datainvoicedetail['KD_BRG'];

      $queryitem="SELECT * FROM mstbrg WHERE kd_brg='$currentitem'";
      $resultitem=mysql_query($queryitem);
      $dataitem=mysql_fetch_array($resultitem);

      echo "<tr>";
      echo "<td align=right><font face=\"Courier\" size=2>".intval($datainvoicedetail['QTY_BESAR'])."</font></td>";
      echo "<td><font face=\"Courier\" size=2>".$dataitem['SAT_JUALB']."</font></td>";
      echo "<td><font face=\"Courier\" size=2>".$datainvoicedetail['NM_BRG']."</font></td>";
      echo "<td align=right><font face=\"Courier\" size=2>".number_format($datainvoicedetail['HRG_JUALB'])."</font></td>";
      echo "<td align=right><font face=\"Courier\" size=2>".number_format($datainvoicedetail['SubTotal'])."</font></td>";
      $total=$total+$datainvoicedetail['SubTotal'];
      echo "</tr>";
}

$emptyrows=15-$myrows;
for ($i=0;$i<$emptyrows;$i++){
      echo "<tr>";
      echo "<td><font face=\"Courier\" size=2>&nbsp</font></td>";
      echo "</tr>";
}

echo "</table>";
echo "<hr>";

echo "<table border=0 cellpadding=3 width=750>";
echo "<tr>";
echo "<td width=45%><font face=\"Courier\" size=2><i><b> Note: </b>Pembayaran 14 hari </i></font></td>";
echo "<td width=15%>&nbsp</td>";
echo "<td width=15%><font face=\"Courier\" size=2><b> TOTAL </b></font></td>";
echo "<td width=25% align=right><font face=\"Courier\" size=2><b>Rp. ".number_format($total)."</b></font></td>";
echo "</tr>";
echo "</table>";

echo "<table border=0 cellpadding=4 width=750>";
echo "<tr>";
echo "<td width=15%>&nbsp</td>";
echo "<td width=35% align=center valign=bottom><font face=\"Courier\" size=2> (............) </font></td>";
echo "<td width=35% align=center valign=bottom><font face=\"Courier\" size=2><u> $maker </u></font></td>";
echo "<td width=15%>&nbsp</td>";
echo "</tr>";

echo "<tr>";
echo "<td width=15%>&nbsp</td>";
echo "<td width=35% align=center><font face=\"Courier\" size=2> Penerima </font></td>";
echo "<td width=35% align=center><font face=\"Courier\" size=2> Pembuat </font></td>";
echo "<td width=15%>&nbsp</td>";
echo "</tr>";
echo "</table>";

//$updquery="UPDATE do SET status='P' WHERE no_do='$mydo'";

?>

</body>
</html>
