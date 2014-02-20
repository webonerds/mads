<?php

/**
 * @file       Menu.php$
 * @created    01/10/2013 10:53:49 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Description of Menu
 *
 * @author Rohit Gupta
 */

Yii::import('zii.widgets.CPortlet');

class Menu extends CPortlet
{
	/**
	 * @var Controller
	 */
	public $activeController;
	public $activeControllerActionId;
	
	public function init()
    {
        parent::init();
		
		$this->activeControllerActionId = $this->activeController->getAction()->id;
    }
	
	protected function renderContent()
    {
		$menuArr = include(Yii::app()->basePath . "/config/menu.php");
			
		$this->render('menu', array('menuArr' => $menuArr));
    }
}

?>
