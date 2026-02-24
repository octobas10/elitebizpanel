<?php
class HomeyouController extends Controller {
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
    public static $not_allowed = ['homeremodel.estate','nationalbathrooms.online','homewell.expert','sunforsolar.energy','cedartreemedia.com','bestamericanroofs.com','homerevampers.net','housefixers.online','fcsroofing.net','homerevitalize.cloud','contractor99.com','hottubpricer.com','getnewsidingtoday.com','bathremodelpros.net','koalatybath.com','bathremodel.io','qualifiedflooringsurvey.com','home-inspire.com','bathprofinder.com','homecontractors101.com','leadsstore.org','localsunrooms.com','improvehomesonline.com','yourhomeservicespath.com','thebathroomremodeling.com','lucsolarsavings.com','waterfiltrationcosts','generatorcosts.com','buildhouseservice.com','siding-costs.com','myhomesolarassist.com','stairlift-quotes.com','selectmyquotes.com','walk-inbathtubshop.com','stairlift-quotes.com','selectmyquotes.com','homesolarassistance.com','walkinbathtubservice.com','roofing.com','leadsstore.org','myhomequote.com','gosolarx.homes'];
    public static $creditRating = [
        1 => '5',
        2 => '4',
        3 => '3',
        4 => '2',
    ];
	public static $projectStatus = [
        1 => 'Ready to Hire',
        2 => 'Planning & Budgeting'
    ];
	public static $PurchaseTimeFrame = [
		1 => 'Timing is Flexible',
		2 => 'Within 1 week',
		3 => '1 - 2 Weeks',
		4 => 'More than 2 Weeks',
	];
    /*=================================================*/
    public static function getRooType($roof_type){
    	switch ($roof_type) {
			case '1':
				$r_type = '13';
				break;
			case '2':
				$r_type = '2';
				break;
			case '3':
				$r_type = '1';
				break;
			case '4':
				$r_type = '3';
				break;
			case '5':
				$r_type = '4';
				break;
			case '6':
				$r_type = '5';
				break;
			case '7':
				$r_type = '12';
				break;
			case '8':
				$r_type = '10';
				break;
			case '9':
				$r_type = '9';
				break;
			case '10':
				$r_type = '6';
				break;
			case '11':
				$r_type = '7';
				break;
			case '12':
				$r_type = '8';
				break;
			default:
				$r_type = '13';
				break;
		}
		return $r_type;
    }
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$zip_code = Yii::app()->request->getParam('zip');
		$submission_model = new Submissions();
		$project_type = Yii::app()->request->getParam('project_type');
		$task_name = Yii::app()->request->getParam('task');
		$project_task = explode('_',$task_name);
		//$project_type=32;$task=5;
		$service_id = $submission_model->getHomeYouVariables($project_type,$project_task[1]);
		if(!$service_id){
			$service_id = $submission_model->getHomeYouVariables($project_type);
		}
		//$service_id = 440;
		if($promo_code != 2){
			$pingData = [];
			$fields = [
				'campaign' => $p1 ? $p1 : 'elitecashwire',
				'campaign_token' => $p2 ? $p2 :'9223016cea1a42d15920d76502e19923ded5fcf2',
				'zipcode' => $zip_code,
				'status' => Yii::app()->request->getParam('project_status')=='0'?'Ready to Hire':'Ready to Hire',
				'source' => Yii::app()->request->getParam('promo_code','1'),
				'timeframe' => self::$PurchaseTimeFrame[Yii::app()->request->getParam('time_frame')],
                'certification_type' => 'TrustedForm',
				'ownhome' => Yii::app()->request->getParam('home_owner') == 1 ? 'Yes' : 'No',
				'description' =>  Yii::app()->request->getParam('comments'),
				'service' => $service_id,
            ];
			$purchase = true;
	        $url = Yii::app()->request->getParam('url');
	        if(in_array(self::getHost($url),self::$not_allowed)){
	        	$purchase = false;
	        }
	        if($purchase == true){
	            //$pingData['ping_request'] = http_build_query($fields);
	            $pingData['ping_request'] = json_encode($fields);
	            //$pingData['header'] = ["application/x-www-form-urlencoded"];
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
        $success = json_decode($ping_response);
        if($success->success == 'true' OR $success->success == '1'){
            $ping_price = isset($success->payout) ? $success->payout : 0;
            $confirmation_id = $success->lead_token;
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
		$project_type = Yii::app()->request->getParam('project_type');
		$task_name = Yii::app()->request->getParam('task');
		$project_task = explode('_',$task_name);
		//$project_type=32;$task=5;
		$service_id = $submission_model->getHomeYouVariables($project_type,$project_task[1]);
		if(!$service_id){
			$service_id = $submission_model->getHomeYouVariables($project_type);
		}
		//$service_id = 440;
		if($promo_code != 2){
			$ping_result = json_decode($ping_response);
			$confirmation_id = $ping_result->lead_token;
			$user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.94 Chrome/37.0.2062.94 Safari/537.36';
			$fields = [
				'campaign' => $p1 ? $p1 : 'elitecashwire',
				'campaign_token' => $p2 ? $p2 :'9223016cea1a42d15920d76502e19923ded5fcf2',
				'lead_token' => $confirmation_id,
				'status' => self::$projectStatus[Yii::app()->request->getParam('project_status',1)],
				'timeframe' => self::$PurchaseTimeFrame[Yii::app()->request->getParam('time_frame')],
				'ownhome' => Yii::app()->request->getParam('home_owner') == 1 ? 'Yes' : 'No',
                'firstname' => Yii::app()->request->getParam('first_name'),
                'lastname' => Yii::app()->request->getParam('last_name'),
				'street_address' => Yii::app()->request->getParam('address'),
				'city' => Yii::app()->request->getParam('city',$city_state['city']),
				'state' => Yii::app()->request->getParam('state',$city_state['state']),
				'zipcode' => $zip_code,
				'phone' => Yii::app()->request->getParam('phone'),
                'email' => Yii::app()->request->getParam('email'),
                'description' =>  Yii::app()->request->getParam('comments'),
                'ip_address' => Yii::app()->request->getParam('ipaddress'),
				'tcpa_consent' => Yii::app()->request->getParam('tcpa_optin') == '0' ? 'No' : 'Yes',
				'tcpa_consent_language' => Yii::app()->request->getParam('tcpa_text'),
				'certification_type' => 'TrustedForm',
				'certification_token' => Yii::app()->request->getParam('trustedformcerturl'),
                'useragent' => Yii::app()->request->getParam('user_agent',$user_agent),
                'source' => Yii::app()->request->getParam('promo_code'),
                'journayaleadid' => Yii::app()->request->getParam('universal_leadid'),
				'service' => $service_id,
            ];
			//$fields += $campaign;
			//$post_request = http_build_query($fields);
			$post_request = json_encode($fields);
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			//$header = ["application/x-www-form-urlencoded"];
			$header = ["Content-Type: application/json"];
        	$post_response = $cm->curl($post_url,$post_request,$header);
			$time_end = CommonToolsMethods::stopwatch();
			$result = json_decode($post_response);
            if($result->success == 'true' OR $result->success ==1){
                $post_status = '1';
                $ping_price = isset($ping_result->payout) ? $ping_result->payout : 0;
                $post_price = isset($result->payout) ? $result->payout : 0;
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
}