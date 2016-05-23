<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Simple Passage
Description: A three-column, fixed-width blog design.
Version    : 1.0
Released   : 20090327
-->
<?php
require_once('include/settings.php');
require_once('include/l18n/'.$lang.'.php');
require_once('selector.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>SELECTOR free MeetMe frontend</title>
    <meta name="SELECTOR" content="" />
    <link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="css/black-tie/jquery-ui-1.8.11.custom.css" type="text/css" rel="stylesheet"/>
    <link href="include/uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="include/functions/js/jquery-1.5.1.min.js">
    </script>
    <script type="text/javascript" src="include/functions/js/jquery.timers.js">
    </script>
    <script type="text/javascript" src="include/functions/js/jquery-ui-1.8.11.custom.min.js">
    </script>
    <script type="text/javascript" src="/include/uploadify/jquery.uploadify.v2.1.4.min.js">
    </script>
    <script type="text/javascript" src="/include/uploadify/swfobject.js">
    </script>
    <?php 
    echo '<script type="text/javascript" src="include/functions/js/jquery.ui.datepicker-'.
    $lang.'.js">'; ?>
    </script>
    <script type="text/javascript" src="include/functions/js/crypto.js">
    </script>
    <script type="text/javascript" src="include/functions/js/selector.js">
    </script>
</head>
<body>
<!-- start header -->
<div id="header">
    <div id="logo">
    	<h1>SELECTOR</h1>
	<p> Хмельницкобленерго</p>
    </div>	
    </div>
	
<!-- end header -->
<div id="wrapper">
	<!-- start page -->
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
	<div id="sidebar1" class="sidebar">
	    <ul>
		<li>
		    <h2><?php echo $l18n['menu'] ?></h2>
		    <ul>
			<li><b><?php echo $l18n['confer'];?></b></li>
			    <li>&nbsp&nbsp&nbsp&nbsp <a href="./index.php">СЕЛЕКТОР</a></li>
			    <li>&nbsp&nbsp&nbsp&nbsp <a id="addconf" href="#"><?php echo $l18n['addnewc'];?></a></li>
			    <li>&nbsp&nbsp&nbsp&nbsp <a id="conferences" href="#"><?php echo $l18n['listconf'];?></a></li>
			<li><b><?php echo $l18n['abongrp'];?></b><br>
			    <li>&nbsp&nbsp&nbsp&nbsp <a id="addgroup" href="#"><?php echo $l18n['addnewg'];?></a></li>
			    <li>&nbsp&nbsp&nbsp&nbsp <a id="groups" href="#"><?php echo $l18n['listgrp'];?></a></li>
	<!--		<li><a id="massdial" href="#">MassDial</a> -->
			<li><a id="records" href="#"><?php echo $l18n['records'];?></a></li>
			<li><a id="settings" href="#"><?php echo $l18n['settings'];?></a></li>
			<li><a id="exit" href="#"><?php echo $l18n['exit'];?></a></li>
		    </ul>
		</li>				
	    </ul>
	</div>
	<input type="hidden" id="md_grp" value=""/>
	<!-- start content -->
	<div id="content">
	    
	</div>
	<!-- end content -->
	<!-- start sidebars -->


	<!-- end sidebars -->
	<div style="clear: both;">&nbsp;</div>
        </div>
	</div>
	</div>
	<!-- end page -->
</div>
<div id="footer">
	<p class="copyright">&copy;&nbsp;&nbsp;2012 frontend by Vitaliy Melnik. All Rights Reserved.</p>
</div>
</body>
</html>
