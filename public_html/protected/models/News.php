<?php
/**
 * @file       News.php$
 * @created    04/02/2014 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij
 */

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $news_id
 * @property string $news_title
 * @property string $brief
 * @property string $description
 * @property integer $display_order
 * @property integer $active
 * @property integer $created_by
 * @property string $created_on
 * @property integer $modified_by
 * @property string $modified_on
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 * @property Users $modifiedBy
 */
class News extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('news_title, brief, description, display_order', 'required'),
			array('display_order, active, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('news_title', 'length', 'max'=>255),
			array('picture_media_file_id', 'file', 
					'types'=>'jpg,png,jpeg',
					'maxSize'=>1024 * 2000, // 800kB
					'tooLarge'=>'Please upload a smaller file.',
					'allowEmpty'=>1,
					),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('news_id, news_title, brief, description, display_order, active, created_by, created_on, modified_by, modified_on', 'safe', 'on'=>'search'),
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
			'modifiedBy' => array(self::BELONGS_TO, 'Users', 'modified_by'),
			'picture_MediaFile' => array(self::BELONGS_TO, 'MediaFiles', 'picture_media_file_id', 'select' => 'filename, filepath, cdn_absolute_url'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'news_id' => 'News',
			'news_title' => 'News Title',
			'brief' => 'Brief',
			'description' => 'Description',
			'display_order' => 'Display Order',
			'picture_media_file_id' => 'Picture',
			'active' => 'Active',
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

		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('news_title',$this->news_title,true);
		$criteria->compare('brief',$this->brief,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('display_order',$this->display_order);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('modified_on',$this->modified_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * @return bool
	 */
	protected function beforeDelete()
	{
		$this->unsetMediaFile();
		
		return parent::beforeDelete();
	}
	
	/**
	 * Function to unset the media file table for a news media files. 
	 * eg. when record is deleted
	 */
	public function unsetMediaFile()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('news_id', $this->news_id);
		
		MediaFiles::model()->updateAll(array('news_id' => NULL, 'marked_delete' => 1), $criteria);
	}
		
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
