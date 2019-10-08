<?php
function dateconvert($datesrc) {
   //$dateArray=explode('-',$datesrc);
   //$datedest = date('d-M-Y', mktime(0, 0, 0, $dateArray[1], $dateArray[2], $dateArray[0])); 
   $tanggal=strtotime($datesrc);
   $datedest=date('Y-m-d H:i:s', $tanggal);
   return $datedest;
}

function getwarna($kdwarna) {
   $myquery4="SELECT * FROM mstwarna
              WHERE kd_warna = '$kdwarna'";

   $myresult4=mysql_query($myquery4);
   $data=mysql_fetch_array($myresult4);

   return $data['NM_WARNA'];
}

function gettipe($kdtipe) {
   $myquery="SELECT * FROM msttype
              WHERE kd_tipe = '$kdtipe'";

   $myresult=mysql_query($myquery);
   $data=mysql_fetch_array($myresult);

   return $data['NM_TIPE'];
}

function getfield($tabel, $cekin, $nilai, $cekout) {
   $myquery="SELECT * FROM $tabel
              WHERE $cekin = '$nilai'";

   $myresult=mysql_query($myquery);
   $data=mysql_fetch_array($myresult);

   return $data[$cekout];
}

?>
