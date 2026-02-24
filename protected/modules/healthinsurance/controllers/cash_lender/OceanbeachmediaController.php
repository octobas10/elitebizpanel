<?php
class OceanbeachmediaController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static $medicalConditionFromBuyer = ['None','AIDS / HIV','Alzheimer Disease','Asthma','Cancer','Cholesterol','Depression','Diabetes','Heart Disease','High Blood Pressure','Kidney Disease','Liver Disease','Mental Illness','Pulmonary Disease','Stroke','Ulcer','Vascular Disease','Other'];
	
    public static $companyListFromBuyer = ["Company Not Listed","21st Century Insurance","AAA Insurance Co.","AABCO","AARP","Access Insurance","Acordia","Aegis Security","Aetna","Affirmative","Aflac","AHCP","AIG","AIU Insurance","Alfa Insurance","All Nation","All Risk","Alleghany Corporation","Allianz","Allied Group","Allied","Allmerica","Allstate Insurance","American Alliance Ins Co","American Automobile Insurance","American Banks","American Casualty","American Deposit Insurance","American Direct Business Insurance","American Economy Ins Co","American Empire Insurance","American Family Insurance","American Financial","American Health Underwriters","American Home Assurance","American Income Life Insurance Company","American Insurance","American International Ins","American International Pacific","American International South","American Manufacturers","American Mayflower Insurance","American Medical Securities","American Motorists Insurance","American National Insurance","American National Property and Casualty","American Premier","American Protection Insurance","American Reliable Ins Co","American Republic","American Savers Plan","American Service Insurance","American Skyline Insurance Company","American Spirit Insurance","American Standard Insurance - OH","American Standard Insurance - WI","American States","Americas Ins. Consultants","AmeriPlan","Ameriprise","Amerisure","Ameritas Life Insurance Company","Amex Assurance Co","Amica Insurance","Amica Mutual Ins Co","Answer Financial","Anthem","API","Arbella","Arizona General","Armed Forces Insurance","Assigned Risk","Associated Indemnity","Associated Insurance Managers","Assurant","Atlanta Casualty","Atlanta Specialty","Atlantic Indemnity","Atlantic Mutual Co","Atlantis","Austin Mutual","Auto Club Insurance Company","Auto Owners","Avomark","AXA Equitable Life Insurance Company","Badger Mutual","Bankers Life and Casualty Company","Banner Life","Berkshire Hathaway","Best Agency USA","Blue Cross / Blue Shield","Bonneville","Boston Old Colony","Builders","Cal Farm Insurance","Calfarm Ins Co","California Casualty and Fire Ins Co","California State Automobile Association","Camden","Capital Choice","Cascade National Ins","Casualty Assurance","Centennial","Century National Ins","Charter Oak","Chartis","Chase Insurance Group","Chicago Insurance","Chubb Group of Ins Co","Church Mutual","Cigna","Cincinnati Insurance Company","Citizens","Clarendon National Insurance","Clarendon","Cloverleaf","CNA","Colonial Penn","Colonial","Combined","Commerce Insurance Group","Commerce West","Commercial Union","Commonwealth","Conseco","Continental Casualty","Continental Divide Insurance","Continental Insurance","Cotton States Insurance","Cottonwood","Country Financial","Countrywide Insurance","Criterion","CSE Insurance Group","CUNA Mutual","Dairyland Insurance","Dakota Fire","Deerbrook","Depositors Emcasc","Direct General Insurance","Dixie","Eagle Ins Co","Ebco General","eFinancial","eHealth","Electric Insurance","Elephant","EMC","Empire Fire and Marine","Employers Fire","Encompass Insurance Company","Ensure","Equitable Life","Erie Insurance Company","Esurance","Evergreen USA RRG","Explorer","Facility","Farm and Ranch","Farm Bureau/Farm Family/Rural","Farmers Insurance","Farmers Union","Farmland","Federal Ins Co","Federated Mutual Insurance Company","Fidelity Insurance Company","Financial Indemnity","Fire and Casualty Insurance Co of CT","Firemans Fund","First Acceptance Insurance","First American","First Financial","First General","First Insurance Company of Hawaii, LTD","First National","FM Global","Ford Motor Credit","Foremost","Foresters","Fortis","Franklin","GAINSCO","Geico Casualty","Geico","General Accident Insurance","General Re","Genworth Financial","Globe","GMAC Insurance","Grange","GRE Harleysville H","Great American Ins Co","Great Way","Great West Casualty Company","Grinnell Mutual","Guaranty National Insurance","Guardian Life Insurance Company of America","Guide One Insurance","Halcyon","Hanover Ins Co","Hanover Lloyds Insurance Company","Happy Days","Hartford Accident and Indemnity","Hawkeye Security","HCC Insurance Holdings","Health Benefits Direct","Health Choice One","Health Net","Health Plus of America","HealthMarkets","HealthShare American","Heritage","Home State County Mutual","Horace Mann","Humana","IAB","IFA Auto Insurance","IGF","IIS Insurance","Infinity Insurance","Infinity Select Insurance","Insphere Insurance Solutions","Insur. of Evanston","Insurance Co of the West","Insurance Insight","Integon","Interstate","Jackson National Life","John Deere","John Hancock Insurance","Kaiser Permanente","Kemper Insurance","Kentucky Central","Kentucky Farm Bureau","Knights of Columbus","Landmark American Insurance","Leader Insurance","Leader National","Leader Preferred Insurance","Leader Specialty Insurance","League General","Liberty Insurance Corp","Liberty Mutual Insurance","Liberty National","Liberty Northwest Insurance","Lincoln Benefit Life","Lincoln National Corporation","LTC Financial Partners","Lumbermens Mutual","Marathon","Markel Corporation","Maryland Casualty","MassMutual Financial Group","Matrix Direct","MEGA Life and Health","Mega/Midwest","Mendota","Merastar","Merchants Insurance Group","Mercury","MetLife Auto and Home","MetLife","Mid Century Insurance","Mid-Continent Casualty","Middlesex Insurance","Midland National Life","Midwest Mutual","Millbank","Millers Mutual","Milwaukee","Minnehoma","Missouri General","Modern Woodmen of America","Mortgage Protection Bureau","Motors","Mountain Laurel","Mutual Insurance","Mutual Of Enumclaw","Mutual of New York","Mutual of Omaha","National Alliance","National Ben Franklin Insurance","National Casualty","National Colonial","National Continental Insurance","National Fire Insurance Company of Hartford","National Health Insurance","National Indemnity","National Merit","National Surety Corp","National Union Fire Insurance","Nationwide General Insurance","Nationwide Mutual Insurance Company","Natl Farmers Union","New England Financial","New Jersey Manufacturers Insurance Company","New York Life Insurance Company","NJ Skylands Insurance","North American","North Pacific","North Pointe","North Shore","Northern Capital","Northern States","Northland","Northwestern Mutual Life","Northwestern Pacific Indemnity","Ohio Casualty","Ohio Security","Olympia","Omega","Omni Insurance","OneBeacon","Oregon Mutual","Orion Insurance","Other","Oxford Health Plans","Pacific Indemnity","Pacific Insurance","Pacific Life","Pacificare","Pafco","Paloverde","Patriot General Insurance","Peak Property and Casualty Insurance","PEMCO Insurance","Penn America","Penn Mutual","Pennsylvania Natl","Philadelphia Insurance Companies","Phoenix","Physicians","Pinnacle","Pioneer Life","Plymouth Rock Assurance","Preferred Mutual","Premier","Prestige","Primerica","Principal Financial","Progressive","Protective Life","Provident","Prudential Insurance Co.","QBE Insurance","Quality","Ramsey","RBC Liberty Insurance","Regal","Reliance Insurance Company","Reliant","Republic Indemnity","Response Insurance","RLI Corp.","Rockford Mutual","Rodney D. Young","Safe Auto Insurance Company","SAFECO","Safeguard","Safeway Insurance","Sea West Insurance","Security Insurance","Security National","Sedgwick James","Selective Insurance","Sentinel Insurance","Sentry Insurance Group","Shelter Insurance Co.","Skandia TIG Tita","Southern Aid and Insurance Company","Spectrum","St. Paul Fire and Marine Ins Co","St. Paul","Standard Fire Insurance Company","Standard Guaranty","Standard Insurance Company","State and County Mutual Fire Insurance","State Auto Ins Co","State Farm County","State Farm Insurance","State Mutual","State National Insurance","Sun Coast","Sun Life Financial","Superior American Insurance","Superior Guaranty Insurance","Superior Insurance","Superior","Sutter","Symetra","The Ahbe Group","The Credo Group","The General","The Hartford","The Regence Group","TIAA-CREF","TICO Insurance","TIG Countrywide Insurance","Titan","Total","Tower","TransAmerica","Travelers Insurance Company","Trinity Universal","Tri-State Consumer Insurance","Trupanion","Trust Hall","Twin City Fire Insurance","Unicare","Unigard Ins","Union","United American","United Financial","United Fire Group","United Security","United Services Automobile Association","Unitrin Direct","Universal Underwriters Insurance","Unum","US Financial","US Health Advisors","USA Benefits/Continental General","USAA","USF and G","Utah Home and Fire","Utica","Vasa North Atlantic","Vigilant","Viking","Wawanesa Mutual","Wellington","Wellpoint","West American","West Bend Mutual","West Coast Life","West Plains","Western and Southern Life","Western Mutual Insurance Group","Western National","Western Southern Life","White Mountains Insurance Group","William Penn","Windsor","Windstar","Wisconsin Mutual","Woodlands Financial Group","Workmens Auto Insurance","World Insurance","Worldwide","Yellow Key","Yosemite","Zurich North America"];
    
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$height_cm = Yii::app()->request->getParam('height');
		$total_inches = $height_cm/2.54;
		$height_feet = intval($total_inches/12);
		$height_inches = round($total_inches%12);
		$submission_model = new Submissions();
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$medicalCondition = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
		$pingData = [];
		$fields = [
			'meta' => [
				'originally_created' => date('Y-m-d').'T'.date('H:i:s').'Z',
				'source_id' => Yii::app()->request->getParam('promo_code'),
				'offer_id' => $_SESSION['affiliate_trans_id'],
				'lead_id_code' => Yii::app()->request->getParam('universal_leadid'),
				'trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
				'tcpa_compliant' => Yii::app()->request->getParam('tcpa_optin'),
				'tcpa_consent_text' => Yii::app()->request->getParam('tcpa_text'),
				'user_agent' => Yii::app()->request->getParam('user_agent'),
				'landing_page_url' => Yii::app()->request->getParam('url','https://elitehealthinsurers.com')
		    ],
		    'contact' => [
		    	'phone_last_four' => Yii::app()->request->getParam('phone_last_4'),
	            "zip_code" => Yii::app()->request->getParam('zip'),
	            "ip_address" => Yii::app()->request->getParam('ipaddress'),
   			],
   			'data'=> [
				'height'=> floor($total_inches),
				'weight'=>Yii::app()->request->getParam('weight'),
				'birth_date'=> Yii::app()->request->getParam('dob'),
				'gender'=> Yii::app()->request->getParam('gender'),
				'student'=> Yii::app()->request->getParam('is_student'),
				'tobacco'=> Yii::app()->request->getParam('is_smoker'),
				'bmi'=> '20',
				'medical_condition'=> $medicalCondition,
				'currently_employed' => true,
				'number_in_household'=> Yii::app()->request->getParam('number_in_household',4),
				'household_income'=> (int) Yii::app()->request->getParam('income'),
				'hospitalized'=> false,
				'ongoing_medical_treatment'=>true,
				'previously_denied'=> Yii::app()->request->getParam('previously_denied')=='0'?false:true,
				'prescriptions'=> false,
				'prescription_description'=> 'Not Collected',
				'qualifying_life_condition'=> 'Married Or Divorced',
				'current_policy'=> [
					'insurance_company'=> $insuranceCompany,
					'expiration_date'=> Yii::app()->request->getParam('insurance_expiration_date'),
					'insured_since'=> Yii::app()->request->getParam('insurance_start_date'),
				]
			],
		];
		$apitoken = $p2 ? $p2 : 'ad9c4a8f6f787143161921c035496866c20c7071';
		$pingData['ping_request'] = json_encode($fields);
		$pingData['header'] = ["Authorization: Token $apitoken","content-type: application/json"];
		return $pingData;
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
    	$result = json_decode($ping_response,TRUE);
        if (trim($result['status']) == 'success' || trim($result['status']) == 'success') {
            $ping_price = isset($result['price']) ? $result['price'] : 0;
            $confirmation_id = $result['auth_code'];
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
		$result = json_decode($ping_response,TRUE);
		$auth_code = $result['auth_code'];
		$height_cm = Yii::app()->request->getParam('height');
		$total_inches = $height_cm/2.54;
		$height_feet = intval($total_inches/12);
		$height_inches = round($total_inches%12);
		$zip_code = Yii::app()->request->getParam('zip');
		$submission_model = new Submissions();
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$medicalCondition = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
		$fields = [
			'auth_code' => $auth_code,
			'meta' => [
				'originally_created' => date('Y-m-d').'T'.date('H:i:s').'Z',
				'source_id' => Yii::app()->request->getParam('promo_code'),
				'offer_id' => $_SESSION['affiliate_trans_id'],
				'lead_id_code' => Yii::app()->request->getParam('universal_leadid'),
				'trusted_form_cert_url' => Yii::app()->request->getParam('trustedformcerturl'),
				'tcpa_compliant' => Yii::app()->request->getParam('tcpa_optin'),
				'tcpa_consent_text' => Yii::app()->request->getParam('tcpa_text'),
				'user_agent' => Yii::app()->request->getParam('user_agent'),
				'landing_page_url' => Yii::app()->request->getParam('url','https://elitehealthinsurers.com')
		    ],
		    'contact' => [
		    	'first_name'=> Yii::app()->request->getParam('first_name'),
		        'last_name'=> Yii::app()->request->getParam('last_name'),
		        'email'=> Yii::app()->request->getParam('email'),
		        'phone'=> Yii::app()->request->getParam('phone'),
		        'address'=> Yii::app()->request->getParam('address'),
		        'city'=> $city_state['city'],
		        'state'=> $city_state['state'],
	            "zip_code" => Yii::app()->request->getParam('zip'),
	            "ip_address" => Yii::app()->request->getParam('ipaddress'),
   			],
   			'data'=> [
				'height'=> floor($total_inches),
				'weight'=>Yii::app()->request->getParam('weight'),
				'birth_date'=> Yii::app()->request->getParam('dob'),
				'gender'=> Yii::app()->request->getParam('gender'),
				'student'=> Yii::app()->request->getParam('is_student'),
				'tobacco'=> Yii::app()->request->getParam('is_smoker'),
				'bmi'=> '20',
				'medical_condition'=> $medicalCondition,
				'currently_employed' => true,
				'number_in_household'=> Yii::app()->request->getParam('number_in_household',4),
				'household_income'=> Yii::app()->request->getParam('income'),
				'hospitalized'=> false,
				'ongoing_medical_treatment'=>true,
				'previously_denied'=> Yii::app()->request->getParam('previously_denied')=='0'?false:true,
				'prescriptions'=> false,
				'prescription_description'=> '',
				'qualifying_life_condition'=> 'Married Or Divorced',
				'current_policy'=> [
				    'insurance_company'=> $insuranceCompany,
				    'expiration_date'=> Yii::app()->request->getParam('insurance_expiration_date'),
				    'insured_since'=> Yii::app()->request->getParam('insurance_start_date'),
				]
			],
		];
		//echo '<pre>';print_r($fields);die();
		$post_request = json_encode($fields);
		$apitoken = $p2 ? $p2 : 'ad9c4a8f6f787143161921c035496866c20c7071';
        $header = array(
            "authorization: Token $apitoken",
            "content-type: application/json",
        );
        //echo '<pre>';print_r($post_request);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $post_response = $cm->curl($post_url, $post_request, $header);
		$time_end = CommonToolsMethods::stopwatch();
		$success = json_decode($post_response,TRUE);
		//echo '<pre>';print_r();die();
		if (isset($success['status']) && $success['status'] == 'success') {
			$post_status = '1';
            $redirect_url = '';
            $ping_success = json_decode($ping_response,TRUE);
            $post_price = isset($success['price']) ? $success['price'] : $ping_success['price'];
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