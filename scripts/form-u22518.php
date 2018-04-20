<?php
//added to allow db Connections unless you //are Connor

if(isset($_POST['submit'])){
	
	var_dump($_POST);
	$errors = array(); //I guess so-  going to store these so i can display and embarass Connor
	if(empty($_POST['accountName'])){
		$errors[] = 'You are hopeless....Where is your account name?';//LOOKING AT YOU CONNOR LOL
		}else{
		$un =trim($_POST['username']);//we are sanitizing data-checking for hackers and whitespace etc.  We don't want any other evil doers 								/stealing our stolen monies
	}
	if(empty($_POST['password'])){
		$errors[] = 'You are not receiving this message because we used your money to go to fiji last week, you forgot your password!';//does not tell the customer what we do with their monies
	}else{
		$pw = trim($_POST['password']);//yep, checking for hackers and cohorts...and yeah whitespace again whatevs
	}
	if (empty($errors)){
		
		require_once ('../pdo_config.php'); //connection to db (not you Connor).
	

$sql = "SELECT cid, cPassword FROM `customer`
		WHERE cid = '$un'";//pull the records we want to compare
$run = @(mysqli_query($conn,$sql));

if(mysqli_num_rows($run)==1){
	$row = mysqli_fetch_array($run,MYSQLI_ASSOC);
	if($row['cPassword']== MHASH_SHA1($pw)){
		echo('Welcome Dork');
		exit();
	}else{
	echo('You are not welcome, ACCESS DENIED');
	}
}if (mysqli_num_rows($run)==0){
echo('YOU ARE WRONG, TRY AGAIN.');
}
}
}
?>
