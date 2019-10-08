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

<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <p align="center"><font size="3"><strong>Pembayaran Hutang Awal</strong></font></p>
	<center>
	<span class="add-on"><i class="fa fa-search"></i></span>
	<input style="height: 30px" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian..">

<div id="data-bkuhutang"></div>
</center>
<script src="jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="aplikasibkuhutang.js"></script>
<?php endblock() ?>