<?php
class SunshineController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
	 public static function getHost($url, $accept_www=false){
	    $url = str_replace(["%3A","%2F"],[':','/'],$url);
	    $URIs = parse_url(trim($url)); 
	    $host = !empty($URIs['host'])? $URIs['host'] : explode('/', $URIs['path'])[0];
	    return $accept_www == false? str_ireplace('www.', '', $host) : $host;  
	} 
    public static $not_allowed = ['adopt-a-contractor.com'];
   
    public static $user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.94 Chrome/37.0.2062.94 Safari/537.36';
    public static $BuildingType = [
		1=>'Single Family Home',
		2=>'Multi-Unit',
		3=>'Commercial',
		4=>'Apartment',
		5=>'Condo',
		6=>'Mobile Home',
		7=>'Other',
	];
    public static function getRequestTimeFrame($time_frame){
    	switch ($time_frame) {
			case '1':
				$request_time_frame = 'Immediate';
				break;
			case '2':
				$request_time_frame = 'Within 1 Month';
				break;
			case '3':
				$request_time_frame = 'Within 1 Month';
				break;
			case '4':
				$request_time_frame = 'Within 1 Month';
				break;
			default:
				$request_time_frame = 'More Than 1 Month';
				break;
		}
		return $request_time_frame;
    }
    public static function getRoofingType($rooting_type){
    	switch ($rooting_type) {
			case '1':
				$roof_type = 'Asphalt Shingle';
				break;
			case '2':
				$roof_type = 'Cedar Shake';
				break;
			case '3':
				$roof_type = 'Metal';
				break;
			case '4':
				$roof_type = 'Tar';
				break;
			case '5':
				$roof_type = 'Other';
				break;
			case '6':
				$roof_type = 'Natural Slate';
				break;
			default:
				$roof_type = 'Other';
				break;
		}
		return $roof_type;
    }
	public static function getRoofShade($roof_shade){
    	switch ($roof_shade) {
			case '0':
				$roofshade = 'No Shade';
				break;
			case '1':
				$roofshade = 'A Little Shade';
				break;
			case '2':
				$roofshade = 'A Lot Of Shade';
				break;
			case '3':
				$roofshade = 'Uncertain';
				break;
			default:
				$roofshade = 'NA';
				break;
		}
		return $roofshade;
    }
	public static function getPurchaseTimeFrame($time_frame){
    	switch ($time_frame) {
			case '1':
				$purchase_time_frame = 'Immediately';
				break;
			case '2':
				$purchase_time_frame = 'Within 1 months';
				break;
			case '3':
				$purchase_time_frame = '1-3 months';
				break;
			case '4':
				$purchase_time_frame = '1-3 months';
				break;
			case '5':
				$purchase_time_frame = '3+ months';
				break;
			default:
				$purchase_time_frame = '3+ months';
				break;
		}
		return $purchase_time_frame;
    }
	public static $ElectricityBill = [
		1=>'$0-$99',
		2=>'$0-$99',
		3=>'$100-$150',
		4=>'$151-$200',
		5=>'$201-$300',
		6=>'$301-$400',
		7=>'$301-$400',
		8=>'$301-$400',
		9=>'$401-$500',
		10=>'$501-$600',
		11=>'$601-$700',
	];
    public static $CreditRating = [
		1=>'Excellent',
		2=>'Good',
		3=>'Fair',
		4=>'Poor',
	];
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$pingData = [];
		
		$KEY = $p2 ? $p2 : '35377425b4990cd0e42178bc38c858c9594d6d6af6fcb748213f5307d0b53da2';
		$project_type = Yii::app()->request->getParam('project_type');
        $submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
        if($project_type == 42){// ROOFING
			$campaign['Stories'] = ['1 Story','2 Stories','3+ Stories'][rand(0,2)];
			$campaign['Property_Type'] = self::$BuildingType[Yii::app()->request->getParam('property_type',rand(1,2))];
			$campaign['Time_Frame'] = self::getRequestTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
            $campaign['Roof_Type'] = self::getRoofingType(Yii::app()->request->getParam('roofing_type',rand(1,2)));
            $campaign['Homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
			$campaign['Project'] = date('N')%2 == 0 ? 'New Install' : 'Repair';
			$campaign['Credit_Rating'] = self::$CreditRating[Yii::app()->request->getParam('credit_rating',rand(1,2))];
			$campaign['Comments'] = Yii::app()->request->getParam('comments');
			$TYPE = '53';
			$SRC = 'EMRoofing';
        }
		if($project_type == 45){// SOLAR
            $campaign['Roofing_Type'] = self::getRoofingType(Yii::app()->request->getParam('roofing_type',rand(1,2)));
			$campaign['Residence_Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rent';
			$campaign['Shade'] = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
			$campaign['Monthly_Electric_Bill'] = self::$ElectricityBill[Yii::app()->request->getParam('monthly_bill',rand(1,10))];
			$campaign['Credit'] = self::$CreditRating[Yii::app()->request->getParam('credit_rating',rand(1,2))];
			$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
			$ecw_utility_provider  = $project_provider['provider_name'];
			$sunshine_provider = $submission_model->getSunshineUtilityProviderById($ecw_utility_provider);
			$campaign['Utility_Provider'] = $sunshine_provider['provider'] ?  $sunshine_provider['provider'] : 'NA';
			$campaign['Purchase_Time_Frame'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
			$campaign['Property_Type'] = self::$BuildingType[Yii::app()->request->getParam('property_type',rand(1,2))];
			$TYPE = '51';
			$SRC = 'EMSolar';
        }
		if($project_type == 45 || $project_type == 42){
			$fields = [
				'Request' => [
					//'test_lead' => '0',
					'Key' => $KEY,
					'API_Action' => 'pingPostLead',
					'Format' => 'JSON',
					'Mode' => 'ping',
					'Return_Best_Price' => '1',
					'TYPE' => $TYPE,
					'Landing_Page' => Yii::app()->request->getParam('url','https://elitehomeimprovers.com'),
					'IP_Address' => Yii::app()->request->getParam('ipaddress'),
					'SRC' => $SRC,
					'Sub_ID' => Yii::app()->request->getParam('promo_code'),
					'Unique_Identifier' => Yii::app()->session['affiliate_trans_id'],
					'TCPA' => Yii::app()->request->getParam('tcpa_optin')==1?'Yes':'No',
					'TCPA_Language' =>Yii::app()->request->getParam('tcpa_text'),
					'Trusted_Form_URL' => Yii::app()->request->getParam('trustedformcerturl'),
					'LeadiD_Token' => Yii::app()->request->getParam('universal_leadid'),
					'City' => Yii::app()->request->getParam('city',$city_state['city']),
					'State' => Yii::app()->request->getParam('state',$city_state['state']),
					'Zip' => Yii::app()->request->getParam('zip'),
					'User_Agent' => Yii::app()->request->getParam('user_agent',self::$user_agent),        
					//'Project' => ['New Install','Repair','Replace'][rand(0,2)],
				]
			];
			$fields['Request'] += $campaign;
			//echo '<pre>';print_r($fields);exit;
			$purchase = true;
			$url = Yii::app()->request->getParam('url');
			if(in_array(self::getHost($url),self::$not_allowed)){
				$purchase = false;
			}
			if($purchase == true){
				$pingData['ping_request'] = json_encode($fields);
				$pingData['header'] = ["Content-Type: application/json"];
			}else{
				$pingData['ping_request'] = false;
			}
			return $pingData;
		}
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
    	$result = json_decode($ping_response,TRUE);
        if (trim($result['response']['status']) == 'Matched') {
            $ping_price = isset($result['response']['price']) ? $result['response']['price'] : 0;
            $confirmation_id = $result['response']['lead_id'];
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
		$result = json_decode($ping_response,TRUE);
		$KEY = $p2 ? $p2 : '35377425b4990cd0e42178bc38c858c9594d6d6af6fcb748213f5307d0b53da2';
		$project_type = Yii::app()->request->getParam('project_type');
		$confirmation_id = $result['response']['lead_id'];
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		if($project_type == 42){// ROOFING
			$campaign['Stories'] = ['1 Story','2 Stories','3+ Stories'][rand(0,2)];
			$campaign['Property_Type'] = self::$BuildingType[Yii::app()->request->getParam('property_type',rand(1,2))];
			$campaign['Time_Frame'] = self::getRequestTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
            $campaign['Roof_Type'] = self::getRoofingType(Yii::app()->request->getParam('roofing_type',rand(1,2)));
            $campaign['Homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
			$campaign['Project'] = date('N')%2 == 0 ? 'New Install' : 'Repair';
			$campaign['Credit_Rating'] = self::$CreditRating[Yii::app()->request->getParam('credit_rating',rand(1,2))];
			$campaign['Comments'] = Yii::app()->request->getParam('comments');
			$TYPE = '53';
			$SRC = 'EMRoofing';
        }
		if($project_type == 45){// SOLAR
            $campaign['Roofing_Type'] = self::getRoofingType(Yii::app()->request->getParam('roofing_type',rand(1,2)));
			$campaign['Residence_Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rent';
			$campaign['Shade'] = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
			$campaign['Monthly_Electric_Bill'] = self::$ElectricityBill[Yii::app()->request->getParam('monthly_bill',rand(1,10))];
			$campaign['Credit'] = self::$CreditRating[Yii::app()->request->getParam('credit_rating',rand(1,2))];
			$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
			$ecw_utility_provider  = $project_provider['provider_name'];
			$sunshine_provider = $submission_model->getSunshineUtilityProviderById($ecw_utility_provider);
			$campaign['Utility_Provider'] = $sunshine_provider['provider'] ?  $sunshine_provider['provider'] : 'NA';
			$campaign['Purchase_Time_Frame'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
			$campaign['Property_Type'] = self::$BuildingType[Yii::app()->request->getParam('property_type',rand(1,2))];
			$TYPE = '51';
			$SRC = 'EMSolar';
        }
		$fields = [
		'Request' => [
			    'Lead_ID' =>$confirmation_id,
                'Key' => $KEY,
				'API_Action' => 'pingPostLead',
				'Format' => 'JSON',
		        'Mode' => 'post',
		        'Return_Best_Price' => '1',
		        'TYPE' => $TYPE,
		        'Landing_Page' => Yii::app()->request->getParam('url','https://elitehomeimprovers.com'),
		        'IP_Address' => Yii::app()->request->getParam('ipaddress'),
		        'SRC' => $SRC,
		        'Sub_ID' => Yii::app()->request->getParam('promo_code'),
                'Unique_Identifier' => Yii::app()->session['affiliate_trans_id'],
		        'TCPA' => Yii::app()->request->getParam('tcpa_optin')==1?'Yes':'No',
		        'TCPA_Language' =>Yii::app()->request->getParam('tcpa_text'),
				'Trusted_Form_URL' => Yii::app()->request->getParam('trustedformcerturl'),
		        'LeadiD_Token' => Yii::app()->request->getParam('universal_leadid'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => Yii::app()->request->getParam('state',$city_state['state']),
		        'Zip' => Yii::app()->request->getParam('zip'),
                'First_Name' => Yii::app()->request->getParam('first_name'),
                'Last_Name' => Yii::app()->request->getParam('last_name'),
                'Address' => Yii::app()->request->getParam('address'),
                'Email' => Yii::app()->request->getParam('email'),
                'Primary_Phone' => Yii::app()->request->getParam('phone'),
		        'User_Agent' => Yii::app()->request->getParam('user_agent',self::$user_agent),
	    	]
    	];
		$fields['Request'] += $campaign;
		$post_request = json_encode($fields);
        //echo '<pre>';print_r($post_request);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
		$header = ["Content-Type: application/json"];
        $post_response = $cm->curl($post_url, $post_request,$header);
		$time_end = CommonToolsMethods::stopwatch();
		$success = json_decode($post_response,TRUE);
		if (trim($success['response']['status']) == 'Matched' || trim($success['response']['status']) == 'Matched') {
			$post_status = '1';
            $redirect_url = '';
            $ping_success = json_decode($ping_response,TRUE);
            $post_price = isset($success['response']['price']) ? $success['response']['price'] : $ping_success['response']['price'];
		} else {
			$post_status = '0';
			$post_price = 0;
			$redirect_url = '';
			if (preg_match("/duplicate/i",$post_response)){
				$post_status = '2';
				$post_fail_reason='duplicatebybuyer';
			}
		}
		$post_time = ($time_end - $start_time);
		$post_responses['post_request'] = $post_request;
		$post_responses['post_response'] = $post_response;
		$post_responses['post_status'] = $post_status;
		$post_responses['post_price'] = $post_price;
		$post_responses['redirect_url'] = $redirect_url;
		$post_responses['post_time'] = $post_time;
		$post_responses['post_fail_reason'] = $post_fail_reason;
		//echo '<pre>';print_r($post_responses);die();
		return $post_responses;
    }
}