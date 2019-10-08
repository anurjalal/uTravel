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
   <form action="bayarhutang.php" method="POST">
	<td><b>Supplier<br/><select style="height:30px;margin-top:5px" name="id_supplier" size="1">
	<option selected value="">Tidak ada</option>';
		include ('connectdb.php');

		$myquery="SELECT * FROM supplier";
		$myresult= mysql_query($myquery);

		while ($row=mysql_fetch_array($myresult))
		{
		$id_supplier = $row[id_supplier];
		$nama_supplier = rtrim($row[nama_supplier]);
		echo "<option value=\"$id_supplier\">$nama_supplier</option>";
		}

   echo '
	</td>
	<td><input type="submit" style="margin-top:7px" value="Preview"></td>
	</form>
	</tr>

   </table>
   '; ?>
       

       
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
