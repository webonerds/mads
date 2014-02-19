<?php
/**
 * @file       mysql.php$
 * @created    30/09/2013 4:49:50 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

//development
if ($_SERVER["APPLICATION_ENV"] == "DEV")
{
	return array(
		'host' => 'localhost'
		, 'user' => 'root'
		, 'password' => 'password'
		, 'name' => 'ads_engine_db'
	);
}
//UAT
else if ($_SERVER["APPLICATION_ENV"] == "UAT")
{
	return array(
		'host' => 'localhost'
		, 'user' => 'ccc'
		, 'password' => 'ccc'
		, 'name' => 'ccc'
	);
}
//live
else
{
	return array(
		'host' => 'mysql8.000webhost.com'
		, 'user' => 'a9443242_ads'
		, 'password' => 'ads!@#$%^'
		, 'name' => 'a9443242_adseng'
	);
}
?>
