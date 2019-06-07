<?php
	include "connect.php";
    //header('X-Frame-Options: GOFORIT');
    
    session_start();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
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
    </head>
    <body>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fas fa-bars" style="font-size: 30px; color: white; margin: 10px 10px 10px 10px;"></i></a>
            <a href="index.php">Home</a>
            <a href="./add-new-record/add-new-record.php">Add New Record</a>
            <a href="./search/search.php">Search In List</a>
            <a href="./logout/logout.php">Log Out</a>
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

            /*$(document).ready(function(){
                $("#LocalDB").click(function(){
                    $.ajax({url: "http://127.0.0.1:8000/dbtest/", success: function(result){
                    $("#div1").html(result);
                    }});
                });
            });*/
            var response = '';
            $(document).ready(function(){
              alert("pages ready");
            $("#LocalDB").click(function(){
                alert("Clieck");
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
              
        });

        </script>
        <!--<main id="camera">
            <canvas id="camera--sensor"></canvas>
            <video id="camera--view" autoplay playsinline></video>
            <img src="//:0" alt="" id="camera--output">
            <button id="camera--trigger">Take a picture</button>
        </main>-->
        <div id="div1"></div>
        <button type="button" id="LocalDB" style="background-color:green;padding:15px;color:white;position:absolute;bottom: 10px;left:10px;border-radius:5px; border: 1px solid green">Generate Local DB</button>
        <!--<img src="http://<?php echo $ip_address?>:8000/video_feed/" style="width:100%; height:100%;position:fixed;right:0;bottom:0;min-width:100%;min-height:100%;z-index:-1;padding:0;" id="main"/>-->
        <!-- Reference to your JavaScript file -->
        <script src="script.js"></script>
    </body>
    <footer>

    </footer>
</html>