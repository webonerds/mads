<?php


//Application Globals
require_once(dirname(__FILE__) . "/globals.php");

$frontend = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR;

Yii::setPathOfAlias('frontend',$frontend);
Yii::setPathOfAlias('appwebroot', $_SERVER['DOCUMENT_ROOT']);

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	
	// preloading 'log' component
	'preload'=>array('log'),
	
	// autoloading model and component classes
	'import'=>array(
		'application.commands.ConsoleCommand',
		'application.models.*',
		'application.components.*',
		'application.components.library.*',
		'application.extensions.mailer.EMailer',
	),
	
	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ads_engine_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'password',
			'charset' => 'utf8',
		),
		
	),
);