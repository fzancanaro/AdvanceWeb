<?php
    include ("database.php");
    
    
    $time ='class.time_id';
    $location ='class.location_id';
    $query = "SELECT class_id,class_name,class_time,class_date,location_name,basic_price,family_price 
    FROM class,location,time
    WHERE class.location_id=location.location_id AND class.time_id=time.time_id AND class.time_id = $time AND class.location_id =$location 
    ORDER BY class_date,class_time";
    
    // if($_SERVER["REQUEST_METHOD"]=="POST"){
    //     $location = $_POST["location"];
    //     $time = $_POST["time"];
    //     $query = "SELECT class_id,class_name,class_time,class_date,location_name,basic_price,family_price 
    //     FROM class,location,time
    //     WHERE class.location_id=location.location_id AND class.time_id=time.time_id AND class.time_id = $time AND class.location_id =$location
    //     ORDER BY class_date,class_time";
    // }
    $result= $connection->query($query);
    
?>

<!DOCTYPE html>
<html>
    <?php include("head.php")?>
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    <script src='lib/jquery.min.js'></script>
    <script src='lib/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script> 
        function conf()
        {
            alert("You have enrolled in the class!");
        }
    </script>
    <body>
        <?php include("header.php")?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!--<form method="POST" action="enroll.php" id="Search">-->
                <!--<div class="form-group">-->
                <!--    <label for="location">Location</label>-->
                <!--    <select class="form-control" id="location" name="location">-->
                <!--        <option value='class.location_id'>---</option>-->
                <!--        <option value=2>Prince Park</option>-->
                <!--        <option value=1>Victoria Park</option>-->
                <!--        <option value=3>Blaxland Riverside</option>-->
                <!--    </select>-->
                <!--    <label for="time">Time</label>-->
                <!--    <select class="form-control" id="time" name="time">-->
                <!--        <option value='class.time_id'>---</option>-->
                <!--        <option value=1>Mon_Wed_Fri 09:00</option>-->
                <!--        <option value=3>Mon_Wed_Fri 17:00</option>-->
                <!--        <option value=4>Tue_Thu_Sat 09:00</option>-->
                <!--        <option value=2>Tue_Thu_Sat 17:00</option>-->
                <!--    </select>-->
                <!--    <button type="submit">Submit</button>-->
                <!--</div>-->
                <!--</form>-->
                <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Class Name</th>
                    <th>Class Date</th>
                    <th>Class Time</th>
                    <th>Location</th>
                    <th>Basic Price</th>
                    <th>Family Price</th>
                    <th>Submit</th>
                  </tr>
                </thead>
                <tbody>
                <?php while($userdata= $result->fetch_assoc()) {
                    $id=$userdata["class_id"];
                    echo "<form class=\"enroll-form\" action=\"enroll.php\" method=\"post\"><tr><th>".$userdata["class_name"]."</th><th>".$userdata["class_date"]."</th><th>".
                    $userdata["class_time"]."</th><th>".$userdata["location_name"]."</th><th>$".$userdata["basic_price"].
                    "</th><th>$".$userdata["family_price"]."<th><button type=\"submit\" name=\"submit\" onclick=\"conf()\" value=\"$id\">Enroll</button></th></th></tr></form>";
                }
                
                if($_SERVER["REQUEST_METHOD"]=="POST")
                {
                    $id=$_POST["submit"];
                    $aid=$_SESSION["account_id"];
                    $ddate = date("Y-m-d");
                    $date = new DateTime($ddate);
                    $week = $date->format("W");
                    $query2="INSERT INTO enroll(account_id,class_id,,startWeek) VALUES('$aid','$id','$week')";
                    $connection->query($query2);
                }
                ?>
                </tbody>
              </table>
            </div>
        </div>
        <!------footer------>
        <footer style="background-color:#3498DB;margin-top:26px;">
            <div class="col-md-12">
                <h3 style="text-align:center;font-size:20px">&copy;2017 Boot Camp, ALL RIGHTS RESERVED</h3>
            </div>
        </footer>
        <!------footer------>
    </body>
</html>