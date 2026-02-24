<?php
class BiCoastalMediaController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$fields = array (
			'Key' => $p1,
			'API_Action' => $p2,
			'Mode' => 'ping',
			'Return_Best_Price' => '1',
			'TYPE' => $p3,
			'SRC' => 'ecw_afd',
			'State' => Yii::app()->request->getParam('state'),
			'Zip' => Yii::app()->request->getParam('zip'),
			'SSN' => Yii::app()->request->getParam('ssn'),
			'Sub_ID' => Yii::app()->request->getParam('promo_code'), 
			'Monthly_Income' => Yii::app()->request->getParam('monthly_income')
		);
		$pingData['ping_request'] = http_build_query($fields);
        return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		preg_match ("/<status>(.*)<\/status>/msui", $ping_response, $result);
		if (trim ($result[1]) == 'Matched' || trim ($result[0]) == 'Matched'){
			preg_match ( "/<price>(.*)<\/price>/msui", $ping_response, $price );
			preg_match ( "/<lead_id>(.*)<\/lead_id>/msui", $ping_response, $confirmation_id );
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
		preg_match ( "/<lead_id>(.*)<\/lead_id>/msui", $ping_response, $confirmation_id );
		$fields = array (
			'Key' => $parameter1,
			'API_Action' => $parameter2,
			'Mode' => 'post',
			'Lead_ID' => $confirmation_id[1],
			'TYPE' => $parameter3,
			'Sub_ID' => Yii::app()->request->getParam('promo_code'),
			'IP_Address' => Yii::app()->request->getParam('ipaddress'),
			'Landing_Page' => 'ecw_afd',
			'First_Name' => Yii::app()->request->getParam('first_name'),
			'Last_Name' => Yii::app()->request->getParam('last_name'),
			'Address' => Yii::app()->request->getParam('address'),
			'City' => Yii::app()->request->getParam('city'),
			'State' => Yii::app()->request->getParam('state'),
			'Zip' => Yii::app()->request->getParam('zip'),
			'Email' => Yii::app()->request->getParam('email'),
			'Phone' => Yii::app()->request->getParam('phone'),
			'Alternate_Phone' => Yii::app()->request->getParam('mobile'),
			'Credit_Check_Authorized' => 'Yes',				
			'CoSigner' => (Yii::app()->request->getParam('cosigner')=='1') ? 'Yes' : 'No',
			'DOB' => date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))),
			'Months_At_Residence' => Yii::app()->request->getParam('stay_in_month','3'),
			'Years_At_Residence' => Yii::app()->request->getParam('stay_in_year','4'),
			'Monthly_Mortgage_Or_Rent' => Yii::app()->request->getParam('home_pay','1200'),
			'Rent_Or_Own' => (Yii::app()->request->getParam('is_rented')=='rent') ? 'Rent' : 'Own',
			'Bankruptcy' => (Yii::app()->request->getParam('bankruptcy')=='1') ? 'Yes' : 'No',
			'Employer' => Yii::app()->request->getParam('employer'),
			'Occupation' => Yii::app()->request->getParam('job_title'),
			'Years_Employed' => Yii::app()->request->getParam('employment_in_year','3'),
			'Months_Employed' => Yii::app()->request->getParam('employment_in_month','6'),
		);
		
		$post_request = http_build_query($fields);
		
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_full_response = $cm->curl($post_url,$post_request);
		$time_end = CommonToolsMethods::stopwatch();
		 
		preg_match("/<status>(.*)<\/status>/", $post_full_response, $success);
		
		if(trim($success[1]) == 'Matched'){
			$post_status = '1';
			preg_match("/<Redirect>(.*)<\/Redirect>/", $post_full_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<price>(.*)<\/price>/msui",$post_full_response,$price);
			preg_match ( "/<price>(.*)<\/price>/msui", $ping_response, $ping_price );
			$post_price = isset($price[1]) ? $price[1] : $ping_price[1];
			preg_match("/<lead_id>(.*)<\/lead_id>/msui", $post_full_response, $post_confirmation);
		}else{
			$post_status = '0';
			$post_price = 0;
			$redirect_url='';
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
