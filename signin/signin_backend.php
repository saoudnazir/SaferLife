<?php
	include "../connect.php";
	
	$username = $_POST["signin_username"];
	$password = $_POST["signin_password"];
	//$password_encrypt = sha1($password);
	
	$query = "SELECT * FROM users WHERE username = '$username' AND u_Password = '$password'";
	$result = mysqli_query($conn,$query);

	$row1 = mysqli_fetch_assoc($result);
	session_start();
	if(mysqli_num_rows($result) > 0)
	{		
		$_SESSION["username"] = $row1["username"];
		$_SESSION["firstname"] = $row1["u_FirstName"];
		$_SESSION["lastname"] = $row1["u_LastName"];
		header("Location:../index.php");
	} else {
		$_SESSION["username_err"] = "Your username is wrong.";
		$_SESSION["password_err"] = "Your password is wrong.";
		header ("Location:../signin/signin.php");
	}
?>