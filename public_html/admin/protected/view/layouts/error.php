<?php /* @var $this Controller */ ?>
<?php

/**
 * @file       error.php$
 * @created    04/10/2013 6:34:27 PM
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
	<link rel="stylesheet" href="css/ie.css">
	<![endif]-->
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
</head>
<body id="error">
	<header>
		<div id="logo">
			<a href="/">Fans Unite</a>
		</div>
	</header>
	<section id="content">
		<?php
		echo $content;
		?>
		<a class="btn small" href="<?php echo Yii::app()->baseUrl; ?>">&lsaquo; Back to Dashboard</a>
	</section>
	<footer>Copyright <?php echo Yii::app()->name; ?> <?php echo date('Y'); ?></footer>		
</body>
</html>
