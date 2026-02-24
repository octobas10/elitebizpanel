<?php

//echo $_SERVER['REMOTE_ADDR'];echo '<br>';echo $_SERVER['SERVER_ADDR'];exit;
/* if(($_SERVER['REMOTE_ADDR']=='103.240.33.226' || $_SERVER['REMOTE_ADDR']=='104.162.168.42') && $_SERVER['SERVER_ADDR']=='192.168.1.188'){
  }else{
  exit;
  } */
/* Ping  Process */
error_reporting(E_ALL);
ini_set('display_errors', 1);
require dirname(__FILE__) . './../../../../vendor/autoload.php';
class PingprocessController extends Controller
{
    public function actionIndex()
    {
        $redisClient = new Predis\Client();
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $reqCount = $redisClient->incr($ip);
        $ttl = $redisClient->ttl($ip);
        //if($ip == '81.96.154.57'){}
        if ($ttl == '-1') {
            $redisClient->expire($ip, 60);
        }
        if ($reqCount < Yii::app()->params['homeimprovement_ping_cap']) {
            $_POST = $_REQUEST;
            $process = 'inorganic';
            Yii::app()->session['ping_type'] = 'ping';
            $promo_code = Yii::app()->request->getParam('promo_code');
            $lead_mode = Yii::app()->request->getParam('lead_mode');
            $affiliate_user_model = new AffiliateUser;
            /** Add affiliate transaction in the affiliate transaction table */
            LeadsController::actionAffiliateTransaction($_POST, $process);
            /** Validation check function check required field and other validation */
            LeadsController::actionValidationCheck($_POST, $process);
            /** Give duplicate lead error if lead is duplicate else insert new data */
            LeadsController::actionCheckPingDuplicate($_POST, $process);  // May 16,2016 when rich asked about the query
            /** Affiliate Cap Check */
            $affiliate_cap = $affiliate_user_model->check_affiliate_cap($promo_code);
            //$affiliate_cap = true;
            $cm = new CommonMethods();
            /** start the clock to mesure ping time */
            $start_time = CommonToolsMethods::stopwatch();
            $lender_aff_trans_model = new LenderAffiliateTransaction();
            $lender_details_model = new LenderDetails();
            $affiliate_status = $affiliate_user_model->checkAffiliateStatus($promo_code, $process);
            // SEND ACCEPTED RESONSE FOR AFFILIATE WHEN LEAD MODE =0
            if ($lead_mode == 0) {
                $cm->setAffiliatePingResponse(1, '0.00', '0.00', '00');
            }
            if ($affiliate_status != 'TestMode') {
                if ($affiliate_cap) {
                    $multi_curl = array();
                    /** Get all the lenders whose status live and who is not static_lead_price lender */
                    if ($promo_code == '1') {
                        $lenders_list = $_POST['lender'];
                        $lenderlist = $lender_details_model->findAll(array("condition" => "name IN ('" . $lenders_list . "') AND lender_pingpost_type=0", 'order' => 'id DESC'));
                    } else if ($lead_mode == 1) {
                        $lenderlist = $lender_details_model->findAll(array("condition" => "status = 1 AND name != 'DummyLender1' AND name != 'DummyLender2' AND lender_pingpost_type=0", 'order' => 'id DESC'));
                    } else {
                        $lenderlist = $lender_details_model->findAll(array("condition" => "status = 1 AND lender_pingpost_type=0"));
                    }
                    /** Add lender's id to check USPS zip validation for them */
                    /*if ($promo_code == '1') {
                        echo '<pre>';print_r($lenderlist);die();
                    }*/
                    $Filtered_Lenders = [];
                    foreach ($lenderlist as $lender) {
                        $lender_id = $lender->id;
                        /** Check for Paused Vendor */
                        $check_paused_vendor = $lender_details_model->check_paused_vendor($lender_id);
                        $paused_vendor = in_array($promo_code, $check_paused_vendor);
                        if ($paused_vendor == 1) continue;
                        /** CHECK SUBMISSION CAP AND ACCEPT CAP OF THE LENDER */
                        $check_submission_accept_cap = $lender_details_model->check_acceptCap($lender->id);
                        if (!$check_submission_accept_cap) continue;
                        /** Check Cap of Lender for perticular Affiliate (Lender Affiliate Setting) */
                        $lender_aff_cap = $lender_aff_trans_model->check_lender_affiliate_cap($promo_code, $lender_id);
                        if (!$lender_aff_cap) continue;
                        $time_limit = Yii::app()->request->getParam('time_limit', '15');
                        $remained_time_limit = floor($time_limit - $cm->time_check($start_time));
                        if ($remained_time_limit <= $lender->posting_timelimit || $lender->posting_timelimit != '-1') continue;
                        /** Add this Filtered Lender Id in Array */
                        $Filtered_Lenders[] = $lender_id;
                        //echo '<pre>';print_r($Filtered_Lenders);die();
                    }
                    /** ======= Create Lender List For Ping And Post ========= */
                    $list = implode(',', $Filtered_Lenders);
                    //mail('tony.elitecashwire@gmail.com','from pingprocesscontroller 55',$list);
                    if ($list) {
                        /** This is the lender list which we use everywhere */
                        if ($promo_code == '1') {
                            $lenderlist = $lender_details_model->findAll(array("condition" => " id IN (" . $list . ") AND static_lead_price=0.00"));
                        } else {
                            $lenderlist = $lender_details_model->findAll(array("condition" => " id IN (" . $list . ") AND status = 1 AND static_lead_price=0.00"));
                        }
                    } else {
                        $cm->setAffiliatePingResponse(0, 0, 0, 0);
                    }
                    /** == END =========== */
                    /** === Create Ping Request Array ===== */
                    foreach ($lenderlist as $lender) {
                        $lender_id = $lender->id;
                        $lendername = $lender->name;
                        $LenderClassName = $lendername . 'Controller';
                        $arg1 = $lender->parameter1;
                        $arg2 = $lender->parameter2;
                        $arg3 = $lender->parameter3;
                        $arg4 = $lender->status;
                        //$arg4 = 0;
                        $ping_url = $lender->status == '0' ? $lender->ping_url_test : $lender->ping_url_live;
                        if ($lender->ping_url_test != '' || $lender->ping_url_live != '') {
                            $methodName = 'returnPingData';
                            $ping_data[$lender_id] = call_user_func_array(array($LenderClassName, $methodName), array($arg1, $arg2, $arg3, $arg4, $ping_url));
                            if ($ping_data[$lender_id]['ping_request'] != false) {
                                $ping_lender_url = $ping_data[$lender_id]['ping_url'];
                                $ping_url = (isset($ping_lender_url) && $ping_lender_url != '') ? $ping_lender_url : $ping_url;
                                $lenders_response[$lender_id]['ping_url'] = $ping_url;
                                $lenders_response[$lender_id]['ping_request'] = $ping_data[$lender_id]['ping_request'];
                                // ADD LENDER MARGIN IN LENDER RESPONSE ARRAY
                                $lenders_response[$lender_id]['margin'] = $lender->margin;
                                $multi_curl[$lender_id]['lender_id'] = $lender_id;
                                $multi_curl[$lender_id]['ping_url'] = $ping_url;
                                $multi_curl[$lender_id]['ping_request'] = $ping_data[$lender_id]['ping_request'];
                                $multi_curl[$lender_id]['header'] = $ping_data[$lender_id]['header'];
                            } else {
                                $multi_curl[$lender_id]['lender_id'] = $lender_id;
                                $multi_curl[$lender_id]['ping_response_filtered'] = $ping_data[$lender_id]['ping_response_filtered'];
                            }
                        }
                    }
                    /** ========== Broadcast Ping to Every Lender =====* */
                    $ping_responses = $cm->multi_curl($multi_curl);
                    //echo '<pre>..123..';print_r($ping_responses);echo '</pre>';die();
                    /** =======Get Response form Ping and Set Lender Trasaction Log ========== */
                    $aff_ping_status = 0;
                    foreach ($lenderlist as $lender){
                        $lender_id = $lender->id;
                        if ($ping_responses[$lender_id] && !empty($ping_responses[$lender_id]['ping_response'])) {//16.JAN.2026
                            if ($lender->ping_url_test != '' || $lender->ping_url_live != '') {
                                $lendername = $lender->name;
                                /* === Add Ping Respose and Ping Time in Our Main Array === */
                                $lenders_response[$lender_id]['ping_response'] = $ping_responses[$lender_id]['ping_response'];
                                $lenders_response[$lender_id]['ping_time'] = $ping_responses[$lender_id]['ping_time'];
                                /* ==== Add Ping Respose and Ping Time in Our Main Array === */
                                $ping_response = $lenders_response[$lender_id]['ping_response'];
                                $LenderClassName = $lendername . 'Controller';
                                $methodName = 'returnPingResponse';
                                /** Return Ping Status, Ping Price, and Confirmation ID from Ping Response */
                                $ping_response_info[$lender_id] = call_user_func_array(array($LenderClassName, $methodName), array($ping_response));
                                /* ====== Add Ping Response in Our Main Array ======= */
                                $lenders_response[$lender_id]['ping_price'] = $ping_response_info[$lender_id]['ping_price'];
                                $lenders_response[$lender_id]['ping_status'] = $ping_response_info[$lender_id]['ping_status'];
                                $lenders_response[$lender_id]['confirmation_id'] = $ping_response_info[$lender_id]['confirmation_id'];
                                /* ====== Add Ping Response in Our Main Array ======= */
                                /* ======== One2One Consent============= */
                                if($ping_response_info[$lender_id]['brands']){
                                    foreach($ping_response_info[$lender_id]['brands'] as $brands){
                                        $cm->saveBrandBuyers($brands,$lender_id);
                                    }
                                }
                                /* ======== One2One Consent============= */
                                $ping_price = $lenders_response[$lender_id]['ping_price'];
                                $ping_time = $lenders_response[$lender_id]['ping_time'];
                                $ping_request = $lenders_response[$lender_id]['ping_request'];
                                $ping_status = $lenders_response[$lender_id]['ping_status'];
                                $ping_response = $lenders_response[$lender_id]['ping_response'];
                                /** increment submission count in ledner affiliate trasaction */
                                $lender_aff_trans_model->lender_ping_status_update($lender_id, $promo_code, $ping_status, $ping_price);
                                /** Update Ping Log in LenderTransaction Table */
                                $ping_id = $cm->setLenderTransactionLog($lendername, $ping_price, $post_request = null, $post_status = null, $post_response = null, $ping_time, $ping_request, $ping_status, $ping_response, $redirect_url = null, $ping_id = null, $lender_id);
                                $lenders_response[$lender_id]['ping_id'] = $ping_id;
                                $ping_prices[$lender_id] = $lenders_response[$lender_id]['ping_price'];
                                if ($ping_status == 1) {
                                    $aff_ping_status = 1;
                                }
                            }
                        }else{ //16.JAN.2026
                            $ping_prices[$lender_id] = null;
                        }
                    }
                    /** =============END============== */
                    /** ==== Find Max Ping Price Lender ==== */
                    $max_price_lender_id = array_search(max($ping_prices), $ping_prices);
                    $Max_Price_Ping_Accepted_Lender = $lenders_response[$max_price_lender_id];
                    /** =================END=  */
                    $Max_Ping_Price = ($Max_Price_Ping_Accepted_Lender['ping_price'] != '') ? $Max_Price_Ping_Accepted_Lender['ping_price'] : 0.00;
                    /** == Calculate Ping Time for Affiliate == */
                    $time_end = CommonToolsMethods::stopwatch();
                    $aff_ping_time = ($time_end - $start_time);
                    /** ================== END ================ */
                    /** Affiliate ping price calculation based on margin set for that affiliate */
                    $affiliate = $affiliate_user_model->findByPk($promo_code);
                    // APPLY LENDER MARGIN OR AFFILIATE MARGIN
                    $lender_margin = $lenders_response[$max_price_lender_id]['margin'];
                    $applied_margin = $lender_margin > $affiliate->margin ? $lender_margin : $affiliate->margin;
                    $vendor_ping_price = $Max_Ping_Price - (($Max_Ping_Price * $applied_margin) / 100);
                    /** =========== CHECK BID PRICE = */
                    if ($aff_ping_status == 1) {
                        //mail('octobas@gmail.com','Min Bid Price accepted',$vendor_ping_price .'---'. $affiliate->min_bid_price);
                        if ($vendor_ping_price < $affiliate->min_bid_price) {
                            $aff_ping_status = 0;
                        }
                    }
                    /** =========== CHECK BID PRICE = */
                    /** Update affiliate's daily count */
                    AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_ping_status);
                    /** Update lender ping price and vendor ping price in affiliate transaction table * */
                    $cm->setAffiliatePingResponse($aff_ping_status, $Max_Ping_Price, $vendor_ping_price, $aff_ping_time,$applied_margin);
                } else {
                    /** Todays' cap is full of this affiliate(promo_code) */
                    $affiliate = $affiliate_user_model->findByPk($promo_code);
                    $cm->setRespondErrorExceedTime($affiliate->user_name, $process);
                }
            }
        } else {
            $ttl = $redisClient->ttl($ip);
            echo json_encode(['status' => "You have used up all your quota, Try again after {$ttl} seconds "]);
            exit();
        }
    }
}
