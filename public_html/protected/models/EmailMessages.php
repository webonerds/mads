<?php

/**
 * This is the model class for table "email_messages".
 *
 * The followings are the available columns in table 'email_messages':
 * @property integer $email_message_id
 * @property integer $parent_email_message_id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property string $to_email
 * @property string $subject
 * @property string $message
 * @property string $body_contents
 * @property integer $sent_successful
 * @property integer $message_replied
 * @property integer $mark_as_read
 * @property string $created_on
 *
 * The followings are the available model relations:
 * @property Users $fromUser
 * @property EmailMessages $parentEmailMessage
 * @property EmailMessages[] $emailMessages
 * @property Users $toUser
 */
class EmailMessages extends ActiveRecord
{
	public $totalCount;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'email_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_on, subject, message', 'required'),
			array('parent_email_message_id, from_user_id, to_user_id, sent_successful, message_replied, mark_as_read', 'numerical', 'integerOnly'=>true),
			array('to_email, subject', 'length', 'max'=>255),
			array('message, body_contents', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('email_message_id, parent_email_message_id, from_user_id, to_user_id, to_email, subject, message, body_contents, sent_successful, message_replied, created_on', 'safe', 'on'=>'search'),
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
			'fromUser' => array(self::BELONGS_TO, 'Users', 'from_user_id'),
			'parentEmailMessage' => array(self::BELONGS_TO, 'EmailMessages', 'parent_email_message_id'),
			'emailMessages' => array(self::HAS_MANY, 'EmailMessages', 'parent_email_message_id'),
			'toUser' => array(self::BELONGS_TO, 'Users', 'to_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'email_message_id' => 'Email Message',
			'parent_email_message_id' => 'Parent Email Message',
			'from_user_id' => 'From User',
			'to_user_id' => 'To User',
			'to_email' => 'To Email',
			'subject' => 'Subject',
			'message' => 'Message',
			'body_contents' => 'Body Contents',
			'sent_successful' => 'Sent Successful',
			'message_replied' => 'Message Replied',
			'mark_as_read' => 'Mark as Read',
			'created_on' => 'Created On',
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

		$criteria->compare('email_message_id',$this->email_message_id);
		$criteria->compare('parent_email_message_id',$this->parent_email_message_id);
		$criteria->compare('from_user_id',$this->from_user_id);
		$criteria->compare('to_user_id',$this->to_user_id);
		$criteria->compare('to_email',$this->to_email,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('body_contents',$this->body_contents,true);
		$criteria->compare('sent_successful',$this->sent_successful);
		$criteria->compare('message_replied',$this->message_replied);
		$criteria->compare('created_on',$this->created_on,true);
		
		$criteria->with = array("fromUser" => array("select" => "firstname, lastname"),
								"toUser" => array("select" => "firstname, lastname"),
							);
		$criteria->together = TRUE;
		//$criteria->order = 't.created_on desc';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>'t.created_on desc'),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmailMessages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Gets Unread messages count
	 * 
	 * @param Integer $toUserId
	 * @return type
	 */
	public static function getUnreadMessagesCount($toUserId)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'email_message_id';
		$criteria->distinct = TRUE;
		$criteria->compare('to_user_id', $toUserId);
		$criteria->compare('t.mark_as_read', 0);	//Unread messages only
		$criteria->addCondition('from_user_id IS NOT NULL');
		
		$dependency = new CDbCacheDependency('SELECT MAX(created_on) FROM email_messages WHERE to_user_id = ' . $toUserId);
		
		return EmailMessages::model()->cache(AppConstants::ONE_MONTH_CACHE_TIME, $dependency)->count($criteria);
	}
	
	/**
	 * Returns the messages page to inbox as per provided userId
	 * 
	 * @param Integer $userId
	 * @param Integer $page
	 * @return EmailMessages
	 */
	public static function getInboxMessagesByUser($userId, $page = 1)
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'email_message_id DESC';
		$criteria->compare('to_user_id', $userId);
		$criteria->addCondition('from_user_id IS NOT NULL');
		$criteria->with = array('fromUser' => array(
			'select' => 'username, firstname, lastname, user_id, profile_picture_media_file_id'
			, 'joinType' => 'INNER JOIN'
			, 'with' => array(
				'profile_picture_MediaFile' => array(
					'select' => 'filepath, filename, cdn_absolute_url'
					)
				)
			)
		);
		
		$criteria->offset = ($page - 1) * AppConstants::INBOX_MESSSAGES_LIMIT;
		
		$criteria->limit = AppConstants::INBOX_MESSSAGES_LIMIT;
		
		$dependency = new CDbCacheDependency('SELECT MAX(created_on) FROM email_messages WHERE to_user_id = ' . $userId);
		
		return EmailMessages::model()->cache(AppConstants::ONE_MONTH_CACHE_TIME, $dependency)->findAll($criteria);
	}
}
