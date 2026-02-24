<?php
class RoninrevenueAmrcolController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender 
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $p4 = false){
		$program_model = new ProgramOfInterests();
		$valid_program = $program_model->checkProgramOfIntereset(Yii::app()->request->getParam('program_of_interest'));
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
    public static function returnPingResponse($ping_response){
    	preg_match("/<isValidPost>(.*)<\/isValidPost>/msui",$ping_response,$result);
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
    public static function sendPostData($parameter1,$parameter2,$parameter3,$ping_response,$post_url,$status){
		$cm = new CommonMethods();
    	preg_match("/<id>(.*)<\/id>/",$ping_response, $confirmation_id);
		$program_model = new ProgramOfInterests();
		$valid_program = $program_model->checkProgramOfInteresetRoninRevenuesACMC(Yii::app()->request->getParam('program_of_interest'));
		if($valid_program['id']){
			$prog_of_int = $valid_program['id']; //Yii::app()->request->getParam('program_of_interest');
		}else{
			$cm->setRespondError('','programofinterestnonavailable','inorganic');
		}
		$campus = $_REQUEST['campus']; //Yii::app()->request->getParam('campus');
        $t_reasons = array();
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
                    $t_reasons[] = 'Paused Direct Posting';  
                }
            }
        } 
        //**********************REJECT LEADS WITH DUPLICATE IP -- **********************//
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
					$t_reasons[] = 'Duplicate Ip-address';
                }
            }
        }
        //**********************REJECT LEADS WITH DUPLICATE IP -- ENDS**********************//
        if(isset($_SESSION['verify_phone']) && !empty($_SESSION['verify_phone']) && $_SESSION['verify_phone']=='1') {
            $_SESSION['verify_phone'] = '0';
            unset($_SESSION['verify_phone']);
            $o_affiliate_user = new AffiliateUser();
            $msg = $o_affiliate_user->checkPhone(Yii::app()->request->getParam('phone'));
            if($msg==1) {
                $msg_cell = $o_affiliate_user->checkPhone(Yii::app()->request->getParam('mobile'));
                if($msg_cell==1) {
                } else {
                    $o_submissions = new Submissions();
                    $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
					$t_reasons[] = 'Invalid Mobile';
                }
            } else {
                $o_submissions = new Submissions();
                $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
				$t_reasons[] = 'Invalid Phone';
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
                $o_submissions = new Submissions();
                $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
				$t_reasons[] = 'Invalid Postal Address';
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
                            $o_submissions = new Submissions();
                            $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
							$t_reasons[] = 'Invalid Email Address';
                        }
                    } else {
                        $o_submissions = new Submissions();
                        $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
						$t_reasons[] = 'Invalid Email Address';
                    }
                } else {
                    $o_submissions = new Submissions();
                    $o_submissions->update_campus_cap($_SESSION['affiliate_trans_id'],'3');
					$t_reasons[] = 'Invalid Email Address';
                }
        }
        if(!isset($_REQUEST['repost']) && empty($_REQUEST['repost'])) {
          if(isset($_SESSION['index_process_set'])) {
            if(isset($_REQUEST['promo_code']) && !empty($_REQUEST['promo_code']) && ($_REQUEST['promo_code']!=90 || $_REQUEST['promo_code']!=114 )) {
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
        if(isset($_SESSION['post_process_cap_limit_reach']) && !empty($_SESSION['post_process_cap_limit_reach'])) {
          $t_reasons[] = $_SESSION['post_process_cap_limit_reach'];
          $_SESSION['post_process_cap_limit_reach'] = '';
          unset($_SESSION['post_process_cap_limit_reach']);
        }
        if(!empty($t_reasons)){
            $cm->setResponse(implode(',',$t_reasons));
            exit;
        }
        $o_campus_details = new CampusDetails();
        $t_caps = $o_campus_details->getCampusCapDetails("where campus_code='".$campus."'");
		$campus_id_rr = $t_caps[0]['campus_id'];
		
		//mail('octobas@gmail.com','ACMC campus', $campus.'-----'.$campus_id_rr);
		
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
		
		$master_degree = Yii::app()->request->getParam('master_degree');
		$ged = Yii::app()->request->getParam('ged');
		if($master_degree){
			$education_level_id = '163';
		}else if($ged){
			$education_level_id = '158';
		}else{
			$EDU_array = array('159','159','161');
			$edu_key = array_rand($EDU_array);
			$education_level_id = $EDU_array[$edu_key];
		}
		$start_date_list = array('Immediately','1-3 Months','1-3 Months','1-3 Months','4-6 Months');
		$sd_key = array_rand($start_date_list);
        $leadid = Yii::app()->request->getParam('universal_leadid');
		$vendorlead = $_SESSION['affiliate_trans_id'];
		$promo_code = Yii::app()->request->getParam('promo_code');
    	$fields = array(
			'campaign_code' => $parameter1 ? $parameter1 :'dvskx748VkjvAUm6W7sUsw',
            'lead[firstname]' => Yii::app()->request->getParam('first_name'),
            'lead[lastname]' => Yii::app()->request->getParam('last_name'),
            'lead_address[address]' => Yii::app()->request->getParam('address'),
            'lead_address[city]' => Yii::app()->request->getParam('city'),
            'lead_address[state]' => strtoupper(Yii::app()->request->getParam('state')),
            'lead_address[zip]' => Yii::app()->request->getParam('zip'),
            'lead[email]' => Yii::app()->request->getParam('email'),
    		'lead[phone1]' => Yii::app()->request->getParam('phone'),
    		'lead[gender]' => 'M',
			//'lead[age]' => '',
    		'lead_education[grad_year]' => Yii::app()->request->getParam('grad_year'),
    		'lead_education[program_id]' => $prog_of_int,
    		'lead_education[education_level_id]' => $education_level_id,
			'lead_education[campus_id]' => '82',
    		'lead_education[start_date]' => $start_date_list[$sd_key],
    		'lead_custom_value[Near]' => 'Y',
    		'lead_custom_value[Visit]' => 'Y',
    		'lead[service_leadid]' => $leadid,
    		'lead_consent[tcpa_consent]' => 'Yes',
    		'lead[ip]' => Yii::app()->request->getParam('ipaddress'),
    		'subid' => $promo_code,
			'lead[test]' => 'false',
			'lead[media_type]' => 'callcenter',
    	);
		
    	//if($confirmation_id!=''){ $fields['confirmation'] = $confirmation_id;}
		$post_request = '';
		foreach ($fields as $key => $value) $post_request .= '&'.$key.'='.urlencode($value);
		$post_request = substr($post_request,1);
    	//echo $post_request;
    	$cm = new CommonMethods();
    	$start_time = CommonToolsMethods::stopwatch();
    	$post_full_response = $cm->curl($post_url,$post_request);
		//print_r($post_full_response);exit;
    	$time_end = CommonToolsMethods::stopwatch();
		$response_json = json_decode($post_full_response);
		$post_fail_reason = '';
		if (isset($response_json->status) && $response_json->status == 'success') {
		  $post_status = '1';
		  $post_price = '0';
		  $redirect_url = '';
		}else if (isset($response_json->status) && $response_json->status == 'failure') {
		  $redirect_url =  '';
		  $post_price='';
		  if($response_json->reason->base[0] =='Reached the monthly campaign cap for campus'){
        $post_status = '2';
        $post_fail_reason='cap_reached';
      }elseif($response_json->reason->base[0] =='Program not available for campus'){
        $post_status = '2';
        $post_fail_reason='programofinterestnonavailable';
      }elseif($response_json->reason->base[0] =='Inactive Campus.' || strpos($post_full_response,'Inactive Campus')){
        $post_status = '2';
        $post_fail_reason='inactive_campaign';
      }else{
       $post_status = '0';
      }
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
		$post_responses['post_fail_reason'] = $post_fail_reason;
		//exit();
    	return $post_responses;
    }
}