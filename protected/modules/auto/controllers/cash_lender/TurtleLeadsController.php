<?php
class TurtleLeadsController extends Controller{
	public function __construct(){}
	/**
	 * Create Ping Request for Lender
	 */
	public static $user_agent_list = ['Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1','Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36','Roku4640X/DVP-7.70 (297.70E04154A)','Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30','Mozilla/5.0 (Linux; Android 5.1; AFTS Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/41.99900.2250.0242 Safari/537.36','Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)','Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US','Mozilla/5.0 (Windows NT 10.0; Win64; x64; XBOX_ONE_ED) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393'];
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = [];
        $user_agent = self::$user_agent_list[array_rand(self::$user_agent_list)];
		$fields = [
			'lp_campaign_id' => $p1?$p1:'630fa9760a953',
			'lp_campaign_key' => $p2?$p2:'r8L6fntKJVwXCjzvRYW7',
			'income' => Yii::app()->request->getParam('monthly_income'),
			'ssn' => Yii::app()->request->getParam('ssn'),
			'zip_code' => Yii::app()->request->getParam('zip'),
			'loan_type' => 'Dealer Purchase',
			'ip_address' => Yii::app()->request->getParam('ipaddress'),
			'landing_page'=>Yii::app()->request->getParam('url','https://eliteautocash.com'),
			'user_agent' => $user_agent,
			'tcpa_consent'=>'Yes',
			'tcpa_consent_text'=>Yii::app()->request->getParam('tcpa_text','i submit'),
            'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
            'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
		];
		$pingData['ping_request'] = http_build_query($fields);
		return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		preg_match ("/<result>(.*)<\/result>/msui", $ping_response,$result);
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
        $user_agent = self::$user_agent_list[array_rand(self::$user_agent_list)];
		$fields = array(
			'lp_campaign_id' => $parameter1?$parameter1:'630fa9760a953',
			'lp_campaign_key' => $parameter2?$parameter2:'r8L6fntKJVwXCjzvRYW7',
			'lp_ping_id' => $ping_id,
			'lp_s1' => Yii::app()->request->getParam('promo_code'),
			'first_name' => Yii::app()->request->getParam('first_name'),
			'last_name' => Yii::app()->request->getParam('last_name'),
			'phone_home' => Yii::app()->request->getParam('phone'),
			'phone_work' => Yii::app()->request->getParam('work_phone',Yii::app()->request->getParam('phone')),
			'address' => Yii::app()->request->getParam('address'),
			'city' => Yii::app()->request->getParam('city'),
			'state' => Yii::app()->request->getParam('state'),
			'zip_code' => Yii::app()->request->getParam('zip'),
			'email_address' => Yii::app()->request->getParam('email'),
			'dob' => date('Y-m-d',strtotime(Yii::app()->request->getParam('dob'))),
			'ip_address' => Yii::app()->request->getParam('ipaddress'),
			'landing_page'=>Yii::app()->request->getParam('url','https://eliteautocash.com'),
			'ssn' => Yii::app()->request->getParam('ssn'),
			'income' => Yii::app()->request->getParam('monthly_income'),
			'employer_name' => Yii::app()->request->getParam('employer'),
			'job_title' => Yii::app()->request->getParam('job_title'),
			'employer_years' => Yii::app()->request->getParam('employment_in_year'),
			'employment_in_month' => Yii::app()->request->getParam('employment_in_month'),
			'residence_cost' => round(Yii::app()->request->getParam('monthly_income')/rand(3,4)),
			'residence_type' => (Yii::app()->request->getParam('is_rented')=='rent')?'Rent':'Own',
			'residence_years' => Yii::app()->request->getParam('stay_in_year'),
			'residence_months' => Yii::app()->request->getParam('stay_in_month'),
			'bankruptcy' => Yii::app()->request->getParam('bankruptcy')=='1' ? 'true':'false',
			'loan_type' => 'Dealer Purchase',
			'occupation'=>'Employment',
			'tcpa_optin' => 'Yes',
			'tcpa_optin_text'=>Yii::app()->request->getParam('tcpa_text'),
			'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
            'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
			'user_agent' => $user_agent,
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
