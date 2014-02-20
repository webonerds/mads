<?php

/**
 * @file       Reports.php$
 * @created    25/12/2013 12:24:10 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */

/**
 * Description of Reports
 *
 * @author Ajij Attar
 */
class Reports extends CFormModel
{
	
	public static function getPiaChartData($model='users',$interval=NULL)
	{
		
		$query = "SELECT count(*) as total , DATE_FORMAT(created_on, '%b %Y') as month, (select count(*) from $model where  created_on BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 $interval) AND CURDATE() AND active='1' and DATE_FORMAT(created_on, '%b %Y') = month) as active , (select count(*) from $model where created_on BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 $interval) AND CURDATE() AND active='0' and DATE_FORMAT(created_on, '%b %Y') = month) as inactive from $model where created_on BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 $interval) AND CURDATE() group by month;";
			
	
		$postStatsArr = Yii::app()->db->createCommand($query)->queryAll();
	
	
		return $postStatsArr;
	
	}
	/**
	 * 
	 * @param model $model
	 * @param type $group
	 * @param type $days
	 * @return type
	 */
	public static function getGraphData($model,$group,$days=6)
	{
		
		$graphdata = Yii::app()->db->createCommand("select count(*) as total_post,date_format(created_on,'%y-%M-%d') as day from $model  group by day limit 6")->queryAll();
		
		return $graphdata;
	}
	
	/**
	 * 
	 * @param type $model
	 * @param type $interval
	 * @return type
	 */
	public static function getChartData($model='users')
	{
		
		$query = "SELECT count(*) as total, DATE_FORMAT(created_on, '%b %Y') as month, (select count(*) from $model where  active='1' and DATE_FORMAT(created_on, '%b %Y') = month) as active , (select count(*) from $model where  active='0' and DATE_FORMAT(created_on, '%b %Y') = month) as inactive from $model group by month;";
			
	
		$postStatsArr = Yii::app()->db->createCommand($query)->queryAll();
	
	
		return $postStatsArr;
	
	}
}
