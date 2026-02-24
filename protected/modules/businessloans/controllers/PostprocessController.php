<?php
/* Direct Post */
error_reporting(E_ALL);
ini_set('display_errors', 1);
class PostprocessController extends Controller
{
	/* 
	   1. SELECT ALL NON DIRECT BUYERS (PING POST BUYERS) AND PING THEM 
	   2. IF PING IS ACCEPTED BY ANY OF THE PING POST BUYERS 
	   3. CHECK THE PING PRICE WITH GREATER THAN THE STATIC PRICE BUYER(DIRECT BUYER) AND IF STATIC PRICE IS GREATER THAN PING PRICE STATIC PRICE SEND POST TO DIRECT BUYER 
	   4. IF ANY OF THE DIRECT BUYERS DOESN'T ACCEPT THE POST THEN THEN SEND POST TO PING POST BUYER 
	*/
	public function actionIndex()
	{
		$_POST = $_REQUEST;
		$process = 'inorganic';
		Yii::app()->session['ping_type'] = 'directpost';
		$promo_code = Yii::app()->request->getParam('promo_code');
		$lead_mode = Yii::app()->request->getParam('lead_mode');
		/** Add affiliate transaction in the affiliate transaction table */
		LeadsController::actionAffiliateTransaction($_POST, $process);
		/** Validation check function check required field and other validation */
		LeadsController::actionValidationCheck($_POST, $process);
		/** Give duplicate lead error if lead is dublicate else insert new data */
		LeadsController::actionCheckDuplicate($_POST, $process);		
		$affiliate_user_model = new AffiliateUser;
		/** Affiliate Promo Code & Status check, Check whether affiliate is active or not */
		$affiliate_status = $affiliate_user_model->checkAffiliateStatus($promo_code);
		/** Affiliate Cap Check */
		$affiliate_cap = $affiliate_user_model->check_affiliate_cap($promo_code);
		$cm = new CommonMethods();
		/** start the clock to mesure ping post time */
		$start_time = CommonToolsMethods::stopwatch();
		$lender_aff_trans_model = new LenderAffiliateTransaction();
		$affiliate_daily_model = new AffiliateDailyCounts();
		$lender_details_model = new LenderDetails();
		if ($lead_mode == 0) {
			$cm->setAffiliatePingResponse(1, '0.00', '0.00', '00');
		}
		
		if ($affiliate_status != 'TestMode') {
			if ($affiliate_cap) {
				/* 1. SELECT ALL NON DIRECT BUYERS (PING POST BUYERS) AND PING THEM  */
				$multi_curl = [];
				/** Get all the lenders whose status live and who is not static_lead_price lender */
				if ($promo_code == '1') {
					$dummy_lenders_list = $_POST['lender'];
					$lenderlist = $lender_details_model->findAll(array("condition" => "status = 1 AND name IN ('" . $dummy_lenders_list . "') AND lender_pingpost_type=0", 'order' => 'id DESC'));
				} else if ($lead_mode == '1') {
					$lenderlist = $lender_details_model->findAll(array("condition" => "status = 1 AND name != 'DummyLender1' AND name != 'DummyLender2' AND lender_pingpost_type=0", 'order' => 'id DESC'));
				} else {
					$lenderlist = $lender_details_model->findAll(array("condition" => "status = 1 AND lender_pingpost_type=0"));
				}
				/** ======= Check Affiliate and Lender Setting(Paused Vendor,Submission Cap, Acceptance Cap) ====== */
				$Filtered_Lenders = [];
				foreach ($lenderlist as $lender) {
					$lender_id = $lender->id;
					/** Check for Paused Vendor */
					$check_paused_vendor = $lender_details_model->check_paused_vendor($lender_id);
					$paused_vendor = in_array($promo_code, $check_paused_vendor);
					if ($paused_vendor == 1) continue;
					/** Check Submission and Acceptance Cap of Lender */
					$check_submission_accept_cap = $lender_details_model->check_acceptCap($lender->id);
					if (!$check_submission_accept_cap) continue;
					/** Check Cap of Lender for perticular Affiliate (Lender Affiliate Setting) */
					$lender_aff_cap = $lender_aff_trans_model->check_lender_affiliate_cap($promo_code, $lender_id);
					if (!$lender_aff_cap) continue;
					$time_limit = Yii::app()->request->getParam('time_limit', '15');
					$remained_time_limit = floor($time_limit - $cm->time_check($start_time));
					if ($remained_time_limit <= $lender->posting_timelimit  || $lender->posting_timelimit != '-1') continue;
					/** Add this Filtered Lender Id in Array */
					$Filtered_Lenders[] = $lender_id;
				}
				/** === Create Lender List For Ping And Post ===== */
				$list = implode(', ', $Filtered_Lenders);
				if ($list) {
					$lenderlist = $lender_details_model->findAll(array("condition" => " id IN (" . $list . ") AND status = 1 AND lender_pingpost_type=0"));
				}
				/** ======== Create Ping Request FOR PING/POST BUYERS ========= */
				if ($lenderlist) {
					foreach ($lenderlist as $lender) {
						$lender_id = $lender->id;
						$lendername = $lender->name;
						$LenderClassName = $lendername . 'Controller';
						$arg1 = $lender->parameter1;
						$arg2 = $lender->parameter2;
						$arg3 = $lender->parameter3;
						$arg4 = $lender->status;
						$ping_url = $lender->status == '0' ? $lender->ping_url_test : $lender->ping_url_live;
						if ($lender->ping_url_test != '' || $lender->ping_url_live != '') {
							$methodName = 'returnPingData';
							$ping_data[$lender_id] = call_user_func_array(array($LenderClassName, $methodName), array($arg1, $arg2, $arg3, $arg4));
							if ($ping_data[$lender_id]['ping_request'] != false) {
								$lenders_response[$lender_id]['ping_url']		=	$ping_url;
								$lenders_response[$lender_id]['ping_request']	=	$ping_data[$lender_id]['ping_request'];
								$multi_curl[$lender_id]['lender_id']			=	$lender_id;
								$multi_curl[$lender_id]['ping_url']				=	$ping_url;
								$multi_curl[$lender_id]['ping_request']			=	$ping_data[$lender_id]['ping_request'];
								$multi_curl[$lender_id]['header'] 				=	$ping_data[$lender_id]['header'];
							} else {
								$multi_curl[$lender_id]['lender_id'] = $lender_id;
								$multi_curl[$lender_id]['ping_response_filtered'] = $ping_data[$lender_id]['ping_response_filtered'];
							}
						}
					}
					/** ========== Broadcast Ping to Every Lender =====**/
					$ping_responses = $cm->multi_curl($multi_curl);
					/** ============== Get Response form Ping and Set Lender Trasaction Log ========== */
				}
				/*2. IF PING IS ACCEPTED BY ANY OF THE PING POST BUYERS */
				if ($lenderlist) {
					Yii::app()->session['ping_type'] = 'directping';
					foreach ($lenderlist as $lender) {
						$lender_id = $lender->id;
						if ($lender->ping_url_test != '' || $lender->ping_url_live != '') {
							$lendername = $lender->name;
							/* ======= Add Ping Respose and Ping Time in Our Main Array ======= */
							$lenders_response[$lender_id]['ping_response'] 		= $ping_responses[$lender_id]['ping_response'];
							$lenders_response[$lender_id]['ping_time'] 			= $ping_responses[$lender_id]['ping_time'];
							/* ======= Add Ping Respose and Ping Time in Our Main Array ======= */
							$ping_response		= $lenders_response[$lender_id]['ping_response'];
							$LenderClassName	= $lendername . 'Controller';
							$methodName			= 'returnPingResponse';
							/** Return Ping Status, Ping Price, and Confirmation ID from Ping Response */
							$ping_response_info[$lender_id] = call_user_func_array(array($LenderClassName, $methodName), array($ping_response));
							/* ========== Add Ping Response in Our Main Array === */
							$lenders_response[$lender_id]['ping_status'] 		= $ping_response_info[$lender_id]['ping_status'];
							$lenders_response[$lender_id]['ping_price']         = $ping_response_info[$lender_id]['ping_price'];
							$lenders_response[$lender_id]['confirmation_id'] 	= $ping_response_info[$lender_id]['confirmation_id'];
							/* ========== Add Ping Response in Our Main Array === */
							/** increment submission count in ledner affiliate trasaction */
							$lender_aff_trans_model->lender_ping_status_update($lender_id, $promo_code, $lenders_response[$lender_id]['ping_status'], $lenders_response[$lender_id]['ping_price']);
							/** Update Ping Log in LenderTransaction Table*/
							/* $send_string = $lendername.'<==>whatprice:'. $lenders_response[$lender_id]['ping_price'].'<==>'. $post_request .'<==>'. $post_status .'<==>'. $post_response .'<==>'. $lenders_response[$lender_id]['ping_time'].'<==>'. $lenders_response[$lender_id]['ping_request'].'<==>'. $lenders_response[$lender_id]['ping_status'].'<==>'. $ping_response.'<==>'. $redirect_url .'<==>ping_id:'. $ping_id .'<==>'. $lender_id;
							mail('octobas@gmail.com', 'Turbo whats my ping id', $lendername.'--'.$send_string); */
							$ping_id = $cm->setLenderTransactionLog($lendername, $lenders_response[$lender_id]['ping_price'], null , null, null, $lenders_response[$lender_id]['ping_time'], $lenders_response[$lender_id]['ping_request'], $lenders_response[$lender_id]['ping_status'], $ping_response, $redirect_url = null, $ping_id = null, $lender_id);
							$affiliate_daily_model->update_affiliate_daily_counts($promo_code,$ping_response_info[$lender_id]['ping_status']);
							$lenders_response[$lender_id]['ping_id'] = $ping_id;
							$ping_prices[$lender_id] = $lenders_response[$lender_id]['ping_price'];
						}
					}
					/** ==== Find Max Ping Price Lender ==== */
					$max_price_lender_id = array_search(max($ping_prices), $ping_prices);
					$Max_Price_Ping_Accepted_Lender = $lenders_response[$max_price_lender_id];
					$Max_Ping_Price = ($Max_Price_Ping_Accepted_Lender['ping_price'] != '') ? $Max_Price_Ping_Accepted_Lender['ping_price'] : 0.00;
				} else {
					$Max_Ping_Price = 0.00;
				}
				/* 3. CHECK THE PING PRICE WITH GREATER THAN THE STATIC PRICE BUYER(DIRECT BUYER) AND IF STATIC PRICE IS GREATER THAN PING PRICE STATIC PRICE SEND POST TO DIRECT BUYER */
				$static_price_lenderlist = $lender_details_model->findAll(array("condition" => "status = 1 AND lender_pingpost_type=1 AND static_lead_price>=$Max_Ping_Price", 'order' => 'static_lead_price desc'));
				Yii::app()->session['ping_type'] = 'directpost';
				$static_lender_accept_status = false;
				if (!empty($static_price_lenderlist)) {
					$static_price_direct_post = true;
					foreach ($static_price_lenderlist as $static_price_lender) {
						/** RESTRICT BY CAPS [SUBMISSIONS AND ACCEPT] */
						$check_submission_accept_cap = $lender_details_model->check_acceptCap($static_price_lender->id);
						//if (!$check_submission_accept_cap) continue;
						$check_submission_accept_cap = $lender_details_model->check_acceptCap($static_price_lender->id);
						//if (!$check_submission_accept_cap) continue;
						/** RESTRICT BY CAPS [SUBMISSIONS AND ACCEPT] */
						$lendername = $static_price_lender->name;
						$lender_id = $static_price_lender->id;
						$LenderClassName = $lendername . 'Controller';
						$methodName = 'sendPostData';
						$arg1 = $static_price_lender->parameter1;
						$arg2 = $static_price_lender->parameter2;
						$arg3 = $static_price_lender->parameter3;
						$static_lead_price = $static_price_lender->static_lead_price;
						$confirmation_id = '';
						$post_url = $static_price_lender->post_url_live;
						$lender_status = $static_price_lender->status;
						/** Send Post Data to Static Price Lender */
						$post_responses = call_user_func_array([$LenderClassName, $methodName], [$arg1, $arg2, $arg3, $confirmation_id, $post_url, $lender_status]);
						$ping_id = null;
						if($post_responses['post_status']== '1'){
							if($post_responses['post_price']>'0.00'){
								$post_responses['post_price'] = $post_responses['post_price'];
							}else{
								$post_responses['post_price'] = $static_lead_price;
							}
						}else{
							$post_responses['post_price'] = '0.00';
						}
						/** Increment submission count in ledner affiliate trasaction */
						$lender_aff_trans_model->lender_post_status_update($lender_id, $promo_code, $post_responses['post_status'], $post_responses['post_price'], $static_price_direct_post);
						/** Update Post Log in LenderTransaction Table*/
						$cm->setLenderTransactionLog($lendername, $post_responses['post_price'], $post_responses['post_request'], $post_responses['post_status'], $post_responses['post_response'], $post_responses['post_time'], null, null, null, $post_responses['redirect_url'], $ping_id, $lender_id);
						$affiliate_daily_model->update_affiliate_daily_counts($promo_code, $post_responses['post_status']);
						if ($post_responses['post_status'] == '1') {
							// IF LEAD IS ACCEPTED HERE , IT WILL NOT GO IN POINT 4
							$max_price_lender_id = $lender_id;
							$static_lender_accept_status = true;
							break;
						} else {
							continue;
						}
					}
				}
				/* 4. IF ANY OF THE DIRECT BUYERS DOESN'T ACCEPT THE POST THEN THEN SEND POST TO PING POST BUYER (ONE WHO ACCEPTED THE PING)*/
				if ($Max_Price_Ping_Accepted_Lender['ping_price'] != '' && $static_lender_accept_status == false) {
					$max_price_lender = $lender_details_model->findByPK($max_price_lender_id);
					$lendername = $max_price_lender->name;
					$lender_id = $max_price_lender->id;
					$LenderClassName = $lendername . 'Controller';
					$methodName = 'sendPostData';
					$arg1 = $max_price_lender->parameter1;
					$arg2 = $max_price_lender->parameter2;
					$arg3 = $max_price_lender->parameter3;
					$static_lead_price = $max_price_lender->static_lead_price;
					$confirmation_id = $Max_Price_Ping_Accepted_Lender['confirmation_id'];
					$post_url = $max_price_lender->post_url_live;
					$lender_status = $lender->status;
					/** Send Post Data to Highest Ping Price Lender */
					$post_responses = call_user_func_array(array($LenderClassName, $methodName), array($arg1, $arg2, $arg3, $confirmation_id, $post_url, $lender_status));
					/*===== Add Post Responce In Our Main Array ======= */
					//$lenders_response[$max_price_lender_id]['margin'] = $max_price_lender->margin;
					$lenders_response[$max_price_lender_id]['post_request'] = $post_responses['post_request'];
					$lenders_response[$max_price_lender_id]['post_response'] = $post_responses['post_response'];
					$lenders_response[$max_price_lender_id]['post_status'] = $post_responses['post_status'];
					$lenders_response[$max_price_lender_id]['post_price'] = $post_responses['post_price'];
					$lenders_response[$max_price_lender_id]['redirect_url'] = $post_responses['redirect_url'];
					$ping_id = $lenders_response[$max_price_lender_id]['ping_id'];
					$lenders_response[$max_price_lender_id]['post_time'] = $post_responses['post_time'];
					/*===== Add Post Responce In Our Main Array ======= */
					if (isset($lenders_response[$max_price_lender_id]['ping_price']) != '') {
						$post_price = $lenders_response[$max_price_lender_id]['ping_price'];
					} else {
						$post_price = $post_responses['post_price'];
					}
					$post_request = $post_responses['post_request'];
					$post_status = $post_responses['post_status'];
					$post_response = $post_responses['post_response'];
					$post_time = $post_responses['post_time'];
					$ping_request = null;
					$ping_responses = null;
					$ping_response = null;
					$ping_status = null;
					$redirect_url = $post_responses['redirect_url'];
					/** Update Lender Accepted=1 in LenderAffiliateTransaction Table */
					$lender_aff_trans_model->lender_post_status_update($lender_id, $promo_code, $post_status, $post_price);
					//mail('octobas@gmail.com', 'Tubo Posting', $lender_id.'--'.$promo_code.'---'.$post_response);
					/** Update Post Log in LenderTransaction Table*/
					$cm->setLenderTransactionLog($lendername, $post_price, $post_request, $post_status, $post_response, $post_time, $ping_request, $ping_status, $ping_response, $redirect_url, $ping_id, $lender_id);
					$affiliate_daily_model->update_affiliate_daily_counts($promo_code, $post_responses['post_status']);
				}
				/** Calculate Lead Margin Price,Update Submission Table and Send back Aceepted Response to Affiliate **/
				if ($post_responses['post_status'] == '1') {
					/** calculation of lender lead price and vendor lead price with margin/comission */
					$affiliate = $affiliate_user_model->findByPk($promo_code);
					if ($static_lead_price == '0.00') {
						$lender_lead_price = $post_responses['post_price'];
					} else {
						$lender_lead_price = $static_lead_price;
					}
					//mail('octobas@gmail.com', 'Debt ping response to Pub', $lender_lead_price);
					$lender_margin = $lenders_response[$max_price_lender_id]['margin'];
					$applied_margin = $lender_margin > $affiliate->margin ? $lender_margin : $affiliate->margin;
					$vendor_lead_price = $lender_lead_price - (($lender_lead_price * $applied_margin) / 100);
					//mail('octobas@gmail.com', 'Debt ping response to Pub', $lender_lead_price.'---'.$vendor_lead_price);
					$redirect_url = $post_responses['redirect_url'];
					/** update lender and vendor price & redirect url in submission table **/
					//mail('octobas@gmail.com', 'Debt ping submission table', $lender_lead_price.'---Lender id: '.$max_price_lender_id."--aff trans id:".Yii::app()->session['affiliate_trans_id']);
					$cm->setLeadPriceInSubmission($max_price_lender_id, $lender_lead_price, $vendor_lead_price, $redirect_url);
					/** send back accept response to affiliate with lead processing time */
					$time_end = CommonToolsMethods::stopwatch();
					$lead_processing_time = ($time_end - $start_time);
					$cm->setAcceptRespond($lender_lead_price, $vendor_lead_price, $lead_processing_time, $process);
				} elseif ($post_responses['post_status'] == '2') {
					$post_fail_reason = !empty($post_responses['post_fail_reason']) ? $post_responses['post_fail_reason'] : 'unknown';
					$cm->setRespondError('', $post_fail_reason, $process);
				} else {
					$cm->setResponse('No Coverage');
					//$cm->setNoLenderFoundRespond($process);
				}
			} else {
				/** Todays' cap is full of this affiliate(promo_code) */
				$affiliate = $affiliate_user_model->findByPk($promo_code);
				$cm->setRespondErrorExceedTime($affiliate->user_name, $process);
			}
		}
	}
}
