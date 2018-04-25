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

  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2018.0.0.379"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.watch.js", "require.js", "checking_report.css"], "outOfDate":[]};
</script>
  
  <title>checking_report</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="css/master_admin.css?crc=223606753"/>
  <link rel="stylesheet" type="text/css" href="css/checking_report.css?crc=165970972" id="pagesheet"/>
	 <style type="text/css">
  body,td,th {
	font-family: "Frutiger LT Std 55 Roman";
	  font-size: 30;
	font-weight: bold;
	color: #0000FF;
	  line-height: 1.0;
}
	

.table {
	
	width: 100%;
	box-shadow: 0 1px 3px rgba(0,0,0,1.0);
    display:table;
    font-family: "Frutiger LT Std 55 Roman";
	font-size: 30;
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
/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background:#8C8AEE; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background:#5F6E83; }  

tr td:hover { background: #666; color:#000F0F; }  
/* Hover cell effect! */
	 .input{
			 margin-left: auto;margin-right: auto;
		 
		 }
	
  </style> 
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
   </head>
 <body>

  <div class="clearfix borderbox" id="page"><!-- column -->
   <div class="clearfix colelem" id="pu24324"><!-- group -->
    <div class="clip_frame grpelem" id="u24324"><!-- image -->
     <img class="block" id="u24324_img" src="images/cash-change-coins-banner-crop-u24324.jpg?crc=4139890737" alt="" data-heightwidthratio="0.13279132791327913" data-image-width="1107" data-image-height="147"/>
    </div>
    <img class="grpelem" id="u24327-4" alt="Dork's Bank" src="images/u24327-4.png?crc=3766499476" data-image-width="214"/><!-- rasterized frame -->
    <img class="grpelem" id="u24326-4" alt="WE'VE GOT YOUR MONEY." src="images/u24326-4.png?crc=209820837" data-image-width="261"/><!-- rasterized frame -->
    <nav class="MenuBar clearfix grpelem" id="menuu26511"><!-- horizontal box -->
     <div class="MenuItemContainer clearfix grpelem" id="u26519"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u26520" href="reports.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u26523"><!-- state-based BG images --><img alt="Reports" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u26521"><!-- content --></div></a>
      <div class="SubMenu MenuLevel1 clearfix" id="u26524"><!-- vertical box -->
       <ul class="SubMenuView clearfix colelem" id="u26525"><!-- vertical box -->
        <li class="MenuItemContainer clearfix colelem" id="u26540"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26543" href="top-users.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26544-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26544-3"><p>TopUsers</p></div></div><div class="grpelem" id="u26546"><!-- content --></div></a></li>
        <li class="MenuItemContainer clearfix colelem" id="u26547"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix grpelem" id="u26548" href="checking_report.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26551-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26551-3"><p>Checking</p></div></div><div class="grpelem" id="u26549"><!-- content --></div></a></li>
        <li class="MenuItemContainer clearfix colelem" id="u26533"><!-- horizontal box --><div class="MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26536"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26539-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26539-3"><p>Savings</p></div></div><div class="grpelem" id="u26537"><!-- content --></div></div></li>
        <li class="MenuItemContainer clearfix colelem" id="u26526"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26529" href="loans_report.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26531-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26531-3"><p>Loan</p></div></div><div class="grpelem" id="u26532"><!-- content --></div></a></li>
       </ul>
      </div>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u26561"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u26562" href="account_settings.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u26565"><!-- state-based BG images --><img alt="Dork" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u26564"><!-- content --></div></a>
      <div class="SubMenu MenuLevel1 clearfix" id="u26566"><!-- vertical box -->
       <ul class="SubMenuView clearfix colelem" id="u26567"><!-- vertical box -->
        <li class="MenuItemContainer clearfix colelem" id="u26568"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26571" href="account_setup.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26573-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26573-3"><p>Account_Setup</p></div></div><div class="grpelem" id="u26572"><!-- content --></div></a></li>
        <li class="MenuItemContainer clearfix colelem" id="u26582"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26583" href="loans_report.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26586-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26586-3"><p>Loan_Admin</p></div></div><div class="grpelem" id="u26584"><!-- content --></div></a></li>
        <li class="MenuItemContainer clearfix colelem" id="u26575"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26578" href="update_info.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26580-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26580-3"><p>Update</p></div></div><div class="grpelem" id="u26579"><!-- content --></div></a></li>
        <li class="MenuItemContainer clearfix colelem" id="u29234"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u29235" href="withdraw.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u29238-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u29238-3"><p>Withdraw</p></div></div><div class="grpelem" id="u29237"><!-- content --></div></a></li>
       </ul>
      </div>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u26554"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u26557" href="logout.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u26559"><!-- state-based BG images --><img alt="Logout" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u26560"><!-- content --></div></a>
     </div>
    </nav>
   </div>
   <div class="clearfix colelem" id="u24358"><!-- group -->
    <div class="grpelem" id="u24328"><!-- simple frame -->
	   	<!--MAIN FORM-->
	<center><form method="post" action="create_acct.php">
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
				<input name="firstName" type="text"
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
				<input name="lastName" type="text"
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
					<input name="streetnum" type="text"
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
					<input name="streetname" type="text"
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
					<input name="country" type="text"
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
					<input name="postcode" type="text"
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
					<input name="state" type="text"
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
					<input name="city" type="text"
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
					<input name="username" type="text"
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
				<input name="password" type="password">
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
				<input name="passCheck" type="password">
			</p>
			<br>
			
			<!-- SUBMIT -->
			<p>
				<input style="font-size: 120%;background-color: #0000FF; color: #fff; width: 375; width:375;" type="submit" name="send" id="button" value="Register">
			</p>
		</fieldset>
		</form></center>


<?php 
	include './includes/footer.php';
?>
	   </div>
   </div>
   <div class="verticalspacer" data-offset-top="0" data-content-above-spacer="1210" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
  </div>
  <div class="preload_images">
   <img class="preload" src="images/u26523-a.png?crc=286736856" alt=""/>
   <img class="preload" src="images/u26565-a.png?crc=4233768770" alt=""/>
   <img class="preload" src="images/u26559-a.png?crc=3925028500" alt=""/>
  </div>
  <!-- Other scripts -->
  <script type="text/javascript">
   // Decide weather to suppress missing file error or not based on preference setting
var suppressMissingFileError = false
</script>
  <script type="text/javascript">
   window.Muse.assets.check=function(d){if(!window.Muse.assets.checked){window.Muse.assets.checked=!0;var b={},c=function(a,b){if(window.getComputedStyle){var c=window.getComputedStyle(a,null);return c&&c.getPropertyValue(b)||c&&c[b]||""}if(document.documentElement.currentStyle)return(c=a.currentStyle)&&c[b]||a.style&&a.style[b]||"";return""},a=function(a){if(a.match(/^rgb/))return a=a.replace(/\s+/g,"").match(/([\d\,]+)/gi)[0].split(","),(parseInt(a[0])<<16)+(parseInt(a[1])<<8)+parseInt(a[2]);if(a.match(/^\#/))return parseInt(a.substr(1),
16);return 0},g=function(g){for(var f=document.getElementsByTagName("link"),h=0;h<f.length;h++)if("text/css"==f[h].type){var i=(f[h].href||"").match(/\/?css\/([\w\-]+\.css)\?crc=(\d+)/);if(!i||!i[1]||!i[2])break;b[i[1]]=i[2]}f=document.createElement("div");f.className="version";f.style.cssText="display:none; width:1px; height:1px;";document.getElementsByTagName("body")[0].appendChild(f);for(h=0;h<Muse.assets.required.length;){var i=Muse.assets.required[h],l=i.match(/([\w\-\.]+)\.(\w+)$/),k=l&&l[1]?
l[1]:null,l=l&&l[2]?l[2]:null;switch(l.toLowerCase()){case "css":k=k.replace(/\W/gi,"_").replace(/^([^a-z])/gi,"_$1");f.className+=" "+k;k=a(c(f,"color"));l=a(c(f,"backgroundColor"));k!=0||l!=0?(Muse.assets.required.splice(h,1),"undefined"!=typeof b[i]&&(k!=b[i]>>>24||l!=(b[i]&16777215))&&Muse.assets.outOfDate.push(i)):h++;f.className="version";break;case "js":h++;break;default:throw Error("Unsupported file type: "+l);}}d?d().jquery!="1.8.3"&&Muse.assets.outOfDate.push("jquery-1.8.3.min.js"):Muse.assets.required.push("jquery-1.8.3.min.js");
f.parentNode.removeChild(f);if(Muse.assets.outOfDate.length||Muse.assets.required.length)f="Some files on the server may be missing or incorrect. Clear browser cache and try again. If the problem persists please contact website author.",g&&Muse.assets.outOfDate.length&&(f+="\nOut of date: "+Muse.assets.outOfDate.join(",")),g&&Muse.assets.required.length&&(f+="\nMissing: "+Muse.assets.required.join(",")),suppressMissingFileError?(f+="\nUse SuppressMissingFileError key in AppPrefs.xml to show missing file error pop up.",console.log(f)):alert(f)};location&&location.search&&location.search.match&&location.search.match(/muse_debug/gi)?
setTimeout(function(){g(!0)},5E3):g()}};
var muse_init=function(){require.config({baseUrl:""});require(["jquery","museutils","whatinput","jquery.musemenu","jquery.watch"],function(d){var $ = d;$(document).ready(function(){try{
window.Muse.assets.check($);/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.makeButtonsVisibleAfterSettingMinWidth();/* body */
Muse.Utils.initWidget('.MenuBar', ['#bp_infinity'], function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.showWidgetsWhenReady();/* body */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
}catch(b){if(b&&"function"==typeof b.notify?b.notify():Muse.Assert.fail("Error calling selector function: "+b),false)throw b;}})})};

</script>
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=4157109226" type="text/javascript" async data-main="scripts/museconfig.js?crc=380897831" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
   </body>
</html>
