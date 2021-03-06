<?php
	session_start();
	require_once '../pdo_config.php';
	/*
	account_info.php
	
	Dork's Bank
	
	Page used for allowing users to see all account balances
	*/
	
	/*
	Return the Sum of all balances for a user, Checking.
	Input: Customer ID
	Output: Sum of Balances
	*/
	$c = 0;
	$s = 0;
	$l = 0;
	$cid = $_SESSION['cid'];
	$sql = "SELECT SUM(bal) AS userCbal FROM checking WHERE cid = :cid";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(':cid', $cid);
	$stmt->execute();
	$rows = $stmt->fetchAll();
	foreach($rows as $row) {
		$c = $row['userCbal'];
		// Sets the double decimal
		$c = floor($c*100)/100;
	}
	
	/*
	Return the Sum of all balances for a user, Savings.
	Input: Customer ID
	Output: Sum of Balances
	*/
	$sql2 = "SELECT SUM(bal) AS userSbal FROM savings WHERE cid = :cid";
	$stmt2 = $conn->prepare($sql2);
	$stmt2->bindValue(':cid', $cid);
	$stmt2->execute();
	$rows2 = $stmt2->fetchAll();
	foreach($rows2 as $row) {
		$s = $row['userSbal'];
		$s = floor($s*100)/100;
	}
	
	/*
	Return the Sum of all remaining balances for a user, Loans.
	Input: Customer ID
	Output: Sum of Balances
	*/
	$sql3 = "SELECT SUM(remBal) AS userLbal FROM loan WHERE cid = :cid";
	$stmt3 = $conn->prepare($sql3);
	$stmt3->bindValue(':cid', $cid);
	$stmt3->execute();
	$rows3 = $stmt3->fetchAll();
	foreach($rows3 as $row) {
		$l = $row['userLbal'];
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
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.watch.js", "jquery.museresponsive.js", "require.js", "account_info.css"], "outOfDate":[]};
</script>
  
  <title>account_info</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="css/master_accountsrouting.css?crc=86596428"/>
  <link rel="stylesheet" type="text/css" href="css/account_info.css?crc=4239324463" id="pagesheet"/>
	 
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
/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background:#8C8AEE; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background:#5F6E83; }  

tr td:hover { background: #666; color:#000F0F; }  
/* Hover cell effect! */

  </style> 
  <!-- IE-only CSS -->
  <!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="css/nomq_preview_master_accountsrouting.css?crc=487786325"/>
  <link rel="stylesheet" type="text/css" href="css/nomq_account_info.css?crc=4280821788" id="nomq_pagesheet"/>
  <![endif]-->
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
   </head>
 <body>

  <div class="breakpoint active" id="bp_infinity" data-min-width="1274"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox" id="page"><!-- column -->
    <div class="clearfix colelem" id="pu23584"><!-- group -->
     <div class="clip_frame grpelem" id="u23584"><!-- image -->
      <img class="block temp_no_img_src" id="u23584_img" data-orig-src="images/cash-change-coins-banner-crop-u23584.jpg?crc=273604942" alt="" data-heightwidthratio="0.13333333333333333" data-image-width="1410" data-image-height="188" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_img_src" id="u23574-4" alt="Dork's Bank" data-orig-src="images/u23574-4.png?crc=3887892894" data-image-width="330" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_img_src" id="u23575-4" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u23575-4.png?crc=3987375930" data-image-width="210" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar gradient clearfix grpelem" id="menuu23594"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem" id="u23609"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u23612" href="index.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23614"><!-- state-based BG images --><img alt="Home" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u23614_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u23614_1_content"></div></div><div class="grpelem" id="u23615"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix" id="u23610"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem" id="u23611"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem" id="u29270"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u29273" href="help.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u29279-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u29279-3" class="shared_content" data-content-guid="u29279-3_content"><p>Help</p></div></div><div class="grpelem" id="u29282"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u29305"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u29308" href="about-us.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u29311-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u29311-3" class="shared_content" data-content-guid="u29311-3_content"><p>About Us</p></div></div><div class="grpelem" id="u29309"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u23616"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive borderbox transition clearfix colelem" id="u23617" href="account_info.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23620"><!-- state-based BG images --><img alt="Account" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u23620_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u23620_1_content"></div></div><div class="grpelem" id="u23618"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix" id="u23621"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem" id="u23622"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem" id="u26301"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26303" href="checking.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26307-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26307-3" class="shared_content" data-content-guid="u26307-3_content"><p>Checking</p></div></div><div class="grpelem" id="u26309"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u26322"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26323" href="savings.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26324-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26324-3" class="shared_content" data-content-guid="u26324-3_content"><p>Savings</p></div></div><div class="grpelem" id="u26325"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u26343"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26344" href="loan.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26346-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26346-3" class="shared_content" data-content-guid="u26346-3_content"><p>Loan</p></div></div><div class="grpelem" id="u26345"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u30655"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u30658" href="detailed-transactions.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30660-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30660-3" class="shared_content" data-content-guid="u30660-3_content"><p>Transactions</p></div></div><div class="grpelem" id="u30659"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u32425"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u32426" href="routing-info.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u32429-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u32429-3" class="shared_content" data-content-guid="u32429-3_content"><p>Routing Info</p></div></div><div class="grpelem" id="u32427"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u23595"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u23598" href="logout.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23600"><!-- state-based BG images --><img alt="Logout" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u23600_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u23600_1_content"></div></div><div class="grpelem" id="u23601"><!-- content --></div></a>
      </div>
     </nav>
</div>
    <div class="clearfix colelem" id="u23571"><!-- column -->
     <div class="clearfix colelem" id="u23681"><!-- group -->
      <!-- rasterized frame -->
      <div class="grpelem shared_content" id="u4378" data-content-guid="u4378_content"><!-- custom html -->
        <!--Assets Table-->
	<center><table class="table" style="position:center;">
		<tr class="row-header">
			<td class="cell" colspan="1" style="text-align:left;">Checking Balance</td>
			<td class="cell" colspan="1" style="text-align:left;">Savings Balance</td>
			<td class="cell" colspan="1" style="text-align:left;">Loan Remaining</td>
		</tr>
		<?php foreach ($rows as $row) { ?>
		<tr>
			<td class="cell-r"><?php echo '$'.$c; ?></td>
			<td class="cell-r"><?php echo '$'.$s; ?></td>
			<td class="cell-r"><?php echo '$'.$l; ?></td>
		</tr>
		<?php } ?>
		</table></center></div>
		  
		  
      </div>
     </div>
</div>
    <div class="verticalspacer" data-offset-top="598" data-content-above-spacer="1250" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u23614-a.png?crc=3879757298" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/arrowmenudown.png?crc=262559161" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23620-a.png?crc=50581031" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23600-a.png?crc=3930042119" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <div class="breakpoint" id="bp_1273" data-min-width="1273" data-max-width="1273"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox temp_no_id" data-orig-id="page"><!-- column -->
    <div class="clearfix colelem temp_no_id" data-orig-id="pu23584"><!-- group -->
     <div class="clip_frame grpelem temp_no_id" data-orig-id="u23584"><!-- image -->
      <img class="block temp_no_id temp_no_img_src" data-orig-src="images/cash-change-coins-banner-crop-u23584.jpg?crc=273604942" alt="" data-heightwidthratio="0.13309352517985612" data-image-width="1112" data-image-height="148" data-orig-id="u23584_img" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_id temp_no_img_src" alt="Dork's Bank" data-orig-src="images/u23574-4.png?crc=3887892894" data-image-width="275" data-orig-id="u23574-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_id temp_no_img_src" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u23575-4.png?crc=3987375930" data-image-width="203" data-orig-id="u23575-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar gradient clearfix grpelem temp_no_id" data-orig-id="menuu23594"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23609"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="index.php" data-orig-id="u23612"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23614"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23614_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23614_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23615"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u23610"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u23611"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u29270"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="help.php" data-orig-id="u29273"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u29279-4"><!-- content --><span class="placeholder" data-placeholder-for="u29279-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u29282"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u29305"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="about-us.php" data-orig-id="u29308"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u29311-4"><!-- content --><span class="placeholder" data-placeholder-for="u29311-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u29309"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23616"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive borderbox transition clearfix colelem temp_no_id" href="account_info.php" data-orig-id="u23617"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23620"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23620_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23620_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23618"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u23621"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u23622"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26301"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="checking.php" data-orig-id="u26303"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26307-4"><!-- content --><span class="placeholder" data-placeholder-for="u26307-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26309"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26322"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="savings.php" data-orig-id="u26323"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26324-4"><!-- content --><span class="placeholder" data-placeholder-for="u26324-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26325"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26343"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="loan.php" data-orig-id="u26344"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26346-4"><!-- content --><span class="placeholder" data-placeholder-for="u26346-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26345"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30655"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="detailed-transactions.php" data-orig-id="u30658"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30660-4"><!-- content --><span class="placeholder" data-placeholder-for="u30660-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30659"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u32425"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="routing-info.php" data-orig-id="u32426"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u32429-4"><!-- content --><span class="placeholder" data-placeholder-for="u32429-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u32427"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23595"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="logout.php" data-orig-id="u23598"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23600"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23600_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23600_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23601"><!-- content --></div></a>
      </div>
     </nav>
     <span class="grpelem placeholder" data-placeholder-for="u2152_content"><!-- placeholder node --></span>
    </div>
    <div class="clearfix colelem temp_no_id" data-orig-id="u23571"><!-- column -->
     <div class="clearfix colelem temp_no_id" data-orig-id="u23681"><!-- group -->
      <img class="grpelem temp_no_id temp_no_img_src" alt="Account Balance:" data-orig-src="images/u2149-52.png?crc=4216946563" data-image-width="138" data-orig-id="u2149-5" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
      <span class="grpelem placeholder" data-placeholder-for="u4378_content"><!-- placeholder node --></span>
     </div>
     <div class="clearfix colelem temp_no_id" data-orig-id="u23572"><!-- group -->
      <img class="grpelem temp_no_id temp_no_img_src" alt="Transaction History:" data-orig-src="images/u2279-42.png?crc=304798917" data-image-width="142" data-orig-id="u2279-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     </div>
    </div>
    <div class="verticalspacer" data-offset-top="598" data-content-above-spacer="1210" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u23614-a.png?crc=3879757298" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/arrowmenudown.png?crc=262559161" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23620-a.png?crc=50581031" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23600-a.png?crc=3930042119" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <div class="breakpoint" id="bp_1272" data-min-width="987" data-max-width="1272"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox temp_no_id" data-orig-id="page"><!-- column -->
    <div class="clearfix colelem temp_no_id" data-orig-id="pu23584"><!-- group -->
     <div class="clip_frame grpelem temp_no_id" data-orig-id="u23584"><!-- image -->
      <img class="block temp_no_id temp_no_img_src" data-orig-src="images/cash-change-coins-banner-crop-u23584.jpg?crc=273604942" alt="" data-heightwidthratio="0.1332133213321332" data-image-width="1111" data-image-height="148" data-orig-id="u23584_img" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_id temp_no_img_src" alt="Dork's Bank" data-orig-src="images/u23574-4.png?crc=3887892894" data-image-width="274" data-orig-id="u23574-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_id temp_no_img_src" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u23575-4.png?crc=3987375930" data-image-width="202" data-orig-id="u23575-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar gradient clearfix grpelem temp_no_id" data-orig-id="menuu23594"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23609"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="index.php" data-orig-id="u23612"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23614"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23614_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23614_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23615"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u23610"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u23611"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u29270"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="help.php" data-orig-id="u29273"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u29279-4"><!-- content --><span class="placeholder" data-placeholder-for="u29279-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u29282"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u29305"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="about-us.php" data-orig-id="u29308"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u29311-4"><!-- content --><span class="placeholder" data-placeholder-for="u29311-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u29309"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23616"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive borderbox transition clearfix colelem temp_no_id" href="account_info.php" data-orig-id="u23617"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23620"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23620_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23620_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23618"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u23621"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u23622"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26301"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="checking.php" data-orig-id="u26303"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26307-4"><!-- content --><span class="placeholder" data-placeholder-for="u26307-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26309"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26322"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="savings.php" data-orig-id="u26323"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26324-4"><!-- content --><span class="placeholder" data-placeholder-for="u26324-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26325"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26343"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="loan.php" data-orig-id="u26344"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26346-4"><!-- content --><span class="placeholder" data-placeholder-for="u26346-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26345"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30655"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="detailed-transactions.php" data-orig-id="u30658"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30660-4"><!-- content --><span class="placeholder" data-placeholder-for="u30660-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30659"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u32425"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="routing-info.php" data-orig-id="u32426"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u32429-4"><!-- content --><span class="placeholder" data-placeholder-for="u32429-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u32427"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23595"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="logout.php" data-orig-id="u23598"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23600"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23600_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23600_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23601"><!-- content --></div></a>
      </div>
     </nav>
     <span class="grpelem placeholder" data-placeholder-for="u2152_content"><!-- placeholder node --></span>
    </div>
    <div class="clearfix colelem temp_no_id" data-orig-id="u23571"><!-- column -->
     <div class="clearfix colelem temp_no_id" data-orig-id="u23681"><!-- group -->
      <img class="grpelem temp_no_id temp_no_img_src" alt="Account Balance:" data-orig-src="images/u2149-53.png?crc=4216946563" data-image-width="137" data-orig-id="u2149-5" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
      <span class="grpelem placeholder" data-placeholder-for="u4378_content"><!-- placeholder node --></span>
     </div>
     <div class="clearfix colelem temp_no_id" data-orig-id="u23572"><!-- group -->
      <img class="grpelem temp_no_id temp_no_img_src" alt="Transaction History:" data-orig-src="images/u2279-43.png?crc=304798917" data-image-width="142" data-orig-id="u2279-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     </div>
    </div>
    <div class="verticalspacer" data-offset-top="562" data-content-above-spacer="1210" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u23614-a.png?crc=3879757298" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/arrowmenudown.png?crc=262559161" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23620-a.png?crc=50581031" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23600-a.png?crc=3930042119" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <div class="breakpoint" id="bp_986" data-min-width="986" data-max-width="986"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox temp_no_id" data-orig-id="page"><!-- column -->
    <div class="clearfix colelem temp_no_id" data-orig-id="pu23584"><!-- group -->
     <div class="clip_frame grpelem temp_no_id" data-orig-id="u23584"><!-- image -->
      <img class="block temp_no_id temp_no_img_src" data-orig-src="images/cash-change-coins-banner-crop-u23584.jpg?crc=273604942" alt="" data-heightwidthratio="0.13356562137049943" data-image-width="861" data-image-height="115" data-orig-id="u23584_img" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_id temp_no_img_src" alt="Dork's Bank" data-orig-src="images/u23574-4.png?crc=3887892894" data-image-width="213" data-orig-id="u23574-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_id temp_no_img_src" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u23575-4.png?crc=3987375930" data-image-width="157" data-orig-id="u23575-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar gradient clearfix grpelem temp_no_id" data-orig-id="menuu23594"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23609"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="index.php" data-orig-id="u23612"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23614"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23614_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23614_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23615"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u23610"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u23611"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u29270"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="help.php" data-orig-id="u29273"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u29279-4"><!-- content --><span class="placeholder" data-placeholder-for="u29279-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u29282"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u29305"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="about-us.php" data-orig-id="u29308"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u29311-4"><!-- content --><span class="placeholder" data-placeholder-for="u29311-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u29309"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23616"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive borderbox transition clearfix colelem temp_no_id" href="account_info.php" data-orig-id="u23617"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23620"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23620_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23620_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23618"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u23621"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u23622"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26301"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="checking.php" data-orig-id="u26303"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26307-4"><!-- content --><span class="placeholder" data-placeholder-for="u26307-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26309"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26322"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="savings.php" data-orig-id="u26323"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26324-4"><!-- content --><span class="placeholder" data-placeholder-for="u26324-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26325"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26343"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="loan.php" data-orig-id="u26344"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26346-4"><!-- content --><span class="placeholder" data-placeholder-for="u26346-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26345"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30655"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="detailed-transactions.php" data-orig-id="u30658"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30660-4"><!-- content --><span class="placeholder" data-placeholder-for="u30660-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30659"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u32425"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="routing-info.php" data-orig-id="u32426"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u32429-4"><!-- content --><span class="placeholder" data-placeholder-for="u32429-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u32427"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23595"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="logout.php" data-orig-id="u23598"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23600"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23600_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23600_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23601"><!-- content --></div></a>
      </div>
     </nav>
     <span class="grpelem placeholder" data-placeholder-for="u2152_content"><!-- placeholder node --></span>
    </div>
    <div class="clearfix colelem temp_no_id" data-orig-id="u23571"><!-- column -->
     <div class="clearfix colelem temp_no_id" data-orig-id="u23681"><!-- group -->
      <img class="grpelem temp_no_id temp_no_img_src" alt="Account Balance:" data-orig-src="images/u2149-54.png?crc=3764341022" data-image-width="106" data-orig-id="u2149-5" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
      <span class="grpelem placeholder" data-placeholder-for="u4378_content"><!-- placeholder node --></span>
     </div>
     <div class="clearfix colelem temp_no_id" data-orig-id="u23572"><!-- group -->
      <img class="grpelem temp_no_id temp_no_img_src" alt="Transaction History:" data-orig-src="images/u2279-44.png?crc=421540838" data-image-width="110" data-orig-id="u2279-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     </div>
    </div>
    <div class="verticalspacer" data-offset-top="562" data-content-above-spacer="1190" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u23614-a.png?crc=3879757298" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/arrowmenudown.png?crc=262559161" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23620-a.png?crc=50581031" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23600-a.png?crc=3930042119" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <div class="breakpoint" id="bp_985" data-max-width="985"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox temp_no_id" data-orig-id="page"><!-- column -->
    <div class="clearfix colelem temp_no_id" data-orig-id="pu23584"><!-- group -->
     <div class="clip_frame grpelem temp_no_id" data-orig-id="u23584"><!-- image -->
      <img class="block temp_no_id temp_no_img_src" data-orig-src="images/cash-change-coins-banner-crop-u23584.jpg?crc=273604942" alt="" data-heightwidthratio="0.13372093023255813" data-image-width="860" data-image-height="115" data-orig-id="u23584_img" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_id temp_no_img_src" alt="Dork's Bank" data-orig-src="images/u23574-4.png?crc=3887892894" data-image-width="264" data-orig-id="u23574-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_id temp_no_img_src" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u23575-4.png?crc=3987375930" data-image-width="205" data-orig-id="u23575-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar gradient clearfix grpelem temp_no_id" data-orig-id="menuu23594"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23609"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="index.php" data-orig-id="u23612"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23614"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23614_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23614_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23615"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u23610"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u23611"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u29270"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="help.php" data-orig-id="u29273"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u29279-4"><!-- content --><span class="placeholder" data-placeholder-for="u29279-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u29282"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u29305"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="about-us.php" data-orig-id="u29308"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u29311-4"><!-- content --><span class="placeholder" data-placeholder-for="u29311-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u29309"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23616"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive borderbox transition clearfix colelem temp_no_id" href="account_info.php" data-orig-id="u23617"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23620"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23620_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23620_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23618"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u23621"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u23622"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26301"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="checking.php" data-orig-id="u26303"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26307-4"><!-- content --><span class="placeholder" data-placeholder-for="u26307-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26309"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26322"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="savings.php" data-orig-id="u26323"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26324-4"><!-- content --><span class="placeholder" data-placeholder-for="u26324-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26325"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u26343"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="loan.php" data-orig-id="u26344"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u26346-4"><!-- content --><span class="placeholder" data-placeholder-for="u26346-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u26345"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30655"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="detailed-transactions.php" data-orig-id="u30658"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30660-4"><!-- content --><span class="placeholder" data-placeholder-for="u30660-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30659"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u32425"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="routing-info.php" data-orig-id="u32426"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u32429-4"><!-- content --><span class="placeholder" data-placeholder-for="u32429-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u32427"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u23595"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="logout.php" data-orig-id="u23598"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u23600"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u23600_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u23600_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u23601"><!-- content --></div></a>
      </div>
     </nav>
     <span class="grpelem placeholder" data-placeholder-for="u2152_content"><!-- placeholder node --></span>
    </div>
    <div class="clearfix colelem temp_no_id" data-orig-id="u23571"><!-- column -->
     <div class="clearfix colelem temp_no_id" data-orig-id="u23681"><!-- group -->
      <img class="grpelem temp_no_id temp_no_img_src" alt="Account Balance:" data-orig-src="images/u2149-55.png?crc=3764341022" data-image-width="106" data-orig-id="u2149-5" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
      <span class="grpelem placeholder" data-placeholder-for="u4378_content"><!-- placeholder node --></span>
     </div>
     <div class="clearfix colelem temp_no_id" data-orig-id="u23572"><!-- group -->
      <img class="grpelem temp_no_id temp_no_img_src" alt="Transaction History:" data-orig-src="images/u2279-45.png?crc=4086412143" data-image-width="110" data-orig-id="u2279-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     </div>
    </div>
    <div class="verticalspacer" data-offset-top="562" data-content-above-spacer="1204" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u23614-a.png?crc=3879757298" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/arrowmenudown.png?crc=262559161" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23620-a.png?crc=50581031" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u23600-a.png?crc=3930042119" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <!-- Other scripts -->
  <script type="text/javascript">
   // Decide weather to suppress missing file error or not based on preference setting
var suppressMissingFileError = true
</script>
  <script type="text/javascript">
   window.Muse.assets.check=function(d){if(!window.Muse.assets.checked){window.Muse.assets.checked=!0;var b={},c=function(a,b){if(window.getComputedStyle){var c=window.getComputedStyle(a,null);return c&&c.getPropertyValue(b)||c&&c[b]||""}if(document.documentElement.currentStyle)return(c=a.currentStyle)&&c[b]||a.style&&a.style[b]||"";return""},a=function(a){if(a.match(/^rgb/))return a=a.replace(/\s+/g,"").match(/([\d\,]+)/gi)[0].split(","),(parseInt(a[0])<<16)+(parseInt(a[1])<<8)+parseInt(a[2]);if(a.match(/^\#/))return parseInt(a.substr(1),
16);return 0},g=function(g){for(var f=document.getElementsByTagName("link"),h=0;h<f.length;h++)if("text/css"==f[h].type){var i=(f[h].href||"").match(/\/?css\/([\w\-]+\.css)\?crc=(\d+)/);if(!i||!i[1]||!i[2])break;b[i[1]]=i[2]}f=document.createElement("div");f.className="version";f.style.cssText="display:none; width:1px; height:1px;";document.getElementsByTagName("body")[0].appendChild(f);for(h=0;h<Muse.assets.required.length;){var i=Muse.assets.required[h],l=i.match(/([\w\-\.]+)\.(\w+)$/),k=l&&l[1]?
l[1]:null,l=l&&l[2]?l[2]:null;switch(l.toLowerCase()){case "css":k=k.replace(/\W/gi,"_").replace(/^([^a-z])/gi,"_$1");f.className+=" "+k;k=a(c(f,"color"));l=a(c(f,"backgroundColor"));k!=0||l!=0?(Muse.assets.required.splice(h,1),"undefined"!=typeof b[i]&&(k!=b[i]>>>24||l!=(b[i]&16777215))&&Muse.assets.outOfDate.push(i)):h++;f.className="version";break;case "js":h++;break;default:throw Error("Unsupported file type: "+l);}}d?d().jquery!="1.8.3"&&Muse.assets.outOfDate.push("jquery-1.8.3.min.js"):Muse.assets.required.push("jquery-1.8.3.min.js");
f.parentNode.removeChild(f);if(Muse.assets.outOfDate.length||Muse.assets.required.length)f="Some files on the server may be missing or incorrect. Clear browser cache and try again. If the problem persists please contact website author.",g&&Muse.assets.outOfDate.length&&(f+="\nOut of date: "+Muse.assets.outOfDate.join(",")),g&&Muse.assets.required.length&&(f+="\nMissing: "+Muse.assets.required.join(",")),suppressMissingFileError?(f+="\nUse SuppressMissingFileError key in AppPrefs.xml to show missing file error pop up.",console.log(f)):alert(f)};location&&location.search&&location.search.match&&location.search.match(/muse_debug/gi)?
setTimeout(function(){g(!0)},5E3):g()}};
var muse_init=function(){require.config({baseUrl:""});require(["jquery","museutils","whatinput","jquery.musemenu","jquery.watch","jquery.museresponsive"],function(d){var $ = d;$(document).ready(function(){try{
window.Muse.assets.check($);/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.makeButtonsVisibleAfterSettingMinWidth();/* body */
Muse.Utils.initWidget('.MenuBar', ['#bp_infinity', '#bp_1273', '#bp_1272', '#bp_986', '#bp_985'], function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
Muse.Utils.fullPage('#page');/* 100% height page */
$( '.breakpoint' ).registerBreakpoint();/* Register breakpoints */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
}catch(b){if(b&&"function"==typeof b.notify?b.notify():Muse.Assert.fail("Error calling selector function: "+b),false)throw b;}})})};

</script>
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=4157109226" type="text/javascript" async data-main="scripts/museconfig.js?crc=380897831" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
   </body>
</html>
