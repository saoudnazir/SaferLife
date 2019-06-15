<?php
    include "connect.php";
    session_start();
    $data = json_encode($_SESSION["ResponseID"]);
    echo $contents . " There is";

    echo $data . " Here";

    unset($_SESSION["ResponseID"]);

    $data = json_encode($_SESSION["ResponseID"]);
    echo $contents . " There is";

    echo $data . " Here"; 
?>