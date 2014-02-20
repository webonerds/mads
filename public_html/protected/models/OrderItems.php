<?php

/**
 * This is the model class for table "order_items".
 *
 * The followings are the available columns in table 'order_items':
 * @property integer $order_item_id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $quantity
 * @property string $unit_price
 * @property string $total_price
 * @property integer $created_by
 * @property string $created_on
 * @property integer $modified_by
 * @property string $modified_on
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 * @property Users $modifiedBy
 * @property Orders $order
 * @property Products $product
 */
class OrderItems extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_item_id, order_id, product_id, quantity, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('unit_price, total_price', 'length', 'max'=>6),
			array('created_on, modified_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_item_id, order_id, product_id, quantity, unit_price, total_price, created_by, created_on, modified_by, modified_on', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
			'itemsTotal'=>array(self::STAT,  'OrderItems', 'order_id', 'select' => 'SUM(total_price)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_item_id' => 'Order Item',
			'order_id' => 'Order',
			'product_id' => 'Product',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'total_price' => 'Total Price',
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

		$criteria->compare('order_item_id',$this->order_item_id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('modified_on',$this->modified_on,true);
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
	 * @return OrderItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
