<?php
include "dbcustomer.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM groupbiaya where nm_beban LIKE '%Pendapatan%'");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->NM_BEBAN), $q) !== false) {
		echo "$line->KD_BEBAN,$line->NM_BEBAN\n";
	
 }
 }

?>