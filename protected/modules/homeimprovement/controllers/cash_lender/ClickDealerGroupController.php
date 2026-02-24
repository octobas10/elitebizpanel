<?php
class ClickDealerGroupController extends Controller {
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
	public static $tcpa_text = 'By clicking GET YOUR QUOTE, I agree to the Terms of Service and Privacy Policy, I authorize home improvement companies, their contractors and partner companies to contact me about home improvement offers by phone calls and text messages to the number I provided. I authorize that these marketing communications may be delivered to me using an automatic telephone dialing system or by prerecorded message. I understand that my consent is not a condition of purchase, and I may revoke that consent at any time. Mobile and data charges may apply. California Residents.';
    public static $not_allowed = ['casautilities.com','contractorscan.com','findmywindowpro.com','homeappointments.com','home-revivals.us','homewindowsurvey.com','homewindows.net','netwayi.com','nationwidewindows.online','nationalwindows.online','simplehome-quotes.com','adopt-a-contractor.com','findmyroofingpro.com','homefixwiz.com','helloprojectusa.com','home-improvements.co','homepros123.com','homequote.io','quotewallet.com','nationwideroofing.net','nationalroofing.online','parasolleads.com','top10us.com','thequotematch.com','asksolar.com','go4solarsavings.com','nationwidesolar.energy','smart-solar-savings-center.com','ready4solar.com','bathremodelspecialists.com','homelix.co','nationwidebathrooms.online','betterhomeupgrade.com','upgrades4myhome.com'];
    public static $creditRating = [
        1 => '5',
        2 => '4',
        3 => '3',
        4 => '2',
    ];
    public static $user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.94 Chrome/37.0.2062.94 Safari/537.36';
    /*=================================================*/
	public static $AirSubType = [
		1=>'1',
		2=>'1',
		3=>'1',
		4=>'1',
		5=>'2',
		6=>'2',
		7=>'2',
		8=>'2',
		9=>'3',
		10=>'4',
		11=>'1',
		12=>'2',
	];
	public static $AirSubTypeFuel = [
		1=>'1',
		2=>'2',
		3=>'4',
		4=>'3',
		5=>'1',
		6=>'2',
		7=>'3',
		8=>'4',
		9=>'5',
		10=>'1',
		11=>'1',
		12=>'2',
	];
    public static function getFloorMaterial($flooring_material){
    	switch ($flooring_material) {
			case '1':
				$f_type = '5';
				break;
			case '2':
				$f_type = '1';
				break;
			case '3':
				$f_type = '3';
				break;
			case '4':
				$f_type = '4';
				break;
			case '5':
				$f_type = '2';
				break;
			case '6':
				$f_type = '2';
				break;
			default:
				$f_type = '2';
				break;
		}
		return $f_type;
    }
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
	public static function getRoofShade($roof_shade){
    	switch ($roof_shade) {
			case '0':
				$roofshade = '1';
				break;
			case '1':
				$roofshade = '2';
				break;
			case '2':
				$roofshade = '3';
				break;
			case '3':
				$roofshade = '4';
				break;
			default:
				$roofshade = '4';
				break;
		}
		return $roofshade;
    }
	public static function getRoofingMatirialType($rooting_type){
    	switch ($rooting_type) {
			case '1':
				$roof_type = '1';
				break;
			case '2':
				$roof_type = '2';
				break;
			case '3':
				$roof_type = '3';
				break;
			case '4':
				$roof_type = '5';
				break;
			case '5':
				$roof_type = '6';
				break;
			case '6':
				$roof_type = '4';
				break;
			default:
				$roof_type = '1';
				break;
		}
		return $roof_type;
    }
	public static function getRoofingProperty($rooting_propety_type){
    	switch ($rooting_propety_type) {
			case '1':
				$roof_type = '2';
				break;
			case '2':
				$roof_type = '1';
				break;
			case '3':
				$roof_type = '3';
				break;
			case '4':
				$roof_type = '4';
				break;
			default:
				$roof_type = '1';
				break;
		}
		return $roof_type;
    }
	public static function getSidingMaterial($siding_type){
    	switch ($siding_type) {
			case '1':
				$side_type = '1';
				break;
			case '2':
				$side_type = '6';
				break;
			case '3':
				$side_type = '3';
				break;
			case '4':
				$side_type = '4';
				break;
			default:
				$side_type = '5';
				break;
		}
		return $side_type;
    }
	
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$project_type = Yii::app()->request->getParam('project_type');
		if($promo_code != 0){
			$pingData = [];
			$state_accepted = [];
			$cmp_key = '';
			/*============= COMMPLTED CATEGORIES ===========*/
			if($project_type == 27){ // FLOORING
				$cmp_key = 'mt248kuhir';
				$campaign['work_type'] = date('N')%2 == 0 ? '1' : '2';
				$projec_type = date('N')%2;
				$initial = $projec_type == 0 ? '1' : '2';
				$floor_material = self::getFloorMaterial(Yii::app()->request->getParam('flooring_type'));
				$campaign['project_total'] = $initial.'-'.$floor_material;
				$campaign['floor_material'] = $floor_material;
			}
			if($project_type == 33){ //HVAC
				$cmp_key = 'o8q7cvyk94';
				$campaign['project_type'] = date('N')%2;
				$campaign['project'] = Yii::app()->request->getParam('air_type')=='1' ? '2' : '1';
				$campaign['heating_system_type'] = self::$AirSubType[Yii::app()->request->getParam('air_sub_type')];
				$campaign['fuel'] = self::$AirSubTypeFuel[Yii::app()->request->getParam('air_sub_type')];
			}
			if($project_type == 42){ // ROOFING
				$cmp_key = 'pwt4oj60yk';
				$campaign['project'] = date('N')%2 == 0 ? '1' : '2';
				$roof_material = self::getRoofingMatirialType(Yii::app()->request->getParam('roofing_type'));
				$property_type =self::getRoofingProperty(Yii::app()->request->getParam('property_type'));
				$campaign['type_material'] = $property_type.'-'.$roof_material;
				$campaign['roof_material'] = $roof_material;
				$state_accepted = ['NJ','MA','WA','MD','CA','OR','FL','WI','IN','OH','PA','TX','TN','NC'];
			}
			if($project_type == 43){ // SIDING
				$cmp_key = '9cyblwzmok';
				$siding_material =self::getSidingMaterial(Yii::app()->request->getParam('siding_type'));
				$job_type = Yii::app()->request->getParam('job_type');
				$campaign['siding_material'] = $siding_material;
				$campaign['project'] = $job_type;
				$campaign['project_total'] = $job_type.'-'.$siding_material;
			}
			if($project_type == 45){ // SOLAR
				$cmp_key = 'rtqz2ji8h5';
				$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
				$ecw_utility_provider  = $project_provider['provider_name'];
				$campaign['electric_provider'] = $ecw_utility_provider;
				$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
				$campaign['roof_shade'] = $roof_shade;
				$campaign['electric_bill'] = Yii::app()->request->getParam('monthly_bill');
                $campaign['electric_utility_provider'] = $project_provider['provider_name'];
                $campaign['roof_shade'] = Yii::app()->request->getParam('roof_shade');
                $campaign['roof_type'] = self::getRooType(Yii::app()->request->getParam('roof_type','2'));
                $campaign['credit_rating'] = self::$creditRating[Yii::app()->request->getParam('credit_rating','2')];
                $campaign['solar_electric'] = date('N')%2 == 0 ? 'Yes' : 'No';
                $campaign['solar_hot_water'] = date('N')%2 == 0 ? 'Yes' : 'No';
                $campaign['solar_pool_heating'] = date('N')%2 == 0 ? 'Yes' : 'No';
                $campaign['property_type'] = date('N')%2 == 0 ? '1' : '2';
                $campaign['authorized_to_make_changes'] = 'Yes';
                $campaign['install_location'] = date('N')%2 == 0 ? '1' : '2';
				$state_accepted = ['AZ','CA','HI','NJ','FL','MA','NY','UT','IL','CT','OR','MD','CO'];
			}
			if($project_type == 52){ // WINDOWS
				$cmp_key = '7k2pj43usq';
				$campaign['project'] = date('N')%2 == 0 ? '2' : '3';
				$campaign['number'] = Yii::app()->request->getParam('number_of_windows');
			}
			if($cmp_key != ''){
				$fields = [
					'ip' => Yii::app()->request->getParam('ipaddress'),
					'useragent' => Yii::app()->request->getParam('user_agent',self::$user_agent),
					'country_iso_2' => 'US',
					'region' => Yii::app()->request->getParam('state',$city_state['state']),
					'city' => Yii::app()->request->getParam('city',$city_state['city']),
					'address' => Yii::app()->request->getParam('address'),
					'phone' => Yii::app()->request->getParam('phone'),
					'referrer' => Yii::app()->request->getParam('url','https://elitehomeinsurer.com'),
					'zipcode' => $zip_code,
					'journaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
					'trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
					'homeowner' => Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No',
					'time_to_call' => date('N')%2 == 0 ? '1' : '2',
					'trusted_form_cert_id' => 'NA',
					'authorized_to_make_changes' => 'Yes',
					'session_length' => '60',
					'project' => date('N')%2 == 0 ? '1' : '2',
					'tcpa_text' => Yii::app()->request->getParam('tcpa_text',self::$tcpa_text),
					//'ping_url' => $ping_url.'&cmp_key='.$cmp_key.'&post_test=true',
				];
				$fields += $campaign;
				//echo '<pre>';print_r($fields);exit;
				$purchase = true;
				$url = Yii::app()->request->getParam('url');
				if(in_array(self::getHost($url),self::$not_allowed)){
					$purchase = false;
				}
				if(!empty($state_accepted)){
					if(!in_array($city_state['state'],$state_accepted)){
						$purchase = false;
					}
				}
				if($purchase == true){
					$pingData['header'] = ["Accept: application/json"];
					$pingData['ping_url'] = $ping_url.'&cmp_key='.$cmp_key;
					$pingData['ping_request'] = http_build_query($fields);
				}else{
					$pingData['ping_request'] = false;
				}
			}else{
				$pingData['ping_request'] = false;
				$pingData['ping_response_filtered'] = 'Out of Given Categories';
			}
			//echo '<pre>';print_r($pingData);exit;
			return $pingData;
		}
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        $success = json_decode($ping_response,TRUE);
        if(!empty($success) && trim($success['Result']) == 'Success'){
            $ping_price = isset($success['Payout']) ? $success['Payout'] : 0;
            $confirmation_id = $success['PingId'];
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
		if($promo_code != 0){
			$success = json_decode($ping_response,TRUE);
			$confirmation_id = $success['PingId'];
			$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
			/*============= COMMPLTED CATEGORIES ===========*/
			if($project_type == 27){ // FLOORING
				$cmp_key = 'mt248kuhir';
				$campaign['work_type'] = date('N')%2 == 0 ? '1' : '2';
				$projec_type = date('N')%2;
				$initial = $projec_type == 0 ? '1' : '2';
				$floor_material = self::getFloorMaterial(Yii::app()->request->getParam('flooring_type'));
				$campaign['project_total'] = $initial.'-'.$floor_material;
				$campaign['floor_material'] = $floor_material;
			}
			if($project_type == 33){ //HVAC
				$cmp_key = 'o8q7cvyk94';
				$campaign['project_type'] = date('N')%2;
				$campaign['project'] = Yii::app()->request->getParam('air_type')=='1' ? '2' : '1';
				$campaign['heating_system_type'] = self::$AirSubType[Yii::app()->request->getParam('air_sub_type')];
				$campaign['fuel'] = self::$AirSubTypeFuel[Yii::app()->request->getParam('air_sub_type')];
			}
			if($project_type == 42){ // ROOFING
				$cmp_key = 'pwt4oj60yk';
				$campaign['project'] = date('N')%2 == 0 ? '1' : '2';
				$roof_material = self::getRoofingMatirialType(Yii::app()->request->getParam('roofing_type'));
				$property_type =self::getRoofingProperty(Yii::app()->request->getParam('property_type'));
				$campaign['type_material'] = $property_type.'-'.$roof_material;
				$campaign['roof_material'] = $roof_material;
			}
			if($project_type == 43){ // SIDING
				$cmp_key = '9cyblwzmok';
				$siding_material =self::getSidingMaterial(Yii::app()->request->getParam('siding_type'));
				$job_type = Yii::app()->request->getParam('job_type');
				$campaign['siding_material'] = $siding_material;
				$campaign['project'] = $job_type;
				$campaign['project_total'] = $job_type.'-'.$siding_material;
			}
			if($project_type == 45){ // SOLAR
				$cmp_key = 'rtqz2ji8h5';
				$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
				$ecw_utility_provider  = $project_provider['provider_name'];
				$campaign['electric_provider'] = $ecw_utility_provider;
				$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
				$campaign['roof_shade'] = $roof_shade;
				$campaign['electric_bill'] = Yii::app()->request->getParam('monthly_bill');
                $campaign['electric_utility_provider'] = $project_provider['provider_name'];
                $campaign['roof_shade'] = Yii::app()->request->getParam('roof_shade');
                $campaign['roof_type'] = self::getRooType(Yii::app()->request->getParam('roof_type','2'));
                $campaign['credit_rating'] = self::$creditRating[Yii::app()->request->getParam('credit_rating','2')];
                $campaign['solar_electric'] = date('N')%2 == 0 ? 'Yes' : 'No';
                $campaign['solar_hot_water'] = date('N')%2 == 0 ? 'Yes' : 'No';
                $campaign['solar_pool_heating'] = date('N')%2 == 0 ? 'Yes' : 'No';
                $campaign['property_type'] = date('N')%2 == 0 ? '1' : '2';
                $campaign['authorized_to_make_changes'] = 'Yes';
                $campaign['install_location'] = date('N')%2 == 0 ? '1' : '2';
			}
			if($project_type == 52){ // WINDOWS
				$cmp_key = '7k2pj43usq';
				$campaign['project'] = date('N')%2 == 0 ? '2' : '3';
				$campaign['number'] = Yii::app()->request->getParam('number_of_windows');
			}
			$fields = [
				'ping_id' => $confirmation_id,
                'first_name' => Yii::app()->request->getParam('first_name'),
                'last_name' => Yii::app()->request->getParam('last_name'),
                'email' => Yii::app()->request->getParam('email'),
                'ip' => Yii::app()->request->getParam('ipaddress'),
                'useragent' => Yii::app()->request->getParam('user_agent',self::$user_agent),
                'country_iso_2' => 'US',
                'region' => Yii::app()->request->getParam('state',$city_state['state']),
                'city' => Yii::app()->request->getParam('city',$city_state['city']),
                'address' => Yii::app()->request->getParam('address'),
                'phone' => Yii::app()->request->getParam('phone'),
                'referrer' => Yii::app()->request->getParam('url','https://elitehomeinsurer.com'),
                'zipcode' => $zip_code,
                'journaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
                'trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
                'homeowner' => Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No',
				'time_to_call' => date('N')%2 == 0 ? '1' : '2',
                'trusted_form_cert_id' => 'NA',
				'authorized_to_make_changes' => 'Yes',
                'session_length' => '60',
                'project' => date('N')%2 == 0 ? '1' : '2',
                'tcpa_text' => Yii::app()->request->getParam('tcpa_text',self::$tcpa_text),
                //'post_test' => true,
				//'post_url' => $post_url.'&cmp_key='.$cmp_key.'&post_test=true',
            ];
            $fields += $campaign;
			//echo '<pre>';print_r($fields);exit;
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			$header = ["Accept: application/json"];
			//$header = ["Content-Type: application/json"];
			$post_url = $post_url.'&cmp_key='.$cmp_key;
			$post_request = http_build_query($fields);
        	$post_response = $cm->curl($post_url,$post_request,$header);
			$time_end = CommonToolsMethods::stopwatch();
			$result = json_decode($post_response,TRUE);
            if(!empty($result) && trim($result['Result']) == 'Success'){
                $post_status = '1';
                $ping_price = isset($success['Payout']) ? $success['Payout'] : 0;
                $post_price = isset($result['Payout']) ? $result['Payout'] : 0;
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