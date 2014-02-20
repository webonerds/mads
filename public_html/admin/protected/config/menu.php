<?php

/**
 * @file       menu.php$
 * @created    01/02/2014 11:32:23 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

return array(
		
		'site' => array(
							'displayName' => 'Dashboard',
							'iconClassName' => 'i_house',
							'link' => Yii::app()->createUrl("site/index"),
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary'
																),
												)
						),
	
		'categories' => array(
							'displayName' => 'Categories Manager',
							'iconClassName' => 'i_list',
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary',
																),
								
												'create' => array(
																	'displayName' => 'Create Category',
																),
												'toggleapproved' => array(
																	'hidden' => true,
																),
											
												),
							'roles' => array('admin')
						),
	
	
		'post' => array(
							'displayName' => 'Post Manager',
							'iconClassName' => 'i_user_comment',
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary',
																),
												'abused' => array(
																	'displayName' => 'Abused Post Summary'
																),
												'create&type=story' => array(
																	'displayName' => 'Create Story Post',
																),
												'create&type=picture' => array(
																	'displayName' => 'Create Picture Post',
																),
												'actionToggleActive'=>array(
																	'hidden'=>true,
																),

												'toggleapproved' => array(
																	'hidden' => true,
																),
												'sendApprovedEmail' => array(
																	'hidden' => true,
																),
												'comments' => array(
																	'hidden' => true,
																),
												'toggleCommentApproved' => array(
																	'hidden' => true,
																),
												),
							'roles' => array('admin')
						),
	
		'page' => array(
							'displayName' => 'Page Manager',
							'iconClassName' => 'i_documents',
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary'
																),
												'create' => array(
																	'displayName' => 'Create Page',
																),
												'update' => array(
																	'hidden' => TRUE
																),
												),
							'roles' => array('admin')
						),
		'orders' => array(
							'displayName' => 'Order Manager',
							'iconClassName' => 'i_shopping_cart',
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary'
																),
												'printorders' => array(
																	'displayName' => 'Print Orders'
																),
												'update' => array(
																	'hidden' => TRUE
																),
												),
			
							'roles' => array('admin')
						),					
		
						
		'product' => array(
							'displayName' => 'Product Manager',
							'iconClassName' => 'i_shopping_bag',
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary'
																),
												
												'deleted' => array(
																	'displayName' => 'Deleted Summary'
																),				
												'create' => array(
																	'displayName' => 'Create Product',
																),
												'update' => array(
																	'hidden' => TRUE
																),
												'deletemarked' => array(
																	'hidden' => TRUE
																),				
												),
							'roles' => array('admin')
						),				
		'user' => array(
							'displayName' => 'User Manager',
							'iconClassName' => 'i_users',
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary',
																),
												'create' => array(
																	'displayName' => 'Create User',
																),
												'sendMessage' => array(
																	'hidden' => TRUE,
																),
												'exportMembers' => array(
																	'displayName' => 'Export Members',
																),
												),
							'roles' => array('admin')
						),
	
		'news' => array(
							'displayName' => 'News Manager',
							'iconClassName' => 'i_rss',
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary',
																),
												'create' => array(
																	'displayName' => 'Create News',
																)
												),
							'roles' => array('admin')
						),

		'faqs' => array(
							'displayName' => 'Faqs Manager',
							'iconClassName' => 'i_question',
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary',
																),
												'create' => array(
																	'displayName' => 'Create Faq',
																)
												),
							'roles' => array('admin')
						),

		'report' => array(
							'displayName' => 'Report Manager',
							'iconClassName' => 'i_chart_8',
							'subMenu' => array (
												'posts' => array(
																	'displayName' => 'User Posts Report',
																),
												'users' => array(
																	'displayName' => 'Users Report',
																),
												'Products' => array(
																	'displayName' => 'Products Report',
																
												)					
												),
												
							'roles' => array('admin')
						),
		'activities' => array(
							'displayName' => 'User Activities Manager',
							'iconClassName' => 'i_timer',
							'subMenu' => array (
												'index' => array(
																	'displayName' => 'Summary',
																),
												'abused' => array(
																	'displayName' => 'Abused Summary',
																),
												),
							'roles' => array('admin')
						),
		'login' => array(
							'displayName' => 'Logout',
							'iconClassName' => 'i_finish_flag',
							'link' => Yii::app()->createUrl("login/logout")
						),
	);