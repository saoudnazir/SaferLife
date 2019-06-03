<?php
    include "../connect.php";

    $pID = $_POST['add-new-blacklist-pID'];
    $fullname = $_POST['add-new-blacklist-pName'];
    $crime = $_POST['add-new-blacklist-crime'];
    $date = $_POST['add-new-blacklist-date'];
    $time = $_POST['add-new-blacklist-time'];
    $location = $_POST['add-new-blacklist-location'];

    $query1 = "SELECT * FROM crime where c_name = '$crime'";
    $result1 = mysqli_query($conn, $query1);
    $row1 = mysqli_fetch_assoc($result1);
    $count1 = mysqli_num_rows($result1);
    if ($count1 > 0) {
        $cID = $row1['c_ID'];
        $query = "INSERT INTO blacklist (c_ID, p_ID, b_Date, b_Time, b_location) VALUES ($cID, $pID, '$date', '$time', '$location')";
        echo $query;
        $result = mysqli_query($conn, $query);
        echo $result;
        if($result)
        {
            echo "New Record has been added successfully";
			header("Location: add-new-record.php");
        } else {
			echo "Error occured: ".$query. "<br>" . $conn->error;;
		}
    }
;?>