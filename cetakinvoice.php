<html>
<?php
	session_start();
	include_once "db.php";
	error_reporting (E_ALL ^ E_NOTICE);
?>
<?php
function indonesian_date ($timestamp = '', $date_format = 'j F Y') {
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    //$date = preg_replace ($pattern, $replace, $date);
	$date = preg_replace ($pattern, $replace, $date);
    $date = "{$date}";
    return $date;
}
?>
<head>
<title>Tanda Terima Pembelian</title>
</head>
				  <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $username = $_SESSION['LOGIN_NAME'];
				  $lineuser = $db->queryUniqueObject("SELECT NM_USER FROM userlog WHERE LOGIN_NAME='$username'");
				  $line = $db->queryUniqueObject("SELECT * FROM penjualan WHERE no_invoice='$id'");
				  $linetotal = $db->queryUniqueObject("SELECT sum(hrgjualdgnpajak) as hargajualdenganpajak FROM penjualan WHERE no_invoice='$id'");
				  }
				  ?>
<body style="text-align: center; font-weight: bold;">
<center>
<table style="border: 1px solid black;">
<tr>
<td>INVOICE</td>
</tr>
</table>
<table width="90%">
<tr>
<td rowspan="3"><img width="50%" src="images/logo.jpg"></td>
<td><b style="margin-left:-30px">PT. UNDIP MAJU</b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>No. Invoice : <?php echo $id;?></td>

</tr>
<tr>
<td width="300px"><font style="margin-left:-30px">(UNDIP MANDIRI ANEKA JAYA USAHA)</font></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td width="150px">Tanggal: <?php echo date('d-m-Y');?></td>
</tr>
<tr>
<td><font style="margin-left:-30px">Jl. Prof. Soedarto, SH Tembalang, Semarang</font></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td width="150px">Customer: </td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td width="150px"><?php echo wordwrap($line->nama_customer);?></td>
</tr>
</table>
</center>
<center>
<table border="1" style="border-collapse: collapse" width="90%">
<tr>
<th>NO</th>
<th>JENIS&nbsp;&nbsp;PESANAN</th>
<th>JUMLAH</th>
<th>HARGA&nbsp;&nbsp;SATUAN</th>
<th>TOTAL</th>
</tr>

<?php
$myquery="SELECT * FROM penjualan where no_invoice='$id'";
$myresult=mysql_query($myquery);
$i=1;
while ($data=mysql_fetch_array($myresult)) {
?>
<tr>
<td align="center"><?php echo $i;?><br><br><br><br></td>
<td align="center"><?php echo $data['tipe'];?><br><?php echo wordwrap($data['keterangan'])?><br><br><br></td>
<td align="center"><?php echo $data['jumlah'];?><br><br><br><br></td>
<td align="center">Rp. <?php echo number_format($data['hargajual'],0,',','.');?><br><br><br><br></td>
<td align="right">Rp. <?php echo number_format($data['hrgjualdgnpajak'],0,',','.');?><br><br><br><br></td>
</tr>
<?php $i++;} ?>

<tr>
<td align="center" colspan="4">TOTAL PEMBAYARAN</td>
<td align="right">Rp. <?php echo number_format($linetotal->hargajualdenganpajak,0,',','.');?></td>
</tr>
</table>
</center>

<br>

<table width="90%">
<tr>
<td><b style="margin-left:30px">Keterangan: </b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><center>Pemohon</center></td>

</tr>
<tr>
<td><font style="margin-left:30px">1 _____________________________</font></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><font style="margin-left:30px">2 _____________________________</font></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><font style="margin-left:30px">3 _____________________________</font></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><center><?php echo $lineuser->NM_USER?></center></td>
</tr>
</table>
</body>
</html>
