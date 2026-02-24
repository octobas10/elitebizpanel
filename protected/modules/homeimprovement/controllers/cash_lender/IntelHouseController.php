<?php
class IntelHouseController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
	// ============ NEW DATA ========
	public static function getBathroomProjectType($category_type){
    	switch ($category_type) {
			case '13_1':
				$bath_type = 'bathtub_liner';
				break;
			case '13_2':
				$bath_type = 'full_remodel';
				break;
			case '13_3':
				$bath_type = 'walk_in_tub';
				break;
			case '13_4':
				$bath_type = 'countertops';
				break;
			case '13_5':
				$bath_type = 'cabinets_vanity';
				break;
			case '13_6':
				$bath_type = 'flooring';
				break;
			case '13_7':
				$bath_type = 'other';
				break;
			default:
				$bath_type = 'walk_in_tub';
				break;
		}
		return $bath_type;
    }
	public static function getPurchaseTimeFrame($time_frame){
    	switch ($time_frame) {
			case '1':
				$purchase_time_frame = 'immediately';
				break;
			case '2':
				$purchase_time_frame = 'within_1_months';
				break;
			case '3':
				$purchase_time_frame = '1_3_months';
				break;
			case '4':
				$purchase_time_frame = '1_3_months';
				break;
			case '5':
				$purchase_time_frame = '3_months';
				break;
			default:
				$purchase_time_frame = '3_months';
				break;
		}
		return $purchase_time_frame;
    }
	public static $AirType = [
		1=>'cooling',
		2=>'heating',
		3=>'cooling',
	];
	public static $AirSubType = [
		1=>'gas_furnace',
		2=>'propane_furnace',
		3=>'oil_furnace',
		4=>'electric_furnace',
		5=>'gas_boiler',
		6=>'propane_boiler',
		7=>'oil_boiler',
		8=>'electric_boiler',
		9=>'central_ac',
		10=>'heat_pump',
		11=>'water_heater',
		12=>'ductless_ac',
		13=>'duct_ac'
	];
	public static function getRoofingMatirialType($rooting_type){
    	switch ($rooting_type) {
			case '1':
				$roof_type = 'asphalt_shingle';
				break;
			case '2':
				$roof_type = 'cedar_shake';
				break;
			case '3':
				$roof_type = 'metal';
				break;
			case '4':
				$roof_type = 'tar';
				break;
			case '5':
				$roof_type = 'tile';
				break;
			case '6':
				$roof_type = 'natural_slate';
				break;
			default:
				$roof_type = 'asphalt_shingle';
				break;
		}
		return $roof_type;
    }
	public static $ElectricityBill = [
		1=>'less_than_100',
		2=>'100_149',
		3=>'150_199',
		4=>'200_249',
		5=>'250_299',
		6=>'300_349',
		7=>'more_than_350',
		8=>'not_sure',
		9=>'not_sure',
		10=>'not_sure',
		11=>'not_sure',
	];
	public static $GenericRepair = ['pex_repipe','copper_repipe','full_residential_repipe','appliance_repair','basement_drainage_channel','bathtubs','commercial_industrial_plumbing','faucets_fixtures_pipes','gas_pipes','general_repair','leak_detection_and_repair','remodeling_and_construction','sewer_and_drain','showers','solar_water_heater_system','sump_pump','tank','toilet','water_heater','water_or_fuel_tank','water_treatment_or_purification','well_pump','other'];
	public static function getSidingType($siding_type){
    	switch ($siding_type) {
			case '1':
				$side_type = 'vinyl';
				break;
			case '2':
				$side_type = 'wood';
				break;
			case '3':
				$side_type = 'stucco';
				break;
			case '4':
				$side_type = 'brick_or_stone';
				break;		
			default:
				$side_type = 'aluminum';
				break;
		}
		return $side_type;
    }
	public static function getRoofShade($roof_shade){
    	switch ($roof_shade) {
			case '0':
				$roofshade = 'partially_shaded';
				break;
			case '1':
				$roofshade = 'partially_shaded';
				break;
			case '2':
				$roofshade = 'no_shade';
				break;
			case '3':
				$roofshade = 'uncertain';
				break;
			default:
				$roofshade = 'no_shade';
				break;
		}
		return $roofshade;
    }
	public static function getFloorMaterial($flooring_material){
    	switch ($flooring_material) {
			case '1':
				$f_type = 'granite';
				break;
			case '2':
				$f_type = 'vinyl';
				break;
			case '3':
				$f_type = 'carpet';
				break;
			case '4':
				$f_type = 'tile';
				break;
			case '5':
				$f_type = 'composite';
				break;
			case '6':
				$f_type = 'laminate';
				break;
			default:
				$f_type = 'wooden';
				break;
		}
		return $f_type;
    }
	public static $CreditRating = [
		1=>'excellent',
		2=>'good',
		3=>'fair',
		4=>'poor',
	];
	public static $SolarRoofType = [
		1=>'tile',
		2=>'shake_shingle',
		3=>'flat',
		4=>'gable',
		5=>'cross_gabled',
		6=>'cross_hipped',
		7=>'flat',
		8=>'gable',
		9=>'gable',
		10=>'gable',
		11=>'gable',
		12=>'gable',
	];
	public static $JobType = [
		1=>'install',
		2=>'repair',
		3=>'replace',
	];
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$pingData = [];
        $submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$project_type = Yii::app()->request->getParam('project_type');
		$task = Yii::app()->request->getParam('task');
		if($project_type == 13){ //BATHROOM
			$campaign['project_type'] = self::getBathroomProjectType($task);
			$api_key = '8E3D9096-B415-48B1-ADEA-2D539D7CB90B';
		}
		if($project_type == 27){ //FLOORING
			$campaign['project_type'] = ['install','replace','repair'][rand(0,2)];
			$campaign['flooring_type'] = self::getFloorMaterial(Yii::app()->request->getParam('flooring_type'));
			$api_key = '4B67C064-EFFD-433C-AEC0-131718C47972';
		}
		if($project_type == 33){ //HVAC
			$campaign['project_type'] = ['install','repair'][rand(0,1)];
			$campaign['air_type'] = self::$AirType[Yii::app()->request->getParam('air_type',rand(1,2))];
			$campaign['system_type'] = self::$AirSubType[Yii::app()->request->getParam('air_sub_type',rand(1,2))];
			$api_key = 'AF8B17F3-1BA6-4EB3-819F-836CD0A15A63';
		}
        if($project_type == 40){// PLUMBING
			$campaign['project_type'] = self::$GenericRepair[rand(0,23)];
			$api_key = 'D7FCC6EC-F018-4FD2-86E3-DE4F88C53AA0';
        }
		if($project_type == 42){// ROOFING
			$campaign['project_type'] = ['new_home','existing_home','repair'][rand(0,2)];
			$campaign['roofing_type'] = self::getRoofingMatirialType(Yii::app()->request->getParam('roofing_type'));
			$api_key = 'ACC1E331-A2F7-4619-935B-A42981CFF6C6';
        }
		if($project_type == 43){ // SIDING
			$campaign['siding_type'] = self::getSidingType(Yii::app()->request->getParam('siding_type',rand(1,2)));
			$campaign['project_type'] = self::$JobType[Yii::app()->request->getParam('job_type','2')];
			$api_key = 'BC17E99E-8CAB-45DC-BF1C-9DC4C305DA01';
		}
		if($project_type == 45){// SOLAR
			$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
			$campaign['project_type'] = ['new_home','existing_home','repair'][rand(0,2)];
			$campaign['utility_provider'] = $project_provider['provider_name'];
			$campaign['shade'] = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
			$campaign['electric_bill'] = self::$ElectricityBill[Yii::app()->request->getParam('monthly_bill',rand(1,10))];
			$campaign['credit'] = self::$CreditRating[Yii::app()->request->getParam('credit_rating','2')];
			$campaign['roof_type'] = self::$SolarRoofType[Yii::app()->request->getParam('roof_type','2')];
			$api_key = 'BA33EE49-9445-49F9-A180-55E64952F994';
        }
		if($project_type == 52){ //WINDOWS
			$campaign['windows'] = Yii::app()->request->getParam('number_of_rooms',rand(1,2));
			$campaign['nature'] = ['replace','repair'][rand(0,1)];
			$api_key = '0077611A-9C21-4300-8030-CAD52DD6939F';
		}
		$fields = [
			'api_key' => $api_key,
			'source' => Yii::app()->request->getParam('promo_code'),
			'postcode' => $zip_code,
			'purchase_time' => self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2))),
			'homeowner' => $campaign['Homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'yes' : 'no',
			'trusted_form_token' => Yii::app()->request->getParam('trustedformcerturl',0),
			'universal_lead_id' => Yii::app()->request->getParam('universal_leadid'),
			'landing_page' => Yii::app()->request->getParam('url','https://elitehomeimprovers.com'),
			'ip' => Yii::app()->request->getParam('ipaddress'),
			'tcpa_text' =>Yii::app()->request->getParam('tcpa_text'),
			's1' => Yii::app()->session['affiliate_trans_id'],
    	];
        $fields += $campaign;
		//echo '<pre>';print_r($fields);exit;
		$pingData['ping_request'] = http_build_query($fields);
		$pingData['header'] = ["content-type:application/x-www-form-urlencoded"];
		//echo '<pre>';print_r($pingData);exit;
		return $pingData;
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
    	$result = json_decode($ping_response,TRUE);
        if (trim($result['status']) == 'success') {
            $ping_price = isset($result['price']) ? $result['price'] : 0;
            $confirmation_id = $result['lead_id'];
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
		$lead_id = $result['lead_id'];
		$project_type = Yii::app()->request->getParam('project_type');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$task = Yii::app()->request->getParam('task');
		if($project_type == 13){ //BATHROOM
			$campaign['project_type'] = self::getBathroomProjectType($task);
			$api_key = '8E3D9096-B415-48B1-ADEA-2D539D7CB90B';
		}
		if($project_type == 27){ //FLOORING
			$campaign['project_type'] = ['install','replace','repair'][rand(0,2)];
			$campaign['flooring_type'] = self::getFloorMaterial(Yii::app()->request->getParam('flooring_type'));
			$api_key = '4B67C064-EFFD-433C-AEC0-131718C47972';
		}
		if($project_type == 33){ //HVAC
			$campaign['project_type'] = ['install','repair'][rand(0,1)];
			$campaign['air_type'] = self::$AirType[Yii::app()->request->getParam('air_type',rand(1,2))];
			$campaign['system_type'] = self::$AirSubType[Yii::app()->request->getParam('air_sub_type',rand(1,2))];
			$api_key = 'AF8B17F3-1BA6-4EB3-819F-836CD0A15A63';
		}
        if($project_type == 40){// PLUMBING
			$campaign['project_type'] = self::$GenericRepair[rand(0,23)];
			$api_key = 'D7FCC6EC-F018-4FD2-86E3-DE4F88C53AA0';
        }
		if($project_type == 42){// ROOFING
			$campaign['project_type'] = ['new_home','existing_home','repair'][rand(0,2)];
			$campaign['roofing_type'] = self::getRoofingMatirialType(Yii::app()->request->getParam('roofing_type'));
			$api_key = 'ACC1E331-A2F7-4619-935B-A42981CFF6C6';
        }
		if($project_type == 43){ // SIDING
			$campaign['siding_type'] = self::getSidingType(Yii::app()->request->getParam('siding_type',rand(1,2)));
			$campaign['project_type'] = self::$JobType[Yii::app()->request->getParam('job_type','2')];
			$api_key = 'BC17E99E-8CAB-45DC-BF1C-9DC4C305DA01';
		}
		if($project_type == 45){// SOLAR
			$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
			$campaign['project_type'] = ['new_home','existing_home','repair'][rand(0,2)];
			$campaign['utility_provider'] = $project_provider['provider_name'];
			$campaign['shade'] = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
			$campaign['electric_bill'] = self::$ElectricityBill[Yii::app()->request->getParam('monthly_bill',rand(1,10))];
			$campaign['credit'] = self::$CreditRating[Yii::app()->request->getParam('credit_rating','2')];
			$campaign['roof_type'] = self::$SolarRoofType[Yii::app()->request->getParam('roof_type','2')];
			$api_key = 'BA33EE49-9445-49F9-A180-55E64952F994';
        }
		if($project_type == 52){ //WINDOWS
			$campaign['windows'] = Yii::app()->request->getParam('number_of_rooms',rand(1,2));
			$campaign['nature'] = ['replace','repair'][rand(0,1)];
			$api_key = '0077611A-9C21-4300-8030-CAD52DD6939F';
		}
		$fields = [
			'api_key' => $api_key,
			'lead_id' => $lead_id,
			'source' => Yii::app()->request->getParam('promo_code'),
			'postcode' => $zip_code,
			'purchase_time' => self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2))),
			'homeowner' => $campaign['Homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'yes' : 'no',
			'trusted_form_token' => Yii::app()->request->getParam('trustedformcerturl',0),
			'universal_lead_id' => Yii::app()->request->getParam('universal_leadid'),
			'landing_page' => Yii::app()->request->getParam('url','https://elitehomeimprovers.com'),
			'ip' => Yii::app()->request->getParam('ipaddress'),
			'first_name' => Yii::app()->request->getParam('first_name'),
			'last_name' => Yii::app()->request->getParam('last_name'),
			'email' => Yii::app()->request->getParam('email'),
			'phone' => Yii::app()->request->getParam('phone'),
			'city' => Yii::app()->request->getParam('city',$city_state['city']),
			'state' => Yii::app()->request->getParam('state',$city_state['state']),
			'address' => Yii::app()->request->getParam('address'),
			'best_call_time'=>['morning','afternoon','evening','anytime'][rand(0,3)],
			'tcpa_text' =>Yii::app()->request->getParam('tcpa_text'),
			's1' => Yii::app()->session['affiliate_trans_id'],
    	];
		$fields += $campaign;
		//echo '<pre>';print_r($fields);exit;
		$post_request = http_build_query($fields);
		$header = ["content-type: application/x-www-form-urlencoded"];
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $post_response = $cm->curl($post_url, $post_request,$header);
		$time_end = CommonToolsMethods::stopwatch();
		$success = json_decode($post_response,TRUE);
		if (trim($success['status']) == 'success') {
			$post_status = '1';
            $redirect_url = '';
            $ping_success = json_decode($ping_response,TRUE);
            $post_price = isset($success['price']) ? $success['price'] : $ping_success['price'];
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
		$post_responses['post_fail_reason'] = '';
		//echo '<pre>';print_r($post_responses);die();
		return $post_responses;
    }
}