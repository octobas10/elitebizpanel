<?php
class DMLserviceSTVTController extends Controller {
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
			$response .= '<Errors><Error>Program of Interest is not valid (select from "BAM","FMMA","CJA","LSA","MCA","MCB","FMMB","GBB","MGB","BAB","CJB","LSB","BAC","CJC","FC","LSC","MGC","MCC","BACA","FSA","HSA","HC","TMA","IBA","IBAS","ACBA","FSB","HMB","IBB","ITMB","HSCA","MDA","HSCC","HDC","PCT","PN","SPT","SUR","IDA","IDB","IDM","GD","CAN" )</Error></Errors>';
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
		$valid_program = $program_model->checkProgramOfInteresetDML(Yii::app()->request->getParam('program_of_interest'));
		if($valid_program['id']){
			$prog_of_int = $valid_program['id']; //Yii::app()->request->getParam('program_of_interest');
		}else{
			$cm->setRespondError('','programofinterestnonavailable','');
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
        $leadid = Yii::app()->request->getParam('universal_leadid');
		$vendorlead = $_SESSION['affiliate_trans_id'];
		
		$state_code = Yii::app()->request->getParam('state');
		$state_id_array = array(
			'1'=>'AL',
			'2'=>'AK',
			'57'=>'AS',
			'3'=>'AZ',
			'4'=>'AR',
			'5'=>'CA',
			'6'=>'CO',
			'7'=>'CT',
			'8'=>'DE',
			'58'=>'FM',
			'9'=>'FL',
			'10'=>'GA',
			'61'=>'GU',
			'11'=>'HI',
			'12'=>'ID',
			'13'=>'IL',
			'14'=>'IN',
			'15'=>'IA',
			'16'=>'KS',
			'17'=>'KY',
			'18'=>'LA',
			'19'=>'ME',
			'20'=>'MD',
			'21'=>'MA',
			'22'=>'MI',
			'23'=>'MN',
			'24'=>'MS',
			'25'=>'MO',
			'26'=>'MT',
			'27'=>'NE',
			'28'=>'NV',
			'29'=>'NH',
			'30'=>'NJ',
			'31'=>'NM',
			'32'=>'NY',
			'33'=>'NC',
			'34'=>'ND',
			'35'=>'OH',
			'36'=>'OK',
			'37'=>'OR',
			'38'=>'PA',
			'39'=>'RI',
			'40'=>'SC',
			'41'=>'SD',
			'42'=>'TN',
			'43'=>'TX',
			'44'=>'UT',
			'45'=>'VT',
			'46'=>'VA',
			'47'=>'WA',
			'49'=>'WV',
			'50'=>'WI',
			'51'=>'WY',
			'52'=>'PR',
			'53'=>'DC',
			'54'=>'AL',
			'55'=>'VI',
			'56'=>'MH',
		);
		$state_id = array_search($state_code, $state_id_array);
		$promo_code = Yii::app()->request->getParam('promo_code');
		$lead_source_id = ($promo_code=='109' || $promo_code=='111' || $promo_code=='112' || $promo_code=='113' ) ? '3353' : '3353';
    	$fields = array(
			'first_name' => Yii::app()->request->getParam('first_name'),
            'last_name' => Yii::app()->request->getParam('last_name'),
            'address' => Yii::app()->request->getParam('address'),
            'city' => Yii::app()->request->getParam('city'),
            'state_id' => $state_id,
            'zipcode' => Yii::app()->request->getParam('zip'),
            'email' => Yii::app()->request->getParam('email'),
    		'day_phone' => Yii::app()->request->getParam('phone'),
    		'grad_year' => Yii::app()->request->getParam('grad_year'),
    		'location_id' => $campus_id_rr,
    		'program_id' => $prog_of_int,
    		'ip' => $_REQUEST['ipaddress'],
    		'military' => 'n',
    		'tcpa_agreement' => '1',
    		'universal_lead_id' => $leadid,
    		'lead_source_id' => $lead_source_id,
			'level_of_education_id' => '1402',
    	);
    	//if($confirmation_id!=''){ $fields['confirmation'] = $confirmation_id;}
		$post_request = '';
		foreach ($fields as $key => $value) $post_request .= '&'.$key.'='.urlencode($value);
		$post_request = substr($post_request,1);
		//print_r($fields);exit;
    	$cm = new CommonMethods();
    	$start_time = CommonToolsMethods::stopwatch();
    	$post_full_response = $cm->curl($post_url,$post_request);
		//print_r($post_full_response);exit;
    	$time_end = CommonToolsMethods::stopwatch();
		preg_match("/<status>(.*)<\/status>/", $post_full_response, $pstatus);
		if (trim($pstatus[1]) == 'Accepted' || trim(strtolower($pstatus[1])) =='accepted') {
			$post_status = '1';
			preg_match("/<redirectURL>(.*)<\/redirectURL>/", $post_full_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<Price>(.*)<\/Price>/msui",$post_full_response,$price);
			$post_price=isset($price[1]) ? $price[1] : '';
		}else if (strpos($post_full_response, 'Duplicate') !== false){
			$post_status = '2';
			$post_price = '0';
			$redirect_url = '';
		}else {
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