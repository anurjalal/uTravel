<?php
session_start();
include_once "db.php"; 

//$tbl_name="stock_user"; // Table name
$tbl_name="userlog";

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$password=md5($mypassword);

//$pwd=$db->queryUniqueValue("SELECT pwd FROM $tbl_name WHERE LOGIN_NAME='$myusername'");

$sql="SELECT * FROM $tbl_name WHERE LOGIN_NAME='$myusername' and PWD='$password'" ;
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
//if(password_verify($mypassword, $pwd)) {
// Register $myusername, $mypassword and redirect to file "login_success.php"
$row = mysql_fetch_row($result);

$_SESSION['KD_USER']=$row[0];
$_SESSION['LOGIN_NAME']=$row[2];
$_SESSION['ID_GROUP']=$row[4];

if($row[4]=="Administrator")
header("location:admin.php");
else if($row[4]=="Sales")
header("location:sales.php");
else if ($row[4]=="Kasir")
header("location:kasir.php");
else if ($row[4]=="Finance")
header("location:finance.php");
else if ($row[4]=="Warehouse")
header("location:warehouse.php");
else
echo "error in validate user";

}
else {
header("location:index.php?msg=Wrong%20Username%20or%20Password");
//header("location:index.php?msg=".$row[0]);
}
?>