<?php

class AutoFeedLendersController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','updateByData','delete','data','pausevendorAjax'),
				'users'=>array('@'),
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
	public function actionCreate(){
		$model=new AutoFeedLenders;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['AutoFeedLenders'])){
			$model->attributes=$_POST['AutoFeedLenders'];
			$delay = $_POST['AutoFeedLenders']['delay'];
			$delaytime = $_POST['delaytime'];
			if($delaytime=='DAY'){
				$delay = $delay * 24;
			}
			//$delays = $delay.' '.$delaytime; 
		    $interval = $_POST['AutoFeedLenders']['interval'];
			$intervaltime = $_POST['intervaltime'];
			if($intervaltime == 'min'){
			 $interval = $interval *60;
			}
			$model->interval = $interval;
			$model->delay = $delay;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionData($id){
		$this->layout='blank';
		$this->render('dialogbox',array(
			'id'=>$id,
		));  
	}
	public function actionPausevendorAjax(){
		$model=new AutoFeedLenders();
		$xml_cat = $model->getvendorslist(); 
		echo $xml_cat; 
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated 
	 */
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['AutoFeedLenders'])){
			$model->attributes=$_POST['AutoFeedLenders'];
			$delay = $_POST['AutoFeedLenders']['delay'];
			$delaytime = $_POST['delaytime'];
			if($delaytime=='DAY'){
				$delay = $delay * 24;
			}
			//$delays = $delay.' '.$delaytime; 
		    $interval = $_POST['AutoFeedLenders']['interval'];
			$intervaltime = $_POST['intervaltime'];
			if($intervaltime == 'min'){
			 $interval = $interval *60;
			}
			$model->interval = $interval;
			$model->delay = $delay;
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
	public function actionDelete($id){
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex(){
	   $model=new AutoFeedLenders('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AutoFeedLenders']))
			$model->attributes=$_GET['AutoFeedLenders'];

		$this->render('index',array(
			'model'=>$model,
		));
		/*$dataProvider=new CActiveDataProvider('AutoFeedLenders');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin(){
		$model=new AutoFeedLenders('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AutoFeedLenders']))
			$model->attributes=$_GET['AutoFeedLenders'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AutoFeedLenders the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id){
		$model=AutoFeedLenders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function actionUpdateByData(){
	   $id = $_POST['pk'] ; 
	   $model=$this->loadModel($id);
	   if(isset($id)){
	      AutoFeedLenders::model()->updateByPk($id,array($_POST['name']=>$_POST['value'])); 
	   }
	}
	/**
	 * Performs the AJAX validation.
	 * @param AutoFeedLenders $model the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='auto-feed-lenders-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
