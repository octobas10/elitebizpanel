<?php
class VeerusController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static $creditRating = [
        1 => 'Excellent',
        2 => 'Good',
        3 => 'Fair',
        4 => 'Poor',
    ];
    public static function getHost($url, $accept_www=false){
	    $url = str_replace(["%3A","%2F"],[':','/'],$url);
	    $URIs = parse_url(trim($url)); 
	    $host = !empty($URIs['host'])? $URIs['host'] : explode('/', $URIs['path'])[0];
	    return $accept_www == false? str_ireplace('www.', '', $host) : $host;  
	}
	public static $not_allowed = [];
    public static function getPurchaseTimeFrame($time_frame){
    	switch ($time_frame) {
			case '1':
				$purchase_time_frame = 'Immediately';
				break;
			case '1':
				$purchase_time_frame = 'Within 1 months';
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
			case '6':
				$purchase_time_frame = '3+ months';
				break;
			default:
				$purchase_time_frame = '1-3 months';
				break;
		}
		return $purchase_time_frame;
    }
   	public static function getMonthlyBill($mothly_bill){
    	switch ($mothly_bill) {
			case '1':
				$monthly_electric_bill = '50';
				break;
			case '2':
				$monthly_electric_bill = '100';
				break;
			case '3':
				$monthly_electric_bill = '150';
				break;
			case '4':
				$monthly_electric_bill = '200';
				break;
			case '5':
				$monthly_electric_bill = '300';
				break;
			case '6':
				$monthly_electric_bill = '400';
				break;
			case '7':
				$monthly_electric_bill = '500';
				break;
			case '8':
				$monthly_electric_bill = '600';
				break;
			case '9':
				$monthly_electric_bill = '700';
				break;
			case '10':
				$monthly_electric_bill = '800';
				break;
			case '11':
				$monthly_electric_bill = '900';
				break;
			default:
				$monthly_electric_bill = '500';
				break;
		}
		return $monthly_electric_bill;
    }
    public static function getRoofShade($roof_shade){
    	switch ($roof_shade) {
			case '0':
				$roofshade = 'No Shade';
				break;
			case '1':
				$roofshade = 'Partial Shade';
				break;
			case '2':
				$roofshade = 'Full Shade';
				break;
			case '3':
				$roofshade = 'Not Sure';
				break;
			default:
				$roofshade = 'Full Shade';
				break;
		}
		return $roofshade;
    }
    public static function getPropertyType($property_type){
    	switch ($property_type) {
			case '1':
				$propertytype = 'Single Family';
				break;
			case '2':
				$propertytype = 'Multi Family';
				break;
			case '3':
				$propertytype = 'Townhome';
				break;
			case '4':
				$propertytype = 'Condo';
				break;
			case '5':
				$propertytype = 'Duplex';
				break;
			case '6':
				$propertytype = 'Manufactured';
				break;
			default:
				$propertytype = 'Single Family';
				break;
		}
		return $propertytype;
    }
    
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$time_frame = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame'));
		$project_type = Yii::app()->request->getParam('project_type');
		$task_name = Yii::app()->request->getParam('task');
		$project_task = explode('_',$task_name);
		$project_variable = $submission_model->getProjectVariables($project_type,$project_task[1]);
		$jangl_project_array = [];
		if(!empty($project_variable)){
			$variable = array_keys($project_variable);
			$jangl_project_array = $project_variable[$variable[0]];
			$first_key = array_keys($jangl_project_array)[0];	
		}
		$url = Yii::app()->request->getParam('url','https://elitehomeinsurer.com');
		$url = self::getHost($url);
		$fields = [
			'meta' => [
				'originally_created' => date('Y-m-d').'T'.date('H:i:s').'Z',
				'source_id' => Yii::app()->request->getParam('promo_code'),
				'offer_id' => $_SESSION['affiliate_trans_id'],
				'lead_id_code' => Yii::app()->request->getParam('universal_leadid'),
				'trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
				'tcpa_compliant' => Yii::app()->request->getParam('tcpa_optin'),
				'tcpa_consent_text' => Yii::app()->request->getParam('tcpa_text'),
				'user_agent' => Yii::app()->request->getParam('user_agent'),
				'landing_page_url' => 'https://'.$url
		    ],
		    'contact' => [
		    	"city" => $city_state['city'],
		    	"state" => $city_state['state'],
	            "zip_code" => Yii::app()->request->getParam('zip'),
	            "ip_address" => Yii::app()->request->getParam('ipaddress'),
   			],
   			'data'=> [
				'best_call_time'=> "Anytime",
				'purchase_time_frame'=> $time_frame,
				'own_property'=> Yii::app()->request->getParam('home_owner') == 1 ? 'true' : 'false',
				'credit_rating' => self::$creditRating[Yii::app()->request->getParam('credit_rating','2')],
			]
		];
		if($project_type == 45 ){// SOLAR
			$campaign['best_call_time'] = 'Anytime';
			$campaign['purchase_time_frame'] = $time_frame;
			$campaign['own_property'] = Yii::app()->request->getParam('home_owner') == 1 ? 'true' : 'false';
			$campaign['credit_rating'] = self::$creditRating[Yii::app()->request->getParam('credit_rating','2')];
			$monthly_bill = self::getMonthlyBill(Yii::app()->request->getParam('monthly_bill'));
			$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
			$utility_provider  = $project_provider['provider_name'];
			$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
			$property_type = self::getPropertyType(Yii::app()->request->getParam('property_type'));
			$campaign['monthly_electric_bill'] = $monthly_bill;
			$campaign['utility_provider'] = $utility_provider;
			$campaign['roof_shade'] = $roof_shade;
			$campaign['property_type'] = $property_type;
			$fields['data'] += $campaign;
			$apitoken = $p1 ? $p1 : 'c330e4bed0874c0a7244b2af6c726718efe4d675';
			$ping_url = str_replace('home_improvement','solar',$ping_url);
		}else{ // HOME IMPROVEMENT
			if(!empty($jangl_project_array)){
				$campaign = [$variable[0] => $jangl_project_array];
				$fields['data'] += $campaign;
			}
			$apitoken = $p1 ? $p1 : '95804521031c698e3d51306392ef167eaf4fa0b3';
		}
		$purchase = true;
        if(in_array(self::getHost($url),self::$not_allowed)){
        	//$purchase = false;
        }
		if($purchase == true){
        	$pingData['ping_request'] = json_encode($fields);
			$pingData['ping_url'] = $ping_url;
			$pingData['header'] = ["Authorization: Token $apitoken","content-type: application/json"];
        }else{
            $pingData['ping_request'] = false;
        }
		return $pingData;
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
    	$result = json_decode($ping_response,TRUE);
        if (trim($result['status']) == 'success' || trim($result['status']) == 'success') {
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
    	$result = json_decode($ping_response,TRUE);
		$auth_code = $result['auth_code'];
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$time_frame = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame'));
		$project_type = Yii::app()->request->getParam('project_type');
		$task_name = Yii::app()->request->getParam('task');
		$project_task = explode('_',$task_name);
		$project_variable = $submission_model->getProjectVariables($project_type,$project_task[1]);
		$jangl_project_array = [];
		if(!empty($project_variable)){
			$variable = array_keys($project_variable);
			$jangl_project_array = $project_variable[$variable[0]];
			$first_key = array_keys($jangl_project_array)[0];	
		}
		$url = Yii::app()->request->getParam('url','https://elitehomeinsurer.com');
		$url = self::getHost($url);
		$fields = [
			'auth_code' => $auth_code,
			'meta' => [
				'originally_created' => date('Y-m-d').'T'.date('H:i:s').'Z',
				'source_id' => Yii::app()->request->getParam('promo_code'),
				'offer_id' => $_SESSION['affiliate_trans_id'],
				'lead_id_code' => Yii::app()->request->getParam('universal_leadid'),
				'trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
				'tcpa_compliant' => Yii::app()->request->getParam('tcpa_optin'),
				'tcpa_consent_text' => Yii::app()->request->getParam('tcpa_text'),
				'user_agent' => Yii::app()->request->getParam('user_agent'),
				'landing_page_url' => 'https://'.$url,
		    ],
		    'contact' => [
		    	'first_name'=> Yii::app()->request->getParam('first_name'),
		        'last_name'=> Yii::app()->request->getParam('last_name'),
		        'email'=> Yii::app()->request->getParam('email'),
		        'phone'=> Yii::app()->request->getParam('phone'),
		        'address'=> Yii::app()->request->getParam('address'),
		        'city'=> $city_state['city'],
		        'state'=> $city_state['state'],
	            "zip_code" => Yii::app()->request->getParam('zip'),
	            "ip_address" => Yii::app()->request->getParam('ipaddress'),
   			],
   			'data'=> [
				'best_call_time'=> "Anytime",
				'purchase_time_frame'=> $time_frame,
				'own_property'=> Yii::app()->request->getParam('home_owner') == 1 ? 'true' : 'false',
				'credit_rating' => self::$creditRating[Yii::app()->request->getParam('credit_rating','2')],
			]
		];
		if($project_type == 45 ){// SOLAR
			$monthly_bill = self::getMonthlyBill(Yii::app()->request->getParam('monthly_bill'));
			$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
			$utility_provider  = $project_provider['provider_name'];
			$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
			$property_type = self::getPropertyType(Yii::app()->request->getParam('property_type'));
			$campaign['monthly_electric_bill'] = $monthly_bill;
			$campaign['utility_provider'] = $utility_provider;
			$campaign['roof_shade'] = $roof_shade;
			$campaign['property_type'] = $property_type;
			$fields['data'] += $campaign;
			$apitoken = $p1 ? $p1 : 'c330e4bed0874c0a7244b2af6c726718efe4d675';
			$post_url = str_replace('home_improvement','solar',$ping_url);
		}else{ // HOME IMPROVEMENT
			if(!empty($jangl_project_array)){
				$campaign = [$variable[0] => $jangl_project_array];
				$fields['data'] += $campaign;
			}
			$apitoken = $p1 ? $p1 : '95804521031c698e3d51306392ef167eaf4fa0b3';
		}
		/*if(!empty($jangl_project_array)){
			$campaign = [$variable[0] => $jangl_project_array];
			$fields['data'] += $campaign;
		}*/

		$post_request = json_encode($fields);
        $header = [
            "authorization: Token $apitoken",
            "content-type: application/json",
        ];
        //echo '<pre>';print_r($post_request);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $post_response = $cm->curl($post_url, $post_request, $header);
		$time_end = CommonToolsMethods::stopwatch();
		$success = json_decode($post_response,TRUE);
		//echo '<pre>';print_r();die();
		if (isset($success['status']) && $success['status'] == 'success') {
			$post_status = '1';
            $redirect_url = '';
            $ping_success = json_decode($ping_response,TRUE);
            $post_price = isset($success['price']) ? $success['price'] : $ping_success['price'];
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