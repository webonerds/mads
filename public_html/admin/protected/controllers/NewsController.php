<?php

/**
 * @file       NewsController.php$
 * @created    04/02/2014 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij
 */

class NewsController extends Controller
{
	/**
	 * Array to hold all the uploaded files field prefix
	 * @var Array
	 */
    public $fileUploadPrefixArray = array('picture');

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' News.
	 */
	public function actionCreate()
	{
		$model=new News;

		if(isset($_POST['News']))
		{	
			$this->_onInsertUpdateEvent($model, "insert");

			if (!$model->hasErrors())
			{
				if( $this->_uploadNewsImage($model, 'insert') )
				{
					Yii::app()->user->setFlash('message', 'News created successfully');

					$this->redirect(array('index'));
				}	
				
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' News.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$this->_onInsertUpdateEvent($model, "update");
			if (!$model->hasErrors())
			{
				if( $this->_uploadNewsImage($model, 'update') )
				{
					Yii::app()->user->setFlash('message', 'News updated successfully');
					$this->redirect(array('index'));
			
			
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
	
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
		{
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{	
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['News']))
		{
			$model->attributes=$_GET['News'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		
		if($model===null)
		{
			throw new CHttpException(404,'The requested News does not exist.');
		}
		
		return $model;
	}

	
	/**
	 * Function to handle the Insert / Update operations
	 * 
	 * @param News $model
	 * @param string $scenario
	 */
	
	private function _onInsertUpdateEvent(News $model, $scenario = "insert")
	{
		//setting the model scenario used for validations
		$model->scenario = $scenario;
		//Sets model attribute values from POST
		$model->attributes = $_POST['News'];
		
		if ($model->validate()) 
		{
			$transaction = $model->dbConnection->beginTransaction();
			
			try
			{
				//saving the recordset
				$model->save(false);
			
				//committing the transaction
				$transaction->commit();
			}
			catch (Exception $e)
			{
				$transaction->rollback();
				
				$model->addError('news_title', $e->getMessage());
			}
		}
	}
	
	/**
	 * Toggle the active status of the record set
	 * 
	 * @param integer $id
	 */
	public function actionToggleActive($id)
	{
        $model = News::model()->findByPk($id);
		
        $model->active = !$model->active;
        $model->save(false);
        		
		ControllerHelper::OutputJSON(array("success" => 1, "active" => $model->active));
	}
	
	/**
	 * Function to delete an already uploaded picture
	 * 
	 * @param integer $id
	 * @param string $field
	 */
	public function actionDeleteImage($id, $field)
	{
		$model = $this->loadModel($id);
		
		$transaction = $model->dbConnection->beginTransaction();
		
		try
		{
			$model->saveAttributes(array($field . '_media_file_id' => null));
			$model->unsetMediaFile();
			
			//committing the transaction
			$transaction->commit();
		}
		catch(Exception $e)
		{
			$transaction->rollback();
			
			throw new CHttpException(404, 'Error occurred while deleting');
		}
		
		ControllerHelper::OutputJSON(array("success" => 1));
	}
	
	/**
	 * Function to upload the assets image
	 * @param Assets $model
	 * @return boolean
	 */
	private function _uploadNewsImage($model, $scenario)
	{
		$dirPath = Yii::app()->uploader->createDirectoryByLimiter(Yii::getPathOfAlias(AppConstants::UPLOADS_NEWS_PATH_ALIAS), $model->news_id);
		
		list($saveResult, $uploadedfilesArr) = ControllerFileUploadHelper::uploadFiles($this, $model, $scenario, $dirPath, AppConstants::$NEWS_MEDIA_CONFIGURATION);
		
		return $saveResult;
	}
}
