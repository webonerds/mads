<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $order_id
 * @property integer $user_id
 * @property string $total_price
 * @property string $total_shipping
 * @property string $status
 * @property string $type
 * @property string $total_gst
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property OrderItems[] $orderItems
 * @property Users $createdBy
 * @property Users $modifiedBy
 * @property Users $user
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	
	 public function beforeSave()
    {       
		 if ($this->total_price > 0)
		 $this->total_gst= $model->total_price/10;
		 
		 return parent::beforeSave();
	 }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id', 'required'),
			array('order_id, user_id, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('total_price, total_shipping, total_gst', 'length', 'max'=>6),
			array('created_on, modified_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_id, user_id, total_price, total_shipping, total_gst, created_on, created_by, modified_on, modified_by', 'safe', 'on'=>'search'),
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
			'orderItems' => array(self::HAS_MANY, 'OrderItems', 'order_id'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'numOfItems' => array(self::STAT, 'OrderItems', 'order_id'),
			'modifiedBy' => array(self::BELONGS_TO, 'Users', 'modified_by'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'itemsTotal'=>array(self::STAT,  'OrderItems', 'order_id', 'select' => 'SUM(total_price)'),
			'totalPrice'=>array(self::STAT,  'OrderItems', 'order_id', 'select' => 'SUM(total_price)'),
			
			'totalGstPrice'=>array(self::STAT,  'OrderItems', 'order_id', 'select' => ' cast(SUM(total_price)/10 as decimal(20,2))'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_id' => 'Order',
			'user_id' => 'User',
			'total_price' => 'Total Price',
			'total_shipping' => 'Total Shipping',
			'total_gst' => 'Total Gst',
			'created_on' => 'Created On',
			'created_by' => 'Created By',
			'modified_on' => 'Modified On',
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

		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('total_shipping',$this->total_shipping,true);
		$criteria->compare('total_gst',$this->total_gst,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status,true);
		
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by);
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
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
