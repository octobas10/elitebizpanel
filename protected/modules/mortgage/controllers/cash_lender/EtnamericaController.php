<?php

class EtnamericaController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$pingData = [];
        $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
            case '1':
                $mort_type = 'New purchase';
                break;
            case '2':
                $mort_type = 'Rate/Term';
                break;
            case '3':
                $mort_type = 'Not Sure';
                break;
            case '4':
                $mort_type = 'Reverse';
                break;        
            default:
                $mort_type = 'Cashout';
                break;
        }
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        switch ($credit_rating) {
            case '1':
                $credit_rat = 'Excellent';
                break;
            case '2':
                $credit_rat = 'Good';
                break;
            case '3':
                $credit_rat = 'Fair';
                break;
            case '4':
                $credit_rat = 'Poor';
                break;        
            default:
                $credit_rat = 'Good';
                break;
        }
        $property_type = Yii::app()->request->getParam('property_use');
        switch ($property_type) {
            case '1':
                $prop_use = 'Single Family Residence';
                break;
            case '2':
                $prop_use = 'Condo';
                break;
            case '3':
                $prop_use = 'Townhouse';
                break;    
            default:
                $prop_use = 'Multi Family';
                break;
        }
        $property_desc = Yii::app()->request->getParam('property_desc');
        switch ($property_desc) {
            case '1':
                $prop_desc = 'Single Family';
                break;
            case '2':
                $prop_desc = 'Multi Family';
                break;
            case '3':
                $prop_desc = 'Town House';
                break;
            case '4':
                $prop_desc = 'Condominium';
                break;
            case '5':
                $prop_desc = 'Mobile Home';
                break;
            default:
                $prop_desc = 'Single Family';
                break;
        }
        $rate_type = Yii::app()->request->getParam('rate_type');
        switch ($rate_type) {
            case '1':
                $r_type = 'Fixed';
                break;
            case '2':
                $r_type = 'Adjustable';
                break;
            case '3':
                $r_type = 'Fixed/Adjustable';
                break;
            default:
                $r_type = 'Fixed';
                break;
        }
        $first_interest_rate = Yii::app()->request->getParam('first_interest_rate');
        if($first_interest_rate>=0 and $first_interest_rate>=2){
            $fir = '1.0-2.0';
        }else if($first_interest_rate>2 and $first_interest_rate>=3){
            $fir = '2.1-3.0';
        }else if($first_interest_rate>3 and $first_interest_rate>=4){
            $fir = '3.1-4.0';
        }else if($first_interest_rate>4 and $first_interest_rate>=5){
             $fir = '4.1-5.0';
        }else{
             $fir = '5.1+';
        }
        $second_interest_rate = Yii::app()->request->getParam('second_interest_rate');
        if($second_interest_rate>=0 and $second_interest_rate>=2){
            $sir = '1.0-2.0';
        }else if($second_interest_rate>2 and $second_interest_rate>=3){
            $sir = '2.1-3.0';
        }else if($second_interest_rate>3 and $second_interest_rate>=4){
            $sir = '3.1-4.0';
        }else if($second_interest_rate>4 and $second_interest_rate>=5){
             $sir = '4.1-5.0';
        }else{
             $sir = '5.1+';
        }
       
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $TCPA_Consent = Yii::app()->request->getParam('tcpa_optin') == '0' ? 'No' : 'Yes';
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage',rand(3,9));
        $State = Yii::app()->request->getParam('property_state',$city_state['state']);
		$fields = [
            'lp_campaign_id' => $p1 ? $p1 : '63987f88d3742',
            'lp_campaign_key' => $p2 ? $p2 : 'L4tQbVvjXDB2kH6YW8TC',
            //'lp_test' => '1',
            'lp_s1' => Yii::app()->request->getParam('sub_id'),
            'lp_response' => 'XML',
            'lp_ping_id' => '',
            'first_name' => Yii::app()->request->getParam('first_name'),
            'last_name' => Yii::app()->request->getParam('last_name'),
            'phone_home' => Yii::app()->request->getParam('phone'),
            'phone_cell' => Yii::app()->request->getParam('phone2'),
            'phone_work' => Yii::app()->request->getParam('phone2'),
            'address' => Yii::app()->request->getParam('address'),
            'city' => $city_state['city'],
            'state' => $State,
            'zip_code' => $zip_code,
            'email_address' => Yii::app()->request->getParam('email'),
            'dob' => Yii::app()->request->getParam('dob'),
            'ip_address' => Yii::app()->request->getParam('ipaddress'),
            'tcpa_consent' => Yii::app()->request->getParam('tcpa_optin')==1?'Yes':'No',
            'tcpa_language' => Yii::app()->request->getParam('tcpa_text'),
            'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
            'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
            'user_agent' => Yii::app()->request->getParam('user_agent'),
            'mortgage_type' => $mort_type,
            'credit_rating' => $credit_rat,
            'property_type' => $prop_use,
            'loan_amount' => $loan_amount,
            'property_value' => $property_value,
            'employment_status' => 'Employed',
            'bankruptcy' => Yii::app()->request->getParam('bankruptcy')==1?'yes':'no',
            'loan_type' => 'FHA',
            'first_mortgage_balance' => Yii::app()->request->getParam('first_balance'),
            'first_mortgage_rate' => $first_interest_rate,
            //'landing_page_url' => Yii::app()->request->getParam('url','https://elitemortgagefinder.com'),
            'landing_page_url' => 'https://elitemortgagefinder.com',
        ];
		$pingData['ping_request'] = http_build_query($fields);
		return $pingData;
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<result>(.*)<\/result>/", $ping_response, $success);
        if(trim($success[1]) == 'success'){
            preg_match("/<price>(.*)<\/price>/msui", $ping_response, $price);
            preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response, $confirmation_id);
            $ping_price = isset($price[1]) ? $price[1] : 0;
            $confirmation_id = $confirmation_id [1];
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
	    $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
            case '1':
                $mort_type = 'New purchase';
                break;
            case '2':
                $mort_type = 'Rate/Term';
                break;
            case '3':
                $mort_type = 'Not Sure';
                break;
            case '4':
                $mort_type = 'Reverse';
                break;        
            default:
                $mort_type = 'New purchase';
                break;
        }
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        switch ($credit_rating) {
            case '1':
                $credit_rat = 'Excellent';
                break;
            case '2':
                $credit_rat = 'Good';
                break;
            case '3':
                $credit_rat = 'Fair';
                break;
            case '4':
                $credit_rat = 'Poor';
                break;        
            default:
                $credit_rat = 'Good';
                break;
        }
        $property_type = Yii::app()->request->getParam('property_use');
        switch ($property_type) {
            case '1':
                $prop_use = 'Single Family Residence';
                break;
            case '2':
                $prop_use = 'Condo';
                break;
            case '3':
                $prop_use = 'Townhouse';
                break;    
            default:
                $prop_use = 'Multi Family';
                break;
        }
        $property_desc = Yii::app()->request->getParam('property_desc');
        switch ($property_desc) {
            case '1':
                $prop_desc = 'Single Family';
                break;
            case '2':
                $prop_desc = 'Multi Family';
                break;
            case '3':
                $prop_desc = 'Town House';
                break;
            case '4':
                $prop_desc = 'Condominium';
                break;
            case '5':
                $prop_desc = 'Mobile Home';
                break;
            default:
                $prop_desc = 'Single Family';
                break;
        }
        $rate_type = Yii::app()->request->getParam('rate_type');
        switch ($rate_type) {
            case '1':
                $r_type = 'Fixed';
                break;
            case '2':
                $r_type = 'Adjustable';
                break;
            case '3':
                $r_type = 'Fixed/Adjustable';
                break;
            default:
                $r_type = 'Fixed';
                break;
        }
        $first_interest_rate = Yii::app()->request->getParam('first_interest_rate');
        if($first_interest_rate>=0 and $first_interest_rate>=2){
            $fir = '1.0-2.0';
        }else if($first_interest_rate>2 and $first_interest_rate>=3){
            $fir = '2.1-3.0';
        }else if($first_interest_rate>3 and $first_interest_rate>=4){
            $fir = '3.1-4.0';
        }else if($first_interest_rate>4 and $first_interest_rate>=5){
             $fir = '4.1-5.0';
        }else{
             $fir = '5.1+';
        }
        $second_interest_rate = Yii::app()->request->getParam('second_interest_rate');
        if($second_interest_rate>=0 and $second_interest_rate>=2){
            $sir = '1.0-2.0';
        }else if($second_interest_rate>2 and $second_interest_rate>=3){
            $sir = '2.1-3.0';
        }else if($second_interest_rate>3 and $second_interest_rate>=4){
            $sir = '3.1-4.0';
        }else if($second_interest_rate>4 and $second_interest_rate>=5){
             $sir = '4.1-5.0';
        }else{
             $sir = '5.1+';
        }
        preg_match("/<ping_id>(.*)<\/ping_id>/msui",$ping_response,$confirmation_id);
        $zip_code = Yii::app()->request->getParam('zip');
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $TCPA_Consent = Yii::app()->request->getParam('tcpa_optin') == '0' ? 'No' : 'Yes';
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage',rand(3,9));
        $second_balance = Yii::app()->request->getParam('second_balance',$property_value);
        $State = Yii::app()->request->getParam('property_state',$city_state['state']);
        $fields = [
            'lp_campaign_id' => $p1 ? $p1 : '63987f88d3742',
            'lp_campaign_key' => $p2 ? $p2 : 'L4tQbVvjXDB2kH6YW8TC',
            //'lp_test' => '1',
            'lp_s1' => Yii::app()->request->getParam('sub_id'),
            'lp_response' => 'XML',
            'lp_ping_id' => $confirmation_id[1],
            'first_name' => Yii::app()->request->getParam('first_name'),
            'last_name' => Yii::app()->request->getParam('last_name'),
            'phone_home' => Yii::app()->request->getParam('phone'),
            'phone_cell' => Yii::app()->request->getParam('phone2'),
            'phone_work' => Yii::app()->request->getParam('phone2'),
            'address' => Yii::app()->request->getParam('address'),
            'city' => $city_state['city'],
            'state' => $State,
            'zip_code' => $zip_code,
            'email_address' => Yii::app()->request->getParam('email'),
            'dob' => Yii::app()->request->getParam('dob'),
            'ip_address' => Yii::app()->request->getParam('ipaddress'),
            'tcpa_consent' => Yii::app()->request->getParam('tcpa_optin')==1?'Yes':'No',
            'tcpa_language' => Yii::app()->request->getParam('tcpa_text'),
            'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
            'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
            'user_agent' => Yii::app()->request->getParam('user_agent'),
            'mortgage_type' => $mort_type,
            'credit_rating' => $credit_rat,
            'property_type' => $prop_use,
            'loan_amount' => $loan_amount,
            'property_value' => $property_value,
            'employment_status' => 'Employed',
            'bankruptcy' => Yii::app()->request->getParam('bankruptcy')==1?'Yes':'No',
            'loan_type' => 'FHA',
            'first_mortgage_balance' => Yii::app()->request->getParam('first_balance'),
            'first_mortgage_rate' => $first_interest_rate,
            //'landing_page_url' => Yii::app()->request->getParam('url','https://elitemortgagefinder.com/'),
            'landing_page_url' => 'https://elitemortgagefinder.com',
        ];
		//echo '<pre>';print_r($fields);die();
		$post_request = http_build_query($fields);
		//echo '<pre>';print_r($post_request);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_response = $cm->curl($post_url, $post_request);
		$time_end = CommonToolsMethods::stopwatch();
        $post_response = html_entity_decode($post_response);
		//echo '<pre>';print_r();die();
		preg_match("/<result>(.*)<\/result>/", $post_response, $success);
        if(trim($success[1]) == 'success'){
            $post_status = '1';
            preg_match("/<price>(.*)<\/price>/msui",$post_response,$price);
            preg_match("/<price>(.*)<\/price>/msui", $ping_response, $ping_price );
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
		//echo '<pre>';print_r($post_responses);die();
		return $post_responses;
    }
}
