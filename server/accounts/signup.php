<?php 
	include('../auth/access-origin.php');
	include('../database/config.php');
	include('../lib/hash.php');
	include('../lib/util.php');

	//check if post variables exist, if not, return error
	if (!isset($_POST['username'])) {
		echo 'Error no data available for processing';
	} else {
		//connect to db
		$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
		 
		//check connection
		if ($conn->connect_error) {
		  echo 'Error DB connection failed';
		}

		//sanitize the inputs
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

		//hash password
		$rounds = 7;
		$password = hash_password($password, $rounds);



		//create an account in accounts table, set verified to false
		//on success return success
		$sqlAccountCreation = "INSERT INTO users(signup_date, username, email, password, role) VALUES (NOW(), '$username','$email', '$password', 'member')";
		//debug
		//$conn->query($sqlAccountCreation) or die(mysqli_error($conn));

		if ($conn->query($sqlAccountCreation) === TRUE) {
			echo 'SUCCESS';
		} else {
			echo 'ERROR: unable to create account';
		}

	}

?>