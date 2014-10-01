<?php 
	include('access-origin.php');
	session_id('user');
	session_start();
	session_destroy();
	session_commit();
?>