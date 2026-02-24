<?php
class IncentMediaController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$zip =  Yii::app()->request->getParam('zip');
		$zipcode =  $status == 1 ? $zip : '01010';
		$fields = array (
			'cid' => $p1 ? $p1 : 'auto378204',
			'subid' => Yii::app()->request->getParam('promo_code'),
			'zip' => $zipcode,
			'ssn' => Yii::app()->request->getParam('ssn'),
			'monthly_income' => Yii::app()->request->getParam('monthly_income'),
		);
		
		$pingData['ping_request'] = http_build_query($fields);
        return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		preg_match("/<result>(.*)<\/result>/msui", $ping_response, $result);
		if (trim ($result[1]) == 'true' || trim ($result[1]) == 'True'){
			preg_match("/<price>(.*)<\/price>/msui", $ping_response, $price );
			preg_match("/<offerId>(.*)<\/offerId>/msui", $ping_response, $confirmation_id );
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
		preg_match("/<offerId>(.*)<\/offerId>/msui", $ping_response,$confirmation_id);
		$loan_term = array('36','48','60','72','84');
		$loan_term_key = array_rand($loan_term);
		if($status == 1){
			preg_match("/<offerId>(.*)<\/offerId>/msui", $ping_response, $confirmation_id);
			$PingId = $confirmation_id[1];
		}else{
			$PingId = $ping_response;
		}
		$home_phone = Yii::app()->request->getParam('phone');
		$home_phone1 = substr($home_phone,0,3);
		$home_phone2 = substr($home_phone,3,3);
		$home_phone3 = substr($home_phone,6,4);
		$work_phone = Yii::app()->request->getParam('work_phone','');
		$work_phone1 = substr($work_phone,0,3);
		$work_phone2 = substr($work_phone,3,3);
		$work_phone3 = substr($work_phone,6,4);
		$mobile_phone = Yii::app()->request->getParam('mobile');
		$mobile_phone = $mobile_phone ? $mobile_phone : $home_phone ;
		$mobile_phone1 = substr($mobile_phone,0,3);
		$mobile_phone2 = substr($mobile_phone,3,3);
		$mobile_phone3 = substr($mobile_phone,6,4);
		$dob = explode('/',date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))));
		$bmonth = $dob[0];
		$bday = $dob[1];
		$byear = $dob[2];
		$yearsatres = Yii::app()->request->getParam('stay_in_year','3');
		$monthsatres = Yii::app()->request->getParam('stay_in_month','6');
		$yearsatwork = Yii::app()->request->getParam('employment_in_year','3');
		$monthsatwork = Yii::app()->request->getParam('employment_in_month','6');
		$fields = array (
			//'IsTest' => $status == 1 ? 'false' : 'true',
			'offerId' => trim($PingId),
			'firstname' => Yii::app()->request->getParam('first_name'),
			'lastname' => Yii::app()->request->getParam('last_name'),
			'email' => Yii::app()->request->getParam('email'),
			'address1' => Yii::app()->request->getParam('address'),
			'address2' => '',
			'city' => Yii::app()->request->getParam('city'),
			'home_phone1' => $home_phone1,
			'home_phone2' => $home_phone2,
			'home_phone3' => $home_phone3,
			'work_phone1' => $work_phone1,
			'work_phone2' => $work_phone2,
			'work_phone3' => $work_phone3,
			'mobile_phone1' => $mobile_phone1,
			'mobile_phone2' => $mobile_phone2,
			'mobile_phone3' => $mobile_phone3,
			'bmonth' => $bmonth,
			'bday' => $bday,
			'byear' => $byear,
			'ownrent' => (Yii::app()->request->getParam('is_rented')=='rent') ? 'rent' : 'own',
			'timeatresidence'=>$yearsatres,
			'timeatresidencemonths'=>$monthsatres,
			'timeatjob'=>$yearsatwork,
			'timeatjobmonths'=>$monthsatwork,
			'employer'=>Yii::app()->request->getParam('employer'),
			'occupation' => Yii::app()->request->getParam('job_title'),
			'monthlypayment' => Yii::app()->request->getParam('home_pay','1200'),
			'bankrupt' => Yii::app()->request->getParam('bankruptcy','0'),
			'cosign' => Yii::app()->request->getParam('cosigner','0'),
			'optin' => '1',
			'ipaddress' => Yii::app()->request->getParam('ipaddress'),
			'timetocontact'=>'day',
			'loantype'=>'loan',
		);
		$post_request = http_build_query($fields);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_response = $cm->curl($post_url,$post_request);
		$time_end = CommonToolsMethods::stopwatch();
		preg_match("/<result>(.*)<\/result>/", $post_response, $success);
		if(trim($success[1]) == 'True' || trim($success[1]) == 'true'){
			$post_status = '1';
			preg_match("/<Redirect>(.*)<\/Redirect>/", $post_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<price>(.*)<\/price>/msui",$post_response,$price);
			preg_match("/<price>(.*)<\/price>/msui", $ping_response, $ping_price);
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