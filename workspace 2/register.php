<?php
    include ("database.php");
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if($_POST["submit"]=="login"){
            $errors=array();
            $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
            $query = "SELECT account_id,password,last_name,first_name,email,last_login FROM account 
              WHERE email='$email' AND active=1";
            $result= $connection ->query($query);
            $query2 = "UPDATE account SET last_login=NOW() WHERE email='$email' AND active=1";
            $connection ->query($query2);
            
            if($result->num_rows>0)
            {
                $userdata = $result->fetch_assoc();
                $id = $userdata["account_id"];
                $name = $userdata["last_name"];
                $password = $_POST["password"];
                if(password_verify($password,$userdata["password"]))
                {
                    session_start();
                    $_SESSION["account_id"] = $id;
                    $_SESSION["last_name"] = $name;
                    $_SESSION["email"] = $userdata["email"];
                    $_SESSION["first_name"] = $userdata["first_name"];
                    $_SESSION["last_login"] = $userdata["last_login"];
                    header("location:index.php");
                }
                else
                {
                    $errors["login"] = "Can not find your email or password not match1";
                }
            }
            else
            {
               $errors["login"] = "Can not find your email or password not match2";
            }
        }
        
        
        else if($_POST["submit"]=="register"){
            $errors=array();
            if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
            {
                $errors["email"]="invlid email";
            }
            
            if(strlen($_POST["password"])<8)
            {
                $errors["password"]="password should be 8 chrs or more";
            }
            
            if(count($errors)==0){
                $email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
                $hash=password_hash($_POST["password"],PASSWORD_DEFAULT);
                $first_name=$_POST["first_name"];
                $last_name=$_POST["last_name"];
                $query="INSERT INTO account(email,password,first_name,last_name,creation_date,last_update,active,last_login) 
                VALUES ('$email','$hash','$first_name','$last_name',NOW(),NOW(),1,NOW())";
                if(!$connection->query($query)){
                    $errors["database"] = "database error";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <?php include("head.php");?>
    <?php include("header.php");?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="text-center">Login</h3>
                    <form class="login-form" action="register.php" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" name="email" id="email" type="email" placeholder="Your email">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" name="password" id="password" type="password" placeholder="Your password">
                            <span class="help-block"></span>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-info" type="submit" name="submit" value="login">Login</button>
                        </div>
                        <?php
                        if($errors["login"])
                        {
                          $login_error = $errors["login"];
                        }
                        ?>
                        <span class="help-block"><?php echo $login_error ?></span>
                    </form>
                </div>
                
                
                <div class="col-md-4 col-md-offset-2">
                    <h3 class="text-center">Not yet registered?</h3>
                    <form class="register-form" action="register.php" method="post">
                        <?php
                        if($errors["email"])
                        {
                            $email_error = $errors["email"];
                            $email_error_class = "has-error";
                        }
                        ?>
                        <div class="form-group <?php echo $email_error_class; ?>">
                            <label for="email">Email</label>
                            <input class="form-control" name="email" id="email" type="email" placeholder="Your email">
                            <span class="help-block"><?php echo $email_error;?></span>
                        </div>
                        <?php
                        if ($errors["password"])
                        {
                            $pw_error = $errors["password"];
                            $pw_error_class = "has-error";
                        }
                        ?>
                        <div class="form-group <?php echo $pw_error_class;?>">
                            <label for="password">Password</label>
                            <input class="form-control" name="password" id="password" type="password" placeholder="Your password">
                            <span class="help-block"><?php echo $pw_error;?></span>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input class="form-control" name="first_name" id="first_name" type="text" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input class="form-control" name="last_name" id="last_name" type="text" placeholder="Last Name">
                        </div>
                        <div class="text-center">
                            <button class="btn btn-info" type="submit" name="submit" value="register">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
