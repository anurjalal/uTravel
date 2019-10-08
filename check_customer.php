<?php
include "dbkoneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM customer");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->nama_customer), $q) !== false) {
		echo "$line->nama_customer\n";

 }
 }

?>
