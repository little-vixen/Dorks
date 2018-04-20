<?php
//added to allow db Connections unless you //are Connor

if(isset($_POST['submit'])){
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
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "webpro.js", "jquery.watch.js", "require.js", "index.css"], "outOfDate":[]};
</script>
  
  <title>We Like Your Money As Much As You Do</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="css/index.css?crc=4100718796" id="pagesheet"/>
   </head>
 <body>

  <!--HTML Widget code-->
  
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

  
  <div class="clearfix borderbox" id="page"><!-- group -->
   <div class="clip_frame grpelem" id="u1120"><!-- image -->
    <img class="block" id="u1120_img" src="images/cash-change-coins-106152.jpg?crc=3877446195" alt="" data-heightwidthratio="0.6666666666666666" data-image-width="1230" data-image-height="820"/>
   </div>
   <div class="rgba-background clearfix grpelem" id="u1210"><!-- group -->
    <img class="grpelem" id="u199-4" alt="Dork's Bank" src="images/u199-4.png?crc=4150129515" data-image-width="458"/><!-- rasterized frame -->
    <div class="clearfix grpelem" id="u22286-3" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content -->
     <p>&nbsp;</p>
    </div>
   </div>
   <div class="rgba-background clearfix grpelem" id="u1074"><!-- column -->
    <div class="colelem" id="u1071"><!-- simple frame --></div>
    <div class="clearfix colelem" id="pu1077-6"><!-- group -->
     <img class="grpelem" id="u1077-6" alt="&nbsp;Banking For Dorks." src="images/u1077-6.png?crc=4263567247" data-image-width="560"/><!-- rasterized frame -->
     <form class="form-grp clearfix grpelem" id="widgetu22518" method="post" enctype="multipart/form-data" action="accounts.php"><!-- none box -->
      <div class="position_content" id="widgetu22518_position_content">
       <div class="fld-grp clearfix colelem" id="widgetu22519" data-required="true"><!-- none box -->
        <label class="fld-label colelem" id="accountName" for="widgetu22519_input"><!-- state-based BG images --><img alt="Account:" src="images/blank.gif?crc=4208392903" style="display:block"/><div class="fluid_height_spacer"></div></label>
        <span class="fld-input NoWrap actAsDiv clearfix colelem" id="u22522-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u22522-3"><input class="wrapped-input" type="text" spellcheck="false" id="widgetu22519_input" name="custom_U22519" tabindex="1"/><label class="wrapped-input fld-prompt" id="widgetu22519_prompt" for="widgetu22519_input"><span class="actAsPara">Your Name</span></label></div></span>
       </div>
       <div class="fld-grp clearfix colelem" id="widgetu22523" data-required="true" data-type="password"><!-- none box -->
        <label class="fld-label colelem" id="password" for="widgetu22523_input"><!-- state-based BG images --><img alt="Password:" src="images/blank.gif?crc=4208392903" style="display:block"/><div class="fluid_height_spacer"></div></label>
        <span class="fld-input NoWrap actAsDiv clearfix colelem" id="u22525-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content --><div id="u22525-3"><input class="wrapped-input" type="password" spellcheck="false" id="widgetu22523_input" name="password" tabindex="2"/><label class="wrapped-input fld-prompt" id="widgetu22523_prompt" for="widgetu22523_input"><span class="actAsPara">Password</span></label></div></span>
       </div>
       <div class="clearfix colelem" id="pu22529-4"><!-- group -->
        <div class="clearfix grpelem" id="u22529-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content -->
         <p>Probing your assets...</p>
        </div>
        <div class="clearfix grpelem" id="u22530-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content -->
         <p>The banking gods hate you(connor).</p>
        </div>
        <div class="clearfix grpelem" id="u22527-4" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true"><!-- content -->
         <p>Ok, fine.</p>
        </div>
        <button class="submit-btn NoWrap grpelem" id="u22528" type="submit" value="Submit" tabindex="3"><!-- state-based BG images -->
         <img alt="Login" src="images/blank.gif?crc=4208392903"/>
         <div class="fluid_height_spacer"></div>
        </button>
       </div>
      </div>
     </form>
     <div class="clip_frame grpelem" id="u1583"><!-- image -->
      <img class="block" id="u1583_img" src="images/nerdmoney.jpg?crc=81157550" alt="" data-heightwidthratio="0.6657458563535912" data-image-width="362" data-image-height="241"/>
     </div>
     <img class="grpelem" id="u1630-4" alt="We've got your money." src="images/u1630-4.png?crc=3992780049" data-image-width="427"/><!-- rasterized frame -->
    </div>
   </div>
   <div class="size_fixed grpelem" id="u3434" data-sizePolicy="fixed" data-pintopage="page_fluidx"><!-- custom html -->
    
<div class="fb-like" data-href="http://DorksBank.php/index.php" data-send="true" data-width="344" data-show-faces="false" data-colorscheme="dark" data-layout="button_count" data-action="like"></div>

   </div>
   <div class="size_fixed grpelem" id="u3444" data-sizePolicy="fixed" data-pintopage="page_fluidx"><!-- custom html -->
    
<a href="https://twitter.com/littlevixen" class="twitter-follow-button" data-lang="en" data-show-screen-name="false" data-size="medium"></a>

   </div>
   <div class="verticalspacer" data-offset-top="820" data-content-above-spacer="819" data-content-below-spacer="61" data-sizePolicy="fixed" data-pintopage="page_fixedLeft"></div>
  </div>
  <div class="preload_images">
   <img class="preload" src="images/accountName-ferr.png?crc=3766513617" alt=""/>
   <img class="preload" src="images/password-ferr.png?crc=3873853122" alt=""/>
   <img class="preload" src="images/u22528-r.png?crc=3857150756" alt=""/>
  </div>
  <!-- JS includes -->
  <script type="text/javascript">
   if (document.location.protocol != 'https:') document.write('\x3Cscript src="http://musecdn.businesscatalyst.com/scripts/4.0/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script type="text/javascript">
   window.jQuery || document.write('\x3Cscript src="scripts/jquery-1.8.3.min.js?crc=209076791" type="text/javascript">\x3C/script>');
</script>
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
var muse_init=function(){require.config({baseUrl:""});require(["jquery","museutils","whatinput","webpro","jquery.watch"],function(d){var $ = d;$(document).ready(function(){try{
window.Muse.assets.check($);/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.makeButtonsVisibleAfterSettingMinWidth();/* body */
Muse.Utils.initWidget('#widgetu22518', ['#bp_infinity'], function(elem) { return new WebPro.Widget.Form(elem, {validationEvent:'submit',errorStateSensitivity:'high',fieldWrapperClass:'fld-grp',formSubmittedClass:'frm-sub-st',formErrorClass:'frm-subm-err-st',formDeliveredClass:'frm-subm-ok-st',notEmptyClass:'non-empty-st',focusClass:'focus-st',invalidClass:'fld-err-st',requiredClass:'fld-err-st',ajaxSubmit:true}); });/* #widgetu22518 */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.showWidgetsWhenReady();/* body */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
}catch(b){if(b&&"function"==typeof b.notify?b.notify():Muse.Assert.fail("Error calling selector function: "+b),false)throw b;}})})};

</script>
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=4157109226" type="text/javascript" async data-main="scripts/museconfig.js?crc=380897831" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
  
  <!--HTML Widget code-->
  
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

   </body>
</html>
