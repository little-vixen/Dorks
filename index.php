<?php 
	/*
	index.php
	
	Dork's Bank
	
	Main Page for logins, session ID for customers will be set once successfully logged in.
	*/
	if (isset($_POST['send'])) {
		$missing = array();
		$errors = array();
		$username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
		$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
		if (empty($username)) {
			$missing[] = 'username';
			
		}
		if (empty($password)) {
			$missing[] = 'password';
			
		}
		while (!$missing && !$errors) {
			try {
				require_once ('../pdo_config.php');
				/*
				Returns Account information Customer Table
				Input:	- ':cid' : Customer ID
						- ':password' : Customer Password
				Output: Redirect to Login verification
				*/
				$sql = "select cid,fn,ln,cPassword from customer where cid = :cid and cPassword = Password(:password) and active = 1";
				$stmt = $conn -> prepare($sql);
				$stmt->bindValue(':cid', $username);
				$stmt->bindValue(':password', $password);
				$stmt->execute();
				$rows = $stmt->rowCount();
				if ($rows==0) { //cid not found
					$errors[] = 'username';
					$errors[] = 'password';
				} else { //cid found, validate password
					$result = $stmt->fetch();
					$username = $result['cid'];
					session_start();
					$_SESSION['cid'] = $username;
					$_SESSION['fn'] = $result['fn'];
					$_SESSION['ln'] = $result['ln'];
					header('Location: login_direct.php');
					exit;
				}
			} catch (Exception $e) { 
				echo $e->getMessage(); 
			}
		}			
	}
	require './includes/header.php';
?>
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-GB" >
 <head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="generator" content="2018.0.0.379"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  
  
  <title>We Like Your Money As Much As You Do</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="css/master_main.css?crc=3827645107"/>
  <link rel="stylesheet" type="text/css" href="css/index.css?crc=4256566798" id="pagesheet"/>
  <style type="text/css">
  body,td,th {
	font-family: "Frutiger LT Std 55 Roman";
	font-weight: bold;
	color: #0000FF;
}
  body {
	background-color: #093648;
}
  </style>
  
</head>
 <body>

  <div class="clearfix borderbox" id="page"><!-- group -->
   <div class="clip_frame grpelem" id="u23164"><!-- image -->
    <img class="block" id="u23164_img" src="images/cash-change-coins-106152.jpg?crc=3877446195" alt="" data-heightwidthratio="0.6666666666666666" data-image-width="1230" data-image-height="820"/>
   </div>
   <div class="rgba-background clearfix grpelem" id="u23055"><!-- group -->
    <img class="grpelem" id="u23085-4" alt="Dork's Bank" src="images/u23085-4.png?crc=4150129515" data-image-width="458"/><!-- rasterized frame -->
    <div class="clearfix grpelem" id="pmenuu23056"><!-- group -->
     <nav class="MenuBar gradient clearfix grpelem" id="menuu23056"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem" id="u23071"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive borderbox transition clearfix colelem" id="u23072" href="index.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23075"><!-- state-based BG images --><img alt="Home" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u23073"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix" id="u23076"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem" id="u23077"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem" id="u26154"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26156" href="help.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26160-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26160-3"><p>help</p></div></div><div class="grpelem" id="u26162"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u26175"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26176" href="about-us.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26179-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26179-3"><p>About Us</p></div></div><div class="grpelem" id="u26178"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u26196"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u26197" href="create_acct.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u26199"><!-- state-based BG images --><img alt="New Dork" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u26200"><!-- content --></div></a>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u23057"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u23058" href="admin_login.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23060"><!-- state-based BG images --><img alt="Admin" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u23059"><!-- content --></div></a>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u23064"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u23065" href="assets/logout.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23066"><!-- state-based BG images --><img alt="Logout" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u23068"><!-- content --></div></a>
      </div>
     </nav>
     <div class="clearfix grpelem" id="u22286-3" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content -->
      <p>&nbsp;</p>
     </div>
    </div>
   </div>
   <div class="rgba-background clearfix grpelem" id="u23148"><!-- group -->
    <div class="clip_frame grpelem" id="u23150"><!-- image -->
     <img class="block" id="u23150_img" src="images/nerdmoney.jpg?crc=81157550" alt="" data-heightwidthratio="0.6657458563535912" data-image-width="362" data-image-height="241"/>
    </div>
    <!-- MAIN FORM-->
		
     <form method="post" action="index.php" style="margin-top:40px;
	   margin-left:100px;">
			
			<!--CUSTOMER ID-->
			<img class="grpelem" id="u23149-6" alt="&nbsp;Banking For Dorks." src="images/u23149-6.png?crc=4263567247" data-image-width="560"/>
			<p><img class="grpelem" id="u23152-4" alt="We've got your money." src="images/u23152-4.png?crc=3992780049" data-image-width="427"/>
				<label style=" font-size: 200%;color: #0000FF;margin-bottom: 45;">Customer ID:</label>
				<br><br><br>
				<input name="username" type="text" style = "height: 30px;">
				<br><br>
			</p>
<br>
			<!--PASSWORD-->
			
			<p>
<label style="font-size: 200%;color: #0000FF; margin-top:45;">Password:<br></label>
				<br><br>
				<input name="password" id="pw" type="password" style = "height: 30px;">
				<br><br><br><br>
			</p>
<p>
		  <input style="font-size: 200%; color:antiquewhite; background-color: #0000FF; width: 175px; " name="send" type="submit" value="Login">
			</p>
		</form>
<!-- rasterized frame -->
    <!-- rasterized frame -->
 </div>
   <div class="verticalspacer" data-offset-top="431" data-content-above-spacer="823" data-content-below-spacer="562" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
  </div>
  <div class="preload_images">
   <img class="preload" src="images/u23075-a.png?crc=4254103083" alt=""/>
   <img class="preload" src="images/arrowmenudown.png?crc=262559161" alt=""/>
   <img class="preload" src="images/u26199-a.png?crc=244710354" alt=""/>
   <img class="preload" src="images/u23060-a.png?crc=4028909114" alt=""/>
   <img class="preload" src="images/u23066-a.png?crc=515786451" alt=""/>
   <img class="preload" src="images/u23539-ferr.png?crc=73592033" alt=""/>
 
   <img class="preload" src="images/u23542-r.png?crc=343872555" alt=""/>
  </div>
  
</html>
