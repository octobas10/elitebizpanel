<?php
class QuinStreetController
{
    public static $occupationListFromBuyer = ['Administrative', 'Architect', 'Business Owner', 'Clergy/Religious', 'Disabled', 'Engineer', 'Finance', 'Healthcare', 'Homemaker', 'Human Resources', 'Lawyer', 'Marketing & Sales', 'Military', 'Other', 'Retired', 'Scientist', 'Self-Employed', 'Student Unemployed'];

    public static $companyListFromBuyer = ['Other','21st Century','AAA Insurance','Allstate','Commerce Insurance Co','Esurance','Farmers Insurance','GEICO','The Hartford','Liberty Mutual','Met Life Insurance','GMACNatGenIns','Nationwide','Progressive','SAFECO','State Farm','Travelers Insurance','USAA'];

    public static $accidentDescription = [
        0 => 'MOVINGNAF',
        1 => 'MOVINGNAF',
        2 => 'MOVINGNAF',
        3 => 'OTHERNAF',
        4 => 'MOVINGNAF',
        5 => 'OTHERNAF',
        6 => 'STATIONARYNAF'
    ];
    public static $violationDescription = [
        0 => 'DWI',
        1 => 'DWI',
        2 => 'ALLOW',
        3 => 'SPEED25',
        4 => 'OTHER',
        5 => 'OTHER',
        6 => 'WHISKEY',
        7 => 'WHISKEY',
    ];
    public static $claimDescription = [
        1 => 'ACTOFNATURE',
        2 => 'UMPIP',
        3 => 'ACTOFNATURE',
        4 => 'ACTOFNATURE',
        5 => 'WINDSHIELD',
        6 => 'THEFTCLAIM',
        7 => 'THEFTCLAIM',
        8 => 'TOWING',
        9 => 'VANDALISM',
        10 => 'WINDSHIELD',
        11 => 'UMPIP'
    ];
    public static $education = [
        0 => 'Other',
        1 => 'Other',
        2 => 'Some College',
        3 => 'High School Diploma',
        4 => 'Some College',
        5 => 'Associate',
        6 => 'Bachelors',
        7 => 'Master',
        8 => 'PhD',
        9 => 'Other'
    ];
    public static $accidentDamage = [
        0 => 'People',
        1 => 'People',
        2 => 'Property',
        3 => 'Both',
        4 => 'Not Applicable'
    ];
    public static $converageType = [
        0 => 'Basic Protection',
        1 => 'Basic Protection',
        2 => 'Superior Protection',
        3 => 'State Minimum',
        4 => 'Standard Protection'
    ];
    public static $bodilyInjury = [
        0 => '250/500',
        1 => '250/500',
        2 => '100/300',
        3 => '50/100',
        4 => '25/50'
    ];
    public static $propertyDamage = [
        0 => '100000',
        1 => '100000',
        2 => '50000',
        3 => '25000',
        4 => '10000'
    ];
    public static $vehiclePrimaryUse = [
        1 => 'Delivery',
        2 => 'ToFromWork',
        3 => 'BusinessCalls',
        4 => 'Pleasure',
        5 => 'BusinessCalls'
    ];
    public static $vehicleAnnualMileage = [
        1 => '2500',
        2 => '7500',
        3 => '7500',
        4 => '12500',
        5 => '12500',
        6 => '15000',
        7 => '15000',
        8 => '15000',
        9 => '15000'
    ];
    public static $vehicleDailyMileage = [
        1 => '20',
        2 => '50',
        3 => '90',
        4 => '100',
        5 => '150',
        6 => '200'
    ];
    public static $vehicleOneWayMileage = [
        1 => '20',
        2 => '30',
        3 => '40',
        4 => '60',
        5 => '90',
        6 => '100'
    ];
    public static $vehicleDeductibles = [
        1 => '100',
        2 => '100',
        3 => '250',
        4 => '250',
        5 => '500',
        6 => '500',
        7 => '1000',
        8 => '1000',
    ];
    public static $vehicleCollisionDeductibles = [
        1 => '1',
        2 => '251',
        3 => '501',
        4 => '750',
        5 => '1001',
        6 => '1501',
        7 => '3001',
        8 => '5001',
    ];
    public static $creditRating = [
        1 => 'Excellent',
        2 => 'Good',
        3 => 'Poor',
        4 => 'Do not know',
    ];
    public static $incidentTypeName = [
        1 => 'Collision',
        2 => 'Accident',
        3 => 'Violation',
        4 => 'Claim',
    ];
    public static function incidentAmountPaid($amount = 0){
        switch ($amount) {
            case $amount >= 1 AND $amount >= 250:
                $paid_amount = '1';
                break;
            case $amount >= 251 AND $amount >= 500:
                $paid_amount = '251';
                break;
            case $amount >= 501 AND $amount >= 749:
                $paid_amount = '501';
                break;
            case $amount >= 750 AND $amount >= 1000:
                $paid_amount = '750';
                break;
            case $amount >= 1001 AND $amount >= 1500:
                $paid_amount = '1001';
                break;
            case $amount >= 1500 AND $amount >= 3000:
                $paid_amount = '1501';
                break;
            case $amount >= 3001 AND $amount >= 5000:
                $paid_amount = '3001';
                break;
            case $amount >= 5001 AND $amount >= 10000:
                $paid_amount = '5001';
                break;
            case $amount >= 10000:
                $paid_amount = '10000';
                break;
            default:
               $paid_amount = '3001';
               break;
        }
        return $paid_amount;
    }
   
    public static $tcpLanguage = 'By submitting my information, I agree to be contacted regarding free, no-obligation auto insurance quotes, and agree to the Privacy Policy and Terms & Conditions of this website. I also hereby consent to receive marketing communications via autodialed and/or pre-recorded calls, SMS/MMS messages, and/or emails from | and one or more of its marketing partners or insurance agents at the phone number provided, including my wireless number. I understand that consent is not a condition to receive quotes or make a purchase.';

    public function __construct() {}
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0)
    {
        $pingData = [];
        $zip_code = Yii::app()->request->getParam('zip');
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $years_at_residence = (int) Yii::app()->request->getParam('stay_in_year');
        if ($years_at_residence > 10 || $years_at_residence < 1) {
            $years_at_resi_array = [15, 20, 25, 30];
            $years_at_residance = $years_at_resi_array[array_rand($years_at_resi_array)];
        }
        $months_at_residance = (int) Yii::app()->request->getParam('stay_in_month');
        $months_at_residance = $months_at_residance > 11 ? rand(1, 11) : $months_at_residance;
        $insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer, self::$companyListFromBuyer[0]);
        $driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer, self::$occupationListFromBuyer[0]);
        $Driver1 =  [
            'driverId' => 1,
            'postalCode' => (int)Yii::app()->request->getParam('zip'),
            'city' => $city_state['city'],
            'state' => $city_state['state'],
            'country' => 'US',
            'birthDate' => date('Ymd', strtotime(Yii::app()->request->getParam('driver1_dob'))),
            'gender' => Yii::app()->request->getParam('driver1_gender') == 'M' ? 'Male' : 'Female',
            'maritalStatus' => Yii::app()->request->getParam('driver1_marital_status', '2') == '2' ? 'Yes' : 'No',
            'education' => self::$education[Yii::app()->request->getParam('driver1_education', '1')],
            'occupation' => $driver1_occupation,
            'employer' => $driver1_occupation,
            'timeAtCurrentResidence' => [2, 3, 4, 5, 6, 7, 8][date('w')],
            'residenceType' => ['AptOrCoopOwnr', 'CondoOwner', 'LiveWithParents', 'MobileHomeOwnr', 'MultiFmyHmeOwnr', 'Renter', 'SingleFamily'][date('w')],
            'doesRequireSR22' =>  Yii::app()->request->getParam('driver1_required_SR22', '0') == '1' ? 'Y' : 'N',
            'licenseStatus' => 'Valid',
            'matureDriverCourse' => 'N',
            'licenseSuspension' => 'No',
            'driverIsGoodStudent' => 'N',
            'driverTrainingCourseTaken' => 'Y',
            'lengthWithCurrentEmployer' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12][date('g')],
            'relationshipToApplicant' => 'Applicant',
            'dateLicenseWasSuspended' => '',
            'licenseState' => $city_state['state'],
            'ageFirstLicensed' => (int)['15','16'][date('N')%2],
            'driverIncidentCount' => 3,
        ];
        $Driver2 =  [
            'driverId' => 2,
            'postalCode' => (int)Yii::app()->request->getParam('zip'),
            'city' => $city_state['city'],
            'state' => $city_state['state'],
            'country' => 'US',
            'birthDate' => date('Ymd', strtotime(Yii::app()->request->getParam('driver2_dob'))),
            'gender' => Yii::app()->request->getParam('driver2_gender') == 'M' ? 'Male' : 'Female',
            'maritalStatus' => Yii::app()->request->getParam('driver2_marital_status', '2') == '2' ? 'Yes' : 'No',
            'education' => self::$education[Yii::app()->request->getParam('driver2_education', '1')],
            'occupation' => $driver1_occupation,
            'employer' => $driver1_occupation,
            'timeAtCurrentResidence' => [2, 3, 4, 5, 6, 7, 8][date('w')],
            'residenceType' => ['AptOrCoopOwnr', 'CondoOwner', 'LiveWithParents', 'MobileHomeOwnr', 'MultiFmyHmeOwnr', 'Renter', 'SingleFamily'][date('w')],
            'doesRequireSR22' =>  Yii::app()->request->getParam('driver2_required_SR22', '0') == '1' ? 'Y' : 'N',
            'licenseStatus' => 'Valid',
            'matureDriverCourse' => 'N',
            'licenseSuspension' => 'No',
            'driverIsGoodStudent' => 'N',
            'driverTrainingCourseTaken' => 'Y',
            'lengthWithCurrentEmployer' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12][date('g')],
            'relationshipToApplicant' => 'Applicant',
            'dateLicenseWasSuspended' => '',
            'licenseState' => $city_state['state'],
            'ageFirstLicensed' => (int)['15','16'][date('N') % 2],
            'driverIncidentCount' => 3,
        ];
        
        $Vehicle1 =  [
            "vehicleId" => 1,
            "vehicleYear" => (int)Yii::app()->request->getParam('vehicle1_year'),
            "vehicleMake" => Yii::app()->request->getParam('vehicle1_make'),
            "vehicleModel" => Yii::app()->request->getParam('vehicle1_model'),
            "vehicleSubModel" => Yii::app()->request->getParam('vehicle1_submodel'),
            "vin" => Yii::app()->request->getParam('vehicle1_vin', "1ACBC535*B*******"),
            "vehiclePrimaryUse" => self::$vehiclePrimaryUse[Yii::app()->request->getParam('vehicle1_primary_use', 1)],
            "dailyMileage" => (int)self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
            "annualMileage" => (int)self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage')],
            "oneWayMileage" => (int)self::$vehicleOneWayMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
            "ownedLeasedOrFinanced" => "Owned",
            "vehicleCost" => 0,
            "daysDrivenPerWeek" => (int)['4','5'][date('N') % 2],
            "garagingCounty" => "",
            "garagingState" => $city_state['state'],
            "garagingCity" => $city_state['city'],
            "garagingZip" => Yii::app()->request->getParam('zip'),
            "garagingStreetAddress" => (string)Yii::app()->request->getParam('address') ?: 'NA',
            "antiTheftDevice" => "AudibleAlarm",
            "antiLockBrakes" => ['Y', 'N'][date('N') % 2],
            "vehicleType" => "PrivatePassenger",
            "vehicleParkedAt" => "PrivateGarage",
            "collisionDeductible" => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            "comprehensiveDeductible" => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
            "rental" => "N",
            "towing" => "Y",
        ];
        $Vehicle2 =  [
            "vehicleId" => 2,
            "vehicleYear" => (int)Yii::app()->request->getParam('vehicle2_year'),
            "vehicleMake" => Yii::app()->request->getParam('vehicle2_make'),
            "vehicleModel" => Yii::app()->request->getParam('vehicle2_model'),
            "vehicleSubModel" => Yii::app()->request->getParam('vehicle2_submodel'),
            "vin" => Yii::app()->request->getParam('vehicle2_vin', "1ACBC535*B*******"),
            "vehiclePrimaryUse" => self::$vehiclePrimaryUse[Yii::app()->request->getParam('vehicle2_primary_use', 1)],
            "dailyMileage" => (int)self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_daily_mileage')],
            "annualMileage" => (int)self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle2_annual_mileage')],
            "oneWayMileage" => (int)self::$vehicleOneWayMileage[Yii::app()->request->getParam('vehicle2_daily_mileage')],
            "ownedLeasedOrFinanced" => "Owned",
            "vehicleCost" => 0,
            "daysDrivenPerWeek" => (int)['4','5'][date('N') % 2],
            "garagingCounty" => "",
            "garagingState" => $city_state['state'],
            "garagingCity" => $city_state['city'],
            "garagingZip" => Yii::app()->request->getParam('zip'),
            "garagingStreetAddress" => (string)Yii::app()->request->getParam('address') ?: 'NA',
            "antiTheftDevice" => "AudibleAlarm",
            "antiLockBrakes" => ['Y', 'N'][date('N') % 2],
            "vehicleType" => "PrivatePassenger",
            "vehicleParkedAt" => "PrivateGarage",
            "collisionDeductible" => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            "comprehensiveDeductible" => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
            "rental" => "N",
            "towing" => "Y",
        ];
        $driverVehicleUsages = [
            'driverVehicleUsageId' => 1,
            'vehicleId' => 1,
            'driverId' => '1',
            'vehicleUsage' => ['Primary', 'Occasional'][date('N') % 2],
        ];
        
        $priorPolicyInfo = [
            'insuredTimeframe' => 'FiveYearsorMore',
            'tenureWithCurrentInsurer' => '3to4',
            'insuranceCarrier' => $insuranceCompany,
            'expirationDate' => date("Ymd", strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
            'coveragesCurrBIPD' => ''
        ];
        $policyInfo = [
            'policyTerm' => '',
            'policyStartDate' => date('Ymd',strtotime(Yii::app()->request->getParam('insurance_start_date'))),
            'policyPackage' => ''
        ];
        $policyCoverage = [
            'ownBoat' => 'N',
            'ownMotorCycle' => 'Y',
            'ownHome' => Yii::app()->request->getParam('is_rented') == 1 ? 'No' : 'Yes',
            'coveragesUMBIPD' => '',
            'coveragesUMUIM' => '',
            'coveragesBIPD' => '15-30-10'
        ];
        $accidents = [
            'accidentId' => 1,
            'driverId' => 1,
            'incidentAccidentType' => Yii::app()->request->getParam('driver1_accident1_description', ''),
            'incidentAccidentDate' => date('Ymd',strtotime(Yii::app()->request->getParam('driver1_incident1_date'))),
            'propertyDamagePaid' => Yii::app()->request->getParam('driver1_accident1_amount'),
            'comprehensiveClaimPaid' => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            'incidentCollisionClaimPay' => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            'injuriesFatalities' => 'N',
            'claimPaidToOtherParty' => '',
            'incidentAccidentDesc' => self::$incidentTypeName[Yii::app()->request->getParam('driver1_incident1_type')],
            'incidentAmountPaid' => self::incidentAmountPaid(Yii::app()->request->getParam('driver1_accident1_amount')),
            'damagedThing' => '',
            'driversFault' => ''
        ];
        
        $violations = [
            'violationId' => 1,
            'driverId' => 1,
            'incidentViolationDate' => date('Ymd',strtotime(Yii::app()->request->getParam('driver1_incident1_date'))),
            'incidentViolationType' => self::$violationDescription[Yii::app()->request->getParam('driver1_violation1_description',1)],
            'incidentViolationDesc' => 'Speeding'
        ];
        $claims = [
            'claimId' => 1,
            'driverId' => 1,
            'incidentClaimDate' => date('Ymd',strtotime(Yii::app()->request->getParam('driver1_incident1_date'))),
            'incidentClaimType' => Yii::app()->request->getParam('driver1_claim1_description', ''),
            'incidentClaimAmountPaid' => self::incidentAmountPaid(Yii::app()->request->getParam('driver1_claim1_paid_amount')),
            'incidentClaimDesc' => Yii::app()->request->getParam('driver1_claim1_description', ''),
            'incidentAmountPaid' => self::incidentAmountPaid(Yii::app()->request->getParam('driver1_claim1_paid_amount')),
            'damagedThing' => '',
            'driversFault' => ''
        ];
        
        $fields = [
            'action' => 'ping',
            'data' => [
                'drivers' => [$Driver1,$Driver2],
                'vehicles' => [$Vehicle1,$Vehicle2],
                'driverVehicleUsages' => [$driverVehicleUsages],
                'priorPolicyInfo' => $priorPolicyInfo,
                'policyInfo' => $policyInfo,
                'policyCoverage' => $policyCoverage,
                'incidents' => [
                    'accidents' => [$accidents],
                    'violations' => [$violations],
                    'claims' => [$claims]
                ],
                'propertyInfo' => [
                    'crossSellHome' => 'Yes',
                    'propertyType' => '',
                    'approxYearBuilt' => '',
                    'homeInsClaim' => 'Yes',
                    'needFloodInsurance' => 'Yes'
                ],
                'military' => [
                    'militaryStatus' => 'No'
                ],
                'currentlyInsured' => 'Yes',
                'creditRating' => self::$creditRating[Yii::app()->request->getParam('credit_rating')],
                'driverCount' => 1,
                'vehicleCount' => 1,
                'householdResidentCount' => 1
            ],
            'metaData' => [
                'homePhoneConsent' => 'Yes',
                'workPhoneConsent' => 'No',
                'consentLanguage' => Yii::app()->request->getParam('tcpa_text') ?: self::$tcpLanguage,
                'ipAddress' => Yii::app()->request->getParam('ipaddress	', ''),
                'aff' => Yii::app()->request->getParam('promo_code', ''),
                'trustedFormToken' => Yii::app()->request->getParam('trustedformcerturl', ''),
                'leadIdToken' => Yii::app()->request->getParam('universal_leadid', ''),
                'userAgent' => Yii::app()->request->getParam('user_agent', ''),
            ]
        ];
        $purchase = true;
        if ($purchase == true) {
            $pingData['ping_request'] = json_encode($fields);
            $pingData['header'] = ['content-type: application/json', 'Accept: application/json'];
            //echo '<pre>';print_r($pingData);exit;
            return $pingData;
        } else {
            return [];
        }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response)
    {
        $result = json_decode($ping_response, TRUE);
        if (isset($result['status']) && $result['status'] == 'SUCCESS') {
            $ping_price = isset($result['commission']) ? $result['commission'] : 0;
            $ping_response_info['ping_price'] = trim($ping_price);
            $ping_response_info['ping_status'] = '1';
            $ping_response_info['confirmation_id'] = $result['pingId'];
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
    public static function sendPostData($parameter1, $parameter2, $parameter3, $ping_response, $post_url, $status)
    {
        $zip_code = Yii::app()->request->getParam('zip');
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer, self::$occupationListFromBuyer[0]);
        $years_at_residance = (int) Yii::app()->request->getParam('stay_in_year');
        if ($years_at_residance > 10 || $years_at_residance < 1) {
            $years_at_resi_array = [15, 20, 25, 30];
            $years_at_residance = $years_at_resi_array[array_rand($years_at_resi_array)];
        }
        $months_at_residance = (int) Yii::app()->request->getParam('stay_in_month');
        $months_at_residance = $months_at_residance > 11 ? rand(1, 11) : $months_at_residance;
        $insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer, self::$companyListFromBuyer[0]);
        $Driver1 =  [
            'driverId' => 1,
            'firstName' => Yii::app()->request->getParam('driver1_first_name'),
            'lastName' => Yii::app()->request->getParam('driver1_last_name'),
            'email' => Yii::app()->request->getParam('email'),
            'homePhone' => Yii::app()->request->getParam('phone'),
            'workPhone' =>Yii::app()->request->getParam('mobile'),
            'address' => Yii::app()->request->getParam('address'),
            'postalCode' => (int)Yii::app()->request->getParam('zip'),
            'city' => $city_state['city'],
            'state' => $city_state['state'],
            'country' => 'US',
            'birthDate' => date('Ymd', strtotime(Yii::app()->request->getParam('driver1_dob'))),
            'gender' => Yii::app()->request->getParam('driver1_gender') == 'M' ? 'Male' : 'Female',
            'maritalStatus' => Yii::app()->request->getParam('driver1_marital_status', '2') == '2' ? 'Yes' : 'No',
            'education' => self::$education[Yii::app()->request->getParam('driver1_education', '1')],
            'occupation' => $driver1_occupation,
            'employer' => '',
            'timeAtCurrentResidence' => [2, 3, 4, 5, 6, 7, 8][date('w')],
            'residenceType' => ['AptOrCoopOwnr', 'CondoOwner', 'LiveWithParents', 'MobileHomeOwnr', 'MultiFmyHmeOwnr', 'Renter', 'SingleFamily'][date('w')],
            'doesRequireSR22' =>  Yii::app()->request->getParam('driver1_required_SR22', '0') == '1' ? 'Y' : 'N',
            'licenseStatus' => 'Valid',
            'matureDriverCourse' => 'N',
            'licenseSuspension' => 'No',
            'driverIsGoodStudent' => 'N',
            'driverTrainingCourseTaken' => 'Y',
            'lengthWithCurrentEmployer' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12][date('g')],
            'relationshipToApplicant' => 'Applicant',
            'dateLicenseWasSuspended' => '',
            'licenseState' => $city_state['state'],
            'ageFirstLicensed' => (int)['15','16'][date('N') % 2],
            'driverIncidentCount' => (int)Yii::app()->request->getParam('driver1_num_of_incidents'),
        ];
        $Driver2 =  [
            'driverId' => 2,
            'firstName' => Yii::app()->request->getParam('driver2_first_name'),
            'lastName' => Yii::app()->request->getParam('driver2_last_name'),
            'email' => Yii::app()->request->getParam('email'),
            'homePhone' => Yii::app()->request->getParam('phone'),
            'workPhone' =>Yii::app()->request->getParam('mobile'),
            'address' => Yii::app()->request->getParam('address'),
            'postalCode' => (int)Yii::app()->request->getParam('zip'),
            'city' => $city_state['city'],
            'state' => $city_state['state'],
            'country' => 'US',
            'birthDate' => date('Ymd', strtotime(Yii::app()->request->getParam('driver2_dob'))),
            'gender' => Yii::app()->request->getParam('driver2_gender') == 'M' ? 'Male' : 'Female',
            'maritalStatus' => Yii::app()->request->getParam('driver2_marital_status', '2') == '2' ? 'Yes' : 'No',
            'education' => self::$education[Yii::app()->request->getParam('driver2_education', '1')],
            'occupation' => $driver1_occupation,
            'employer' => $driver1_occupation,
            'timeAtCurrentResidence' => [2, 3, 4, 5, 6, 7, 8][date('w')],
            'residenceType' => ['AptOrCoopOwnr', 'CondoOwner', 'LiveWithParents', 'MobileHomeOwnr', 'MultiFmyHmeOwnr', 'Renter', 'SingleFamily'][date('w')],
            'doesRequireSR22' =>  Yii::app()->request->getParam('driver2_required_SR22', '0') == '1' ? 'Y' : 'N',
            'licenseStatus' => 'Valid',
            'matureDriverCourse' => 'N',
            'licenseSuspension' => 'No',
            'driverIsGoodStudent' => 'N',
            'driverTrainingCourseTaken' => 'Y',
            'lengthWithCurrentEmployer' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12][date('g')],
            'relationshipToApplicant' => 'Applicant',
            'dateLicenseWasSuspended' => '',
            'licenseState' => $city_state['state'],
            'ageFirstLicensed' => (int)['15','16'][date('N') % 2],
            'driverIncidentCount' => (int)Yii::app()->request->getParam('driver1_num_of_incidents'),
        ];
        $Vehicle1 =  [
            "vehicleId" => 1,
            "vehicleYear" => (int)Yii::app()->request->getParam('vehicle1_year'),
            "vehicleMake" => Yii::app()->request->getParam('vehicle1_make'),
            "vehicleModel" => Yii::app()->request->getParam('vehicle1_model'),
            "vehicleSubModel" => Yii::app()->request->getParam('vehicle1_submodel'),
            "vin" => Yii::app()->request->getParam('vehicle1_vin', "1ACBC535*B*******"),
            "vehiclePrimaryUse" => self::$vehiclePrimaryUse[Yii::app()->request->getParam('vehicle1_primary_use', 1)],
            "dailyMileage" => (int)self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
            "annualMileage" => (int)self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage')],
            "oneWayMileage" => (int)self::$vehicleOneWayMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
            "ownedLeasedOrFinanced" => "Owned",
            "vehicleCost" => 0,
            "daysDrivenPerWeek" => (int)['4','5'][date('N') % 2],
            "garagingCounty" => "",
            "garagingState" => $city_state['state'],
            "garagingCity" => $city_state['city'],
            "garagingZip" => Yii::app()->request->getParam('zip'),
            "garagingStreetAddress" => (string)Yii::app()->request->getParam('address') ?: 'NA',
            "antiTheftDevice" => "AudibleAlarm",
            "antiLockBrakes" => ['Y', 'N'][date('N') % 2],
            "vehicleType" => "PrivatePassenger",
            "vehicleParkedAt" => "PrivateGarage",
            "collisionDeductible" => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            "comprehensiveDeductible" => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
            "rental" => "Y",
            "towing" => "Y",
        ];
        $Vehicle2 =  [
            "vehicleId" => 2,
            "vehicleYear" => (int)Yii::app()->request->getParam('vehicle2_year'),
            "vehicleMake" => Yii::app()->request->getParam('vehicle2_make'),
            "vehicleModel" => Yii::app()->request->getParam('vehicle2_model'),
            "vehicleSubModel" => Yii::app()->request->getParam('vehicle2_submodel'),
            "vin" => Yii::app()->request->getParam('vehicle2_vin', "1ACBC535*B*******"),
            "vehiclePrimaryUse" => self::$vehiclePrimaryUse[Yii::app()->request->getParam('vehicle2_primary_use', 1)],
            "dailyMileage" => (int)self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_daily_mileage')],
            "annualMileage" => (int)self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle2_annual_mileage')],
            "oneWayMileage" => (int)self::$vehicleOneWayMileage[Yii::app()->request->getParam('vehicle2_daily_mileage')],
            "ownedLeasedOrFinanced" => "Owned",
            "vehicleCost" => 0,
            "daysDrivenPerWeek" => (int)['4','5'][date('N') % 2],
            "garagingCounty" => "",
            "garagingState" => $city_state['state'],
            "garagingCity" => $city_state['city'],
            "garagingZip" => Yii::app()->request->getParam('zip'),
            "garagingStreetAddress" => (string)Yii::app()->request->getParam('address') ?: 'NA',
            "antiTheftDevice" => "AudibleAlarm",
            "antiLockBrakes" => ['Y', 'N'][date('N') % 2],
            "vehicleType" => "PrivatePassenger",
            "vehicleParkedAt" => "PrivateGarage",
            "collisionDeductible" => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            "comprehensiveDeductible" => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
            "rental" => "Y",
            "towing" => "Y",
        ];
        //==========
        $driverVehicleUsages = [
            'driverVehicleUsageId' => 1,
            'vehicleId' => 1,
            'driverId' => '1',
            'vehicleUsage' => ['Primary', 'Occasional'][date('N') % 2],
        ];
        $priorPolicyInfo = [
            'insuredTimeframe' => 'FiveYearsorMore',
            'tenureWithCurrentInsurer' => '3to4',
            'insuranceCarrier' => $insuranceCompany,
            'expirationDate' => date('Ymd',strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
            'coveragesCurrBIPD' => ''
        ];
        $policyInfo = [
            'policyTerm' => '',
            'policyStartDate' => date('Ymd',strtotime(Yii::app()->request->getParam('insurance_start_date'))),
            'policyPackage' => ''
        ];
        $policyCoverage = [
            'ownBoat' => 'N',
            'ownMotorCycle' => 'Y',
            'ownHome' => Yii::app()->request->getParam('is_rented') == 1 ? 'No' : 'Yes',
            'coveragesUMBIPD' => '',
            'coveragesUMUIM' => '',
            'coveragesBIPD' => '15-30-10'
        ];
        $accidents = [
            'accidentId' => 1,
            'driverId' => 1,
            'incidentAccidentType' => Yii::app()->request->getParam('driver1_accident1_description', ''),
            'incidentAccidentDate' => date('Ymd',strtotime(Yii::app()->request->getParam('driver1_incident1_date'))),
            'propertyDamagePaid' => Yii::app()->request->getParam('driver1_accident1_amount'),
            'comprehensiveClaimPaid' => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            'incidentCollisionClaimPay' => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            'injuriesFatalities' => 'N',
            'claimPaidToOtherParty' => '',
            'incidentAccidentDesc' => self::$incidentTypeName[Yii::app()->request->getParam('driver1_incident1_type')],
            'incidentAmountPaid' => self::incidentAmountPaid(Yii::app()->request->getParam('driver1_accident1_amount')),
            'damagedThing' => '',
            'driversFault' => ''
        ];
        
        $violations = [
            'violationId' => 1,
            'driverId' => 1,
            'incidentViolationDate' => date('Ymd',strtotime(Yii::app()->request->getParam('driver1_incident1_date'))),
            'incidentViolationType' => self::$violationDescription[Yii::app()->request->getParam('driver1_violation1_description',1)],
            'incidentViolationDesc' => 'Speeding'
        ];
        $claims = [
            'claimId' => 1,
            'driverId' => 1,
            'incidentClaimDate' => date('Ymd',strtotime(Yii::app()->request->getParam('driver1_incident1_date'))),
            'incidentClaimType' => Yii::app()->request->getParam('driver1_claim1_description', ''),
            'incidentClaimAmountPaid' => self::incidentAmountPaid(Yii::app()->request->getParam('driver1_claim1_paid_amount')),
            'incidentClaimDesc' => Yii::app()->request->getParam('driver1_claim1_description', ''),
            'incidentAmountPaid' => self::incidentAmountPaid(Yii::app()->request->getParam('driver1_claim1_paid_amount')),
            'damagedThing' => '',
            'driversFault' => ''
        ];
        //==========
        $ping_result = json_decode($ping_response, TRUE);
        $fields = [
            'action' => 'post',
            'data' => [
                'drivers' => [$Driver1, $Driver2],
                'vehicles' => [$Vehicle1, $Vehicle2],
                'driverVehicleUsages' => [$driverVehicleUsages],
                'priorPolicyInfo' => $priorPolicyInfo,
                'policyInfo' => $policyInfo,
                'policyCoverage' => $policyCoverage,
                'incidents' => [
                    'accidents' => [$accidents],
                    'violations' => [$violations],
                    'claims' => [$claims]
                ],
                'propertyInfo' => [
                    'crossSellHome' => 'Yes',
                    'propertyType' => '',
                    'approxYearBuilt' => '',
                    'homeInsClaim' => 'Yes',
                    'needFloodInsurance' => 'Yes'
                ],
                'military' => [
                    'militaryStatus' => 'No'
                ],
                'currentlyInsured' => 'Yes',
                'creditRating' => self::$creditRating[Yii::app()->request->getParam('credit_rating')],
                'driverCount' => 1,
                'vehicleCount' => 1,
                'householdResidentCount' => 1
            ],
            'metaData' => [
                'pingID' => $ping_result['pingId'],
                'homePhoneConsent' => 'Yes',
                'workPhoneConsent' => 'No',
                'consentLanguage' => Yii::app()->request->getParam('tcpa_text', ''),
                'ipAddress' => Yii::app()->request->getParam('ipaddress	', ''),
                'aff' => Yii::app()->request->getParam('promo_code', ''),
                'trustedFormToken' => Yii::app()->request->getParam('trustedformcerturl', ''),
                'leadIdToken' => Yii::app()->request->getParam('universal_leadid', ''),
                'userAgent' => Yii::app()->request->getParam('user_agent', ''),
            ]
        ];
        //echo '<pre>';print_r($fields);exit;
        $post_request = json_encode($fields);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $header = ['content-type: application/json', 'Accept: application/json'];
        //$post_url = 'https://sandboxapi.px.com/api/lead/post';
        $post_url = 'https://leadapi.px.com/api/lead/post';
        $post_response = $cm->curl($post_url, $post_request, $header);
        $time_end = CommonToolsMethods::stopwatch();
        $post_response_array = json_decode($post_response, true);
        if (trim($post_response_array['Success']) == '1') {
            $ping_price = trim($prepingresult['ping_price']);
            $post_price = trim($post_response_array['Payout']);
            $post_status = '1';
            $redirect_url = '';
            $post_fail_reason = '';
            $post_price = $post_price ? $post_price : $ping_price;
        } else {
            $post_status = '0';
            $post_price = 0;
            $redirect_url = '';
            $post_fail_reason = '';
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
