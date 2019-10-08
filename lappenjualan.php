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
   <td><font size="5"><b>Pesanan</td>
   </tr>
   <tr>
   <form action="lappesanantoday.php" method="POST">
    <td><b><i>Hari ini:      </i></b></td>
    <td><input type="submit" value="Preview"></td>
   </form>
   </tr>

   <tr>
   <form action="lappesananperiod.php" method="POST">
	<td><b><i>Periode:      </i></b></td>
	<td><input type="submit" value="Preview"></td>
	<td><b>Awal<br/><input style="height:30px;margin-top:7px" type="text" id="date1" name="date1" value="<?php echo date('01-m-Y')?>"></td>
       <td><b>Akhir<br/><input style="height:30px;margin-top:7px" type="text" id="date2" name="date2" value="<?php echo date('d-m-Y')?>"></b> </td>
   </form>
   </tr>
   
   <tr>
   <form action="lappesanantotal.php" method="POST">
    <td><b><i>Total:      </i></b></td>
    <td><input type="submit" value="Preview"></td>
   </form>
   </tr>
   </table>
   <br/>
   <table border=0 cellpadding=20>
   <tr>
   <td><font size="5"><b>Penjualan</td>
   </tr>
   <tr>
   <form action="lappenjualantoday.php" method="POST">
    <td><b><i>Hari ini:      </i></b></td>
    <td><input type="submit" value="Preview"></td>
   </form>
   </tr>

   <tr>
   <form action="lappenjualanperiod.php" method="POST">
	<td><b><i>Periode:      </i></b></td>
	<td><input type="submit" value="Preview"></td>
	<td><b>Awal<br/><input style="height:30px;margin-top:7px" type="text" id="date3" name="date3" value="<?php echo date('01-m-Y')?>"></td>
	<td><b>Akhir<br/><input style="height:30px;margin-top:7px" type="text" id="date4" name="date4" value="<?php echo date('d-m-Y')?>"></td>
   </form>
   </tr>
   
   <tr>
   <form action="lappenjualantotal.php" method="POST">
    <td><b><i>Total:      </i></b></td>
    <td><input type="submit" value="Preview"></td>
   </form>
   </tr>   

   </table>
<?php endblock() ?>
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('date1'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('date2'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('date3'),
		format : "DD-MM-YYYY",
    });
    var picker = new Pikaday({
        field: document.getElementById('date4'),
		format : "DD-MM-YYYY",
    });
</script>

