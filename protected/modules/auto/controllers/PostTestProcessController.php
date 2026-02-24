<?php
class PostTestProcessController extends Controller{
	public function actionIndex(){
		$process = 'inorganic';
		/** Add affiliate transaction in the affiliate transaction table */ 
		LeadsController::actionAffiliateTransaction($_REQUEST); 
		/** Validation check function check required field and other validation */
		LeadsController::actionValidationCheck($_REQUEST,$process);
		/** Give duplicate lead error if lead is duplicate else insert new data */ 
		LeadsController::actionCheckDuplicate($_REQUEST,$process);
		$promo_code = Yii::app()->request->getParam('promo_code');
		$affiliate_user_model = new AffiliateUser;
		/** Affiliate Promo Code & Status check, Check whether affiliate is active or not */
		$affiliate_status = $affiliate_user_model->checkAffiliateStatus($promo_code);
		/** Affiliate Cap Check */
		$affiliate_cap = $affiliate_user_model->check_affiliate_cap($promo_code);
		$connection=Yii::app()->db;
		$cm = new CommonMethods();
		/** start the clock to mesure ping post time */
		$start_time = CommonToolsMethods::stopwatch();
		$lender_aff_trans_model = new LenderAffiliateTransaction();
		$lender_details_model=new LenderDetails();
		if($affiliate_status!='TestMode'){
			if($affiliate_cap){
				$multi_curl = array();
				$lender_id  = Yii::app()->getRequest()->getParam('lender_id');
				$lenderlist = $lender_details_model->findAll(array("condition"=>"id=$lender_id"));
				/** ====================== Create Ping Request Array ======================== */
				foreach($lenderlist as $lender){
					$lender_id = $lender->id;
					$lendername = $lender->name;
					$LenderClassName = $lendername.'Controller';
					$arg1 = $lender->parameter1;
					$arg2 = $lender->parameter2;
					$arg3 = $lender->parameter3;
					$ping_url = $lender->status == '0' ? $lender->ping_url_test : $lender->ping_url_live;
					if($lender->ping_url_test!='' || $lender->ping_url_live !=''){
						$methodName = 'returnPingData';
						$ping_data[$lender_id] = call_user_func_array(array($LenderClassName,$methodName),array($arg1,$arg2,$arg3));
						$lenders_response[$lender_id]['ping_url']		= 	$ping_url;
						$lenders_response[$lender_id]['ping_request'] 	=	$ping_data[$lender_id]['ping_request'];
						$multi_curl[$lender_id]['lender_id'] 			=	$lender_id;
						$multi_curl[$lender_id]['ping_url'] 			=	$ping_url;
						$multi_curl[$lender_id]['ping_request'] 		=	$ping_data[$lender_id]['ping_request'];
						$multi_curl[$lender_id]['header'] 				=	$ping_data[$lender_id]['header'];
					}
				}
				/** =================================END======================================= */
				//echo '<pre>';print_r($multi_curl);echo '</pre>';
				/** ========== Broadcast Ping to Every Lender =====**/
				$ping_responses = $cm->multi_curl($multi_curl);
				//echo '<pre>';print_r($ping_responses);echo '</pre>';
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
						$ping_response		= $lenders_response[$lender_id]['ping_response'];
						$LenderClassName	= $lendername.'Controller';
						$methodName			= 'returnPingResponse';
						/** Return Ping Status, Ping Price, and Confirmation ID from Ping Response */
						$ping_response_info[$lender_id] = call_user_func_array(array($LenderClassName,$methodName),array($ping_response));
						/* ========================= Add Ping Response in Our Main Array ========================== */
						$lenders_response[$lender_id]['ping_status'] 		= $ping_response_info[$lender_id]['ping_status'];
						$lenders_response[$lender_id]['ping_price'] 			= $ping_response_info[$lender_id]['ping_price'];
						$lenders_response[$lender_id]['confirmation_id'] 	= $ping_response_info[$lender_id]['confirmation_id'];
						/* ========================= Add Ping Response in Our Main Array ========================== */
						/** Update Ping Log in LenderTransaction Table*/
						$ping_id = $cm->setLenderTransactionLog($lendername,$lenders_response[$lender_id]['ping_price'],$post_request=null,$post_status=null,$post_response=null,$lenders_response[$lender_id]['ping_time'],$lenders_response[$lender_id]['ping_request'],$lenders_response[$lender_id]['ping_status'],$ping_response,$redirect_url=null,$ping_id=null,$lender_id);
						$lenders_response[$lender_id]['ping_id'] = $ping_id;
						$ping_prices[$lender_id] = $lenders_response[$lender_id]['ping_price'];
						/** increment submission count in ledner affiliate trasaction */
						$lender_aff_trans_model->lender_ping_status_update($lendername,$promo_code,$lenders_response[$lender_id]['ping_status'],$lenders_response[$lender_id]['ping_price']);
					}
				}
				/** =============END============== */
				/** ==== Find Max Ping Price Lender ==== */
				$max_price_lender_id = array_search(max($ping_prices),$ping_prices);
				$Max_Price_Ping_Accepted_Lender = $lenders_response[$max_price_lender_id];
				/** =================END====================  */
				$Max_Ping_Price = ($Max_Price_Ping_Accepted_Lender['ping_price']!='') ? $Max_Price_Ping_Accepted_Lender['ping_price'] : 0.00;
				/** =============== Send Post Data to Highest Ping Price Lender =================*/
				if($Max_Price_Ping_Accepted_Lender['ping_price']!=''){
					$max_price_lender = $lender_details_model->findByPK($max_price_lender_id);
					$lendername = $max_price_lender->name;
					$lender_id = $max_price_lender->id;
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
					$post_responses=call_user_func_array(array($LenderClassName,$methodName),array($arg1,$arg2,$arg3,$confirmation_id,$post_url,$lender_status));

					/*==================== Add Post Responce In Our Main Array ====================== */
					$lenders_response[$max_price_lender_id]['post_request'] 		= $post_responses['post_request'];
					$lenders_response[$max_price_lender_id]['post_response'] 	= $post_responses['post_response'];
					$lenders_response[$max_price_lender_id]['post_status'] 		= $post_responses['post_status'];
					$lenders_response[$max_price_lender_id]['post_price'] 		= $post_responses['post_price'];
					$lenders_response[$max_price_lender_id]['redirect_url'] 		= $post_responses['redirect_url'];
					$lenders_response[$max_price_lender_id]['post_time'] 			= $post_responses['post_time'];
					/*==================== Add Post Responce In Our Main Array ====================== */
					
					if(isset($lenders_response[$max_price_lender_id]['ping_price'])!=''){
						$post_price 		= $lenders_response[$max_price_lender_id]['ping_price'];
					}else{
						$post_price 		= $post_responses['post_price'];
					}
					$post_request 			= $post_responses['post_request'];
					$post_status 			= $post_responses['post_status'];
					$post_response 		= $post_responses['post_response'];
					$post_time 				= $post_responses['post_time'];
					$ping_request 			= null;
					$ping_responses 		= null;
					$ping_response 		= null;
					$redirect_url 			= $post_responses['redirect_url'];
					$ping_id 				= $lenders_response[$max_price_lender_id]['ping_id'];
					
					/** Update Post Log in LenderTransaction Table*/
					$cm->setLenderTransactionLog($lendername,$post_price,$post_request,$post_status,$post_response,$post_time,$ping_request,$ping_responses,$ping_response,$redirect_url,$ping_id,$lender_id);
					
					/** Update Lender Accepted=1 in LenderAffiliateTransaction Table */
					$lender_aff_trans_model->lender_post_status_update($lendername,$promo_code,$post_status,$post_price);
				}
				/** ===============END=================*/
				
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
			}
		}
	}
}
