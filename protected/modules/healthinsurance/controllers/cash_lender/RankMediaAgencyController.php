<?php

class RankMediaAgencyController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function getHost($url, $accept_www=false){
	    $url = str_replace(["%3A","%2F"],[':','/'],$url);
	    $URIs = parse_url(trim($url)); 
	    $host = !empty($URIs['host'])? $URIs['host'] : explode('/', $URIs['path'])[0];
	    return $accept_www == false? str_ireplace('www.', '', $host) : $host;  
	}
    public static $not_allowed = ['xpres-health.com','xpres-quote.com','bestamericanhealth.com','bestamericanmedicare.com','bestamericanexpense.com','onlineinsurancepro.com','yourquoteguru.com','quickmedicarecoverage.com','financedoneright.com','essentialhealthinfo.com','seniorbeginnings.com','greaterTrip.com','findPrimejobs.com','insuranceoffersnow.com','insurancechiefs.com','netwayi.com','parasolleads.com','bestamericanauto.com','unitedquotes.com','health-signup.com'];

    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$height_cm = Yii::app()->request->getParam('height');
		$inches = round($height_cm/2.54);
		$height_feet = intval($inches/12);
		$height_inches = round($inches%12);
		$zip_code = Yii::app()->request->getParam('zip');
		$submission_model = new Submissions();
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$current_coverage_type = Yii::app()->request->getParam('current_coverage_type',0);
		if ($promo_code != 13) {
			$fields = array(
				'lp_campaign_id' => $p1 ? $p1 :'614e0ec84c34c',
				'lp_campaign_key' => $p2 ? $p2 : 'xvMPVgtdm6wGr8cQz4LF',
				'lp_s1' => $promo_code,
				'lp_s2' => '',
				'lp_s3' => '',
				'lp_s4' => '',
				'lp_s5' => '',
				'lp_response' => 'XML',
				'zip_code' => $zip_code,
				'state' => $city_state['state'],
				'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
				'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
				'dob'=>Yii::app()->request->getParam('dob'),
				'ip_address' => Yii::app()->request->getParam('ipaddress'),
				'currently_insured' => $current_coverage_type > 0 ? 'Yes' : 'No',
				'landing_page' => Yii::app()->request->getParam('url','https://elitehealthinsurers.com'),
				'gender'=>Yii::app()->request->getParam('gender')=='M'?'Male':'Female',
				'tcpa_consent' => Yii::app()->request->getParam('tcpa_optin') > 0 ? 'Yes' : 'Yes',
				'height_in_feet'=>$height_feet,
				'height_in_inches'=>$height_inches,
				'weight_in_pounds'=>Yii::app()->request->getParam('weight'),
				'household_size'=>Yii::app()->request->getParam('number_in_household'),
				'household_income' => Yii::app()->request->getParam('income', '3500'),
				'user_agent'=>Yii::app()->request->getParam('user_agent'),
				'tcpa_language' => Yii::app()->request->getParam('tcpa_text'),
				'preexisting_conditions' => 'No',
			);
			$purchase = true;
			$url = Yii::app()->request->getParam('url');
			if(in_array(self::getHost($url),self::$not_allowed)){
				$purchase = false;
			}
			$age = (date('Y')-date('Y',strtotime(Yii::app()->request->getParam('dob'))));
			if($age > 64){
				$ping_response = $age .' more than 64 Not Allowed';
				$purchase = false;
			}
			if($purchase == true){
				$pingData['ping_request'] = http_build_query($fields);
			}else{
				$pingData['ping_request'] = false;
			}
			return $pingData;
		}
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<result>(.*)<\/result>/msui", $ping_response, $result);
        if (trim($result[1]) == 'success' || trim($result[0]) == 'success') {
            preg_match("/<price>(.*)<\/price>/msui", $ping_response, $price);
            preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response, $confirmation_id);
            $ping_price = isset($price[1]) ? $price[1] : 0;
            $confirmation_id = $confirmation_id [1];
            $ping_response_info['ping_price'] = trim($ping_price);
            $ping_response_info['ping_status'] = '1';
            $ping_response_info['confirmation_id'] = $confirmation_id;
        } else {
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
    public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response, $confirmation_id);
		$height_cm = Yii::app()->request->getParam('height');
		$inches = round($height_cm/2.54);
		$height_feet = intval($inches/12);
		$height_inches = $inches%12;
		$zip_code = Yii::app()->request->getParam('zip');
		$submission_model = new Submissions();
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$result = json_decode($ping_response,TRUE);
		$ping_id = $result['response']['lead_id'];
		$current_coverage_type = Yii::app()->request->getParam('current_coverage_type',0);
		$age = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob'))));
		$email = Yii::app()->request->getParam('email');
		$phone = Yii::app()->request->getParam('phone');
		if($email == 'jojobobey126@gmail.com' OR $phone == '6185728131'){
		}else{
			$fields = array(
			'lp_campaign_id' => $p1 ? $p1 :'614e0ec84c34c',
			'lp_campaign_key' => $p2 ? $p2 : 'xvMPVgtdm6wGr8cQz4LF',
			'lp_s1' => $promo_code,
			'lp_s2' => '',
			'lp_s3' => '',
			'lp_s4' => '',
			'lp_s5' => '',
			'lp_response' => 'XML',
			'lp_ping_id' =>$confirmation_id[1],
			'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
			'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
			'first_name' => Yii::app()->request->getParam('first_name'),
			'last_name' => Yii::app()->request->getParam('last_name'),
			'phone_home' => Yii::app()->request->getParam('phone'),
			'address' => Yii::app()->request->getParam('address'),
			'city' => $city_state['city'],
			'state' => $city_state['state'],
			'zip_code' => $zip_code,
			'email_address' => $email,
			'dob'=>Yii::app()->request->getParam('dob'),
			'ip_address' => Yii::app()->request->getParam('ipaddress'),
			'currently_insured' => $current_coverage_type > 0 ? 'Yes' : 'No',
			'landing_page' => Yii::app()->request->getParam('url','https://elitehealthinsurers.com'),
			'gender'=>Yii::app()->request->getParam('gender')=='M'?'Male':'Female',
			'tcpa_consent' => Yii::app()->request->getParam('tcpa_optin') > 0 ? 'Yes' : 'Yes',
			'height_in_feet'=>$height_feet,
			'height_in_inches'=>$height_inches,
			'weight_in_pounds'=>Yii::app()->request->getParam('weight'),
			'household_size'=>Yii::app()->request->getParam('number_in_household'),
			'household_income' => Yii::app()->request->getParam('income', '3500'),
			'user_agent'=>Yii::app()->request->getParam('user_agent'),
			'tcpa_language' => Yii::app()->request->getParam('tcpa_text'),
			'preexisting_conditions' => 'No',
		);
		$post_request = http_build_query($fields);
		//echo '<pre>';print_r($post_request);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_response = $cm->curl($post_url, $post_request);
		$time_end = CommonToolsMethods::stopwatch();
		//echo '<pre>';print_r($ping_response);die();
		preg_match("/<result>(.*)<\/result>/", $post_response, $success);
		//echo '<pre>';print_r();die();
		if (trim($success[1]) == 'success') {
			$post_status = '1';
			preg_match("/<redirect_url>(.*)<\/redirect_url>/", $post_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<price>(.*)<\/price>/msui", $post_response, $price);
			preg_match("/<price>(.*)<\/price>/msui", $ping_response, $ping_price);
			$post_price = isset($price[1]) ? $price[1] : $ping_price[1];
		} else {
			$post_status = '0';
			$post_price = 0;
			$redirect_url = '';
		}
		$post_time = ($time_end - $start_time);
		$post_responses['post_request'] = $post_request;
		$post_responses['post_response'] = $post_response;
		$post_responses['post_status'] = $post_status;
		$post_responses['post_price'] = $post_price;
		$post_responses['redirect_url'] = $redirect_url;
		$post_responses['post_time'] = $post_time;
		//echo '<pre>';print_r($post_responses);die();
		return $post_responses;
		}
		
    }
}