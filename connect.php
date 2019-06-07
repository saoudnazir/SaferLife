<?php
	$servername="localhost";
	$username="root";
	$password="";
	$dbname="saferlife";
	
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	
	if ($conn->connect_error){
		die ("connection failed: " .$conn->connect_error);
	} else {
		//echo "Good connection!";
		$ip_address = "192.168.0.27";
    }
?>