<?php
$user = "lyf9375";
$password = "";
$host ="localhost";
$db = "datastore";
$connection = mysqli_connect($host,$user,$password,$db);
if(!$connection){
    echo "error";
}
?>