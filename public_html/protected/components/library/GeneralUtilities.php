<?php

/**
 * @file       GeneralUtilities.php$
 * @created    14/10/2013 04:18:49 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */


class GeneralUtilities extends CComponent
{

	/**
	 * Function to print array in readable format
	 * 
	 * @param type $arr
	 */
	public static function debug($arr){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}
	
	public static function convertMysqlDateTimeToUnix($mysqlDateTime)
	{
		$dateTimeObj = new DateTime($mysqlDateTime);
		return $dateTimeObj->getTimestamp();
	}
	
	/**
	 * Function to convert date in MySql default date format
	 * 
	 * @param type $mysqlDate
	 * @param type $format
	 */
	public static function convertMysqlDateFormat($mysqlDate, $format = 'dd/MM/yyyy')
	{
		return Yii::app()->dateFormatter->format($format, strtotime($mysqlDate));
		//return date($format, strtotime($mysqlDate));
	}
	
	/**
	 * Function to convert date (dd/mm/yyyy) to MySql date format
	 * 
	 * @param type $mysqlDate
	 * @param type $format
	 */
	public static function convertDateToMysqlFormat($humanReadableDate, $format = 'yyyy-mm-dd')
	{
		$dt = DateTime::createFromFormat('d/m/Y', $humanReadableDate);
		return $dt->format('Y-m-d');
	}
	/**
	 * Converts time difference into human readable timespan
	 * @param type $ptime
	 * @return string
	 */
	public static function convertIntoTimespan($ptime)
	{
		$etime = time() - $ptime;

		if ($etime < 1)
		{
			return '0 seconds';
		}

		$a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
					30 * 24 * 60 * 60       =>  'month',
					24 * 60 * 60            =>  'day',
					60 * 60                 =>  'hour',
					60                      =>  'minute',
					1                       =>  'second'
					);

		foreach ($a as $secs => $str)
		{
			$d = $etime / $secs;
			if ($d >= 1)
			{
				$r = round($d);
				return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
			}
		}
	}
	
	public static function getTruncatedString($stringToTruncate, $limit = 10, $insertTrailingChars = TRUE, $trailingChars = '..', $stripNewlineChars = FALSE)
	{
		$stringToTruncate = $stripNewlineChars ? str_replace('\n', '', $stringToTruncate) : $stringToTruncate;
		
		$runningChars = ($limit < strlen($stringToTruncate)) ? $trailingChars : '' ;
		
		return substr($stringToTruncate, 0, $limit) .  (($insertTrailingChars) ? $runningChars : '');
	}
	
	/**
	 * Decodes the message code (base64) into appropriate string value
	 * @return string
	 */
	public static function decodeQuerstringMessageCode()
	{
		$message = "";
		
		if (isset($_GET['c']))
		{
			$code = Yii::app()->input->stripClean($_GET['c']);
			$code = base64_decode($code);
			$message = Yii::t('message', isset(Yii::app()->params['messageCodes'][$code]) 
									? Yii::app()->params['messageCodes'][$code] : '');
		}
		
		return $message;
	}
	
	public static function replaceBrWithP($data) 
	{
		if (strstr($data, '<br') !== FALSE)
		{
			$data = preg_replace('#(?:<br\s*/?>\s*?){2,}#', '</p><p>', $data);
			return "<p>$data</p>";
		}
		
		return $data;
	}
}

?>
