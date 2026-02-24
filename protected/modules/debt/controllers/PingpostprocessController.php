<?php
/* Post(after ping) Process */
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PingpostprocessController extends Controller {
    public function actionIndex() {
        $_POST = $_REQUEST;
        $process = 'inorganic';
        if(isset($_POST['dob'])){
    		if(($_POST['dob'] == '1969-12-31' || trim($_POST['dob'])=='') && !empty($_POST['email'])){
                $dob = CommonToolsMethods::getDOBbyEmailSpencer($_POST['email']);
                if($dob){
                    $_POST['dob'] = $dob;
                }
            }
        }
        Yii::app()->session['ping_type'] = 'post';
        $lead_mode = Yii::app()->request->getParam('lead_mode');
        $promo_code = Yii::app()->request->getParam('promo_code');
        /** Add affiliate transaction in the affiliate transaction table */
        LeadsController::actionAffiliateTransaction($_POST, $process);
        $affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
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
        $lender_details_model = new LenderDetails();
        $lender_transaction_model = new LenderTransactions();
        // SEND ACCEPTED RESONSE FOR AFFILIATE WHEN LEAD MODE =0
        if ($lead_mode == 0) {
            $cm->setAcceptRespond('0.00', '0.00', '0', $process);
        }
        if ($affiliate_status != 'TestMode') {
            if ($affiliate_cap) {
                $lenders = $lender_transaction_model->get_Lender_Pigned_With_This_Ping_Id($affiliate_trans_id);
                if($lenders){
                    $lender_ping_price =  $lenders[0]->ping_price;
                }else{
                    $lender_ping_price = '0';
                }
                /** == ADD CODE FOR STATIC PRICE BUYER ====== */
                $static_price_lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND static_lead_price>$lender_ping_price",'order'=>'static_lead_price desc'));
                if(!empty($static_price_lenderlist)){
                    foreach($static_price_lenderlist as $static_price_lender){
                        $lendername = $static_price_lender->name;
                        $lender_id = $static_price_lender->id;
                        $LenderClassName = $lendername.'Controller';
                        $methodName = 'sendPostData';
                        $arg1 = $static_price_lender->parameter1;
                        $arg2 = $static_price_lender->parameter2;
                        $arg3 = $static_price_lender->parameter3;
                        $static_lead_price = $static_price_lender->static_lead_price;
                        $confirmation_id = '';
                        $post_url = $static_price_lender->post_url_live;
                        $lender_status = $static_price_lender->status;
                        /** Send Post Data to Static Price Lender */
                        $post_response=call_user_func_array(array($LenderClassName,$methodName),array($arg1,$arg2,$arg3,$confirmation_id,$post_url,$lender_status));
                        $ping_id = null;
                        $post_response['post_price'] = $static_lead_price;
                        /** Increment submission count in ledner affiliate trasaction */
                        $static_price_direct_post=true;
                        $lender_aff_trans_model->lender_post_status_update($lender_id,$promo_code,$post_response['post_status'],$post_response['post_price'],$static_price_direct_post);
                        /** Update Post Log in LenderTransaction Table*/
                        $cm->setLenderTransactionLog($lendername,$post_response['post_price'],$post_response['post_request'],$post_response['post_status'],$post_response['post_response'],$post_response['post_time'],null,null,null,$post_response['redirect_url'],$ping_id,$lender_id);
                        if($post_response['post_status']=='1'){
                            unset($lenders);//if lead is accepted do not send post to buyer whoes ping was accepted
                            break;
                        }else{
                            continue;
                        }
                    }
                }
                /** == ADD CODE FOR STATIC PRICE BUYER ====== */
                /** ===== Send Post Data to Highest Ping Price Lender ====== */
                /** Check Ping Id Status. Actually Ping Exist or not */
                $ping_id = Yii::app()->request->getParam('ping_id');
                LeadsController::check_Ping_Id_Existence($ping_id);
                if (!empty($lenders)) {
                    foreach ($lenders as $lender) {
                        if ($lender->name != '') {
                            $lender_trans_id = $lender->lender_trans_id;
                            $lender_id = $lender->id;
                            $lendername = $lender->name;
                            $LenderClassName = $lendername . 'Controller';
                            $methodName = 'sendPostData';
                            $arg1 = $lender->parameter1;
                            $arg2 = $lender->parameter2;
                            $arg3 = $lender->parameter3;
                            $ping_response = $lender->ping_response;
                            $post_url = $lender->post_url_live;
                            $lender_status = $lender->status;
                            $post_response = call_user_func_array(array($LenderClassName, $methodName), array($arg1, $arg2, $arg3, $ping_response, $post_url, $lender_status));
                            /** Update Post Log in LenderTransaction Table */
                            //mail('octobas@gmail.com','Ping post Process....',$post_response['post_price']);
                            $cm->setLenderTransactionLog($lendername, $post_response['post_price'], $post_response['post_request'], $post_response['post_status'], $post_response['post_response'], $post_response['post_time'], $ping_request = null, $ping_status = null, $ping_response = null, $post_response['redirect_url'], $lender_trans_id,$lender_id);
                            /** Update Lender Accepted=1 in LenderAffiliateTransaction Table */
                            $lender_aff_trans_model->lender_post_status_update($lender_id, $promo_code, $post_response['post_status'], $post_response['post_price']);
                            if ($post_response['post_status'] == 1){
                                break;
                            }
                        }
                    }
                }
                /** ====================================END======================================== */
                $aff_post_status = $post_response['post_status'] == '1' ? 1 : 0;
                /** Update affiliate's daily count */
                AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_post_status);
                /** Calculate Lead Margin Price,Update Submission Table and Send back Accepted Response to Affiliate * */
                if ($post_response['post_status'] == '1') {
                    $redirect_url = $post_response['redirect_url'];
                    /** calculation of lender lead price and vendor lead price with margin/comission */
                    $affiliate = $affiliate_user_model->findByPk($promo_code);
                    $lender_aff_trans = $lender_transaction_model->findByPk($lender_trans_id);
                    $ping_price = $lender_aff_trans->ping_price;
                    $lender_lead_price = (isset($ping_price) && $ping_price != '0.00') ? $ping_price : $post_response['post_price'];
                    /* DO NOT CALCULATE VENDOR PING PRICE TAKE FROM AFF TRANSACTION TABEL*/
                    //$vendor_lead_price = $lender_lead_price - (($lender_lead_price * $affiliate->margin) / 100);
                    $affiliate_trans_model = new affiliateTransactions;
                    $affiliateTransactions = $affiliate_trans_model->findByPk($affiliate_trans_id);
                    $vendor_lead_price = $affiliateTransactions->vendor_ping_price;
                    $redirect_url = $post_response['redirect_url'];
                    /** update lender and vendor price & redirect url in submission table * */
                    $cm->setLeadPriceInSubmission($lender_id, $lender_lead_price, $vendor_lead_price, $redirect_url);
                    /** send back accept response to affiliate with lead processing time */
                    $time_end = CommonToolsMethods::stopwatch();
                    $lead_processing_time = ($time_end - $start_time);
                    $cm->setAcceptRespond($lender_lead_price, $vendor_lead_price, $post_response['post_time'], $process);
                }elseif($post_response['post_status']=='2'){
                    $post_fail_reason = !empty($post_response['post_fail_reason'])?$post_response['post_fail_reason']:'unknown';
                    $cm->setRespondError('',$post_fail_reason,$process);
                }else{
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