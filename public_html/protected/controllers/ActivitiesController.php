<?php

/**
 * @file       ActivitiesController.php$
 * @created    07/02/2014 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */

class ActivitiesController extends Controller
{
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' Activity.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserActivities']))
		{
			$this->_onInsertUpdateEvent($model, "update");
			if (!$model->hasErrors())
			{
				Yii::app()->user->setFlash('message', 'Activity updated successfully');
				$this->redirect(array('index'));
			
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new UserActivities('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['UserActivities']))
		{
			$model->attributes=$_GET['UserActivities'];
		}
		
		$this->render('index',array(
			'model'=>$model,
		));
	}
/**
	 * Lists all models.
	 */
	public function actionAbused()
	{
		$model=new UserActivities('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['UserActivities']))
		{
			$model->attributes=$_GET['UserActivities'];
		}
		$model->activity_type='reported_abuse';
		$this->render('index',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserActivities the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserActivities::model()->findByPk($id);
		
		if($model===null)
		{
			throw new CHttpException(404,'The requested Activity does not exist.');
		}
		
		return $model;
	}

	/**
	 * Function to handle the Insert / Update operations
	 * 
	 * @param UserActivities $model
	 * @param string $scenario
	 */
	
	private function _onInsertUpdateEvent(UserActivities $model, $scenario = "insert")
	{
					
		//setting the model scenario used for validations
		$model->scenario = $scenario;
		//Sets model attribute values from POST
		$model->attributes = $_POST['UserActivities'];
		
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
				
				$model->addError('user_id', $e->getMessage());
			}
		}
	}
	
	
	
}
