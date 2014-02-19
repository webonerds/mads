<?php

/**
 * @file       ReportController.php$
 * @created    07/10/2013 12:13:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

class ReportController extends Controller
{
	/**
	 * Function to show posts report
	 */

	public function actionPosts($model='user_posts')
	{	
		if (isset($_POST['interval']))
		{
			$interval= $_POST['interval'];
			
		}else
		{
			$interval= 'WEEK';
		}
		$postStatsArr= Reports::getPiaChartData($model,$interval);
		$chartData= Reports::getChartData('user_posts');
		//Renders the view
		$this->render('posts', array('postStatsArr' => $postStatsArr,'chartData'=>$chartData,'interval'=>$interval));
	}
	
	
	public function actionUsers($model='users')
	{	
		if (isset($_POST['interval']))
		{
			$interval= $_POST['interval'];
			
		}else
		{
			$interval= 'WEEK';
		}
		$postStatsArr= Reports::getPiaChartData($model,$interval);
		$chartData= Reports::getChartData($model);
		//Renders the view
		$this->render('users', array('postStatsArr' => $postStatsArr,'chartData'=>$chartData,'interval'=>$interval));
	}
	
	
	public function actionProducts($model='products')
	{	
		if (isset($_POST['interval']))
		{
			$interval= $_POST['interval'];
			
		}else
		{
			$interval= 'WEEK';
		}
		$postStatsArr= Reports::getPiaChartData($model,$interval);
		$chartData= Reports::getChartData($model);
		//Renders the view
		$this->render('products', array('postStatsArr' => $postStatsArr,'chartData'=>$chartData,'interval'=>$interval));
	}
	
	
	/**
	 * Function to show posts by users report
	 */
	public function actionPostsByUsers()
	{
		//Gets post stats data
		$monthInterval = AppConstants::REPORT_MONTH_LIMIT - 1;
		
		$query = "SELECT DATE_FORMAT(created_on, '%b %Y') month, created_by,
							 SUM(IF(approved = 1, 1, 0)) approved, 
							 SUM(IF(approved = 0, 1, 0)) unapproved FROM posts
							 WHERE created_on >= (SELECT DATE_FORMAT(DATE_SUB(CURDATE(),INTERVAL {$monthInterval} MONTH), '%Y-%m-01'))
							 GROUP BY month, created_by";

		$postStatsArr = Posts::model()->findAllBySql($query);
		//Gets distinct users data
		$query = "SELECT DISTINCT created_by FROM posts 
					WHERE created_on >= (SELECT DATE_FORMAT(DATE_SUB(CURDATE(),INTERVAL 4 MONTH), '%Y-%m-01'))";
		
		$distinctUsersArr = CHtml::listData(Posts::model()->with(array(
							'createdBy' => array(
								'select' => 'firstname, lastname',
								'joinType' => 'INNER JOIN',
								'together' => true
							)
						))->findAllBySql($query), 'created_by', 'createdBy.fullName');

		//Gets months array
		$usersMonthsDataArr = array();
		
		foreach($distinctUsersArr as $user_id => $fullname)
		{
			for ($i = 0; $i < AppConstants::REPORT_MONTH_LIMIT; $i++)
			{
				$usersMonthsDataArr[$user_id][$fullname][$i]['month'] = date("M Y", strtotime(-($i) . " months"));
				$usersMonthsDataArr[$user_id][$fullname][$i]['approved'] = 0;
				$usersMonthsDataArr[$user_id][$fullname][$i]['unapproved'] = 0;
				foreach($postStatsArr as $postStat)
				{
					if ($postStat->month == $usersMonthsDataArr[$user_id][$fullname][$i]['month'] && 
							$postStat->created_by == $user_id)
					{
						$usersMonthsDataArr[$user_id][$fullname][$i]['approved'] = $postStat->approved;
						$usersMonthsDataArr[$user_id][$fullname][$i]['unapproved'] = $postStat->unapproved;
						break;
					}
				}
			}
		}
		
		
		//Renders the view
		$this->render('postsByUsers', array('usersMonthsDataArr' => $usersMonthsDataArr));
	}
	
}
