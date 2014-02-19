<?php

/**
 * @file       OrderItemsController.php$
 * @created    04/02/2014 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij
 */

class OrderItemsController extends Controller
{
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the summary of OrderItems.
	 */
	public function actionCreate()
	{
		$model=new OrderItems;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OrderItems']))
		{
			$this->_onInsertUpdateEvent($model, "insert");

			if (!$model->hasErrors())
			{
				Yii::app()->user->setFlash('message', 'Faq created successfully');

				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' Faq.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=  OrderItems::model()->findByPk($id);
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OrderItems']))
		{
			$this->_onInsertUpdateEvent($model, "update");
			if (!$model->hasErrors())
			{
				Yii::app()->user->setFlash('message', 'Order Item updated successfully');
				$this->redirect(array('orders/index'));
			
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
		$this->redirect('orders/index');
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
		{
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		
		$model=new OrderItems('search');
		$this->layout=FALSE;
		$model->unsetAttributes();  // clear any default values
		$model->order_id=(int)$id;
		if(isset($_GET['OrderItems']))
		{
			$model->attributes=$_GET['OrderItems'];
		}
		
		$this->render('index',array(
			'model'=>$model,
		));
		
		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OrderItems the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OrderItems::model()->findByPk($id);
		
		if($model===null)
		{
			throw new CHttpException(404,'The requested Faq does not exist.');
		}
		
		return $model;
	}

	/**
	 * Function to handle the Insert / Update operations
	 * 
	 * @param OrderItems $model
	 * @param string $scenario
	 */
	
	private function _onInsertUpdateEvent(OrderItems $model, $scenario = "insert")
	{
					
		//setting the model scenario used for validations
		$model->scenario = $scenario;
		//Sets model attribute values from POST
		$model->attributes = $_POST['OrderItems'];
		
		if ($model->validate()) 
		{
			$transaction = $model->dbConnection->beginTransaction();
			
			try
			{
				$model->total_price= $model->unit_price * $model->quantity;
				//saving the recordset
				$model->save(false);
			
				//committing the transaction
				$transaction->commit();
			}
			catch (Exception $e)
			{
				$transaction->rollback();
				
				$model->addError('faq_title', $e->getMessage());
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
        $model = OrderItems::model()->findByPk($id);
		
        $model->active = !$model->active;
        $model->save(false);
        		
		ControllerHelper::OutputJSON(array("success" => 1, "active" => $model->active));
	}
	
	
}
