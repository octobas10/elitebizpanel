<?php
class AuQuiroMediaController extends Controller{
	public function __construct(){}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$fields = array(
			'lp_campaign_id' => $p1,
			'lp_campaign_key' => $p2,
			'monthly_income' => Yii::app()->request->getParam('monthly_income'),
			'SSN' => Yii::app()->request->getParam('ssn'),
			'zip_code' => Yii::app()->request->getParam('zip'),
		);
		$pingData['ping_request'] = http_build_query($fields);
		return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		preg_match ("/<result>(.*)<\/result>/msui", $ping_response, $result);
		if (trim($result[0]) == 'success' || trim($result[1]) == 'success'){
			preg_match("/<price>(.*)<\/price>/msui", $ping_response, $price);
			preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response, $confirmation_id);
			$ping_price = isset($price[1]) ? $price[1] : 0;
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
	/**
	 * Send Post Data to Lender
	 */
	public static function sendPostData($parameter1,$parameter2,$parameter3,$ping_response,$post_url,$status){
		preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response, $confirmation_id);
		$ping_id = $confirmation_id[1];
		$fields = array(
			'lp_campaign_id' => $parameter1,
			'lp_campaign_key' => $parameter2,
			'lp_ping_id' => $ping_id,
			'address' => Yii::app()->request->getParam('address'),
			'address_month' => Yii::app()->request->getParam('stay_in_month'),
			'address_years' => Yii::app()->request->getParam('stay_in_year'),
			'bankruptcy' =>  Yii::app()->request->getParam('bankruptcy'),
			'city' => Yii::app()->request->getParam('city'),
			'credit' => 'Agreed',
			'date_stamp' => '',
			'dob_mm' => date('m',strtotime(Yii::app()->request->getParam('dob'))),
			'dob_dd' => date('d',strtotime(Yii::app()->request->getParam('dob'))),
			'dob_yy' => date('Y',strtotime(Yii::app()->request->getParam('dob'))),
			'email_address' => Yii::app()->request->getParam('email'),
			'employer_name' => Yii::app()->request->getParam('employer'),
			'first_name' => Yii::app()->request->getParam('first_name'),
			'ip_address' => Yii::app()->request->getParam('ipaddress'),
			'job_title' => Yii::app()->request->getParam('job_title'),
			'last_name' => Yii::app()->request->getParam('last_name'),
			'marketing_offers' => 'Yes',
			'monthly_income' => Yii::app()->request->getParam('monthly_income'),
			'monthly_payment' => Yii::app()->request->getParam('home_pay'),
			'months_job' => Yii::app()->request->getParam('employment_in_month'),
			'phone_home' => Yii::app()->request->getParam('phone'),
			'phone_work' => Yii::app()->request->getParam('work_phone',Yii::app()->request->getParam('phone')),
			'rent_own' => (Yii::app()->request->getParam('is_rented')=='rent') ? 'Rent' : 'Own',
			'SSN' => Yii::app()->request->getParam('ssn'),
			'state' => Yii::app()->request->getParam('state'),
			'year_Job' => Yii::app()->request->getParam('employment_in_year'),
			'zip_code' => Yii::app()->request->getParam('zip'),
			'date_stamp'=>date('Y-m-d H:i:s'),
		);
		
		$post_request = http_build_query($fields);
		
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_full_response = $cm->curl($post_url,$post_request);
		$time_end = CommonToolsMethods::stopwatch();
		
		preg_match("/<result>(.*)<\/result>/",$post_full_response,$success);
		
		if(trim($success[1])=='success'){
			$post_status = '1';
			preg_match("/<redirect_url>(.*)<\/redirect_url>/", $post_full_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<price>(.*)<\/price>/msui",$post_full_response,$price);
			preg_match("/<price>(.*)<\/price>/msui", $ping_response, $ping_price );
			$post_price = isset($price[1]) ? $price[1] : $ping_price[1];
		}else{
			$post_status = '0';
			$post_price = 0;
			$redirect_url = '';
		}
		
		$post_time = ($time_end-$start_time);
		
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
