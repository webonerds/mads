<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $product_id
 * @property string $code
 * @property string $brief
 * @property string $description
 * @property double $price
 * @property integer $active
 * @property integer $marked_delete
 * @property integer $product_picture_media_file_id
 * @property integer $created_by
 * @property string $created_on
 * @property integer $modified_by
 * @property string $modified_on
 *
 * The followings are the available model relations:
 * @property MediaFiles[] $mediaFiles
 * @property Users $createdBy
 * @property Users $modifiedBy
 * @property MediaFiles $productPictureMediaFile
 */
class Products extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brief, description', 'required'),
			array('active, product_picture_media_file_id, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('code, brief', 'length', 'max'=>1000),
			array('created_on, modified_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_id, code, brief, description, price, active, product_picture_media_file_id, created_by, created_on, modified_by, modified_on,marked_delete', 'safe', 'on'=>'search'),
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
			'mediaFiles' => array(self::HAS_MANY, 'MediaFiles', 'product_id'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'updatedBy' => array(self::BELONGS_TO, 'Users', 'modified_by'),
			'product_picture_MediaFile' => array(self::BELONGS_TO, 'MediaFiles', 'product_picture_media_file_id', 'select' => 'filename, filepath, cdn_absolute_url'),
	
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Product',
			'code' => 'Code',
			'brief' => 'Brief',
			'description' => 'Description',
			'price' => 'Price',
			'active' => 'Active',
			'product_picture_media_file_id' => 'Product Picture',
			'marked_delete' => 'Marked Delete',
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

		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('brief',$this->brief,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('active',$this->active);
		$criteria->compare('product_picture_media_file_id',$this->product_picture_media_file_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('modified_on',$this->modified_on,true);
		if($this->marked_delete==1)
		{
			$criteria->condition="marked_delete is not null and marked_delete='1'";
		}
		else
		{
			$criteria->condition="marked_delete is  null or marked_delete='0'";
					
		}	
		$criteria->order="created_by desc";
		$criteria->order="modified_by desc";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
		$criteria->compare('product_id', $this->product_id);
		
		MediaFiles::model()->updateAll(array('product_id' => NULL, 'marked_delete' => 1), $criteria);
	}
}
