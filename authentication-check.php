<?php
    if (!isset($_SESSION["username"]))
    {        
		header ("Location:./signin/signin.php");
    }
?>