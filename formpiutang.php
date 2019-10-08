<?php
session_start();
if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Administrator'){
include 'base.php'; }
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Sales'){
include 'basesales.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Kasir'){
include 'basekasir.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Finance'){
include 'basefinance.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Warehouse'){
include 'basewarehouse.php';}
?>
<?php startblock('konten') ?>
<link rel="shortcut icon" href="favicon.png"/>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script language="javascript" src="calendar/calendar.js"></script>
   <br>
   <center>
   <table border=0 cellpadding=20>
   <tr>

   <?php

   echo '

   <tr>
   <form action="terimapiutang.php" method="POST">
	<td><b>Customer<br/><select style="height:30px;margin-top:5px" name="id_customer" size="1">
	<option selected value="">Tidak ada</option>';
		include ('connectdb.php');

		$myquery="SELECT * FROM customer";
		$myresult= mysql_query($myquery);

		while ($row=mysql_fetch_array($myresult))
		{
		$id_customer = $row[id_customer];
		$nama_customer = rtrim($row[nama_customer]);
		echo "<option value=\"$id_customer\">$nama_customer</option>";
		}

   echo '
   </td>
   <td><input type="submit" style="margin-top:7px" value="Preview"></td>      
   </form>
   </tr>

   </table>
   ';
   ?>

      
       
       
<?php endblock() ?>
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_awal'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('tgl_akhir'),
		format : "DD-MM-YYYY",
    });
</script>
