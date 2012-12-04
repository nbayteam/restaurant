<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property integer $user_type
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property UserType $userType
 * @property Profile[] $tblProfiles
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
            array('username', 'unique'),
			array('user_type', 'numerical', 'integerOnly'=>true),
			array('username, create_date', 'length', 'max'=>45),
			array('password', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, user_type, user_key, create_date', 'safe', 'on'=>'search'),
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
            'profiles' => array(self::HAS_ONE, 'Profile', 'user_id'),
			'userType' => array(self::BELONGS_TO, 'UserType', 'user_type'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Email Address',
			'password' => 'Password',
			'user_type' => 'User Type',
            'user_key' => 'User Key',
            'last_login_time' => 'Last Login Time',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    /**
     * prepares create_time attribute before performing validation
     */
    protected function beforeValidate() {
        if($this->isNewRecord) {
            $this->create_date = new CDbExpression('NOW()');
        }
        return parent::beforeValidate();
    }
    
    /**
     * perform one-way encryption on the password before we store it in database
     */
    protected function afterValidate() {
        parent::afterValidate();
        $this->password = $this->encrypt($this->password);
        $this->user_type = 1;
    }
    
    public function encrypt($value)
    {
        return md5($value);
    }
    
     /** Returns encrypted value of $value using base_64_encode where usnique key is user's password
      * @param string $value: value to be encrypted.
      * @return string: encrypted $value
      */
    public function encryptLink($value)
    {
        $key = $this->password;
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $value, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    }
    
    /**
     * Returns decrypted value of $value using base_64_encode where usnique key is user's password
     * @param string $value: value to be decrypted.
     * @return string: decrypted $value
     */
    public function decryptLink($value)
    {
        $key = $this->password;
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($value), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted;
    }

}