<?php
	session_start();
	if(is_null($_SESSION['admin_user'])){
		header('Location:./login.php');
		exit(0);
	} 
	$admin = $_SESSION['admin_user'];
?>
