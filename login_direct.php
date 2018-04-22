<?php
	session_start();
	//
	if(isset($_SESSION['cid'])) {
		$username = "username";
		$value = $_SESSION['cid'];
		$expire = time()+60*60*24*30;
		setcookie($username, $value, $expire, "/");
		header('Location: logged_in.php');
	}
?>