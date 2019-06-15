<?php
	include "./connect.php";
    session_start();
    
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
        <?php include "styles.php"; ?>
        <link rel="stylesheet" type="text/css" href="alert.css">
    </head>
    <script>
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
                                url: "testing.php",
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
        $(document).ready(function(){
            $(".notification-container").click(function(){
                window.open('./display/display.php?id=<?php if(isset($_SESSION["res_ID"])) {echo $_SESSION["res_ID"];} ?>', '_blank')
            });            
        });
    </script>
    <body>
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
    </body>
</html>