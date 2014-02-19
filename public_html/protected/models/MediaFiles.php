<?php

/**
 * This is the model class for table "media_files".
 *
 * The followings are the available columns in table 'media_files':
 * @property integer $media_file_id
 * @property integer $user_id
 * @property integer $user_post_id
 * @property integer $product_id
 * @property integer $news_id
 * @property string $column_name
 * @property string $file_type
 * @property integer $image_width
 * @property integer $image_height
 * @property string $image_identifier
 * @property string $original_filename
 * @property string $filepath
 * @property string $filename
 * @property integer $filesize
 * @property string $filetype
 * @property string $cdn_absolute_url
 * @property integer $marked_delete
 * @property string $created_on
 * @property integer $created_by
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 */
class MediaFiles extends ActiveRecord
{
	public  $news_id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'media_files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('news_id, club_id, sport_id, user_id, image_width, image_height, filesize, marked_delete, created_by', 'numerical', 'integerOnly'=>true),
			array('column_name, filetype', 'length', 'max'=>50),
			array('file_type', 'length', 'max'=>5),
			array('image_identifier', 'length', 'max'=>4),
			array('original_filename, filepath, cdn_absolute_url', 'length', 'max'=>255),
			array('filename', 'length', 'max'=>100),
			array('created_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('media_file_id, asset_id, club_id, column_name, file_type, image_width, image_height, image_identifier, original_filename, filepath, filename, filesize, filetype, cdn_absolute_url, marked_delete, created_on, created_by', 'safe', 'on'=>'search'),
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
			'news' => array(self::BELONGS_TO, 'News', 'news_id'),
			
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'media_file_id' => 'Media File',
			'user_id' => 'User',
			'user_post_id' => 'Asset',
			'product_id' => 'Club',
			'news_id' => 'Sport',
			'column_name' => 'Column Name',
			'file_type' => 'File Type',
			'image_width' => 'Image Width',
			'image_height' => 'Image Height',
			'image_identifier' => 'Image Identifier',
			'original_filename' => 'Original Filename',
			'filepath' => 'Filepath',
			'filename' => 'Filename',
			'filesize' => 'Filesize',
			'filetype' => 'Filetype',
			'cdn_absolute_url' => 'Cdn Absolute Url',
			'marked_delete' => 'Marked Delete',
			'created_on' => 'Created On',
			'created_by' => 'Created By',
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

		$criteria->compare('media_file_id',$this->media_file_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_post_id',$this->user_post_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('column_name',$this->column_name,true);
		$criteria->compare('file_type',$this->file_type,true);
		$criteria->compare('image_width',$this->image_width);
		$criteria->compare('image_height',$this->image_height);
		$criteria->compare('image_identifier',$this->image_identifier,true);
		$criteria->compare('original_filename',$this->original_filename,true);
		$criteria->compare('filepath',$this->filepath,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('filesize',$this->filesize);
		$criteria->compare('filetype',$this->filetype,true);
		$criteria->compare('cdn_absolute_url',$this->cdn_absolute_url,true);
		$criteria->compare('marked_delete',$this->marked_delete);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MediaFiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function afterSave()
	{
		//lets store the media file for Post in the cache for future access
		$url = FALSE;
		
		if (!empty($this->cdn_absolute_url))
		{
			$url = $this->cdn_absolute_url;
		}
		else if (!empty($this->filename))
		{
			$url = Yii::app()->params["baseHttpPath"] . '/' . $this->filepath . '/' . $this->filename;
		}
		
		if ($url !== FALSE)
		{
			$referenceModelColumn = 'news_id';
			$referenceModelColumn = ($this->product_id > 0) ? 'product_id' : $referenceModelColumn;
			$referenceModelColumn = ($this->user_id > 0) ? 'user_id' : $referenceModelColumn;
			$referenceModelColumn = ($this->user_post_id > 0) ? 'user_post_id' : $referenceModelColumn;
		
	//		$this->storeMediaFileURLInCache($referenceModelColumn, $this->{$referenceModelColumn}, $this->column_name, $url, $this->image_identifier);
		}
				
		return parent::afterSave();
	}
	
	public static function _GetMediaFilesReferenceColumnName($model)
	{
		$modelClassName = get_class($model);
		
		$mediaFilesReferenceTableColumnName = FALSE;
		if ($modelClassName == 'News')
		{
			$mediaFilesReferenceTableColumnName = 'news_id';
		}
		else if ($modelClassName == 'Users')
		{
			$mediaFilesReferenceTableColumnName = 'user_id';
		}
		else if ($modelClassName == 'UserPosts')
		{
			$mediaFilesReferenceTableColumnName = 'user_post_id';
		}
		else if ($modelClassName == 'Products')
		{
			$mediaFilesReferenceTableColumnName = 'product_id';
		}
		
		return $mediaFilesReferenceTableColumnName;
	}
	
	/**
	 * Function to store the Media File URL in cache
	 * 
	 * @param string $referenceModelKey Model primary key column name eg asset_id, club_id
	 * @param string $referenceModelKeyValue Reference Model Primary Key Value
	 * @param string $referenceModelColumn Reference Model Column (eg. asset, club_flag)
	 * @param string $url URL of the Image
	 * @param string $imageIdentifier Image Identifier default 'Orig'
	 */
	 
	 
/*	public static function storeMediaFileURLInCache($referenceModelKey, $referenceModelKeyValue, $referenceModelColumn, $url, $imageIdentifier = 'Orig')
	{
		Yii::app()->cache->set("MediaFile-{$referenceModelKey}-{$referenceModelKeyValue}-{$referenceModelColumn}-{$imageIdentifier}", $url, AppConstants::ONE_MONTH_CACHE_TIME);
	}
	
*/
	/**
	 * Function to get the Media File URL from cache.
	 * 
	 * @param string $referenceModelKey Model primary key column name eg asset_id, club_id
	 * @param string $referenceModelKeyValue Reference Model Primary Key Value
	 * @param string $referenceModelColumn Reference Model Column (eg. asset, club_flag)
	 * @return string will return boolean FALSE if cache is not found
	 */
/*	public static function ($referenceModelKey, $referenceModelKeyValue, $referenceModelColumn, $imageIdentifier = 'Orig')
	{
		return Yii::app()->cache->get("MediaFile-{$referenceModelKey}-{$referenceModelKeyValue}-{$referenceModelColumn}-{$imageIdentifier}");	
	}
	*/
}
