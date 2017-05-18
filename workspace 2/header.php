<?php
    session_start();
    if(!$_SESSION["account_id"])
        $login=0;
    else{
        $login=1;
    }
?>
<header>
    <div class="row visible-on">
        <span class="hidden-xs">
            <div class="col-md-9 col-md-offset-1">
                <div class="row">
                    <div class="col-md-2">
                        <a class="logo"><img src="images/logof.png" width=100% style="margin-top:5px"></a>
                    </div>
                    <div class="col-md-8" style="margin-top:15px">
                        <ul class="nav nav-pills nav-justified" >
                            <li><a href="index.php" style="color:#2C3E50">Home</a></li>
                            <li><a href="events.html" style="color:#2C3E50">Why Choose Us</a></li>
                            <li><a href="games.html" style="color:#2C3E50">Boot Camps</a></li>
                            <li><a href="shops.html" style="color:#2C3E50">About</a></li>  
                            <li><a href="contact.html" style="color:#2C3E50">Contact</a></li> 
                        </ul>
                    </div>
                    <?php if(!$login) { ?>
                    <dic class="col-md-1 col-md-offset-1" style="margin-top:20px">
                        <button style="background-color:#FF3E30;border-radius: 20px;padding:5px 30px"><a href="register.php" style="color:#FFFFFF ">Login/Register</a></button>
                    </dic>
                    <?php } ?>
                    <?php if($login) { ?>
                    <dic class="col-md-2" style="margin-top:20px">
                        <div class="row">
                            <div class="col-md-3">
                                <div style="padding-top:5px">Hello</div>
                            </div>
                            <div class="col-md-3">
                                <a href="profile.php" style="text-decoration: underline"><div style="color:#006AFF;padding-top:5px"><?php echo $_SESSION["last_name"];?></div></a>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                <button style="background-color:#FF3E30;border-radius: 20px;padding:5px 30px"><a href="logout.php" style="color:#FFFFFF ">Logout</a></button>
                            </div>
                        </div>
                    </dic>
                    <?php } ?>
                </div>
            </div>
        </span>
        <span class="visible-xs">
            <div class="row">
                <div class="col-xs-2 col-xs-offset-1">
                    <div class="btn-group">
                    	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    		<a class="logo"><img src="images/burger.png" class="img-responsive" width="100%"></a>
                    	</button>
                    	<ul class="dropdown-menu" role="menu">
                    		<li class="active"><a href="index.html" style="background-color:#2980B9">Home</a></li>
                            <li><a href="events.html" style="color:#2C3E50">Why Choose Us</a></li>
                            <li><a href="games.html" style="color:#2C3E50">Boot Camps</a></li>
                            <li><a href="shops.html" style="color:#2C3E50">About</a></li>  
                            <li><a href="contact.html" style="color:#2C3E50">Contact</a></li> 
                    	</ul>
                    </div>
                </div>
                <div class="col-xs-4 col-xs-offset-1">
                    <a class="logo"><img src="images/logof.png" width=100%></a>
                </div>
                <div class="col-xs-2">
                    <a href="login.html" type="submit" name="submit" style="color:#2C3E50;margin-top:5px">Login/Register</a> 
                </div>
            </div>
        </span>
    </div>
</header>