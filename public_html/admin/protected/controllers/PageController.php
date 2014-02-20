<?php

/**
 * @file       PageController.php$
 * @created    11/11/2013 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */

class PageController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	/**
	 * Index function to show Summary
	 */
	
	public function actionIndex()
	{
		$model = new Pages('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Pages']))
		{
			$model->attributes=$_GET['Pages'];
		}
	
        //Renders the view
		$this->render('index', array('model' => $model));
	}
	
	/**
	 * Create new Record
	 */
	public function actionCreate()
	{
		$model = new Pages('insert');
		
		//Checks if it's POST request
        if (isset($_POST['Pages']))
		{
			
			$this->_onInsertUpdateEvent($model, "insert");

			if (!$model->hasErrors())
			{
				Yii::app()->user->setFlash('message', 'Page created successfully');

				$this->redirect(array('index'));
			}
		}
		
		$this->render('create',array(
			'model' => $model,
		));
	}
	
	/**
	 * Edit an Asset
	 */
	public function actionUpdate()
	{
		$model = $this->loadModel();
		
		//Checks if it's POST request
		if(isset($_POST['Pages']))
		{
			$this->_onInsertUpdateEvent($model, "update");
			
			if (!$model->hasErrors())
			{
				Yii::app()->user->setFlash('message', 'Page updated successfully');
			}
		}

		$this->render('update',array(
			'model' => $model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	
	 * @return Assets
	 * @throws CHttpException
	 */
	private function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$this->_model = Pages::model()->findByPk((int)$_GET['id']);
				
			}
			
			if($this->_model === null)
				throw new CHttpException(404, 'Invalid Request');
		}
		
		return $this->_model;
	}
	
	/**
	 * Function to handle the Insert / Update operations
	 * 
	 * @param Pages $model
	 * @param string $scenario
	 */
	private function _onInsertUpdateEvent(Pages $model, $scenario = "insert")
	{
					
		//setting the model scenario used for validations
		$model->scenario = $scenario;
		//Sets model attribute values from POST
		$model->attributes = $_POST['Pages'];
		
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
				
				$model->addError('page_title', $e->getMessage());
			}
		}
	}
	
	/**
	 * Toggles the active
	 */
	public function actionToggleActive()
	{
        $model = $this->loadModel();
		
        $model->active = !$model->active;
        $model->save(false);
        		
		ControllerHelper::OutputJSON(array("success" => 1, "active" => $model->active));
	}
}
