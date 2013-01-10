<?php

/**
 * This is the model class for table "tbl_review".
 *
 * The followings are the available columns in table 'tbl_review':
 * @property integer $id
 * @property integer $user_id
 * @property integer $business_id
 * @property string $description
 * @property double $rating
 * @property double $rating2
 * @property double $rating3
 * @property double $rating4
 * @property string $source
 * @property integer $price
 * @property integer $ambience
 * @property string $noise_level
 * @property string $parking
 * @property string $good_type_meal
 * @property string $groups_option
 * @property string $kids_option
 * @property string $delivery
 * @property string $reservation
 * @property string $credit_cards
 * @property string $take_out
 * @property string $waiter_service
 * @property string $outdoor_seating
 * @property string $wifi
 * @property string $alcohol
 * @property string $tv
 * @property string $cater
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Business $business
 * @property User $userPriceType $price
 * @property AmbienceType $ambience
 */
class Review extends CActiveRecord
{

	const RATE_0 = 0;
	const RATE_1 = 1;
	const RATE_2 = 2;
	const RATE_3 = 3;
	const RATE_4 = 4;
	const RATE_5 = 5;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Review the static model class
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
		return 'tbl_review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, business_id, description, rating, rating2, rating3, rating4, price, ambience, create_date', 'required'),
			array('user_id, business_id, price, ambience', 'numerical', 'integerOnly'=>true),
			array('rating, rating2, rating3, rating4', 'numerical'),
			array('source, noise_level, parking, good_type_meal, groups_option, kids_option, delivery, reservation, credit_cards, take_out, waiter_service, outdoor_seating, wifi, alcohol, tv, cater', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, business_id, description, rating, rating2, rating3, rating4, source, price, ambience, noise_level, parking, good_type_meal, groups_option, kids_option, delivery, reservation, credit_cards, take_out, waiter_service, outdoor_seating, wifi, alcohol, tv, cater, create_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'price' => array(self::BELONGS_TO, 'PriceType', 'price'),
			'ambience' => array(self::BELONGS_TO, 'AmbienceType', 'ambience'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'business_id' => 'Business',
			'description' => 'Description',
			'rating' => 'Dish Rating',
			'rating2' => 'Ambience Rating',
			'rating3' => 'Service Rating',
			'rating4' => 'Overall Rating',
			'source' => 'Source',
			'price' => 'Price',
			'ambience' => 'Ambience',
			'noise_level' => 'Noise Level',
			'parking' => 'Parking',
			'good_type_meal' => 'Good Type Meal',
			'groups_option' => 'Groups Option',
			'kids_option' => 'Kids Option',
			'delivery' => 'Delivery',
			'reservation' => 'Reservation',
			'credit_cards' => 'Credit Cards',
			'take_out' => 'Take Out',
			'waiter_service' => 'Waiter Service',
			'outdoor_seating' => 'Outdoor Seating',
			'wifi' => 'Wifi',
			'alcohol' => 'Alcohol',
			'tv' => 'Tv',
			'cater' => 'Cater',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('business_id',$this->business_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('rating2',$this->rating2);
		$criteria->compare('rating3',$this->rating3);
		$criteria->compare('rating4',$this->rating4);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('ambience',$this->ambience);
		$criteria->compare('noise_level',$this->noise_level,true);
		$criteria->compare('parking',$this->parking,true);
		$criteria->compare('good_type_meal',$this->good_type_meal,true);
		$criteria->compare('groups_option',$this->groups_option,true);
		$criteria->compare('kids_option',$this->kids_option,true);
		$criteria->compare('delivery',$this->delivery,true);
		$criteria->compare('reservation',$this->reservation,true);
		$criteria->compare('credit_cards',$this->credit_cards,true);
		$criteria->compare('take_out',$this->take_out,true);
		$criteria->compare('waiter_service',$this->waiter_service,true);
		$criteria->compare('outdoor_seating',$this->outdoor_seating,true);
		$criteria->compare('wifi',$this->wifi,true);
		$criteria->compare('alcohol',$this->alcohol,true);
		$criteria->compare('tv',$this->tv,true);
		$criteria->compare('cater',$this->cater,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
    * @return array review rating value indexed by type IDs
    */
    public function getRatingOption()
    {
    	return array(
    		self::RATE_0=>'Select a Rating',
    		self::RATE_1=>'1',
    		self::RATE_2=>'2',
    		self::RATE_3=>'3',
    		self::RATE_4=>'4',
    		self::RATE_5=>'5',
    	);
    }

	/**
     * Prepares create_date, user_id attributes before performing validation.
     */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			// Set create_date, user_id adding the review
			$this->user_id = Yii::app()->user->id;
		}
        $this->create_date = new CDbExpression('NOW()');

		return parent::beforeValidate();
	}
}
