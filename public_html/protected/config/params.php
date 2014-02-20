<?php

/**
 * @file       params.php$
 * @created    12/10/2013 5:35:31 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

return array(
		'email'	=> require_once(dirname(__FILE__) . '/params_email.php'),
		'baseHttpPath' => ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'],
		'domainInfo' => require_once(dirname(__FILE__) . '/params_domain.php'),
		'documentRoot' => $_SERVER['DOCUMENT_ROOT'],
		'pager' => array('size' => 20),
		'googlead' =>  array('publisher' => 'ca-pub-6138138034123139'
							, 'adslot_ids' => array(
									'300_250' => '4722449357'
									, '300_600' => '1489781352'
									, '728_90' => '8594245757'
								)
							),
		'seo' => array('meta_title' => 'Thankful'
				, 'meta_keywords' => 'Thankful'
				, 'meta_description' => 'Thankful'
				, 'google_analytics_id' => 'UA-46049304-1'
				, 'default_facebook_url' => 'http://www.facebook.com/thankful'
				, 'default_twitter_url' => 'http://www.twitter.com/thankful'
				),
	);
?>
