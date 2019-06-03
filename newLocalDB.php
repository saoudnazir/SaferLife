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
        }/*
        for ($i = 0; $i < count($data_array); $i++)
        {
            $Image_Path = $data_array[$i]["p_Images"];
            $type = pathinfo($Image_Path, PATHINFO_EXTENSION);
            $Img = file_get_contents('.'.$Image_Path);
            $ImageEncode = base64_encode($Img);
            $ImageArray[] = $ImageEncode;            
        }
        $ArrMerge = array_merge($data_array,$ImageArray);*/
        for ($i = 0; $i < count($data_array); $i++)
        {
            array_push($FinalArray,$data_array[$i]);
        }
        $jsonfile = json_encode($FinalArray);
        //header('Content-disposition: attachment; filename=file.json');
        //header('Content-type: application/json');
        echo $jsonfile;
        //header("Location:index.php");
    } else {
        echo "Query Statement Is Not Correct?";
    }
?>