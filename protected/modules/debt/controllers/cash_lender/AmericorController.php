<?php
class AmericorController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $domain_url = null) {
        // TOKEN REQUEST
        $cm = new CommonMethods();
        $token_request = [
            'username' => $p1 ?? 'username',
            'publicKey' => $p2 ?? 'publicKey',
        ];
        $ping_token = json_encode($token_request);
        $header = ["Content-Type: application/json"];
        $token_url = $domain_url.'/v1/authentication/token';
        $token_response = $cm->curl($token_url,$ping_token,$header);
        $token_result = json_decode($token_response,TRUE);
        // PING REQUEST
        $promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
        $OriginalUrl = Yii::app()->request->getParam('url');
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl',$OriginalUrl);
        $phone = Yii::app()->request->getParam('phone');
        $phone2 = Yii::app()->request->getParam('phone2');
        $fields = [
            "firstName"=>  Yii::app()->request->getParam('first_name'),
            "lastName"=>  Yii::app()->request->getParam('last_name'),
            "middleName"=> "",
            "phoneMobile"=> Yii::app()->request->getParam('phone'),
            "phoneHome"=>  ($phone2 == null or $phone2 == '' or $phone2 == 'null') ? $phone : $phone2,
            "email"=> Yii::app()->request->getParam('email'),
            "noEmail"=> false,
            "state"=> $city_state['state'],
            "ssn"=> Yii::app()->request->getParam('ssn'),
            "dob"=> Yii::app()->request->getParam('dob'),
            "address"=> Yii::app()->request->getParam('address'),
            "city"=> $city_state['city'],
            "zip"=> $zip_code,
            "mailingAddress"=> Yii::app()->request->getParam('address'),
            "mailingState"=> $city_state['state'],
            "mailingCity"=> $city_state['city'],
            "mailingZip"=>$zip_code,
            "externalSalesRepId"=> 12345,
            "accessCode"=> "CX67865676",
            "clientEstimatedDebt"=> Yii::app()->request->getParam('loan_amount'),
            "source"=> $promo_code,
            "leadOrigin"=> $OriginalUrl,
            "externalId"=> "018ebd24-306f-73d4-9b68-8a1066e66188"
        ];
        $purchase = true;
        $ping_url = $domain_url.'/v1/leads';
        $header = ["Authorization: Bearer ".$token_result['token']];
        if($purchase == true){
            $pingData['ping_request'] = json_encode($fields);
            $pingData['header'] = $header;
            $pingData['ping_url'] = $ping_url;
            return $pingData;
        }else{
            $pingData['ping_request'] = false;
            return $pingData;
        }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
    	$result = json_decode($ping_response,TRUE);
        if (isset($result['id']) && isset($result['uuid']) ) {
            $ping_price = isset($result['price']) ? $result['price'] : 0;
            $confirmation_id = $result['auth_code'];
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
    public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status) {
        $promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
        $OriginalUrl = Yii::app()->request->getParam('url');
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl',$OriginalUrl);
        $phone = Yii::app()->request->getParam('phone');
        $phone2 = Yii::app()->request->getParam('phone2');
        $fields = [
            "firstName"=>  Yii::app()->request->getParam('first_name'),
            "lastName"=>  Yii::app()->request->getParam('last_name'),
            "middleName"=> "",
            "phoneMobile"=> Yii::app()->request->getParam('phone'),
            "phoneHome"=>  ($phone2 == null or $phone2 == '' or $phone2 == 'null') ? $phone : $phone2,
            "email"=> Yii::app()->request->getParam('email'),
            "noEmail"=> false,
            "state"=> $city_state['state'],
            "ssn"=> Yii::app()->request->getParam('ssn'),
            "dob"=> Yii::app()->request->getParam('dob'),
            "address"=> Yii::app()->request->getParam('address'),
            "city"=> $city_state['city'],
            "zip"=> $zip_code,
            "mailingAddress"=> Yii::app()->request->getParam('address'),
            "mailingState"=> $city_state['state'],
            "mailingCity"=> $city_state['city'],
            "mailingZip"=>$zip_code,
            "externalSalesRepId"=> 12345,
            "accessCode"=> "CX67865676",
            "clientEstimatedDebt"=> Yii::app()->request->getParam('loan_amount'),
            "source"=> $promo_code,
            "leadOrigin"=> $OriginalUrl,
            "externalId"=> "018ebd24-306f-73d4-9b68-8a1066e66188"
        ];
        $post_request = json_encode($fields);
        //echo '<pre>';print_r($post_request);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        //$header = ["application/x-www-form-urlencoded"];
        $header = ["Content-Type: application/json"];
        $post_response = $cm->curl($post_url,$post_request,$header);
        $time_end = CommonToolsMethods::stopwatch();
        preg_match("/<Success>(.*)<\/Success>/", $post_response, $success);
        if(trim($success[1]) == 'true'){
            $post_status = '1';
            preg_match("/<Payout>(.*)<\/Payout>/msui",$post_response,$price);
            preg_match("/<Payout>(.*)<\/Payout>/msui", $ping_response, $ping_price );
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