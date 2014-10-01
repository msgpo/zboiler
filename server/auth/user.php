<?php 
	include('../auth/access-origin.php');
	include('../database/config.php');
	include('../lib/hash.php');
	include('../lib/util.php');


	$data = json_decode(file_get_contents('php://input'));  //get user from 


	if (!isset($_POST['email'])) {
		echo 'Error no data available for processing';
	} else {

	  //connect to db
		$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
		 
		//check connection
		if ($conn->connect_error) {
		  echo 'ERROR: DB connection failed';
		}

    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

		//check if the beta key exists in beta table and it is not claimed yet
		//if it does, mark the key as claimed
		//else return error
		$sql = 'SELECT * FROM users WHERE email = "'.$email.'"';

		$results = $conn->query($sql);
		$rows_returned = $results->num_rows;

		//no email found
		if($rows_returned == 0) {
			echo 'ERROR: Invalid email login';
		} else {

			//Get the password hash from db
			while($row = $results->fetch_assoc()){
			    $hashed_password = $row['password'];
			    $username = $row['username'];
			}

			//if the crpt of password entered and hashed password is same as password, then auth is complete. send a session uid back
			if(crypt($password, $hashed_password) == $hashed_password) {
		    session_start();
				$_SESSION['user'] = uniqid($username.'_usab_');
				echo $_SESSION['user'];
		  } else {
		  	echo 'ERROR: invalid password';
		  }
		}

	}

	
?>