<?php

/**
 * @file       ControllerFileUploadHelper.php$
 * @created    10/10/2013 5:15:40 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Description of ControllerFileUploadHelper
 *
 * @author Rohit Gupta
 */


class ControllerFileUploadHelper extends CComponent
{
	
	/**
	 * 
	 * @param CController $controller
	 * @param CModel $model
	 * @param string $scenario
	 * @param string $dirPath
	 * @return array
	 */
	public static function uploadFiles(CController $controller, CModel $model, $scenario, $dirPath, $resizeArray = array())
	{
		$uploader = new FileUpload;
		$modelClassName = get_class($model);
		$fileInputVars = array();
		
		//Lets generate an array of all the input fields, which were uploaded
		foreach ($controller->fileUploadPrefixArray as $fileUploadFieldPrefix)
		{
			$fileInputVars[] = $modelClassName . '[' . $fileUploadFieldPrefix  . '_media_file_id]';
		}
		
		//Uploading the files to the filesystem
		$uploader->uploadFile($fileInputVars, $dirPath, $resizeArray);
		
		//Saving all the files to the db
		$saveResult = self::saveUploadedFiles($controller, 
											$model, 
											$uploader->filesArr,
											str_replace(array(Yii::app()->params["documentRoot"] . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR), array('', '/'), $dirPath),
											$scenario,
											$resizeArray);
		
		if ($saveResult && $scenario == 'update')
		{
			//deleting the previous uploaded files
			self::deleteOldUploadedFiles($controller, 
										$model, 
										$uploader->filesArr, 
										$dirPath,
										$resizeArray
										);
		}
		
		return array($saveResult, $uploader->filesArr);
	}
	
	/**
	 * all the model images fields should be of the format {prefix}_media_file_id
	 * 
	 * all the old images in the model should be of the format old_{prefix}_filename
	 * 
	 * @param CController $controller
	 * @param CModel $model
	 * @param array $uploadedFiles Should be returned from FileUpload
	 * @param string $dirPath
	 * @param string $scenario
	 * @return boolean
	 */
	public static function saveUploadedFiles(CController $controller, CModel $model, array $uploadedFiles, $dirPath, $scenario = 'insert', $resizeArray = array())
	{
		$modelClassName = get_class($model);
		$modelUpdated = false;
		$modelError = false;
		
		foreach ($uploadedFiles as $key => $uploadedFile)
		{
			$matches = array();
			preg_match('/'. $modelClassName . '\[(.*)_media_file_id\]/', $key, $matches);
			$fieldName = $matches[1];
			
			$modelFieldNames = array('media_id' => "{$fieldName}_media_file_id");
				
			if ($uploadedFile['IsUploaded'] === true 
			&& $uploadedFile['ErrorUploading'] === false)
			{
				$modelUpdated = true;
				
				$mediaFilesReferenceTableColumnName = MediaFiles::_GetMediaFilesReferenceColumnName($model);
				
				//lets create an entry in the media files
				$mediaFilesModel = new MediaFiles('insert');
				$mediaFilesModel->unsetAttributes();
				$mediaFilesModel->filename = $uploadedFile['SavedFileName'];
				$mediaFilesModel->filesize = $uploadedFile['FileSize'];
				$mediaFilesModel->original_filename = $uploadedFile['OrigName'];
				$mediaFilesModel->filetype = $uploadedFile['FileType'];
				$mediaFilesModel->filepath = $dirPath;
				$mediaFilesModel->image_identifier = 'Orig';
				$mediaFilesModel->column_name = $fieldName;
				$mediaFilesModel->isNewRecord = TRUE;
				if ($mediaFilesReferenceTableColumnName)
				{
					$mediaFilesModel->{$mediaFilesReferenceTableColumnName} = $model->getPrimaryKey();
				}
				if (strpos($modelFieldNames["media_id"], 'video') !== FALSE)
				{
					$mediaFilesModel->file_type = 'video';
				}
				$mediaFilesModel->save(FALSE);
				
				//Updating the media id
				$model->{$modelFieldNames["media_id"]} = $mediaFilesModel->getPrimaryKey();
				
				
				//for each of the resize elements, lets create a media entry
				foreach ($resizeArray as $imageIdentifier => $resizeConfig)
				{
					$resizeFileName = $resizeConfig['prefix'] . $uploadedFile['SavedFileName'];
					$resizeFilePath = Yii::app()->params["documentRoot"] . DIRECTORY_SEPARATOR . $dirPath . "/" . $resizeFileName;
					
					if (is_file($resizeFilePath))
					{
						$imageData = getimagesize($resizeFilePath);
						
						$mediaFilesModel->unsetAttributes();
						$mediaFilesModel->filename = $resizeFileName;
						$mediaFilesModel->filesize = filesize($resizeFilePath);
						$mediaFilesModel->original_filename = $resizeFileName;
						$mediaFilesModel->filetype = $uploadedFile['FileType'];
						$mediaFilesModel->filepath = $dirPath;
						$mediaFilesModel->image_identifier = $imageIdentifier;
						$mediaFilesModel->column_name = $fieldName;
						$mediaFilesModel->isNewRecord = TRUE;
						if ($mediaFilesReferenceTableColumnName)
						{
							$mediaFilesModel->{$mediaFilesReferenceTableColumnName} = $model->getPrimaryKey();
						}
						
						if($imageData[2] == IMAGETYPE_GIF || $imageData[2] == IMAGETYPE_JPEG || $imageData[2] == IMAGETYPE_PNG) 
						{
							$mediaFilesModel->image_width = $imageData[0];
							$mediaFilesModel->image_height = $imageData[1];
						}
						else if (strpos($modelFieldNames["media_id"], 'video') !== FALSE)
						{
							$mediaFilesModel->file_type = 'video';
						}
						
						$mediaFilesModel->save(FALSE);
					}
				}
				
			}
			else if ($uploadedFile['IsUploaded'] === false && $scenario == 'update')
			{
				//allowed not uploading files when updating
			}
			else
			{
				//Not forcing image upload on insert. Validation to occur at model level
				//
				//$model->addError($modelFieldNames['name'], $uploadedFile['Error']);
				//$modelError = TRUE;
			}
		}
		
		if ($modelUpdated && !$modelError)
		{
			$model->save(false);
		}
		
		return TRUE & !$modelError;
	}
	
	/**
	 * all the old images in the model should be of the format old_{prefix}_filename
	 * 
	 * @param CController $controller
	 * @param CModel $model
	 * @param array $uploadedFiles
	 * @param type $dirPath
	 */
	public static function deleteOldUploadedFiles(CController $controller, CModel $model, array $uploadedFiles, $dirPath, $resizeArray=array())
	{
		$modelClassName = get_class($model);
		$uploader = new FileUpload;
		
		$mediaFilesReferenceTableColumnName = MediaFiles::_GetMediaFilesReferenceColumnName($model);
			
		foreach ($uploadedFiles as $key => $uploadedFile)
		{
			if ($uploadedFile['IsUploaded'] === true 
			&& $uploadedFile['ErrorUploading'] === false)
			{
				$matches = array();
				preg_match('/'. $modelClassName . '\[(.*)_media_file_id\]/', $key, $matches);
				$fieldName = $matches[1];
				
				$oldFileVarName = "old_{$fieldName}_media_file_id";
				$completeFieldName = "{$fieldName}_media_file_id";
				
				if (!empty($model->{$oldFileVarName}) && ($model->{$oldFileVarName} > 0))
				{
					//fetching the media record
					$mediaFileOrigModel = MediaFiles::model()->findByPk($model->{$oldFileVarName});
					
					//deleting the file(s) from local system
					$uploader->deleteImage($dirPath, $mediaFileOrigModel->filename, $resizeArray);
					
					//lets delete the media file entries which dont have any CDN
					$criteria = new CDbCriteria();
					$criteria->condition = "column_name=:column_name AND (cdn_absolute_url IS NULL or cdn_absolute_url = '') ";
					if ($mediaFilesReferenceTableColumnName)
					{
						$criteria->condition .= ' AND ' . $mediaFilesReferenceTableColumnName . ' = ' . $model->getPrimaryKey();
					}
					$criteria->condition .= ' AND media_file_id < ' . $model->{$completeFieldName};
					$criteria->params = array(':column_name' => $fieldName);
					MediaFiles::model()->deleteAll($criteria);
					
					//lets mark the media file to be deleted 
					$criteria = new CDbCriteria();
					$criteria->condition = "column_name=:column_name";
					if ($mediaFilesReferenceTableColumnName)
					{
						$criteria->condition .= ' AND ' . $mediaFilesReferenceTableColumnName . ' = ' . $model->getPrimaryKey();
					}
					$criteria->condition .= ' AND media_file_id < ' . $model->{$completeFieldName};
					$criteria->params = array(':column_name' => $fieldName);
					MediaFiles::model()->updateAll( array('marked_delete' => 1), $criteria);
				}
			}
		}
	}
}