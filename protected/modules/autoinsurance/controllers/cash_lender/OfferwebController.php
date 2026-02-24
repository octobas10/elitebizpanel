<?php
class OfferwebController extends Controller {
    public static $AccidentType = [
            1 => '5',
            2 => '3',
            3 => '4',
            4 => '2',
            5 => '1',
            6 => '0'
    ];
    public static $Damage = [
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '0'
        ];

    public static $PrimaryUsage = [
            1 => 'Business',
            2 => 'Commute To/From Work',
            3 => 'Commute To/From School',
            4 => 'Pleasure',
            5 => 'Government'
    ];
    public static $converageType = [
            1 => 'Superior',
            2 => 'Standard',
            3 => 'Basic',
            4 => 'State'
    ];
    public static $bodilyInjury = [
            1 => '250/500',
            2 => '100/300',
            3 => '50/100',
            4 => '25/50'
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
    public static $maritialStatus = [
            1 => 'Single',
            2 => 'Married',
            3 => 'Separated',
            4 => 'Divorced',
            5 => 'Married',
            6 => 'Widowed'
    ];
    public static $creditRating = [
            1 => 'Excellent',
            2 => 'Good',
            3 => 'Average',
            4 => 'Poor',
    ];
    public static $educationList = [
            1 => 'GED',
            2 => 'Some Or No High School',
            3 => 'High School',
            4 => 'Some College',
            5 => 'Associate Degree',
            6 => 'Bachelors Degree',
            7 => 'Masters Degree',
            8 => 'Doctoral Degree',
            9 => 'Unknown',
    ];
	public static $driverAccidentDescription = [
            1 => 'Vehicle Hit Vehicle',
            2 => 'Vehicle Hit Pedestrian',
            3 => 'Vehicle Hit Property',
            4 => 'Vehicle Damaged Avoiding Accident',
            5 => 'At Fault Accident Not Listed',
            6 => 'Loss Claim Not Listed'
    ];
    public static $AccidentDamage = [
            1 => 'People',
            2 => 'Property',
            3 => 'Both',
            4 => 'Not Applicable',
    ];
    public static $occupationListFromBuyer = ['Advertising','Arts/Entertainment','Banking/Mortgage','Clerical/Administrative','Clergy/Religious','Construction/Facilities','Customer Service','Disabled','Education/Training','Engineer/Architect','Government','Health Care','Homemaker','Hospitality/Travel','Human Resources','Insurance','Internet/New Media','Law Enforcement','Legal','Management Consulting','Manufacturing','Marketing','Military/Defense','Non-Profit/Volunteer','Pharmaceutical/Biotech','Real Estate','Restaurant/Food Service','Retail','Retired','Sales','Self Employed','Student','Technology','Telecommunications','Transportation','Unemployed','Other/Not Listed'];
    public static $companyListFromBuyer = ["Company Not Listed","21st Century Insurance","AAA Insurance Co.","AABCO","AARP","Access Insurance","Acordia","Aegis Security","Aetna","Affirmative","Aflac","AHCP","AIG","AIU Insurance","Alfa Insurance","All Nation","All Risk","Alleghany Corporation","Allianz","Allied Group","Allied","Allmerica","Allstate Insurance","American Alliance Ins Co","American Automobile Insurance","American Banks","American Casualty","American Deposit Insurance","American Direct Business Insurance","American Economy Ins Co","American Empire Insurance","American Family Insurance","American Financial","American Health Underwriters","American Home Assurance","American Income Life Insurance Company","American Insurance","American International Ins","American International Pacific","American International South","American Manufacturers","American Mayflower Insurance","American Medical Securities","American Motorists Insurance","American National Insurance","American National Property and Casualty","American Premier","American Protection Insurance","American Reliable Ins Co","American Republic","American Savers Plan","American Service Insurance","American Skyline Insurance Company","American Spirit Insurance","American Standard Insurance - OH","American Standard Insurance - WI","American States","Americas Ins. Consultants","AmeriPlan","Ameriprise","Amerisure","Ameritas Life Insurance Company","Amex Assurance Co","Amica Insurance","Amica Mutual Ins Co","Answer Financial","Anthem","API","Arbella","Arizona General","Armed Forces Insurance","Assigned Risk","Associated Indemnity","Associated Insurance Managers","Assurant","Atlanta Casualty","Atlanta Specialty","Atlantic Indemnity","Atlantic Mutual Co","Atlantis","Austin Mutual","Auto Club Insurance Company","Auto Owners","Avomark","AXA Equitable Life Insurance Company","Badger Mutual","Bankers Life and Casualty Company","Banner Life","Berkshire Hathaway","Best Agency USA","Blue Cross / Blue Shield","Bonneville","Boston Old Colony","Builders","Cal Farm Insurance","Calfarm Ins Co","California Casualty and Fire Ins Co","California State Automobile Association","Camden","Capital Choice","Cascade National Ins","Casualty Assurance","Centennial","Century National Ins","Charter Oak","Chartis","Chase Insurance Group","Chicago Insurance","Chubb Group of Ins Co","Church Mutual","Cigna","Cincinnati Insurance Company","Citizens","Clarendon National Insurance","Clarendon","Cloverleaf","CNA","Colonial Penn","Colonial","Combined","Commerce Insurance Group","Commerce West","Commercial Union","Commonwealth","Conseco","Continental Casualty","Continental Divide Insurance","Continental Insurance","Cotton States Insurance","Cottonwood","Country Financial","Countrywide Insurance","Criterion","CSE Insurance Group","CUNA Mutual","Dairyland Insurance","Dakota Fire","Deerbrook","Depositors Emcasc","Direct General Insurance","Dixie","Eagle Ins Co","Ebco General","eFinancial","eHealth","Electric Insurance","Elephant","EMC","Empire Fire and Marine","Employers Fire","Encompass Insurance Company","Ensure","Equitable Life","Erie Insurance Company","Esurance","Evergreen USA RRG","Explorer","Facility","Farm and Ranch","Farm Bureau/Farm Family/Rural","Farmers Insurance","Farmers Union","Farmland","Federal Ins Co","Federated Mutual Insurance Company","Fidelity Insurance Company","Financial Indemnity","Fire and Casualty Insurance Co of CT","Firemans Fund","First Acceptance Insurance","First American","First Financial","First General","First Insurance Company of Hawaii, LTD","First National","FM Global","Ford Motor Credit","Foremost","Foresters","Fortis","Franklin","GAINSCO","Geico Casualty","Geico","General Accident Insurance","General Re","Genworth Financial","Globe","GMAC Insurance","Grange","GRE Harleysville H","Great American Ins Co","Great Way","Great West Casualty Company","Grinnell Mutual","Guaranty National Insurance","Guardian Life Insurance Company of America","Guide One Insurance","Halcyon","Hanover Ins Co","Hanover Lloyds Insurance Company","Happy Days","Hartford Accident and Indemnity","Hawkeye Security","HCC Insurance Holdings","Health Benefits Direct","Health Choice One","Health Net","Health Plus of America","HealthMarkets","HealthShare American","Heritage","Home State County Mutual","Horace Mann","Humana","IAB","IFA Auto Insurance","IGF","IIS Insurance","Infinity Insurance","Infinity Select Insurance","Insphere Insurance Solutions","Insur. of Evanston","Insurance Co of the West","Insurance Insight","Integon","Interstate","Jackson National Life","John Deere","John Hancock Insurance","Kaiser Permanente","Kemper Insurance","Kentucky Central","Kentucky Farm Bureau","Knights of Columbus","Landmark American Insurance","Leader Insurance","Leader National","Leader Preferred Insurance","Leader Specialty Insurance","League General","Liberty Insurance Corp","Liberty Mutual Insurance","Liberty National","Liberty Northwest Insurance","Lincoln Benefit Life","Lincoln National Corporation","LTC Financial Partners","Lumbermens Mutual","Marathon","Markel Corporation","Maryland Casualty","MassMutual Financial Group","Matrix Direct","MEGA Life and Health","Mega/Midwest","Mendota","Merastar","Merchants Insurance Group","Mercury","MetLife Auto and Home","MetLife","Mid Century Insurance","Mid-Continent Casualty","Middlesex Insurance","Midland National Life","Midwest Mutual","Millbank","Millers Mutual","Milwaukee","Minnehoma","Missouri General","Modern Woodmen of America","Mortgage Protection Bureau","Motors","Mountain Laurel","Mutual Insurance","Mutual Of Enumclaw","Mutual of New York","Mutual of Omaha","National Alliance","National Ben Franklin Insurance","National Casualty","National Colonial","National Continental Insurance","National Fire Insurance Company of Hartford","National Health Insurance","National Indemnity","National Merit","National Surety Corp","National Union Fire Insurance","Nationwide General Insurance","Nationwide Mutual Insurance Company","Natl Farmers Union","New England Financial","New Jersey Manufacturers Insurance Company","New York Life Insurance Company","NJ Skylands Insurance","North American","North Pacific","North Pointe","North Shore","Northern Capital","Northern States","Northland","Northwestern Mutual Life","Northwestern Pacific Indemnity","Ohio Casualty","Ohio Security","Olympia","Omega","Omni Insurance","OneBeacon","Oregon Mutual","Orion Insurance","Other","Oxford Health Plans","Pacific Indemnity","Pacific Insurance","Pacific Life","Pacificare","Pafco","Paloverde","Patriot General Insurance","Peak Property and Casualty Insurance","PEMCO Insurance","Penn America","Penn Mutual","Pennsylvania Natl","Philadelphia Insurance Companies","Phoenix","Physicians","Pinnacle","Pioneer Life","Plymouth Rock Assurance","Preferred Mutual","Premier","Prestige","Primerica","Principal Financial","Progressive","Protective Life","Provident","Prudential Insurance Co.","QBE Insurance","Quality","Ramsey","RBC Liberty Insurance","Regal","Reliance Insurance Company","Reliant","Republic Indemnity","Response Insurance","RLI Corp.","Rockford Mutual","Rodney D. Young","Safe Auto Insurance Company","SAFECO","Safeguard","Safeway Insurance","Sea West Insurance","Security Insurance","Security National","Sedgwick James","Selective Insurance","Sentinel Insurance","Sentry Insurance Group","Shelter Insurance Co.","Skandia TIG Tita","Southern Aid and Insurance Company","Spectrum","St. Paul Fire and Marine Ins Co","St. Paul","Standard Fire Insurance Company","Standard Guaranty","Standard Insurance Company","State and County Mutual Fire Insurance","State Auto Ins Co","State Farm County","State Farm Insurance","State Mutual","State National Insurance","Sun Coast","Sun Life Financial","Superior American Insurance","Superior Guaranty Insurance","Superior Insurance","Superior","Sutter","Symetra","The Ahbe Group","The Credo Group","The General","The Hartford","The Regence Group","TIAA-CREF","TICO Insurance","TIG Countrywide Insurance","Titan","Total","Tower","TransAmerica","Travelers Insurance Company","Trinity Universal","Tri-State Consumer Insurance","Trupanion","Trust Hall","Twin City Fire Insurance","Unicare","Unigard Ins","Union","United American","United Financial","United Fire Group","United Security","United Services Automobile Association","Unitrin Direct","Universal Underwriters Insurance","Unum","US Financial","US Health Advisors","USA Benefits/Continental General","USAA","USF and G","Utah Home and Fire","Utica","Vasa North Atlantic","Vigilant","Viking","Wawanesa Mutual","Wellington","Wellpoint","West American","West Bend Mutual","West Coast Life","West Plains","Western and Southern Life","Western Mutual Insurance Group","Western National","Western Southern Life","White Mountains Insurance Group","William Penn","Windsor","Windstar","Wisconsin Mutual","Woodlands Financial Group","Workmens Auto Insurance","World Insurance","Worldwide","Yellow Key","Yosemite","Zurich North America"];

    public static $userAgentList = ['Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1','Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36','Roku4640X/DVP-7.70 (297.70E04154A)','Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30','Mozilla/5.0 (Linux; Android 5.1; AFTS Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/41.99900.2250.0242 Safari/537.36','Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)','Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US','Mozilla/5.0 (Windows NT 10.0; Win64; x64; XBOX_ONE_ED) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393'];
        
    
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $pingData = [];
        $p1 = $p1 ? $p1 : '513257';
		$IPAddress = Yii::app()->request->getParam('ipaddress');
        $user_agent_list = self::$userAgentList;
        $user_agent = $user_agent_list[array_rand($user_agent_list)];
		$user_agent = Yii::app()->request->getParam('user_agent',$user_agent);
		$LeadDateTime = date('Y-m-d H:i:s');
		$Unique_identifier = Yii::app()->session['affiliate_trans_id'];
		$TCPAOptin = Yii::app()->request->getParam('tcpa_optin','Yes')==1?'Yes':'No';
		$TCPAText = Yii::app()->request->getParam('tcpa_text','By submitting this form');
		$UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
		$SubID = Yii::app()->request->getParam('sub_id');
		$url = Yii::app()->request->getParam('url','https://eliteinsurers.com');
		$promo_code = Yii::app()->request->getParam('promo_code');
		$zip = Yii::app()->request->getParam('zip');
		$residence_type = (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own';
		$years_at_residence = Yii::app()->request->getParam('stay_in_year','4');
		$months_at_residence = Yii::app()->request->getParam('stay_in_month','3');
		$credit_rating = Yii::app()->request->getParam('credit_rating','3');
		$bankruptcy = Yii::app()->request->getParam('bankruptcy','0');
		$coverageType = Yii::app()->request->getParam('coverage_type','3');
		$driver1_hasTAVCs=(Yii::app()->request->getParam('driver1_hasTAVCs')=='0') ? 'No' : 'Yes';
		$driver2_hasTAVCs=(Yii::app()->request->getParam('driver2_hasTAVCs')=='0') ? 'No' : 'Yes';
		$vehicle_comprehensiveDeductible=Yii::app()->request->getParam('vehicle_deductibles','4');
		$vehicle_collisionDeductible = Yii::app()->request->getParam('vehicle_collision_deductibles','4');
		$medicalPayment = Yii::app()->request->getParam('medical_pay','5');
		$haveInsurance = Yii::app()->request->getParam('insurance_policy','0');
		$insuranceCompany = Yii::app()->request->getParam('insurance_company','1');
		$continuously_insured_period=Yii::app()->request->getParam('continuously_insured_period','1');
		$current_policy_start_date=date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date')));
		$current_policy_expiration_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date')));
		$driver1_gender=(Yii::app()->request->getParam('driver1_gender')=='M') ? 'Male' : 'Female';
		$driver1_dob=date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_dob')));
		$driver1_requiredSR22 = Yii::app()->request->getParam('driver1_required_SR22','0');
		$driver2_gender = (Yii::app()->request->getParam('driver2_gender')=='M') ? '1' : '2';
		$driver2_dob = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob')));
		$driver2_maritalStatus = Yii::app()->request->getParam('driver2_marital_status','1');
		$driver2_maritalStatus = $driver2_maritalStatus == 1 ? 'Single' : 'Married';
		$driver2_education = Yii::app()->request->getParam('driver2_education','1');
		$driver2_education -= $driver2_education;
		$driver2_occupation = Yii::app()->request->getParam('driver2_occupation','1');
		$driver2_requiredSR22 = Yii::app()->request->getParam('driver2_required_SR22','0');
		$submission_model = new Submissions();
		$city_state = $submission_model->getCityStateFromZip($zip);
        $converage_type = Yii::app()->request->getParam('coverage_type','1');
        $parking = ['Driveway','Private Garage','Parking Garage','Parking Lot','Street'];
        $park_key = array_rand($parking);
        $Collision_Coverage = ['No Coverage','No Deductible'];
        $CC_key = array_rand($Collision_Coverage);
        $Comprehensive_Coverage = ['No Coverage','No Deductible'];
        $CCC_key = array_rand($Comprehensive_Coverage);
        $age = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('driver1_dob'))));
        $age2 = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('driver2_dob'))));
		$pastdate = Yii::app()->request->getParam('insurance_expiration_date');
		$insurance_expiration_date_gap = round((time() - strtotime($pastdate))/86400);
		$is_policy_expired = $insurance_expiration_date_gap >30 ? 'Yes' : 'No';
		$policy_start_date = date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_start_date',(time()-(rand(360,370)*86400)))));
        $policy_start_date = date('Y-m-d',strtotime(Yii::app()->request->getParam('insurance_start_date',(time()-(rand(360,370)*86400)))));
		$company_years = round((time() - strtotime($policy_start_date))/(86400*365));

		$driver1_at_fault = Yii::app()->request->getParam('driver1_accident1_at_fault');
		$is_driver1_at_fault = $driver1_at_fault == 1 ? 'Yes' : 'No';
		$driver2_at_fault = Yii::app()->request->getParam('driver1_accident2_at_fault');
		$is_driver2_at_fault = $driver2_at_fault == 1 ? 'Yes' : 'No';
		$vehicle1_vehicle_ownership = Yii::app()->request->getParam('vehicle1_vehicle_ownership');
		$vehicle2_vehicle_ownership = Yii::app()->request->getParam('vehicle2_vehicle_ownership');
    	$vehicle1_vehicle_ownership = $vehicle1_vehicle_ownership == 1 ? 'Owned' : 'Financed';
		$vehicle2_vehicle_ownership = $vehicle2_vehicle_ownership == 1 ? 'Owned' : 'Financed';
		$partner_email = 'sushil@astroriacompany.com';
		$partner_company = 'AstroriaCompany';

		$driver1_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident1_date')),'');
		$driver1_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident2_date')),'');
		$driver2_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident1_date')),'');
		$driver2_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident2_date')),'');
		$driver1_first_name = Yii::app()->request->getParam('driver1_first_name');
		$driver1_last_name = Yii::app()->request->getParam('driver1_last_name');
		$phone = Yii::app()->request->getParam('phone');
		$address = Yii::app()->request->getParam('address');
		$email = Yii::app()->request->getParam('email');
		$dob_year = date('Y',strtotime(Yii::app()->request->getParam('driver1_dob')));
		$dob_month = date('m',strtotime(Yii::app()->request->getParam('driver1_dob')));
		$dob_day = date('d',strtotime(Yii::app()->request->getParam('driver1_dob')));
		$gender = Yii::app()->request->getParam('driver1_gender')=='M'?'Male':'Female';
		$vehicle1_year = Yii::app()->request->getParam('vehicle1_year');
		$vehicle1_make = Yii::app()->request->getParam('vehicle1_make');
		$vehicle1_model = Yii::app()->request->getParam('vehicle1_model');
		$vehicle1_submodel = Yii::app()->request->getParam('vehicle1_submodel','3.2 Sedan');
		$vehicle1_vin = Yii::app()->request->getParam('vehicle1_vin');
		$vehicle1_primary_use = Yii::app()->request->getParam('vehicle1_primary_use');
		$vehicle1_vehicle_ownership = Yii::app()->request->getParam('vehicle1_vehicle_ownership');
		$vehicle1_daily_mileage = Yii::app()->request->getParam('vehicle1_daily_mileage');
		$vehicle1_annual_mileage = Yii::app()->request->getParam('vehicle1_annual_mileage');
		$landing_page = Yii::app()->request->getParam('url','https://eliteinsurers.com');
		$tcpa_text = Yii::app()->request->getParam('tcpa_text');
		$universal_leadid = Yii::app()->request->getParam('universal_leadid');
		$user_agent = Yii::app()->request->getParam('user_agent');
        $user_agent_list = self::$userAgentList;
        $user_agent = $user_agent_list[array_rand($user_agent_list)];

		$trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
		$ipaddress = Yii::app()->request->getParam('ipaddress');
		$residence_type = (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own';
		$driver1_requiredSR22 = Yii::app()->request->getParam('driver1_required_SR22')=='1'?'SR-22':'None';
        $driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver1_occupation'));
        $insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$security_system ='N/A';
		$vehicle2_year = Yii::app()->request->getParam('vehicle2_year');
		$additional_driver=Yii::app()->request->getParam('driver2_hasTAVCs')=='0'?'No':'Yes';
		$additional_vehicle=isset($vehicle2_year) ? 'Yes' : 'No';
        $ad_id ='123';
        $click_id =Yii::app()->session['affiliate_trans_id'];
		$ping_request ='<lead>
				   <AFID>'.$p1.'</AFID>
				   <SID>'.$promo_code.'</SID>
				   <AffiliateReferenceID></AffiliateReferenceID>
				   <Last4Numbers>'.substr($phone,-4).'</Last4Numbers>
				   <_Phone>'.$phone.'</_Phone>
				   <_City>'.$city_state['city'].'</_City>
				   <_State>'.$city_state['state'].'</_State>
				   <_PostalCode>'.$zip.'</_PostalCode>
				   <Email>'.$email.'</Email>
				   <DOBM>'.$dob_month.'</DOBM>
				   <DOBD>'.$dob_day.'</DOBD>
				   <DOBY>'.$dob_year.'</DOBY>
				   <Gender>'.$gender.'</Gender>
				   <VehicleYear>'.$vehicle1_year.'</VehicleYear>
				   <VehicleMake>'.$vehicle1_make.'</VehicleMake>
				   <VehicleModel>'.$vehicle1_model.'</VehicleModel>
				   <VehicleSubModel>'.$vehicle1_submodel.'</VehicleSubModel>
				   <VehicleMiles>'.$vehicle1_annual_mileage.'</VehicleMiles>
				   <LandingPageURL>'.$landing_page.'</LandingPageURL>
				   <TCPAConsentText>'.$tcpa_text.'</TCPAConsentText>
				   <xxTrustedFormCertUrl>'.$trustedformcerturl.'</xxTrustedFormCertUrl>
				   <Universal_Lead_ID>'.$universal_leadid.'</Universal_Lead_ID>
				   <UA>'.$user_agent.'</UA>
				   <IP>'.$ipaddress.'</IP>
				   <InsuranceCompany>'.$insuranceCompany.'</InsuranceCompany>
				   <CompanyYears>'.$company_years.'</CompanyYears>
				   <Insured>'.$is_policy_expired.'</Insured>
				   <CurrentResidence>'.$residence_type.'</CurrentResidence>
				   <DriverLicenseStatus>Active</DriverLicenseStatus>
				   <CreditRating>'.self::$creditRating[Yii::app()->request->getParam('credit_rating','2')].'</CreditRating>
				   <MaritalStatus>'.self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status','2')].'</MaritalStatus>
				   <Reposessions>No</Reposessions>
				   <DUI>No</DUI>
				   <Bankruptcy>No</Bankruptcy>
				   <Filing>'.$driver1_requiredSR22.'</Filing>
				   <SecuritySystem>N/A</SecuritySystem>
				   <AdditionalDrivers>'.$additional_driver.'</AdditionalDrivers>
				   <AdditionalVehicles>'.$additional_vehicle.'</AdditionalVehicles>
				   <Occupation>'.$driver1_occupation.'</Occupation>
				   <s2>'.$SubID.'</s2>
				</lead>';
		
        $header = ["Content-Type: application/xml"];
		$pingData['ping_request'] = $ping_request;
        $pingData['header'] = $header;
        return $pingData;
    }

    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<Accepted>(.*)<\/Accepted>/msui", $ping_response, $result);
        if (trim($result[1]) == 'true' || trim($result[0]) == '1') {
            preg_match("/<Payout>(.*)<\/Payout>/msui", $ping_response, $price);
            preg_match("/<PingId>(.*)<\/PingId>/msui", $ping_response, $confirmation_id);
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
    public static function sendPostData($parameter1, $parameter2, $parameter3, $ping_response, $post_url, $status) {
        $p1 = $p1 ? $p1 : '513257';
    	preg_match("/<PingId>(.*)<\/PingId>/msui", $ping_response, $confirmation_id);
    	$IPAddress = Yii::app()->request->getParam('ipaddress');
        $user_agent_list = self::$userAgentList;
        $user_agent = $user_agent_list[array_rand($user_agent_list)];
        $user_agent = Yii::app()->request->getParam('user_agent',$user_agent);
        $LeadDateTime = date('Y-m-d H:i:s');
        $Unique_identifier = Yii::app()->session['affiliate_trans_id'];
        $TCPAOptin = Yii::app()->request->getParam('tcpa_optin','Yes')==1?'Yes':'No';
        $TCPAText = Yii::app()->request->getParam('tcpa_text','By submitting this form');
        $UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
        $SubID = Yii::app()->request->getParam('sub_id');
        $url = Yii::app()->request->getParam('url','https://eliteinsurers.com');
        $promo_code = Yii::app()->request->getParam('promo_code');
        $zip = Yii::app()->request->getParam('zip');
        $residence_type = (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own';
        $years_at_residence = Yii::app()->request->getParam('stay_in_year','4');
        $months_at_residence = Yii::app()->request->getParam('stay_in_month','3');
        $credit_rating = Yii::app()->request->getParam('credit_rating','3');
        $bankruptcy = Yii::app()->request->getParam('bankruptcy','0');
        $coverageType = Yii::app()->request->getParam('coverage_type','3');
        $driver1_hasTAVCs=(Yii::app()->request->getParam('driver1_hasTAVCs')=='0') ? 'No' : 'Yes';
        $driver2_hasTAVCs=(Yii::app()->request->getParam('driver2_hasTAVCs')=='0') ? 'No' : 'Yes';
        $vehicle_comprehensiveDeductible=Yii::app()->request->getParam('vehicle_deductibles','4');
        $vehicle_collisionDeductible = Yii::app()->request->getParam('vehicle_collision_deductibles','4');
        $medicalPayment = Yii::app()->request->getParam('medical_pay','5');
        $haveInsurance = Yii::app()->request->getParam('insurance_policy','0');
        $insuranceCompany = Yii::app()->request->getParam('insurance_company','1');
        $continuously_insured_period=Yii::app()->request->getParam('continuously_insured_period','1');
        $current_policy_start_date=date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date')));
        $current_policy_expiration_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date')));
        $driver1_gender=(Yii::app()->request->getParam('driver1_gender')=='M') ? 'Male' : 'Female';
        $driver1_dob=date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_dob')));
        $driver1_requiredSR22 = Yii::app()->request->getParam('driver1_required_SR22','0');
        $driver2_gender = (Yii::app()->request->getParam('driver2_gender')=='M') ? '1' : '2';
        $driver2_dob = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob')));
        $driver2_maritalStatus = Yii::app()->request->getParam('driver2_marital_status','1');
        $driver2_maritalStatus = $driver2_maritalStatus == 1 ? 'Single' : 'Married';
        $driver2_education = Yii::app()->request->getParam('driver2_education','1');
        $driver2_education -= $driver2_education;
        $driver2_occupation = Yii::app()->request->getParam('driver2_occupation','1');
        $driver2_requiredSR22 = Yii::app()->request->getParam('driver2_required_SR22','0');
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip);
        $converage_type = Yii::app()->request->getParam('coverage_type','1');
        $parking = ['Driveway','Private Garage','Parking Garage','Parking Lot','Street'];
        $park_key = array_rand($parking);
        $Collision_Coverage = ['No Coverage','No Deductible'];
        $CC_key = array_rand($Collision_Coverage);
        $Comprehensive_Coverage = ['No Coverage','No Deductible'];
        $CCC_key = array_rand($Comprehensive_Coverage);
        $age = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('driver1_dob'))));
        $age2 = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('driver2_dob'))));
        $pastdate = Yii::app()->request->getParam('insurance_expiration_date');
        $insurance_expiration_date_gap = round((time() - strtotime($pastdate))/86400);
        $is_policy_expired = $insurance_expiration_date_gap >30 ? 'Yes' : 'No';
        $policy_start_date = date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_start_date',(time()-(rand(360,370)*86400)))));
        $policy_start_date = date('Y-m-d',strtotime(Yii::app()->request->getParam('insurance_start_date',(time()-(rand(360,370)*86400)))));
        $company_years = round((time() - strtotime($policy_start_date))/(86400*365));
        $driver1_at_fault = Yii::app()->request->getParam('driver1_accident1_at_fault');
        $is_driver1_at_fault = $driver1_at_fault == 1 ? 'Yes' : 'No';
        $driver2_at_fault = Yii::app()->request->getParam('driver1_accident2_at_fault');
        $is_driver2_at_fault = $driver2_at_fault == 1 ? 'Yes' : 'No';
        $vehicle1_vehicle_ownership = Yii::app()->request->getParam('vehicle1_vehicle_ownership');
        $vehicle2_vehicle_ownership = Yii::app()->request->getParam('vehicle2_vehicle_ownership');
        $vehicle1_vehicle_ownership = $vehicle1_vehicle_ownership == 1 ? 'Owned' : 'Financed';
        $vehicle2_vehicle_ownership = $vehicle2_vehicle_ownership == 1 ? 'Owned' : 'Financed';
        $partner_email = 'sushil@astroriacompany.com';
        $partner_company = 'AstroriaCompany';
        $driver1_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident1_date')),'');
        $driver1_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident2_date')),'');
        $driver2_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident1_date')),'');
        $driver2_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident2_date')),'');
        $driver1_first_name = Yii::app()->request->getParam('driver1_first_name');
        $driver1_last_name = Yii::app()->request->getParam('driver1_last_name');
        $phone = Yii::app()->request->getParam('phone');
        $address = Yii::app()->request->getParam('address');
        $email = Yii::app()->request->getParam('email');
        $dob_year = date('Y',strtotime(Yii::app()->request->getParam('driver1_dob')));
        $dob_month = date('m',strtotime(Yii::app()->request->getParam('driver1_dob')));
        $dob_day = date('d',strtotime(Yii::app()->request->getParam('driver1_dob')));
        $gender = Yii::app()->request->getParam('driver1_gender')=='M'?'Male':'Female';
        $vehicle1_year = Yii::app()->request->getParam('vehicle1_year');
        $vehicle1_make = Yii::app()->request->getParam('vehicle1_make');
        $vehicle1_model = Yii::app()->request->getParam('vehicle1_model');
        $vehicle1_submodel = Yii::app()->request->getParam('vehicle1_submodel','3.2 Sedan');
        $vehicle1_vin = Yii::app()->request->getParam('vehicle1_vin');
        $vehicle1_primary_use = Yii::app()->request->getParam('vehicle1_primary_use');
        $vehicle1_vehicle_ownership = Yii::app()->request->getParam('vehicle1_vehicle_ownership');
        $vehicle1_daily_mileage = Yii::app()->request->getParam('vehicle1_daily_mileage');
        $vehicle1_annual_mileage = Yii::app()->request->getParam('vehicle1_annual_mileage');
        $landing_page = Yii::app()->request->getParam('url','https://eliteinsurers.com');
        $tcpa_text = Yii::app()->request->getParam('tcpa_text');
        $universal_leadid = Yii::app()->request->getParam('universal_leadid');
        $user_agent = Yii::app()->request->getParam('user_agent');
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        $ipaddress = Yii::app()->request->getParam('ipaddress');
        $residence_type = (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own';
        $driver1_requiredSR22 = Yii::app()->request->getParam('driver1_required_SR22')=='1'?'SR-22':'None';
        $driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver1_occupation'));
        $insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
        $security_system ='N/A';
        $vehicle2_year = Yii::app()->request->getParam('vehicle2_year');
        $additional_driver=Yii::app()->request->getParam('driver2_hasTAVCs')=='0' ? 'No' : 'Yes';
        $additional_vehicle=isset($vehicle2_year) ? 'Yes' : 'No';
        $ad_id ='123';
        $click_id =Yii::app()->session['affiliate_trans_id'];
		$post_request ='<lead>
                   <PingId>'.$confirmation_id[1].'</PingId>
                   <AFID>'.$p1.'</AFID>
                   <SID>'.$promo_code.'</SID>
                   <AffiliateReferenceID></AffiliateReferenceID>
                   <_FirstName>'.$driver1_first_name.'</_FirstName>
                   <_LastName>'.$driver1_last_name.'</_LastName>
                   <Last4Numbers>'.substr($phone,-4).'</Last4Numbers>
                   <_Phone>'.$phone.'</_Phone>
                   <_Address>'.$address.'</_Address>
                   <_City>'.$city_state['city'].'</_City>
                   <_State>'.$city_state['state'].'</_State>
                   <_PostalCode>'.$zip.'</_PostalCode>
                   <Email>'.$email.'</Email>
                   <DOBM>'.$dob_month.'</DOBM>
                   <DOBD>'.$dob_day.'</DOBD>
                   <DOBY>'.$dob_year.'</DOBY>
                   <Gender>'.$gender.'</Gender>
                   <VehicleYear>'.$vehicle1_year.'</VehicleYear>
                   <VehicleMake>'.$vehicle1_make.'</VehicleMake>
                   <VehicleModel>'.$vehicle1_model.'</VehicleModel>
                   <VehicleSubModel>'.$vehicle1_submodel.'</VehicleSubModel>
                   <VehicleMiles>'.$vehicle1_annual_mileage.'</VehicleMiles>
                   <LandingPageURL>'.$landing_page.'</LandingPageURL>
                   <TCPAConsentText>'.$tcpa_text.'</TCPAConsentText>
                   <xxTrustedFormCertUrl>'.$trustedformcerturl.'</xxTrustedFormCertUrl>
                   <Universal_Lead_ID>'.$universal_leadid.'</Universal_Lead_ID>
                   <UA>'.$user_agent.'</UA>
                   <IP>'.$ipaddress.'</IP>
                   <InsuranceCompany>'.$insuranceCompany.'</InsuranceCompany>
                   <CompanyYears>'.$company_years.'</CompanyYears>
                   <Insured>'.$is_policy_expired.'</Insured>
                   <CurrentResidence>'.$residence_type.'</CurrentResidence>
                   <DriverLicenseStatus>Active</DriverLicenseStatus>
                   <CreditRating>'.self::$creditRating[Yii::app()->request->getParam('credit_rating','2')].'</CreditRating>
                   <MaritalStatus>'.self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status','2')].'</MaritalStatus>
                   <Reposessions>No</Reposessions>
                   <DUI>No</DUI>
                   <Bankruptcy>No</Bankruptcy>
                   <Filing>'.$driver1_requiredSR22.'</Filing>
                   <SecuritySystem>N/A</SecuritySystem>
                   <AdditionalDrivers>'.$additional_driver.'</AdditionalDrivers>
                   <AdditionalVehicles>'.$additional_vehicle.'</AdditionalVehicles>
                   <Occupation>'.$driver1_occupation.'</Occupation>
                   <s2>'.$SubID.'</s2>
                </lead>';

        $cm = new CommonMethods();
        $header = ["Content-Type: application/xml"];
        $start_time = CommonToolsMethods::stopwatch();
        
        $post_url = $post_url.'?PingId='.$confirmation_id[1];

        $post_response = $cm->curl($post_url, $post_request, $header);
        $time_end = CommonToolsMethods::stopwatch();
		//echo '<pre>';print_r($ping_response);die();
        preg_match("/<status>(.*)<\/status>/", $post_response, $success);
        if (trim($success[1]) == 'Accepted') {
            $post_status = '1';
            preg_match("/<successUrl>(.*)<\/successUrl>/", $post_response, $redirect);
            $redirect_url = isset($redirect[1]) ? $redirect[1] : '';
            preg_match("/<commission>(.*)<\/commission>/msui", $post_response, $price);
            preg_match("/<Payout>(.*)<\/Payout>/msui", $ping_response, $ping_price);
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
