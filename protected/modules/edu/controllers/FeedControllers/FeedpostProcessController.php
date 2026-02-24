<?php
class FeedpostProcessController extends Controller{	
	
	public $layout='//layouts/auto/column2';
	
	public function actionIndex(){
		/**
		 ** Author : Vatsal Gadhia
		 ** Modification : db_edu component replaced by db so that data can be access from new db of edu module
		 ** Modification Date : 01-08-2016
		**/
	    $connection=Yii::app()->db;
		$cm = new CommonMethods();
		FeedSubmissionsController::actionValidationCheck();
		$model = new AutoFeedVendor;
		$status = $model->checkVendorStatus();
		
        $this->pingFeedLenders('feed');
        
	}
	
	public function pingFeedLenders($called_from_interface='feed'){
		//echo '<pre>';print_r($_POST);echo '</pre>';exit;
		
		if($called_from_interface=='testfeedlender'){
			$Submissions = Yii::app()->getRequest()->getParam('Submissions');
			$model = new FeedSubmission();
			$data = $_POST;
			$model->attributes = $data;
			$model->city = $Submissions['city'];
			$model->state = $Submissions['state'];
			$model->source = Yii::app()->getRequest()->getParam('url', Yii::app()->getRequest()->getParam('source'));
			$model->save();
		}else{
			/** Give duplicate lead error if lead is duplicate else insert new data */
			FeedSubmissionsController::actionCheckDuplicate($called_from_interface);
		}
			
		/**
		 ** Author : Vatsal Gadhia
		 ** Modification : db_edu component replaced by db so that data can be access from new db of edu module
		 ** Modification Date : 01-08-2016
		**/
		$connection=Yii::app()->db;
		$cm = new CommonMethods();
		
		if(!empty($_REQUEST['AutoFeedLenders']['feed_lender_name'])){
			$feedLenders = AutoFeedLenders::model()->findAll(array("condition"=>"id =".$_REQUEST['AutoFeedLenders']['feed_lender_name']));
		}else{
			$dataProvider = new CActiveDataProvider('AutoFeedLenders',array('criteria'=>array('condition'=>'status = 1')));
			$feedLenders = $dataProvider->getData();
		}
		//echo '<pre>';print_r($feedLenders);echo '</pre>';exit;
		
		foreach($feedLenders as $feedlender){
			$model = new AutoFeedLenders();
			$vendor_id = Yii::app()->getRequest()->getParam('vendor_id');
			$boolean = $model->check_caps($feedlender->feed_lender_name,$vendor_id);
			if($boolean){
				$controller = $feedlender->feed_lender_name .'Controller';
				
				$criteria=new CDbCriteria;
				$criteria->select='date';
				$criteria->condition = "'feed_lender_name' = '". $feedlender->feed_lender_name ."' AND DATE(date) = '".date('Y-m-d')."'";
				$rows = FeedLenderTransactions::model()->find($criteria);
				$count = FeedLenderTransactions::model()->count($criteria);
				
				$to_time = strtotime($rows['date']);
				$from_time = strtotime(date('Y-m-d H:i:s'));
				$time_elapsed = round(abs($to_time - $from_time)/60,2);
				
				/** Checking time interval */
				if((empty($time_elapsed) OR  $time_elapsed=='')){
					$time_elapsed = 0;
				}
				if($feedlender->submission_cap > $count){
					if($time_elapsed > $feedlender->interval || $feedlender->interval ==0 || $feedlender->interval=='0'){
						$ping = $controller::doConnect($feedlender->feed_lender_name,$_REQUEST,$feedlender->parameter1,$feedlender->parameter2,$feedlender->parameter3,$feedlender->post_url,$feedlender->test_url);
					}else{
						$cm->setRespondErrorTimeIntervalFeed($feedlender->feed_lender_name,$feedlender->interval);
					}
				}else{
					$cm->setRespondErrorCapFeed($feedlender->feed_lender_name,$feedlender->cap);
				}
			}
		}
		//exit;
	}
	
	/*public function actioncheckcap(){
		$model = new AutoFeedLenders();
		$boolean = $model->check_caps('Axiombpmfeed',1);
	}*/
}
