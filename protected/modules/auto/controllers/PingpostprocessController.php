<?php
//echo $_SERVER['REMOTE_ADDR'];echo '<br>';echo $_SERVER['SERVER_ADDR'];exit;
/* Post(after ping) Process */
error_reporting(E_ALL);
ini_set('display_errors', 1);
class PingpostprocessController extends Controller{	
	public function actionIndex(){
		$_POST = $_REQUEST;
		$process = 'inorganic';
		Yii::app()->session['ping_type'] = 'post';
		$ping_id = Yii::app()->request->getParam('ping_id');
		$lead_mode = Yii::app()->request->getParam('lead_mode');
		$promo_code = Yii::app()->request->getParam('promo_code');
		/** Check Ping Id Status. Actually Ping Exist or not */
		LeadsController::check_Ping_Id_Existence($ping_id);
		/** Add affiliate transaction in the affiliate transaction table */ 
		LeadsController::actionAffiliateTransaction($_POST,$process);
		$affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
		/** Validation check function check required field and other validation */
		LeadsController::actionValidationCheck($_POST,$process);
		/** Give duplicate lead error if lead is dublicate else insert new data */
		LeadsController::actionCheckDuplicate($_POST,$process);
		$affiliate_user_model = new AffiliateUser;
		/** Affiliate Promo Code & Status check, Check whether affiliate is active or not */
		$affiliate_status = $affiliate_user_model->checkAffiliateStatus($promo_code);
		/** Affiliate Cap Check */
		$affiliate_cap = $affiliate_user_model->check_affiliate_cap($promo_code);
		$cm = new CommonMethods();
		/** start the clock to mesure ping post time */
		$start_time = CommonToolsMethods::stopwatch();
		$lender_aff_trans_model = new LenderAffiliateTransaction();
		$lender_details_model=new LenderDetails();
		$lender_transaction_model = new LenderTransactions();
		// SEND ACCEPTED RESONSE FOR AFFILIATE WHEN LEAD MODE =0
		if($lead_mode==0){
			$cm->setAcceptRespond('0.00','0.00','0',$process);
		}
		if($affiliate_status!='TestMode'){
			if($affiliate_cap){
				$lenders = $lender_transaction_model->get_Lender_Pigned_With_This_Ping_Id($affiliate_trans_id);
				/** =============== Send Post Data to Highest Ping Price Lender =================*/
				if(!empty($lenders)){
					foreach($lenders as $lender){
						if($lender->name!=''){
							$lender_trans_id = $lender->lender_trans_id;
							$lender_id = $lender->id;
							$lendername = $lender->name;
							$LenderClassName = $lendername.'Controller';
							$methodName = 'sendPostData';
							$arg1 = $lender->parameter1;
							$arg2 = $lender->parameter2;
							$arg3 = $lender->parameter3;
							$ping_response = $lender->ping_response;
							$post_url = $lender->post_url_live;
							$lender_status = $lender->status;
							$post_response = call_user_func_array(array($LenderClassName, $methodName),array($arg1,$arg2,$arg3,$ping_response,$post_url,$lender_status));
							/** Update Post Log in LenderTransaction Table*/
							$cm->setLenderTransactionLog($lendername,$post_response['post_price'],$post_response['post_request'],$post_response['post_status'],$post_response['post_response'],$post_response['post_time'],$ping_request=null,$ping_status=null,$ping_response=null,$post_response['redirect_url'],$lender_trans_id,$lender_id);
							/** Update Lender Accepted=1 in LenderAffiliateTransaction Table */
							$lender_aff_trans_model->lender_post_status_update($lender_id,$promo_code,$post_response['post_status'],$post_response['post_price']);
							if($post_response['post_status']==1) break;
						}
					}
				}
				/** ====================================END========================================*/
				$aff_post_status = $post_response['post_status']=='1' ? 1 : 0;
				/** Update affiliate's daily count */
				AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_post_status);
				/** Calculate Lead Margin Price,Update Submission Table and Send back Accepted Response to Affiliate **/
				if($post_response['post_status']=='1'){
					$redirect_url = $post_response['redirect_url'];
					/** calculation of lender lead price and vendor lead price with margin/comission */
					$affiliate = $affiliate_user_model->findByPk($promo_code);
					$lender_aff_trans = $lender_transaction_model->findByPk($lender_trans_id);
					$ping_price = $lender_aff_trans->ping_price;
					$lender_lead_price = (isset($ping_price) && $ping_price!='0.00') ? $ping_price : $post_response['post_price'];
					$vendor_lead_price = $lender_lead_price-(($lender_lead_price*$affiliate->margin)/100);
					$redirect_url = $post_response['redirect_url'];
					/** update lender and vendor price & redirect url in submission table **/
					$cm->setLeadPriceInSubmission($lender_id,$lender_lead_price,$vendor_lead_price,$redirect_url);
					/** send back accept response to affiliate with lead processing time */
					$time_end = CommonToolsMethods::stopwatch();
					$lead_processing_time = ($time_end - $start_time);
					$cm->setAcceptRespond($lender_lead_price,$vendor_lead_price,$post_response['post_time'],$process);
				}
				/** ===================END============================*/
				/** No Lender Found, Send Denied Responce , Initiate Feed Process and Lastly Redirect to No Lender Found Page. */
				$cm->setNoLenderFoundRespond($process);
				//FeedpostProcessController::pingFeedLenders('lead');
			}else{
				/** Todays' cap is full of this affiliate(promo_code) */
				$affiliate = $affiliate_user_model->findByPk($promo_code);
				$cm->setRespondErrorExceedTime($affiliate->user_name,$process);
			}
		}
	}
}