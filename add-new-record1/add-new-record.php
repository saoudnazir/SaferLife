<?php
    include '../connect.php';
    session_start();

    if(isset($_GET['action']))
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
        /*Display the person that has been selected to add to blacklist*/
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $query1 = "SELECT * FROM people where p_ID = $id";
            $result1 = mysqli_query($conn,$query1);
            if($result1)
            {
                $row1 = mysqli_fetch_assoc($result1);
            }
        }
        /*get the data from crime to display in the dropdown list*/
        $query2 = "SELECT * FROM crime";
        $result2 = mysqli_query($conn,$query2);
        $data2 = array();
        $count2 = mysqli_num_rows($result2);
        if ($count2 > 0)
        {
            while ($row2 = mysqli_fetch_assoc($result2))
            {
                $data2[] = $row2;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../styles.php'?>
<link rel="stylesheet" type="text/css" href="../sideNav/sideNav-style.css">
<link rel="stylesheet" type="text/css" href="./add-new-record.css">
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image-upload-preview')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);ss
        }
    }
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
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
        if($action == 'people')
        {
    
?>
<style>
    #peopleAddLink {
        background-color:black;
        color: white;
        border: 2px solid white;
    }
</style>
<?php 
        } else if($action == 'blacklist')
        {
?>
<style>
    #blacklistAddLink {
        background-color:black;
        color: white;
        border: 2px solid white;
    }
</style>
<?php
        }
    }
?>
</head>
<body>
    <?php 
        include '../sideNav/sideNav.php';
    ?>
    <div class= "container main-container">
        <!--Header -->
        <div class="add-new-record-header">
            <ul class="add-option-list">
                <li><a href="./add-new-record.php?action=people" id="peopleAddLink">Add New Person</a></li>
                <li><a href="./add-new-record.php?action=blacklist" id="blacklistAddLink">Add New Criminal</a></li>
            </ul>
        </div>
        <!-- Header -->

        <!-- Start of Add New Person -->
        <?php
            if(isset($_GET['action']))
            {
                $action = $_GET['action'];
                if($action == 'people')
                {
        ?>
        <div class="tab-content">
            <div class="row tab-pane TabContent fade in active" id="AddNewPerson">
                <div class="col-sm-12 add-new-person-content">
                    <form action="add-new-person-backend.php" method="post" class="add-new-person-form row" enctype="multipart/form-data">
                        <div class="col-sm-4 add-new-person-field title">Full Name</div>
                        <div class="col-sm-8 add-new-person-field"><input style ="padding: 10px" type="text" placeholder="Full Name..." name="add-new-user-fullname" size="28" required></div>
                        <div class="col-sm-4 add-new-person-field title">Date Of Birth</div>
                        <div class="col-sm-8 add-new-person-field"><input style ="padding: 10px" type="date" placeholder="Date Of Birth..." name="add-new-user-dob" size="28" required></div>
                        <div class="col-sm-4 add-new-person-field title">Address</div>
                        <div class="col-sm-8 add-new-person-field"><input style ="padding: 10px" type="text" placeholder="Address..." name="add-new-user-address" size="28" required></div>
                        <div class="col-sm-4 add-new-person-field title">Extra Note</div>
                        <div class="col-sm-8 add-new-person-field text-area"><textarea rows="6" cols="30" type="text" placeholder="Extra Note..." name="add-new-user-extranote" required></textarea></div>
                        <div class="col-sm-4 add-new-person-field title" id="profile-img">Profile Image</div>
                        <div class="col-sm-4 upload-file-wraper">
                            <button class="upload-btn">Upload a file</button>
                            <input type="file" name="file" id="inputFile" onchange="readURL(this);">
                        </div>
                        <div class="col-sm-12 add-new-person-field image-preview-container">
                            <div class="col-sm-4"></div>
                            <div class=" col-sm-4 imag-container">
                                <img src="#" id="image-upload-preview" style="width: 200px;"/>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <div class="col-sm-12 submit-btn-container">
                            <button id="submit-btn" type="submit" value="Submit">Submit</button> 
                        </div>                          
                    </form>
                </div>
            </div>
        </div>
        <?php
                } else if ($action == 'blacklist') {
        ?>
        <div class="tab-content">
            <div class="row tab-pane TabContent fade in active" id="AddNewCriminal">
                <div class="search-bar col-sm-6">
                    <?php 
                        if(!isset($_GET['id'])) { 
                    ?>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
                    <ul id="myUL">
                        <?php
                            for ($x = 0; $x < $count; $x++)
                            {
                        ?>
                        <li><a href="./add-new-record.php?action=blacklist&id=<?php echo $data[$x]['p_ID']?>" class="row">
                            <div class="col-sm-3 search-image-result" style="height: 100%;">
                                <img src="../Backend/server/MyApp/faces/<?php echo $data[$x]["p_Images"]; ?>"/>
                            </div>
                            <div class="col-sm-9 search-details-result row">
                                <div class="row col-sm-12">
                                    <div class="col-sm-4 title name-field">Full Name</div>
                                    <div class="col-sm-8 details-show"><p class="name details"><?php echo $data[$x]["p_Name"]; ?></p></div>
                                </div>
                                <div class="row col-sm-12">
                                    <div class="col-sm-4 title dob-field">Date Of Birth</div>
                                    <div class="col-sm-8 details-show"><p class="dob details"><?php echo $data[$x]["p_dob"]; ?></p></div>
                                </div>
                                <div class="row col-sm-12">
                                    <div class="col-sm-4 title address-field">Address</div>
                                    <div class="col-sm-8 details-show"><p class="address details"><?php echo $data[$x]["p_address"]; ?></p></div>
                                </div>
                                <div class="row col-sm-12">
                                    <div class="col-sm-4 title note-field">Extra Note</div>
                                    <div class="col-sm-8 details-show"><p class="note details"><?php echo $data[$x]["p_Note"]; ?></p></div>
                                </div>
                            </div>
                        </a></li>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="col-sm-3 search-image-result" style="height: 100%;">
                                <img src="../Backend/server/<?php echo $row1["p_Images"]; ?>"/>
                            </div>
                            <div class="col-sm-9 search-details-result row">
                                <div class="row col-sm-12">
                                    <div class="col-sm-4 title name-field">Full Name</div>
                                    <div class="col-sm-8 details-show"><p class="name details"><?php echo $row1["p_Name"]; ?></p></div>
                                </div>
                                <div class="row col-sm-12">
                                    <div class="col-sm-4 title dob-field">Date Of Birth</div>
                                    <div class="col-sm-8 details-show"><p class="dob details"><?php echo $row1["p_dob"]; ?></p></div>
                                </div>
                                <div class="row col-sm-12">
                                    <div class="col-sm-4 title address-field">Address</div>
                                    <div class="col-sm-8 details-show"><p class="address details"><?php echo $row1["p_address"]; ?></p></div>
                                </div>
                                <div class="row col-sm-12">
                                    <div class="col-sm-4 title note-field">Extra Note</div>
                                    <div class="col-sm-8 details-show"><p class="note details"><?php echo $row1["p_Note"]; ?></p></div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-sm-6 add-new-person-content">
                    <form action="add-new-blacklist-backend.php" method="post" class="add-new-person-form row" enctype="multipart/form-data">
                        <div class="row col-sm-12">
                            <div class="col-sm-4 add-new-person-field title">Person Identification</div>
                            <div class="col-sm-8 add-new-person-field"><input style ="padding: 10px" type="text" value="<?php echo $row1['p_ID']; ?>" name="add-new-blacklist-pID" size="8" readonly></div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-4 add-new-person-field title">Person Full Name</div>
                            <div class="col-sm-8 add-new-person-field"><input style ="padding: 10px" type="text" value="<?php echo $row1['p_Name']; ?>" name="add-new-blacklist-pName" size="20" readonly></div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-4 add-new-person-field title">Crime</div>
                            <div class="col-sm-8 add-new-person-field">
                                <select name="add-new-blacklist-crime">
                                    <?php 
                                        for ($x = 0; $x < $count2; $x++) 
                                        {
                                    ?>
                                    <option value="<?php echo $data2[$x]['c_name']; ?>"><?php echo $data2[$x]['c_name']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-4 add-new-person-field title">Date Happened</div>
                            <div class="col-sm-8 add-new-person-field"><input style ="padding: 10px" type="date" name="add-new-blacklist-date" size="28" required></div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-4 add-new-person-field title">Time Happened</div>
                            <div class="col-sm-8 add-new-person-field"><input style ="padding: 10px" type="time" name="add-new-blacklist-time" size="28" required></div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-4 add-new-person-field title">Location Happened</div>
                            <div class="col-sm-8 add-new-person-field"><input style ="padding: 10px" type="text" placeholder="Location..." name="add-new-blacklist-location" size="28" required></div>
                        </div>                        
                        <div class="col-sm-12 submit-btn-container">
                            <button id="submit-btn" type="submit" value="Submit">Submit</button> 
                        </div>                          
                    </form>
                </div>
            </div>
        </div>
        <?php
                }
            }
        ?>
    </div>
</body>
</html>