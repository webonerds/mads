<?php

/**
 * @file       CategoriesController.php$
 * @created    05/02/2014 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij
 */

class CategoriesController extends Controller
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Categories;

		if(isset($_POST['Categories']))
		{
			$this->_onInsertUpdateEvent($model, "insert");

			if (!$model->hasErrors())
			{
				Yii::app()->user->setFlash('message', 'Category created successfully');

				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Categories']))
		{
			$this->_onInsertUpdateEvent($model, "update");
			if (!$model->hasErrors())
			{
				Yii::app()->user->setFlash('message', 'Category updated successfully');
				$this->redirect(array('index'));
			
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Function to delete the faq
	 * @param integer $id 
	 */
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
		$model = new Categories('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Categories']))
		{
			$model->attributes = $_GET['Categories'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Categories the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Categories::model()->findByPk($id);
		
		if($model===null)
		{
			throw new CHttpException(404, 'The requested category does not exist.');
		}
		
		return $model;
	}

	/**
	 * Function to handle the Insert / Update operations
	 * 
	 * @param Pages $model
	 * @param string $scenario
	 */
	
	private function _onInsertUpdateEvent(Categories $model, $scenario = "insert")
	{
					
		//setting the model scenario used for validations
		$model->scenario = $scenario;
		//Sets model attribute values from POST
		$model->attributes = $_POST['Categories'];
		
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
				
				$model->addError('title', $e->getMessage());
			}
		}
	}
	
	public function actionToggleActive($id)
	{
        $model = Categories::model()->findByPk($id);
		
        $model->active = !$model->active;
        $model->save(false);
        		
		ControllerHelper::OutputJSON(array("success" => 1, "active" => $model->active));
	}
}
