<?php

/**
 * @file       db_config.php$
 * @created    12/12/2013 12:24:38 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

//MySQL Specific configuration
$mysqlConfig = require_once(dirname(__FILE__) . "/mysql.php");

//development
if ($_SERVER["APPLICATION_ENV"] == "DEV")
{
	return array(
			'class'=>'frontend.extensions.dbsplit.DbConnectionMan',
			'connectionString' => 'mysql:host='. $mysqlConfig['host'] .';dbname=' . $mysqlConfig['name'],
			'schemaCachingDuration' => 3600,
			'enableProfiling' => true,
			'enableParamLogging' => true,
			'emulatePrepare' => true,
			'username' => $mysqlConfig['user'],
			'password' => $mysqlConfig['password'],
			'charset' => 'utf8',
		);
}
//UAT
else if ($_SERVER["APPLICATION_ENV"] == "UAT")
{
	return array(
			'class'=>'frontend.extensions.dbsplit.DbConnectionMan',
			'connectionString' => 'mysql:host='. $mysqlConfig['host'] .';dbname=' . $mysqlConfig['name'],
			'schemaCachingDuration' => 3600,
			'enableProfiling' => false,
			'emulatePrepare' => true,
			'username' => $mysqlConfig['user'],
			'password' => $mysqlConfig['password'],
			'charset' => 'utf8',
			/*'enableSlave'=>true,
				'slaves'=>array(
					array(
						'connectionString'=>'mysql:host='. $mysqlConfig['host'] .';dbname=fansunite_copy',
						'username'=>$mysqlConfig['user'],
						'password'=>$mysqlConfig['password'],
					)
				),	*/		
		);
}
//live
else
{


	return array(
			'class'=>'frontend.extensions.dbsplit.DbConnectionMan',
			//'connectionString' => 'mysql:host='. $mysqlConfig['host'] .';dbname=' . $mysqlConfig['name'],
			'schemaCachingDuration' => 3600,
			'enableProfiling' => true,
			'emulatePrepare' => true,
			'username' => $mysqlConfig['user'],
			'password' => $mysqlConfig['password'],
			'charset' => 'utf8',
			/*'enableSlave'=>true,
				'slaves'=>array(
					array(
						'connectionString'=>'mysql:host='. $mysqlConfig['host'] .';dbname=fansunite_copy',
						'username'=>$mysqlConfig['user'],
						'password'=>$mysqlConfig['password'],
					)
				),	*/		
		);
}

