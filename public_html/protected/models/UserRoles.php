<?php

/**
 * This is the model class for table "user_roles".
 *
 * The followings are the available columns in table 'user_roles':
 * @property integer $user_id
 * @property integer $role_id
 * @property string $created_on
 * @property integer $created_by
 */
class UserRoles extends ActiveRecord
{
	
	public $clubs;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, role_id', 'required'),
			array('user_id, role_id, created_by', 'numerical', 'integerOnly'=>true),
			array('created_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, role_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			// other relations
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id', 'together' => true, 'joinType' => 'INNER JOIN'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id', 'together' => true),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'role_id' => 'Role',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRoles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Function save user roles
	 * 
	 * @param type $userId
	 * @param array $roles
	 */
	public function saveUserRoles($userId = 0, array $roles = array())
	{
		//lets delete the existing club domains
		$this->deleteAll('user_id=:user_id', array(':user_id' => $userId));
		
		//lets insert domains
		foreach ($roles as $role):
			
			$this->user_id = $userId;
			$this->role_id = $role;
			$this->isNewRecord = true;
						
			//In case of frontend registration - ActiveRecord will save created_by value
			if (!isset(Yii::app()->user->id))
			{
				$this->created_by = $userId;
			}
			
			$this->save(false);
			
		endforeach;
	}
	
	/**
	 * 
	 * @param type $role_id
	 * @return type
	 */
	public function getUsersByRole($role_id = 0)
	{
		return $this->with(array(
				'user' => array(
						'select' => 'user.user_id, user.firstname, user.lastname',
						'joinType' => 'INNER JOIN',
						'together' => true
					)
				))->findAll(array(
					
					'condition' => 't.role_id = :role_id',
					'params' => array(':role_id' => $role_id)
			));
	}
}
