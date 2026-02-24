<?php
class QuoteBoundController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$fields = array (
			'CampaignId' => '35FD82D27034D285E00DA2ABC5A5A3D2',
			'SubId' => '2045',
			'Zip' => Yii::app()->request->getParam('zip'),
			'Social' => Yii::app()->request->getParam('ssn'),
			'MonthlyIncome' => Yii::app()->request->getParam('monthly_income'),
		);
		$pingData['ping_request'] = http_build_query($fields);
        return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
	
		preg_match ("/<IsValid>(.*)<\/IsValid>/msui", $ping_response, $result);
	
		if (trim ($result[1]) == 'True' || trim ($result[0]) == 'True'){
			preg_match ( "/<Price>(.*)<\/Price>/msui", $ping_response, $price );
			preg_match ( "/<PingId>(.*)<\/PingId>/msui", $ping_response, $confirmation_id );
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
		preg_match ( "/<PingId>(.*)<\/PingId>/msui", $ping_response, $confirmation_id );
		$fields = array (
				'CampaignId' => '35FD82D27034D285E00DA2ABC5A5A3D2',
				'SubId' => '2045',
				'PingId' => $confirmation_id[1],
				'IPAddress' => $_SERVER['REMOTE_ADDR'],
				'FirstName' => Yii::app()->request->getParam('first_name'),
				'LastName' => Yii::app()->request->getParam('last_name'),
				'Address1' => Yii::app()->request->getParam('address'),
				'City' => Yii::app()->request->getParam('city'),
				'State' => Yii::app()->request->getParam('state'),
				'Zip' => Yii::app()->request->getParam('zip'),
				'Email' => Yii::app()->request->getParam('email'),
				'Phone' => Yii::app()->request->getParam('phone'),
				'AltPhone' => Yii::app()->request->getParam('work_phone',Yii::app()->request->getParam('phone')),
				'Authorize' => Yii::app()->request->getParam('agree_credit_check','Yes'),
				'CosignerAvailable' => Yii::app()->request->getParam('cosigner')=='0' ? 'No' : 'Yes',
				'DOB' => Yii::app()->request->getParam('dob'),
				'Social' => Yii::app()->request->getParam('ssn'),
				'MonthsAtResidence' => Yii::app()->request->getParam('stay_in_month'),
				'YearsAtResidence' => Yii::app()->request->getParam('stay_in_year'),
				'MonthlyHousingPayment' => Yii::app()->request->getParam('home_pay'),
				'OwnRent' => Yii::app()->request->getParam('is_rented'),
				'Bankruptcy' => Yii::app()->request->getParam('bankruptcy')=='0' ? 'No' : 'Yes',
				'Employer' => Yii::app()->request->getParam('employer'),
				'Occupation' => Yii::app()->request->getParam('job_title'),
				'Yearsatwork' => Yii::app()->request->getParam('employment_in_year','3'),
				'MonthsEmployed' => Yii::app()->request->getParam('employment_in_month','6'),
				'MonthlyIncome' => Yii::app()->request->getParam('monthly_income'),
		);
		
		$post_request = http_build_query($fields);
		
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_full_response = $cm->curl($post_url,$post_request);
		$time_end = CommonToolsMethods::stopwatch();
		 
		preg_match("/<IsValid>(.*)<\/IsValid>/", $post_full_response, $success);
		
		if(trim($success[1]) == 'True'){
			$post_status = '1';
			preg_match("/<redirectURL>(.*)<\/redirectURL>/", $post_full_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<Price>(.*)<\/Price>/msui",$post_full_response,$price);
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $ping_price);
			$post_price = isset($price[1]) ? $price[1] : $ping_price[1];
		}else{
			$post_status = '0';
			$post_price = '';
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
