<?php

/**
 * @file       ActiveRecord.php$
 * @created    14/10/2013 2:39:05 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Description of ActiveRecord
 *
 * @author Rohit Gupta
 */
class ActiveRecord extends CActiveRecord
{
    public function beforeSave()
    {       
        if($this->isNewRecord)
        {
            if($this->hasAttribute('created_on'))
                $this->created_on = new CDbExpression('NOW()');
			
            if($this->hasAttribute('created_by') && !isset($this->created_by) && isset(Yii::app()->user) && Yii::app()->user->id > 0)
                $this->created_by = Yii::app()->user->id;
			
			if($this->hasAttribute('modified_on'))
                $this->modified_on = new CDbExpression('NOW()');
			
            if($this->hasAttribute('modified_by') && !isset($this->modified_by) && isset(Yii::app()->user) && Yii::app()->user->id > 0)
                $this->modified_by = Yii::app()->user->id;
		}
		else
		{
			if($this->hasAttribute('modified_on'))
                $this->modified_on = new CDbExpression('NOW()');
			
            if($this->hasAttribute('modified_by') && !isset($this->modified_by) && isset(Yii::app()->user) && Yii::app()->user->id > 0)
                $this->modified_by = Yii::app()->user->id;
		}
		
		return parent::beforeSave();
    }
	
	/**
	 * Function to return the full HTTP path of an uploaded file
	 * 
	 * @param string $fieldPrefix
	 * @return string
	 */
	public function getUploadedFileFullPath($fieldPrefix)
	{	
		$fieldName = $fieldPrefix . "_media_file_id";
		$mediaRelationName = $fieldPrefix . "_MediaFile";
		
		//lets get the image from cache, if not found then we will continue fetching from the Databae
		//. we will store the image in the cache once fetched from the DB
	//	$cachedURL = MediaFiles::getMediaFileURLFromCache(MediaFiles::_GetMediaFilesReferenceColumnName($this), $this->getPrimaryKey(), $fieldName);
		$cachedURL= FALSE;
		if ($cachedURL === FALSE)
		{
			$url = FALSE;
			
			if($this->hasAttribute($fieldName) && $this->{$fieldName} > 0)
			{
				if (!empty($this->$mediaRelationName->cdn_absolute_url))
				{
					$url = $this->$mediaRelationName->cdn_absolute_url;
				}
				else if (!empty($this->$mediaRelationName->filename))
				{
					$url = Yii::app()->params["baseHttpPath"] . '/' . $this->$mediaRelationName->filepath . '/' . $this->$mediaRelationName->filename;
				}
				
				//lets store the url in the cache
				/*if ($url !== FALSE)
				{
					MediaFiles::storeMediaFileURLInCache(MediaFiles::_GetMediaFilesReferenceColumnName($this), $this->getPrimaryKey(), $fieldName, $url);
				}*/
			}
			
			return $url;
		}
		
		return $cachedURL;
	}
	
	/**
	 * Function to return the full HTTP path of an uploaded file
	 * 
	 * @param string $fieldPrefix
	 * @return string
	 */
	public function getUploadedFileFullPathByIdentifier($fieldPrefix, $imageIdentifier = 'Orig')
	{	
		//lets get the image from cache, if not found then we will continue fetching from the Databae
		//. we will store the image in the cache once fetched from the DB
		$cachedURL = MediaFiles::getMediaFileURLFromCache(get_class($this), $this->getPrimaryKey(), $fieldPrefix, $imageIdentifier);
		
		if ($cachedURL === FALSE)
		{
			$url = FALSE;
			$columnFieldName = MediaFiles::_GetMediaFilesReferenceColumnName($this);
			
			$mediaFilesModel = MediaFiles::model()->find("image_identifier = :image_identifier AND {$columnFieldName} = :{$columnFieldName}",
						array(":image_identifier" => $imageIdentifier, ":{$columnFieldName}" => $this->{$columnFieldName})
					);
			if ($mediaFilesModel === null)
			{
				$mediaFilesModel = MediaFiles::model()->find("image_identifier = :image_identifier AND {$columnFieldName} = :{$columnFieldName}",
						array(":image_identifier" => 'Orig', ":{$columnFieldName}" => $this->{$columnFieldName})
					);
			}

			if (!empty($mediaFilesModel->cdn_absolute_url))
			{
				$url = $mediaFilesModel->cdn_absolute_url;
			}
			else if (!empty($mediaFilesModel->filename))
			{
				$url = Yii::app()->params["baseHttpPath"] . '/' . $mediaFilesModel->filepath . '/' . $mediaFilesModel->filename;
			}
			
			//lets store the url in the cache
		/*	if ($url !== FALSE)
			{
				MediaFiles::storeMediaFileURLInCache(get_class($this), $this->getPrimaryKey(), $fieldPrefix, $url, $imageIdentifier);
			}*/
			
			return $url;
		}
		
		return $cachedURL;
	}
	
	/**
	 * Function to retun the yesno array for Cgridview Filter Select dropdown
	 * 
	 * @return array
	 */
	public function getYesNoFilterArray()
	{
		return array('' => 'All', '1' => 'Yes', '0' => 'No');
	}
	
	/**
	 * Function to retun the Activities Status array for Cgridview Filter Select dropdown
	 * 
	 * @return array
	 */
	public function getActivitiesFilterArray()
	{
		return array('' => 'All', 'open' => 'Open', 'resolved' => 'Resolved','close'=>'close');
	}
	
	/**
	 * Function to retun the ActivitiesType array for Cgridview Filter Select dropdown
	 * 
	 * @return array
	 */
	public function getActivitiesTypeFilterArray()
	{
		return array('' => 'All', 'facebook_share' => 'Facebook Share', 'goolgle_plus_share' => 'Google+ Share','twitter_share'=>'Twitter Share','reported_abuse'=>'Reported Abuse');
	}
	
	/**
	 * Function to retun the ActivitiesType array for Cgridview Filter Select dropdown
	 * 
	 * @return array
	 */
	public function getActivitiesStatusFilterArray()
	{
		return array('' => 'select', 'open' => 'Open', 'resolved' => 'Resolved','closed'=>'closed');
	}
	/**
	 * Limits the field characters
	 * @param type $field
	 * @param type $limit
	 * @return type
	 */
	public function limitFieldLength($field, $limit = -1)
	{
		if ($limit > 0)
		{
			$runningChars = $limit < strlen($this->{$field}) ? '..' : '' ;
			
			return substr($this->{$field}, 0, $limit) .  $runningChars;
		}
		else
		{
			return $this->{$field};
		}
	}
}
