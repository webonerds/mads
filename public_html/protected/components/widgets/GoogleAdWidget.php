<?php

/**
 * @file       GoogleAdWidget.php$
 * @created    27/11/2013 7:55:58 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Description of GoogleAdWidget
 *
 * @author Rohit Gupta
 */
class GoogleAdWidget extends CWidget
{
	/**
	 *
	 * @var int Width of the Ad Banner
	 */
	public $width;
	
	/**
	 *
	 * @var int Height of the Ad Banner
	 */
	public $height;
	
	public $publisherId;
	
	public $adSlotId;

	public function init()
    {
        // this method is called by CController::beginWidget()
		if (!isset($this->width))
		{
			$this->width = 300;
		}
		
		if (!isset($this->height))
		{
			$this->height = 250;
		}
		
		if (!isset($this->publisherId))
		{
			$this->publisherId = Yii::app()->params["googlead"]["publisher"];
		}
		
		if (!isset($this->adSlotId))
		{
			if (isset(Yii::app()->params["googlead"]["adslot_ids"]["{$this->width}_{$this->height}"]))
			{
				$this->adSlotId = Yii::app()->params["googlead"]["adslot_ids"]["{$this->width}_{$this->height}"];
			}
		}
		
		//only show the ads if NOT in dev
		if (Yii::app()->params["domainInfo"]["environment"] != "DEV")
		{
			$script = '(adsbygoogle = window.adsbygoogle || []).push({});';

			/*@var $cs CClientScript */
			$cs=Yii::app()->clientScript;
			$cs->registerScriptFile('//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', CClientScript::POS_END, array('async'=>'async'));
			$cs->registerScript("googleads-js-{$this->width}_{$this->height}", $script, CClientScript::POS_END);
		}
    }
 
    public function run()
    {
		// this method is called by CController::endWidget()
		$this->render('google_ad');
    }
}
