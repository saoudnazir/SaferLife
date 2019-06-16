<?php
	include "../connect.php";
    session_start();
    include "../authentication-check.php";
    if(isset($_GET['value']))
    {
        $value = $_GET['value'];
        if ($value == 'people')
        {
            $query = "SELECT * FROM people";
        
            $result = mysqli_query($conn,$query);
            $data = array();
            $count = mysqli_num_rows($result);
            if ($count > 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $data[] = $row;
                }
            }
        } else if ($value == 'blacklist')
        {
            $query = "SELECT p.p_ID, p.p_Name, p.p_dob, p.p_address, p.p_Note, p.p_Images, c.c_Name FROM blacklist b
            inner join people p on b.p_ID = p.p_ID
            inner join crime c on b.c_ID = c.c_ID";
        
            $result = mysqli_query($conn,$query);
            $data = array();
            $count = mysqli_num_rows($result);
            if ($count > 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $data[] = $row;
                }
            }
        }
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Safer Life Security System - Search Page</title>
        <?php include "../styles.php"; ?>
        <link rel="stylesheet" type="text/css" href="../sideNav/sideNav-style.css">
        <link rel="stylesheet" type="text/css" href="search-style.css">
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
        <script>
            function myFunction() {
                var input, filter, ul, li, a, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                li = ul.getElementsByTagName("li");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
        </script>
        <?php
            if(isset($_GET['value']))
            {
                $value = $_GET['value'];
                if($value == 'people')
                {
            
        ?>
        <style>
            #peopleSearchLink {
                background-color:black;
                color: white;
                border: 2px solid white;
            }
        </style>
        <?php 
                } else if($value == 'blacklist')
                {
        ?>
        <style>
            #blacklistSearchLink {
                background-color:black;
                color: white;
                border: 2px solid white;
            }
        </style>
        <?php
                }
            }
        ?>
        <!-- Reference to your JavaScript file -->
        <script src="script.js"></script>
    </head>
    <body>
        <?php include '../sideNav/sideNav.php'; ?>
    <!-- Main Content -->
        <div class="main-container container">
            <div class="search-option-list">
                <ul class="search-option">
                    <li><a href="./search.php?value=people" id="peopleSearchLink">Search For People</a></li>
                    <li><a href="./search.php?value=blacklist" id="blacklistSearchLink">Search For Criminal</a></li>
                </ul>
            </div>
            <div class="search-bar">
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
                <ul id="myUL">
                    <?php 
                        if (isset($_GET['value'])) {
                            if($_GET['value'] =='people') {
                                for ($x = 0; $x < $count; $x++)
                                {
                    ?>
                    <li><a href="../display/display.php?id=<?php echo $data[$x]['p_ID']?>" class="row">
                        <div class="col-sm-3 search-image-result">
                            <img src="../Backend/server/MyApp/faces/<?php echo $data[$x]["p_Images"]; ?>"/>
                        </div>
                        <div class="col-sm-9 search-details-result row">
                            <div class="col-sm-4 title name-field">Full Name</div>
                            <div class="col-sm-8 details-show"><p class="name details"><?php echo $data[$x]["p_Name"]; ?></p></div>
                            <div class="col-sm-4 title dob-field">Date Of Birth</div>
                            <div class="col-sm-8 details-show"><p class="dob details"><?php echo $data[$x]["p_dob"]; ?></p></div>
                            <div class="col-sm-4 title address-field">Address</div>
                            <div class="col-sm-8 details-show"><p class="address details"><?php echo $data[$x]["p_address"]; ?></p></div>
                            <div class="col-sm-4 title note-field">Extra Note</div>
                            <div class="col-sm-8 details-show"><p class="note details"><?php echo $data[$x]["p_Note"]; ?></p></div>
                        </div>
                    </a></li>
                    <?php
                                }
                            } else if ($_GET['value'] =='blacklist')
                            {
                                for ($x = 0; $x < $count; $x++)
                                {
                    ?>
                    <li><a href="../display/display.php?id=<?php echo $data[$x]['p_ID']; ?>" class="row">
                        <div class="col-sm-3 search-image-result">
                            <img src="../<?php echo $data[$x]["p_Images"]; ?>"/>
                        </div>
                        <div class="col-sm-9 search-details-result row">
                            <div class="col-sm-4 title name-field">Full Name</div>
                            <div class="col-sm-8 details-show"><p class="name details"><?php echo $data[$x]["p_Name"]; ?></p></div>
                            <div class="col-sm-4 title dob-field">Date Of Birth</div>
                            <div class="col-sm-8 details-show"><p class="dob details"><?php echo $data[$x]["p_dob"]; ?></p></div>
                            <div class="col-sm-4 title address-field">Address</div>
                            <div class="col-sm-8 details-show"><p class="address details"><?php echo $data[$x]["p_address"]; ?></p></div>
                            <div class="col-sm-4 title note-field">Extra Note</div>
                            <div class="col-sm-8 details-show"><p class="note details"><?php echo $data[$x]["p_Note"]; ?></p></div>
                            <div class="col-sm-4 title crime-field">Crime</div>
                            <div class="col-sm-8 details-show"><p class="crime details"><?php echo $data[$x]["c_Name"]; ?></p></div>
                        </div>
                    </a></li>
                    <?php
                                }
                            }
                        }
                    ?>    
                    <!--<li><a href="#">Billy</a></li>
                    <li><a href="#">Bob</a></li>

                    <li><a href="#">Calvin</a></li>
                    <li><a href="#">Christina</a></li>
                    <li><a href="#">Cindy</a></li>-->
                </ul>
            </div>
        </div>
    </body>
    <footer>

    </footer>
</html>