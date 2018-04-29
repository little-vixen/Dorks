<?php 
	/*
	create_acct.php
	
	Dork's Bank
	
	Account Creation page, takes input from form, once registered user information will be input into Customers and
	CustomerAddress tables.
	*/
	if (isset($_POST['send'])) {
		$missing = array();
		$errors = array();
		
		//FIRST NAME
		$firstName = trim(filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING));
		if (empty($firstName)) {
			$missing[] = 'firstName';
		} else {
			$tempName = explode(" ", $firstName);
			$firstName = $tempName[0];
		}
		
		//LAST NAME
		$lastName = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING));
		if (empty($lastName)) {
			$missing[] = 'lastName';
		} else {
			$tempName = explode(" ", $lastName);
			$lastName = $tempName[0];
		}
		
		//STREET NUMBER
		$streetnum = trim(filter_input(INPUT_POST, 'streetnum', FILTER_DEFAULT));
		if (empty($streetnum)) {
			$missing[] = 'streetnum';
		}
		
		//STREET NAME
		$streetname = trim(filter_input(INPUT_POST, 'streetname', FILTER_DEFAULT));
		if(empty($streetname)) {
			$missing[] = 'streetname';
		}
		
		//COUNTY
		$country = trim(filter_input(INPUT_POST, 'country', FILTER_DEFAULT));
		if(empty($country)) {
			$missing[] = 'country';
		}
		
		//POSTCODE
		$postcode = trim(filter_input(INPUT_POST, 'postcode', FILTER_DEFAULT));
		if(empty($postcode)) {
			$missing[] = 'postcode';
		}
		
		//STATE
		$state = trim(filter_input(INPUT_POST, 'state', FILTER_DEFAULT));
		if (empty($state)) {
			$missing[] = 'state';
		}
		
		//CITY
		$city = trim(filter_input(INPUT_POST, 'city', FILTER_DEFAULT));
		if (empty($city)) {
			$missing[] = 'city';
		}
		
		//USERNAME
		$username = trim(filter_input(INPUT_POST, 'username', FILTER_DEFAULT));
		if (empty($username)) {
			$missing[] = 'username';
		}
		
		//PASSWORD
		$password = trim(filter_input(INPUT_POST, 'password', FILTER_DEFAULT));
		if (empty($password)) {
			$missing[] = 'password';
		}
		
		//PASSCHECK
		$passCheck = trim(filter_input(INPUT_POST, 'passCheck', FILTER_DEFAULT));
		if (empty($passCheck)) {
			$missing[] = 'passCheck';
		}
		elseif ($passCheck <> $password) {
			$errors[] = 'passCheck';
		}
		
		//REGISTER
		if (!$missing && !$errors) {
			require_once('../pdo_config.php'); //connect to DB
			$sql = "SELECT * FROM customer where cid = :cid";
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':cid', $username);
			$stmt->execute();
			$rows = $stmt->rowCount();
			if ($rows==0) { //cid not found, can add new customer
				try {
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					/*
					Create a new Customer account
					Input:	- ':cid' :	Customer ID
							- ':first' : First name
							- ':last' : Last name
							- ':password' : Customer Password
					*/
					$stmt = $conn->prepare("INSERT INTO customer(cid, fn, ln, cPassword, creationdate, active, aid) VALUES (:cid, :first, :last, PASSWORD(:password), CURDATE(), 1, 'DARKOVERLORD')");
					$stmt->bindParam(':cid', $username);
					$stmt->bindParam(':first', $firstName);
					$stmt->bindParam(':last', $lastName);
					$stmt->bindParam(':password', $password);
					$stmt->execute();
					/*
					Returns the max customer address id from customer Addresses
					*/
					$stmt2 = $conn->prepare("SELECT MAX(addyid) as max FROM customerAddress WHERE 1");
					$stmt2->execute();
					$rows = $stmt2->fetchAll();
					$max = 0;
					foreach ($rows as $row) {
						$max = $row['max'];
					}
					$max = $max + 1;
					/*
					Create a new Customer Address
					Input:	- ':addyid' : Address ID
							- ':cid' :	Customer ID
							- ':streetnum' : Street Number
							- ':streetname' : Street Name
							- ':city' : City
							- ':state' : State
							- ':zip' : ZIP
							- ':country' : Country
					Output: Redirect to Account Creation confirmation
					*/
					$stmt3 = $conn->prepare("INSERT INTO customerAddress(addyid, cid, streetNum, streetName, city, state, zip, country) VALUES (:addyid, :cid, :streetnum, :streetname, :city, :state, :zip, :country)");
					$stmt3->bindParam(':addyid', $max);
					$stmt3->bindParam(':cid', $username);
					$stmt3->bindParam(':streetnum', $streetnum);
					$stmt3->bindParam(':streetname', $streetname);
					$stmt3->bindParam(':city', $city);
					$stmt3->bindParam(':state', $state);
					$stmt3->bindParam(':zip', $postcode);
					$stmt3->bindParam(':country', $country);
					$stmt3->execute();
					header('Location: acct_created.php');
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit;
				}
			}
		}
	}

require './includes/header.php';
?>

<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-GB">
 <head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="generator" content="2018.0.0.379"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.watch.js", "jquery.museresponsive.js", "require.js", "create_acct.css"], "outOfDate":[]};
</script>
  
  <title>create_acct</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="css/master_helpabout.css?crc=13923039"/>
  <link rel="stylesheet" type="text/css" href="css/create_acct.css?crc=347402159" id="pagesheet"/>
  <style type="text/css">
  body,td,th {
	font-family: "Frutiger LT Std 55 Roman";
	font-size: 30px;
	font-weight: bold;
	color: #0000FF;
	line-height: 1.0;
}
	

.table {
	
	width: 100%;
	box-shadow: 0 1px 3px rgba(0,0,0,1.0);
    display:table;
    font-family: "Frutiger LT Std 55 Roman";
	font-size: 30px;
}

.row {
	display:table-row;
}
	
.row-header {
	display:table-row;
	font-weight: 900;
	color: #ffffff;
	background: #2196F3;
}

.cell {
	padding: 6px 12px;
	display: table-cell;
	float:center;
	width:70px;
	background: #2196F3;
}

.cell-r {
	padding: 6px 12px;
	display: table-cell;
	float:center;
	width:70px;
	background:rgba(127,127,127,0.5);
	color:white;
}
		 	 .input{
			 margin-left: auto;margin-right: auto;
		 }
/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background:#8C8AEE; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background:#5F6E83; }  

tr td:hover { background: #666; color:#000F0F; }  
/* Hover cell effect! */

  body {
	background-color: #062725;
	  
	  
	  }
	  u23972_img {
		  position:relative;
	  }
	  
	
  </style> 


  <!-- IE-only CSS -->
  <!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="css/nomq_preview_master_helpabout.css?crc=4016803318"/>
  <link rel="stylesheet" type="text/css" href="css/nomq_create_acct.css?crc=4081190823" id="nomq_pagesheet"/>
  <![endif]-->
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
   </head>
 <body>

  <!--HTML Widget code-->
  
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

  
  <div class="breakpoint active" id="bp_infinity" data-min-width="1300"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox" id="page"><!-- group -->
    <div class="clip_frame grpelem" style="height:850px; background-repeat:repeat-y;" id="u23972"><!-- image -->
    </div>
	   
    <div class="clearfix grpelem" id="u24069"><!-- group -->
     <img class="grpelem temp_no_img_src" id="u24071-4" alt="We've got your money." data-orig-src="images/u24071-4.png?crc=3983403244" data-image-width="538" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_img_src" id="u24072-4" alt="Dork's Bank" data-orig-src="images/u24072-4.png?crc=4278239847" data-image-width="577" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar clearfix grpelem" id="menuu27150"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem" id="u27200"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u27201" href="index.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u27204"><!-- state-based BG images --><img alt="Home" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u27204_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u27204_1_content"></div></div><div class="grpelem" id="u27202"><!-- content --></div></a>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u32866"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u32867" href="account_info.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u32868"><!-- state-based BG images --><img alt="Account" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u32868_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u32868_1_content"></div></div><div class="grpelem" id="u32869"><!-- content --></div></a>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u32837"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u32838" href="logout.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u32839"><!-- state-based BG images --><img alt="Logout" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u32839_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u32839_1_content"></div></div><div class="grpelem" id="u32840"><!-- content --></div></a>
      </div>
     </nav>
    </div>
    <div class="clearfix grpelem" style="height:750px;" id="u24070"><!-- group -->
     <div class="grpelem shared_content" id="u5194" data-content-guid="u5194_content"><!-- simple frame -->
		
		<!--MAIN FORM-->
	<center><form method="post" action="create_acct.php" >
		<fieldset>
			<legend>Register</legend><br></br>
			<?php if ($missing || $errors) { ?>
				<p class="warning"> Please fix the item(s) indicated.</p>
			<?php } ?>
				
			<!-- FIRST NAME -->
			<p>
				<label id="firstName">First Name:
				<?php if ($missing && in_array('firstName', $missing)) { ?>
					<span class = "warning"> Please enter your first name </span>
				<?php } ?></label><br>
				<input name="firstName" type="text" style="width:375px; height:40px; color:antiquewhite;"					
					   <?php if (isset($firstName)) {
						echo 'value="' . htmlentities($firstName) . '"';
					} ?>>
			</p>
			<br>
			
			<!-- LAST NAME -->
			<p>
				<label id="lastName">Last Name:
				<?php if ($missing && in_array('lastName', $missing)) { ?>
					<span class = "warning"> Please enter your first name </span>
				<?php } ?></label><br>
				<input name="lastName" type="text" style="width:375px; height:40px; color:antiquewhite;"
					<?php if (isset($lastName)) {
						echo 'value="' . htmlentities($lastName) . '"';
					} ?>>
			</p>
			<br>
			
			<!-- STREET NUMBER -->
			<p>
				<label id="streetnum">Street Number:
					<?php if ($missing && in_array('streetnum', $missing)) { ?>
						<span class = "warning"> Please enter your Street Number </span>
					<?php } ?></label><br>
					<input name="streetnum" type="text" style="width:375px; height:40px; color:antiquewhite;"
						<?php if (isset($streetnum)) {
							echo 'value="' . htmlentities($streetnum) . '"';
						} ?>>
			</p>
			<br>
			
			<!-- STREET NAME -->
			<p>
				<label id="streetname">Street Name:
					<?php if ($missing && in_array('streetname', $missing)) { ?>
						<span class = "warning"> Please enter your Street Name </span>
					<?php } ?></label><br>
					<input name="streetname" type="text" style="width:375px; height:40px; color:antiquewhite;"
						<?php if (isset($streetname)) {
							echo 'value="' . htmlentities($streetname) . '"';
						} ?>>
			</p>
			<br>
			
			<!-- COUNTRY -->
			<p>
				<label id="country">Country:
					<?php if ($missing && in_array('country', $missing)) { ?>
						<span class = "warning"> Please enter your Country </span>
					<?php } ?></label><br>
					<input name="country" type="text" style="width:375px; height:40px; color:antiquewhite;"
						<?php if (isset($country)) {
							echo 'value="' . htmlentities($country) . '"';
						} ?>>
			</p>
			<br>
			
			<!-- POSTCODE -->
			<p>
				<label id="postcode">Postcode:
					<?php if ($missing && in_array('postcode', $missing)) { ?>
						<span class = "warning"> Please enter your Postcode</span>
					<?php } ?></label><br>
					<input name="postcode" type="text" style="width:375px; height:40px; color:antiquewhite;"
						<?php if (isset($postcode)) {
							echo 'value="' . htmlentities($postcode) . '"';
						} ?>>
			</p>
			<br>
			
			<!-- STATE -->
			<p>
				<label id="state">State:
					<?php if ($missing && in_array('state', $missing)) { ?>
						<span class = "warning"> Please enter your State </span>
					<?php } ?></label><br>
					<input name="state" type="text" style="width:375px; height:40px; color:antiquewhite;"
						<?php if (isset($state)) {
							echo 'value="' . htmlentities($state) . '"';
						} ?>>
			</p>
			<br>
			
			<!-- CITY -->
			<p>
				<label id="city">City:
					<?php if ($missing && in_array('city', $missing)) { ?>
						<span class = "warning"> Please enter your City </span>
					<?php } ?></label><br>
					<input name="city" type="text" style="width:375px; height:40px; color:antiquewhite;"
						<?php if (isset($city)) {
							echo 'value="' . htmlentities($city) . '"';
						} ?>>
			</p>
			<br>
			
			<!-- USERNAME -->
			<p>
				<label id="username">Username:
					<?php if ($missing && in_array('username', $missing)) { ?>
						<span class = "warning"> Please enter your Username </span>
					<?php } ?></label><br>
					<input name="username" type="text" style="width:375px; height:40px; color:antiquewhite;"
						<?php if (isset($username)) {
							echo 'value="' . htmlentities($username) . '"';
						} ?>>
			</p>
			<br>
			
			<!-- PASSWORD -->
			<p>
				<label id="password">Password:
					<?php if ($missing && in_array('password', $missing)) { ?>
						<span class = "warning"> Please enter your password </span>
					<?php } ?></label><br>
				<input name="password" type="password" style="width:375px; height:40px; color:antiquewhite;">
			</p>
			<br>
			
			<!-- PASSWORD AUTH -->
			<p>
				<label id="passCheck">Re-enter Password:
					<?php if ($missing && in_array('passCheck', $missing)) { ?>
						<span class = "warning"> Please enter your password </span>
					<?php } ?>
					<?php if ($errors && in_array('passCheck', $errors)) { ?>
						<span class = "warning"> Password not the same </span>
					<?php } ?></label><br>
				<input name="passCheck" type="password" style="width:375px; height:40px; color:antiquewhite;">
			</p>
			<br>
			
			<!-- SUBMIT -->
			<p>
				<input style="font-size: 120%;background-color: #0000FF; color:antiquewhite; width: 375px; height:40px;" type="submit" name="send" id="button" value="Register">
			</p>
		</fieldset>
		</form></center>
		<?php
			include './includes/footer.php';
		?>
		
		</div>
    </div>
    <div class="size_fixed grpelem shared_content" id="u5233" data-sizePolicy="fixed" data-pintopage="page_fluidx" data-content-guid="u5233_content"><!-- custom html -->
     
<div class="fb-like" data-href="http://DorksBank.php/create_acct.php" data-send="true" data-width="344" data-show-faces="false" data-colorscheme="dark" data-layout="button_count" data-action="like"></div>

    </div>
    <div class="size_fixed grpelem shared_content" id="u5234" data-sizePolicy="fixed" data-pintopage="page_fluidx" data-content-guid="u5234_content"><!-- custom html -->
     
<a href="https://twitter.com/littlevixen" class="twitter-follow-button" data-lang="en" data-show-screen-name="false" data-size="medium"></a>

    </div>
    <div class="verticalspacer" data-offset-top="855" data-content-above-spacer="1033" data-content-below-spacer="177" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u27204-a.png?crc=312175258" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u32868-a.png?crc=413361760" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u32839-a.png?crc=4140319941" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <div class="breakpoint" id="bp_1299" data-max-width="1299"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox temp_no_id" data-orig-id="page"><!-- group -->
    <div class="clip_frame grpelem temp_no_id" data-orig-id="u23972"><!-- image -->
     <img class="block temp_no_id temp_no_img_src" data-orig-src="images/cash-change-coins-106152.jpg?crc=3877446195" alt="" data-heightwidthratio="0.6664556962025316" data-image-width="1580" data-image-height="1053" data-orig-id="u23972_img" src="images/blank.gif?crc=4208392903"/>
    </div>
    <div class="clearfix grpelem temp_no_id" data-orig-id="u24069"><!-- group -->
     <img class="grpelem temp_no_id temp_no_img_src" alt="Dork's Bank" data-orig-src="images/u24072-4.png?crc=4278239847" data-image-width="469" data-orig-id="u24072-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <div class="clearfix grpelem" id="pu24071-4"><!-- column -->
      <img class="colelem temp_no_id temp_no_img_src" alt="We've got your money." data-orig-src="images/u24071-4.png?crc=3983403244" data-image-width="265" data-orig-id="u24071-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
      <nav class="MenuBar clearfix colelem temp_no_id" data-orig-id="menuu27150"><!-- horizontal box -->
       <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u27200"><!-- vertical box -->
        <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="index.php" data-orig-id="u27201"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u27204"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u27204_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u27204_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u27202"><!-- content --></div></a>
       </div>
       <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u32866"><!-- vertical box -->
        <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="account_info.php" data-orig-id="u32867"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u32868"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u32868_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u32868_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u32869"><!-- content --></div></a>
       </div>
       <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u32837"><!-- vertical box -->
        <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="logout.php" data-orig-id="u32838"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u32839"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u32839_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u32839_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u32840"><!-- content --></div></a>
       </div>
      </nav>
     </div>
    </div>
    <div class="clearfix grpelem temp_no_id" data-orig-id="u24070"><!-- group -->
     <span class="size_fixed grpelem placeholder" data-placeholder-for="u5234_content"><!-- placeholder node --></span>
     <div class="clearfix grpelem" id="pu5194"><!-- column -->
      <span class="colelem placeholder" data-placeholder-for="u5194_content"><!-- placeholder node --></span>
      <span class="size_fixed colelem placeholder" data-placeholder-for="u5233_content"><!-- placeholder node --></span>
     </div>
    </div>
    <div class="verticalspacer" data-offset-top="855" data-content-above-spacer="1053" data-content-below-spacer="543" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u27204-a.png?crc=312175258" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u32868-a.png?crc=413361760" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u32839-a.png?crc=4140319941" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <!-- JS includes -->
  <script type="text/javascript">
   if (document.location.protocol != 'https:') document.write('\x3Cscript src="http://musecdn.businesscatalyst.com/scripts/4.0/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script type="text/javascript">
   window.jQuery || document.write('\x3Cscript src="scripts/jquery-1.8.3.min.js?crc=209076791" type="text/javascript">\x3C/script>');
</script>
  <!-- Other scripts -->
 
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=4157109226" type="text/javascript" async data-main="scripts/museconfig.js?crc=380897831" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
  
  <!--HTML Widget code-->
  
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

   </body>
</html>
