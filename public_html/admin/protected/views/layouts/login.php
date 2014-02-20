<?php /* @var $this Controller */ ?>
<?php

/**
 * @file       login.php$
 * @created    30/09/2013 10:24:40 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>
<!doctype html>
<!--
=================================================================
=================================================================
Powered By:
       __       ___      .__   __.   _______  __       _______ 
      |  |     /   \     |  \ |  |  /  _____||  |     |   ____|
      |  |    /  ^  \    |   \|  | |  |  __  |  |     |  |__   
.==.  |  |   /  /_\  \   |  . `  | |  | |_ | |  |     |   __|  
|  `=='  |  /  _____  \  |  |\   | |  |__| | |  `====.|  |____ 
 \______/  /__/     \__\ |__| \__|  \______| |_______||_______|
=================================================================
=================================================================
-->
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="author" content="IDEORIS Pty Ltd">
	
	
	<!-- Apple iOS and Android stuff -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="img/icon.png">
	<link rel="apple-touch-startup-image" href="img/startup.png">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/template/css/style.css">
	
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/template/css/thankful/theme.css" id="themestyle">
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/template/css/ie.css">
	<![endif]-->
	
	<!-- Use Google CDN for jQuery and jQuery UI -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
	
	<!-- Loading JS Files this way is not recommended! Merge them but keep their order -->
	
	<!-- some basic functions -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/functions.js"></script>
		
	<!-- all Third Party Plugins -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/plugins.js"></script>
		
	<!-- Whitelabel Plugins -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Alert.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Dialog.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Form.js"></script>
		
	<!-- configuration to overwrite settings -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/config.js"></script>
		
	<!-- the script which handles all the access to plugins etc... -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/login.js"></script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
</head>
<body id="login">
	<header>
		<div id="logo">
			<a href="/">Fans Unite</a>
		</div>
	</header>
	<section id="content">
		<?php echo $content; ?>
	</section>
	<footer>Copyright <?php echo Yii::app()->name; ?> <?php echo date('Y'); ?></footer>
</body>
</html>
