<?php
//to log out the user, unset session variables or destroy the session.
session_start();
//unset
unset($_SESSION["account_id"]);
echo "you are now logged out";

//to destroy the entire session
//session_destroy();


?>