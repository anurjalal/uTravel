<?php
include "dbkoneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM masterbandara");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->nama_kota), $q) !== false) {
		echo "$line->nama\n";
	
 }
 }

?>