<?php

/**
 * This is the model class for table "tbl_review".
 *
 * The followings are the available columns in table 'tbl_review':
 * @property integer $id
 * @property integer $user_id
 * @property integer $business_id
 * @property string $title
 * @property string $description
 * @property double $rating
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property Business $business
 * @property User $user
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
			array('title, description, rating', 'required'),
			array('user_id, business_id', 'numerical', 'integerOnly'=>true),
			array('rating', 'numerical'),
			array('title', 'length', 'max'=>100),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, business_id, title, description, rating, create_date', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'description' => 'Description',
			'rating' => 'Rating',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('rating',$this->rating);
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
			$this->create_date = new CDbExpression('NOW()');
			$this->user_id = Yii::app()->user->id;
		}

		return parent::beforeValidate();
	}
}