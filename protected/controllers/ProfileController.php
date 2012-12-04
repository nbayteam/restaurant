<?php

class ProfileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        
        /**
         * @var private user containing the associate User model instance
         */
        private $_user = null;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
                        'updateProfile + update', // check to ensure valid user ID
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Profile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			
			if($model->save())
			{
				//$this->uploadPhoto($model, $uploadedFile);
				//$model->picture->saveAs('images/uploads');
				
				//$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];

			$rnd = rand(0,9999);	// generate random number between 0-9999

			// Get selected image
			// Standardize extension and encrypt filename
			$uploadedFile = CUploadedFile::getInstance($model, 'picture');
			$extension = strtolower($uploadedFile->getExtensionName());
			$filename = md5(date('YmdHis') . $id) . "." . $extension;	// random number + filename
			$model->picture = $filename;

			// Check if profile image is set
			$currentProfile = Profile::model()->findByPk($id);
			$currentProfilePic = $currentProfile->picture;
			if(!is_null($currentProfilePic)) {
				@unlink(Yii::app()->params['imagePath'] . $id . '/' . $currentProfilePic);
				@unlink(Yii::app()->params['imagePath'] . $id . '/sm-' . $currentProfilePic);	
			}

			if($model->save()) {
				// Prepare upload directory
				$uploadDirectoryPath = 'images/uploads/' . $id;
				$uploadDirectory = Yii::app()->file->set($uploadDirectoryPath)->isdir;
				
				// Create directory if it doesn't exist
				if(!$uploadDirectory) {
					Yii::app()->file->createDir(0754, $uploadDirectoryPath);
				}

				Yii::import('application.vendors.wideImage.lib.WideImage');
				$uploadedFile->saveAs(Yii::app()->params['imagePath'] . $id .'/' . $filename);
				if($extension == "jpeg" || $extension == "gif" || $extension == "jpg"){
					WideImage::load(Yii::app()->params['imagePath'] . $id . '/' . $filename)->resizeDown(600, 600, 'outside')->saveToFile(Yii::app()->params['imagePath'] . $id . '/' . $filename, 80);
					WideImage::load(Yii::app()->params['imagePath'] . $id . '/' . $filename)->resizeDown(200, 200, 'outside')->saveToFile(Yii::app()->params['imagePath'] . $id . '/sm-' . $filename, 80);
				} else if ($extension == "png") {
					WideImage::load(Yii::app()->params['imagePath'] . $id . '/' . $filename)->resizeDown(600, 600, 'outside')->saveToFile(Yii::app()->params['imagePath'] . $id . '/' . $filename, 9);
					WideImage::load(Yii::app()->params['imagePath'] . $id . '/' . $filename)->resizeDown(200, 200, 'outside')->saveToFile(Yii::app()->params['imagePath'] . $id . '/sm-' . $filename, 9);
				}

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Profile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Profile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profile']))
			$model->attributes=$_GET['Profile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Profile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        /**
         * protected method to check logged in User model class
         * @user_id the primary identifier of the logged in User
         * @return object the User data model based on the primary key
         */
        protected function checkUser($user_id)
        {
            // if the user property is null, create it based on input id
            if($this->_user === null)
            {
                $this->_user = User::model()->findByPk($user_id);
                if($this->_user === null)
                {
                    throw new CHttpException(404, 'The requested profile does not exist.');
                } else if ($this->_user->id != Yii::app()->user->id) {
                    throw new CHttpException(404, 'You don\'t have permission to edit this profile.');
                }
            }
            return $this->_user;
        }
        
        /**
         * Filter to ensure valid user ID
         */
        public function filterUpdateProfile($filterChain)
        {
            // set the user identifier based on either GET or POST input
            // request variable, since we allow both types for our action
            $userId = null;
            if(isset($_GET['id']))
            {
                $userId = $_GET['id'];
            } else 
            {
                if(isset($_POST['id']))
                    $userId = $_POST['id'];
            }
            
            $this->checkUser($userId);
            
            // complete the running of other filters and execute the requested action
            $filterChain->run();
        }
        
        /**
         * Returns the user model instance  to which this profile belongs
         */
        public function getUser()
        {
            return $this->_user;
        }

        /**
        * Upload and crunch an image
        */
        public function updatePhoto($model, $selectedPhoto)
        {
        	if(is_object($selectedPhoto) && get_class($selectedPhoto) == 'CUploadedFile')
        	{
        		$extension = $model->image->getExtensionName();

        		// Generate a filename for the uploaded image based on a random number
        		// but check that the random number has not already been used
        		if($model->picture == '' or is_null($model->picture))
        		{
        			$n = 1;
        			// loop until random number is unique - which it probably is first time
        			while($n > 0) {
        				$random = dechex(rand()%99999999);
        				$picture = $model->property->ref . '_' . $random . '.' . $extension;
        				$n = Profile::model()->count('picture=:picture', array('picture'=>$picture));
        			}
        			$model->picture = $picture;
        		}
        	}
        }

}
