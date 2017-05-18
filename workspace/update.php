<?php
include("database.php");
$query = "SELECT * FROM users";
$result = $connection->query($query);
if($result->num_rows > 0){
  $userdata = array();
  while($users = $result->fetch_assoc()){
    array_push($userdata,$users);
  }
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
  $update_id = $_POST["submit"];
  $update_name = $_POST["name"];
  $update_email = $_POST["email"];
  
  $update_query = "UPDATE users SET name='$update_name'";
}
?>
<!doctype html>
<html>
  <?php include("head.php");?>
  <body>
    <div class="container">
      <?php
      foreach($userdata as $data){
        echo "<div class=\"row\">";
        echo "<div class=\"col-md-4\">";
        $user_name = $data["name"];
        $user_email = $data["email"];
        $user_id = $data["id"];
        
        echo "<form action=\"update.php\" method=\"post\">";
        echo "<input type=\"text\" name=\"name\" value=\"$user_name\" class=\"form-control\">";
        echo "<input type=\"email\" name=\"email\" value=\"$user_email\" class=\"form-control\">";
        echo "<button type=\"submit\" name=\"submit\" value=\"$user_id\" class=\"btn btn-info\">
        update</button>";
        echo "</form></div></div>";
      }
      ?>
    </div>
  </body>
</html>