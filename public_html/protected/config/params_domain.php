<?php
/**
 * @file       params_domain.php$
 * @created    01/02/2014 4:39:41 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

//development
if ($_SERVER["APPLICATION_ENV"] === "DEV")
{
	return array(
			'environment' => 'DEV',
			'facebook_appid' => 'xxxxx',
		);
}
//UAT
else if ($_SERVER["APPLICATION_ENV"] === "UAT")
{
	return array(
			'environment' => 'UAT',
			'facebook_appid' => 'xxxxx',
		);
}
//live
else
{
	return array(
			'environment' => 'PROD',
			'facebook_appid' => 'xxxx',
		);
}