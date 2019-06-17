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
                $("#SaveVideo").click(function(){
                    $.ajax({ type: "GET",   
                        url: "http://<?php echo $ip_address?>:8000/save-video/",   
                        async: false,
                        success : function(text)
                        {
                        },
                        error: function(result) {
                        }
                    });
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
                                    type: "GET",
                                    url: "alert-display-data.php",
                                    success: function (data) {                                        
                                        var myObj = $.parseJSON(data);
                                        console.log(myObj[0]["result_code"]);
                                        $("#alert-img").attr("src","backend/server/faces/" + myObj[0]["p_Images"]);
                                        $("#alert-name").text("Name: " + myObj[0]["p_Name"]);
                                        $("#alert-crime-level").text("Crime Level: " + myObj[0]["c_level"]);

                                        $(".notification-container").show();
                                        $(document).ready(function(){
                                            $(".notification-container").click(function(){
                                                window.open('./display/display.php?id='+response, '_blank')
                                            }); 
                                        });
                                        
                                    }
                                });
                                //window.open('./alert-display-data.php', '_blank');
                            }
                        },
                        error: function (e) {
                            $('.modal-content').html(JSON.stringify(e)).fadeIn();
                        }
                });
            }
        </script>
        <div class="notification-container" style="display: none;">
            <div class="noti-img-container">
                <img src="backend/server/faces/SaoudNazir.jpg" id="alert-img"/>
            </div>
            <div class="noti-info-container">
                <p>One criminal has been seen!</p>
                <p id="alert-name">Name: </p>
                <p id="alert-crime-level">Criminal Level: </p>
            </div>
        </div>
        <div id="div1"></div>
        <button type="button" id="SaveVideo" style="width: 200px;background-color:black;padding:15px;color:white;position:absolute;bottom: 70px;right:10px;border-radius:5px; border: 1px solid green">Save Video</button>
                
        <button type="button" id="LocalDB" style="background-color:green;padding:15px;color:white;position:absolute;bottom: 10px;left:10px;border-radius:5px; border: 1px solid green">Generate Local DB</button>
        <button type="button" id="SessionClear" style="width:200px;background-color:#00ccff;padding:15px;color:white;position:absolute;bottom: 10px;right:10px;border-radius:5px; border: 1px solid #00ccff">Clear Session</button>

    </body>
    <footer>

    </footer>
</html>