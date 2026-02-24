<?php
ini_set('display_errors', 1);
ini_set('memory_limit', '-1');
class LeadsController extends Controller{
	public $layout ='column1';
	public function filters(){
		return array(
			'accessControl',
		);
	}
	public function accessRules(){
			return array(
				//allow all users to perform these actions
				array('allow',
					'actions' => array('view','postaccept','successAffiliate','nolenderfound'),
					'users' => array('*'),
				),
				// allow authenticated user to perform these actions
				array(
					'allow',
					'actions' => array('view','postaccept','successAffiliate','nolenderfound'),
					'users' => array('@')
				),
				//allow admin user to perform these actions
				array(
					'allow',
					'actions' => array('index','browsetransaction','failedleads','exportleads','lendertransaction','returnleads','postedleads','lead_info','browseleads','campus_cap_rejected_leads','phoneVerificationDetails','editleaddetails','questionableLeadReport','pauseDirectPost','emailrejectedleads'),
					'users' => array('admin')
				),
				//deny all users
				array('deny',
					'users' => array('*'),
				),
			);
	}
	public function loadModel($id){
		$model=Submissions::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function actionView($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionIndex(){
		$this->actionBrowsetransaction();
	}
	public static function actionAffiliateTransaction($data,$process='organic',$post_request_affiliate=''){
		$is_organic = ($process=='organic') ? 1 : 0;
		$ping_id = Yii::app()->request->getParam('ping_id','');
		if ($ping_id !='' && Yii::app()->session['ping_type'] == 'post') {
			$ping_id = $data['ping_id'];
			$aff_trans = AffiliateTransactions::model()->findByPk($ping_id);
			$aff_trans->post_request = http_build_query($_POST);
			$aff_trans->post_request_affiliate = $post_request_affiliate;
			if($aff_trans->validate()){
				$aff_trans->save();
				Yii::app()->session['affiliate_trans_id'] = $ping_id;
				Yii::app()->params['affiliate_trans_id'] = $ping_id;
			}else{
				echo $aff_trans->getErrors();
			}
		} elseif (($ping_id=="" || $ping_id == null) && Yii::app()->session['ping_type'] == 'directpost'){
			$model_aff_trnsaction = new AffiliateTransactions();
			$model_aff_trnsaction->attributes = $data;
			$model_aff_trnsaction->date = date('Y-m-d H:i:s');
			$ip_address = Yii::app()->request->getParam('ipaddress');
			$model_aff_trnsaction->ip = (!empty($ip_address) ? $ip_address : Yii::app()->request->userHostAddress);
			$model_aff_trnsaction->promo_code = isset($data['promo_code']) ? $data['promo_code'] : '';
			$model_aff_trnsaction->sub_id = isset($data['sub_id']) ? $data['sub_id'] : '';
			$model_aff_trnsaction->post_request_affiliate = $post_request_affiliate;
			$model_aff_trnsaction->post_request = http_build_query($_POST);
			$model_aff_trnsaction->posting_type = 1; // 0=pingpost, 1=directpost
			$model_aff_trnsaction->is_organic = $is_organic;
			// added campus code in affiliate transaction 01.18.2018
			$model_aff_trnsaction->campus_code = isset($data['campus']) ? $data['campus'] : '';
			$model_aff_trnsaction->insert();
			/*
			** 
			** modification description : way of retrieving last id is changed (previously we get last id with the help of DB object but due to mulitple databases it return 0)
			** modification date : 01-08-2016
			*/
			//Yii::app()->session['affiliate_trans_id'] = Yii::app()->db->lastInsertID;
			Yii::app()->session['affiliate_trans_id'] = $model_aff_trnsaction->id;
			Yii::app()->params['affiliate_trans_id'] = $model_aff_trnsaction->id;
		} else{
			$model_aff_trnsaction = new AffiliateTransactions();
			$model_aff_trnsaction->date = date('Y-m-d H:i:s');
			//$model_aff_trnsaction->ip = Yii::app()->request->userHostAddress;
			/**
			 * @since : 13-12-2016 04:45 PM
			 * @functionality : Add ip address of reposted lead
			 */
			$ip_address = Yii::app()->request->getParam('ipaddress');
			$model_aff_trnsaction->ip = (!empty($ip_address) ? $ip_address : Yii::app()->request->userHostAddress);
			$model_aff_trnsaction->promo_code = isset($data['promo_code']) ? $data['promo_code'] : '';
			$model_aff_trnsaction->sub_id = isset($data['sub_id']) ? $data['sub_id'] : '';
			$model_aff_trnsaction->post_request_affiliate = $post_request_affiliate;
			$model_aff_trnsaction->ping_request = http_build_query($_POST);
			$model_aff_trnsaction->posting_type = 0; // 0=pingpost, 1=directpost
			$model_aff_trnsaction->is_organic = $is_organic;
			$model_aff_trnsaction->insert();
			/*
			** 
			** modification description : way of retrieving last id is changed (previously we get last id with the help of DB object but due to mulitple databases it return 0)
			** modification date : 01-08-2016
			*/
			//Yii::app()->session['affiliate_trans_id'] = Yii::app()->db->lastInsertID;
			Yii::app()->session['affiliate_trans_id'] = $model_aff_trnsaction->id;
			Yii::app()->params['affiliate_trans_id'] = $model_aff_trnsaction->id;
		}
	}
	public function actionBrowsetransaction(){
		if(!empty($_POST)){
			foreach($_POST as $search_field => $search_field_value){
				$_SESSION['browse_searched_parameters'][$search_field] = $search_field_value;
			}
		}
		if($searched_parameters = Yii::app()->session['browse_searched_parameters']){
			foreach($searched_parameters as $search_field => $search_field_value){
				$_POST[$search_field] = $search_field_value;
			}
		}
		$model = new AffiliateTransactions();
		$criteria = new CDbCriteria();
		$criteria = $model->browse_search_transction();
		$total = $model->count($criteria);
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$posts = $model->findAll($criteria);
		$this->render('browsetransaction',array(
			'posts' => $posts,
			'pages' => $pages,
			'total' => $total
		));
	}
	public function actionFailedleads(){
		/**
		 ** Author : 
		 ** Description : code to get failed leads
		 ** Date : 02-08-2016
		**/			
		$o_list_leads = new ListLeads;
		$o_list_leads->unsetAttributes(); // clear any default values
		$rawData = $o_list_leads->getFailedLeads();
		$this->render('failed_leads',array(
			'rawData' => $rawData
		));
	}
	public function actionExportleads(){
		if(Yii::app()->request->getParam('export')=='Export'){
			$model = new Submissions();
			$rawData = $model->exportleads();
			//echo'<pre>';print_r($rawData);echo'</pre>';
			if(!empty($rawData)) {
	        	$csv_output = '';
	        	header("Content-type:text/octect-stream");
	        	header("Content-Disposition:attachment;filename=data.csv");
	        	$header = implode(',',array_keys($rawData[0]));
	        	$csv_output .= $header."\n";
	        	foreach($rawData as $key=>$value){
	        		$csv_output .= '"' . stripslashes(implode('","',$value)) . "\"\n";
	        	}
	        	print $csv_output;exit();
			}else{
				$this->render('exportleads',array("NoDataFound"=>true));
				Yii::app()->end();
			}
		}else{
			$this->render('exportleads');
		}
	}
	public function actionLendertransaction(){		
		$model = new LenderTransactions();
		$criteria = new CDbCriteria();
		$criteria = $model->browselendertransction();
		$total = $model->count($criteria);
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$posts = $model->findAll($criteria);
		//echo '<pre>';print_r($posts);exit;
		$this->render('lendertransaction',array(
			'posts' => $posts,
			'pages' => $pages,
			'total' => $total
		));
	}
	public function actionSuccessAffiliate(){
         header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods:GET,POST,JSONP');
        header("Access-Control-Allow-Headers:HTTP-X-REQUESTED-WITH");
		$process = 'organic';
		//$affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
		$affiliate_trans_id = $_REQUEST['affiliate_trans_id'];
		$model = new AffiliateTransactions();
		list($exit_url,$pixel,$response) = $model->log_redirect($affiliate_trans_id,$process);
        $AffiliateTransactions = AffiliateTransactions::model()->findByPK($affiliate_trans_id);
		$AffiliateStatus=AffiliateUser::verifyAffiliateStatus($AffiliateTransactions->promo_code);
	if($AffiliateStatus==1) {
       
			if($exit_url=='' && $pixel==0){
				//header('Location:'.Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto'].'/index.php/thankyou');exit;
			}else if($exit_url!='' && $pixel==0){
				header('Location:'.$exit_url);	
			}else{
                 $model_aff_trnsaction = new AffiliateTransactions();
				$model_aff_trnsaction -> updateAffiliateTransactions(array('pixel_fired'=>'1'),$affiliate_trans_id);
				$ch = curl_init(Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'].'/affiliates/pixelCodeDisplay?pixel='.$pixel.'&affiliate_trans_id='.$affiliate_trans_id));
				curl_setopt($ch, CURLOPT_HEADER, 0);

				$t_response = curl_exec($ch);
				curl_close($ch);
				// header('Location:'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'].'/affiliates/pixelCodeDisplay?pixel='.$pixel.'&affiliate_trans_id='.$affiliate_trans_id));exit;
			}
		} else if($AffiliateStatus==2) {
        $model_aff_trnsaction = new AffiliateTransactions();
				$model_aff_trnsaction -> updateAffiliateTransactions(array('pixel_fired'=>'1'),$affiliate_trans_id);
         // echo $pixel = AffiliatesController::actionGetaffstatus(Yii::app()->request->getParam('promo_code'),Yii::app()->request->getParam('sub_id')); 
        $ch = curl_init(Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'].'/affiliates/pixelCodeDisplay?pixel=1&affiliate_trans_id='.$affiliate_trans_id));
				curl_setopt($ch, CURLOPT_HEADER, 0);

				$t_response = curl_exec($ch);
				curl_close($ch);
		}
        
	}
	public function actionPostaccept(){
		$process = 'inorganic';
		$model = new AffiliateTransactions();
		list($exit_url,$pixel,$response) = $model->log_redirect($_REQUEST['affiliate_trans_id'],$process);
		if($response==''){
			if($exit_url==''){
				// No Exit URL then Redirect to Private Labeled Site Homepage
				// No Exit URL so we will not update redirect=yes in affiliate transaction and submission table
				
				/**
				 * 
				 * description : redirection to "thankyou" page removed
				 * date : 22-08-2016
				 */
				//header('Location:'.Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto'].'/index.php/thankyou');exit;
			}else{
				header('Location:'.$exit_url);exit;
			}
		}else{
			echo $response;exit;
		}
	}
	public function actionNolenderfound(){
		$this->render('nolenderfound');
	}
	public static function actionValidationCheck($data,$process = 'organic'){
		$model = new Submissions();
		$model->attributes = $data;
		if(!$model->validate()){
			$cm = new CommonMethods();
			$getError = $model->getErrors();
			$erroall1 = '';
			foreach($getError as $errorsall=>$value){
				foreach($value as $errorsalls){
					$erroall1 .= $errorsalls.',';
				}
			}
			$all_errors = 'Missing or invalid fields: '.$erroall1;
			$all_errors = substr($all_errors, 0, -1);
			if($process == 'inorganic'){
				$cm->setRespondError($model->getErrors(),'submission',$process);
			}else if($process == 'organic'){
				$cm->setRespondError($model->getErrors(),'submission',$process);
			}else{
				$request = '';
				foreach ($data as $key => $value){
					$request .= '&'.$key.'='.urlencode($value);
				}
				Yii::app()->getController()->redirect(Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto'].'/index.php?'.$request.'&error='.$all_errors);
			}
		}
	}
	public static function actionCheckDuplicate($data,$process = 'organic'){
     	$model = new Submissions();
		if($data['lead_mode']==1) {
			if(isset($data['repost']) && $data['repost']==1) {
				$count = 0;
			}else{
				$count = Yii::app()->request->getParam('ping_id') ? 0 : $model->checkDuplicate($data);
			}
		} else {
			$count = 0;
		}
		if(!empty($count) && $count > 0){
			/** Update affiliate's daily count */
			$duplicate = 1;$aff_post_status = 0;
			$promo_code = Yii::app()->request->getParam('promo_code');
			AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_post_status,$duplicate);
			$cm = new CommonMethods();
			$cm->setRespondError('','duplicate',$process);
		}else{
			if(Yii::app()->request->getParam('ping_id')){
				$aff_trans = AffiliateTransactions::model()->findByPk(Yii::app()->session['affiliate_trans_id']);
				$submission_ping = $model->findByPk($aff_trans->customer_id);
				$submission_ping->attributes = $data;
				$submission_ping->save();
				Yii::app()->session['lead_id'] = $submission_ping->id;
			}else{
				$model->attributes = $data;
				$model->posting_type = 1; // 0=pingpost, 1=directpost
				$model->is_organic = ($process == 'organic') ? 1 : 0;
				$model->lead_status = 0;
				$model->save();
				Yii::app()->session['lead_id'] = $model->id;
			}
		}
	}
	public static function actionCheckPingDuplicate($data,$process='organic'){
		$model = new Submissions();
		$count = $model->checkPingDuplicate($data);
		if(!empty($count) && $count > 0){
			/** Update affiliate's daily count */
			$duplicate = 1;$aff_ping_status = 0;
			$promo_code = Yii::app()->request->getParam('promo_code');
			AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_ping_status,$duplicate);
			$cm = new CommonMethods();
			$cm->setRespondError('','duplicate',$process);
		}else{
			$model->attributes = $data;
			$city_state = $model->getCityStateFromZip($data['zip']);
			$model->city = $city_state['city'];
			$model->state = $city_state['state'];
			$model->posting_type = 0; // 0=pingpost, 1=directpost
			$model->is_organic = ($process == 'organic') ? 1 : 0;
			$model->save();
		}
	}
	public static function check_Ping_Id_Existence($ping_id){
		$aff_trans = AffiliateTransactions::model()->findByPk($ping_id);
		if(empty($aff_trans)){
			$cm = new CommonMethods();
			$cm->NoPingFound($ping_id);exit;
		}
	}
	public function actionReturnleads(){
		$returns = array();
		//echo '<pre>';print_r($_POST);exit;
		if(Yii::app()->request->getParam('export')=='Export'){
			$model = new Submissions();
			$criteria = $model->search_return_leads();
			$rawData = $model->findAll($criteria);
			//echo'<pre>';print_r($rawData);echo'</pre>';
			if(!empty($rawData)) {
				$headers = "Ipaddress,First Name,Last Name,Email,Affiliate,status,Reason,Date Submission";
	        	$csv_output = '';
				foreach($rawData as $raw){
					$raws['ipaddress']         = $raw->ipaddress;
					$raws['first_name']        = $raw->first_name;
					$raws['last_name']         = $raw->last_name;
					$raws['email']             = $raw->email;
					$raws['promo_code']        = $raw->gender.'('.$raw->promo_code .')';
					$raws['lead_status']       = $raw->is_returned ==1 ? RETURNED : ACCEPTED;
					$raws['return_reason']       = $raw->return_reason;
					//$raws['lender_id']         = $raw->lender_id;
					//$raws['lender_lead_price'] = $raw->lender_lead_price;
					$raws['sub_date']   	   = $raw->sub_date;
					$csv_output .= stripslashes(implode(',',$raws)) . "\n";
				}
	        	header("Content-type:text/octect-stream");header("Content-Disposition:attachment;filename=returnleads.csv");
	        	$csvoutput = $headers."\n".$csv_output;
	        	print $csvoutput;exit();
			}else{
				$this->render('exportleads',array("NoDataFound"=>true));
				Yii::app()->end();
			}
		}
		if(!empty($_POST)){
			foreach($_POST as $search_field => $search_field_value){
				$_SESSION['returned_leads_searched_parameters'][$search_field] = $search_field_value;
				if($search_field == 'returns') {
					$returns = $search_field_value;
				}
			}
		}
		if($searched_parameters = Yii::app()->session['returned_leads_searched_parameters']){
			foreach($searched_parameters as $search_field => $search_field_value){
				$_POST[$search_field] = $search_field_value;
			}
		}
		$model = new Submissions();
		// $returns = Yii::app()->getRequest()->getParam('returns');
		if(isset($returns) && !empty($returns)) {
			/**
			  * @description : send mail to affiliates for return leads with reason if pixel_type=1
			  * @since : 07-01-2017 11:35
			 */
			$s_lead_return_reason = $_REQUEST['reason'];
			//headers, subject and common message
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Higher Learning Marketers <returns@higherlearningmarketers.com>' . "\r\n";

			$subject = "IMPORTANT! Return Lead Notification from HigherLearningMarketers!";

			$mailmessage = "<b>**Please do not reply to this email address. All inquiries should be directed to your affiliate manager.**</b>,<br /><br />";
			$mailmessage .= "This is an automated email to notify you of a returned lead. The below lead has been removed from the accepted lead count and will not be included in your final billable count<br /><br />";

			foreach ($returns as $i_return) {
				$t_affiliate_trans_id = $model->getAffiliateTransactionId($i_return);
				if(isset($t_affiliate_trans_id[0]) && !empty($t_affiliate_trans_id[0])) {
					$i_affiliate_trans_id_from_sub_id = $t_affiliate_trans_id[0]['id'];
					$o_affiliate_user = new AffiliateUser();
					$i_pixel_type = $o_affiliate_user->getAffiliatePixelType($i_affiliate_trans_id_from_sub_id);
					if(isset($i_pixel_type) && !empty($i_pixel_type) && $i_pixel_type==1) {
						$s_email = $i_sub_id = "";
						$t_aff_submitted_data=Submissions::model()->findByPk($i_return);
						if(isset($t_aff_submitted_data) && !empty($t_aff_submitted_data)) {
							$s_email = $t_aff_submitted_data['email'];
							$i_sub_id = $t_aff_submitted_data['sub_id'];
						}
						$mailmessage .= "Email : ".$s_email."<br />";
						$mailmessage .= "Sub ID : ".$i_sub_id."<br />";
						$mailmessage .= "Reason for Return : ".$s_lead_return_reason."<br /><br />";
						$mailmessage .= "Sincerely,<br /><br />";
						$mailmessage .= "HigherLearningMarketers Team<br />";
						if(isset($s_email) && !empty($s_email)) {
							mail($s_email, $subject, $mailmessage, $headers);
						}
					}
				}
			}
			
			$model->update_returned_leads($returns);
			$returns = array();
			unset($returns);
			// $this->redirect('returnleads');
		}
		$criteria = $model->search_return_leads();
		$total = $model->count($criteria);
		/** For paggination uncomment these lines */
		/* $pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria); */
		$posts = $model->findAll($criteria);
		//echo'<pre>';print_r($criteria);print_r($posts);echo'</pre>';exit;
		$this->render('returnleads',array(
			'posts' => $posts,
			'total' => $total,
		));        
	}
	public function actionPostedleads(){
		$model = new AffiliateTransactions();
		$posts = $model->search_posted_leads();
		$searched_data = array();
		$filter = Yii::app()->getRequest()->getParam('filter_date',date("Y-m-d"));
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
		$this->render('postedleads',array(
			'posts' => $posts,
			'searched_data' => $searched_data
		));
	}
	public function actionLead_info(){
		$submission_model = new Submissions();
		$haystack = $_SERVER['HTTP_REFERER'];
		$needle = 'postedleads';
		$lead_info_reports = (strpos($haystack, $needle)) ? $submission_model->lead_info_posted_leads() : $submission_model->lead_info_reports();
		//echo '<pre>';print_r($lead_info_reports);exit;
		$this->render('lead_info',array('lead_info_reports'=>$lead_info_reports));
	}
	public function actionBrowseleads(){
		if(!empty($_POST)){
			foreach($_POST as $search_field => $search_field_value){
				$_SESSION['browse_searched_parameters'][$search_field] = $search_field_value;
			}
		}
		if($searched_parameters = Yii::app()->session['browse_searched_parameters']){
			foreach($searched_parameters as $search_field => $search_field_value){
				$_POST[$search_field] = $search_field_value;
			}
		}
		$criteria = new CDbCriteria();
		$model = new Submissions();
		$criteria = $model->browseleads();
		$posts = $model->findAll($criteria);
		/**
		 * @since : 21-12-2016 09:29 PM
		 
		 * @functionality : Added condition to check request is not for export then add pagination conditions
		 */
		$s_export = Yii::app()->request->getParam('export');
		if($s_export != 'Export'){
			$total = $model->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = 10;
			$pages->applyLimit($criteria);
			$posts = $model->findAll($criteria);
		}
		if(Yii::app()->request->getParam('export')=='Export'){
			Yii::import('ext.ECSVExport');
			if(!empty($posts)) {
				$posts = $model->findAll($criteria);
				$filename = 'csvfile.csv';
				$csv = new ECSVExport($posts);
				$content = $csv->toCSV();
				Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
				unset($_SESSION['browse_searched_parameters']['export']);
				exit();
			}
			else{
				$this->render('browseleads',array("NoDataFound"=>true));
				Yii::app()->end();
			}
		}
		//$this->render('browseleads',array('posts' => $posts));
		$this->render('browseleads',array(
			'posts' => $posts,
			'pages' => $pages,
			'total' => $total
		));
	}

	
	
	/**
	 * @since : 09-12-2016 11:53 AM
	 
	 * @functionality : Added $t_rejected_repost_lead_data to set repost data came from edit page for repost
	 */
	public function actionCampus_cap_rejected_leads($s_rejected_repost_lead_data='') {
		$cap_msg = '';
		$redirect_page_no = 1;
		//echo '<pre>';print_r($_POST);exit;
		/**
		  * @author : 
		  * @description : search button functionality (set the search criteria)
		  * @since : 26-12-2016 12:50 PM
		 */
		if(isset($_REQUEST['search_leads'])) {
			foreach($_POST as $search_field => $search_field_value){
				$_SESSION['browse_searched_campus_cap'][$search_field] = $search_field_value;
			}
		}
		if(isset($_REQUEST['page']) && !empty($_REQUEST['page'])) {
			$redirect_page_no = $_REQUEST['page'];
		}
		/**
		  * @author : 
		  * @description : reset button functionality (unset the search criteria and then redirect to main page)
		  * @since : 26-12-2016 12:50 PM
		 */
		if(Yii::app()->request->getParam('reset_leads')) {
			unset($_SESSION['browse_searched_campus_cap']);
			$campus_cap_reset_url = Yii::app()->createUrl('edu/leads/campus_cap_rejected_leads');
			if(isset($_REQUEST['ltype'])) {
				$campus_cap_reset_url = Yii::app()->createUrl('edu/leads/campus_cap_rejected_leads?ltype=1');
			}
			$this->redirect($campus_cap_reset_url);
			exit;
		}
		/**
		 * @since : 13-12-2016 10:33 AM
		 * @functionality : Added condition for assign value in $redirect_page_no
		 */
		$s_redirect_page = Yii::app()->request->getParam('rp');
		$i_page = Yii::app()->request->getParam('pv');
		if(in_array($s_redirect_page,array('fl','ql'))){
			$redirect_page_no = Yii::app()->request->getParam('rp');
		}elseif(!empty($i_page)){
			$redirect_page_no = Yii::app()->request->getParam('pv');
		}
		$criteria = new CDbCriteria();
		$model = new Submissions();
		/**
		 * @since : 05-12-2016 04:29 PM
		 * @functionality : Add lead to questionable lead
		 */
		
		$questionable_lead_id = Yii::app()->request->getParam('qid');
		if(isset($questionable_lead_id) && !empty($questionable_lead_id)) {
			$model->markQuestionableLead($questionable_lead_id);
			Yii::app()->user->setFlash('success','Lead Marked Questionable.');
			if($redirect_page_no==1) {
				$this->redirect('campus_cap_rejected_leads');
			} else {
				$this->redirect($redirect_page_no);
			}
		} 		
		
		/*if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
			$criteria = $model->campus_cap_rejected_leads($_REQUEST['id']);
		} else {
			$criteria = $model->campus_cap_rejected_leads();
		}*/
		
		/**
		  * @author : 
		  * @description : affiliate_transaction_id passed as a parameter. (otherwise it returns invlaid lead as default it accepts submissions_id as a parameter)
		  * @since : 28-12-2016 09:57 AM
		 */
		if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
			$t_affiliate_trans_id = $model->getAffiliateTransactionId($_REQUEST['id']);
			if(isset($t_affiliate_trans_id[0]) && !empty($t_affiliate_trans_id[0])) {
				$criteria = $model->campus_cap_rejected_leads($t_affiliate_trans_id[0]['id']);
			} else {
				$criteria = $model->campus_cap_rejected_leads($_REQUEST['id']);
			}
		} else {
			$criteria = $model->campus_cap_rejected_leads();
		}
		// print_r($criteria);
		$posts = $model->findAll($criteria);
		
		/**
		 * @since : 21-12-2016 04:57 PM
		 
		 * @functionality : Added condition to export all details instead of particular page
		 */
		$s_export_data = Yii::app()->request->getParam('export');
		if($s_export_data != 'Export CSV'){
			$total = $model->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = 10;
			$pages->applyLimit($criteria);
			$posts = $model->findAll($criteria);
		}
		
		/**
		 * @since : 05-12-2016 03:36 PM
		 
		 * @functionality : Export data in csv
		 */
		 if(Yii::app()->request->getParam('export')=='Export CSV'){
				if(!empty($posts)){
					$aff_datas = AffiliateUser::model()->findAll(array('select'=>'id,user_name,status'));
					$aff_data = $active_aff_data = array();
					foreach($aff_datas as $value){
						$aff_data[$value->id] = $value->user_name.'('.$value->id.')';
						if($value->status==1) {
							$active_aff_data[$value->id] = $value->user_name.'('.$value->id.')';
						}
					}
					header('Content-Type: text/csv; charset=utf-8');
					header('Content-Disposition: attachment; filename=data.csv');
					$output = fopen('php://output', 'w');
					fputcsv($output, array('Date Time','First Name','Last Name','Email','Postal Address','Campus','Affiliate','Lead Status','Phone','Ip Address'));
					foreach($posts as $row){
						$lead_status = '';
						if($row->lead_status =='1'){
							$lead_status =  "ACCEPTED";
						}
						else if($row->lead_status=='0'){
							$lead_status =  "REJECTED";
						}
						else if($row->lead_status=='-1'){
							$lead_status =  "ERROR";
						}
						else if($row->lead_status=='2'){
							$lead_status =  "RETURNED";
						}
						else{
							$lead_status =  "ERROR";
						}

						$lead_status.= " ,Reason : ";
						if($len_trans['is_campus_cap']=='2') {
							$lead_status.=  "Duplicate IP-address";
						} else {
							$lead_status.=  "Cap Met";
						}
						$data = array(
							$row->sub_date,
							$row->first_name,
							$row->last_name,
							$row->email,
							$row->address.' Zipcode :</b> '.$row->zip,
							$row->campus,
							$aff_data[$row ->promo_code],
							$lead_status,
							$row->phone,
							$row->ipaddress,
						);
						fputcsv($output, $data);
					}
					exit;
				}else{
					if($redirect_page_no==1) {
	    				// $this->actionCampus_cap_rejected_leads();
	    				/**
						 * @since : 05-12-2016 05:23 PM
						 
						 * @functionality : If request for questionable lead then add ltype = 1 in get parameter
						 */
	    				if($questionable_lead_id == 1){
	    					$this->redirect(array('leads/campus_cap_rejected_leads', 'ltype'=>'1'));
	    				}else{
							$this->redirect('campus_cap_rejected_leads');
	    				}
	    			} else {
	    				// $this->actionCampus_cap_rejected_leads();
						$this->redirect($redirect_page_no);
					}
					exit;
				}
			}
		
		
		if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
			/**
			 * @since : 12-12-2016 08:42 PM
			 * @functionality : Added capus cap condition and page came from Falied Leads will be allowed to go through this repost section
			 */
			//echo '<pre>';print_r($posts);print_r($_REQUEST);exit;
		
			//if(isset($posts) && !empty($posts) && ((isset($posts[0]['is_campus_cap']) && !empty($posts[0]['is_campus_cap']) && $posts[0]['is_campus_cap']==0) || $redirect_page_no == 'fl')) {
			if(isset($posts) && !empty($posts) && ((isset($posts[0]['is_campus_cap'])  && $posts[0]['is_campus_cap']==0) || $redirect_page_no == 'fl')) {	
				$s_old_campus = $_REQUEST['campus'];
				$s_new_campus = $_REQUEST['new_campus'];
				$zip = $_REQUEST['zip'];
				$o_campus_details = new CampusDetails();
        		//get all caps for campus
		        $t_caps = $o_campus_details->getCampusCapDetails("where campus_code='".$s_new_campus."'");
		        //get total submission for campus
		        $t_submissions = $o_campus_details->getDurationTransactions($s_new_campus);
		        if(isset($t_caps) && !empty($t_caps)) {
		            if(isset($t_submissions) && !empty($t_submissions)) {
		                //check daily limit
		                /*if($t_caps[0]['daily_limit']!=-1) {
		                	if($t_caps[0]['daily_limit']==0) {
		                    	$cap_msg = 'Daily Cap Limit is 0.';
		                    }
		                    else if($t_caps[0]['daily_limit'] > $t_submissions['day_submission']) { }
		                    else {
		                    	$cap_msg = 'Daily Cap Limit Reached.';
		                    }
		                }
		                //check weekly limit
		                else if($t_caps[0]['weekly_limit']!=-1) {
		                	if($t_caps[0]['weekly_limit']==0) {
		                    	$cap_msg = 'Weekly Cap Limit is 0.';
		                    }
		                    else if($t_caps[0]['weekly_limit'] > $t_submissions['week_submission']) { }
		                    else {
		                    	$cap_msg = 'Weekly Cap Limit Reached.';
		                    }
		                }
		                //check monthly limit
		                else if($t_caps[0]['monthly_limit']!=-1) {
		                	if($t_caps[0]['monthly_limit']==0) {
		                    	$cap_msg = 'Monthly Cap Limit is 0.';
		                    }
		                    else if($t_caps[0]['monthly_limit'] > $t_submissions['month_submission']) { }
		                    else {
		                    	$cap_msg = 'Monthly Cap Limit Reached.';
		                    }
		                }*/
		                //check daily limit
                if($t_caps[0]['daily_limit']!=-1) {
                    if($t_caps[0]['daily_limit'] > $t_submissions['day_submission']) { }
                    else {
                        //daily limit over
                        $o_edu_zip_codes = new EduZipCodes();
                        $t_campus_progs = $o_edu_zip_codes->getCampusProgramFromZip($zip," AND campus_code!='".$s_new_campus."'");
                        if(isset($t_campus_progs) && !empty($t_campus_progs)) {
                            foreach ($t_campus_progs as $t_campus_prog) {
                                $t_caps_new = $o_campus_details->getCampusCapDetails("where campus_code='".$t_campus_prog['campus_code']."'");
                                $t_submissions_new = $o_campus_details->getDurationTransactions($t_campus_prog['campus_code']);
                                if(isset($t_caps_new) && !empty($t_caps_new) && isset($t_submissions_new) && !empty($t_submissions_new)) {
                                    if($t_caps_new[0]['daily_limit']!=-1) {
                                        if($t_caps_new[0]['daily_limit'] <= $t_submissions_new['day_submission']) {
                                            $cap_msg = '';
                                        } else {
                                            $s_new_campus = $t_campus_prog['campus_code'];
                                            $poi = $t_campus_prog['program_of_interest_code'];
                                            $_REQUEST['new_program_of_interest'] = $poi;
                                            $cap_msg = '';
                                            break;
                                        }
                                    } else {
                                        $s_new_campus = $t_campus_prog['campus_code'];
                                        $poi = $t_campus_prog['program_of_interest_code'];
                                        $_REQUEST['new_program_of_interest'] = $poi;
                                        $cap_msg = '';
                                        break;
                                    }
                                } else {
                                    $cap_msg = 'Daily Cap Limit Reached.';
                                }
                            }
                            
                        } else {
                            $cap_msg = 'Daily Cap Limit Reached.';
                        }
                    }
                }
                //check weekly limit
                if($t_caps[0]['weekly_limit']!=-1) {
                    if($t_caps[0]['weekly_limit'] > $t_submissions['week_submission']) { }
                    else {
                        //weekly limit over
                        $o_edu_zip_codes = new EduZipCodes();
                        $t_campus_progs = $o_edu_zip_codes->getCampusProgramFromZip($zip," AND campus_code!='".$s_new_campus."'");
                        if(isset($t_campus_progs) && !empty($t_campus_progs)) {
                            foreach ($t_campus_progs as $t_campus_prog) {
                                $t_caps_new = $o_campus_details->getCampusCapDetails("where campus_code='".$t_campus_prog['campus_code']."'");
                                $t_submissions_new = $o_campus_details->getDurationTransactions($t_campus_prog['campus_code']);
                                if(isset($t_caps_new) && !empty($t_caps_new) && isset($t_submissions_new) && !empty($t_submissions_new)) {
                                    if($t_caps_new[0]['weekly_limit']!=-1) {
                                        if($t_caps_new[0]['weekly_limit'] <= $t_submissions_new['week_submission']) {
                                            $cap_msg = '';
                                        } else {
                                            $s_new_campus = $t_campus_prog['campus_code'];
                                            $poi = $t_campus_prog['program_of_interest_code'];
                                            $_REQUEST['new_program_of_interest'] = $poi;
                                            $cap_msg = '';
                                            break;
                                        }
                                    } else {
                                        $s_new_campus = $t_campus_prog['campus_code'];
                                        $poi = $t_campus_prog['program_of_interest_code'];
                                        $_REQUEST['new_program_of_interest'] = $poi;
                                        $cap_msg = '';
                                        break;
                                    }
                                } else {
                                    $cap_msg = 'Weekly Cap Limit Reached.';
                                }
                            }
                            
                        } else {
                            $cap_msg = 'Weekly Cap Limit Reached.';
                        }
                    }
                }
                //check monthly limit
                if($t_caps[0]['monthly_limit']!=-1) {
                    if($t_caps[0]['monthly_limit'] > $t_submissions['month_submission']) { }
                    else {
                        //monthly limit over
                        $o_edu_zip_codes = new EduZipCodes();
                        $t_campus_progs = $o_edu_zip_codes->getCampusProgramFromZip($zip," AND campus_code!='".$s_new_campus."'");
                        if(isset($t_campus_progs) && !empty($t_campus_progs)) {
                            
                            foreach ($t_campus_progs as $t_campus_prog) {
                                $t_caps_new = $o_campus_details->getCampusCapDetails("where campus_code='".$t_campus_prog['campus_code']."'");
                                $t_submissions_new = $o_campus_details->getDurationTransactions($t_campus_prog['campus_code']);
                                if(isset($t_caps_new) && !empty($t_caps_new) && isset($t_submissions_new) && !empty($t_submissions_new)) {
                                    if($t_caps_new[0]['monthly_limit']!=-1) {
                                        if($t_caps_new[0]['monthly_limit'] <= $t_submissions_new['month_submission']) {
                                            $cap_msg = '';
                                        } else {
                                            $s_new_campus = $t_campus_prog['campus_code'];
                                            $poi = $t_campus_prog['program_of_interest_code'];
                                            $_REQUEST['new_program_of_interest'] = $poi;
                                            $cap_msg = '';
                                            break;
                                        }
                                    } else {
                                        $s_new_campus = $t_campus_prog['campus_code'];
                                        $poi = $t_campus_prog['program_of_interest_code'];
                                        $_REQUEST['new_program_of_interest'] = $poi;
                                        $cap_msg = '';
                                        break;
                                    }
                                } else {
                                    $cap_msg = 'Monthly Cap Limit Reached.';
                                }
                            }
                            
                        } else {
                            $cap_msg = 'Monthly Cap Limit Reached.';
                        }
                    }
                }
		                ///////////////
		            }
		        } else {
            		$cap_msg = 'Cap Limit Reached.';
		        }
		        if(isset($cap_msg) && !empty($cap_msg)) {
		        	Yii::app()->user->setFlash('error',$cap_msg);
	    			if($redirect_page_no==1) {
	    				// $this->actionCampus_cap_rejected_leads();
						$this->redirect('campus_cap_rejected_leads');
	    			} else {
	    				// $this->actionCampus_cap_rejected_leads();
						/**
						 * @functionality : If page edited from questionable lead then redirect to questionable leads page
	    				/**
						 * @functionality : Added value for redirect to particular page number
						 */
						$page_value = Yii::app()->request->getParam('pv');
	    				if($redirect_page_no == 'ql'){
	    					$pv = (!empty($page_value) ? $page_value : 1 );
							$this->redirect(array('leads/campus_cap_rejected_leads', 'ltype'=>'1','page'=>$pv));
	    				}else if($redirect_page_no == 'fl'){
	    					$pv = (!empty($page_value) ? $page_value : 1 );
							$this->redirect(array('leads/failedVerificationLeads','page'=>$pv));
	    				}else{
	    					$pv = (!empty($page_value) ? $page_value : 1 );
							$this->redirect(array('leads/campus_cap_rejected_leads','page'=>$pv));
							// $this->redirect($redirect_page_no);
						}
					}
					exit;
				}
				else {
                	//$t_affiliate_requested_lead = $model->update_campus_cap($_REQUEST['id'],'1');
					/**
					  * @description : function to get affiliate transaction id using submission id
					  * @since : 27-12-2016 19:35 PM
	 				 */
					$i_affiliate_trans_id = $_REQUEST['id'];
					$t_affiliate_trans_id = $model->getAffiliateTransactionId($_REQUEST['id']);
					if(isset($t_affiliate_trans_id[0]) && !empty($t_affiliate_trans_id[0])) {
						$i_affiliate_trans_id = $t_affiliate_trans_id[0]['id'];
					}
                	$t_affiliate_requested_lead = $model->update_campus_cap($i_affiliate_trans_id,'1');
					if(!empty($s_rejected_repost_lead_data)){                		
                		$t_affiliate_requested_lead[0]['post_request'] = $s_rejected_repost_lead_data;
                	}
	                if(isset($t_affiliate_requested_lead) && !empty($t_affiliate_requested_lead) && isset($t_affiliate_requested_lead[0]['post_request']) && !empty($t_affiliate_requested_lead[0]['post_request'])) {
	            			$t_phonecell = explode('&phonecell=',$t_affiliate_requested_lead[0]['post_request']);
	            			/*if(isset($t_phonecell) && !empty($t_phonecell)) {
	                			$t_mobile  =explode('&', $t_phonecell[1]);
	                			if(isset($t_mobile) && !empty($t_mobile)) {
	                				$mobile = $t_mobile[0];
	                			}
	                		}
	            			if(isset($mobile) && !empty($mobile)) {
	            				$t_affiliate_requested_lead[0]['post_request'] .= '&mobile='.$mobile;
	            			}*/
	            			if(isset($s_new_campus) && !empty($s_new_campus)) {
	            				$t_affiliate_requested_lead[0]['post_request'] = str_replace("campus=".$s_old_campus,"campus=".$s_new_campus,$t_affiliate_requested_lead[0]['post_request']);
	            			}

	            			if(isset($_REQUEST['new_program_of_interest']) && !empty($_REQUEST['new_program_of_interest'])) {
	            				$t_affiliate_requested_lead[0]['post_request'] = str_replace("program_of_interest=".$_REQUEST['program_of_interest'],"program_of_interest=".$_REQUEST['new_program_of_interest'],$t_affiliate_requested_lead[0]['post_request']);
	            			}
	                	if (AffiliatesController::actionCheckgeofootprint(1)) {
	                	} else {
	                		$t_campus_program_from_zip = AffiliatesController::actionGetCampusPorgramFromZipcode(1);
	                		if($t_campus_program_from_zip) {
	                			$t_affiliate_requested_lead[0]['post_request'] = str_replace("campus=".$s_new_campus,"campus=".$t_campus_program_from_zip['campus'],$t_affiliate_requested_lead[0]['post_request']);
	                			$t_affiliate_requested_lead[0]['post_request'] = str_replace("program_of_interest=".$_REQUEST['program_of_interest'],"program_of_interest=".$t_campus_program_from_zip['program'],$t_affiliate_requested_lead[0]['post_request']);
	                		} else {
								$model->update_campus_cap($t_affiliate_requested_lead[0]['id']);
	                			Yii::app()->user->setFlash('error','No Campus Found Near By Your Postal Code');
	                			if($redirect_page_no==1) {
									$this->redirect('campus_cap_rejected_leads');
	                			} else {
									/**
									 * @functionality : If page edited from questionable lead then redirect to questionable leads page
									 * @functionality : Added value for redirect to particular page number
									 */
				    				$page_value = Yii::app()->request->getParam('pv');
									if($redirect_page_no == 'ql'){
										$pv = (!empty($page_value) ? $page_value : 1 );
										$this->redirect(array('leads/campus_cap_rejected_leads', 'ltype'=>'1','page'=>$pv));
									}else if($redirect_page_no == 'fl'){
										$pv = (!empty($page_value) ? $page_value : 1 );
										$this->redirect(array('leads/failedVerificationLeads','page'=>$pv));
									}else{
										$pv = (!empty($page_value) ? $page_value : 1 );
										$this->redirect(array('leads/campus_cap_rejected_leads','page'=>$pv));
										// $this->redirect($redirect_page_no);
									}
								}
								exit;
	                		}
	                	}
	                	if(isset($_REQUEST['promo_code']) && !empty($_REQUEST['promo_code']) && isset($_REQUEST['new_promo_code']) && !empty($_REQUEST['new_promo_code']) && preg_match('/^[1-9][0-9]*$/',$_REQUEST['promo_code']) && $_REQUEST['promo_code']>0 && preg_match('/^[1-9][0-9]*$/',$_REQUEST['new_promo_code']) && $_REQUEST['new_promo_code']>0 && $_REQUEST['promo_code']!=$_REQUEST['new_promo_code']) {
	                		echo "1";
	                		$t_affiliate_requested_lead[0]['post_request'] = str_replace("promo_code=".$_REQUEST['promo_code'],"promo_code=".$_REQUEST['new_promo_code'],$t_affiliate_requested_lead[0]['post_request']);
	                	}
						/**
						 * @since : 13-12-2016 01:35 PM
						 * @functionality : Update Lead is_repost status = 1 if lead is reposted.
						 */
	                	$model->updateLeadToRepostLead($_REQUEST['id']);
	                	Yii::app()->session['is_lead_reposted'] = '1';
	                	$ch = curl_init(Yii::app()->getBaseUrl(true).'/index.php/edu/IndexProcess?'.$t_affiliate_requested_lead[0]['post_request'].'&ipaddress='.$t_affiliate_requested_lead[0]['ip'].'&repost=1');

						curl_setopt($ch, CURLOPT_HEADER, 0);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$repost_response = curl_exec($ch);
						Yii::app()->user->setFlash('repost_response',$repost_response);
						if (preg_match("~\bREJECTED\b~",strtoupper($repost_response))) {
							$model->update_campus_cap($t_affiliate_requested_lead[0]['id']);
							// $model->delete_last_submission();
							// $msg = 'Error Occured While Reposting Lead. Try Again.'.$repost_response;
							if (preg_match("~\bINVALID MOBILE NUMBER\b~",strtoupper($repost_response))) {
								$msg = "Invalid Mobile Number";
							} else if (preg_match("~\bINVALID PHONE NUMBER\b~",strtoupper($repost_response))) {
								$msg = "Invalid Phone Number";
							} else {
								$msg = 'Error Occured While Reposting Lead. Try Again.<br />'.$repost_response;
							}
							Yii::app()->user->setFlash('error',$msg);
						} else {
							Yii::app()->user->setFlash('success','Lead Reposted');
						}
						curl_close($ch);
						Yii::app()->session['is_lead_reposted'] = '0';
	        			if($redirect_page_no==1) {
							$this->redirect('campus_cap_rejected_leads');
	        			} else {
							/**
							 * @functionality : If page edited from questionable lead then redirect to questionable leads page
							 * @functionality : Added value for redirect to particular page number
							 */
		    				$page_value = Yii::app()->request->getParam('pv');
							if($redirect_page_no == 'ql'){
								$pv = (!empty($page_value) ? $page_value : 1 );
								$this->redirect(array('leads/campus_cap_rejected_leads', 'ltype'=>'1','page'=>$pv));
							}else if($redirect_page_no == 'fl'){
								$pv = (!empty($page_value) ? $page_value : 1 );
								$this->redirect(array('leads/failedVerificationLeads','page'=>$pv));
							}else{
								$pv = (!empty($page_value) ? $page_value : 1 );
								$this->redirect(array('leads/campus_cap_rejected_leads','page'=>$pv));
								// $this->redirect($redirect_page_no);
							}
						}
						exit;
					} else {
						Yii::app()->user->setFlash('error','Invalid Request');
	        			if($redirect_page_no==1) {
							$this->redirect('campus_cap_rejected_leads');
	        			} else {
							/**
							 * @functionality : If page edited from questionable lead then redirect to questionable leads page
							 * @functionality : Added value for redirect to particular page number
							 */
		    				$page_value = Yii::app()->request->getParam('pv');
							if($redirect_page_no == 'ql'){
								$pv = (!empty($page_value) ? $page_value : 1 );
								$this->redirect(array('leads/campus_cap_rejected_leads', 'ltype'=>'1','page'=>$pv));
							}else if($redirect_page_no == 'fl'){
								$pv = (!empty($page_value) ? $page_value : 1 );
								$this->redirect(array('leads/failedVerificationLeads','page'=>$pv));
							}else{
								$pv = (!empty($page_value) ? $page_value : 1 );
								$this->redirect(array('leads/campus_cap_rejected_leads','page'=>$pv));
								// $this->redirect($redirect_page_no);
							}
						}
						exit;
					}
				}
			} else {
				Yii::app()->user->setFlash('error','Invalid Lead');
    			if($redirect_page_no==1) {
					$this->redirect('campus_cap_rejected_leads');
    			} else {
					/**
					 * @since : 12-12-2016 04:52 PM
					 
					 * @functionality : If page edited from questionable lead then redirect to questionable leads page
					 */
					/**
					 * @since : 13-12-2016 10:38 AM
					 
					 * @functionality : Added value for redirect to particular page number
					 */
    				$page_value = Yii::app()->request->getParam('pv');
					if($redirect_page_no == 'ql'){
						$pv = (!empty($page_value) ? $page_value : 1 );
						$this->redirect(array('leads/campus_cap_rejected_leads', 'ltype'=>'1','page'=>$pv));
					}else if($redirect_page_no == 'fl'){
						$pv = (!empty($page_value) ? $page_value : 1 );
						$this->redirect(array('leads/failedVerificationLeads','page'=>$pv));
					}else{
						$pv = (!empty($page_value) ? $page_value : 1 );
						$this->redirect(array('leads/campus_cap_rejected_leads','page'=>$pv));
						// $this->redirect($redirect_page_no);
					}
				}
				exit;
			}
		}
		//$this->render('browseleads',array('posts' => $posts));
		$this->render('campus_cap_rejected_leads',array(
			'posts' => $posts,
			'pages' => $pages,
			'total' => $total
		));
	}

	public function actionGetCampuses($i_zip_code) {
		$o_edu_zip_codes = new EduZipCodes();
		$t_campuses = $o_edu_zip_codes->getCampusesZip($i_zip_code);
		return $t_campuses;
	}
	
	
	/**
	 * @since : 08-12-2016 06:36 PM
	 
	 * @functionality : Edit Lead Details For Reposting
	 */
	public function actionEditLeadDetails(){
		$i_submission_id = Yii::app()->request->getParam('id');
		/**
		 * @since : 09-12-2016 10:26 AM
		 
		 * @functionality : Added is_reposted flag for reposting after changing lead details
		 */
		$is_reposted = Yii::app()->request->getParam('is_reposted');
		if(!empty($is_reposted) && !empty($i_submission_id)){
			/**
			 * @since : 09-12-2016 10:26 AM
			 
			 * @functionality : Update current lead sent new lead details for repost
			 */
		 	$o_submission = new Submissions;
			$criteria = $o_submission->getRejectedLeadDetails($i_submission_id);
			$t_details = $o_submission->findAll($criteria);
			if(!empty($t_details)){
				/**
				 * @since : 12-12-2016 12:39 PM
				 
				 * @functionality : Set details for promo_code from post instead of database
				 */
				$s_repost_data = 'promo_code='.urlencode(Yii::app()->getRequest()->getPost('promo_code'));
				$s_repost_data.= '&password=testleadonly';
				$s_repost_data.= '&zip='.urlencode(Yii::app()->getRequest()->getPost('zip'));
				$s_repost_data.= '&first_name='.urlencode(Yii::app()->getRequest()->getPost('first_name'));
				$s_repost_data.= '&last_name='.urlencode(Yii::app()->getRequest()->getPost('last_name'));
				/**
				 * @since : 12-12-2016 01:32 PM
				 
				 * @functionality : Removed Urlencode from Email
				 */
				$s_repost_data.= '&email='.Yii::app()->getRequest()->getPost('email');
				$s_repost_data.= '&sub_id='.urlencode($t_details[0]->sub_id);
				$s_repost_data.= '&sub_id2='.urlencode($t_details[0]->sub_id2);
				$s_repost_data.= '&gender='.urlencode($t_details[0]->gender);
				$s_repost_data.= '&dob='.urlencode($t_details[0]->dob);
				$s_repost_data.= '&phone='.urlencode(Yii::app()->getRequest()->getPost('phone'));
				$s_repost_data.= '&mobile='.urlencode(Yii::app()->getRequest()->getPost('mobile'));
				$s_repost_data.= '&phonecell='.urlencode(Yii::app()->getRequest()->getPost('mobile'));
				$s_repost_data.= '&address='.urlencode(Yii::app()->getRequest()->getPost('address'));
				/**
				 * @since : 12-12-2016 12:39 PM
				 
				 * @functionality : Set details for campus from post instead of database
				 */
				$campus =  urlencode($t_details[0]->campus);
				$program_of_interest = urlencode($t_details[0]->program_of_interest);
				$s_campus = Yii::app()->getRequest()->getPost('campus');
				if(!empty($s_campus)){
					$t_campus = explode('@',$s_campus);
					/**
					 * @since : 14-12-2016 10:22 AM
					 
					 * @functionality : Changed count variable to counting of an array
					 */
					if(!empty($t_campus) && count($t_campus) == 2){
						$campus =  urlencode($t_campus[0]);
						$program_of_interest = urlencode($t_campus[1]);
					}
				}
				$s_repost_data.= '&campus='.$campus;
				$s_repost_data.= '&grad_year='.urlencode($t_details[0]->grad_year);
				$s_repost_data.= '&highest_education=1';
				$s_repost_data.= '&start_date=1';
				$s_repost_data.= '&learning_peference=2';
				$s_repost_data.= '&enrollment_time=0';
				$s_repost_data.= '&outstanding_loan=0';
				$s_repost_data.= '&military='.urlencode($t_details[0]->military);
				$s_repost_data.= '&city='.urlencode(Yii::app()->getRequest()->getPost('city'));
				$s_repost_data.= '&state='.urlencode(Yii::app()->getRequest()->getPost('state'));
				$s_repost_data.= '&universal_leadid='.urlencode($t_details[0]->lead_id);
				$s_repost_data.= '&lead_mode='.urlencode($t_details[0]->lead_mode);
				$s_repost_data.= '&program_of_interest='.$program_of_interest;
				/**
				 * @since : 12-12-2016 04:47 PM
				 
				 * @functionality : Changed campus from DB campus to Post Campus.
				 */
				$_REQUEST['campus'] = $campus;
				$_REQUEST['new_campus'] = $campus;
				$_REQUEST['program_of_interest'] = $program_of_interest;
				$_REQUEST['new_program_of_interest'] = $program_of_interest;
				$_REQUEST['zip'] = Yii::app()->getRequest()->getPost('zip');
				$this -> actionCampus_cap_rejected_leads($s_repost_data);
				exit;
			}else{
				$this->redirect(array('leads/EditLeadDetails', 'id'=>'1'));
			}
			exit;
		}


		/**
		 * @since : 09-12-2016 10:04 AM
		 
		 * @functionality : Fetched details from database for requested rejected lead for edit.
		 */
		if(!empty($i_submission_id)){		
			$o_submission = new Submissions;
			$criteria = $o_submission->getRejectedLeadDetails($i_submission_id);
			$t_details = $o_submission->findAll($criteria);
			if(!empty($t_details)){
				$this->render('edit_lead_details',array('i_submission_id'=>$i_submission_id,'t_details'=>$t_details));
				exit;
			}
		}
		Yii::app()->user->setFlash('error','Details Not Found.');
		/**
		 * @since : 12-12-2016 05:59 PM
		 
		 * @functionality : If page edited from questionable lead then redirect to questionable leads page
		 */
		/**
		 * @since : 14-12-2016 10:19 PM
		 
		 * @functionality : Changed parameter name of page redirection
		 */
		if(Yii::app()->request->getParam('rp') == 'ql'){
			$this->redirect(array('leads/campus_cap_rejected_leads', 'ltype'=>'1'));
		}else{
			$this->redirect('campus_cap_rejected_leads');
		}
	}
	
	
	
	/**
	* @since : 02-12-2016 12:32 PM
	
	* @functionality : Function to show report for phone verification for leads
	*/
	/**
	 * @since : 03-12-2016 09:07 AM
	 
	 * @functionality : Added criteria for pagination
	*/
	public function actionPhoneVerificationDetails(){
		$s_filter_date = Yii::app()->request->getParam('filter_date');
		$s_filter_date = urldecode($s_filter_date);
		if(!empty($s_filter_date)){
				$o_phoneverification = new PhoneVerification;
				$criteria = $o_phoneverification->getPhoneVerificationDates($s_filter_date);
				if(!empty($criteria)){
						$total = $o_phoneverification->count($criteria);
						$pages = new CPagination($total);
						$pages->pageSize = 10;
						$pages->applyLimit($criteria);
						$t_result = $o_phoneverification->findAll($criteria);
				}
				$this->render('phoneVerificationDetails',array('s_dates'=>$s_filter_date,'t_result'=>$t_result,'pages' => $pages,'total' => $total));exit;
		}
		$this->render('phoneVerificationDetails');
	}
	
	/**
	 * @since : 23-12-2016 01:25 PM
	 
	 * @functionality : Created function to display report for questionable leads
	 */
	public function actionQuestionableLeadReport(){
		$t_sub_ids = Submissions::model()->findAll(array(
			'select'=>'t.sub_id',
			'distinct'=>true,
			"condition"=>"t.sub_id !=  ''"
		));
		$o_submission = new Submissions;
		$t_questionable_leads = $o_submission->getQuestionableLeads();
		$this->render('questionable_leads_report',array('t_sub_ids'=>$t_sub_ids,'t_questionable_leads'=>$t_questionable_leads));
	}
	
	/**
		 * @since : 23-12-2016 03:44 PM
		 
		 * @functionality : Created function for add and edit paused direct post
		 */
		public function actionPauseDirectPost(){
			if(isset($_POST['isAjax'])){
				if($_POST['isAjax'] == 2){
					if(isset($_POST['promo_code']) && !empty($_POST['promo_code'])){
						$o_paused_affiliate = new PausedAffiliate;
						$t_affiliate = $o_paused_affiliate -> getPausedAffiliate('promo_code = '.$_POST['promo_code']);
						if(!empty($t_affiliate)){
							$o_paused_affiliate_detail = new PausedAffiliateDetail;
							$t_data = $o_paused_affiliate_detail -> getPausedSubIds('paused_affiliate_id = '.$t_affiliate[0]['id']);
							/**
							  * @author : 
							  * @description : get all the sub_ids from submissions table for the selected promo_code
							  * @since : 13-01-2017 12:47
							 */
							$o_submissions = new Submissions();
							$t_submitted_sub_ids = $o_submissions -> getSubIDFromPromoCode($_POST['promo_code']);
							if(isset($t_submitted_sub_ids) && !empty($t_submitted_sub_ids)) {
								$t_new_sub_ids = array();
								foreach ($t_submitted_sub_ids as $t_submitted_sub_id) {
									if(strlen($t_submitted_sub_id['sub_id'])>0) {
										$t_new_sub_ids[]['sub_id'] = $t_submitted_sub_id['sub_id'];
									}
								}
								$t_merge_sub_ids = array_merge($t_data, $t_new_sub_ids);
								$t_data = array();
								$t_data = array_values(array_unique($t_merge_sub_ids,SORT_REGULAR));
							}
							if(!empty($t_data)){
								echo json_encode(array('flag'=>true,'data'=>$t_data,'id'=>$t_affiliate[0]['id']));
								exit;
							}else{
								echo json_encode(array('flag'=>true,'id'=>$t_affiliate[0]['id']));
								exit;
							}
						} else {

							/**
							  * @author : 
							  * @description : get all the sub_ids from submissions table for the selected promo_code
							  * @since : 13-01-2017 12:49
							 */
							$o_submissions = new Submissions();
							$t_submitted_sub_ids = $o_submissions -> getSubIDFromPromoCode($_POST['promo_code']);
							if(isset($t_submitted_sub_ids) && !empty($t_submitted_sub_ids)) {
								$t_new_sub_ids = array();
								foreach ($t_submitted_sub_ids as $t_submitted_sub_id) {
									if(strlen($t_submitted_sub_id['sub_id'])>0) {
										$t_new_sub_ids[]['sub_id']=$t_submitted_sub_id['sub_id'];
									}
								}
								if(!empty($t_new_sub_ids)){
									echo json_encode(array('flag'=>true,'data'=>$t_new_sub_ids,'id'=>''));
									exit;
								}
							}
						}
					}
				}else{
					if(isset($_POST['promo_code']) && !empty($_POST['promo_code']) && isset($_POST['sub_ids'])){
						$o_paused_affiliate = new PausedAffiliate;					
						if(isset($_POST['paused_affiliate_id']) && !empty($_POST['paused_affiliate_id'])){
							PausedAffiliateDetail::model()->deleteAll("paused_affiliate_id = ".$_POST['paused_affiliate_id']);						
							if(!empty($_POST['sub_ids'])){
								$this -> saveAffiliateDetails($_POST['paused_affiliate_id'],$_POST['sub_ids']);
							}
							echo json_encode(array('flag'=>true,'id'=>$_POST['paused_affiliate_id'],));
							exit;
						}else{
							$o_paused_affiliate -> promo_code = $_POST['promo_code'];
							$o_paused_affiliate -> created_at = date('Y-m-d H:i:s');
							$o_paused_affiliate -> ip_address = $_SERVER['REMOTE_ADDR'];
							if(!empty($_POST['sub_ids']) && $o_paused_affiliate->save()){
								$i_last_id = $o_paused_affiliate->id;		
								$this -> saveAffiliateDetails($i_last_id,$_POST['sub_ids']);									
								echo json_encode(array('flag'=>true,'id'=>$o_paused_affiliate->id));
								exit;
							}
						}
					}
				}
				echo json_encode(array('flag'=>false));
				exit;
			}
			$this -> render('pause_direct_posting');
		}
		
		/**
		 * @since : 26-12-2016 10:22 AM
		 
		 * @functionality : Save affiliate details
		 */
		private function saveAffiliateDetails($i_affiliate_id,$t_sub_ids){
			if(!empty($i_affiliate_id) && !empty($t_sub_ids)){
				foreach($t_sub_ids as $i_id){
					$o_paused_affiliate_details = new PausedAffiliateDetail;
					$o_paused_affiliate_details -> paused_affiliate_id = $i_affiliate_id;
					$o_paused_affiliate_details -> sub_id = $i_id;
					$o_paused_affiliate_details -> created_at = date('Y-m-d H:i:s');
					$o_paused_affiliate_details -> ip_address = $_SERVER['REMOTE_ADDR'];
					$o_paused_affiliate_details -> save();
					unset($o_paused_affiliate_details);
				}
			}
		}
	
	/**
		  * @author : 
		  * @description : function to display list of rejected leads and send email to affiliates
		  * @since : 23-12-2016 16:08 PM
		 */
		public function actionEmailRejectedLeads() {
			$criteria = new CDbCriteria();
			$model = new Submissions();
			$redirect_page_no = 1;
			$msg = 0;
			if(isset($_REQUEST['page']) && !empty($_REQUEST['page'])) {
				$redirect_page_no = $_REQUEST['page'];
			}
			if(isset($_POST) && !empty($_POST)) {
				$id = $_POST['returns'];
			} else if(isset($_REQUEST) && isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
			}
			if(isset($id) && !empty($id)) {
				/**
				  * @author : 
				  * @description : check whether admin have selected more then one email id or not
				  * @since : 28-12-2016 11:37 AM
				 */
				if(is_array($id)) {
					$t_customer_ids = array();
					foreach ($id as $i_id) {
						$t_affiliate_trans_id = $model->getAffiliateTransactionId($i_id);
						if(isset($t_affiliate_trans_id[0]) && !empty($t_affiliate_trans_id[0])) {
							$t_customer_ids[] = $t_affiliate_trans_id[0]['id'];
						}
					}
					$criteria = $model->campus_cap_rejected_leads($t_customer_ids,1);
				} else {
					$t_affiliate_trans_id = $model->getAffiliateTransactionId($_REQUEST['id']);
					if(isset($t_affiliate_trans_id[0]) && !empty($t_affiliate_trans_id[0])) {
						$criteria = $model->campus_cap_rejected_leads($t_affiliate_trans_id[0]['id'],1);
					} else {
						$criteria = $model->campus_cap_rejected_leads($id,1);
					}
				}
				unset($id);
				$email_posts = $model->findAll($criteria);
				if(isset($email_posts) && !empty($email_posts)) {
					foreach ($email_posts as $email_post) {
						/**
						  * @author : 
						  * @description : submission id change by affiliate_trasaction id
						  * @since : 28-12-2016 10:47 AM
						 */
						$i_id = $email_post['id'];
						$t_aff_trans_id = $model->getAffiliateTransactionId($email_post['id']);
						if(isset($t_aff_trans_id[0]) && !empty($t_aff_trans_id[0])) {
							$i_id = $t_aff_trans_id[0]['id'];
						}
						$i_lead_mode = $email_post['lead_mode'];
						$i_promo_code = $email_post['promo_code'];
						$s_first_name = $email_post['first_name'];
						$s_email = $email_post['email'];
						$s_sub_date = date("Y-m-d", strtotime($email_post['sub_date']));
						$link = 'promo_code='.$i_promo_code.'&id='.$i_id;
						//$lead_link = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'].'/affiliates/landingpage3?'.$link);
						$lead_link = 'http://higherlearningapp.com/index.php/landpage3?'.$link;
						$email_link = "<a href='".$lead_link."'>here</a>";
						// $unsubscribe_link = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'].'/affiliates/removeemail?email='.$s_email);
						$unsubscribe_link = 'http://www.higherlearningapp.com/index.php/removeme?id='.$i_id;
						
						$o_affiliate_user = new AffiliateUser();
						$is_email_exists = $o_affiliate_user->checkSupressionEmailExist($s_email,1);
						/**
						  * @author : 
						  * @description : bcc email ids added
						  * @since : 13-01-2017 18:25
						 */
						if($is_email_exists == 1) {
							if($i_lead_mode == 1) {
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= 'From: Higher Learning App <support@higherlearningapp.com>' . "\r\n";
								$headers .= 'Bcc: vic@elitemate.com, elitematevic@gmail.com, vic@higherlearningmarketers.com';

								$subject = "Please review and resubmit your information to Higher Learning App";

								$mailmessage = "Hi ".$s_first_name.",<br /><br />";
								$mailmessage .= "Hope all is well. On ".$s_sub_date." you submitted your application to Higher Learning App and some of the information was incorrect, failed our application verification and wasn't submitted to any colleges. Sometimes this happens with typos in your name, postal address, email or telephone number. Please review and edit your application ".$email_link." if you are still interested. A nearby interested college will contact you shortly after you resubmit your corrected application to Higher Learning App. Colleges usually will call, email, text or send a postal mail to you to supply more information about enrolment and financial assistance. If you do not get contacted by a college near you within a few days please email us at support@higherlearningapp.com or call 718 699-1904 or write to us at HigherLearningApp.com - 105-10 62nd Road, Suite 1D, Forest Hills, NY 11375. All the best!<br /><br />";
								$mailmessage .= "Have a great day!<br /><br />";
								$mailmessage .= "Sincerely,<br /><br />";
								$mailmessage .= "Higher Learning app<br />";
								$mailmessage .= "support@higherlearningapp.com<br />";
								$mailmessage .= "Helping People Find Nearby Colleges<br /><br />";
								$mailmessage .= "HigherLearningApp.com - 105-10 62nd Road, Suite 1D, Forest Hills, NY 11375<br /><br />";
								$mailmessage .= "<a href='".$unsubscribe_link."'>Unsubscribe</a>";
								
								if(mail($s_email, $subject, $mailmessage, $headers)) {
									$msg = 1;
								}
							}
						} else {
							$msg = 2;
						}
					}
				}
				
				if($msg == 1) {
					Yii::app()->user->setFlash('success','Email Sent Successfully.');
				} else if($msg == 2) {
					Yii::app()->user->setFlash('error','Email is in Supression List.');
				} else {
					Yii::app()->user->setFlash('error','Error Occured While Sending Email. Try Again.');
				}
				$this->redirect('emailrejectedleads');
			}
			
			/**
			  * @author : 
			  * @description : code to avoid search for email_rejected_leads page
			  * @since : 28-12-2016 11:05 PM
			 */
			$criteria = $model->campus_cap_rejected_leads('',1);
			$total = $model->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = 10;
			$pages->applyLimit($criteria);
			$posts = $model->findAll($criteria);

			$o_affiliate_user = new AffiliateUser();
			$table = 'edu_email_supression_list';
			$fields = 'email';
			$t_emails = array();

			/**
			  * @author : 
			  * @description : List of emails which are in suppression list
			  * @since : 23-12-2016 18:47 PM
			 */
			$supression_emails = $o_affiliate_user->downloadSupressionList($fields,$table);
			if(isset($supression_emails) && !empty($supression_emails)) {
				foreach ($supression_emails as $supression_email) {
					$t_emails[] = $supression_email['email'];
				}
			}
			$this->render('email_rejected_leads',array(
				'posts' => $posts,
				'pages' => $pages,
				'total' => $total,
				'supression_emails' => $t_emails
			));
		}
	
}
?>
