<?php
class UniversitiesController extends Controller {
  public static $Occupation = array(
        1 => 'Accounts Pay/Rec.',
        2 => 'Actor',
        3 => 'Administration/Management',
        4 => 'Appraiser',
        5 => 'Architect',
  );
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
    $education_level = Yii::app()->request->getParam('master_degree');
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
      $pingData = array();
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
          //'IsTest' => 'Y',
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
    $valid_program = $program_model->checkProgramOfInteresetUniversities(Yii::app()->request->getParam('program_of_interest'));
    //echo '<pre>123';print_r($valid_program);exit;
    if($valid_program['category_id']){
      $prog_of_int = $valid_program['category_id'];
    }else{
      $cm->setRespondError('','programofinterestnonavailable','');
    }
    $campus = $_REQUEST['campus'];
        $t_reasons = array();
        if(!isset($_REQUEST['repost'])) {
            $promo_code = Yii::app()->request->getParam('promo_code');
            $sub_id = Yii::app()->request->getParam('sub_id');
            if(!empty($promo_code) && !empty($sub_id)){
                $o_paused_affiliate = new PausedAffiliate;
                $t_paused_data = $o_paused_affiliate->checkPausedAffiliateSubIdPair(' pa.promo_code = "'.$promo_code.'" and pad.sub_id = "'.$sub_id.'"');
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
        //**********REJECT LEADS WITH DUPLICATE IP -- ENDS**************//
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
    $education_level = Yii::app()->request->getParam('education_level');
    switch($education_level){
      case '1';
        $edu_level = 'GED';
        break;
      case '2';
        $edu_level = 'High School';
        break;
      case '3';
        $edu_level = '0-23 College Credits';
        break;
      case '4';
        $edu_level = '24-47 College Credits';
        break;
      case '5';
        $edu_level = '24-47 College Credits';
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
        $edu_level = "High School";
    }
    $degree_start_time=array('Immediately','1-3 Months','4-6 Months','7-9 Months','10 - 12 Months');
    $dst_key = array_rand($degree_start_time);
    $best_time_contact = array('Anytime','Morning','Afternoon','Evening');
    $btc_key = array_rand($best_time_contact);
    
    $vendorlead = $_SESSION['affiliate_trans_id'];
    $leadid = Yii::app()->request->getParam('universal_leadid');
    $dob = Yii::app()->request->getParam('dob');
    $Year_dob = date('Y',strtotime($dob));
    $promo_code = Yii::app()->request->getParam('promo_code');
    $timestamp = date('m-d-Y H:i:s').' EST';
    $dataSource = 'http://higherlearningapp.com';
    
    $RNLicense = Yii::app()->request->getParam('are_you_a_registered_nurse');
    $RNLicense = $RNLicense=='1' ? 'Y' : 'N';
    $TeachingLicense = Yii::app()->request->getParam('do_you_have_a_teaching_certificate');
    $TeachingLicense = $TeachingLicense=='1' ? 'Y' : 'N';
    $USCitizen = Yii::app()->request->getParam('military');
    $USCitizen = $USCitizen=='1' ? 'Y' : 'N';
    $ipaddress = Yii::app()->request->getParam('ipaddress');
    if(empty($ipaddress)) {
      $ipaddress = $_SERVER['REMOTE_ADDR'];
    }
    $promo_code = Yii::app()->request->getParam('promo_code');
    switch($promo_code){
      case '96';
        $RepID = 'Astoria';
        $dataSource = 'astoriaCompany.com';
        $TCPASourceURL = 'http://www.astoriaCompany.com';
        break;
      case '115';
        $RepID = 'Adam';
        $dataSource = 'tracsion.com';
        $TCPASourceURL = 'http://www.tracsion.com';
        break;
      case '116';
        $RepID = 'University';
        $dataSource = 'prospexdigital.com';
        $TCPASourceURL = 'http://www.prospexdigital.com';
        break;
      case '121';
        $RepID = 'J2Media';
        $dataSource = 'j2mediaventures.com';
        $TCPASourceURL = 'http://j2mediaventures.com';
        break;
      default:
        $RepID = 'HLApp';
        $dataSource = 'higherlearningapp.com';
        $TCPASourceURL = 'http://j2mediaventures.com';
    }
   
    $fields = array(
        //'IsTest'=>'true',
        'AffiliateId'=>$parameter1,
        'AffiliateCampaignId'=>$parameter2,
        'RequestSearch'=>'True',
        'LeadiDToken' => $leadid,
        'CampaignId' => $promo_code,
        'SubCampaignId' => Yii::app()->request->getParam('sub_id'),
        'UniqueId' => $vendorlead,
        'FirstName'=> Yii::app()->request->getParam('first_name'),
        'LastName'=> Yii::app()->request->getParam('last_name'),
        'Address1'=> Yii::app()->request->getParam('address'),
        'City'=> Yii::app()->request->getParam('city'),
        'State'=> Yii::app()->request->getParam('state'),
        'Zip'=> Yii::app()->request->getParam('zip'),
        'Phone1'=> Yii::app()->request->getParam('phone'),
        'Phone2' => Yii::app()->request->getParam('mobile'),
        'Email'=> Yii::app()->request->getParam('email'),
        'BirthYear'=> $Year_dob,
        'GradYear'=> Yii::app()->request->getParam('grad_year'),
        'IPAddress'=> $ipaddress,
        'Gender'=> Yii::app()->request->getParam('gender'),
        'USCitizen'=> $USCitizen,
        'RNLicense'=> $RNLicense, 
        'TeachingLicense'=> $TeachingLicense,
        'USMilitaryStatus'=> 'No U.S. Military Affiliation',
        'USMilitaryAffiliation'=> 'No U.S. Military Affiliation',
        'Orientation'=>  $campus_id_rr,
        'StartMonth'=> rand(1,12),
        'BestTimeToContact'=> $best_time_contact[$btc_key],
        'SiteSourceURL'=>$dataSource,
        'TCPASourceURL'=>$TCPASourceURL,
      );
      $fields_ping = array(
        'LevelOfEducation'=> $edu_level,
        'CategoryId'=> $prog_of_int,
        'StartRange' => $degree_start_time[$dst_key],
        'Country' => 'US',
      );

    $ping_request_fields = array_merge($fields,$fields_ping);
    $ping_request = http_build_query($ping_request_fields);
    $cm = new CommonMethods();
    $start_time = CommonToolsMethods::stopwatch();
    $header = array();
    // PING WITH GET METHOD.
    $ping_full_response = $cm->curl($post_url,$ping_request,$header,'get');
    $ping_json_response = json_decode($ping_full_response);
   
    $time_end = CommonToolsMethods::stopwatch();
    //$ping_status = $ping_json_response->Validation->IsValid==true ?  1 : 0 ;
	$ping_status = ($ping_json_response->Validation->IsValid==true) && ($ping_json_response->SearchResults->Count>0) ?  1 : 0 ;

    $ping_time = ($time_end - $start_time);
    $ping_id = $cm->setLenderTransactionLogEdu('Universities',24.00,null,null,null,null,$ping_request,$ping_status,$ping_full_response,$ping_time,$redirect_url=null,$ping_id=null,$_REQUEST['campus']);
    $flag_program = false;
    /* ============== PING ENDS HERE ================= */
    if($ping_status == 1){
      $Matches = [];
      foreach ($ping_json_response->SearchResults->Results as $index => $Results) {
        $the_school_id = $Results->SchoolId;
        foreach ($Results->Programs as $match => $Programs) {
          $Matches[$index][$match]['SchoolId'] = $the_school_id;
          $Matches[$index][$match]['ProgramId'] = $Programs->ProgramId;
          $Matches[$index][$match]['OrderId'] = $Programs->OrderId;
          $Matches[$index][$match]['CampusId'] = $Programs->Campuses[0]->CampusId;
        }
        foreach ($Results->CustomQuestions as $custq => $custQuestion) {
          $CustomQuestions[$index][$custq]['SchoolId'] = $the_school_id;
          $CustomQuestions[$index][$custq]['Name'] = $custQuestion->FieldName;
          if(isset($custQuestion->Details->Items)){
            $CustomQuestions[$index][$custq]['Value'] = $custQuestion->Details->Items[0]->Value;
          }else{
            $CustomQuestions[$index][$custq]['Value'] = $custQuestion->Details->Value;
          }
        }
      }
      $final_match = '';$final_custom_quest = '';
      foreach ($Matches as $results) {
        $match = http_build_query($results);
        $final = urldecode(http_build_query($results, 'Matches['));
        $final = preg_replace('/\b([0-9]{1,})\b/', '$1]', $final);
        $final = str_replace(array(']&'),array('&'), $final);
        $final_match .= $final;
      }
      $final_match = rtrim($final_match,']');
      foreach ($CustomQuestions as $results) {
        $match = http_build_query($results);
        $final = urldecode(http_build_query($results, 'CustomQuestions['));
        $final = preg_replace('/\b([0-9]{1,})\b/', '$1]', $final);
        $final = str_replace(array(']&'),array('&'), $final);
        $final_custom_quest .= $final;
      }
      $final_custom_quest = rtrim($final_custom_quest,']');
      $additional_questions = $final_match.'&'.$final_custom_quest;
      /* ============== PING ENDS HERE ================= */
      $start_time = CommonToolsMethods::stopwatch();
      $fields_post = array (
        'Token'=>$ping_json_response->Token,
      );
      $fields = array_merge($fields,$fields_post);
     
      $post_request_fields = http_build_query($fields);
      $post_request_fields = $post_request_fields.'&'.$additional_questions;

      $post_full_response = $cm->curl($post_url,$post_request_fields);
      $post_json_response = json_decode($post_full_response);
      $pstatus = $post_json_response->Validation->IsValid == true ?  1 : 0 ;
      $time_end = CommonToolsMethods::stopwatch();
      if (trim($pstatus) == '1' || $pstatus ==1) {
        $post_status = '1';
        preg_match("/<redirectURL>(.*)<\/redirectURL>/", $post_json_response, $redirect);
        $redirect_url = isset($redirect[1]) ? $redirect[1] : '';
        preg_match("/<Price>(.*)<\/Price>/msui",$post_json_response,$price);
        $post_price=isset($price[1]) ? $price[1] : '';
      } else {
        $post_status = '0';
        $post_price = '0';
        $redirect_url = '';
      }
      $post_time = ($time_end - $start_time);
    }
    $post_time = ($time_end - $start_time);
  $post_responses['ping_id'] = $ping_id;
    $post_responses['post_request'] = $post_request_fields;
    $post_responses['post_response'] = $post_full_response;
    $post_responses['post_status'] = $post_status;
    $post_responses['post_price'] = $post_price;
    $post_responses['redirect_url'] = $redirect_url;
    $post_responses['post_time'] = $post_time;
  //exit();
  return $post_responses;
    }
}