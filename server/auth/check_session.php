<?php 
	include('access-origin.php');
	session_start();
	if ( isset($_SESSION['user']) ) {
		print 'authenticated';
	} else {
		echo 'no valid session found'.$_SESSION['user'];
	}
?>