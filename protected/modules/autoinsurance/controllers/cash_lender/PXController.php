<?php
class PXController
{
    public static $occupationListFromBuyer = ['Employeed', 'Government', 'Homemaker', 'Retired', 'Student Living w/ Parents', 'Student not Living w/ Parents', 'Unemployed', 'Sales', 'Marketing', 'IT', 'Medical', 'Unknown', 'BusinessOwner', 'Student', 'SalesInside', 'SalesOutside', 'Scientist', 'OtherTechnical', 'MilitaryEnlisted', 'Architect', 'Other'];
    public static $companyListFromBuyer = ['Company not listed', '21st Century Insurance', 'AAA', 'AIG', 'Alfa Insurance', 'Allied', 'Allstate', 'American Alliance Insurance', 'American Deposit Insurance', 'American Family', 'American Family Insurance', 'American Home Assurance', 'American International Insurance', 'American International Pacific', 'American Motorists Insurance', 'American National', 'American Premier Insurance', 'American Protection Insurance', 'American Skyline Insurance', 'Amica', 'Arbella', 'Assurant', 'Atlanta Casualty', 'Atlantic Indemnity', 'Auto Club Insurance Company', 'Auto-Owners Insurance', 'Bristol West Insurance', 'California State Automobile Association', 'Chubb', 'Citizens', 'Clarendon Insurance', 'Clearcover', 'CNA', 'Company not listed', 'Cotton States', 'COUNTRY Financial', 'Country Insurance and Financial Services', 'CSE Insurance Group', 'Currently not insured', 'Dairyland Insurance', 'Direct auto ', 'Electric Insurance', 'Elephant Insurance', 'Encova Insurance', 'Erie Insurance', 'Esurance', 'Farm Bureau', 'Farmers', 'Foremost', 'GAINSCO', 'Geico', 'Guaranty National Insurance', 'Hanover Insurance Group', 'Hugo Insurance', 'Infinity Insurance', 'Kemper', 'Leader Insurance', 'Liberty Mutual', 'MAPFRE Insurance', 'Maryland Casualty', 'Mercury Insurance', 'MetLife Auto and Home', 'Mid Century Insurance', 'Mile Auto', 'National General Insurance', 'National Union Fire Insurance', 'Nationwide', 'NJM Insurance', 'Omni Insurance', 'Orion Insurance', 'Pacific Insurance', 'Pafco General Insurance', 'Patriot General Insurance', 'Peak Property and Casualty Insurance', 'PEMCO Insurance', 'Plymouth Rock Assurance', 'Progressive', 'Prudential Guarantee', 'Republic Indemnity', 'Response Insurance', 'Root Insurance', 'SafeAuto', 'SAFECO Insurance', 'Safeway Insurance', 'Security Insurance', 'Sentinel Insurance', 'Sentry Insurance', 'Shelter Insurance', 'St. Paul Insurance', 'State Farm', 'Stillwater Insurance', 'The General', 'The Hartford', 'Titan', 'Travelers Insurance', 'Twin City Fire Insurance', 'Unitrin Direct (now Kemper Direct)', 'USAA', 'USF&G (United States Fidelity and Guaranty)', 'Viking Insurance', 'Wawanesa Insurance', 'Western Mutual', 'Windsor Insurance', 'Zurich North America'];
    public static $majorViolationDescription = [
        1 => 'DUI/DWAI',
        2 => 'License was suspended',
        3 => 'Minor in possession',
        4 => 'Open container',
        5 => 'Drug possession',
        6 => 'DrivingWhileUnderTheInfluenceOfDrugs',
        7 => 'DrivingUnderInfluenceOfAlcolholOrWhileIntoxicated',
    ];
    public static $violationDescription = [
        1 => "Careless driving",
        2 => "Carpool lane violation",
        3 => "Child not in car seat",
        4 => "Defective Equipment",
        5 => "Defective vehicle (reduced violation)",
        6 => "Driving without a license",
        7 => "Excessive noise",
        8 => "Exhibition driving",
        9 => "Expired drivers license",
        10 => "Expired emmissions",
        11 => "Expired Registration",
        12 => "Failure to obey traffic signal",
        13 => "Failure to signal",
        14 => "Failure to stop",
        15 => "Failure to yield",
        16 => "Following too close",
        17 => "Illegal lane change",
        18 => "Illegal passing",
        19 => "Illegal turn",
        20 => "Illegal turn on red",
        21 => "Illegal U Turn",
        22 => "Inattentive driving",
        23 => "No helmet",
        24 => "No insurance",
        25 => "No seatbelt",
        26 => "Passing a school bus",
        27 => "Passing in a no-passing zone",
        28 => "Passing on shoulder",
        29 => "Ran a red light",
        30 => "Ran a stop sign",
        31 => "Reckless driving",
        32 => "Reckless endangerment",
        33 => "Wrong way on a one way",
        34 => "Other Unlisted Moving Violation",
        35 => "Driving too fast for conditions",
    ];
    public static $accidentDescription = [
        1 => 'Collided with another car',
        2 => 'Hit an obstruction. Single car accident',
        3 => 'Hit by another person',
        4 => 'Hit while stopped',
        5 => 'Hit a pedestrian',
        6 => 'Other Unlisted Accident',
        7 => 'Rearended by another person',
        8 => 'VehicleHitProperty',
        9 => 'VehicleDamagedAvoidingAccident',
        10 => 'OtherVehicleHitYours',
        11 => 'AtFaultAccidentNotListed',
        12 => 'NotAtFaultAccidentNotListed',
    ];
    public static $claimDescription = [
        1 => 'Act of Nature',
        2 => 'Car fire',
        3 => 'Flood damage',
        4 => 'Hail damage',
        5 => 'Hit an animal',
        6 => 'Theft of stereo',
        7 => 'Theft of vehicle',
        8 => 'Towing service',
        9 => 'Vandalism',
        10 => 'Windshield Replacement',
        11 => 'AutoCylinders'
    ];
    public static $education_old = ['Bachelors Degree', 'Doctorate Degree', 'High school diploma', 'Masters Degree', 'Other', 'None', 'Some College', 'Associate Degree', 'Marketing', 'IT', 'Medical', 'Unknown', 'BusinessOwner', 'Student', 'SalesInside', 'SalesOutside', 'Scientist', 'OtherTechnical', 'MilitaryEnlisted', 'Architect', 'Other'];
    public static $education = [
        1 => 'None',
        2 => 'Some College',
        3 => 'High school diploma',
        4 => 'Some College',
        5 => 'Associate Degree',
        6 => 'Bachelors Degree',
        7 => 'Masters Degree',
        8 => 'Doctorate Degree',
        9 => 'Other'
    ];
    public static $maritalStatus = [
        1 => 'Single',
        2 => 'Married',
        3 => 'Separated',
        4 => 'Divorced',
        5 => 'Domestic Partner',
        6 => 'Widowed'
    ];
    public static $accidentDamage = [
        1 => 'People',
        2 => 'Property',
        3 => 'Both',
        4 => 'Not Applicable'
    ];
    public static $converageType = [
        1 => 'Basic Protection',
        2 => 'Superior Protection',
        3 => 'State Minimum',
        4 => 'Standard Protection'
    ];
    public static $bodilyInjury = [
        1 => '250/500',
        2 => '100/300',
        3 => '50/100',
        4 => '25/50'
    ];
    public static $propertyDamage = [
        1 => '100000',
        2 => '50000',
        3 => '25000',
        4 => '10000'
    ];
    public static $PrimaryUser = [
        1 => 'Business Individual',
        2 => 'Commute To/From Work',
        3 => 'Commute To/From School',
        4 => 'Pleasure',
        5 => 'Farm'
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
        1 => '1-3',
        2 => '4-5',
        3 => '6-9',
        4 => '10-19',
        5 => '20-49',
        6 => '50+'
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
        1 => '100',
        2 => '100',
        3 => '250',
        4 => '250',
        5 => '500',
        6 => '500',
        7 => '1000',
        8 => '1000',
    ];
    public static $creditRating = [
        1 => 'Excellent',
        2 => 'Good',
        3 => 'Some Problems',
        4 => 'Major Problems',
    ];
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
        // ==================== DRIVER 1 ==============================
        $driver1_incidentDate1 = Yii::app()->request->getParam('driver1_incident1_date');
        // CLAIM
        $driver1_claim1_description = Yii::app()->request->getParam('driver1_claim1_description', '');
        $driver1_claim1_paid_amount = Yii::app()->request->getParam('driver1_claim1_paid_amount');
        // VIOLATION
        $driver1_violation1_description = Yii::app()->request->getParam('driver1_violation1_description', '');
        $driver1_violation1_state = Yii::app()->request->getParam('driver1_violation1_state', $city_state['state']);
        // ACCIDENT 
        $driver1_accident1_description = Yii::app()->request->getParam('driver1_accident1_description', '');
        $driver1_accident1_amount = Yii::app()->request->getParam('driver1_accident1_amount');
        $driver1_accident1_damage = self::$accidentDamage[Yii::app()->request->getParam('driver1_accident1_damage', '4')];
        $driver1_accident1_at_fault = Yii::app()->request->getParam('driver1_accident1_at_fault') == 1 ? 'Yes' : 'No';
        // TICKET // MAJOR VIOLATION
        $driver1_ticket1_description = Yii::app()->request->getParam('driver1_ticket1_description');
        // ==================== DRIVER 2 ==============================
        $driver2_incidentDate1 = Yii::app()->request->getParam('driver2_incident1_date');
        // CLAIM
        $driver2_claim1_description = Yii::app()->request->getParam('driver2_claim1_description', '');
        $driver2_claim1_paid_amount = Yii::app()->request->getParam('driver2_claim1_paid_amount');
        // VIOLATION
        $driver2_violation1_description = Yii::app()->request->getParam('driver2_violation1_description', '');
        $driver2_violation1_state = Yii::app()->request->getParam('driver2_violation1_state', $city_state['state']);
        // ACCIDENT 
        $driver2_accident1_description = Yii::app()->request->getParam('driver2_accident1_description', '');
        $driver2_accident1_amount = Yii::app()->request->getParam('driver2_accident1_amount');
        $driver2_accident1_damage = self::$accidentDamage[Yii::app()->request->getParam('driver2_accident1_damage', '4')];
        $driver2_accident1_at_fault = Yii::app()->request->getParam('driver2_accident1_at_fault') == 1 ? 'Yes' : 'No';
        // TICKET // MAJOR VIOLATION
        $driver2_ticket1_description = Yii::app()->request->getParam('driver2_ticket1_description');
        //$ApiToken = 'FDF1EB63-8841-4B55-A45C-126EFFA82509'; //1:1concent
        $ApiToken = '0ABDC241-7723-4AF8-8706-9B1636097CB1'; // exlusive
        $driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer, self::$occupationListFromBuyer[0]);
        $tcpa_text = str_replace('&', '', Yii::app()->request->getParam('tcpa_text'));
        $TcpaText = htmlspecialchars($tcpa_text);
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        $years_at_residance = (int) Yii::app()->request->getParam('stay_in_year');
        if ($years_at_residance > 10 || $years_at_residance < 1) {
            $years_at_resi_array = [15, 20, 25, 30];
            $years_at_residance = $years_at_resi_array[array_rand($years_at_resi_array)];
        }
        $months_at_residance = (int) Yii::app()->request->getParam('stay_in_month');
        $months_at_residance = $months_at_residance > 11 ? rand(1, 11) : $months_at_residance;
        $fields = [
            'ApiToken' => $ApiToken,
            'Vertical' => 'Auto',
            'SubId' => Yii::app()->request->getParam('promo_code'),
            'OriginalUrl' => Yii::app()->request->getParam('url', 'https://eliteinsurers.com'),
            'Source' => 'Social',
            'JornayaLeadId' => Yii::app()->request->getParam('universal_leadid'),
            'Trustedform' => $trustedformcerturl,
            'SessionLength' => '30',
            'TcpaText' => $TcpaText,
            'VerifyAddress' => 'false',
        ];
         $ContactData =  [
            'City' => $city_state['city'],
            'ZipCode' => $zip_code,
            'State' => $city_state['state'],
            'IpAddress' => Yii::app()->request->getParam('ipaddress'),
            'ResidenceType' => Yii::app()->request->getParam('is_rented') == 1 ? 'I am renting' : 'My own house',
            'YearsAtResidence' => (string) $years_at_residance,
            'MonthsAtResidence' => (string) $months_at_residance,
        ];
        $Driver1 =  [
            'BirthDate' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob'))),
            'Gender' => Yii::app()->request->getParam('driver1_gender') == 'M' ? 'Male' : 'Female',
            'MaritalStatus' => self::$maritalStatus[Yii::app()->request->getParam('driver1_marital_status', '1')],
            'RelationshipToApplicant' => 'Self',
            'LicenseState' => $city_state['state'],
            'AgeLicensed' => '18',
            'LicenseStatus' => 'Current',
            'LicenseEverSuspendedRevoked' => 'No',
            'Occupation' => $driver1_occupation,
            'YearsAtEmployer' => '10',
            'Education' => self::$education[Yii::app()->request->getParam('driver1_education', '1')],
            'RequiresSR22Filing' => Yii::app()->request->getParam('driver1_required_SR22', '0') == '1' ? 'Yes' : 'No',
            'CreditRating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '0')],
        ];
        $Driver2 =  [
            'BirthDate' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob'))),
            'Gender' => Yii::app()->request->getParam('driver2_gender') == 'M' ? 'Male' : 'Female',
            'MaritalStatus' => self::$maritalStatus[Yii::app()->request->getParam('driver2_marital_status', '1')],
            'RelationshipToApplicant' => 'Self',
            'LicenseState' => $city_state['state'],
            'AgeLicensed' => '18',
            'LicenseStatus' => 'Current',
            'LicenseEverSuspendedRevoked' => 'No',
            'Occupation' => $driver1_occupation,
            'YearsAtEmployer' => '10',
            'Education' => self::$education[Yii::app()->request->getParam('driver2_education', '1')],
            'RequiresSR22Filing' => Yii::app()->request->getParam('driver2_required_SR22', '0') == '1' ? 'Yes' : 'No',
            'CreditRating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '0')],
        ];
        $Violation1 = [];
        $MajorViolation1 = [];
        $Accident1 = [];
        $Claim1 = [];
        // FOR PX , TICKET = VIOLATION AND VIOLATION = MAJORVALIATION
        if (!empty($driver1_ticket1_description)) {
            $Violation1 = [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$violationDescription[$driver1_ticket1_description],
                
            ];
        }
        if (!empty($driver1_violation1_description)) {
            $MajorViolation1 =  [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$majorViolationDescription[$driver1_violation1_description],
                'State' => $city_state['state'],
            ];
        }
        if (!empty($driver1_accident1_description)) {
            $Accident1 = [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$accidentDescription[$driver1_accident1_description],
                'AtFault' => $driver1_accident1_at_fault,
                'Damage' => $driver1_accident1_damage,
                'Amount' => $driver1_accident1_amount
            ];
        }
        if (!empty($driver1_claim1_description)) {
            $Claim1 =  [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$claimDescription[$driver1_claim1_description],
                'PaidAmount' => $driver1_claim1_paid_amount,
                'Damage' => 'People'
            ];
        }
        $Vehicle1 =  [
            'VIN' => Yii::app()->request->getParam('vehicle1_vin', "1ACBC535*B*******"),
            'Year' => Yii::app()->request->getParam('vehicle1_year'),
            'Make' => Yii::app()->request->getParam('vehicle1_make'),
            'Model' => Yii::app()->request->getParam('vehicle1_model'),
            'SubModel' => Yii::app()->request->getParam('vehicle1_submodel'),
            'WeeklyCommuteDays' => (string) rand(5, 7),
            'Garage' => 'No Cover',
            'Ownership' => Yii::app()->request->getParam('vehicle1_vehicle_ownership') == 1 ? 'Yes' : 'No',
            'PrimaryUse' => self::$PrimaryUser[Yii::app()->request->getParam('vehicle1_primary_use', 1)],
            'AnnualMiles' => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage', 1)],
            'ComprehensiveDeductible' => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
            'OneWayDistance' => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
            'CollisionDeductible' => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
        ];
        $Violation2 = [];$MajorViolation2 = [];$Accident2 = [];$Claim2 = [];
        // FOR PX , TICKET = VIOLATION AND VIOLATION = MAJORVALIATION
        if (!empty($driver1_ticket1_description)) {
            $Violation1 =  [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$violationDescription[$driver1_ticket1_description],
            ];
        }
         if (!empty($driver1_violation1_description)) {
            $MajorViolation1 = [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$majorViolationDescription[$driver1_violation1_description],
                'State' => $city_state['state'],
            ];
        }
        if (!empty($driver2_accident1_description)) {
            $Accident2 =  [
                'Date' => $driver2_incidentDate1,
                'Description' => self::$accidentDescription[$driver2_accident1_description],
                'AtFault' => $driver2_accident1_at_fault,
                'Damage' => $driver2_accident1_damage,
                'Amount' => $driver2_accident1_amount
            ];
        }
        if (!empty($driver2_claim1_description)) {
            $Claim2 =  [
                'Date' => $driver2_incidentDate1,
                'Description' => self::$claimDescription[$driver2_claim1_description],
                'PaidAmount' => $driver2_claim1_paid_amount,
                'Damage' => 'People'
            ];
        }
        $Vehicle2 = null;
        $vehicle2_year = Yii::app()->request->getParam('vehicle2_year');
        if (!empty($vehicle2_year)) {
            $Vehicle2 = [
                'VIN' => Yii::app()->request->getParam('vehicle2_vin', "1ACBC535*B*******"),
                'Year' => Yii::app()->request->getParam('vehicle2_year'),
                'Make' => Yii::app()->request->getParam('vehicle2_make'),
                'Model' => Yii::app()->request->getParam('vehicle2_model'),
                'SubModel' => Yii::app()->request->getParam('vehicle2_submodel'),
                'WeeklyCommuteDays' => (string) rand(5, 7),
                'Garage' => 'No Cover',
                'Ownership' => Yii::app()->request->getParam('vehicle2_vehicle_ownership') == 1 ? 'Yes' : 'No',
                'PrimaryUse' => self::$PrimaryUser[Yii::app()->request->getParam('vehicle2_primary_use', 1)],
                'AnnualMiles' => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle2_annual_mileage', 1)],
                'ComprehensiveDeductible' => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
                'OneWayDistance' => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_daily_mileage')],
                'CollisionDeductible' => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            ];
        }
        $insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer, self::$companyListFromBuyer[0]);
        $CurrentInsurancePolicy =  [
            'InsuranceCompany' => $insuranceCompany,
            'ExpirationDate' => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
            'InsuredSince' => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date'))),
        ];
        $converage_type = Yii::app()->request->getParam('coverage_type', '1');
        $RequestedInsurancePolicy =  [
            'CoverageType' => self::$converageType[$converage_type],
            'BodilyInjury' => self::$bodilyInjury[$converage_type],
            'PropertyDamage' => self::$propertyDamage[$converage_type],
        ];
        if ($Violation1) {
            $Driver1['Violations'] = [];
            $Driver1['Violations'] += [$Violation1];
        }
        if ($MajorViolation1) {
            $Driver1['MajorViolations'] = [];
            $Driver1['MajorViolations'] += [$MajorViolation1];
        }
        if ($Accident1) {
            $Driver1['Accidents'] = [];
            $Driver1['Accidents'] += [$Accident1];
        }
        if ($Claim1) {
            $Driver1['Claims'] = [];
            $Driver1['Claims'] += [$Claim1];
        }
        //==========
        if ($Violation2) {
            $Driver2['Violations'] = [];
            $Driver2['Violations'] += [$Violation2];
        }
        if ($MajorViolation2) {
            $Driver2['MajorViolations'] = [];
            $Driver2['MajorViolations'] += [$MajorViolation2];
        }
        if ($Accident2) {
            $Driver2['Accidents'] = [];
            $Driver2['Accidents'] += [$Accident2];
        }
        if ($Claim2) {
            $Driver2['Claims'] = [];
            $Driver2['Claims'] += [$Claim2];
        }
        $fields['ContactData'] = $ContactData;
        $fields['Drivers'] = [$Driver1, $Driver2];
        $fields['Vehicles']  = [$Vehicle1, $Vehicle2];
        $fields['CurrentInsurancePolicy'] = $CurrentInsurancePolicy;
        $fields['RequestedInsurancePolicy'] = $RequestedInsurancePolicy;
        $fields['InterestedInHomeInsurance'] = 'Yes';
        $purchase = true;
        if ($purchase == true) {
            //$pingData['ping_url'] = 'https://leadapi.px.com/api/lead/ping';
            $pingData['ping_url'] = 'https://sandboxapi.px.com/api/lead/ping';
            $pingData['ping_request'] = json_encode($fields);
            $pingData['header'] = ['content-type: application/json', 'Accept: application/json'];
            return $pingData;
        } else {
            return [];
        }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function extractPingResponse($response)
    {
        $response_array = json_decode($response, TRUE);
        $pResponse = [];
        if ($response_array['Success'] == 1 || $response_array['Success'] == true) {
            $max_payout = max(array_column($response_array['Legs'], 'Payout'));
            $parent_key = 0;
            foreach ($response_array['Legs'] as $key => $value) {
                if (in_array($max_payout, $value)) {
                    $parent_key = $key;
                }
            }
            $pResponse['success'] = '1';
            $pResponse['confirmation_id'] = $response_array['TransactionId'];
            $pResponse['price'] = $response_array['Payout'];
            $pResponse['price'] = $max_payout;
            $pResponse['hash'] = $response_array['Legs'][$parent_key]['Hash'];
        } else {
            $pResponse['success'] = '0';
        }
        echo '<pre>';print_r($pResponse);exit;
        return $pResponse;
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response)
    {
        $result = json_decode($ping_response);
        if ($result->Success == '1') {
            $ping_response_info['ping_status'] = '1';
            $ping_response_info['confirmation_id'] = $result->TransactionId;
            if (isset($result->Brands)) {
                $i = 0;
                $brands = (array) $result->Brands;
                $ping_price = max(array_column($brands, "Bid"));
                $ping_response_info['ping_price'] = trim($ping_price);
                foreach ($result->Brands as $brands) {
                    $ping_response_info['brands'][$i]['brand_id'] = $brands->PxId;
                    $ping_response_info['brands'][$i]['brand_name'] = $brands->Name;
                    $ping_response_info['brands'][$i]['bid_price'] = $brands->Bid;
                    $i++;
                }
            } else {
                $ping_response_info['ping_price'] = $result->Payout;
            }
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
        //$ping_response_array = self::extractPingResponse($ping_response);
        $prepingresult = self::returnPingResponse($ping_response);
        /* foreach ($prepingresult['brands'] as $key => $details) {
            $brands[]["Name"] = $details['brand_name'];
        } */
        /* $prePingReturn = [
            "MatchPingId" => $prepingresult['confirmation_id'],
            "BrandConsent" => $brands,
        ]; */
        $zip_code = Yii::app()->request->getParam('zip');
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        // ==================== DRIVER 1 ==============================
        $driver1_incidentDate1 = Yii::app()->request->getParam('driver1_incident1_date');
        // CLAIM
        $driver1_claim1_description = Yii::app()->request->getParam('driver1_claim1_description', '');
        $driver1_claim1_paid_amount = Yii::app()->request->getParam('driver1_claim1_paid_amount');
        // VIOLATION
        $driver1_violation1_description = Yii::app()->request->getParam('driver1_violation1_description', '');
        $driver1_violation1_state = Yii::app()->request->getParam('driver1_violation1_state', $city_state['state']);
        // ACCIDENT 
        $driver1_accident1_description = Yii::app()->request->getParam('driver1_accident1_description', '');
        $driver1_accident1_amount = Yii::app()->request->getParam('driver1_accident1_amount');
        $driver1_accident1_damage = self::$accidentDamage[Yii::app()->request->getParam('driver1_accident1_damage', '4')];
        $driver1_accident1_at_fault = Yii::app()->request->getParam('driver1_accident1_at_fault') == 1 ? 'Yes' : 'No';
        // TICKET // MAJOR VIOLATION
        $driver1_ticket1_description = Yii::app()->request->getParam('driver1_ticket1_description');
        // ==================== DRIVER 2 ==============================
        $driver2_incidentDate1 = Yii::app()->request->getParam('driver2_incident1_date');
        // CLAIM
        $driver2_claim1_description = Yii::app()->request->getParam('driver2_claim1_description', '');
        $driver2_claim1_paid_amount = Yii::app()->request->getParam('driver2_claim1_paid_amount');
        // VIOLATION
        $driver2_violation1_description = Yii::app()->request->getParam('driver2_violation1_description', '');
        $driver2_violation1_state = Yii::app()->request->getParam('driver2_violation1_state', $city_state['state']);
        // ACCIDENT 
        $driver2_accident1_description = Yii::app()->request->getParam('driver2_accident1_description', '');
        $driver2_accident1_amount = Yii::app()->request->getParam('driver2_accident1_amount');
        $driver2_accident1_damage = self::$accidentDamage[Yii::app()->request->getParam('driver2_accident1_damage', '4')];
        $driver2_accident1_at_fault = Yii::app()->request->getParam('driver2_accident1_at_fault') == 1 ? 'Yes' : 'No';
        // TICKET // MAJOR VIOLATION
        $driver2_ticket1_description = Yii::app()->request->getParam('driver2_ticket1_description');
        //$ApiToken = 'FDF1EB63-8841-4B55-A45C-126EFFA82509'; //1:1concent
        $ApiToken = '0ABDC241-7723-4AF8-8706-9B1636097CB1'; // exlusive
        $driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer, self::$occupationListFromBuyer[0]);
        $tcpa_text = str_replace('&', '', Yii::app()->request->getParam('tcpa_text'));
        $TcpaText = htmlspecialchars($tcpa_text);
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        $years_at_residance = (int) Yii::app()->request->getParam('stay_in_year');
        if ($years_at_residance > 10 || $years_at_residance < 1) {
            $years_at_resi_array = [15, 20, 25, 30];
            $years_at_residance = $years_at_resi_array[array_rand($years_at_resi_array)];
        }
        $months_at_residance = (int) Yii::app()->request->getParam('stay_in_month');
        $months_at_residance = $months_at_residance > 11 ? rand(1, 11) : $months_at_residance;
        $fields = [
            'ApiToken' => $ApiToken,
            'Vertical' => 'Auto',
            'SubId' => Yii::app()->request->getParam('promo_code'),
            'OriginalUrl' => Yii::app()->request->getParam('url', 'https://eliteinsurers.com'),
            'Source' => 'Social',
            'JornayaLeadId' => Yii::app()->request->getParam('universal_leadid'),
            'Trustedform' => $trustedformcerturl,
            'SessionLength' => '30',
            'TcpaText' => $TcpaText,
            'VerifyAddress' => 'false',
            'TransactionId' => $prepingresult['confirmation_id'],
        ];
        //$fields += $prePingReturn;
        $ContactData =  [
            'FirstName' => Yii::app()->request->getParam('driver1_first_name'),
            'LastName' => Yii::app()->request->getParam('driver1_last_name'),
            'Address' => Yii::app()->request->getParam('address'),
            'City' => $city_state['city'],
            'ZipCode' => $zip_code,
            'EmailAddress' => Yii::app()->request->getParam('email'),
            'PhoneNumber' => Yii::app()->request->getParam('phone'),
            'DayPhoneNumber' => Yii::app()->request->getParam('mobile'),
            'State' => $city_state['state'],
            'IpAddress' => Yii::app()->request->getParam('ipaddress'),
            'ResidenceType' => Yii::app()->request->getParam('is_rented') == 1 ? 'I am renting' : 'My own house',
            'YearsAtResidence' => (string) $years_at_residance,
            'MonthsAtResidence' => (string) $months_at_residance,
        ];
        $Driver1 =  [
            'FirstName' => Yii::app()->request->getParam('driver1_first_name'),
            'LastName' => Yii::app()->request->getParam('driver1_last_name'),
            'BirthDate' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob'))),
            'Gender' => Yii::app()->request->getParam('driver1_gender') == 'M' ? 'Male' : 'Female',
            'MaritalStatus' => self::$maritalStatus[Yii::app()->request->getParam('driver1_marital_status', '1')],
            'RelationshipToApplicant' => 'Self',
            'LicenseState' => $city_state['state'],
            'AgeLicensed' => '18',
            'LicenseStatus' => 'Current',
            'LicenseEverSuspendedRevoked' => 'No',
            'Occupation' => $driver1_occupation,
            'YearsAtEmployer' => '10',
            'Education' => self::$education[Yii::app()->request->getParam('driver1_education', '1')],
            'RequiresSR22Filing' => Yii::app()->request->getParam('driver1_required_SR22', '0') == '1' ? 'Yes' : 'No',
            'CreditRating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '0')],
        ];
        $Violation1 = [];$MajorViolation1 = [];$Accident1 = [];$Claim1 = [];
        // FOR PX , TICKET = VIOLATION AND VIOLATION = MAJORVALIATION
        if (!empty($driver1_ticket1_description)) {
            $Violation1 =  [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$violationDescription[$driver1_ticket1_description],
            ];
        }
        if (!empty($driver1_violation1_description)) {
            $MajorViolation1 = [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$majorViolationDescription[$driver1_violation1_description],
                'State' => $city_state['state'],
            ];
        }
        if (!empty($driver1_accident1_description)) {
            $Accident1 = [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$accidentDescription[$driver1_accident1_description],
                'AtFault' => $driver1_accident1_at_fault,
                'Damage' => $driver1_accident1_damage,
                'Amount' => $driver1_accident1_amount
            ];
        }
        if (!empty($driver1_claim1_description)) {
            $Claim1 =  [
                'Date' => $driver1_incidentDate1,
                'Description' => self::$claimDescription[$driver1_claim1_description],
                'PaidAmount' => $driver1_claim1_paid_amount,
                'Damage' => 'People'
            ];
        }
        $Vehicle1 =  [
            'VIN' => Yii::app()->request->getParam('vehicle1_vin', "1ACBC535*B*******"),
            'Year' => Yii::app()->request->getParam('vehicle1_year'),
            'Make' => Yii::app()->request->getParam('vehicle1_make'),
            'Model' => Yii::app()->request->getParam('vehicle1_model'),
            'SubModel' => Yii::app()->request->getParam('vehicle1_submodel'),
            'WeeklyCommuteDays' => (string) rand(5, 7),
            'Garage' => 'No Cover',
            'Ownership' => Yii::app()->request->getParam('vehicle1_vehicle_ownership') == 1 ? 'Yes' : 'No',
            'PrimaryUse' => self::$PrimaryUser[Yii::app()->request->getParam('vehicle1_primary_use', 1)],
            'AnnualMiles' => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage', 1)],
            'ComprehensiveDeductible' => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
            'OneWayDistance' => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
            'CollisionDeductible' => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
        ];
        $Driver2 = []; $Violation2 = []; $MajorViolation2 = []; $Accident2 = []; $Claim2 = [];
        $driver2_first_name = Yii::app()->request->getParam('driver2_first_name');
        if (!empty($driver2_first_name)) {
            $Driver2 =  [
                'FirstName' => $driver2_first_name,
                'LastName' => Yii::app()->request->getParam('driver2_last_name'),
                'BirthDate' => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob'))),
                'Gender' => Yii::app()->request->getParam('driver2_gender') == 'M' ? 'Male' : 'Female',
                'MaritalStatus' => self::$maritalStatus[Yii::app()->request->getParam('driver2_marital_status', '1')],
                'RelationshipToApplicant' => 'Self',
                'LicenseState' => $city_state['state'],
                'AgeLicensed' => '18',
                'LicenseStatus' => 'Current',
                'LicenseEverSuspendedRevoked' => 'No',
                'Occupation' => $driver1_occupation,
                'YearsAtEmployer' => '10',
                'Education' => self::$education[Yii::app()->request->getParam('driver2_education', '1')],
                'RequiresSR22Filing' => Yii::app()->request->getParam('driver2_required_SR22', '0') == '1' ? 'Yes' : 'No',
                'CreditRating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '0')],
            ];
            // FOR PX , TICKET = VIOLATION AND VIOLATION = MAJORVALIATION
            if (!empty($driver2_ticket1_description)) {
                $Violation2 =  [
                    'Date' => $driver2_incidentDate1,
                    'Description' => self::$violationDescription[$driver2_ticket1_description],
                ];
            }
            if (!empty($driver2_violation1_description)) {
                $MajorViolation2 =  [
                    'Date' => $driver2_incidentDate1,
                    'Description' => self::$majorViolationDescription[$driver2_violation1_description],
                    'State' => $city_state['state'],
                ];
            }
            
            if (!empty($driver2_accident1_description)) {
                $Accident2 =  [
                    'Date' => $driver2_incidentDate1,
                    'Description' => self::$accidentDescription[$driver2_accident1_description],
                    'AtFault' => $driver2_accident1_at_fault,
                    'Damage' => $driver2_accident1_damage,
                    'Amount' => $driver2_accident1_amount
                ];
            }
            if (!empty($driver2_claim1_description)) {
                $Claim2 =  [
                    'Date' => $driver2_incidentDate1,
                    'Description' => self::$claimDescription[$driver2_claim1_description],
                    'PaidAmount' => $driver2_claim1_paid_amount,
                    'Damage' => 'People'
                ];
            }
        }
        $Vehicle2 = [];
        $vehicle2_year = Yii::app()->request->getParam('vehicle2_year');
        if (!empty($vehicle2_year)) {
            $Vehicle2 = [
                'VIN' => Yii::app()->request->getParam('vehicle2_vin', "1ACBC535*B*******"),
                'Year' => Yii::app()->request->getParam('vehicle2_year'),
                'Make' => Yii::app()->request->getParam('vehicle2_make'),
                'Model' => Yii::app()->request->getParam('vehicle2_model'),
                'SubModel' => Yii::app()->request->getParam('vehicle2_submodel'),
                'WeeklyCommuteDays' => (string) rand(5, 7),
                'Garage' => 'No Cover',
                'Ownership' => Yii::app()->request->getParam('vehicle2_vehicle_ownership') == 1 ? 'Yes' : 'No',
                'PrimaryUse' => self::$PrimaryUser[Yii::app()->request->getParam('vehicle2_primary_use', 1)],
                'AnnualMiles' => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle2_annual_mileage', 1)],
                'ComprehensiveDeductible' => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
                'OneWayDistance' => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_daily_mileage')],
                'CollisionDeductible' => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            ];
        }
        $insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer, self::$companyListFromBuyer[0]);
        $CurrentInsurancePolicy =  [
            'InsuranceCompany' => $insuranceCompany,
            'ExpirationDate' => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
            'InsuredSince' => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date'))),
        ];
        $converage_type = Yii::app()->request->getParam('coverage_type', '1');
        $RequestedInsurancePolicy =  [
            'CoverageType' => self::$converageType[$converage_type],
            'BodilyInjury' => self::$bodilyInjury[$converage_type],
            'PropertyDamage' => self::$propertyDamage[$converage_type],
        ];
        if ($Violation1) {
            $Driver1['Violations'] = [];
            $Driver1['Violations'] += [$Violation1];
        }
        if ($MajorViolation1) {
            $Driver1['MajorViolations'] = [];
            $Driver1['MajorViolations'] += [$MajorViolation1];
        }
        if ($Accident1) {
            $Driver1['Accidents'] = [];
            $Driver1['Accidents'] += [$Accident1];
        }
        if ($Claim1) {
            $Driver1['Claims'] = [];
            $Driver1['Claims'] += [$Claim1];
        }
        //==========
        if ($Violation2) {
            $Driver2['Violations'] = [];
            $Driver2['Violations'] += [$Violation2];
        }
        if ($MajorViolation2) {
            $Driver2['MajorViolations'] = [];
            $Driver2['MajorViolations'] += [$MajorViolation2];
        }
        if ($Accident2) {
            $Driver2['Accidents'] = [];
            $Driver2['Accidents'] += [$Accident2];
        }
        if ($Claim2) {
            $Driver2['Claims'] = [];
            $Driver2['Claims'] += [$Claim2];
        }
        $fields['ContactData'] = $ContactData;
        $fields['Drivers'] = [$Driver1, $Driver2];
        $fields['Vehicles']  = [$Vehicle1, $Vehicle2];
        $fields['CurrentInsurancePolicy'] = $CurrentInsurancePolicy;
        $fields['RequestedInsurancePolicy'] = $RequestedInsurancePolicy;
        $fields['InterestedInHomeInsurance'] = 'Yes';
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