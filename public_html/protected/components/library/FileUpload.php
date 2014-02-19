<?php

/**
 * @file       FileUpload.php$
 * @created    10/10/2013 11:49:43 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Description of FileUpload
 *
 * @author Rohit Gupta
 */
class FileUpload extends CComponent
{
	public $filesArr = array();
	
	const DIRECTORY_LIMITER = 1000;
	const DIR_MODE = 0755;
	
	public function init()
	{
		
	}
	
	public function uploadFile($fileInputVars, $dirPath, $resizeArray = array())
	{
		if (!is_array($fileInputVars))
		{
			$fileInputVars = array($fileInputVars);
		}
		
		foreach ($fileInputVars as $fileInputVar)
		{			
			$this->filesArr[$fileInputVar] = array('IsUploaded' => false, 'ErrorUploading' => FALSE, "Error" => "");
			
			$fileInstance = CUploadedFile::getInstanceByName($fileInputVar);
			
			if(is_object($fileInstance) && $fileInstance->name !== "")
			{
				$this->filesArr[$fileInputVar]['IsUploaded'] = true;
										
				$randomFileName = self::generateRandomFileName($dirPath, $fileInstance->extensionName);
				
				if (!$fileInstance->saveAs($dirPath . DIRECTORY_SEPARATOR . $randomFileName))
				{
					$this->filesArr[$fileInputVar]['ErrorUploading'] = true;
					$this->filesArr[$fileInputVar]['Error'] = $fileInstance->getError();
				}
				else
				{
					//Resize the images
					if (!empty($resizeArray) && ($fileInstance->getType() == image_type_to_mime_type(IMAGETYPE_GIF) || $fileInstance->getType() == image_type_to_mime_type(IMAGETYPE_JPEG) || $fileInstance->getType() == image_type_to_mime_type(IMAGETYPE_PNG)))
					{
						foreach ($resizeArray as $resizeValue)
						{
							$thumb = Yii::app()->phpThumb->create($dirPath . DIRECTORY_SEPARATOR . $randomFileName);
							$thumb->adaptiveResize($resizeValue['width'], $resizeValue['height']);
							$thumb->save($dirPath . DIRECTORY_SEPARATOR . $resizeValue['prefix'] . $randomFileName);
						}
					}
					
					$this->filesArr[$fileInputVar]['OrigName'] = $fileInstance->name;
					$this->filesArr[$fileInputVar]['FileSize'] = $fileInstance->size;
					$this->filesArr[$fileInputVar]['SavedFileName'] = $randomFileName;
					$this->filesArr[$fileInputVar]['FileType'] = $fileInstance->type;											
				}
			}
		}
	}
	
	public function generateRandomFileName($dirPath, $extension) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
        while (1) 
		{    
            $randomString = '';
			
            for ( $i = 0; $i < 13; $i++ ) 
			{
                $randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
            }
            
            if (!file_exists($dirPath . DIRECTORY_SEPARATOR . $randomString . $extension ))
			{
				break;
			}
        }
        
        
		return $randomString . "." . $extension;
	}
	
	public function deleteImage($dirPath, $fileName, $resizeArray = array())
	{
		$filePath = $dirPath . DIRECTORY_SEPARATOR . $fileName;

		if (is_file($filePath))
		{
			@unlink($filePath);
		}
		
		//Removes the resized files
		if (!empty($resizeArray))
		{
			foreach ($resizeArray as $resizeValue)
			{
				$filePath = $dirPath . DIRECTORY_SEPARATOR . $resizeValue['prefix'] . $fileName;
				if (is_file($filePath))
				{
					@unlink($filePath);
				}
			}
		}
	}
	
	public function createDirectoryByLimiter($baseDirPath = "", $indxPk = 0, $mode = self::DIR_MODE)
	{
		$dirPath = self::getDirectoryLimiterPath($baseDirPath, $indxPk );
	
		
		self::createDirectory($dirPath, $mode);
		
		return $dirPath;
	}
	
	public function getDirectoryLimiterPath($baseDirPath = "", $indxPk = 0)
	{
		$directoryLimit = ceil($indxPk / self::DIRECTORY_LIMITER);
		$dirPath = $baseDirPath . DIRECTORY_SEPARATOR . $directoryLimit . DIRECTORY_SEPARATOR . $indxPk;
		
		return $dirPath;
	}
	
	public function createDirectory($dirPath = "", $mode = self::DIR_MODE)
	{
		if (!is_dir($dirPath))
		{
			if(!mkdir($dirPath, $mode, true))
			{
				throw new CException('Error creating directory {$dirPath}');
			}
		}
	}
}

