<?php 
	session_start();
	/*
	update_info.php
	
	Dork's Bank
	
	Update Customer Address Information
	*/
	if (isset($_SESSION['aid'])) {
		require_once '../pdo_config.php';
		$search = trim(filter_input(INPUT_POST, 'checking_search', FILTER_SANITIZE_STRING));
		if (isset($_POST['send'])) {
			try{
				/*
				Search feature, depending on what is typed will return customer addresses.
				Input:	'%$search%' - First name search, finds names that contain the search parameters.
				Output:	Customer Address Table
				*/
				
				$sql = "SELECT * FROM customerAddress WHERE cid LIKE '%$search%'";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$rows = $stmt->fetchAll();
				$errorInfo = $conn->errorInfo();
			} catch (PDOException $e) { 
				echo $e->getMessage(); 
				exit;
			}
		} elseif (!isset($_POST['send'])) {
			try { 
				$sql = "SELECT a.cid, a.streetNum, a.streetName, a.city, a.state, a.country, a.zip FROM customerAddress a, customerAddress b WHERE a.zip = b.zip AND a.cid <> b.cid ORDER BY a.zip, a.cid";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$rows = $stmt->fetchAll();
			} catch (PDOException $e) { 
				echo $e->getMessage(); 
				exit;
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
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.watch.js", "jquery.museresponsive.js", "require.js", "update_info.css"], "outOfDate":[]};
</script>
  
  <title>update_info</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="css/master_admin.css?crc=20483078"/>
  <link rel="stylesheet" type="text/css" href="css/update_info.css?crc=393191469" id="pagesheet"/>
	 
	 <style type="text/css">
  body,td,th {
	font-family: "Frutiger LT Std 55 Roman";
	font-size: 20px;
	font-weight: bold;
	color: #0000FF;
	line-height: 1.0;
}
	

.table {
	
	width: 100%;
	box-shadow: 0 1px 3px rgba(0,0,0,1.0);
    display:table;
    font-family: "Frutiger LT Std 55 Roman";
	font-size: 20px;
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
	background-color: #093648;
}
     </style> 
	 
  <!-- IE-only CSS -->
  <!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="css/nomq_preview_master_admin.css?crc=93109966"/>
  <link rel="stylesheet" type="text/css" href="css/nomq_update_info.css?crc=420692505" id="nomq_pagesheet"/>
  <![endif]-->
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
   </head>
 <body>

  <div class="breakpoint active" id="bp_infinity" data-min-width="949"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox" id="page"><!-- column -->
    <div class="clearfix colelem" id="pu30744"><!-- group -->
     <div class="clip_frame grpelem" id="u30744"><!-- image -->
      <img class="block temp_no_img_src" id="u30744_img" data-orig-src="images/cash-change-coins-banner-crop-u30744.jpg?crc=4139890737" alt="" data-heightwidthratio="0.13279132791327913" data-image-width="1107" data-image-height="147" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_img_src" id="u30746-4" alt="Dork's Bank" data-orig-src="images/u30746-4.png?crc=3877500381" data-image-width="273" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_img_src" id="u30747-4" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u30747-4.png?crc=4016458241" data-image-width="208" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar clearfix grpelem" id="menuu30748"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem" id="u30749"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u30787" href="by_city.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u30788"><!-- state-based BG images --><img alt="Reports" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u30788_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u30788_1_content"></div></div><div class="grpelem" id="u30789"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix" id="u30750"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem" id="u30751"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem" id="u30780"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u30783" href="top-users.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30784-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30784-3" class="shared_content" data-content-guid="u30784-3_content"><p>Top Users</p></div></div><div class="grpelem" id="u30786"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u30773"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u30776" href="checking_report.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30778-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30778-3" class="shared_content" data-content-guid="u30778-3_content"><p>Checking</p></div></div><div class="grpelem" id="u30779"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u30759"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u30762" href="saving_report.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30765-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30765-3" class="shared_content" data-content-guid="u30765-3_content"><p>Savings</p></div></div><div class="grpelem" id="u30763"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u30766"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u30767" href="loans_report.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30770-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30770-3" class="shared_content" data-content-guid="u30770-3_content"><p>Loan</p></div></div><div class="grpelem" id="u30769"><!-- content --></div></a></li>
         
         <li class="MenuItemContainer clearfix colelem" id="u33633"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u33634" href="demographics.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u33637-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u33637-3" class="shared_content" data-content-guid="u33637-3_content"><p>Demographics</p></div></div><div class="grpelem" id="u33635"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u33577"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u33578" href="phone_test.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u33581-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u33581-3" class="shared_content" data-content-guid="u33581-3_content"><p>Email All</p></div></div><div class="grpelem" id="u33579"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u30791"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u30836" href="account_settings.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u30837"><!-- state-based BG images --><img alt="Dork" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u30837_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u30837_1_content"></div></div><div class="grpelem" id="u30838"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix" id="u30792"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem" id="u30793"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem" id="u30822"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u30823" href="account_setup.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30826-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30826-3" class="shared_content" data-content-guid="u30826-3_content"><p>Account Setup</p></div></div><div class="grpelem" id="u30824"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u30808"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u30811" href="takeout_loan.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30814-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30814-3" class="shared_content" data-content-guid="u30814-3_content"><p>Loan Admin</p></div></div><div class="grpelem" id="u30813"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u30829"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix grpelem" id="u30830" href="update_info.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30832-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30832-3" class="shared_content" data-content-guid="u30832-3_content"><p>Update</p></div></div><div class="grpelem" id="u30833"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u30794"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix grpelem" id="u30795" href="update_info.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30796-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30796-3" class="shared_content" data-content-guid="u30796-3_content"><p>Withdraw/Deposit</p></div></div><div class="grpelem" id="u30798"><!-- content --></div></a></li>
        
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u30840"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u30841" href="logout.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u30843"><!-- state-based BG images --><img alt="Logout" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u30843_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u30843_1_content"></div></div><div class="grpelem" id="u30844"><!-- content --></div></a>
      </div>
     </nav>
    </div>
    <div class="clearfix colelem shared_content" id="u24358" data-content-guid="u24358_content"><!-- group -->
     <div class="grpelem" id="u24328"><!-- simple frame -->
		
		<!--SEARCH-->
		<center><form method='post' action='update_info.php'>
			<label style="font-size: 150%;  color: #0000FF;">Customer ID</label>
			<br><br>
			<input name="checking_search" type="text" style="width:375px; height:40px; ">
			<br><br>
			<input style="font-size: 100%;background-color: #0000FF; color:antiquewhite; width: 375px; height: 40px; margin-bottom: 15px;" name="send" type="submit" value="Search">
		</form></center>
		
		<!--CUSTOMER ADDRESS-->
		<center><table class="table">
			<tr class="row-header">
				<td class="cell" colspan="1" style="text-align:left;">Address ID</td>
				<td class="cell" colspan="0" style="text-align:left;">Customer ID</td>
				<td class="cell" colspan="1" style="text-align:left;">Address</td>
				<td class="cell" colspan="1" style="text-align:left;">City</td>
				<td class="cell" colspan="1" style="text-align:left;">State</td>
				<td class="cell" colspan="1" style="text-align:left;">ZIP</td>
				<td class="cell" colspan="1" style="text-align:left;">Country</td>
			</tr>
			<?php foreach ($rows as $row) { ?>
			<tr>
				<td class="cell-r"><?php echo $row['addyid']; ?></td>
				<td class="cell-r">				
					<form action="update_info_work.php" method="post">
						<input style="font-size: 100%;background-color: #0000FF; color:antiquewhite; width: 375px; height: 40px;" type='submit' name ="add" value=<?php echo $row['cid'];?>>
					</form></td>
				<td class="cell-r"><?php echo $row['streetNum'] . $row['streetName']; ?></td>
				<td class="cell-r"><?php echo $row['city']; ?></td>
				<td class="cell-r"><?php echo $row['state']; ?></td>
				<td class="cell-r"><?php echo $row['zip']; ?></td>
				<td class="cell-r"><?php echo $row['country']; ?></td>
			</tr>
		<?php } //endforeach loop ?>
	   </table></center>
	</main>
	<?php } else { 
	header('Location: access_Denied.php');
	exit;
	} ?>
		 
		</div>
    </div>
    <div class="verticalspacer" data-offset-top="0" data-content-above-spacer="1210" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u30788-a.png?crc=286736856" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u30837-a.png?crc=4233768770" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u30843-a.png?crc=3925028500" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <div class="breakpoint" id="bp_948" data-max-width="948"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox temp_no_id" data-orig-id="page"><!-- column -->
    <div class="clearfix colelem temp_no_id" data-orig-id="pu30744"><!-- group -->
     <div class="clip_frame grpelem temp_no_id" data-orig-id="u30744"><!-- image -->
      <img class="block temp_no_id temp_no_img_src" data-orig-src="images/cash-change-coins-banner-crop-u30744.jpg?crc=4139890737" alt="" data-heightwidthratio="0.13285024154589373" data-image-width="828" data-image-height="110" data-orig-id="u30744_img" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_id temp_no_img_src" alt="Dork's Bank" data-orig-src="images/u30746-4.png?crc=3877500381" data-image-width="266" data-orig-id="u30746-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_id temp_no_img_src" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u30747-4.png?crc=4016458241" data-image-width="214" data-orig-id="u30747-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar clearfix grpelem temp_no_id" data-orig-id="menuu30748"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u30749"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="by_city.php" data-orig-id="u30787"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u30788"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u30788_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u30788_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30789"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u30750"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u30751"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30780"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="top-users.php" data-orig-id="u30783"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30784-4"><!-- content --><span class="placeholder" data-placeholder-for="u30784-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30786"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30773"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="checking_report.php" data-orig-id="u30776"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30778-4"><!-- content --><span class="placeholder" data-placeholder-for="u30778-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30779"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30759"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="saving_report.php" data-orig-id="u30762"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30765-4"><!-- content --><span class="placeholder" data-placeholder-for="u30765-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30763"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30766"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="loans_report.php" data-orig-id="u30767"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30770-4"><!-- content --><span class="placeholder" data-placeholder-for="u30770-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30769"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30752"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="top-users.php" data-orig-id="u30755"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30757-4"><!-- content --><span class="placeholder" data-placeholder-for="u30757-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30758"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u33633"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="demographics.php" data-orig-id="u33634"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u33637-4"><!-- content --><span class="placeholder" data-placeholder-for="u33637-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u33635"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u33577"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="phone_test.php" data-orig-id="u33578"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u33581-4"><!-- content --><span class="placeholder" data-placeholder-for="u33581-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u33579"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u30791"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="account_settings.php" data-orig-id="u30836"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u30837"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u30837_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u30837_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30838"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u30792"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u30793"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30822"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="account_setup.php" data-orig-id="u30823"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30826-4"><!-- content --><span class="placeholder" data-placeholder-for="u30826-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30824"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30808"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="takeout_loan.php" data-orig-id="u30811"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30814-4"><!-- content --><span class="placeholder" data-placeholder-for="u30814-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30813"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30829"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix grpelem temp_no_id" href="update_info.php" data-orig-id="u30830"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30832-4"><!-- content --><span class="placeholder" data-placeholder-for="u30832-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30833"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30794"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix grpelem temp_no_id" href="update_info.php" data-orig-id="u30795"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30796-4"><!-- content --><span class="placeholder" data-placeholder-for="u30796-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30798"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30801"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="deactivate_users.php" data-orig-id="u30804"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30805-4"><!-- content --><span class="placeholder" data-placeholder-for="u30805-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30807"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u30840"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="logout.php" data-orig-id="u30841"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u30843"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u30843_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u30843_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30844"><!-- content --></div></a>
      </div>
     </nav>
    </div>
    <span class="clearfix colelem placeholder" data-placeholder-for="u24358_content"><!-- placeholder node --></span>
    <div class="verticalspacer" data-offset-top="0" data-content-above-spacer="1205" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u30788-a.png?crc=286736856" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u30837-a.png?crc=4233768770" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u30843-a.png?crc=3925028500" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <!-- Other scripts -->
  <script type="text/javascript">
   // Decide weather to suppress missing file error or not based on preference setting
var suppressMissingFileError = true
</script>
 
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=4157109226" type="text/javascript" async data-main="scripts/museconfig.js?crc=380897831" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
   </body>
</html>
