<?php

Yii::import('application.extensions.image.Image');

/**
 * This is the model class for table "tbl_photos_menu".
 *
 * The followings are the available columns in table 'tbl_photos_menu':
 * @property integer $id
 * @property integer $menu_id
 * @property integer $photo_id
 *
 * The followings are the available model relations:
 * @property Menu $menu
 * @property Photo $photo
 */
class PhotosMenu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PhotosMenu the static model class
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
		return 'tbl_photos_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id, photo_id', 'required'),
			array('menu_id, photo_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_id, photo_id', 'safe', 'on'=>'search'),
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
			'menu' => array(self::BELONGS_TO, 'Menu', 'menu_id'),
			'photo' => array(self::BELONGS_TO, 'Photo', 'photo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_id' => 'Menu',
			'photo_id' => 'Photo',
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
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('photo_id',$this->photo_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    public function afterSave()
    {
        //$this->addImages( );
        parent::afterSave( );
    }


    public function addImages( ) {
        //If we have pending images
        if( Yii::app( )->user->hasState( 'images' ) ) {
            $userImages = Yii::app( )->user->getState( 'images' );
            //Resolve the final path for our images
            $path = Yii::app( )->getBasePath( )."/../images/menus/{$this->menu_id}/";
            $thumbPath = Yii::app( )->getBasePath( )."/../images/menus/{$this->menu_id}/thumbs/";
            //Create the folder and give permissions if it doesnt exists
            if( !is_dir( $path ) ) {
                mkdir( $path );
                chmod( $path, 0777 );
            }
            if( !is_dir( $thumbPath ) ) {
                mkdir( $thumbPath );
                chmod( $thumbPath, 0777 );
            }

            //Now lets create the corresponding models and move the files
            foreach( $userImages as $image ) {
                // original image
                if( is_file( $image["path"] ) ) {
                    if( copy( $image["path"], $path.$image["filename"] ) ) {
                        chmod( $path.$image["filename"], 0777 );
                    }
                } else {
                    //You can also throw an execption here to rollback the transaction
                    Yii::log( $image["path"]." is not a file", CLogger::LEVEL_WARNING );
                }

                // thumbnail
                if( is_file( $image["thumb"] ) ) {
                    if( copy( $image["thumb"], $thumbPath.$image["filename"] ) ) {
                        chmod( $thumbPath.$image["filename"], 0777 );
                    }
                } else {
                    //You can also throw an execption here to rollback the transaction
                    Yii::log( $image["path"]." is not a file", CLogger::LEVEL_WARNING );
                }
            }
            //Clear the user's session
            Yii::app( )->user->setState( 'images', null );
            Yii::app( )->user->setState( 'addPhotosTo', null );
        }
    }
}
