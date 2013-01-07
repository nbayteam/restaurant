<?php

/**
 * This is the model class for table "tbl_photo".
 *
 * The followings are the available columns in table 'tbl_photo':
 * @property integer $id
 * @property integer $user_id
 * @property string $description
 * @property string $picture
 * @property string $primary
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property User $user
 * @property PhotosBusiness[] $photosBusinesses
 * @property PhotosMenu[] $photosMenus
 */
class Photo extends CActiveRecord
{
	public $file;
	public $mime_type;
    public $size;
    public $name;
    public $filename;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Photo the static model class
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
		return 'tbl_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, primary, create_date', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('description, picture', 'length', 'max'=>255),
			array('primary', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, description, picture, primary, create_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'photosBusinesses' => array(self::HAS_MANY, 'PhotosBusiness', 'photo_id'),
			'photosMenus' => array(self::HAS_MANY, 'PhotosMenu', 'photo_id'),
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
			'description' => 'Description',
			'picture' => 'Picture',
			'primary' => 'Primary',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('primary',$this->primary,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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

		$this->primary = "No";
        $this->create_date = new CDbExpression('NOW()');

		return parent::beforeValidate();
	}

	/**
     * Prepares user_id attributes before performing save.
     */
	protected function beforeSave()
	{
		$this->user_id = Yii::app()->user->id;
		$this->create_date = new CDbExpression('NOW()');

		return parent::beforeSave();
	}

	/**
	* Save images as user post photos
	*/
	protected function afterSave()
	{
		$this->saveImages();
		parent::afterSave();
	}

	/**
	* move photos to its respective folders
	*/
	public function saveImages()
	{
		// Check if we have pending images
		if(Yii::app()->user->hasState('images')) {
			$userImages = Yii::app()->user->getState('images');

			// Resolve the final path for our images
			$addPhotosTo = Yii::app()->user->getState('addPhotosTo');
            $addPhotosToType = $addPhotosTo[0];
            $addPhotosToId = $addPhotosTo[1];
			$path = Yii::app()->getBasePath() . "/../images/menus/{$addPhotosToId}/";
			$thumbsPath = Yii::app()->getBasePath() . "/../images/menus/{$addPhotosToId}/thumbs/";

			// --------------------------
            // Check and create directories
            // --------------------------
            if(!is_dir($path)) {
                mkdir($path, 0777, true);
                chmod ($path , 0777);
            }
            if(!is_dir($thumbsPath)) {
                mkdir($thumbsPath, 0777, true);
                chmod ($thumbsPath , 0777);
            }

            // Create corresponding models and move the files
            foreach($userImages as $image) {
            	if(is_file($image["path"])) {
            		if(rename($image["path"], $path.$image["filename"])) {
            			chmod($path.$image["filename"], 0777);
            		}
            		if(rename($image["thumb"], $thumbsPath.$image["filename"])) {
            			chmod($thumbsPath.$image["filename"], 0777);
            		}
            	} else {
            		// throw exception here to rollback the transaction
            		Yii::log($image["path"] . " is not a file", CLogger::LEVEL_WARNING);
            	}
            }

            // Clear the user's session
            Yii::app()->user->setState('images', null);
            //Yii::app()->user->setState('addPhotosTo', null);
		}
	}
}
