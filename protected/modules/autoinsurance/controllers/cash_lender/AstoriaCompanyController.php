<?php
class AstoriaCompanyController extends Controller {
    public function __construct() {
        
    }
	public static $companyListFromBuyer = [1 => 'Company Not Listed',2 => '21st Century Insurance',3 => 'AAA Insurance Co.',4 => 'AARP',5 => 'AETNA',6 => 'AFLAC',7 => 'AIG',8 => 'AIU Insurance',9 => 'Allied',10 => 'Allstate County Mutual',11 => 'Allstate Indemnity',12 => 'Allstate Insurance',13 => 'American Alliance Insurance',14 => 'American Automobile Insurance',15 => 'American Casualty',16 => 'American Deposit Insurance',17 => 'American Direct Business Insurance',18 => 'American Empire Insurance',19 => 'American Family Insurance',20 => 'American Family Mutual',21 => 'American Financial',22 => 'American Health Underwriters',23 => 'American Home Assurance',24 => 'American Insurance',25 => 'American International Ins',26 => 'American International Pacific',27 => 'American International South',28 => 'American Manufacturers',29 => 'American Mayflower Insurance',30 => 'American Motorists Insurance',31 => 'American National Insurance',32 => 'American Premier Insurance',33 => 'American Protection Insurance',34 => 'American Republic',35 => 'American Savers Plan',36 => 'American Service Insurance',37 => 'American Skyline Insurance Company',38 => 'American Spirit Insurance',39 => 'American Standard Insurance - OH',40 => 'American Standard Insurance - WI',41 => 'AmeriPlan',42 => 'Amica Insurance',43 => 'Answer Financial',44 => 'Arbella',45 => 'Associated Indemnity',46 => 'Assurant',47 => 'Atlanta Casualty',48 => 'Atlantic Indemnity',49 => 'Auto Club Insurance Company',50 => 'AXA Advisors',51 => 'Bankers Life and Casualty',52 => 'Banner Life',53 => 'Best Agency USA',54 => 'Blue Cross and Blue Shield',55 => 'Brooke Insurance',56 => 'Cal Farm Insurance',57 => 'California State Automobile Association',58 => 'Chubb',59 => 'Citizens',60 => 'Clarendon American Insurance',61 => 'Clarendon National Insurance',62 => 'CNA',63 => 'Colonial Insurance',64 => 'Comparison Market',65 => 'Continental Casualty',66 => 'Continental Divide Insurance',67 => 'Continental Insurance',68 => 'Cotton States Insurance',69 => 'Country Insurance and Financial Services',70 => 'Countrywide Insurance',71 => 'CSE Insurance Group',72 => 'Dairyland County Mutual Co of TX',73 => 'Dairyland Insurance',74 => 'eHealthInsurance Services',75 => 'Electric Insurance',76 => 'Erie Insurance Company',77 => 'Erie Insurance Exchange',78 => 'Erie Insurance Group',79 => 'Erie Insurance Property and Casualty',80 => 'Esurance',81 => 'Farm Bureau/Farm Family/Rural',82 => 'Farmers Insurance',83 => 'Farmers Insurance Exchange',84 => 'Farmers TX County Mutual',85 => 'Farmers Union',86 => 'FinanceBox.com',87 => 'Fire and Casualty Insurance Co of CT',88 => 'Firemans Fund',89 => 'Foremost',90 => 'Foresters',91 => 'Geico Casualty',92 => 'Geico General Insurance',93 => 'Geico Indemnity',94 => 'GMAC Insurance',95 => 'Golden Rule Insurance',96 => 'Government Employees Insurance',97 => 'Guaranty National Insurance',98 => 'Guide One Insurance',99 => 'Hanover Lloyds Insurance Company',100 => 'Hartford Accident and Indemnity',101 => 'Hartford Casualty Insurance',102 => 'Hartford Fire Insurance',103 => 'Hartford Insurance Co of Illinois',104 => 'Hartford Insurance Co of the Southeast',105 => 'Hartford Omni',106 => 'Hartford Underwriters Insurance',107 => 'Health Benefits Direct',108 => 'Health Choice One',109 => 'Health Plus of America',110 => 'HealthShare American',111 => 'Humana',112 => 'IFA Auto Insurance',113 => 'IGF Insurance',114 => 'Infinity Insurance',115 => 'Infinity National Insurance',116 => 'Infinity Select Insurance',117 => 'Insurance Insight',118 => 'Insurance.com',119 => 'InsuranceLeads.com',120 => 'InsWeb',121 => 'Integon',122 => 'John Hancock',123 => 'Kaiser Permanente',124 => 'Kemper Lloyds Insurance',125 => 'Landmark American Insurance',126 => 'Leader National Insurance',127 => 'Leader Preferred Insurance',128 => 'Leader Specialty Insurance',129 => 'Liberty Insurance Corp',130 => 'Liberty Mutual Fire Insurance',131 => 'Liberty Mutual Insurance',132 => 'Liberty National',133 => 'Liberty Northwest Insurance',134 => 'Lumbermens Mutual',135 => 'Maryland Casualty',136 => 'Mass Mutual',137 => 'Mega/Midwest',138 => 'Mercury',139 => 'MetLife Auto and Home',140 => 'Metropolitan Insurance Co.',141 => 'Mid Century Insurance',142 => 'Mid-Continent Casualty',143 => 'Middlesex Insurance',144 => 'Midland National Life',145 => 'Mutual of New York',146 => 'Mutual Of Omaha',147 => 'National Ben Franklin Insurance',148 => 'National Casualty',149 => 'National Continental Insurance',150 => 'National Fire Insurance Company of Hartford',151 => 'National Health Insurance',152 => 'National Indemnity',153 => 'National Union Fire Insurance of LA',154 => 'National Union Fire Insurance of PA',155 => 'Nationwide General Insurance',156 => 'Nationwide Insurance Company',157 => 'Nationwide Mutual Fire Insurance',158 => 'Nationwide Mutual Insurance',159 => 'Nationwide Property and Casualty',160 => 'New England Financial',161 => 'New York Life Insurance',162 => 'Northwestern Mutual Life',163 => 'Northwestern Pacific Indemnity',164 => 'Omni Indemnity',165 => 'Omni Insurance',166 => 'Orion Insurance',167 => 'Pacific Indemnity',168 => 'Pacific Insurance',169 => 'Pafco General Insurance',170 => 'Patriot General Insurance',171 => 'Peak Property and Casualty Insurance',172 => 'PEMCO Insurance',173 => 'Physicians',174 => 'Progressive',175 => 'Progressive Auto Pro',176 => 'Prudential Insurance Co.',177 => 'Reliance Insurance',178 => 'Reliance National Indemnity',179 => 'Reliance National Insurance',180 => 'Republic Indemnity',181 => 'Response Insurance',182 => 'SAFECO',183 => 'Safeway Insurance',184 => 'Safeway Insurance Co of AL',185 => 'Safeway Insurance Co of GA',186 => 'Safeway Insurance Co of LA',187 => 'Security Insurance Co of Hartford',188 => 'Security National Insurance Co of FL',189 => 'Sentinel Insurance',190 => 'Sentry Insurance a Mutual Company',191 => 'Sentry Insurance Group',192 => 'Shelter Insurance Co.',193 => 'St. Paul',194 => 'St. Paul Fire and Marine',195 => 'St. Paul Insurance',196 => 'Standard Fire Insurance Company',197 => 'State and County Mutual Fire Insurance',198 => 'State Farm County',199 => 'State Farm Fire and Cas',200 => 'State Farm General',201 => 'State Farm Indemnity',202 => 'State Farm Insurance Co.',203 => 'State Farm Lloyds Tx',204 => 'State Farm Mutual Auto',205 => 'State Fund',206 => 'State National Insurance',207 => 'Superior American Insurance',208 => 'Superior Guaranty Insurance',209 => 'Superior Insurance',210 => 'Sure Health Plans',211 => 'The Ahbe Group',212 => 'The General',213 => 'The Hartford',214 => 'TICO Insurance',215 => 'TIG Countrywide Insurance',216 => 'Titan',217 => 'TransAmerica',218 => 'Travelers Indemnity',219 => 'Travelers Insurance Company',220 => 'Tri-State Consumer Insurance',221 => 'Twin City Fire Insurance',222 => 'UniCare',223 => 'United American/Farm and Ranch',224 => 'United Pacific Insurance',225 => 'United Security',226 => 'United Services Automobile Association',227 => 'Unitrin Direct',228 => 'Universal Underwriters Insurance',229 => 'US Financial',230 => 'USA Benefits/Continental General',231 => 'USAA',232 => 'USF and G',233 => 'Viking County Mutual Insurance',234 => 'Viking Insurance Co of WI',235 => 'Western and Southern Life',236 => 'Western Mutual',237 => 'Windsor Insurance',238 => 'Woodlands Financial Group',239 => 'Zurich North America',240 => 'plymouth rock assurance'];
	

    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$InsuranceComapany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer, self::$companyListFromBuyer[1]);
		if($promo_code == '8' || $promo_code == 8){
		}else{
			$pingData = array();
			$fields = array(
				'lead_type' => $p1,
				'lead_mode' => $status,
				'vendor_id' => $p2,
				'ipaddress' => Yii::app()->request->getParam('ipaddress'),
				'sub_id' => $promo_code,
				'tcpa_optin' => Yii::app()->request->getParam('tcpa_optin',0),
				'tcpa_text' => Yii::app()->request->getParam('tcpa_text'),
				'universal_leadid' =>  Yii::app()->request->getParam('universal_leadid'),
				'xxtrustedformcerturl'=>  Yii::app()->request->getParam('trustedformcerturl'),
				'origination_datetime' => date('Y-m-d H:i:s'),
				'origination_timezone' => '1',
				'zip' => Yii::app()->request->getParam('zip'),
				'residence_type' => (Yii::app()->request->getParam('is_rented') == 'rent') ? '1' : '1',
				'years_at_residence' => Yii::app()->request->getParam('stay_in_year', '4'),
				'months_at_residence' => Yii::app()->request->getParam('stay_in_month', '3'),
				'credit_rating' => '3', // Fair
				'bankruptcy' => Yii::app()->request->getParam('bankruptcy', '0'),
				'coverageType' => Yii::app()->request->getParam('coverage_type', '3'),
				'vehicle_comprehensiveDeductible' => Yii::app()->request->getParam('vehicle_deductibles', '4'),
				'vehicle_collisionDeductible' => Yii::app()->request->getParam('vehicle_collision_deductibles', '4'),
				'medicalPayment' => Yii::app()->request->getParam('medical_pay', '5'),
				'haveInsurance' => Yii::app()->request->getParam('insurance_policy', '0'),
				'insuranceCompany' => $InsuranceComapany,
				'continuously_insured_period' => Yii::app()->request->getParam('continuously_insured_period', '1'),
				'current_policy_start_date' => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date'))),
				'current_policy_expiration_date' => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
				//'driver1_firstname' => Yii::app()->request->getParam('first_name'),
				//'driver1_lastname' => Yii::app()->request->getParam('last_name'),
				'driver1_gender' => (Yii::app()->request->getParam('driver1_gender') == 'M') ? '0' : '1',
				'driver1_dob' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob'))),
				'driver1_maritalStatus' => Yii::app()->request->getParam('driver1_marital_status', '1'),
				'driver1_education' => Yii::app()->request->getParam('driver1_education', '1'),
				'driver1_occupation' => Yii::app()->request->getParam('driver1_occupation', '1'),
				'driver1_requiredSR22' => Yii::app()->request->getParam('driver1_required_SR22', '0'),
				'driver1_hasTAVCs' => Yii::app()->request->getParam('driver1_hasTAVCs'),
				'driver1_numOfIncidents' => Yii::app()->request->getParam('driver1_num_of_incidents','1'),
				'driver1_incidentType1' => Yii::app()->request->getParam('driver1_incident1_type'),
				'driver1_incidentDate1' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident1_date'))),
				'driver1_ticket1Description' => Yii::app()->request->getParam('driver1_ticket1_description'),
				'driver1_accident1Description' => Yii::app()->request->getParam('driver1_accident1_description'),
				'driver1_accident1Damage' => Yii::app()->request->getParam('driver1_accident1_damage'),
				'driver1_accident1Atfault' => Yii::app()->request->getParam('driver1_accident1_at_fault'),
				'driver1_accident1Amount' => Yii::app()->request->getParam('driver1_accident1_amount'),
				'driver1_violation1Description' => Yii::app()->request->getParam('driver1_violation1_description'),
				'driver1_violation1State' => Yii::app()->request->getParam('driver1_violation1_state'),
				'driver1_claim1Description' => Yii::app()->request->getParam('driver1_claim1_description'),
				'driver1_claim1PaidAmount' => Yii::app()->request->getParam('driver1_claim1_paid_amount'),
				'driver1_incidentType2' => Yii::app()->request->getParam('driver1_incident2_type'),
				'driver1_incidentDate2' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident2_date'))),
				'driver1_ticket2Description' => Yii::app()->request->getParam('driver1_ticket2_description'),
				'driver1_accident2Description' => Yii::app()->request->getParam('driver1_accident2_description'),
				'driver1_accident2Damage' => Yii::app()->request->getParam('driver1_accident2_damage'),
				'driver1_accident2Atfault' => Yii::app()->request->getParam('driver1_accident2_at_fault'),
				'driver1_accident2Amount' => Yii::app()->request->getParam('driver1_accident2_amount'),
				'driver1_violation2Description' => Yii::app()->request->getParam('driver1_violation2_description'),
				'driver1_violation2State' => Yii::app()->request->getParam('driver1_violation2_state'),
				'driver1_claim2Description' => Yii::app()->request->getParam('driver1_claim2_description'),
				'driver1_claim2PaidAmount' => Yii::app()->request->getParam('driver1_claim2_paid_amount'),
				'driver1_incidentType3' => Yii::app()->request->getParam('driver1_incident3_type'),
				'driver1_incidentDate3' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident3_date'))),
				'driver1_ticket3Description' => Yii::app()->request->getParam('driver1_ticket3_description'),
				'driver1_accident3Description' => Yii::app()->request->getParam('driver1_accident3_description'),
				'driver1_accident3Damage' => Yii::app()->request->getParam('driver1_accident3_damage'),
				'driver1_accident3Atfault' => Yii::app()->request->getParam('driver1_accident3_at_fault'),
				'driver1_accident3Amount' => Yii::app()->request->getParam('driver1_accident3_amount'),
				'driver1_violation3Description' => Yii::app()->request->getParam('driver1_violation3_description'),
				'driver1_violation3State' => Yii::app()->request->getParam('driver1_violation3_state'),
				'driver1_claim3Description' => Yii::app()->request->getParam('driver1_claim3_description'),
				'driver1_claim3PaidAmount' => Yii::app()->request->getParam('driver1_claim3_paid_amount'),
				'driver1_incidentType4' => Yii::app()->request->getParam('driver1_incident4_type'),
				'driver1_incidentDate4' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident4_date'))),
				'driver1_ticket4Description' => Yii::app()->request->getParam('driver1_ticket4_description'),
				'driver1_accident4Description' => Yii::app()->request->getParam('driver1_accident4_description'),
				'driver1_accident4Damage' => Yii::app()->request->getParam('driver1_accident4_damage'),
				'driver1_accident4Atfault' => Yii::app()->request->getParam('driver1_accident4_at_fault'),
				'driver1_accident4Amount' => Yii::app()->request->getParam('driver1_accident4_amount'),
				'driver1_violation4Description' => Yii::app()->request->getParam('driver1_violation4_description'),
				'driver1_violation4State' => Yii::app()->request->getParam('driver1_violation4_state'),
				'driver1_claim4Description' => Yii::app()->request->getParam('driver1_claim4_description'),
				'driver1_claim4PaidAmount' => Yii::app()->request->getParam('driver1_claim4_paid_amount'),
				'vehicle1_year' => Yii::app()->request->getParam('vehicle1_year'),
				'vehicle1_make' => Yii::app()->request->getParam('vehicle1_make'),
				'vehicle1_model' => Yii::app()->request->getParam('vehicle1_model'),
				'vehicle1_subModel' => Yii::app()->request->getParam('vehicle1_submodel'),
				'vehicle1_vin' => Yii::app()->request->getParam('vehicle1_vin'),
				'vehicle1_primaryUse' => Yii::app()->request->getParam('vehicle1_primary_use'),
				'vehicle1_vehicleOwnership' => Yii::app()->request->getParam('vehicle1_vehicle_ownership'),
				'vehicle1_dailyMileage' => Yii::app()->request->getParam('vehicle1_daily_mileage'),
				'vehicle1_annualMileage' => Yii::app()->request->getParam('vehicle1_annual_mileage'),
			);
			// VEHICAL2 INFORMATIONS
			if (Yii::app()->request->getParam('vehicle2_year')) {
				$fields['vehicle2_year'] = Yii::app()->request->getParam('vehicle2_year');
			}
			if (Yii::app()->request->getParam('vehicle2_make')) {
				$fields['vehicle2_make'] = Yii::app()->request->getParam('vehicle2_make');
			}
			if (Yii::app()->request->getParam('vehicle2_model')) {
				$fields['vehicle2_model'] = Yii::app()->request->getParam('vehicle2_model');
			}
			if (Yii::app()->request->getParam('vehicle2_submodel')) {
				$fields['vehicle2_subModel'] = Yii::app()->request->getParam('vehicle2_submodel');
			}
			if (Yii::app()->request->getParam('vehicle2_vin')) {
				$fields['vehicle2_vin'] = Yii::app()->request->getParam('vehicle2_vin');
			}
			if (Yii::app()->request->getParam('vehicle2_primary_use')) {
				$fields['vehicle2_primaryUse'] = Yii::app()->request->getParam('vehicle2_primary_use');
			}
			if (Yii::app()->request->getParam('vehicle2_vehicle_ownership')) {
				$fields['vehicle2_vehicleOwnership'] = Yii::app()->request->getParam('vehicle2_vehicle_ownership');
			}
			if (Yii::app()->request->getParam('vehicle2_daily_mileage')) {
				$fields['vehicle2_dailyMileage'] = Yii::app()->request->getParam('vehicle2_daily_mileage');
			}
			if (Yii::app()->request->getParam('vehicle2_annual_mileage')) {
				$fields['vehicle2_annualMileage'] = Yii::app()->request->getParam('vehicle2_annual_mileage');
			}
			//'driver2_firstname' => Yii::app()->request->getParam('driver2_first_name'),
			//'driver2_lastname' => Yii::app()->request->getParam('driver2_last_name'),
			if (Yii::app()->request->getParam('driver2_gender')) {
				$fields['driver2_gender'] = (Yii::app()->request->getParam('driver2_gender') == 'M') ? '0' : '1';
			}
			if (Yii::app()->request->getParam('driver2_dob')) {
				$fields['driver2_dob'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob')));
			}
			if (Yii::app()->request->getParam('driver2_relationship_to_applicant')) {
				$fields['driver2_relationshipToApplicant'] = Yii::app()->request->getParam('driver2_relationship_to_applicant');
			}
			if (Yii::app()->request->getParam('driver2_marital_status')) {
				$fields['driver2_maritalStatus'] = Yii::app()->request->getParam('driver2_marital_status');
			}
			if (Yii::app()->request->getParam('driver2_education')) {
				$fields['driver2_education'] = Yii::app()->request->getParam('driver2_education');
			}
			if (Yii::app()->request->getParam('driver2_occupation')) {
				$fields['driver2_occupation'] = Yii::app()->request->getParam('driver2_occupation');
			}
			if (Yii::app()->request->getParam('driver2_required_SR22')) {
				$fields['driver2_requiredSR22'] = Yii::app()->request->getParam('driver2_required_SR22');
			}
			if (Yii::app()->request->getParam('driver2_hasTAVCs')) {
				$fields['driver2_hasTAVCs'] = Yii::app()->request->getParam('driver2_hasTAVCs');
			}
			if (Yii::app()->request->getParam('driver2_num_of_incidents')) {
				$fields['driver2_numOfIncidents'] = Yii::app()->request->getParam('driver2_num_of_incidents');
			}
			if (Yii::app()->request->getParam('driver2_incident1_type')) {
				$fields['driver2_incidentType1'] = Yii::app()->request->getParam('driver2_incident1_type');
			}
			if (Yii::app()->request->getParam('driver2_incident1_date')) {
				$fields['driver2_incidentDate1'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_incident1_date')));
			}
			if (Yii::app()->request->getParam('driver2_ticket1_description')) {
				$fields['driver2_ticket1Description'] = Yii::app()->request->getParam('driver2_ticket1_description');
			}
			if (Yii::app()->request->getParam('driver2_accident1_description')) {
				$fields['driver2_accident1Description'] = Yii::app()->request->getParam('driver2_accident1_description');
			}
			if (Yii::app()->request->getParam('driver2_accident1_damage')) {
				$fields['driver2_accident1Damage'] = Yii::app()->request->getParam('driver2_accident1_damage');
			}
			if (Yii::app()->request->getParam('driver2_accident1_at_fault')) {
				$fields['driver2_accident1Atfault'] = Yii::app()->request->getParam('driver2_accident1_at_fault');
			}
			if (Yii::app()->request->getParam('driver2_accident1_amount')) {
				$fields['driver2_accident1Amount'] = Yii::app()->request->getParam('driver2_accident1_amount');
			}
			if (Yii::app()->request->getParam('driver2_violation1_description')) {
				$fields['driver2_violation1Description'] = Yii::app()->request->getParam('driver2_violation1_description');
			}
			if (Yii::app()->request->getParam('driver2_violation1_state')) {
				$fields['driver2_violation1State'] = Yii::app()->request->getParam('driver2_violation1_state');
			}
			if (Yii::app()->request->getParam('driver2_claim1_description')) {
				$fields['driver2_claim1Description'] = Yii::app()->request->getParam('driver2_claim1_description');
			}
			if (Yii::app()->request->getParam('driver2_claim1_paid_amount')) {
				$fields['driver2_claim1PaidAmount'] = Yii::app()->request->getParam('driver2_claim1_paid_amount');
			}
			if (Yii::app()->request->getParam('driver2_incident2_type')) {
				$fields['driver2_incidentType2'] = Yii::app()->request->getParam('driver2_incident2_type');
			}
			if (Yii::app()->request->getParam('driver2_incident2_date')) {
				$fields['driver2_incidentDate2'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_incident2_date')));
			}
			if (Yii::app()->request->getParam('driver2_ticket2_description')) {
				$fields['driver2_ticket2Description'] = Yii::app()->request->getParam('driver2_ticket2_description');
			}
			if (Yii::app()->request->getParam('driver2_accident2_description')) {
				$fields['driver2_accident2Description'] = Yii::app()->request->getParam('driver2_accident2_description');
			}
			if (Yii::app()->request->getParam('driver2_accident2_damage')) {
				$fields['driver2_accident2Damage'] = Yii::app()->request->getParam('driver2_accident2_damage');
			}
			if (Yii::app()->request->getParam('driver2_accident2_damage')) {
				$fields['driver2_accident2Atfault'] = Yii::app()->request->getParam('driver2_accident2_at_fault');
			}
			if (Yii::app()->request->getParam('driver2_accident2_amount')) {
				$fields['driver2_accident2Amount'] = Yii::app()->request->getParam('driver2_accident2_amount');
			}
			if (Yii::app()->request->getParam('driver2_violation2_description')) {
				$fields['driver2_violation2Description'] = Yii::app()->request->getParam('driver2_violation2_description');
			}
			if (Yii::app()->request->getParam('driver2_violation2_state')) {
				$fields['driver2_violation2State'] = Yii::app()->request->getParam('driver2_violation2_state');
			}
			if (Yii::app()->request->getParam('driver2_claim2_description')) {
				$fields['driver2_claim2Description'] = Yii::app()->request->getParam('driver2_claim2_description');
			}
			if (Yii::app()->request->getParam('driver2_claim2_paid_amount')) {
				$fields['driver2_claim2PaidAmount'] = Yii::app()->request->getParam('driver2_claim2_paid_amount');
			}
			if (Yii::app()->request->getParam('driver2_incident3_type')) {
				$fields['driver2_incidentType3'] = Yii::app()->request->getParam('driver2_incident3_type');
			}
			if (Yii::app()->request->getParam('driver2_incident3_date')) {
				$fields['driver2_incidentDate3'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_incident3_date')));
			}
			if (Yii::app()->request->getParam('driver2_ticket3_description')) {
				$fields['driver2_ticket3Description'] = Yii::app()->request->getParam('driver2_ticket3_description');
			}
			if (Yii::app()->request->getParam('driver2_accident3_description')) {
				$fields['driver2_accident3Description'] = Yii::app()->request->getParam('driver2_accident3_description');
			}
			if (Yii::app()->request->getParam('driver2_accident3_damage')) {
				$fields['driver2_accident3Damage'] = Yii::app()->request->getParam('driver2_accident3_damage');
			}
			if (Yii::app()->request->getParam('driver2_accident3_at_fault ')) {
				$fields['driver2_accident3Atfault'] = Yii::app()->request->getParam('driver2_accident3_at_fault');
			}
			if (Yii::app()->request->getParam('driver2_accident3_amount')) {
				$fields['driver2_accident3Amount'] = Yii::app()->request->getParam('driver2_accident3_amount');
			}
			if (Yii::app()->request->getParam('driver2_violation3_description')) {
				$fields['driver2_violation3Description'] = Yii::app()->request->getParam('driver2_violation3_description');
			}
			if (Yii::app()->request->getParam('driver2_violation3_state')) {
				$fields['driver2_violation3State'] = Yii::app()->request->getParam('driver2_violation3_state');
			}
			if (Yii::app()->request->getParam('driver2_claim3_description')) {
				$fields['driver2_claim3Description'] = Yii::app()->request->getParam('driver2_claim3_description');
			}
			if (Yii::app()->request->getParam('driver2_claim3_paid_amount')) {
				$fields['driver2_claim3PaidAmount'] = Yii::app()->request->getParam('driver2_claim3_paid_amount');
			}
			if (Yii::app()->request->getParam('driver2_incident4_type')) {
				$fields['driver2_incidentType4'] = Yii::app()->request->getParam('driver2_incident4_type');
			}
			if (Yii::app()->request->getParam('driver2_incident4_date')) {
				$fields['driver2_incidentDate4'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_incident4_date')));
			}
			if (Yii::app()->request->getParam('driver2_ticket4_description')) {
				$fields['driver2_ticket4Description'] = Yii::app()->request->getParam('driver2_ticket4_description');
			}
			if (Yii::app()->request->getParam('driver2_accident4_description')) {
				$fields['driver2_accident4Description'] = Yii::app()->request->getParam('driver2_accident4_description');
			}
			if (Yii::app()->request->getParam('driver2_accident4_damage')) {
				$fields['driver2_accident4Damage'] = Yii::app()->request->getParam('driver2_accident4_damage');
			}
			if (Yii::app()->request->getParam('driver2_accident4_at_fault')) {
				$fields['driver2_accident4Atfault'] = Yii::app()->request->getParam('driver2_accident4_at_fault');
			}
			if (Yii::app()->request->getParam('driver2_accident4_amount')) {
				$fields['driver2_accident4Amount'] = Yii::app()->request->getParam('driver2_accident4_amount');
			}
			if (Yii::app()->request->getParam('driver2_violation4_description')) {
				$fields['driver2_violation4Description'] = Yii::app()->request->getParam('driver2_violation4_description');
			}
			if (Yii::app()->request->getParam('driver2_violation4_state')) {
				$fields['driver2_violation4State'] = Yii::app()->request->getParam('driver2_violation4_state');
			}
			if (Yii::app()->request->getParam('driver2_claim4_description')) {
				$fields['driver2_claim4Description'] = Yii::app()->request->getParam('driver2_claim4_description');
			}
			if (Yii::app()->request->getParam('driver2_claim4_paid_amount')) {
				$fields['driver2_claim4PaidAmount'] = Yii::app()->request->getParam('driver2_claim4_paid_amount');
			}
			
			$pingData['ping_request'] = http_build_query($fields);
			return $pingData;
	    }
    }

    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<Response>(.*)<\/Response>/msui", $ping_response, $result);
        if (trim($result[1]) == 'Accepted' || trim($result[0]) == 'Accepted') {
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
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$InsuranceComapany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer, self::$companyListFromBuyer[1]);
		
		if($promo_code == '8' || $promo_code == 8){
		}else{
			preg_match("/<Confirmation>(.*)<\/Confirmation>/msui", $ping_response, $confirmation_id);
			$home_payment = Yii::app()->request->getParam('home_pay') < 99 ? rand(100, 2000) : Yii::app()->request->getParam('home_pay');
			$fields = array(
				'confirmation_id' => $confirmation_id[1],
				'lead_type' => $parameter1,
				'lead_mode' => $status == 1 ? '1' : '0',
				'vendor_id' => $parameter2,
				'ipaddress' => Yii::app()->request->getParam('ipaddress'),
				'sub_id' => $promo_code,
				'tcpa_optin' => Yii::app()->request->getParam('tcpa_optin',0),
				'tcpa_text' => Yii::app()->request->getParam('tcpa_text'),
				'universal_leadid' =>  Yii::app()->request->getParam('universal_leadid'),
				'xxtrustedformcerturl'=>  Yii::app()->request->getParam('trustedformcerturl'),
				'origination_datetime' => date('Y-m-d H:i:s'),
				'origination_timezone' => '1',
				'zip' => Yii::app()->request->getParam('zip'),
				'email' => Yii::app()->request->getParam('email'),
				'address' => Yii::app()->request->getParam('address'),
				'primary_phone' => str_replace('-','',Yii::app()->request->getParam('phone')),
				'residence_type' => (Yii::app()->request->getParam('is_rented') == 'rent') ? '1' : '1',
				'years_at_residence' => Yii::app()->request->getParam('stay_in_year', '4'),
				'months_at_residence' => Yii::app()->request->getParam('stay_in_month', '3'),
				'credit_rating' => '3', // Fair
				'bankruptcy' => Yii::app()->request->getParam('bankruptcy', '0'),
				'coverageType' => Yii::app()->request->getParam('coverage_type', '3'),
				'vehicle_comprehensiveDeductible' => Yii::app()->request->getParam('vehicle_deductibles', '4'),
				'vehicle_collisionDeductible' => Yii::app()->request->getParam('vehicle_collision_deductibles', '4'),
				'medicalPayment' => Yii::app()->request->getParam('medical_pay', '5'),
				'haveInsurance' => Yii::app()->request->getParam('insurance_policy', '0'),
				'insuranceCompany' => $InsuranceComapany,
				'continuously_insured_period' => Yii::app()->request->getParam('continuously_insured_period', '1'),
				'current_policy_start_date' => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date'))),
				'current_policy_expiration_date' => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
				'driver1_firstname' => Yii::app()->request->getParam('driver1_first_name'),
				'driver1_lastname' => Yii::app()->request->getParam('driver1_last_name'),
				'driver1_gender' => (Yii::app()->request->getParam('driver1_gender') == 'M') ? '0' : '1',
				'driver1_dob' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob'))),
				'driver1_maritalStatus' => Yii::app()->request->getParam('driver1_marital_status', '1'),
				'driver1_education' => Yii::app()->request->getParam('driver1_education', '1'),
				'driver1_occupation' => Yii::app()->request->getParam('driver1_occupation', '1'),
				'driver1_requiredSR22' => Yii::app()->request->getParam('driver1_required_SR22', '0'),
				'driver1_hasTAVCs' => Yii::app()->request->getParam('driver1_hasTAVCs'),
				'driver1_numOfIncidents' => Yii::app()->request->getParam('driver1_num_of_incidents'),
				'driver1_incidentType1' => Yii::app()->request->getParam('driver1_incident1_type'),
				'driver1_incidentDate1' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident1_date'))),
				'driver1_ticket1Description' => Yii::app()->request->getParam('driver1_ticket1_description'),
				'driver1_accident1Description' => Yii::app()->request->getParam('driver1_accident1_description'),
				'driver1_accident1Damage' => Yii::app()->request->getParam('driver1_accident1_damage'),
				'driver1_accident1Atfault' => Yii::app()->request->getParam('driver1_accident1_at_fault'),
				'driver1_accident1Amount' => Yii::app()->request->getParam('driver1_accident1_amount'),
				'driver1_violation1Description' => Yii::app()->request->getParam('driver1_violation1_description'),
				'driver1_violation1State' => Yii::app()->request->getParam('driver1_violation1_state'),
				'driver1_claim1Description' => Yii::app()->request->getParam('driver1_claim1_description'),
				'driver1_claim1PaidAmount' => Yii::app()->request->getParam('driver1_claim1_paid_amount'),
				'driver1_incidentType2' => Yii::app()->request->getParam('driver1_incident2_type'),
				'driver1_incidentDate2' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident2_date'))),
				'driver1_ticket2Description' => Yii::app()->request->getParam('driver1_ticket2_description'),
				'driver1_accident2Description' => Yii::app()->request->getParam('driver1_accident2_description'),
				'driver1_accident2Damage' => Yii::app()->request->getParam('driver1_accident2_damage'),
				'driver1_accident2Atfault' => Yii::app()->request->getParam('driver1_accident2_at_fault'),
				'driver1_accident2Amount' => Yii::app()->request->getParam('driver1_accident2_amount'),
				'driver1_violation2Description' => Yii::app()->request->getParam('driver1_violation2_description'),
				'driver1_violation2State' => Yii::app()->request->getParam('driver1_violation2_state'),
				'driver1_claim2Description' => Yii::app()->request->getParam('driver1_claim2_description'),
				'driver1_claim2PaidAmount' => Yii::app()->request->getParam('driver1_claim2_paid_amount'),
				'driver1_incidentType3' => Yii::app()->request->getParam('driver1_incident3_type'),
				'driver1_incidentDate3' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident3_date'))),
				'driver1_ticket3Description' => Yii::app()->request->getParam('driver1_ticket3_description'),
				'driver1_accident3Description' => Yii::app()->request->getParam('driver1_accident3_description'),
				'driver1_accident3Damage' => Yii::app()->request->getParam('driver1_accident3_damage'),
				'driver1_accident3Atfault' => Yii::app()->request->getParam('driver1_accident3_at_fault'),
				'driver1_accident3Amount' => Yii::app()->request->getParam('driver1_accident3_amount'),
				'driver1_violation3Description' => Yii::app()->request->getParam('driver1_violation3_description'),
				'driver1_violation3State' => Yii::app()->request->getParam('driver1_violation3_state'),
				'driver1_claim3Description' => Yii::app()->request->getParam('driver1_claim3_description'),
				'driver1_claim3PaidAmount' => Yii::app()->request->getParam('driver1_claim3_paid_amount'),
				'driver1_incidentType4' => Yii::app()->request->getParam('driver1_incident4_type'),
				'driver1_incidentDate4' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident4_date'))),
				'driver1_ticket4Description' => Yii::app()->request->getParam('driver1_ticket4_description'),
				'driver1_accident4Description' => Yii::app()->request->getParam('driver1_accident4_description'),
				'driver1_accident4Damage' => Yii::app()->request->getParam('driver1_accident4_damage'),
				'driver1_accident4Atfault' => Yii::app()->request->getParam('driver1_accident4_at_fault'),
				'driver1_accident4Amount' => Yii::app()->request->getParam('driver1_accident4_amount'),
				'driver1_violation4Description' => Yii::app()->request->getParam('driver1_violation4_description'),
				'driver1_violation4State' => Yii::app()->request->getParam('driver1_violation4_state'),
				'driver1_claim4Description' => Yii::app()->request->getParam('driver1_claim4_description'),
				'driver1_claim4PaidAmount' => Yii::app()->request->getParam('driver1_claim4_paid_amount'),
				'vehicle1_year' => Yii::app()->request->getParam('vehicle1_year'),
				'vehicle1_make' => Yii::app()->request->getParam('vehicle1_make'),
				'vehicle1_model' => Yii::app()->request->getParam('vehicle1_model'),
				'vehicle1_subModel' => Yii::app()->request->getParam('vehicle1_submodel'),
				'vehicle1_vin' => Yii::app()->request->getParam('vehicle1_vin'),
				'vehicle1_primaryUse' => Yii::app()->request->getParam('vehicle1_primary_use'),
				'vehicle1_vehicleOwnership' => Yii::app()->request->getParam('vehicle1_vehicle_ownership'),
				'vehicle1_dailyMileage' => Yii::app()->request->getParam('vehicle1_daily_mileage'),
				'vehicle1_annualMileage' => Yii::app()->request->getParam('vehicle1_annual_mileage'),
			);
			if (Yii::app()->request->getParam('vehicle2_year')) {
				$fields['vehicle2_year'] = Yii::app()->request->getParam('vehicle2_year');
			}
			if (Yii::app()->request->getParam('vehicle2_make')) {
				$fields['vehicle2_make'] = Yii::app()->request->getParam('vehicle2_make');
			}
			if (Yii::app()->request->getParam('vehicle2_model')) {
				$fields['vehicle2_model'] = Yii::app()->request->getParam('vehicle2_model');
			}
			if (Yii::app()->request->getParam('vehicle2_submodel')) {
				$fields['vehicle2_subModel'] = Yii::app()->request->getParam('vehicle2_submodel');
			}
			if (Yii::app()->request->getParam('vehicle2_vin')) {
				$fields['vehicle2_vin'] = Yii::app()->request->getParam('vehicle2_vin');
			}
			if (Yii::app()->request->getParam('vehicle2_primary_use')) {
				$fields['vehicle2_primaryUse'] = Yii::app()->request->getParam('vehicle2_primary_use');
			}
			if (Yii::app()->request->getParam('vehicle2_vehicle_ownership')) {
				$fields['vehicle2_vehicleOwnership'] = Yii::app()->request->getParam('vehicle2_vehicle_ownership');
			}
			if (Yii::app()->request->getParam('vehicle2_daily_mileage')) {
				$fields['vehicle2_dailyMileage'] = Yii::app()->request->getParam('vehicle2_daily_mileage');
			}
			if (Yii::app()->request->getParam('vehicle2_annual_mileage')) {
				$fields['vehicle1_annualMileage'] = Yii::app()->request->getParam('vehicle2_annual_mileage');
			}
			// DRIVER 2
			if (Yii::app()->request->getParam('driver2_first_name')) {
				$fields['driver2_firstname'] = Yii::app()->request->getParam('driver2_first_name');
			}
			if (Yii::app()->request->getParam('driver2_last_name')) {
				$fields['driver2_lastname'] = Yii::app()->request->getParam('driver2_last_name');
			}
			if (Yii::app()->request->getParam('driver2_gender')) {
				$fields['driver2_gender'] = (Yii::app()->request->getParam('driver2_gender') == 'M') ? '0' : '1';
			}
			if (Yii::app()->request->getParam('driver2_dob')) {
				$fields['driver2_dob'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob')));
			}
			if (Yii::app()->request->getParam('driver2_relationship_to_applicant')) {
				$fields['driver2_relationshipToApplicant'] = Yii::app()->request->getParam('driver2_relationship_to_applicant');
			}
			if (Yii::app()->request->getParam('driver2_marital_status')) {
				$fields['driver2_maritalStatus'] = Yii::app()->request->getParam('driver2_marital_status');
			}
			if (Yii::app()->request->getParam('driver2_education')) {
				$fields['driver2_education'] = Yii::app()->request->getParam('driver2_education');
			}
			if (Yii::app()->request->getParam('driver2_occupation')) {
				$fields['driver2_occupation'] = Yii::app()->request->getParam('driver2_occupation');
			}
			if (Yii::app()->request->getParam('driver2_required_SR22')) {
				$fields['driver2_requiredSR22'] = Yii::app()->request->getParam('driver2_required_SR22');
			}
			if (Yii::app()->request->getParam('driver2_hasTAVCs')) {
				$fields['driver2_hasTAVCs'] = Yii::app()->request->getParam('driver2_hasTAVCs');
			}
			if (Yii::app()->request->getParam('driver2_num_of_incidents')) {
				$fields['driver2_numOfIncidents'] = Yii::app()->request->getParam('driver2_num_of_incidents');
			}
			if (Yii::app()->request->getParam('driver2_incident1_type')) {
				$fields['driver2_incidentType1'] = Yii::app()->request->getParam('driver2_incident1_type');
			}
			if (Yii::app()->request->getParam('driver2_incident1_date')) {
				$fields['driver2_incidentDate1'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_incident1_date')));
			}
			if (Yii::app()->request->getParam('driver2_ticket1_description')) {
				$fields['driver2_ticket1Description'] = Yii::app()->request->getParam('driver2_ticket1_description');
			}
			if (Yii::app()->request->getParam('driver2_accident1_description')) {
				$fields['driver2_accident1Description'] = Yii::app()->request->getParam('driver2_accident1_description');
			}
			if (Yii::app()->request->getParam('driver2_accident1_damage')) {
				$fields['driver2_accident1Damage'] = Yii::app()->request->getParam('driver2_accident1_damage');
			}
			if (Yii::app()->request->getParam('driver2_accident1_at_fault')) {
				$fields['driver2_accident1Atfault'] = Yii::app()->request->getParam('driver2_accident1_at_fault');
			}
			if (Yii::app()->request->getParam('driver2_accident1_amount')) {
				$fields['driver2_accident1Amount'] = Yii::app()->request->getParam('driver2_accident1_amount');
			}
			if (Yii::app()->request->getParam('driver2_violation1_description')) {
				$fields['driver2_violation1Description'] = Yii::app()->request->getParam('driver2_violation1_description');
			}
			if (Yii::app()->request->getParam('driver2_violation1_state')) {
				$fields['driver2_violation1State'] = Yii::app()->request->getParam('driver2_violation1_state');
			}
			if (Yii::app()->request->getParam('driver2_claim1_description')) {
				$fields['driver2_claim1Description'] = Yii::app()->request->getParam('driver2_claim1_description');
			}
			if (Yii::app()->request->getParam('driver2_claim1_paid_amount')) {
				$fields['driver2_claim1PaidAmount'] = Yii::app()->request->getParam('driver2_claim1_paid_amount');
			}
			if (Yii::app()->request->getParam('driver2_incident2_type')) {
				$fields['driver2_incidentType2'] = Yii::app()->request->getParam('driver2_incident2_type');
			}
			if (Yii::app()->request->getParam('driver2_incident2_date')) {
				$fields['driver2_incidentDate2'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_incident2_date')));
			}
			if (Yii::app()->request->getParam('driver2_ticket2_description')) {
				$fields['driver2_ticket2Description'] = Yii::app()->request->getParam('driver2_ticket2_description');
			}
			if (Yii::app()->request->getParam('driver2_accident2_description')) {
				$fields['driver2_accident2Description'] = Yii::app()->request->getParam('driver2_accident2_description');
			}
			if (Yii::app()->request->getParam('driver2_accident2_damage')) {
				$fields['driver2_accident2Damage'] = Yii::app()->request->getParam('driver2_accident2_damage');
			}
			if (Yii::app()->request->getParam('driver2_accident2_damage')) {
				$fields['driver2_accident2Atfault'] = Yii::app()->request->getParam('driver2_accident2_at_fault');
			}
			if (Yii::app()->request->getParam('driver2_accident2_amount')) {
				$fields['driver2_accident2Amount'] = Yii::app()->request->getParam('driver2_accident2_amount');
			}
			if (Yii::app()->request->getParam('driver2_violation2_description')) {
				$fields['driver2_violation2Description'] = Yii::app()->request->getParam('driver2_violation2_description');
			}
			if (Yii::app()->request->getParam('driver2_violation2_state')) {
				$fields['driver2_violation2State'] = Yii::app()->request->getParam('driver2_violation2_state');
			}
			if (Yii::app()->request->getParam('driver2_claim2_description')) {
				$fields['driver2_claim2Description'] = Yii::app()->request->getParam('driver2_claim2_description');
			}
			if (Yii::app()->request->getParam('driver2_claim2_paid_amount')) {
				$fields['driver2_claim2PaidAmount'] = Yii::app()->request->getParam('driver2_claim2_paid_amount');
			}
			if (Yii::app()->request->getParam('driver2_incident3_type')) {
				$fields['driver2_incidentType3'] = Yii::app()->request->getParam('driver2_incident3_type');
			}
			if (Yii::app()->request->getParam('driver2_incident3_date')) {
				$fields['driver2_incidentDate3'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_incident3_date')));
			}
			if (Yii::app()->request->getParam('driver2_ticket3_description')) {
				$fields['driver2_ticket3Description'] = Yii::app()->request->getParam('driver2_ticket3_description');
			}
			if (Yii::app()->request->getParam('driver2_accident3_description')) {
				$fields['driver2_accident3Description'] = Yii::app()->request->getParam('driver2_accident3_description');
			}
			if (Yii::app()->request->getParam('driver2_accident3_damage')) {
				$fields['driver2_accident3Damage'] = Yii::app()->request->getParam('driver2_accident3_damage');
			}
			if (Yii::app()->request->getParam('driver2_accident3_at_fault ')) {
				$fields['driver2_accident3Atfault'] = Yii::app()->request->getParam('driver2_accident3_at_fault');
			}
			if (Yii::app()->request->getParam('driver2_accident3_amount')) {
				$fields['driver2_accident3Amount'] = Yii::app()->request->getParam('driver2_accident3_amount');
			}
			if (Yii::app()->request->getParam('driver2_violation3_description')) {
				$fields['driver2_violation3Description'] = Yii::app()->request->getParam('driver2_violation3_description');
			}
			if (Yii::app()->request->getParam('driver2_violation3_state')) {
				$fields['driver2_violation3State'] = Yii::app()->request->getParam('driver2_violation3_state');
			}
			if (Yii::app()->request->getParam('driver2_claim3_description')) {
				$fields['driver2_claim3Description'] = Yii::app()->request->getParam('driver2_claim3_description');
			}
			if (Yii::app()->request->getParam('driver2_claim3_paid_amount')) {
				$fields['driver2_claim3PaidAmount'] = Yii::app()->request->getParam('driver2_claim3_paid_amount');
			}
			if (Yii::app()->request->getParam('driver2_incident4_type')) {
				$fields['driver2_incidentType4'] = Yii::app()->request->getParam('driver2_incident4_type');
			}
			if (Yii::app()->request->getParam('driver2_incident4_date')) {
				$fields['driver2_incidentDate4'] = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_incident4_date')));
			}
			if (Yii::app()->request->getParam('driver2_ticket4_description')) {
				$fields['driver2_ticket4Description'] = Yii::app()->request->getParam('driver2_ticket4_description');
			}
			if (Yii::app()->request->getParam('driver2_accident4_description')) {
				$fields['driver2_accident4Description'] = Yii::app()->request->getParam('driver2_accident4_description');
			}
			if (Yii::app()->request->getParam('driver2_accident4_damage')) {
				$fields['driver2_accident4Damage'] = Yii::app()->request->getParam('driver2_accident4_damage');
			}
			if (Yii::app()->request->getParam('driver2_accident4_at_fault')) {
				$fields['driver2_accident4Atfault'] = Yii::app()->request->getParam('driver2_accident4_at_fault');
			}
			if (Yii::app()->request->getParam('driver2_accident4_amount')) {
				$fields['driver2_accident4Amount'] = Yii::app()->request->getParam('driver2_accident4_amount');
			}
			if (Yii::app()->request->getParam('driver2_violation4_description')) {
				$fields['driver2_violation4Description'] = Yii::app()->request->getParam('driver2_violation4_description');
			}
			if (Yii::app()->request->getParam('driver2_violation4_state')) {
				$fields['driver2_violation4State'] = Yii::app()->request->getParam('driver2_violation4_state');
			}
			if (Yii::app()->request->getParam('driver2_claim4_description')) {
				$fields['driver2_claim4Description'] = Yii::app()->request->getParam('driver2_claim4_description');
			}
			if (Yii::app()->request->getParam('driver2_claim4_paid_amount')) {
				$fields['driver2_claim4PaidAmount'] = Yii::app()->request->getParam('driver2_claim4_paid_amount');
			}
			//echo '<pre>';print_r($fields);die();
			$post_request = http_build_query($fields);
			//echo '<pre>';print_r($post_request);
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			$post_response = $cm->curl($post_url, $post_request);
			$time_end = CommonToolsMethods::stopwatch();
			//echo '<pre>';print_r($ping_response);die();
			preg_match("/<Response>(.*)<\/Response>/", $post_response, $success);
			//echo '<pre>';print_r();die();
			if (trim($success[1]) == 'Accepted') {
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

}

?>
