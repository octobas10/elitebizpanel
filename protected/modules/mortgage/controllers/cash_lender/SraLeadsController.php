<?php

class SraLeadsController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		if($promo_code != 8){
			$pingData = array();
            $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
            switch ($Mortgage_Type) {
                case '1':
                    $mort_type = 'New Purchase';
                    break;
                case '2':
                    $mort_type = 'Refinance';
                    break;
                case '3':
                    $mort_type = 'Home Equity Loan';
                    break;
                case '4':
                    $mort_type = 'Reverse Mortgage';
                    break;        
                default:
                    $mort_type = 'New Purchase';
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
                    $prop_use = 'Primary Residence';
                    break;
                case '2':
                    $prop_use = 'Second Home';
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
                    $r_type = 'Adjustable';
                    break;
                default:
                    $r_type = 'Fixed';
                    break;
            }
            $email = Yii::app()->request->getParam('email');
            $email_domain = substr(strrchr($email, "@"), 1);
            $submission_model = new Submissions();
            $zip_code = Yii::app()->request->getParam('zip');
            $city_state = $submission_model->getCityStateFromZip($zip_code);
			$fields = array(
				'Lead.LeadTypeId' => $p1?$p1 : '6',
				'Source.Key' => $p2?$p2:'AD576BFD-D9CB-4325-B170-774BDEA68A39',
				'Source.Token' => $p3?$p3:'C4CA4370-042D-48F1-9F7F-E4279344E3E6',
                'Lead.Zip' => $zip_code,
				'Lead.City' => $city_state['city'],
				'Lead.State' =>  $city_state['state'],
				'Lead.Email' => $email,
				'Lead.Homephone' => Yii::app()->request->getParam('phone'),
				'Lead.Workphone' => Yii::app()->request->getParam('phone2'),
				'Attributes.HouseType' => $prop_use,
				'Attributes.LoanType' => $loan_type,
				'Attributes.HouseValue' =>  Yii::app()->request->getParam('estimate_value'),
				'Attributes.LoanAmount' => Yii::app()->request->getParam('loan_amount'),
				'Attributes.LTV' =>  Yii::app()->request->getParam('ltv_percentage'),
				'Attributes.CreditScore' =>  $credit_rat,
				'Attributes.Military' =>  'No',
				'Attributes.InterestRate' =>  Yii::app()->request->getParam('first_interest_rate'),
				'Attributes.InterestRateType' =>  $r_type,
				//======================================================================
                'Attributes.EmailDomain' => $email_domain,
                'Attributes.IPaddress' => Yii::app()->request->getParam('ipaddress'),
                'Attributes.ULeadId' =>  Yii::app()->request->getParam('universal_leadid'),
                'Attributes.xxTrustedFormCertUrl' => Yii::app()->request->getParam('url'),
                'Attributes.BornOn' => Yii::app()->request->getParam('dob'),
                'Attributes.SubID' => Yii::app()->request->getParam('sub_id', '0'),
                'Attributes.UserAgent' =>  Yii::app()->request->getParam('user_agent'),
                'Attributes.PartnerLeadId' =>  '',
                'Attributes.LandingPage' =>  Yii::app()->request->getParam('url'),
                'Attributes.ConsentText' =>  Yii::app()->request->getParam('tcpa_text'),
			);
			$pingData['ping_request'] = http_build_query($fields);
			return $pingData;
	    }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<Success>(.*)<\/Success>/msui", $ping_response, $result);
        if (trim($result[1]) == 'true' || trim($result[0]) == 'true') {
            preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $price);
            preg_match("/<ID>(.*)<\/ID>/msui", $ping_response, $confirmation_id);
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

	    $credit_rating = Yii::app()->request->getParam('mortgage_lead_type');
        $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
            case '1':
                $mort_type = 'New Purchase';
                break;
            case '2':
                $mort_type = 'Refinance';
                break;
            case '3':
                $mort_type = 'Home Equity Loan';
                break;
            case '4':
                $mort_type = 'Reverse Mortgage';
                break;        
            default:
                $mort_type = 'New Purchase';
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
                $prop_use = 'Primary Residence';
                break;
            case '2':
                $prop_use = 'Second Home';
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
                $r_type = 'Adjustable';
                break;
            default:
                $r_type = 'Fixed';
                break;
        }
        $email = Yii::app()->request->getParam('email');
        $email_domain = substr(strrchr($email, "@"), 1);
        preg_match("/<Confirmation>(.*)<\/Confirmation>/msui", $ping_response, $confirmation_id);
        $zip_code = Yii::app()->request->getParam('zip');
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        preg_match("/<ID>(.*)<\/ID>/msui", $ping_response, $confirmation_id);
        $fields = array(
            'Lead.LeadTypeId' => $p1?$p1 : '6',
            'TXID' => $confirmation_id[1],
            'Source.Key' => $p2?$p2:'AD576BFD-D9CB-4325-B170-774BDEA68A39',
            'Source.Token' => $p3?$p3:'C4CA4370-042D-48F1-9F7F-E4279344E3E6',
            'Lead.Zip' => $zip_code,
            'Lead.FirstName' => Yii::app()->request->getParam('first_name'),
            'Lead.LastName' => Yii::app()->request->getParam('last_name'),
            'Lead.Address' => Yii::app()->request->getParam('address'),
            'Lead.Address2' => Yii::app()->request->getParam('address2'),
            'Lead.City' => $city_state['city'],
            'Lead.State' =>  $city_state['state'],
            'Lead.Email' => $email,
            'Lead.Homephone' => Yii::app()->request->getParam('phone'),
            'Lead.Workphone' => Yii::app()->request->getParam('phone2'),
            'Attributes.HouseType' => $prop_use,
            'Attributes.LoanType' => $loan_type,
            'Attributes.HouseValue' =>  Yii::app()->request->getParam('estimate_value'),
            'Attributes.LoanAmount' => Yii::app()->request->getParam('loan_amount'),
            'Attributes.LTV' =>  Yii::app()->request->getParam('ltv_percentage'),
            'Attributes.CreditScore' =>  $credit_rat,
            'Attributes.Military' =>  'No',
            'Attributes.InterestRate' =>  Yii::app()->request->getParam('first_interest_rate'),
            'Attributes.InterestRateType' =>  $r_type,
            //======================================================================
            'Attributes.EmailDomain' => $email_domain,
            'Attributes.IPaddress' => Yii::app()->request->getParam('ipaddress'),
            'Attributes.ULeadId' =>  Yii::app()->request->getParam('universal_leadid'),
            'Attributes.xxTrustedFormCertUrl' => Yii::app()->request->getParam('url'),
            'Attributes.BornOn' => Yii::app()->request->getParam('dob'),
            'Attributes.SubID' => Yii::app()->request->getParam('sub_id', '0'),
            'Attributes.UserAgent' =>  Yii::app()->request->getParam('user_agent'),
            'Attributes.PartnerLeadId' =>  '',
            'Attributes.LandingPage' =>  Yii::app()->request->getParam('url'),
            'Attributes.ConsentText' =>  Yii::app()->request->getParam('tcpa_text'),
        );
		//echo '<pre>';print_r($fields);die();
		$post_request = http_build_query($fields);
		//echo '<pre>';print_r($post_request);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_response = $cm->curl($post_url, $post_request);
		$time_end = CommonToolsMethods::stopwatch();
		//echo '<pre>';print_r($ping_response);die();
		preg_match("/<Message>(.*)<\/Message>/", $post_response, $success);
		//echo '<pre>';print_r();die();
		if (trim($success[1]) == 'success') {
			$post_status = '1';
			preg_match("/<Redirect>(.*)<\/Redirect>/", $post_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<Price>(.*)<\/Price>/msui", $post_response, $price);
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $ping_price);
			$post_price = isset($price[1]) ? $price[1] : $ping_price[1];
		} else {
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
