<?php 
	session_start();
	$currentPage = basename($_SERVER['pageid']);
	
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Dork's Bank</title>
	<meta charset="utf-8">
	<link href="./includes/css.php" rel="stylesheet" type="text/css">
	
</head>

<body>
	<div id="wrapper">
	<div id="heading">
		<br>
	<?php
		include './includes/menu.php';
	?>