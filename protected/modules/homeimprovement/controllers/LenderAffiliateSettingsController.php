<?php
class LenderAffiliateSettingsController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @return array action filters
	 */
	public function filters(){
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
	public function accessRules(){
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','updateByData','delete','data','pausevendorAjax'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
	public function actionView($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){
		$model=new LenderAffiliateSettings;
        $lender = CHtml::listData(LenderDetails::model()->findAllByAttributes(array()), 'id', 'user_name');
		$affiliate = CHtml::listData(AffiliateUser::model()->findAllByAttributes(array('status'=>'1')), 'id', 'user_name');
		if(isset($_POST['LenderAffiliateSettings'])){
			$model->attributes=$_POST['LenderAffiliateSettings'];
			$count = count($model->lender_details_id);
		    for($i=0;$i<$count;$i++){
			    $return = $this->loadModelByAttibute($_POST['LenderAffiliateSettings']['affiliate_user_id'],$_POST['LenderAffiliateSettings']['lender_details_id'][$i]); 
				if($return=="0" || $return==0){
					$model=new LenderAffiliateSettings;
				}else{
					$model=$this->loadModel($return);
				}
			    $model->affiliate_user_id = $_POST['LenderAffiliateSettings']['affiliate_user_id'];
				$model->lender_details_id = $_POST['LenderAffiliateSettings']['lender_details_id'][$i];
				$model->intervals = !empty($_POST['LenderAffiliateSettings']['intervals']) ? $_POST['LenderAffiliateSettings']['intervals'] : 0;
				$model->cap = !empty($_POST['LenderAffiliateSettings']['cap']) ? $_POST['LenderAffiliateSettings']['cap'] : 0;
				$model->orderby = !empty($_POST['LenderAffiliateSettings']['orderby']) ?$_POST['LenderAffiliateSettings']['orderby'] : 1;
				$model->status = !empty($_POST['LenderAffiliateSettings']['status']) ? $model->status : 1;
                $model->save();
			}
			Yii::app()->user->setFlash('success','Affiliate Lender Setting done sucessfully !');
		}
		$rendring=new LenderAffiliateSettings('search');
		$rendring->unsetAttributes();
		if(isset($_GET['LenderAffiliateSettings']))
			$rendring->attributes=$_GET['LenderAffiliateSettings'];
			$this->render('create',array(
				'model'=>$rendring,
				'lender'=>$lender,
				'affiliate'=>$affiliate,
				'rendring'=>$rendring,
			));
	}
	/**
	 * 
	 * @param unknown $id
	 */
	public function actionData($id){
		$this->layout='blank';
		$this->render('dialogbox',array(
			'id'=>$id,
		));  
	}
	/**
	 * 
	 */
	public function actionPausevendorAjax(){
		extract($_REQUEST);
		$connection = yii::app()->dbHomeimprovement;
		$sql = "UPDATE homeimprovement_lender_affiliate_settings SET paused_vendor  = '$val' WHERE lender_details_id=$id";
		$command=$connection->createCommand($sql);
		$command->execute();
		$sql2 = "UPDATE homeimprovement_lender_details SET paused_vendor  = '$val' WHERE id=$id";
		$command2=$connection->createCommand($sql2);
		$command2->execute();
		if($val!="") echo $val;
		else echo 'No Paused vendor';
	}
	
	/**
	 * Load Model
	 * @param unknown $affiliate_id
	 * @param unknown $lender_id
	 * @return string
	 */
    public function loadModelByAttibute($affiliate_id,$lender_id){
    	if($affiliate_id=="" && $lender_id==""){
			$return = "0";
		}else{
		    $modelcriteria = new CDbCriteria();
	        $modelcriteria->select="id";
	        $modelcriteria->condition="affiliate_user_id=".$affiliate_id. " AND lender_details_id = ".$lender_id;
	        $affLenderSetting=LenderAffiliateSettings::model()->find($modelcriteria);
			if($affLenderSetting===NULL){
				return "0";
			}else{
				return $affLenderSetting->id;
			}
		}
		return $return;
	}
	
	/** 
	 * Update Data from the View File with Ajax
	 */
	public function actionUpdateByData(){
		$id = $_POST['pk'] ;
		$model=$this->loadModel($id);
	   	if(isset($id)){
	   		LenderAffiliateSettings::model()->updateByPk($id,array($_POST['name']=>$_POST['value'])); 
	   }
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		$lender=CHtml::listData(LenderDetails::model()->findAllByAttributes(array('status'=>'1')), 'id', 'user_name');
		$affiliate=CHtml::listData(AffiliateUser::model()->findAllByAttributes(array('status'=>'1')), 'id', 'user_name');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LenderAffiliateSettings'])){
			$model->attributes=$_POST['LenderAffiliateSettings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('update',array(
			'model'=>$model,
			'lender'=>$lender,
			'affiliate'=>$affiliate,
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
	    $model=new LenderAffiliateSettings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LenderAffiliateSettings']))
			$model->attributes=$_GET['LenderAffiliateSettings'];

		$this->render('index',array(
			'model'=>$model,
		));
		/*$dataProvider=new CActiveDataProvider('LenderAffiliateSettings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		)); */
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin(){
		$model=new LenderAffiliateSettings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LenderAffiliateSettings']))
			$model->attributes=$_GET['LenderAffiliateSettings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id){
		$model=LenderAffiliateSettings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='lender-affiliate-settings-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionaddnewliquor() {
		$cs = Yii::app()->clientScript;
		$cs->reset();
		$cs->scriptMap = array(
				'jquery.js' => false, // prevent produce jquery.js in additional javascript data
				'jquery.min.js' => false,
		);
	
		$this->renderPartial('/liquor/add_new_liquor', array('model' => $model), false, true);
	}
}
