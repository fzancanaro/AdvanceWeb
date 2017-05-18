<?php
include("database.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $errors = array();
  $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
  //get user account using the email
  $query = "SELECT account_id,username,password FROM Accounts WHERE email='$email' AND active=1";
  //echo $query;
  $result = $connection->query($query);
  if($result->num_rows>0){
    $userdata = $result->fetch_assoc();
    print_r($userdata);
    $stored_pw = $userdata["password"];
    $stored_email = $userdata["email"];
    $id = $userdata["account_id"];
    $password = $_POST["password"];
    if(password_verify($password,$stored_pw)){
      //passwords match
      session_start();
      $_SESSION["account_id"] = $id;
      //redirect to accounts.php page
      header("location:accounts.php");
    }
    else
      echo "error";
  }
  
  //check if user password matches
  
  
 
 
}
?>
<!doctype html>
<html>
    <?php include("head.php");?>
    <body>
      <header class="navbar"></header>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                  <h2>Login</h2>
                  <form id="login-form" method="post" action="login.php">
                    <?php
                    if($errors["email"]){
                      $email_error = $errors["email"];
                      $email_error_class = "has-error";
                    }
                    ?>
                    <div class="form-group <?php echo $email_error_class; ?>">
                      <label for="email">Email</label>
                      <input class="form-control" type="email" id="email" name="email" placeholder="you@email.com" value="<?php echo $email; ?>">
                      <span class="help-block"><?php echo $email_error; ?></span>
                    </div>
                    <?php
                      if($errors["password"]){
                      $pw_error = $errors["password"];
                      $pw_error_class = "has-error";
                    }
                    ?>
                    <div class="form-group <?php echo $pw_error_class; ?>">
                      <label for="password">Password</label>
                      <input class="form-control" type="password" id="password" name="password" placeholder="8 characters or more">
                      <span class="help-block"><?php echo $pw_error; ?></span>
                    </div>
                    <div class="text-center">
                      <button class="btn btn-info" type="submit">Register</button>
                    </div>
                  </form> 
                </div>
            </div>
        </div>
    </body>
</html>