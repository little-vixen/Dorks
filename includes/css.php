<?php header("Content-type: text/css");?>

body {
	margin:0;
	font-family:Verdana,sans-serif;
	font-size:15px;
	line-height:1.5;
	padding: 0;
	text-align: center;
}

/* All margins are removed from h1 and h2 tags, except for the bottom margin, which is set to 10px.
 * The main font-family is reset to Verdana, which looks better for titles, and the color is reset to a dark blue.
 */

h1, h2, h3, h4 {
    margin: 0 0 10px 0;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    color: #36486b;
	text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff,-1px 1px 0 #fff,1px 1px 0 #fff;
}

h2 {
    font-size: 140%;
	text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff,-1px 1px 0 #fff,1px 1px 0 #fff;
}

h4 {
	font-size: 80%;
	color: #000000;
	text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff,-1px 1px 0 #fff,1px 1px 0 #fff;
}

p {
    margin: 0 auto 1em 0;
    padding: 0 20px;
    font-size: 85%;
    line-height: 1.4;
}

header {
    position: absolute;
    top: -100px;
}

#wrapper {
	//padding:90px 200px 45px;
	padding: 20px 0px 0px;
	background: #00545B;
	background-image: url(../images/cash-change-coins-106152.jpg);
	background-position: calc(0% + 70px) 0px;
	background-repeat: no-repeat;
	background-attachment:fixed;
	margin:0 auto;
	position:relative;
	//border-left: 1px solid #A4C8D8;
	//border-right: 1px solid #A4C8D8;
}

/* Top-bar and top divs for the top menu bar */

.top-bar {
	position:fixed;
	width:100%;
	top:0;
	display:table;
	clear:both;
	padding:8px 16px!important;
	color:#000!important;
	//background-color:#2196F3!important;
	background-color:rgba(127,127,127,0.5);
}

/* Cart tab when there cart is not empty */

.cart-bar {
	//background-color:#ff0000!important;
	background: linear-gradient(red,white);
	border-radius: 25px;
}

.top {
	border:none;
	outline:0;
	padding:8px 16px;
	vertical-align:middle;
	overflow:hidden;
	text-align:center;
	cursor:pointer;
	white-space:nowrap
	margin:top;
	float:left;
	width:15.33%;
	background-color:rgba(127,127,127,0.0);//#2196F3;
	color:#00224C;
	user-select:none
}

.top:hover {
	color:#000!important;
	background-color:#ccc!important;
}

.top a {
	color:#fff;
	text-decoration:none;
    font-family:Arial;
    display: block;
	padding:8px 16px;
	
}

/* Drop down button for Administrator bar */

.top-button {
	background-color:rgba(127,127,127,0.0);//#2196F3;
	padding:8px 16px;
	vertical-align:middle;
	overflow:hidden;
	text-align:center;
    color: white;
    border: none;
    cursor: pointer;
}

.top-a {
	position: relative;
	display: inline-block;
	//float:right;
}

.top-b {
	border:none;
	outline:0;
	padding:8px 16px;
	vertical-align:middle;
	overflow:hidden;
	text-align:center;
	cursor:pointer;
	white-space:nowrap
	margin:top;
	float:left;
	width:15.33%;
	background-color:rgba(127,127,127,0.0);//#2196F3;
	color:#00224C;
	user-select:none
	display: inline-block;
}

.top-content {
	position: absolute;
	display:none;
	background-color: #f9f9f9;
	min-width: 200px;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.top-content a {
    color: black;
    padding: 5px 0px;
    text-decoration: none;
    display: block;
}

.top-content b {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.top-content a:hover {
	color:#000!important;
	background-color:#ccc!important;
}

.top-a:hover .top-content {
	display: block;
}

.top-a:hover .top-button {
	background-color: #2196F3;
}

.top-b:hover .top-content {
	display: block;
}

.top-b:hover .top-button {
	background-color:rgba(127,127,127,0.0);//#2196F3;
}

input[type=button], input[type=submit] {
	font-weight: bold;
	background-color: #2196F3;
    border: none;
	float: left;
    color: white;
    padding: 2px 4px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
	transition: all 0.3s ease 0s;
}

input[type=button]:hover, input[type=submit]:hover {
	opacity:0.75;
}

.table {
	margin: 100px 0 40px 0;
	width: 140%;
	box-shadow: 0 1px 3px rgba(0,0,0,1.0);
	display:table;
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

#manage_role {
	text-align:left;
}

#heading {
	margin-top: 60px;
}

/* The here ID identifies the current page and applies a white stripe to the left as a visual indicator. */

a#here {
    border-left-color: #618685 !important;
    background-color: transparent !important;
    color: #000 !important;
}

/* The maincontent div has zero top and bottom margins. The right margin is 10% of page width to give breathing space on the right.*/

main {
    margin: 0 10% 0 390px;
	//margin-left: 350px;
    min-width: 525px;
    max-width: 640px;
	min-height: 600px;
}

/* Styles for links in the maincontent div. */

main a {
    font-weight: bold;
    text-decoration: none;
    padding: 2px 4px;
}

main a:link, main a:visited {
    background-color: #2196F3;
    border: none;
    color: white;
    //padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
	transition: all 0.3s ease 0s;
}

main a:hover, main a:active {
	opacity:0.75;
}

/* The figure is for the random image on the front page. It floats to the right with a 20px right margin and a 10px left one. */

figure {
    float: right;
    margin: 0 20px 0 10px;
}



/* The footer needs to appear below anything that is floated, so clear: both is added to the rule. */

footer {
	clear:both;
	position:absolute;
	width:100%;
	color: #FFF;
	background-color: #A4C8D8;
}

footer p {
	margin-bottom:0;
	font-size: 130%;
	float:left;
}

/* Styles for the contact form. */

form {
    margin: 0 100px 0 0px;
}

form label {
	text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff,-1px 1px 0 #fff,1px 1px 0 #fff;
}

form h1,h2,h3,h4 {
	text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff,-1px 1px 0 #fff,1px 1px 0 #fff;
}

form h2 {
    color: #036;
    font-size: 80%;
    font-weight: bold;
    margin: 0 0 5px 10px;
}

form p {
    margin: 0 0 5px 0;
	text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff,-1px 1px 0 #fff,1px 1px 0 #fff;
}

input[type="text"], input[type="email"], input[type="password"]{
    width: 250px;
	float: left;
	text-shadow: -1px -1px 0 #fff,1px -1px 0 #fff,-1px 1px 0 #fff,1px 1px 0 #fff;
}

label {
    font-weight: bold;
    color: #036;
    display: block;
	float: left;
}

fieldset#submit {
	border: none;
}

/* The warning class makes the error messages on the feedback form bold and red. */

.warning {
    font-weight: bold;
    color: #f00;
}


