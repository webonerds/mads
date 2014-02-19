<?php

/**
 * @file       TwitterAPI.php$
 * @created    04/11/2013 1:32:16 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Description of TwitterAPI
 *
 * @author Rohit Gupta
 */
class TwitterAPI
{
	private $_consumerKey;
	private $_consumerSecret;
	private $_accessToken;
	private $_accessTokenSecret;
	
	function __construct($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret)
	{
		$this->_consumerKey = $consumerKey;
		$this->_consumerSecret = $consumerSecret;
		$this->_accessToken = $accessToken;
		$this->_accessTokenSecret = $accessTokenSecret;
	}

	public function getMostRecent($screen_name, $count, $retweets)
    {
        //codebird is going to be doing the oauth lifting for us
        require_once(dirname(__FILE__) . '/codebird.php');
     
        //These are your keys/tokens/secrets provided by Twitter
        $CONSUMER_KEY = $this->_consumerKey;
        $CONSUMER_SECRET = $this->_consumerSecret;
        $ACCESS_TOKEN = $this->_accessToken;
        $ACCESS_TOKEN_SECRET = $this->_accessTokenSecret;
     
        //Get authenticated
        \Codebird\Codebird::setConsumerKey($CONSUMER_KEY, $CONSUMER_SECRET);
         
        $cb = \Codebird\Codebird::getInstance();
        $cb->setToken($ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);
         
        //These are our params passed in for our request to twitter
        //The GET request is made by our codebird instance for us further down
        $params = array(
            'screen_name' => $screen_name,
            'count' => $count,
            'include_rts' => $retweets,
			'trim_user' => 1,
			'exclude_replies' => true,
			'contributor_details' => false
        );
         
        //tweets returned by Twitter in JSON object format
        return (array) $cb->statuses_userTimeline($params);
		
        //Let's encode it for our JS/jQuery and return it
        //return json_encode($tweets);
    }
}
