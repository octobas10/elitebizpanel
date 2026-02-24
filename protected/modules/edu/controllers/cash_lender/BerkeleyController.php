<?php
class BerkeleyController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender 
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $p4 = false){
				
		$program_model = new ProgramOfInterests();
		$valid_program = $program_model->checkProgramOfInteresetBerkeley(Yii::app()->request->getParam('program_of_interest'));
		if($valid_program){
			$prog_of_int = Yii::app()->request->getParam('program_of_interest');
		}else{
			$response = '<?xml version="1.0"?>';
			$response .= '<PostResponse>';
			$response .= '<Response>REJECTED</Response>';
			$response .= '<Errors><Error>Program of Interest is not valid (select from "GB","IB","MG","AC","CJ","FS","FN","ID","BA","LS","MK","TM","GD","HC","HSA","HM","HSC","MD","PCT","PN","SPT","SUR","CNA","NS","DM")</Error></Errors>';
			$response .= '</PostResponse>';
			echo $response;
			exit;
		}
		
		$campus = Yii::app()->request->getParam('campus');
		$src1 = '';
		$campus_array = array('BGN','CLF','DVR','GMT','MDL','NWK','NYB','NYC','WST');
		if(in_array(strtoupper($campus),$campus_array)){
			$src1 = "YHR";
		}else{
			$src1 = "YHL";
		}
		
        // $leadid = $_SESSION['lead_id'];
        /**
          * @author : vatsal gadhaia
          * @description : generate random number of exaclt length (here we will pass 36)
          * @since : 31-08-2016
        */
        for($i = 0; $i < 36; $i++) {
            $i_rand .= mt_rand(1, 9);
        }
		$leadid = Yii::app()->request->getParam('universal_leadid');
		$vendorlead = $_SESSION['affiliate_trans_id'];
    	$pingData = array();
        $fields = array(
            'firstName' => Yii::app()->request->getParam('first_name'),
            'lastName' => Yii::app()->request->getParam('last_name'),
            'address1' => Yii::app()->request->getParam('address'),
            'city' => Yii::app()->request->getParam('city'),
            'state' => Yii::app()->request->getParam('state'),
            'zip' => Yii::app()->request->getParam('zip'),
            'email' => Yii::app()->request->getParam('email'),
            'military' => Yii::app()->request->getParam('military'),
    		'leadid' => $leadid,
    		'phone' => Yii::app()->request->getParam('phone'),
    		'phonecell' => Yii::app()->request->getParam('mobile'),
    		'gradyear' => Yii::app()->request->getParam('grad_year'),
    		'campus' => $campus,
    		'inr1' => $prog_of_int,
    		'src1' => $src1,
    		'vendorlead' => $vendorlead,
			'comments' => Yii::app()->request->getParam('comments'),
			'password' => Yii::app()->request->getParam('password')
			
        );
        $pingData['ping_request'] = http_build_query($fields);
        return $pingData;
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response){

    	preg_match("/<isValidPost>(.*)<\/isValidPost>/msui",$ping_response,$result);
    	
    	/** Set Post Rejection, For Testing Purpose Only.*/
    	//$result[0]=$result[1] = 'false';
    	 
    	if(trim($result[1]) == 'true' || trim($result[0]) == 'true'){
    		preg_match("/<Price>(.*)<\/Price>/msui",$ping_response,$price);
    		preg_match("/<id>(.*)<\/id>/msui",$ping_response,$confirmation_id);
    		$ping_price = $price[1];
    		$confirmation_id = $confirmation_id[1];
    		$ping_response_info['ping_price'] = trim($ping_price);
    		$ping_response_info['ping_status'] = '1';
    		$ping_response_info['confirmation_id'] = $confirmation_id;
    	}else{
    		$ping_price = 0;
    		$ping_response_info['ping_price'] = $ping_price;
    		$ping_response_info['ping_status'] = '0';
    		$ping_response_info['confirmation_id'] = '';
    	}
    	return $ping_response_info;
    }
    /**
     * Send Post Data to Lender 
     */
    public static function sendPostData($parameter1,$parameter2,$parameter3,$ping_response,$post_url,$status){
    	preg_match("/<id>(.*)<\/id>/",$ping_response, $confirmation_id);
				
		$program_model = new ProgramOfInterests();
		$valid_program = $program_model->checkProgramOfInteresetBerkeley(Yii::app()->request->getParam('program_of_interest'));
		if($valid_program){
			/**
			* @author : Vatsal Gadhia
			* @description : Yii::app()->request->getParam('program_of_interest') replaced by $_REQUEST['program_of_interest'] (as getParam retrieve the data from url)
			* @since : 05-01-2017 13:24
		   */
			$prog_of_int = $_REQUEST['program_of_interest']; //Yii::app()->request->getParam('program_of_interest');
		}else{
			$response = '<?xml version="1.0"?>';
			$response .= '<PostResponse>';
			$response .= '<Response>REJECTED</Response>';
			$response .= '<Errors><Error>Program of Interest is not valid (select from "GB","IB","MG","AC","CJ","FS","FN","ID","BA","LS","MK","TM","GD","HC","HSA","HM","HSC","MD","PCT","PN","SPT","SUR","CNA","NS","DM")</Error></Errors>';
			$response .= '</PostResponse>';
			echo $response;
			exit;
		}
		
		/**
      * @author : Vatsal Gadhia
      * @description : Yii::app()->request->getParam('campus') replaced by $_REQUEST['campus'] (as getParam retrieve the data from url)
      * @since : 05-01-2017 13:24
     */
		$campus = $_REQUEST['campus']; //Yii::app()->request->getParam('campus');
		$src1 = '';
		$campus_array = array('BGN','CLF','DVR','GMT','MDL','NWK','NYB','NYC','WST');
		if(in_array(strtoupper($campus),$campus_array)){
			$src1 = "YHR";
		}else{
			$src1 = "YHL";
		}
        
        $cm = new CommonMethods();
		
		/**
         * @since : 22-12-2016 05:46 PM
         * @author : Siddharajsinh Maharaul
         * @functionality : Array for store rejected lead response
         */
        $t_reasons = array();
		
		/**
         * @since : 26-12-2016 11:38 AM
         * @author : Siddharajsinh Maharaul
         * @functionality : Check for paused promo code and sub id pair
         */
        /**
         * @since : 26-12-2016 01:32 PM
         * @author : Siddharajsinh Maharaul
         * @functionality : Removed exit from this condition and added reason to array to combine at last of the validations.
         */
        if(!isset($_REQUEST['repost'])) {
            $promo_code = Yii::app()->request->getParam('promo_code');
            $sub_id = Yii::app()->request->getParam('sub_id');
            if(!empty($promo_code) && !empty($sub_id)){
                $o_paused_affiliate = new PausedAffiliate;
                $t_paused_data = $o_paused_affiliate -> checkPausedAffiliateSubIdPair(' pa.promo_code = "'.$promo_code.'" and pad.sub_id = "'.$sub_id.'"');
                if(!empty($t_paused_data)){
                    $o_submissions = new Submissions();
                    $o_submissions -> update_campus_cap($_SESSION['affiliate_trans_id'],'3');                    
                    $i_customer_id = $o_submissions -> getCustomerId($_SESSION['affiliate_trans_id']);
                    if(!empty($i_customer_id)){
                        $o_submissions -> markQuestionableLead($i_customer_id);
                    }
                    unset($o_submissions);
                    // $cm->pausedDirectPost();  
                    $t_reasons[] = 'Paused Direct Posting';  
                }
            }
        } 
		
		
        /////////////////////////REJECT LEADS WITH DUPLICATE IP -- STARTS/////////////////////////
        if(isset($_REQUEST['repost']) && !empty($_REQUEST['repost'])) {}
        else {
            if(isset($_SESSION['is_reject_lead']) && !empty($_SESSION['is_reject_lead']) && $_SESSION['is_reject_lead']=='1') {
                if(isset($_SESSION['is_lead_reposted']) && !empty($_SESSION['is_lead_reposted']) && $_SESSION['is_lead_reposted']=='1') {
                    $_SESSION['is_lead_reposted'] = '0';
                    unset($_SESSION['is_lead_reposted']);
                } else {
                    $_SESSION['is_reject_lead'] = '0';
                    unset($_SESSION['is_reject_lead']);
                    $o_submissions = new Submissions();
                    $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'2');
					/**
					 * @since : 26-12-2016 01:32 PM
					 * @author : Siddharajsinh Maharaul
					 * @functionality : Reason for rejecting lead and store this to save it after all condition checked
					 */
					$t_reasons[] = 'Duplicate Ip-address';
                    //$cm->edusetDuplicateIP();
                    //exit;
                }
            }
        }
        //////////////////////////REJECT LEADS WITH DUPLICATE IP -- ENDS//////////////////////////
        if(isset($_SESSION['verify_phone']) && !empty($_SESSION['verify_phone']) && $_SESSION['verify_phone']=='1') {
            $_SESSION['verify_phone'] = '0';
            unset($_SESSION['verify_phone']);
            $o_affiliate_user = new AffiliateUser();
            $msg = $o_affiliate_user->checkPhone(Yii::app()->request->getParam('phone'));
            if($msg==1) {
                $msg_cell = $o_affiliate_user->checkPhone(Yii::app()->request->getParam('mobile'));
                if($msg_cell==1) {
                } else {
					/**
                     * @since : 13-12-2016 01:15 PM
                     * @author : Siddharajsinh Maharaul
                     * @functionality : Added is_campus_cap = 3 for rejected due to invalid phone
                     */
                    $o_submissions = new Submissions();
                    $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
					/**
					 * @since : 26-12-2016 01:32 PM
					 * @author : Siddharajsinh Maharaul
					 * @functionality : Reason for rejecting lead and store this to save it after all condition checked
					 */
					$t_reasons[] = 'Invalid Mobile';
                    //$cm->edusetInvalidNumber('organic',2);
                    //exit;
                }
            } else {
				/**
                 * @since : 13-12-2016 01:15 PM
                 * @author : Siddharajsinh Maharaul
                 * @functionality : Added is_campus_cap = 3 for rejected due to invalid phone
                 */
                $o_submissions = new Submissions();
                $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
				/**
				 * @since : 26-12-2016 01:32 PM
				 * @author : Siddharajsinh Maharaul
				 * @functionality : Reason for rejecting lead and store this to save it after all condition checked
				 */
				$t_reasons[] = 'Invalid Phone';
                //$cm->edusetInvalidNumber('organic',1);
                //exit;
            }
        }

        if(isset($_SESSION['verify_address']) && !empty($_SESSION['verify_address']) && $_SESSION['verify_address']=='1') {
            $_SESSION['verify_address'] = '0';
            unset($_SESSION['verify_address']);
            $user_address = Yii::app()->request->getParam('address');
            $user_city = Yii::app()->request->getParam('city');
            $user_state = Yii::app()->request->getParam('state');
            $user_zip = Yii::app()->request->getParam('zip');
            if(!AffiliatesController::actionUSPSPostalAddressVerification($user_address,$user_city,$user_state,$user_zip)) {
				/**
                 * @since : 13-12-2016 01:15 PM
                 * @author : Siddharajsinh Maharaul
                 * @functionality : Added is_campus_cap = 3 for rejected due to invalid address
                 */
                $o_submissions = new Submissions();
                $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
				/**
				 * @since : 26-12-2016 01:32 PM
				 * @author : Siddharajsinh Maharaul
				 * @functionality : Reason for rejecting lead and store this to save it after all condition checked
				 */
				$t_reasons[] = 'Invalid Postal Address';
                //$cm->edusetVerificationFailed('1');
                //exit;
            }
        }

        if(isset($_SESSION['verify_email']) && !empty($_SESSION['verify_email']) && $_SESSION['verify_email']=='1') {
            $_SESSION['verify_email'] = '0';
            unset($_SESSION['verify_email']);
            $user_email = Yii::app()->request->getParam('email');

                require 'XverifyClientAPI.php';
                $api_key = '1000018-2917DC1B';//'09ASXD-9E0B1F9C'; // Your API Key
                $options = array();
                $options['type'] = 'json'; // API response type
                $options['domain'] = 'higherlearningapp.com';// Reruired your domain name 
                $options['catch_all'] = 'no';// Reruired your domain name 
                $client = new XverifyClientAPI($api_key,$options);
                $data = array();
                $data['email'] = $user_email;
                $client->verify('email',$data);
                $t_response = explode('jQuery22402469638349049722_1480935238606(', $client->response);
                if(isset($t_response) && !empty($t_response)) {
                    $t_response = explode(')',$t_response[1]);
                    if(isset($t_response) && !empty($t_response)) {
                        $json_response = json_decode($t_response[0]);
                        if($json_response->email->status=='valid') {
                        } else {
							/**
                             * @since : 13-12-2016 01:15 PM
                             * @author : Siddharajsinh Maharaul
                             * @functionality : Added is_campus_cap = 3 for rejected due to invalid email
                             */
                            $o_submissions = new Submissions();
                            $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
							/**
							 * @since : 26-12-2016 01:32 PM
							 * @author : Siddharajsinh Maharaul
							 * @functionality : Reason for rejecting lead and store this to save it after all condition checked
							 */
							$t_reasons[] = 'Invalid Email Address';
                            //$cm->edusetVerificationFailed('2');
                            //exit;
                        }
                    } else {
						/**
                         * @since : 13-12-2016 01:15 PM
                         * @author : Siddharajsinh Maharaul
                         * @functionality : Added is_campus_cap = 3 for rejected due to invalid email
                         */
                        $o_submissions = new Submissions();
                        $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
						/**
						 * @since : 26-12-2016 01:32 PM
						 * @author : Siddharajsinh Maharaul
						 * @functionality : Reason for rejecting lead and store this to save it after all condition checked
						 */
						$t_reasons[] = 'Invalid Email Address';
                        //$cm->edusetVerificationFailed('2');
                        //exit;
                    }
                } else {
					/**
                     * @since : 13-12-2016 01:15 PM
                     * @author : Siddharajsinh Maharaul
                     * @functionality : Added is_campus_cap = 3 for rejected due to invalid email
                     */
                    $o_submissions = new Submissions();
                    $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
					/**
					 * @since : 26-12-2016 01:32 PM
					 * @author : Siddharajsinh Maharaul
					 * @functionality : Reason for rejecting lead and store this to save it after all condition checked
					 */
					$t_reasons[] = 'Invalid Email Address';
                    //$cm->edusetVerificationFailed('2');
                    //exit;
                }
        }
		
		//====Code To Check Distance Between Entered Address and Retrieved IP Address Starts====//
        /**
          * @author : Vatsal Gadhia
          * @description : get distance between entered address and retrieved IP address
          * @since : 04-01-2017 11:13
         */
        /**
          * @author : Vatsal Gadhia
          * @description : check ip range validation only for "organic" leads (sent through indexprocess) and do not check ip range validation for promo_code=90
          * @since : 20-01-2017 10:47
         */
        if(!isset($_REQUEST['repost']) && empty($_REQUEST['repost'])) {
          if(isset($_SESSION['index_process_set'])) {
            if(isset($_REQUEST['promo_code']) && !empty($_REQUEST['promo_code']) && $_REQUEST['promo_code']!=90) {
              $latitudeFrom = $longitudeFrom = $latitudeTo = $longitudeTo = '';
        
              $address = Yii::app()->request->getParam('address');
              // Get JSON results from this request
              $s_geo_city = Yii::app()->request->getParam('city');
              $s_geo_state = Yii::app()->request->getParam('state');
              $s_geo_address = $address." ".$s_geo_city." ".$s_geo_state;
              // Get JSON results from this request
              $address_ch = curl_init('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($s_geo_address).'&sensor=false');
              curl_setopt($address_ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($address_ch, CURLOPT_POST, false);
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
                    $t_reasons[] = 'IP Range Limit Crossed';
                  }
                } else {
                  if(isset($_SESSION['post_process_set'])) {
                    unset($_SESSION['post_process_set']);
                  } else {
                    $o_submissions = new Submissions();
                    $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
                  }
                  $t_reasons[] = 'IP Range Limit Crossed';
                }
              } else {
                if(isset($_SESSION['post_process_set'])) {
                  unset($_SESSION['post_process_set']);
                } else {
                  $o_submissions = new Submissions();
                  $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
                }
                $t_reasons[] = 'IP Range Limit Crossed';
              }
            }
          }
        }
        //=====Code To Check Distance Between Entered Address and Retrieved IP Address Ends=====//

          /**
            * @author : Vatsal Gadhia
            * @description : code to check whether the cap_limit is reached when lead is posted through api(postprocess)
            * @since : 04-01-2017 12:16
           */
        if(isset($_SESSION['post_process_cap_limit_reach']) && !empty($_SESSION['post_process_cap_limit_reach'])) {
          // $o_submissions = new Submissions();
          // $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'1');
          $t_reasons[] = $_SESSION['post_process_cap_limit_reach'];
          $_SESSION['post_process_cap_limit_reach'] = '';
          unset($_SESSION['post_process_cap_limit_reach']);
        }
		
		/**
         * @since : 22-12-2016 05:54 PM
         * @author : Siddharajsinh Maharaul
         * @functionality : Check for reason and addded all together in rejected response
         */
        /**
         * @Author : Siddharajsinh Maharaul
         * @Date : 28-12-2016 03:31 PM
         * @functionality : Added exit after response set, if any reason found for above Paused,Duplicate Ip, Email,Postal Address and phone.
         */
        if(!empty($t_reasons)){
            $cm->setResponse(implode(',',$t_reasons));
            exit;
        }

        /**
         * @author : vatsal gadhia
         * @description : check cap limit for campus
         * @since : 09-09-2016
         */
        // ========================== code to check cap starts ========================== //

        $o_campus_details = new CampusDetails();
        //get all caps for campus
        $t_caps = $o_campus_details->getCampusCapDetails("where campus_code='".$campus."'");

        //get total submission for campus
		/**
         * @since : 12-12-2016 03:34 PM
         * @author : Siddharajsinh Maharaul
         * @functionality : Changed response from setNoLenderFoundRespond() to setCapLimitMet()
         */
        $t_submissions = $o_campus_details->getDurationTransactions($campus);
        if(isset($t_caps) && !empty($t_caps)) {
            if(isset($t_submissions) && !empty($t_submissions)) {
                //check daily limit
                if($t_caps[0]['daily_limit']!=-1) {
                    if($t_caps[0]['daily_limit'] > $t_submissions['day_submission']) { }
                    else {
                        //daily limit over
                        
                        if(isset($_SESSION['post_process_set'])) {
                          unset($_SESSION['post_process_set']);
                        } else {
                          $o_submissions = new Submissions();
                          $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id']);
                        }

                        if(isset($_SESSION['index_process_set'])) {
                          $o_submissions = new Submissions();
                          $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id']);
                        }
                        $cm->setCapLimitMet();
                        exit;
                    }
                }

                //check weekly limit
                if($t_caps[0]['weekly_limit']!=-1) {
                    if($t_caps[0]['weekly_limit'] > $t_submissions['week_submission']) { }
                    else {
                        //weekly limit over
                        
                        if(isset($_SESSION['post_process_set'])) {
                          unset($_SESSION['post_process_set']);
                        } else {
                          $o_submissions = new Submissions();
                          $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id']);
                        }

                        if(isset($_SESSION['index_process_set'])) {
                          $o_submissions = new Submissions();
                          $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id']);
                        }
                        $cm->setCapLimitMet();
                        exit;
                    }
                }

                //check monthly limit
                if($t_caps[0]['monthly_limit']!=-1) {
                    if($t_caps[0]['monthly_limit'] > $t_submissions['month_submission']) { }
                    else {
                        //monthly limit over
                        
                        if(isset($_SESSION['post_process_set'])) {
                          unset($_SESSION['post_process_set']);
                        } else {
                          $o_submissions = new Submissions();
                          $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id']);
                        }

                        if(isset($_SESSION['index_process_set'])) {
                          $o_submissions = new Submissions();
                          $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id']);
                        }
                        $cm->setCapLimitMet();
                        exit;
                    }
                }
            }
        }
//        else {
//            //caps not found for campus
//            $cm->setNoLenderFoundRespond();
//            exit;
//        }

        // =========================== code to check cap ends =========================== //
		/**
		 ** author : vatsal gadhia
		 ** description : 1) value for key "phonecell" is changed with the value retrieved by get parameter "mobile"
		 **               2) value for key "password" is changed with the value retrieved by parameter "$parameter1"
		 ** date : 03-08-2016
		 */
        // $leadid = $_SESSION['lead_id'];
        /**
          * @author : vatsal gadhaia
          * @description : generate random number of exaclt length (here we will pass 36)
          * @since : 31-08-2016
        */
        for($i = 0; $i < 36; $i++) {
            $i_rand .= mt_rand(1, 9);
        }
       $leadid = Yii::app()->request->getParam('universal_leadid');
		$vendorlead = $_SESSION['affiliate_trans_id'];
    	$fields = array(
    		'http_referer' => 'http://elitebizpanel.com/index.php/edu/postprocess?',
            'firstName' => Yii::app()->request->getParam('first_name'),
            'lastName' => Yii::app()->request->getParam('last_name'),
            'address1' => Yii::app()->request->getParam('address'),
            'city' => Yii::app()->request->getParam('city'),
            'state' => Yii::app()->request->getParam('state'),
            'zip' => Yii::app()->request->getParam('zip'),
            'email' => Yii::app()->request->getParam('email'),
            'military' => Yii::app()->request->getParam('military'),
    		'leadid' => $leadid,
    		'phone' => Yii::app()->request->getParam('phone'),
    		'phonecell' => Yii::app()->request->getParam('mobile'),
    		'password' => $parameter1,
    		'gradyear' => Yii::app()->request->getParam('grad_year'),
    		'campus' => $campus,
    		'inr1' => $prog_of_int,
    		'src1' => $src1,
    		'vendorlead' => $vendorlead,
			'comments' => Yii::app()->request->getParam('comments')
    	);
    	if($confirmation_id!=''){ $fields['confirmation'] = $confirmation_id;}
    	$post_request = http_build_query($fields);
    	$cm = new CommonMethods();
    	$start_time = CommonToolsMethods::stopwatch();
    	$post_full_response = $cm->curl($post_url,$post_request);
		
		//print_r($post_full_response);
		
    	$time_end = CommonToolsMethods::stopwatch();
		
		if (strpos($post_full_response, 'FAILURE') !== false) {
			$post_status = '0';
    		$post_price = '0';
    		$redirect_url = '';
		}else if (strpos($post_full_response, 'SUCCESS') !== false) {
			$post_status = '1';
    		preg_match("/<redirectURL>(.*)<\/redirectURL>/", $post_full_response, $redirect);
    		$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			//echo $redirect_url;
    		preg_match("/<Price>(.*)<\/Price>/msui",$post_full_response,$price);
    		$post_price=isset($price[1]) ? $price[1] : '';
		}else{
			$post_status = '0';
    		$post_price = '0';
    		$redirect_url = '';
		}
    
    	$post_time = ($time_end - $start_time);
    	
    	$post_responses['post_request'] = $post_request;
    	$post_responses['post_response'] = $post_full_response;
    	$post_responses['post_status'] = $post_status;
    	$post_responses['post_price'] = $post_price;
    	$post_responses['redirect_url'] = $redirect_url;
    	$post_responses['post_time'] = $post_time;
		//exit();
    	return $post_responses;
    }
}
?>
