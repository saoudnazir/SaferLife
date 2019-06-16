<?php
    include "connect.php";
    session_start();
    $url ="http://".$ip_address.":8000/alert";
    $contents = file_get_contents($url);
    if($contents !== false){
        //echo $contents;s
        //Print out the contents.
        if($contents !== "No Criminal Found")
        {
            if(!isset($_SESSION["ResponseID"]))
            {
                $_SESSION["ResponseID"] = array();
                $_SESSION["res_ID"] = $contents;
                $date = date("Y/m/d");
                date_default_timezone_set("Australia/sydney");
                $time = date("h:i:sa");
                $query = "INSERT INTO seen_history (p_ID,seen_Date,seen_Time) VALUES ($contents,'$date','$time')";
                $result = mysqli_query($conn, $query);
                array_push($_SESSION["ResponseID"],$contents);
                if($result)
                {
                    echo $contents;
                } else {
                    echo "Error occured: ".$query. "<br>" . $conn->error;;
                }
            } else if(in_array($contents, $_SESSION["ResponseID"])){
                echo "Criminal found has been inserted.";
            } else if (isset($_SESSION["res_ID"])){
                //unset($_SESSION["res_ID"]);
                unset($_SESSION["res_ID"]);
                $_SESSION["res_ID"] = $contents;
                $date = date("Y/m/d");
                date_default_timezone_set("Australia/sydney");
                $time = date("h:i:sa");
                $query = "INSERT INTO seen_history (p_ID,seen_Date,seen_Time) VALUES ($contents,'$date','$time')";
                $result = mysqli_query($conn, $query);
                array_push($_SESSION["ResponseID"],$contents);
                if($result)
                {
                    echo $contents;
                } else {
                    echo "Error occured: ".$query. "<br>" . $conn->error;;
                }
                echo "Manh Huy Vo";
            }
        } else {
            echo $contents;
        }
    }
?>