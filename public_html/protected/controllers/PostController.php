<?php

/**
 * @file       PostController.php$
 * @created    04/02/2014 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */

class PostController extends Controller
{
	
	/**
	 * Array to hold all the uploaded files field prefix
	 * @var Array
	 */
    public $fileUploadPrefixArray = array('picture');
	
	
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	/**
	 * Index function to show Summary
	 */
	
	public function actionIndex()
	{
		$model = new UserPosts('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['UserPosts']))
		{
			$model->attributes=$_GET['UserPosts'];
		}
	
        //Renders the view
		$this->render('index', array('model' => $model));
	}
	/**
	 * Abused function to show Summary of Abused Posts
	 */
	
	public function actionAbused()
	{
		$model = new UserPosts('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['UserPosts']))
		{
			$model->attributes=$_GET['UserPosts'];
		}
		$model->reported_abuse='1';
        //Renders the view
		$this->render('index', array('model' => $model));
	}
	
	/**
	 * Create new Record
	 */
	public function actionCreate($type=NULL)
	{
		$model = new UserPosts('insert');
		
		//Checks if it's POST request
        if (isset($_POST['UserPosts']))
		{
			$this->_onInsertUpdateEvent($model, "insert");

			if (!$model->hasErrors())
			{
				if( $this->_uploadUserPostImage($model, 'insert') )
				{			
					Yii::app()->user->setFlash('message', 'Post created successfully');
				
					$this->redirect(array('index'));
				}
			}
		}
		
		$this->render('create',array(
			'model' => $model, 'type' => $type
		));
	}
	
	/**
	 * Edit a Post
	 */
	public function actionUpdate()
	{
		
		$model = $this->loadModel();
		
		//Checks if it's POST request
	
		if(isset($_POST['UserPosts']))
		{
			$this->_onInsertUpdateEvent($model, "update");
			
			if (!$model->hasErrors())
			{
				if( $this->_uploadUserPostImage($model, 'update') )
				{
					Yii::app()->user->setFlash('message', 'Post updated successfully');
					$this->redirect(array('index'));
			
				}	
			}
		}

		$this->render('update',array(
			'model' => $model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	
	 * @return UserPosts
	 * @throws CHttpException
	 */
	private function loadModel()
	{
		if ($this->_model === null)
		{
			if (isset($_GET['id']))
			{
				$this->_model = UserPosts::model()->findByPk((int)$_GET['id']);
			}
			
			if ($this->_model === null)
			{
				throw new CHttpException(404,'Invalid Request');
			}
		}
		
		return $this->_model;
	}
	
	/**
	 * Function to handle the Insert / Update operations
	 * 
	 * @param UserPosts $model
	 * @param string $scenario
	 */
	private function _onInsertUpdateEvent(UserPosts $model, $scenario = "insert")
	{
					
		//setting the model scenario used for validations
		$model->scenario = $scenario;
		//Sets model attribute values from POST
		$model->attributes = $_POST['UserPosts'];
	
		
		if ($model->validate()) 
		{
			
			$transaction = $model->dbConnection->beginTransaction();
			
			try
			{
				$model->user_id = Yii::app()->user->id;
				//saving the recordset
				$model->save(false);
			
				//committing the transaction
				$transaction->commit();
			}
			catch (Exception $e)
			{
				$transaction->rollback();
				
				$model->addError('comment', $e->getMessage());
			}
		}
	}
	
	/**
	 * Toggles the active
	 */
	public function actionToggleActive($id)
	{
         $model = UserPosts::model()->findByPk($id);
		
        $model->active = !$model->active;
        $model->save(false);
        		
		ControllerHelper::OutputJSON(array("success" => 1, "active" => $model->active));
	}
	
	/**
	 * Function to upload the post pictre
	 * @param Post $model
	 * @return boolean
	 */
	private function _uploadUserPostImage($model, $scenario)
	{
		$dirPath = Yii::app()->uploader->createDirectoryByLimiter(Yii::getPathOfAlias(AppConstants::UPLOADS_USERPOST_PATH_ALIAS), $model->user_post_id);
		
		list($saveResult, $uploadedfilesArr) = ControllerFileUploadHelper::uploadFiles($this, $model, $scenario, $dirPath, AppConstants::$USERPOST_MEDIA_CONFIGURATION);
		
		return $saveResult;
	}
}
