<?php
class RankMediaAgencyController extends Controller {
    public function __construct() {
    }
    public static $converageType = [
        1 => 'State Min',
        2 => 'Basic',
        3 => 'Standard Premium',
        4 => 'Standard Premium'
	];
    public static $bodilyInjury = [
        1 => '250/500',
        2 => '100/300',
        3 => '50/100',
        4 => '25/50'
	];
	public static $not_allowed = ['xpres-health.com','xpres-quote.com','bestamericanhealth.com','bestamericanmedicare.com','bestamericanexpense.com','onlineinsurancepro.com','yourquoteguru.com','quickmedicarecoverage.com','financedoneright.com','essentialhealthinfo.com','seniorbeginnings.com','greaterTrip.com','findPrimejobs.com','insuranceoffersnow.com','insurancechiefs.com','netwayi.com','parasolleads.com','bestamericanauto.com','unitedquotes.com','health-signup.com'];

    public static $occupationListFromBuyer = ['Unknown','Administrative Clerical','Architect','Business Owner','Clergy','Construction','CPA','Dentist','Disabled','Engineer','Homemaker','Inside Sales','Lawyer','Manager or Supervisor','Military Enlisted','Military Officer','Minor','Other','Outside Sales','Physician','Professional Salaried','Professor','Retail','Retired','School Teacher','Scientist','Self Employed','Student','Unemployed'];
    public static $companyListFromBuyer = ['Other','21st Century','AAA','Acceptance','AIG','AIU','Alfa','Alliance Insurance','Allied','Allstate','AMCO','American Alliance','American Automobile Insurance','American Casualty','American Direct Business Insurance','American Economy','American Empire Insurance','American Family Insurance','American Financial','American Home Assurance','American Insurance','American International Insurance','American International Pacific','American International South','American Manufacturers','American Motorists Insurance','American National Insurance','American National Property and Casualty','American Protection Insurance','American Reliable','American Republic','American Service Insurance','American Skyline Insurance Company','American Spirit Insurance','American Standard Insurance OH','American Standard Insurance WI','AMEX Assurance','Amica','Amica Mutual','Associated Indemnity','Atlanta Casualty','Atlantic Indemnity','Atlantic Mutual','Auto Club Insurance Company','Bristol','Brooke Insurance','Cal Farm Insurance','California Automobile','California Casualty and Fire','California State Auto Assoc','Capital','Century National','Chubb','Clarendon National Insurance','CNA','Colonial Penn','Commerce Insurance','Commerce West','Commerical Union','Continental Casualty','Continental Divide Insurance','Continentual Insurance','Cotton States Insurance','Country Financial','Countrywide Insurance','Dairyland Insurnace','DIrect Auto','Direct General','Direct Insurance','Eagle','Electric Insurance','Elephant Insurance','Empire Fire and Marine','Erie Insurance','Erie Insurance Company','Esurance','Explorer','Farm Bureau','Farmers Insurance','Farmers Union','Federal Insurance','Financial Indemnity','Fire and Casualty Insurance Co of CT','Firemans Fund','Foremost','Freeway Insurance','Gainsco Insurance','Garrison','Geico','Geico Casualty','General Accident Insurance','GMAC Insurance','GoAuto Insurance','Good 2 Go','Great American','Guaranty National Insurance','Guide One Insurance','Hanover Lloyds Insurance Company','Hartford Accident and Indemnity','High Point Insurance','IFA Auto Insurance','Infinity Insurance','Insurance of the West','Integon','Kemper','Kemper Insurance','Leader National','Liberty Insurance Corp','Liberty Mutual Insurance','Liberty Northwest Insurance','Lumbermens Mutual','Mapfre Insurance','Maryland Casualty','Mercury','Metlife Auto and Home','Mid Century Insurance','Mid Continent Casualty','Middlesex Insurance','Mutual of Omaha','National Ben Franklin Insurance','National Casualty','National Continental Insurance','National Fire Insurance Company of Hartford','National General Insurance','National Union Fire Insurance of LA','National Union Fire Insurance of PA','Nationwide General Insurance','NJ Skylands Insurance','Northwestern Pacific Indemnity','Not Currently Insured','Ohio Casualty','Omni Insurance','Orion Auto','Other','Pacific Indemnity','Pacific Insurance','Palisades Insurance','Patriot General Insurance','Peak Property and Casualty Insurance','Pemco Insurance','Permanent General','Plymouth Rock','Progressive','Prudential Insurance Company','Republic Indemnity','Response Insurance','Safe Auto Insurance','Safeco','Safeway','Selective','Sentinel','Sentry Insurance Group','Shelter Insurance Co','St Paul','Standard Fire Insurance Company','State and County Mutual Fire Insurance','State Auto','State Farm County','State National Insurance','Superior Guaranty Insurance','Superior Insurance','The General','TICO Insurance','TIG Insurance Group','Titan','Travelers Insurance Company','TriState Consumer Insurance','Unigard','United Services Automobile','Unitrin Direct','US Agencies','USAA','USF and G','Verti','Wawanesa Mutual','Workmens Auto Insurance','Zurich Insurance Group'];
    	public static $maritialStatus = [
            1 => 'Single',
            2 => 'Married',
            3 => 'Separated',
            4 => 'Divorced',
            5 => 'Domestic Partnership',
            6 => 'Widowed'
      	];
		public static $education = [
            1 => 'GED',
            2 => 'SomeOrNoHighSchool',
            3 => 'HighSchoolDiploma',
            4 => 'SomeCollege',
            5 => 'AssociateDegree',
            6 => 'BachelorsDegree',
            7 => 'MastersDegree',
            8 => 'DoctorateDegree',
            9 => 'Unknown'
		];
	
    	public static $vehicleComprehensiveDeductibles = [
            1 =>'0',
            2 =>'50',
            3 =>'100',
            4 =>'250',
            5 =>'500',
            6 =>'1000',
            7 =>'2500',
            8 =>'5000',
        ];
 		public static $vehicleCollisionDeductibles = [
	        1 =>'0',
	        2 =>'50',
	        3 =>'100',
	        4 =>'250',
	        5 =>'500',
	        6 =>'1000',
	        7 =>'2500',
	        8 =>'5000'
    	];
    	public static $vehicleAnnualMileage = [
            1 => '5000',
            2 => '7500',
            3 => '10000',
            4 => '12500',
            5 => '15000',
            6 => '18000',
            7 => '25000',
            8 => '50000',
            9 => '100000'
		];
        public static $vehicleDailyMileage = [
            1 => '3',
            2 => '5',
            3 => '9',
            4 => '20',
            5 => '50',
            6 => '100'
        ];
        public static $creditRating = [
            1=>'Excellent',
            2=>'Good',
            3=>'Average',
            4=>'Poor',
        ];
        public static $PrimaryUser = [
            1=>'Business',
            2=>'Other',
            3=>'Other',
            4=>'Pleasure',
            5=>'Farm'
        ];
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver1_occupation'));
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$marital_status = self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status','2')];
		$education = self::$education[Yii::app()->request->getParam('driver1_education', '1')];
		$converage_type = Yii::app()->request->getParam('coverage_type', '1');
		$pingData = [];
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code,10001);
		$age = date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob')));
		$yeardiff = time() - strtotime(Yii::app()->request->getParam('insurance_start_date',rand(3,5)));
		$datediff = time() - strtotime(Yii::app()->request->getParam('insurance_expiration_date'));
		$Current_Insurance_Company_Years = round($yeardiff / (60*60*24*365));
		$insured_past_30_days = round($datediff/(60*60*24));
		$insured_past_30_days = $insured_past_30_days>30?'Yes':'No';
		$dob = date('Y-m-d',strtotime(Yii::app()->request->getParam('driver1_dob')));
		$fields = [
			'lp_campaign_id'=>$p1?$p1:'614e0e9f272ac',
			'lp_campaign_key'=>$p2?$p2:'JfLn6bPkYQjHW9ZFgBvc',
			'lp_response'=>'XML',
			'city'=>$city_state['city'],
			'state'=>$city_state['state'],
			'zip_code'=>$zip_code,
			'ip_address'=>Yii::app()->request->getParam('ipaddress'),
			'country'=>'USA',
			'dob'=>$dob,
			'age_licensed'=>rand(18,20),
			'license_status'=>'valid',
			'tcpa_language'=>Yii::app()->request->getParam('tcpa_text'),
			'requires_sr22_filing'=>Yii::app()->request->getParam('driver1_required_SR22')=='1'?'Yes':'No',
			'residence_type'=>(Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own',
			'years_at_residence' => Yii::app()->request->getParam('stay_in_year', '4'),
			'name_of_employer'=> Yii::app()->request->getParam('employer'),
			'education'=>$education,
			'marital_status'=>$marital_status,
			'occupation'=>$driver1_occupation,
			'us_residence'=>'true',
			'Currently_Insured'=>'Yes',
			'dui'=>'No',
			'License_state'=>$city_state['state']?$city_state['state']:'NY',
			'suspended_revoked'=>'No',
			'Insurance_company'=>$insuranceCompany,
			'coverage_type'=>self::$converageType[$converage_type],
			'primary_use_1'=>self::$PrimaryUser[Yii::app()->request->getParam('vehicle1_primary_use')],
			'alarm'=>'No alarm',
			'multi_vehicle'=>'No',
			'student'=>'No',
			'expiration_date'=>date('m/d/Y', strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
			'collision_deductible'=>self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
			'Comprehensive_deductible'=>self::$vehicleComprehensiveDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
			'annual_miles_1'=>self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage')],
			'universal_leadid'=>Yii::app()->request->getParam('universal_leadid'),
			'jornaya_lead_id'=>Yii::app()->request->getParam('universal_leadid'),
			'trusted_form_cert_id'=>Yii::app()->request->getParam('trustedformcerturl'),
			'credit_rating'=>self::$creditRating[Yii::app()->request->getParam('credit_rating', '0')],
			'bankruptcy'=> Yii::app()->request->getParam('bankruptcy', '0')==1?'Yes':'No',
			'repossessions'=>'No',
			'vin2'=>Yii::app()->request->getParam('vehicle2_vin',"1ACBC535*C*******"),
			'make_year_2'=>Yii::app()->request->getParam('vehicle2_make'),
			'Current_Insurance_Company_Years'=>$Current_Insurance_Company_Years,
			'landing_page'=>Yii::app()->request->getParam('url','https://eliteinsurers.com'),
			'insured_past_30_days'=>$insured_past_30_days,
			'ownership_type_1'=>Yii::app()->request->getParam('is_rented')==1?'Leased':'Own',
			'tcpa_consent'=>'Yes',
			'garage_type_1'=>'Covered',
			'is_salvaged_1'=>'No',
			'gender'=>Yii::app()->request->getParam('driver1_gender')=='M'?'Male':'Female',
			'vin1'=>Yii::app()->request->getParam('vehicle1_vin',"1ACBC535*B*******"),
			'make_year_1'=>Yii::app()->request->getParam('vehicle1_year'),
			'make1'=>Yii::app()->request->getParam('vehicle1_make'),
			'model1'=>Yii::app()->request->getParam('vehicle1_model'),
			'insured_since'=>date('m/d/Y', strtotime(Yii::app()->request->getParam('insurance_start_date'))),
		];
		$purchase = true;
		$url = Yii::app()->request->getParam('url');
		$url = parse_url($url, PHP_URL_HOST);
		$before = '.';
		$pos = strpos($url,$before);
		//$url = $pos !== false ? substr($url, $pos + strlen($before), strlen($url)) : "";
		if($url <> ""){
		    if (@preg_match("/$url/", var_export(self::$not_allowed, true))) {
		        $purchase = false;
		    }
		}
        if ($purchase == true) {
            $pingData['ping_request'] = http_build_query($fields);
        }else{
            $pingData['ping_request'] = false;
        }
        return $pingData;
    }

    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<result>(.*)<\/result>/msui", $ping_response, $result);
        if (trim($result[1]) == 'success' || trim($result[0]) == 'success') {
            preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $price);
            preg_match("/<Confirmation>(.*)<\/Confirmation>/msui", $ping_response, $confirmation_id);
            $ping_price = isset($price[1]) ? $price[1] : 0;
            $confirmation_id = $confirmation_id [1];
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
    public static function sendPostData($parameter1, $parameter2, $parameter3, $ping_response, $post_url, $status) {
		preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response, $confirmation_id);
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver1_occupation'));
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$marital_status = self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status','2')];
		$education = self::$education[Yii::app()->request->getParam('driver1_education', '1')];
		$converage_type = Yii::app()->request->getParam('coverage_type', '1');
		$pingData = [];
		$zip_code = Yii::app()->request->getParam('zip',10001);
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$age = date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob')));
		$yeardiff = time() - strtotime(Yii::app()->request->getParam('insurance_start_date',rand(3,5)));
		$datediff = time() - strtotime(Yii::app()->request->getParam('insurance_expiration_date'));
		$Current_Insurance_Company_Years = round($yeardiff / (60*60*24*365));
		$insured_past_30_days = round($datediff/(60*60*24));
		$insured_past_30_days = $insured_past_30_days>30?'Yes':'No';
		$dob = date('Y-m-d',strtotime(Yii::app()->request->getParam('driver1_dob')));
			$fields = [
				'lp_campaign_id'=>$p1?$p1:'614e0e9f272ac',
				'lp_campaign_key'=>$p2?$p2:'JfLn6bPkYQjHW9ZFgBvc',
				'lp_response'=>'XML',
				'lp_ping_id' => $confirmation_id[1],
				'first_name' => Yii::app()->request->getParam('driver1_first_name'),
				'last_name' => Yii::app()->request->getParam('driver1_last_name'),
				'phone_home' => Yii::app()->request->getParam('phone'),
				'phone_cell' => Yii::app()->request->getParam('phone2'),
				'address' => Yii::app()->request->getParam('address'),
				'city'=>$city_state['city'],
				'state'=>$city_state['state'],
				'zip_code'=>$zip_code,
				'ip_address'=>Yii::app()->request->getParam('ipaddress'),
				'country'=>'USA',
				'email_address'=>Yii::app()->request->getParam('email'),
				'dob'=>$dob,
				'age_licensed'=>rand(18,20),
				'license_status'=>'valid',
				'tcpa_language'=>Yii::app()->request->getParam('tcpa_text'),
				'requires_sr22_filing'=>Yii::app()->request->getParam('driver1_required_SR22')=='1'?'Yes':'No',
				'residence_type'=>(Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own',
				'years_at_residence' => Yii::app()->request->getParam('stay_in_year', '4'),
				'name_of_employer'=> Yii::app()->request->getParam('employer'),
				'education'=>$education,
				'marital_status'=>$marital_status,
				'occupation'=>$driver1_occupation,
				'us_residence'=>'true',
				'Currently_Insured'=>'Yes',
				'dui'=>'No',
				'License_state'=>$city_state['state']?$city_state['state']:'NY',
				'suspended_revoked'=>'No',
				'Insurance_company'=>$insuranceCompany,
				'coverage_type'=>self::$converageType[$converage_type],
				'primary_use_1'=>self::$PrimaryUser[Yii::app()->request->getParam('vehicle1_primary_use')],
				'alarm'=>'No alarm',
				'multi_vehicle'=>'No',
				'student'=>'No',
				'expiration_date'=>date('m/d/Y', strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
				'collision_deductible'=>self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
				'Comprehensive_deductible'=>self::$vehicleComprehensiveDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
				'annual_miles_1'=>self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage')],
				'universal_leadid'=>Yii::app()->request->getParam('universal_leadid'),
				'jornaya_lead_id'=>Yii::app()->request->getParam('universal_leadid'),
				'trusted_form_cert_id'=>Yii::app()->request->getParam('trustedformcerturl'),
				'credit_rating'=>self::$creditRating[Yii::app()->request->getParam('credit_rating', '0')],
				'bankruptcy'=> Yii::app()->request->getParam('bankruptcy', '0')==1?'Yes':'No',
				'repossessions'=>'No',
				'vin2'=>Yii::app()->request->getParam('vehicle2_vin',"1ACBC535*C*******"),
				'make_year_2'=>Yii::app()->request->getParam('vehicle2_make'),
				'Current_Insurance_Company_Years'=>$Current_Insurance_Company_Years,
				'landing_page'=>Yii::app()->request->getParam('url','https://eliteinsurers.com'),
				'insured_past_30_days'=>$insured_past_30_days,
				'ownership_type_1'=>Yii::app()->request->getParam('is_rented')==1?'Leased':'Own',
				'tcpa_consent'=>'Yes',
				'garage_type_1'=>'Covered',
				'is_salvaged_1'=>'No',
				'gender'=>Yii::app()->request->getParam('driver1_gender')=='M'?'Male':'Female',
				'vin1'=>Yii::app()->request->getParam('vehicle1_vin',"1ACBC535*B*******"),
				'make_year_1'=>Yii::app()->request->getParam('vehicle1_year'),
				'make1'=>Yii::app()->request->getParam('vehicle1_make'),
				'model1'=>Yii::app()->request->getParam('vehicle1_model'),
				'insured_since'=>date('m/d/Y', strtotime(Yii::app()->request->getParam('insurance_start_date'))),
			];
			$post_request = http_build_query($fields);
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			$post_response = $cm->curl($post_url, $post_request);
			$time_end = CommonToolsMethods::stopwatch();
			preg_match("/<result>(.*)<\/result>/", $post_response, $success);
			if (trim($success[1]) == 'success') {
				$post_status = '1';
				preg_match("/<Redirect>(.*)<\/Redirect>/", $post_response, $redirect);
				$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
				preg_match("/<Price>(.*)<\/Price>/msui", $post_response, $price);
				preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $ping_price);
				$post_price = isset($price[1]) ? $price[1] : $ping_price[1];
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
			//echo '<pre>';print_r($post_responses);die();
			return $post_responses;
    }
}