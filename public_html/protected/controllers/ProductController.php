<?php
/*@var $model Products*/
/**
 * @file       ProductController.php$
 * @created    04/02/2014 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */

class ProductController extends Controller
{
	/**
	 * Array to hold all the uploaded files field prefix
	 * @var Array
	 */
    public $fileUploadPrefixArray = array('product_picture');

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' Products.
	 */
	public function actionCreate()
	{
		$model=new Products;

		if(isset($_POST['Products']))
		{	
			$this->_onInsertUpdateEvent($model, "insert");

			if (!$model->hasErrors())
			{
				if( $this->_uploadProductsImage($model, 'insert') )
				{
					Yii::app()->user->setFlash('message', 'Product created successfully');

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
	 * If update is successful, the browser will be redirected to the 'view' Products.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Products']))
		{
			$this->_onInsertUpdateEvent($model, "update");
			if (!$model->hasErrors())
			{
				if( $this->_uploadProductsImage($model, 'update') )
				{
					Yii::app()->user->setFlash('message', 'Product updated successfully');
					
					$this->redirect(array('index'));
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Delete a product
	 * 
	 * @param integer $id
	 */
	public function actionDelete($id)
	{
		
		 $model = Products::model()->findByPk($id);
		
        $model->marked_delete = !$model->marked_delete;
        $model->save(false);

			$this->redirect(array('index'));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{	
		$model=new Products('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Products']))
		{
			$model->attributes=$_GET['Products'];
		}

		$this->render('index',array(
			'model'=>$model
		));
		
	}
	
	/**
	 * Lists all models.
	 */
	public function actionDeleted()
	{	
		$model=new Products('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Products']))
		{
			$model->attributes = $_GET['Products'];
		}
		
		$model->marked_delete = "1";
		
		$this->render('deleted',array(
			'model'=>$model,
		));
		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Products the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Products::model()->findByPk($id);
		
		if($model === null)
		{
			throw new CHttpException(404,'The requested Products does not exist.');
		}
		
		return $model;
	}

	
	/**
	 * Function to handle the Insert / Update operations
	 * 
	 * @param Products $model
	 * @param string $scenario
	 */
	
	private function _onInsertUpdateEvent(Products $model, $scenario = "insert")
	{
		//setting the model scenario used for validations
		$model->scenario = $scenario;
		//Sets model attribute values from POST
		$model->attributes = $_POST['Products'];
		
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
				
				$model->addError('code', $e->getMessage());
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
        $model = Products::model()->findByPk($id);
		
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
		/*@var $model Products*/
		
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
	private function _uploadProductsImage($model, $scenario)
	{
		$dirPath = Yii::app()->uploader->createDirectoryByLimiter(Yii::getPathOfAlias(AppConstants::UPLOADS_PRODUCTS_PATH_ALIAS), $model->product_id);
		
		list($saveResult, $uploadedfilesArr) = ControllerFileUploadHelper::uploadFiles($this, $model, $scenario, $dirPath, AppConstants::$PRODUCTS_MEDIA_CONFIGURATION);
		
		return $saveResult;
	}
}
