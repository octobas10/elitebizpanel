<?php
class PXController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static $medicalConditionFromBuyer = ['HighCholesterol','PulmonaryDisease','VascularDisease','AIDSHIV','KidneyDisease','Asthma','Cancer','Depression','Diabetes','HeartDisease','LiverDisease','HighBloodPressure','MentalIllness','Stroke','Alzheimer','AlcoholAbuse'];
    public static $companyListFromBuyer = ['Currently not insured','21st Century','AAA','AARP','AIG','Access Insurance','AETNA','AFLAC','AIU','Alfa Insurance','All Risk','Allianz','Allied','Allstate','American Alliance Insurance','American Family','American Home Assurance','American Insurance','American International Insurance','American International Pacific','American Internacional south','AMS User Group','American International South','American Direct Business Insurance','American Deposit Insurance','American Casualty','American Manufacturers','American Empire Insurance','American Financial','American Health Underwriters','American Mayflower Insurance','American Motorists Insurance','American National','American Premier Insurance','American Protection Insurance','American Automobile Insurance','American Reliable','American Republic','American Savers Plan','American Service Insurance','American Skyline Insurance Company','American Spirit Insurance','American Standard Insurance','AmeriPlan','Ameriprise','Amica','Answer Financial','Anthem','Arbella','Armed Forces Insurance','Associated Indemnity','Assurant','Atlanta Casualty','Atlantic Indemnity','Atlantis','Auto Club Insurance Company','AXA Advisors','Auto Owners','Bankers Life and Casualty','Banner Life','Best Agency USA','Blue Cross / Blue Shield','Brooke Insurance','Commonwealth','Company not listed','Cal Farm Insurance','California State Automobile Association','Chubb','Cigna','Citizens','Clarendon','Clarendon National Insurance','CNA','Colonial Insurance','Comparison Market','Continental Insurance','Cotton States','Country Insurance and Financial Services','County Insurance and Financial Services','Countrywide','Countywide','CSE Insurance Group','Dairyland Insurance','eFinancial','eHealth Insurance Sercies','eHealthInsurance Services','Electric Insurance','Elephant','Equitable Life & Casualty Insurance','Erie Insurance','Esurance','Farm Bureau/Farm Family/Rural','Farmers','FinanceBox.com','Fire and Casualty Insurance Co of CT','Farmers Union','Fidelity Insurance Company','Fidelity National','Foremost','Foresters','Geico','AMSUserGroup','Garden State Life Insurance Company','GMAC','Golden Rule Insurance','Government Employees Insurance','Government Empoyees Insurance','Grange','Great American','Great West','Guaranty National Insurance','Guide One Insurance','Hanover Lloyds Insurance Company','The Hartford','Guardian','Guideone','Hartford AARP','Health Benefits Direct','Health Care Solutions','Health Choice One','Health Net','Health Plus of America','HealthMarkets','HealthShare American','Horace Mann','Horace Mann Insurance','Humana','IFA Auto Insurance','IGF Insurance','IDS','IHIAA','Infinity Insurance','Insurance Insight','Infinity National Insurance','Infinity Select Insurance','Insphere Insurance Solutions','Insurance Shopper, Inc','Insurance.com','Integon','Iroquois Group','John Hancock','Kaiser Permanente','Kemper Lloyds Insurance','Landmark American Insurance','Leader Insurance','Leader Preferred Insurance','Leader Specialty Insurance','Liberty Insurance Corp','Liberty Mutual','Liberty National','Liberty Northwest','Liberty Nothwest','Lincoln Benefit Life','Lumbermens Mutual','Maryland Casualty','Mass Mutual','Matrix Direct','Mercury','MetLife Auto and Home','Metropolitan Insurance Co.','Mid Century Insurance','Continent Casualty','Middlesex Insurance','Midland National Life','Mutual Insurance','National Insurance','Miller Mutual','Modern Woodmen of America','Mutual of New York','Mutual Of Omaha','National Ben Franklin Insurance','National Casualty','Continental Casualty','Continental Divide Insurance','National Continental Insurance','National Fire Insurance','National Health Insurance','National Indemnity','National Union Fire Insurance','Nationwide','New England Financial','New York Life Insurance','Northwestern Mutual Life','Nortwestern Mutual Life','Norhwestern Pacific Indemnity','Northwestern Pacific Indemnity','Omni Insurance','Orion Insurance','Pacific Insurance','Pafco General Insurance','Patriot General Insurance','Peak Property and Casualty Insurance','PEMCO Insurance','Physicians','Penn Mutual','Pennsylvania life','Premier','Primerica','Principal Financial','Progressive','Protective Life','Prudential Insurance Co.','RBC Liberty','Reliance Insurance','Republic Indemnity','Response Insurance','SAFECO','Safeway Insurance','Security Insurance','Senior Market Sales','Sentinel Insurance','Sentry','Shelter','St. Paul Insurance','Standard File Insurance Company','Standard Fire Insurance Company','State and County Mutual Fire Insurance','State Farm','State National','Superior American Insurance','Superior Guaranty Insurance','Superior Insurance','Sure Health Plans','The Ahbe Group','The General','TICO Insurance','TICO Insurance1','TIG Countrywide Insurance','Titan','TransAmerica','Travelers','State Consumer Insurance','Twin City Fire Insurance','UniCare','United Insurance','United American/Farm and Ranch','United Life Group','United Pacific Insurance','United Security','United Services Automobile Association','Unitrin Direct','Universal Underwriters Insurance','US Financial','US Health Group','USA Benefits','USA Benefits','USAA','USF and G','Viking Insurance','Western and Southern Life','Western Mutual','William Penn','Windsor Insurance','Woodlands Financial Group','Zurich North America'];

    public static $occupationListFromBuyer = ['Employeed','Government','Homemaker','Retired','Unemployed','Military','Retail','Sales','Marketing','IT','Medical','Unknown','BusinessOwner','Student','SalesInside','SalesOutside','Scientist','OtherTechnical','MilitaryEnlisted','Architect','Other'];
    
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$height_cm = Yii::app()->request->getParam('height');
		$total_inches = $height_cm/2.54;
		$height_feet = intval($total_inches/12);
		$height_inches = $total_inches%12;
		$submission_model = new Submissions();
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$medi_cond = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
		$pingData = [];
		$maritial_status = Yii::app()->request->getParam('marital_status');
		switch ($maritial_status) {
			case '1':
				$MaritalStatus = 'Single';
				break;
			case '2':
				$MaritalStatus = 'Married';
				break;
			case '3':
				$MaritalStatus = 'Separated';
				break;
			case '4':
				$MaritalStatus = 'Divorced';
				break;
			case '5':
				$MaritalStatus = 'Married';
				break;
			case '6':
				$MaritalStatus = 'Widowed';
				break;
			default:
				$MaritalStatus = 'Married';
				break;
		}
		$Education_Level = Yii::app()->request->getParam('education_level');
		switch ($Education_Level) {
			case '1':
				$Education = 'Other';
				break;
			case '2':
				$Education = 'Some College';
				break;
			case '3':
				$Education = 'High school diploma';
				break;
			case '4':
				$Education = 'Some College';
				break;
			case '5':
				$Education = 'Associate Degree';
				break;
			case '6':
				$Education = 'Bachelors Degree';
				break;
			case '7':
				$Education = 'Bachelors Degree';
				break;
			case '8':
				$Education = 'Doctorate Degree';
				break;
			case '9':
				$Education = 'Other';
				break;
			default:
				$Education = 'None';
				break;
		}
		$submission_model = new Submissions();
		$occupation_id  = Yii::app()->request->getParam('occupation', '1');
		$occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0]);
		$Occupation = $occupation == '' ? 'Employeed' : $occupation;
		$height_cm = Yii::app()->request->getParam('height');
		$inches = $height_cm/2.54;
		$Height_FT = intval($inches/12);
		$Height_Inch = round($inches%12);
		$requested_coverage_type = Yii::app()->request->getParam('requested_coverage_type');
		$Pregnant = Yii::app()->request->getParam('expectant_parent')==1?'Yes':'No';
		$Smoker = Yii::app()->request->getParam('is_smoker')==1?'Yes':'No';
		$ExpirationDate = date('Y-m-d',strtotime(Yii::app()->request->getParam('insurance_expiration_date')));
		$InsuredSince = date('Y-m-d',strtotime(Yii::app()->request->getParam('insurance_start_date')));
		switch ($requested_coverage_type) {
			case '1':
				$RequestedCoverageType = 'Short Term';
				break;
			case '2':
				$RequestedCoverageType = 'Individual Family';
				break;
			case '3':
				$RequestedCoverageType = 'Medicare Supplement';
				break;
			default:
				$RequestedCoverageType = 'COBRA';
				break;
		}
		$current_coverage_type = Yii::app()->request->getParam('current_coverage_type',0);
		switch ($current_coverage_type) {
			case '1':
				$CurrentCoverageType = 'Short Term';
				break;
			case '2':
				$CurrentCoverageType = 'Individual Family';
				break;
			case '3':
				$CurrentCoverageType = 'Medicare Supplement';
				break;
			default:
				$CurrentCoverageType = 'COBRA';
				break;
		}
		$income = Yii::app()->request->getParam('income',0);
		switch ($income) {
			case ($income >= 0 && $income <=29999):
				$HouseHoldIncome = 'Below $30,000';
				break;
			case ($income >= 30000 && $income <=44999):
				$HouseHoldIncome = '$30,000 - $44,999';
				break;
			case ($income >= 45000 && $income <=59999):
				$HouseHoldIncome = '$45,000 - $59,999';
				break;
			case ($income >= 60000 && $income <=74999):
				$HouseHoldIncome = '$60,000 - $74,999';
				break;
			case ($income >= 75000):
				$HouseHoldIncome = 'Above $75,000';
				break;
			default:
				$HouseHoldIncome = 'Below $30,000';
				break;
		}
		$age = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob'))));
		
		if($age < '65'){
			$ApiToken = '3F44A014-33AD-439D-A6F6-E2802A7FC59E';  //Health U65
		}else{
			$ApiToken = '0A4BA869-BA55-4100-9D32-136357869074';  //Medicare
		}
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$BirthDate = date('Y-m-d',strtotime(Yii::app()->request->getParam('dob')));
		$Gender = Yii::app()->request->getParam('gender')=='M'?'Male':'Female';
		$Weight= Yii::app()->request->getParam('weight');
		$Student= Yii::app()->request->getParam('is_student')==1?'true':'false';
		$HouseHoldSize = Yii::app()->request->getParam('number_in_household');
		$OriginalUrl = Yii::app()->request->getParam('url','https://elitehealthinsurers.com');
		$OriginalUrl = 'https://elitehealthinsurers.com';
		$tcpa_text = str_replace('&','',Yii::app()->request->getParam('tcpa_text'));
        $TcpaText = htmlspecialchars($tcpa_text);
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl',$OriginalUrl);
		$fields = [
			'ApiToken' => $ApiToken,
			'Vertical' => 'Health',
			'SubId' => Yii::app()->request->getParam('promo_code'),
	        'OriginalUrl' => $OriginalUrl,
	        'Source' => 'Social',
	        'JornayaLeadId' => Yii::app()->request->getParam('universal_leadid'),
	        'Trustedform' => $trustedformcerturl,
	        'SessionLength' => '30',
	        'TcpaText' => $TcpaText,
	        'VerifyAddress' => 'false',
	        'ContactData' => [
	        	'ZipCode' => $zip_code,
	        	'State' => $city_state['state'],
	        	'Address' => Yii::app()->request->getParam('address'),
	        	'IpAddress' => Yii::app()->request->getParam('ipaddress'),
	        ],
	        'Person' => [
	        	"BirthDate"=> $BirthDate,
				"Gender"=> $Gender,
				"MaritalStatus"=> $MaritalStatus,
				"RelationshipToApplicant"=> "Self",
				"DeniedInsurance"=> "No",
				"USResidence"=> "True",
				"Height_FT"=> (string) $Height_FT,
				"Height_Inch"=> (string) $Height_Inch,
				"Weight"=> $Weight,
				"Student"=> $Student,
				"Occupation"=> $Occupation,
				"Education"=> $Education,
				"HouseHoldIncome"=> $HouseHoldIncome,
				"HouseHoldSize"=> $HouseHoldSize,
				'Conditions' => [
		        	'HighCholesterol'=> $medi_cond=='HighCholesterol'?'Yes':'No',
					'PulmonaryDisease'=> $medi_cond=='PulmonaryDisease'?'Yes':'No',
					'VascularDisease'=> $medi_cond=='VascularDisease'?'Yes':'No',
					'AIDSHIV'=> $medi_cond=='AIDSHIV'?'Yes':'No',
					'KidneyDisease'=> $medi_cond=='KidneyDisease'?'Yes':'No',
					'Asthma'=> $medi_cond=='Asthma'?'Yes':'No',
					'Cancer'=> $medi_cond=='Cancer'?'Yes':'No',
					'Depression'=> $medi_cond=='Depression'?'Yes':'No',
					'Diabetes'=> $medi_cond=='Diabetes'?'Yes':'No',
					'HeartDisease'=> $medi_cond=='HeartDisease'?'Yes':'No',
					'LiverDisease'=> $medi_cond=='LiverDisease'?'Yes':'No',
					'HighBloodPressure'=> $medi_cond=='HighBloodPressure'?'Yes':'No',
					'MentalIllness'=> $medi_cond=='MentalIllness'?'Yes':'No',
					'Stroke'=> $medi_cond=='Stroke'?'Yes':'No',
					'Alzheimer'=> $medi_cond=='Alzheimer'?'Yes':'No',
					'AlcoholAbuse'=> $medi_cond=='AlcoholAbuse'?'Yes':'No',
		        ],
		        'MedicalHistory' => [
		        	'Hospitalized'=> 'No',
					'Pregnant'=>$Pregnant,
					'Smoker'=> $Smoker,
					'Alcoholabstain'=> 'No',
					'Comment'=> ''
		        ],
	        ],
	        'RequestedInsurancePolicy' => [
	        	'CoverageType'=> $RequestedCoverageType,
	        ],
	        'CurrentInsurancePolicy' => [
	        	'InsuranceCompany'=> $insuranceCompany,
				'ExpirationDate'=> $ExpirationDate,
				'InsuredSince'=> $InsuredSince,
	        ],
	        'Distribution' => [
	        	'OpenSlots'=> '5',
	        ]
		];
		$purchase = true;
		if($purchase == true && $age < '65'){
			$pingData['ping_request'] = json_encode($fields);
			$pingData['header'] = ["content-type: application/json","Accept: application/json"];
			return $pingData;
		}else{
			return [];
		}
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function extractPingResponse($response){
    	$response_array = json_decode($response,TRUE);
    	$pResponse = [];
    	if($response_array['Success'] == 1 || $response_array['Success'] == true){
			$max_payout = max(array_column($response_array['Legs'], 'Payout'));
			$parent_key = 0;
			foreach($response_array['Legs'] as $key => $value) {
			    if(in_array($max_payout, $value)){
			        $parent_key = $key;
			    }
			}
			$pResponse['success'] = '1';
	        $pResponse['confirmation_id'] = $response_array['TransactionId'];
	        $pResponse['price'] = $max_payout;
	        $pResponse['hash'] = $response_array['Legs'][$parent_key]['Hash'];
		}else{
			$pResponse['success'] = '0';
		}
		return $pResponse;

    }
    public static function returnPingResponse($ping_response) {
    	$response = self::extractPingResponse($ping_response);
        if(trim($response['success']) == '1'){
            $ping_response_info['ping_price'] = trim($response['price']);
            $ping_response_info['ping_status'] = '1';
            $ping_response_info['confirmation_id'] = $response['confirmation_id'];
        } else {
            $ping_response_info['ping_price'] = 0;
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
		$maritial_status = Yii::app()->request->getParam('marital_status');
		switch ($maritial_status) {
			case '1':
				$MaritalStatus = 'Single';
				break;
			case '2':
				$MaritalStatus = 'Married';
				break;
			case '3':
				$MaritalStatus = 'Separated';
				break;
			case '4':
				$MaritalStatus = 'Divorced';
				break;
			case '5':
				$MaritalStatus = 'Married';
				break;
			case '6':
				$MaritalStatus = 'Widowed';
				break;
			default:
				$MaritalStatus = 'Married';
				break;
		}
		$Education_Level = Yii::app()->request->getParam('education_level');
		switch ($Education_Level) {
			case '1':
				$Education = 'Other';
				break;
			case '2':
				$Education = 'Some College';
				break;
			case '3':
				$Education = 'High school diploma';
				break;
			case '4':
				$Education = 'Some College';
				break;
			case '5':
				$Education = 'Associate Degree';
				break;
			case '6':
				$Education = 'Bachelors Degree';
				break;
			case '7':
				$Education = 'Bachelors Degree';
				break;
			case '8':
				$Education = 'Doctorate Degree';
				break;
			case '9':
				$Education = 'Other';
				break;
			default:
				$Education = 'None';
				break;
		}
		$submission_model = new Submissions();
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$medi_cond = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
		$occupation_id  = Yii::app()->request->getParam('occupation', '1');
		$occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0]);
		$Occupation = $occupation == '' ? 'Employeed' : $occupation;
		$height_cm = Yii::app()->request->getParam('height');
		$inches = $height_cm/2.54;
		$Height_FT = intval($inches/12);
		$Height_Inch = round($inches%12);
		$requested_coverage_type = Yii::app()->request->getParam('requested_coverage_type');
		$Pregnant = Yii::app()->request->getParam('expectant_parent')==1?'Yes':'No';
		$Smoker = Yii::app()->request->getParam('is_smoker')==1?'Yes':'No';
		$ExpirationDate = date('Y-m-d',strtotime(Yii::app()->request->getParam('insurance_expiration_date')));
		$InsuredSince = date('Y-m-d',strtotime(Yii::app()->request->getParam('insurance_start_date')));
		switch ($requested_coverage_type) {
			case '1':
				$RequestedCoverageType = 'Short Term';
				break;
			case '2':
				$RequestedCoverageType = 'Individual Family';
				break;
			case '3':
				$RequestedCoverageType = 'Medicare Supplement';
				break;
			default:
				$RequestedCoverageType = 'COBRA';
				break;
		}
		$current_coverage_type = Yii::app()->request->getParam('current_coverage_type',0);
		switch ($current_coverage_type) {
			case '1':
				$CurrentCoverageType = 'Short Term';
				break;
			case '2':
				$CurrentCoverageType = 'Individual Family';
				break;
			case '3':
				$CurrentCoverageType = 'Medicare Supplement';
				break;
			default:
				$CurrentCoverageType = 'COBRA';
				break;
		}
		$income = Yii::app()->request->getParam('income',0);
		switch ($income) {
			case ($income >= 0 && $income <=29999):
				$HouseHoldIncome = 'Below $30,000';
				break;
			case ($income >= 30000 && $income <=44999):
				$HouseHoldIncome = '$30,000 - $44,999';
				break;
			case ($income >= 45000 && $income <=59999):
				$HouseHoldIncome = '$45,000 - $59,999';
				break;
			case ($income >= 60000 && $income <=74999):
				$HouseHoldIncome = '$60,000 - $74,999';
				break;
			case ($income >= 75000):
				$HouseHoldIncome = 'Above $75,000';
				break;
			default:
				$HouseHoldIncome = 'Below $30,000';
				break;
		}
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$BirthDate = date('Y-m-d',strtotime(Yii::app()->request->getParam('dob')));
		$Gender = Yii::app()->request->getParam('gender')=='M'?'Male':'Female';
		$Weight= Yii::app()->request->getParam('weight');
		$Student= Yii::app()->request->getParam('is_student')==1?'true':'false';
		$HouseHoldSize = Yii::app()->request->getParam('number_in_household');
		$age = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob'))));
		if($age < 65){
			$ApiToken = '3F44A014-33AD-439D-A6F6-E2802A7FC59E';  //Health U65
		}else{
			$ApiToken = '0A4BA869-BA55-4100-9D32-136357869074';  //Medicare
		}
		$ping_response_array = self::extractPingResponse($ping_response);
		
		$years_at_residance = (int) Yii::app()->request->getParam('stay_in_year');
		if($years_at_residance > 10){
			$years_at_resi_array = [15,20,25,30];
			$years_at_residance = $years_at_resi_array[array_rand($years_at_resi_array)];
		}
		$phone = Yii::app()->request->getParam('phone');
		$months_at_residance = (int) Yii::app()->request->getParam('stay_in_month');
		$months_at_residance = $months_at_residance >11? rand(1,11) : $months_at_residance;
		$OriginalUrl = Yii::app()->request->getParam('url','https://elitehealthinsurers.com');
		$OriginalUrl = 'https://elitehealthinsurers.com';
		$tcpa_text = str_replace('&','',Yii::app()->request->getParam('tcpa_text'));
        $TcpaText = htmlspecialchars($tcpa_text);
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl',$OriginalUrl);
		$fields = [
			'ApiToken' => $ApiToken,
			'Vertical' => 'Health',
			'SubId' => Yii::app()->request->getParam('promo_code'),
	        'OriginalUrl' => $OriginalUrl,
	        'Source' => 'Social',
	        'JornayaLeadId' => Yii::app()->request->getParam('universal_leadid'),
	        'Trustedform' => $trustedformcerturl,
	        'SessionLength' => '30',
	        'TcpaText' => $TcpaText,
	        'VerifyAddress' => 'false',
	        'TransactionId' => $ping_response_array['confirmation_id'],
	        'ContactData' => [
	        	'FirstName'=> Yii::app()->request->getParam('first_name'),
				'LastName'=> Yii::app()->request->getParam('last_name'),
				'City'=> $city_state['city'],
	        	'ZipCode' => $zip_code,
	        	'State' => $city_state['state'],
	        	'Address' => Yii::app()->request->getParam('address'),
	        	'IpAddress' => Yii::app()->request->getParam('ipaddress'),
	        	'EmailAddress'=> Yii::app()->request->getParam('email'),
				'PhoneNumber'=> $phone,
				//'DayPhoneNumber'=> Yii::app()->request->getParam('mobile',$phone),
				'ResidenceType'=> Yii::app()->request->getParam('is_rented')==1?'I am renting':'My own house',
				'YearsAtResidence'=> (string) $years_at_residance,
				'MonthsAtResidence'=> (string) $months_at_residance,
	        ],
	        'Person' => [
	        	"BirthDate"=> $BirthDate,
				"Gender"=> $Gender,
				"MaritalStatus"=> $MaritalStatus,
				"RelationshipToApplicant"=> "Self",
				"DeniedInsurance"=> "No",
				"USResidence"=> "True",
				"Height_FT"=> (string) $Height_FT,
				"Height_Inch"=> (string) $Height_Inch,
				"Weight"=> $Weight,
				"Student"=> $Student,
				"Occupation"=> $Occupation,
				"Education"=> $Education,
				"HouseHoldIncome"=> $HouseHoldIncome,
				"HouseHoldSize"=> $HouseHoldSize,
				'Conditions' => [
		        	'HighCholesterol'=> $medi_cond=='HighCholesterol'?'Yes':'No',
					'PulmonaryDisease'=> $medi_cond=='PulmonaryDisease'?'Yes':'No',
					'VascularDisease'=> $medi_cond=='VascularDisease'?'Yes':'No',
					'AIDSHIV'=> $medi_cond=='AIDSHIV'?'Yes':'No',
					'KidneyDisease'=> $medi_cond=='KidneyDisease'?'Yes':'No',
					'Asthma'=> $medi_cond=='Asthma'?'Yes':'No',
					'Cancer'=> $medi_cond=='Cancer'?'Yes':'No',
					'Depression'=> $medi_cond=='Depression'?'Yes':'No',
					'Diabetes'=> $medi_cond=='Diabetes'?'Yes':'No',
					'HeartDisease'=> $medi_cond=='HeartDisease'?'Yes':'No',
					'LiverDisease'=> $medi_cond=='LiverDisease'?'Yes':'No',
					'HighBloodPressure'=> $medi_cond=='HighBloodPressure'?'Yes':'No',
					'MentalIllness'=> $medi_cond=='MentalIllness'?'Yes':'No',
					'Stroke'=> $medi_cond=='Stroke'?'Yes':'No',
					'Alzheimer'=> $medi_cond=='Alzheimer'?'Yes':'No',
					'AlcoholAbuse'=> $medi_cond=='AlcoholAbuse'?'Yes':'No',
		        ],
		        'MedicalHistory' => [
		        	'Hospitalized'=> 'No',
					'Pregnant'=>$Pregnant,
					'Smoker'=> $Smoker,
					'Alcoholabstain'=> 'No',
					'Comment'=> ''
		        ],
	        ],
	        'RequestedInsurancePolicy' => [
	        	'CoverageType'=> $RequestedCoverageType,
	        ],
	        'CurrentInsurancePolicy' => [
	        	'InsuranceCompany'=> $insuranceCompany,
				'ExpirationDate'=> $ExpirationDate,
				'InsuredSince'=> $InsuredSince,
	        ],
	        'Distribution' => [
	        	'Include'=> [[
					"Name"=> "Leg12",
					"Hash"=> $ping_response_array['hash'],
				]],
	        ]
		];
		$post_request = json_encode($fields);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $header = ["content-type: application/json","Accept: application/json"];
        $post_response = $cm->curl($post_url, $post_request,$header);
		$time_end = CommonToolsMethods::stopwatch();
		$post_response_array = self::extractPingResponse($post_response);
		if(trim($post_response_array['success']) == '1'){
            $ping_price = trim($ping_response_array['price']);
            $post_price = trim($post_response_array['price']);
			$post_status = '1';
            $redirect_url = '';
            $post_price = $post_price ? $post_price : $ping_price;
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
		$post_responses['post_fail_reason'] = $post_fail_reason;
		//echo '<pre>';print_r($post_responses);die();
		return $post_responses;
    }
}