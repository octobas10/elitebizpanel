<?php
class RevRadicalController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$fields = array (
			//'IsTest' => $status == 1 ? 'false' : 'true',
			'CampaignId' => $p1,
			'Zip' => Yii::app()->request->getParam('zip'),
			'Social' => Yii::app()->request->getParam('ssn'),
			'GrossMonthlyIncome' => Yii::app()->request->getParam('monthly_income'),
			'IPAddress' => Yii::app()->request->getParam('ipaddress'),
			'Source' => Yii::app()->request->getParam('url','www.eliteautocash.com'),
		);
		$pingData['ping_request'] = http_build_query($fields);
        return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		preg_match("/<IsValid>(.*)<\/IsValid>/msui", $ping_response, $result);
		if (trim ($result[1]) == 'True' || trim ($result[0]) == 'True'){
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $price );
			preg_match("/<PingId>(.*)<\/PingId>/msui", $ping_response, $confirmation_id );
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
		preg_match("/<PingId>(.*)<\/PingId>/msui", $ping_response,$confirmation_id);
		$loan_term = array('36','48','60','72','84');
		$loan_term_key = array_rand($loan_term);
		if($status == 1){
			preg_match("/<PingId>(.*)<\/PingId>/msui", $ping_response, $confirmation_id);
			$PingId = $confirmation_id[1];
		}else{
			$PingId = $ping_response;
		}
		$fields = array (
			'CampaignId' => $parameter1,
			//'IsTest' => $status == 1 ? 'false' : 'true',
			'PingId' => trim($PingId),
			'FirstName' => Yii::app()->request->getParam('first_name'),
			'LastName' => Yii::app()->request->getParam('last_name'),
			'Email' => Yii::app()->request->getParam('email'),
			'Address1' => Yii::app()->request->getParam('address'),
			'Zip' => Yii::app()->request->getParam('zip'),
			'Phone' => Yii::app()->request->getParam('phone'),
			'City' => Yii::app()->request->getParam('city'),
			'State' => Yii::app()->request->getParam('state'),
			'OwnHome' => (Yii::app()->request->getParam('is_rented')=='rent') ? 'Rent' : 'Own',
			'YearsAtResidence' => Yii::app()->request->getParam('stay_in_year','4'),
			'MonthsAtResidence' => Yii::app()->request->getParam('stay_in_month','3'),
			'DateOfBirth' => date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))),
			'Social' => Yii::app()->request->getParam('ssn'),
			'Employer' => Yii::app()->request->getParam('employer'),
			'jobtitle' => Yii::app()->request->getParam('job_title'),
			'WorkPhone' => Yii::app()->request->getParam('work_phone',''),
			'YearsAtWork' => Yii::app()->request->getParam('employment_in_year','3'),
			'MonthsAtWork' => Yii::app()->request->getParam('employment_in_month','6'),
			'IncomeType' => 'Fixed Income', // Employed
			'GrossMonthlyIncome' => Yii::app()->request->getParam('monthly_income'),
			'LoanAmount' => Yii::app()->request->getParam('loan_amount','10000'),
			'Bankruptcy' => Yii::app()->request->getParam('bankruptcy','0'),
			'Cosigner' => Yii::app()->request->getParam('cosigner','0'),
			'CellPhone' => Yii::app()->request->getParam('mobile'),
			'AuthorizeCreditCheck' => Yii::app()->request->getParam('agree_credit_check','True'),
			'CreditRating' => 'Good',
			'LoanTerm' => $loan_term[$loan_term_key],
			'MonthlyHousePayment' => Yii::app()->request->getParam('home_pay','1200'),
			'Occupation' => Yii::app()->request->getParam('job_title'),
			'OptIn' => 'True',
			'ConsentType' => 'Active',
			'ConsentText' => 'test',
			'IPAddress' => Yii::app()->request->getParam('ipaddress'),
			'UserAgent' => '1',
			'SubId' => $_POST['promo_code'],
			'ContactWhen'=>'Anytime',
			'Source' => Yii::app()->request->getParam('url','www.eliteautocash.com'),
			'website_url' => 'www.eliteautocash.com',
		);
		$post_request = http_build_query($fields);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_response = $cm->curl($post_url,$post_request);
		$time_end = CommonToolsMethods::stopwatch();
		preg_match("/<IsValid>(.*)<\/IsValid>/", $post_response, $success);
		if(trim($success[1]) == 'True'){
			$post_status = '1';
			preg_match("/<Redirect>(.*)<\/Redirect>/", $post_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<Price>(.*)<\/Price>/msui",$post_response,$price);
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $ping_price );
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