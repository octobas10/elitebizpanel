<?php
class SunshineController extends Controller {
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
    public static $vehicleAnnualMileage = array (
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
    public static $vehicleDailyMileage = array (
            1 => '3',
            2 => '5',
            3 => '9',
            4 => '20',
            5 => '50',
            6 => '100'
        );
    public static $maritialStatus = array (
            1 => 'Single',
            2 => 'Married',
            3 => 'Separated',
            4 => 'Divorced',
            5 => 'Married',
            6 => 'Widowed'
        );
    public static $creditRating = array (
            1 => 'Excellent',
            2 => 'Good',
            3 => 'Average',
            4 => 'Poor',
    );
    public static $educationList = array (
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
	public static $driverAccidentDescription = array (
            1 => 'Vehicle Hit Vehicle',
            2 => 'Vehicle Hit Pedestrian',
            3 => 'Vehicle Hit Property',
            4 => 'Vehicle Damaged Avoiding Accident',
            5 => 'At Fault Accident Not Listed',
            6 => 'Loss Claim Not Listed'
    );
    public static $AccidentDamage = array (
            1 => 'People',
            2 => 'Property',
            3 => 'Both',
            4 => 'Not Applicable',
    );
    public static $occupationList = [
    	1=>'Advertising',
		2=>'Arts/Entertainment',
		3=>'Banking/Mortgage',
		4=>'Clerical/Administrative',
		5=>'Clergy/Religious',
		6=>'Construction/Facilities',
		7=>'Customer Service',
		8=>'Disabled',
		9=>'Education/Training',
		10=>'Engineer/Architect',
		11=>'Government',
		12=>'Health Care',
		13=>'Homemaker',
		14=>'Hospitality/Travel',
		15=>'Human Resources',
		16=>'Insurance',
		17=>'Internet/New Media',
		18=>'Law Enforcement',
		19=>'Legal',
		20=>'Management Consulting',
		21=>'Manufacturing',
		22=>'Marketing',
		23=>'Military/Defense',
		24=>'Non-Profit/Volunteer',
		25=>'Pharmaceutical/Biotech',
		26=>'Real Estate',
		27=>'Restaurant/Food Service',
		28=>'Retail',
		29=>'Retired',
		30=>'Sales',
		31=>'Self Employed',
		32=>'Student',
		33=>'Technology',
		34=>'Telecommunications',
		35=>'Transportation',
		36=>'Unemployed',
		];

	public static $insuranceCompanyList = [
		1=>'Company Not Listed',
		2=>'21st Century Insurance',
		3=>'AAA Insurance Co.',
		4=>'AIG',
		5=>'AIU Insurance',
		6=>'Alfa',
		7=>'Allied',
		8=>'Allstate Insurance',
		9=>'Amco Ins Co',
		10=>'American Alliance Ins Co',
		11=>'American Automobile Insurance',
		12=>'American Casualty',
		13=>'American Direct Business Insurance',
		14=>'American Economy Ins Co',
		15=>'American Empire Insurance',
		16=>'American Family Insurance',
		17=>'American Financial',
		18=>'American Home Assurance',
		19=>'American Insurance',
		20=>'American International Ins',
		21=>'American International Pacific',
		22=>'American International South',
		23=>'American Manufacturers',
		24=>'American Motorists Insurance',
		25=>'American National Insurance',
		26=>'American Protection Insurance',
		27=>'American Reliable Ins Co',
		28=>'American Republic',
		29=>'American Service Insurance',
		30=>'American Skyline Insurance Company',
		31=>'American Spirit Insurance',
		32=>'American Standard Insurance - OH',
		33=>'American Standard Insurance - WI',
		34=>'Amex Assurance Co',
		35=>'Amica Insurance',
		36=>'Associated Indemnity',
		37=>'Atlanta Casualty',
		38=>'Atlantic Indemnity',
		39=>'Auto Club Insurance Company',
		40=>'Brooke Insurance',
		41=>'Cal Farm Insurance',
		42=>'California Automobile Ins Co',
		43=>'California Casualty and Fire Ins Co',
		44=>'California State Auto Assoc',
		45=>'Century National Ins',
		46=>'Chubb Group of Ins Co',
		47=>'Clarendon National Insurance',
		48=>'CNA',
		49=>'Colonial Penn',
		50=>'Commerce West',
		51=>'Commercial Union',
		52=>'Continental Casualty',
		53=>'Continental Divide Insurance',
		54=>'Continental Insurance',
		55=>'Cotton States Insurance',
		56=>'Country Financial',
		57=>'Countrywide Insurance',
		58=>'Dairyland Insurance',
		59=>'Eagle Ins Co',
		60=>'Electric Insurance',
		61=>'Empire Fire and Marine',
		62=>'Erie Insurance Company',
		63=>'Esurance',
		64=>'Explorer',
		65=>'Farm Bureau/Farm Family/Rural',
		66=>'Farmers Insurance',
		67=>'Farmers Union',
		68=>'Federal Ins Co',
		69=>'Financial Indemnity',
		70=>'Fire and Casualty Insurance Co of CT',
		71=>'Firemans Fund',
		72=>'Geico Casualty',
		73=>'General Accident Insurance',
		74=>'GMAC Insurance',
		75=>'Great American Ins Co',
		76=>'Guaranty National Insurance',
		77=>'Guide One Insurance',
		78=>'Hanover Lloyds Insurance Company',
		79=>'Hartford Accident and Indemnity',
		80=>'High Point Insurance',
		81=>'IFA Auto Insurance',
		82=>'Infinity Insurance',
		83=>'Integon',
		84=>'Insurance Co of the West',
		85=>'Kemper Insurance',
		86=>'Leader National',
		87=>'Liberty Insurance Corp',
		88=>'Liberty Mutual Insurance',
		89=>'Liberty Northwest Insurance',
		90=>'Lumbermens Mutual',
		91=>'Maryland Casualty',
		92=>'Mercury',
		93=>'MetLife Auto and Home',
		94=>'Mid Century Insurance',
		95=>'Mid-Continent Casualty',
		96=>'Middlesex Insurance',
		97=>'Mutual of Omaha',
		98=>'National Ben Franklin Insurance',
		99=>'National Casualty',
		100=>'National Continental Insurance',
		101=>'National Fire Insurance Company of Hartford',
		102=>'National Union Fire Insurance of LA',
		103=>'National Union Fire Insurance of PA',
		104=>'Nationwide General Insurance',
		105=>'Northwestern Pacific Indemnity',
		106=>'NJ Skylands Insurance',
		107=>'Ohio Casualty',
		108=>'Omni Insurance',
		109=>'Orion Auto Ins Co',
		110=>'Pacific Indemnity',
		111=>'Pacific Insurance',
		112=>'Patriot General Insurance',
		113=>'Peak Property and Casualty Insurance',
		114=>'PEMCO Insurance',
		115=>'Progressive',
		116=>'Prudential Insurance Co.',
		117=>'Republic Indemnity',
		118=>'Response Insurance',
		119=>'SAFECO',
		120=>'Safeway Insurance',
		121=>'Selective InsGroup',
		122=>'Sentinel Insurance',
		123=>'Sentry Insurance Group',
		124=>'Shelter Insurance Co.',
		125=>'St. Paul',
		126=>'Standard Fire Insurance Company',
		127=>'State and County Mutual Fire Insurance',
		128=>'State Auto Ins Co',
		129=>'State Farm County',
		130=>'State National Insurance',
		131=>'Superior Guaranty Insurance',
		132=>'Superior Insurance',
		133=>'TICO Insurance',
		134=>'TIG Insurance Group',
		135=>'Titan',
		136=>'Travelers Insurance Company',
		137=>'Tri-State Consumer Insurance',
		138=>'Unigard Ins',
		139=>'United Services Automobile Association',
		140=>'Unitrin Direct',
		141=>'USAA',
		142=>'USF and G',
		143=>'Wawanesa Mutual',
		144=>'Workmens Auto Insurance',
		145=>'Zurich Ins Group',
		146=>'Not Currently Insured',
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
    private function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $pingData = array();
        $p1 = $p1 ? $p1 : '35377425b4990cd0e42178bc38c858c9594d6d6af6fcb748213f5307d0b53da2';
        $p2 = $p2 ? $p2 : 'EMAUTO';
        $p3 = $p3 ? $p3 : '36';
		$IPAddress = Yii::app()->request->getParam('ipaddress');
		$user_agent = Yii::app()->request->getParam('user_agent','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15');
		$LeadDateTime = date('Y-m-d H:i:s');
		$Unique_identifier = Yii::app()->session['affiliate_trans_id'];
		$TCPAOptin = Yii::app()->request->getParam('tcpa_optin')=='1' ? 'Yes' : 'No';
		$TCPAText = Yii::app()->request->getParam('tcpa_text','By submitting this form');
		$TCPAText = str_replace(['&','"'],['',''],$TCPAText);
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
		$continuously_insured_period = self::$ContinuouslyInsuredPeriod[$continuously_insured_period];

		
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
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        
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
        $policy_expiry_date = date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_expiration_date',(time()+(rand(30,39)*86400)))));
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
		$vehicle1_vin = Yii::app()->request->getParam('vehicle1_vin','1ACBC535B');
		$vehicle1_vin = str_replace('****','',$vehicle1_vin);
		$vehicle2_vin = Yii::app()->request->getParam('vehicle2_vin','1ACBC535B');
		$vehicle2_vin = str_replace('****','',$vehicle2_vin);
		$request ='<?xml version="1.0" encoding="utf-8"?>
			<Request>
			<Key>'.$p1.'</Key>
			<API_Action>pingPostLead</API_Action>
			<Mode>ping</Mode>
			<TYPE>'.$p3.'</TYPE>
			<Return_Best_Price>1</Return_Best_Price>
			<IP_Address>'.$IPAddress.'</IP_Address>
			<SRC>'.$p2.'</SRC>
			<Landing_Page>'.$url.'</Landing_Page>
			<Sub_ID>'.$SubID.'</Sub_ID>
			<Pub_ID>'.$promo_code.'</Pub_ID>
			<Origination_Datetime>'.date('m/d/Y H:i:s').'</Origination_Datetime>
			<Origination_Timezone>EST / EDT</Origination_Timezone>
			<Unique_Identifier>'.$Unique_identifier.'</Unique_Identifier>
			<User_Agent>'.$user_agent.'</User_Agent>
			<TCPA_Consent>'.$TCPAOptin.'</TCPA_Consent>
			<TCPA_Language>'.$TCPAText.'</TCPA_Language>
			<leadid_token>'.$UniversalLeadID.'</leadid_token>
			<Trusted_Form_URL>'.$trustedformcerturl.'</Trusted_Form_URL>
			<Driver_1_City>'.$city_state['city'].'</Driver_1_City>
			<Driver_1_State>'.$city_state['state'].'</Driver_1_State>
			<Driver_1_Zip>'.$zip.'</Driver_1_Zip>
			<Vehicle_1_Year>'.Yii::app()->request->getParam('vehicle1_year').'</Vehicle_1_Year>
			<Vehicle_1_Make>'.Yii::app()->request->getParam('vehicle1_make').'</Vehicle_1_Make>
			<Vehicle_1_Model>'.Yii::app()->request->getParam('vehicle1_model').'</Vehicle_1_Model>
			<Vehicle_1_Sub_Model>'.Yii::app()->request->getParam('vehicle1_submodel','No Trim').'</Vehicle_1_Sub_Model>
			<Vehicle_1_Vin>'.$vehicle1_vin.'</Vehicle_1_Vin>
			<Vehicle_1_Ownership>'.$vehicle1_vehicle_ownership.'</Vehicle_1_Ownership>
			<Vehicle_1_Primary_Use>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_primary_use','5')].'</Vehicle_1_Primary_Use>
			<Vehicle_1_Average_One_Way_Mileage>'.self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage','1')].'</Vehicle_1_Average_One_Way_Mileage>
			<Vehicle_1_Annual_Mileage>'.self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage','1')].'</Vehicle_1_Annual_Mileage>
			<Vehicle_1_Security_System>No Alarm</Vehicle_1_Security_System>
			<Vehicle_1_Parking>'.$parking[$park_key].'</Vehicle_1_Parking>
			<Vehicle_1_Average_Days_Per_Week_Used>5</Vehicle_1_Average_Days_Per_Week_Used>
			<Vehicle_1_Coverage_Type>'.self::$converageType[$converage_type].'</Vehicle_1_Coverage_Type>
			<Vehicle_1_Desired_Collision_Coverage>'.$Collision_Coverage[$CC_key].'</Vehicle_1_Desired_Collision_Coverage>
			<Vehicle_1_Desired_Comprehensive_Coverage>'.$Comprehensive_Coverage[$CCC_key].'</Vehicle_1_Desired_Comprehensive_Coverage>
			<Driver_1_Birthdate>'.$driver1_dob.'</Driver_1_Birthdate>
			<Driver_1_Age>'.$age.'</Driver_1_Age>
			<Driver_1_Gender>'.$driver1_gender.'</Driver_1_Gender>
			<Driver_1_Marital_Status>'.self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status','2')].'</Driver_1_Marital_Status>
			<Driver_1_Credit_Rating>'.self::$creditRating[Yii::app()->request->getParam('credit_rating','2')].'</Driver_1_Credit_Rating>
			<Driver_1_License_Status>Active</Driver_1_License_Status>
			<Driver_1_Licensed_State>'.$city_state['state'].'</Driver_1_Licensed_State>
			<Driver_1_Age_When_First_Licensed>16</Driver_1_Age_When_First_Licensed>
			<Driver_1_Suspended_Or_Revoked_In_The_Past_5_Years>No</Driver_1_Suspended_Or_Revoked_In_The_Past_5_Years>
			<Driver_1_Filing_Required>None</Driver_1_Filing_Required>
			<Driver_1_Education>'.self::$educationList[Yii::app()->request->getParam('driver1_education','4')].'</Driver_1_Education>
			<Driver_1_Occupation>'.self::$occupationList[Yii::app()->request->getParam('driver1_occupation','37')].'</Driver_1_Occupation>
			<Driver_1_Current_Residence>'.$residence_type.'</Driver_1_Current_Residence>
			<Driver_1_Years_At_Current_Residence>'.$years_at_residence.'</Driver_1_Years_At_Current_Residence>
			<Driver_1_Months_At_Current_Residence>'.$months_at_residence.'</Driver_1_Months_At_Current_Residence>
			<Driver_1_Tickets_Accidents_Claims_Past_3_Years>'.$driver1_hasTAVCs.'</Driver_1_Tickets_Accidents_Claims_Past_3_Years>
			<Driver_1_Insured_Past_30_Days>'.$is_policy_expired.'</Driver_1_Insured_Past_30_Days>
			<Driver_1_Policy_Expiration_Date>'.$policy_expiry_date.'</Driver_1_Policy_Expiration_Date>
			<Driver_1_Insured_Since>'.$policy_start_date.'</Driver_1_Insured_Since>
			<Driver_1_Insurance_Company>'.self::$insuranceCompanyList[Yii::app()->request->getParam('insurance_company','1')].'</Driver_1_Insurance_Company>
			<Driver_1_Bankruptcy_In_Past_5_Years>No</Driver_1_Bankruptcy_In_Past_5_Years>
			<Driver_1_Additional_Drivers>No</Driver_1_Additional_Drivers>
			<Driver_1_Additional_Vehicles>No</Driver_1_Additional_Vehicles>
			<Driver_1_Relationship_To_Applicant>Self</Driver_1_Relationship_To_Applicant>
			<Driver_1_US_Resident_In_The_Past_12_Months>Yes</Driver_1_US_Resident_In_The_Past_12_Months>
			<Driver_1_Reposessions_In_The_Past_5_Years>No</Driver_1_Reposessions_In_The_Past_5_Years>
			<Driver_1_DUI_DWI_In_The_Past_5_Years>No</Driver_1_DUI_DWI_In_The_Past_5_Years>
			<Driver_1_Incident_Type_1>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident1_description','6')].'</Driver_1_Incident_Type_1>';
			if($driver1_incidentDate1 !=""){
				$request .='<Driver_1_Approximate_Date_1>'.$driver1_incidentDate1.'</Driver_1_Approximate_Date_1>';
			}
			$request .='<Driver_1_Damages_1>'.self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage','4')].'</Driver_1_Damages_1>
			<Driver_1_At_Fault_1>'.$is_driver1_at_fault.'</Driver_1_At_Fault_1>
			<Driver_1_Insurance_Paid_Amount_1>'.Yii::app()->request->getParam('driver1_accident1_amount','1500').'</Driver_1_Insurance_Paid_Amount_1>
			<Driver_1_Incident_Type_2>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident2_description','6')].'</Driver_1_Incident_Type_2>';
			if($driver1_incidentDate2 !=""){
				$request .='<Driver_1_Approximate_Date_2>'.$driver1_incidentDate2.'</Driver_1_Approximate_Date_2>';
			}
			$request .='<Driver_1_Damages_2>'.self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage','4')].'</Driver_1_Damages_2>
			<Driver_1_At_Fault_2>'.$is_driver2_at_fault.'</Driver_1_At_Fault_2>
			<Driver_1_Insurance_Paid_Amount_2>'.Yii::app()->request->getParam('driver1_accident2_amount','1500').'</Driver_1_Insurance_Paid_Amount_2>';

			if (Yii::app()->request->getParam('vehicle2_year')) {
				$request .='<Vehicle_2_Year>'.Yii::app()->request->getParam('vehicle2_year').'</Vehicle_2_Year>
				<Vehicle_2_Make>'.Yii::app()->request->getParam('vehicle2_make').'</Vehicle_2_Make>
				<Vehicle_2_Model>'.Yii::app()->request->getParam('vehicle2_model').'</Vehicle_2_Model>
				<Vehicle_2_Sub_Model>'.Yii::app()->request->getParam('vehicle2_submodel').'</Vehicle_2_Sub_Model>
				<Vehicle_2_Vin>'.$vehicle2_vin.'</Vehicle_2_Vin>
				<Vehicle_2_Ownership>'.$vehicle2_vehicle_ownership.'</Vehicle_2_Ownership>
				<Vehicle_2_Primary_Use>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use')].'</Vehicle_2_Primary_Use>
				<Vehicle_2_Average_One_Way_Mileage>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use')].'</Vehicle_2_Average_One_Way_Mileage>
				<Vehicle_2_Annual_Mileage>'.self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_annual_mileage')].'</Vehicle_2_Annual_Mileage>
				<Vehicle_2_Security_System></Vehicle_2_Security_System>
				<Vehicle_2_Parking>'.$parking[$park_key].'</Vehicle_2_Parking>
				<Vehicle_2_Average_Days_Per_Week_Used></Vehicle_2_Average_Days_Per_Week_Used>
				<Vehicle_2_Coverage_Type>'.rand(5,15).'</Vehicle_2_Coverage_Type>
				<Vehicle_2_Desired_Collision_Coverage>'.$Collision_Coverage[$CC_key].'</Vehicle_2_Desired_Collision_Coverage>
				<Vehicle_2_Desired_Comprehensive_Coverage>'.$Comprehensive_Coverage[$CCC_key].'</Vehicle_2_Desired_Comprehensive_Coverage>';
			}
			if (Yii::app()->request->getParam('driver2_gender')) {
				$request .='<Driver_2_Birthdate>'.$driver2_dob.'</Driver_2_Birthdate>
				<Driver_2_Age>'.$age2.'</Driver_2_Age>
				<Driver_2_Gender>'.$driver2_gender.'</Driver_2_Gender>
				<Driver_2_Relationship_To_Applicant>Spouse</Driver_2_Relationship_To_Applicant>
				<Driver_2_Marital_Status>'.$driver2_maritalStatus.'</Driver_2_Marital_Status>
				<Driver_2_Credit_Rating>'.self::$creditRating[Yii::app()->request->getParam('credit_rating','2')].'</Driver_2_Credit_Rating>
			<Driver_2_License_Status>Active</Driver_2_License_Status>
			<Driver_2_Licensed_State>'.$city_state['state'].'</Driver_2_Licensed_State>
			<Driver_2_Age_When_First_Licensed>18</Driver_2_Age_When_First_Licensed>
			<Driver_2_Suspended_Or_Revoked_In_The_Past_5_Years>No</Driver_2_Suspended_Or_Revoked_In_The_Past_5_Years>
			<Driver_2_Filing_Required>None</Driver_2_Filing_Required>
			<Driver_2_Education>'.self::$educationList[Yii::app()->request->getParam('driver2_education','4')].'</Driver_2_Education>
			<Driver_2_Occupation>'.self::$occupationList[Yii::app()->request->getParam('driver2_occupation','37')].'</Driver_2_Occupation>
			<Driver_2_Current_Residence>'.$residence_type.'</Driver_2_Current_Residence>
			<Driver_2_Years_At_Current_Residence>'.$years_at_residence.'</Driver_2_Years_At_Current_Residence>
			<Driver_2_Months_At_Current_Residence>'.$months_at_residence.'</Driver_2_Months_At_Current_Residence>
			<Driver_2_Tickets_Accidents_Claims_Past_3_Years>'.$driver2_hasTAVCs.'</Driver_2_Tickets_Accidents_Claims_Past_3_Years>
			<Driver_2_Insured_Past_30_Days>'.$is_policy_expired.'</Driver_2_Insured_Past_30_Days>
			<Driver_2_Bankruptcy_In_Past_5_Years>No</Driver_2_Bankruptcy_In_Past_5_Years>
			<Driver_2_US_Resident_In_The_Past_12_Months>Yes</Driver_2_US_Resident_In_The_Past_12_Months>
			<Driver_2_Reposessions_In_The_Past_5_Years>No</Driver_2_Reposessions_In_The_Past_5_Years>
			<Driver_2_Policy_Expiration_Date>'.$policy_expiry_date.'</Driver_2_Policy_Expiration_Date>
			<Driver_2_Insurance_Company>'.self::$insuranceCompanyList[Yii::app()->request->getParam('insurance_company','1')].'</Driver_2_Insurance_Company>
			<Driver_2_Incident_Type_1>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident1_description','6')].'</Driver_2_Incident_Type_1>';
			if($driver2_incidentDate1 !=""){
				$request .='<Driver_2_Approximate_Date_1>'.$driver2_incidentDate1.'</Driver_2_Approximate_Date_1>';
			}
			$request .='<Driver_2_Damages_1>'.self::$AccidentDamage[Yii::app()->request->getParam('driver2_accident1_damage','4')].'</Driver_2_Damages_1>
			<Driver_2_At_Fault_1>'.$is_driver2_at_fault.'</Driver_2_At_Fault_1>
			<Driver_2_Insurance_Paid_Amount_1>'.Yii::app()->request->getParam('driver2_accident1_amount').'</Driver_2_Insurance_Paid_Amount_1>
			<Driver_2_Incident_Type_2>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident2_description','6')].'</Driver_2_Incident_Type_2>';
			if($driver2_incidentDate2 !=""){
				$request .='<Driver_2_Approximate_Date_2>'.$driver2_incidentDate2.'</Driver_2_Approximate_Date_2>';
			}
			$request .='<Driver_2_Damages_2>'.$is_driver2_at_fault.'</Driver_2_Damages_2>
			<Driver_2_At_Fault_2>'.$is_driver2_at_fault.'</Driver_2_At_Fault_2>
			<Driver_2_Insurance_Paid_Amount_2>'.Yii::app()->request->getParam('driver2_accident2_amount','1500').'</Driver_2_Insurance_Paid_Amount_2>';
			}
			$request .='</Request>';
		$pingData['ping_request'] = $request;
        return $pingData;
    }

    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<status>(.*)<\/status>/msui", $ping_response, $result);
        if (trim($result[1]) == 'Matched' || trim($result[0]) == 'Matched') {
            preg_match("/<price>(.*)<\/price>/msui", $ping_response, $price);
            preg_match("/<lead_id>(.*)<\/lead_id>/msui", $ping_response, $confirmation_id);
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
    	preg_match("/<lead_id>(.*)<\/lead_id>/msui", $ping_response, $confirmation_id);
    	$pingData = array();
        $p1 = $p1 ? $p1 : '35377425b4990cd0e42178bc38c858c9594d6d6af6fcb748213f5307d0b53da2';
        $p2 = $p2 ? $p2 : 'EMAUTO';
        $p3 = $p3 ? $p3 : '36';
		$IPAddress = Yii::app()->request->getParam('ipaddress');
		$user_agent = Yii::app()->request->getParam('user_agent','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15');
		$address = Yii::app()->request->getParam('address');
		$LeadDateTime = date('Y-m-d H:i:s');
		$Unique_identifier = Yii::app()->session['affiliate_trans_id'];
		$TCPAOptin = Yii::app()->request->getParam('tcpa_optin')=='1' ? 'Yes' : 'No';
		$TCPAText = Yii::app()->request->getParam('tcpa_text','By submitting this form');
		$TCPAText = str_replace(['&','"'],['',''],$TCPAText);
		$UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
		$SubID = Yii::app()->request->getParam('sub_id');
		$url = Yii::app()->request->getParam('url','https://eliteinsurers.com');
		$promo_code = Yii::app()->request->getParam('promo_code');
		$zip = Yii::app()->request->getParam('zip');
		$phone = Yii::app()->request->getParam('phone');
		$last_4_phone = substr($phone, 6,4);
		$phone2 = Yii::app()->request->getParam('phone2');
		$residence_type = (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own';
		$years_at_residence = Yii::app()->request->getParam('stay_in_year','4');
		$months_at_residence = Yii::app()->request->getParam('stay_in_month','3');
		$credit_rating = Yii::app()->request->getParam('credit_rating','3');
		$bankruptcy = Yii::app()->request->getParam('bankruptcy','0');
		$coverageType = Yii::app()->request->getParam('coverage_type','3');
		$driver1_hasTAVCs=(Yii::app()->request->getParam('driver1_hasTAVCs') == '0') ? 'No' : 'Yes';
		$driver2_hasTAVCs=(Yii::app()->request->getParam('driver2_hasTAVCs') == '0') ? 'No' : 'Yes';
		$vehicle_comprehensiveDeductible = Yii::app()->request->getParam('vehicle_deductibles','4');
		$vehicle_collisionDeductible = Yii::app()->request->getParam('vehicle_collision_deductibles','4');
		$medicalPayment = Yii::app()->request->getParam('medical_pay','5');
		$haveInsurance = Yii::app()->request->getParam('insurance_policy','0');
		$insuranceCompany = Yii::app()->request->getParam('insurance_company',1);
		$continuously_insured_period = Yii::app()->request->getParam('continuously_insured_period','1');
		$driver1_first_name  = Yii::app()->request->getParam('driver1_first_name');
		$driver1_last_name  = Yii::app()->request->getParam('driver1_last_name');
		$address  = Yii::app()->request->getParam('address');
		$email  = Yii::app()->request->getParam('email');
		$driver1_gender = (Yii::app()->request->getParam('driver1_gender')=='M') ? 'Male':'Female';
		$driver1_dob  = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_dob')));
		$driver1_requiredSR22  = Yii::app()->request->getParam('driver1_required_SR22','0');
		$driver2_gender = (Yii::app()->request->getParam('driver2_gender')=='M') ? '1' : '2';
		$driver2_dob  = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob')));
		$driver2_maritalStatus = Yii::app()->request->getParam('driver2_marital_status','1');
		$driver2_maritalStatus = $driver2_maritalStatus == 1 ? 'Single' : 'Married';
		$driver2_education = Yii::app()->request->getParam('driver2_education','1');
		$driver2_education -= $driver2_education;
		$driver2_occupation = Yii::app()->request->getParam('driver2_occupation','1');
		$driver2_requiredSR22 = Yii::app()->request->getParam('driver2_required_SR22','0');
		$trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');

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
		$pastdate = Yii::app()->request->getParam('insurance_expiration_date');
		$insurance_expiration_date_gap = round((time() - strtotime($pastdate))/86400);
		$is_policy_expired = $insurance_expiration_date_gap >30 ? 'Yes' : 'No';
		$policy_start_date = date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_start_date',(time()-(rand(360,370)*86400)))));
        $policy_expiry_date = date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_expiration_date',(time()+(rand(30,39)*86400))  )));
        $a = (time()-(rand(10,30)*86400));
		$driver1_at_fault = Yii::app()->request->getParam('driver1_accident1_at_fault');
		$is_driver1_at_fault = $driver1_at_fault == 1 ? 'Yes' : 'No';
		$driver2_at_fault = Yii::app()->request->getParam('driver1_accident2_at_fault');
		$is_driver2_at_fault = $driver2_at_fault == 1 ? 'Yes' : 'No';
		$vehicle1_vehicle_ownership = Yii::app()->request->getParam('vehicle1_vehicle_ownership');
		$vehicle2_vehicle_ownership = Yii::app()->request->getParam('vehicle2_vehicle_ownership');
    	$vehicle1_vehicle_ownership = $vehicle1_vehicle_ownership == 1 ? 'Owned' : 'Financed';
		$vehicle2_vehicle_ownership = $vehicle2_vehicle_ownership == 1 ? 'Owned' : 'Financed';
		$partner_email = 'jim@xananetwork.com';
		$partner_company = 'XanaNetwork';
		$driver1_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident1_date')),'');
		$driver1_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident2_date')),'');
		$driver2_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident1_date')),'');
		$driver2_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident2_date')),'');
		$vehicle1_vin = Yii::app()->request->getParam('vehicle1_vin','1ACBC535B');
		$vehicle1_vin = str_replace('****','',$vehicle1_vin);
		$vehicle2_vin = Yii::app()->request->getParam('vehicle2_vin','1ACBC535B');
		$vehicle2_vin = str_replace('****','',$vehicle2_vin);
		$request ='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Key>'.$p1.'</Key>
				<API_Action>pingPostLead</API_Action>
				<Mode>post</Mode>
				<TYPE>'.$p3.'</TYPE>
				<Return_Best_Price>1</Return_Best_Price>
				<Lead_ID>'.$confirmation_id[1].'</Lead_ID>
				<IP_Address>'.$IPAddress.'</IP_Address>
				<SRC>'.$p2.'</SRC>
				<Landing_Page>'.$url.'</Landing_Page>
				<Sub_ID>'.$SubID.'</Sub_ID>
				<Pub_ID>'.$promo_code.'</Pub_ID>
				<Origination_Datetime>'.date('m/d/Y H:i:s').'</Origination_Datetime>
				<Origination_Timezone>EST / EDT</Origination_Timezone>
				<Unique_Identifier>'.$Unique_identifier.'</Unique_Identifier>
				<User_Agent>'.$user_agent.'</User_Agent>
				<TCPA_Consent>'.$TCPAOptin.'</TCPA_Consent>
				<TCPA_Language>'.$TCPAText.'</TCPA_Language>
				<leadid_token>'.$UniversalLeadID.'</leadid_token>
				<Trusted_Form_URL>'.$trustedformcerturl.'</Trusted_Form_URL>
				<Driver_1_First_Name>'.$driver1_first_name.'</Driver_1_First_Name>
				<Driver_1_Last_Name>'.$driver1_last_name.'</Driver_1_Last_Name>
				<Driver_1_Address>'.$address.'</Driver_1_Address>
				<Driver_1_City>'.$city_state['city'].'</Driver_1_City>
				<Driver_1_State>'.$city_state['state'].'</Driver_1_State>
				<Driver_1_Zip>'.$zip.'</Driver_1_Zip>
				<Driver_1_Daytime_Phone>'.$phone.'</Driver_1_Daytime_Phone>
				<Driver_1_Evening_Phone>'.$phone.'</Driver_1_Evening_Phone>
				<Driver_1_Cell_Phone>'.$phone.'</Driver_1_Cell_Phone>
				<Driver_1_Email>'.$email.'</Driver_1_Email>
				<Driver_2_Address></Driver_2_Address>
				<Driver_2_City></Driver_2_City>
				<Driver_2_State></Driver_2_State>
				<Driver_2_Zip></Driver_2_Zip>
				<Driver_2_Daytime_Phone></Driver_2_Daytime_Phone>
				<Driver_2_Evening_Phone></Driver_2_Evening_Phone>
				<Driver_2_Cell_Phone></Driver_2_Cell_Phone>
				<Driver_2_Email></Driver_2_Email>
				<Vehicle_1_Year>'.Yii::app()->request->getParam('vehicle1_year').'</Vehicle_1_Year>
				<Vehicle_1_Make>'.Yii::app()->request->getParam('vehicle1_make').'</Vehicle_1_Make>
				<Vehicle_1_Model>'.Yii::app()->request->getParam('vehicle1_model').'</Vehicle_1_Model>
				<Vehicle_1_Sub_Model>'.Yii::app()->request->getParam('vehicle1_submodel').'</Vehicle_1_Sub_Model>
				<Vehicle_1_Vin>'.$vehicle1_vin.'</Vehicle_1_Vin>
				<Vehicle_1_Ownership>'.$vehicle1_vehicle_ownership.'</Vehicle_1_Ownership>
				<Vehicle_1_Primary_Use>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_primary_use','5')].'</Vehicle_1_Primary_Use>
				<Vehicle_1_Average_One_Way_Mileage>'.self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage','1')].'</Vehicle_1_Average_One_Way_Mileage>
				<Vehicle_1_Annual_Mileage>'.self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage','1')].'</Vehicle_1_Annual_Mileage>
				<Vehicle_1_Security_System>No Alarm</Vehicle_1_Security_System>
				<Vehicle_1_Parking>'.$parking[$park_key].'</Vehicle_1_Parking>
				<Vehicle_1_Average_Days_Per_Week_Used>5</Vehicle_1_Average_Days_Per_Week_Used>
				<Vehicle_1_Coverage_Type>'.self::$converageType[$converage_type].'</Vehicle_1_Coverage_Type>
				<Vehicle_1_Desired_Collision_Coverage>'.$Collision_Coverage[$CC_key].'</Vehicle_1_Desired_Collision_Coverage>
				<Vehicle_1_Desired_Comprehensive_Coverage>'.$Comprehensive_Coverage[$CCC_key].'</Vehicle_1_Desired_Comprehensive_Coverage>
				<Driver_1_Birthdate>'.$driver1_dob.'</Driver_1_Birthdate>
				<Driver_1_Age>'.$age.'</Driver_1_Age>
				<Driver_1_Gender>'.$driver1_gender.'</Driver_1_Gender>
				<Driver_1_Marital_Status>'.self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status','2')].'</Driver_1_Marital_Status>
				<Driver_1_Credit_Rating>'.self::$creditRating[Yii::app()->request->getParam('credit_rating','2')].'</Driver_1_Credit_Rating>
				<Driver_1_License_Status>Active</Driver_1_License_Status>
				<Driver_1_Licensed_State>'.$city_state['state'].'</Driver_1_Licensed_State>
				<Driver_1_Age_When_First_Licensed>16</Driver_1_Age_When_First_Licensed>
				<Driver_1_Suspended_Or_Revoked_In_The_Past_5_Years>No</Driver_1_Suspended_Or_Revoked_In_The_Past_5_Years>
				<Driver_1_Filing_Required>None</Driver_1_Filing_Required>
				<Driver_1_Education>'.self::$educationList[Yii::app()->request->getParam('driver1_education','4')].'</Driver_1_Education>
				<Driver_1_Occupation>'.self::$occupationList[Yii::app()->request->getParam('driver1_occupation','37')].'</Driver_1_Occupation>
				<Driver_1_Current_Residence>'.$residence_type.'</Driver_1_Current_Residence>
				<Driver_1_Years_At_Current_Residence>'.$years_at_residence.'</Driver_1_Years_At_Current_Residence>
				<Driver_1_Months_At_Current_Residence>'.$months_at_residence.'</Driver_1_Months_At_Current_Residence>
				<Driver_1_Tickets_Accidents_Claims_Past_3_Years>'.$driver1_hasTAVCs.'</Driver_1_Tickets_Accidents_Claims_Past_3_Years>
				<Driver_1_Insured_Past_30_Days>'.$is_policy_expired.'</Driver_1_Insured_Past_30_Days>
				<Driver_1_Policy_Expiration_Date>'.$policy_expiry_date.'</Driver_1_Policy_Expiration_Date>
				<Driver_1_Insured_Since>'.$policy_start_date.'</Driver_1_Insured_Since>
				<Driver_1_Insurance_Company>'.self::$insuranceCompanyList[Yii::app()->request->getParam('insurance_company','1')].'</Driver_1_Insurance_Company>
				<Driver_1_Bankruptcy_In_Past_5_Years>No</Driver_1_Bankruptcy_In_Past_5_Years>
				<Driver_1_Additional_Drivers>No</Driver_1_Additional_Drivers>
				<Driver_1_Additional_Vehicles>No</Driver_1_Additional_Vehicles>
				<Driver_1_Relationship_To_Applicant>Self</Driver_1_Relationship_To_Applicant>
				<Driver_1_US_Resident_In_The_Past_12_Months>Yes</Driver_1_US_Resident_In_The_Past_12_Months>
				<Driver_1_Reposessions_In_The_Past_5_Years>No</Driver_1_Reposessions_In_The_Past_5_Years>
				<Driver_1_DUI_DWI_In_The_Past_5_Years>No</Driver_1_DUI_DWI_In_The_Past_5_Years>
				<Driver_1_Incident_Type_1>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident1_description','6')].'</Driver_1_Incident_Type_1>';
				if($driver1_incidentDate1 !=""){
				$request .='<Driver_1_Approximate_Date_1>'.$driver1_incidentDate1.'</Driver_1_Approximate_Date_1>';
				}
				$request .='<Driver_1_Damages_1>'.self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage')].'</Driver_1_Damages_1>
				<Driver_1_At_Fault_1>'.$is_driver1_at_fault.'</Driver_1_At_Fault_1>
				<Driver_1_Insurance_Paid_Amount_1>'.Yii::app()->request->getParam('driver1_accident1_amount','1500').'</Driver_1_Insurance_Paid_Amount_1>
				<Driver_1_Incident_Type_2>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident2_description','6')].'</Driver_1_Incident_Type_2>';
				if($driver1_incidentDate2 !=""){
				$request .= '<Driver_1_Approximate_Date_2>'.$driver1_incidentDate2.'</Driver_1_Approximate_Date_2>';
				}
				$request .='<Driver_1_Damages_2>'.self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage','4')].'</Driver_1_Damages_2>
				<Driver_1_At_Fault_2>'.$is_driver1_at_fault.'</Driver_1_At_Fault_2>
				<Driver_1_Insurance_Paid_Amount_2>'.Yii::app()->request->getParam('driver1_accident2_amount','1500').'</Driver_1_Insurance_Paid_Amount_2>';
				if (Yii::app()->request->getParam('vehicle2_year')) {
				$request .='<Vehicle_2_Year>'.Yii::app()->request->getParam('vehicle2_year',date('Y')).'</Vehicle_2_Year>
				<Vehicle_2_Make>'.Yii::app()->request->getParam('vehicle2_make').'</Vehicle_2_Make>
				<Vehicle_2_Model>'.Yii::app()->request->getParam('vehicle2_model').'</Vehicle_2_Model>
				<Vehicle_2_Sub_Model>'.Yii::app()->request->getParam('vehicle2_submodel').'</Vehicle_2_Sub_Model>
				<Vehicle_2_Vin>'.$vehicle2_vin.'</Vehicle_2_Vin>
				<Vehicle_2_Ownership>'.$vehicle2_vehicle_ownership.'</Vehicle_2_Ownership>
				<Vehicle_2_Primary_Use>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use')].'</Vehicle_2_Primary_Use>
				<Vehicle_2_Average_One_Way_Mileage>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use')].'</Vehicle_2_Average_One_Way_Mileage>
				<Vehicle_2_Annual_Mileage>'.self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_annual_mileage')].'</Vehicle_2_Annual_Mileage>
				<Vehicle_2_Security_System></Vehicle_2_Security_System>
				<Vehicle_2_Parking>'.$parking[$park_key].'</Vehicle_2_Parking>
				<Vehicle_2_Average_Days_Per_Week_Used></Vehicle_2_Average_Days_Per_Week_Used>
				<Vehicle_2_Coverage_Type>'.rand(5,15).'</Vehicle_2_Coverage_Type>
				<Vehicle_2_Desired_Collision_Coverage>'.$Collision_Coverage[$CC_key].'</Vehicle_2_Desired_Collision_Coverage>
				<Vehicle_2_Desired_Comprehensive_Coverage>'.$Comprehensive_Coverage[$CCC_key].'</Vehicle_2_Desired_Comprehensive_Coverage>';
				}
				if (Yii::app()->request->getParam('driver2_gender')) {
				$request .='<Driver_2_Birthdate>'.$driver2_dob.'</Driver_2_Birthdate>
				<Driver_2_Age></Driver_2_Age>
				<Driver_2_Gender>'.$driver2_gender.'</Driver_2_Gender>
				<Driver_2_Relationship_To_Applicant>Spouse</Driver_2_Relationship_To_Applicant>
				<Driver_2_Marital_Status>'.$driver2_maritalStatus.'</Driver_2_Marital_Status>
				<Driver_2_Credit_Rating>'.self::$creditRating[Yii::app()->request->getParam('credit_rating'.'2')].'</Driver_2_Credit_Rating>
				<Driver_2_License_Status>Active</Driver_2_License_Status>
				<Driver_2_Licensed_State>'.$city_state['state'].'</Driver_2_Licensed_State>
				<Driver_2_Age_When_First_Licensed>18</Driver_2_Age_When_First_Licensed>
				<Driver_2_Suspended_Or_Revoked_In_The_Past_5_Years>No</Driver_2_Suspended_Or_Revoked_In_The_Past_5_Years>
				<Driver_2_Filing_Required>None</Driver_2_Filing_Required>
				<Driver_2_Education>'.self::$educationList[Yii::app()->request->getParam('driver2_education','4')].'</Driver_2_Education>
				<Driver_2_Occupation>'.self::$occupationList[Yii::app()->request->getParam('driver2_occupation','37')].'</Driver_2_Occupation>
				<Driver_2_Current_Residence>'.$residence_type.'</Driver_2_Current_Residence>
				<Driver_2_Years_At_Current_Residence>'.$years_at_residence.'</Driver_2_Years_At_Current_Residence>
				<Driver_2_Months_At_Current_Residence>'.$months_at_residence.'</Driver_2_Months_At_Current_Residence>
				<Driver_2_Tickets_Accidents_Claims_Past_3_Years>'.$driver2_hasTAVCs.'</Driver_2_Tickets_Accidents_Claims_Past_3_Years>
				<Driver_2_Insured_Past_30_Days>'.$is_policy_expired.'</Driver_2_Insured_Past_30_Days>
				<Driver_2_Bankruptcy_In_Past_5_Years>No</Driver_2_Bankruptcy_In_Past_5_Years>
				<Driver_2_US_Resident_In_The_Past_12_Months>Yes</Driver_2_US_Resident_In_The_Past_12_Months>
				<Driver_2_Reposessions_In_The_Past_5_Years>No</Driver_2_Reposessions_In_The_Past_5_Years>
				<Driver_2_Policy_Expiration_Date>'.$policy_expiry_date.'</Driver_2_Policy_Expiration_Date>
				<Driver_2_Insurance_Company>'.self::$insuranceCompanyList[Yii::app()->request->getParam('insurance_company','1')].'</Driver_2_Insurance_Company>
				<Driver_2_Incident_Type_1>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident1_description','6')].'</Driver_2_Incident_Type_1>';
				if($driver2_incidentDate1 !=""){
				$request .='<Driver_2_Approximate_Date_1>'.$driver2_incidentDate1.'</Driver_2_Approximate_Date_1>';
				}
				$request .='<Driver_2_Damages_1>'.self::$AccidentDamage[Yii::app()->request->getParam('driver2_accident1_damage','4')].'</Driver_2_Damages_1>
				<Driver_2_At_Fault_1>'.$is_driver2_at_fault.'</Driver_2_At_Fault_1>
				<Driver_2_Insurance_Paid_Amount_1>'.Yii::app()->request->getParam('driver2_accident1_amount').'</Driver_2_Insurance_Paid_Amount_1>
				<Driver_2_Incident_Type_2>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident2_description','6')].'</Driver_2_Incident_Type_2>';
				if($driver2_incidentDate2 !=""){
				$request .='<Driver_2_Approximate_Date_2>'.$driver2_incidentDate2.'</Driver_2_Approximate_Date_2>';
				}
				$request .='<Driver_2_Damages_2>'.$is_driver2_at_fault.'</Driver_2_Damages_2>
				<Driver_2_At_Fault_2>'.$is_driver2_at_fault.'</Driver_2_At_Fault_2>
				<Driver_2_Insurance_Paid_Amount_2>'.Yii::app()->request->getParam('driver2_accident2_amount','1500').'</Driver_2_Insurance_Paid_Amount_2>';
				}
		$request .='</Request>';
		$post_request = $request;
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $post_response = $cm->curl($post_url, $post_request);
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
