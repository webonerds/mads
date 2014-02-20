<?php
//points to front end.
$frontend = dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'protected';
Yii::setPathOfAlias('frontend',$frontend);
Yii::setPathOfAlias('appwebroot', $_SERVER['DOCUMENT_ROOT']);

//Application Globals
require_once($frontend . "/config/globals.php");

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Thankful',
	
	// preloading 'log' component
	'preload'=>array('log', 'input', 'clientScript'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'frontend.models.*',
		'application.components.*',
		'frontend.components.common.*',
		'frontend.components.library.*',
		'frontend.extensions.mailer.EMailer',
	),
	
	//Enable gzip compression
	//'onBeginRequest'=>create_function('$event', 'return ob_start("ob_gzhandler");'),
	//'onEndRequest'=>create_function('$event', 'return ob_end_flush();'),
	
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
		'session' => array(
			'autoStart'=>true,
			//'cookieParams' => array(/*'path' => '/admin/',*/ 'domain' => '.fansunite.com.au'),
		),
		'uploader' => array(
			'class' => 'frontend.components.library.FileUpload'
		),
		'request'=>array(
			//'enableCsrfValidation'=>true,
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
		
		'db'=>require_once($frontend . "/config/db_config.php"),
		'errorHandler'=>array(
			'errorAction'=>'error/index',
		),
		'log' => require_once($frontend . "/config/log_config.php"),
		'mailer' => array(
			'class' => 'frontend.extensions.mailer.EMailer',
			'pathViews' => 'application.views.email',
			'pathLayouts' => 'frontend.views.layouts.email'
		),
		'mailLogger' => array(
			'class' => 'frontend.components.common.EmailMessageLogger',
		),
		'cache' => require_once($frontend . "/config/caching_config.php"),
		'input' => array(   
            'class'         => 'CmsInput',  
            'cleanPost'     => false,  
            'cleanGet'      => false,   
        ),
		'phpThumb'=>array(
			'class'=>'frontend.extensions.EPhpThumb.EPhpThumb',
		),
	),
	'params' => require_once($frontend . "/config/params.php"),
);
