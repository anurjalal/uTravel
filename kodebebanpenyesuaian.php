<?php
include "dbcustomer.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT kd_gabungan as kd_beban,nm_subbeban as nm_beban FROM subgroupbiaya UNION select kd_beban,nm_beban from groupbiaya");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->nm_beban), $q) !== false) {
		echo "$line->kd_beban,$line->nm_beban\n";
	
 }
 }

?>