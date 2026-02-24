<?php
class RemodelwellController extends Controller {
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

    public static $not_allowed = ['casautilities.com','contractorscan.com','findmywindowpro.com','homeappointments.com','home-revivals.us','homewindowsurvey.com','homewindows.net','netwayi.com','nationwidewindows.online','nationalwindows.online','simplehome-quotes.com','adopt-a-contractor.com','casautilities.com','findmyroofingpro.com','homefixwiz.com','helloprojectusa.com','home-improvements.co','homepros123.com','homequote.io','quotewallet.com','nationwideroofing.net','nationalroofing.online','parasolleads.com','top10us.com','thequotematch.com','asksolar.com','go4solarsavings.com','nationwidesolar.energy','smart-solar-savings-center.com','ready4solar.com','bathremodelspecialists.com','homelix.co','nationwidebathrooms.online','Freshhammer.com','Fixerjoe.com','upgrades4myhome.com','betterhomeupgrade.com','smarthouseupgrades.com','nationalgutterupgrades.com','nationalbathroomupgrades.com','nationalsidingupgrades.com','nationalwindowsupgrades.com','nationalroofingupgrades.com','nationalsolarupgrades.com','nationalpaintingupgrades.com','nationalhvacupgrades.com','nationalkitchenupgrades.com','solaronlinesurvey.com','ready4solar.com','go4solarsavings.com','solarsurveyquote.com','gowithsolarenergy.com','Ehomeimprovementquotes.com','Billy.com','Buyerlink.com','Remodelwell.com','Thedoorstepservices.com','contractors99.com'];

    public static $creditRating = [
        1 => 'Excellent',
        2 => 'Good',
        3 => 'Average',
        4 => 'Poor',
    ];
    public static $windowNumber = [
        1 => '1',
        2 => '2',
        3 => '3-5',
        4 => '3-5',
        5 => '3-5',
        6 => '6-9',
        7 => '6-9',
        8 => '6-9',
        9 => '6-9',
        9 => '10+',
    ];
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
    public static function getElectricityBill($electricity_bill){

    	switch ($electricity_bill) {
			case '1':
				$ele_bill = '$0-50';
				break;
			case '2':
				$ele_bill = '$51-100';
				break;
			case '3':
				$ele_bill = '$101-150';
				break;
			case '4':
				$ele_bill = '$151-200';
				break;
			case '5':
				$ele_bill = '$201-300';
				break;
			case '6':
				$ele_bill = '$301-400';
				break;
			case '7':
				$ele_bill = '$401-500';
				break;
			case '8':
				$ele_bill = '$501-600';
				break;
			case '9':
				$ele_bill = '$601-700';
				break;
			case '10':
				$ele_bill = '$701-800';
				break;
			case '11':
				$ele_bill = '$801+';
				break;
		}
		return $ele_bill;
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
				$purchase_time_frame = '3+ months';
				break;
			case '5':
				$purchase_time_frame = '3+ months';
				break;
			default:
				$purchase_time_frame = 'Within 1 months';
				break;
		}
		return $purchase_time_frame;
    }
    public static function getPropertyType($property_type){
    	switch ($property_type) {
			case '1':
				$propertytype = 'Single Family Home';
				break;
			case '2':
				$propertytype = 'Multi Family Home';
				break;
			case '3':
				$propertytype = 'Townhome';
				break;
			case '4':
				$propertytype = 'Condo';
				break;
			case '5':
				$propertytype = 'Condo';
				break;
			case '6':
				$propertytype = 'Mobile Home';
				break;
			default:
				$propertytype = 'Single Family Home';
				break;
		}
		return $propertytype;
    }

    public static function getRoofingCategory($category_type){
    	switch ($category_type) {
			case '1':
				$category = 'Asphalt Shingle';
				break;
			case '2':
				$category = 'Wood Shake/Comp.';
				break;
			case '3':
				$category = 'Metal';
				break;
			case '4':
				$category = 'Flat / SinglePly';
				break;
			case '5':
				$category = 'Tile';
				break;
			case '6':
				$category = 'Natural Slate';
				break;
			default:
				$category = 'Asphalt Shingle';
				break;
		}
		return $category;
    }

    public static function getHVACCategory($category_type){
    	switch ($category_type) {
			case '1':
				$category = 'Furnace/Heating System';
				break;
			case '2':
				$category = 'Furnace/Heating System';
				break;
			case '3':
				$category = 'Furnace/Heating System';
				break;
			case '4':
				$category = 'Electrical Baseboard/Wall Heater';
				break;
			case '5':
				$category = 'Boiler';
				break;
			case '6':
				$category = 'Boiler';
				break;
			case '7':
				$category = 'Boiler';
				break;
			case '8':
				$category = 'Boiler';
				break;
			case '9':
				$category = 'Central A/C';
				break;
			case '10':
				$category = 'Heat Pump';
				break;
			case '11':
				$category = 'Electrical Baseboard/Wall Heater';
				break;
			case '12':
				$category = 'Furnace/Heating System';
				break;
			case '13':
				$category = 'Boiler';
				break;
			default:
				$category = 'HVAC - Ducts/Vents Cleaning';
				break;
		}
		return $category;
    }
    public static function getSidingCategory($category_type){
    	switch ($category_type) {
			case '1':
				$category = 'Vinyl';
				break;
			case '2':
				$category = 'Brick or stone';
				break;
			case '3':
				$category = 'Stucco';
				break;
			case '4':
				$category = 'Other';
				break;
			default:
				$category = 'Wood';
				break;
		}
		return $category;
    }
	public static function getFlooringCategory($category_type){
    	switch ($category_type) {
			case '1':
				$category = 'Hardwood';
				break;
			case '2':
				$category = 'Vinyl/Linoleum';
				break;
			case '3':
				$category = 'Carpet';
				break;
			case '4':
				$category = 'Tile';
				break;
			case '5':
				$category = 'Wood Refinishing';
				break;
			case '6':
				$category = 'Laminate';
				break;
			default:
				$category = 'Wood';
				break;
		}
		return $category;
    }
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$project_type = Yii::app()->request->getParam('project_type');
		if($promo_code != 3){
			$pingData = [];
			// REMODEL WELL
			if($project_type == 27){//FLOORING
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$campaign['square_footage'] = ['1000 sqft','1500 sqft','2000+ sqft'][rand(1,3)];
				$flooring_material = self::getFlooringCategory(Yii::app()->request->getParam('siding_type',rand(1,2)));
				$type = date('N')%2;
				$initial = $type == 1 ? 'Flooring Install' : 'Flooring Repair';
				$campaign['category'] = $initial.' - '.$flooring_material;
				$campaign['property_type'] = self::getPropertyType(Yii::app()->request->getParam('property_type'));
				$lp_campaign_id = '67377934a0afc';
				$lp_campaign_key = 'vHT47rzPmp8WwJhBVx2c';
			}
			if($project_type == 33){//HVAC
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$air_sub_type = self::getHVACCategory(Yii::app()->request->getParam('air_sub_type',rand(1,2)));
				$property_type = date('N')%2;
				$initial = $property_type == 1 ? 'HVAC Install' : 'HVAC Repair';
				$campaign['category'] = $initial.' - '.$air_sub_type;
				$lp_campaign_id = '6737700389c37';
				$lp_campaign_key = 'pwgXyfTW4k3Mzq8JPBtL';
			}
			if($project_type == 42){//ROOFING
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$roofing_material = self::getRoofingCategory(Yii::app()->request->getParam('roofing_type',rand(1,2)));
				$property_type = Yii::app()->request->getParam('property_type',rand(1,2));
				$initial = $property_type > 2 ? 'Roof Repair' : 'Roof Install';
				$campaign['category'] = $initial.' - '.$roofing_material;
				$campaign['roof_material'] = $roofing_material;
				$campaign['roof_job'] = $initial;
				$lp_campaign_id = '673769f015cea';
				$lp_campaign_key = 'y8bzT9J3dNPgnmDcM2WG';
			}
			if($project_type == 43){//SIDING
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$siding_material = self::getSidingCategory(Yii::app()->request->getParam('siding_type',rand(1,2)));
				$job_type = Yii::app()->request->getParam('job_type',rand(1,2));
				$initial = $job_type == 1 ? 'Siding Install' : 'Siding Repair';
				$campaign['category'] = $initial.' - '.$siding_material;
				$campaign['property_type'] = self::getPropertyType(Yii::app()->request->getParam('property_type'));
				$lp_campaign_id = '673778647f887';
				$lp_campaign_key = 'pRhVtw8Z94xgKbkLHTz2';
			}
			if($project_type == 45){//SOLAR
				$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
				$utility_provider  = $project_provider['provider_name'];
				$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
				$monthly_bill = self::getElectricityBill(Yii::app()->request->getParam('monthly_bill'));
				$property_type = self::getPropertyType(Yii::app()->request->getParam('property_type'));
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$campaign['electric_provider'] = $utility_provider;
				$campaign['roof_shade'] = $roof_shade;
				$campaign['electric_bill'] = $monthly_bill;
				$campaign['credit_score'] = self::$creditRating[Yii::app()->request->getParam('credit_rating','2')];
				$campaign['property_type'] = $property_type;
				$campaign['purchase_time_frame'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['pub_id'] = $_POST['promo_code'];
				$lp_campaign_id = '67376e5cbd435';
				$lp_campaign_key = 'CBMNXVzpG4wFJLtnRPhy';
			}
			if($project_type == 52){//WINDOWS
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['category'] = ['Windows Install - Single','Windows Install - Multiple','Windows Repair','Windows - Cleaning'][rand(0,2)];
				$campaign['window_number'] = self::$windowNumber[Yii::app()->request->getParam('credit_rating','2')];
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['comments'] = $_POST['comments'];
				$lp_campaign_id = '67376daa62e23';
				$lp_campaign_key = 'hPZ7rNj8tVXMy4wmKdQn';
			}
			$fields = [
			'auth' => [
				'lp_campaign_id' => $lp_campaign_id,
				'lp_campaign_key' => $lp_campaign_key,
			],
			'tracking' => [
				'lp_s1'=>$promo_code,
				'lp_s2'=>Yii::app()->request->getParam('sub_id'),
				'lp_s3'=>'',
				'lp_s4'=>'',
				'lp_s5'=>'',
			],
			'mode' => [
				'lp_test'=>false,
			],
			'lead' => [	
				'city'=>$city_state['city']?$city_state['city']:'New York',
				'state'=>$city_state['state']?$city_state['state']:'NY',
				'zip_code'=>Yii::app()->request->getParam('zip'),
				'email_address'=>Yii::app()->request->getParam('email'),
				'ip_address'=>Yii::app()->request->getParam('ipaddress'),
				'best_time_to_call'=>['Morning','Afternoon','Evening','Anytime'][rand(0,2)],
				'landing_page_url'=>Yii::app()->request->getParam('url','https://elitehomeimprovers.com'),
				'tcpa_consent_text'=>Yii::app()->request->getParam('tcpa_text'),
				'tcpa_consent'=>Yii::app()->request->getParam('tcpa_optin')==1 ? 'Yes' : 'No',
			],
			'tcpa' => [		
				'jornaya_lead_id'=>Yii::app()->request->getParam('universal_leadid'),
				'trusted_form_cert_id'=>Yii::app()->request->getParam('trustedformcerturl'),
			],
			];
			$fields['lead'] += $campaign;
			//$fields += $campaign;
			$purchase = true;
	        $url = Yii::app()->request->getParam('url');
	        if(in_array(self::getHost($url),self::$not_allowed)){
	        	$purchase = false;
	        }
	        if($purchase == true){
	            $pingData['ping_request'] = json_encode($fields);
				$pingData['header'] = array('Content-Type: application/json');
				//$pingData['header'] = ["application/x-www-form-urlencoded"];
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
        $result = json_decode($ping_response);
		if($result->result=='success'){
			$ping_response_info['ping_status'] = '1';
			$ping_response_info['confirmation_id'] = $result->ping_id;
			if($result->brands){
				$i=0;
				$brands = (array) $result->brands;
				$ping_price = max(array_column($brands, "payout"));
				$ping_response_info['ping_price'] = trim($ping_price);
				foreach ($result->brands as $brands) {
					$ping_response_info['brands'][$i]['brand_id'] = $brands->lp_brand_id;
					$ping_response_info['brands'][$i]['brand_name'] = $brands->name;
					$ping_response_info['brands'][$i]['bid_price'] = $brands->payout;
					$i++;
				}
			}
		}else {
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
		$result = json_decode($ping_response);
		if($promo_code != 3){
			$confirmation_id = $result->ping_id;
			if($project_type == 27){//FLOORING
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$campaign['square_footage'] = ['1000 sqft','1500 sqft','2000+ sqft'][rand(1,3)];
				$flooring_material = self::getFlooringCategory(Yii::app()->request->getParam('siding_type',rand(1,2)));
				$type = date('N')%2;
				$initial = $type == 1 ? 'Flooring Install' : 'Flooring Repair';
				$campaign['category'] = $initial.' - '.$flooring_material;
				$campaign['property_type'] = self::getPropertyType(Yii::app()->request->getParam('property_type'));
				$lp_campaign_id = '67377934a0afc';
				$lp_campaign_key = 'vHT47rzPmp8WwJhBVx2c';
			}
			if($project_type == 33){//HVAC
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$air_sub_type = self::getHVACCategory(Yii::app()->request->getParam('air_sub_type',rand(1,2)));
				$property_type = date('N')%2;
				$initial = $property_type == 1 ? 'HVAC Install' : 'HVAC Repair';
				$campaign['category'] = $initial.' - '.$air_sub_type;
				$lp_campaign_id = '6737700389c37';
				$lp_campaign_key = 'pwgXyfTW4k3Mzq8JPBtL';
			}
			if($project_type == 42){//ROOFING
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$roofing_material = self::getRoofingCategory(Yii::app()->request->getParam('roofing_type',rand(1,2)));
				$property_type = Yii::app()->request->getParam('property_type',rand(1,2));
				$initial = $property_type > 2 ? 'Roof Repair' : 'Roof Install';
				$campaign['category'] = $initial.' - '.$roofing_material;
				$campaign['roof_material'] = $roofing_material;
				$campaign['roof_job'] = $initial;
				$lp_campaign_id = '673769f015cea';
				$lp_campaign_key = 'y8bzT9J3dNPgnmDcM2WG';
			}
			if($project_type == 43){//SIDING
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$siding_material = self::getSidingCategory(Yii::app()->request->getParam('siding_type',rand(1,2)));
				$job_type = Yii::app()->request->getParam('job_type',rand(1,2));
				$initial = $job_type == 1 ? 'Siding Install' : 'Siding Repair';
				$campaign['category'] = $initial.' - '.$siding_material;
				$campaign['property_type'] = self::getPropertyType(Yii::app()->request->getParam('property_type'));
				$lp_campaign_id = '673778647f887';
				$lp_campaign_key = 'pRhVtw8Z94xgKbkLHTz2';
			}
			if($project_type == 45){//SOLAR
				$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
				$utility_provider  = $project_provider['provider_name'];
				$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
				$monthly_bill = self::getElectricityBill(Yii::app()->request->getParam('monthly_bill'));
				$property_type = self::getPropertyType(Yii::app()->request->getParam('property_type'));
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$campaign['electric_provider'] = $utility_provider;
				$campaign['roof_shade'] = $roof_shade;
				$campaign['electric_bill'] = $monthly_bill;
				$campaign['credit_score'] = self::$creditRating[Yii::app()->request->getParam('credit_rating','2')];
				$campaign['property_type'] = $property_type;
				$campaign['purchase_time_frame'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['pub_id'] = $_POST['promo_code'];
				$lp_campaign_id = '67376e5cbd435';
				$lp_campaign_key = 'CBMNXVzpG4wFJLtnRPhy';
			}
			if($project_type == 52){//WINDOWS
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No';
				$campaign['timeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['category'] = ['Windows Install - Single','Windows Install - Multiple','Windows Repair','Windows - Cleaning'][rand(0,2)];
				$campaign['window_number'] = self::$windowNumber[Yii::app()->request->getParam('credit_rating','2')];
				$campaign['lp_caller_id'] = $_POST['promo_code'];
				$campaign['comments'] = $_POST['comments'];
				$lp_campaign_id = '67376daa62e23';
				$lp_campaign_key = 'hPZ7rNj8tVXMy4wmKdQn';
			}
			
			$fields = [
				'brands' => [
					['lp_brand_id'=>'']
				],
			    'auth' => [
					'lp_campaign_id' => $lp_campaign_id,
					'lp_campaign_key' => $lp_campaign_key,
					'lp_ping_id'=>$confirmation_id,
				],
				'tracking' => [
					'lp_s1'=>$promo_code,
					'lp_s2'=>Yii::app()->request->getParam('sub_id'),
					'lp_s3'=>'',
					'lp_s4'=>'',
					'lp_s5'=>'',
				],
				'mode' => [
					'lp_test'=>false,
				],
				'lead' => [	
					'first_name'=>Yii::app()->request->getParam('first_name'),
					'last_name'=>Yii::app()->request->getParam('last_name'),
					'phone_home'=>Yii::app()->request->getParam('phone'),
					'email_address'=>Yii::app()->request->getParam('email'),
					'address'=>Yii::app()->request->getParam('address'),
					'city'=>$city_state['city']?$city_state['city']:'New York',
					'state'=>$city_state['state']?$city_state['state']:'NY',
					'zip_code'=>Yii::app()->request->getParam('zip'),
					'dob'=> date("Y-m-d",strtotime(Yii::app()->request->getParam('dob'))),
					'gender'=>['Male','Female'][rand(0,1)],
					'best_time_to_call'=>['Morning','Afternoon','Evening','Anytime'][rand(0,2)],
					'ip_address'=>Yii::app()->request->getParam('ipaddress'),
					'landing_page_url'=>Yii::app()->request->getParam('url','https://elitehomeimprovers.com'),
					'tcpa_consent_text'=>Yii::app()->request->getParam('tcpa_text','This is submit..'),
					'tcpa_consent'=>Yii::app()->request->getParam('tcpa_optin')==1 ? 'Yes' : 'No',
				],
				'tcpa' => [		
					'jornaya_lead_id'=>Yii::app()->request->getParam('universal_leadid'),
					'trusted_form_cert_id'=>Yii::app()->request->getParam('trustedformcerturl'),
				]
			];
			$fields['lead'] += $campaign;
			//echo '<pre>';print_r($fields);exit;
			//$fields += $campaign;
			$post_request = json_encode($fields);
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			$header = array('Content-Type: application/json');
        	$post_response = $cm->curl($post_url,$post_request,$header);
			$time_end = CommonToolsMethods::stopwatch();
			$result = json_decode($post_response);
			//echo '<pre>';print_r();die();
			if($result->result=='success'){
				$postPrice = $result->payout;
				$post_status = '1';
				$post_price = isset($postPrice) ? $postPrice : '0.00';
				$redirect_url = '';
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
			return $post_responses;
		}
    }
}