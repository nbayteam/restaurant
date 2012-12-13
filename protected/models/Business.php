<?php

/**
 * This is the model class for table "tbl_business".
 *
 * The followings are the available columns in table 'tbl_business':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $type
 * @property string $picture
 * @property string $address
 * @property string $phone
 * @property string $geolocation
 * @property integer $price
 * @property integer $category
 * @property integer $cuisine
 * @property string $opening_hours
 * @property string $payment
 * @property integer $attire
 * @property integer $ambience
 * @property string $groups_option
 * @property string $kids_option
 * @property string $website
 * @property string $menu
 * @property string $facebook
 * @property string $twitter
 * @property double $rating
 * @property string $google_id
 * @property string $update_date
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property BusinessType $type0
 * @property CategoryType $category0
 * @property PriceType $price0
 * @property CuisineType $cuisine0
 * @property AttireType $attire0
 * @property AmbienceType $ambience0
 * @property Review[] $reviews
 */
class Business extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Business the static model class
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
		return 'tbl_business';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, groups_option, kids_option, update_date, create_date', 'required'),
			array('type, price, category, cuisine, attire, ambience', 'numerical', 'integerOnly'=>true),
			array('rating', 'numerical'),
			array('name, google_id', 'length', 'max'=>100),
			array('description, picture, address', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>10),
			array('geolocation, payment, website, menu, facebook, twitter', 'length', 'max'=>50),
			array('opening_hours', 'length', 'max'=>83),
			array('groups_option, kids_option', 'length', 'max'=>3),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, type, picture, address, phone, geolocation, price, category, cuisine, opening_hours, payment, attire, ambience, groups_option, kids_option, website, menu, facebook, twitter, rating, google_id, update_date, create_date', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'BusinessType', 'type'),
			'category' => array(self::BELONGS_TO, 'CategoryType', 'category'),
			'price' => array(self::BELONGS_TO, 'PriceType', 'price'),
			'cuisine' => array(self::BELONGS_TO, 'CuisineType', 'cuisine'),
			'attire' => array(self::BELONGS_TO, 'AttireType', 'attire'),
			'ambience' => array(self::BELONGS_TO, 'AmbienceType', 'ambience'),
			'reviews' => array(self::HAS_MANY, 'Review', 'business_id',
				'order'=>'reviews.date_added DESC'),
			'reviewCount' => array(self::STAT, 'Review', 'business_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'type' => 'Type',
			'picture' => 'Picture',
			'address' => 'Address',
			'phone' => 'Phone',
			'geolocation' => 'Geolocation',
			'price' => 'Price',
			'category' => 'Category',
			'cuisine' => 'Cuisine',
			'opening_hours' => 'Opening Hours',
			'payment' => 'Payment',
			'attire' => 'Attire',
			'ambience' => 'Ambience',
			'groups_option' => 'Groups Option',
			'kids_option' => 'Kids Option',
			'website' => 'Website',
			'menu' => 'Menu',
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'rating' => 'Rating',
			'google_id' => 'Google',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('geolocation',$this->geolocation,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('category',$this->category);
		$criteria->compare('cuisine',$this->cuisine);
		$criteria->compare('opening_hours',$this->opening_hours,true);
		$criteria->compare('payment',$this->payment,true);
		$criteria->compare('attire',$this->attire);
		$criteria->compare('ambience',$this->ambience);
		$criteria->compare('groups_option',$this->groups_option,true);
		$criteria->compare('kids_option',$this->kids_option,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('menu',$this->menu,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('google_id',$this->google_id,true);
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
		} else {
			// Not a new record so just update the last updated time
			$this->update_date = new CDbExpression('NOW()');
		}

		return parent::beforeValidate();
	}

	/**
	* @return string the type text display for the current business
	*/
	public function getTypeText()
	{
		$typeOptions = CHtml::listData(BusinessType::model()->findAll(), 'id', 'name');
		return isset($typeOptions[$this->type]) ? $typeOptions[$this->type] : "unknown status ({$this->type})";
	}

	/**
	* @return string the price text display for the current business
	*/
	public function getPriceText()
	{
		$priceOptions = CHtml::listData(PriceType::model()->findAll(), 'id', 'name');
		return isset($priceOptions[$this->price]) ? $priceOptions[$this->price] : "unknown status ({$this->price})";
	}

	/**
	* @return string the category text display for the current business
	*/
	public function getCategoryText()
	{
		$categoryOptions = CHtml::listData(CategoryType::model()->findAll(), 'id', 'name');
		return isset($categoryOptions[$this->category]) ? $categoryOptions[$this->category] : "unknown status ({$this->category})";
	}

	/**
	* @return string the cuisine text display for the current business
	*/
	public function getCuisineText()
	{
		$cuisineOptions = CHtml::listData(CuisineType::model()->findAll(), 'id', 'name');
		return isset($cuisineOptions[$this->cuisine]) ? $cuisineOptions[$this->cuisine] : "unknown status ({$this->cuisine})";
	}

	/**
	* @return string the attire text display for the current business
	*/
	public function getAttireText()
	{
		$attireOptions = CHtml::listData(AttireType::model()->findAll(), 'id', 'name');
		return isset($attireOptions[$this->attire]) ? $attireOptions[$this->attire] : "unknown status ({$this->attire})";
	}

	/**
	* @return string the ambience text display for the current business
	*/
	public function getAmbienceText()
	{
		$ambienceOptions = CHtml::listData(AmbienceType::model()->findAll(), 'id', 'name');
		return isset($ambienceOptions[$this->ambience]) ? $ambienceOptions[$this->ambience] : "unknown status ({$this->ambience})";
	}
}