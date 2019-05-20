<?php
	include "../connect.php";
	
	$fullname = $_POST["add-new-user-fullname"];
	$dob = $_POST["add-new-user-dob"];
	$address = $_POST["add-new-user-address"];
    $extranote = $_POST["add-new-user-extranote"];
    $file = $_FILES['file'];
	
	/*print_r($file);*/

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];

	$fileSeperateName = explode('.', $fileName); // split file name into 2 part before and after the '.' to get the name and extension seperately
	$fileExtension = strtolower (end($fileSeperateName));

	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileExtension, $allowed)) // check the file extension
	{
		if ($fileError === 0)
		{ //check the file error
			if ($fileSize < 1000000) { //check the file size
				$fileDestination = '../faces/face'.$fileName;
				move_uploaded_file($fileTmpName, $fileDestination);
				
			} else {
				echo "Your file is too big.";
			}
		} else {
			echo "There was an error uploading your file.";
		}
	} else {
		echo "You can't upload files of this type.";
	}
	$fileNameDB = '/faces/face'.$fileName; //the image name that would be saved in the database
    if(isset($fullname) && isset($dob) && isset($address) && isset($extranote) && isset($file))
    {
        $query1 = "INSERT INTO people (p_Name, p_dob, p_address, p_Note, p_Images) VALUES ('$fullname', '$dob', '$address', '$extranote', '$fileNameDB')";
		$result1 = mysqli_query($conn,$query1);
		echo $result1;
		if($result1){
			echo "New Record has been added successfully";
			header("Location: add-new-record.php");
		} else {
			echo "Error occured: ".$query1. "<br>" . $conn->error;;
		}
    }
?>