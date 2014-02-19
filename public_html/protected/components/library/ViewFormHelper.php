<?php

/**
 * @file       ViewFormHelper.php$
 * @created    09/10/2013 04:18:49 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */


class ViewFormHelper extends CHtml
{

	/**
	 * Function to show various image related action buttons
	 * 
	 * @param CController $controller
	 * @param CModel $model
	 * @param string $modelFieldPrefix
	 * @param array $configOptions array('ShowView' => true, 'ShowDelete' => true)
	 */
    public static function imageActions(CController $controller, CModel $model, $modelFieldPrefix, $configOptions = array())
	{   
		$fileNameField = "{$modelFieldPrefix}_media_file_id";
		
		if (!is_object($model->{$fileNameField}) && isset($model->{$fileNameField}) && !empty($model->{$fileNameField}) && $model->{$fileNameField} > 0) 
		{    
			if (isset($configOptions["ShowView"]) && $configOptions["ShowView"])
			{
				echo CHtml::link('', $model->getUploadedFileFullPath($modelFieldPrefix), array('class' => 'previewImage fancybox'));
			}
			 
			if (isset($configOptions["ShowDelete"]) && $configOptions["ShowDelete"])
			{
				echo CHtml::link('', '#', array('class' => 'deleteImage',
												'data-record-id' => $model->{$model->tableSchema->primaryKey},
												'data-url' => Yii::app()->createUrl($controller->getId() . "/deleteimage"),
												'data-field' => $modelFieldPrefix
											 )
							 );
			}

		}
    }
	
}

?>
