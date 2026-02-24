<?php

class EtnamericaController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static $maritalStatus = [
        1=>'Single',
        2=>'Married',
        3=>'Separated',
        4=>'Divorced',
        5=>'Domestic Partner',
        6=>'Widowed'
    ];
    public static $educationLevel = [
        1 => 'Less than High School',
		2 => 'Some or No High School',
		3 => 'High School Diploma',
		4 => 'Some College',
		5 => 'Associate Degree',
		6 => 'Bachelors Degree',
		7 => 'Masters Degree',
		8 => 'Doctorate Degree',
		9 => 'Other',
    ];
    public static $coverageType = [
		1 => 'Individual Plan',
		2 => 'Family Plan',
		3 => 'Medicare Supplement',
    ];
   
    public static $medicalConditionFromBuyer = ['AIDS','AlcoholDrugAbuse','AlzheimersDisease','Arthritis','Asthma','Cancer','Cholesterol','Depression','Diabetes','EyeDisorder','HeartDisease','Hepatitus','HighBloodPressure','Hospitalized','KidneyDisease','LiverDisease','Lupus','MedicalTreatment','MentalIllness','Neurosis','Pregnant','PulmonaryDisease','Seizure','Skin','Stroke','Transienteschemicattack','Ulcer','VascularDisease','Other','None'];
    public static $companyListFromBuyer = ["Company Not Listed","21st Century Insurance","AAA Insurance Co.","AABCO","AARP","Access Insurance","Acordia","Aegis Security","Aetna","Affirmative","Aflac","AHCP","AIG","AIU Insurance","Alfa Insurance","All Nation","All Risk","Alleghany Corporation","Allianz","Allied Group","Allied","Allmerica","Allstate Insurance","American Alliance Ins Co","American Automobile Insurance","American Banks","American Casualty","American Deposit Insurance","American Direct Business Insurance","American Economy Ins Co","American Empire Insurance","American Family Insurance","American Financial","American Health Underwriters","American Home Assurance","American Income Life Insurance Company","American Insurance","American International Ins","American International Pacific","American International South","American Manufacturers","American Mayflower Insurance","American Medical Securities","American Motorists Insurance","American National Insurance","American National Property and Casualty","American Premier","American Protection Insurance","American Reliable Ins Co","American Republic","American Savers Plan","American Service Insurance","American Skyline Insurance Company","American Spirit Insurance","American Standard Insurance - OH","American Standard Insurance - WI","American States","Americas Ins. Consultants","AmeriPlan","Ameriprise","Amerisure","Ameritas Life Insurance Company","Amex Assurance Co","Amica Insurance","Amica Mutual Ins Co","Answer Financial","Anthem","API","Arbella","Arizona General","Armed Forces Insurance","Assigned Risk","Associated Indemnity","Associated Insurance Managers","Assurant","Atlanta Casualty","Atlanta Specialty","Atlantic Indemnity","Atlantic Mutual Co","Atlantis","Austin Mutual","Auto Club Insurance Company","Auto Owners","Avomark","AXA Equitable Life Insurance Company","Badger Mutual","Bankers Life and Casualty Company","Banner Life","Berkshire Hathaway","Best Agency USA","Blue Cross / Blue Shield","Bonneville","Boston Old Colony","Builders","Cal Farm Insurance","Calfarm Ins Co","California Casualty and Fire Ins Co","California State Automobile Association","Camden","Capital Choice","Cascade National Ins","Casualty Assurance","Centennial","Century National Ins","Charter Oak","Chartis","Chase Insurance Group","Chicago Insurance","Chubb Group of Ins Co","Church Mutual","Cigna","Cincinnati Insurance Company","Citizens","Clarendon National Insurance","Clarendon","Cloverleaf","CNA","Colonial Penn","Colonial","Combined","Commerce Insurance Group","Commerce West","Commercial Union","Commonwealth","Conseco","Continental Casualty","Continental Divide Insurance","Continental Insurance","Cotton States Insurance","Cottonwood","Country Financial","Countrywide Insurance","Criterion","CSE Insurance Group","CUNA Mutual","Dairyland Insurance","Dakota Fire","Deerbrook","Depositors Emcasc","Direct General Insurance","Dixie","Eagle Ins Co","Ebco General","eFinancial","eHealth","Electric Insurance","Elephant","EMC","Empire Fire and Marine","Employers Fire","Encompass Insurance Company","Ensure","Equitable Life","Erie Insurance Company","Esurance","Evergreen USA RRG","Explorer","Facility","Farm and Ranch","Farm Bureau/Farm Family/Rural","Farmers Insurance","Farmers Union","Farmland","Federal Ins Co","Federated Mutual Insurance Company","Fidelity Insurance Company","Financial Indemnity","Fire and Casualty Insurance Co of CT","Firemans Fund","First Acceptance Insurance","First American","First Financial","First General","First Insurance Company of Hawaii, LTD","First National","FM Global","Ford Motor Credit","Foremost","Foresters","Fortis","Franklin","GAINSCO","Geico Casualty","Geico","General Accident Insurance","General Re","Genworth Financial","Globe","GMAC Insurance","Grange","GRE Harleysville H","Great American Ins Co","Great Way","Great West Casualty Company","Grinnell Mutual","Guaranty National Insurance","Guardian Life Insurance Company of America","Guide One Insurance","Halcyon","Hanover Ins Co","Hanover Lloyds Insurance Company","Happy Days","Hartford Accident and Indemnity","Hawkeye Security","HCC Insurance Holdings","Health Benefits Direct","Health Choice One","Health Net","Health Plus of America","HealthMarkets","HealthShare American","Heritage","Home State County Mutual","Horace Mann","Humana","IAB","IFA Auto Insurance","IGF","IIS Insurance","Infinity Insurance","Infinity Select Insurance","Insphere Insurance Solutions","Insur. of Evanston","Insurance Co of the West","Insurance Insight","Integon","Interstate","Jackson National Life","John Deere","John Hancock Insurance","Kaiser Permanente","Kemper Insurance","Kentucky Central","Kentucky Farm Bureau","Knights of Columbus","Landmark American Insurance","Leader Insurance","Leader National","Leader Preferred Insurance","Leader Specialty Insurance","League General","Liberty Insurance Corp","Liberty Mutual Insurance","Liberty National","Liberty Northwest Insurance","Lincoln Benefit Life","Lincoln National Corporation","LTC Financial Partners","Lumbermens Mutual","Marathon","Markel Corporation","Maryland Casualty","MassMutual Financial Group","Matrix Direct","MEGA Life and Health","Mega/Midwest","Mendota","Merastar","Merchants Insurance Group","Mercury","MetLife Auto and Home","MetLife","Mid Century Insurance","Mid-Continent Casualty","Middlesex Insurance","Midland National Life","Midwest Mutual","Millbank","Millers Mutual","Milwaukee","Minnehoma","Missouri General","Modern Woodmen of America","Mortgage Protection Bureau","Motors","Mountain Laurel","Mutual Insurance","Mutual Of Enumclaw","Mutual of New York","Mutual of Omaha","National Alliance","National Ben Franklin Insurance","National Casualty","National Colonial","National Continental Insurance","National Fire Insurance Company of Hartford","National Health Insurance","National Indemnity","National Merit","National Surety Corp","National Union Fire Insurance","Nationwide General Insurance","Nationwide Mutual Insurance Company","Natl Farmers Union","New England Financial","New Jersey Manufacturers Insurance Company","New York Life Insurance Company","NJ Skylands Insurance","North American","North Pacific","North Pointe","North Shore","Northern Capital","Northern States","Northland","Northwestern Mutual Life","Northwestern Pacific Indemnity","Ohio Casualty","Ohio Security","Olympia","Omega","Omni Insurance","OneBeacon","Oregon Mutual","Orion Insurance","Other","Oxford Health Plans","Pacific Indemnity","Pacific Insurance","Pacific Life","Pacificare","Pafco","Paloverde","Patriot General Insurance","Peak Property and Casualty Insurance","PEMCO Insurance","Penn America","Penn Mutual","Pennsylvania Natl","Philadelphia Insurance Companies","Phoenix","Physicians","Pinnacle","Pioneer Life","Plymouth Rock Assurance","Preferred Mutual","Premier","Prestige","Primerica","Principal Financial","Progressive","Protective Life","Provident","Prudential Insurance Co.","QBE Insurance","Quality","Ramsey","RBC Liberty Insurance","Regal","Reliance Insurance Company","Reliant","Republic Indemnity","Response Insurance","RLI Corp.","Rockford Mutual","Rodney D. Young","Safe Auto Insurance Company","SAFECO","Safeguard","Safeway Insurance","Sea West Insurance","Security Insurance","Security National","Sedgwick James","Selective Insurance","Sentinel Insurance","Sentry Insurance Group","Shelter Insurance Co.","Skandia TIG Tita","Southern Aid and Insurance Company","Spectrum","St. Paul Fire and Marine Ins Co","St. Paul","Standard Fire Insurance Company","Standard Guaranty","Standard Insurance Company","State and County Mutual Fire Insurance","State Auto Ins Co","State Farm County","State Farm Insurance","State Mutual","State National Insurance","Sun Coast","Sun Life Financial","Superior American Insurance","Superior Guaranty Insurance","Superior Insurance","Superior","Sutter","Symetra","The Ahbe Group","The Credo Group","The General","The Hartford","The Regence Group","TIAA-CREF","TICO Insurance","TIG Countrywide Insurance","Titan","Total","Tower","TransAmerica","Travelers Insurance Company","Trinity Universal","Tri-State Consumer Insurance","Trupanion","Trust Hall","Twin City Fire Insurance","Unicare","Unigard Ins","Union","United American","United Financial","United Fire Group","United Security","United Services Automobile Association","Unitrin Direct","Universal Underwriters Insurance","Unum","US Financial","US Health Advisors","USA Benefits/Continental General","USAA","USF and G","Utah Home and Fire","Utica","Vasa North Atlantic","Vigilant","Viking","Wawanesa Mutual","Wellington","Wellpoint","West American","West Bend Mutual","West Coast Life","West Plains","Western and Southern Life","Western Mutual Insurance Group","Western National","Western Southern Life","White Mountains Insurance Group","William Penn","Windsor","Windstar","Wisconsin Mutual","Woodlands Financial Group","Workmens Auto Insurance","World Insurance","Worldwide","Yellow Key","Yosemite","Zurich North America"];

    public static $occupationListFromBuyer = ['Accounts Pay/Rec.','Actor','Administration/Management','Appraiser','Architect','Artist','Assembler','Auditor','Baker','Bank Teller','Banker','Bartender','Broker','Cashier','Casino Worker','CEO','Certified Public Accountant','Chemist','Child Care','City Worker','Claims Adjuster','Clergy','Clerical/Technical','College Professor','Computer Tech','Construction','Contractor','Counselor','Craftsman/Skilled Worker','Custodian','Customer Support Rep','Dancer','Decorator','Delivery Driver','Dentist','Director','Disabled','Drivers','Electrician','Engineer-Aeronautical','Engineer-Aerospace','Engineer-Chemical','Engineer-Civil','Engineer-Electrical','Engineer-Gas','Engineer-Geophysical','Engineer-Mechanical','Engineer-Nuclear','Engineer-Other','Engineer-Petroleum','Engineer-Structural','Entertainer','Farmer','Fire Fighter','Flight Attend.','Food Service','Government','Health Care','Housewife/Househusband','Installer','Instructor','Journalist','Journeyman','Laborer/Unskilled Worker','LabTech.','Lawyer','Machine Operator','Machinist','Maintenance','Manufacturer','Marketing','Mechanic','Military E1 - E4','Military E5 - E7','Military Officer','Military Other','Model','Nanny','Nurse/CNA','Other','Painter','Para-Legal','Paramedic','Personal Trainer','Photographer','Physician','Pilot','Plumber','Police Officer','Postal Worker','Preacher','Pro Athlete','Production','Prof-College Degree','Prof-Specialty Degree','Programmer','Real Estate','Receptionist','Reservation Agent','Restaurant Manager','Retail','Retired','Roofer','Sales','Scientist','Secretary','Security','Self Employed','Social Worker','Stocker','Store Owner','Student Living w/Parents','Student Not Living w/Parents','Stylist','Supervisor','Teacher','Teacher - with Credentials','Technical/Supervisory','Travel Agent','Truck Driver','Unemployed','Unknown','Vet','Waitress','Welder'];

    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
			$promo_code = Yii::app()->request->getParam('promo_code');
				$height_cm = Yii::app()->request->getParam('height');
				$inches = $height_cm/2.54;
				$height_feet = intval($inches/12);
				$height_inches = round($inches%12);
				$zip_code = Yii::app()->request->getParam('zip');
				$submission_model = new Submissions();
				$city_state = $submission_model->getCityStateFromZip($zip_code);
				$submission_model = new Submissions();
				$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
				$medicalCondition = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
				$occupation = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0]);
				$fields =[
					'lp_campaign_id' => $p1 ? $p1 :'62208a2dee977',
					'lp_campaign_key' => $p2 ? $p2 : 'qBhHKJQzDGfF6kvYn2jd',
					'lp_s1' => $promo_code,
					'lp_s2' => '',
					'lp_s3' => '',
					'lp_s4' => '',
					'lp_s5' => '',
					'lp_response' => 'XML',
					'zip_code' => $zip_code,
					'state' => $city_state['state'],
					'city' => $city_state['city'],
					'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
					'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
					'dob'=>date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))),
					'ip_address' => Yii::app()->request->getParam('ipaddress'),
					'insured_since' => date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_start_date'))),
					'expiration_date' => date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
					'landing_page' => Yii::app()->request->getParam('url','https://elitehealthinsurers.com'),
					'gender'=>Yii::app()->request->getParam('gender')=='M'?'Male':'Female',
					'tcpa_consent' => Yii::app()->request->getParam('tcpa_optin') > 0 ? 'Yes' : 'Yes',
					'height_feet'=>$height_feet,
					'height_inches'=>$height_inches,
					'weight'=>Yii::app()->request->getParam('weight'),
					'household_size'=>Yii::app()->request->getParam('number_in_household'),
					'household_income' => Yii::app()->request->getParam('income', '3500'),
					'user_agent'=>Yii::app()->request->getParam('user_agent'),
					'residence_type' => Yii::app()->request->getParam('is_rented')=='rent' ? 'Rent' : 'Own',
					'tcpa_language' => Yii::app()->request->getParam('tcpa_text'),
					'years_at_residence' => Yii::app()->request->getParam('stay_in_year'),
					'months_at_residence' => Yii::app()->request->getParam('stay_in_month'),
					'marital_status'=>self::$maritalStatus[Yii::app()->request->getParam('marital_status','1')],
					'occupation' => $occupation,
					'education_level'=>self::$educationLevel[Yii::app()->request->getParam('education_level','1')],
					'student' => Yii::app()->request->getParam('is_student')=='1'?'Yes':'No',
					'medical_condition' => $medicalCondition,
					'dui' => Yii::app()->request->getParam('dui')=='1'?'Yes':'No',
					'previously_denied' => Yii::app()->request->getParam('previously_denied')=='1'?'Yes':'No',
					'expectant_parent' => Yii::app()->request->getParam('expectant_parent')=='1'?'Yes':'No',
					'is_smoker' => Yii::app()->request->getParam('is_smoker')=='1'?'Yes':'No',
					'relative_heart'=> Yii::app()->request->getParam('relative_heart')=='1'?'Yes':'No',
					'relative_cancer' => Yii::app()->request->getParam('relative_cancer')=='1'?'Yes':'No',
					'requested_coverage_type' => self::$coverageType[Yii::app()->request->getParam('requested_coverage_type','1')],
					'current_coverage_type'=>self::$coverageType[Yii::app()->request->getParam('current_coverage_type','1')],
					'current_insurance_company'=>$insuranceCompany,
					'have_insurance'=> Yii::app()->request->getParam('insurance_start_date')!="" > 0 ? 'Yes' : 'No',
				];
				$pingData = [];
				$purchase = true;
				$age = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob'))));
				if($age > 64){
	                $ping_response = $age .' more than 64 Not Allowed';
	                $purchase = false;
            	}
            	//$pingData['header'] = ["Content-Type: application/json"];
            	if($purchase == true){
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
            preg_match("/<price>(.*)<\/price>/msui", $ping_response, $price);
            preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response, $confirmation_id);
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
    public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response, $confirmation_id);
		$height_cm = Yii::app()->request->getParam('height');
		$inches = $height_cm/2.54;
		$height_feet = intval($inches/12);
		$height_inches = round($inches%12);
		$zip_code = Yii::app()->request->getParam('zip');
		$submission_model = new Submissions();
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$medicalCondition = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
		$occupation = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0]);
		// GET PING ID
		preg_match("/<ping_id>(.*)<\/ping_id>/msui", $ping_response,$confirmation_id);
		$fields =[
			'lp_campaign_id' => $p1 ? $p1 :'62208a2dee977',
			'lp_campaign_key' => $p2 ? $p2 : 'qBhHKJQzDGfF6kvYn2jd',
			'lp_s1' => $promo_code,
			'lp_s2' => '',
			'lp_s3' => '',
			'lp_s4' => '',
			'lp_s5' => '',
			'lp_response' => 'XML',
			'lp_ping_id' =>$confirmation_id[1],
			'first_name' => Yii::app()->request->getParam('first_name'),
			'last_name' => Yii::app()->request->getParam('last_name'),
			'phone_home' => Yii::app()->request->getParam('phone'),
			'address' => Yii::app()->request->getParam('address'),
			'city' => $city_state['city'],
			'state' => $city_state['state'],
			'email_address' => Yii::app()->request->getParam('email'),
			'dob'=>date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))),
			'ip_address' => Yii::app()->request->getParam('ipaddress'),
			'zip_code' => $zip_code,
			'state' => $city_state['state'],
			'city' => $city_state['city'],
			'jornaya_lead_id' => Yii::app()->request->getParam('universal_leadid'),
			'trusted_form_cert_id' => Yii::app()->request->getParam('trustedformcerturl'),
			'insured_since' => date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_start_date'))),
			'expiration_date' => date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
			'landing_page' => Yii::app()->request->getParam('url','https://elitehealthinsurers.com'),
			'gender'=>Yii::app()->request->getParam('gender')=='M'?'Male':'Female',
			'tcpa_consent' => Yii::app()->request->getParam('tcpa_optin') > 0 ? 'Yes' : 'Yes',
			'height_feet'=>$height_feet,
			'height_inches'=>$height_inches,
			'weight'=>Yii::app()->request->getParam('weight'),
			'household_size'=>Yii::app()->request->getParam('number_in_household'),
			'household_income' => Yii::app()->request->getParam('income', '3500'),
			'user_agent'=>Yii::app()->request->getParam('user_agent'),
			'residence_type' => Yii::app()->request->getParam('is_rented')=='rent' ? 'Rent' : 'Own',
			'tcpa_language' => Yii::app()->request->getParam('tcpa_text'),
			'years_at_residence' => Yii::app()->request->getParam('stay_in_year'),
			'months_at_residence' => Yii::app()->request->getParam('stay_in_month'),
			'marital_status'=>self::$maritalStatus[Yii::app()->request->getParam('marital_status','1')],
			'occupation' => $occupation,
			'education_level'=>self::$educationLevel[Yii::app()->request->getParam('education_level','1')],
			'student' => Yii::app()->request->getParam('is_student')=='1'?'Yes':'No',
			'medical_condition' => $medicalCondition,
			'dui' => Yii::app()->request->getParam('dui')=='1'?'Yes':'No',
			'previously_denied' => Yii::app()->request->getParam('previously_denied')=='1'?'Yes':'No',
			'expectant_parent' => Yii::app()->request->getParam('expectant_parent')=='1'?'Yes':'No',
			'is_smoker' => Yii::app()->request->getParam('is_smoker')=='1'?'Yes':'No',
			'relative_heart'=> Yii::app()->request->getParam('relative_heart')=='1'?'Yes':'No',
			'relative_cancer' => Yii::app()->request->getParam('relative_cancer')=='1'?'Yes':'No',
			'requested_coverage_type' => self::$coverageType[Yii::app()->request->getParam('requested_coverage_type','1')],
			'current_coverage_type'=>self::$coverageType[Yii::app()->request->getParam('current_coverage_type','1')],
			'current_insurance_company'=>$insuranceCompany,
			'have_insurance'=> Yii::app()->request->getParam('insurance_start_date')!="" > 0 ? 'Yes':'No',
		];
		$post_request = http_build_query($fields);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_response = $cm->curl($post_url, $post_request);
		$time_end = CommonToolsMethods::stopwatch();
		//echo '<pre>';print_r($ping_response);die();
		preg_match("/<result>(.*)<\/result>/", $post_response, $success);
		if (trim($success[1]) == 'success') {
			$post_status = '1';
			preg_match("/<redirect_url>(.*)<\/redirect_url>/", $post_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<price>(.*)<\/price>/msui", $post_response, $price);
			preg_match("/<price>(.*)<\/price>/msui", $ping_response, $ping_price);
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