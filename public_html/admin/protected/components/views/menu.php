<?php
/* @var $this Menu */
/* @var $menuArr array */
/**
 * @file       menu.php$
 * @created    01/10/2013 10:55:42 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>
<?php

//Variable to hold the dynamic menu
$menuHTML = "";

//building the menu
foreach ($menuArr as $controllerID => $controllerArr):
	
	//if we have a hidden menu
	if (isset($controllerArr['hidden']) && $controllerArr['hidden'])
		continue;
	
	$controllerLink = '';
	$controllerActive = ($this->activeController->id === $controllerID) ? 'class="active"' : '';
	$subMenu = '';

	//Building the sub navigation if exists
	if (isset($controllerArr['subMenu']) && count($controllerArr['subMenu'])):

		$activeSubMenu = ($this->activeController->id === $controllerID) ? 'style="display: block;"' : '';
	
		//if there is no access for the controller then lets not display the menu
		if (!Yii::app()->user->checkControllerAccess($controllerID, '', false))
			continue;
	
		$subMenu .= '<ul '. $activeSubMenu .'>';

		foreach ($controllerArr['subMenu'] as $actionID => $actionArr):

			$actionLink = (isset($actionArr['link'])) ? $actionArr['link'] : Yii::app()->createUrl("{$controllerID}/{$actionID}");
			$actionActive = ($this->activeController->id === $controllerID && $actionID === $this->activeControllerActionId) ? 'class="active"' : '';
			
			//if there is no access for the controller action then lets not display the sub menu item
			if (!Yii::app()->user->checkControllerAccess($controllerID, $actionID))
				continue;
			
			//If the action is set not to display, then not showing the menu item
			if (isset($actionArr['hidden']) && $actionArr['hidden'])
				continue;
			
			$subMenu .= '<li><a '. $actionActive .' href="'. $actionLink .'"><span>'. $actionArr['displayName'] .'</span></a></li>';

		endforeach;

		$subMenu .= '</ul>';

	else:

		$controllerLink = (isset($controllerArr['link'])) ? 'href="'. $controllerArr['link'] . '"' : $controllerLink;

	endif;

	//building the root menu + submenu
	$menuHTML .= <<<HTML
		<li class="{$controllerArr['iconClassName']}"><a {$controllerActive} {$controllerLink}><span>{$controllerArr['displayName']}</span></a>{$subMenu}</li>
HTML;

endforeach;
?>

		<ul id="nav">
			<?php echo $menuHTML; ?>
			<!--<li class="i_images"><a href="gallery.html"><span>Gallery</span></a></li>
			<li class="i_blocks_images"><a href="widgets.html"><span>Widgets</span></a></li>
			<li class="i_breadcrumb"><a href="breadcrumb.html"><span>Breadcrumb</span></a></li>
			<li class="i_file_cabinet"><a href="fileexplorer.html"><span>Fileexplorer</span></a></li>
			<li class="i_calendar_day"><a href="calendar.html"><span>Calendar</span></a></li>
			<li class="i_speech_bubbles_2"><a href="dialogs_and_buttons.html"><span>Dialogs &amp; Buttons</span></a></li>
			<li class="i_table"><a href="datatable.html"><span>Table</span></a></li>
			<li class="i_typo"><a href="typo.html"><span>Typo</span></a></li>
			<li class="i_grid"><a href="grid.html"><span>Grid</span></a></li>-->
		</ul>