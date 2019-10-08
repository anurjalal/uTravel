<?php
include "dbcustomer.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT kd_gabungan,nm_subbeban,kategori FROM subgroupbiaya UNION select * from groupbiaya where nm_beban LIKE '%Biaya%'");
  while ($line = $db->fetchNextObject()) {
  	if (strpos(strtolower($line->nm_subbeban), $q) !== false) {
		echo "$line->kd_gabungan,$line->nm_subbeban\n";
	
 }
 }

?>