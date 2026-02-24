<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class IndexProcessController extends Controller{
	public function actionIndex(){
		$_POST = $_REQUEST;
		//echo '<pre>';print_r($_REQUEST);exit;
		$process = 'organic';
		Yii::app()->session['ping_type'] = 'directpost';
		$promo_code = Yii::app()->request->getParam('promo_code');
		$lead_mode = Yii::app()->request->getParam('lead_mode');
		/** Add affiliate transaction in the affiliate transaction table */
		LeadsController::actionAffiliateTransaction($_POST,$process); 
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
		$submission_model = new Submissions();
		
		if($affiliate_status!='TestMode'){
			if($affiliate_cap){
				$multi_curl = array();
				$lender_details_model=new LenderDetails();
				/** Get all the lenders whose status live and who is not static_lead_price lender */
				
				$dummy_lenders = array('DummyLender1','DummyLender2');
				$dummy_lenders_list = implode("','",$dummy_lenders);
				if($lead_mode==1){
					$lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND name != 'DummyLender1' AND name != 'DummyLender2' AND static_lead_price=0.00"));
					#$lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND name NOT IN ('".$dummy_lenders_list."') AND static_lead_price=0.00"));
				}else{
					$lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND static_lead_price=0.00"));
				}
				
				/** ======= Check Affiliate and Lender Setting(Paused Vendor,Submission Cap, Acceptance Cap) ====== */
				/** Add lender's id to check USPS zip validation for them */
				$USPS_Zip_Check_Lenders = array(4); // 4=AstoriaCompany
				foreach($lenderlist as $lender){
					$lender_id = $lender->id;
					/** Chech USPS ZIP validation for these lenders*/
					if(in_array($lender_id, $USPS_Zip_Check_Lenders)){
						$zip = Yii::app()->request->getParam('zip');
						$USPS_Zip = $submission_model->USPS_Validation($zip);
						if($USPS_Zip!=1) continue;
					}
					/** Check for Paused Vendor */
					$check_paused_vendor = $lender_details_model->check_paused_vendor($lender_id);
					$paused_vendor = in_array($promo_code, $check_paused_vendor);
					if($paused_vendor==1) continue;
					/** Check Submission and Acceptance Cap of Lender */
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
				/** =========================================== END =========================================== */
				
				/** ========================== Create Lender List For Ping And Post ============================ */
				$list = implode(', ',$Filtered_Lenders);
				if($list){
					/** This is the lender list which we use everywhere */
					$lenderlist = $lender_details_model->findAll(array("condition"=>" id IN (".$list.") AND status = 1 AND static_lead_price=0.00"));
				}else{
					/** No Lender Found */
					$cm->setNoLenderFoundRespond();
				}
				/** ======================================== END ================================================= */	
				/** ====================== Create Ping Request Array ======================== */
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
						$lenders_response[$lender_id]['ping_url']		= 	$ping_url;
						$lenders_response[$lender_id]['ping_request'] 	=	$ping_data[$lender_id]['ping_request'];
						$multi_curl[$lender_id]['lender_id'] 			=	$lender_id;
						$multi_curl[$lender_id]['ping_url'] 			=	$ping_url;
						$multi_curl[$lender_id]['ping_request'] 		=	$ping_data[$lender_id]['ping_request'];
						$multi_curl[$lender_id]['header'] 				=	$ping_data[$lender_id]['header'];
					}
				}
				/** =================================END======================================= */
				/** ========== Broadcast Ping to Every Lender =====**/
				$ping_responses = $cm->multi_curl($multi_curl);
				/** ========================END=====================**/
				/** ============== Get Response form Ping and Set Lender Trasaction Log ========== */
				foreach($lenderlist as $lender){
					$lender_id = $lender->id;
					if($lender->ping_url_test!='' || $lender->ping_url_live !='' ){
						$lendername = $lender->name;
						/* ================ Add Ping Respose and Ping Time in Our Main Array =========== */ 
						$lenders_response[$lender_id]['ping_response'] 		= $ping_responses[$lender_id]['ping_response'];
						$lenders_response[$lender_id]['ping_time'] 			= $ping_responses[$lender_id]['ping_time'];
						/* ================ Add Ping Respose and Ping Time in Our Main Array =========== */
						$ping_response = $lenders_response[$lender_id]['ping_response'];
						$LenderClassName = $lendername.'Controller';
						$methodName = 'returnPingResponse';
						/** Return Ping Response from Ping Full Response */
						$ping_response_info[$lender_id] = call_user_func_array(array($LenderClassName,$methodName),array($ping_response));
						/* ========================= Add Ping Response in Our Main Array ========================== */
						$lenders_response[$lender_id]['ping_price'] 			= $ping_response_info[$lender_id]['ping_price'];
						$lenders_response[$lender_id]['ping_status'] 		= $ping_response_info[$lender_id]['ping_status'];
						$lenders_response[$lender_id]['confirmation_id'] 	= $ping_response_info[$lender_id]['confirmation_id'];
						/* ========================= Add Ping Response in Our Main Array ========================== */
						$ping_price 		= $lenders_response[$lender_id]['ping_price'];
						$ping_time 			= $lenders_response[$lender_id]['ping_time'];
						$ping_request 		= $lenders_response[$lender_id]['ping_request'];
						$ping_status 		= $lenders_response[$lender_id]['ping_status'];
						$ping_response 	= $lenders_response[$lender_id]['ping_response'];
						/** Increment submission count in ledner affiliate trasaction */
						$lender_aff_trans_model->lender_ping_status_update($lendername,$promo_code,$lenders_response[$lender_id]['ping_status'],$lenders_response[$lender_id]['ping_price']);
						/** Update Ping Log in LenderTransaction Table*/
						$ping_id = $cm->setLenderTransactionLog($lendername,$lenders_response[$lender_id]['ping_price'],$post_request=null,$post_status=null,$post_response=null,$lenders_response[$lender_id]['ping_time'],$lenders_response[$lender_id]['ping_request'],$lenders_response[$lender_id]['ping_status'],$lenders_response[$lender_id]['ping_response'],$redirect_url=null,$ping_id=null);
						$lenders_response[$lender_id]['ping_id'] = $ping_id;
						$ping_prices[$lender_id] = $lenders_response[$lender_id]['ping_price'];
					}
				}
				/** =============END============== */
				/** ==== Find Max Ping Price Lender ==== */
				$max_price_lender_id = array_search(max($ping_prices),$ping_prices);
				$Max_Price_Ping_Accepted_Lender = $lenders_response[$max_price_lender_id];
				/** =================END====================  */
				$Max_Ping_Price = ($Max_Price_Ping_Accepted_Lender['ping_price']!='') ? $Max_Price_Ping_Accepted_Lender['ping_price'] : 0.00;
				/** =============== Send Direct Post to Static Lead Price Lenders =============== */
				$static_price_lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND static_lead_price>$Max_Ping_Price",'order'=>'static_lead_price desc'));
				$static_lender_accept_status = false;
				if(!empty($static_price_lenderlist)){
					$static_price_direct_post=true;
					foreach($static_price_lenderlist as $static_price_lender){
						$lendername = $static_price_lender->name;
						$LenderClassName = $lendername.'Controller';
						$methodName = 'sendPostData';
						$arg1 = $static_price_lender->parameter1;
						$arg2 = $static_price_lender->parameter2;
						$arg3 = $static_price_lender->parameter3;
						$static_lead_price = $static_price_lender->static_lead_price;
						$confirmation_id = '';
						$post_url = $static_price_lender->post_url_live;
						$lender_status = $lender->status;
						/** Send Post Data to Static Price Lender */
						$post_responses=call_user_func_array(array($LenderClassName,$methodName),array($arg1,$arg2,$arg3,$confirmation_id,$post_url,$lender_status));
						$post_responses['post_price']=$static_lead_price;
						/** Increment submission count in ledner affiliate trasaction */
						$lender_aff_trans_model->lender_post_status_update($lendername,$promo_code,$post_responses['post_status'],$post_responses['post_price'],$static_price_direct_post);
						/** Update Post Log in LenderTransaction Table*/
						$cm->setLenderTransactionLog($lendername,$post_responses['post_price'],$post_responses['post_request'],$post_responses['post_status'],$post_responses['post_response'],$post_responses['post_time'],null,null,null,$post_responses['redirect_url'],$ping_id = null);
						if($post_response['post_status']=='1'){
							$static_lender_accept_status = true;
							break;
						}else{
							continue;
						}
					}
				}
				/** ==============END================ */
				/** If there is no static price lender or no static price lender accept the post */
				/** =============== Send Post Data to Highest Ping Price Lender =================*/
				if($Max_Price_Ping_Accepted_Lender['ping_price']!='' && $static_lender_accept_status==false){
					$max_price_lender = $lender_details_model->findByPK($max_price_lender_id);
					$lendername = $max_price_lender->name;
					$LenderClassName = $lendername.'Controller';
					$methodName = 'sendPostData';
					$arg1 = $max_price_lender->parameter1;
					$arg2 = $max_price_lender->parameter2;
					$arg3 = $max_price_lender->parameter3;
					$static_lead_price = $max_price_lender->static_lead_price;
					$confirmation_id = $Max_Price_Ping_Accepted_Lender['confirmation_id'];
					$post_url = $max_price_lender->post_url_live;
					$lender_status = $lender->status;
					/** Send Post Data to Highest Ping Price Lender */
					$post_responses=call_user_func_array(array($LenderClassName, $methodName),array($arg1,$arg2,$arg3,$confirmation_id,$post_url,$lender_status));
					/*==================== Add Post Responce In Our Main Array ====================== */
					$lenders_response[$max_price_lender_id]['post_request'] 		= $post_responses['post_request'];
					$lenders_response[$max_price_lender_id]['post_response'] 	= $post_responses['post_response'];
					$lenders_response[$max_price_lender_id]['post_status'] 		= $post_responses['post_status'];
					$lenders_response[$max_price_lender_id]['post_price'] 		= $post_responses['post_price'];
					$lenders_response[$max_price_lender_id]['redirect_url'] 		= $post_responses['redirect_url'];
					$lenders_response[$max_price_lender_id]['post_time'] 			= $post_responses['post_time'];
					/*==================== Add Post Responce In Our Main Array ====================== */
					if(isset($lenders_response[$max_price_lender_id]['ping_price'])!=''){
						$post_price 	= $lenders_response[$max_price_lender_id]['ping_price'];
					}else{
						$post_price 	= $post_responses['post_price'];
					}
					/** Update Lender Accepted=1 in LenderAffiliateTransaction Table */
					$lender_aff_trans_model->lender_post_status_update($lendername,$promo_code,$post_responses['post_status'],$post_price);
					/** Update Post Log in LenderTransaction Table*/
					$cm->setLenderTransactionLog($lendername,$post_price,$post_responses['post_request'],$post_responses['post_status'],$post_responses['post_response'],$post_responses['post_time'],$ping_request=null,$ping_status=null,$ping_response=null,$post_responses['redirect_url'],$lenders_response[$max_price_lender_id]['ping_id']);
				}
				/** ===============END=================*/
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
					$redirect_url=$post_responses['redirect_url'];
					/** update lender and vendor price & redirect url in submission table **/
					$cm->setLeadPriceInSubmission($max_price_lender_id,$lender_lead_price,$vendor_lead_price,$redirect_url);
					/** send back accept response to affiliate with lead processing time */
					$time_end = CommonToolsMethods::stopwatch();
					$lead_processing_time = ($time_end - $start_time);
					$cm->setAcceptRespond($lender_lead_price,$vendor_lead_price,$lead_processing_time,$process);
				}
				/** ===================END============================*/
				/** No Lender Found, Send Denied Responce , Initiate Feed Process and Lastly Redirect to No Lender Found Page. */
				//$cm->setNoLenderFoundRespond();
				//FeedpostProcessController::pingFeedLenders('lead');
				
				//header('Location:'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'].'/leads/nolenderfound'));
				
				//Yii::app()->getController()->redirect( array(Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto'].'/index.php/coreg','request_data'=>'test'));
				
				Yii::app()->getController()->redirect(Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto'].'/index.php/coreg?request_data='.json_encode($_POST));
				
				//Yii::app()->getController()->redirect(array(Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto'].'/index.php/coreg','id'=>'test'));
				
				
			}else{
				/** Todays' cap is full of this affiliate(promo_code) */
				$affiliate = $affiliate_user_model->findByPk($promo_code);
				$cm->setRespondErrorExceedTime($affiliate->user_name,$process);
			}
		}
	}
}
