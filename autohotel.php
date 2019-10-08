<?php
include "dbkoneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM masterhotel");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->nama_hotel), $q) !== false) {
		echo "$line->nama_hotel\n";
	
 }
 }

?>