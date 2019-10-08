<?php
include "dbkoneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM masterpesawat");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->nama_maskapai), $q) !== false) {
		echo "$line->nama_maskapai\n";
	
 }
 }

?>