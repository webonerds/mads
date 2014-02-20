<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $page_id
 * @property string $page_title
 * @property string $page_slug
 * @property string $page_content
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $active
 * @property string $creatgetYesNoFilterArrayed_on
 * @property string $modified_on
 * @property integer $created_by
 * @property integer $modified_by
 */
class Pages extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pages';
	}
	
	/**
	* Behaviors for this model
	*/
   public function behaviors(){
	 return array(
	   'sluggable' => array(
		 'class'=>'frontend.extensions.behaviors.SluggableBehavior',
		 'columns' => array('page_slug'),
		 'slugColumn' => 'page_slug',
		 'unique' => true,
		 'update' => true,
	   ),
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
			array('page_title, page_slug, page_content, active', 'required'),
			array('active, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('page_title, page_slug, meta_title', 'length', 'max'=>255),
			array('meta_title, meta_keywords, meta_description, created_on, modified_on, created_by, modified_by', 'safe'),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('page_id, page_title, page_slug, page_content, meta_title, meta_keywords, meta_description, active, created_on, modified_on, created_by, modified_by', 'safe', 'on'=>'search'),
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
			'club' => array(self::BELONGS_TO, 'Clubs', 'club_id'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'modifiedBy' => array(self::BELONGS_TO, 'Users', 'modified_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'page_id' => 'Page',
			'page_title' => 'Page Title',
			'page_slug' => 'Page Slug',
			'page_content' => 'Page Content',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'active' => 'Active',
			'created_on' => 'Created On',
			'modified_on' => 'Modified On',
			'created_by' => 'Created By',
			'modified_by' => 'Modified By',
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

		$criteria->compare('page_id',$this->page_id);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_slug',$this->page_slug,true);
		$criteria->compare('page_content',$this->page_content,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_by',$this->modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
