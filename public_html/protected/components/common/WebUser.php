<?php

/**
 * @file       WebUser.php$
 * @created    02/10/2013 1:25:09 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Description of WebUser
 *
 * @author Rohit Gupta
 */
class WebUser extends CWebUser
{
	/**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params=array())
    {
		if (empty($this->id)) 
		{
            // Not identified => no rights
            return false;
        }
		
		//if admin, then allow everything
		if ($this->isAdmin())
		{
			return TRUE;
		}
		
		//Lets do data based validation for each task
        switch ($operation)
		{
			//member can edit a task, if he is an editor the club or if the task is assigned or created by the user
			case 'task.view':
				/* @var $task Tasks */
				$task = $params["task"];
				return ($task->assigned_user_id == $this->id 
						|| $task->created_by == $this->id 
						|| UserClubRoles::model()->validateUserClubRole($this->id, $task->club_id, AppConstants::USERS_EDITOR_ROLE_ID)
						) ? true : false;
				break;
			
			default :
				break;
		}
		
		return FALSE;
    }
	
	
	/**
	 * Function to check the access to a controller or its function based on menu.php config
	 * 
	 * @return boolean
	 */
	public function checkControllerAccess($controllerID = '', $actionID = '', $checkActionAccess = true)
	{
		if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
		
		//If frontend user try to login from admin panel then throws exception
		if (Yii::app()->user->isOnlyUser())
		{
			Yii::app()->user->logout();
			throw new CHttpException(403, 'You are not authorized to login from this panel.');
		}
		
		//Current logged in user roles
		$roles = $this->getState("roles");
		
		//By default only allowing the admin to have access unless gets overridden below
		$requiredRoles = array();
		
		//Getting all the roles from menu.php config
		$menuArr = include(Yii::app()->basePath . "/config/menu.php");
		$activeContollerID = (!empty($controllerID)) ? $controllerID : Yii::app()->controller->id;
		$activeContollerActionID = (!empty($actionID)) ? $actionID : Yii::app()->controller->action->id;
		
		//checking for roles at controller level
		if (isset($menuArr[$activeContollerID]) && isset($menuArr[$activeContollerID]["roles"]))
		{
			$requiredRoles = $menuArr[$activeContollerID]["roles"];
		}
		
		//checking for roles at controller action level for subMenu
		if ($checkActionAccess && isset($menuArr[$activeContollerID]['subMenu'][$activeContollerActionID]) && isset($menuArr[$activeContollerID]['subMenu'][$activeContollerActionID]["roles"]))
		{
			$requiredRoles = $menuArr[$activeContollerID]['subMenu'][$activeContollerActionID]["roles"];
		}
		
		//if there are no roles required, then lets allow the access
		if (empty($requiredRoles))
			return TRUE;
		
		//If there are roles, that match, then allow acccess
		return count(array_intersect($roles, $requiredRoles)) > 0 ? TRUE : FALSE;
		
	}
	
	/**
	 * Function to check if the logged in user has a specific role
	 * @param string $role Role to check
	 * @return boolean
	 */
	public function checkUserRole($role = "")
	{
		if ($role === '')
			return FALSE;
		
		$roles = $this->getState("roles");
		
		return in_array($role, $roles) ? TRUE : FALSE;
	}
	
	/**
	 * Check if the user is an admin
	 * 
	 * @return bool
	 */
	public function isAdmin()
	{
		return $this->checkUserRole('admin');
	}
	
	/**
	 * Checks if it's frontend user
	 * 
	 * @return bool
	 */
	public function isOnlyUser()
	{
		return !($this->isAdmin());
	}
}