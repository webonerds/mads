<?php

/**
 * This is the model class for table "user_posts".
 *
 * The followings are the available columns in table 'user_posts':
 * @property integer $user_post_id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $post_type
 * @property integer $picture_thumb_media_file_id
 * @property integer $picture_media_file_id
 * @property string $comment
 * @property string $story_background_colour
 * @property string $story_font_style
 * @property integer $is_public
 * @property integer $active
 * @property integer $total_likes
 * @property integer $total_shares
 * @property integer $reported_abuse
 * @property integer $created_by
 * @property string $created_on
 * @property integer $modified_by
 * @property string $modified_on
 *
 * The followings are the available model relations:
 * @property UserActivities[] $userActivities
 * @property UserPostComments[] $userPostComments
 * @property Categories $category
 * @property Users $createdBy
 * @property Users $modifiedBy
 * @property MediaFiles $pictureMediaFile
 * @property MediaFiles $pictureThumbMediaFile
 * @property Users $user
 */
class UserPosts extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_posts';
	}

	/**
	* Behaviors for this model
	*/
   public function behaviors(){
	 return array(
	   
		'sanitize' => array(
			'class'=>'frontend.extensions.behaviors.SanitizeBehavior',
			'purifyFields' => array('comment'),
			'stripcleanFields' => array('*'),
			'exceptFields' => array('user_post_id'),
		)
	 );
   }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment','required'),
			
			array('picture_media_file_id', 'file', 
					'types'=>'jpg,png,jpeg',
					'maxSize'=>1024 * 2000, // 800kB
					'tooLarge'=>'Please upload a smaller file.',
					'allowEmpty'=>1,
					),
			array('user_id, category_id, picture_thumb_media_file_id, picture_media_file_id, is_public, active, total_likes, total_shares, reported_abuse, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('post_type', 'length', 'max'=>7),
			array('story_background_colour, story_font_style', 'length', 'max'=>20),
			array('comment, created_on, modified_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_post_id, user_id, category_id, post_type, picture_thumb_media_file_id, picture_media_file_id, comment, story_background_colour, story_font_style, is_public, active, total_likes, total_shares, reported_abuse, created_by, created_on, modified_by, modified_on', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by', 'joinType' => 'INNER JOIN', 'select' => 'user_id, firstname, lastname, username, profile_picture_media_file_id, goodcall_count_received, register_source'),
			'fansuniteTopic' => array(self::BELONGS_TO, 'Topics', 'fansunite_topic_id'),
			'modifiedBy' => array(self::BELONGS_TO, 'Users', 'modified_by'),
			'picture_MediaFile' => array(self::BELONGS_TO, 'MediaFiles', 'picture_media_file_id', 'select' => 'filename, filepath, cdn_absolute_url'),
		//	'comments' => array(self::HAS_MANY, 'UserPostComments', 'post_id'),
            'numComments' => array(self::STAT, 'UserPostComments', 'post_id'),
			'user'=>array(self::BELONGS_TO,'Users','created_by'),
			);
	}

	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_post_id' => 'User Post',
			'user_id' => 'User',
			'category_id' => 'Category',
			'post_type' => 'Post Type',
			'picture_thumb_media_file_id' => 'Picture Thumb Media File',
			'picture_media_file_id' => 'Picture Media File',
			'comment' => 'Comment',
			'story_background_colour' => 'Story Background Colour',
			'story_font_style' => 'Story Font Style',
			'is_public' => 'Is Public',
			'active' => 'Active',
			'total_likes' => 'Total Likes',
			'total_shares' => 'Total Shares',
			'reported_abuse' => 'Reported Abuse',
			'created_by' => 'Created By',
			'created_on' => 'Created On',
			'modified_by' => 'Modified By',
			'modified_on' => 'Modified On',
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

		$criteria->compare('user_post_id',$this->user_post_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('post_type',$this->post_type,true);
		$criteria->compare('picture_thumb_media_file_id',$this->picture_thumb_media_file_id);
		$criteria->compare('picture_media_file_id',$this->picture_media_file_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('story_background_colour',$this->story_background_colour,true);
		$criteria->compare('story_font_style',$this->story_font_style,true);
		$criteria->compare('is_public',$this->is_public);
		$criteria->compare('active',$this->active);
		$criteria->compare('total_likes',$this->total_likes);
		$criteria->compare('total_shares',$this->total_shares);
		$criteria->compare('reported_abuse',$this->reported_abuse);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('modified_on',$this->modified_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public function latestStoryPosts()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('post_type','story');
		$criteria->order="created_on desc";
		$criteria->limit='5';
		return new CActiveDataProvider($this, array(
			'pagination'=>FALSE,
			'criteria'=>$criteria,
		));
	}
	
	public function latestPicturePosts()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('post_type','picture');
		$criteria->order="created_on desc";
		$criteria->limit='5';
		return new CActiveDataProvider($this, array(
			'pagination'=>FALSE,
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPosts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
