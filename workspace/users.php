<?php

include("database.php");

$query= "SELECT * FROM users";
$result =$connection->query($query);
if($result->num_rows >0)
{
    while($row=$result->fetch_assoc())
    {
        $id=$row["id"];
        $name=$row["name"];
        $email=$row["email"];
        echo"<p>id=@id, name=$name,email=$email</p>";
    }
}

?>
