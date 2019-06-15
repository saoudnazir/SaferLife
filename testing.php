
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
                                url: "alert-display-data.php",
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
                window.open('./display/display.php?id=<?php echo $_SESSION["res_ID"] ?>', '_blank')
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