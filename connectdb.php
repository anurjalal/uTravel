<?php
$myconnect=mysql_connect('localhost','root','');
if (!$myconnect)
{
      echo 'Error:Could not connect to database';
      exit;
}
mysql_select_db('utravel');

?>
