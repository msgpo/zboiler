<?php
	include('auth/access-origin.php');
	include('database/config.php');
	
	if(!isset($_POST['hash']) || !isset($_POST['headline']) || !isset($_POST['description']) || !isset($_POST['logo']) || !isset($_POST['reveal']) || !isset($_POST['author']) ){
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
		$query = mysql_query("INSERT INTO tablename(hash,date) VALUES ('$Hash', NOW())");
		//debug
		//$conn->query($sqlDelete) or die(mysqli_error($conn));

		if ($conn->query($query) === TRUE) {
			echo 'SUCCESS';
		} else {
			echo 'ERROR: unable to create account';
		}

	}

?>