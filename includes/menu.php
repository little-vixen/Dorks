<?php
	$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
	/*
	menu.php
	
	Dork's Bank
	
	Handles the top bar menu
	*/
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="top-bar"> <!-- Just for CSS, to have the pages look different -->
	<div class="top-a" style="font-size:200%;border:none;outline:0;padding:4px 0px;vertical-align:middle;overflow:hidden;text-align:center;white-space:nowrap;margin:top;float:left;width:19.88%;user-select:none;">
		<a>Dork's Bank</a>
	</div>
	<div class="top">
		<a href="index2.php" <?php if ($currentPage == 'index2.php') { $_SERVER['pageid'] = 'Home';} ?>>Home</a>
	</div>
	
	<?php
		/*
		No one is currently logged in
		*/
		if((!isset($_SESSION['cid']) && !isset($_SESSION['aid'])) || $currentPage == 'logout.php') { ?>
			<div class="top">
				<a href='create_acct.php'
				<?php if ($currentPage == 'create_acct.php') { echo 'id="Register"';} ?>>Register</a>
			</div>
			<div class="top">
				<a href='admin_login.php'>Employee Login</a>
			</div>
		<div class="top">
			<a href='help.php'
			<?php if ($currentPage == 'about-us.php') { echo 'id="here"';} ?>>Test - About Us</a>
		</div>
		<?php } ?>
		<?php 
		/*
		Customer is currently logged in
		*/
		if(isset($_SESSION['cid']) && !isset($_SESSION['aid']) && $currentPage != 'logout.php'){ ?>
			<div class="top-b">
				<button class="top-button">Account</button>
				<div class = "top-content">
					<a href='account_info.php'>Account Info</a>
					<a href='checking.php'>Checking</a>
					<a href='saving.php'>Saving</a>
					<a href='loan.php'>Loan</a>
				</div>
			</div>
		<?php } ?>
		<?php
		/*
		Admin is currently logged in
		*/
		if((isset($_SESSION['aid']) && !isset($_SESSION['cid'])) && $currentPage != 'logout.php') { ?>
			<div class="top-b">
				<button class="top-button">Customer Service</button>
				<div class = "top-content">
					<a href='withdraw.php'>Withdraw/Deposit</a>
					<!--<a href='transfer.php'>Transfer</a>-->
					<a href='takeout_loan.php'>Takeout Loan</a>
					<a href='update_info.php'>Update Customer Information</a>
					<a href='account_settings.php'>Activate/Deactivate</a>
					<a href='account_setup.php'>Account Setup</a>
					<a href='phone_test.php'>Email All Users</a>
				</div>
			</div>
			<div class="top-b">
				<button class="top-button">Generate Reports</button>
				<div class = "top-content">
					<a href='checking_report.php'>Checking</a>
					<a href='saving_report.php'>Savings</a>
					<a href='loans_report.php'>Loans</a>
					<!--<a href='account_stats.php'>Account Stats</a>-->
					<a href='top_users.php'>Top Customers</a>
				</div>
			</div>
		<?php } ?>
		<?php
		/*
		Log out
		*/
		if((isset($_SESSION['cid']) || isset($_SESSION['aid'])) && $currentPage != 'logout.php'){ ?>
			<div class="top">
				<a href='logout_direct.php' 
				<?php if ($currentPage == 'logout.php') { echo 'id="Logout"';} ?>>Logout</a>
			</div>
		<?php } ?>
</div>