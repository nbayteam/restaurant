<?php

class MenuController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
      * @var private property containing the associated Business model instance. */
    private $_business = null;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'businessContext + index, create', // check to ensure valid business context
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
        $photos = new Photo;

        // Clear the user's session
        Yii::app( )->user->setState( 'images', null );
        Yii::app( )->user->setState( 'addPhotosTo', null );

        // set session addPhotosTo to menu to tell Photo to link photos to menu
        Yii::app( )->user->setState( 'addPhotosTo', ['menu', $id] );

		$this->render('view',array(
			'model'=>$this->loadModel($id),
            'photos'=>$photos,
			// 'bid'=>$this->_business->id,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Menu;

		// pre-fill business id
		$model->business_id = $this->_business->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Menu']))
		{
			$model->attributes=$_POST['Menu'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'bid'=>$model->business_id,
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
		//$this->performAjaxValidation($model);

		if(isset($_POST['Menu']))
		{
			$model->attributes=$_POST['Menu'];
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
		// $dataProvider=new CActiveDataProvider('Menu');

		$dataProvider=new CActiveDataProvider('Menu', array(
			'criteria'=>array(
				'condition'=>'business_id=:businessId',
				'params'=>array(':businessId'=>$this->_business->id),
				'order'=>'create_date DESC',
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'bid'=>$this->_business->id,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Menu('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Menu']))
			$model->attributes=$_GET['Menu'];

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
		$model=Menu::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='menu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
    * Protected method to load the associated Business model class
    * @business_id the primary identifier of the associated Business
    * @return object the Business data model based on the primary key
    */
    protected function loadBusiness($business_id)
    {
    	//if the project property is null, create it based on input id
        if($this->_business===null)
        {
        	$this->_business=Business::model()->findbyPk($business_id);
        	if($this->_business===null)
            {
            	// Temporary error
            	// Will redirect to new business creation page
            	throw new CHttpException(404,'The requested business does not exist.');
            }
        }
        return $this->_business;
    }

    /**
      * In-class defined filter method, configured for use in the above filters() method
      * It is called before the actionCreate() action method is run in order to ensure a proper project context
      */
	public function filterBusinessContext($filterChain)
    {
   		//set the project identifier based on either the GET or POST
        //request variables, since we allow both types for our actions
   		$businessId = null;
   		if(isset($_GET['bid']))
   			$businessId = $_GET['bid'];
   		else if(isset($_POST['bid']))
   			$businessId = $_POST['bid'];

   		$this->loadBusiness($businessId);

   		//complete the running of other filters and execute the requested action
        $filterChain->run();
    }
}
