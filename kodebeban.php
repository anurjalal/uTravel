<?php
include "dbcustomer.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM groupbiaya");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->KD_BEBAN), $q) !== false) {
		echo "$line->KD_BEBAN\n";
	
 }
 }

?>