<?php

Yii::app()->params['state'] = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota','OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming','DC'=>'District of Columbia');

Yii::app()->params['field'] = array('lead_mode' => 'lead_mode', 'promo_code' => 'promo_code', 'sub_id' => 'sub_id', 'first_name' => 'first_name', 'last_name' => 'last_name', 'email' => 'email', 'phone' => 'phone', 'address' => 'address', 'city' => 'city', 'state' => 'state', 'zip' => 'zip', 'gender' => 'gender', 'dob' => 'dob', 'mobile' => 'mobile', 'ssn' => 'ssn', 'is_rented' => 'is_rented', 'stay_in_year' => 'stay_in_year', 'stay_in_month' => 'stay_in_month', 'home_pay' => 'home_pay', 'employer' => 'employer', 'job_title' => 'job_title', 'employment_in_month' => 'employment_in_month', 'employment_in_year' => 'employment_in_year', 'work_phone' => 'work_phone', 'monthly_income' => 'monthly_income', 'loan_amount' => 'loan_amount', 'bankruptcy' => 'bankruptcy', 'cosigner' => 'cosigner', 'car_year' => 'car_year', 'car_make' => 'car_make', 'car_trim' => 'car_trim', 'car_model' => 'car_model', 'agree_credit_check' => 'agree_credit_check', 'ipaddress' => 'ipaddress', 'url' => 'url', 'user_agent' => 'user_agent', 'sub_date' => 'sub_date');

Yii::app()->params['field_edu'] = array('lead_mode' => 'lead_mode', 'promo_code' => 'promo_code', 'sub_id' => 'sub_id', 'first_name' => 'first_name', 'last_name' => 'last_name', 'email' => 'email', 'phone' => 'phone', 'address' => 'address', 'city' => 'city', 'state' => 'state', 'zip' => 'zip', 'gender' => 'gender', 'dob' => 'dob', 'mobile' => 'mobile', 'ssn' => 'ssn', 'program_of_interest' => 'program_of_interest', 'master_degree' => 'master_degree', 'ipaddress' => 'ipaddress', 'url' => 'url', 'user_agent' => 'user_agent', 'sub_date' => 'sub_date');

define('ACCEPTED', 'ACCEPTED'); // Response is 1
define('REJECTED', 'REJECTED'); // Response is 0
define('ERROR', 'ERROR');       // Response is -1
define('RETURNED', 'RETURNED'); // Response does not change. There is "is_returned" column

/** Global Array for Status and Affiliate Type */
$GLOBALS['status'] =  array('1'=>'Active','0'=>'Test','-1'=>'Inactive');
$GLOBALS['active_campus'] =  array('1'=>'Active','0'=>'Inactive');
$GLOBALS['ground_campus'] =  array('1'=>'Yes','0'=>'No');
$GLOBALS['affiliate_type'] =  array('1'=>'Inorganic','0'=>'Organic');

function setResponseText($response){
	if($response==1){
		$responseText = ACCEPTED;
	}elseif($response==0){
		$responseText = REJECTED;
	}elseif($response==-1){
		$responseText = ERROR;
	}
	return $responseText;
}

/** Define Email */
define('VIPUL', 'vipul.bhandari@axiombpm.com');
define('DEVANG', 'devang.parekh@axiombpm.com');
/**
 * Generate affiliate name and promo code array.
 */
function get_affiliate_name_and_promocode(){
	$data = AffiliateUser::model()->findAll(array('select'=>'id,user_name'));
	$aff_data = array();
	foreach($data as $value){
		$aff_data[$value->id] = $value->user_name.' ('.$value->id.')';
	}
	natcasesort($aff_data);
	return $aff_data;
}
/**
 * Generate lender name and lender id array.
 */
function get_lender_name_and_lender_id(){
	$data = LenderDetails::model()->findAll(array('select'=>'id,name'));
	$lender_data = array();
	foreach($data as $value){
		$lender_data[$value->id] = $value->name.' ('.$value->id.')';
	}
	natcasesort($lender_data);
	return $lender_data;
}
?>
