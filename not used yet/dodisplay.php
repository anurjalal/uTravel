<html>

<title> UD. ANUGRAH - Print DO </title>
<body>
<form action="doprint.php" method="POST">

<?php

include ('connectdb.php');
include ('publicfunction.php');

$mydo=$HTTP_POST_VARS['mydo'];

$myquery1="SELECT * FROM do WHERE no_do='$mydo'";
$myresult1=mysql_query($myquery1);

$datado=mysql_fetch_array($myresult1);
$myuserss=$datado['USERSS'];
$currentcust=$datado['KD_CUST'];

$myquery2="SELECT * FROM mstcust WHERE kd_cust='$currentcust'";
$myresult2=mysql_query($myquery2);
$datacust=mysql_fetch_array($myresult2);

$myquery3="SELECT * FROM prncount WHERE no_faktur='$mydo'";
$myresult3=mysql_query($myquery3);
$dataprint=mysql_fetch_array($myresult3);

$datesales = dateconvert($datado['DATE_SALES']);

echo "<table border=0 cellpadding=0 width=750>";
echo "<tr>";
echo "<td width=50%><b><u><font face=courier size=4>DELIVERY ORDER</font></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
     .$datesales."</b></td>";echo "<td width=50%><font face=\"courier\" size=2>Kepada Yth:</font></td>";
echo "</tr>";
echo "</table>";

echo "<table border=0 cellpadding=0 width=750><font face=\"courier\" size=2>";
echo "<tr>";
echo "<td width=10%><font face=\"courier\" size=2>No:</font></td>";
echo "<td width=35%><font face=\"courier\" size=2>".$datado['NO_DO']."</font></td>";
echo "<td width=5%>&nbsp;</td>";
echo "<td width=50%><font face=\"courier\" size=2><b>".$datacust['NM_CUST']."</b></font></td>";
echo "</tr>";

$datedo = dateconvert($datado['D_DO']);

echo "<tr>";
echo "<td width=10%><font face=\"courier\" size=2>Tanggal:</font></td>";
echo "<td width=35%><font face=\"courier\" size=2>".$datedo."</font></td>";
echo "<td width=5%>&nbsp;</td>";
echo "<td width=50%><font face=\"courier\" size=2><b>".$datacust['ALM_CUST']."</b></font></td>";
echo "</tr>";

echo "<tr>";
echo "<td width=10%>&nbsp;</td>";
echo "<td width=35%><font face=\"courier\" size=2>".$datado['D_SALES']."/".$datado['KD_CUST']."</font></td>";
echo "<td width=5%>&nbsp;</td>";
echo "<td width=50%><font face=\"courier\" size=2><b>".$datacust['KOTA_CUST']."</b></font></td>";
echo "</tr></table>";

$myquerydetail="SELECT * FROM dodetail WHERE no_do='$mydo'";

$myresultdetail=mysql_query($myquerydetail);

$myrows=mysql_num_rows($myresultdetail);

echo "<hr>";
echo "<table border=0 cellpadding=0 width=750>";
echo "<tr bgcolor=#ccccff>
      <th width=8%><font face=\"courier\" size=2> QTY </font></th>
      <th width=3%> </th>
      <th width=50%><font face=\"courier\" size=2> NAMA BARANG </font></th>
      <th width=11%><font face=\"courier\" size=2> HARGA </font></th>
      <th width=15%><font face=\"courier\" size=2> KETERANGAN </font></th>
      </tr>
      </table>";
echo "<hr>";

echo "<table border=0 cellpadding=0 width=750>";
for ($i=0;$i<$myrows;$i++){
      $datadodetail=mysql_fetch_array($myresultdetail);
      echo "<tr>";
      echo "<td align=right><font face=\"Courier\" size=2>".intval($datadodetail['JUMLAH'])."</font></td>";
      echo "<td><font face=\"Courier\" size=2>".$datadodetail['SATUAN']."</font></td>";
      echo "<td><font face=\"Courier\" size=2>".$datadodetail['NM_BRG']."</font></td>";
      echo "<td align=right><font face=\"Courier\" size=2>".number_format($datadodetail['PRICE'])."</font></td>";
      echo "<td><font face=\"Courier\" size=2>".$datadodetail['DESCS']."</font></td>";
      echo "</tr>";
}

$emptyrows=15-$myrows;
for ($i=0;$i<$emptyrows;$i++){
      echo "<tr>";
      echo "<td><font face=\"Courier\" size=2>&nbsp</td>";
      echo "</tr>";
}

echo "</table>";      
echo "<hr>";

echo "<table border=0 cellpadding=3 width=750>";
echo "<tr>";
echo "<td width=20%><font face=\"Courier\" size=2> Pembuat, </font></td>";
echo "<td width=20%><font face=\"Courier\" size=2> Dikeluarkan Oleh, </font></td>";
echo "<td width=20%><font face=\"Courier\" size=2> Acc, </font></td>";
echo "<td width=20%><font face=\"Courier\" size=2> Bag. Packing, </font></td>";
echo "<td width=20%>&nbsp</td>";
echo "</tr>";

echo "<tr>";
echo "<td width=20%>&nbsp</td>";
echo "<td width=20%>&nbsp</td>";
echo "<td width=20%>&nbsp</td>";
echo "<td width=20%>&nbsp</td>";
echo "<td width=20% align=right><font face=\"Courier\" size=1>".date("d M Y")."</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td width=20%><font face=\"Courier\" size=2><u>".$myuserss."</u></font></td>";
echo "<td width=20%> _________________ </td>";
echo "<td width=20%> _________________ </td>";
echo "<td width=20%> _________________ </td>";
echo "<td width=20% align=right><font face=\"Courier\" size=1>No.print: ".$dataprint['iCOUNT']."</font></td>";
echo "</tr>";
echo "</font></table>";

$updquery="UPDATE do SET status='P' WHERE no_do='$mydo'";
$updresult=mysql_query($updquery); 

//echo "<p align=\"center\"><a href=\"mainpage.php\">Lihat DO lain</a></p>";
      
?>

</body>
</html>
