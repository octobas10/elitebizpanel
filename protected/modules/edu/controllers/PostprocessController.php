<?php
/* Direct Post */
error_reporting(E_ALL);
ini_set('display_errors', 1);
require dirname(__FILE__) . './../../../../vendor/autoload.php';
class PostprocessController extends Controller{	
	public function actionIndex(){
		/*if($_SERVER['REMOTE_ADDR'] == '82.17.180.215'){
			echo '<pre>...ORIGINAL REQUEST...';print_r($_REQUEST);
		}*/
		$redisClient = new Predis\Client();
		$ip = $_SERVER['REMOTE_ADDR'];
		$reqCount = $redisClient->incr($ip);
		$ttl = $redisClient->ttl($ip);
		if ($ttl == '-1') {
			$redisClient->expire($ip, 60);
		}
		if ($reqCount < Yii::app()->params['edu_ping_cap']) {
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods:GET,POST,JSONP');
			header("Access-Control-Allow-Headers:HTTP-X-REQUESTED-WITH");
			$_SESSION['post_process_set']=true;
			$process = 'inorganic';
			$post_request_affiliate = http_build_query($_POST); 
			if(isset($_REQUEST['lead_mode']) &&!empty($_REQUEST['lead_mode']) && $_REQUEST['lead_mode']==1) {
				//Find the Prefect Match
				$edu_zipcodes = AffiliatesController::actionCheckgeofootprint(1);
				//echo '<pre>...28..28..';print_r($edu_zipcodes);exit;
				$_REQUEST['lender_id'] = $edu_zipcodes['lender_id'];
				$_REQUEST['city'] = !empty($edu_zipcodes['city'])?$edu_zipcodes['city']:$_REQUEST['city'];
				$_REQUEST['state'] = !empty($edu_zipcodes['state'])?$edu_zipcodes['state']:$_REQUEST['state'];
				$_REQUEST['zip'] = !empty($edu_zipcodes['zipcode'])?$edu_zipcodes['zipcode']:$_REQUEST['zip'];
				$_REQUEST['program_of_interest'] = !empty($edu_zipcodes['program'])?$edu_zipcodes['program']:$_REQUEST['program_of_interest'];
				$_REQUEST['campus'] = !empty($edu_zipcodes['campus'])?$edu_zipcodes['campus']:$_REQUEST['campus'];
				/*if($_SERVER['REMOTE_ADDR'] == '81.96.154.57'){
					echo '<pre>...UPDATED REQUEST...';print_r($_REQUEST);exit;
				}*/
			}
			$_POST = $_REQUEST;
			Yii::app()->session['ping_type'] = 'directpost';
			$promo_code = Yii::app()->request->getParam('promo_code');
			$lead_mode = Yii::app()->request->getParam('lead_mode');
			$sub_id2 = Yii::app()->request->getParam('sub_id2');
			/** Affiliate Promo Code & Status check, Check whether affiliate is active or not */
			$_POST['lead_id'] = Yii::app()->request->getParam('universal_leadid');
			if(isset($sub_id2) && !empty($sub_id2)) {
				$_POST['sub_id2'] = $sub_id2;
			} else {
				$_POST['sub_id2'] = '';
			}
			/** ADD IN AFFILIATE_TRANSACTION TABLE */
			LeadsController::actionAffiliateTransaction($_POST,$process,$post_request_affiliate); 
			LeadsController::actionValidationCheck($_POST,$process);
			LeadsController::actionCheckDuplicate($_POST,$process);
			$affiliate_user_model = new AffiliateUser;
			//SET SESSION LEAD_MODE, BY CALLING THIS FUNCTION
			$affiliate_status = $affiliate_user_model->checkAffiliateStatus($promo_code,$process);
			$affiliate_cap = $affiliate_user_model->check_affiliate_cap($promo_code);
			$cm = new CommonMethods();
			/** start the clock to mesure ping post time */
			$start_time = CommonToolsMethods::stopwatch();
			$lender_aff_trans_model = new LenderAffiliateTransaction();
			$lender_details_model= new LenderDetails();
			if($lead_mode==0){
				$cm->setAcceptRespond('0.00','0.00','0',$process);
			}
			if($affiliate_status!='TestMode'){
				if($affiliate_cap){
					$i_max_price = 0;
					$MATCHED_LENDER_FIRST = $_REQUEST['lender_id'] ? $_REQUEST['lender_id'] : 0;
					if($lead_mode==1){
						if($MATCHED_LENDER_FIRST == '0'){
							$static_price_lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND static_lead_price>=0.00"));
						}else{
							$static_price_lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND id IN ('".$MATCHED_LENDER_FIRST."') AND static_lead_price>=0.00",'order'=>'FIELD(id,'.$MATCHED_LENDER_FIRST.') DESC, static_lead_price DESC'));
						}
					} else {
						$test_lenders = array('Dummy','Dummy1',$_REQUEST['lender_name']);
						$test_lenders_list = implode("','",$test_lenders);
						$static_price_lenderlist = $lender_details_model->findAll(array("condition"=>"name IN ('".$test_lenders_list."')"));
					}
					/*if($_SERVER['REMOTE_ADDR'] == '81.96.154.57'){
						echo '<pre>';print_r($static_price_lenderlist);exit;
					}*/
					//echo '<pre>';print_r($static_price_lenderlist);exit;
					if(!empty($static_price_lenderlist)){
						$static_price_direct_post=true;
						foreach($static_price_lenderlist as $static_price_lender){
							$lendername = $static_price_lender->name;
							$lender_id = $static_price_lender->id;
							$LenderClassName = $lendername.'Controller';
							$methodName = 'sendPostData';
							$arg1 = $static_price_lender->parameter1;
							$arg2 = $static_price_lender->parameter2;
							$arg3 = $static_price_lender->parameter3;
							$static_lead_price = $static_price_lender->static_lead_price;
							if($static_lead_price>=$i_max_price){
								$max_price_lender_id = $static_price_lender->id;
								$i_max_price = $static_lead_price;
								$Max_Price_Ping_Accepted_Lender['ping_price'] = $static_lead_price;
							}
							$confirmation_id = '';
							$post_url = $static_price_lender->post_url_live;
							$lender_status = $static_price_lender->status;
							/** Send Post Data to Static Price Lender */
							include 'cash_lender/'.$LenderClassName.'.php';
							$post_responses=call_user_func_array(array($LenderClassName,$methodName),array($arg1,$arg2,$arg3,$confirmation_id,$post_url,$lender_status));
							//$ping_id = null;
							$ping_id = $post_responses['ping_id'];
							// added campus code in lender transaction 01.18.2018
							$campus_code = $_REQUEST['campus'];
							$post_responses['post_price']=$static_lead_price;
							
							/** Increment submission count in ledner affiliate trasaction */
							$lender_aff_trans_model->lender_post_status_update($lender_id,$promo_code,$post_responses['post_status'],$post_responses['post_price'],$static_price_direct_post);
							/** Update Post Log in LenderTransaction Table*/
							$cm->setLenderTransactionLogEdu($lendername,$post_responses['post_price'],$post_responses['post_request'],$post_responses['post_status'],$post_responses['post_response'],$post_responses['post_time'],null,null,null,null,$post_responses['redirect_url'],$ping_id,$campus_code,$lender_id);
							if($post_responses['post_status']=='1'){
								$static_lender_accept_status = true;
								break;
							}else{
								continue;
							}
						}
					}
					$aff_post_status = $post_responses['post_status']=='1' ? 1 : 0;
					/** Update affiliate's daily count */
					AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_post_status);
					/** Calculate Lead Margin Price,Update Submission Table and Send back Aceepted Response to Affiliate **/
					if($post_responses['post_status']=='1'){
						/** calculation of lender lead price and vendor lead price with margin/comission */
						$affiliate = $affiliate_user_model->findByPk($promo_code);
						if($static_lead_price==0.00){
							$lender_lead_price=$post_price;
						}else{
							$lender_lead_price=$static_lead_price;
						}
						$vendor_lead_price=$lender_lead_price-(($lender_lead_price*$affiliate->margin)/100);
						$redirect_url = $post_responses['redirect_url'];
						//code added because if lender_list is empty at initial level max_price_lender_id will not be set
						if(!isset($max_price_lender_id) || empty($max_price_lender_id)){
							$cm->setResponse('No Coverage'); 
							//$cm->setNoLenderFoundRespond($process); 
							Yii::app()->session['feedpostprocess_after_postprocess'] = true;
							FeedpostProcessController::pingFeedLenders('lead');
							$time_end = CommonToolsMethods::stopwatch();
							$post_time = ($time_end - $start_time);
							$cm->setNoFeedLenderFoundRespond($post_time);
						}
						/** update lender and vendor price & redirect url in submission table **/
						/** send back accept response to affiliate with lead processing time */
						$time_end = CommonToolsMethods::stopwatch();
						$lead_processing_time = ($time_end - $start_time);
						//echo $lead_processing_time.$process;
						$cm->edusetAcceptRespond($lender_lead_price,$vendor_lead_price,$lead_processing_time,$process);
					}elseif($post_responses['post_status']=='2'){
						$post_fail_reason = !empty($post_responses['post_fail_reason'])?$post_responses['post_fail_reason']:'unknown';
						$cm->setRespondError('',$post_fail_reason,$process);
					}else{
					/** No Lender Found, Send Denied Responce , Initiate Feed Process and Lastly Redirect to No Lender Found Page. */
						$cm->setResponse('No Coverage');
						Yii::app()->session['feedpostprocess_after_postprocess'] = true;
						FeedpostProcessController::pingFeedLenders('lead');
						$time_end = CommonToolsMethods::stopwatch();
						$post_time = ($time_end - $start_time);
						$cm->setNoFeedLenderFoundRespond($post_time);
					}
				}else{
					/** Todays' cap is full of this affiliate(promo_code) */
					$affiliate = $affiliate_user_model->findByPk($promo_code);
					$cm->setRespondErrorExceedTime($affiliate->user_name,$process);
				}
			}
		} else {
			$ttl = $redisClient->ttl($ip);
			echo json_encode(['status' => "You have used up all your quota, Try again after {$ttl} seconds "]);
			exit();
		}
	}
}