<?php
include("database.php");
session_start();
$aid=$_SESSION["account_id"];
$query="SELECT class_name FROM enroll,class WHERE account_id='$aid' 
AND enroll.class_id=class.class_id";
$result= $connection ->query($query);
?>

<!DOCTYPE html>
<html>
    <?php include("head.php");?>
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar
            ({
                defaultView: 'month',
                editable: true,
                selectable: true,
                events:"/myfeed.php"
            })
        });
    </script>
    <body>
        <?php include("header.php");?>
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-4" style="padding-top:20px;">
                    <h4>First Name:</h4>
                    <h4><?php echo $_SESSION["first_name"]?></h4>
                    <h4>Last Name:</h4>
                    <h4><?php echo $_SESSION["last_name"]?></h4>
                    <h4>Email:</h4>
                    <h4><?php echo $_SESSION["email"]?></h4>
                     <h4>Last login time:</h4>
                    <h4><?php echo $_SESSION["last_login"]?></h4>
                    <a href="enroll.php"><button>Enroll</button></a>
                </div>
                <div class="col-md-8">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </body>
</html>
