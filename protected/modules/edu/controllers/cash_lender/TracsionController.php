<?php
class TracsionController extends Controller {
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
    	$pingData = [];
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
		$valid_program = $program_model->checkProgramOfInteresetTracsion(Yii::app()->request->getParam('program_of_interest'));
		if(!$valid_program['id']){
			$cm->setRespondError('','programofinterestnonavailable','inorganic');
		}
		$campus = $_REQUEST['campus'];
    $o_campus_details = new CampusDetails();
    $t_caps = $o_campus_details->getCampusCapDetails("where campus_code='".$campus."'");
    $campus_id = $t_caps[0]['campus_id'];

    $master_degree = Yii::app()->request->getParam('master_degree');
    $ged = Yii::app()->request->getParam('ged');
    if($master_degree){
        $education_level_id = '175';
    }else if($ged){
        $education_level_id = '171';
    }else{
        $EDU_array = array('172','173','174');
        $edu_key = array_rand($EDU_array);
        $education_level_id = $EDU_array[$edu_key];
    }
		$start_date_list = array('Immediately','1-3 Months','1-3 Months','1-3 Months','4-6 Months');
		$sd_key = array_rand($start_date_list);
		$vendorlead = $_SESSION['affiliate_trans_id'];
		$promo_code = Yii::app()->request->getParam('promo_code');
        switch($promo_code){
          case '96';
            $RepID = 'Astoria';
            $dataSource = 'astoriaCompany';
            $TCPASourceURL = 'http://www.astoriaCompany.com';
            break;
          case '115';
            $RepID = 'Adam';
            $dataSource = 'tracsion';
            $TCPASourceURL = 'http://www.tracsion.com';
            break;
          case '116';
            $RepID = 'University';
            $dataSource = 'prospexdigital';
            $TCPASourceURL = 'http://www.prospexdigital.com';
            break;
          case '121';
            $RepID = 'J2Media';
            $dataSource = 'j2mediaventures';
            $TCPASourceURL = 'http://j2mediaventures.com';
            break;
          default:
            $RepID = 'HLApp';
            $dataSource = 'higherlearningapp';
            $TCPASourceURL = 'http://j2mediaventures.com';
        }
        $dob = Yii::app()->request->getParam('dob');
        $age = (date('Y') - date('Y',strtotime($dob)));
        
        $education_level = Yii::app()->request->getParam('education_level');
        switch($education_level){
          case '1';
            $edu_level_call = '686';$edu_level_WT = '627';
            break;
          case '2';
            $edu_level_call = '686';$edu_level_WT = '627';
            break;
          case '3';
            $edu_level_call = '687';$edu_level_WT = '628';
            break;
          case '4';
            $edu_level_call = '687';$edu_level_WT = '628';
            break;
          case '5';
            $edu_level_call = '687';$edu_level_WT = '628';
            break;
          case '6';
            $edu_level_call = "688";$edu_level_WT = '629';
            break;
          case '7';
            $edu_level_call = '689';$edu_level_WT = '630';
            break;
          case '8';
            $edu_level_call = '690';$edu_level_WT = '631';
            break;
          case '9';
            $edu_level_call = '691';$edu_level_WT = '632';
            break;
          default:
            $edu_level_call = '685';$edu_level_WT = '626';
        }
        if($campus == 'SOUTH_UNI_ONL'){
          $program_id = $valid_program['program_id_wt'];
          $campaign_code = '_DlRA9Eg_yhUDaqh_EG_eA';  //$43 // South WT(Online) campaign
          $edu_level = $edu_level_WT;
        }else{
          $campaign_code = 'i0cO8LXUpV9qJ9jK92yIDg';  //$18 // South Call campaign
          $program_id = $valid_program['program_id_call'];
          $edu_level = $edu_level_call;
        }
        if($campus == 'SOUTH_UNI_ONL'){
      	   $fields = [
  			      'campaign_code' => $campaign_code,
              'lead[firstname]' => Yii::app()->request->getParam('first_name'),
              'lead[lastname]' => Yii::app()->request->getParam('last_name'),
              'lead_address[address]' => Yii::app()->request->getParam('address'),
              'lead_address[city]' => Yii::app()->request->getParam('city'),
              'lead_address[state]' => strtoupper(Yii::app()->request->getParam('state')),
              'lead_address[zip]' => Yii::app()->request->getParam('zip'),
              'lead[email]' => Yii::app()->request->getParam('email'),
              'lead[phone1]' => Yii::app()->request->getParam('phone'),
              'lead[gender]' =>['F','M'][rand(0,1)],
              'lead[age]' => $age,
              'lead_education[grad_year]' => Yii::app()->request->getParam('grad_year'),
              'lead_background[military_type]' => 'NONE',
              'lead_background[us_citizen]' => 'US',
              'lead_education[education_level_id]' => $edu_level,
              'lead_education[program_id]' => $program_id,
              'lead_education[campus_id]' => $campus_id,
              'lead_education[start_date]' => $start_date_list[$sd_key],
              'lead[service_leadid]' => Yii::app()->request->getParam('universal_leadid'),
              'lead[service_trusted_form]' => Yii::app()->request->getParam('trustedformcerturl'),
              'lead[ip]' => Yii::app()->request->getParam('ipaddress'),
              'lead_custom_value[Near]' => 'Y',
              'lead_custom_value[Visit]' => 'Y',
              'lead_consent[tcpa_consent]' => '1',
              'subid' => $promo_code,
              'agent_id' => $RepID,
              'lead[signup_url]' => $TCPASourceURL,
              'lead_call_center[call_center_dba]' => $dataSource,  
              'lead[test]' => 'true',
              'lead[media_type]' => 'callcenter',
      	];
        $post_request = '';
        foreach ($fields as $key => $value) $post_request .= '&'.$key.'='.urlencode($value);
        $post_request = substr($post_request,1);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $post_full_response = $cm->curl($post_url,$post_request);
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
      	return $post_responses;
      }
    }
}