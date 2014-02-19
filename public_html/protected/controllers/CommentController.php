<?php

/**
 * @file       CommentController.php$
 * @created    06/02/2014 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */

class CommentController extends Controller
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
		$model = new UserPostComments('search');
		$model->unsetAttributes();  // clear any default values
		
		if (isset($_GET['user_post_id']))
		{
			$model->post_id=$_GET['user_post_id'];
		
		}
		
		if (isset($_GET['UserPostComments']))
		{
			$model->attributes=$_GET['UserPostComments'];
				
		}
	
        //Renders the view
		$this->render('index', array('model' => $model));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	
	 * @return UserPostComments
	 * @throws CHttpException
	 */
	private function loadModel()
	{
		if ($this->_model === null)
		{
			if (isset($_GET['id']))
			{
				$this->_model = UserPostComments::model()->findByPk((int)$_GET['id']);
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
	 * @param UserPostComments $model
	 * @param string $scenario
	 */
	private function _onInsertUpdateEvent(UserPostComments $model, $scenario = "insert")
	{
					
		//setting the model scenario used for validations
		$model->scenario = $scenario;
		//Sets model attribute values from POST
		$model->attributes = $_POST['UserPostComments'];
	
		
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
				
				$model->addError('comment', $e->getMessage());
			}
		}
	}
	
	/**
	 * Toggles the active
	 */
	public function actionToggleActive($id)
	{
         $model = UserPostComments::model()->findByPk($id);
		
        $model->active = !$model->active;
        $model->save(false);
        		
		ControllerHelper::OutputJSON(array("success" => 1, "active" => $model->active));
	}
	

}
