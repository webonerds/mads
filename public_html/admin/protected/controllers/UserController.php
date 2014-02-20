<?php
/**
 * @file       UserController.php$
 * @created    05/10/2013 10:58:34 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Controller to manage User Manager
 *
 * @author Rohit Gupta
 */

class UserController extends Controller
{
	/**
	 * @var Users the currently loaded data model instance.
	 */
	private $_model;
	public $fileUploadPrefixArray = array('profile_picture');
	
	/**
	 * Users Summary
	 */
	public function actionIndex()
	{
		$model = new Users('search');
		
		$model->unsetAttributes();  // clear any default values
        
		if(isset($_GET['Users']))
		{
			$model->attributes = Yii::app()->input->stripClean($_GET['Users']);
		}
	
        //Renders the view
		$this->render('index', array('model' => $model));
	}
	
	/**
	 * Create User
	 */
	public function actionCreate()
	{
		$model = new Users('insert');
		
		if(isset($_POST['Users']))
		{
			//Function to handle post data
			$this->_onInsertUpdateEvent($model, "insert");
			
			if (!$model->hasErrors())
			{
				Yii::app()->user->setFlash('message', 'User created successfully');

				$this->redirect(array('index'));
			}
		}
		
	
		
		$this->render('create', array('model'=>$model));
	}

	/**
	 * Edit User
	 */
	public function actionUpdate()
	{
		$model = $this->loadModel();
		if(isset($_POST['Users']))
		{
			//Function to handle post data
			$this->_onInsertUpdateEvent($model, "update");
			
			if (!$model->hasErrors())
			{
				
					Yii::app()->user->setFlash('message', 'User updated successfully');
					
					$this->redirect($this->createUrl('index'));
			
				
			}
		}
		
		//Empty the password, as its not mandatory when updating
		$model->setAttribute('password', '');
		
		$userRolesModel = UserRoles::model()->with('role')->findAll('user_id=:user_id', array(':user_id' => $model->user_id));
		$userRolesArr = CHtml::listData($userRolesModel, 'role_id', 'role.role_name');
		
		
		$this->render('update', array('model'=>$model, 'userRoles' => $userRolesArr));
	}


	
	
	public function actionExportMembers()
	{
		Yii::import('frontend.extensions.ECSVExport');
		
		$userModels = Users::model()->findAll(array('order' => 'firstname', 'select' => 'firstname,lastname,register_source,private_email,date_of_birth,active,created_on'));
		$csv = new ECSVExport($userModels);
		$csv->includeColumnHeaders = FALSE;
		
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename="Members-' . date('YmdHi') .'.csv"');
		
		echo	Users::model()->getAttributeLabel('firstname') . "," .
				Users::model()->getAttributeLabel('lastname') . "," .
				Users::model()->getAttributeLabel('register_source') . "," .
				Users::model()->getAttributeLabel('private_email') . "," .
				Users::model()->getAttributeLabel('date_of_birth') . "," .
				Users::model()->getAttributeLabel('active') . "," .
				Users::model()->getAttributeLabel('created_on') . ",\n";
				
		echo $csv->toCSV();
		
		ControllerHelper::disableRoutes();
		Yii::app()->end();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	private function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$_GET['id'] = Yii::app()->input->stripClean($_GET['id']);
				
				$this->_model = Users::model()->findByPk($_GET['id']);
			}
			
			if($this->_model === null)
				throw new CHttpException(404,'Invalid Request');
		}
		
		return $this->_model;
	}
	
	/**
	 * Function to upload the profile picture
	 * @param Users $model
	 * @return boolean
	 */
	private function _uploadUserProfilePicture($model, $scenario)
	{
		$dirPath = Yii::app()->uploader->createDirectoryByLimiter(Yii::getPathOfAlias(AppConstants::UPLOADS_USERS_PATH_ALIAS), $model->user_id);
		
		list($saveResult, $uploadedfilesArr) = ControllerFileUploadHelper::uploadFiles($this, $model, $scenario, $dirPath);
		
		return $saveResult;
	}
	
	/**
	 * Function to handle the Insert / Update operations
	 * 
	 * @param Games $model
	 * @param string $scenario
	 */
	private function _onInsertUpdateEvent(Users $model, $scenario = "insert")
	{
		//setting the model scenario used for validations
		$model->scenario = $scenario;
		//Sets model attribute values from POST
		$model->attributes = $_POST['Users'];
		
		
		if ($model->validate()) 
		{
			$transaction = $model->dbConnection->beginTransaction();
			
			try
			{
				//saving the transaction
				$model->save(false);
				
				
				for($i=0;$i<count($_POST['Users']['roles']);$i++)
				{
					$userroles= UserRoles::model()->findByAttributes(array('user_id'=>$model->user_id,'role_id'=>$_POST['Users']['roles'][$i]));
					if(!isset($userroles))
					{
							$userroles= new UserRoles();
					}
					$userroles->user_id=$model->user_id;
					$userroles->role_id=$_POST['Users']['roles'][$i];
					$userroles->save(false);
					
				}
				
				//lets unset the password field to avoid re-crypting
				$model->unsetAttributes(array('password'));
			
				//uploading the files
				if($this->_uploadUserProfilePicture($model, $scenario))
				{
					 
					$transaction->commit();
				}
				else 
				{
					$transaction->rollback();

					$model->addError('profile_picture_media_file_id', "Error uploading file");
				}
			}
			catch (Exception $e)
			{
				$transaction->rollback();
				
				$model->addError('username', $e->getMessage());
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