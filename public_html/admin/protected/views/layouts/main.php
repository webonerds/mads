<?php /* @var $this Controller */ ?>
<?php

/**
 * @file       main.php$
 * @created    30/09/2013 6:20:27 PM
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
	<meta property="og:title" content="ShareThis Homepage" />
	<meta property="og:type" content="Sharing Widgets" />
	<meta property="og:url" content="http://sharethis.com" />
	<meta property="og:image" content="http://sharethis.com/images/logo.jpg" />
	<meta property="og:description" content="Sharing is great!" />
	<meta property="og:site_name" content="ShareThis" />

	<meta name="description" content="<?php echo Yii::app()->name; ?> - Administration">
	<meta name="author" content="IDEORIS Pty Ltd">
	
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/template/css/style.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/template/css/colorbox.css">
	
	<!-- Apple iOS and Android stuff -->
	<meta name="apple-mobile-web-app-capable" content="no">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	
	<!-- Apple iOS and Android stuff - don't remove! -->
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<!-- Use Google CDN for jQuery and jQuery UI -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/jquery-1.7.1.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/jquery-ui.1.8.12.min.js"></script>
	
	<title><?php echo $this->pageTitle; ?></title>
	
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/template/css/thankful/theme.css" id="themestyle">
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/template/css/ie.css">
	<![endif]-->
	
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "657c4a8e-b2f1-421b-814c-b8eb972c25da", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
</head>
<body>
	<div id="pageoptions">
		<ul>
			<li><a href="<?php echo Yii::app()->createUrl('login/logout');?>">Logout</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('message/inbox');?>">
					Inbox(<?php echo EmailMessages::model()->count('to_user_id=:user_id AND mark_as_read<>:mark_as_read', 
																array(
																		':user_id' => Yii::app()->user->id, 
																		':mark_as_read' => AppConstants::MARK_AS_READ,
																)); ?>)
				</a>
			</li>
			
		</ul>
		<div>
			<h3>Place for some configs</h3>
			<p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores.</p>
		</div>
	</div>

	<header>
		<div id="logo">
			<a href="<?php echo Yii::app()->baseUrl; ?>">Fans Unite</a>
		</div>
		<div id="header">
			<ul id="headernav">
				<li><ul>
					<li><a href="icons.html">Icons</a><span>300+</span></li>
					<li><a href="#">Submenu</a><span>4</span>
						<ul>
							<li><a href="#">Just</a></li>
							<li><a href="#">another</a></li>
							<li><a href="#">Dropdown</a></li>
							<li><a href="#">Menu</a></li>
						</ul>
					</li>
					<li><a href="login.html">Login</a></li>
					<li><a href="wizard.html">Wizard</a><span>Bonus</span></li>
					<li><a href="#">Errorpage</a><span>new</span>
						<ul>
							<li><a href="error-403.html">403</a></li>
							<li><a href="error-404.html">404</a></li>
							<li><a href="error-405.html">405</a></li>
							<li><a href="error-500.html">500</a></li>
							<li><a href="error-503.html">503</a></li>
						</ul>
					</li>
				</ul></li>
			</ul>
			<div id="searchbox">
				<form id="searchform" autocomplete="off">
					<input type="search" name="query" id="search" placeholder="Search">
				</form>
			</div>
			<ul id="searchboxresult">
			</ul>
		</div>
	</header>

	<nav>
		<?php $this->widget('application.components.Menu', array('activeController' => Yii::app()->getController())); ?>
	</nav>
		
	<section id="content">
		<div class="g12">
			<?php echo $content; ?>
		</div>
	</section><!-- end div #content -->
	<footer>Copyright <?php echo Yii::app()->name; ?> <?php echo date('Y'); ?></footer>
	<!-- Loading JS Files this way is not recommended! Merge them but keep their order -->
	
	<!-- some basic functions -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/functions.js"></script>
		
	<!-- all Third Party Plugins and Whitelabel Plugins -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/plugins.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/editor.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/calendar.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/flot.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/elfinder.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/datatables.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Alert.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Autocomplete.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Breadcrumb.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Calendar.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Chart.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Color.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Date.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Editor.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_File.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Dialog.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Fileexplorer.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Form.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Gallery.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Multiselect.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Number.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Password.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Slider.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Store.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Time.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Valid.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/wl_Widget.js"></script>
	
	<!-- configuration to overwrite settings -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/config.js"></script>
		
	<!-- the script which handles all the access to plugins etc... -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/script.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/jquery.colorbox-min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/custom.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/template/js/handlebars.js"></script>
<?php
$cs = Yii::app()->getClientScript();  	
$cs->scriptMap=array(
	'jquery.js' => false,
	'jquery-ui.min.js' => false,
	'jquery.ui.datepicker-en.js' => false
);
?>
</body>
</html>
