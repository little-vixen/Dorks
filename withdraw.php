<?php
	session_start();
	/*
	withdraw.php
	
	Dork's Bank
	
	Withdraws/Deposits into an account, Employee access only
	*/
	if (isset($_SESSION['aid'])) { 
		require_once '../pdo_config.php';
		$search = trim(filter_input(INPUT_POST, 'checking_search', FILTER_SANITIZE_STRING));
		if (isset($_POST['send'])) {
			try{
				/*
				Display Checking accounts for a customer
				Input: - ':cid' : Customer ID
				Output: Return Customer Checking Accounts
				*/
				$sql = "SELECT * FROM customer, checking WHERE customer.cid = :cid and checking.cid = customer.cid";
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cid', $search);
				$stmt->execute();
				$rows = $stmt->fetchAll();
				
				/*
				Display Saving accounts for a customer
				Input: - ':cid' : Customer ID
				Output: Return Customer Saving Accounts
				*/
				$sql2="SELECT * FROM customer, savings WHERE customer.cid = :cid and savings.cid = customer.cid";
				$stmt2 = $conn->prepare($sql2);
				$stmt2->bindValue(':cid', $search);
				$stmt2->execute();
				$rows2 = $stmt2->fetchAll();
				
			} catch (PDOException $e) { 
				echo $e->getMessage(); 
				exit;
			}
		}
		if (isset($_POST['CW']) || isset($_POST['CD'])) {
			$checkid = $_POST['checkid'];
			$cid = $_POST['cid'];
			$amount = $_POST['amount'];
			/*
			Return max transaction ID from checking transactions table
			*/
			$sql = "SELECT MAX(tid) as max FROM ctransaction WHERE 1";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			$max = 0;
			foreach ($rows as $row) {
				$max = $row['max'];
			}
			$max = $max + 1;
			/*
			Creates a new Checking Transaction
			Input:	- ':tid' : Max Transaction ID + 1
					- ':transtype' : Transaction Type (Withdraw/Deposit)
					- ':amount' : Amount
					- ':checkid' : Check ID
					- ':cid' : Customer ID
			Output: Redirect to withdraw_filter.php
			*/
			$sql2 = "INSERT INTO ctransaction(tid, transtype, transdate, amount, cid, checkid) VALUES (:tid, :transtype, CURRENT_TIMESTAMP(), :amount, :cid, :checkid)";
			$stmt2 = $conn->prepare($sql2);
			$stmt2->bindValue(':tid', $max);
			if (isset($_POST['CW'])) {
				$stmt2->bindValue(':transtype', 'W');
				$stmt2->bindValue(':amount', -$amount);
			}
			if (isset($_POST['CD'])) {
				$stmt2->bindValue(':transtype', 'D');
				$stmt2->bindValue(':amount', $amount);
			}
			$stmt2->bindValue(':cid', $cid);
			$stmt2->bindValue(':checkid', $checkid);
			$stmt2->execute();
			header('Location: withdraw_filter.php');
			exit;
		}
		if (isset($_POST['SW']) || isset($_POST['SD'])) {
			$saveid = $_POST['saveid'];
			$cid = $_POST['cid'];
			$amount = $_POST['amount'];
			/*
			Return max transaction ID from saving transactions table
			*/
			$sql3 = "SELECT MAX(tid) as max FROM stransaction WHERE 1";
			$stmt3 = $conn->prepare($sql3);
			$stmt3->execute();
			$rows3 = $stmt3->fetchAll();
			$max = 0;
			foreach ($rows3 as $row3) {
				$max = $row3['max'];
			}
			$max = $max + 1;
			/*
			Creates a new Saving Transaction
			Input:	- ':tid' : Max Transaction ID + 1
					- ':transtype' : Transaction Type (Withdraw/Deposit)
					- ':amount' : Amount
					- ':saveid' : Save ID
					- ':cid' : Customer ID
			Output: Redirect to withdraw_filter.php
			*/
			$sql4 = "INSERT INTO stransaction(tid, transtype, transdate, amount, cid, saveid) VALUES (:tid, :transtype, CURRENT_TIMESTAMP(), :amount, :cid, :saveid)";
			$stmt4 = $conn->prepare($sql4);
			$stmt4->bindValue(':tid', $max);
			if (isset($_POST['SW'])) {
				$stmt4->bindValue(':transtype', 'W');
				$stmt4->bindValue(':amount', -$amount);
			}
			if (isset($_POST['SD'])) {
				$stmt4->bindValue(':transtype', 'D');
				$stmt4->bindValue(':amount', $amount);
			}
			echo $amount;
			$stmt4->bindValue(':cid', $cid);
			$stmt4->bindValue(':saveid', $saveid);
			$stmt4->execute();
			header('Location: withdraw.php');
			exit;
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
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.watch.js", "jquery.museresponsive.js", "require.js", "withdraw.css"], "outOfDate":[]};
</script>
  
  <title>withdraw</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="css/master_admin.css?crc=20483078"/>
  <link rel="stylesheet" type="text/css" href="css/withdraw.css?crc=4293335970" id="pagesheet"/>
	 
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

  </style> 
	 
  <!-- IE-only CSS -->
  <!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="css/nomq_preview_master_admin.css?crc=93109966"/>
  <link rel="stylesheet" type="text/css" href="css/nomq_withdraw.css?crc=3942528070" id="nomq_pagesheet"/>
  <![endif]-->
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
   </head>
 <body>

  <div class="breakpoint active" id="bp_infinity" data-min-width="1349"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox" id="page"><!-- column -->
    <div class="clearfix colelem" id="pu30744"><!-- group -->
     <div class="clip_frame grpelem" id="u30744"><!-- image -->
      <img class="block temp_no_img_src" id="u30744_img" data-orig-src="images/cash-change-coins-banner-crop-u30744.jpg?crc=4139890737" alt="" data-heightwidthratio="0.13329383886255924" data-image-width="1688" data-image-height="225" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_img_src" id="u30746-4" alt="Dork's Bank" data-orig-src="images/u30746-4.png?crc=3877500381" data-image-width="448" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_img_src" id="u30747-4" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u30747-4.png?crc=4016458241" data-image-width="397" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar gradient clearfix grpelem" id="menuu30748"><!-- horizontal box -->
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
         <li class="MenuItemContainer clearfix colelem" id="u30829"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u30830" href="update_info.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30832-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30832-3" class="shared_content" data-content-guid="u30832-3_content"><p>Update</p></div></div><div class="grpelem" id="u30833"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u30794"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u30795" href="withdraw.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u30796-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u30796-3" class="shared_content" data-content-guid="u30796-3_content"><p>Withdraw/Deposit</p></div></div><div class="grpelem" id="u30798"><!-- content --></div></a></li>
        
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
		
		 <?php if (!isset($_POST['check_with']) && !isset($_POST['check_dep']) && !isset($_POST['save_with']) && !isset($_POST['save_dep'])) { ?>
			<!--SEARCH-->
			<center><form method='post' action='withdraw.php'>
			<label style="font-size: 150%;  color: #0000FF;">Customer ID</label>
			<br><br>
			<input name="checking_search" type="text" style="width:375px;">
			<br><br>
			<input style="font-size: 100%;background-color: #0000FF; color:antiquewhite; width: 375px; height: 40px; margin-bottom: 15px;" name="send" type="submit" value="Search">
				</form></center>
			<!--ALL CHECKING-->
			<center><table class="table" style="position:center;">
				<tr class="row-header">
					<td class="cell" colspan="7" style="text-align:left;">Checking Deposit/Withdraw</td>
				</tr>
				<tr class="row-header">
					<td class="cell" colspan="0" style="text-align:left;">Checking ID</td>
					<td class="cell" colspan="0" style="text-align:left;">Customer ID</td>
					<td class="cell" colspan="0" style="text-align:left;">First</td>
					<td class="cell" colspan="0" style="text-align:left;">Last</td>
					<td class="cell" colspan="1" style="text-align:left;">Balance</td>
					<td class="cell" colspan="1" style="text-align:left; width:175px;">Withdraw</td>
					<td class="cell" colspan="1" style="text-align:left; width:175px;">Deposit</td>
				</tr>
				<?php foreach ($rows as $row) { ?>
				<tr>
					<td class="cell-r"><?php echo $row['checkid']; ?></td>
					<td class="cell-r"><?php echo $row['cid']; ?></td>
					<td class="cell-r"><?php echo $row['fn']; ?></td>
					<td class="cell-r"><?php echo $row['ln']; ?></td>
					<td class="cell-r"><?php echo $row['bal']; ?></td>
					<td class="cell-r">				
						<form action="withdraw.php" method="post">
							<input type="hidden" name="saveid" value="<?php echo $row2['saveid']; ?>">
							<input type="hidden" name="cid" value="<?php echo $row2['cid']; ?>">
							<input type="hidden" name="fn" value="<?php echo $row2['fn']; ?>">
							<input type="hidden" name="ln" value="<?php echo $row2['ln']; ?>">
							<input type="hidden" name="bal" value="<?php echo $row2['bal']; ?>">
							<input style="font-size: 120%;background-color: #0000FF; color:antiquewhite; width: 175px;" type='submit' name ="save_with" value="Withdraw">
						</form></td>
					<td class="cell-r">				
						<form action="withdraw.php" method="post">
							<input type="hidden" name="saveid" value="<?php echo $row2['saveid']; ?>">
							<input type="hidden" name="cid" value="<?php echo $row2['cid']; ?>">
							<input type="hidden" name="fn" value="<?php echo $row2['fn']; ?>">
							<input type="hidden" name="ln" value="<?php echo $row2['ln']; ?>">
							<input type="hidden" name="bal" value="<?php echo $row2['bal']; ?>">
							<input style="font-size: 120%;background-color: #0000FF; color:antiquewhite; width: 175px;;" type='submit' name ="save_dep" value="Deposit">
						</form></td>
				</tr>
			<?php } //endforeach loop ?>
				</table></center><br></br>
	   <!--ALL SAVINGS-->
			<center><table class="table" style="position:center;">
				<tr class="row-header">
					<td class="cell" colspan="7" style="text-align:left;">Savings Deposit/Withdraw</td>
				</tr>
				<tr class="row-header">
					<td class="cell" colspan="0" style="text-align:left;">Savings ID</td>
					<td class="cell" colspan="0" style="text-align:left;">Customer ID</td>
					<td class="cell" colspan="0" style="text-align:left;">First</td>
					<td class="cell" colspan="0" style="text-align:left;">Last</td>
					<td class="cell" colspan="1" style="text-align:left;">Balance</td>
					<td class="cell" colspan="1" style="text-align:left; width:175px;">Withdraw</td>
					<td class="cell" colspan="1" style="text-align:left; width:175px;">Deposit</td>
				</tr>
				<?php foreach ($rows2 as $row2) { ?>
				<tr>
					<td class="cell-r"><?php echo $row2['saveid']; ?></td>
					<td class="cell-r"><?php echo $row2['cid']; ?></td>
					<td class="cell-r"><?php echo $row2['fn']; ?></td>
					<td class="cell-r"><?php echo $row2['ln']; ?></td>
					<td class="cell-r"><?php echo $row2['bal']; ?></td>
					<td class="cell-r">				
						<form action="withdraw.php" method="post">
							<input type="hidden" name="saveid" value="<?php echo $row2['saveid']; ?>">
							<input type="hidden" name="cid" value="<?php echo $row2['cid']; ?>">
							<input type="hidden" name="fn" value="<?php echo $row2['fn']; ?>">
							<input type="hidden" name="ln" value="<?php echo $row2['ln']; ?>">
							<input type="hidden" name="bal" value="<?php echo $row2['bal']; ?>">
							<input style="font-size: 120%;background-color: #0000FF; color:antiquewhite; width: 175px;" type='submit' name ="save_with" value="Withdraw">
						</form></td>
					<td class="cell-r">				
						<form action="withdraw.php" method="post">
							<input type="hidden" name="saveid" value="<?php echo $row2['saveid']; ?>">
							<input type="hidden" name="cid" value="<?php echo $row2['cid']; ?>">
							<input type="hidden" name="fn" value="<?php echo $row2['fn']; ?>">
							<input type="hidden" name="ln" value="<?php echo $row2['ln']; ?>">
							<input type="hidden" name="bal" value="<?php echo $row2['bal']; ?>">
							<input style="font-size: 120%;background-color: #0000FF; color:antiquewhite; width: 175px;;" type='submit' name ="save_dep" value="Deposit">
						</form></td>
				</tr>
			<?php } //endforeach loop ?>
				</table></center>
		<?php } ?>
	   
	   </div>
    <div class="colelem" id="u23572"><!-- simple frame -->
	  <!--CHECKING WITHDRAW/DEPOSIT-->
		<?php 
			if (isset($_POST['check_with']) || isset($_POST['check_dep'])) { 
			$checkid = $_POST['checkid'];
			$cid = $_POST['cid'];
			$fn = $_POST['fn'];
			$ln = $_POST['ln'];
			$bal = $_POST['bal'];?>
			<table>
				<tr class="row-header">
					<td class="cell" colspan="0" style="text-align:left;">Checking ID</td>
					<td class="cell" colspan="0" style="text-align:left;">Customer ID</td>
					<td class="cell" colspan="0" style="text-align:left;">First</td>
					<td class="cell" colspan="0" style="text-align:left;">Last</td>
					<td class="cell" colspan="1" style="text-align:left;">Balance</td>
				</tr>
				<tr>
					<td class="cell-r"><?php echo $checkid; ?></td>
					<td class="cell-r"><?php echo $cid; ?></td>
					<td class="cell-r"><?php echo $fn; ?></td>
					<td class="cell-r"><?php echo $ln; ?></td>
					<td class="cell-r"><?php echo $bal; ?></td>
				</tr>
			</table>
			<br><br>
			<form method="post" action="withdraw.php">
				<label style="font-size: 150%;color: #0000FF;">Amount: </label>
				<input name="amount" type="number" style="width:375px; height:45px; ">
				<input name="checkid" type="hidden" value="<?php echo $checkid; ?>">
				<input name="cid" type="hidden" value="<?php echo $cid; ?>">
				<br><br>
				<?php if (isset($_POST['check_with'])) { ?>
					<input style="font-size: 120%;background-color: #0000FF; color:antiquewhite; width: 375px; height:45px;" name="CW" type="submit" value="Withdraw">
				<?php } ?>
				<?php if (isset($_POST['check_dep'])) { ?>
					<input style="font-size: 120%;background-color: #0000FF; color:antiquewhite; width: 375px; height:45px; " name="CD" type="submit" value="Depost">
				<?php } ?>
			</form>
		<?php } ?>
		<!--SAVINGS WITHDRAW/DEPOSIT-->
		<?php 
			if (isset($_POST['save_with']) || isset($_POST['save_dep'])) { 
			$saveid = $_POST['saveid'];
			$cid = $_POST['cid'];
			$fn = $_POST['fn'];
			$ln = $_POST['ln'];
			$bal = $_POST['bal'];?>
			<table>
				<tr class="row-header">
					<td class="cell" colspan="0" style="text-align:left;">Savings ID</td>
					<td class="cell" colspan="0" style="text-align:left;">Customer ID</td>
					<td class="cell" colspan="0" style="text-align:left;">First</td>
					<td class="cell" colspan="0" style="text-align:left;">Last</td>
					<td class="cell" colspan="1" style="text-align:left;">Balance</td>
				</tr>
				<tr>
					<td class="cell-r"><?php echo $saveid; ?></td>
					<td class="cell-r"><?php echo $cid; ?></td>
					<td class="cell-r"><?php echo $fn; ?></td>
					<td class="cell-r"><?php echo $ln; ?></td>
					<td class="cell-r"><?php echo $bal; ?></td>
				</tr>
			</table>
			<br><br>
			<form method="post" action="withdraw.php">
				<label style="font-size: 150%;color: #0000FF;">Amount: </label>
				<input name="amount" type="number" style="width:375px; height:45px;">
				<input name="saveid" type="hidden" value="<?php echo $saveid; ?>">
				<input name="cid" type="hidden" value="<?php echo $cid; ?>">
				<br><br>
				<?php if (isset($_POST['save_with'])) { ?>
					<input style="font-size: 120%;background-color: #0000FF; color:antiquewhite; width: 375px; height:45px; " name="SW" type="submit" value="Withdraw">
				<?php } ?>
				<?php if (isset($_POST['save_dep'])) { ?>
					<input style="font-size: 120%;background-color: #0000FF; color:antiquewhite; width: 375px; height:45px; " name="SD" type="submit" value="Deposit">
				<?php } ?>
			</form>
		<?php } ?>
		<?php } else { 
	header('Location: access_Denied.php');
	exit;
	} ?>
		 
		</div>
    </div>
    <div class="verticalspacer" data-offset-top="0" data-content-above-spacer="1286" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u30788-a.png?crc=286736856" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/arrowmenudown.png?crc=262559161" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u30837-a.png?crc=4233768770" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u30843-a.png?crc=3925028500" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <div class="breakpoint" id="bp_1348" data-min-width="1269" data-max-width="1348"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox temp_no_id" data-orig-id="page"><!-- column -->
    <div class="clearfix colelem temp_no_id" data-orig-id="pu30744"><!-- group -->
     <div class="clip_frame grpelem temp_no_id" data-orig-id="u30744"><!-- image -->
      <img class="block temp_no_id temp_no_img_src" data-orig-src="images/cash-change-coins-banner-crop-u30744.jpg?crc=4139890737" alt="" data-heightwidthratio="0.133276740237691" data-image-width="1178" data-image-height="157" data-orig-id="u30744_img" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_id temp_no_img_src" alt="Dork's Bank" data-orig-src="images/u30746-4.png?crc=3877500381" data-image-width="312" data-orig-id="u30746-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_id temp_no_img_src" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u30747-4.png?crc=4016458241" data-image-width="277" data-orig-id="u30747-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar gradient clearfix grpelem temp_no_id" data-orig-id="menuu30748"><!-- horizontal box -->
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
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30829"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="update_info.php" data-orig-id="u30830"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30832-4"><!-- content --><span class="placeholder" data-placeholder-for="u30832-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30833"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30794"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="update_info.php" data-orig-id="u30795"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30796-4"><!-- content --><span class="placeholder" data-placeholder-for="u30796-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30798"><!-- content --></div></a></li>
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
    <div class="verticalspacer" data-offset-top="0" data-content-above-spacer="1276" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u30788-a.png?crc=286736856" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/arrowmenudown.png?crc=262559161" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u30837-a.png?crc=4233768770" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/u30843-a.png?crc=3925028500" alt="" src="images/blank.gif?crc=4208392903"/>
   </div>
  </div>
  <div class="breakpoint" id="bp_1268" data-min-width="949" data-max-width="1268"><!-- responsive breakpoint node -->
   <div class="clearfix borderbox temp_no_id" data-orig-id="page"><!-- column -->
    <div class="clearfix colelem temp_no_id" data-orig-id="pu30744"><!-- group -->
     <div class="clip_frame grpelem temp_no_id" data-orig-id="u30744"><!-- image -->
      <img class="block temp_no_id temp_no_img_src" data-orig-src="images/cash-change-coins-banner-crop-u30744.jpg?crc=4139890737" alt="" data-heightwidthratio="0.13279132791327913" data-image-width="1107" data-image-height="147" data-orig-id="u30744_img" src="images/blank.gif?crc=4208392903"/>
     </div>
     <img class="grpelem temp_no_id temp_no_img_src" alt="Dork's Bank" data-orig-src="images/u30746-4.png?crc=3877500381" data-image-width="273" data-orig-id="u30746-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <img class="grpelem temp_no_id temp_no_img_src" alt="WE'VE GOT YOUR MONEY." data-orig-src="images/u30747-4.png?crc=4016458241" data-image-width="208" data-orig-id="u30747-4" src="images/blank.gif?crc=4208392903"/><!-- rasterized frame -->
     <nav class="MenuBar gradient clearfix grpelem temp_no_id" data-orig-id="menuu30748"><!-- horizontal box -->
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
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30829"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="update_info.php" data-orig-id="u30830"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30832-4"><!-- content --><span class="placeholder" data-placeholder-for="u30832-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30833"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30794"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="update_info.php" data-orig-id="u30795"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30796-4"><!-- content --><span class="placeholder" data-placeholder-for="u30796-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30798"><!-- content --></div></a></li>
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
    <div class="verticalspacer" data-offset-top="0" data-content-above-spacer="1210" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
   </div>
   <div class="preload_images">
    <img class="preload temp_no_img_src" data-orig-src="images/u30788-a.png?crc=286736856" alt="" src="images/blank.gif?crc=4208392903"/>
    <img class="preload temp_no_img_src" data-orig-src="images/arrowmenudown.png?crc=262559161" alt="" src="images/blank.gif?crc=4208392903"/>
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
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30829"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="update_info.php" data-orig-id="u30830"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30832-4"><!-- content --><span class="placeholder" data-placeholder-for="u30832-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30833"><!-- content --></div></a></li>
         <li class="MenuItemContainer clearfix colelem temp_no_id" data-orig-id="u30794"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem temp_no_id" href="update_info.php" data-orig-id="u30795"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem temp_no_id" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true" data-orig-id="u30796-4"><!-- content --><span class="placeholder" data-placeholder-for="u30796-3_content"><!-- placeholder node --></span></div><div class="grpelem temp_no_id" data-orig-id="u30798"><!-- content --></div></a></li>
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
Muse.Utils.initWidget('.MenuBar', ['#bp_infinity', '#bp_1348', '#bp_1268', '#bp_948'], function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
Muse.Utils.fullPage('#page');/* 100% height page */
$( '.breakpoint' ).registerBreakpoint();/* Register breakpoints */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
}catch(b){if(b&&"function"==typeof b.notify?b.notify():Muse.Assert.fail("Error calling selector function: "+b),false)throw b;}})})};

</script>
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=4157109226" type="text/javascript" async data-main="scripts/museconfig.js?crc=380897831" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
   </body>
</html>
