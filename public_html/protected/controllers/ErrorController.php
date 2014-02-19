<?php

class ErrorController extends Controller
{
	public $layout = "error";
	
	public function accessRules()
	{
		return array(
            array('allow',
                'users'=>array('*')
            )
        );
	}

/**
	 * This is the action to handle external exceptions.
	 */
	public function actionIndex()
	{
		$this->actionError();
	}
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}