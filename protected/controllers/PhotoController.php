<?php

Yii::import("ext.EPhpThumb.EPhpThumb");

class PhotoController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
      * @var private property containing the associated Business model instance. */
    private $_menu = null;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions'=>array('index','view', 'postPhotos'),
                'users'=>array('*'),
         ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','uploadPhotos', 'postPhotos'),
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
        $model=new Photo;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Photo']))
        {
            $model->attributes=$_POST['Photo'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
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

        if(isset($_POST['Photo']))
        {
            $model->attributes=$_POST['Photo'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
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
        $dataProvider=new CActiveDataProvider('Photo');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
     ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Photo('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Photo']))
            $model->attributes=$_GET['Photo'];

        $this->render('admin',array(
            'model'=>$model,
     ));
    }

    /**
    * Creates a new model.
    * If creation is successful, the browser will display the models.
    */
    public function actionPostPhotos()
    {
        // Yii::import("xupload.models.XUploadForm");
        $path = realpath(Yii::app()->getBasePath()."/../images/") . "/tmp/";
        $thumbsPath = realpath(Yii::app()->getBasePath()."/../images/") . "/tmp/thumbs/";
        $publicPath = Yii::app()->getBaseUrl()."/images/tmp/";
        $privatePath = realpath(Yii::app()->getBasePath()."/../images")."/";
        $privateThumbPath = realpath(Yii::app()->getBasePath()."/../images")."/";

        // --------------------------
        // Original path checking
        // --------------------------
        Yii::log('Path value is ' . $path);
        Yii::log('thumbsPath value is ' . $thumbsPath);

        header('Vary: Accept');
        if(isset($_SERVER['HTTP_ACCEPT'])
            && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        if(isset($_GET["_method"])) {
            if($_GET["_method"] == "delete") {
                $success = is_file($_GET["file"]) && $_GET["file"][0] !== '.' && unlink($_GET["file"]);
                echo json_encode($success);
            }
        } else {
            $this->init();
            $model = new Photo;   //Here we instantiate our model
 
            //We get the uploaded instance
            $model->file = CUploadedFile::getInstance($model, 'file');
            
            if($model->file !== null) {
                Yii::log('file != null');
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                //(optional) Generate a random name for our file
                $filename = md5(Yii::app()->user->id.microtime().$model->name);
                $filename .= ".".$model->file->getExtensionName();
                //Initialize the ddditional Fields, note that we retrieve the
                //fields as if they were in a normal $_POST array
                $model->description  = Yii::app()->request->getPost('description', '');
 

                if($model->validate()) {

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
                    $model->file->saveAs($path.$filename);
                    chmod($path.$filename, 0777);

                    //Now we need to save this path to the user's session
                   //  if(Yii::app()->user->hasState('images')) {
                   //      $userImages = Yii::app()->user->getState('images');
                   //  } else {
                   //      $userImages = array();
                   //  }
                   //   $userImages[] = array(
                   //      "path" => $path.$filename,
                   //      //the same file or a thumb version that you generated
                   //      "thumb" => $path.$filename,
                   //      "filename" => $filename,
                   //      'size' => $model->size,
                   //      'mime' => $model->mime_type,
                   //      'name' => $model->name,
                   //      'description' => $model->description,
                   // );
                   //  Yii::app()->user->setState('images', $userImages);
 
                    //Now we return our json
                    echo json_encode(array(array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            //And the description
                            "description" => $model->description,
                            "url" => $publicPath.$filename,
                            "thumbnail_url" => $publicPath.$filename,
                            "delete_url" => $this->createUrl("postPhotos", array(
                                "_method" => "delete",
                                "file" => $path.$filename
                          )),
                            "delete_type" => "POST"
                      )));
                } else {
                    echo json_encode(array(array("error" => $model->getErrors('file'),)));
                    Yii::log("XUploadAction: ".CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction");
                }
            } else {
                Yii::log('file == null');
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }


    /**
    * Creates a new model.
    * If creation is successful, the browser will display the models.
    */
    public function actionUploadPhotos()
    {
        //Yii::import("xupload.models.XUploadForm");
        //Here we define the paths where the files will be stored temporarily
        $path = realpath(Yii::app()->getBasePath()."/../images/") . "/tmp/";
        $thumbsPath = realpath(Yii::app()->getBasePath()."/../images/") . "/tmp/thumbs/";
        $publicPath = Yii::app()->getBaseUrl()."/images/";
        $privatePath = realpath(Yii::app()->getBasePath()."/../images")."/";
        $privateThumbPath = realpath(Yii::app()->getBasePath()."/../images")."/";

        // --------------------------
        // Original path checking
        // --------------------------
        Yii::log('Path value is ' . $path);
        Yii::log('thumbsPath value is ' . $thumbsPath);

        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if(isset($_SERVER['HTTP_ACCEPT'])
            && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        //Here we check if we are deleting and uploaded file
        if(isset($_GET["_method"])) {
            if($_GET["_method"] == "delete") {
                if($_GET["file"][0] !== '.') {
                    // Check for session state
                    $addPhotosTo = Yii::app()->user->getState('addPhotosTo');
                    $addPhotosToType = $addPhotosTo[0];
                    $addPhotosToId = $addPhotosTo[1];

                    // remove photo file
                    $file = $privatePath.'menus/'.$addPhotosToId.'/' . $_GET["file"];
                    Yii::log("file is " . $file);
                    if(is_file($file)) {
                        unlink($file);
                    }
                    // remove thumbnail file
                    $thumbsFile = $privateThumbPath.'menus/'.$addPhotosToId.'/thumbs/' . $_GET["file"];
                    if(is_file($thumbsFile)) {
                        unlink($thumbsFile);
                    }
                }
                echo json_encode(true);
            }
        } else {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'file');
            //We check that the file was successfully uploaded
            if($model->file !== null) {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                //(optional) Generate a random name for our file
                $filename = md5(Yii::app()->user->id.microtime().$model->name);
                $filename .= ".".$model->file->getExtensionName();
                if($model->validate()) {
                    // create $path if it doesn't exist
                    if(!is_dir($path)) {
                        mkdir($path, 0777, true);
                        chmod($path, 0777);
                    }

                    // create $thumbsPath if it doesn't exist
                    if(!is_dir($thumbsPath)) {
                        mkdir($thumbsPath, 0777, true);
                        chmod($thumbsPath, 0777);
                    }

                    //Move our file to our temporary dir
                    $model->file->saveAs($path.$filename);
                    chmod($path.$filename, 0777);

                    // --------------------------
                    // Temporary path checking
                    // --------------------------
                    Yii::log('temporary path is ' . $path.$filename);
                    Yii::log('temporary thumbs path is ' . $thumbsPath.$filename);

                    //here you can also generate the image versions you need
                    //using something like PHPThumb

                    // --------------------------
                    // Creating thumbnail
                    // --------------------------
                    $thumb=new EPhpThumb();
                    $thumb->init(); //this is needed

                    //chain functions
                    $thumb->create($path.$filename)
                          ->resize(200,200)
                          ->save($thumbsPath.$filename);


                    //Now we need to save this path to the user's session
                    /*
                    if(Yii::app()->user->hasState('images')) {
                        $userImages = Yii::app()->user->getState('images');
                    } else {
                        $userImages = array();
                    }
                     $userImages[] = array(
                        "path" => $path.$filename,
                        //the same file or a thumb version that you generated
                        "thumb" => $thumbsPath.$filename,
                        "filename" => $filename,
                        'size' => $model->size,
                        'mime' => $model->mime_type,
                        'name' => $model->name,
                 );
                    Yii::app()->user->setState('images', $userImages);
                    */

                    // save photo into database
                    $newPhotoModel = new Photo;
                    $newPhotoModel->user_id = Yii::app()->user->id;
                    $newPhotoModel->description = "helloworld";
                    $newPhotoModel->picture = $filename;

                    $succeed = false;
                    if ($newPhotoModel->save()){
                        if(Yii::app()->user->hasState('addPhotosTo')) {
                            $addPhotosTo = Yii::app()->user->getState('addPhotosTo');
                            $addPhotosToType = $addPhotosTo[0];
                            $addPhotosToId = $addPhotosTo[1];
                            if ($addPhotosToType === 'menu') {
                                $newPhotosMenu = new PhotosMenu;
                                $newPhotosMenu->photo_id = $newPhotoModel->id;
                                $newPhotosMenu->menu_id = $addPhotosToId;
                                if ($newPhotosMenu->save())
                                {
                                    $succeed = true;
                                    $privatePath = $privatePath.'menus/'.$addPhotosToId.'/';
                                    $privateThumbPath = $privateThumbPath.'menus/'.$addPhotosToId.'/thumbs/';
                                    $publicPath = $publicPath.'menus/'.$addPhotosToId.'/';
                                }
                            }
                        }
                    }

                    if ($succeed)
                    {
                        // move images to correct folder
                        //Create the folder and give permissions if it doesnt exists
                        Yii::log('check1 '.$privatePath);
                        if(!is_dir($privatePath)) {
                            mkdir($privatePath);
                            chmod($privatePath, 0777);
                        }
                        Yii::log('check2 '.$privateThumbPath);
                        if(!is_dir($privateThumbPath)) {
                            mkdir($privateThumbPath);
                            chmod($privateThumbPath, 0777);
                        }
                        Yii::log('check3');

                        // original image
                        $tmpImagePath = $path.$filename;
                        if(is_file($tmpImagePath)) {
                            if(rename($tmpImagePath, $privatePath.$filename)) {
                                chmod($privatePath.$filename, 0777);
                            }
                        } else {
                            //You can also throw an execption here to rollback the transaction
                            Yii::log($tmpImagePath." is not a file", CLogger::LEVEL_WARNING);
                        }

                        // thumb image
                        $tmpThumbPath = $thumbsPath.$filename;
                        if(is_file($tmpThumbPath)) {
                            if(rename($tmpThumbPath, $privateThumbPath.$filename)) {
                                chmod($privateThumbPath.$filename, 0777);
                            }
                        } else {
                            //You can also throw an execption here to rollback the transaction
                            Yii::log($tmpThumbPath." is not a file", CLogger::LEVEL_WARNING);
                        }

                        //Now we need to tell our widget that the upload was succesfull
                        //We do so, using the json structure defined in
                        // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                        echo json_encode(array(array(
                                "name" => $model->name,
                                "type" => $model->mime_type,
                                "size" => $model->size,
                                "url" => $publicPath.$filename,
                                //"thumbnail_url" => $publicPath.$filename,
                                "thumbnail_url" => $publicPath.'/thumbs/'.$filename,
                                "delete_url" => $this->createUrl("uploadPhotos", array(
                                    "_method" => "delete",
                                    "file" => $filename
                             )),
                                "delete_type" => "POST"
                         )));
                    }
                    else{
                        //If the upload failed for some reason we log some data and let the widget know
                        echo json_encode(array(
                            array("error" => $model->getErrors('file'),
                     )));
                        Yii::log("XUploadAction: ".CVarDumper::dumpAsString($model->getErrors()),
                            CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                     );
                    }

                } else {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array("error" => $model->getErrors('file'),
                 )));
                    Yii::log("XUploadAction: ".CVarDumper::dumpAsString($model->getErrors()),
                        CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                 );
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Photo::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='photo-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
    * Protected method to load the associated Business model class
    * @menu_id the primary identifier of the associated Business
    * @return object the Business data model based on the primary key
    */
    protected function loadMenu($menu_id)
    {
        //if the project property is null, create it based on input id
        if($this->_menu===null)
        {
            $this->_menu=Menu::model()->findbyPk($menu_id);
            if($this->_menu===null)
            {
                // Temporary error
                // Will redirect to new business creation page
                throw new CHttpException(404,'The requested business does not exist.');
            }
        }
        return $this->_menu;
    }

    /**
      * In-class defined filter method, configured for use in the above filters() method
      * It is called before the actionCreate() action method is run in order to ensure a proper project context
      */
    public function filterMenuContext($filterChain)
    {
        //set the project identifier based on either the GET or POST
        //request variables, since we allow both types for our actions
        $menuId = null;
        if(isset($_GET['mid']))
            $menuId = $_GET['mid'];
        else if(isset($_POST['mid']))
            $menuId = $_POST['mid'];

        $this->loadMenu($menuId);

        //complete the running of other filters and execute the requested action
        $filterChain->run();
    }
}