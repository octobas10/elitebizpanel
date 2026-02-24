<?php
class BrowseVendorLenderTransactionController extends Controller{
	public $layout ='column1';
	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
			
		);
	}
	public function accessRules(){
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','failedLeads','listLeads'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex(){
		$model = new FeedLenderTransactions();
		$rawData=$model->browsefeedlendertransction();
		$this->render('index', array('rawData'=>$rawData));	
	}
	public function actionFailedLeads(){
	  $this->render('failed_leads');
	}
	public function actionListLeads(){
		$model = new AutoFeedVendor();
		$rawData=$model->listfeedbrowseleads();
		if((Yii::app()->request->getParam('yt1')) && Yii::app()->request->getParam('yt1')=='Export'){
			$csv_output = '';
			$csv_output .= 'id,feed_vendor_id,first_name,last_name,email,gender,dob,phone,cell,address,city,zip,state,source,sub_date,status'."\"\n";
			header("Content-type:text/octect-stream");
	        header("Content-Disposition:attachment;filename=data.csv");
	        
		    foreach($rawData as $key=>$value){
			 	    $csv_output .= '"' . stripslashes(implode('","',$value)) . "\"\n";
			}
			print $csv_output; exit;
		}else{
			$this->render('list_leads',array('rawData'=>$rawData));
		}
	}
}
