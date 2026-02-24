<?php

ini_set('display_errors', 1);
ini_set('memory_limit', '-1');

class LeadsController extends Controller {

    public $layout = 'column1';

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            //allow all users to perform these actions
            array('allow',
                'actions' => array('view', 'postaccept', 'successAffiliate', 'nolenderfound'),
                'users' => array('*'),
            ),
            // allow authenticated user to perform these actions
            array(
                'allow',
                'actions' => array(''),
                'users' => array('@')
            ),
            //allow admin user to perform these actions
            array(
                'allow',
                'actions' => array('index', 'browsetransaction', 'failedleads', 'exportleads', 'lendertransaction', 'returnleads', 'postedleads', 'lead_info', 'browseleads'),
                'users' => array('admin')
            ),
            //deny all users
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function loadModel($id) {
        $model = Submissions::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionIndex() {
        $this->actionBrowsetransaction();
    }

    public static function actionAffiliateTransaction($data, $process = 'organic') {
        $is_organic = ($process == 'organic') ? 1 : 0;
        $ping_id = Yii::app()->request->getParam('ping_id','');
        if ($ping_id !='' && Yii::app()->session['ping_type'] == 'post') {
            $ping_id = $data['ping_id'];
            $aff_trans = AffiliateTransactions::model()->findByPk($ping_id);
            if(!empty($aff_trans)){
                $aff_trans->post_request = http_build_query($_POST);
                if ($aff_trans->validate()) {
                    $aff_trans->save();
                    Yii::app()->session['affiliate_trans_id'] = $ping_id;
                } else {
                    echo $aff_trans->getErrors();
                }
            }else{
                $cm = new CommonMethods();
                $cm->setRespondError('', 'nopingidfound', $process);
            }    
        } elseif (($ping_id=="" || $ping_id == null) && Yii::app()->session['ping_type'] == 'directpost'){
            $model_aff_trnsaction = new AffiliateTransactions();
            $model_aff_trnsaction->attributes = $data;
            $model_aff_trnsaction->date = date('Y-m-d H:i:s');
            $model_aff_trnsaction->ip = Yii::app()->request->userHostAddress;
            $model_aff_trnsaction->promo_code = isset($data['promo_code']) ? $data['promo_code'] : '';
            $model_aff_trnsaction->sub_id = isset($data['sub_id']) ? $data['sub_id'] : '';
            //12.7.2017
            $model_aff_trnsaction->sub_id2 = isset($data['sub_id2']) ? $data['sub_id2'] : '';
            $model_aff_trnsaction->post_request = http_build_query($_POST);
            $model_aff_trnsaction->posting_type = 1; // 0=pingpost, 1=directpost
            $model_aff_trnsaction->is_organic = $is_organic;
            $model_aff_trnsaction->insert();
            Yii::app()->session['affiliate_trans_id'] = Yii::app()->dbAutoinsurance->lastInsertID;
        } else {
            $model_aff_trnsaction = new AffiliateTransactions();
            $model_aff_trnsaction->date = date('Y-m-d H:i:s');
            $model_aff_trnsaction->ip = Yii::app()->request->userHostAddress;
            $model_aff_trnsaction->promo_code = isset($data['promo_code']) ? $data['promo_code'] : '';
            $model_aff_trnsaction->sub_id = isset($data['sub_id']) ? $data['sub_id'] : '';
            $model_aff_trnsaction->ping_request = http_build_query($_POST);
            $model_aff_trnsaction->posting_type = 0; // 0=pingpost, 1=directpost
            $model_aff_trnsaction->is_organic = $is_organic;
            $model_aff_trnsaction->insert();
            Yii::app()->session['affiliate_trans_id'] = Yii::app()->dbAutoinsurance->lastInsertID;
        }
    }

    public function actionBrowsetransaction() {
        if (!empty($_POST)) {
            foreach ($_POST as $search_field => $search_field_value) {
                $_SESSION['browse_searched_parameters'][$search_field] = $search_field_value;
            }
        }
        if ($searched_parameters = Yii::app()->session['browse_searched_parameters']) {
            foreach ($searched_parameters as $search_field => $search_field_value) {
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
        $this->render('browsetransaction', array(
            'posts' => $posts,
            'pages' => $pages,
            'total' => $total
        ));
    }

    public function actionFailedleads() {
        $this->render('failed_leads');
    }

    public function actionExportleads() {
        if (Yii::app()->request->getParam('export') == 'Export') {
            $model = new Submissions();
            $rawData = $model->exportleads();
            //echo'<pre>';print_r($rawData);echo'</pre>';
            if (!empty($rawData)) {
                $csv_output = '';
                header("Content-type:text/octect-stream");
                header("Content-Disposition:attachment;filename=data.csv");
                $header = implode(',', array_keys($rawData[0]));
                $csv_output .= $header . "\n";
                foreach ($rawData as $key => $value) {
                    $csv_output .= '"' . stripslashes(implode('","', $value)) . "\"\n";
                }
                print $csv_output;
                exit();
            } else {
                $this->render('exportleads', array("NoDataFound" => true));
                Yii::app()->end();
            }
        } else {
            $this->render('exportleads');
        }
    }

    public function actionLendertransaction() {
        $model = new LenderTransactions();
        $rawData = $model->browselendertransction();
        $this->render('lendertransaction', array('rawData' => $rawData));
    }

    public function actionSuccessAffiliate() {
        $process = 'organic';
        $affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
        $model = new AffiliateTransactions();
        list($exit_url, $pixel, $response) = $model->log_redirect($affiliate_trans_id, $process);
        if ($exit_url == '' && $pixel == 0) {
            header('Location:' . Yii::app()->params['httphost'] . Yii::app()->params['frontEndAuto'] . '/index.php/thankyou');
            exit;
        } else if ($exit_url != '' && $pixel == 0) {
            header('Location:' . $exit_url);
        } else {
            header('Location:' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'] . '/affiliates/pixelCodeDisplay?pixel=' . $pixel . '&affiliate_trans_id=' . $affiliate_trans_id));
            exit;
        }
    }

    public function actionPostaccept() {
        $process = 'inorganic';
        $model = new AffiliateTransactions();
        list($exit_url, $pixel, $response) = $model->log_redirect($_REQUEST['affiliate_trans_id'], $process);
        if ($response == '') {
            if ($exit_url == '') {
                // No Exit URL then Redirect to Private Labeled Site Homepage
                // No Exit URL so we will not update redirect=yes in affiliate transaction and submission table
                header('Location:' . Yii::app()->params['httphost'] . Yii::app()->params['frontEndAuto'] . '/index.php/thankyou');
                exit;
            } else {
                header('Location:' . $exit_url);
                exit;
            }
        } else {
            echo $response;
            exit;
        }
    }

    public function actionNolenderfound() {
        $this->render('nolenderfound');
    }

    public static function actionValidationCheck($data, $process = 'organic') {
        $model = new Submissions();
        $model->attributes = $data;
        if (!$model->validate()) {
            $cm = new CommonMethods();
            $getError = $model->getErrors();
            $erroall1 = '';
            foreach ($getError as $errorsall => $value) {
                foreach ($value as $errorsalls) {
                    $erroall1 .= $errorsalls . ',';
                }
            }
            $all_errors = 'Missing or invalid fields: ' . $erroall1;
            if ($process == 'inorganic') {
                $cm->setRespondError($model->getErrors(), 'submission', $process);
            } else {
                $request = '';
                foreach ($data as $key => $value) {
                    $request .= '&' . $key . '=' . urlencode($value);
                }
                Yii::app()->getController()->redirect(Yii::app()->params['httphost'] . Yii::app()->params['frontEndAuto'] . '/index.php?' . $request . '&error=' . $all_errors);
            }
        }
    }
    /*
        actionCheckDuplicate
        THIS FUNCTION IS CALLED WHILE POST ONLY
    */
    public static function actionCheckDuplicate($data, $process = 'organic') {
        /* THIS FUNCTION IS ONLY FOR POST, FOR PING checkPingDuplicate , HENCE CALLING BELOW FUNCTION NOT REQUIRED ANYMORE, THUS COUNT=0 */
        //$model = new Submissions();
        //$count = Yii::app()->request->getParam('ping_id') ? 0 : $model->checkDuplicate($data);
        $count = 0;
        if (!empty($count) && $count > 0) {
            /** Update affiliate's daily count */
            $duplicate = 1;
            $aff_post_status = 0;
            $promo_code = Yii::app()->request->getParam('promo_code');
            AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_post_status, $duplicate);
            $cm = new CommonMethods();
            $cm->setRespondError('', 'duplicate', $process);
        } else {
            if (Yii::app()->request->getParam('ping_id')) {
                $aff_trans = AffiliateTransactions::model()->findByPk(Yii::app()->session['affiliate_trans_id']);
                if ($aff_trans->customer_id) {
                    /* IF THERE IS AN VALIDATION ERROR WHILE SENDING 'POST' THEN SAVE METHOD WILL NOT WORK, YOU MUST USE UPDATE METHOD */
                    /*$newsubmission = Submissions::model()->findByPk($aff_trans->customer_id);
                    $newsubmission->attributes = $data;
                    $newsubmission->save();*/
                    Submissions::model()->updateByPk($aff_trans->customer_id,$data);
                }
            } else {
                $model = new Submissions();
                $model->attributes = $data;
                $model->posting_type = 1; // 0=pingpost, 1=directpost
                $model->is_organic = ($process == 'organic') ? 1 : 0;
                //error_log(var_dump($model), 1);
                $model->save();
                Yii::app()->session['customer_id'] = $model->id;
            }
        }
    }

    public static function actionCheckPingDuplicate($data, $process = 'organic') {
        $model = new Submissions();
        $count = $model->checkPingDuplicate($data);
        /* if($_SERVER['REMOTE_ADDR']=='192.168.1.188'){
          print_r($count);exit;
          } */
        if (!empty($count) && $count > 0) {
            /** Update affiliate's daily count */
            $duplicate = 1;
            $aff_ping_status = 0;
            $promo_code = Yii::app()->request->getParam('promo_code');
            AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_ping_status, $duplicate);
            $cm = new CommonMethods();
            $cm->setRespondError('', 'duplicate', $process);
        } else {
            $model->attributes = $data;
            $city_state = $model->getCityStateFromZip($data['zip']);
            $model->city = $city_state['city'];
            $model->state = $city_state['state'];
            $model->posting_type = 0; // 0=pingpost, 1=directpost
            $model->is_organic = ($process == 'organic') ? 1 : 0;
            $model->save();
            Yii::app()->session['customer_id'] = $model->id;
        }
    }

    public static function check_Ping_Id_Existence($ping_id) {
        $aff_trans = AffiliateTransactions::model()->findByPk($ping_id);
        if (empty($aff_trans)) {
            $cm = new CommonMethods();
            $cm->NoPingFound($ping_id);
            exit;
        }
        $hasTAVCsData = Yii::app()->request->getParam('hasTAVCs');
        if (strpos($aff_trans->ping_request, "hasTAVCs=$hasTAVCsData") == false) {
            $post_response = '<?xml version="1.0"?>';
            $post_response .= '<PostResponse>';
            $post_response .= '<Response>REJECTED</Response>';
            $post_response .= '<Reason>hasTAVCs not mattached with Ping Data</Reason>';
            $post_response .= '</PostResponse>';
            header('Content-Type: text/xml');
            echo $post_response;
            exit;
        }
    }

    public function actionReturnleads(){
		if(Yii::app()->request->getParam('export')=='Export'){
			//echo'<pre>===';print_r($_POST);echo'</pre>';
			$model = new Submissions();
			$criteria = $model->search_return_leads();
			$rawData = $model->findAll($criteria);
			//echo'<pre>----';print_r($rawData);echo'</pre>';EXIT;
			if(!empty($rawData)) {
				$headers = "Ipaddress,First Name,Last Name,Email,Promo Code,status,Return reason,Date Submission";
	        	$csv_output = '';
				foreach($rawData as $raw){
					$raws['ipaddress']         = $raw->ipaddress;
					$raws['driver1_first_name'] = $raw->driver1_first_name;
					$raws['driver1_last_name']  = $raw->driver1_last_name;
					$raws['email']             = $raw->email;
					$raws['promo_code']        = $raw->promo_code;
					$raws['lead_status']       = $raw->is_returned ==1 ? RETURNED : ACCEPTED;
					$raws['return_reason']         = $raw->return_reason;
					//$raws['lender_id']         = $raw->lender_id;
					//$raws['lender_lead_price'] = $raw->lender_lead_price;
					$raws['sub_date']   	   = $raw->sub_date;
					$csv_output .= stripslashes(implode(',',$raws)) . "\n";
				}
				//print_r($csv_output);exit;
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
			}
		}
		if($searched_parameters = Yii::app()->session['returned_leads_searched_parameters']){
			foreach($searched_parameters as $search_field => $search_field_value){
				$_POST[$search_field] = $search_field_value;
			}
		}
		$model = new Submissions();
		$returns = Yii::app()->getRequest()->getParam('returns');
		if(!empty($returns)){
			$model->update_returned_leads($returns);
			//$this->redirect('returnleads');  // this is disable for sarah 
		}
		$criteria = $model->search_return_leads();
		$total = $model->count($criteria);
		/** For paggination uncomment these lines */
		/* $pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria); */
		$posts = $model->findAll($criteria);
		
		$this->render('returnleads',array(
			'posts' => $posts,
			/* 'pages' => $pages, */
			'total' => $total,
		));
	}
    public function actionPostedleads() {
        $model = new AffiliateTransactions();
        $posts = $model->search_posted_leads();
        $searched_data = array();
        $filter = Yii::app()->getRequest()->getParam('filter_date', date("Y-m-d"));
        $filter = explode(' - ', $filter);
        $count = count($filter);
        if ($count == 2) {
            $start_date = date("Y-m-d", strtotime($filter[0]));
            $end_date = date("Y-m-d", strtotime($filter[1]));
        } else {
            $start_date = date("Y-m-d", strtotime($filter[0]));
            $end_date = date("Y-m-d", strtotime($filter[0]));
        }
        $searched_data['filter_date']['start_date'] = $start_date;
        $searched_data['filter_date']['end_date'] = $end_date;
        $this->render('postedleads', array(
            'posts' => $posts,
            'searched_data' => $searched_data
        ));
    }

    public function actionLead_info() {
        $submission_model = new Submissions();
        $haystack = $_SERVER['HTTP_REFERER'];
        $needle = 'postedleads';
        $lead_info_reports = (strpos($haystack, $needle)) ? $submission_model->lead_info_posted_leads() : $submission_model->lead_info_reports();
        $this->render('lead_info', array('lead_info_reports' => $lead_info_reports));
    }

    public function actionBrowseleads() {
        if (!empty($_POST)) {
            foreach ($_POST as $search_field => $search_field_value) {
                $_SESSION['browse_searched_parameters'][$search_field] = $search_field_value;
            }
        }
        if ($searched_parameters = Yii::app()->session['browse_searched_parameters']) {
            foreach ($searched_parameters as $search_field => $search_field_value) {
                $_POST[$search_field] = $search_field_value;
            }
        }
        $model = new Submissions();
        $criteria = $model->browseleads();
        $posts = $model->findAll($criteria);
        if (Yii::app()->request->getParam('export') == 'Export') {
            Yii::import('ext.ECSVExport');
            if (!empty($posts)) {
                $posts = $model->findAll($criteria);
                $filename = 'csvfile.csv';
                $csv = new ECSVExport($posts);
                $content = $csv->toCSV();
                Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
                unset($_SESSION['browse_searched_parameters']['export']);
                exit();
            }
        }
        $this->render('browseleads', array('posts' => $posts));
    }
}
?>
