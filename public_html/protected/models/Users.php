<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property string $register_surce
 * @property string $date_of_birth
 * @property string $phone
 * @property string $paypal_email
 * @property string $email
 * @property string $address
 * @property string $profile_description
 * @property string $lat
 * @property string $logn
 * @property string $sex
 * @property string $private_email
 * @property integer $profile_picture_media_file_id
 * @property integer $email_newsletter
 * @property string $reset_password_key
 * @property string $reset_password_timestamp
 * @property string $last_login_datetime
 * @property integer $email_address_verified
 * @property integer $status
 * @property string $created_on
 * @property string $modified_on
 */
class Users extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profile_picture_media_file_id, email_newsletter, email_address_verified, status', 'numerical', 'integerOnly'=>true),
			array('firstname, lastname, username, password, register_surce, paypal_email, email, lat, logn, private_email, reset_password_key', 'length', 'max'=>1000),
			array('phone', 'length', 'max'=>100),
			array('sex', 'length', 'max'=>6),
			array('date_of_birth, address, profile_description, reset_password_timestamp, last_login_datetime, created_on, modified_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, firstname, lastname, username, password, register_surce, date_of_birth, phone, paypal_email, email, address, profile_description, lat, logn, sex, private_email, profile_picture_media_file_id, email_newsletter, reset_password_key, reset_password_timestamp, last_login_datetime, email_address_verified, status, created_on, modified_on', 'safe', 'on'=>'search'),
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
				'profile_picture_MediaFile' => array(self::BELONGS_TO, 'MediaFiles', 'profile_picture_media_file_id'),
				'roles' => array(self::MANY_MANY, 'Roles', 'user_roles(user_id, role_id)'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'username' => 'Username',
			'password' => 'Password',
			'register_surce' => 'Register Surce',
			'date_of_birth' => 'Date Of Birth',
			'phone' => 'Phone',
			'paypal_email' => 'Paypal Email',
			'email' => 'Email',
			'address' => 'Address',
			'profile_description' => 'Profile Description',
			'lat' => 'Lat',
			'logn' => 'Logn',
			'sex' => 'Sex',
			'private_email' => 'Private Email',
			'profile_picture_media_file_id' => 'Profile Picture Media File',
			'email_newsletter' => 'Email Newsletter',
			'reset_password_key' => 'Reset Password Key',
			'reset_password_timestamp' => 'Reset Password Timestamp',
			'last_login_datetime' => 'Last Login Datetime',
			'email_address_verified' => 'Email Address Verified',
			'status' => 'Status',
			'created_on' => 'Created On',
			'modified_on' => 'Modified On',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('register_surce',$this->register_surce,true);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('paypal_email',$this->paypal_email,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('profile_description',$this->profile_description,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('logn',$this->logn,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('private_email',$this->private_email,true);
		$criteria->compare('profile_picture_media_file_id',$this->profile_picture_media_file_id);
		$criteria->compare('email_newsletter',$this->email_newsletter);
		$criteria->compare('reset_password_key',$this->reset_password_key,true);
		$criteria->compare('reset_password_timestamp',$this->reset_password_timestamp,true);
		$criteria->compare('last_login_datetime',$this->last_login_datetime,true);
		$criteria->compare('email_address_verified',$this->email_address_verified);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('modified_on',$this->modified_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		
		
		/**
	 * Function to get the full name of a user
	 * 
	 * @return string
	 */
	function getFullname()
	{
		return $this->firstname . " " . $this->lastname;
	}
	
	}
}