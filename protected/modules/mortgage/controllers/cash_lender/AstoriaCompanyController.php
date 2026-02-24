<?php

class AstoriaCompanyController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$tcpa_optin = Yii::app()->request->getParam('tcpa_optin');
		$tcpa_optin = $tcpa_optin == 'Yes' || $tcpa_optin == '1'  ? 1 : 0;
		$bankruptcy = Yii::app()->request->getParam('bankruptcy');
		$bankruptcy = $bankruptcy == 'Yes' || $bankruptcy == '1'  ? 1 : 0;
		$estimate_value = Yii::app()->request->getParam('estimate_value');
		$loan_amount = Yii::app()->request->getParam('loan_amount');
		$loan_percentage = round($loan_amount * 100 /  $estimate_value);
		if($loan_percentage>95){
			$loan_amount_est = round($estimate_value * 70 /100);
		}else{
			$loan_amount_est = $loan_amount;
		}
		$first_interest_rate = Yii::app()->request->getParam('first_interest_rate');
		if($promo_code != 2 && $promo_code != 12 && $promo_code != 16 && $promo_code != 26 && $promo_code != 27 && $promo_code != 39 && $promo_code != 92){
			$pingData = array();
			$fields1 = array(
				'lead_type' => $p1,
				'lead_mode' => '1',
				'vendor_id' => $p2,
				'ipaddress' => Yii::app()->request->getParam('ipaddress'),
				'sub_id' => $promo_code,
				'tcpa_optin' => $tcpa_optin,
				'tcpa_text' => Yii::app()->request->getParam('tcpa_text'),
				'universal_leadid' =>  Yii::app()->request->getParam('universal_leadid'),
				'origination_datetime' => date('Y-m-d H:i:s'),
				'origination_timezone' => '1',
				'zip' => Yii::app()->request->getParam('zip'),
				'credit_rating' => Yii::app()->request->getParam('credit_rating'),
				'bankruptcy' => $bankruptcy,
				'user_agent' =>  Yii::app()->request->getParam('user_agent'),
				'url' =>  Yii::app()->request->getParam('url'),
				'employment_type' =>  Yii::app()->request->getParam('employment_type'),
				'income' =>  Yii::app()->request->getParam('income'),
				'in_military' =>  Yii::app()->request->getParam('in_military','1'),
				'loan_amount' =>  $loan_amount_est,
				'mortgage_lead_type' =>  Yii::app()->request->getParam('mortgage_lead_type'),
				//==================================
			);
			if (Yii::app()->request->getParam('mortgage_lead_type')) {
                switch (Yii::app()->request->getParam('mortgage_lead_type')) {
                    case 1:
                        $fields2 = array(
                            "down_payment" => Yii::app()->request->getParam('down_payment'),
                            "first_interest_rate" => $first_interest_rate,
                            "spec_home" => Yii::app()->request->getParam('spec_home'),
                            "buy_timeframe" => Yii::app()->request->getParam('buy_timeframe'),
                            "agent_found" => Yii::app()->request->getParam('agent_found'),
                            "property_state" => Yii::app()->request->getParam('property_state'),
                            "property_zip" => Yii::app()->request->getParam('property_zip'),
                            "estimate_value" => Yii::app()->request->getParam('estimate_value'),
                        );
                        break;
                    case 2:
                        $fields2 = array(
                            "first_balance" => Yii::app()->request->getParam('first_balance'),
                            "first_interest_rate" => $first_interest_rate,
                            "second_balance" => Yii::app()->request->getParam('second_balance'),
                            "second_interest_rate" => Yii::app()->request->getParam('second_interest_rate'),
                            "additional_cash" => Yii::app()->request->getParam('additional_cash'),
                            "property_state" => Yii::app()->request->getParam('property_state'),
                            "property_zip" => Yii::app()->request->getParam('property_zip'),
                            "estimate_value" => Yii::app()->request->getParam('estimate_value'),
                        );
                        break;
                    case 3:
                        $fields2 = array(
                        	"first_interest_rate" => $first_interest_rate,
                            "home_equity_type" => Yii::app()->request->getParam('home_equity_type'),
                            "first_balance" => Yii::app()->request->getParam('first_balance'),
                            "second_balance" => Yii::app()->request->getParam('second_balance'),
                            "second_interest_rate" => Yii::app()->request->getParam('second_interest_rate'),
                            "additional_cash" => Yii::app()->request->getParam('additional_cash'),
                            "property_state" => Yii::app()->request->getParam('property_state'),
                            "property_zip" => Yii::app()->request->getParam('property_zip'),
                            "estimate_value" => Yii::app()->request->getParam('estimate_value'),
                        );
                        break;
                    case 4:
                        $fields2 = array(
                            "first_balance" => Yii::app()->request->getParam('first_balance'),
                            "first_interest_rate" => $first_interest_rate,
                            "second_balance" => Yii::app()->request->getParam('second_balance'),
                            "second_interest_rate" => Yii::app()->request->getParam('second_interest_rate'),
                            "additional_cash" => Yii::app()->request->getParam('additional_cash'),
                            "property_state" => Yii::app()->request->getParam('property_state'),
                            "property_zip" => Yii::app()->request->getParam('property_zip'),
                            "estimate_value" => Yii::app()->request->getParam('estimate_value'),
                        );
                        break;
                }
	        }
			$fields3 = array(
				'property_use' => Yii::app()->request->getParam('property_use',1),
				'property_desc' => Yii::app()->request->getParam('property_desc',1),
				'estimate_value' => Yii::app()->request->getParam('estimate_value'),
				'rate_type' =>  Yii::app()->request->getParam('rate_type'),
				'credit_rating' => Yii::app()->request->getParam('credit_rating',1),
                'ltv_percentage' => Yii::app()->request->getParam('ltv_percentage',95),
				'bank_foreclosure' => Yii::app()->request->getParam('bank_foreclosure',0),
				'num_mortgage_lates' =>  Yii::app()->request->getParam('num_mortgage_lates',0),
				'va_loan' =>  Yii::app()->request->getParam('va_loan',0),
				'comments' =>  Yii::app()->request->getParam('comments'),
				//======================================================================
			);
			$fields = array_merge($fields1, $fields2, $fields3);
			$pingData['ping_request'] = http_build_query($fields);
			return $pingData;
	    }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<Response>(.*)<\/Response>/msui", $ping_response, $result);
        if (trim($result[1]) == 'Accepted' || trim($result[0]) == 'Accepted') {
            preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $price);
            preg_match("/<Confirmation>(.*)<\/Confirmation>/msui", $ping_response, $confirmation_id);
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
		$promo_code = Yii::app()->request->getParam('promo_code');
		$tcpa_optin = Yii::app()->request->getParam('tcpa_optin');
		$tcpa_optin = $tcpa_optin == 'Yes' || $tcpa_optin == '1'  ? 1 : 0;
		$bankruptcy = Yii::app()->request->getParam('bankruptcy');
		$bankruptcy = $bankruptcy == 'Yes' || $bankruptcy == '1'  ? 1 : 0;
		$first_interest_rate='No Rate'?'1':$_REQUEST['first_interest_rate'];

		$estimate_value = Yii::app()->request->getParam('estimate_value');
		$loan_amount = Yii::app()->request->getParam('loan_amount');
		$loan_percentage = round($loan_amount * 100 /  $estimate_value);
		if($loan_percentage>95){
			$loan_amount_est = round($estimate_value * 70 /100);
		}else{
			$loan_amount_est = $loan_amount;
		}
		$first_interest_rate = Yii::app()->request->getParam('first_interest_rate');
		if($promo_code != 2 && $promo_code != 16){
			preg_match("/<Confirmation>(.*)<\/Confirmation>/msui", $ping_response, $confirmation_id);
			$fields1 = array(
				'confirmation_id' => $confirmation_id[1],
				'lead_type' => $p1,
				'lead_mode' => '1',
				'vendor_id' => $p2,
                'first_name' => Yii::app()->request->getParam('first_name'),
                'last_name' => Yii::app()->request->getParam('last_name'),
                'email' => Yii::app()->request->getParam('email'),
                'address' => Yii::app()->request->getParam('address'),
                'property_street' => Yii::app()->request->getParam('address'),
                'primary_phone' => str_replace('-','',Yii::app()->request->getParam('phone')),
                'secondary_phone' => str_replace('-','',Yii::app()->request->getParam('phone2')),
                'dob' => Yii::app()->request->getParam('dob'),
				'ipaddress' => Yii::app()->request->getParam('ipaddress'),
                'zip' => Yii::app()->request->getParam('zip'),
				'sub_id' => $promo_code,
				'tcpa_optin' => $tcpa_optin,
				'tcpa_text' => Yii::app()->request->getParam('tcpa_text'),
				'universal_leadid' =>  Yii::app()->request->getParam('universal_leadid'),
				'origination_datetime' => date('Y-m-d H:i:s'),
				'origination_timezone' => '1',
				'zip' => Yii::app()->request->getParam('zip'),
				'credit_rating' => Yii::app()->request->getParam('credit_rating'),
				'bankruptcy' => $bankruptcy, 
				'user_agent' =>  Yii::app()->request->getParam('user_agent'),
				'url' =>  Yii::app()->request->getParam('url'),
				'employment_type' =>  Yii::app()->request->getParam('employment_type'),
				'income' =>  Yii::app()->request->getParam('income'),
				'in_military' =>  Yii::app()->request->getParam('in_military','1'),
				'loan_amount' =>  $loan_amount_est,
				'mortgage_lead_type' =>  Yii::app()->request->getParam('mortgage_lead_type'),
				//======================================================================
			);
			if (Yii::app()->request->getParam('mortgage_lead_type')) {
                switch (Yii::app()->request->getParam('mortgage_lead_type')) {
                    case 1:
                        $fields2 = array(
                            "down_payment" => Yii::app()->request->getParam('down_payment'),
                            "first_interest_rate" => $first_interest_rate,
                            "spec_home" => Yii::app()->request->getParam('spec_home'),
                            "buy_timeframe" => Yii::app()->request->getParam('buy_timeframe'),
                            "agent_found" => Yii::app()->request->getParam('agent_found'),
                            "property_state" => Yii::app()->request->getParam('property_state'),
                            "property_zip" => Yii::app()->request->getParam('property_zip'),
                            "estimate_value" => Yii::app()->request->getParam('estimate_value'),
                        );
                        break;
                    case 2:
                        $fields2 = array(
                            "first_balance" => Yii::app()->request->getParam('first_balance'),
                            "first_interest_rate" => $first_interest_rate,
                            "second_balance" => Yii::app()->request->getParam('second_balance'),
                            "second_interest_rate" => Yii::app()->request->getParam('second_interest_rate'),
                            "additional_cash" => Yii::app()->request->getParam('additional_cash'),
                            "property_state" => Yii::app()->request->getParam('property_state'),
                            "property_zip" => Yii::app()->request->getParam('property_zip'),
                            "estimate_value" => Yii::app()->request->getParam('estimate_value'),
                        );
                        break;
                    case 3:
                        $fields2 = array(
                        	"first_interest_rate" => $first_interest_rate,
                            "home_equity_type" => Yii::app()->request->getParam('home_equity_type'),
                            "first_balance" => Yii::app()->request->getParam('first_balance'),
                            "second_balance" => Yii::app()->request->getParam('second_balance'),
                            "second_interest_rate" => Yii::app()->request->getParam('second_interest_rate'),
                            "additional_cash" => Yii::app()->request->getParam('additional_cash'),
                            "property_state" => Yii::app()->request->getParam('property_state'),
                            "property_zip" => Yii::app()->request->getParam('property_zip'),
                            "estimate_value" => Yii::app()->request->getParam('estimate_value'),
                        );
                        break;
                    case 4:
                        $fields2 = array(
                            "first_balance" => Yii::app()->request->getParam('first_balance'),
                            "first_interest_rate" => $first_interest_rate,
                            "second_balance" => Yii::app()->request->getParam('second_balance'),
                            "second_interest_rate" => Yii::app()->request->getParam('second_interest_rate'),
                            "additional_cash" => Yii::app()->request->getParam('additional_cash'),
                            "property_state" => Yii::app()->request->getParam('property_state'),
                            "property_zip" => Yii::app()->request->getParam('property_zip'),
                            "estimate_value" => Yii::app()->request->getParam('estimate_value'),
                        );
                        break;
                }
	        }
			$fields3 = array(
				'property_use' => Yii::app()->request->getParam('property_use',1),
				'property_desc' => Yii::app()->request->getParam('property_desc',1),
				'estimate_value' => Yii::app()->request->getParam('estimate_value'),
				'rate_type' =>  Yii::app()->request->getParam('rate_type'),
				'credit_rating' => Yii::app()->request->getParam('credit_rating',1),
                'ltv_percentage' => Yii::app()->request->getParam('ltv_percentage',95),
				'bank_foreclosure' => Yii::app()->request->getParam('bank_foreclosure',0),
				'num_mortgage_lates' =>  Yii::app()->request->getParam('num_mortgage_lates',0),
				'va_loan' =>  Yii::app()->request->getParam('va_loan',0),
				'comments' =>  Yii::app()->request->getParam('comments'),
                'post_url' => $post_url,
				//======================================================================
			);
			$fields = array_merge($fields1, $fields2, $fields3);
			//echo '<pre>';print_r($fields);die();
			$post_request = http_build_query($fields);
			//echo '<pre>';print_r($post_request);
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			$post_response = $cm->curl($post_url, $post_request);
			$time_end = CommonToolsMethods::stopwatch();
			//echo '<pre>';print_r($ping_response);die();
			preg_match("/<Response>(.*)<\/Response>/", $post_response, $success);
			//echo '<pre>';print_r();die();
			if (trim($success[1]) == 'Accepted') {
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
}