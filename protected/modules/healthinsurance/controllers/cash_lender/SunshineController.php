<?php
class SunshineController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static $medicalConditionFromBuyer = ['None','AIDS/HIV','Aneurysm','Alzheimers Disease','Asthma','Cancer','Depression','Diabetes','Drug and/or Alcohol Abuse','Emphysema','Pregnancy','High Blood Pressure','Heart Attack','Heart Disease','Kidney Disease','Liver Disease','Mental Illness','MS','Paralysis','Pulmonary Disease','Stroke','Vascular Disease','Other / Unlisted Condition'];
    public static $companyListFromBuyer = ["Other","21st Century Insurance","AAA Insurance Co.","AABCO","AARP","Access Insurance","Acordia","Aegis Security","Aetna","Affirmative","Aflac","AHCP","AIG","AIU Insurance","Alfa Insurance","All Nation","All Risk","Alleghany Corporation","Allianz","Allied Group","Allied","Allmerica","Allstate Insurance","American Alliance Ins Co","American Automobile Insurance","American Banks","American Casualty","American Deposit Insurance","American Direct Business Insurance","American Economy Ins Co","American Empire Insurance","American Family Insurance","American Financial","American Health Underwriters","American Home Assurance","American Income Life Insurance Company","American Insurance","American International Ins","American International Pacific","American International South","American Manufacturers","American Mayflower Insurance","American Medical Securities","American Motorists Insurance","American National Insurance","American National Property and Casualty","American Premier","American Protection Insurance","American Reliable Ins Co","American Republic","American Savers Plan","American Service Insurance","American Skyline Insurance Company","American Spirit Insurance","American Standard Insurance - OH","American Standard Insurance - WI","American States","Americas Ins. Consultants","AmeriPlan","Ameriprise","Amerisure","Ameritas Life Insurance Company","Amex Assurance Co","Amica Insurance","Amica Mutual Ins Co","Answer Financial","Anthem","API","Arbella","Arizona General","Armed Forces Insurance","Assigned Risk","Associated Indemnity","Associated Insurance Managers","Assurant","Atlanta Casualty","Atlanta Specialty","Atlantic Indemnity","Atlantic Mutual Co","Atlantis","Austin Mutual","Auto Club Insurance Company","Auto Owners","Avomark","AXA Equitable Life Insurance Company","Badger Mutual","Bankers Life and Casualty Company","Banner Life","Berkshire Hathaway","Best Agency USA","Blue Cross / Blue Shield","Bonneville","Boston Old Colony","Builders","Cal Farm Insurance","Calfarm Ins Co","California Casualty and Fire Ins Co","California State Automobile Association","Camden","Capital Choice","Cascade National Ins","Casualty Assurance","Centennial","Century National Ins","Charter Oak","Chartis","Chase Insurance Group","Chicago Insurance","Chubb Group of Ins Co","Church Mutual","Cigna","Cincinnati Insurance Company","Citizens","Clarendon National Insurance","Clarendon","Cloverleaf","CNA","Colonial Penn","Colonial","Combined","Commerce Insurance Group","Commerce West","Commercial Union","Commonwealth","Conseco","Continental Casualty","Continental Divide Insurance","Continental Insurance","Cotton States Insurance","Cottonwood","Country Financial","Countrywide Insurance","Criterion","CSE Insurance Group","CUNA Mutual","Dairyland Insurance","Dakota Fire","Deerbrook","Depositors Emcasc","Direct General Insurance","Dixie","Eagle Ins Co","Ebco General","eFinancial","eHealth","Electric Insurance","Elephant","EMC","Empire Fire and Marine","Employers Fire","Encompass Insurance Company","Ensure","Equitable Life","Erie Insurance Company","Esurance","Evergreen USA RRG","Explorer","Facility","Farm and Ranch","Farm Bureau/Farm Family/Rural","Farmers Insurance","Farmers Union","Farmland","Federal Ins Co","Federated Mutual Insurance Company","Fidelity Insurance Company","Financial Indemnity","Fire and Casualty Insurance Co of CT","Firemans Fund","First Acceptance Insurance","First American","First Financial","First General","First Insurance Company of Hawaii, LTD","First National","FM Global","Ford Motor Credit","Foremost","Foresters","Fortis","Franklin","GAINSCO","Geico Casualty","Geico","General Accident Insurance","General Re","Genworth Financial","Globe","GMAC Insurance","Grange","GRE Harleysville H","Great American Ins Co","Great Way","Great West Casualty Company","Grinnell Mutual","Guaranty National Insurance","Guardian Life Insurance Company of America","Guide One Insurance","Halcyon","Hanover Ins Co","Hanover Lloyds Insurance Company","Happy Days","Hartford Accident and Indemnity","Hawkeye Security","HCC Insurance Holdings","Health Benefits Direct","Health Choice One","Health Net","Health Plus of America","HealthMarkets","HealthShare American","Heritage","Home State County Mutual","Horace Mann","Humana","IAB","IFA Auto Insurance","IGF","IIS Insurance","Infinity Insurance","Infinity Select Insurance","Insphere Insurance Solutions","Insur. of Evanston","Insurance Co of the West","Insurance Insight","Integon","Interstate","Jackson National Life","John Deere","John Hancock Insurance","Kaiser Permanente","Kemper Insurance","Kentucky Central","Kentucky Farm Bureau","Knights of Columbus","Landmark American Insurance","Leader Insurance","Leader National","Leader Preferred Insurance","Leader Specialty Insurance","League General","Liberty Insurance Corp","Liberty Mutual Insurance","Liberty National","Liberty Northwest Insurance","Lincoln Benefit Life","Lincoln National Corporation","LTC Financial Partners","Lumbermens Mutual","Marathon","Markel Corporation","Maryland Casualty","MassMutual Financial Group","Matrix Direct","MEGA Life and Health","Mega/Midwest","Mendota","Merastar","Merchants Insurance Group","Mercury","MetLife Auto and Home","MetLife","Mid Century Insurance","Mid-Continent Casualty","Middlesex Insurance","Midland National Life","Midwest Mutual","Millbank","Millers Mutual","Milwaukee","Minnehoma","Missouri General","Modern Woodmen of America","Mortgage Protection Bureau","Motors","Mountain Laurel","Mutual Insurance","Mutual Of Enumclaw","Mutual of New York","Mutual of Omaha","National Alliance","National Ben Franklin Insurance","National Casualty","National Colonial","National Continental Insurance","National Fire Insurance Company of Hartford","National Health Insurance","National Indemnity","National Merit","National Surety Corp","National Union Fire Insurance","Nationwide General Insurance","Nationwide Mutual Insurance Company","Natl Farmers Union","New England Financial","New Jersey Manufacturers Insurance Company","New York Life Insurance Company","NJ Skylands Insurance","North American","North Pacific","North Pointe","North Shore","Northern Capital","Northern States","Northland","Northwestern Mutual Life","Northwestern Pacific Indemnity","Ohio Casualty","Ohio Security","Olympia","Omega","Omni Insurance","OneBeacon","Oregon Mutual","Orion Insurance","Other","Oxford Health Plans","Pacific Indemnity","Pacific Insurance","Pacific Life","Pacificare","Pafco","Paloverde","Patriot General Insurance","Peak Property and Casualty Insurance","PEMCO Insurance","Penn America","Penn Mutual","Pennsylvania Natl","Philadelphia Insurance Companies","Phoenix","Physicians","Pinnacle","Pioneer Life","Plymouth Rock Assurance","Preferred Mutual","Premier","Prestige","Primerica","Principal Financial","Progressive","Protective Life","Provident","Prudential Insurance Co.","QBE Insurance","Quality","Ramsey","RBC Liberty Insurance","Regal","Reliance Insurance Company","Reliant","Republic Indemnity","Response Insurance","RLI Corp.","Rockford Mutual","Rodney D. Young","Safe Auto Insurance Company","SAFECO","Safeguard","Safeway Insurance","Sea West Insurance","Security Insurance","Security National","Sedgwick James","Selective Insurance","Sentinel Insurance","Sentry Insurance Group","Shelter Insurance Co.","Skandia TIG Tita","Southern Aid and Insurance Company","Spectrum","St. Paul Fire and Marine Ins Co","St. Paul","Standard Fire Insurance Company","Standard Guaranty","Standard Insurance Company","State and County Mutual Fire Insurance","State Auto Ins Co","State Farm County","State Farm Insurance","State Mutual","State National Insurance","Sun Coast","Sun Life Financial","Superior American Insurance","Superior Guaranty Insurance","Superior Insurance","Superior","Sutter","Symetra","The Ahbe Group","The Credo Group","The General","The Hartford","The Regence Group","TIAA-CREF","TICO Insurance","TIG Countrywide Insurance","Titan","Total","Tower","TransAmerica","Travelers Insurance Company","Trinity Universal","Tri-State Consumer Insurance","Trupanion","Trust Hall","Twin City Fire Insurance","Unicare","Unigard Ins","Union","United American","United Financial","United Fire Group","United Security","United Services Automobile Association","Unitrin Direct","Universal Underwriters Insurance","Unum","US Financial","US Health Advisors","USA Benefits/Continental General","USAA","USF and G","Utah Home and Fire","Utica","Vasa North Atlantic","Vigilant","Viking","Wawanesa Mutual","Wellington","Wellpoint","West American","West Bend Mutual","West Coast Life","West Plains","Western and Southern Life","Western Mutual Insurance Group","Western National","Western Southern Life","White Mountains Insurance Group","William Penn","Windsor","Windstar","Wisconsin Mutual","Woodlands Financial Group","Workmens Auto Insurance","World Insurance","Worldwide","Yellow Key","Yosemite","Zurich North America"];

    public static $occupationListFromBuyer = ['Unknown','Accounts Pay/Rec.','Actor','Administration/Management','Appraiser','Architect','Artist','Assembler','Auditor','Baker','Bank Teller','Banker','Bartender','Broker','Cashier','Casino Worker','CEO','Certified Public Accountant','Chemist','Child Care','City Worker','Claims Adjuster','Clergy','Clerical/Technical','College Professor','Computer Tech','Construction','Contractor','Counselor','Craftsman/Skilled Worker','Custodian','Customer Support Rep','Dancer','Decorator','Delivery Driver','Dentist','Director','Disabled','Drivers','Electrician','Engineer-Aeronautical','Engineer-Aerospace','Engineer-Chemical','Engineer-Civil','Engineer-Electrical','Engineer-Gas','Engineer-Geophysical','Engineer-Mechanical','Engineer-Nuclear','Engineer-Other','Engineer-Petroleum','Engineer-Structural','Entertainer','Farmer','Fire Fighter','Flight Attend.','Food Service','Government','Health Care','Housewife/Househusband','Installer','Instructor','Journalist','Journeyman','Laborer/Unskilled Worker','LabTech.','Lawyer','Machine Operator','Machinist','Maintenance','Manufacturer','Marketing','Mechanic','Military E1 - E4','Military E5 - E7','Military Officer','Military Other','Model','Nanny','Nurse/CNA','Other','Painter','Para-Legal','Paramedic','Personal Trainer','Photographer','Physician','Pilot','Plumber','Police Officer','Postal Worker','Preacher','Pro Athlete','Production','Prof-College Degree','Prof-Specialty Degree','Programmer','Real Estate','Receptionist','Reservation Agent','Restaurant Manager','Retail','Retired','Roofer','Sales','Scientist','Secretary','Security','Self Employed','Social Worker','Stocker','Store Owner','Student Living w/Parents','Student Not Living w/Parents','Stylist','Supervisor','Teacher','Teacher - with Credentials','Technical/Supervisory','Travel Agent','Truck Driver','Unemployed','Vet','Waitress','Welder'];
    
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		if($promo_code != '38'){
			$height_cm = Yii::app()->request->getParam('height');
			$total_inches = ceil($height_cm/2.54);
			$height_feet = intval($total_inches/12);
			$height_feet = $height_feet < 5 ? 5 : $height_feet;
			$height_inches = round($total_inches%12);
			$submission_model = new Submissions();
			$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
			$medicalCondition = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
			$pingData = [];
			$maritial_status = Yii::app()->request->getParam('marital_status');
			switch ($maritial_status) {
				case '1':
					$mar_status = 'Single';
					break;
				case '2':
					$mar_status = 'Married';
					break;
				case '3':
					$mar_status = 'Separated';
					break;
				case '4':
					$mar_status = 'Divorced';
					break;
				case '5':
					$mar_status = 'Domestic Partner';
					break;
				case '6':
					$mar_status = 'Widowed';
					break;
				default:
					$mar_status = 'Married';
					break;
			}
			$Education_Level = Yii::app()->request->getParam('education_level');
			switch ($Education_Level) {
				case '1':
					$edu_level = 'Less than High School';
					break;
				case '2':
					$edu_level = 'Some or No High School';
					break;
				case '3':
					$edu_level = 'High School Diploma';
					break;
				case '4':
					$edu_level = 'Some College';
					break;
				case '5':
					$edu_level = 'Associate Degree';
					break;
				case '6':
					$edu_level = 'Bachelors Degree';
					break;
				case '7':
					$edu_level = 'Bachelors Degree';
					break;
				case '8':
					$edu_level = 'Doctorate Degree';
					break;
				case '9':
					$edu_level = 'Other';
					break;
				default:
					$edu_level = 'Other';
					break;
			}
			$submission_model = new Submissions();
			$occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0]);
			$inches = $height_cm/2.54;
			$height_feet = intval($inches/12);
			$height_inches = round($inches);
			$height_inches = ($height_inches < '1' OR $height_inches > '11') ? '9' : $height_inches;
			$requested_coverage_type = Yii::app()->request->getParam('requested_coverage_type');
			switch ($requested_coverage_type) {
				case '1':
					$req_coverage_type = 'Individual Plan';
					break;
				case '2':
					$req_coverage_type = 'Family Plan';
					break;
				case '3':
					$req_coverage_type = 'Medicare Supplement';
					break;
				default:
					$req_coverage_type = 'Individual Plan';
					break;
			}
			$current_coverage_type = Yii::app()->request->getParam('current_coverage_type',0);
			switch ($current_coverage_type) {
				case '1':
					$curr_coverage_type = 'Individual Plan';
					break;
				case '2':
					$curr_coverage_type = 'Family Plan';
					break;
				case '3':
					$curr_coverage_type = 'Medicare Supplement';
					break;
				default:
					$curr_coverage_type = 'Individual Plan';
					break;
			}
			$age = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob'))));
			if($age < '65'){
				$SRC = 'EMHealth';  //Health U65
			}else{
				$SRC = 'EMO65'; //Medicare
			}
			$KEY = $p2 ? $p2 : '35377425b4990cd0e42178bc38c858c9594d6d6af6fcb748213f5307d0b53da2';
			$TYPE = $p3 ? $p3 : '49';
			$income = Yii::app()->request->getParam('income');
			$income = $income == '0' ? '2000' : $income;
			$fields = [
				'Request' => [
					'Key' => $KEY,
					'API_Action' => 'pingPostLead',
					'Format' => 'JSON',
					'Mode' => 'ping',
					'Return_Best_Price' => '1',
					'TYPE' => $TYPE,
					'Landing_Page' => Yii::app()->request->getParam('url','https://elitehealthinsurers.com'),
					'IP_Address' => Yii::app()->request->getParam('ipaddress'),
					'SRC' => $SRC,
					'Sub_ID' => $promo_code,
					'TCPA_Consent' => Yii::app()->request->getParam('tcpa_optin')==1?'Yes':'No',
					'TCPA_Language' =>Yii::app()->request->getParam('tcpa_text'),
					'LeadiD_Token' => Yii::app()->request->getParam('universal_leadid'),
					'Trusted_Form_URL' => Yii::app()->request->getParam('trustedformcerturl'),
					'Zip' => Yii::app()->request->getParam('zip'),
					'DOB' => date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))),
					'User_Agent' => Yii::app()->request->getParam('user_agent'),
					'Residence_Type' => Yii::app()->request->getParam('is_rented')=='1'?'Rent':'Own',
					'Years_At_Residence' => Yii::app()->request->getParam('stay_in_year'),
					'Months_At_Residence' => Yii::app()->request->getParam('stay_in_month'),
					'Gender' => Yii::app()->request->getParam('gender')=='M'?'Male':'Female',
					'Marital_Status' => $mar_status,
					'Occupation' => $occupation,
					'Education_Level' => $edu_level,
					'Student' => Yii::app()->request->getParam('is_student')==1?'Yes':'No',
					'Weight' => Yii::app()->request->getParam('weight'),
					'Height_Inch' => $height_inches,
					'Height_Ft' => $height_feet,
					'Household_Size' => Yii::app()->request->getParam('number_in_household'),
					'Estimated_Household_Income' => Yii::app()->request->getParam('income'),
					'Medical_Conditions' => $medicalCondition,
					'DUI' => Yii::app()->request->getParam('dui')==1?'Yes':'No',
					'Tobacco_Use' => Yii::app()->request->getParam('is_smoker')==1?'Yes':'No',
					'Previously_Denied' => Yii::app()->request->getParam('previously_denied')==1?'Yes':'No',
					'Expectant_Parent' => Yii::app()->request->getParam('expectant_parent')==1?'Yes':'No',
					'Is_Smoker' => Yii::app()->request->getParam('is_smoker')==1?'Yes':'No',
					'Relative_Heart' => Yii::app()->request->getParam('relative_heart')==1?'Yes':'No',
					'Relative_Cancer' => Yii::app()->request->getParam('relative_cancer')==1?'Yes':'No',
					'Requested_Coverage_Type' => $req_coverage_type,
					'Currently_Insured' => $current_coverage_type > 0 ? 'Yes' : 'No',
					'Current_Coverage_Type' => $curr_coverage_type,
					'Insurance_Company' => $insuranceCompany,
					'Insurance_Expiration_Date' =>date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
					'Insurance_Start_Date' =>date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_start_date'))),
				]
			];
			$pingData['ping_request'] = json_encode($fields);
			return $pingData;
		}
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
		$height_cm = Yii::app()->request->getParam('height');
		$total_inches = ceil($height_cm/2.54);
		$height_feet = intval($total_inches/12);
		$height_feet = $height_feet < 5 ? 5 : $height_feet;
		$height_inches = round($total_inches%12);
		$submission_model = new Submissions();
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$medicalCondition = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
		$maritial_status = Yii::app()->request->getParam('marital_status');
		switch ($maritial_status) {
			case '1':
				$mar_status = 'Single';
				break;
			case '2':
				$mar_status = 'Married';
				break;
			case '3':
				$mar_status = 'Separated';
				break;
			case '4':
				$mar_status = 'Divorced';
				break;
			case '5':
				$mar_status = 'Domestic Partner';
				break;
			case '6':
				$mar_status = 'Widowed';
				break;
			default:
				$mar_status = 'Married';
				break;
		}
		$Education_Level = Yii::app()->request->getParam('education_level');
		switch ($Education_Level) {
			case '1':
				$edu_level = 'Less than High School';
				break;
			case '2':
				$edu_level = 'Some or No High School';
				break;
			case '3':
				$edu_level = 'High School Diploma';
				break;
			case '4':
				$edu_level = 'Some College';
				break;
			case '5':
				$edu_level = 'Associate Degree';
				break;
			case '6':
				$edu_level = 'Bachelors Degree';
				break;
			case '7':
				$edu_level = 'Bachelors Degree';
				break;
			case '8':
				$edu_level = 'Doctorate Degree';
				break;
			case '9':
				$edu_level = 'Other';
				break;
			default:
				$edu_level = 'Other';
				break;
		}
		$submission_model = new Submissions();
		$occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0]);
		$inches = round($height_cm/2.54);
		$height_feet = intval($inches/12);
		$height_inches = round($inches);
		$requested_coverage_type = Yii::app()->request->getParam('requested_coverage_type');
		switch ($requested_coverage_type) {
			case '1':
				$req_coverage_type = 'Individual Plan';
				break;
			case '2':
				$req_coverage_type = 'Family Plan';
				break;
			case '3':
				$req_coverage_type = 'Medicare Supplement';
				break;
			default:
				$req_coverage_type = 'Individual Plan';
				break;
		}
		$current_coverage_type = Yii::app()->request->getParam('current_coverage_type',0);
		switch ($current_coverage_type) {
			case '1':
				$curr_coverage_type = 'Individual Plan';
				break;
			case '2':
				$curr_coverage_type = 'Family Plan';
				break;
			case '3':
				$curr_coverage_type = 'Medicare Supplement';
				break;
			default:
				$curr_coverage_type = 'Individual Plan';
				break;
		}
		$age = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob'))));
		if($age < '65'){
			$SRC = 'EMHealth';  //Health U65
		}else{
			$SRC = 'EMO65'; //Medicare
		}
		$KEY = $p2 ? $p2 : '35377425b4990cd0e42178bc38c858c9594d6d6af6fcb748213f5307d0b53da2';
		$TYPE = $p3 ? $p3 : '49';
		$confirmation_id = $result['response']['lead_id'];
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$income = Yii::app()->request->getParam('income');
		$income = $income == '0' ? '2000' : $income;
		$fields = [
		'Request' => [
			'Lead_ID' =>$confirmation_id,
			'Key' => $KEY,
			'API_Action' => 'pingPostLead',
			'Format' => 'JSON',
	        'Mode' => 'post',
	        'Return_Best_Price' => '1',
	        'TYPE' => $TYPE,
	        'Landing_Page' => Yii::app()->request->getParam('url','https://elitehealthinsurers.com'),
	        'IP_Address' => Yii::app()->request->getParam('ipaddress'),
	        'SRC' => $SRC,
	        'Sub_ID' => Yii::app()->request->getParam('promo_code'),
	        'TCPA_Consent' => Yii::app()->request->getParam('tcpa_optin')==1?'Yes':'No',
	        'TCPA_Language' =>Yii::app()->request->getParam('tcpa_text'),
	        'LeadiD_Token' => Yii::app()->request->getParam('universal_leadid'),
			'Trusted_Form_URL' => Yii::app()->request->getParam('trustedformcerturl'),
	        'Zip' => Yii::app()->request->getParam('zip'),
			'First_Name' => Yii::app()->request->getParam('first_name'),
			'Last_Name' => Yii::app()->request->getParam('last_name'),
			'Address' => Yii::app()->request->getParam('address'),
			'State' => $city_state['state'],
			'Email' => Yii::app()->request->getParam('email'),
			'Primary_Phone' => Yii::app()->request->getParam('phone'),
			'Secondary_Phone' => Yii::app()->request->getParam('mobile'),
	        'DOB' => date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))),
	        'User_Agent' => Yii::app()->request->getParam('user_agent'),
	        'Residence_Type' => Yii::app()->request->getParam('is_rented')=='1'?'Rent':'Own',
	        'Years_At_Residence' => Yii::app()->request->getParam('stay_in_year'),
	        'Months_At_Residence' => Yii::app()->request->getParam('stay_in_month'),
	        'Gender' => Yii::app()->request->getParam('gender')=='M'?'Male':'Female',
	        'Marital_Status' => $mar_status,
	        'Occupation' => $occupation,
	        'Education_Level' => $edu_level,
	        'Student' => Yii::app()->request->getParam('is_student')==1?'Yes':'No',
	        'Weight' => Yii::app()->request->getParam('weight'),
			'Height_Inch' => $height_inches,
			'Height_Ft' => $height_feet,
			'Household_Size' => Yii::app()->request->getParam('number_in_household'),
			'Estimated_Household_Income' => Yii::app()->request->getParam('income'),
	        'Medical_Conditions' => $medicalCondition,
	        'DUI' => Yii::app()->request->getParam('dui')==1?'Yes':'No',
	        'Tobacco_Use' => Yii::app()->request->getParam('is_smoker')==1?'Yes':'No',
	        'Previously_Denied' => Yii::app()->request->getParam('previously_denied')==1?'Yes':'No',
	        'Expectant_Parent' => Yii::app()->request->getParam('expectant_parent')==1?'Yes':'No',
	        'Relative_Heart' => Yii::app()->request->getParam('relative_heart')==1?'Yes':'No',
	        'Relative_Cancer' => Yii::app()->request->getParam('relative_cancer')==1?'Yes':'No',
	        'Requested_Coverage_Type' => $req_coverage_type,
	        'Currently_Insured' => $current_coverage_type > 0 ? 'Yes' : 'No',
	        'Current_Coverage_Type' => $curr_coverage_type,
	        'Insurance_Company' => $insuranceCompany,
	        'Insurance_Expiration_Date' =>date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
	        'Insurance_Start_Date' =>date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_start_date'))),
	    	]
    	];
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