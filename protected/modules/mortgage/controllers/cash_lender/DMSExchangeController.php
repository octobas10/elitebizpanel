<?php
class DMSExchangeController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $purchase = true;
        $sub1 = Yii::app()->request->getParam('promo_code');
        $sub2 = Yii::app()->request->getParam('sub_id');
        $promo_code = Yii::app()->request->getParam('promo_code');
        $pingData = [];
        $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
            case '1':
                $mort_type = 'New Purchase';
                break;
            case '2':
                $mort_type = 'Refinance';
                break;
            case '3':
                $mort_type = 'PURC';
                break;
            case '4':
                $mort_type = 'PURC';
                break;        
            default:
                $mort_type = 'NA';
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
                $credit_rat = 'Average';
                break;
        }
        $property_use = Yii::app()->request->getParam('property_use');
        switch ($property_use) {
            case '1':
                $prop_use = 'Primary Residence';
                break;
            case '2':
                $prop_use = 'Secondary Home';
                break;
            case '3':
                $prop_use = 'Investment Property';
                break;    
            default:
                $prop_use = 'Conventional';
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
                $prop_desc = 'Cooperative';
                break;
            case '4':
                $prop_desc = 'Condom';
                break;
            case '5':
                $prop_desc = 'Mobile Manufactured';
                break;
            default:
                $prop_desc = 'Other';
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
        $second_interest_rate = Yii::app()->request->getParam('second_interest_rate');
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $TCPA_Consent = Yii::app()->request->getParam('tcpa_optin') == '0' ? 'No' : 'Yes';
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $va_loan = Yii::app()->request->getParam('va_loan') == 1 ? 'true' : 'false';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage',rand(3,9));
        $state = Yii::app()->request->getParam('property_state',$city_state['state']);
        $estimated_home_value = Yii::app()->request->getParam('estimate_value');
        $current_interest_rate = Yii::app()->request->getParam('first_interest_rate');
        $num_mortgage_lates = Yii::app()->request->getParam('num_mortgage_lates');
        $dob_year = date('Y',strtotime(Yii::app()->request->getParam('dob')));
        $dob_month = date('m',strtotime(Yii::app()->request->getParam('dob')));
        $dob_day = date('d',strtotime(Yii::app()->request->getParam('dob')));
        if($Mortgage_Type == '2' || $Mortgage_Type == '3' || $Mortgage_Type == '4'){
            $fields = [
                'ip' => Yii::app()->request->getParam('ipaddress'),
                'url_consent' => Yii::app()->request->getParam('url','https://mortgagefinder.com'),
                'consent_time' => date('y-m-d h:m:s'),
                'type_of_loan'=> $mort_type,
                'credit_score' => $credit_rat,
                'home_value' => $estimated_home_value,
                'amount_of_loan' => Yii::app()->request->getParam('loan_amount'),
                'zipcode' => $zip_code,
                'city' => Yii::app()->request->getParam('city',$city_state['city']),
                'state' => Yii::app()->request->getParam('state',$city_state['state']),
                'jornayaleadid' => Yii::app()->request->getParam('universal_leadid'),
                'current_va' => $va_loan,
                'cash_out_request' => Yii::app()->request->getParam('additional_cash'),
                'best_time' => 'Anytime',
                'property_description' => $prop_desc,
                'current_interest_rate' => Yii::app()->request->getParam('first_interest_rate'),
                'use_of_loan' => $prop_use,
                'num_mortgage_lates'=> $num_mortgage_lates,
                'dob_month' => $dob_month,
                'dob_day' => $dob_day,
                'dob_year' => $dob_year,
                'xx_trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
                'ltv' => Yii::app()->request->getParam('ltv_percentage'),
                'sub1' => $sub1,
                'sub2' => $sub2,
            ];
            $accepted_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type);
            $state_included = ['AZ','CA','CO','FL','MI','MN','NC','NJ','NV','OR','TN','UT','VA'];
            if(!in_array($state,$state_included)){
                $ping_response = $state .' Not Allowed';
                $purchase = false;
            }else if($accepted_cap_count > 50){
                $ping_response = 'Daily Cap 50 Met:'.$Mortgage_Type;
                $purchase = false;
            }else if($loan_amount < 50000 OR $loan_amount > 300000){
                $ping_response = 'loan amount should be between $50,000 and $300,000-- '.$loan_amount;
                $purchase = false;
            }else if($credit_rating > '2'){
                $ping_response = 'Credit Rating only Good/Excellent Allowed';
                $purchase = false;
            }else if($ltv_percentage > '55'){
                $ping_response = 'Ltv should not be more than 55%';
                $purchase = false;
            }else if($estimated_home_value < '400000'){
                $ping_response = 'Home Value must be more than 400K';
                $purchase = false;
            }else if(date('l')=='Saturday' || date('l')=='Sunday'){
                $ping_response = 'No Weekends and Between 9am 5pm PST';
                $purchase = false;
            }
        }
        if($purchase == true){
            $pingData['ping_request'] = http_build_query($fields);
        }else{
            $pingData['ping_request'] = false;
        }
        return $pingData;

    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        $success = json_decode($ping_response,TRUE);
        if(trim($success['status']) == 'accepted'){
            $ping_price = isset($success['payout']) ? $success['payout'] : 0;
            $confirmation_id = $success['resvcode'];
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
        $purchase = true;
        $class_name =  str_replace('Controller','',get_class());
        $sub1 = Yii::app()->request->getParam('promo_code');
        $sub2 = Yii::app()->request->getParam('sub_id');
        $promo_code = Yii::app()->request->getParam('promo_code');
        $pingData = [];
        $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
                case '1':
                    $mort_type = 'New Purchase';
                    break;
                case '2':
                    $mort_type = 'REFI';
                    break;
                case '3':
                    $mort_type = 'PURC';
                    break;
                case '4':
                    $mort_type = 'PURC';
                    break;        
                default:
                    $mort_type = 'NA';
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
                    $credit_rat = 'Average';
                    break;
            }
            $property_use = Yii::app()->request->getParam('property_use');
            switch ($property_use) {
                case '1':
                    $prop_use = 'Primary Residence';
                    break;
                case '2':
                    $prop_use = 'Secondary Home';
                    break;
                case '3':
                    $prop_use = 'Investment Property';
                    break;    
                default:
                    $prop_use = 'Conventional';
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
                    $prop_desc = 'Cooperative';
                    break;
                case '4':
                    $prop_desc = 'Condom';
                    break;
                case '5':
                    $prop_desc = 'Mobile Manufactured';
                    break;
                default:
                    $prop_desc = 'Other';
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
            $second_interest_rate = Yii::app()->request->getParam('second_interest_rate');
            $submission_model = new Submissions();
            $zip_code = Yii::app()->request->getParam('zip');
            $city_state = $submission_model->getCityStateFromZip($zip_code);
            $TCPA_Consent = Yii::app()->request->getParam('tcpa_optin') == '0' ? 'No' : 'Yes';
            $loan_amount = Yii::app()->request->getParam('loan_amount');
            $property_value = Yii::app()->request->getParam('property_value');
            $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
            $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
            $va_loan = Yii::app()->request->getParam('va_loan') == 1 ? 'true' : 'false';
            $ltv_percentage = Yii::app()->request->getParam('ltv_percentage',rand(3,9));
            $state = Yii::app()->request->getParam('property_state',$city_state['state']);
            $estimated_home_value = Yii::app()->request->getParam('estimate_value');
            $current_interest_rate = Yii::app()->request->getParam('first_interest_rate');
            $num_mortgage_lates = Yii::app()->request->getParam('num_mortgage_lates');
            $dob_year = date('Y',strtotime(Yii::app()->request->getParam('dob')));
            $dob_month = date('m',strtotime(Yii::app()->request->getParam('dob')));
            $dob_day = date('d',strtotime(Yii::app()->request->getParam('dob')));
            if($Mortgage_Type == '2'){
                $tier15_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'15.000');  
                if($tier15_cap_count > 15){
                    $post_response = 'Daily Cap 15 Met:'.$Mortgage_Type;
                    $purchase = false;
                }else if($loan_amount < 125000){
                    $post_response = 'Loan amount should be between $125,000 You sent :  '.$loan_amount;
                    $purchase = false;
                }else if($credit_rating > '3'){
                    $post_response = 'Credit Rating only Good/Excellent/Average Allowed';
                    $purchase = false;
                }else if($ltv_percentage > '85'){
                    $post_response = 'Ltv should not be more than 5%';
                    $purchase = false;
                }
            }else if($Mortgage_Type == '1' || $Mortgage_Type == '3' || $Mortgage_Type == '4'){
                $accepted_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type);
                $state_included = ['AZ','CA','CO','FL','MI','MN','NC','NJ','NV','OR','TN','UT','VA'];
                if(!in_array($state,$state_included)){
                    $post_response = $state .' Not Allowed';
                    $purchase = false;
                }else if($accepted_cap_count > 50){
                    $post_response = 'Daily Cap 50 Met:'.$Mortgage_Type;
                    $purchase = false;
                }else if($loan_amount < 50000 OR $loan_amount > 300000){
                    $post_response = 'loan amount should be between $50,000 and $300,00-- '.$loan_amount;
                    $purchase = false;
                }else if($credit_rating > '2'){
                    $post_response = 'Credit Rating only Good/Excellent Allowed';
                    $purchase = false;
                }else if($ltv_percentage > '55'){
                    $post_response = 'Ltv should not be more than 55%';
                    $purchase = false;
                }else if($estimated_home_value < '400000'){
                    $post_response = 'Home Value must be more than 400K';
                    $purchase = false;
                }else if(date('l')=='Saturday' || date('l')=='Sunday'){
                    $post_response = 'No Weekends and Between 9am 5pm PST';
                    $purchase = false;
                }
                // ADDED HERE TO RESTRICT ALL OTHER TYPES OTHER THAN REFI, REMOVE BELOW LINE WHEN YOU WANT TO ACTIVATE  1,3,4 TYPES
                $purchase = false;
            }
            $success = json_decode($ping_response,TRUE);
            $confirmation_id = $success['resvcode'];
            $fields = [
                'resvcode' => $confirmation_id,
                'firstname' => Yii::app()->request->getParam('first_name'),
                'lastname' => Yii::app()->request->getParam('last_name'),
                'zipcode' => $zip_code,
                'phone' => Yii::app()->request->getParam('phone'),
                'email' => Yii::app()->request->getParam('email'),
                'ip' => Yii::app()->request->getParam('ipaddress'),
                'url_consent' => Yii::app()->request->getParam('tcpa_optin','1'),
                'consent_time' => date('y-m-d h:m:s'),
                'type_of_loan'=> $mort_type,
                'credit_score' => $credit_rat,
                'home_value' => $estimated_home_value,
                'amount_of_loan' => Yii::app()->request->getParam('loan_amount'),
                'address1' => Yii::app()->request->getParam('address'),
                'city' => Yii::app()->request->getParam('city',$city_state['city']),
                'state' => Yii::app()->request->getParam('state',$city_state['state']),
                'jornayaleadid' => Yii::app()->request->getParam('universal_leadid'),
                'current_va' => $va_loan,
                'cash_out_request' => Yii::app()->request->getParam('additional_cash'),
                'best_time' => 'Anytime',
                'property_description' => $prop_desc,
                'current_interest_rate' => Yii::app()->request->getParam('first_interest_rate'),
                'use_of_loan' => $prop_use,
                'num_mortgage_lates'=> $num_mortgage_lates,
                'dob_month' => $dob_month,
                'dob_day' => $dob_day,
                'dob_year' => $dob_year,
                'xx_trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
                'ltv' => Yii::app()->request->getParam('ltv_percentage'),
                'sub1' => $sub1,
                'sub2' => $sub2,
                'utm_campaign' => $sub1, 
            ];
            $post_response = '';
            if($purchase == true){
                $post_request = http_build_query($fields);
                $cm = new CommonMethods();
                $start_time = CommonToolsMethods::stopwatch();
                $post_response = $cm->curl($post_url, $post_request);
                $time_end = CommonToolsMethods::stopwatch();
                $post_response = html_entity_decode($post_response);
            }
            $result = json_decode($post_response,TRUE);
            if(trim($result['status']) == 'accepted'){
                $post_status = '1';
                $ping_price = isset($success['payout']) ? $success['payout'] : 0;
                $post_price = isset($result['payout']) ? $result['payout'] : 0;
                $post_price = isset($ping_price) ? $ping_price : $post_price;
                $redirect_url = '';
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