<?php
    include "connect.php";

    $query = "SELECT blacklist.p_ID, people.p_Name, people.p_Images FROM blacklist
            INNER JOIN people where people.p_ID = blacklist.p_ID";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    $data_array = array();
    $FinalArray = array();
    $ImageArray = array();
    if ($count > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $data_array[] = $row;
        }
        for ($i = 0; $i < count($data_array); $i++)
        {
            array_push($FinalArray,$data_array[$i]);
        }
        $jsonfile = json_encode($FinalArray);
        echo $jsonfile;
    } else {
        echo "Query Statement Is Not Correct?";
    }
?>