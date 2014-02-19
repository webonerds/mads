<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	
	/**
	 * @var Users
	 */
	public $userRecord;
	
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$record = Users::model()->findByAttributes(array('username'=>$this->username, 'status' => 1));
		/*@var $record Users*/
		
		if($record === null)
		{
            $this->errorCode=self::ERROR_USERNAME_INVALID;
		}
        else if( MD5($this->password)!= $record->password )
		{
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
        else
        {
            $this->_id = $record->user_id;
            $this->setState('firstname', $record->firstname);
			$this->setState('lastname', $record->lastname);
			$this->setState('username', $record->username);
			
			//lets get all the user roles
			$roles = UserRoles::model()->with('role')->findAll('user_id = :user_id', array(':user_id' => $record->user_id));
			$rolesArr = CHtml::listData($roles, 'role_id', 'role.role_name'); 
			
			$this->setState('roles', $rolesArr);
			$this->setState('private_email', $record->private_email);
			$this->setState('fullname', $record->getFullname());
			$this->setState('email_address_verified', $record->email_address_verified);
			
			$record->last_login_datetime = date("Y-m-d H:i:s");
			$record->last_login_ip_address = Yii::app()->request->getUserHostAddress();
			$record->update(array('last_login_datetime', 'last_login_ip_address'));
			
			$this->errorCode=self::ERROR_NONE;
        }
		
        return !$this->errorCode;
	}
	
	/**
	 * Function to check if the username is correct or not
	 * 
	 * @return int
	 */
	public function verifyUsername()
	{
		$record = Users::model()->findByAttributes(array('username'=>$this->username, 'active' => 1));
		
		if($record === null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else
		{
        	$this->errorCode=self::ERROR_NONE;
			$this->userRecord = $record;
		}
		
		return !$this->errorCode;
	}
	
	public function getId()
    {
        return $this->_id;
    }
}