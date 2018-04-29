<?php
	session_start();
	/*
	login_direct.php
	
	Dork's Bank
	
	Sets cookies for the current session.
	*/
	if(isset($_SESSION['cid'])) {
		$username = "username";
		$value = $_SESSION['cid'];
		$expire = time()+60*60*24*30;
		setcookie($username, $value, $expire, "/");
		header('Location: logged_in.php');
	}
	elseif(isset($_SESSION['aid'])) {
		$username = "username";
		$value = $_SESSION['aid'];
		$expire = time()+60*60*24*30;
		setcookie($username, $value, $expire, "/");
		header('Location: admin_logged_in.php');
	}
?>