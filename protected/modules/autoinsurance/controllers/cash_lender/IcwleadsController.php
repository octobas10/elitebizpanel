<?php
class IcwleadsController extends Controller {
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
            1 => '5',
            2 => '2',
            3 => '3',
            4 => '1',
            5 => '1'
        );
    public static $CreditRating = array(
            1 => '4',
            2 => '3',
            3 => '2',
            4 => '1'
        );
    public static $converageType = array(
            1 => '4',
            2 => '3',
            3 => '2',
            4 => '1'
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
    public static $occupationListFromBuyer = array("Other/Not Listed","Advertising","Arts/Entertainment","Banking/Mortgage","Clergy/Religious","Clerical/Administrative","Construction/Facilities","CPA/Auditor","Customer Service/Teller","Disabled","Doctor/Dentist","Engineer/Architect","Government","Health Care","Homemaker","Hospitality/Travel","Human Resources","Insurance","Internet/New Media","Law Enforcement","Lawyer","Management Consulting","Manufacturing","Marketing","Military/Defense","Non-Profit/Volunteer","Pharmaceutical/Biotech","Real Estate","Restaurant/Food Service","Retail","Retired","Sales","Self Employed","Skilled Worked","Student","Teacher/Education","Technology","Telecommunications","Transportation/Logistics","Unemployed"
	);
    public static $companyListFromBuyer = array("Company Not Listed","21st Century Insurance","AAA Insurance Co.","AABCO","AARP","Access Insurance","Acordia","Aegis Security","Aetna","Affirmative","Aflac","AHCP","AIG","AIU Insurance","Alfa Insurance","All Nation","All Risk","Alleghany Corporation","Allianz","Allied Group","Allied","Allmerica","Allstate Insurance","American Alliance Ins Co","American Automobile Insurance","American Banks","American Casualty","American Deposit Insurance","American Direct Business Insurance","American Economy Ins Co","American Empire Insurance","American Family Insurance","American Financial","American Health Underwriters","American Home Assurance","American Income Life Insurance Company","American Insurance","American International Ins","American International Pacific","American International South","American Manufacturers","American Mayflower Insurance","American Medical Securities","American Motorists Insurance","American National Insurance","American National Property and Casualty","American Premier","American Protection Insurance","American Reliable Ins Co","American Republic","American Savers Plan","American Service Insurance","American Skyline Insurance Company","American Spirit Insurance","American Standard Insurance - OH","American Standard Insurance - WI","American States","Americas Ins. Consultants","AmeriPlan","Ameriprise","Amerisure","Ameritas Life Insurance Company","Amex Assurance Co","Amica Insurance","Amica Mutual Ins Co","Answer Financial","Anthem","API","Arbella","Arizona General","Armed Forces Insurance","Assigned Risk","Associated Indemnity","Associated Insurance Managers","Assurant","Atlanta Casualty","Atlanta Specialty","Atlantic Indemnity","Atlantic Mutual Co","Atlantis","Austin Mutual","Auto Club Insurance Company","Auto Owners","Avomark","AXA Equitable Life Insurance Company","Badger Mutual","Bankers Life and Casualty Company","Banner Life","Berkshire Hathaway","Best Agency USA","Blue Cross / Blue Shield","Bonneville","Boston Old Colony","Builders","Cal Farm Insurance","Calfarm Ins Co","California Casualty and Fire Ins Co","California State Automobile Association","Camden","Capital Choice","Cascade National Ins","Casualty Assurance","Centennial","Century National Ins","Charter Oak","Chartis","Chase Insurance Group","Chicago Insurance","Chubb Group of Ins Co","Church Mutual","Cigna","Cincinnati Insurance Company","Citizens","Clarendon National Insurance","Clarendon","Cloverleaf","CNA","Colonial Penn","Colonial","Combined","Commerce Insurance Group","Commerce West","Commercial Union","Commonwealth","Conseco","Continental Casualty","Continental Divide Insurance","Continental Insurance","Cotton States Insurance","Cottonwood","Country Financial","Countrywide Insurance","Criterion","CSE Insurance Group","CUNA Mutual","Dairyland Insurance","Dakota Fire","Deerbrook","Depositors Emcasc","Direct General Insurance","Dixie","Eagle Ins Co","Ebco General","eFinancial","eHealth","Electric Insurance","Elephant","EMC","Empire Fire and Marine","Employers Fire","Encompass Insurance Company","Ensure","Equitable Life","Erie Insurance Company","Esurance","Evergreen USA RRG","Explorer","Facility","Farm and Ranch","Farm Bureau/Farm Family/Rural","Farmers Insurance","Farmers Union","Farmland","Federal Ins Co","Federated Mutual Insurance Company","Fidelity Insurance Company","Financial Indemnity","Fire and Casualty Insurance Co of CT","Firemans Fund","First Acceptance Insurance","First American","First Financial","First General","First Insurance Company of Hawaii, LTD","First National","FM Global","Ford Motor Credit","Foremost","Foresters","Fortis","Franklin","GAINSCO","Geico Casualty","Geico","General Accident Insurance","General Re","Genworth Financial","Globe","GMAC Insurance","Grange","GRE Harleysville H","Great American Ins Co","Great Way","Great West Casualty Company","Grinnell Mutual","Guaranty National Insurance","Guardian Life Insurance Company of America","Guide One Insurance","Halcyon","Hanover Ins Co","Hanover Lloyds Insurance Company","Happy Days","Hartford Accident and Indemnity","Hawkeye Security","HCC Insurance Holdings","Health Benefits Direct","Health Choice One","Health Net","Health Plus of America","HealthMarkets","HealthShare American","Heritage","Home State County Mutual","Horace Mann","Humana","IAB","IFA Auto Insurance","IGF","IIS Insurance","Infinity Insurance","Infinity Select Insurance","Insphere Insurance Solutions","Insur. of Evanston","Insurance Co of the West","Insurance Insight","Integon","Interstate","Jackson National Life","John Deere","John Hancock Insurance","Kaiser Permanente","Kemper Insurance","Kentucky Central","Kentucky Farm Bureau","Knights of Columbus","Landmark American Insurance","Leader Insurance","Leader National","Leader Preferred Insurance","Leader Specialty Insurance","League General","Liberty Insurance Corp","Liberty Mutual Insurance","Liberty National","Liberty Northwest Insurance","Lincoln Benefit Life","Lincoln National Corporation","LTC Financial Partners","Lumbermens Mutual","Marathon","Markel Corporation","Maryland Casualty","MassMutual Financial Group","Matrix Direct","MEGA Life and Health","Mega/Midwest","Mendota","Merastar","Merchants Insurance Group","Mercury","MetLife Auto and Home","MetLife","Mid Century Insurance","Mid-Continent Casualty","Middlesex Insurance","Midland National Life","Midwest Mutual","Millbank","Millers Mutual","Milwaukee","Minnehoma","Missouri General","Modern Woodmen of America","Mortgage Protection Bureau","Motors","Mountain Laurel","Mutual Insurance","Mutual Of Enumclaw","Mutual of New York","Mutual of Omaha","National Alliance","National Ben Franklin Insurance","National Casualty","National Colonial","National Continental Insurance","National Fire Insurance Company of Hartford","National Health Insurance","National Indemnity","National Merit","National Surety Corp","National Union Fire Insurance","Nationwide General Insurance","Nationwide Mutual Insurance Company","Natl Farmers Union","New England Financial","New Jersey Manufacturers Insurance Company","New York Life Insurance Company","NJ Skylands Insurance","North American","North Pacific","North Pointe","North Shore","Northern Capital","Northern States","Northland","Northwestern Mutual Life","Northwestern Pacific Indemnity","Ohio Casualty","Ohio Security","Olympia","Omega","Omni Insurance","OneBeacon","Oregon Mutual","Orion Insurance","Other","Oxford Health Plans","Pacific Indemnity","Pacific Insurance","Pacific Life","Pacificare","Pafco","Paloverde","Patriot General Insurance","Peak Property and Casualty Insurance","PEMCO Insurance","Penn America","Penn Mutual","Pennsylvania Natl","Philadelphia Insurance Companies","Phoenix","Physicians","Pinnacle","Pioneer Life","Plymouth Rock Assurance","Preferred Mutual","Premier","Prestige","Primerica","Principal Financial","Progressive","Protective Life","Provident","Prudential Insurance Co.","QBE Insurance","Quality","Ramsey","RBC Liberty Insurance","Regal","Reliance Insurance Company","Reliant","Republic Indemnity","Response Insurance","RLI Corp.","Rockford Mutual","Rodney D. Young","Safe Auto Insurance Company","SAFECO","Safeguard","Safeway Insurance","Sea West Insurance","Security Insurance","Security National","Sedgwick James","Selective Insurance","Sentinel Insurance","Sentry Insurance Group","Shelter Insurance Co.","Skandia TIG Tita","Southern Aid and Insurance Company","Spectrum","St. Paul Fire and Marine Ins Co","St. Paul","Standard Fire Insurance Company","Standard Guaranty","Standard Insurance Company","State and County Mutual Fire Insurance","State Auto Ins Co","State Farm County","State Farm Insurance","State Mutual","State National Insurance","Sun Coast","Sun Life Financial","Superior American Insurance","Superior Guaranty Insurance","Superior Insurance","Superior","Sutter","Symetra","The Ahbe Group","The Credo Group","The General","The Hartford","The Regence Group","TIAA-CREF","TICO Insurance","TIG Countrywide Insurance","Titan","Total","Tower","TransAmerica","Travelers Insurance Company","Trinity Universal","Tri-State Consumer Insurance","Trupanion","Trust Hall","Twin City Fire Insurance","Unicare","Unigard Ins","Union","United American","United Financial","United Fire Group","United Security","United Services Automobile Association","Unitrin Direct","Universal Underwriters Insurance","Unum","US Financial","US Health Advisors","USA Benefits/Continental General","USAA","USF and G","Utah Home and Fire","Utica","Vasa North Atlantic","Vigilant","Viking","Wawanesa Mutual","Wellington","Wellpoint","West American","West Bend Mutual","West Coast Life","West Plains","Western and Southern Life","Western Mutual Insurance Group","Western National","Western Southern Life","White Mountains Insurance Group","William Penn","Windsor","Windstar","Wisconsin Mutual","Woodlands Financial Group","Workmens Auto Insurance","World Insurance","Worldwide","Yellow Key","Yosemite","Zurich North America");

    public function __construct() {
    }

    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
    	$TestMode ='0';
    	$submission_model = new Submissions();
        $pingData = array();
        $p1 = $p1 ? $p1 : '4';
        $p2 = $p2 ? $p2 : '185';
        $p3 = $p3 ? $p3 : 'a65ef435705ac69a7c3b4134c345cc05';
		$IPAddress = Yii::app()->request->getParam('ipaddress');
		$LeadDateTime = date('Y-m-d H:i:s');
		$TCPAOptin = Yii::app()->request->getParam('tcpa_optin','0');
		$TCPAText = Yii::app()->request->getParam('tcpa_text');
		$UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
		$SubID = Yii::app()->request->getParam('sub_id');
		$url = Yii::app()->request->getParam('url','https://eliteinsurers.com');
		$promo_code = Yii::app()->request->getParam('promo_code');
		$zip = Yii::app()->request->getParam('zip');
		$phone = Yii::app()->request->getParam('phone');
		$last_4_phone = substr($phone, 6,4);
		$phone2 = Yii::app()->request->getParam('phone2');
		$residence_type = (Yii::app()->request->getParam('is_rented') == 'rent') ? '2' : '1';
		$years_at_residence = Yii::app()->request->getParam('stay_in_year', '4');
		$months_at_residence = Yii::app()->request->getParam('stay_in_month', '3');
		$credit_rating = Yii::app()->request->getParam('credit_rating', '3');
		$bankruptcy = Yii::app()->request->getParam('bankruptcy', '0');
		$coverageType = Yii::app()->request->getParam('coverage_type', '3');
		$vehicle_comprehensiveDeductible = Yii::app()->request->getParam('vehicle_deductibles', '4');
		$vehicle_collisionDeductible = Yii::app()->request->getParam('vehicle_collision_deductibles', '4');
		$medicalPayment = Yii::app()->request->getParam('medical_pay', '5');
		$haveInsurance = Yii::app()->request->getParam('insurance_policy', '0');
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$driver1_occupation = $driver1_occupation == '' ? 'Company Not Listed' : $driver1_occupation;
		$continuously_insured_period = Yii::app()->request->getParam('continuously_insured_period', '1');
		$current_policy_start_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date')));
		if($current_policy_start_date == date('Y-m-d')){
			$current_policy_start_date = date('Y-m-d', strtotime(' - 30 days'));
		}
		$current_policy_expiration_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date',date('Y-m-d',time()+rand(60,90)*86400))));
		$driver1_gender = (Yii::app()->request->getParam('driver1_gender')=='M') ? '1' : '2';
		$driver1_dob  = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob')));
		$driver1_maritalStatus  = Yii::app()->request->getParam('driver1_marital_status', '1');
		$driver1_education  = Yii::app()->request->getParam('driver1_education', '1');
		$driver1_education = $driver1_education - 1;
		$driver1_education = $driver1_education > 7 ? 1 : $driver1_education;
		$driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver1_occupation'));
		$driver1_requiredSR22  = Yii::app()->request->getParam('driver1_required_SR22', '0');
		$converage_type = Yii::app()->request->getParam('coverage_type', '1');
		$city_state = $submission_model->getCityStateFromZip($zip);
		$license_state = $city_state['state'] ? $city_state['state'] : 'NY';
		$trustedformcerturl  = Yii::app()->request->getParam('trustedformcerturl', $url);
		$request = '<?xml version="1.0"?>
					<Request>
						<CampaignID>'.$p1.'</CampaignID>
						<VendorID>'.$p2.'</VendorID>
						<APIKey>'.$p3.'</APIKey>
						<SubID>'.$SubID.'</SubID>
						<xxTrustedFormCertUrl>'.$trustedformcerturl.'</xxTrustedFormCertUrl>
						<UniversalLeadID>'.$UniversalLeadID.'</UniversalLeadID>
						<UserAgent></UserAgent>
						<IPAddress>'.$IPAddress.'</IPAddress>
						<LeadDateTime>'.$LeadDateTime.'</LeadDateTime>
						<LeadTimeZone>EST</LeadTimeZone>
						<TCPAOptin>'.$TCPAOptin.'</TCPAOptin>
						<TCPAText>'.$TCPAText.'</TCPAText>
						<URL>'.$url.'</URL>
						<PreferredPhoneLastFour>'.$last_4_phone.'</PreferredPhoneLastFour>
						<PreferredPhone>'.$phone2.'</PreferredPhone>
						<Zip>'.$zip.'</Zip>
						<CurrentCoverageType>'.self::$converageType[$converage_type].'</CurrentCoverageType>
						<CurrentInsuranceCompany>'.$insuranceCompany.'</CurrentInsuranceCompany>
						<CurrentPolicyExpires>'.$current_policy_expiration_date.'</CurrentPolicyExpires>
						<InsuredSince>'.$current_policy_start_date.'</InsuredSince>
						<YearsContinuouslyInsured>'.$continuously_insured_period.'</YearsContinuouslyInsured>
						<RequestedCoverageType>'.self::$converageType[$converage_type].'</RequestedCoverageType>
						<RequestedBodilyInjury>'.self::$bodilyInjury[$converage_type].'</RequestedBodilyInjury>
						<RequestedPropertyDamage></RequestedPropertyDamage>
						<RequestedUninsuredMotoristCover>'.rand(0,1).'</RequestedUninsuredMotoristCover>
						<Drivers>';
						$request .='<Driver>
								<RelationshipToApplicant>1</RelationshipToApplicant>
								<DOB>'.$driver1_dob.'</DOB>
								<MaritalStatus>'.$driver1_maritalStatus.'</MaritalStatus>
								<Gender>'.$driver1_gender.'</Gender>
								<LicenseStatus>1</LicenseStatus>
								<LicenseState>'.$license_state.'</LicenseState>
								<LicenseEverSuspended>0</LicenseEverSuspended>
								<LicenseSinceAge></LicenseSinceAge>
								<ResidenceType>'.$residence_type.'</ResidenceType>
								<ResidenceYears>'.$years_at_residence.'</ResidenceYears>
								<ResidenceMonths>'.$months_at_residence.'</ResidenceMonths>
								<Occupation>'.$driver1_occupation.'</Occupation>
								<EmploymentYears></EmploymentYears>
								<EmploymentMonths></EmploymentMonths>
								<EducationLevel>'.$driver1_education.'</EducationLevel>
								<RequiresSR22>'.$driver1_requiredSR22.'</RequiresSR22>
								<Bankruptcy>'.$bankruptcy.'</Bankruptcy>
								<DefensiveDriverCourse></DefensiveDriverCourse>
								<StudentDiscount></StudentDiscount>
								<CreditRating>'.self::$CreditRating[$credit_rating].'</CreditRating>';

								if (Yii::app()->request->getParam('driver1_hasTAVCs')) {
								for ($i = 1; $i <= Yii::app()->request->getParam('driver1_num_of_incidents'); $i++){
                                $driver1_incidentDate=date('Y-m-d',strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date')));
                                $driver1_AccidentType = Yii::app()->request->getParam('driver1_accident'.$i.'_description');
                                $driver1_AccidentDamange = Yii::app()->request->getParam('driver1_accident'.$i.'_damange');
								switch (Yii::app()->request->getParam("driver1_incident".$i."_type")) {
								case 1:
								$request .='<Tickets>
									<Ticket>
										<TicketDate>'.$driver1_incidentDate.'</TicketDate>
										<TicketType>'.Yii::app()->request->getParam('driver1_ticket'.$i.'_description').'</TicketType>
										<TicketState>'.$city_state['state'].'</TicketState>
									</Ticket>
								</Tickets>';
								break;
								case 2:
								$request .='<Violations>
									<Violation>
										<ViolationDate>'. $driver1_incidentDate.'</ViolationDate>
										<ViolationType>'.Yii::app()->request->getParam('driver1_violation_'.$i.'_description').'</ViolationType>
										<ViolationState>'.Yii::app()->request->getParam("driver1_violation_".$i."_state").'</ViolationState>
									</Violation>
								</Violations>';
								break;
                                case 3:
								$request .='<Accidents>
									<Accident>
										<AccidentDate>'.$driver1_incidentDate.'</AccidentDate>
										<AccidentType>'.self::$AccidentType[$driver1_AccidentType].'</AccidentType>
										<DriverAtFault>'.$driver1_AccidentType.'</DriverAtFault>
										<Damage>'.$driver1_AccidentDamange.'</Damage>
									</Accident>
								</Accidents>';
                                break;
                                case 4:
								$request .='<Claims>
									<Claim>
										<ClaimDate>'.$driver1_incidentDate.'</ClaimDate>
										<ClaimType>'.Yii::app()->request->getParam('driver1_claim'.$i.'_description').'</ClaimType>
										<DriverAtFault>'.Yii::app()->request->getParam('driver1_accident'.$i.'_at_fault').'</DriverAtFault>
										<PaidAmount>'.Yii::app()->request->getParam('driver1_accident'.$i.'_amount').'</PaidAmount>
									</Claim>
								</Claims>';
								break;
                                }
								}
                            }
							$request .='</Driver>';
							if (Yii::app()->request->getParam('driver2_gender')) {
							$driver2_gender = (Yii::app()->request->getParam('driver2_gender')=='M') ? '1' : '2';
							$driver2_dob  = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob')));
							$driver2_maritalStatus  = Yii::app()->request->getParam('driver2_marital_status', '1');
							$driver2_education  = Yii::app()->request->getParam('driver2_education', '1');
							$driver2_education  -= $driver2_education;

							$driver2_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver2_occupation'));
							
							$driver2_requiredSR22  = Yii::app()->request->getParam('driver2_required_SR22', '0');
							$request .='<Driver>
								<RelationshipToApplicant>1</RelationshipToApplicant>
								<DOB>'.$driver2_dob.'</DOB>
								<MaritalStatus>'.$driver2_maritalStatus.'</MaritalStatus>
								<Gender>'.$driver2_gender.'</Gender>
								<LicenseStatus>1</LicenseStatus>
								<LicenseState>'.$license_state.'</LicenseState>
								<LicenseEverSuspended>0</LicenseEverSuspended>
								<LicenseSinceAge></LicenseSinceAge>
								<ResidenceType>'.$residence_type.'</ResidenceType>
								<ResidenceYears>'.$years_at_residence.'</ResidenceYears>
								<ResidenceMonths>'.$months_at_residence.'</ResidenceMonths>
								<Occupation>'.$driver2_occupation.'</Occupation>
								<EmploymentYears></EmploymentYears>
								<EmploymentMonths></EmploymentMonths>
								<EducationLevel>'.$driver2_education.'</EducationLevel>
								<RequiresSR22>'.$driver2_requiredSR22.'</RequiresSR22>
								<Bankruptcy>'.$bankruptcy.'</Bankruptcy>
								<DefensiveDriverCourse></DefensiveDriverCourse>
								<StudentDiscount></StudentDiscount>
								<CreditRating>'.self::$CreditRating[$credit_rating].'</CreditRating>';
								if (Yii::app()->request->getParam('driver2_hasTAVCs')) {
								for ($i = 1; $i <= Yii::app()->request->getParam('driver1_num_of_incidents'); $i++){
                                $driver2_incidentDate=date('Y-m-d',strtotime(Yii::app()->request->getParam('driver2_incident'.$i.'_date')));
                                $driver2_AccidentType = Yii::app()->request->getParam('driver2_accident'.$i.'_description');
                                $driver2_AccidentDamange = Yii::app()->request->getParam('driver2_accident'.$i.'_damange');
								switch (Yii::app()->request->getParam("driver2_incident".$i."_type")) {
								case 1:
								$request .='<Tickets>
									<Ticket>
										<TicketDate>'.$driver2_incidentDate.'</TicketDate>
										<TicketType>'.Yii::app()->request->getParam('driver2_ticket'.$i.'_description').'</TicketType>
										<TicketState>'.$city_state['state'].'</TicketState>
									</Ticket>
								</Tickets>';
								break;
								case 2:
								$request .='<Violations>
									<Violation>
										<ViolationDate>'. $driver2_incidentDate.'</ViolationDate>
										<ViolationType>'.Yii::app()->request->getParam('driver2_violation_'.$i.'_description').'</ViolationType>
										<ViolationState>'.Yii::app()->request->getParam("driver2_violation_".$i."_state").'</ViolationState>
									</Violation>
								</Violations>';
								break;
                                case 3:
								$request .='<Accidents>
									<Accident>
										<AccidentDate>'.$driver2_incidentDate.'</AccidentDate>
										<AccidentType>'.self::$AccidentType[$driver2_AccidentType].'</AccidentType>
										<DriverAtFault>'.$driver2_AccidentType.'</DriverAtFault>
										<Damage>'.$driver2_AccidentDamange.'</Damage>
									</Accident>
								</Accidents>';
                                break;
                                case 4:
								$request .='<Claims>
									<Claim>
										<ClaimDate>'.$driver2_incidentDate.'</ClaimDate>
										<ClaimType>'.Yii::app()->request->getParam('driver2_claim'.$i.'_description').'</ClaimType>
										<DriverAtFault>'.Yii::app()->request->getParam('driver2_accident'.$i.'_at_fault').'</DriverAtFault>
										<PaidAmount>'.Yii::app()->request->getParam('driver2_accident'.$i.'_amount').'</PaidAmount>
									</Claim>
								</Claims>';
								break;
                                }
								}
                            }
							$request .='</Driver>';
							}
						$request .='</Drivers>
						<Vehicles>
							<Vehicle>
								<Year>'.Yii::app()->request->getParam('vehicle1_year').'</Year>
								<Make>'.Yii::app()->request->getParam('vehicle1_make').'</Make>
								<Model>'.Yii::app()->request->getParam('vehicle1_model').'</Model>
								<SubModel>'.Yii::app()->request->getParam('vehicle1_submodel').'</SubModel>
								<VIN>'.Yii::app()->request->getParam('vehicle1_vin').'</VIN>
								<Salvaged>0</Salvaged>
								<Alarm>0</Alarm>
								<ABS>1</ABS>
								<OvernightParking>'.rand(1,5).'</OvernightParking>
								<Ownership>'.Yii::app()->request->getParam('vehicle1_vehicle_ownership').'</Ownership>
								<PrimaryDriver>1</PrimaryDriver>
								<PrimaryUse>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_primary_use')].'</PrimaryUse>
								<AnnualMiles>'.self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage')].'</AnnualMiles>
								<WeeklyCommuteDays>3</WeeklyCommuteDays>
								<OneWayDistance>'.self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')].'</OneWayDistance>
								<ComprehensiveDeductible>'.Yii::app()->request->getParam('vehicle_deductibles').'</ComprehensiveDeductible>
								<CollisionDeductible>'.Yii::app()->request->getParam('vehicle_collision_deductibles').'</CollisionDeductible>
								<Restraint>1</Restraint>
								<AutomaticSeatBelts>1</AutomaticSeatBelts>
								<Airbags>1</Airbags>
								<Towing>1</Towing>
								<FourWheelDrive>1</FourWheelDrive>
								<Rental>0</Rental>
							</Vehicle>
						</Vehicles>
					</Request>';
        
        //$pingData['ping_request'] = http_build_query($fields);
		//echo $request;exit;
		$pingData['ping_request'] = $request;
        return $pingData;
    }

    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<Response>(.*)<\/Response>/msui", $ping_response, $result);
        if (trim($result[1]) == 'Accepted' || trim(strtolower($result[1])) == 'accepted') {
            preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $price);
            preg_match("/<PingID>(.*)<\/PingID>/msui", $ping_response, $confirmation_id);
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
		$TestMode ='0';
    	$submission_model = new Submissions();
    	$p1 = $p1 ? $p1 : '4';
        $p2 = $p2 ? $p2 : '185';
        $p3 = $p3 ? $p3 : 'a65ef435705ac69a7c3b4134c345cc05';
        $UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
		$IPAddress = Yii::app()->request->getParam('ipaddress');
		$LeadDateTime = date('Y-m-d H:i:s');
		$TCPAOptin = Yii::app()->request->getParam('tcpa_optin','0');
		$TCPAText = Yii::app()->request->getParam('tcpa_text');
		$SubID = Yii::app()->request->getParam('sub_id');
		$url = Yii::app()->request->getParam('url','https://eliteinsurers.com');
		$promo_code = Yii::app()->request->getParam('promo_code');
		$first_name = Yii::app()->request->getParam('driver1_first_name');
		$last_name = Yii::app()->request->getParam('driver1_last_name');
		$email = Yii::app()->request->getParam('email');
		$address = Yii::app()->request->getParam('address');
		$phone = Yii::app()->request->getParam('phone');
		$phone2 = Yii::app()->request->getParam('phone2');
		$zip = Yii::app()->request->getParam('zip');
		$phone = Yii::app()->request->getParam('phone');
		$last_4_phone = substr($phone, 6,4);
		$phone2 = Yii::app()->request->getParam('mobile');
		$residence_type = (Yii::app()->request->getParam('is_rented') == 'rent') ? '2' : '1';
		$years_at_residence = Yii::app()->request->getParam('stay_in_year', '4');
		$months_at_residence = Yii::app()->request->getParam('stay_in_month', '3');
		$credit_rating = Yii::app()->request->getParam('credit_rating', '3');
		$bankruptcy = Yii::app()->request->getParam('bankruptcy', '0');
		$coverageType = Yii::app()->request->getParam('coverage_type', '3');
		$vehicle_comprehensiveDeductible = Yii::app()->request->getParam('vehicle_deductibles', '4');
		$vehicle_collisionDeductible = Yii::app()->request->getParam('vehicle_collision_deductibles', '4');
		$medicalPayment = Yii::app()->request->getParam('medical_pay', '5');
		$haveInsurance = Yii::app()->request->getParam('insurance_policy', '0');
		$insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
		$continuously_insured_period = Yii::app()->request->getParam('continuously_insured_period', '1');
		$current_policy_start_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date')));
		if($current_policy_start_date == date('Y-m-d')){
			$current_policy_start_date = date('Y-m-d', strtotime(' - 30 days'));
		}
		$current_policy_expiration_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date',date('Y-m-d',time()+rand(60,90)*86400))));
		$driver1_gender  = (Yii::app()->request->getParam('driver1_gender') == 'M') ? '1' : '2';
		$driver1_dob  = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob')));
		$driver1_maritalStatus  = Yii::app()->request->getParam('driver1_marital_status', '1');
		$driver1_education  = Yii::app()->request->getParam('driver1_education', '1');
		$driver1_education = $driver1_education - 1;
		$driver1_education = $driver1_education > 7 ? 1 : $driver1_education;

		$driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver1_occupation'));


		$driver1_requiredSR22  = Yii::app()->request->getParam('driver1_required_SR22', '0');
		$converage_type = Yii::app()->request->getParam('coverage_type', '1');
		$city_state = $submission_model->getCityStateFromZip($zip);
		$license_state = $city_state['state'] ? $city_state['state'] : 'NY';
		$trustedformcerturl  = Yii::app()->request->getParam('trustedformcerturl', $url);
        preg_match("/<PingID>(.*)<\/PingID>/msui", $ping_response, $confirmation_id);
        $PingID = $confirmation_id[1];
		$request = '<?xml version="1.0"?>
					<Request>
						<PingID>'.$PingID.'</PingID>
						<CampaignID>'.$p1.'</CampaignID>
						<VendorID>'.$p2.'</VendorID>
						<APIKey>'.$p3.'</APIKey>
						<SubID>'.$SubID.'</SubID>
						<xxTrustedFormCertUrl>'.$trustedformcerturl.'</xxTrustedFormCertUrl>
						<UniversalLeadID>'.$UniversalLeadID.'</UniversalLeadID>
						<UserAgent></UserAgent>
						<IPAddress>'.$IPAddress.'</IPAddress>
						<LeadDateTime>'.$LeadDateTime.'</LeadDateTime>
						<LeadTimeZone>EST</LeadTimeZone>
						<TCPAOptin>'.$TCPAOptin.'</TCPAOptin>
						<TCPAText>'.$TCPAText.'</TCPAText>
						<URL>'.$url.'</URL>
						<FirstName>'.$first_name.'</FirstName>
						<LastName>'.$last_name.'</LastName>
					    <Email>'.$email.'</Email>
					    <HomePhone>'.$phone.'</HomePhone>
					    <CellPhone>'.$phone2.'</CellPhone>
					    <WorkPhone>'.$phone.'</WorkPhone>
					    <PreferredPhone>'.$phone2.'</PreferredPhone>
					    <Address>'.$address.'</Address>
					    <City>'.$city_state['city'].'</City>
					    <State>'.$city_state['state'].'</State>
						<Zip>'.$zip.'</Zip>
						<CurrentCoverageType>'.self::$converageType[$converage_type].'</CurrentCoverageType>
						<CurrentInsuranceCompany>'.$insuranceCompany.'</CurrentInsuranceCompany>
						<CurrentPolicyExpires>'.$current_policy_expiration_date.'</CurrentPolicyExpires>
						<InsuredSince>'.$current_policy_start_date.'</InsuredSince>
						<YearsContinuouslyInsured>'.$continuously_insured_period.'</YearsContinuouslyInsured>
						<RequestedCoverageType>'.self::$converageType[$converage_type].'</RequestedCoverageType>
						<RequestedBodilyInjury>'.self::$bodilyInjury[$converage_type].'</RequestedBodilyInjury>
						<RequestedPropertyDamage></RequestedPropertyDamage>
						<RequestedUninsuredMotoristCover>'.rand(0,1).'</RequestedUninsuredMotoristCover>
						<Drivers>';
						$request .='<Driver>
								<RelationshipToApplicant>1</RelationshipToApplicant>
								<FirstName>'.$first_name.'</FirstName>
								<LastName>'.$last_name.'</LastName>
								<DOB>'.$driver1_dob.'</DOB>
								<MaritalStatus>'.$driver1_maritalStatus.'</MaritalStatus>
								<Gender>'.$driver1_gender.'</Gender>
								<LicenseStatus>1</LicenseStatus>
								<LicenseState>'.$license_state.'</LicenseState>
								<LicenseNumber></LicenseNumber>
								<LicenseEverSuspended>0</LicenseEverSuspended>
								<LicenseSinceAge></LicenseSinceAge>
								<ResidenceType>'.$residence_type.'</ResidenceType>
								<ResidenceYears>'.$years_at_residence.'</ResidenceYears>
								<ResidenceMonths>'.$months_at_residence.'</ResidenceMonths>
								<Occupation>'.$driver1_occupation.'</Occupation>
								<EmploymentYears></EmploymentYears>
								<EmploymentMonths></EmploymentMonths>
								<EducationLevel>'.$driver1_education.'</EducationLevel>
								<RequiresSR22>'.$driver1_requiredSR22.'</RequiresSR22>
								<Bankruptcy>'.$bankruptcy.'</Bankruptcy>
								<DefensiveDriverCourse></DefensiveDriverCourse>
								<StudentDiscount></StudentDiscount>
								<CreditRating>'.$credit_rating.'</CreditRating>';

								if (Yii::app()->request->getParam('driver1_hasTAVCs')) {
								for ($i = 1; $i <= Yii::app()->request->getParam('driver1_num_of_incidents'); $i++){

                                $driver1_incidentDate=date('Y-m-d',strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date')));

                                $driver1_AccidentType = Yii::app()->request->getParam('driver1_accident'.$i.'_description');
                                $driver1_AccidentDamange = Yii::app()->request->getParam('driver1_accident'.$i.'_damange');
								switch (Yii::app()->request->getParam("driver1_incident".$i."_type")) {
								case 1:
								$request .='<Tickets>
									<Ticket>
										<TicketDate>'.$driver1_incidentDate.'</TicketDate>
										<TicketType>'.Yii::app()->request->getParam('driver1_ticket'.$i.'_description').'</TicketType>
										<TicketState>'.$city_state['state'].'</TicketState>
									</Ticket>
								</Tickets>';
								break;
								case 2:
								$request .='<Violations>
									<Violation>
										<ViolationDate>'. $driver1_incidentDate.'</ViolationDate>
										<ViolationType>'.Yii::app()->request->getParam('driver1_violation_'.$i.'_description').'</ViolationType>
										<ViolationState>'.Yii::app()->request->getParam("driver1_violation_".$i."_state").'</ViolationState>
									</Violation>
								</Violations>';
								break;
                                case 3:
								$request .='<Accidents>
									<Accident>
										<AccidentDate>'.$driver1_incidentDate.'</AccidentDate>
										<AccidentType>'.self::$AccidentType[$driver1_AccidentType].'</AccidentType>
										<DriverAtFault>'.$driver1_AccidentType.'</DriverAtFault>
										<Damage>'.$driver1_AccidentDamange.'</Damage>
									</Accident>
								</Accidents>';
                                break;
                                case 4:
								$request .='<Claims>
									<Claim>
										<ClaimDate>'.$driver1_incidentDate.'</ClaimDate>
										<ClaimType>'.Yii::app()->request->getParam('driver1_claim'.$i.'_description').'</ClaimType>
										<DriverAtFault>'.Yii::app()->request->getParam('driver1_accident'.$i.'_at_fault').'</DriverAtFault>
										<PaidAmount>'.Yii::app()->request->getParam('driver1_accident'.$i.'_amount').'</PaidAmount>
									</Claim>
								</Claims>';
								break;
                                }
								}
                            }
							$request .='</Driver>';
							if (Yii::app()->request->getParam('driver2_gender')) {
							$driver2_first_name  = Yii::app()->request->getParam('driver2_first_name', '');
							$driver2_last_name  = Yii::app()->request->getParam('driver2_last_name', '');	
							$driver2_gender = (Yii::app()->request->getParam('driver2_gender')=='M') ? '1' : '2';
							$driver2_dob  = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob')));
							$driver2_maritalStatus  = Yii::app()->request->getParam('driver2_marital_status', '1');
							$driver2_education  = Yii::app()->request->getParam('driver2_education', '1');
							$driver2_education  -= $driver2_education;
							$driver2_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver2_occupation'));
							$driver2_requiredSR22  = Yii::app()->request->getParam('driver2_required_SR22', '0');
							$request .='<Driver>
								<RelationshipToApplicant>1</RelationshipToApplicant>
								<DOB>'.$driver2_dob.'</DOB>
								<FirstName>'.$driver2_first_name.'</FirstName>
								<LastName>'.$driver2_last_name.'</LastName>
								<MaritalStatus>'.$driver2_maritalStatus.'</MaritalStatus>
								<Gender>'.$driver2_gender.'</Gender>
								<LicenseStatus>1</LicenseStatus>
								<LicenseState>'.$license_state.'</LicenseState>
								<LicenseNumber></LicenseNumber>
								<LicenseEverSuspended>0</LicenseEverSuspended>
								<LicenseSinceAge></LicenseSinceAge>
								<ResidenceType>'.$residence_type.'</ResidenceType>
								<ResidenceYears>'.$years_at_residence.'</ResidenceYears>
								<ResidenceMonths>'.$months_at_residence.'</ResidenceMonths>
								<Occupation>'.$driver2_occupation.'</Occupation>
								<EmploymentYears></EmploymentYears>
								<EmploymentMonths></EmploymentMonths>
								<EducationLevel>'.$driver2_education.'</EducationLevel>
								<RequiresSR22>'.$driver2_requiredSR22.'</RequiresSR22>
								<Bankruptcy>'.$bankruptcy.'</Bankruptcy>
								<DefensiveDriverCourse></DefensiveDriverCourse>
								<StudentDiscount></StudentDiscount>
								<CreditRating>'.self::$CreditRating[$credit_rating].'</CreditRating>';
								if (Yii::app()->request->getParam('driver2_hasTAVCs')) {
								for ($i = 1; $i <= Yii::app()->request->getParam('driver1_num_of_incidents'); $i++){
                                $driver2_incidentDate=date('Y-m-d',strtotime(Yii::app()->request->getParam('driver2_incident'.$i.'_date')));
                                $driver2_AccidentType = Yii::app()->request->getParam('driver2_accident'.$i.'_description');
                                $driver2_AccidentDamange = Yii::app()->request->getParam('driver2_accident'.$i.'_damange');
								switch (Yii::app()->request->getParam("driver2_incident".$i."_type")) {
								case 1:
								$request .='<Tickets>
									<Ticket>
										<TicketDate>'.$driver2_incidentDate.'</TicketDate>
										<TicketType>'.Yii::app()->request->getParam('driver2_ticket'.$i.'_description').'</TicketType>
										<TicketState>'.$city_state['state'].'</TicketState>
									</Ticket>
								</Tickets>';
								break;
								case 2:
								$request .='<Violations>
									<Violation>
										<ViolationDate>'. $driver2_incidentDate.'</ViolationDate>
										<ViolationType>'.Yii::app()->request->getParam('driver2_violation_'.$i.'_description').'</ViolationType>
										<ViolationState>'.Yii::app()->request->getParam("driver2_violation_".$i."_state").'</ViolationState>
									</Violation>
								</Violations>';
								break;
                                case 3:
								$request .='<Accidents>
									<Accident>
										<AccidentDate>'.$driver2_incidentDate.'</AccidentDate>
										<AccidentType>'.self::$AccidentType[$driver2_AccidentType].'</AccidentType>
										<DriverAtFault>'.$driver2_AccidentType.'</DriverAtFault>
										<Damage>'.$driver2_AccidentDamange.'</Damage>
									</Accident>
								</Accidents>';
                                break;
                                case 4:
								$request .='<Claims>
									<Claim>
										<ClaimDate>'.$driver2_incidentDate.'</ClaimDate>
										<ClaimType>'.Yii::app()->request->getParam('driver2_claim'.$i.'_description').'</ClaimType>
										<DriverAtFault>'.Yii::app()->request->getParam('driver2_accident'.$i.'_at_fault').'</DriverAtFault>
										<PaidAmount>'.Yii::app()->request->getParam('driver2_accident'.$i.'_amount').'</PaidAmount>
									</Claim>
								</Claims>';
								break;
                                }
								}
                            }
							$request .='</Driver>';
							}
						$request .='</Drivers>
						<Vehicles>
							<Vehicle>
								<Year>'.Yii::app()->request->getParam('vehicle1_year').'</Year>
								<Make>'.Yii::app()->request->getParam('vehicle1_make').'</Make>
								<Model>'.Yii::app()->request->getParam('vehicle1_model').'</Model>
								<SubModel>'.Yii::app()->request->getParam('vehicle1_submodel').'</SubModel>
								<VIN>'.Yii::app()->request->getParam('vehicle1_vin').'</VIN>
								<Salvaged>0</Salvaged>
								<Alarm>0</Alarm>
								<ABS>1</ABS>
								<OvernightParking>'.rand(1,5).'</OvernightParking>
								<Ownership>'.Yii::app()->request->getParam('vehicle1_vehicle_ownership').'</Ownership>
								<PrimaryDriver>1</PrimaryDriver>
								<PrimaryUse>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_primary_use')].'</PrimaryUse>
								<AnnualMiles>'.(Yii::app()->request->getParam('vehicle1_primary_use')*1000).'</AnnualMiles>
								<WeeklyCommuteDays>'.rand(3,5).'</WeeklyCommuteDays>
								<OneWayDistance>'.rand(10,30).'</OneWayDistance>
								<ComprehensiveDeductible>'.Yii::app()->request->getParam('vehicle_deductibles').'</ComprehensiveDeductible>
								<CollisionDeductible>'.Yii::app()->request->getParam('vehicle_collision_deductibles').'</CollisionDeductible>
								<Restraint>1</Restraint>
								<AutomaticSeatBelts>1</AutomaticSeatBelts>
								<Airbags>1</Airbags>
								<Towing>1</Towing>
								<FourWheelDrive>1</FourWheelDrive>
								<Rental>0</Rental>
							</Vehicle>
						</Vehicles>
					</Request>';
		//echo '<pre>';print_r($fields);die();
        //$post_request = http_build_query($fields);
		//echo '<pre>';print_r($request);echo $post_url;exit;
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $post_response = $cm->curl($post_url, $request);
        $time_end = CommonToolsMethods::stopwatch();
		//echo '<pre>';print_r($ping_response);die();
        preg_match("/<Response>(.*)<\/Response>/msui", $post_response, $success);
		//echo '<pre>';print_r();die();
	if (trim($success[1]) == 'Accepted' || trim(strtolower($success[1])) == 'accepted') {
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
        $post_responses['post_request'] = $request;
        $post_responses['post_response'] = $post_response;
        $post_responses['post_status'] = $post_status;
        $post_responses['post_price'] = $post_price;
        $post_responses['redirect_url'] = $redirect_url;
        $post_responses['post_time'] = $post_time;
        //echo '<pre>';print_r($post_responses);die();
        return $post_responses;
    }
}