<?php
include "dbcustomer.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM mstcust");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->NM_CUST), $q) !== false) {
		echo "$line->NM_CUST\n";
	
 }
 }

?>