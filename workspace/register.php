<?php
include("database.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $errors = array();
  $email = $_POST["email"];
  $password = $_POST["password"];
  if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
    $errors["email"] = "not a valid email";
  }
  if(strlen($password) < 8){
    $errors["password"] = "password should be at least 8 characters";
  }
  //if no errors
  if(count($errors)==0){
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    $hashed = password_hash($password,PASSWORD_DEFAULT);
    $query = "INSERT INTO Accounts (email,password,creation_date,last_update,last_login,active)
    VALUES ('$email','$hashed',NOW(),NOW(),NOW(),1)";
    if(!$connection->query($query)){
      $errors["database"] = "database error";
    }
  }
}
?>
<!doctype html>
<html>
    <?php include("head.php");?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                  <form id="register-form" method="post" action="register.php">
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