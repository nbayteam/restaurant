<?php

/**
 * This is the model class for table "tbl_menu".
 *
 * The followings are the available columns in table 'tbl_menu':
 * @property integer $id
 * @property integer $business_id
 * @property string $category
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $status
 * @property string $update_date
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property Business $business
 * @property PhotosMenu[] $photosMenus
 */
class Menu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
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
		return 'tbl_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('business_id, category, name, price, status, update_date, create_date', 'required'),
			array('business_id', 'numerical', 'integerOnly'=>true),
			array('category', 'length', 'max'=>25),
			array('name', 'length', 'max'=>100),
			array('price', 'length', 'max'=>6),
			array('status', 'length', 'max'=>10),
            array('description', 'length', 'max'=>400),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, business_id, category, name, description, price, status, update_date, create_date', 'safe', 'on'=>'search'),
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
			'business' => array(self::BELONGS_TO, 'Business', 'business_id'),
			'photosMenus' => array(self::HAS_MANY, 'PhotosMenu', 'menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'business_id' => 'Business',
			'category' => 'Category',
			'name' => 'Name',
			'description' => 'Description',
			'price' => 'Price',
			'status' => 'Status',
			'update_date' => 'Update Date',
			'create_date' => 'Create Date',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('business_id',$this->business_id);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
     * Prepares create_date, update_date attributes before performing validation.
     */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			// Set create_date, user_id adding the review
			$this->create_date = $this->update_date = new CDbExpression('NOW()');
			$this->status = "Non-active";
		} else {
			// Not a new record so just update the last updated time
			$this->update_date = new CDbExpression('NOW()');
		}

		return parent::beforeValidate();
	}

	/**
	* @return string the category text display for the current menu
	*/
	public function getCategoryText()
	{
		$categoryOptions = CHtml::listData(MenuCategory::model()->findAll(), 'id', 'name');
		return isset($categoryOptions[$this->category]) ? $categoryOptions[$this->category] : "-";
	}
}
