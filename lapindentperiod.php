<html>

<title> Laporan Indent </title>

<head>
<font face="courier" size=3><b>LAPORAN INDENT PERIODE</b></font>
<br> <br>

<?php
include ('publicfunction.php');

$startdate = $_POST["date1"];
$enddate = $_POST["date2"];

echo "<font face=\"courier\" size=3><b>Tanggal : ".date('d-M-Y',strtotime($startdate))." sampai ".date('d-M-Y',strtotime($enddate))."</b></font>";

echo "<br>";
echo "<br>";

?>

</head>

<body>
<?php
include ('connectdb.php');
$tahunawal = date("Y",strtotime($startdate));
$bulanawal = date("m",strtotime($startdate));
$tanggalawal = date("d",strtotime($startdate));
$tahunakhir = date("Y",strtotime($enddate));
$bulanakhir = date("m",strtotime($enddate));
$tanggalakhir = date("d",strtotime($enddate));
$awal = mktime(7, 0, 0, $bulanawal, $tanggalawal, $tahunawal);
$akhir = mktime(30, 59, 59, $bulanakhir, $tanggalakhir, $tahunakhir);
$tanggalawal = gmdate('Y-m-d H:i:s', $awal);
$tanggalakhir = gmdate('Y-m-d H:i:s', $akhir);
echo "<table border=1 style='border-collapse: collapse;' width=100%>";
echo "<tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
      <th width=20%><font face=\"courier\" size=2> TGL TRANSAKSI </font></th>
      <th width=13%><font face=\"courier\" size=2> NO PESANAN </font></th>
      <th width=10%><font face=\"courier\" size=2> PEMBAYARAN </font></th>
      <th width=20%><font face=\"courier\" size=2> CUSTOMER </font></th>
      <th width=20%><font face=\"courier\" size=2> ALAMAT </font></th>
	  <th width=20%><font face=\"courier\" size=2> KODE </font></th>
	  <th width=20%><font face=\"courier\" size=2> TIPE </font></th>
	  <th width=20%><font face=\"courier\" size=2> NAMA TIPE </font></th>
	  <th width=20%><font face=\"courier\" size=2> WARNA </font></th>
	  <th width=20%><font face=\"courier\" size=2> NO. RANGKA </font></th>
	  <th width=20%><font face=\"courier\" size=2> NO. MESIN </font></th>
      <th width=10%><font face=\"courier\" size=2> LEASING </font></th>
      <th width=10%><font face=\"courier\" size=2> UANG MUKA </font></th>
      <th width=10%><font face=\"courier\" size=2> TENOR BULAN </font></th>
      <th width=10%><font face=\"courier\" size=2> ANGSURAN </font></th>
      <th width=10%><font face=\"courier\" size=2> HARGA </font></th>
      <th width=10%><font face=\"courier\" size=2> DISKON </font></th>
      <th width=10%><font face=\"courier\" size=2> DISKON INTERNAL </font></th>
      <th width=10%><font face=\"courier\" size=2> DISKON PROMO </font></th>
      <th width=10%><font face=\"courier\" size=2> PPN </font></th>
      <th width=10%><font face=\"courier\" size=2> DP </font></th>
      <th width=10%><font face=\"courier\" size=2> TOTAL </font></th>
      </tr>";

//$myquery1="SELECT * FROM trjual WHERE tgl_nota = '$today'";
$myquery1="SELECT * FROM spes left outer join leasingspes on leasingspes.no_pesanan=spes.no_pesanan
           WHERE spes.status='INDENT' and spes.tgl_pesanan between '$tanggalawal' and '$tanggalakhir'";
$myresult1=mysql_query($myquery1);

$myrows=mysql_num_rows($myresult1);
$myquery2="SELECT sum(hrg_total) as subtotal FROM spes where spes.status='INDENT' and spes.tgl_pesanan between '$tanggalawal' and '$tanggalakhir'";
$myresult2=mysql_query($myquery2);
$datainvoice2=mysql_fetch_array($myresult2);
for ($i=0;$i<$myrows;$i++){
      $datainvoice=mysql_fetch_array($myresult1);

      $custcode=$datainvoice['KD_CUST'];

      $myquery2="SELECT * FROM mstcust WHERE kd_cust='$custcode'";
      $myresult2=mysql_query($myquery2);

      $datacust=mysql_fetch_array($myresult2);
      $myquery3="SELECT * FROM mstlease WHERE kd_lease='".$datainvoice['KD_LEASE']."'";
      $myresult3=mysql_query($myquery3);

      $datalease=mysql_fetch_array($myresult3);
     
      echo "<tr>";
	  echo "<td width=20%><font face=\"Courier\" size=2><b>".date('d-m-Y',strtotime($datainvoice['TGL_TRANSAKSI']))."</font></td>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datainvoice['NO_PESANAN']."</font></td>";
      echo "<td width=13%><font face=\"Courier\" size=2><b>".$datainvoice['SISTEM_BYR']."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datacust['NM_CUST']."</font></td>";
	  echo "<td width=20%><font face=\"Courier\" size=2><b>".$datacust['ALMT_CUST'].' '.$datacust['KELURAHAN'].' '.$datacust['KECAMATAN'].' '.$datacust['KOTA_CUST'].' '.$datacust['PROVINSI']."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datainvoice['KD_ASTRA']."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datainvoice['KD_TIPE']."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datainvoice['NM_TIPE']."</font></td>";
      echo "<td width=12.5%><font face=\"Courier\" size=2><b>".getfield('mstwarna', 'KD_WARNA', $datainvoice['KD_WARNA'], 'NM_WARNA')."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datainvoice['NO_RANGKA']."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datainvoice['NO_MESIN']."</font></td>";
      echo "<td width=20%><font face=\"Courier\" size=2><b>".$datalease['NM_LEASE']."</font></td>";
      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datainvoice['UANGMUKA'],0,',','.')."</font></td>";
      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".$datainvoice['BLNKREDIT']."</font></td>";
      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datainvoice['ANGSURAN'],0,',','.')."</font></td>";

      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datainvoice['HRG_JUAL'],0,',','.')."</font></td>";
      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datainvoice['DISKON'],0,',','.')."</font></td>";
      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datainvoice['DISKON_INT'],0,',','.')."</font></td>";
      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datainvoice['DISKON_PROMO'],0,',','.')."</font></td>";
      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datainvoice['PPN'],0,',','.')."</font></td>";
      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datainvoice['UANG_MUKA'],0,',','.')."</font></td>";
      echo "<td align='right' width=20%><font face=\"Courier\" size=2><b>".number_format($datainvoice['HRG_TOTAL'],0,',','.')."</font></td>";

      echo "</tr>";
      
}

;
echo "</table>";      
echo "<font face=\"Courier\" size=4><b><p align='right'>GRAND TOTAL ".number_format($datainvoice2['subtotal'],0,',','.')."</font></b></td>";            

?>

</body>

</html>
