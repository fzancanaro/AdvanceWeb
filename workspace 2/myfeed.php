<?php
    include ("database.php");
    session_start();
    $aid=$_SESSION["account_id"];
    $events=array();
    $query="SELECT class_name,class_date,class_time FROM enroll,class,time WHERE account_id='$aid' 
    AND enroll.class_id=class.class_id AND time.time_id=class.time_id";
    $result = $connection->query($query);
    $ddate = date("Y-m-d");
    $date = new DateTime($ddate);
    $week = $date->format("W");
    $startWeek=$week;
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $title = $row["class_name"];
            $date = $row["class_date"];
            $time = $row["class_time"];
            if($date==("Mon_Wed_Fri"))
            {
                for($i=0;$i<=3;$i++){
                    for($j=1;$j<=5;$j+=2)
                    {
                        $start="2017-W".($startWeek+$i)."-".$j."T".$time."Z";
                        $class = array("title"=>$title,"start"=>$start);
                        array_push($events,$class); 
                    }
                }
            }
            else if($date==("Tue_Thu_Sat"))
            {
                 for($i=0;$i<=3;$i++){
                    for($j=2;$j<=6;$j+=2)
                    {
                        $start="2017-W".($startWeek+$i)."-".$j."T".$time."Z";
                        $class = array("title"=>$title,"start"=>$start);
                        array_push($events,$class); 
                    }
                }
            }
        }
        echo json_encode($events);
    }
?>