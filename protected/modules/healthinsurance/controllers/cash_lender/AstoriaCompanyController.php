<?php

class AstoriaCompanyController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
			$promo_code = Yii::app()->request->getParam('promo_code');
			if($promo_code != 7){
				$height_cm = Yii::app()->request->getParam('height');
				$inches = $height_cm/2.54;
				$height_feet = intval($inches/12);
				$height_inches = round($inches%12);
				$pingData = array();
				$stay_in_month = Yii::app()->request->getParam('stay_in_month')>11 ? 11 : Yii::app()->request->getParam('stay_in_month');
				$fields = array(
					'lead_type' => $p1,
					'lead_mode' => '1',
					'vendor_id' => $p2,
					'sub_id' => $promo_code,
					'tcpa_optin' => Yii::app()->request->getParam('tcpa_optin',0),
					'tcpa_text' => Yii::app()->request->getParam('tcpa_text'),
					'universal_leadid'=>Yii::app()->request->getParam('universal_leadid'),
					'origination_datetime' => date('Y-m-d H:i:s'),
					'origination_timezone' => '1',
					'vendor_lead_id' => Yii::app()->request->getParam('vendor_lead_id'),
					'url' => Yii::app()->request->getParam('url'),
					'zip' => Yii::app()->request->getParam('zip'),
					'user_agent' => Yii::app()->request->getParam('user_agent'),
					'phone_last_4' => Yii::app()->request->getParam('phone_last_4'),
					'income' => Yii::app()->request->getParam('income', '0'),
					'ipaddress' => Yii::app()->request->getParam('ipaddress'),
					'user_agent'=>Yii::app()->request->getParam('user_agent'),
					'household_size'=>Yii::app()->request->getParam('number_in_household'),
					'residence_type'=>Yii::app()->request->getParam('is_rented'),
					'marital_status'=>Yii::app()->request->getParam('marital_status'),
					'years_at_residence'=>Yii::app()->request->getParam('stay_in_year'),
					'months_at_residence'=>$stay_in_month,
					'dob'=>Yii::app()->request->getParam('dob'),
					'gender'=>Yii::app()->request->getParam('gender')=='M'?'0':'1',
					'education_level'=>Yii::app()->request->getParam('education_level'),
					'occupation'=>Yii::app()->request->getParam('occupation'),
					'student'=>Yii::app()->request->getParam('is_student'),
					'height_feet'=>$height_feet,
					'height_inches'=>$height_inches,
					'weight'=>Yii::app()->request->getParam('weight'),
					'medical_condition'=>Yii::app()->request->getParam('medical_condition',0),
					'dui'=>Yii::app()->request->getParam('dui'),
					'requested_coverage_type'=>Yii::app()->request->getParam('requested_coverage_type',1),
					'previously_denied'=>Yii::app()->request->getParam('previously_denied'),
					'is_smoker'=>Yii::app()->request->getParam('is_smoker'),
					'expectant_parent'=>Yii::app()->request->getParam('expectant_parent'),
					'relative_heart'=>Yii::app()->request->getParam('relative_heart'),
					'relative_cancer'=>Yii::app()->request->getParam('relative_cancer'),
					'haveInsurance'=>Yii::app()->request->getParam('current_coverage_type')>0 ? '1' : '0',
					'current_coverage_type' => Yii::app()->request->getParam('current_coverage_type',1),
					'current_insurance_company'=>Yii::app()->request->getParam('insurance_company',1),
					'current_policy_expiration_date'=>Yii::app()->request->getParam('insurance_expiration_date'),
					'insured_since_date'=>Yii::app()->request->getParam('insurance_start_date'),
					'xxtrustedformcerturl'=>Yii::app()->request->getParam('trustedformcerturl'),
				);
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
		if($promo_code != 7){
			preg_match("/<Confirmation>(.*)<\/Confirmation>/msui", $ping_response, $confirmation_id);
			$height_cm = Yii::app()->request->getParam('height');
			$inches = $height_cm/2.54;
			$height_feet = intval($inches/12);
			$height_inches = round($inches%12);
			$stay_in_month = Yii::app()->request->getParam('stay_in_month')>11 ? 11 : Yii::app()->request->getParam('stay_in_month');
			$fields = array(
				'confirmation_id'=>$confirmation_id[1],
				'lead_type' => $p1,
				'lead_mode' => '1',
				'vendor_id' => $p2,
				'sub_id' => $promo_code,
				'tcpa_optin' => Yii::app()->request->getParam('tcpa_optin',0),
				'tcpa_text' => Yii::app()->request->getParam('tcpa_text'),
				'universal_leadid'=>Yii::app()->request->getParam('universal_leadid'),
				'origination_datetime' => date('Y-m-d H:i:s'),
				'origination_timezone' => '1',
				'url' => Yii::app()->request->getParam('url'),
				'zip' => Yii::app()->request->getParam('zip'),
				'user_agent' => Yii::app()->request->getParam('user_agent'),
				'vendor_lead_id' => Yii::app()->request->getParam('vendor_lead_id'),
				'income' => Yii::app()->request->getParam('income', '0'),
				'first_name' => Yii::app()->request->getParam('first_name'),
				'last_name' => Yii::app()->request->getParam('last_name'),
				'email' => Yii::app()->request->getParam('email'),
				'address' => Yii::app()->request->getParam('address'),
				'primary_phone' => str_replace('-','',Yii::app()->request->getParam('phone')),
				'secondary_phone' => str_replace('-','',Yii::app()->request->getParam('phone2')),
				'ipaddress' => Yii::app()->request->getParam('ipaddress'),
				'user_agent'=>Yii::app()->request->getParam('user_agent'),
				'household_size'=>Yii::app()->request->getParam('number_in_household'),
				'residence_type'=>Yii::app()->request->getParam('is_rented'),
				'years_at_residence'=>Yii::app()->request->getParam('stay_in_year'),
				'months_at_residence'=>$stay_in_month,
				'marital_status'=>Yii::app()->request->getParam('marital_status'),
				'gender'=>Yii::app()->request->getParam('gender')=='M'?'0':'1',
				'dob'=>Yii::app()->request->getParam('dob'),
				'education_level'=>Yii::app()->request->getParam('education_level'),
				'occupation'=>Yii::app()->request->getParam('occupation'),
				'student'=>Yii::app()->request->getParam('is_student'),
				'height_feet'=>$height_feet,
				'height_inches'=>$height_inches,
				'weight'=>Yii::app()->request->getParam('weight'),
				'medical_condition'=>Yii::app()->request->getParam('medical_condition'),
				'dui'=>Yii::app()->request->getParam('dui'),
				'requested_coverage_type' => Yii::app()->request->getParam('requested_coverage_type',1),
				'previously_denied'=>Yii::app()->request->getParam('previously_denied'),
				'is_smoker'=>Yii::app()->request->getParam('is_smoker'),
				'expectant_parent'=>'0',
				'relative_heart'=>'0',
				'relative_cancer'=>'0',
				'haveInsurance'=>'1',
				'current_coverage_type' =>Yii::app()->request->getParam('current_coverage_type',1),
				'current_insurance_company'=>Yii::app()->request->getParam('insurance_company'),
				'current_policy_expiration_date'=>Yii::app()->request->getParam('insurance_expiration_date'),
				'insured_since_date'=>Yii::app()->request->getParam('insurance_start_date'),
				'xxtrustedformcerturl'=>Yii::app()->request->getParam('trustedformcerturl'),
			);
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