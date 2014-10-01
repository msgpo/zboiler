<?php 
	include('auth/access-origin.php');
	include('database/config.php');

	if(!isset($_GET['hash'])){
		echo "POST Variables not set";
	} else {
		//connect to db
		$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
		 
		//check connection
		if ($conn->connect_error) {
		  echo 'Error DB connection failed';
		}

		//create an account in accounts table, set verified to false
		//on success return success
		$sqlDelete = "UPDATE table SET logo = 'logo',  WHERE hash = '".$Hash."'";
		//debug
		//$conn->query($sqlDelete) or die(mysqli_error($conn));

		if ($conn->query($sqlDelete) === TRUE) {
			echo 'SUCCESS';
		} else {
			echo 'ERROR: unable to create account';
		}
	}

?>