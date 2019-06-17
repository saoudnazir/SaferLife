<?php
	include "./connect.php";
    session_start();
    
    if(isset($_GET["resid"]))
    {
        $id = $_GET["resid"];
        $query = "SELECT p.p_Name, p.p_ID, p.p_dob, p.p_address, p.p_Note, p.p_Images, c.c_Name, c.c_level, b.b_Date, b.b_Time, b.b_location FROM blacklist b
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
            echo json_encode($data);       
        } else {
            echo "There is nothing match!";
        }
    }
?>