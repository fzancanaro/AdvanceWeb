<?php
session_start();
unset($_SESSION["account_id"]);
unset($_SESSION["last_name"]);
unset($_SESSION["email"]);
unset($_SESSION["first_name"]);
unset($_SESSION["last_login"]);
header("location:index.php");
?>