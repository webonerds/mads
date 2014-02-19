<?php

class LoginController extends Controller
{
	public $layout = "login";
	
	public function accessRules()
    {
        return array(
            array('allow',
                'users'=>array('*'),
				'actions'=>array('index')
			),
			
			array('allow',
                'users'=>array('@'),
				'actions'=>array('logout')
			),
			
			array('deny',
                'users'=>array('*')
			),
        );
    }
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 * 
	 * Displays the login page
	 */
	public function actionIndex()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = Yii::app()->input->stripClean($_POST['LoginForm']);
			
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	
	/**
	 * Logs out the current admin user and redirect to login page.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout(true);
		
		$this->redirect(Yii::app()->user->loginUrl);
	}
}