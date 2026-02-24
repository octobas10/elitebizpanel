<?php
class TurtleLeadsController extends Controller {
    public function __construct() {
    }
    public static $converageType = [
        1 => 'Preferred',
        2 => 'Premium',
        3 => 'Standard',
        4 => 'State Minimum',
	];
    public static $bodilyInjury = [
        1 => '250/500',
        2 => '100/300',
        3 => '50/100',
        4 => '25/50'
	];
	public static $vehicleDailyMileage = array (
            1 => '3',
            2 => '5',
            3 => '9',
            4 => '20',
            5 => '50',
            6 => '100'
        );
    public static $occupationListFromBuyer = ['Unknown','Administrative Clerical','Architect','Business Owner','Clergy','Construction','CPA','Dentist','Disabled','Engineer','Homemaker','Inside Sales','Lawyer','Manager or Supervisor','Military Enlisted','Military Officer','Minor','Other','Outside Sales','Physician','Professional Salaried','Professor','Retail','Retired','School Teacher','Scientist','Self Employed','Student','Unemployed'];

    public static $companyListFromBuyer = ["Not Insured at This Time","Other","21st Century Insurance","AAA Insurance Co.","AABCO","AARP","Access Insurance","Acordia","Aegis Security","Aetna","Affirmative","Aflac","AHCP","AIG","AIU Insurance","Alfa Insurance","All Nation","All Risk","Alleghany Corporation","Allianz","Allied Group","Allied","Allmerica","Allstate Insurance","American Alliance Ins Co","American Automobile Insurance","American Banks","American Casualty","American Deposit Insurance","American Direct Business Insurance","American Economy Ins Co","American Empire Insurance","American Family Insurance","American Financial","American Health Underwriters","American Home Assurance","American Income Life Insurance Company","American Insurance","American International Ins","American International Pacific","American International South","American Manufacturers","American Mayflower Insurance","American Medical Securities","American Motorists Insurance","American National Insurance","American National Property and Casualty","American Premier","American Protection Insurance","American Reliable Ins Co","American Republic","American Savers Plan","American Service Insurance","American Skyline Insurance Company","American Spirit Insurance","American Standard Insurance - OH","American Standard Insurance - WI","American States","Americas Ins. Consultants","AmeriPlan","Ameriprise","Amerisure","Ameritas Life Insurance Company","Amex Assurance Co","Amica Insurance","Amica Mutual Ins Co","Answer Financial","Anthem","API","Arbella","Arizona General","Armed Forces Insurance","Assigned Risk","Associated Indemnity","Associated Insurance Managers","Assurant","Atlanta Casualty","Atlanta Specialty","Atlantic Indemnity","Atlantic Mutual Co","Atlantis","Austin Mutual","Auto Club Insurance Company","Auto Owners","Avomark","AXA Equitable Life Insurance Company","Badger Mutual","Bankers Life and Casualty Company","Banner Life","Berkshire Hathaway","Best Agency USA","Blue Cross / Blue Shield","Bonneville","Boston Old Colony","Builders","Cal Farm Insurance","Calfarm Ins Co","California Casualty and Fire Ins Co","California State Automobile Association","Camden","Capital Choice","Cascade National Ins","Casualty Assurance","Centennial","Century National Ins","Charter Oak","Chartis","Chase Insurance Group","Chicago Insurance","Chubb Group of Ins Co","Church Mutual","Cigna","Cincinnati Insurance Company","Citizens","Clarendon National Insurance","Clarendon","Cloverleaf","CNA","Colonial Penn","Colonial","Combined","Commerce Insurance Group","Commerce West","Commercial Union","Commonwealth","Conseco","Continental Casualty","Continental Divide Insurance","Continental Insurance","Cotton States Insurance","Cottonwood","Country Financial","Countrywide Insurance","Criterion","CSE Insurance Group","CUNA Mutual","Dairyland Insurance","Dakota Fire","Deerbrook","Depositors Emcasc","Direct General Insurance","Dixie","Eagle Ins Co","Ebco General","eFinancial","eHealth","Electric Insurance","Elephant","EMC","Empire Fire and Marine","Employers Fire","Encompass Insurance Company","Ensure","Equitable Life","Erie Insurance Company","Esurance","Evergreen USA RRG","Explorer","Facility","Farm and Ranch","Farm Bureau/Farm Family/Rural","Farmers Insurance","Farmers Union","Farmland","Federal Ins Co","Federated Mutual Insurance Company","Fidelity Insurance Company","Financial Indemnity","Fire and Casualty Insurance Co of CT","Firemans Fund","First Acceptance Insurance","First American","First Financial","First General","First Insurance Company of Hawaii, LTD","First National","FM Global","Ford Motor Credit","Foremost","Foresters","Fortis","Franklin","GAINSCO","Geico Casualty","Geico","General Accident Insurance","General Re","Genworth Financial","Globe","GMAC Insurance","Grange","GRE Harleysville H","Great American Ins Co","Great Way","Great West Casualty Company","Grinnell Mutual","Guaranty National Insurance","Guardian Life Insurance Company of America","Guide One Insurance","Halcyon","Hanover Ins Co","Hanover Lloyds Insurance Company","Happy Days","Hartford Accident and Indemnity","Hawkeye Security","HCC Insurance Holdings","Health Benefits Direct","Health Choice One","Health Net","Health Plus of America","HealthMarkets","HealthShare American","Heritage","Home State County Mutual","Horace Mann","Humana","IAB","IFA Auto Insurance","IGF","IIS Insurance","Infinity Insurance","Infinity Select Insurance","Insphere Insurance Solutions","Insur. of Evanston","Insurance Co of the West","Insurance Insight","Integon","Interstate","Jackson National Life","John Deere","John Hancock Insurance","Kaiser Permanente","Kemper Insurance","Kentucky Central","Kentucky Farm Bureau","Knights of Columbus","Landmark American Insurance","Leader Insurance","Leader National","Leader Preferred Insurance","Leader Specialty Insurance","League General","Liberty Insurance Corp","Liberty Mutual Insurance","Liberty National","Liberty Northwest Insurance","Lincoln Benefit Life","Lincoln National Corporation","LTC Financial Partners","Lumbermens Mutual","Marathon","Markel Corporation","Maryland Casualty","MassMutual Financial Group","Matrix Direct","MEGA Life and Health","Mega/Midwest","Mendota","Merastar","Merchants Insurance Group","Mercury","MetLife Auto and Home","MetLife","Mid Century Insurance","Mid-Continent Casualty","Middlesex Insurance","Midland National Life","Midwest Mutual","Millbank","Millers Mutual","Milwaukee","Minnehoma","Missouri General","Modern Woodmen of America","Mortgage Protection Bureau","Motors","Mountain Laurel","Mutual Insurance","Mutual Of Enumclaw","Mutual of New York","Mutual of Omaha","National Alliance","National Ben Franklin Insurance","National Casualty","National Colonial","National Continental Insurance","National Fire Insurance Company of Hartford","National Health Insurance","National Indemnity","National Merit","National Surety Corp","National Union Fire Insurance","Nationwide General Insurance","Nationwide Mutual Insurance Company","Natl Farmers Union","New England Financial","New Jersey Manufacturers Insurance Company","New York Life Insurance Company","NJ Skylands Insurance","North American","North Pacific","North Pointe","North Shore","Northern Capital","Northern States","Northland","Northwestern Mutual Life","Northwestern Pacific Indemnity","Ohio Casualty","Ohio Security","Olympia","Omega","Omni Insurance","OneBeacon","Oregon Mutual","Orion Insurance","Other","Oxford Health Plans","Pacific Indemnity","Pacific Insurance","Pacific Life","Pacificare","Pafco","Paloverde","Patriot General Insurance","Peak Property and Casualty Insurance","PEMCO Insurance","Penn America","Penn Mutual","Pennsylvania Natl","Philadelphia Insurance Companies","Phoenix","Physicians","Pinnacle","Pioneer Life","Plymouth Rock Assurance","Preferred Mutual","Premier","Prestige","Primerica","Principal Financial","Progressive","Protective Life","Provident","Prudential Insurance Co.","QBE Insurance","Quality","Ramsey","RBC Liberty Insurance","Regal","Reliance Insurance Company","Reliant","Republic Indemnity","Response Insurance","RLI Corp.","Rockford Mutual","Rodney D. Young","Safe Auto Insurance Company","SAFECO","Safeguard","Safeway Insurance","Sea West Insurance","Security Insurance","Security National","Sedgwick James","Selective Insurance","Sentinel Insurance","Sentry Insurance Group","Shelter Insurance Co.","Skandia TIG Tita","Southern Aid and Insurance Company","Spectrum","St. Paul Fire and Marine Ins Co","St. Paul","Standard Fire Insurance Company","Standard Guaranty","Standard Insurance Company","State and County Mutual Fire Insurance","State Auto Ins Co","State Farm County","State Farm Insurance","State Mutual","State National Insurance","Sun Coast","Sun Life Financial","Superior American Insurance","Superior Guaranty Insurance","Superior Insurance","Superior","Sutter","Symetra","The Ahbe Group","The Credo Group","The General","The Hartford","The Regence Group","TIAA-CREF","TICO Insurance","TIG Countrywide Insurance","Titan","Total","Tower","TransAmerica","Travelers Insurance Company","Trinity Universal","Tri-State Consumer Insurance","Trupanion","Trust Hall","Twin City Fire Insurance","Unicare","Unigard Ins","Union","United American","United Financial","United Fire Group","United Security","United Services Automobile Association","Unitrin Direct","Universal Underwriters Insurance","Unum","US Financial","US Health Advisors","USA Benefits/Continental General","USAA","USF and G","Utah Home and Fire","Utica","Vasa North Atlantic","Vigilant","Viking","Wawanesa Mutual","Wellington","Wellpoint","West American","West Bend Mutual","West Coast Life","West Plains","Western and Southern Life","Western Mutual Insurance Group","Western National","Western Southern Life","White Mountains Insurance Group","William Penn","Windsor","Windstar","Wisconsin Mutual","Woodlands Financial Group","Workmens Auto Insurance","World Insurance","Worldwide","Yellow Key","Yosemite","Zurich North America"];

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
            2 => 'Some or No High School',
            3 => 'High School Diploma',
            4 => 'Some College',
            5 => 'Associate Degree',
            6 => 'Bachelors Degree',
            7 => 'Masters Degree',
            8 => 'Doctorate Degree',
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
        public static $creditRating = [
            1=>'Excellent',
            2=>'Good',
            3=>'Average',
            4=>'Poor',
        ];
        public static $PrimaryUse = [
            1=>'Business',
            2=>'Commute Work',
            3=>'Commute School',
            4=>'Pleasure',
            5=>'Commute Varies'
        ];
        public static $ContinuousCoveragePeriod = [
            1=>'Less Than 6 Months',
            2=>'6 Months',
            3=>'1 Year',
            4=>'2 Years',
            5=>'3 Years',
            6=>'3 to 5 Years',
            7=>'More than 5 Years',
        ];
        public static $user_agent_list = ['Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1','Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36','Roku4640X/DVP-7.70 (297.70E04154A)','Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30','Mozilla/5.0 (Linux; Android 5.1; AFTS Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/41.99900.2250.0242 Safari/537.36','Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)','Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US','Mozilla/5.0 (Windows NT 10.0; Win64; x64; XBOX_ONE_ED) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393'];

    public static $not_allowed = ['bestamerican.com'];
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
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$age = date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob')));
		$yeardiff = time() - strtotime(Yii::app()->request->getParam('insurance_start_date'));
		$datediff = time() - strtotime(Yii::app()->request->getParam('insurance_expiration_date'));
		$Current_Insurance_Company_Years = round($yeardiff / (60*60*24*365));
		$insured_past_30_days = round($datediff/(60*60*24));
		$insured_past_30_days = $insured_past_30_days>30?'Yes':'No';
		$dob = date('Y-m-d',strtotime(Yii::app()->request->getParam('driver1_dob')));
        $user_agent = self::$user_agent_list[array_rand(self::$user_agent_list)];
        $vehicle_vin = Yii::app()->request->getParam('vehicle1_vin',"00000000000000000");
        $vehicle_vin = $vehicle_vin == '' ? '00000000000000000' : $vehicle_vin;
		$fields = [
			'lp_campaign_id'=>$p1?$p1:'630fa988acc88',
			'lp_campaign_key'=>$p2?$p2:'xy2W4bHRVXJMnTd8PDtp',
			'lp_response'=>'XML',
			'city'=>$city_state['city'],
			'state'=>$city_state['state'],
			'zip_code'=>$zip_code,
			'ip_address'=>Yii::app()->request->getParam('ipaddress'),
			'country'=>'USA',
			'dob'=>$dob,
			'age_when_licensed' => $age,
			'driver_relationship'=>'Spouse',
			'tcpa_consent_text'=>Yii::app()->request->getParam('tcpa_text','By submitting'),
            'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
            'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
			'years_at_current_residence' =>Yii::app()->request->getParam('stay_in_year'),
			'requires_sr22'=>Yii::app()->request->getParam('driver1_required_SR22')=='1'?'treu':'false',
			'bankruptcy' =>Yii::app()->request->getParam('bankruptcy','0')==1?'true':'false',
			'currently_employed' =>'Yes',
			'requested_policy_coverage_type' =>self::$converageType[$converage_type],
			'gender'=>Yii::app()->request->getParam('driver1_gender')=='M'?'M':'F',
			'landing_page'=>Yii::app()->request->getParam('url','https://eliteinsurers.com'),
			'marital_status'=>$marital_status,
			'license_status' =>'Active',
			'education' =>$education,
			'homeowner' =>Yii::app()->request->getParam('is_rented')=='rent'?'No':'Yes',
			'vehicle_ownership' =>Yii::app()->request->getParam('vehicle1_vehicle_ownership')=='1'?'Own':'Lease',	
			'vehicle_primary_use' =>self::$PrimaryUse[Yii::app()->request->getParam('vehicle1_primary_use')],
			'tcpa_consent'=>'Yes',
			'tcpa_language'=>Yii::app()->request->getParam('tcpa_text'),
			'occupation' => $driver1_occupation,
			'tickets_or_claims_in_last_three_years'=>'false',
			'vehicle_make'=>Yii::app()->request->getParam('vehicle1_make'),
			'vehicle_model'=>Yii::app()->request->getParam('vehicle1_model'),
			'vehicle_submodel'=>Yii::app()->request->getParam('vehicle1_submodel','trim'),
			'vehicle_vin'=>$vehicle_vin,
			'estimated_annual_mileage'=>self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage')],
			'residence_status'=>Yii::app()->request->getParam('is_rented') == 'rent' ? 'Rent':'Own',
			'current_insurance_company'=>$insuranceCompany,
			'currently_insured'=>'Yes',
			'vehicle_days_week'=>'',
			'vehicle_oneway_distance'=>self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
			'current_coverage_type'=>self::$converageType[$converage_type],
			'incident_date_1'=>Yii::app()->request->getParam('driver1_incident1_date'),
			'incident_date_2'=>'',
			'current_coverage_start_date'=>Yii::app()->request->getParam('insurance_start_date'),
			'current_coverage_end_date'=>Yii::app()->request->getParam('insurance_expiration_date'),
			'vehicle_year'=>Yii::app()->request->getParam('vehicle1_year'),
			'additional_vehicles'=>'',
			'continuous_coverage'=>self::$ContinuousCoveragePeriod[Yii::app()->request->getParam('continuously_insured_period')],
			'credit'=>self::$creditRating[Yii::app()->request->getParam('credit_rating', '0')],
			'age_when_licensed'=>$age,
            'user_agent' => $user_agent,
		];
        /*if($_SERVER['REMOTE_ADDR'] == '82.36.128.57'){
            echo '<pre>';
            print_r($fields);
            exit;
        }*/
		$purchase = true;
        $url = Yii::app()->request->getParam('url');
        $url = parse_url($url, PHP_URL_HOST);
        $before = '.';
        $pos = strpos($url ,$before);
        $url = $pos !== false ? substr($url, $pos + strlen($before), strlen($url)) : "";
        if($url <> ""){
            if (@preg_match("/$url/", var_export(self::$not_allowed, true))) {
                $purchase = true;
            }
        }
		if ($purchase === true) {
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
		preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response,$confirmation_id);
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver1_occupation'));
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$marital_status = self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status','2')];
		$education = self::$education[Yii::app()->request->getParam('driver1_education', '1')];
		$converage_type = Yii::app()->request->getParam('coverage_type', '1');
		$pingData = [];
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$age = date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob')));
		$yeardiff = time() - strtotime(Yii::app()->request->getParam('insurance_start_date'));
		$datediff = time() - strtotime(Yii::app()->request->getParam('insurance_expiration_date'));
		$Current_Insurance_Company_Years = round($yeardiff / (60*60*24*365));
		$insured_past_30_days = round($datediff/(60*60*24));
		$insured_past_30_days = $insured_past_30_days>30?'Yes':'No';
		$dob = date('Y-m-d',strtotime(Yii::app()->request->getParam('driver1_dob')));
        $user_agent = self::$user_agent_list[array_rand(self::$user_agent_list)];
        $vehicle_vin = Yii::app()->request->getParam('vehicle1_vin',"00000000000000000");
        $vehicle_vin = $vehicle_vin == '' ? '00000000000000000' : $vehicle_vin;
		$fields = [
			'lp_campaign_id'=>$p1?$p1:'630fa988acc88',
			'lp_campaign_key'=>$p2?$p2:'xy2W4bHRVXJMnTd8PDtp',
			'lp_response'=>'XML',
			'lp_ping_id'=>$confirmation_id[1],
			'first_name'=>Yii::app()->request->getParam('driver1_first_name'),
			'last_name'=>Yii::app()->request->getParam('driver1_last_name'),
			'phone_home'=>Yii::app()->request->getParam('phone'),
			'address'=>Yii::app()->request->getParam('address'),
			'city'=>$city_state['city'],
			'state'=>$city_state['state'],
			'zip_code'=>$zip_code,
			'email_address'=>Yii::app()->request->getParam('email'),
			'ip_address'=>Yii::app()->request->getParam('ipaddress'),
			'country'=>'USA',
			'dob'=>$dob,
			'age_when_licensed' => $age,
			'driver_relationship'=>'Spouse',
			'tcpa_consent_text'=>Yii::app()->request->getParam('tcpa_text','By submitting'),
            'tcpa_consent'=>'Yes',
			'years_at_current_residence' =>Yii::app()->request->getParam('stay_in_year'),
			'requires_sr22'=>Yii::app()->request->getParam('driver1_required_SR22')=='1'?'true':'false',
			'bankruptcy' =>Yii::app()->request->getParam('bankruptcy', '0')==1?'true':'false',
			'currently_employed' =>'Yes',
			'requested_policy_coverage_type' =>self::$converageType[$converage_type],
			'gender'=>Yii::app()->request->getParam('driver1_gender')=='M'?'M':'F',
			'user_agent' => $user_agent,
			'landing_page'=>Yii::app()->request->getParam('url','https://eliteinsurers.com'),
			'marital_status'=>$marital_status,
			'license_status' =>'Active',
			'education' =>$education,
			'homeowner' =>Yii::app()->request->getParam('is_rented')=='rent'?'No':'Yes',
			'vehicle_ownership' =>Yii::app()->request->getParam('vehicle1_vehicle_ownership')=='1'?'Own':'Lease',	
			'vehicle_primary_use' =>self::$PrimaryUse[Yii::app()->request->getParam('vehicle1_primary_use')],
			'tcpa_consent'=>'Yes',
			'tcpa_consent_text'=>Yii::app()->request->getParam('tcpa_text','i submit'),
            'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
            'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
			'occupation' => $driver1_occupation,
			'tickets_or_claims_in_last_three_years'=>'false',
			'vehicle_make'=>Yii::app()->request->getParam('vehicle1_make'),
			'vehicle_model'=>Yii::app()->request->getParam('vehicle1_model'),
			'vehicle_submodel'=>Yii::app()->request->getParam('vehicle1_submodel','trim'),
			'vehicle_vin'=>$vehicle_vin,
			'estimated_annual_mileage'=>self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage')],
			'residence_status'=>Yii::app()->request->getParam('is_rented') == 'rent' ? 'Rent':'Own',
			'current_insurance_company'=>$insuranceCompany,
			'currently_insured'=>'Yes',
			'vehicle_days_week'=>'',
			'vehicle_oneway_distance'=>self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
			'current_coverage_type'=>self::$converageType[$converage_type],
			'incident_date_1'=>Yii::app()->request->getParam('driver1_incident1_date'),
			'incident_date_2'=>'',
			'current_coverage_start_date'=>Yii::app()->request->getParam('insurance_start_date'),
			'current_coverage_end_date'=>Yii::app()->request->getParam('insurance_expiration_date'),
			'vehicle_year'=>Yii::app()->request->getParam('vehicle1_year'),
			'additional_vehicles'=>'',
			'continuous_coverage'=>self::$ContinuousCoveragePeriod[Yii::app()->request->getParam('continuously_insured_period')],
			'credit'=>self::$creditRating[Yii::app()->request->getParam('credit_rating', '0')],
			'age_when_licensed'=>$age,
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