<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
class LendersController extends Controller{
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
			// allow all users to perform these actions
			array('allow',
				'actions'=>array('index','login','view'),
				'users'=>array('*'),
			),
			// allow authenticated user to perform these actions
			array('allow',
				'actions'=>array(
					'create',
					'update',
					'updateByData',
					'delete',
					'data',
					'pausevendorAjax',
					'lenderreport',
					'profile',
					'leadinfo',
					'lenderstats'
				),
				'users'=>array('@'),
			),
			// deny all users
			array('deny',
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
		$model=new LenderDetails;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
     	if(isset($_POST['LenderDetails'])){
			$model->attributes=$_POST['LenderDetails'];
			$model->lender_pingpost_type = ($_POST['LenderDetails']['lender_pingpost_type']=='on') ? 1 : 0;
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}
		}
      $this->render('create',array(
      	'model'=>$model,
		));
	}
	
	public function actionData(){
		$this->layout='blank';
		$this->render('dialogbox',array(
			'id'=>$_REQUEST['id'],
		));  
	}
	public function actionPausevendorAjax(){
		extract($_REQUEST);
		$connection = yii::app()->dbHealthinsurance;
		$sql2 = "UPDATE healthinsurance_lender_details SET paused_vendor  = '$val' WHERE id=$id";
		$command2=$connection->createCommand($sql2);
		$command2->execute();
		if($val!="") echo $val;
		else echo 'No Paused vendor';
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		$model->validate();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$lender=CHtml::listData(LenderDetails::model()->findAllByAttributes(array('status'=>'1')), 'id', 'user_name');
		if(isset($_POST['LenderDetails'])){
			$model->attributes=$_POST['LenderDetails'];
			$model->lender_pingpost_type = ($_POST['LenderDetails']['lender_pingpost_type']=='on') ? 1 : 0;
			//print_r($model->attributes);exit;
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$this->render('update',array(
				'model'=>$model,
				'lender'=>$lender
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex(){
		$model=new LenderDetails('search');
		$model->unsetAttributes();
		$dataProvider=new CActiveDataProvider('LenderDetails',array(
			'criteria'=>array('order'=>'id DESC'),'pagination'=>array('pageSize'=>15)));
			
		if(Yii::app()->request->getParam('LenderDetails'))
			$model->attributes=$_GET['LenderDetails'];

		$this->render('index',array(
			'model'=>$model,
			'dataProvider' => $dataProvider
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin(){
		$model=new LenderDetails('search');
		$model->unsetAttributes();
		if(Yii::app()->request->getParam('LenderDetails'))
			$model->attributes=$_GET['LenderDetails'];
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionUpdateByData(){
		Yii::import('ext.editable.EditableSaver');
		$es = new EditableSaver('LenderDetails');
		$es->update();
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id){
		$model=LenderDetails::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='lender-details-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * Lender Report Statistics Table (Diplayed on Lender Dashboard)
	 */
	public function actionLenderreport(){
		$lender_transactions = new LenderTransactions();
		//$lender_price_leads = $lender_transactions->lender_reports();
		$lender_price_leads = $lender_transactions->lender_reports_submission();
		$lender_array = [];
		$total_accepted_leads = 0;$turn_over = 0;$total_profit_per_lender = $total_returned_leads = 0;
		foreach ($lender_price_leads as $lender_name => $transactions){
			foreach ($transactions as $key => $trans){
				foreach ($trans as $key => $trans){
					$total_accepted_leads += $trans['leads'];
					$total_returned_leads += $trans['returned'];
					$turn_over = $turn_over + (($trans['leads']-$trans['returned'])*$trans['lead_price']);
					//$total_profit_per_lender += (($trans['leads']-$trans['returned'])*$trans['lead_price'])/$trans['margin'];
				}
			}
			$lender_price_leads[$lender_name]['total_accepted_leads'] =  $total_accepted_leads;
			$lender_price_leads[$lender_name]['total_returned_leads'] =  $total_returned_leads;
			$lender_price_leads[$lender_name]['grand_total'] =  ($total_accepted_leads)-($total_returned_leads);
			$lender_price_leads[$lender_name]['turn_over'] =  $turn_over;
			//$lender_price_leads[$lender_name]['total_profit_per_lender'] =  $total_profit_per_lender;
			$total_accepted_leads = 0;
			$turn_over = 0;
			//$total_profit_per_lender = 0;
			$total_returned_leads = 0;
		}
		/*** SEARCHED DATA ARRAY **/
		$searched_data = array();
		$lender = Yii::app()->getRequest()->getParam('lender');
		$filter_date = explode(' - ',Yii::app()->getRequest()->getParam('filter_date',date('Y-m-d')));
		$count =  count($filter_date);
		$start_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[0])).' 00:00:00' : date("Y-m-d", strtotime($filter_date[0])).' 00:00:00';
		$end_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[1])).' 23:59:59' : date("Y-m-d", strtotime($filter_date[0])).' 23:59:59';
		$searched_data['lender'] = $lender;
		$searched_data['filter_date']['start_date'] = $start_date;
		$searched_data['filter_date']['end_date'] = $end_date;
		/*** SEARCHED DATA ARRAY **/
		$this->render('lenderreport',array('lender_array'=>$lender_price_leads,'searched_data'=>$searched_data));
	}
	/**
	 * Lender Login
	 */
	public function actionLogin(){
		$this->layout = '/layouts/column1';
		$model = new LoginForm();
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['LoginForm'])){
			$model->attributes = $_POST['LoginForm'];
			if($model->validate() && $model->lenderlogin()){
				$url = explode ( "/", Yii::app()->request->urlReferrer);
				if(end($url) == 'login'){
					Yii::app()->user->setReturnUrl('../default/index');
					$this->redirect(Yii::app()->user->returnUrl);
				}else{
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
		}
		$this->render('login', array(
			'model' => $model
		) );
	}
	/**
	 * Lead info for lender when they login
	 */
	public function actionLeadinfo(){
		$model = new LenderTransactions();
		$criteria = $model->leadinfo_for_specific_lender();
		//echo '<pre>';print_r($criteria);exit;
		if(Yii::app()->request->getParam('export')=='Export CSV'){
			$posts = $model->findAll($criteria);
			if(!empty($posts)){
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename=data.csv');
				$output = fopen('php://output', 'w');
				fputcsv($output, array('Date','Sr.#','Ping Request','Ping Response','Ping Price','Post Request','Post Response','Post Price'));
				foreach($posts as $row){
					$data = array(
						$row->date,
						$row->id,
						$row->ping_request,
						$row->ping_response,
						$row->ping_price,
						$row->post_request,
						$row->post_response,
						$row->post_price,
					);
					fputcsv($output, $data);
				}
				exit;
			}else{
				$this->render('leadinfo',array("NoDataFound"=>true));
			}
		}else{
			$total = $model->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = 10;
			$pages->applyLimit($criteria);
			$posts = $model->findAll($criteria);
			$this->render('leadinfo',array('posts' => $posts,'pages' => $pages,'total' => $total));
		}
	}
	/**
	 * Lender Stats
	 */
	public function actionLenderstats(){
		$lenderstats = array();
		if(Yii::app()->request->getParam('lenderstats_search')=='Get Lender Stats'){
			$model = new LenderTransactions();
			$lenderstats = $model->lender_stats();
		}
		$this->render('lenderstats',array('lenderstats' => $lenderstats));
	}
}
