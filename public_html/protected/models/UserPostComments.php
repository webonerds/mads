<?php

/**
 * This is the model class for table "user_post_comments".
 *
 * The followings are the available columns in table 'user_post_comments':
 * @property integer $user_post_comment_id
 * @property integer $post_id
 * @property string $comment
 * @property integer $active
 * @property integer $created_by
 * @property string $created_on
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 * @property UserPosts $post
 */
class UserPostComments extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_post_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_id, comment', 'required'),
			array('post_id, active, created_by', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_post_comment_id, post_id, comment, active, created_by, created_on', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'post' => array(self::BELONGS_TO, 'UserPosts', 'post_id'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_post_comment_id' => 'User Post Comment',
			'post_id' => 'Post',
			'comment' => 'Comment',
			'active' => 'Active',
			'created_by' => 'Created By',
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
		$criteria->compare('user_post_comment_id',$this->user_post_comment_id);
		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('date(created_on)',$this->created_on);
		$criteria->order='created_on desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getCreatorName($id)
	{
		$user=  Users::model()->findByPk($id);
		if (isset($user))
		{
			return $user->firstname. " ". $user->lastname;
		}
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPostComments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
