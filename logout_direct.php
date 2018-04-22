<?php
	session_start();
	if (isset($_SESSION['cid'])) {
		setcookie('PHPSESSID',"",time() - 3600);
		header('Location: logout.php');
	} else {
		header('Location: logout.php');
	}
?>