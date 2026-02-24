<?php
class QuinStreetController extends Controller {
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
			$cm->setRespondError('','programofinterestnonavailable','inorganic');
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
		$education_level = Yii::app()->request->getParam('education_level');
		switch($education_level){
			case '1';
				$edu_level = 'Completed GED';
				break;
			case '2';
				$edu_level = 'Working on GED';
				break;
			case '3';
				$edu_level = 'High School Graduate';
				break;
			case '4';
				$edu_level = 'Some College';
				break;
			case '5';
				$edu_level = 'Associate Degree';
				break;
			case '6';
				$edu_level = "Bachelor's Degree";
				break;
			case '7';
				$edu_level = 'Graduate Degree';
				break;
			default:
				$edu_level = 'High School Graduate';
		}
    	$pingData = [];
		//https://backend.leadscorz.com/api/v1/campaigns/aafc436d-aa5b-4670-ae82-2966a9d87e4b/inbox/berkeley/ping-web-leads/
		//https://backend.leadscorz.com/api/v1/campaigns/aafc436d-aa5b-4670-ae82-2966a9d87e4b/test-inbox/berkeley/ping-web-leads/
        $fields = array(
            'firstName' => Yii::app()->request->getParam('first_name'),
            'lastName' => Yii::app()->request->getParam('last_name'),
            'Address1' => Yii::app()->request->getParam('address'),
            'City' => Yii::app()->request->getParam('city'),
            'State' => Yii::app()->request->getParam('state'),
            'Zip' => Yii::app()->request->getParam('zip'),
            'Email' => Yii::app()->request->getParam('email'),
            'military' => Yii::app()->request->getParam('military'),
    		'leadid' => $leadid,
    		'DayPhone' => Yii::app()->request->getParam('phone'),
    		'phonecell' => Yii::app()->request->getParam('mobile'),
    		'gradyear' => Yii::app()->request->getParam('grad_year'),
    		'EducationLevel' => $edu_level,
    		'LocationID' => $campus,
    		'CurriculumID' => $prog_of_int,
    		'ConsentVerbiage' => 'Y',
    		'src1' => $src1,
    		'LeadBuyerID' => Yii::app()->request->getParam('promo_code'),
			'VendorID' => $p1,
			'AffiliateID' => $p2,
			'IsTest' => 'Y',
        );
        $pingData['ping_request'] = http_build_query($fields);
        /*$apitoken = '664eaa8c5b905d3d56bb3d7571c55a10de2ba3cc';
		$pingData['header'] = ["Authorization: Token $apitoken","application/x-www-form-urlencoded"];*/
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
		$pre_ping_url = 'https://backend.leadscorz.com/api/v1/campaigns/aafc436d-aa5b-4670-ae82-2966a9d87e4b/inbox/berkeley/ping-web-leads/';
		$AuthorizationCode = 'Token 664eaa8c5b905d3d56bb3d7571c55a10de2ba3cc';
		$header = [
            "Authorization: $AuthorizationCode",
            "content-type: application/x-www-form-urlencoded",
        ];
		$fields = [
			'phone' => Yii::app()->request->getParam('phone'),
			'firstname' => Yii::app()->request->getParam('first_name'),
			'lastname' => Yii::app()->request->getParam('last_name'),
			'zip' => Yii::app()->request->getParam('zip'),
		];
		$pre_ping_request = http_build_query($fields);
    	$pre_ping_response = $cm->curl($pre_ping_url,$pre_ping_request, $header);
		//mail('octobas@gmail.com','Pre Ping Respo',$pre_ping_request.'--'.$pre_ping_response);
		$result = json_decode($pre_ping_response);
		if($result->status == 'ok'){
			$program_model = new ProgramOfInterests();
			$valid_program = $program_model->checkProgramOfInteresetQuinStreet(Yii::app()->request->getParam('program_of_interest'));
			if($valid_program['QMP_program_code']){
				$prog_of_int = $valid_program['QMP_program_code']; //Yii::app()->request->getParam('program_of_interest');
			}else{
				$cm->setRespondError('','programofinterestnonavailable','');
			}
			$campus = $_REQUEST['campus']; //Yii::app()->request->getParam('campus');
			$t_reasons = [];
			$o_campus_details = new CampusDetails();
			$t_caps = $o_campus_details->getCampusCapDetails("where campus_code='".$campus."'");
			$campus_id_rr = $t_caps[0]['campus_id'];
			$education_level = Yii::app()->request->getParam('education_level');
			$campusCode = Yii::app()->request->getParam('campus');
			if(($education_level == '1' || $education_level == '2') && $campusCode =='WST'){
				$t_reasons[] = 'GED and High School Diploma Restricted for WST';
				$cm->setResponse(implode(',',$t_reasons));
				exit;
			}
			switch($education_level){
				case '1';
					$edu_level = 'GED';
					break;
				case '2';
					$edu_level = 'High School Diploma';
					break;
				case '3';
					$edu_level = 'Some college 0-23 credits';
					break;
				case '4';
					$edu_level = 'Some college 24-34 credits';
					break;
				case '5';
					$edu_level = 'Some college 60-120 credits';
					break;
				case '6';
					$edu_level = "Associate's Degree";
					break;
				case '7';
					$edu_level = "Bachelor's Degree";
					break;
				case '8';
					$edu_level = "Master's Degree";
					break;
				case '9';
					$edu_level = "Doctoral Degree";
					break;
				default:
					$edu_level = "Associate's Degree";
			}
			$degree_start_time = array('Less than 1 month','1-3 months','1-3 months','Less than 1 month','1-3 months','Less than 1 month','1-3 months','Less than 1 month','1-3 months');
			$dst_key = array_rand($degree_start_time);
			$vendorlead = $_SESSION['affiliate_trans_id'];
			$leadid = Yii::app()->request->getParam('universal_leadid');
			$dob = Yii::app()->request->getParam('dob','');
			if($dob == ""){
				$age = rand(18,39);
			}else{
				$age = (date('Y') - date('Y',strtotime($dob)));
				if($age < 18){
					$age = 18;
				}else if($age > 39){
					$age = 39;
				}
			}
			$aggregatorCode = 'HLSOURCE';
			$mediaChannel = 'Call Center';
			$dataSource = 'Higher Learning App';
			$ccPortal = 'https://elitebizpanel.com/index.php/edu/affiliates/login';
			$ccCenter = 'Higher Learning App';
			$aggregatorLeadKey = '4279';
			$grad_year = Yii::app()->request->getParam('grad_year');
			$grad_year = $grad_year < 1980 ? 1980 : $grad_year;
			$state_code = Yii::app()->request->getParam('state');
			$cCode =  ($campusCode == 'ONL') ? 'ONLINE' : 'CAMPUS'; 
			//$senior_adult = $grad_year >= date('Y') ? ' HS SENIORS' : ' ADULT';
			// BERKELEY HAS NOW STOPPE HIGHSCHOOL (HS SENIORS), NOW ALL WILL GO TO ADULTS ONLY. 11 JUNE 2024
			$senior_adult = $grad_year >= date('Y') ? ' ADULT' : ' ADULT';
			if($campusCode == 'ONL' && ($state_code=='NY' OR $state_code=='NJ')){
				$senior_adult = '';
			}
			$campaignCode = 'HLSOURCE_'.$cCode.$senior_adult;
			$deviceType = 'Desktop';
			switch($campusCode){
				case 'NYB';
					$campaignCode = $campaignCode." - BROOKLYN";
					break;
				case 'NYC';
					$campaignCode = $campaignCode." - NEW YORK CITY";
					break;
				case 'NWK';
					$campaignCode = $campaignCode." - NEWARK";
					break;
				case 'BGN';
					$campaignCode = $campaignCode." - PARAMUS";
					break;
				case 'WST';
					$campaignCode = $campaignCode." - WHITE PLAINS";
					break;
				case 'MDL';
					$campaignCode = $campaignCode." - WOODBRIDGE";
					break;
				case 'GMT';
					$campaignCode = $campaignCode." - WOODLAND PARK";
					break;
				case 'ONL';
					$campaignCode = ($state_code=='NY' OR $state_code=='NJ') ? $campaignCode." - ".$state_code : $campaignCode." - ONLINE";
					break;
			}
			$promo_code = Yii::app()->request->getParam('promo_code');
			switch($promo_code){
				case '96';
					$ccCenter = 'astoriacompany.com';
					break;
				case '115';
					$ccCenter = '';
					break;
				case '116';
					$ccCenter = 'universities.com';
					break;
				case '121';
					$ccCenter = 'j2mediaventures.com';
					break;
				default:
					$ccCenter = 'Higher Learning App';
			}
			$clientCode = $campusCode == 'ONL' ? 'BRKLYONLINE' : 'BRKLYGROUND';
			$timestamp = date('m-d-Y H:i:s').' EST';
			$dataSource = 'http://higherlearningapp.com';
			$fields = [
				'firstName' => Yii::app()->request->getParam('first_name'),
				'lastName' => Yii::app()->request->getParam('last_name'),
				'email' => Yii::app()->request->getParam('email'),
				'addressLine1' => Yii::app()->request->getParam('address'),
				'zip' => Yii::app()->request->getParam('zip'),
				'city' => Yii::app()->request->getParam('city'),
				'state' => Yii::app()->request->getParam('state'),
				'country' => 'US',
				'homePhone' => Yii::app()->request->getParam('phone'),
				'cellPhone' => Yii::app()->request->getParam('mobile'),
				'workPhone' => Yii::app()->request->getParam('mobile'),
				'age' => $age,
				'highestEducationLevel' => $edu_level,
				'highSchoolGradYear' => $grad_year,
				'degreeStartTimeFrame' => $degree_start_time[$dst_key],
				'citizenship' => 'US',
				'militaryStatus' => 'None',
				'clientCode' =>  $clientCode,
				'campusCode' =>  $campusCode,
				'campaignCode' => $campaignCode,
				'programOfInterest' => $prog_of_int,
				'aggregatorLeadKey' => $aggregatorLeadKey,
				'aggregatorCode' => $aggregatorCode,
				'mediaChannel' => $mediaChannel,
				'dataSource' => Yii::app()->request->getParam('url',$dataSource),
				'ccPortal' => $ccPortal,
				'ccCenter' => $ccCenter,
				'leadIDToken' => $leadid,
				'position' => '1',
				'deviceType' => $deviceType,
				'timestamp' => $timestamp,
				//'test' => 'Y',
				//'increaseCapForValidTestLead' => 'Y',
				'tcpaWrittenConsent' => '1',
				//'post_url' => $post_url,
				'exclusive' => 'Y',
			];
			$post_request = json_encode($fields);
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			$AuthorizationCode = 'Basic SExTT1VSQ0U6SExTT1VSQ0U4MjkyNDY=';
			$header = [
				"authorization: $AuthorizationCode",
				"content-type: application/json",
			];
			$post_url = 'https://leadipapi.cloudcontrol.media/v2/postData';
			$post_full_response = $cm->curl($post_url,$post_request, $header);
			$time_end = CommonToolsMethods::stopwatch();
			$pstatus = json_decode($post_full_response);
			$post_fail_reason = '';
			if (trim($pstatus->Status) == 'Success' || trim(strtolower($pstatus->Status)) =='success') {
				$post_status = '1';
				$post_price = '0';
				$redirect_url = '';
			}else if (trim($pstatus->Status) == 'Failure' || trim(strtolower($pstatus->Status)) =='failure'){
				$redirect_url =  '';
				$post_price='';
				if ($pstatus->Details->errors[1]->message == 'The lead has been filtered'){
					$post_status = '2';
					$post_fail_reason='lead_filtered';
				}else if ($pstatus->ResponseCode == 'CLIENT_DEDUP_CHECK_FAILED'){
					$post_status = '2';
					$post_fail_reason='duplicatebybuyer';
				}else if ($pstatus->ResponseCode == 'CAMPAIGN_MONTHLY_INQUIRY_CAP_MET'){
					$post_status = '2';
					$post_fail_reason='cap_reached';
				}else if ($pstatus->ResponseCode == 'CAMPAIGN_EDU_PROGRAM_RESTRICTION_FAILED'){
					$post_status = '2';
					$post_fail_reason='program_restriction_failed';
				}
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
			$post_responses['post_fail_reason'] = $post_fail_reason;
		}else{
			$post_responses['post_request'] = $pre_ping_request;
			$post_responses['post_response'] = $pre_ping_response;
			$post_responses['post_status'] = '0';
			$post_responses['post_price'] = '0.00';
			$post_responses['redirect_url'] = '';
			$post_responses['post_time'] = '0';
			$post_responses['post_fail_reason'] = 'grade_quality_failed';
		}
		return $post_responses;
    	
    }
}