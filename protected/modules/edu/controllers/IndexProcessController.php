<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class IndexProcessController extends Controller{
	public function actionIndex(){
		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods:GET,POST,JSONP');
        header("Access-Control-Allow-Headers:HTTP-X-REQUESTED-WITH");
		$_POST = $_REQUEST;
		//session_start();
		$_SESSION['index_process_set']=true;
		//echo '<pre>';print_r($_REQUEST);exit;
		$process = 'organic';
		Yii::app()->session['ping_type'] = 'directpost';
		$promo_code = Yii::app()->request->getParam('promo_code');
		$lead_mode = Yii::app()->request->getParam('lead_mode');
		
		if($_REQUEST['city']=='' || $_REQUEST['state']==''){
			$o_edu_zip_codes = new EduZipCodes();
            $zipcode_city_state = $o_edu_zip_codes->checkzipcodedatabase($_REQUEST['zip']);
			$_REQUEST['city'] = $zipcode_city_state['city'];
			$_REQUEST['state'] = $zipcode_city_state['state'];
		}
		//$tcpa_text = Yii::app()->request->getParam('tcpa_text','By pressing Submit on this page, I give Higher Learning App associated colleges permission to call and/or text me about its programs or services at the phone number provided, including a wireless numb');
		$_REQUEST['tcpa_text'] = 'By pressing Submit on this page, I give Higher Learning App associated colleges permission to call and/or text me about its programs or services at the phone number provided, including a wireless numb';

		/**
		 * @description : code to set lead_mode as pet the affiliate status
		 */
		$affiliate_user_model = new AffiliateUser;
		$submission_model = new Submissions();
		/**
		  * @description : code to set is_campus_cap=0 for lead which is re-submitted by clicking on link send in email
		 */
		$previous_submission_id = Yii::app()->request->getParam('previous_submission_id');
		if(isset($previous_submission_id) && !empty($previous_submission_id)) {
			$submission_model->update_campus_cap($previous_submission_id,'1');
		}
		/** Affiliate Promo Code & Status check, Check whether affiliate is active or not */
		$affiliate_status = $affiliate_user_model->checkAffiliateStatus($promo_code);
		$lead_mode = Yii::app()->session['lead_mode'];
		$_REQUEST['lead_mode'] = $lead_mode;
		$_POST['lead_mode'] = $lead_mode;
		$_POST['lead_id'] = Yii::app()->request->getParam('universal_leadid');
		$sub_id2 = Yii::app()->request->getParam('sub_id2');
		if(isset($sub_id2) && !empty($sub_id2)) {
			$_POST['sub_id2'] = $sub_id2;
		} else {
			$_POST['sub_id2'] = '';
		}
		/**  @description : check whether user is allowed for duplicate IP leads or not */
		$affiliate_ip_block = $affiliate_user_model->checkAffiliateIPBlock($promo_code);
		if($affiliate_ip_block) {
			$is_allow_duplicate_ip = "1";
		} else { $is_allow_duplicate_ip = "0"; }
		$is_reject_lead='0';
		/**
		 * @functionality : Added ip address if lead posted from repost section
		 * @functionality : Changed condition direct from yii get parameter method to storing it in variable and used it.
		 */
		$s_ipaddress = Yii::app()->request->getParam('ipaddress');
		$ip_address = (!empty($s_ipaddress) ? $s_ipaddress : $_SERVER['REMOTE_ADDR'] );	
		$ip_count = $submission_model->checkDuplicateIP($promo_code,$ip_address);
		if(isset($ip_count) && !empty($ip_count) && $ip_count>0) {
			if($is_allow_duplicate_ip=='0') {
				$is_reject_lead = '1';
				Yii::app()->session['is_reject_lead'] = '1';
			} else {
				$is_reject_lead = '0';
				Yii::app()->session['is_reject_lead'] = '0';
				if($lead_mode==1){
					/**
					 * @functionality : Do not change promo code if lead come for repost
					 */
					if(Yii::app()->request->getParam('repost') != 1){
						$_POST['promo_code']='1';
					}
				}
			}
		}
		$cm = new CommonMethods();
		/*================================*/
		if(!isset($_REQUEST['repost']) && empty($_REQUEST['repost'])) {
          if(isset($_SESSION['index_process_set'])) {
            if(($_REQUEST['promo_code']=='90' || $_REQUEST['promo_code']=='114' || $_REQUEST['promo_code']=='115' || $_REQUEST['promo_code']=='1')) {
			}else{
              $latitudeFrom = $longitudeFrom = $latitudeTo = $longitudeTo = '';
              $address = Yii::app()->request->getParam('address');
              // Get JSON results from this request
              $s_geo_city = Yii::app()->request->getParam('city');
              $s_geo_state = Yii::app()->request->getParam('state');
              $s_geo_address = $address." ".$s_geo_city." ".$s_geo_state;
              // Get JSON results from this request
			  $posting='';
              $address_ch = curl_init('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($s_geo_address).'&sensor=false');
              curl_setopt($address_ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($address_ch, CURLOPT_POST, false);
			  curl_setopt($address_ch, CURLOPT_POSTFIELDS, $posting);
              curl_setopt($address_ch, CURLOPT_TIMEOUT, 2);
              $geo = curl_exec($address_ch);
              curl_close($address_ch);
              // Convert the JSON to an array
              $geo = json_decode($geo, true);
              if ($geo['status'] == 'OK') {
                $latitudeFrom = $geo['results'][0]['geometry']['location']['lat'];
                $longitudeFrom = $geo['results'][0]['geometry']['location']['lng'];
              }
              $ipaddress = Yii::app()->request->getParam('ipaddress');
              if(empty($ipaddress)) {
                $ipaddress = $_SERVER['REMOTE_ADDR'];
				$_REQUEST['ipaddress'] = $ipaddress;
              }
              $ip_ch = curl_init('http://freegeoip.net/json/'.$ipaddress);
              curl_setopt($ip_ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ip_ch, CURLOPT_POST, false);
              curl_setopt($ip_ch, CURLOPT_TIMEOUT, 2);
              $t_ip_lat_long = curl_exec($ip_ch);
              curl_close($ip_ch);
              if(isset($t_ip_lat_long) && !empty($t_ip_lat_long)) {
                $t_ip_lat_long = json_decode($t_ip_lat_long,true);
                $latitudeTo = $t_ip_lat_long['latitude'];
                $longitudeTo = $t_ip_lat_long['longitude'];
              }
			  
              if(isset($latitudeFrom) && !empty($latitudeFrom) && isset($longitudeFrom) && !empty($longitudeFrom) && isset($latitudeTo) && !empty($latitudeTo) && isset($longitudeTo) && !empty($longitudeTo)) {
                $theta = $longitudeFrom - $longitudeTo;
                $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                if(isset($miles) && !empty($miles)) {
                  if($miles>400) {
                    if(isset($_SESSION['post_process_set'])) {
                      unset($_SESSION['post_process_set']);
                    } else {
                      $o_submissions = new Submissions();
                      $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
                    }
                    $cm->setRespondError('','iprangelimitcrossed',$process);
                  }
                } else {
                  if(isset($_SESSION['post_process_set'])) {
                    unset($_SESSION['post_process_set']);
                  } else {
                    $o_submissions = new Submissions();
                    $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
                  }
                  $cm->setRespondError('','iprangelimitcrossed',$process);
                }
              } else {
                if(isset($_SESSION['post_process_set'])) {
                  unset($_SESSION['post_process_set']);
                } else {
                  $o_submissions = new Submissions();
                  $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
                }
                $cm->setRespondError('','iprangelimitcrossed',$process);
              }
            }
          }
        }
		
		/*=================*/
		if(isset($_REQUEST['lead_mode']) && !empty($_REQUEST['lead_mode']) && $_REQUEST['lead_mode']==1) {
			$campus = Yii::app()->request->getParam('campus');
	        $zip = Yii::app()->request->getParam('zip');
	        $poi = Yii::app()->request->getParam('program_of_interest');
	        $o_campus_details = new CampusDetails();
	        //get all caps for campus
	        $t_caps = $o_campus_details->getCampusCapDetails("where campus_code='".$campus."'");
	        //get total submission for campus
	        $t_submissions = $o_campus_details->getDurationTransactions($campus);
            if(isset($t_submissions) && !empty($t_submissions)) {
                //check daily limit
                if($t_caps[0]['daily_limit']!=-1) {
                    if($t_caps[0]['daily_limit'] > $t_submissions['day_submission']) { }
                    else {
                        //daily limit over
                        $o_edu_zip_codes = new EduZipCodes();
                        $t_campus_progs = $o_edu_zip_codes->getCampusProgramFromZip($zip," AND campus_code!='".$campus."'");
                        if(isset($t_campus_progs) && !empty($t_campus_progs)) {
                            foreach ($t_campus_progs as $t_campus_prog) {
                                $t_caps_new = $o_campus_details->getCampusCapDetails("where campus_code='".$t_campus_prog['campus_code']."'");
                                $t_submissions_new = $o_campus_details->getDurationTransactions($t_campus_prog['campus_code']);
                                if(isset($t_caps_new) && !empty($t_caps_new) && isset($t_submissions_new) && !empty($t_submissions_new)) {
                                    if($t_caps_new[0]['daily_limit']!=-1) {
                                        if($t_caps_new[0]['daily_limit'] <= $t_submissions_new['day_submission']) {
                                        } else {
											$_REQUEST['lender_id'] = $t_campus_prog['lender_id'];
                                            $campus = $t_campus_prog['campus_code'];
                                            $poi = $t_campus_prog['program_of_interest_code'];
                                            $_POST['campus'] = $campus;
                                            $_POST['program_of_interest'] = $poi;
                                            break;
                                        }
                                    } else {
                                        $campus = $t_campus_prog['campus_code'];
                                        $poi = $t_campus_prog['program_of_interest_code'];
                                        $_POST['campus'] = $campus;
                                        $_POST['program_of_interest'] = $poi;
                                        break;
                                    }
                                } else {
                                }
                            }
                        } else {
                        }
                    }
                }
                //check weekly limit
                if($t_caps[0]['weekly_limit']!=-1) {
                    if($t_caps[0]['weekly_limit'] > $t_submissions['week_submission']) { }
                    else {
                        //weekly limit over
                        $o_edu_zip_codes = new EduZipCodes();
                        $t_campus_progs = $o_edu_zip_codes->getCampusProgramFromZip($zip," AND campus_code!='".$campus."'");
                        if(isset($t_campus_progs) && !empty($t_campus_progs)) {
                            //////////////////////////////
                            foreach ($t_campus_progs as $t_campus_prog) {
                                $t_caps_new = $o_campus_details->getCampusCapDetails("where campus_code='".$t_campus_prog['campus_code']."'");
                                $t_submissions_new = $o_campus_details->getDurationTransactions($t_campus_prog['campus_code']);
                                if(isset($t_caps_new) && !empty($t_caps_new) && isset($t_submissions_new) && !empty($t_submissions_new)) {
                                    if($t_caps_new[0]['weekly_limit']!=-1) {
                                        if($t_caps_new[0]['weekly_limit'] <= $t_submissions_new['week_submission']) {
                                        } else {
											$_REQUEST['lender_id'] = $t_campus_prog['lender_id'];
                                            $campus = $t_campus_prog['campus_code'];
                                            $poi = $t_campus_prog['program_of_interest_code'];
                                            $_POST['campus'] = $campus;
                                            $_POST['program_of_interest'] = $poi;
                                            break;
                                        }
                                    } else {
                                        $campus = $t_campus_prog['campus_code'];
                                        $poi = $t_campus_prog['program_of_interest_code'];
                                        $_POST['campus'] = $campus;
                                        $_POST['program_of_interest'] = $poi;
                                        break;
                                    }
                                } else {
                                }
                            }
                        } else {
                        }
                    }
                }
                //check monthly limit
                if($t_caps[0]['monthly_limit']!=-1) {
                    if($t_caps[0]['monthly_limit'] > $t_submissions['month_submission']) { }
                    else {
                        //monthly limit over
                        $o_edu_zip_codes = new EduZipCodes();
                        $t_campus_progs = $o_edu_zip_codes->getCampusProgramFromZip($zip," AND campus_code!='".$campus."'");
                        if(isset($t_campus_progs) && !empty($t_campus_progs)) {
                            //////////////////////////////
                            foreach ($t_campus_progs as $t_campus_prog) {
                                $t_caps_new = $o_campus_details->getCampusCapDetails("where campus_code='".$t_campus_prog['campus_code']."'");
                                $t_submissions_new = $o_campus_details->getDurationTransactions($t_campus_prog['campus_code']);
                                if(isset($t_caps_new) && !empty($t_caps_new) && isset($t_submissions_new) && !empty($t_submissions_new)) {
                                    if($t_caps_new[0]['monthly_limit']!=-1) {
                                        if($t_caps_new[0]['monthly_limit'] <= $t_submissions_new['month_submission']) {
                                        } else {
											$_REQUEST['lender_id'] = $t_campus_prog['lender_id'];
                                            $campus = $t_campus_prog['campus_code'];
                                            $poi = $t_campus_prog['program_of_interest_code'];
                                            $_POST['campus'] = $campus;
                                            $_POST['program_of_interest'] = $poi;
                                            break;
                                        }
                                    } else {
                                        $campus = $t_campus_prog['campus_code'];
                                        $poi = $t_campus_prog['program_of_interest_code'];
                                        $_POST['campus'] = $campus;
                                        $_POST['program_of_interest'] = $poi;
                                        break;
                                    }
                                } else {
                                }
                            }
                        } else {
                        }
                    }
                }
            }
        }
		//echo '<pre>****>';print_r($_POST);exit;
		/** Add affiliate transaction in the affiliate transaction table */ 
		LeadsController::actionAffiliateTransaction($_POST,$process); 
		/** Validation check function check required field and other validation */
		LeadsController::actionValidationCheck($_POST,$process);
		/** Give duplicate lead error if lead is dublicate else insert new data */ 
		LeadsController::actionCheckDuplicate($_POST,$process);
		/** Affiliate Cap Check */
		$affiliate_cap = $affiliate_user_model->check_affiliate_cap($promo_code);
		$cm = new CommonMethods();
		/** start the clock to mesure ping post time */
		$start_time = CommonToolsMethods::stopwatch();
		$lender_aff_trans_model = new LenderAffiliateTransaction();
		$lender_details_model=new LenderDetails();
		$edu_zip_codes_model = new EduZipCodes();
		if($affiliate_status!='TestMode'){
			if($affiliate_cap){
				$multi_curl = array();
				/** Get all the lenders whose status live and who is not static_lead_price lender */
				$dummy_lenders = array('DummyLender1','DummyLender2','Dummy');
				$dummy_lenders_list = implode("','",$dummy_lenders);
				if($lead_mode==1){
					$lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND name NOT IN ('".$dummy_lenders_list."') AND static_lead_price=0.00"));
				}else{
					$lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND name='Dummy' AND static_lead_price=0.00"));
				}
					//echo '<pre>'; print_r($lenderlist);exit;
					// ======= Check Affiliate and Lender Setting(Paused Vendor,Submission Cap, Acceptance Cap) ====== 
					// Add lender's id to check USPS zip validation for them 
					//$USPS_Zip_Check_Lenders = array(4); // 4=AstoriaCompany
					foreach($lenderlist as $lender){
						$lender_id = $lender->id;
						/** Check USPS ZIP validation for these lenders*/
						/*if(in_array($lender_id, $USPS_Zip_Check_Lenders)){
							$zip = Yii::app()->request->getParam('zip');
							$USPS_Zip = $submission_model->USPS_Validation($zip);
							if($USPS_Zip!=1) continue;
						}*/
						//check zipcode, campus_code, program_of_interest_code and lender_id matches or not
						/*if($lender->no_check_geo_footprint == '0'){
							$valid_zip_codes=$edu_zip_codes_model->checkZipCampusProgram(Yii::app()->request->getParam('zip'),Yii::app()->request->getParam('campus'),Yii::app()->request->getParam('program_of_interest'),$lender_id);
							if(!$valid_zip_codes){
								$cm->setOutsideGeoFootprintRespond();
							}			
						}*/
						/** Check for Paused Vendor */
						$check_paused_vendor = $lender_details_model->check_paused_vendor($lender_id);
						$paused_vendor = in_array($promo_code, $check_paused_vendor);
						if($paused_vendor==1) continue;
						/** Check Submission and Acceptance Cap of Lender */
						$check_submission_accept_cap = $lender_details_model->check_acceptCap($lender->user_name);
						//print_r($check_submission_accept_cap);
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
					print_r($Filtered_Lenders);exit;
					/** ========================== Create Lender List For Ping And Post ============================ */
					/**
					 * description : validation added to check if filtered lenders found then only proceed further or else execute another query
					 */
					if(isset($Filtered_Lenders) && !empty($Filtered_Lenders)) {
						$list = implode(', ',$Filtered_Lenders);
						if($list){
							// This is the lender list which we use everywhere
							$lenderlist = $lender_details_model->findAll(array("condition"=>" id IN (".$list.") AND status = 1 AND static_lead_price=0.00"));
						}else{
							$cm->setNoLenderFoundRespond();
						}
					}
				$i_max_price = 0;
				$MATCHED_LENDER_FIRST = $_REQUEST['lender_id'] ? $_REQUEST['lender_id'] : 0;
				if($lead_mode==1){
					if($MATCHED_LENDER_FIRST == '0'){
						$static_price_lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND name NOT IN ('".$dummy_lenders_list."')  AND static_lead_price>=0.00"));
					}else{
						$static_price_lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND id IN ('".$MATCHED_LENDER_FIRST."') AND name NOT IN ('".$dummy_lenders_list."')  AND static_lead_price>=0.00",'order'=>'FIELD(id,'.$MATCHED_LENDER_FIRST.') DESC, static_lead_price DESC'));
					}
				} else {
					$static_price_lenderlist = $lender_details_model->findAll(array("condition"=>"status = 1 AND name='Dummy' AND static_lead_price>=0.00",'order'=>'static_lead_price desc'));
				}
				/*if($_SERVER['REMOTE_ADDR']=='103.60.177.1'){
					echo '<pre>';print_r($static_price_lenderlist);echo $MATCHED_LENDER_FIRST;print_r($_REQUEST);exit;
				}*/
				$static_lender_accept_status = false;
				if(!empty($static_price_lenderlist)){
					$static_price_direct_post=true;
					foreach($static_price_lenderlist as $static_price_lender){
						if($static_price_lender->no_check_geo_footprint == '0'){
							$valid_zip_codes = $edu_zip_codes_model->checkZipCampusProgram(Yii::app()->request->getParam('zip'),'','',$lender_id);
							if(!$valid_zip_codes){
								$cm->setOutsideGeoFootprintRespond();
							}
						}
						$lendername = $static_price_lender->name;
						$lender_id = $static_price_lender->id;
						$LenderClassName = $lendername.'Controller';
						$methodName = 'sendPostData';
						$arg1 = $static_price_lender->parameter1;
						$arg2 = $static_price_lender->parameter2;
						$arg3 = $static_price_lender->parameter3;
						$static_lead_price = $static_price_lender->static_lead_price;
						Yii::app()->session['verify_phone']=$static_price_lender->verify_phone;
						Yii::app()->session['verify_email']=$static_price_lender->verify_email;
						Yii::app()->session['verify_address']=$static_price_lender->verify_address;
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
						$ping_id = null;
						// added campus code in lender transaction 01.18.2018
						$campus_code = $_REQUEST['campus'];
						$post_responses['post_price']=$static_lead_price;
						/** Increment submission count in ledner affiliate trasaction */
						$lender_aff_trans_model->lender_post_status_update($lender_id,$promo_code,$post_responses['post_status'],$post_responses['post_price'],$static_price_direct_post);
						/** Update Post Log in LenderTransaction Table*/
						$cm->setLenderTransactionLogEdu($lendername,$post_responses['post_price'],$post_responses['post_request'],$post_responses['post_status'],$post_responses['post_response'],$post_responses['post_time'],null,null,null,null,$post_responses['redirect_url'],$ping_id,$campus_code);

						if($post_responses['post_status']=='1'){
							$static_lender_accept_status = true;
							break;
						}else{
							continue;
						}
					}
				}
				// ===============END=================
				$aff_post_status = $post_responses['post_status']=='1' ? 1 : 0;
				// Update affiliate's daily count
				AffiliateDailyCounts::model()->update_affiliate_daily_counts($promo_code, $aff_post_status);
				//Calculate Lead Margin Price,Update Submission Table and Send back Aceepted Response to Affiliate
				if($post_responses['post_status']=='1'){
					// calculation of lender lead price and vendor lead price with margin/comission
					$affiliate = $affiliate_user_model->findByPk($promo_code);
					if($static_lead_price == '0.00'){
						$lender_lead_price=$post_price;
					}else{
						$lender_lead_price=$static_lead_price;
					}
					$vendor_lead_price=$lender_lead_price-(($lender_lead_price*$affiliate->margin)/100);
					$redirect_url=$post_responses['redirect_url'];
					//echo $max_price_lender_id;
					//code added because if lender_list is empty at initial level max_price_lender_id will not be set
					if(!isset($max_price_lender_id) || empty($max_price_lender_id)){ $cm->setNoLenderFoundRespond($process); }
					//echo $max_price_lender_id;
					// update lender and vendor price & redirect url in submission table
					//$cm->setLeadPriceInSubmission($max_price_lender_id,$lender_lead_price,$vendor_lead_price,$redirect_url);
					// send back accept response to affiliate with lead processing time 
					$time_end = CommonToolsMethods::stopwatch();
					$lead_processing_time = ($time_end - $start_time);
					//echo $lead_processing_time.$process;
					$cm->edusetAcceptRespond($lender_lead_price,$vendor_lead_price,$lead_processing_time,$process);
				}
				else{
					//No Lender Found, Send Denied Responce , Initiate Feed Process and Lastly Redirect to No Lender Found Page.
					$cm->setNoLenderFoundRespond($process);
				}
				//FeedpostProcessController::pingFeedLenders('lead');
			}else{
				// Todays' cap is full of this affiliate(promo_code)
				$affiliate = $affiliate_user_model->findByPk($promo_code);
				$cm->setRespondErrorExceedTime($affiliate->user_name,$process);
			}
		}
	}
}