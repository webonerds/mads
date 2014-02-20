<?php

/**
 * @file       log_config.php$
 * @created    12/12/2013 12:18:39 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

//development
if ($_SERVER["APPLICATION_ENV"] == "DEV")
{
	return array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				
				array(
					'class'=>'CProfileLogRoute',
					'report'=>'callstack'
				),
				
				array(
					'class'=>'CWebLogRoute',
					'categories'=>'system.db.CDbCommand'
				),
			),
		);
}
//UAT
else if ($_SERVER["APPLICATION_ENV"] == "UAT")
{
	return array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		);
}
//live
else
{
	return array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		);
}