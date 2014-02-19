<?php

/**
 * @file       memcache_servers.php$
 * @created    01/02/2014 1:43:16 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

//development

if ($_SERVER["APPLICATION_ENV"] == "DEV")
{
	return array(
            //'class' => 'system.caching.CMemCache',
			'class' => 'system.caching.CDummyCache',
            /*'servers' => array(
                array('host' => '127.0.0.1', 'port' => 11211, 'weight' => 60),
            ),*/
        );
}
//UAT
else if ($_SERVER["APPLICATION_ENV"] == "UAT")
{
	return array(
            'class' => 'system.caching.CMemCache',
            'servers' => array(
                array('host' => '127.0.0.1', 'port' => 11211, 'weight' => 60),
            ),
        );
}

//live
else
{ 
	return array(
            'class' => 'system.caching.CMemCache',
            'servers' => array(
                array('host' => '127.0.0.1', 'port' => 11211, 'weight' => 60),
            ),
        );
		
}