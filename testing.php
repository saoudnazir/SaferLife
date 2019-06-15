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
    
        // Get the modal
        $(document).ready(function(){
            var modal = document.getElementById("myModal");
            // Get the button that opens the modal
            var btn = document.getElementsByClassName("notification-container")[0];
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            // When the user clicks on the button, open the modal 
            btn.onclick = function() {
                modal.style.display = "block";
                btn.style.display = "none";
            }
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
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
        <button id="myBtn">Open Modal</button>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="blacklist-info-container row">
                    <div class="col-sm-4 avatar-container">                        
                        <img src="./Backend/server/faces/<?php echo $data[0]['p_Images']; ?>" id="avatar-image"/>
                    </div>
                    <div class="col-sm-8 info-container row">
                        <div class="col-sm-4 title name-field">Full Name</div>
                        <div class="col-sm-8 details-show"><p class="name details"><?php echo $data[0]['p_Name']; ?></p></div>
                        <div class="col-sm-4 title dob-field">Date Of Birth</div>
                        <div class="col-sm-8 details-show"><p class="dob details"><?php echo $data[0]["p_dob"]; ?></p></div>
                        <div class="col-sm-4 title address-field">Address</div>
                        <div class="col-sm-8 details-show"><p class="address details"><?php echo $data[0]["p_address"]; ?></p></div>
                        <div class="col-sm-4 title note-field">Extra Note</div>
                        <div class="col-sm-8 details-show"><p class="note details"><?php echo $data[0]["p_Note"]; ?></p></div>
                    </div>
                </div>
                <div class="row">
                    <div class="crime-happen-info-container row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Index</th>
                                    <th scope="col">Crime Name</th>
                                    <th scope="col">Crime Level</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Location</th>
                                </tr>
                            </thead>
                            <?php
                                for ($x = 0; $x < $count; $x++)
                                {
                            ?>
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $x+1; ?></th>
                                    <td><?php echo $data[$x]['c_Name'] ?></td>
                                    <td><?php echo $data[$x]['c_level'] ?></td>
                                    <td><?php echo $data[$x]['b_Date'] ?></td>
                                    <td><?php echo $data[$x]['b_Time'] ?></td>
                                    <td><?php echo $data[$x]['b_location'] ?></td>
                                </tr>
                            </tbody>
                            <?php
                                }                            
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>