<?php
	include "connect.php";
    //header('X-Frame-Options: GOFORIT');
    session_start();
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
            }

            function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
            }
        </script>
        <!--<main id="camera">
            <canvas id="camera--sensor"></canvas>
            <video id="camera--view" autoplay playsinline></video>
            <img src="//:0" alt="" id="camera--output">
            <button id="camera--trigger">Take a picture</button>
        </main>-->
        <iframe src="http://10.1.6.161:8000/index/" style="width:600px; overflow:hidden; z-index: -1; height: 800px; border: 1px solid black; position: fixed;top: 0;right: 0;">
        </iframe>
        <!-- Reference to your JavaScript file -->
        <script src="script.js"></script>
    </body>
    <footer>

    </footer>
</html>