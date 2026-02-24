<?php
class DummyController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender 
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $p4 = false){
    	$pingData = array();
        $fields = array(
            'firstName' => Yii::app()->request->getParam('first_name'),
            'lastName' => Yii::app()->request->getParam('last_name'),
            'ssn' => Yii::app()->request->getParam('ssn'),
            'dob' => Yii::app()->request->getParam('dob'),
            'address' => Yii::app()->request->getParam('address'),
            'city' => Yii::app()->request->getParam('city'),
            'state' => Yii::app()->request->getParam('state'),
            'zip' => Yii::app()->request->getParam('zip'),
            'email' => Yii::app()->request->getParam('email')
        );
        $pingData['ping_request'] = http_build_query($fields);
        return $pingData;
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response){

    	preg_match("/<isValidPost>(.*)<\/isValidPost>/msui",$ping_response,$result);
    	
    	/** Set Post Rejection, For Testing Purpose Only.*/
    	//$result[0]=$result[1] = 'false';
    	 
    	if(trim($result[1]) == 'true' || trim($result[0]) == 'true'){
    		preg_match("/<Price>(.*)<\/Price>/msui",$ping_response,$price);
    		preg_match("/<id>(.*)<\/id>/msui",$ping_response,$confirmation_id);
    		$ping_price = $price[1];
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
    	preg_match("/<id>(.*)<\/id>/",$ping_response, $confirmation_id);
    	$fields = array(
    		'http_referer' => 'http://elitebizpanel.com/index.php/edu/postprocess?',
    		'lead_mode' => Yii::app()->request->getParam('lead_mode'),
    		'promo_code' => Yii::app()->request->getParam('promo_code'),
    		'first_name' => Yii::app()->request->getParam('first_name'),
    		'last_name' => Yii::app()->request->getParam('last_name'),
    		'gender' => Yii::app()->request->getParam('gender'),
    		'ssn' => Yii::app()->request->getParam('ssn'),
    		'dob' => Yii::app()->request->getParam('dob'),
    		'address' => Yii::app()->request->getParam('address'),
    		'city' => Yii::app()->request->getParam('city'),
    		'state' => Yii::app()->request->getParam('state'),
    		'zip' => Yii::app()->request->getParam('zip'),
    		'email' => Yii::app()->request->getParam('email'),
    		'phone' => Yii::app()->request->getParam('phone'),
    		'mobile' => Yii::app()->request->getParam('mobile'),
    		'program_of_interest' => Yii::app()->request->getParam('program_of_interest'),
    		'master_degree' => Yii::app()->request->getParam('master_degree'),
    		'ged' => Yii::app()->request->getParam('ged'),
    		'speak_english' => Yii::app()->request->getParam('speak_english'),
			'campus' => Yii::app()->request->getParam('campus')
    		//'title' => Yii::app()->request->getParam('job_title'),
    		//'employer_name' => Yii::app()->request->getParam('employer'),
    		//'empmonth' => Yii::app()->request->getParam('employment_in_month'),
    		//'empyear' => Yii::app()->request->getParam('employment_in_month'),
    		//'empphone' => Yii::app()->request->getParam('work_phone'),
    		//'mainincome' => Yii::app()->request->getParam('monthly_income')
    	);
    	if($confirmation_id!=''){ $fields['confirmation'] = $confirmation_id;}
    	$post_request = http_build_query($fields);
    	$cm = new CommonMethods();
    	$start_time = CommonToolsMethods::stopwatch();
    	$post_full_response = $cm->curl($post_url,$post_request);
		//print_r($post_full_response);
    	$time_end = CommonToolsMethods::stopwatch();
    	
    	preg_match("/<isValidPost>(.*)<\/isValidPost>/", $post_full_response, $success);
    	
    	//Set Post Rejection, For Testing Purpose Only.
    	//$success[1] = 'false';
    
    	if($success[1] == 'true'){
    		$post_status = '1';
    		preg_match("/<redirectURL>(.*)<\/redirectURL>/", $post_full_response, $redirect);
    		$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			//echo $redirect_url;
    		preg_match("/<Price>(.*)<\/Price>/msui",$post_full_response,$price);
    		$post_price=isset($price[1]) ? $price[1] : '';
    	}else{
    		$post_status = '0';
    		$post_price = '0';
    		$redirect_url = '';
    	}
		//print_r($success);
		//exit();
    
    	$post_time = ($time_end - $start_time);
    	
    	$post_responses['post_request'] = $post_request;
    	$post_responses['post_response'] = $post_full_response;
    	$post_responses['post_status'] = $post_status;
    	$post_responses['post_price'] = $post_price;
    	$post_responses['redirect_url'] = $redirect_url;
    	$post_responses['post_time'] = $post_time;
		//exit();
    	return $post_responses;
    }
}
?>
