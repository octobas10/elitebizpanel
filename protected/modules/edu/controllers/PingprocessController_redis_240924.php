<?php
/* Ping  Process */
error_reporting(E_ALL);
ini_set('display_errors', 1);
class PingprocessController extends Controller{	
	public function actionIndex(){
		$_POST = $_REQUEST;
		$process = 'inorganic';
		Yii::app()->session['ping_type'] = 'ping';
		$promo_code = Yii::app()->request->getParam('promo_code');
		$lead_mode = Yii::app()->request->getParam('lead_mode');
		$affiliate_user_model = new AffiliateUser;
		$affiliate_status= $affiliate_user_model->checkAffiliateStatus($promo_code,$process);
		/** Add affiliate transaction in the affiliate transaction table */ 
		LeadsController::actionAffiliateTransaction($_POST,$process); 
		/** Validation check function check required field and other validation */
		LeadsController::actionValidationCheck($_POST,$process);
		/** Give duplicate lead error if lead is duplicate else insert new data */ 
		LeadsController::actionCheckPingDuplicate($_POST,$process);
		/** Affiliate Cap Check */
		$affiliate_cap = $affiliate_user_model->check_affiliate_cap($promo_code);
		$cm = new CommonMethods();
		/** start the clock to mesure ping time */
		$start_time = CommonToolsMethods::stopwatch();
		$lender_aff_trans_model = new LenderAffiliateTransaction();
		$lender_details_model = new LenderDetails();
		$submission_model = new Submissions();
		if($affiliate_status!='TestMode'){
			if($affiliate_cap){
				$multi_curl = array();
				/** Get all the lenders whose status live and who is not static_lead_price lender */
				$dummy_lenders = array('DummyLender1','DummyLender2');
				$dummy_lenders_list = implode("','",$dummy_lenders);
				if($lead_mode==1){
					$lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND name NOT IN ('".$dummy_lenders_list."') AND static_lead_price=0.00",'order' => 'id DESC'));
				}else{
					$lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND static_lead_price=0.00"));
				}
				/** Add lender's id to check USPS zip validation for them */
				$USPS_Zip_Check_Lenders = array(1); // 4=AstoriaCompany
				foreach($lenderlist as $lender){
					$lender_id = $lender->id;
					/** Check USPS ZIP validation for these lenders*/
					/** Check for Paused Vendor */
					$check_paused_vendor = $lender_details_model->check_paused_vendor($lender_id);
					$paused_vendor = in_array($promo_code, $check_paused_vendor);
					if($paused_vendor==1) continue;
					/** CHECK SUBMISSION CAP AND ACCEPT CAP OF THE LENDER */
					$check_submission_accept_cap = $lender_details_model->check_acceptCap($lender->name);
					if(!$check_submission_accept_cap) continue;
					/** Check Cap of Lender for perticular Affiliate (Lender Affiliate Setting) */
					$lender_aff_cap = $lender_aff_trans_model->check_lender_affiliate_cap($promo_code,$lender_id);
					if(!$lender_aff_cap) continue;
					$time_limit = Yii::app()->request->getParam('time_limit','15');
					$remained_time_limit = floor($time_limit - $cm->time_check($start_time));
					if($remained_time_limit <= $lender->posting_timelimit  || $lender->posting_timelimit != '-1') continue;
					/** Add this Filtered Lender Id in Array */
					$Filtered_Lenders[] = $lender_id;
				}

				/** ========================== Create Lender List For Ping And Post ============================ */
				$list = implode(', ',$Filtered_Lenders);
				if($list){
					/** This is the lender list which we use everywhere */
					$lenderlist = $lender_details_model->findAll(array("condition"=>" id IN (".$list.") AND status = 1 AND static_lead_price=0.00"));
				}else{
					/** No Lender Found */
					$cm->setAffiliatePingResponse(0,0,0,0);
				}
				/** =========END ===== */
				/** ===== Create Ping Request Array ====== */
				foreach($lenderlist as $lender){
					$lender_id = $lender->id;
					$lendername = $lender->name;
					$LenderClassName = $lendername.'Controller';
					$arg1 = $lender->parameter1;
					$arg2 = $lender->parameter2;
					$arg3 = $lender->parameter3;
					$arg4 = $lender->status;
					$ping_url = $lender->status == '0' ? $lender->ping_url_test : $lender->ping_url_live;
					if($lender->ping_url_test!='' || $lender->ping_url_live !=''){
						$methodName = 'returnPingData';
						$ping_data[$lender_id] = call_user_func_array(array($LenderClassName,$methodName),array($arg1,$arg2,$arg3,$arg4));
						$lenders_response[$lender_id]['ping_url']			= 	$ping_url;
						$lenders_response[$lender_id]['ping_request']	=	$ping_data[$lender_id]['ping_request'];
						$multi_curl[$lender_id]['lender_id']				=	$lender_id;
						$multi_curl[$lender_id]['ping_url']					=	$ping_url;
						$multi_curl[$lender_id]['ping_request']			=	$ping_data[$lender_id]['ping_request'];
					}
				}
				/** =====END====== */
				/** ========== Broadcast Ping to Every Lender =====**/
				$ping_responses = $cm->multi_curl($multi_curl);
				/** =====END====== */
				/** ======Get Response form Ping and Set Lender Trasaction Log == */
				$aff_ping_status = 0;
				foreach($lenderlist as $lender){
					$lender_id = $lender->id;
					if($lender->ping_url_test!='' || $lender->ping_url_live !='' ){
						$lendername = $lender->name;
						/* ====Add Ping Respose and Ping Time in Our Main Array== */ 
						$lenders_response[$lender_id]['ping_response']		= $ping_responses[$lender_id]['ping_response'];
						$lenders_response[$lender_id]['ping_time']			= $ping_responses[$lender_id]['ping_time'];
						/* ===Add Ping Respose and Ping Time in Our Main Array== */
						$ping_response = $lenders_response[$lender_id]['ping_response'];
						$LenderClassName = $lendername.'Controller';
						$methodName = 'returnPingResponse';
						/** Return Ping Status, Ping Price, and Confirmation ID from Ping Response */
						$ping_response_info[$lender_id] = call_user_func_array(array($LenderClassName,$methodName),array($ping_response));
						/* ====Add Ping Response in Our Main Array==== */
						$lenders_response[$lender_id]['ping_price']			= $ping_response_info[$lender_id]['ping_price'];
						$lenders_response[$lender_id]['ping_status']			= $ping_response_info[$lender_id]['ping_status'];
						$lenders_response[$lender_id]['confirmation_id']	= $ping_response_info[$lender_id]['confirmation_id'];
						/* ====Add Ping Response in Our Main Array=== */
						$ping_price 		= $lenders_response[$lender_id]['ping_price'];
						$ping_time 			= $lenders_response[$lender_id]['ping_time'];
						$ping_request 		= $lenders_response[$lender_id]['ping_request'];
						$ping_status 		= $lenders_response[$lender_id]['ping_status'];
						$ping_response 	= $lenders_response[$lender_id]['ping_response'];
						/** increment submission count in ledner affiliate trasaction */
						$lender_aff_trans_model->lender_ping_status_update($lender_id,$promo_code,$ping_status,$ping_price);
						/** Update Ping Log in LenderTransaction Table*/
						$ping_id = $cm->setLenderTransactionLog($lendername,$ping_price,$post_request=null,$post_status=null,$post_response=null,$ping_time,$ping_request,$ping_status,$ping_response,$redirect_url=null,$ping_id=null);
						$lenders_response[$lender_id]['ping_id'] = $ping_id;
						$ping_prices[$lender_id] = $lenders_response[$lender_id]['ping_price'];
						if($ping_status==1){
							$aff_ping_status = 1;
						}
					}
				}
				/** =============END============== */
				/** ==== Find Max Ping Price Lender ==== */
				$max_price_lender_id = array_search(max($ping_prices),$ping_prices);
				$Max_Price_Ping_Accepted_Lender = $lenders_response[$max_price_lender_id];
				/** =================END====================  */
				$Max_Ping_Price = ($Max_Price_Ping_Accepted_Lender['ping_price']!='') ? $Max_Price_Ping_Accepted_Lender['ping_price'] : 0.00;
				/** == Calculate Ping Time for Affiliate == */
				$time_end = CommonToolsMethods::stopwatch();
				$aff_ping_time = ($time_end - $start_time);
				/** ================== END ================ */
				/** Affiliate ping price calculation based on margin set for that affiliate*/
				$affiliate = $affiliate_user_model->findByPk($promo_code);
				$vendor_ping_price = $Max_Ping_Price-(($Max_Ping_Price*$affiliate->margin)/100);
				/** ============================== END ======================================= */
				/** Update affiliate's daily count */
				AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_ping_status);
				/** Update lender ping price and vendor ping price in affiliate transaction table **/
				$cm->setAffiliatePingResponse($aff_ping_status,$Max_Ping_Price,$vendor_ping_price,$aff_ping_time);
			}else{
				/** Todays' cap is full of this affiliate(promo_code) */
				$affiliate = $affiliate_user_model->findByPk($promo_code);
				$cm->setRespondErrorExceedTime($affiliate->user_name,$process);
			}
		}
	}
}
