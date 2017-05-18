<?php
session_start();
//check if user is logged in via session variable "account"
if(!$_SESSION["account_id"]){
    header("location:login.php");
    exit();
}
else {
    echo "hello user, your account id is ".$_SESSION["account_id"];
    echo "to log out, go to <a href=\"logout.php\">Log Out<\a> page";
}
?>