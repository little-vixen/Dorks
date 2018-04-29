<?php
	/*
	update_info_work.php
	
	Dork's Bank
	
	Customer Address Information Update processing
	*/
	if (isset($_POST['add'])) {
		$cid = $_POST['add'];
		try{
			require_once '../pdo_config.php';
			/*
			Return customer address
			Input:	':cid', Customer ID
			*/
			$sql = "SELECT * FROM customerAddress WHERE cid = :cid";
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':cid', $cid);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			$errorInfo = $conn->errorInfo();
		} catch (PDOException $e) { 
			echo $e->getMessage(); 
			exit;
		}
	}
	if (isset($_POST['send'])) {
		$addyid = trim(filter_input(INPUT_POST, 'addyid', FILTER_DEFAULT));
		$cid = trim(filter_input(INPUT_POST, 'cid', FILTER_DEFAULT));
		
		//streetnum
		$streetnum = trim(filter_input(INPUT_POST, 'streetnum', FILTER_DEFAULT));
		if (empty($streetnum)) {
			$missing[] = 'streetnum';
		}
		
		//streetName
		$streetname = trim(filter_input(INPUT_POST, 'streetname', FILTER_DEFAULT));
		if (empty($streetname)) {
			$missing[] = 'streetname';
		}
		
		//city
		$city = trim(filter_input(INPUT_POST, 'city', FILTER_DEFAULT));
		if (empty($city)) {
			$missing[] = 'city';
		}
		
		//state
		$state = trim(filter_input(INPUT_POST, 'state', FILTER_DEFAULT));
		if (empty($state)) {
			$missing[] = 'state';
		}
		
		//zip
		$zip = trim(filter_input(INPUT_POST, 'zip', FILTER_DEFAULT));
		if (empty($zip)) {
			$missing[] = 'zip';
		}
		
		//country
		$country = trim(filter_input(INPUT_POST, 'country', FILTER_DEFAULT));
		if (empty($country)) {
			$missing[] = 'country';
		}
		
		try {
			require_once '../pdo_config.php';
			/*
			Update Customer Address Information
			Input:	- ':addyid', Address ID
					- ':cid', Customer ID
					- ':streetnum', Street Number
					- ':streetname', Street Name
					- ':city', City
					- ':state', State
					- ':zip', Zip
					- ':country', Country
			Output: Redirect to update_info.php
			*/
			$sql = "UPDATE customerAddress SET addyid = :addyid, cid = :cid, streetNum = :streetnum, streetName= :streetname, city= :city, state= :state, zip= :zip, country= :country where addyid = :addyid";
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':addyid',$addyid);
			$stmt->bindValue(':cid',$cid);
			$stmt->bindValue(':streetnum',$streetnum);
			$stmt->bindValue(':streetname',$streetname);
			$stmt->bindValue(':city',$city);
			$stmt->bindValue(':state',$state);
			$stmt->bindValue(':zip',$zip);
			$stmt->bindValue(':country',$country);
			$stmt->execute();
			header('Location: update_info.php');
			exit;
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
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "jquery.musemenu.js", "webpro.js", "jquery.watch.js", "jquery.museresponsive.js", "require.js", "jquery.musepolyfill.bgsize.js", "update_info_work.css"], "outOfDate":[]};
</script>
  
  <title>update_info_work</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="css/master_admin_headeronly.css?crc=216535351"/>
  <link rel="stylesheet" type="text/css" href="css/update_info_work.css?crc=3766769438" id="pagesheet"/>
	 
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
  <link rel="stylesheet" type="text/css" href="css/nomq_preview_master_admin_headeronly.css?crc=4288608174"/>
  <link rel="stylesheet" type="text/css" href="css/nomq_update_info_work.css?crc=365149470" id="nomq_pagesheet"/>
  <![endif]-->
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
   </head>
 <body>

  <div class="breakpoint active" id="bp_infinity" data-min-width="996"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox" id="page"><!-- column -->
    <div class="clearfix colelem" id="pu31466"><!-- group -->
     <div class="clip_frame grpelem" id="u31466"><!-- image -->
      <img class="block temp_no_img_src" id="u31466_img" data-orig-src="images/cash-change-coins-banner-crop-u31466.jpg?crc=303377592" alt="" data-heightwidthratio="0.13279132791327913" data-image-width="1107" data-image-height="147" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_img_src shared_content" id="u31468-4" alt="Dork's Bank" data-orig-src="images/u31468-4.png?crc=385349146" data-image-width="279" src="images/blank.gif?crc=4208392903" data-content-guid="u31468-4_content"/><!-- rasterized frame -->
     <img class="grpelem temp_no_img_src" id="u31469-4" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u31469-4.png?crc=209820837" data-image-width="261" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar clearfix grpelem" id="menuu31470"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem" id="u31471"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u31509" href="by_city.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u31510"><!-- state-based BG images --><img alt="Reports" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u31510_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u31510_1_content"></div></div><div class="grpelem" id="u31511"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix" id="u31472"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem" id="u31473"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem" id="u31502"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31505" href="top-users.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31506-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31506-3" class="shared_content" data-content-guid="u31506-3_content"><p>Top Users</p></div></div><div class="grpelem" id="u31508"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u31495"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31498" href="checking_report.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31500-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31500-3" class="shared_content" data-content-guid="u31500-3_content"><p>Checking</p></div></div><div class="grpelem" id="u31501"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u31481"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31484" href="saving_report.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31487-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31487-3" class="shared_content" data-content-guid="u31487-3_content"><p>Savings</p></div></div><div class="grpelem" id="u31485"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u31488"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31489" href="loans_report.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31492-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31492-3" class="shared_content" data-content-guid="u31492-3_content"><p>Loan</p></div></div><div class="grpelem" id="u31491"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u31474"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31477" href="loans_report.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31479-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31479-3" class="shared_content" data-content-guid="u31479-3_content"><p>Transactions</p></div></div><div class="grpelem" id="u31480"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u33353"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u33356" href="demographics.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u33359-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u33359-3" class="shared_content" data-content-guid="u33359-3_content"><p>Demographics</p></div></div><div class="grpelem" id="u33358"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u33409"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u33412" href="phone_test.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u33413-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u33413-3" class="shared_content" data-content-guid="u33413-3_content"><p>Email All</p></div></div><div class="grpelem" id="u33414"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u31513"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u31558" href="account_settings.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u31559"><!-- state-based BG images --><img alt="Dork" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u31559_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u31559_1_content"></div></div><div class="grpelem" id="u31560"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix" id="u31514"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem" id="u31515"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem" id="u31544"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31545" href="account_setup.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31548-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31548-3" class="shared_content" data-content-guid="u31548-3_content"><p>Account Setup</p></div></div><div class="grpelem" id="u31546"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u31530"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31533" href="takeout_loan.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31536-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31536-3" class="shared_content" data-content-guid="u31536-3_content"><p>Loan Admin</p></div></div><div class="grpelem" id="u31535"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u31551"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31552" href="update_info.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31554-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31554-3" class="shared_content" data-content-guid="u31554-3_content"><p>Update</p></div></div><div class="grpelem" id="u31555"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u31516"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31517" href="withdraw.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31518-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31518-3" class="shared_content" data-content-guid="u31518-3_content"><p>Withdraw/Deposit</p></div></div><div class="grpelem" id="u31520"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u31523"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u31526" href="deactivate_users.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u31527-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u31527-3" class="shared_content" data-content-guid="u31527-3_content"><p>Activate/Deactivate</p></div></div><div class="grpelem" id="u31529"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u31562"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u31563" href="logout.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u31565"><!-- state-based BG images --><img alt="Logout" src="images/blank.gif?crc=4208392903" class="shared_content" data-content-guid="u31565_0_content"/><div class="fluid_height_spacer shared_content" data-content-guid="u31565_1_content"></div></div><div class="grpelem" id="u31566"><!-- content --></div></a>
      </div>
     </nav>
    </div>
    <div class="clearfix colelem" id="u11424"><!-- group -->
     <div class="clearfix grpelem" id="u11406"><!-- group -->
      <!-- rasterized frame -->
		 
		 	<!--CUSTOMER ADDRESS-->
	<table class="table" style="position:center;">
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
			<td class="cell-r"><?php echo $row['addyid']; $addyid = $row['addyid'];?></td>
			<td class="cell-r"><?php echo $row['cid']; $cid = $row['cid'];?></td>
			<td class="cell-r"><?php echo $row['streetNum'] . $row['streetName']; $streetnum = $row['streetNum']; $streetname = $row['streetName'];?></td>
			<td class="cell-r"><?php echo $row['city']; $city = $row['city'];?></td>
			<td class="cell-r"><?php echo $row['state']; $state = $row['state'];?></td>
			<td class="cell-r"><?php echo $row['zip']; $zip = $row['zip'];?></td>
			<td class="cell-r"><?php echo $row['country']; $country = $row['country'];?></td>
		</tr>
    <?php } //endforeach loop ?>
    </table><!--INPUT-->
	<form method="post" action="update_info_work.php">
		<!--Street Number-->
		<input name="addyid" type="hidden" value=<?php echo "$addyid";?>>
		<input name="cid" type="hidden" value=<?php echo "$cid";?>>
		<p>
			<center><label style="font-size: 150%;color: #0000FF;"> Street Number: </label>
			<br><br>
			<input style="width:375px; height:40px;" name="streetnum" type="text" value=<?php echo "$streetnum";?>
				<?php if (isset($streetnum)) {
					echo 'value="' . htmlentities($streetnum) . '"';
				} ?>>
		</p>
		<br>
		<!--Street Name-->
		<p>
			<label style="font-size: 150%;color: #0000FF;">Street Name: </label>
			<br><br>
			<input style="width:375px; height:40px;" name="streetname" type="text" value=<?php echo "$streetname";?>>
		</p>
		<br>
		<!--City-->
		<p>
			<label style="font-size: 150%;color: #0000FF;">City: </label>
			<br><br>
			<input style="width:375px; height:40px;" name="city" type="text" value=<?php echo "$city";?>>
		</p>
		<br>
		<!--State-->
		<p>
			<label style="font-size: 150%;color: #0000FF;">State: </label>
			<br><br>
			<input style="width:375px; height:40px;" name="state" type="text" value=<?php echo "$state";?>>
		</p>
		<br>
		<!--Zip-->
		<p>
			<label style="font-size: 150%;color: #0000FF;">Zip: </label>
			<br><br>
			<input style="width:375px; height:40px;" name="zip" type="text" value=<?php echo "$zip";?>>
		</p>
		<br>
		<!--Country-->
		<p>
			<label style="font-size: 150%;color: #0000FF;">Country: </label>
			<br><br>
			<input style="width:375px; height:40px;" name="country" type="text" value=<?php echo "$country";?>>
		</p>
		<br>
		<p>
		<input style="font-size: 130%;background-color: #0000FF; color:antiquewhite; width: 375px; height: 40px; margin-bottom: 15px;" name="send" type="submit" value="Update">
		</p>
	</form></center>
 
     
         
         <div class="fld-grp clearfix grpelem" id="widgetu11350" data-required="true"><!-- none box -->
          
          <div class="fld-message clearfix grpelem" id="u11353-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content -->
           <p class="shared_content" data-content-guid="u11353-4_0_content">Required</p>
       </div>
      </div>
     </div>
<div class="clearfix colelem" id="pu11362-4"><!-- group -->
  <div class="clearfix grpelem" id="u11362-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content -->
         <p class="shared_content" data-content-guid="u11362-4_0_content">Submitting Form...</p>
        </div>
        <div class="clearfix grpelem" id="u11392-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content -->
         <p class="shared_content" data-content-guid="u11392-4_0_content">The server encountered an error.</p>
        </div>
     </div>
      </form>
     </div>
    </div>
    <div class="verticalspacer shared_content" data-offset-top="1456" data-content-above-spacer="1210" data-content-below-spacer="307" data-sizePolicy="fixed" data-pintopage="page_fixedLeft" data-content-guid="page_2_content"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u31510-a.png?crc=286736856" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u31559-a.png?crc=4233768770" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u31565-a.png?crc=3925028500" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11361-ferr.png?crc=400137501" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11377-ferr.png?crc=432628417" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11349-ferr.png?crc=329174086" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11351-ferr.png?crc=389535245" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11391-r.png?crc=3870359806" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11405-ferr.png?crc=156688855" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11356-ferr.png?crc=535536118" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11373-ferr.png?crc=4242002409" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11400-ferr.png?crc=439685048" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11396-ferr.png?crc=290584959" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11368-ferr.png?crc=429753847" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11390-ferr.png?crc=4207921964" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttonunchecked.png?crc=3976871150" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttonuncheckedrollover.png?crc=4276313674" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttonuncheckedmousedown.png?crc=54863585" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttonchecked.png?crc=4193302265" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttoncheckedrollover.png?crc=88928956" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttoncheckedmousedown.png?crc=4280357799" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11386-ferr.png?crc=4002687073" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11383-ferr.png?crc=4002687073" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <div class="breakpoint" id="bp_995" data-max-width="995"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox temp_no_id" data-orig-id="page"><!-- column -->
    <div class="clearfix colelem temp_no_id" data-orig-id="pu31466"><!-- group -->
     <div class="clip_frame grpelem temp_no_id" data-orig-id="u31466"><!-- image -->
      <img class="block temp_no_id temp_no_img_src" data-orig-src="images/cash-change-coins-banner-crop-u31466.jpg?crc=303377592" alt="" data-heightwidthratio="0.1334867663981588" data-image-width="869" data-image-height="116" data-orig-id="u31466_img" src="images/blank.gif?crc=4208392903"/>
     </div>
     <span class="grpelem placeholder" data-placeholder-for="u31468-4_content"><!-- placeholder node --></span>
     <img class="grpelem temp_no_id temp_no_img_src" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u31469-4.png?crc=209820837" data-image-width="204" data-orig-id="u31469-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar clearfix grpelem temp_no_id" data-orig-id="menuu31470"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u31471"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="by_city.php" data-orig-id="u31509"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u31510"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u31510_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u31510_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31511"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u31472"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u31473"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31502"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="top-users.php" data-orig-id="u31505"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31506-4"><!-- content --><span class="placeholder" data-placeholder-for="u31506-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31508"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31495"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="checking_report.php" data-orig-id="u31498"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31500-4"><!-- content --><span class="placeholder" data-placeholder-for="u31500-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31501"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31481"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="saving_report.php" data-orig-id="u31484"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31487-4"><!-- content --><span class="placeholder" data-placeholder-for="u31487-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31485"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31488"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="loans_report.php" data-orig-id="u31489"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31492-4"><!-- content --><span class="placeholder" data-placeholder-for="u31492-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31491"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31474"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="loans_report.php" data-orig-id="u31477"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31479-4"><!-- content --><span class="placeholder" data-placeholder-for="u31479-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31480"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u33353"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="demographics.php" data-orig-id="u33356"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u33359-4"><!-- content --><span class="placeholder" data-placeholder-for="u33359-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u33358"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u33409"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="phone_test.php" data-orig-id="u33412"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u33413-4"><!-- content --><span class="placeholder" data-placeholder-for="u33413-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u33414"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u31513"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="account_settings.php" data-orig-id="u31558"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u31559"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u31559_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u31559_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31560"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix temp_no_id" data-orig-id="u31514"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem temp_no_id" data-orig-id="u31515"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31544"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="account_setup.php" data-orig-id="u31545"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31548-4"><!-- content --><span class="placeholder" data-placeholder-for="u31548-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31546"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31530"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="takeout_loan.php" data-orig-id="u31533"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31536-4"><!-- content --><span class="placeholder" data-placeholder-for="u31536-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31535"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31551"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="update_info.php" data-orig-id="u31552"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31554-4"><!-- content --><span class="placeholder" data-placeholder-for="u31554-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31555"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31516"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="withdraw.php" data-orig-id="u31517"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31518-4"><!-- content --><span class="placeholder" data-placeholder-for="u31518-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31520"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u31523"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="deactivate_users.php" data-orig-id="u31526"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u31527-4"><!-- content --><span class="placeholder" data-placeholder-for="u31527-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31529"><!-- content --></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem temp_no_id" data-orig-id="u31562"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem temp_no_id" href="logout.php" data-orig-id="u31563"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem temp_no_id" data-orig-id="u31565"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u31565_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u31565_1_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u31566"><!-- content --></div></a>
      </div>
     </nav>
    </div>
    <div class="clearfix colelem temp_no_id" data-orig-id="u11424"><!-- group -->
     <div class="clearfix grpelem temp_no_id" data-orig-id="u11406"><!-- group -->
      <img class="grpelem temp_no_id temp_no_img_src" alt="Update Customer Information:" data-orig-src="images/u11407-42.png?crc=3828014304" data-image-width="222" data-orig-id="u11407-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
      <form class="form-grp clearfix grpelem temp_no_id" method="post" enctype="multipart/form-data" action="scripts/form-u11345.php" data-orig-id="widgetu11345"><!-- none box -->
       <div class="position_content" id="widgetu11345_position_content">
        <div class="clearfix colelem temp_no_id" data-orig-id="pwidgetu11358"><!-- group -->
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11358"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11361"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11358_input" data-orig-id="u11361"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11361_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11361_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11359-4"><!-- content --><div class="temp_no_id" data-orig-id="u11359-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11358_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11358_input" data-orig-id="widgetu11358_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11358_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11360-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11360-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11375"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11377"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11375_input" data-orig-id="u11377"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11377_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11377_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11378-4"><!-- content --><div class="temp_no_id" data-orig-id="u11378-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11375_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11375_input" data-orig-id="widgetu11375_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11375_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11376-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11376-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
        </div>
        <div class="clearfix colelem temp_no_id" data-orig-id="pwidgetu11346"><!-- group -->
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-type="email" data-orig-id="widgetu11346"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11349"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11346_input" data-orig-id="u11349"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11349_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11349_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11348-4"><!-- content --><div class="temp_no_id" data-orig-id="u11348-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11346_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11346_input" data-orig-id="widgetu11346_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11346_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11347-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11347-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11350"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11351"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11350_input" data-orig-id="u11351"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11351_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11351_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11352-4"><!-- content --><div class="temp_no_id" data-orig-id="u11352-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11350_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11350_input" data-orig-id="widgetu11350_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11350_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11353-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11353-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
        </div>
        <div class="clearfix colelem temp_no_id" data-orig-id="pu11397-4"><!-- group -->
         <div class="clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11397-4"><!-- content -->
          <span class="placeholder" data-placeholder-for="u11397-4_0_content"><!-- placeholder node --></span>
         </div>
         <button class="submit-btn NoWrap grpelem temp_no_id" type="submit" value="Submit" tabindex="26" data-orig-id="u11391"><!-- state-based BG images -->
          <span class="placeholder" data-placeholder-for="u11391_0_content"><!-- placeholder node --></span>
          <span class="fluid_height_spacer placeholder" data-placeholder-for="u11391_1_content"><!-- placeholder node --></span>
         </button>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11402"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11405"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11402_input" data-orig-id="u11405"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11405_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11405_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11403-4"><!-- content --><div class="temp_no_id" data-orig-id="u11403-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11402_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11402_input" data-orig-id="widgetu11402_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11402_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11404-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11404-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11354"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11356"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11354_input" data-orig-id="u11356"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11356_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11356_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11357-4"><!-- content --><div class="temp_no_id" data-orig-id="u11357-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11354_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11354_input" data-orig-id="widgetu11354_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11354_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11355-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11355-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11371"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11373"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11371_input" data-orig-id="u11373"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11373_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11373_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11372-4"><!-- content --><div class="temp_no_id" data-orig-id="u11372-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11371_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11371_input" data-orig-id="widgetu11371_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11371_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11374-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11374-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11398"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11400"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11398_input" data-orig-id="u11400"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11400_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11400_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11399-4"><!-- content --><div class="temp_no_id" data-orig-id="u11399-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11398_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11398_input" data-orig-id="widgetu11398_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11398_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11401-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11401-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11393"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11396"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11393_input" data-orig-id="u11396"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11396_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11396_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11394-4"><!-- content --><div class="temp_no_id" data-orig-id="u11394-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11393_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11393_input" data-orig-id="widgetu11393_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11393_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11395-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11395-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11363"><!-- none box -->
          <span class="fld-input NoWrap actAsDiv clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11364-4"><!-- content --><div class="temp_no_id" data-orig-id="u11364-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11363_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11363_input" data-orig-id="widgetu11363_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11363_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11366-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11366-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-orig-id="widgetu11367"><!-- none box -->
          <div class="clearfix grpelem temp_no_id" data-orig-id="ppu11368"><!-- column -->
           <label class="fld-label colelem temp_no_id" for="widgetu11367_input" data-orig-id="u11368"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11368_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11368_1_content"><!-- placeholder node --></span></label>
           <span class="fld-input NoWrap actAsDiv clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11369-4"><!-- content --><div class="temp_no_id" data-orig-id="u11369-3"><span class="wrapped-input placeholder" data-placeholder-for="widgetu11367_input_content"><!-- placeholder node --></span><label class="wrapped-input fld-prompt temp_no_id" for="widgetu11367_input" data-orig-id="widgetu11367_prompt"><span class="actAsPara placeholder" data-placeholder-for="widgetu11367_prompt_0_content"><!-- placeholder node --></span></label></div></span>
          </div>
          <div class="fld-message clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11370-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11370-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
         <div class="fld-grp clearfix grpelem temp_no_id" data-required="true" data-type="radiogroup" data-orig-id="widgetu11379"><!-- none box -->
          <div class="clearfix colelem temp_no_id" data-orig-id="pwidgetu11388"><!-- group -->
           <div class="fld-grp clearfix grpelem temp_no_id" data-required="false" data-type="radio" data-orig-id="widgetu11388"><!-- none box -->
            <label class="fld-label colelem temp_no_id" for="widgetu11388_input" data-orig-id="u11390"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11390_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11390_1_content"><!-- placeholder node --></span></label>
            <div class="fld-radiobutton museBGSize colelem temp_no_id" data-orig-id="u11389"><!-- simple frame -->
             <span class="wrapped-input placeholder" data-placeholder-for="widgetu11388_input_content"><!-- placeholder node --></span>
             <label for="widgetu11388_input"></label>
            </div>
           </div>
           <div class="fld-grp clearfix grpelem temp_no_id" data-required="false" data-type="radio" data-orig-id="widgetu11385"><!-- none box -->
            <div class="fld-radiobutton museBGSize colelem temp_no_id" data-orig-id="u11387"><!-- simple frame -->
             <span class="wrapped-input placeholder" data-placeholder-for="widgetu11385_input_content"><!-- placeholder node --></span>
             <label for="widgetu11385_input"></label>
            </div>
            <label class="fld-label colelem temp_no_id" for="widgetu11385_input" data-orig-id="u11386"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11386_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11386_1_content"><!-- placeholder node --></span></label>
           </div>
          </div>
          <div class="fld-grp clearfix colelem temp_no_id" data-required="false" data-type="radio" data-orig-id="widgetu11382"><!-- none box -->
           <label class="fld-label grpelem temp_no_id" for="widgetu11382_input" data-orig-id="u11383"><!-- state-based BG images --><span class="placeholder" data-placeholder-for="u11383_0_content"><!-- placeholder node --></span><span class="fluid_height_spacer placeholder" data-placeholder-for="u11383_1_content"><!-- placeholder node --></span></label>
           <div class="fld-radiobutton museBGSize grpelem temp_no_id" data-orig-id="u11384"><!-- simple frame -->
            <span class="wrapped-input placeholder" data-placeholder-for="widgetu11382_input_content"><!-- placeholder node --></span>
            <label for="widgetu11382_input"></label>
           </div>
          </div>
          <div class="fld-message clearfix colelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11380-4"><!-- content -->
           <span class="placeholder" data-placeholder-for="u11380-4_0_content"><!-- placeholder node --></span>
          </div>
         </div>
        </div>
        <div class="clearfix colelem temp_no_id" data-orig-id="pu11362-4"><!-- group -->
         <div class="clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11362-4"><!-- content -->
          <span class="placeholder" data-placeholder-for="u11362-4_0_content"><!-- placeholder node --></span>
         </div>
         <div class="clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u11392-4"><!-- content -->
          <span class="placeholder" data-placeholder-for="u11392-4_0_content"><!-- placeholder node --></span>
         </div>
        </div>
       </div>
      </form>
     </div>
    </div>
    <span class="verticalspacer placeholder" data-placeholder-for="page_2_content"><!-- placeholder node --></span>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u31510-a.png?crc=286736856" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u31559-a.png?crc=4233768770" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u31565-a.png?crc=3925028500" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11361-ferr2.png?crc=66944758" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11377-ferr2.png?crc=4049960151" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11349-ferr2.png?crc=516504376" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11351-ferr2.png?crc=4070243728" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11391-r2.png?crc=39844249" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11405-ferr2.png?crc=370513212" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11356-ferr2.png?crc=87487426" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11373-ferr2.png?crc=4129957132" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11400-ferr2.png?crc=209372426" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11396-ferr2.png?crc=66934405" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11368-ferr2.png?crc=193986722" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11390-ferr2.png?crc=45315370" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttonunchecked.png?crc=3976871150" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttonuncheckedrollover.png?crc=4276313674" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttonuncheckedmousedown.png?crc=54863585" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttonchecked.png?crc=4193302265" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttoncheckedrollover.png?crc=88928956" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/radiobuttoncheckedmousedown.png?crc=4280357799" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11386-ferr2.png?crc=4130994134" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u11383-ferr2.png?crc=4130994134" alt="" src="images/blank.gif?crc=4208392903"/>
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
var muse_init=function(){require.config({baseUrl:""});require(["jquery","museutils","whatinput","jquery.musemenu","jquery.musepolyfill.bgsize","webpro","jquery.watch","jquery.museresponsive"],function(d){var $ = d;$(document).ready(function(){try{
window.Muse.assets.check($);/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.makeButtonsVisibleAfterSettingMinWidth();/* body */
Muse.Utils.initWidget('.MenuBar', ['#bp_infinity', '#bp_995'], function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
Muse.Utils.initWidget('#widgetu11345', ['#bp_infinity', '#bp_995'], function(elem) { return new WebPro.Widget.Form(elem, {validationEvent:'submit',errorStateSensitivity:'high',fieldWrapperClass:'fld-grp',formSubmittedClass:'frm-sub-st',formErrorClass:'frm-subm-err-st',formDeliveredClass:'frm-subm-ok-st',notEmptyClass:'non-empty-st',focusClass:'focus-st',invalidClass:'fld-err-st',requiredClass:'fld-err-st',ajaxSubmit:true}); });/* #widgetu11345 */
Muse.Utils.fullPage('#page');/* 100% height page */
$( '.breakpoint' ).registerBreakpoint();/* Register breakpoints */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
}catch(b){if(b&&"function"==typeof b.notify?b.notify():Muse.Assert.fail("Error calling selector function: "+b),false)throw b;}})})};

</script>
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=4157109226" type="text/javascript" async data-main="scripts/museconfig.js?crc=380897831" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
   </body>
</html>
