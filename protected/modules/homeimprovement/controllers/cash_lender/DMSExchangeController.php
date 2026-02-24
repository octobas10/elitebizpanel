<?php
class DMSExchangeController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
   	public static $tcpa_text = 'By clicking GET YOUR QUOTE, I agree to the Terms of Service and Privacy Policy, I authorize home improvement companies, their contractors and partner companies to contact me about home improvement offers by phone calls and text messages to the number I provided. I authorize that these marketing communications may be delivered to me using an automatic telephone dialing system or by prerecorded message. I understand that my consent is not a condition of purchase, and I may revoke that consent at any time. Mobile and data charges may apply. California Residents.';
    public static function getHost($url, $accept_www=false){
	    $url = str_replace(["%3A","%2F"],[':','/'],$url);
	    $URIs = parse_url(trim($url)); 
	    $host = !empty($URIs['host'])? $URIs['host'] : explode('/', $URIs['path'])[0];
	    return $accept_www == false? str_ireplace('www.', '', $host) : $host;  
	} 
    public static $not_allowed = ['casautilities.com','contractorscan.com','findmywindowpro.com','homeappointments.com','home-revivals.us','homewindowsurvey.com','homewindows.net','netwayi.com','nationwidewindows.online','nationalwindows.online','simplehome-quotes.com','adopt-a-contractor.com','findmyroofingpro.com','homefixwiz.com','helloprojectusa.com','home-improvements.co','homepros123.com','homequote.io','quotewallet.com','nationwideroofing.net','nationalroofing.online','parasolleads.com','top10us.com','thequotematch.com','asksolar.com','go4solarsavings.com','nationwidesolar.energy','smart-solar-savings-center.com','ready4solar.com','bathremodelspecialists.com','homelix.co','nationwidebathrooms.online','betterhomeupgrade.com','upgrades4myhome.com'];
    public static $user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.94 Chrome/37.0.2062.94 Safari/537.36';
    /**=================**/
    public static function getPurchaseTimeFrame($time_frame){
    	switch ($time_frame) {
			case '1':
				$purchase_time_frame = 'Immediately';
				break;
			case '2':
				$purchase_time_frame = '1-6 months';
				break;
			case '3':
				$purchase_time_frame = 'Don\'t know';
				break;
			case '4':
				$purchase_time_frame = 'Don\'t know';
				break;
			case '5':
				$purchase_time_frame = 'Don\'t know';
				break;
			default:
				$purchase_time_frame = 'Immediately';
				break;
		}
		return $purchase_time_frame;
    }
    public static function getPropertyType($property_type){
    	switch ($property_type) {
			case '1':
				$propertytype = 'Single Family';
				break;
			case '2':
				$propertytype = 'Single Family';
				break;
			case '3':
				$propertytype = 'Townhome';
				break;
			case '4':
				$propertytype = 'Condominium';
				break;
			case '5':
				$propertytype = 'Condominium';
				break;
			case '6':
				$propertytype = 'Mobile Home';
				break;
			default:
				$propertytype = 'Manufactured';
				break;
		}
		return $propertytype;
    }
    public static function getFlooringType($flooring_type){
    	switch ($flooring_type) {
			case '1':
				$floor_type = 'Wood Floor';
				break;
			case '2':
				$floor_type = 'Vinyl';
				break;
			case '3':
				$floor_type = 'Carpet';
				break;
			case '4':
				$floor_type = 'Tile';
				break;
			case '5':
				$floor_type = 'Linoleum';
				break;
			default:
				$floor_type = 'Carpet';
				break;
		}
		return $floor_type;
    }
    public static function getHVACRequest($category_type){
    	switch ($category_type) {
			case '33_1':
				$heat_type = 'install_radiant_floooring';
				break;
			case '33_2':
				$heat_type = 'install_boiler_furnace';
				break;
			case '33_3':
				$heat_type = 'repair_boiler_furnace';
				break;
			case '33_4':
				$heat_type = 'repair_radiant_floooring';
				break;
			case '33_5':
				$heat_type = 'install_heat_pump';
				break;
			case '33_6':
				$heat_type = 'repair_heat_pump';
				break;
			case '33_7':
				$heat_type = 'install_baseboard_heat';
				break;
			case '33_8':
				$heat_type = 'repair_ductless_ac';
				break;
			default:
				$heat_type = 'Other';
				break;
		}
		return $heat_type;
    }
    public static function getHVACHeatType($category_type){
    	switch ($category_type) {
			case '1':
				$category = 'Gas Furnace';
				break;
			case '2':
				$category = 'propane';
				break;
			case '3':
				$category = 'propane';
				break;
			case '4':
				$category = 'electric';
				break;
			case '5':
				$category = 'natural_gas';
				break;
			case '6':
				$category = 'propane';
				break;
			case '7':
				$category = 'oil';
				break;
			case '8':
				$category = 'electric';
				break;
			case '9':
				$category = 'natural_gas';
				break;
			case '10':
				$category = 'propane';
				break;
			case '11':
				$category = 'oil';
				break;
			case '12':
				$category = 'oil';
				break;
			case '13':
				$category = 'natural_gas';
				break;
			default:
				$category = 'dont know';
				break;
		}
		return $category;
    }
    public static function getBathroomProjectType($category_type){
    	switch ($category_type) {
			case '13_1':
				$bath_type = 'Sinks';
				break;
			case '13_2':
				$bath_type = 'Full Bathroom';
				break;
			case '13_3':
				$bath_type = 'Tile';
				break;
			case '13_4':
				$bath_type = 'Countertop';
				break;
			case '13_5':
				$bath_type = 'Cabinets';
				break;
			case '13_6':
				$bath_type = 'Floor Plan';
				break;
			case '13_7':
				$bath_type = 'Tub or Shower';
				break;
			default:
				$bath_type = 'Other';
				break;
		}
		return $bath_type;
    }

    public static function getRoofShade($roof_shade){
    	switch ($roof_shade) {
			case '0':
				$roofshade = 'No Shade';
				break;
			case '1':
				$roofshade = 'A little shade';
				break;
			case '2':
				$roofshade = 'A lot of Shade';
				break;
			case '3':
				$roofshade = 'Uncertain';
				break;
			default:
				$roofshade = 'A lot of Shade';
				break;
		}
		return $roofshade;
    }
    public static $electric_bill = ['Under $100','$100 - $200','$200 - $300','$100 - $200','$100 - $200','$200 - $300','$300+'];
    public static $gutters = ['copper_install','copper_repair','downspouts_and_accessories_install','downspouts_and_accessories_repair','galvanized_metal_install','galvanized_metal_repair','pvc_install','pvc_repair','seamless_metal_install','seamless_metal_repair','wood_install','wood_repair'];

    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$sub1 = Yii::app()->request->getParam('sub_id');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$project_type = Yii::app()->request->getParam('project_type');
		$task = Yii::app()->request->getParam('task');
		if($promo_code != 0){
			$pingData = [];
			//=============== START FROM HERE =============
			if($project_type == 13){ // BATH
				$campaign_key = '606b3bff08fc6ad8ad0f2728783b6eb9';
        		$campaign['bathroom_project_type'] = self::getBathroomProjectType($task);
			}
			if($project_type == 27){ // FLOORING
				$campaign_key = '10ce2ad9fe0dde9c76f3cd2a5e0b63ce';
        		$campaign['floor_type'] = self::getFlooringType(Yii::app()->request->getParam('flooring_type'));;
			}
			if($project_type == 30){ // GUTTERS
				$campaign_key = 'f3c5a2a661c46511dcb0c2e795aaec88';
				$campaign['roof_shade'] = self::getRoofShade(Yii::app()->request->getParam('roof_shade',rand(1,2)));
				$campaign['gutter_type'] = self::$gutters[date("m")];
			}
			if($project_type == 33){ //HVAC
				$campaign_key = 'c902a9eb9c33de6fc4afac4674a94e59';
				$air_sub_type = self::getHVACRequest($task);
				$property_type = date('N')%2;
				$initial = $property_type == 0 ? 'install' : 'repair';
				$campaign['category'] = $initial.'_'.$air_sub_type;
				$heat_type = self::getHVACHeatType(Yii::app()->request->getParam('air_sub_type',rand(1,2)));
				$campaign['heat_type'] = $heat_type;
			}
			if($project_type == 38){ // PAINTING
				$campaign_key = '685bf2ffc99ddf2a55db10a7b6b6ffa9';
			}
			if($project_type == 40){ // PLUMBING
				$campaign_key = 'e718ef7dfe7a3b63193166e5d399716b';
			}
			if($project_type == 45){ // SOLAR
				$campaign_key = '8d7c82d8d9f2a8ac5371100a6cdb9d76';
				$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
				$ecw_utility_provider  = $project_provider['provider_name'];
				$dms_utility_provider = $submission_model->getDMSUtilityProviderById($ecw_utility_provider);
				$utility_provider  = $dms_utility_provider['provider'];
				$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
				$campaign['electric_provider'] = $utility_provider;
				$campaign['roof_shade'] = $roof_shade;
				$campaign['electric_bill'] = self::$electric_bill[date('N')];
			}
			if($project_type == 45){
				$fields = [
					'firstname' => Yii::app()->request->getParam('first_name'),
	                'lastname' => Yii::app()->request->getParam('last_name'),
	                'zipcode' => $zip_code,
	                'phone' => Yii::app()->request->getParam('phone'),
	                'email' => Yii::app()->request->getParam('email'),
	                'ip' => Yii::app()->request->getParam('ipaddress'),
	                'city' => Yii::app()->request->getParam('city',$city_state['city']),
	                'state' => Yii::app()->request->getParam('state',$city_state['state']),
	                'url_consent' => 'Yes',
	                'consent_time' => date('y-m-d h:m:s'),
	                'tcpa_text'=> Yii::app()->request->getParam('tcpa_text',self::$tcpa_text),
	                'project_type'=> ['new','repair','replace','service','new','repair','new'][date("N")],
	                'BuyTimeframe' => self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2))),
	                'homeowner' => Yii::app()->request->getParam('home_owner')=='1' ? 'true' : 'false',
	                'property_type' => self::getPropertyType(Yii::app()->request->getParam('property_type')),
	                'jornayaleadid' => Yii::app()->request->getParam('universal_leadid'),
	                'xx_trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
	                'time_to_call' => 'any time',
	                'user_agent' => self::$user_agent,
	                'sub1' => $sub1,
	                'sub2' => '',
	                'utm_campaign' => $promo_code,
	                'ping_url' => $ping_url.'/'.$campaign_key.'/ping?format=json',
	            ];
				$fields += $campaign;
				$purchase = true;
		        $url = Yii::app()->request->getParam('url');
		        if(in_array(self::getHost($url),self::$not_allowed)){
		        	$purchase = false;
		        }
		        if($purchase == true){
		        	$pingData['ping_url'] = $ping_url.'/'.$campaign_key.'/ping?format=json';
		        	$pingData['header'] = ["Content-Type: application/json"];
		            $pingData['ping_request'] = json_encode($fields);
		        }else{
		            $pingData['ping_request'] = false;
		        }
		        return $pingData;
	    	}
		}
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
		$promo_code = Yii::app()->request->getParam('promo_code');
		$sub1 = Yii::app()->request->getParam('sub_id');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$project_type = Yii::app()->request->getParam('project_type');
		$task = Yii::app()->request->getParam('task');
		if($promo_code != 0){
			$success = json_decode($ping_response,TRUE);
			$confirmation_id = $success['resvcode'];
			//=============== START FROM HERE =============
			if($project_type == 13){ // BATH
				$campaign_key = '606b3bff08fc6ad8ad0f2728783b6eb9';
        		$campaign['bathroom_project_type'] = self::getBathroomProjectType($task);
			}
			if($project_type == 27){ // FLOORING
				$campaign_key = '10ce2ad9fe0dde9c76f3cd2a5e0b63ce';
        		$campaign['floor_type'] = self::getFlooringType(Yii::app()->request->getParam('flooring_type'));;
			}
			if($project_type == 30){ // GUTTERS
				$campaign_key = 'f3c5a2a661c46511dcb0c2e795aaec88';
				$campaign['roof_shade'] = self::getRoofShade(Yii::app()->request->getParam('roof_shade',rand(1,2)));
				$campaign['gutter_type'] = self::$gutters[date("m")];
			}
			if($project_type == 33){ //HVAC
				$campaign_key = 'c902a9eb9c33de6fc4afac4674a94e59';
				$air_sub_type = self::getHVACRequest($task);
				$property_type = date('N')%2;
				$initial = $property_type == 0 ? 'install' : 'repair';
				$campaign['category'] = $initial.'_'.$air_sub_type;
				$heat_type = self::getHVACHeatType(Yii::app()->request->getParam('air_sub_type',rand(1,2)));
				$campaign['heat_type'] = $heat_type;
			}
			if($project_type == 38){ // PAINTING
				$campaign_key = '685bf2ffc99ddf2a55db10a7b6b6ffa9';
			}
			if($project_type == 40){ // PLUMBING
				$campaign_key = 'e718ef7dfe7a3b63193166e5d399716b';
			}
			if($project_type == 45){ // SOLAR
				$campaign_key = '8d7c82d8d9f2a8ac5371100a6cdb9d76';
				$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
				$ecw_utility_provider  = $project_provider['provider_name'];
				$dms_utility_provider = $submission_model->getDMSUtilityProviderById($ecw_utility_provider);
				$utility_provider  = $dms_utility_provider['provider'];
				$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
				$campaign['electric_provider'] = $utility_provider;
				$campaign['roof_shade'] = $roof_shade;
				$campaign['electric_bill'] = self::$electric_bill[date('N')];
			}
			$fields = [
				'resvcode' => $confirmation_id,
				'firstname' => Yii::app()->request->getParam('first_name'),
                'lastname' => Yii::app()->request->getParam('last_name'),
                'zipcode' => $zip_code,
                'phone' => Yii::app()->request->getParam('phone'),
                'email' => Yii::app()->request->getParam('email'),
                'ip' => Yii::app()->request->getParam('ipaddress'),
                'city' => Yii::app()->request->getParam('city',$city_state['city']),
                'state' => Yii::app()->request->getParam('state',$city_state['state']),
                'url_consent' => Yii::app()->request->getParam('url','https://mortgagefinder.com'),
                'consent_time' => date('y-m-d h:m:s'),
                'tcpa_text'=> Yii::app()->request->getParam('tcpa_text',self::$tcpa_text),
                'project_type'=> ['new','repair','replace','service','new','repair','new'][date("N")],
                'BuyTimeframe' => self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2))),
                'homeowner' => Yii::app()->request->getParam('home_owner')=='1' ? 'true' : 'false',
                'property_type' => self::getPropertyType(Yii::app()->request->getParam('property_type')),
                'jornayaleadid' => Yii::app()->request->getParam('universal_leadid'),
                'xx_trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
                'time_to_call' => 'any time',
                'user_agent' => self::$user_agent,
                'sub1' => $sub1,
                'sub2' => '',
                'utm_campaign' => $promo_code,
                'post_url' => $post_url.'/'.$campaign_key.'/post?format=json',
            ];
			$fields += $campaign;
			$post_request = json_encode($fields);
			//echo '<pre>';print_r($post_request);
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			//$header = ["application/x-www-form-urlencoded"];
			$header = ["Content-Type: application/json"];
			$post_url = $post_url.'/'.$campaign_key.'/post?format=json';
        	$post_response = $cm->curl($post_url,$post_request,$header);
			$time_end = CommonToolsMethods::stopwatch();
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
}