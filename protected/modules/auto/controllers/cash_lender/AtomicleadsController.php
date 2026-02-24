<?php
class AtomicleadsController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$fields = array (
				'password' => $p1,
				'VID' => $p2,
				'SocialSecurityNumber' => Yii::app()->request->getParam('ssn'),
				'ZipCode' => Yii::app()->request->getParam('zip'),
				'MonthlyIncome' => Yii::app()->request->getParam('monthly_income'),
				'SubID' => $p3,
				'LeadGenMethod' => 'UNKNOWN',
				'BirthDate' => date('m/d/Y',strtotime(Yii::app()->request->getParam('dob')))
		);
		$pingData['ping_request'] = http_build_query($fields);
        return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		preg_match ("/<isValidPost>(.*)<\/isValidPost>/msui", $ping_response, $result);
		if (trim ($result[0]) == 'true' || trim ($result[1]) == 'true'){
			preg_match ( "/<Price>(.*)<\/Price>/msui", $ping_response, $price );
			preg_match ( "/<LeadIdentifier>(.*)<\/LeadIdentifier>/msui", $ping_response, $confirmation_id );
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
		preg_match ( "/<LeadIdentifier>(.*)<\/LeadIdentifier>/msui", $ping_response, $confirmation_id );
		$fields = array (
				'password' => $parameter1,
				'VID' => $parameter2,
				'OrderID' => $confirmation_id[1],
				'EmployerPhone' => Yii::app()->request->getParam('work_phone',Yii::app()->request->getParam('phone')),
				'AppForward' => 'Yes',
				'FirstName' => Yii::app()->request->getParam('first_name'),
				'LastName' => Yii::app()->request->getParam('last_name'),
				'Address' => Yii::app()->request->getParam('address'),
				'City' => Yii::app()->request->getParam('city'),
				'State' => Yii::app()->request->getParam('state'),
				'ZipCode' => Yii::app()->request->getParam('zip'),
				'Email' => Yii::app()->request->getParam('email'),
				'HomePhone' => Yii::app()->request->getParam('phone'),
				'CellPhone' => Yii::app()->request->getParam('mobile',Yii::app()->request->getParam('phone')),
				'SocialSecurityNumber' => Yii::app()->request->getParam('ssn'),
				'MonthsatResidence' => Yii::app()->request->getParam('stay_in_month','3'),
				'YearsatResidence' => Yii::app()->request->getParam('stay_in_year','4'),
				'MonthlyPayment' => Yii::app()->request->getParam('home_pay','1200'),
				'Employer' => Yii::app()->request->getParam('employer'),
				'WorkPhone' => Yii::app()->request->getParam('work_phone',Yii::app()->request->getParam('phone')),
				'JobTitle' => Yii::app()->request->getParam('job_title'),
				'MonthlyIncome' => Yii::app()->request->getParam('monthly_income'),
				'MonthsatEmployer' => Yii::app()->request->getParam('employment_in_month','6'),
				'YearsatEmployer' => Yii::app()->request->getParam('employment_in_year','3'),
				'ResidenceType' => (Yii::app()->request->getParam('is_rented')=='rent') ? 'Rent' : 'Own',
				'Bankruptcy' => (Yii::app()->request->getParam('bankruptcy')=='1') ? 'Yes' : 'No',
				'CreditAuthorization' => (Yii::app()->request->getParam('agree_credit_check')=='1') ? 'Yes' : 'No',
				'SubID' => $parameter3,
				'LeadGenMethod' => 'UNKNOWN',
				'IPAddress' => Yii::app()->request->getParam('ipaddress'),
				'LeadID' => rand(1111,9999),
				'CosignerAvailable' => (Yii::app()->request->getParam('cosigner')=='1') ? 'Yes' : 'No',
				'BirthDate' => date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))),
		);
		
		$post_request = http_build_query($fields);
		
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_full_response = $cm->curl($post_url,$post_request);
		$time_end = CommonToolsMethods::stopwatch();
		 
		preg_match("/<isValidPost>(.*)<\/isValidPost>/", $post_full_response, $success);
		
		if(trim($success[1]) == 'true'){
			$post_status = '1';
			preg_match("/<Redirect>(.*)<\/Redirect>/", $post_full_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<Price>(.*)<\/Price>/msui",$post_full_response,$price);
			preg_match ( "/<Price>(.*)<\/Price>/msui", $ping_response, $ping_price );
			$post_price = isset($price[1]) ? $price[1] : $ping_price[1];
		}else{
			$post_status = '0';
			$post_price = 0;
			$redirect_url = '';
		}
		
		$post_time = ($time_end - $start_time);
		 
		$post_response['post_request'] = $post_request;
		$post_response['post_response'] = $post_full_response;
		$post_response['post_status'] = $post_status;
		$post_response['post_price'] = $post_price;
		$post_response['redirect_url'] = $redirect_url;
		$post_response['post_time'] = $post_time;
		return $post_response;
	}
}
?>
