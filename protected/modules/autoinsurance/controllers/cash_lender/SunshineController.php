<?php
class SunshineController extends Controller
{
	public static $AccidentType = array(
		1 => '5',
		2 => '3',
		3 => '4',
		4 => '2',
		5 => '1',
		6 => '0'
	);
	public static $Damage = array(
		1 => '1',
		2 => '2',
		3 => '3',
		4 => '0'
	);

	public static $PrimaryUsage = array(
		1 => 'Business',
		2 => 'Commute To/From Work',
		3 => 'Commute To/From School',
		4 => 'Pleasure',
		5 => 'Government'
	);

	public static $converageType = array(
		1 => 'Superior',
		2 => 'Standard',
		3 => 'Basic',
		4 => 'State'
	);
	public static $bodilyInjury = array(
		1 => '250/500',
		2 => '100/300',
		3 => '50/100',
		4 => '25/50'
	);
	public static $vehicleAnnualMileage = array(
		1 => '5000',
		2 => '7500',
		3 => '10000',
		4 => '12500',
		5 => '15000',
		6 => '18000',
		7 => '25000',
		8 => '50000',
		9 => '100000'
	);
	public static $vehicleDailyMileage = array(
		1 => '3',
		2 => '5',
		3 => '9',
		4 => '20',
		5 => '50',
		6 => '100'
	);
	public static $maritialStatus = array(
		1 => 'Single',
		2 => 'Married',
		3 => 'Separated',
		4 => 'Divorced',
		5 => 'Married',
		6 => 'Widowed'
	);
	public static $creditRating = array(
		1 => 'Excellent',
		2 => 'Good',
		3 => 'Average',
		4 => 'Poor',
	);
	public static $educationList = array(
		1 => 'GED',
		2 => 'Some Or No High School',
		3 => 'High School',
		4 => 'Some College',
		5 => 'Associate Degree',
		6 => 'Bachelors Degree',
		7 => 'Masters Degree',
		8 => 'Doctoral Degree',
		9 => 'Unknown',
	);
	public static $driverAccidentDescription = array(
		1 => 'Vehicle Hit Vehicle',
		2 => 'Vehicle Hit Pedestrian',
		3 => 'Vehicle Hit Property',
		4 => 'Vehicle Damaged Avoiding Accident',
		5 => 'At Fault Accident Not Listed',
		6 => 'Loss Claim Not Listed'
	);
	public static $AccidentDamage = array(
		1 => 'People',
		2 => 'Property',
		3 => 'Both',
		4 => 'Not Applicable',
	);
	public static $occupationList = [
		1 => 'Advertising',
		2 => 'Arts/Entertainment',
		3 => 'Banking/Mortgage',
		4 => 'Clerical/Administrative',
		5 => 'Clergy/Religious',
		6 => 'Construction/Facilities',
		7 => 'Customer Service',
		8 => 'Disabled',
		9 => 'Education/Training',
		10 => 'Engineer/Architect',
		11 => 'Government',
		12 => 'Health Care',
		13 => 'Homemaker',
		14 => 'Hospitality/Travel',
		15 => 'Human Resources',
		16 => 'Insurance',
		17 => 'Internet/New Media',
		18 => 'Law Enforcement',
		19 => 'Legal',
		20 => 'Management Consulting',
		21 => 'Manufacturing',
		22 => 'Marketing',
		23 => 'Military/Defense',
		24 => 'Non-Profit/Volunteer',
		25 => 'Pharmaceutical/Biotech',
		26 => 'Real Estate',
		27 => 'Restaurant/Food Service',
		28 => 'Retail',
		29 => 'Retired',
		30 => 'Sales',
		31 => 'Self Employed',
		32 => 'Student',
		33 => 'Technology',
		34 => 'Telecommunications',
		35 => 'Transportation',
		36 => 'Unemployed',
	];

	public static $insuranceCompanyList = [
		1 => 'Company Not Listed',
		2 => '21st Century Insurance',
		3 => 'AAA Insurance Co.',
		4 => 'AIG',
		5 => 'AIU Insurance',
		6 => 'Alfa',
		7 => 'Allied',
		8 => 'Allstate Insurance',
		9 => 'Amco Ins Co',
		10 => 'American Alliance Ins Co',
		11 => 'American Automobile Insurance',
		12 => 'American Casualty',
		13 => 'American Direct Business Insurance',
		14 => 'American Economy Ins Co',
		15 => 'American Empire Insurance',
		16 => 'American Family Insurance',
		17 => 'American Financial',
		18 => 'American Home Assurance',
		19 => 'American Insurance',
		20 => 'American International Ins',
		21 => 'American International Pacific',
		22 => 'American International South',
		23 => 'American Manufacturers',
		24 => 'American Motorists Insurance',
		25 => 'American National Insurance',
		26 => 'American Protection Insurance',
		27 => 'American Reliable Ins Co',
		28 => 'American Republic',
		29 => 'American Service Insurance',
		30 => 'American Skyline Insurance Company',
		31 => 'American Spirit Insurance',
		32 => 'American Standard Insurance - OH',
		33 => 'American Standard Insurance - WI',
		34 => 'Amex Assurance Co',
		35 => 'Amica Insurance',
		36 => 'Associated Indemnity',
		37 => 'Atlanta Casualty',
		38 => 'Atlantic Indemnity',
		39 => 'Auto Club Insurance Company',
		40 => 'Brooke Insurance',
		41 => 'Cal Farm Insurance',
		42 => 'California Automobile Ins Co',
		43 => 'California Casualty and Fire Ins Co',
		44 => 'California State Auto Assoc',
		45 => 'Century National Ins',
		46 => 'Chubb Group of Ins Co',
		47 => 'Clarendon National Insurance',
		48 => 'CNA',
		49 => 'Colonial Penn',
		50 => 'Commerce West',
		51 => 'Commercial Union',
		52 => 'Continental Casualty',
		53 => 'Continental Divide Insurance',
		54 => 'Continental Insurance',
		55 => 'Cotton States Insurance',
		56 => 'Country Financial',
		57 => 'Countrywide Insurance',
		58 => 'Dairyland Insurance',
		59 => 'Eagle Ins Co',
		60 => 'Electric Insurance',
		61 => 'Empire Fire and Marine',
		62 => 'Erie Insurance Company',
		63 => 'Esurance',
		64 => 'Explorer',
		65 => 'Farm Bureau/Farm Family/Rural',
		66 => 'Farmers Insurance',
		67 => 'Farmers Union',
		68 => 'Federal Ins Co',
		69 => 'Financial Indemnity',
		70 => 'Fire and Casualty Insurance Co of CT',
		71 => 'Firemans Fund',
		72 => 'Geico Casualty',
		73 => 'General Accident Insurance',
		74 => 'GMAC Insurance',
		75 => 'Great American Ins Co',
		76 => 'Guaranty National Insurance',
		77 => 'Guide One Insurance',
		78 => 'Hanover Lloyds Insurance Company',
		79 => 'Hartford Accident and Indemnity',
		80 => 'High Point Insurance',
		81 => 'IFA Auto Insurance',
		82 => 'Infinity Insurance',
		83 => 'Integon',
		84 => 'Insurance Co of the West',
		85 => 'Kemper Insurance',
		86 => 'Leader National',
		87 => 'Liberty Insurance Corp',
		88 => 'Liberty Mutual Insurance',
		89 => 'Liberty Northwest Insurance',
		90 => 'Lumbermens Mutual',
		91 => 'Maryland Casualty',
		92 => 'Mercury',
		93 => 'MetLife Auto and Home',
		94 => 'Mid Century Insurance',
		95 => 'Mid-Continent Casualty',
		96 => 'Middlesex Insurance',
		97 => 'Mutual of Omaha',
		98 => 'National Ben Franklin Insurance',
		99 => 'National Casualty',
		100 => 'National Continental Insurance',
		101 => 'National Fire Insurance Company of Hartford',
		102 => 'National Union Fire Insurance of LA',
		103 => 'National Union Fire Insurance of PA',
		104 => 'Nationwide General Insurance',
		105 => 'Northwestern Pacific Indemnity',
		106 => 'NJ Skylands Insurance',
		107 => 'Ohio Casualty',
		108 => 'Omni Insurance',
		109 => 'Orion Auto Ins Co',
		110 => 'Pacific Indemnity',
		111 => 'Pacific Insurance',
		112 => 'Patriot General Insurance',
		113 => 'Peak Property and Casualty Insurance',
		114 => 'PEMCO Insurance',
		115 => 'Progressive',
		116 => 'Prudential Insurance Co.',
		117 => 'Republic Indemnity',
		118 => 'Response Insurance',
		119 => 'SAFECO',
		120 => 'Safeway Insurance',
		121 => 'Selective InsGroup',
		122 => 'Sentinel Insurance',
		123 => 'Sentry Insurance Group',
		124 => 'Shelter Insurance Co.',
		125 => 'St. Paul',
		126 => 'Standard Fire Insurance Company',
		127 => 'State and County Mutual Fire Insurance',
		128 => 'State Auto Ins Co',
		129 => 'State Farm County',
		130 => 'State National Insurance',
		131 => 'Superior Guaranty Insurance',
		132 => 'Superior Insurance',
		133 => 'TICO Insurance',
		134 => 'TIG Insurance Group',
		135 => 'Titan',
		136 => 'Travelers Insurance Company',
		137 => 'Tri-State Consumer Insurance',
		138 => 'Unigard Ins',
		139 => 'United Services Automobile Association',
		140 => 'Unitrin Direct',
		141 => 'USAA',
		142 => 'USF and G',
		143 => 'Wawanesa Mutual',
		144 => 'Workmens Auto Insurance',
		145 => 'Zurich Ins Group',
		146 => 'Not Currently Insured',
	];
	public static $ContinuouslyInsuredPeriod = [
		1 => 'Less than 6 Months',
		2 => '6 Months to 1 Year',
		3 => '1 Year',
		4 => '2 Year',
		5 => '3 Year',
		6 => '4 Year',
		7 => '5 Year',
		8 => '6+ Year',
	];
	private function __construct() {}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0)
	{
		$promo_code = Yii::app()->request->getParam('promo_code');
		if ($promo_code != 80) {
			$p1 = $p1 ? $p1 : '35377425b4990cd0e42178bc38c858c9594d6d6af6fcb748213f5307d0b53da2';
			$p2 = $p2 ? $p2 : 'EMAUTO';
			$p3 = $p3 ? $p3 : '36';
			
			$submission_model = new Submissions();
			$zip = Yii::app()->request->getParam('zip');
			$city_state = $submission_model->getCityStateFromZip($zip);

			$parking = ['Driveway', 'Private Garage', 'Parking Garage', 'Parking Lot', 'Street'];
			$park_key = array_rand($parking);
			$Collision_Coverage = ['No Coverage', 'No Deductible'];
			$CC_key = array_rand($Collision_Coverage);
			$Comprehensive_Coverage = ['No Coverage', 'No Deductible'];
			$CCC_key = array_rand($Comprehensive_Coverage);
		
			$pastdate = Yii::app()->request->getParam('insurance_expiration_date');
			$insurance_expiration_date_gap = round((time() - strtotime($pastdate)) / 86400);
			$is_policy_expired = $insurance_expiration_date_gap > 30 ? 'Yes' : 'No';
			$policy_start_date = date('m/d/Y', strtotime(Yii::app()->request->getParam('insurance_start_date', (time() - (rand(360, 370) * 86400)))));
			$policy_expiry_date = date('m/d/Y', strtotime(Yii::app()->request->getParam('insurance_expiration_date', (time() + (rand(30, 39) * 86400)))));

			$driver1_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident1_date', time())));
			$driver1_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident2_date', time())));
			$driver2_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident1_date', time())));
			$driver2_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident2_date', time())));
			
			$fields = [
				'Request' => [
					//'Test_Lead' => '1',
					'Key' => $p1,
					'API_Action' => 'pingPostLead',
					'Mode' => 'ping',
					'TYPE' => $p3,
					'Return_Best_Price' => '1',
					'IP_Address' => Yii::app()->request->getParam('ipaddress'),
					'SRC' => $p2,
					'Landing_Page' =>  Yii::app()->request->getParam('url', 'https://eliteinsurers.com'),
					'Sub_ID' => Yii::app()->request->getParam('sub_id'),
					'Pub_ID' => Yii::app()->request->getParam('promo_code'),
					'Origination_Datetime' => date('m/d/Y H:i:s'),
					'Origination_Timezone' => 'EST / EDT',
					'Unique_Identifier' => Yii::app()->session['affiliate_trans_id'],
					'User_Agent' =>Yii::app()->request->getParam('user_agent', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15'),
					'TCPA_Consent' => Yii::app()->request->getParam('tcpa_optin') == '1' ? 'Yes' : 'No',
					'TCPA_Language' => Yii::app()->request->getParam('tcpa_text', 'By submitting this form'),
					'leadid_token' => Yii::app()->request->getParam('universal_leadid'),
					'Trusted_Form_URL' => Yii::app()->request->getParam('trustedformcerturl'),
					'Driver_1_City' => $city_state['city'],
					'Driver_1_State' => $city_state['state'],
					'Driver_1_Zip' => Yii::app()->request->getParam('zip'),
					'Vehicle_1_Year' => Yii::app()->request->getParam('vehicle1_year'),
					'Vehicle_1_Make' => Yii::app()->request->getParam('vehicle1_make'),
					'Vehicle_1_Model' => Yii::app()->request->getParam('vehicle1_model'),
					'Vehicle_1_Sub_Model' => Yii::app()->request->getParam('vehicle1_submodel', 'No Trim'),
					'Vehicle_1_Vin' => str_replace('****', '', Yii::app()->request->getParam('vehicle1_vin', '1ACBC535B')),
					'Vehicle_1_Ownership' => Yii::app()->request->getParam('vehicle1_vehicle_ownership') == 1 ? 'Owned' : 'Financed',
					'Vehicle_1_Primary_Use' => self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_primary_use', '5')],
					'Vehicle_1_Average_One_Way_Mileage' => self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_daily_mileage', '1')],
					'Vehicle_1_Annual_Mileage' => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage', '1')],
					'Vehicle_1_Security_System' => 'No Alarm',
					'Vehicle_1_Security_System' => $parking[$park_key],
					'Vehicle_1_Average_Days_Per_Week_Used' => '5',
					'Vehicle_1_Coverage_Type' => self::$converageType[Yii::app()->request->getParam('coverage_type', '1')],
					'Vehicle_1_Desired_Collision_Coverage' =>  $Collision_Coverage[$CC_key],
					'Vehicle_1_Desired_Comprehensive_Coverage' => $Comprehensive_Coverage[$CCC_key],
					'Driver_1_Birthdate' => date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_dob'))),
					'Driver_1_Age' => (date('Y') - date('Y', strtotime(Yii::app()->request->getParam('driver1_dob')))),
					'Driver_1_Gender' => Yii::app()->request->getParam('driver1_gender') == 'M' ? 'Male' : 'Female',
					'Driver_1_Marital_Status' => self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status', '2')],
					'Driver_1_Credit_Rating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '2')],
					'Driver_1_License_Status' => 'Active',
					'Driver_1_Licensed_State' => $city_state['state'],
					'Driver_1_Age_When_First_Licensed' => '16',
					'Driver_1_Suspended_Or_Revoked_In_The_Past_5_Years' => 'No',
					'Driver_1_Filing_Required' => 'None',
					'Driver_1_Education' => self::$educationList[Yii::app()->request->getParam('driver1_education', '4')],
					'Driver_1_Occupation' => self::$occupationList[Yii::app()->request->getParam('driver1_occupation', '37')],
					'Driver_1_Current_Residence' => (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own',
					'Driver_1_Years_At_Current_Residence' => Yii::app()->request->getParam('stay_in_year', '4'),
					'Driver_1_Months_At_Current_Residence' =>  Yii::app()->request->getParam('stay_in_month', '3'),
					'Driver_1_Tickets_Accidents_Claims_Past_3_Years' => (Yii::app()->request->getParam('driver1_hasTAVCs') == '0') ? 'No' : 'Yes',
					'Driver_1_Insured_Past_30_Days' => $is_policy_expired,
					'Driver_1_Policy_Expiration_Date' =>  $policy_expiry_date,
					'Driver_1_Insured_Since' => $policy_start_date,
					'Driver_1_Insurance_Company' => self::$insuranceCompanyList[Yii::app()->request->getParam('insurance_company', '1')],
					'Driver_1_Bankruptcy_In_Past_5_Years' => 'No',
					'Driver_1_Additional_Drivers' => 'No',
					'Driver_1_Additional_Vehicles' => 'No',
					'Driver_1_Relationship_To_Applicant' => 'Self',
					'Driver_1_US_Resident_In_The_Past_12_Months' => 'Yes',
					'Driver_1_Reposessions_In_The_Past_5_Years' => 'No',
					'Driver_1_DUI_DWI_In_The_Past_5_Years' => 'No',
					'Driver_1_Incident_Type_1' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident1_description', '6')],
				]
			];
			if ($driver1_incidentDate1 != "") {
				$fields['Request']['Driver_1_Approximate_Date_1'] = $driver1_incidentDate1;
			}
			$driver1 = [
				'Request' => [
					'Driver_1_Damages_1' =>  self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage', '4')],
					'Driver_1_At_Fault_1' => Yii::app()->request->getParam('driver1_accident1_at_fault') == 1 ? 'Yes' : 'No',
					'Driver_1_Insurance_Paid_Amount_1' => Yii::app()->request->getParam('driver1_accident1_amount', '1500'),
					'Driver_1_Incident_Type_2' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident2_description', '6')],
					'Driver_1_Approximate_Date_2' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident2_description', '6')],
					'Driver_1_Damages_2' => self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage', '4')],
					'Driver_1_At_Fault_2' =>Yii::app()->request->getParam('driver1_accident2_at_fault') == 1 ? 'Yes' : 'No',
					'Driver_1_Insurance_Paid_Amount_2' =>  Yii::app()->request->getParam('driver1_accident2_amount', '1500'),
				]
			];
			if (Yii::app()->request->getParam('vehicle2_year')) {
				$vehicle2 = [
					'Request' => [
						'Vehicle_2_Year' =>  self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage', '4')],
						'Vehicle_2_Make' => Yii::app()->request->getParam('vehicle2_make'),
						'Vehicle_2_Model' => Yii::app()->request->getParam('vehicle2_model'),
						'Vehicle_2_Sub_Model' => Yii::app()->request->getParam('vehicle2_submodel'),
						'Vehicle_2_Vin' => str_replace('****', '', Yii::app()->request->getParam('vehicle2_vin', '1ACBC535B')),
						'Vehicle_2_Ownership' =>  Yii::app()->request->getParam('vehicle2_vehicle_ownership') == 1 ? 'Owned' : 'Financed',
						'Vehicle_2_Primary_Use' => self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use')],
						'Vehicle_2_Average_One_Way_Mileage' => self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use')],
						'Vehicle_2_Annual_Mileage' => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_annual_mileage')],
						'Vehicle_2_Security_System' => 'No Alarm',
						'Vehicle_2_Parking' => $parking[$park_key],
						'Vehicle_2_Average_Days_Per_Week_Used' => ['20', '22'][date('N') % 2],
						'Vehicle_2_Average_Days_Per_Week_Used' => range(5, 15)[date('g')],
						'Vehicle_2_Desired_Collision_Coverage' => $Collision_Coverage[$CC_key],
						'Vehicle_2_Desired_Comprehensive_Coverage' => $Comprehensive_Coverage[$CCC_key],
					]
				];
			}
			if ($driver1_incidentDate2 != "") {
				$fields['Request']['Driver_1_Approximate_Date_2'] = $driver1_incidentDate2;
			}
			if (Yii::app()->request->getParam('driver2_gender')) {
				$driver2_education = Yii::app()->request->getParam('driver2_education', '1');
				$driver2_education -= $driver2_education;
				$driver2 = [
					'Request' => [
						'Driver_2_Birthdate' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob', time()))),
						'Driver_2_Age' => (date('Y') - date('Y', strtotime(Yii::app()->request->getParam('driver2_dob')))),
						'Driver_2_Gender' => (Yii::app()->request->getParam('driver2_gender') == 'M') ? '1' : '2',
						'Driver_2_Relationship_To_Applicant' => 'Spouse',
						'Driver_2_Marital_Status' => Yii::app()->request->getParam('driver2_marital_status', '1') == '1' ? 'Single' : 'Married',
						'Driver_2_Credit_Rating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '2')],
						'Driver_2_License_Status' => 'Active',
						'Driver_2_Licensed_State' => $city_state['state'],
						'Driver_2_Age_When_First_Licensed' => ['16', '17'][date('N') % 2],
						'Driver_2_Suspended_Or_Revoked_In_The_Past_5_Years' => 'No',
						'Driver_2_Filing_Required' => 'None',
						'Driver_2_Education' => self::$educationList[Yii::app()->request->getParam('driver2_education', '4')],
						'Driver_2_Occupation' => self::$occupationList[Yii::app()->request->getParam('driver2_occupation', '37')],
						'Driver_2_Current_Residence' => Yii::app()->request->getParam('is_rented') == 'rent' ? 'Rent' : 'Own',
						'Driver_2_Years_At_Current_Residence' => Yii::app()->request->getParam('stay_in_year', '4'),
						'Driver_2_Months_At_Current_Residence' => Yii::app()->request->getParam('stay_in_month', '3'),
						'Driver_2_Tickets_Accidents_Claims_Past_3_Years' => Yii::app()->request->getParam('driver2_hasTAVCs') == '0' ? 'No' : 'Yes',
						'Driver_2_Insured_Past_30_Days' => $is_policy_expired,
						'Driver_2_Bankruptcy_In_Past_5_Years' => 'No',
						'Driver_2_US_Resident_In_The_Past_12_Months' => 'Yes',
						'Driver_2_Reposessions_In_The_Past_5_Years' => 'No',
						'Driver_2_Policy_Expiration_Date' => $policy_expiry_date,
						'Driver_2_Insurance_Company' => self::$insuranceCompanyList[Yii::app()->request->getParam('insurance_company', '1')],
						'Driver_2_Incident_Type_1' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident1_description', '6')]
					]
				];
				if ($driver2_incidentDate1 != "") {
					$driver2['Request']['Driver_2_Approximate_Date_1'] = $driver1_incidentDate2;
				}
				$driver2Extra = [
					'Request' => [
						'Driver_2_Damages_1' => self::$AccidentDamage[Yii::app()->request->getParam('driver2_accident1_damage', '4')],
						'Driver_2_At_Fault_1' => Yii::app()->request->getParam('driver2_accident1_at_fault') == 1 ? 'Yes' : 'No',
						'Driver_2_Insurance_Paid_Amount_1' => Yii::app()->request->getParam('driver2_accident1_amount', 2000),
						'Driver_2_Incident_Type_2' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident2_description', '6')],
						'Driver_2_Damages_2' => Yii::app()->request->getParam('driver2_accident2_at_fault') == 1 ? 'Yes' : 'No',
						'Driver_2_Insurance_Paid_Amount_2' => Yii::app()->request->getParam('driver2_accident2_amount', '1500'),
					]
				];
				if ($driver2_incidentDate2 != "") {
					$driver2['Request']['Driver_2_Approximate_Date_2'] = $driver2_incidentDate2;
				}
				$driver2['Request'] += $driver2Extra['Request'];
			}
			$fields['Request'] += $driver1['Request'];
			$fields['Request'] += $vehicle2['Request'];
			$fields['Request'] += $driver2['Request'];
			$purchase = true;
			if ($purchase == true) {
				$pingData['ping_request'] = json_encode($fields);
				$pingData['header'] = ["Content-Type: application/json"];
			} else {
				$pingData['ping_request'] = false;
			}
			return $pingData;
		}
	}

	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response)
	{
		preg_match("/<status>(.*)<\/status>/msui", $ping_response, $result);
		if (trim($result[1]) == 'Matched' || trim($result[0]) == 'Matched') {
			preg_match("/<price>(.*)<\/price>/msui", $ping_response, $price);
			preg_match("/<lead_id>(.*)<\/lead_id>/msui", $ping_response, $confirmation_id);
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
	public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status)
	{
		preg_match("/<lead_id>(.*)<\/lead_id>/msui", $ping_response, $confirmation_id);
		$p1 = $p1 ? $p1 : '35377425b4990cd0e42178bc38c858c9594d6d6af6fcb748213f5307d0b53da2';
		$p2 = $p2 ? $p2 : 'EMAUTO';
		$p3 = $p3 ? $p3 : '36';
		$submission_model = new Submissions();
		$zip = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip);

		$parking = ['Driveway', 'Private Garage', 'Parking Garage', 'Parking Lot', 'Street'];
		$park_key = array_rand($parking);
		$Collision_Coverage = ['No Coverage', 'No Deductible'];
		$CC_key = array_rand($Collision_Coverage);
		$Comprehensive_Coverage = ['No Coverage', 'No Deductible'];
		$CCC_key = array_rand($Comprehensive_Coverage);
		$pastdate = Yii::app()->request->getParam('insurance_expiration_date');
		$insurance_expiration_date_gap = round((time() - strtotime($pastdate)) / 86400);
		$is_policy_expired = $insurance_expiration_date_gap > 30 ? 'Yes' : 'No';
		$policy_start_date = date('m/d/Y', strtotime(Yii::app()->request->getParam('insurance_start_date', (time() - (rand(360, 370) * 86400)))));
		$policy_expiry_date = date('m/d/Y', strtotime(Yii::app()->request->getParam('insurance_expiration_date', (time() + (rand(30, 39) * 86400)))));
	
		$vehicle1_vehicle_ownership = Yii::app()->request->getParam('vehicle1_vehicle_ownership');
		$vehicle2_vehicle_ownership = Yii::app()->request->getParam('vehicle2_vehicle_ownership');
		$vehicle1_vehicle_ownership = $vehicle1_vehicle_ownership == 1 ? 'Owned' : 'Financed';
		$vehicle2_vehicle_ownership = $vehicle2_vehicle_ownership == 1 ? 'Owned' : 'Financed';

		$driver1_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident1_date', time())));
		$driver1_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident2_date', time())));
		$driver2_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident1_date', time())));
		$driver2_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident2_date', time())));

		$fields = [
			'Request' => [
				//'Test_Lead' => '1',
				'Lead_ID' => $confirmation_id[1],
				'Key' => $p1,
				'API_Action' => 'pingPostLead',
				'Mode' => 'post',
				'TYPE' => $p3,
				'Return_Best_Price' => '1',
				'IP_Address' => Yii::app()->request->getParam('ipaddress'),
				'SRC' => $p2,
				'Landing_Page' =>  Yii::app()->request->getParam('url', 'https://eliteinsurers.com'),
				'Sub_ID' => Yii::app()->request->getParam('sub_id'),
				'Pub_ID' => Yii::app()->request->getParam('promo_code'),
				'Origination_Datetime' => date('m/d/Y H:i:s'),
				'Origination_Timezone' => 'EST / EDT',
				'Unique_Identifier' => Yii::app()->session['affiliate_trans_id'],
				'User_Agent' => Yii::app()->request->getParam('user_agent', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15'),
				'TCPA_Consent' => Yii::app()->request->getParam('tcpa_optin') == '1' ? 'Yes' : 'No',
				'TCPA_Language' => Yii::app()->request->getParam('tcpa_text', 'By submitting this form'),
				'leadid_token' => Yii::app()->request->getParam('universal_leadid'),
				'Trusted_Form_URL' => Yii::app()->request->getParam('trustedformcerturl'),
				'Driver_1_First_Name' => Yii::app()->request->getParam('driver1_first_name'),
				'Driver_1_Last_Name' => Yii::app()->request->getParam('driver1_last_name'),
				'Driver_1_Address' => Yii::app()->request->getParam('address'),
				'Driver_1_Daytime_Phone' => Yii::app()->request->getParam('phone'),
				'Driver_1_Evening_Phone' => Yii::app()->request->getParam('phone'),
				'Driver_1_Cell_Phone' => Yii::app()->request->getParam('phone2'),
				'Driver_1_Email' => Yii::app()->request->getParam('email'),
				'Driver_1_City' => $city_state['city'],
				'Driver_1_State' => $city_state['state'],
				'Driver_1_Zip' => Yii::app()->request->getParam('zip'),
				'Vehicle_1_Year' => Yii::app()->request->getParam('vehicle1_year'),
				'Vehicle_1_Make' => Yii::app()->request->getParam('vehicle1_make'),
				'Vehicle_1_Model' => Yii::app()->request->getParam('vehicle1_model'),
				'Vehicle_1_Sub_Model' => Yii::app()->request->getParam('vehicle1_submodel', 'No Trim'),
				'Vehicle_1_Vin' =>  str_replace('****', '', Yii::app()->request->getParam('vehicle1_vin', '1ACBC535B')),
				'Vehicle_1_Ownership' => Yii::app()->request->getParam('vehicle1_year'),
				'Vehicle_1_Primary_Use' => self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_primary_use', '5')],
				'Vehicle_1_Average_One_Way_Mileage' => self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_daily_mileage', '1')],
				'Vehicle_1_Annual_Mileage' => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage', '1')],
				'Vehicle_1_Security_System' => 'No Alarm',
				'Vehicle_1_Security_System' => $parking[$park_key],
				'Vehicle_1_Average_Days_Per_Week_Used' => '5',
				'Vehicle_1_Coverage_Type' => self::$converageType[Yii::app()->request->getParam('coverage_type', '1')],
				'Vehicle_1_Desired_Collision_Coverage' =>  $Collision_Coverage[$CC_key],
				'Vehicle_1_Desired_Comprehensive_Coverage' => $Comprehensive_Coverage[$CCC_key],
				'Driver_1_Birthdate' => date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_dob'))),
				'Driver_1_Age' => $age,
				'Driver_1_Gender' => Yii::app()->request->getParam('driver1_gender') == 'M' ? 'Male' : 'Female',
				'Driver_1_Marital_Status' => self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status', '2')],
				'Driver_1_Credit_Rating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '2')],
				'Driver_1_License_Status' => 'Active',
				'Driver_1_Licensed_State' => $city_state['state'],
				'Driver_1_Age_When_First_Licensed' => '16',
				'Driver_1_Suspended_Or_Revoked_In_The_Past_5_Years' => 'No',
				'Driver_1_Filing_Required' => 'None',
				'Driver_1_Education' => self::$educationList[Yii::app()->request->getParam('driver1_education', '4')],
				'Driver_1_Occupation' => self::$occupationList[Yii::app()->request->getParam('driver1_occupation', '37')],
				'Driver_1_Current_Residence' => (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own',
				'Driver_1_Years_At_Current_Residence' => Yii::app()->request->getParam('stay_in_year', '4'),
				'Driver_1_Months_At_Current_Residence' =>  Yii::app()->request->getParam('stay_in_month', '3'),
				'Driver_1_Tickets_Accidents_Claims_Past_3_Years' => (Yii::app()->request->getParam('driver1_hasTAVCs') == '0') ? 'No' : 'Yes',
				'Driver_1_Insured_Past_30_Days' => $is_policy_expired,
				'Driver_1_Policy_Expiration_Date' =>  $policy_expiry_date,
				'Driver_1_Insured_Since' => $policy_start_date,
				'Driver_1_Insurance_Company' => self::$insuranceCompanyList[Yii::app()->request->getParam('insurance_company', '1')],
				'Driver_1_Bankruptcy_In_Past_5_Years' => 'No',
				'Driver_1_Additional_Drivers' => 'No',
				'Driver_1_Additional_Vehicles' => 'No',
				'Driver_1_Relationship_To_Applicant' => 'Self',
				'Driver_1_US_Resident_In_The_Past_12_Months' => 'Yes',
				'Driver_1_Reposessions_In_The_Past_5_Years' => 'No',
				'Driver_1_DUI_DWI_In_The_Past_5_Years' => 'No',
				'Driver_1_Incident_Type_1' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident1_description', '6')],
			]
		];
		if ($driver1_incidentDate1 != "") {
			$fields['Request']['Driver_1_Approximate_Date_1'] = $driver1_incidentDate1;
		}
		$driver1 = [
			'Request' => [
				'Driver_1_Damages_1' =>  self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage', '4')],
				'Driver_1_At_Fault_1' => Yii::app()->request->getParam('driver1_accident1_at_fault') == 1 ? 'Yes' : 'No',
				'Driver_1_Insurance_Paid_Amount_1' => Yii::app()->request->getParam('driver1_accident1_amount', '1500'),
				'Driver_1_Incident_Type_2' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident2_description', '6')],
				'Driver_1_Approximate_Date_2' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident2_description', '6')],
				'Driver_1_Damages_2' => self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage', '4')],
				'Driver_1_At_Fault_2' => Yii::app()->request->getParam('driver1_accident2_at_fault') == 1 ? 'Yes' : 'No',
				'Driver_1_Insurance_Paid_Amount_2' =>  Yii::app()->request->getParam('driver1_accident2_amount', '1500'),
			]
		];
		if (Yii::app()->request->getParam('vehicle2_year')) {
			$vehicle2 = [
				'Request' => [
					'Vehicle_2_Year' =>  self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage', '4')],
					'Vehicle_2_Make' => Yii::app()->request->getParam('vehicle2_make'),
					'Vehicle_2_Model' => Yii::app()->request->getParam('vehicle2_model'),
					'Vehicle_2_Sub_Model' => Yii::app()->request->getParam('vehicle2_submodel'),
					'Vehicle_2_Vin' => str_replace('****', '', Yii::app()->request->getParam('vehicle2_vin', '1ACBC535B')),
					'Vehicle_2_Ownership' => $vehicle2_vehicle_ownership,
					'Vehicle_2_Primary_Use' => self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use')],
					'Vehicle_2_Average_One_Way_Mileage' => self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use')],
					'Vehicle_2_Annual_Mileage' => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_annual_mileage')],
					'Vehicle_2_Security_System' => 'No Alarm',
					'Vehicle_2_Parking' => $parking[$park_key],
					'Vehicle_2_Average_Days_Per_Week_Used' => ['20', '22'][date('N') % 2],
					'Vehicle_2_Average_Days_Per_Week_Used' => range(5, 15)[date('g')],
					'Vehicle_2_Desired_Collision_Coverage' => $Collision_Coverage[$CC_key],
					'Vehicle_2_Desired_Comprehensive_Coverage' => $Comprehensive_Coverage[$CCC_key],
				]
			];
		}
		if ($driver1_incidentDate2 != "") {
			$fields['Request']['Driver_1_Approximate_Date_2'] = $driver1_incidentDate2;
		}
		if (Yii::app()->request->getParam('driver2_gender')) {
			$driver2_education = Yii::app()->request->getParam('driver2_education', '1');
			$driver2_education -= $driver2_education;
			$driver2 = [
				'Request' => [
					'Driver_2_Birthdate' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob', time()))),
					'Driver_2_Age' => (date('Y') - date('Y', strtotime(Yii::app()->request->getParam('driver2_dob', time())))),
					'Driver_2_Gender' => (Yii::app()->request->getParam('driver2_gender') == 'M') ? '1' : '2',
					'Driver_2_Relationship_To_Applicant' => 'Spouse',
					'Driver_2_Marital_Status' => Yii::app()->request->getParam('driver2_marital_status', '1') == '1' ? 'Single' : 'Married',
					'Driver_2_Credit_Rating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '2')],
					'Driver_2_License_Status' => 'Active',
					'Driver_2_Licensed_State' => $city_state['state'],
					'Driver_2_Age_When_First_Licensed' => ['16', '17'][date('N') % 2],
					'Driver_2_Suspended_Or_Revoked_In_The_Past_5_Years' => 'No',
					'Driver_2_Filing_Required' => 'None',
					'Driver_2_Education' => self::$educationList[Yii::app()->request->getParam('driver2_education', '4')],
					'Driver_2_Occupation' => self::$occupationList[Yii::app()->request->getParam('driver2_occupation', '37')],
					'Driver_2_Current_Residence' => Yii::app()->request->getParam('is_rented') == 'rent' ? 'Rent' : 'Own',
					'Driver_2_Years_At_Current_Residence' => Yii::app()->request->getParam('stay_in_year', '4'),
					'Driver_2_Months_At_Current_Residence' => Yii::app()->request->getParam('stay_in_month', '3'),
					'Driver_2_Tickets_Accidents_Claims_Past_3_Years' => Yii::app()->request->getParam('driver2_hasTAVCs') == '0' ? 'No' : 'Yes',
					'Driver_2_Insured_Past_30_Days' => $is_policy_expired,
					'Driver_2_Bankruptcy_In_Past_5_Years' => 'No',
					'Driver_2_US_Resident_In_The_Past_12_Months' => 'Yes',
					'Driver_2_Reposessions_In_The_Past_5_Years' => 'No',
					'Driver_2_Policy_Expiration_Date' => $policy_expiry_date,
					'Driver_2_Insurance_Company' => self::$insuranceCompanyList[Yii::app()->request->getParam('insurance_company', '1')],
					'Driver_2_Incident_Type_1' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident1_description', '6')]
				]
			];
			if ($driver2_incidentDate1 != "") {
				$driver2['Request']['Driver_2_Approximate_Date_1'] = $driver1_incidentDate2;
			}
			$driver2Extra = [
				'Request' => [
					'Driver_2_Damages_1' => self::$AccidentDamage[Yii::app()->request->getParam('driver2_accident1_damage', '4')],
					'Driver_2_At_Fault_1' => Yii::app()->request->getParam('driver2_accident1_at_fault') == 1 ? 'Yes' : 'No',
					'Driver_2_Insurance_Paid_Amount_1' => Yii::app()->request->getParam('driver2_accident1_amount', 2000),
					'Driver_2_Incident_Type_2' => self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident2_description', '6')],
					'Driver_2_Damages_2' => Yii::app()->request->getParam('driver2_accident2_at_fault') == 1 ? 'Yes' : 'No',
					'Driver_2_Insurance_Paid_Amount_2' => Yii::app()->request->getParam('driver2_accident2_amount', '1500'),
				]
			];
			if ($driver2_incidentDate2 != "") {
				$driver2['Request']['Driver_2_Approximate_Date_2'] = $driver2_incidentDate2;
			}
			$driver2['Request'] += $driver2Extra['Request'];
		}
		$fields['Request'] += $driver1['Request'];
		$fields['Request'] += $vehicle2['Request'];
		$fields['Request'] += $driver2['Request'];
		//echo '<pre>';print_r($fields);exit;
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_response = $cm->curl($post_url, json_encode($fields));
		$time_end = CommonToolsMethods::stopwatch();
		//echo '<pre>';print_r($ping_response);die();
		preg_match("/<status>(.*)<\/status>/", $post_response, $success);
		//echo '<pre>';print_r();die();
		if (trim($success[1]) == 'Matched') {
			$post_status = '1';
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