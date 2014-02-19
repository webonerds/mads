<?php

/**
 * @file       ControllerHelper.php$
 * @created    28/10/2013 1:40:59 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

class ControllerHelper extends CComponent
{
	public static function OutputJSON($arr)
	{
		header('Content-type: application/json');
		
		echo CJSON::encode($arr);
		Yii::app()->end();
	}
	
	public static function disableRoutes()
	{
		foreach (Yii::app()->log->routes as $route)
        {
			if ($route instanceof CWebLogRoute)
			{
				$route->enabled = false;
			}
        }
	}
}