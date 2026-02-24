<?php
class DetroitTradingController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$User = !empty($p1) ? $p1 : '0000-4029';
		$Password = !empty($p2) ? $p2 : '4029XQA';
		$SOURCE_ID = '';
		$SELF_GENERATED_LEAD = false;
		$LEAD_GEN_METHOD = urlencode('SITE');
		$DebugMode = urlencode('true');
		$GEN_LEAD_ID = '';
		$ZIP_POSTAL_CODE = Yii::app()->request->getParam('zip');
		$GROSS_MONTHLY_INCOME = Yii::app()->request->getParam('monthly_income');
		$SSN = Yii::app()->request->getParam('ssn');
		$MINIMUM_PRICE = '0.5';
		$PING_TIMEOUT_SECONDS = '50';
		$DebugMode = urlencode('true');
		
		$Message =urlencode('<PINGGX_REQUEST xmlns="www.detroittradingexchange.com/SellerMessages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.detroittradingexchange.com/SellerMessages/PingGx_request.xsd"><Lead_Metadata><DTX_GEN_ID>'.$User.'</DTX_GEN_ID><SOURCE_ID>'.$SOURCE_ID.'</SOURCE_ID><GEN_LEAD_ID>'.$GEN_LEAD_ID.'</GEN_LEAD_ID><LEAD_GEN_METHOD>'.$LEAD_GEN_METHOD.'</LEAD_GEN_METHOD><SELF_GENERATED_LEAD>'.$SELF_GENERATED_LEAD.'</SELF_GENERATED_LEAD></Lead_Metadata><Lead_Data><SSN>'.$SSN.'</SSN><ZIP_POSTAL_CODE>'.$ZIP_POSTAL_CODE.'</ZIP_POSTAL_CODE><GROSS_MONTHLY_INCOME>'.$GROSS_MONTHLY_INCOME.'</GROSS_MONTHLY_INCOME><MINIMUM_PRICE>'.$MINIMUM_PRICE.'</MINIMUM_PRICE><PING_TIMEOUT_SECONDS>'.$PING_TIMEOUT_SECONDS.'</PING_TIMEOUT_SECONDS></Lead_Data></PINGGX_REQUEST>');
		
		$fields = array (
			'User' => urlencode($User),
			'Password' => urlencode($Password),
			'Message' => $Message,
			'DebugMode' => urlencode($DebugMode),
		);
		$pingData['ping_request'] = http_build_query($fields);
        return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		$ping_response = html_entity_decode($ping_response);
		preg_match("/<SUCCESS>(.*)<\/SUCCESS>/msui", $ping_response, $result);
		if (trim ($result[1]) == 'True' || trim(strtolower($result[1])) == 'true' || trim(strtolower($result[1])) == 1){
			preg_match("/<PRICE>(.*)<\/PRICE>/msui", $ping_response, $price );
			preg_match("/<DTX_LEAD_ID>(.*)<\/DTX_LEAD_ID>/msui", $ping_response, $confirmation_id );
			$ping_price = isset($price[1]) ? $price[1] : 0;
			$confirmation_id = $confirmation_id [1];
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
		$ping_response = html_entity_decode($ping_response);
		preg_match("/<DTX_LEAD_ID>(.*)<\/DTX_LEAD_ID>/msui", $ping_response,$confirmation_id);
		$loan_term = array('36','48','60','72','84');
		$loan_term_key = array_rand($loan_term);
		if($status == 1){
			preg_match("/<DTX_LEAD_ID>(.*)<\/DTX_LEAD_ID>/msui", $ping_response, $confirmation_id);
			$PingId = $confirmation_id[1];
		}else{
			$PingId = $ping_response;
		}
		$User = !empty($p1) ? $p1 : '0000-4029';
		$Password = !empty($p2) ? $p2 : '4029XQA';
		// Lead_Metadata
		$SOURCE_ID = Yii::app()->request->getParam('url','www.eliteautocash.com');
		$GEN_LEAD_ID = Yii::app()->request->getParam('promo_code');
		$SOURCE_ID = '';
		$CAMPAIGN_ID = '';
		$LEAD_GEN_METHOD = 'SITE';
		$LEAD_SOURCE_IP = Yii::app()->request->getParam('ipaddress');
		$SELF_GENERATED_LEAD = false;
		//
		$MINIMUM_PRICE = '';
		// Lead_Data
		$SSN = Yii::app()->request->getParam('ssn');
		$FIRST_NAME = Yii::app()->request->getParam('first_name');
		$LAST_NAME = Yii::app()->request->getParam('last_name');
		$DOB = date('Y-m-d',strtotime(Yii::app()->request->getParam('dob')));
		$BANKRUPTCY = Yii::app()->request->getParam('bankruptcy','false');
		$BANKRUPTCY = ($BANKRUPTCY=='NULL' OR $BANKRUPTCY=='null') ? 'false' : 'true';
		$COSIGNER_AVAILABLE = Yii::app()->request->getParam('cosigner','true');
		$CREDIT_SCORE = '';
		$DOWN_PAYMENT_AMOUNT = '';
		$GROSS_MONTHLY_INCOME = Yii::app()->request->getParam('monthly_income');
		// CONTACT_INFO
		$homephone = Yii::app()->request->getParam('phone');
		$HOME_PHONE = substr($homephone,0,3).'-'.substr($homephone,3,3).'-'.substr($homephone,6,4);
		$EMAIL = Yii::app()->request->getParam('email');
		$mobilephone = Yii::app()->request->getParam('mobile');
		$MOBILE_PHONE = substr($mobilephone,0,3).'-'.substr($mobilephone,3,3).'-'.substr($mobilephone,6,4);
		$workphone = Yii::app()->request->getParam('work_phone','');
		$WORK_PHONE =  substr($workphone,0,3).'-'.substr($workphone,3,3).'-'.substr($workphone,6,4);
		$EMPLOYER_PHONE =  substr($workphone,0,3).'-'.substr($workphone,3,3).'-'.substr($workphone,6,4);
		// EMPLOYMENT_INFO
		$EMPLOYER_NAME = Yii::app()->request->getParam('employer');
		$YEARS_AT_EMP = Yii::app()->request->getParam('employment_in_year',rand(1,5));
		$MONTHS_AT_EMP = Yii::app()->request->getParam('employment_in_month',rand(1,11));
		$JOB_TITLE = Yii::app()->request->getParam('job_title');
		$MONTHLY_PAYMENT = Yii::app()->request->getParam('home_pay','1200');
		$CREDIT_CHECK = 'true';
		$FORWARD_APPLICATION = 'true';
		$SPECIAL_OFFERS = 'true';
		$TYPE = (Yii::app()->request->getParam('is_rented')=='rent') ? 'RENT' : 'OWN';
		$ADDRESS = Yii::app()->request->getParam('address');
		$CITY = Yii::app()->request->getParam('city');
		$STATE_PROVINCE = Yii::app()->request->getParam('state');
		$ZIP_POSTAL_CODE = Yii::app()->request->getParam('zip');
		$COUNTRY = 'USA';
		$YEARS_AT_RES = Yii::app()->request->getParam('stay_in_year','4');
		$MONTHS_AT_RES = Yii::app()->request->getParam('stay_in_month','3');
			
		$Message =urlencode('<SELLGX_REQUEST xmlns="www.detroittradingexchange.com/SellerMessages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.detroittradingexchange.com/SellerMessages/SellGx_request.xsd"><Lead_Metadata><DTX_GEN_ID>'.$User.'</DTX_GEN_ID><LEAD_SOURCE_IP>'.$LEAD_SOURCE_IP.'</LEAD_SOURCE_IP><SOURCE_ID>'.$SOURCE_ID.'</SOURCE_ID><CAMPAIGN_ID>'.$CAMPAIGN_ID.'</CAMPAIGN_ID><GEN_LEAD_ID>'.$GEN_LEAD_ID.'</GEN_LEAD_ID><LEAD_GEN_METHOD>'.$LEAD_GEN_METHOD.'</LEAD_GEN_METHOD><SELF_GENERATED_LEAD>'.$SELF_GENERATED_LEAD.'</SELF_GENERATED_LEAD></Lead_Metadata><Sales_Instructions><MINIMUM_PRICE>2.00</MINIMUM_PRICE></Sales_Instructions><Lead_Data><PERSONAL_INFO><SSN>'.$SSN.'</SSN><FIRST_NAME>'.$FIRST_NAME.'</FIRST_NAME><LAST_NAME>'.$LAST_NAME.'</LAST_NAME><DOB>'.$DOB.'</DOB><BANKRUPTCY>'.$BANKRUPTCY.'</BANKRUPTCY><COSIGNER_AVAILABLE>'.$COSIGNER_AVAILABLE.'</COSIGNER_AVAILABLE><GROSS_MONTHLY_INCOME>'.$GROSS_MONTHLY_INCOME.'</GROSS_MONTHLY_INCOME><CREDIT_SCORE>'.$CREDIT_SCORE.'</CREDIT_SCORE><DOWN_PAYMENT_AMOUNT>'.$DOWN_PAYMENT_AMOUNT.'</DOWN_PAYMENT_AMOUNT></PERSONAL_INFO><CONTACT_INFO><HOME_PHONE>'.$HOME_PHONE.'</HOME_PHONE><EMAIL>'.$EMAIL.'</EMAIL><WORK_PHONE>'.$WORK_PHONE.'</WORK_PHONE><WORK_PHONE_EXT></WORK_PHONE_EXT><MOBILE_PHONE>'.$MOBILE_PHONE.'</MOBILE_PHONE></CONTACT_INFO><EMPLOYMENT_INFO><EMPLOYER_NAME>'.$EMPLOYER_NAME.'</EMPLOYER_NAME><EMPLOYER_PHONE>'.$EMPLOYER_PHONE.'</EMPLOYER_PHONE><YEARS_AT_EMP>'.$YEARS_AT_EMP.'</YEARS_AT_EMP><MONTHS_AT_EMP>'.$MONTHS_AT_EMP.'</MONTHS_AT_EMP><JOB_TITLE>'.$JOB_TITLE.'</JOB_TITLE></EMPLOYMENT_INFO><RESIDENCE_INFO><TYPE>'.$TYPE.'</TYPE><ADDRESS>'.$ADDRESS.'</ADDRESS><CITY>'.$CITY.'</CITY><STATE_PROVINCE>'.$STATE_PROVINCE.'</STATE_PROVINCE><ZIP_POSTAL_CODE>'.$ZIP_POSTAL_CODE.'</ZIP_POSTAL_CODE><COUNTRY>'.$COUNTRY.'</COUNTRY><YEARS_AT_RES>'.$YEARS_AT_RES.'</YEARS_AT_RES><MONTHS_AT_RES>'.$MONTHS_AT_RES.'</MONTHS_AT_RES><MONTHLY_PAYMENT>'.$MONTHLY_PAYMENT.'</MONTHLY_PAYMENT></RESIDENCE_INFO><AUTHORIZATIONS><CREDIT_CHECK>'.$CREDIT_CHECK.'</CREDIT_CHECK><FORWARD_APPLICATION>true</FORWARD_APPLICATION><SPECIAL_OFFERS>false</SPECIAL_OFFERS></AUTHORIZATIONS></Lead_Data></SELLGX_REQUEST>');
		

		$fields = array (
			'User' => $User,
			'Password' => $Password,
			'Message' => $Message,
			'DebugMode' => $status == 1 ? 'false' : 'true',
			
		);
		$post_request = http_build_query($fields);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_response = $cm->curl($post_url,$post_request);
		$time_end = CommonToolsMethods::stopwatch();
		$post_response = html_entity_decode($post_response);
		preg_match("/<SUCCESS>(.*)<\/SUCCESS>/", $post_response, $success);
		if(trim($success[1]) == 'True' || trim(strtolower($success[1])) == 'true' || trim(strtolower($success[1])) == 1){
			$post_status = '1';
			preg_match("/<PRICE>(.*)<\/PRICE>/msui",$post_response,$price);
			preg_match("/<PRICE>(.*)<\/PRICE>/msui", $ping_response, $ping_price );
			$post_price = isset($price[1]) ? $price[1] : $ping_price[1];
		}else{
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
		return $post_responses;
	}
}