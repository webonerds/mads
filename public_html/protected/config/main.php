<?php

$frontend = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR;




Yii::setPathOfAlias('frontend',$frontend);
Yii::setPathOfAlias('appwebroot', $frontend);



require_once($frontend . "/config/globals.php");

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log', 'input', 'assetManager', 'widgetFactory', 'clientScript'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.FormModels.*',
		'application.components.*',
		'application.components.common.*',
		'application.components.library.*',


	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		 'Map' => array(
        ),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl' => array('login/index'),
			'class' => 'WebUser',
			//'identityCookie' => array('domain' => '.thankful.com.au', 'path' => '/'/*, 'name' => 'PHPSESSID_ADMIN'*/),
			'stateKeyPrefix' => 'userstate'
		),
		'uploader' => array(
			'class' => 'application.components.library.FileUpload'
		),
			'cache' => require_once($frontend . "/config/caching_config.php"),
		'input'=>array(   
            'class'         => 'CmsInput',  
            'cleanPost'     => false,  
            'cleanGet'      => false,   
        ),
		
		'uploader' => array(
			'class' => 'frontend.components.library.FileUpload'
		),
		'phpThumb'=>array(
			'class'=>'frontend.extensions.EPhpThumb.EPhpThumb',
		),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db(1)',
		),
		// uncmment the following to use a MySQL database
	//	'db' => require_once($frontend . "/config/db_config.php"),
		
		
		'db'=>array(
			'connectionString' => 'mysql:host=mysql8.000webhost.com;dbname=ads_engine_db',
			'emulatePrepare' => true,
			'username' => 'a9443242_ads',
			'password' => 'ads!@#$%^',
			'charset' => 'utf8',
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ads_engine_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'password',
			'charset' => 'utf8',
		),
		
		
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'dateformat'=>'yy-mm-dd'
	),
);