<?php
class HSHDirectController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
            case '1':
                $mort_type = 'NEWHOME';
                break;
            case '2':
                $mort_type = 'REFI';
                break;
            case '3':
                $mort_type = 'HOMEEQ';
                break;
            case '4':
                $mort_type = 'REVERSE';
                break;
            default:
                $mort_type = 'REFI';
                break;          
        }
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        switch ($credit_rating) {
            case '1':
                $credit_rat = '0';
                break;
            case '2':
                $credit_rat = '1';
                break;
            case '3':
                $credit_rat = '2';
                break;
            case '4':
                $credit_rat = '3';
                break;        
            default:
                $credit_rat = '0';
                break;
        }
        $property_type = Yii::app()->request->getParam('property_use');
        switch ($property_type) {
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
                $prop_use = 'Primary Residence';
                break;
        }
        $property_desc = Yii::app()->request->getParam('property_desc');
        switch ($property_desc) {
            case '1':
                $prop_desc = '0';
                break;
            case '2':
                $prop_desc = '1';
                break;
            case '3':
                $prop_desc = '3';
                break;
            case '4':
                $prop_desc = '3';
                break;
            case '5':
                $prop_desc = '5';
                break;
            default:
                $prop_desc = '6';
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
        preg_match("/<lead_id>(.*)<\/lead_id>/msui",$ping_response,$confirmation_id);
        $zip_code = Yii::app()->request->getParam('zip');
        $zip_code = Yii::app()->request->getParam('property_zip',$zip_code);
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $TCPA_Consent = Yii::app()->request->getParam('tcpa_optin') == '0' ? 'No' : 'Yes';
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage');
        $second_balance = Yii::app()->request->getParam('second_balance',$property_value);
        $estimate_value = Yii::app()->request->getParam('estimate_value',$property_value);
        $additional_cash = Yii::app()->request->getParam('additional_cash');
        $down_payment = Yii::app()->request->getParam('down_payment');
        //$bankruptcyFlag = ['84 + months ago','Never in bankruptcy','73-84 months ago','61-72 months ago','49-60 months ago','37-48 months ago','25-36 months ago','13-24 months ago','1-12 months ago','Currently in bankruptcy'];
        // BECAUSE OF BANKRUPCY NOT ALLOWED IN LAST 5 YEARS
        $bankruptcyFlag = ['84 + months ago','Never in bankruptcy','73-84 months ago','61-72 months ago'];
        $bflag_key = array_rand($bankruptcyFlag);
        $purchase = true;
        /*$p2 = '13008';
        $p3 = 'HshTestAffiliate';*/
        if($mort_type == 'NEWHOME'){
            $AFN = 'EliteCashWire.com_LeadAPI_NewPurcahse_VA';
            $AF = '13347';
            $fields = array (
                'LoanType' => $mort_type,
                'longform' => 'y',
                'CreditRating' => $credit_rat,
                'PropState'=>Yii::app()->request->getParam('property_state',$city_state['state']),
                'PropUse' => $prop_use,
                'PropValue' => $property_value,
                'PropDesc' => $prop_desc,
                'Military'=>'No',
                'Foreclosure'=>Yii::app()->request->getParam('bank_foreclosure')=='1' ? 'In foreclosure':'No',
                'bankruptcyFlag_New' => Yii::app()->request->getParam('bankruptcy')=='1'?'Currently in bankruptcy':'Never in bankruptcy',
                'down_payment' => $down_payment,
                'Fname' => Yii::app()->request->getParam('first_name'),
                'Lname' => Yii::app()->request->getParam('last_name'),
                'Street' => Yii::app()->request->getParam('address'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => Yii::app()->request->getParam('property_state',$city_state['state']),
                'PostalCode' => Yii::app()->request->getParam('property_zip'),
                'Email' =>Yii::app()->request->getParam('email'),
                'HomePhone' =>Yii::app()->request->getParam('phone'),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid'),
                'AFN' => $AFN,
                'AF' => $AF,
                'WorkPhone' => Yii::app()->request->getParam('phone2'),
                'Dob' => date("m/d/Y",strtotime(Yii::app()->request->getParam('dob'))),
                'AFFID' => Yii::app()->request->getParam('promo_code'),
                'atrk'=>Yii::app()->session['affiliate_trans_id'],
                'ip_address'=>Yii::app()->request->getParam('ipaddress'),
                'useragent'=>Yii::app()->request->getParam('user_agent'),
            );
            $Username = 'EliteCashWire_2';
            $Password = 'ECW2HSH';
            $apitoken = '593b6f11155da943e0b87b53155845777a706e45';
            $post_response = '';
            if($loan_amount < '125000'){
                $post_response = 'loan amount should be more than $125,000';
                $purchase = false;
            }else if($credit_rat == '2' || $credit_rat == '3'){
                $post_response = 'Credit Rating only Good/Excellent Allowed';
                $purchase = false;
            }else if($ltv_percentage >= '100'){
                $post_response = 'Ltv should not be more than 100%';
                $purchase = false;
            }/*else if($prop_desc > '1'){
                $post_response = 'Only Single Family and Multi Family Allowed';
                $purchase = false;
            }*/
        }
        /*$Username = 'HshTestUser';
        $Password = 'Beh4uuwiJKwnm42wuIwplq4';
        $apitoken = 'kOG3tLcVN1SA5aXlS849Wb';*/
        $header = array("Authorization: Basic ".base64_encode($Username).":".base64_encode($Password)." Token ".base64_encode($apitoken));
        $pingData['ping_request'] = http_build_query($fields);
        $pingData['header'] = $header;
        return $pingData;
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        $success = explode('&', $ping_response);
		$price = explode('=', $success[1]);
		if(strtolower(trim($price[0]))=='commision'  && (int) trim($price[1])>0){
			$price = explode('=', $success[1]);
			$ping_price = isset($price[1]) ? $price[1] : 0;
			$confirmation_id = explode('=', $success[0]);
			$confirmation_id = $confirmation_id[1];
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
                $mort_type = 'NEWHOME';
                break;
            case '2':
                $mort_type = 'REFI';
                break;
            case '3':
                $mort_type = 'HOMEEQ';
                break;
            case '4':
                $mort_type = 'REVERSE';
                break;
            default:
                $mort_type = 'REFI';
                break;          
        }
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        switch ($credit_rating) {
            case '1':
                $credit_rat = '0';
                break;
            case '2':
                $credit_rat = '1';
                break;
            case '3':
                $credit_rat = '2';
                break;
            case '4':
                $credit_rat = '3';
                break;        
            default:
                $credit_rat = '0';
                break;
        }
        $property_type = Yii::app()->request->getParam('property_use');
        switch ($property_type) {
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
                $prop_use = 'Primary Residence';
                break;
        }
        $property_desc = Yii::app()->request->getParam('property_desc');
        switch ($property_desc) {
            case '1':
                $prop_desc = '0';
                break;
            case '2':
                $prop_desc = '1';
                break;
            case '3':
                $prop_desc = '3';
                break;
            case '4':
                $prop_desc = '3';
                break;
            case '5':
                $prop_desc = '5';
                break;
            default:
                $prop_desc = '6';
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
        preg_match("/<lead_id>(.*)<\/lead_id>/msui",$ping_response,$confirmation_id);
        $zip_code = Yii::app()->request->getParam('zip');
        $zip_code = Yii::app()->request->getParam('property_zip',$zip_code);
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $TCPA_Consent = Yii::app()->request->getParam('tcpa_optin') == '0' ? 'No' : 'Yes';
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage');
        $second_balance = Yii::app()->request->getParam('second_balance',$property_value);
        $estimate_value = Yii::app()->request->getParam('estimate_value',$property_value);
		$additional_cash = Yii::app()->request->getParam('additional_cash');
		$down_payment = Yii::app()->request->getParam('down_payment');
        //$bankruptcyFlag = ['84 + months ago','Never in bankruptcy','73-84 months ago','61-72 months ago','49-60 months ago','37-48 months ago','25-36 months ago','13-24 months ago','1-12 months ago','Currently in bankruptcy'];
        // BECAUSE OF BANKRUPCY NOT ALLOWED IN LAST 5 YEARS
        $bankruptcyFlag = ['84 + months ago','Never in bankruptcy','73-84 months ago','61-72 months ago'];
        $bflag_key = array_rand($bankruptcyFlag);
        $purchase = true;
        /*$p2 = '13008';
        $p3 = 'HshTestAffiliate';*/
        if($mort_type == 'NEWHOME'){
            $AFN = 'EliteCashWire.com_LeadAPI_NewPurcahse_VA';
            $AF = '13347';
            $fields = array (
                'LoanType' => $mort_type,
                'longform' => 'y',
                'CreditRating' => $credit_rat,
                'PropState'=>Yii::app()->request->getParam('property_state',$city_state['state']),
                'PropUse' => $prop_use,
                'PropValue' => $property_value,
                'PropDesc' => $prop_desc,
                'Military'=>'No',
                'Foreclosure'=>Yii::app()->request->getParam('bank_foreclosure')=='1' ? 'In foreclosure':'No',
                'bankruptcyFlag_New' => Yii::app()->request->getParam('bankruptcy')=='1'?'Currently in bankruptcy':'Never in bankruptcy',
                'down_payment' => $down_payment,
                'Fname' => Yii::app()->request->getParam('first_name'),
                'Lname' => Yii::app()->request->getParam('last_name'),
                'Street' => Yii::app()->request->getParam('address'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => Yii::app()->request->getParam('property_state',$city_state['state']),
                'PostalCode' => Yii::app()->request->getParam('property_zip'),
                'Email' =>Yii::app()->request->getParam('email'),
                'HomePhone' =>Yii::app()->request->getParam('phone'),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid'),
                'AFN' => $AFN,
                'AF' => $AF,
                'WorkPhone' => Yii::app()->request->getParam('phone2'),
                'Dob' => date("m/d/Y",strtotime(Yii::app()->request->getParam('dob'))),
                'AFFID' => Yii::app()->request->getParam('promo_code'),
				'atrk'=>Yii::app()->session['affiliate_trans_id'],
				'ip_address'=>Yii::app()->request->getParam('ipaddress'),
				'useragent'=>Yii::app()->request->getParam('user_agent'),
            );
            $Username = 'EliteCashWire_2';
            $Password = 'ECW2HSH';
            $apitoken = '593b6f11155da943e0b87b53155845777a706e45';
            $post_response = '';
            if($loan_amount < '125000'){
                $post_response = 'loan amount should be more than $125,000';
                $purchase = false;
            }else if($credit_rat == '2' || $credit_rat == '3'){
                $post_response = 'Credit Rating only Good/Excellent Allowed';
                $purchase = false;
            }else if($ltv_percentage >= '100'){
                $post_response = 'Ltv should not be more than 100%';
                $purchase = false;
            }/*else if($prop_desc > '1'){
                $post_response = 'Only Single Family and Multi Family Allowed';
                $purchase = false;
            }*/
        }else if($mort_type == 'REFI'){
            $AFN = 'EliteCashWire.com_LeadAPI';
            $AF = '13283';
            $fields = array (
                'LoanType' => $mort_type,
                'longform' => 'y',
                'CreditRating' => $credit_rat,
                'PropUse' => $prop_use,
                'PropDesc' => $prop_desc,
                'PropValue' => $property_value,
                'PropState'=>Yii::app()->request->getParam('property_state',$city_state['state']),
                'Military'=>'No',
                'down_payment' => $down_payment,
                'PropZip' =>Yii::app()->request->getParam('property_zip',$zip_code),
                'bankruptcyFlag_New' => Yii::app()->request->getParam('bankruptcy')=='1'?'Currently in bankruptcy':'Never in bankruptcy',
                'Foreclosure'=>Yii::app()->request->getParam('bank_foreclosure')=='1' ? 'In foreclosure':'No',
                'MortBalance1' => Yii::app()->request->getParam('first_balance'),
                'SecMortgage' => Yii::app()->request->getParam('second_balance')>'0'?'Yes':'No',
                'MortBalance2' => Yii::app()->request->getParam('second_balance'),
                'Fname' => Yii::app()->request->getParam('first_name'),
                'Lname' => Yii::app()->request->getParam('last_name'),
                'Street' => Yii::app()->request->getParam('address'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => Yii::app()->request->getParam('property_state',$city_state['state']),
                'PostalCode' => Yii::app()->request->getParam('property_zip'),
                'Email' =>Yii::app()->request->getParam('email'),
                'HomePhone' =>Yii::app()->request->getParam('phone'),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid'),
                'AFN' => $AFN,
                'AF' => $AF,
                'WorkPhone' => Yii::app()->request->getParam('phone2'),
                'Dob' => date("m/d/Y",strtotime(Yii::app()->request->getParam('dob'))),
                'CashOut' => $additional_cash,
                'VaLoan' => 'No',
                'FhaLoan' => 'No',
                'AFFID' => Yii::app()->request->getParam('promo_code'),
				'atrk'=>Yii::app()->session['affiliate_trans_id'],
				'ip_address'=>Yii::app()->request->getParam('ipaddress'),
				'useragent'=>Yii::app()->request->getParam('user_agent'),
            );
            $post_response = '';
            if($loan_amount < '150000'){
                $post_response = 'loan amount should be more than $150,000';
                $purchase = false;
            }else if($credit_rat == '2' || $credit_rat == '3'){
                $post_response = 'Credit Rating only Good/Excellent Allowed';
                $purchase = false;
            }else if($ltv_percentage >= '90'){
                $post_response = 'Ltv should not be more than 90%';
                $purchase = false;
            }else if($prop_desc > '1'){
                $post_response = 'Only Single Family and Multi Family Allowed';
                $purchase = false;
            }
            $Username = 'EliteCashWire';
            $Password = 'ECW2HSH';
            $apitoken = 'de036c864ef48b949c160ee5230d47b99cedf8ef';
        }
        /*$Username = 'HshTestUser';
        $Password = 'Beh4uuwiJKwnm42wuIwplq4';
        $apitoken = 'kOG3tLcVN1SA5aXlS849Wb';*/
        $header = array("Authorization: Basic ".base64_encode($Username).":".base64_encode($Password)." Token ".base64_encode($apitoken));
		$post_request = http_build_query($fields);
        if($purchase == true){
            $cm = new CommonMethods();
            $start_time = CommonToolsMethods::stopwatch();
            $post_response = $cm->curl($post_url, $post_request,$header);
            $time_end = CommonToolsMethods::stopwatch();
            $post_response = html_entity_decode($post_response);
        }
        $success = explode('&', $post_response);
        $success = explode('&', $post_response);
        if(isset($success[2])  && trim($success[2])=='Status=Success'){
            $post_status = '1';
            $price = explode('=', $success[1]);
            $post_price = isset($price[1]) ? $price[1] : $ping_price[1];
        }else{
            $post_status = '0';
            $post_price = '0';
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