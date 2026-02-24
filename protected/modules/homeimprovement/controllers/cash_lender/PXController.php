<?php
class PXController extends Controller {
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
    public static $AirType = [
		1=>'Cooling',
		2=>'Heating',
		3=>'Heating and Cooling',
	];
    public static $AirSubType = [
		1=>'Gas Furnace',
		2=>'Propane Furnace',
		3=>'Oil Furnace',
		4=>'Electric Furnace',
		5=>'Gas Boiler',
		6=>'Propane Boiler',
		7=>'Oil Boiler 1',
		8=>'Electric Boiler',
		9=>'Central Air',
		10=>'Heat Pump',
		11=>'Water Heater',
		12=>'Furnace',
		13=>'Boiler'
	];
	public static $PlumbingType = [
		1=>'Drains',
		2=>'Faucets',
		3=>'Fixture',
		4=>'Pipe',
		5=>'Sprinkler systems',
		6=>'Septic system',
		7=>'Water heater',
		9=>'Sewer main',
		10=>'Gutters',
		11=>'Water main',
		12=>'Plumbing for an addition or remodel',
		13=>'Other',
		14=>'Plumbing',
	];
	public static $BuildingType = [
		1=>'Single Family',
		2=>'Multi-Family',
		3=>'Townhome',
		4=>'Condominium',
		5=>'Duplex',
		6=>'Mobile Home',
		7=>'Other',
	];
	public static function getProjectStatus($project_status){
		switch ($project_status) {
			case '1':
				$proj_status = 'Existing home';
				break;
			case '2':
				$proj_status = 'Under development';
				break;
			default:
				$proj_status = 'Existing home';
				break;
		}
		return $proj_status;
	}
	public static function getWindowAge($window_age){
    	switch ($window_age) {
			case '1':
				$win_age = 'New (less than 1 year old)';
				break;
			case '2':
				$win_age = '1-5 years';
				break;
			case '3':
				$win_age = '6+ years';
				break;
			default:
				$win_age = '1-5 years';
				break;
		}
		return $win_age;
    }
    public static function getWindowCondition($window_condition){
    	switch ($window_condition) {
			case '1':
				$window_cond = 'Poor';
				break;
			case '2':
				$window_cond = 'Average';
				break;
			case '3':
				$window_cond = 'Good';
				break;
			default:
				$window_cond = 'Average';
				break;
		}
		return $window_cond;
    }

	public static function getRoofShade($roof_shade){
    	switch ($roof_shade) {
			case '0':
				$roofshade = 'Not sure';
				break;
			case '1':
				$roofshade = 'Partial sun';
				break;
			case '2':
				$roofshade = 'Full sun';
				break;
			case '3':
				$roofshade = 'Not sure';
				break;
			default:
				$roofshade = 'Full sun';
				break;
		}
		return $roofshade;
    }

    public static function getElectricityBill($electricity_bill){
    	switch ($electricity_bill) {
			case '1':
				$ele_bill = '$0-25';
				break;
			case '2':
				$ele_bill = '$76-100';
				break;
			case '3':
				$ele_bill = '$101-125';
				break;
			case '4':
				$ele_bill = '$151-175';
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
				$ele_bill = '$500+';
				break;
			case '9':
				$ele_bill = '$500+';
				break;
			case '10':
				$ele_bill = '$500+';
				break;
			case '11':
				$ele_bill = '$500+';
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
				$purchase_time_frame = '1-3 months';
				break;
			case '3':
				$purchase_time_frame = '3-6 months';
				break;
			case '4':
				$purchase_time_frame = 'Within a Year';
				break;
			case '5':
				$purchase_time_frame = 'Not Sure';
				break;
			default:
				$purchase_time_frame = '1-3 months';
				break;
		}
		return $purchase_time_frame;
    }
    public static function getRequestWeekTimeFrame($time_frame){
    	switch ($time_frame) {
			case '1':
				$request_time_frame = 'Time is flexible';
				break;
			case '2':
				$request_time_frame = 'Within 1 week';
				break;
			case '3':
				$request_time_frame = '1-2 weeks';
				break;
			case '4':
				$request_time_frame = 'More than 2 weeks';
				break;
			default:
				$request_time_frame = '1-3 months';
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
				$roof_type = 'Tar Torchdown';
				break;
			case '5':
				$roof_type = 'Tile';
				break;
			case '6':
				$roof_type = 'Natural Slate';
				break;
			default:
				$roof_type = 'Cedar Shake';
				break;
		}
		return $roof_type;
    }
	public static function getNumberOfWindows($window_number){
    	switch ($window_number) {
			case '1':
				$win_number = '1 window';
				break;
			case '2':
				$win_number = '2 windows';
				break;
			case '3':
				$win_number = '3 to 5 windows';
				break;
			case '4':
				$win_number = '3 to 5 windows';
				break;
			case '5':
				$win_number = '3 to 5 windows';
				break;
			case '6':
				$win_number = '6 to 9 windows';
				break;
			case '7':
				$win_number = '6 to 9 windows';
				break;
			case '8':
				$win_number = '6 to 9 windows';
				break;
			case '9':
				$win_number = '6 to 9 windows';
				break;
			case '10':
				$win_number = '10+ windows';
				break;
			case '11':
				$win_number = '10+ windows';
				break;
			case '12':
				$win_number = '10+ windows';
				break;
			default:
				$win_number = '10+ windows';
				break;
		}
		return $win_number;
    }
    public static function getWindowStyle($window_style){
    	switch ($window_style) {
			case '1':
				$win_style = 'Bay or Bow';
				break;
			case '2':
				$win_style = 'Fixed (non-opening)';
				break;
			case '3':
				$win_style = 'Sliding Glass window';
				break;
			case '4':
				$win_style = 'Garden window';
				break;
			case '5':
				$win_style = 'Casement';
				break;
			case '6':
				$win_style = 'Sliding Glass Door';
				break;
			case '7':
				$win_style = 'Double Hung (both halves open)';
				break;
			case '8':
				$win_style = 'French Door';
				break;
			case '9':
				$win_style = 'Single-Hung (lower half opens)';
				break;
			case '10':
				$win_style = 'Awning (hinged at the top)';
				break;
			case '11':
				$win_style = 'Unsure';
				break;
		}
		return $win_style;
    }
    public static function getProjectTypeRoofing($project_type){
    	switch ($project_type) {
			case '1':
				$proj_type = 'New Roof for New Home';
				break;
			case '2':
				$proj_type = 'New Roof for an Existing Home';
				break;
			case '3':
				$proj_type = 'Repair';
				break;
			case '4':
				$proj_type = 'Shingle over Existing Roof';
				break;		
			default:
				$proj_type = 'New Roof for an Existing Home';
				break;
		}
		return $proj_type;
    }
    public static function getSidingType($siding_type){
    	switch ($siding_type) {
			case '1':
				$side_type = 'Vinyl Siding';
				break;
			case '2':
				$side_type = 'Wood / Fiber / Cement Siding';
				break;
			case '3':
				$side_type = 'I am not sure';
				break;
			case '4':
				$side_type = 'Stucco Siding';
				break;		
			default:
				$side_type = 'I am not sure';
				break;
		}
		return $side_type;
    }
    public static function getJobType($job_type){
    	switch ($job_type) {
			case '1':
				$jtype = 'Replace';
				break;
			case '2':
				$jtype = 'Repair';
				break;
			default:
				$jtype = 'Replace';
				break;
		}
		return $jtype;
    }
    public static function getSidingFloors($floor_type){
    	switch ($floor_type) {
			case '1':
				$flrtype = 'One story';
				break;
			case '2':
				$flrtype = 'Two stories';
				break;
			case '3':
				$flrtype = 'Three stories';
				break;
			case '4':
				$flrtype = 'Four or more stories';
				break;		
			default:
				$flrtype = 'Four or more stories';
				break;
		}
		return $flrtype;
    }
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$project_type = Yii::app()->request->getParam('project_type');
		$task = Yii::app()->request->getParam('task');
		$purchase = true;
		if($promo_code != 2 && $promo_code != 5 && $promo_code != 9&& $promo_code != 11){
			$pingData = [];
			if($project_type == 13){
				$Vertical = 'bathroomremodeling';
        		$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
        		$campaign['PropertyType'] = 'Residential';
        		$campaign['ProjectType'] = 'Install';
        		$campaign['AuthorizedToMakeChanges'] = 'Yes';
        		$campaign['JobTypes']['Floorplan'] = $task == '13_6' ? 'Yes' : 'No';
        		$campaign['JobTypes']['ShowerOrBath'] = $task == '13_2' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Cabinets'] = $task == '13_5' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Countertops'] = $task == '13_4' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Sinks'] = $task == '13_1' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Flooring'] = $task == '13_3' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Toilet'] = $task == '13_7' ? 'Yes' : 'No';
        		$campaign['RequestTimeframe'] = self::getRequestWeekTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
        		$api_token = '3FE3F0CF-42B1-48A5-AED9-FB4C1E387179';
			}
			if($project_type == 27){
				$Vertical = 'flooring';
        		$campaign['FlooringType'] = 'Carpet';
        		$campaign['RoomType'] = 'Bedrooms';
        		$campaign['NumberOfRooms'] = Yii::app()->request->getParam('number_of_rooms',rand(1,2));
        		$campaign['BuildingType'] = self::$BuildingType[Yii::app()->request->getParam('property_type',rand(1,2))];
        		$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
        		$campaign['ProjectType'] = "Install new flooring";
        		$campaign['RequestTimeframe'] = self::getRequestWeekTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
        		$campaign['ProjectStatus'] = self::getProjectStatus(Yii::app()->request->getParam('project_status',rand(1,2)));
        		$campaign['SpecialConsiderations'] = "Installing on stairs";
        		$campaign['PurchasedMaterials'] = 'Yes';
        		$campaign['CoveredByInsurance'] = 'Yes';
        		$api_token = '';
			}
			if($project_type == 33){
				$Vertical = 'Hvac';
				$campaign['ProjectType'] = 'New Unit Installed';
				$campaign['AirType'] = self::$AirType[Yii::app()->request->getParam('air_type',rand(1,2))];
				$campaign['AirSubType'] = self::$AirSubType[Yii::app()->request->getParam('air_sub_type',rand(1,2))];
				$campaign['PropertyType'] = 'Residential';
				$campaign['NumberOfRooms'] = Yii::app()->request->getParam('number_of_rooms',rand(1,2));
				$campaign['NumberOfFloors'] = Yii::app()->request->getParam('number_of_floors',rand(1,2));
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$api_token = 'DCBA983D-DC16-41EF-A92E-493B2E832E0B';
			}
			if($project_type == 40){
				$Vertical = 'Plumbing';
				$campaign['ProjectType'] = 'Repair';
				$campaign['PlumbingType'] = self::$PlumbingType[Yii::app()->request->getParam('plumbing_type',rand(1,2))];
				$campaign['PropertyType'] = 'Residential';
				$campaign['PurchaseTimeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['OwnRented'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$api_token = 'D8C96CD4-072A-4A3A-9340-8F2A7CBDF2DA';
			}
			if($project_type == 42){
				$Vertical = 'Roofing';
				$campaign['ProjectType'] = self::getProjectTypeRoofing(Yii::app()->request->getParam('project_type',rand(1,2)));
				$campaign['PropertyType'] = 'Residential';
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$campaign['AuthorizedToMakeChanges'] = 'Yes';
				$campaign['RoofType'] = self::getRoofingType(Yii::app()->request->getParam('roofing_type',rand(1,2)));
				$campaign['RequestTimeframe'] = self::getRequestWeekTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$api_token = '98692C3B-BF34-46C3-B4EE-6C8C3BC1A59F';
			}
			if($project_type == 43){
				$Vertical = 'Siding';
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$campaign['SidingType'] = self::getSidingType(Yii::app()->request->getParam('siding_type',rand(1,2)));
				$campaign['JobType'] = self::getJobType(Yii::app()->request->getParam('job_type',rand(1,2)));
				$campaign['Floors'] = self::getSidingFloors(Yii::app()->request->getParam('number_of_floors',rand(1,2)));
				$api_token = '79B84637-6EA1-44BF-A44E-07615915CD97';
			}
			if($project_type == 45){
				$Vertical = 'Solar';
				$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
				$ecw_utility_provider  = $project_provider['provider_name'];
				$px_utility_provider = $submission_model->getPXUtilityProviderById($ecw_utility_provider);
				$px_utility_provider = $px_utility_provider == '' ? 'Other' : $px_utility_provider;
				$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
				$monthly_bill = self::getElectricityBill(Yii::app()->request->getParam('monthly_bill'));
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$campaign['RoofShade'] = $roof_shade;
				$campaign['AuthorizedForPropertyChanges'] = 'Yes';
				$campaign['CurrentUtilityProvider'] = $px_utility_provider['provider'];
				$campaign['ElectricityBill'] = $monthly_bill;
				$campaign['ProjectStatus'] = self::getProjectStatus(Yii::app()->request->getParam('project_status',rand(1,2)));
				$campaign['PropertyStories'] = ['One story','One story','One story','Two stories','Three stories or more'][rand(0,4)];
				$campaign['PropertyUsage'] = 'Residential';
				$campaign['SolarSystemType'] = ['Solar electricity','Solar hot water','Solar electricity','Solar electricity','Solar electricity and hot water'][rand(0,4)];
				$campaign['SolarInstallationLocation'] = ['Roof','On the ground','Nearby structure'][rand(0,2)];
				$api_token = 'B1C269EA-0A1E-4F41-8B0B-AD21227B16C0';
				$is_zipcode_available = $submission_model->checkPXSolarZipcode($zip_code);
				if(!$is_zipcode_available){
		        	$purchase = false;
		        }
			}
			if($project_type == 52){
				$Vertical = 'Windows';
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$campaign['BestTimeToCall'] = ['Morning','Afternoon','Evening','Any time'][rand(0,2)];
				$campaign['ProjectType'] = 'New Unit Installed';
				$campaign['NumberOfWindows'] = self::getNumberOfWindows(Yii::app()->request->getParam('number_of_windows',rand(1,2)));
				$campaign['WindowStyle'] = self::getWindowStyle(Yii::app()->request->getParam('window_style',rand(1,11)));
				$campaign['WindowAge'] = self::getWindowAge(Yii::app()->request->getParam('window_age',rand(1,3)));
				$campaign['WindowCondition'] = self::getWindowCondition(Yii::app()->request->getParam('window_condition',rand(1,2)));
				$campaign['PropertyType'] = 'Residential';
				$campaign['AuthorizedToMakeChanges'] = 'Yes';
				$campaign['PurchaseTimeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$api_token = 'A150F641-4B9F-48A1-A077-F04630188E22';
			}
			$tcpa_text = 'By clicking GET YOUR QUOTE, I agree to the Terms of Service and Privacy Policy, I authorize home improvement companies, their contractors and partner companies to contact me about home improvement offers by phone calls and text messages to the number I provided. I authorize that these marketing communications may be delivered to me using an automatic telephone dialing system or by prerecorded message. I understand that my consent is not a condition of purchase, and I may revoke that consent at any time. Mobile and data charges may apply. California Residents.';
			$user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.94 Chrome/37.0.2062.94 Safari/537.36';
			if($project_type == 45 || $project_type == 13 || $project_type == 52 || $project_type == 42 || $project_type == 43 || $project_type == 40 || $project_type == 33){
				$fields = [
				    'ApiToken'=> $api_token,
				    'Vertical'=> $Vertical,
				    'SubId'=> $promo_code,
				    'Sub2Id'=> Yii::app()->request->getParam('sub_id'),
				    'UserAgent' => Yii::app()->request->getParam('user_agent',$user_agent),
				    'OriginalUrl' => Yii::app()->request->getParam('url','https://elitehomeinsurer.com'),
				    'Source'=> 'Social',
				    'JornayaLeadId' => Yii::app()->request->getParam('universal_leadid',0),
				    'TrustedForm' => Yii::app()->request->getParam('trustedformcerturl',0),
				    'SessionLength'=> '38',
				    //'TcpaText'=> Yii::app()->request->getParam('tcpa_text',0),
				    'TcpaText'=> $tcpa_text,
				    'VerifyAddress'=> 'false',
				    'OriginalCreationDate'=> Yii::app()->request->getParam('datetime_stamp',date('Y-m-d H:i:s')),
				    'ContactData'=> [
				    	'City' => $city_state['city']?$city_state['city']:'New York',
				        'State' => $city_state['state']?$city_state['state']:'NY',
				        'ZipCode' => Yii::app()->request->getParam('zip'),
				        'IpAddress' => Yii::app()->request->getParam('ipaddress'),
				    ],
				    'Person'=> [
				        'BestTimeToCall' => "Morning",
				        'BirthDate'=> date("Y-m-d",strtotime(Yii::app()->request->getParam('dob'))),
				        'Gender'=> ['Male','Female'][rand(0,1)],
				    ],
				    'BathroomRemodeling' => [],
				    'Home' => [],
				    'Siding' => [],
					'Plumbing' => [],
				];
				if($project_type == 13){ //BATH
					$fields['BathroomRemodeling'] += $campaign;
					unset($fields['Home']);
					unset($fields['Siding']);
					unset($fields['Plumbing']);
				}else if($project_type == 40){// PLUMBING
					$fields['Plumbing'] += $campaign;
					unset($fields['Home']);
					unset($fields['BathroomRemodeling']);
					unset($fields['Siding']);
				}else if($project_type == 43){// SIDING
					$fields['Siding'] += $campaign;
					unset($fields['Home']);
					unset($fields['BathroomRemodeling']);
					unset($fields['Plumbing']);
				}else{// OTHER
					$fields['Home'] += $campaign;
					unset($fields['BathroomRemodeling']);
					unset($fields['Siding']);
					unset($fields['Plumbing']);
				}
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
				//echo '<pre>';print_r($pingData);exit;
				//$pingData['header'] = ["application/x-www-form-urlencoded"];
				return $pingData;
			}
		}
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<Success>(.*)<\/Success>/", $ping_response, $success);
        if(trim($success[1]) == 'true'){
        	preg_match("/<Payout>(.*)<\/Payout>/msui", $ping_response, $price);
            preg_match("/<TransactionId>(.*)<\/TransactionId>/msui", $ping_response, $confirmation_id);
            $ping_price = isset($price[1]) ? $price[1] : 0;
            $confirmation_id = $confirmation_id[1];
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
		$provider_id = Yii::app()->request->getParam('provider_id');
		$provider_details = $submission_model->getProviderDetailsById($provider_id);
		$project_type = Yii::app()->request->getParam('project_type');
		$task = Yii::app()->request->getParam('task');
		if($promo_code != 0){
			preg_match("/<TransactionId>(.*)<\/TransactionId>/msui", $ping_response, $confirmation_id);
			if($project_type == 13){
				$Vertical = 'bathroomremodeling';
        		$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
        		$campaign['PropertyType'] = 'Residential';
        		$campaign['ProjectType'] = 'Install';
        		$campaign['AuthorizedToMakeChanges'] = 'Yes';
        		$campaign['JobTypes']['Floorplan'] = $task == '13_6' ? 'Yes' : 'No';
        		$campaign['JobTypes']['ShowerOrBath'] = $task == '13_2' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Cabinets'] = $task == '13_5' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Countertops'] = $task == '13_4' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Sinks'] = $task == '13_1' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Flooring'] = $task == '13_3' ? 'Yes' : 'No';
        		$campaign['JobTypes']['Toilet'] = $task == '13_7' ? 'Yes' : 'No';
        		$campaign['RequestTimeframe'] = self::getRequestWeekTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
        		$api_token = '3FE3F0CF-42B1-48A5-AED9-FB4C1E387179';
			}
			if($project_type == 27){
				$Vertical = 'flooring';
        		$campaign['FlooringType'] = 'Carpet';
        		$campaign['RoomType'] = 'Bedrooms';
        		$campaign['NumberOfRooms'] = Yii::app()->request->getParam('number_of_rooms',rand(1,2));
        		$campaign['BuildingType'] = self::$BuildingType[Yii::app()->request->getParam('property_type',rand(1,2))];
        		$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
        		$campaign['ProjectType'] = "Install new flooring";
        		$campaign['RequestTimeframe'] = self::getRequestWeekTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
        		$campaign['ProjectStatus'] = self::getProjectStatus(Yii::app()->request->getParam('project_status',rand(1,2)));
        		$campaign['SpecialConsiderations'] = "Installing on stairs";
        		$campaign['PurchasedMaterials'] = 'Yes';
        		$campaign['CoveredByInsurance'] = 'Yes';
        		$api_token = '';
			}
			if($project_type == 33){
				$Vertical = 'Hvac';
				$campaign['ProjectType'] = 'New Unit Installed';
				$campaign['AirType'] = self::$AirType[Yii::app()->request->getParam('air_type',rand(1,2))];
				$campaign['AirSubType'] = self::$AirSubType[Yii::app()->request->getParam('air_sub_type',rand(1,2))];
				$campaign['PropertyType'] = 'Residential';
				$campaign['NumberOfRooms'] = Yii::app()->request->getParam('number_of_rooms',rand(1,2));
				$campaign['NumberOfFloors'] = Yii::app()->request->getParam('number_of_floors',rand(1,2));
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$api_token = 'DCBA983D-DC16-41EF-A92E-493B2E832E0B';
			}
			if($project_type == 40){
				$Vertical = 'Plumbing';
				$campaign['ProjectType'] = 'Repair';
				$campaign['PlumbingType'] = self::$PlumbingType[Yii::app()->request->getParam('plumbing_type',rand(1,2))];
				$campaign['PropertyType'] = 'Residential';
				$campaign['PurchaseTimeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$campaign['OwnRented'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$api_token = 'D8C96CD4-072A-4A3A-9340-8F2A7CBDF2DA';
			}
			if($project_type == 42){
				$Vertical = 'Roofing';
				$campaign['ProjectType'] = self::getProjectTypeRoofing(Yii::app()->request->getParam('project_type',rand(1,2)));
				$campaign['PropertyType'] = 'Residential';
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$campaign['AuthorizedToMakeChanges'] = 'Yes';
				$campaign['RoofType'] = self::getRoofingType(Yii::app()->request->getParam('roofing_type',rand(1,2)));
				$campaign['RequestTimeframe'] = self::getRequestWeekTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$api_token = '98692C3B-BF34-46C3-B4EE-6C8C3BC1A59F';
			}
			if($project_type == 43){
				$Vertical = 'Siding';
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$campaign['SidingType'] = self::getSidingType(Yii::app()->request->getParam('siding_type',rand(1,2)));
				$campaign['JobType'] = self::getJobType(Yii::app()->request->getParam('job_type',rand(1,2)));
				$campaign['Floors'] = self::getSidingFloors(Yii::app()->request->getParam('number_of_floors',rand(1,2)));
				$api_token = '79B84637-6EA1-44BF-A44E-07615915CD97';
			}
			if($project_type == 45){
				$Vertical = 'Solar';
				$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
				$ecw_utility_provider  = $project_provider['provider_name'];
				$px_utility_provider = $submission_model->getPXUtilityProviderById($ecw_utility_provider);
				$px_utility_provider = $px_utility_provider == '' ? 'Other' : $px_utility_provider;
				$roof_shade = self::getRoofShade(Yii::app()->request->getParam('roof_shade'));
				$monthly_bill = self::getElectricityBill(Yii::app()->request->getParam('monthly_bill'));
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$campaign['RoofShade'] = $roof_shade;
				$campaign['AuthorizedForPropertyChanges'] = 'Yes';
				$campaign['CurrentUtilityProvider'] = $px_utility_provider['provider'];
				$campaign['ElectricityBill'] = $monthly_bill;
				$campaign['ProjectStatus'] = self::getProjectStatus(Yii::app()->request->getParam('project_status',rand(1,2)));
				$campaign['PropertyStories'] = ['One story','One story','One story','Two stories','Three stories or more'][rand(0,4)];
				$campaign['PropertyUsage'] = 'Residential';
				$campaign['SolarSystemType'] = ['Solar electricity','Solar hot water','Solar electricity','Solar electricity','Solar electricity and hot water'][rand(0,4)];
				$campaign['SolarInstallationLocation'] = ['Roof','On the ground','Nearby structure'][rand(0,2)];
				$api_token = 'B1C269EA-0A1E-4F41-8B0B-AD21227B16C0';
			}
			if($project_type == 52){
				$Vertical = 'Windows';
				$campaign['Ownership'] = Yii::app()->request->getParam('home_owner')=='1' ? 'Own' : 'Rented';
				$campaign['BestTimeToCall'] = ['Morning','Afternoon','Evening','Any time'][rand(0,2)];
				$campaign['ProjectType'] = 'New Unit Installed';
				$campaign['NumberOfWindows'] = self::getNumberOfWindows(Yii::app()->request->getParam('number_of_windows',rand(1,2)));
				$campaign['WindowStyle'] = self::getWindowStyle(Yii::app()->request->getParam('window_style',rand(1,11)));
				$campaign['WindowAge'] = self::getWindowAge(Yii::app()->request->getParam('window_age',rand(1,3)));
				$campaign['WindowCondition'] = self::getWindowCondition(Yii::app()->request->getParam('window_condition',rand(1,2)));
				$campaign['PropertyType'] = 'Residential';
				$campaign['AuthorizedToMakeChanges'] = 'Yes';
				$campaign['PurchaseTimeframe'] = self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2)));
				$api_token = 'A150F641-4B9F-48A1-A077-F04630188E22';
			}
			$tcpa_text = 'By clicking GET YOUR QUOTE, I agree to the Terms of Service and Privacy Policy, I authorize home improvement companies, their contractors and partner companies to contact me about home improvement offers by phone calls and text messages to the number I provided. I authorize that these marketing communications may be delivered to me using an automatic telephone dialing system or by prerecorded message. I understand that my consent is not a condition of purchase, and I may revoke that consent at any time. Mobile and data charges may apply. California Residents.';
			$user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.94 Chrome/37.0.2062.94 Safari/537.36';
			$phone = Yii::app()->request->getParam('phone');
			$phone2 = Yii::app()->request->getParam('phone2');
			$fields = [
			    'ApiToken'=> $api_token,
			    'Vertical' => $Vertical,
			    'SubId' => $promo_code,
			    'UserAgent' => Yii::app()->request->getParam('user_agent',$user_agent),
			    'OriginalUrl' => Yii::app()->request->getParam('url','https://elitehomeinsurer.com'),
			    'Source' => 'Social',
			    'JornayaLeadId' => Yii::app()->request->getParam('universal_leadid',0),
			    'TrustedForm' => Yii::app()->request->getParam('trustedformcerturl',0),
			    'SessionLength' => '38',
			    //'TcpaText' => Yii::app()->request->getParam('tcpa_text',0),
			    'TcpaText'=> $tcpa_text,
			    'VerifyAddress' => 'false',
			    'TransactionId' => $confirmation_id[1],
			    'OriginalCreationDate'=> Yii::app()->request->getParam('datetime_stamp',date('Y-m-d H:i:s')),
			    'ContactData' => [
			        'FirstName' => Yii::app()->request->getParam('first_name'),
			        'LastName' => Yii::app()->request->getParam('last_name'),
			        'Address' => Yii::app()->request->getParam('address'),
			        'City' => $city_state['city']?$city_state['city']:'New York',
					'State' => $city_state['state']?$city_state['state']:'NY',
			        'ZipCode' => Yii::app()->request->getParam('zip'),
			        'EmailAddress' => Yii::app()->request->getParam('email'),
			        'PhoneNumber' => Yii::app()->request->getParam('phone'),
			        'DayPhoneNumber' => ($phone2 == null or $phone2 == '' or $phone2 == 'null') ? $phone : $phone2,
			        'IpAddress' => Yii::app()->request->getParam('ipaddress'),
				 ],
				'Person' => [
					'FirstName' => Yii::app()->request->getParam('first_name'),
			    	'LastName' => Yii::app()->request->getParam('last_name'),
			        'BestTimeToCall' => "Morning",
			        'BirthDate'=> date("Y-m-d",strtotime(Yii::app()->request->getParam('dob'))),
			        'Gender'=> ['Male','Female'][rand(0,1)],
				],
				'BathroomRemodeling' => [],
			    'Home' => [],
			    'Siding' => [],
				'Plumbing' => [],
			];
			if($project_type == 13){ //BATH
				$fields['BathroomRemodeling'] += $campaign;
				unset($fields['Home']);
				unset($fields['Siding']);
				unset($fields['Plumbing']);
			}else if($project_type == 40){// PLUMBING
				$fields['Plumbing'] += $campaign;
				unset($fields['Home']);
				unset($fields['BathroomRemodeling']);
				unset($fields['Siding']);
			}else if($project_type == 43){// SIDING
				$fields['Siding'] += $campaign;
				unset($fields['Home']);
				unset($fields['BathroomRemodeling']);
				unset($fields['Plumbing']);
			}else{// OTHER
				$fields['Home'] += $campaign;
				unset($fields['BathroomRemodeling']);
				unset($fields['Siding']);
				unset($fields['Plumbing']);
			}
			/*echo '<pre>';
			print_r($fields);
			exit;*/
			$post_request = json_encode($fields);
			//echo '<pre>';print_r($post_request);
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			//$header = ["application/x-www-form-urlencoded"];
			$header = ["Content-Type: application/json"];
        	$post_response = $cm->curl($post_url,$post_request,$header);
			$time_end = CommonToolsMethods::stopwatch();
			preg_match("/<Success>(.*)<\/Success>/", $post_response, $success);
	        if(trim($success[1]) == 'true'){
	            $post_status = '1';
	            preg_match("/<Payout>(.*)<\/Payout>/msui",$post_response,$price);
	            preg_match("/<Payout>(.*)<\/Payout>/msui", $ping_response, $ping_price );
	            $post_price = isset($price[1]) ? $price[1] : $ping_price[1];
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