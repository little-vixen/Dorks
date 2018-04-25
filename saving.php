<?php
	session_start();
	require_once '../pdo_config.php';
	/*
	saving.php
	
	Dork's Bank
	
	Displays a users Saving Accounts and all Savings Transactions
	*/
	function shortTitle ($title){
		$title = substr($title, 0, -4);
		$title = str_replace('_', ' ', $title);
		$title = ucwords($title);
		return $title;
	}
	try {
		/*
		Returns all Saving Accounts
		Input:	- ':cid' : Customer ID
		*/
		$sql = "SELECT * FROM savings WHERE cid = :cid";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':cid', $_SESSION['cid']);
		$stmt->execute();
		$rows = $stmt->fetchAll();
		$balTotal = 0;
		/*
		Returns all Savings Transactions
		Input: - ':cid' : Customer ID
		*/
		$sql2 = "Select * FROM stransaction WHERE cid = :cid";
		$stmt2 = $conn->prepare($sql2);
		$stmt2->bindValue(':cid', $_SESSION['cid']);
		$stmt2->execute();
		$rows2 = $stmt2->fetchAll();
	} catch (PDOException $e) { 
		echo $e->getMessage(); 
		include './includes/footer.php'; 
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
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.watch.js", "require.js", "saving.css"], "outOfDate":[]};
</script>
  
  <title>saving</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="css/master_accountsrouting.css?crc=68373344"/>
  <link rel="stylesheet" type="text/css" href="css/saving.css?crc=231483555" id="pagesheet"/>
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

  </style> 
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
   </head>
 <body>

  <div class="clearfix borderbox" id="page"><!-- column -->
   <div class="clearfix colelem" id="pu23584"><!-- group -->
    <div class="clip_frame grpelem" id="u23584"><!-- image -->
     <img class="block" id="u23584_img" src="images/cash-change-coins-banner-crop-u23584.jpg?crc=63359190" alt="" data-heightwidthratio="0.13333333333333333" data-image-width="1410" data-image-height="188"/>
    </div>
    <img class="grpelem" id="u23574-4" alt="Dork's Bank" src="images/u23574-4.png?crc=4055798349" data-image-width="330"/><!-- rasterized frame -->
    <img class="grpelem" id="u23575-4" alt="WE'VE GOT YOUR MONEY." src="images/u23575-4.png?crc=3987375930" data-image-width="210"/><!-- rasterized frame -->
    <nav class="MenuBar clearfix grpelem" id="menuu23594"><!-- horizontal box -->
     <div class="MenuItemContainer clearfix grpelem" id="u23609"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u23612" href="index.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23614"><!-- state-based BG images --><img alt="Home" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u23615"><!-- content --></div></a>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u23616"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u23617" href="account_info.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23620"><!-- state-based BG images --><img alt="Account" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u23618"><!-- content --></div></a>
      <div class="SubMenu MenuLevel1 clearfix" id="u23621"><!-- vertical box -->
       <ul class="SubMenuView clearfix colelem" id="u23622"><!-- vertical box -->
        <li class="MenuItemContainer clearfix colelem" id="u26301"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26303" href="checking.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26307-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26307-3"><p>Checking</p></div></div><div class="grpelem" id="u26309"><!-- content --></div></a></li>
        <li class="MenuItemContainer clearfix colelem" id="u26322"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix grpelem" id="u26323" href="saving.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26324-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26324-3"><p>Savings</p></div></div><div class="grpelem" id="u26325"><!-- content --></div></a></li>
        <li class="MenuItemContainer clearfix colelem" id="u26343"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26344" href="loan.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26346-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26346-3"><p>Loan</p></div></div><div class="grpelem" id="u26345"><!-- content --></div></a></li>
       </ul>
      </div>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u23602"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u23605" href="routing-info.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23608"><!-- state-based BG images --><img alt="Manage" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u23607"><!-- content --></div></a>
      <div class="SubMenu MenuLevel1 clearfix" id="u23603"><!-- vertical box -->
       <ul class="SubMenuView clearfix colelem" id="u23604"><!-- vertical box -->
        <li class="MenuItemContainer clearfix colelem" id="u26259"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u26261" href="withdraw.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u26265-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u26265-3"><p>Withdraw</p></div></div><div class="grpelem" id="u26267"><!-- content --></div></a></li>
       </ul>
      </div>
     </div>
     <div class="MenuItemContainer clearfix grpelem" id="u23595"><!-- vertical box -->
      <a class="nonblock nontext MenuItem MenuItemWithSubMenu borderbox transition clearfix colelem" id="u23598" href="logout.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap grpelem" id="u23600"><!-- state-based BG images --><img alt="Logout" src="images/blank.gif?crc=4208392903"/><div class="fluid_height_spacer"></div></div><div class="grpelem" id="u23601"><!-- content --></div></a>
     </div>
    </nav>
   </div>
   <div class="clearfix colelem" id="u23571"><!-- column -->
    <div class="colelem" id="u23681"><!-- simple frame -->
	   <center>
		<!--SAVINGS ACCOUNTS-->
	<table class="table" style="position:center;">
		<tr class="row-header">
			<td class="cell" colspan="1" style="text-align:left;">Saving ID</td>
			<td class="cell" colspan="1" style="text-align:left;">Balance</td>
			<td class="cell" colspan="1" style="text-align:left;">Minimum Allowed</td>
			<td class="cell" colspan="1" style="text-align:left;">API</td>
		</tr>
		<?php foreach ($rows as $row) { ?>
		<tr>
			<td class="cell-r"><?php echo $row['saveid']; ?></td>
			<td class="cell-r"><?php echo $row['bal']; ?></td>
			<?php $balTotal = $balTotal + $row['bal']; ?>
			<td class="cell-r"><?php echo $row['minBal']; ?></td>
			<td class="cell-r"><?php echo $row['api']; ?></td>
		</tr>
		<?php } ?>
	</table></center></div>
    </div>
    <div class="colelem" id="u23572"><!-- simple frame -->
	  <center>
		<!--SAVINGS TRANSACTIONS-->
	<table class="table" style="position:center;">
        <tr class="row-header">
			<td class="cell" colspan="4" style="text-align:left;">Detailed Transactions</td>
        </tr>
		<tr class="row-header">
			<td class="cell" colspan="1" style="text-align:left;">Transaction ID</td>
			<td class="cell" colspan="1" style="text-align:left;">Transaction Date</td>
			<td class="cell" colspan="1" style="text-align:left;">Amount</td>
			<td class="cell" colspan="1" style="text-align:left;">Saving ID</td>
		</tr>
        <?php foreach ($rows2 as $row2) { ?>
		<tr>
			<td class="cell-r"><?php echo $row2['tid']; ?></td>
			<td class="cell-r"><?php echo $row2['transdate']; ?></td>
			<td class="cell-r"><?php echo $row2['amount']; ?></td>
			<td class="cell-r"><?php echo $row2['saveid']; ?></td>
		</tr>
		<?php } ?>
    </table>
	  </center>
    </div>
 </div>
   <div class="verticalspacer" data-offset-top="0" data-content-above-spacer="1250" data-content-below-spacer="0" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
  </div>
  <div class="preload_images">
   <img class="preload" src="images/u23614-a.png?crc=509849107" alt=""/>
   <img class="preload" src="images/u23620-a.png?crc=4158838947" alt=""/>
   <img class="preload" src="images/u23608-a.png?crc=4163806182" alt=""/>
   <img class="preload" src="images/u23600-a.png?crc=92929534" alt=""/>
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
<?php include './includes/footer.php'; ?>
