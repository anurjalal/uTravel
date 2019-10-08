<?php
include "dbkoneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM masterkereta");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->nama_kereta), $q) !== false) {
		echo "$line->nama_kereta\n";
	
 }
 }

?>