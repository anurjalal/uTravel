<?php
include "dbkoneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM supplier");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->nama_supplier), $q) !== false) {
		echo "$line->nama_supplier\n";
	
 }
 }

?>