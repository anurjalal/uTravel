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
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <p align="center"><font size="3"><strong>Buku Piutang</strong></font></p>
	<center>
	<br/>
	<span class="add-on"><i class="fa fa-search"></i></span>
	<input style="height: 30px" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian..">
<div id="data-piutang"></div>
</center>
<script src="jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="aplikasipiutang.js"></script>
<?php endblock() ?>
