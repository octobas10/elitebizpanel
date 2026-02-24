<?php
class ZonerevenueController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$ZIP_POSTAL_CODE = Yii::app()->request->getParam('zip');
		$STATE = Yii::app()->request->getParam('state');
		$YEARS_AT_EMP = Yii::app()->request->getParam('employment_in_year',rand(1,5));
		$MONTHS_AT_EMP = Yii::app()->request->getParam('employment_in_month',rand(1,11));
		$TIME_WITH_EMPLOYER = $YEARS_AT_EMP*12 + $MONTHS_AT_EMP;
		if($TIME_WITH_EMPLOYER < '1'){
			$time_with_emp = 'Less than 1 month';
		}else if($TIME_WITH_EMPLOYER >='1' && $TIME_WITH_EMPLOYER >'6'){
			$time_with_emp = '1-6 months';
		}else if($TIME_WITH_EMPLOYER >='6' && $TIME_WITH_EMPLOYER >'12'){
			$time_with_emp = '6-24 months';
		}else if($TIME_WITH_EMPLOYER >='12' && $TIME_WITH_EMPLOYER >'24'){
			$time_with_emp = '12-24 months';
		}else if($TIME_WITH_EMPLOYER >='24' && $TIME_WITH_EMPLOYER >'60'){
			$time_with_emp = '2-5 years';
		}else if($TIME_WITH_EMPLOYER >='60' && $TIME_WITH_EMPLOYER >'120'){
			$time_with_emp = '1-6 months';
		}else if($TIME_WITH_EMPLOYER >='120'){
			$time_with_emp = '10+ years';
		}
		$GROSS_MONTHLY_INCOME = Yii::app()->request->getParam('monthly_income');
		if($GROSS_MONTHLY_INCOME >= '500' && $GROSS_MONTHLY_INCOME >'100'){
			$gross_income = '500-1000';
		}else if($GROSS_MONTHLY_INCOME >='1000' && $GROSS_MONTHLY_INCOME >'1500'){
			$gross_income = '1000-1500';
		}else if($GROSS_MONTHLY_INCOME >='1500' && $GROSS_MONTHLY_INCOME >'2000'){
			$gross_income = '1500-2000';
		}else if($GROSS_MONTHLY_INCOME >='2000' && $GROSS_MONTHLY_INCOME >'3000'){
			$gross_income = '2000-3000';
		}else if( $GROSS_MONTHLY_INCOME >='3000'){
			$gross_income = '3000+ ';
		}
		$SSN = Yii::app()->request->getParam('ssn');
		$MONTHLY_PAYMENT = Yii::app()->request->getParam('home_pay','2400');
		if($MONTHLY_PAYMENT >= '0' && $MONTHLY_PAYMENT >'500'){
			$monthly_pay = '0-500';
		}else if($MONTHLY_PAYMENT >='501' && $MONTHLY_PAYMENT >'1000'){
			$monthly_pay = '501-1000';
		}else if($MONTHLY_PAYMENT >='1001' && $MONTHLY_PAYMENT >'1500'){
			$monthly_pay = '1001-1500';
		}else if($MONTHLY_PAYMENT >='1501' && $MONTHLY_PAYMENT >'2000'){
			$monthly_pay = '1501-2000';
		}else if( $MONTHLY_PAYMENT >='2000'){
			$monthly_pay = '2000+ ';
		}
		$PROMO_CODE = Yii::app()->request->getParam('promo_code');
		$EMAIL = Yii::app()->request->getParam('email');
		$YEARS_AT_RES = Yii::app()->request->getParam('stay_in_year','4');
		$MONTHS_AT_RES = Yii::app()->request->getParam('stay_in_month','3');
		$TIME_AT_RES = $YEARS_AT_RES*12 + $MONTHS_AT_RES;
		if($TIME_AT_RES < '1'){
			$time_at_residence = 'Less than 1 month';
		}else if($TIME_AT_RES >='1' && $TIME_AT_RES >'6'){
			$time_at_residence = '1-6 months';
		}else if($TIME_AT_RES >='6' && $TIME_AT_RES >'12'){
			$time_at_residence = '6-24 months';
		}else if($TIME_AT_RES >='12' && $TIME_AT_RES >'24'){
			$time_at_residence = '12-24 months';
		}else if($TIME_AT_RES >='24' && $TIME_AT_RES >'60'){
			$time_at_residence = ' 2-5 years';
		}else if($TIME_AT_RES >='60' && $TIME_AT_RES >'120'){
			$time_at_residence = '1-6 months';
		}else if($TIME_AT_RES >='120'){
			$time_at_residence = '10+ years';
		}
		$fields = array (
			'Key' => $p1,
			'API_Action' => 'pingPostLead',
			'Mode' => 'ping',
			'TYPE' => $p2,
			'SRC' => $p3,
			'Sub_ID' => $PROMO_CODE,
			'Email' => $EMAIL,
			'State' => $STATE,
			'Zip' => $ZIP_POSTAL_CODE,
			'Social_Security_Number' => $SSN,
			'Gross_Monthly_Income' => $gross_income,
			'Time_with_Employer' => $time_with_emp,
			'Monthly_Payment' => $monthly_pay,
			'Time_at_current_address' => $time_at_residence,
			'Credit_Score'=>'Good',
		);
		$pingData['ping_request'] = http_build_query($fields);
        return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		$ping_response = html_entity_decode($ping_response);
		preg_match("/<status>(.*)<\/status>/msui", $ping_response, $result);
		if (trim ($result[1]) == 'Matched'){
			preg_match("/<price>(.*)<\/price>/msui", $ping_response, $price );
			preg_match("/<lead_id>(.*)<\/lead_id>/msui", $ping_response, $confirmation_id );
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
		preg_match("/<lead_id>(.*)<\/lead_id>/msui", $ping_response,$confirmation_id);
		$loan_term = array('36','48','60','72','84');
		$loan_term_key = array_rand($loan_term);
		if($status == 1){
			preg_match("/<lead_id>(.*)<\/lead_id>/msui", $ping_response, $confirmation_id);
			$PingId = $confirmation_id[1];
		}else{
			$PingId = $ping_response;
		}
		$LeadDate = date('Y-m-d H:i:s');
		// Lead_Metadata
		$SOURCE_ID = Yii::app()->request->getParam('url','www.eliteautocash.com');
		$PROMO_CODE = Yii::app()->request->getParam('promo_code');
		$LeadID = rand(1111,9999);
		$LEAD_SOURCE_IP = Yii::app()->request->getParam('ipaddress');
		// Lead_Data
		$EMAIL = Yii::app()->request->getParam('email');
		$SSN = Yii::app()->request->getParam('ssn');
		$FIRST_NAME = Yii::app()->request->getParam('first_name');
		$LAST_NAME = Yii::app()->request->getParam('last_name');
		$DOB = date('m/d/Y',strtotime(Yii::app()->request->getParam('dob')));
		$HOME_PHONE = Yii::app()->request->getParam('phone');
		$WORK_PHONE = Yii::app()->request->getParam('work_phone','');
		$MOBILE_PHONE = Yii::app()->request->getParam('mobile');
		$YEARS_AT_RES = Yii::app()->request->getParam('stay_in_year','4');
		$MONTHS_AT_RES = Yii::app()->request->getParam('stay_in_month','3');
		$TIME_AT_RES = $YEARS_AT_RES*12 + $MONTHS_AT_RES;
		if($TIME_AT_RES < '1'){
			$time_at_residence = 'Less than 1 month';
		}else if($TIME_AT_RES >='1' && $TIME_AT_RES >'6'){
			$time_at_residence = '1-6 months';
		}else if($TIME_AT_RES >='6' && $TIME_AT_RES >'12'){
			$time_at_residence = '6-24 months';
		}else if($TIME_AT_RES >='12' && $TIME_AT_RES >'24'){
			$time_at_residence = '12-24 months';
		}else if($TIME_AT_RES >='24' && $TIME_AT_RES >'60'){
			$time_at_residence = ' 2-5 years';
		}else if($TIME_AT_RES >='60' && $TIME_AT_RES >'120'){
			$time_at_residence = '1-6 months';
		}else if($TIME_AT_RES >='120'){
			$time_at_residence = '10+ years';
		}
		$BANKRUPTCY = Yii::app()->request->getParam('bankruptcy','false');
		$COSIGNER_AVAILABLE = Yii::app()->request->getParam('cosigner','Yes');
		$GROSS_MONTHLY_INCOME = Yii::app()->request->getParam('monthly_income');
		if($GROSS_MONTHLY_INCOME >= '500' && $GROSS_MONTHLY_INCOME >'100'){
			$gross_income = '500-1000';
		}else if($GROSS_MONTHLY_INCOME >='1000' && $GROSS_MONTHLY_INCOME >'1500'){
			$gross_income = '1000-1500';
		}else if($GROSS_MONTHLY_INCOME >='1500' && $GROSS_MONTHLY_INCOME >'2000'){
			$gross_income = '1500-2000';
		}else if($GROSS_MONTHLY_INCOME >='2000' && $GROSS_MONTHLY_INCOME >'3000'){
			$gross_income = '2000-3000';
		}else if( $GROSS_MONTHLY_INCOME >='3000'){
			$gross_income = '3000+ ';
		}
		// EMPLOYMENT_INFO
		$EMPLOYER_NAME = Yii::app()->request->getParam('employer');
		$YEARS_AT_EMP = Yii::app()->request->getParam('employment_in_year',rand(1,5));
		$MONTHS_AT_EMP = Yii::app()->request->getParam('employment_in_month',rand(1,11));
		$TIME_WITH_EMPLOYER = $YEARS_AT_EMP*12 + $MONTHS_AT_EMP;
		if($TIME_WITH_EMPLOYER < '1'){
			$time_with_emp = 'Less than 1 month';
		}else if($TIME_WITH_EMPLOYER >='1' && $TIME_WITH_EMPLOYER >'6'){
			$time_with_emp = '1-6 months';
		}else if($TIME_WITH_EMPLOYER >='6' && $TIME_WITH_EMPLOYER >'12'){
			$time_with_emp = '6-24 months';
		}else if($TIME_WITH_EMPLOYER >='12' && $TIME_WITH_EMPLOYER >'24'){
			$time_with_emp = '12-24 months';
		}else if($TIME_WITH_EMPLOYER >='24' && $TIME_WITH_EMPLOYER >'60'){
			$time_with_emp = '2-5 years';
		}else if($TIME_WITH_EMPLOYER >='60' && $TIME_WITH_EMPLOYER >'120'){
			$time_with_emp = '1-6 months';
		}else if($TIME_WITH_EMPLOYER >='120'){
			$time_with_emp = '10+ years';
		}
		$JOB_TITLE = Yii::app()->request->getParam('job_title');
		$MONTHLY_PAYMENT = Yii::app()->request->getParam('home_pay','2400');
		if($MONTHLY_PAYMENT >= '0' && $MONTHLY_PAYMENT >'500'){
			$monthly_pay = '0-500';
		}else if($MONTHLY_PAYMENT >='501' && $MONTHLY_PAYMENT >'1000'){
			$monthly_pay = '501-1000';
		}else if($MONTHLY_PAYMENT >='1001' && $MONTHLY_PAYMENT >'1500'){
			$monthly_pay = '1001-1500';
		}else if($MONTHLY_PAYMENT >='1501' && $MONTHLY_PAYMENT >'2000'){
			$monthly_pay = '1501-2000';
		}else if( $MONTHLY_PAYMENT >='2000'){
			$monthly_pay = '2000+ ';
		}
		$RENT_TYPE = (Yii::app()->request->getParam('is_rented')=='rent') ? 'Rent' : 'Own';
		$ADDRESS = Yii::app()->request->getParam('address');
		$CITY = Yii::app()->request->getParam('city');
		$STATE_PROVINCE = Yii::app()->request->getParam('state');
		$ZIP_POSTAL_CODE = Yii::app()->request->getParam('zip');
		$COUNTRY = 'USA';
		$DownPayment = array('900','1000','1100','1200','1300','1400','1450','1500','1550');
		$down_payment_key = array_rand($DownPayment);
		for($i = 600; $i < 3201; $i++) {
			if($i % 200 == 0) {
				$Month_Pays[] = $i;
			}
		}
		$a_key = array_rand($Month_Pays);
		$Month_Pay = $Month_Pays[$a_key];
		
		$fields = array (
			'Key' => $parameter1,
			'API_Action' => 'pingPostLead',
			'Mode' => 'post',
			'Lead_ID' => trim($PingId),
			'TYPE' => $parameter2,
			'Redirect_URL' => $SOURCE_ID,
			'IP_Address' => $LEAD_SOURCE_IP,
			'SRC' => $parameter3,
			'Pub_ID' => $PROMO_CODE,
			'First_Name' => $FIRST_NAME,
			'Last_Name' => $LAST_NAME,
			'Home_Street_Address' => $ADDRESS,
			'Email' => $EMAIL,
			'City' => $CITY,
			'State' => $STATE_PROVINCE,
			'Zip' => $ZIP_POSTAL_CODE,
			'Home_Phone' => $HOME_PHONE,
			'Cell_Phone' => $MOBILE_PHONE,
			'Gross_Monthly_Income' => $gross_income,
			'Time_with_Employer' => $time_with_emp,
			'Job_Title' => $JOB_TITLE,
			'Employer' => $EMPLOYER_NAME,
			'Social_Security_Number' => $SSN,
			'Date_of_Birth' => $DOB,
			'Monthly_Payment' => $monthly_pay,
			'Time_at_current_address' => $time_at_residence,
			'Home_Type' => $RENT_TYPE,
			'Credit_Score'=>'Good',
		);		
		$post_request = http_build_query($fields);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		//$header = array('Content-Type: application/xml');
		$post_response = $cm->curl($post_url,$post_request);
		$time_end = CommonToolsMethods::stopwatch();
		$post_response = html_entity_decode($post_response);
		preg_match("/<status>(.*)<\/status>/", $post_response, $success);
		if(trim($success[1]) == 'Matched'){
			$post_status = '1';
			preg_match("/<price>(.*)<\/price>/msui",$post_response,$price);
			preg_match("/<price>(.*)<\/price>/msui", $ping_response, $ping_price );
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