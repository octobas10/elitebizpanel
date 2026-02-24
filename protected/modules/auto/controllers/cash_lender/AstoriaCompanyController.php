<?php
class AstoriaCompanyController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$promo_code = Yii::app()->request->getParam('promo_code');
		$pingData = [];
		$ipaddress = Yii::app()->request->getParam('ipaddress');
		/*$randIP = mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0, 255).".".mt_rand(0,255);
		$ipaddress = $ipaddress =='0'? $randIP : $ipaddress;*/
		if($promo_code == 65 || $promo_code == 92){
			$pingData['ping_request'] = false;
            return $pingData;

    	}else{
    		$fields = [
				'lead_type' => $p1,
				'lead_mode' => $status,
				'vendor_id' => $p2,
				'sub_id' =>  Yii::app()->request->getParam('promo_code'),
				'ipaddress' =>  $ipaddress,
				'zip' => Yii::app()->request->getParam('zip'),
				'residence_type' => (Yii::app()->request->getParam('is_rented')=='rent') ? '1' : '0',
				'ssn' => Yii::app()->request->getParam('ssn'),
				'monthly_income' => Yii::app()->request->getParam('monthly_income'),
				'loan_amount' => Yii::app()->request->getParam('loan_amount','10000')
			];
			$pingData['ping_request'] = http_build_query($fields);
			return $pingData;
        }
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		preg_match("/<Response>(.*)<\/Response>/msui", $ping_response, $result);
		if (trim ($result[1]) == 'Accepted' || trim ($result[0]) == 'Accepted'){
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $price );
			preg_match("/<Confirmation>(.*)<\/Confirmation>/msui", $ping_response, $confirmation_id );
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
		preg_match("/<Confirmation>(.*)<\/Confirmation>/msui", $ping_response, $confirmation_id );
		$home_payment = Yii::app()->request->getParam('home_pay') < 99 ? rand(100,2000) : Yii::app()->request->getParam('home_pay');
		$fields = array (
			'confirmation_id' => $confirmation_id[1],
			'lead_type' => $parameter1,
			'lead_mode' => $status == 1 ? '1' : '0',
			'vendor_id' => $parameter2,
			'sub_id' => Yii::app()->request->getParam('promo_code'),
			'universal_leadid' => Yii::app()->request->getParam('universal_leadid'),
			'tcpa_text' => Yii::app()->request->getParam('tcpa_text'),
			'origination_datetime' => date('Y-m-d H:i:s'),
			'origination_timezone' => '1',
			'ipaddress' => Yii::app()->request->getParam('ipaddress'),
			'first_name' => Yii::app()->request->getParam('first_name'),
			'last_name' => Yii::app()->request->getParam('last_name'),
			'email' => Yii::app()->request->getParam('email'),
			'address' => Yii::app()->request->getParam('address'),
			'zip' => Yii::app()->request->getParam('zip'),
			'primary_phone' => Yii::app()->request->getParam('phone'),
			'secondary_phone' => Yii::app()->request->getParam('mobile'),
			'residence_type' => (Yii::app()->request->getParam('is_rented')=='rent') ? '1' : '0',
			'years_at_residence' => Yii::app()->request->getParam('stay_in_year','4'),
			'months_at_residence' => Yii::app()->request->getParam('stay_in_month','3'),
			'dob' => date('Y-m-d',strtotime(Yii::app()->request->getParam('dob'))),
			'ssn' => Yii::app()->request->getParam('ssn'),
			'employer' => Yii::app()->request->getParam('employer'),
			'job_title' => Yii::app()->request->getParam('job_title'),
			'work_phone' => Yii::app()->request->getParam('work_phone',''),
			'employment_in_year' => Yii::app()->request->getParam('employment_in_year','3'),
			'employment_in_month' => Yii::app()->request->getParam('employment_in_month','6'),
			'employment_type' => '1', // Employed
			'monthly_income' => Yii::app()->request->getParam('monthly_income'),
			'loan_amount' => Yii::app()->request->getParam('loan_amount','10000'),
			'account_type' => '2', // Checking
			'bankruptcy' => Yii::app()->request->getParam('bankruptcy','0'),
			'cosigner' => Yii::app()->request->getParam('cosigner','0'),
			'home_payment' => $home_payment,
			'down_payment' => '100',
			'credit_rating' => '3', // Fair
			'credit_repair' => '0', // No
			'agree_credit_check' => Yii::app()->request->getParam('agree_credit_check','1'),
			'optout' => '1' // Yes
		);
		
		$post_request = http_build_query($fields);
		
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_response = $cm->curl($post_url,$post_request);
		$time_end = CommonToolsMethods::stopwatch();
		 
		preg_match("/<Response>(.*)<\/Response>/", $post_response, $success);
		if(trim($success[1]) == 'Accepted'){
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
?>
