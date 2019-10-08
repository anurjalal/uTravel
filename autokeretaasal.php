<?php
include "dbkoneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM masterstasiun");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->nama_stasiun), $q) !== false) {
		echo "$line->nama_stasiun\n";
	
 }
 }

?>