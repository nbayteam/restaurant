<?php

/**
 * This is the model class for table "tbl_business".
 *
 * The followings are the available columns in table 'tbl_business':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $address
 * @property string $geolocation
 * @property double $rating
 * @property string $google_id
 * @property string $update_date
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property BusinessType $type0
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
			array('name, type, address', 'required'),
			array('rating', 'numerical'),
			array('name, google_id', 'length', 'max'=>100),
			array('address', 'length', 'max'=>255),
			array('geolocation', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, address, geolocation, rating, google_id, update_date, create_date', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'address' => 'Address',
			'geolocation' => 'Geolocation',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('geolocation',$this->geolocation,true);
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
}