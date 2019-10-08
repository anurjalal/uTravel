<html>

<title> Laporan Aset </title>

<head>
<font face=\"courier\" size=6><b>LAPORAN ASET PER HARI</b></font>
<br> <br>

<?php
echo "<font face=\"courier\" size=2><b>Tanggal : ".date("d-M-Y")."</b></font>";

echo "<br>";
echo "<br>";

echo "<table border=1 width=100%>";
echo "<tr bgcolor=#ccccff>
      <th width=10%><font face=\"courier\" size=2> NO_RANGKA </font></th>
      <th width=10%><font face=\"courier\" size=2> NO_MESIN </font></th>
      <th width=10%><font face=\"courier\" size=2> KD_TIPE </font></th>
	  <th width=10%><font face=\"courier\" size=2> KD_WARNA </font></th>
	  <th width=10%><font face=\"courier\" size=2> TAHUN </font></th>
	  <th width=10%><font face=\"courier\" size=2> CC </font></th>
      <th width=10%><font face=\"courier\" size=2> JUMLAH </font></th>
      <th width=10%><font face=\"courier\" size=2> HARGA JUAL </font></th>
	  <th width=10%><font face=\"courier\" size=2> NILAI ASET </font></th>
      </tr>";

?>

</head>

<body>
<?php

include ('connectdb.php');
include ('publicfunction.php');

$today=date("Y-m-d");

//$myquery1="SELECT * FROM mstbrg WHERE status = 'A' ORDER BY id_brg";
$myquery1="SELECT * FROM motor m inner join (SELECT distinct kd_tipe, HRG_JUAL, MAX(tgl_start) AS MaxDateTime FROM hrgjual GROUP BY kd_tipe) j on j.kd_tipe=m.kd_tipe";
$myresult1=mysql_query($myquery1);

$totalaset=0;
while ($databrg=mysql_fetch_array($myresult1)) {
   $no_rangka=$databrg['NO_RANGKA'];
   $no_mesin=$databrg['NO_MESIN'];
   $kd_tipe=$databrg['KD_TIPE'];
   $kd_warna=$databrg['KD_WARNA'];
   $tahun=$databrg['TAHUN'];
   $cc=$databrg['CC'];
   $jumlah=$databrg['JUMLAH'];
   $hrg_jual=$databrg['HRG_JUAL'];

   $itemaset = $jumlah * $hrg_jual;
   
   echo "<tr>";
   echo "<td width=10%><font face=\"Courier\" size=2>".$no_rangka."</font></td>";
   echo "<td width=10%><font face=\"Courier\" size=2>".$no_mesin."</font></td>";
   echo "<td width=10%><font face=\"Courier\" size=2>".$kd_tipe."</font></td>";
   echo "<td width=10%><font face=\"Courier\" size=2>".$kd_warna."</font></td>";
   echo "<td width=10%><font face=\"Courier\" size=2>".$tahun."</font></td>";
   echo "<td width=10%><font face=\"Courier\" size=2>".$cc."</font></td>";
   echo "<td width=10% align=right><font face=\"Courier\" size=2>".number_format($jumlah,2)."</font></td>";
   echo "<td width=10% align=right><font face=\"Courier\" size=2>".number_format($hrg_jual,2)."</font></td>";
   echo "<td width=10% align=right><font face=\"Courier\" size=2>".number_format($itemaset,2)."</font></td>";
   echo "</tr>";

   $totalaset = $totalaset + $itemaset;
} // while

echo "<tr>";
echo "<td width=20%>&nbsp</td>";
echo "<td width=30%>&nbsp</td>";
echo "<td width=10%>&nbsp</td>";
echo "<td width=10% align=right><font face=\"Courier\" size=4><b> TOTAL ASET: </b></font></td>";
echo "<td width=10% align=right><font face=\"Courier\" size=4><b>".number_format($totalaset,2)."</b></font></td>";
echo "</tr>";

echo "</table>";      
echo "<br>";

?>

</body>

</html>
