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
   <td><font size="5"><b>Ufood</td>
   </tr>
   <tr>
   <?php
            echo '<form action="lappembeliantoday.php" method="POST">';
	        echo ' <td><b><i>Hari ini:      </i></b></td>';
            echo '<td><input type="submit" value="Preview"></td>';
            echo '</form>';
   ?>
   </tr>

   <tr>
   <?php
            echo '<form action="lappembelianperiod.php" method="POST">';
            echo '<td><b><i>Periode:      </i></b></td>';
	        echo '<td><input type="submit" value="Preview"></td>';
	        echo '<td><b>Awal<br/><input style="height:30px;margin-top:7px" type="text" id="date1" name="date1" value="'.date('01-m-Y').'"></td>';
	        echo '<td><b>Akhir<br/><input style="height:30px;margin-top:7px" type="text" id="date2" name="date2" value="'.date('d-m-Y').'"></td>';
            echo '</form>';
   ?>
   </tr>


   <tr>
   <?php
//        if ($username == "root" or $username == "admin" or $username == "supervisor") {
//           echo '<form action="lappembelianperiodperitem.php" method="POST">
//	             <td><b><i>Periode per No Plat:      </i></b></td>
//                 <td><input type="submit" value="Preview"></td>
//                 <td>Area:  <input type="text" name="kdarea" ></td>
//	             <td>No:  <input type="text" name="noplat" ></td>
//	             <td>Kode:  <input type="text" name="kdplat" ></td>
//                 </form>'
//        }
   ?>
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
