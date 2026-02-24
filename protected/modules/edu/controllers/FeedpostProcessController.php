<?php
class FeedpostProcessController extends Controller{	
	
	public $layout='/column1';
	
	public function actionIndex(){
		/**
		 ** Author : Vatsal Gadhia
		 ** Modification : db_edu component replaced by db so that data can be access from new db of edu module
		 ** Modification Date : 01-08-2016
		**/
	    $connection=Yii::app()->db;
		FeedSubmissionsController::actionValidationCheck();
		$Feed_Lender_Transactions_model = new FeedLenderTransactions();
		$Feed_Lender_Transactions_model->actionLenderTransaction($_POST);
		$model = new EduFeedVendors;
		$status = $model->checkVendorStatus();
		
        $this->pingFeedLenders('feed');
	}
	
	public static function pingFeedLenders($called_from_interface='feed'){
		/**
		 ** Author : Vatsal Gadhia
		 ** Modification : db_edu component replaced by db so that data can be access from new db of edu module
		 ** Modification Date : 01-08-2016
		**/
		$connection=Yii::app()->db;
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		if($called_from_interface=='testfeedlender'){
			$Submissions = Yii::app()->getRequest()->getParam('Submissions');
			$model = new FeedSubmission();
			$data = $_POST;
			$model->attributes = $data;
			$model->city = $Submissions['city'];
			$model->state = $Submissions['state'];
			$model->source = 'self';/*Yii::app()->getRequest()->getParam('url', Yii::app()->getRequest()->getParam('source'));*/
			$model->save();
		}else{
			/** check for duplicate feed */
			FeedSubmissionsController::actionCheckDuplicate($called_from_interface);
		}
		
		if(!empty($_REQUEST['EduFeedLenders']['feed_lender_name'])){
			$feedLenders = EduFeedLenders::model()->findAll(array("condition"=>"id =".$_REQUEST['EduFeedLenders']['feed_lender_name']));
		}else{
			$dataProvider = new CActiveDataProvider('EduFeedLenders',array('criteria'=>array('condition'=>'status = 1')));
			$feedLenders = $dataProvider->getData();
		}
		
		if(isset($feedLenders) && !empty($feedLenders))
		{
			foreach($feedLenders as $feedlender){
				$model = new EduFeedLenders();
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
					if($feedlender->submission_cap > $count || $feedlender->submission_cap==-1){
						if($time_elapsed > $feedlender->interval || $feedlender->interval ==0 || $feedlender->interval=='0'){
							$lendername = $feedlender->feed_lender_name;
							$LenderClassName = $lendername.'Controller';
							$methodName = 'sendPostData';
							$confirmation_id = '';
							$post_url = $feedlender->post_url;
							$lender_status = $feedlender->status;
							require 'feed_lenders/'.$LenderClassName.'.php';
						$ping = $controller::doConnect($feedlender->feed_lender_name,$_REQUEST,$feedlender->parameter1,$feedlender->parameter2,$feedlender->parameter3,$feedlender->post_url,$feedlender->test_url,$vendor_id,$start_time);
							// die("@#$@#$");
								
							/**
							 ** author : vatsal gadhia
							 ** description : code removed from comment to update post accepted status in "feed_lenders_vendors_transactions"
							 ** date : 22-08-2016
							 */
							$lender_vendor_trans_model = new FeedLenderVendorTransaction();
							$lender_vendor_trans_model->lender_post_status_update($lendername,$vendor_id,$ping,'0.000','true');
							$time_end = CommonToolsMethods::stopwatch();
							$post_time = ($time_end - $start_time);
							$cm->setFeedAcceptRespond($post_time,$lendername,$vendor_id);
						}else{
							$cm->setRespondErrorTimeIntervalFeed($feedlender->feed_lender_name,$feedlender->interval);
						}
					}else{
						$cm->setRespondErrorCapFeed($feedlender->feed_lender_name,$feedlender->submission_cap);
					}
				}
				else{
					$time_end = CommonToolsMethods::stopwatch();
					$post_time = ($time_end - $start_time);
					$cm->setPausedFeedVendorFoundRespond($post_time);
				}
			}
		}
		else{
			$time_end = CommonToolsMethods::stopwatch();
			$post_time = ($time_end - $start_time);
			$cm->setNoFeedLenderFoundRespond($post_time);
		}
	}
}
