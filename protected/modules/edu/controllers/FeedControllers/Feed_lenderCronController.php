<?php
class Feed_lenderCronController extends Controller{	
	public function actionIndex(){
		/*
			1) Select all the active lenders with selected columns, There will be more than 1 lenders
			2) colums to be get : feed_lender_name,parameter(s),paused_vendor,submission_cap,accepted_cap,dailysubmission_capcount,dailyaccepted_capcount,capdate,
			3) get all the data to be sent to lenders , loop for data
			4) check for cap , call check for cap function
			5) if check cap returns true then send lead to lender
			6) call connection if if get true from check cap function
		*/
		$dataProvider = new CActiveDataProvider('AutoFeedLenders',array('criteria'=>array('condition'=>'status = 1')));
			
		/**
		 ** Author : Vatsal Gadhia
		 ** Modification : db_edu component replaced by db so that data can be access from new db of edu module
		 ** Modification Date : 01-08-2016
		**/
		$connection=Yii::app()->db;
		$feed_lenders = $dataProvider->getData();
		foreach($feed_lenders as $lender){
			// GET DATA FOR THE LENDER FROM SUBMISSION TABLE.
			$model = new FeedSubmission();
			$feed_submissions = $model->getSubmissionData($lender->delay,$lender->limit,$lender->commit_point);
			$feed_submissions1 =  (end($feed_submissions)); 
			$commit_point	 = ($feed_submissions1['id']); 
			$timestamp_lastsent	 = $feed_submissions1['sub_date']; 
			foreach($feed_submissions as $feed){
				// data & lender
				$model = new AutoFeedLenders();
				$boolean = $model->check_caps($lender->feed_lender_name);
				if($boolean){
					// connect wala function
					$FeedLenderClassName = $lender->feed_lender_name .'Controller';
					$methodName ='doConnect';
					// send data and information of lender like URL
					$FeedLender_response=call_user_func_array(array($FeedLenderClassName, $methodName), array($lender->feed_lender_name,$feed,$lender->parameter1,$lender->parameter2,$lender->parameter3,$lender->post_url,$lender->test_url));
					//*** update capdate,dailysubmission_capcount *//
					$sql="UPDATE auto_feed_lenders SET dailysubmission_capcount = IF(capdate = '".@date('Y-m-d')."' , dailysubmission_capcount+1 , 0 ) , capdate= '".@date('Y-m-d')."' WHERE feed_lender_name='".$lender->feed_lender_name."'";
					$command=$connection->createCommand($sql);
					$dataReader=$command->query();
					if($FeedLender_response == '1'){
						/** if lead ACCEPTED then dailyacceptcapcount incrmented */
						$sql1="UPDATE auto_feed_lenders SET dailyaccepted_capcount = IF(capdate = '".@date('Y-m-d')."' , dailyaccepted_capcount+1 , 0 ) , capdate= '".@date('Y-m-d')."' WHERE feed_lender_name='".$lender->feed_lender_name."'";
						$command=$connection->createCommand($sql1);
						$dataReader=$command->query();
					}
				}
				
			}
		    /** if there is no lead to send then commit point and timestamp should not update  **/
			if(count($feed_submissions) > 0){
				/**
				 ** Author : Vatsal Gadhia
				 ** Modification : db component replaced by db_edu so that data can be access from new db of edu module
				 ** Modification Date : 01-08-2016
				**/
				Yii::app()->db->createCommand()->update('auto_feed_lenders', 
				array(
				'commit_point' => $commit_point,
				'timestamp_lastsent' => $timestamp_lastsent,
				), 'feed_lender_name=:feed_lender_name', array(':feed_lender_name'=>$lender->feed_lender_name));
			}
		}
	}
}
