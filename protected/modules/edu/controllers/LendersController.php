<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
class LendersController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column1';
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
				'actions'=>array('login','view','forgotPassword'),
				'users'=>array('*'),
			),
			// allow authenticated users to perform these actions
			array('allow',
				'actions'=>array('login','support','view','leadinfo','pauseaffiliate'),
				'users'=>array('@'),
			),
			// allow authenticated user to perform these actions
			array('allow',
				'actions'=>array(
					'index',
					'create',
					'update',
					'support',
					'updateByData',
					'delete',
					'data',
					'pausevendorAjax',
					'lenderreport',
					'lendermonthlyreport',
					'profile',
					'leadinfo',
					'lenderstats'
				),
				'users'=>array('admin'),
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
		/**
		 ** Author : Vatsal Gadhia
		 ** Modification : db_edu component replaced by db so that data can be access from new db of edu module
		 ** Modification Date : 01-08-2016
		**/
		$connection = Yii::app()->db;
		$sql2 = "UPDATE edu_lender_details SET paused_vendor  = '$val' WHERE id=$id";
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
             if($model->password != $_POST['LenderDetails']['password']){
                $_POST['LenderDetails']['password']=md5($_POST['LenderDetails']['password']);
            }
			$model->attributes=$_POST['LenderDetails'];
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
		if(Yii::app()->request->getParam('LenderDetails'))
			$model->attributes=$_GET['LenderDetails'];

		$this->render('index',array(
			'model'=>$model,
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
	 * Support for query
	 */
	public function actionSupport(){
		$len_id = Yii::app()->user->id;
		$model = $this->loadModel($len_id);
		$this->render('support',array('model' => $model,));
	}
	/**
	 * Lead info for lender when they login
	 */
	public function actionLeadinfo(){
		$model = new LenderTransactions();
		$criteria = $model->leadinfo_for_specfic_lender();
		if(Yii::app()->request->getParam('export')=='Export CSV'){
			$posts = $model->findAll($criteria);
			if(!empty($posts)){
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename=data.csv');
				$output = fopen('php://output', 'w');
				fputcsv($output, array('Date','Ping Request','Ping Response','Post Request','Post Response'));
				foreach($posts as $row){
					$data = array(
						$row->date,
						$row->ping_request,
						$row->ping_response,
						$row->post_request,
						$row->post_response,
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
	/**
	 * Lender Report Statistics Table (Diplayed on Lender Dashboard)
	 */
	public function actionLenderreport(){
		$lender_transactions = new LenderTransactions();
		//$lender_transactions = $lender_transactions->lender_reports();
		$lender_transactions = $lender_transactions->lender_reports_submission();
		$lender_leads = [];
		foreach ($lender_transactions as $transaction){
			$lender_name = $transaction['lender_name'];
			$lender_price_leads[$lender_name][] = $transaction;
			$lender_total[$lender_name]['leads'] += $transaction['leads'];
			$lender_total[$lender_name]['returned'] += $transaction['returned'];
		}
		/*** SEARCHED DATA ARRAY **/
		$searched_data = [];
		$filter_date = explode(' - ',Yii::app()->getRequest()->getParam('filter_date',date('Y-m-d')));
		$count =  count($filter_date);
		$start_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[0])).' 00:00:00' : date("Y-m-d", strtotime($filter_date[0])).' 00:00:00';
		$end_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[1])).' 23:59:59' : date("Y-m-d", strtotime($filter_date[0])).' 23:59:59';
		$searched_data['lender'] = Yii::app()->getRequest()->getParam('lender');
		$searched_data['filter_date']['start_date'] = $start_date;
		$searched_data['filter_date']['end_date'] = $end_date;
		/*** SEARCHED DATA ARRAY **/
		$this->render('lenderreport',array('lender_total'=>$lender_total,'lender_array'=>$lender_price_leads,'searched_data'=>$searched_data));
	}
	/**
      * @description : Lender Monthly Report For Admin (Diplayed under the menu Lenders -> Lender Monthly Report)
      * @since : 17-10-2016 05:00 pm
     */
	public function actionLenderMonthlyreport(){
		//echo '<pre>';print_r($_REQUEST);exit;
		$searched_data = array();
		$o_edu_zip_codes = new EduZipCodes();
		$t_campus_details = $o_edu_zip_codes->getCampusDetails();
		foreach ($t_campus_details as $cam_details){
			$campus_details[$cam_details['campus_code']] = $cam_details;
		}
		//echo '<pre>';print_r($campus_details);exit;
		$lender_transactions = new LenderTransactions();
		$lender_transactions = $lender_transactions->lender_monthly_reports();
		$lender_leads = [];
		foreach ($lender_transactions as $transaction){
			$lender_name = $transaction['lender_name'];
			$lender_price_leads[$lender_name][] = $transaction;
			$lender_total[$lender_name]['leads'] += $transaction['leads'];
			$lender_total[$lender_name]['returned'] += $transaction['returned'];
			$lender_total[$lender_name]['valid'] += $transaction['valid'];
		}
		$filter_date = explode(' - ',Yii::app()->getRequest()->getParam('filter_date',date('Y-m-d')));
		$promo_code = Yii::app()->getRequest()->getParam('promo_code');
		$count =  count($filter_date);
		$start_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[0])).' 00:00:00' : date("Y-m-d", strtotime($filter_date[0])).' 00:00:00';
		$end_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[1])).' 23:59:59' : date("Y-m-d", strtotime($filter_date[0])).' 23:59:59';
		$searched_data['filter_date']['start_date'] = $start_date;
		$searched_data['filter_date']['end_date'] = $end_date;
		$searched_data['promo_code']= $promo_code;
		/*** SEARCHED DATA ARRAY **/
		$lender = Yii::app()->getRequest()->getParam('lender');
		$year_picker = Yii::app()->getRequest()->getParam('year_picker');
		$month_picker = Yii::app()->getRequest()->getParam('month_picker');		
		$searched_data['lender'] = $lender;
		/*** SEARCHED DATA ARRAY **/
		/*echo '<pre>';
		print_r($lender_price_leads);
		exit;*/
		$this->render('lendermonthlyreport',array('lender_total'=>$lender_total,'lender_array'=>$lender_price_leads,'searched_data'=>$searched_data,'lender'=>$lender,'year_picker'=>$year_picker,'month_picker'=>$month_picker,'campus_details'=>$campus_details));
	}

	/**
	 * @description : forgot password
	 * @since : 19-10-2016
	*/
	public function actionForgotPassword(){
		$model = new LenderDetails();
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
			echo CActiveForm::validate ($model);
			Yii::app()->end();
		}
        
		if(isset($_POST['LenderDetails']['email'])){
 			$res=$model->actionCheckLenderEmail($_POST['LenderDetails']['email']);
            if($res['success']=='1'){
                $this->render('forgotPassword', array(
			         'model' => $model,
                    'email'=>$_POST['LenderDetails']['email'],
                    'pass'=>$res['pass']
		          ) );
            }else{
                 $this->render('forgotPassword', array(
			         'model' => $model,
                    'error'=>$res
		          ) );
            }
		}else{
		$this->render('forgotPassword', array(
			'model' => $model,
             'email'=>''
		) );
        }
    }

	/**
      * @author : vatsal gadhia
      * @description : Paused/Resume Affiliates
      * @since : 26-10-2016
     */
	public function actionPauseAffiliate() {
		if(Yii::app()->user->getState('usertype')!='lender'){
			header('location:'.Yii::app()->createUrl('edu/dashboard/index'));
		}
    	// $model = new LenderDetails();
    	if(isset($_POST) && !empty($_POST)) {
    		$flash_type = '';
    		$flash_message = '';
	    	$o_lender_details = new LenderDetails;
    		if(isset($_POST['resume_affiliates'])) {
    			if($o_lender_details->actionPauseAffiliates('',Yii::app()->user->id,1)) {
    				$flash_type = 'success';
    				$flash_message = 'All Affiliates Are Resumed.';
    			} else {
    				$flash_type = 'error';
    				$flash_message = 'Error Occured While Resuming Affiliates. Try Again.';
    			}
    		} else {
    			$paused_aff_ids = implode(",",$_POST['affiliates']);
    			if($o_lender_details->actionPauseAffiliates($paused_aff_ids,Yii::app()->user->id)) {
    				$flash_type = 'success';
    				$flash_message = 'Selected Affiliates Are Paused.';
    			} else {
    				$flash_type = 'error';
    				$flash_message = 'Error Occured While Pausing Selected Affiliates. Try Again.';
    			}
	    	}
    		Yii::app()->user->setFlash($flash_type,$flash_message);
    		unset($_POST,$flash_type,$flash_message);
    	}
    	$this->render('pauseAffiliate', array('message' => $message,'message_type' => $message_type));
    }
}
