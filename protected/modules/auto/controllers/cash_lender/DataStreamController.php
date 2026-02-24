<?php
class DataStreamController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$pingData = array();
		$PayFrequencies = array(
			"Weekly",
			"BiWeekly",
			"TwiceMonthly",
			"Monthly"
		);
		$PayFrequencies_key = array_rand($PayFrequencies);
		$PayFrequency = $PayFrequencies[$PayFrequencies_key];
		$fields = array(
			'IsTest' => $status == 1 ? 'false' : 'true',
			'PayFrequency' => 'BiWeekly',
			'CampaignId' => $p1,
			"Zip" => Yii::app()->request->getParam('zip'),
			"Social" => Yii::app()->request->getParam('ssn'),
			'GrossMonthlyIncome' => Yii::app()->request->getParam('monthly_income'),
			'SubId' => Yii::app()->request->getParam('promo_code'),
		);
		$pingData['ping_request'] = http_build_query($fields);
		return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response) {
		preg_match("/<IsValid>(.*)<\/IsValid>/msui", $ping_response, $result);
		if(trim($result[1]) == 'True' || trim($result[0]) == 'True') {
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $price);
			preg_match("/<PingId>(.*)<\/PingId>/msui", $ping_response, $confirmation_id);
			$ping_price = isset($price[1]) ? $price[1] : 0;
			$confirmation_id = $confirmation_id[1];
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
	public static function sendPostData($parameter1, $parameter2, $parameter3, $ping_response, $post_url, $status) {
		if($status == 1){
			preg_match("/<PingId>(.*)<\/PingId>/msui", $ping_response, $confirmation_id);
			$PingId = $confirmation_id[1];
		}else{
			$PingId = $ping_response;
		}
		for($i = 600; $i < 3201; $i++) {
			if($i % 200 == 0) {
				$Month_Pays[] = $i;
			}
		}
		$a_key = array_rand($Month_Pays);
		$Month_Pay = $Month_Pays[$a_key];
		$a = array(
			"Anytime",
			"Morning",
			"Afternoon",
			"Evening"
		);
		$a_key = array_rand($a);
		$ContactWhen = $a[$a_key];
		$fields = array(
			"CampaignId" => $parameter1,
			"PingId" => trim($PingId),
			'IsTest' => $status == 1 ? 'false' : 'true',
			"FirstName" => Yii::app()->request->getParam('first_name'),
			"LastName" => Yii::app()->request->getParam('last_name'),
			"Address1" => Yii::app()->request->getParam('address'),
			"State" => Yii::app()->request->getParam('state'),
			"City" => Yii::app()->request->getParam('city'),
			"Zip" => Yii::app()->request->getParam('zip'),
			"Email" => Yii::app()->request->getParam('email'),
			"Phone" => Yii::app()->request->getParam('phone'),
			"WorkPhone" => Yii::app()->request->getParam('work_phone', Yii::app()->request->getParam('phone')),
			"DateOfBirth" => date('m/d/Y', strtotime(Yii::app()->request->getParam('dob'))),
			"Social" => Yii::app()->request->getParam('ssn'),
			"AuthorizeCreditCheck" => Yii::app()->request->getParam('agree_credit_check', '1'),
			"Cosigner" => Yii::app()->request->getParam('cosigner', '0'),
			"Bankruptcy" => Yii::app()->request->getParam('bankruptcy', '0'),
			"LoanTerm" => "36",
			"LoanAmount" => Yii::app()->request->getParam('loan_amount', '10000'),
			"YearsAtResidence" => Yii::app()->request->getParam('stay_in_year', '4'),
			"MonthsAtResidence" => Yii::app()->request->getParam('stay_in_month', '3'),
			"ResidenceDate" => date('m').'/'.date('d').'/'.(date('Y')-rand(1,10)),
			"MonthlyHousePayment" => $Month_Pay,
			"OwnHome" => (Yii::app()->request->getParam('is_rented') == 'rent') ? '0' : '1',
			"Employer" => Yii::app()->request->getParam('employer'),
			"Occupation" => Yii::app()->request->getParam('job_title'),
			"YearsAtWork" => Yii::app()->request->getParam('employment_in_year', '3'),
			"MonthsAtWork" => Yii::app()->request->getParam('employment_in_month', '6'),
			"HireDate" => date('m').'/'.date('d').'/'.(date('Y')-rand(18,65)),
			"GrossMonthlyIncome" => Yii::app()->request->getParam('monthly_income'),
			"OptIn" => "1", // I agree to the terms of service. 0=No,1=Yes
			"IPAddress" => $_SERVER['REMOTE_ADDR'],
			"SubId" => Yii::app()->request->getParam('promo_code'),
			"Source" => "http://eliteautocash.com",
			"ContactWhen" => $ContactWhen,
			"PayFrequency" => "BiWeekly",
			"IncomeType" => "Employed"
		);
		$post_request = http_build_query($fields);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_full_response = $cm->curl($post_url, $post_request);
		$time_end = CommonToolsMethods::stopwatch();
		preg_match("/<IsValid>(.*)<\/IsValid>/", $post_full_response, $success);
		if(trim($success[1]) == 'True') {
			$post_status = '1';
			preg_match("/<Redirect>(.*)<\/Redirect>/", $post_full_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<Price>(.*)<\/Price>/msui", $post_full_response, $price);
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $ping_price);
			$post_price = isset($price[1]) ? $price[1] : $ping_price[1];
		} else {
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
