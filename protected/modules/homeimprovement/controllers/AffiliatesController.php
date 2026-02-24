<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
class AffiliatesController extends Controller{
	/**
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 *      using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '/layouts/column2';
	
	/**
	 * @return array action filters
	 */
	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete'  // we only allow deletion via POST request
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * 
	 * @return array access control rules
	 */
	public function accessRules(){
		return array(
			// allow all users to perform these actions
			array(
				'allow',
				'actions' => array('index','login','affiliateRegister','view','pixelCodeDisplay','getaffstatus'),
				'users' => array('*') 
			),
			// allow authenticated user to perform these actions
			array(
				'allow',
				'actions' => array(
					'supression_list',
					'creatives',
					'support',
					'profile',
					'emailcreatives',
					'viewemailcreatives',
					'leadinfo',
					'affiliatestats',
				),
				'users' => array('@')
			),
			// allow admin user to perform these actions
			array(
				'allow',
				'actions' => array('create','update','delete','updateMd5Password','updateByData','getLast15DaysSubmissionPerAffiliate','supression_list','creatives','support'),
				'users' => array('admin')
			),
			// deny all users
			array(
				'deny',
				'users' => array('*') 
			) 
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id){
		$this->render('view',array(
			'model' => $this->loadModel($id) 
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){
		$model = new AffiliateUser();
		if(Yii::app()->user->checkAccess('admin')){
			$model->scenario = 'adminrole';
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['AffiliateUser'])){
			$errors = '';
			$model->attributes = $_POST['AffiliateUser'];
			$model->is_inorganic = ($_POST['AffiliateUser']['is_inorganic']=='on') ? 1 : 0;
			$model->isAdmin = ($_POST['AffiliateUser']['isAdmin']=='on') ? 1 : 0;
			$model->pixel_type = ($_POST['AffiliateUser']['pixel_type']=='on') ? 1 : 0;
			if($model->save())
				$this->redirect(array('view','id' => $model->id));
			else
				$errors = $model->errors;
		}
		$this->render('create',array(
			'model' => $model,
			'errors' => $errors 
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
		$model = $this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['AffiliateUser'])){
			$model->attributes = $_POST['AffiliateUser'];
			$model->is_inorganic = ($_POST['AffiliateUser']['is_inorganic']=='on') ? 1 : 0;
			//$model->status = ($_POST['AffiliateUser']['status']=='on') ? 1 : 0;
			$model->isAdmin = ($_POST['AffiliateUser']['isAdmin']=='on') ? 1 : 0;
			$model->pixel_type = ($_POST['AffiliateUser']['pixel_type']=='on') ? 1 : 0;
			if($model->save())
				$this->redirect(array(
					'view',
					'id' => $model->id 
				));
		}
		$this->render('update',array(
			'model' => $model 
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
				'admin' 
			));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex(){
		$model = new AffiliateUser('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['AffiliateUser']))
			$model->attributes = $_GET['AffiliateUser'];
		
		$dataProvider_affiliate=new CActiveDataProvider('AffiliateUser',array(
			'criteria'=>array('order'=>'id DESC'),'pagination'=>array('pageSize'=>15)));
		
		$this->render('index',array(
			'model' => $model,
			'dataProvider_affiliate' => $dataProvider_affiliate
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin(){
		$model = new AffiliateUser('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['AffiliateUser']))
			$model->attributes = $_GET['AffiliateUser'];
		
		$this->render('admin',array(
			'model' => $model 
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id){
		$model = AffiliateUser::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'affiliate-user-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionUpdateByData(){
		Yii::import('ext.editable.EditableSaver');
		$es = new EditableSaver('AffiliateUser');
		$es->update();
	}
	public function actionUpdateMd5Password(){
		Yii::import('ext.editable.EditableSaver');
		$es = new EditableSaver('AffiliateUser');
		$es->onBeforeUpdate = function($event) {
			$event->sender->setAttribute('password',md5(Yii::app()->request->getParam('value')));
		};
		$es->update();
	}
	public function actionGetLast15DaysSubmissionPerAffiliate(){
		$model = new AffiliateTransactions();
		return $model->leads_submitted_per_affiliate_last15days();
	}
	/**
	 * Display Affiliate Pixel Code
	 */
	public function actionPixelCodeDisplay(){
		$this->layout='pixel_code_display_layout';
		$affiliate_trans_id = Yii::app()->request->getParam('affiliate_trans_id');
		$pixel = Yii::app()->request->getParam('pixel');
		if($affiliate_trans_id && $pixel!=''){
			$aff=AffiliateTransactions::model()->findByPk($affiliate_trans_id);
			if($aff){
				$aff_user_obj = new AffiliateUser();
				$pixel_type = $aff_user_obj->getAffiliatePixelType($affiliate_trans_id);
				$pixel_code = $aff_user_obj->get_pixel($affiliate_trans_id);
				$lender_exit_url = LenderTransactions::model()->exit_url($affiliate_trans_id);
				if($pixel>0){
					// display pixel code as many times of pixel fire and every time decrease pixel
					//12.7.2017
					$this->render('pixel_code_display',array('pixel_type'=>$pixel_type,'pixel_code'=>$pixel_code,'pixel'=>$pixel,'affiliate_trans_id'=>$affiliate_trans_id,'sub_id'=>$aff->sub_id,'lead_id'=>$aff->lead_id,'sub_id2'=>$aff->sub_id2));
				}else{
					//12.7.2017
					// pixel decressed to zero then redirect to exit url if lender provide othervise redirect to private labeled homepage
					$exit_url = (isset($lender_exit_url) && $lender_exit_url!='') ? $lender_exit_url : Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto'].'/index.php/thankyou';
					$this->render('pixel_code_display',array('pixel_type'=>$pixel_type,'pixel_code'=>$pixel_code,'pixel'=>$pixel,'exit_url'=>$exit_url,'sub_id'=>$aff->sub_id,'lead_id'=>$aff->lead_id,'sub_id2'=>$aff->sub_id2));
				}
			}else{
				echo "Invalid Request";
			}
		}else{
			echo "Invalid Request";
		}
	}
	/**
	 * Create suppression list for affiliates.
	 * Affiliate can only download the suppression list file.
	 * Admin can add new emails and phones to suppression list.
	 */
	public function actionSupression_list(){
		$message = '';
		
		if(Yii::app()->request->getParam('email_suprression_list') || Yii::app()->request->getParam('phone_supression_list')) {
			$table = 'homeimprovement_email_supression_list';
			$fields = 'email';
			
			if(Yii::app()->request->getParam('email_suprression_list')){
				$table = 'homeimprovement_email_supression_list';
				$fields = 'email';
				$filename = 'email_suprression_list-'.date('Y-m-d');
			}elseif(Yii::app()->request->getParam('phone_supression_list')){
				$table = 'homeimprovement_phone_supression_list';
				$fields = 'phone';
				$filename = 'phone_suprression_list-'.date('Y-m-d');
			}
			
			$query_data = Yii::app()->dbHomeimprovement->createCommand()
			->select($fields)
			->from($table)
			->queryAll();
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment;filename="'.$filename.'.csv"');
			
			foreach($query_data as $row){
				foreach($row as $data){
					echo $data;
					echo "\r\n";
				}
			}
			exit;
		}elseif(Yii::app()->request->getParam('emails')){
			$emails = Yii::app()->request->getParam('emails_text');
			if (!empty($emails)){
				$name_emails = preg_split("/[\s,]+/", $emails, -1, PREG_SPLIT_NO_EMPTY);
				foreach ($name_emails as $email) {
					$email = addslashes($email);
					if (@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
						$email_supression = Yii::app()->dbHomeimprovement->createCommand()->select('email')
						->from('homeimprovement_email_supression_list')
						->where("`email`='". $email."'")
						->query();
						if($email_supression->rowCount==0){
							Yii::app()->dbHomeimprovement->createCommand()->insert('homeimprovement_email_supression_list',array('email'=>$email));
							/*$fileName = '../suppressionlist.txt';
							$file=fopen($fileName,"a") or die("$fileName does not exist!");
							fwrite($file, $email."\n");*/
						}
					}
				}
				Yii::app()->user->setFlash('success','Emails added successfully');
			}
		}elseif(Yii::app()->request->getParam('phones')){
			$phones = Yii::app()->request->getParam('phones_text');
			if (!empty($phones)){
				$name_phones = preg_split("/[\s,]+/", $phones, -1, PREG_SPLIT_NO_EMPTY);
				foreach ($name_phones as $phone) {
					$phone = addslashes($phone);
					//if(@eregi("/^[\d]{10}$/", $phone)) {
						//echo '<pre>';print_r($phone);echo '</pre>';exit;
						$phone_supression = Yii::app()->dbHomeimprovement->createCommand()->select('phone')
						->from('homeimprovement_phone_supression_list')
						->where("phone=". $phone)
						->query();
						if($phone_supression->rowCount==0){
							Yii::app()->dbHomeimprovement->createCommand()->insert('homeimprovement_phone_supression_list',array('phone'=>$phone));
							/*$fileName = '../suppressionlist.txt';
							 $file=fopen($fileName,"a") or die("$fileName does not exist!");
							fwrite($file, $email."\n");*/
						}
				}
				Yii::app()->user->setFlash('success','Phone added successfully');
			}
		}
		$this->render('supression_list');
	}
	/**
	 * Banner Creatives
	 */
	public function actionCreatives(){
		$promo_code = Yii::app()->user->id;
		$errors = array();
		if(Yii::app()->request->getParam('upload')){
			extract($_POST);
			$filename = $_FILES["promotional_image"]["name"];
			$file_tmp_name = $_FILES["promotional_image"]["tmp_name"];
			$file_size = $_FILES["promotional_image"]["size"];
			$target_dir = 'promotional_creatives/';
			$target_file = $target_dir . basename($filename);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$check = getimagesize($file_tmp_name);
			if($check !== false){
				$uploadOk = 1;
			}else{
				$errors[] = "File is not an image.";
				$uploadOk = 0;
			}
			if(file_exists($target_file)){
				$errors[] = "Sorry, file already exists.";
				$uploadOk = 0;
			}
			if($file_size > 500000){
				$errors[] = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
				$errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			if($uploadOk == 0){
				$errors[] = "Sorry, your file was not uploaded.";
			}else{
				$pos = strrpos($filename, ".");
				$filename_without_extension = substr($filename, 0, $pos);
				$save_name =  $filename_without_extension.'_'.time().'.'.$imageFileType;
				if (move_uploaded_file($file_tmp_name, $target_dir.$save_name)) {
					$res = Yii::app()->dbHomeimprovement->createCommand()->insert($table='promotional_creatives',$columns=array('private_label'=>$private_label,'promotional_text'=>$promotional_text,'image_name'=>$save_name,'promo_code'=>$promo_code,'c_date'=>date('Y-m-d H:i:s')));
					$this->redirect('creatives');
				}else{
					$errors[] = "Sorry, there was an error uploading your file.";
				}
			}
		}
		if(Yii::app()->request->getParam('remove_id')!=''){
			extract($_POST);
			$condition = 'id='.$remove_id;
			$res = Yii::app()->dbHomeimprovement->createCommand()->delete($table='promotional_creatives',$conditions=$condition,$params=array());
			$this->redirect('creatives');
		}
		
		$creatives = Yii::app()->dbHomeimprovement->createCommand()->select('id,private_label,promotional_text,image_name,promo_code,c_date')
		->from('promotional_creatives')
		->where('')
		->order('c_date desc')
		->queryAll();
		
		$this->render('creatives',array('creatives'=>$creatives,'errors'=>$errors));
	}
	/**
	 * Email Creatives
	 */
	public function actionEmailcreatives(){
		$promo_code = Yii::app()->user->id;
		$errors = array();
		if(Yii::app()->request->getParam('upload')){
			extract($_POST);
			$filename = $_FILES["promotional_image"]["name"];
			$file_tmp_name = $_FILES["promotional_image"]["tmp_name"];
			$file_size = $_FILES["promotional_image"]["size"];
			$target_dir = 'email_creatives/';
			$target_file = $target_dir . basename($filename);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$check = getimagesize($file_tmp_name);
			if($check !== false){
				$uploadOk = 1;
			}else{
				$errors[] = "File is not an image.";
				$uploadOk = 0;
			}
			if(file_exists($target_file)){
				$errors[] = "Sorry, file already exists.";
				$uploadOk = 0;
			}
			if($file_size > 500000){
				$errors[] = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
				$errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			if(!is_dir($target_dir)) {
				mkdir($target_dir,0777,true);
			}
			if($uploadOk == 0){
				$errors[] = "Sorry, your file was not uploaded.";
			}else{
				$pos = strrpos($filename, ".");
				$filename_without_extension = substr($filename, 0, $pos);
				$save_name =  $filename_without_extension.'_'.time().'.'.$imageFileType;
				if (move_uploaded_file($file_tmp_name, $target_dir.$save_name)) {
					$res = Yii::app()->dbHomeimprovement->createCommand()->insert($table='email_creatives',$columns=array('image_name'=>$save_name,'promo_code'=>$promo_code,'c_date'=>date('Y-m-d H:i:s')));
					$this->redirect('emailcreatives');
				}else{
					$errors[] = "Sorry, there was an error uploading your file.";
				}
			}
		}
		if(Yii::app()->request->getParam('add_subjectlines')){
			extract($_POST);
			$res = Yii::app()->dbHomeimprovement->createCommand()->insert($table='email_creatives_subject_lines',$columns=array('subject_lines'=>$email_creatives_subject_line,'promo_code'=>$promo_code,'c_date'=>date('Y-m-d H:i:s')));
			$this->redirect('emailcreatives');
		}
		if(Yii::app()->request->getParam('add_fromlines')){
			extract($_POST);
			$res = Yii::app()->dbHomeimprovement->createCommand()->insert($table='email_creatives_from_lines',$columns=array('from_lines'=>$email_creatives_from_line,'promo_code'=>$promo_code,'c_date'=>date('Y-m-d H:i:s')));
			$this->redirect('emailcreatives');
		}
		if(Yii::app()->request->getParam('remove_id')!=''){
			extract($_POST);
			$condition = 'id='.$remove_id;
			$res = Yii::app()->dbHomeimprovement->createCommand()->delete($table='email_creatives',$conditions=$condition,$params=array());
			$this->redirect('creatives');
		}
	
		$creatives = Yii::app()->dbHomeimprovement->createCommand()->select('id,image_name,promo_code,c_date')
		->from('email_creatives')
		->order('c_date desc')
		->queryAll();
		
		$email_creatives_subject_lines = Yii::app()->dbHomeimprovement->createCommand()->select('id,subject_lines,promo_code,c_date')
		->from('email_creatives_subject_lines')
		->order('c_date desc')
		->queryAll();
		
		$email_creatives_from_lines = Yii::app()->dbHomeimprovement->createCommand()->select('id,from_lines,promo_code,c_date')
		->from('email_creatives_from_lines')
		->order('c_date desc')
		->queryAll();
	
		$this->render('emailcreatives',array('creatives'=>$creatives,'email_creatives_subject_lines'=>$email_creatives_subject_lines,'email_creatives_from_lines'=>$email_creatives_from_lines,'errors'=>$errors));
	}
	/**
	 * View HTML code file for Email Creatives
	 */
	public function actionViewEmailCreatives(){
		$where = 'id='.Yii::app()->request->getParam('id');
		$creatives = Yii::app()->dbHomeimprovement->createCommand()->select('id,image_name,promo_code,c_date')
		->from('email_creatives')
		->where($where)
		->order('c_date desc')
		->queryRow();
		$this->render('viewemailcreatives',array('creatives'=>$creatives));
	}
	/**
	 * Support for query
	 */
	public function actionSupport(){
		$this->render('support');
	}
	/**
	 * Affiliate Login Personal Profile View
	 */
	public function actionProfile(){
		$promo_code = Yii::app()->user->id;
		$model = $this->loadModel($promo_code);
		if(isset($_POST['AffiliateUser'])){
			$model->attributes = $_POST['AffiliateUser'];
			if($model->save()){
				Yii::app()->user->setFlash('success','Update Data Successfully');
			}else{
			}
		}
		$this->render('profile',array(
			'model' => $model,
		));
	}
	/**
	 * Get affiliate status to check test pixel fire in private labeled site.
	 */
	public function actionGetaffstatus(){
		$_POST = $_REQUEST;
		$promo_code = Yii::app()->request->getParam('promo_code');
		$sub_id = Yii::app()->request->getParam('sub_id');
		$subid = Yii::app()->request->getParam('subid');
		$sub_id = !empty($sub_id) ? $sub_id : $subid;
		$sub_id2 = Yii::app()->request->getParam('sub_id2');
		$subid2 = Yii::app()->request->getParam('subid2');
		$sub_id2 = !empty($sub_id2) ? $sub_id2 : $subid2;
		$click_id = Yii::app()->request->getParam('click_id');
		$transaction_id = Yii::app()->request->getParam('transaction_id');
		$pixel_code = '';
		if($promo_code){
			$row = AffiliateUser::model()->findbyPk($promo_code);
			if($row['status'] =='0' && $row['is_inorganic'] =='0'){
				// affiliate is in test mode and organic promo code then fired test pixel
				$process = 'organic';
				Yii::app()->session['ping_type'] = 'directpost';
				$pixel_code = $row['pixel_code'];
				if(strlen($pixel_code) > 0 && $pixel_code != 'NULL' && $pixel_code != ''){
					$patterns = array('/ebpclickid/','/ebpleadid/', '/ebpsubid/', '/ebptransid/','/ebpsub2id/');
					$replacements = array($click_id,rand(1111,9999),$sub_id,$transaction_id,$sub_id2);
					$pixel_code = urldecode($pixel_code);
					$pixel_code = preg_replace($patterns, $replacements, $pixel_code);
				}
				if($row['pixel_type'] == 1){
					mail('octobas@gmail.com,vicd@rcn.com','s2spixel Home Imrovement',$pixel_code.'-->'.$sub_id.'-->'.$sub_id2);
					file_get_contents($pixel_code);
				}else{
					echo $pixel_code;
				}
			}elseif($row['status'] =='1' && $row['is_inorganic'] =='1'){
				// if promo code is inorganic promo code then take his traffic.
				return false;
			}
		}else{
			return false;	
			//echo 'Provide promo_code';
		}
		$process = '';
		Yii::app()->session['ping_type'] = '';
	}
	/**
	 * Lead info for affiliates when they login
	 */
	public function actionLeadinfo(){
		$model = new AffiliateTransactions();
		$criteria = $model->leadinfo_for_affiliate();
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
	 * Affiliate Login
	 */
	public function actionLogin(){
		$this->layout = '/layouts/column1';
		$model = new LoginForm();
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
			echo CActiveForm::validate ($model);
			Yii::app()->end();
		}
		if(isset($_POST['LoginForm'])){
			$model->attributes = $_POST['LoginForm'];
			if($model->validate() && $model->affiliatelogin()){
				$url = explode ( "/", Yii::app()->request->urlReferrer);
				if(end($url) == 'login'){
					Yii::app()->user->setReturnUrl('../dashboard/index');
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
	 * Affiliate Registration
	 */
	public function actionAffiliateRegister(){
		$this->layout = '/layouts/column1';
		$model = new AffiliateUser();
		if (Yii::app()->user->checkAccess('admin')) {
			$model->scenario = 'adminrole';
		}
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'auto-affiliate-register-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['AffiliateUser'])){
			$last_inserted_id = '';
			$model->attributes=$_POST['AffiliateUser'];
			$model->bucket_limit = 100;
			$model->margin = 10;
			$model->is_inorganic = 0;
			if($model->save()){
				$last_inserted_id = $model->id;
			}else{/*echo '<pre>Model Errors=';print_r($model->errors);echo '</pre>';*/}
		}
		$this->render('affiliateRegister', array(
			'model' => $model,
			'last_inserted_id' => $last_inserted_id
		) );
	}
	/**
	 * 
	*/
	public function actionAffiliatestats(){
		$affiliatestats = array();
		$searched_data = array();
		$filter = Yii::app()->getRequest()->getParam('date_filter',date("Y-m-d"));
		$filter = explode(' - ',$filter);
		$count =  count($filter);
		if($count == 2){
			$start_date =  date("Y-m-d", strtotime($filter[0]));
			$end_date =  date("Y-m-d", strtotime($filter[1]));
		}else{
			$start_date =  date("Y-m-d", strtotime($filter[0]));
			$end_date =  date("Y-m-d", strtotime($filter[0]));
		}
		$searched_data['filter_date']['start_date'] = $start_date;
		$searched_data['filter_date']['end_date'] = $end_date;
		if(Yii::app()->request->getParam('affiliatestats_search')=='Get Affiliate Stats'){
			$model = new AffiliateTransactions();
			$affiliatestats = $model->affiliate_stats();
		}
		//echo '<pre>';print_r($affiliatestats);exit;
		$this->render('affiliatestats',array('affiliatestats' => $affiliatestats,'searched_data' => $searched_data));
	}
}
