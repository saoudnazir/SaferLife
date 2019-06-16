<?php
	include "connect.php";    
    session_start();
    include "authentication-check.php";
    /*if (isset($_GET["resid"]))
    {
        $response = $_GET["resid"];
        echo $response;
    }*/
    if(isset($_SESSION["res_ID"]))
    {
        $id = $_SESSION["res_ID"];
        $query = "SELECT p.p_Name, p.p_dob, p.p_address, p.p_Note, p.p_Images, c.c_Name, c.c_level, b.b_Date, b.b_Time, b.b_location FROM blacklist b
            inner join people p on b.p_ID = p.p_ID
            inner join crime c on b.c_ID = c.c_ID
            where b.p_ID = $id";
        
        $result = mysqli_query($conn,$query);
        $data = array();
        $count = mysqli_num_rows($result);
        if($count > 0)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                $data[] = $row;
            }          
        } else {
            echo "There is nothing match!";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Safer Life Security System - Main Page</title>
        <?php include "styles.php"; ?>
        <link rel="stylesheet" type="text/css" href="sideNav/sideNav-style.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="alert.css">
    </head>
    <body>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fas fa-bars" style="font-size: 30px; color: white; margin: 10px 10px 10px 10px;"></i></a>
            <a href="index.php">Home</a>
            <a href="./add-new-record1/add-new-record.php">Add New Record</a>
            <a href="./search/search.php">Search In List</a>    
            <a href="logout.php">Log Out</a>
        </div>
        <a onclick="openNav()"><i class="fas fa-bars openNavBtn" style="font-size: 30px; color: #0000e6; margin: 10px 10px 10px 10px;"></i></a>
        <script>
            function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.getElementById("LocalDB").style.marginLeft="250px";
            }

            function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
            document.getElementById("LocalDB").style.marginLeft="0";
            }

            var response = '';
            $(document).ready(function(){
                $("#LocalDB").click(function(){
                    $.ajax({ type: "GET",   
                        url: "http://<?php echo $ip_address?>:8000/db/",   
                        async: false,
                        success : function(text)
                        {
                            response = text;
                            
                            alert(response);
                        },
                        error: function(result) {
                            response ='error';
                            alert(result);
                        }
                    });
                });   
                $("#SessionClear").click(function(){
                    $.ajax({ type: "GET",   
                        url: "session-clear.php",   
                        async: false,
                        success : function(text)
                        {
                        },
                        error: function(result) {
                            response ='error';
                            alert(result);
                        }
                    });
                });
                $(".notification-container").click(function(){
                    window.open('./display/display.php?id=<?php if(isset($_SESSION["res_ID"])) {echo $_SESSION["res_ID"];} ?>', '_blank')
                });            
            });
            var myVar = setInterval(myTimer, 1000);
            function myTimer() {
                $.ajax({
                        type:"GET",
                        url: "alert-insert-data.php",
                        success: function(response) {
                            //$('.modal-content').html(JSON.stringify(response)).fadeIn();
                            var response_string = JSON.stringify(response);
                            if(response == "Criminal found has been inserted." || response == "No Criminal Found")
                            {
                                $('#response-show').html(JSON.stringify(response)).fadeIn();
                            } else {
                                $('#response-show-2').html(JSON.stringify(response)).fadeIn();
                                $.ajax({
                                    type: "post",
                                    url: "index.php",
                                    success: function (data) {
                                        $(".notification-container").show();
                                        
                                    }
                                });
                            }
                        },
                        error: function (e) {
                            $('.modal-content').html(JSON.stringify(e)).fadeIn();
                        }
                });
            }
        </script>
        <!--<main id="camera">
            <canvas id="camera--sensor"></canvas>
            <video id="camera--view" autoplay playsinline></video>
            <img src="//:0" alt="" id="camera--output">
            <button id="camera--trigger">Take a picture</button>
        </main>-->
        <div class="notification-container" style="display: none;">
            <div class="noti-img-container">
                <img src="backend/server/faces/<?php echo $data[0]['p_Images']; ?>"/>
            </div>
            <div class="noti-info-container">
                <p>One criminal has been seen!</p>
                <p>Name: <?php echo $data[0]['p_Name'];?></p>
                <p>Criminal Level: <?php echo $data[0]['c_level'];?></p>
            </div>
        </div>
        <p id="response-show"></p>
        <p id="response-show-2"></p>
        <div id="div1"></div>
        
        <button type="button" id="LocalDB" style="background-color:green;padding:15px;color:white;position:absolute;bottom: 10px;left:10px;border-radius:5px; border: 1px solid green">Generate Local DB</button>
        <button type="button" id="SessionClear" style="width:200px;background-color:#00ccff;padding:15px;color:white;position:absolute;bottom: 10px;right:10px;border-radius:5px; border: 1px solid #00ccff">Clear Session</button>
        <!--<img src="http://<?php echo $ip_address?>:8000/video_feed/" style="width:100%; height:100%;position:fixed;right:0;bottom:0;min-width:100%;min-height:100%;z-index:-1;padding:0;" id="main"/>-->
        <!-- Reference to your JavaScript file -->
        <script src="script.js"></script>
    </body>
    <footer>

    </footer>
</html>