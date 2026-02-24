<?php
class HomeappointmentsController extends Controller {
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
    public static $not_allowed = ['hvacrepairinstallationnearme.com','solarjoy.com','yourhomeserviceexperts.com','forms.toptopleads.com','findrenovator.com','homefixxer.net','bathroomremodelme.com','bathroomremodelusa.com','getswindowsnow.net','homesolartoday.com','homewindows4u.com','improvementyourhome.com','theflooringestimate.com','thewindowsestimate.com','windowestimate.net','windows-estimate.com','windowspros.net','selectmyquotes.com','billy.com','kavono.space','billy.com','quotewallet.com','homequotespro.com','nationalbathrooms.online','nationalgutters.online','nationalroofing.online','nationalwindows.online','nationwidebathrooms.online','nationwideroofing.net','nationwidesiding.online','nationwidewindows.online','myhomequote.com','nationalbathrooms.online','nationalgutters.online','nationalhvac.online','nationalroofing.online','nationalwindows.online','nationwidebathrooms.online','nationwidehvac.net','nationwideroofing.net','nationwidesiding.online','nationwidewindows.online','bathremodel.io','gutterprotection.io','myhomequote.com','homesbathrooms.com','homeswindows.com','yourhomesroofpros.com','yourhomessolarpros.com','bathremodelpros.net','bathroom-remodelers.com','bathroomremodelusa.com','betterhome.live','homefixr.co','homeimprove.io','home-improvements.co','home-improvements.pro','home-improvements.us','home-improvements.work','homepro.expert','homewindows4u.com','hvac-quotes.net','onehome.cc','premier.home-improvements.co','renovatepro.net','roofing-contractors.co','theflooringestimate.com','thewindowsestimate.com','wilsonandsimpson.com','windowestimate.net','windows-contractors.com','americahomequotes.com','buildroofpros.com','home-improvements.co','homeremodelrus.com','homerevampers.net','homerevitalize.cloud','housefixers.online','qualifiedhvacsurvey.com','thewindows-estimate.com','upgrades4myhome.com','billy.com','bathroomremodelusa.com','buildroofpros.com','homeremodelrus.co','thebathroomremodeling.com','thesolarpros.net','thewindows-estimate.com','bathroomdesignquotes.com','windowquotesaver.com','survey.myremodelhelper.com','survey.myremodelhelper.com','quotes.profind.com','pannelpower.com','solarquote.org','solar-quote.org','solarrooftorooms.pro','sustainablesolar.online','betterhome.live','experthome.pro','homefixr.co','homeimprove.io','homeiq.io','homepro.expert','onehome.cc','renewal.guru','renovatepro.net','porch.com','homefixwiz.com','home-improvements.pro','homerevampers.net','homerevitalize.cloud','homeserviceinstallers.com','housefixers.online','nationalroofing.online','nationwidewindows.online','myessentialroofing.com','myhomequote.com','claim.foundmoneyguide.com','claim.theclassactionguide.com','deals.thefreesamplesguide.com','deals.thefreesampleshelper.com','enter.thedailytipjar.com','form.casability.com','fsg.couponcartdaily.com','go.theamericansurvey.com','go.thefreedailyraffle.com','prize.thefreedailyraffle.com','seq.lucky7sweeps.com','tas.surveysformembers.com','win.omgsweeps.info','win.pickem7.com','win.super7sweeps.com','homequotespro.com'];
    
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
				$roofshade = 'Unknown';
				break;
			default:
				$roofshade = 'Unknown';
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
		1=>'50',
		2=>'100',
		3=>'150',
		4=>'$200',
		5=>'300',
		6=>'400',
		7=>'500',
		8=>'600',
		9=>'700',
		10=>'800',
		11=>'900',
	];
    public static $CreditRating = [
		1=>'Excellent',
		2=>'Good',
		3=>'Fair',
		4=>'Poor',
	];
	public static $ACType = [
		1=>'Central Air',
		2=>'Air Ducts',
		3=>'Commercial Cooling',
		4=>'Ductless Air Conditioning',
		5=>'Thermostats',
	];
	public static $HeatingType = [
		1=>'Heating',
		2=>'Boilers and Radiators',
		3=>'Commercial Heat',
		4=>'Electric Heat',
		5=>'Furnaces',
		6=>'Gas Heat',
		7=>'Heat Pumps',
		8=>'Oil Heat'
	];
	public static function getFloorMaterial($flooring_material){
    	switch ($flooring_material) {
			case '1':
				$f_type = 'Hardwood';
				break;
			case '2':
				$f_type = 'Vinyl/Linoleum';
				break;
			case '3':
				$f_type = 'Carpet';
				break;
			case '4':
				$f_type = 'Tile';
				break;
			case '5':
				$f_type = 'Epoxy';
				break;
			case '6':
				$f_type = 'Laminate';
				break;
			default:
				$f_type = 'Carpet';
				break;
		}
		return $f_type;
    }
	public static $TradeType = [
		13 => 'Bathroom Remodel',
		14 => 'Cabinet Refacing',
		22 => 'Doors',
		24 => 'Electrical',
		27 => 'Flooring',
		30 => 'Gutter Protection',
		32 => 'Home Security',
		33 => 'HVAC',
		35 => 'Kitchen',
		39 => 'Pest Control',
		40 => 'Plumbing',
		42 => 'Roofing',
		43 => 'Siding',
		45 => 'Solar',
		52 => 'Windows',
	];
	public static function getSidingType($siding_type){
    	switch ($siding_type) {
			case '1':
				$side_type = 'Vinyl';
				break;
			case '2':
				$side_type = 'Wood';
				break;
			case '3':
				$side_type = 'Stucco';
				break;
			case '4':
				$side_type = 'Metal';
				break;		
			default:
				$side_type = 'Other';
				break;
		}
		return $side_type;
    }
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		
		$pingData = [];
		$KEY = $p2 ? $p2 : '4b5377d33317e703ab7d5f5fff272cf18f7936d0538b6a253b5489d8286df3f5';
		$SRC = 'EliteHomeImp';
		$TYPE = '38';
		$project_type = Yii::app()->request->getParam('project_type');
        $submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$trade = self::$TradeType[$project_type];
		
        if($project_type == 42){// ROOFING
            $campaign['Roofing_Type'] = self::getRoofingType(Yii::app()->request->getParam('roofing_type',rand(1,2)));
        }
		if($project_type == 43){// SIDING
			$campaign['Siding_Type'] = self::getSidingType(Yii::app()->request->getParam('siding_type',rand(1,2)));
		}
		if($project_type == 52){ //WINDOWS
			$campaign['Number_Of_Windows'] = Yii::app()->request->getParam('number_of_rooms',rand(1,2));
		}
		$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
		$ecw_utility_provider  = $project_provider['provider_name'];
		$fields = [
			'Request' => [
				//'Test_Lead' => '1',
				'Key' => $KEY,
				'API_Action' => 'pingPostLead',
				'Format' => 'JSON',
				'Mode' => 'ping',
				'Return_Best_Price' => '1',
				'TYPE' => $TYPE,
				'Landing_Page' => Yii::app()->request->getParam('url','https://elitehomeimprovers.com'),
				'IP_Address' => Yii::app()->request->getParam('ipaddress'),
				'SRC' => $SRC,
				'Sub_ID' => Yii::app()->request->getParam('sub_id'),
				'Pub_ID' => Yii::app()->request->getParam('promo_code'),
				'Unique_Identifier' => Yii::app()->session['affiliate_trans_id'],
				'User_Agent' => Yii::app()->request->getParam('user_agent',self::$user_agent),
				'TCPA_Consent' => Yii::app()->request->getParam('tcpa_optin')==1?'Yes':'No',
				'TCPA_Language' =>Yii::app()->request->getParam('tcpa_text'),
				'Trusted_Form_URL' => Yii::app()->request->getParam('trustedformcerturl'),
				'LeadiD_Token' => Yii::app()->request->getParam('universal_leadid'),
				'City' => Yii::app()->request->getParam('city',$city_state['city']),
				'State' => Yii::app()->request->getParam('state',$city_state['state']),
				'Zip' => Yii::app()->request->getParam('zip'),
				'Trade' => $trade,
				'AC_Type' => self::$ACType[Yii::app()->request->getParam('air_type',rand(1,2))],
				'Heating_Type' => self::$HeatingType[Yii::app()->request->getParam('air_sub_type',rand(1,2))],
				'Utility_Provider' => $ecw_utility_provider,
				'Property_Type' => date('N')%2 == 0 ? 'Commercial' : 'Residential',
				'Average_Monthly_Utility_Bill' => self::$ElectricityBill[Yii::app()->request->getParam('monthly_bill',rand(1,10))],
				'Homeowner' => Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No',
				'Flooring_Type' => self::getFloorMaterial(Yii::app()->request->getParam('flooring_type')),
				'Project_Type' =>  date('N')%2 == 0 ? 'Replacement' : 'Repair',
				'Shade' => self::getRoofShade(Yii::app()->request->getParam('roof_shade')),
				'Comments' => Yii::app()->request->getParam('comments'),
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
		$KEY = $p2 ? $p2 : '4b5377d33317e703ab7d5f5fff272cf18f7936d0538b6a253b5489d8286df3f5';
		$SRC = 'EliteHomeImp';
		$TYPE = '38';
		$project_type = Yii::app()->request->getParam('project_type');
		$confirmation_id = $result['response']['lead_id'];
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$trade = self::$TradeType[$project_type];
		if($project_type == 42){// ROOFING
            $campaign['Roofing_Type'] = self::getRoofingType(Yii::app()->request->getParam('roofing_type',rand(1,2)));
        }
		if($project_type == 43){// SIDING
			$campaign['Siding_Type'] = self::getSidingType(Yii::app()->request->getParam('siding_type',rand(1,2)));
		}
		if($project_type == 52){ //WINDOWS
			$campaign['Number_Of_Windows'] = Yii::app()->request->getParam('number_of_rooms',rand(1,2));
		}
		$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
		$ecw_utility_provider  = $project_provider['provider_name'];
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
		        'Sub_ID' => Yii::app()->request->getParam('sub_id'),
                'Pub_ID' => Yii::app()->request->getParam('promo_code'),
                'Unique_Identifier' => Yii::app()->session['affiliate_trans_id'],
				'User_Agent' => Yii::app()->request->getParam('user_agent',self::$user_agent),
		        'TCPA_Consent' => Yii::app()->request->getParam('tcpa_optin')==1?'Yes':'No',
		        'TCPA_Language' =>Yii::app()->request->getParam('tcpa_text'),
				'Trusted_Form_URL' => Yii::app()->request->getParam('trustedformcerturl'),
		        'LeadiD_Token' => Yii::app()->request->getParam('universal_leadid'),
                'First_Name' => Yii::app()->request->getParam('first_name'),
                'Last_Name' => Yii::app()->request->getParam('last_name'),
                'Address' => Yii::app()->request->getParam('address'),
				'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => Yii::app()->request->getParam('state',$city_state['state']),
		        'Zip' => Yii::app()->request->getParam('zip'),
                'Email' => Yii::app()->request->getParam('email'),
                'Primary_Phone' => Yii::app()->request->getParam('phone'),
                'Trade' => $trade,
				'AC_Type' => self::$ACType[Yii::app()->request->getParam('air_type',rand(1,2))],
				'Heating_Type' => self::$HeatingType[Yii::app()->request->getParam('air_sub_type',rand(1,2))],
				'Utility_Provider' => $ecw_utility_provider,
				'Property_Type' => date('N')%2 == 0 ? 'Commercial' : 'Residential',
				'Average_Monthly_Utility_Bill' => self::$ElectricityBill[Yii::app()->request->getParam('monthly_bill',rand(1,10))],
				'Homeowner' => Yii::app()->request->getParam('home_owner')=='1' ? 'Yes' : 'No',
				'Flooring_Type' => self::getFloorMaterial(Yii::app()->request->getParam('flooring_type')),
				'Project_Type' =>  date('N')%2 == 0 ? 'Replacement' : 'Repair',
				'Shade' => self::getRoofShade(Yii::app()->request->getParam('roof_shade')),
				'Comments' => Yii::app()->request->getParam('comments'),
	    	]
    	];
		$fields['Request'] += $campaign;
		$post_request = json_encode($fields);
        //echo '<pre>';print_r($post_request);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $post_response = $cm->curl($post_url, $post_request);
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