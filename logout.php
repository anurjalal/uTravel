<?php
session_start();
session_destroy();
unset($_SESSION["id"]);
unset($_SESSION['LOGIN_NAME']);
unset($_SESSION['ID_GROUP']);

header("location:index.php?msg=You%20have%20been%20logged%20out!");
?>