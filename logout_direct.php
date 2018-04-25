<?php
	session_start();
	/*
	logout_direct.php
	
	Dork's Bank
	
	This page just helps to deal with cookies on logout
	*/
	if (isset($_SESSION['cid'])) {
		setcookie('PHPSESSID',"",time() - 3600);
		header('Location: logout.php');
	} else {
		header('Location: logout.php');
	}
?>