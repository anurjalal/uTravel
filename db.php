<?php

include("db.class.php");

// Open the base (construct the object):
include("setting.php");


$db = new DB($base, $server, $user, $pass);



//Koneksi Pop-Up
mysql_connect("localhost","root","");
mysql_select_db("utravel");
?>
