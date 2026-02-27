<?php
class FeedsController extends Controller{
	public $layout ='column1';
	 /**
	 * @return array action filters
	 */
	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules(){
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('listvendor','updatevendor','createvendor','viewvendor','deletevendor','listlender','updatelender','createlendor','viewlender','deletelender','managelender'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function loadModelFeedVendor($id){
		$model=AutoFeedVendor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadModelFeedLender($id){
		$model=AutoFeedLenders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreatevendor(){
		$model=new AutoFeedVendor;
		if(isset($_POST['AutoFeedVendor'])){
			$model->attributes=$_POST['AutoFeedVendor'];
			if($model->save())
				$this->redirect(array('viewvendor','id'=>$model->id));
		}
		$this->render('createvendor',array('model'=>$model));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdatevendor($id){
		$model=$this->loadModelFeedVendor($id);
		if(isset($_POST['AutoFeedVendor'])){
			$model->attributes=$_POST['AutoFeedVendor'];
			if($model->save())
				$this->redirect(array('listvendor','id'=>$model->id));
		}
		$this->render('updatevendor',array('model'=>$model));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeletevendor($id){
		$this->loadModelFeedVendor($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	public function actionViewvendor($id){
		$this->render('viewvendor',array(
			'model' => $this->loadModelFeedVendor($id) 
		));
	}
	public function actionListvendor(){
		$model=new AutoFeedVendor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AutoFeedVendor']))
			$model->attributes=$_GET['AutoFeedVendor'];
		$this->render('listvendor',array('model'=>$model));
	}
	public function actionIndex(){
		$this->render('index',array('model'=>$model));
	}
	/*====================================================*/
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewlender($id){
		$this->render('viewlender',array(
			'model'=>$this->loadModelFeedLender($id),
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreatelender(){
		$model=new AutoFeedLenders;
		if(isset($_POST['AutoFeedLenders'])){
			$model->attributes=$_POST['AutoFeedLenders'];
			$delay = $_POST['AutoFeedLenders']['delay'];
			$delaytime = $_POST['delaytime'];
			if($delaytime=='DAY'){
				$delay = $delay * 24;
			}
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
		$this->render('createlender',array('model'=>$model));
	}
	public function actionData($id){
		$this->layout='blank';
		$this->render('dialogbox',array('id'=>$id));  
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
	public function actionUpdatelender($id){
		$model=$this->loadModelFeedLender($id);
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
		$this->render('updatelender',array('model'=>$model));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeletelender($id){
		$this->loadModelFeedLender($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	/**
	 * Lists all models.
	 */
	public function actionListlender(){
	   $model=new AutoFeedLenders('search');
		$model->unsetAttributes();
		if(isset($_GET['AutoFeedLenders']))
			$model->attributes=$_GET['AutoFeedLenders'];

		$this->render('listlender',array('model'=>$model));
	}
	/**
	 * Manages all models.
	 */
	public function actionManagelender(){
		$model=new AutoFeedLenders('search');
		$model->unsetAttributes();
		if(isset($_GET['AutoFeedLenders']))
			$model->attributes=$_GET['AutoFeedLenders'];

		$this->render('managelender',array(
			'model'=>$model,
		));
	}
	public function actionUpdateByData(){
	    $id = $_POST['pk'] ; 
	    $model=$this->loadModelFeedLender($id);
		if(isset($id)){
	      AutoFeedLenders::model()->updateByPk($id,array($_POST['name']=>$_POST['value'])); 
		}
	}
	
}
?>
