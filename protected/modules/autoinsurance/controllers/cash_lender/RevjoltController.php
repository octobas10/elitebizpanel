<?php
class RevjoltController extends Controller {

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
            1 => 'Preferred',
            2 => 'Premium',
            3 => 'Standard',
            4 => 'State Minimum'
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
    private function __construct() {
    }

    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $pingData = array();
        $p1 = $p1 ? $p1 : '4';
        $p2 = $p2 ? $p2 : '421';
        $p3 = $p3 ? $p3 : 'cbeecc135f542fcb642758c3f19e110e';
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
		$insuranceCompany = Yii::app()->request->getParam('insurance_company',1);
		$continuously_insured_period = Yii::app()->request->getParam('continuously_insured_period', '1');
		$current_policy_start_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date')));
		$current_policy_expiration_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date')));

		$driver1_gender = (Yii::app()->request->getParam('driver1_gender')=='M') ? '1' : '2';
		$driver1_dob  = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob')));
		$driver1_maritalStatus  = Yii::app()->request->getParam('driver1_marital_status', '1');
		$driver1_education  = Yii::app()->request->getParam('driver1_education', '1');
		$driver1_education = $driver1_education - 1;
		$driver1_occupation  = Yii::app()->request->getParam('driver1_occupation', '1');
		$driver1_requiredSR22  = Yii::app()->request->getParam('driver1_required_SR22', '0');
		
		$submission_model = new Submissions();
		$city_state = $submission_model->getCityStateFromZip($zip);
        $TestMode ='0';
        $converage_type = Yii::app()->request->getParam('coverage_type', '1');
		$request = '<?xml version="1.0"?>
					<Request>
						<CampaignID>'.$p1.'</CampaignID>
						<VendorID>'.$p2.'</VendorID>
						<APIKey>'.$p3.'</APIKey>
						<TestMode>'.$TestMode.'</TestMode>
						<SubID>'.$SubID.'</SubID>
						<xxTrustedFormCertUrl></xxTrustedFormCertUrl>
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
								<LicenseState>'.$city_state['state'].'</LicenseState>
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
										<Damage>'.$driver1_AccidentType.'</Damage>
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
							$driver2_occupation  = Yii::app()->request->getParam('driver2_occupation', '1');
							$driver2_requiredSR22  = Yii::app()->request->getParam('driver2_required_SR22', '0');
							$request .='<Driver>
								<RelationshipToApplicant>1</RelationshipToApplicant>
								<DOB>'.$driver2_dob.'</DOB>
								<MaritalStatus>'.$driver2_maritalStatus.'</MaritalStatus>
								<Gender>'.$driver2_gender.'</Gender>
								<LicenseStatus>1</LicenseStatus>
								<LicenseState>'.$city_state['state'].'</LicenseState>
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
										<Damage>'.$driver2_AccidentType.'</Damage>
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
        if (trim($result[1]) == 'Accepted' || trim($result[0]) == 'Accepted') {
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
    	$p1 = $p1 ? $p1 : '4';
        $p2 = $p2 ? $p2 : '421';
        $p3 = $p3 ? $p3 : 'cbeecc135f542fcb642758c3f19e110e';
        $UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
		$IPAddress = Yii::app()->request->getParam('ipaddress');
		$LeadDateTime = date('Y-m-d H:i:s');
		$TCPAOptin = Yii::app()->request->getParam('tcpa_optin','0');
		$TCPAText = Yii::app()->request->getParam('tcpa_text');
		$SubID = Yii::app()->request->getParam('sub_id');
		$url = Yii::app()->request->getParam('url','https://eliteinsurers.com');
		$promo_code = Yii::app()->request->getParam('promo_code');
		
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
		$insuranceCompany = Yii::app()->request->getParam('insurance_company',1);
		$continuously_insured_period = Yii::app()->request->getParam('continuously_insured_period', '1');
		$current_policy_start_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date')));
		$current_policy_expiration_date = date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date')));
		$driver1_gender  = (Yii::app()->request->getParam('driver1_gender') == 'M') ? '1' : '2';
		$driver1_dob  = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob')));
		$driver1_maritalStatus  = Yii::app()->request->getParam('driver1_marital_status', '1');
		$driver1_education  = Yii::app()->request->getParam('driver1_education', '1');
		$driver1_education = $driver1_education - 1;
		$driver1_occupation  = Yii::app()->request->getParam('driver1_occupation', '1');
		$driver1_requiredSR22  = Yii::app()->request->getParam('driver1_required_SR22', '0');
		$converage_type = Yii::app()->request->getParam('coverage_type', '1');

		$submission_model = new Submissions();
		$city_state = $submission_model->getCityStateFromZip($zip);
        $TestMode ='0';
        preg_match("/<PingID>(.*)<\/PingID>/msui", $ping_response, $confirmation_id);
        $PingID = $confirmation_id[1];
		$request = '<?xml version="1.0"?>
					<Request>
						<PingID>'.$PingID.'</PingID>
						<CampaignID>'.$p1.'</CampaignID>
						<VendorID>'.$p2.'</VendorID>
						<APIKey>'.$p3.'</APIKey>
						<TestMode>'.$TestMode.'</TestMode>
						<SubID>'.$SubID.'</SubID>
						<xxTrustedFormCertUrl></xxTrustedFormCertUrl>
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
								<LicenseState>'.$city_state['state'].'</LicenseState>
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
										<Damage>'.$driver1_AccidentType.'</Damage>
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

?>
