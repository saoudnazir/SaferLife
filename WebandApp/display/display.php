<?php
	include "../connect.php";
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
        <?php include "../styles.php"; ?>
        <link rel="stylesheet" type="text/css" href="../sideNav/sideNav-style.css">
        <link rel="stylesheet" type="text/css" href="display-style.css">
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
        <!-- Reference to your JavaScript file -->
        <script src="script.js"></script>
    </head>
    <body>
        <?php include '../sidenav/sideNav.php'; ?>
    <!-- Main Content -->
        <div class="main-container container">
            <div class="header-container">
                <h1>CRIMINAL CHECK</h1>
            </div>
            <div class="main-content row">
                <div class="blacklist-info-container row">
                    <?php
                        if(isset($_GET['id']))
                        {
                    ?>
                    <div class="col-sm-4 avatar-container">                        
                        <img src="../<?php echo $data[0]['p_Images']; ?>" id="avatar-image"/>
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
                    <?php 
                        } else {
                    ?>
                    <div class="col-sm-4 avatar-container">                        
                        <img src="../faces/unknown.png" id="avatar-image"/>
                    </div>
                    <div class="col-sm-8 info-container row">
                        <div class="col-sm-4 title name-field">Full Name</div>
                        <div class="col-sm-8 details-show"><p class="name details">[empty]</p></div>
                        <div class="col-sm-4 title dob-field">Date Of Birth</div>
                        <div class="col-sm-8 details-show"><p class="dob details">[empty]</p></div>
                        <div class="col-sm-4 title address-field">Address</div>
                        <div class="col-sm-8 details-show"><p class="address details">[empty]</p></div>
                        <div class="col-sm-4 title note-field">Extra Note</div>
                        <div class="col-sm-8 details-show"><p class="note details">[empty]</p></div>     
                    </div>   
                    <?php
                        }
                    ?>
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
                        <tbody>
                        <?php
                            if(isset($_GET['id']))
                            {
                                for ($x = 0; $x < $count; $x++)
                                {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $x+1; ?></th>
                                <td><?php echo $data[$x]['c_Name'] ?></td>
                                <td><?php echo $data[$x]['c_level'] ?></td>
                                <td><?php echo $data[$x]['b_Date'] ?></td>
                                <td><?php echo $data[$x]['b_Time'] ?></td>
                                <td><?php echo $data[$x]['b_location'] ?></td>
                            </tr>
                        <?php
                                }
                            } else
                            {
                        ?>
                            <tr>
                                <th scope="row">1</th>
                                <td>[empty]</td>
                                <td>[empty]</td>
                                <td>[empty]</td>
                                <td>[empty]</td>
                                <td>[empty]</td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>

    </body>
    <footer>

    </footer>
</html>