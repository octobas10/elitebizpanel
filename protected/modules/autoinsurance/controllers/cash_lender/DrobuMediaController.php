<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of DrobuMediaController
 *
 * @author appo
 */
class DrobuMediaController {
    public static $Occupation = array(
        1 => 'Accounts Pay/Rec.',
        2 => 'Actor',
        3 => 'Administration/Management',
        4 => 'Appraiser',
        5 => 'Architect',
        6 => 'Artist',
        7 => 'Assembler',
        8 => 'Auditor',
        9 => 'Baker',
        10 => 'Bank Teller',
        11 => 'Banker',
        12 => 'Bartender',
        13 => 'Broker',
        14 => 'Cashier',
        15 => 'Casino Worker',
        16 => 'CEO',
        17 => 'Certified Public Accountant',
        18 => 'Chemist',
        19 => 'Child Care',
        20 => 'City Worker',
        21 => 'Claims Adjuster',
        22 => 'Clergy',
        23 => 'Clerical/Technical',
        24 => 'College Professor',
        25 => 'Computer Tech',
        26 => 'Construction',
        27 => 'Contractor',
        28 => 'Counselor',
        29 => 'Craftsman/Skilled Worker',
        30 => 'Customer Support Rep',
        31 => 'Custodian',
        32 => 'Dancer',
        33 => 'Decorator',
        34 => 'Delivery Driver',
        35 => 'Dentist',
        36 => 'Director',
        37 => 'Disabled',
        38 => 'Drivers',
        39 => 'Electrician',
        40 => 'Engineer-Aeronautical',
        41 => 'Engineer-Aerospace',
        42 => 'Engineer-Chemical',
        43 => 'Engineer-Civil',
        44 => 'Engineer-Electrical',
        45 => 'Engineer-Gas',
        46 => 'Engineer-Geophysical',
        47 => 'Engineer-Mechanical',
        48 => 'Engineer-Nuclear',
        49 => 'Engineer-Other',
        50 => 'Engineer-Petroleum',
        51 => 'Engineer-Structural',
        52 => 'Entertainer',
        53 => 'Farmer',
        54 => 'Fire Fighter',
        55 => 'Flight Attend.',
        56 => 'Food Service',
        57 => 'Health Care',
        58 => 'Installer',
        59 => 'Instructor',
        60 => 'Journalist',
        61 => 'Journeyman',
        62 => 'LabTech.',
        63 => 'Laborer/Unskilled Worker',
        64 => 'Lawyer',
        65 => 'Machine Operator',
        66 => 'Machinist',
        67 => 'Maintenance',
        68 => 'Manufacturer',
        69 => 'Marketing',
        70 => 'Mechanic',
        71 => 'Model',
        72 => 'Nanny',
        73 => 'Nurse/CNA',
        74 => 'Other',
        75 => 'Painter',
        76 => 'Para-Legal',
        77 => 'Paramedic',
        78 => 'Personal Trainer',
        79 => 'Photographer',
        80 => 'Physician',
        81 => 'Pilot',
        82 => 'Plumber',
        83 => 'Police Officer',
        84 => 'Postal Worker',
        85 => 'Preacher',
        86 => 'Pro Athlete',
        87 => 'Production',
        88 => 'Prof-College Degree',
        89 => 'Prof-Specialty Degree',
        90 => 'Programmer',
        91 => 'Real Estate',
        92 => 'Receptionist',
        93 => 'Reservation Agent',
        94 => 'Restaurant Manager',
        95 => 'Retail',
        96 => 'Roofer',
        97 => 'Sales',
        98 => 'Scientist',
        99 => 'Secretary',
        100 => 'Security',
        101 => 'Social Worker',
        102 => 'Stocker',
        103 => 'Store Owner',
        104 => 'Stylist',
        105 => 'Supervisor',
        106 => 'Teacher',
        107 => 'Teacher - with Credentials',
        108 => 'Technical/Supervisory',
        109 => 'Travel Agent',
        110 => 'Truck Driver',
        111 => 'Vet',
        112 => 'Waitress',
        113 => 'Welder',
        114 => 'Government',
        115 => 'Housewife/Househusband',
        116 => 'Retired',
        117 => 'Student Not Living w/Parents',
        118 => 'Unemployed',
        119 => 'Military E1 - E4',
        120 => 'Military E5 - E7',
        121 => 'Military Officer',
        122 => 'Military Other',
        123 => 'Unknown',
        124 => 'Self Employed',
        125 => 'Student Living w/Parents');
    public static $ticketDescription = array(
            1 => 'Careless driving',
            2 => 'Carpool lane violation',
            3 => 'Child not in car seat',
            4 => 'Defective Equipment',
            5 => 'Defective vehicle (reduced violation)',
            6 => 'Driving too fast for conditions',
            7 => 'Driving without a license',
            8 => 'Excessive noise',
            9 => 'Exhibition driving',
            10 => 'Expired drivers license',
            11 => 'Expired emmissions',
            12 => 'Expired Registration',
            13 => 'Failure to obey traffic signal',
            14 => 'Failure to signal',
            15 => 'Failure to stop',
            16 => 'Failure to yield',
            17 => 'Following too close',
            18 => 'Illegal lane change',
            19 => 'Illegal passing',
            20 => 'Illegal turn',
            21 => 'Illegal turn on red',
            22 => 'Illegal U Turn',
            23 => 'Inattentive driving',
            24 => 'No helmet',
            25 => 'No insurance',
            26 => 'No seatbelt',
            27 => 'Passing a school bus',
            28 => 'Passing in a no-passing zone',
            29 => 'Passing on shoulder',
            30 => 'Ran a red light',
            31 => 'Ran a stop sign',
            32 => 'Wrong way on a one way',
            33 => 'Speeding',
            34 => 'Speeding less than 10 MPH over',
            35 => 'Speeding more than 10 MPH over',
            36 => 'Speeding more than 20 MPH over',
            37 => 'Other Ticket');
        public static $accidentDescription = array(
            1 => 'Vehicle Hit Vehicle',
            2 => 'Vehicle Hit Pedestrian',
            3 => 'Vehicle Hit Property',
            4 => 'Vehicle Damaged Avoiding Accident',
            5 => 'Other Vehicle Hit Yours',
            6 => 'Not Listed'
        );
        public static $violationDescription = array(
            1 => 'Driving While Suspended/Revoked',
            2 => 'Drunk Driving - Injury',
            3 => 'Drunk Driving - no Injury',
            4 => 'Hit and Run - Injury',
            5 => 'Hit and Run - no Injury',
            6 => 'Reckless Driving - Injury',
            7 => 'Reckless Driving - no Injury',
            8 => 'Speeding Over 100'
        );
        public static $claimDescription = array(
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
            11 => 'Other'
        );
        public static $education = array(
            1 => 'Less than High School',
            2 => 'Some or No High School',
            3 => 'High School Diploma',
            4 => 'Some College',
            5 => 'Associate Degree',
            6 => 'Bachelors Degree',
            7 => 'Masters Degree',
            8 => 'Doctorate Degree',
            9 => 'Other'
        );
        public static $maritalStatus = array(
            1 => 'Single',
            2 => 'Married',
            3 => 'Separated',
            4 => 'Divorced',
            5 => 'Domestic Partner',
            6 => 'Widowed'
        );
        public static $accidentDamage = array(
            1 => 'People',
            2 => 'Property',
            3 => 'Both',
            4 => 'Not Applicable'
        );
        public static $converageType = array(
            1 => 'Preferred',
            2 => 'Premium',
            3 => 'Premium',
            4 => 'State Minimum'
        );
        public static $bodilyInjury = array(
            1 => '250/500',
            2 => '100/300',
            3 => '50/100',
            4 => '25/50'
        );
        public static $propertyDamage = array(
            1 => '100000',
            2 => '50000',
            3 => '25000',
            4 => '10000'
        );
        public static $PrimaryUser = array(
            1=>'Business',
            2=>'Commute Work',
            3=>'Commute School',
            4=>'Pleasure',
            5=>'Commute Varies'
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
        public static $vehicleDeductibles = array (
            1 =>'0',
            2 =>'50',
            3 =>'100',
            4 =>'250',
            5 =>'500',
            6 =>'1000',
            7 =>'2500',
            8 =>'5000',
        );
        public static $vehicleCollisionDeductibles = array(
            1 =>'0',
            2 =>'50',
            3 =>'100',
            4 =>'250',
            5 =>'500',
            6 =>'1000',
            7 =>'2500',
            8 =>'5000'
        );
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $pingData = array();
        $zip_code = Yii::app()->request->getParam('zip');
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $insurance_company_id = Yii::app()->request->getParam('insurance_company');
        $InsuranceComapany = $submission_model->getInsuranceCompanyDetailsById($insurance_company_id);
        //$marital_status = self::$maritalStatus[Yii::app()->request->getParam('marital_status', '1')];
        $user_agent_list = ['Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1','Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36','Roku4640X/DVP-7.70 (297.70E04154A)','Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30','Mozilla/5.0 (Linux; Android 5.1; AFTS Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/41.99900.2250.0242 Safari/537.36','Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)','Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US','Mozilla/5.0 (Windows NT 10.0; Win64; x64; XBOX_ONE_ED) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393'];
        $user_agent = $user_agent_list[array_rand($user_agent_list)];

        $tcpa_compliant = Yii::app()->request->getParam('tcpa_optin');
        $tcpa_compliant = $tcpa_compliant == '0' ? '0' : '1';
        $trustedformcerturl  = Yii::app()->request->getParam('trustedformcerturl', $url);
        $meta = array(
            'originally_created' => date("c"), //required
            'source_id' => Yii::app()->request->getParam('promo_code'), //required
            'offer_id' => Yii::app()->request->getParam('promo_code'), //optional
            'lead_id_code' => Yii::app()->request->getParam('universal_leadid'), //required
            'trusted_form_cert_url' => $trustedformcerturl, //optional
            'tcpa_compliant' => $tcpa_compliant, //required
            'tcpa_consent_text' => Yii::app()->request->getParam('tcpa_text'), //required
            'user_agent' => $user_agent,
            'landing_page_url' => Yii::app()->request->getParam('url','https://eliteinsurers.com'), //required
        );
        $contact = array(
            "zip_code" => $zip_code, //required
            "ip_address" => Yii::app()->request->getParam('ipaddress', '10.0.0.1'), F
        );
        $years_at_residence = Yii::app()->request->getParam('stay_in_year', '4');
        $months_at_residence = Yii::app()->request->getParam('stay_in_month', '3');
        $drivers1 = array(
            '0' => array(
                "birth_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob'))),
                "marital_status" => self::$maritalStatus[Yii::app()->request->getParam('driver1_marital_status', '1')],
                "gender" => Yii::app()->request->getParam('driver1_gender'),
                "relationship" => 'self',
                "license_status" => 'Active',
                "license_state" => $city_state['state'],
                "requires_sr22" => Yii::app()->request->getParam('driver1_required_SR22', '0'),
                "bankruptcy" => Yii::app()->request->getParam('bankruptcy', '0'),
                'education' => self::$education[Yii::app()->request->getParam('driver1_education', '1')],
                'occupation' => self::$Occupation[Yii::app()->request->getParam('driver1_occupation', '1')],
                'residence_type' => (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own',
                'months_at_residence' => (($years_at_residence * 12) + $months_at_residence),
        ));
		$drivers2 = [];
        if (Yii::app()->request->getParam('driver2_gender')) {
            $drivers2 = array(
                '1' => array(
                    "birth_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob'))),
                    "marital_status" => self::$maritalStatus[Yii::app()->request->getParam('driver2_marital_status', '1')],
                    "gender" => Yii::app()->request->getParam('driver2_gender'),
                    "relationship" => 'Spouse',
                    "license_status" => 'Active',
                    "license_state" => $city_state['state'],
                    "requires_sr22" => Yii::app()->request->getParam('driver2_required_SR22', '0'),
                    'education' => self::$education[Yii::app()->request->getParam('driver2_education', '1')],
                    'occupation' => self::$Occupation[Yii::app()->request->getParam('driver2_occupation', '1')],
                    'residence_type' => (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own',
                    'months_at_residence' => (($years_at_residence * 12) + $months_at_residence),
            ));
        }
        if (Yii::app()->request->getParam('driver1_hasTAVCs')) {
            for ($i = 1; $i <= Yii::app()->request->getParam('driver1_num_of_incidents'); $i++) {
                switch (Yii::app()->request->getParam("driver1_incident" . $i . "_type")) {
                    case 1:
                        $drivers[0]["tickets"][] = array(
                            "ticket_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date'))),
                             "description" => self::$ticketDescription[Yii::app()->request->getParam('driver1_ticket'.$i.'_description')],
                        );
                        break;
                    case 2:
                        $drivers[0]["accidents"][] = array(
                            "accident_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date'))),
                            "description" => self::$accidentDescription[Yii::app()->request->getParam('driver1_accident'.$i.'_description')],
                            "at_fault" => Yii::app()->request->getParam('driver1_accident'.$i.'_at_fault'),
                            "damage" => self::$accidentDamage[Yii::app()->request->getParam('driver1_accident'.$i.'_damage')],
                        );
                        break;
                    case 3:
                        $drivers[0]["major_violations"][] = array(
                            "violation_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date'))),
                            "description" => self::$violationDescription[Yii::app()->request->getParam('driver1_violation'.$i.'_description')],
                            "state" => Yii::app()->request->getParam('driver1_violation'.$i.'_state'),
                        );
                        break;
                    case 4:
                        $drivers[0]["claims"][] = array(
                            "claim_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date'))),
                             "description" => self::$claimDescription[Yii::app()->request->getParam('driver1_claim'.$i.'_description')],
                            "paid_amount" => Yii::app()->request->getParam('driver1_claim'.$i.'_paid_amount'),
                        );
                        break;
                }
            }
        }
        $vehicles1 = array(
            '0' => array(
                "year" => Yii::app()->request->getParam('vehicle1_year'),
                "make" => Yii::app()->request->getParam('vehicle1_make'),
                "model" => Yii::app()->request->getParam('vehicle1_model'),
                "submodel" => Yii::app()->request->getParam('vehicle1_submodel'),
                "vin" => Yii::app()->request->getParam('vehicle1_vin',"1ACBC535*B*******"),
                "primary_use" => self::$PrimaryUser[Yii::app()->request->getParam('vehicle1_primary_use')],
                "ownership" => Yii::app()->request->getParam('vehicle1_vehicle_ownership')== 1? 'Own': 'Lease',
                "annual_miles" => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage')],
                "one_way_distance" => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
                "salvaged" => "0",
                "rental" => "0",
                "comprehensive_deductible" => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
                "collision_deductible" => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
        ));
		$vehicles2 = [];
        if (Yii::app()->request->getParam('vehicle2_year')) {
            $vehicles2 = array(
                '1' => array(
                    "year" => Yii::app()->request->getParam('vehicle2_year'),
                    "make" => Yii::app()->request->getParam('vehicle2_make'),
                    "model" => Yii::app()->request->getParam('vehicle2_model'),
                    "submodel" => Yii::app()->request->getParam('vehicle2_submodel'),
                    "vin" => Yii::app()->request->getParam('vehicle2_vin',"1ACBC535*B*******"),
                    "primary_use" => self::$PrimaryUser[Yii::app()->request->getParam('vehicle2_primary_use')],
                    "ownership" => Yii::app()->request->getParam('vehicle2_vehicle_ownership')== 1? 'Own': 'Lease',
                    "annual_miles" => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle2_annual_mileage')],
                    "one_way_distance" => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
                    "salvaged" => "0",
                    "rental" => "0",
                    "comprehensive_deductible" => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
                    "collision_deductible" => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            ));
        }
		$drivers = array_merge($drivers1,$drivers2);
		$vehicles = array_merge($vehicles1,$vehicles2);
        $fields["meta"] = $meta;
        $fields["contact"] = $contact;
        $fields["data"] = array(
            "drivers" => $drivers,
            "vehicles" => $vehicles
        );
        $converage_type = Yii::app()->request->getParam('coverage_type', '1');
        if (Yii::app()->request->getParam('insurance_policy', '1')) {
            $fields["data"]["current_policy"] = array(
                "insurance_company" => $InsuranceComapany['insurance_company_name'],
                "expiration_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
                "insured_since" => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date'))),
                "coverage_type" => self::$converageType[$converage_type],
            );
        }
        $fields["data"]["requested_policy"] = array(
            "coverage_type" => self::$converageType[$converage_type],
            "bodily_injury" => self::$bodilyInjury[$converage_type],
            "property_damage" => self::$propertyDamage[$converage_type],
        );
        $pingData['ping_request'] = json_encode($fields);
        $pingData['header'] = array(
            "authorization: Token $p2",
            "content-type: application/json",
        );
        return $pingData;
    }

    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        $result = json_decode($ping_response,TRUE);
        //echo '<pre>';print_r($result);die();
        if (isset($result['status']) && $result['status'] == 'success') {
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
    public static function sendPostData($parameter1, $parameter2, $parameter3, $ping_response, $post_url, $status) {
    //  preg_match("/<Confirmation>(.*)<\/Confirmation>/msui", $ping_response, $confirmation_id);
        $confirmation_id = json_decode($ping_response,TRUE);
        $home_payment = Yii::app()->request->getParam('home_pay') < 99 ? rand(100, 2000) : Yii::app()->request->getParam('home_pay');
        $zip_code = Yii::app()->request->getParam('zip');
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $insurance_company_id = Yii::app()->request->getParam('insurance_company');
        $InsuranceComapany = $submission_model->getInsuranceCompanyDetailsById($insurance_company_id);
        //$marital_status = $maritalStatus[Yii::app()->request->getParam('marital_status', '1')];
        $user_agent_list = ['Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1','Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36','Roku4640X/DVP-7.70 (297.70E04154A)','Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30','Mozilla/5.0 (Linux; Android 5.1; AFTS Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/41.99900.2250.0242 Safari/537.36','Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)','Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US','Mozilla/5.0 (Windows NT 10.0; Win64; x64; XBOX_ONE_ED) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393'];
        $user_agent = $user_agent_list[array_rand($user_agent_list)];
        $trustedformcerturl  = Yii::app()->request->getParam('trustedformcerturl', $url);
        $meta = array(
            'originally_created' => date("c"), //required
            'source_id' => Yii::app()->request->getParam('promo_code'), //required
            'offer_id' => Yii::app()->request->getParam('promo_code'), //optional
            'lead_id_code' => Yii::app()->request->getParam('universal_leadid'), //required
            'trusted_form_cert_url' => $trustedformcerturl, //optional
            'tcpa_compliant' => Yii::app()->request->getParam('tcpa_optin'), //required
            'tcpa_consent_text' => Yii::app()->request->getParam('tcpa_text'), //required
            'user_agent' => $user_agent,
            'landing_page_url' => Yii::app()->request->getParam('url','https://eliteinsurers.com'), //required
        );
        $contact = array(
            "first_name" => Yii::app()->request->getParam('driver1_first_name'), 
            "last_name" => Yii::app()->request->getParam('driver1_last_name'), 
            "email" => Yii::app()->request->getParam('email'), 
            "phone" => Yii::app()->request->getParam('phone'), 
            "address" => Yii::app()->request->getParam('address'), 
            "city" => Yii::app()->session['city'] ? Yii::app()->session['city'] : $city_state['city'],
            "state" => Yii::app()->session['state'] ? Yii::app()->session['state'] : $city_state['state'],
            "zip_code" => Yii::app()->request->getParam('zip', '10010'), //required
            "ip_address" => Yii::app()->request->getParam('ipaddress', '10.0.0.1'), F
        );
        $years_at_residence = Yii::app()->request->getParam('stay_in_year', '4');
        $months_at_residence = Yii::app()->request->getParam('stay_in_month', '3');
        $drivers1 = array(
            '0' => array(
                "first_name" => Yii::app()->request->getParam('driver1_first_name'), 
                "last_name" => Yii::app()->request->getParam('driver1_last_name'), 
                "birth_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_dob'))),
                "marital_status" => self::$maritalStatus[Yii::app()->request->getParam('driver1_marital_status', '1')],
                "license_status" => 'Active',
                "relationship" => 'self',
                "license_state" => $city_state['state'],
                "gender" => Yii::app()->request->getParam('driver1_gender'),
                "requires_sr22" => Yii::app()->request->getParam('driver1_required_SR22', '0'),
                "bankruptcy" => Yii::app()->request->getParam('bankruptcy', '0'),
                'education' => self::$education[Yii::app()->request->getParam('driver1_education', '1')],
                'occupation' => self::$Occupation[Yii::app()->request->getParam('driver1_occupation', '1')],
                'residence_type' => (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own',
                'months_at_residence' => (($years_at_residence * 12) + $months_at_residence),
        ));
		$drivers2 = [];
        if (Yii::app()->request->getParam('driver2_first_name')) {
            $drivers2 = array(
                '1' => array(
                    "first_name" => Yii::app()->request->getParam('driver2_first_name'), 
                    "last_name" => Yii::app()->request->getParam('driver2_last_name'), 
                    "birth_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob'))),
                    "marital_status" => self::$maritalStatus[Yii::app()->request->getParam('driver2_marital_status', '1')],
                    "license_status" => 'Active',
                    "relationship" => 'Spouse',
                    "gender" => Yii::app()->request->getParam('driver2_gender'),
                    "license_state" => $city_state['state'],
                    "requires_sr22" => Yii::app()->request->getParam('driver2_required_SR22', '0'),
                    'education' => self::$education[Yii::app()->request->getParam('driver2_education', '1')],
                    'occupation' => self::$Occupation[Yii::app()->request->getParam('driver2_occupation', '1')],
                    'residence_type' => (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own',
                    'months_at_residence' => (($years_at_residence * 12) + $months_at_residence),
            ));
        }
        if (Yii::app()->request->getParam('driver1_hasTAVCs')) {
            for ($i = 1; $i <= Yii::app()->request->getParam('driver1_num_of_incidents'); $i++) {
                switch (Yii::app()->request->getParam("driver1_incident" . $i . "_type")) {
                    case 1:
                        $drivers[0]["tickets"][] = array(
                            "ticket_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date'))),
                            "description" => self::$ticketDescription[Yii::app()->request->getParam('driver1_ticket'.$i.'_description')],
                        );
                        break;
                    case 2:
                        $drivers[0]["accidents"][] = array(
                            "accident_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date'))),
                             "description" => self::$accidentDescription[Yii::app()->request->getParam('driver1_accident'.$i.'_description')],
                            "at_fault" => Yii::app()->request->getParam('driver1_accident'.$i.'_at_fault'),
                            "damage" => self::$accidentDamage[Yii::app()->request->getParam('driver1_accident'.$i.'_damage')],
                        );
                        break;
                    case 3:
                        $drivers[0]["major_violations"][] = array(
                            "violation_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date'))),
                            "description" => self::$violationDescription[Yii::app()->request->getParam('driver1_violation'.$i.'_description')],
                        );
                        break;
                    case 4:
                        $drivers[0]["claims"][] = array(
                            "claim_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('driver1_incident'.$i.'_date'))),
                            "description" => self::$claimDescription[Yii::app()->request->getParam('driver1_claim'.$i.'_description')],
                            "paid_amount" => Yii::app()->request->getParam('driver1_claim'.$i.'_paid_amount'),
                        );
                        break;
                }
            }
        }
        $vehicles1 = array(
            '0' => array(
                "year" => Yii::app()->request->getParam('vehicle1_year'),
                "make" => Yii::app()->request->getParam('vehicle1_make'),
                "model" => Yii::app()->request->getParam('vehicle1_model'),
                "submodel" => Yii::app()->request->getParam('vehicle1_submodel'),
                "vin" => Yii::app()->request->getParam('vehicle1_vin',"1ACBC535*B*******"),
                "primary_use" => self::$PrimaryUser[Yii::app()->request->getParam('vehicle1_primary_use')],
                "ownership" => Yii::app()->request->getParam('vehicle1_vehicle_ownership')== 1? 'Own': 'Lease',
                "annual_miles" => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage')],
                "one_way_distance" => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage')],
                "salvaged" => "0",
                "rental" => "0",
                "comprehensive_deductible" => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
                "collision_deductible" => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
        ));
		$vehicles2 = [];
        if (Yii::app()->request->getParam('vehicle2_year')) {
            $vehicles2 = array(
                '1' => array(
                    "year" => Yii::app()->request->getParam('vehicle2_year'),
                    "make" => Yii::app()->request->getParam('vehicle2_make'),
                    "model" => Yii::app()->request->getParam('vehicle2_model'),
                    "submodel" => Yii::app()->request->getParam('vehicle2_submodel'),
                    "vin" => Yii::app()->request->getParam('vehicle2_vin',"1ACBC535*B*******"),
                    "primary_use" => self::$PrimaryUser[Yii::app()->request->getParam('vehicle2_primary_use')],
                    "ownership" => Yii::app()->request->getParam('vehicle2_vehicle_ownership')== 1? 'Own': 'Lease',
                    "annual_miles" => self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle2_annual_mileage')],
                    "one_way_distance" => self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_daily_mileage')],
                    "salvaged" => "0",
                    "rental" => "0",
                    "comprehensive_deductible" => self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles')],
                    "collision_deductible" => self::$vehicleCollisionDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles')],
            ));
        }
		$drivers = array_merge($drivers1,$drivers2);
		$vehicles = array_merge($vehicles1,$vehicles2);
        $fields["auth_code"] = $confirmation_id["auth_code"];
        $fields["meta"] = $meta;
        $fields["contact"] = $contact;
        $fields["data"] = array(
            "drivers" => $drivers,
            "vehicles" => $vehicles
        );
        $converage_type = Yii::app()->request->getParam('coverage_type', '1');
        if (Yii::app()->request->getParam('insurance_policy', '1')) {
            $fields["data"]["current_policy"] = array(
                "insurance_company" => $InsuranceComapany['insurance_company_name'],
                "expiration_date" => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_expiration_date'))),
                "insured_since" => date('Y-m-d', strtotime(Yii::app()->request->getParam('insurance_start_date'))),
                "coverage_type" => self::$converageType[$converage_type],
            );
        }
        $fields["data"]["requested_policy"] = array(
            "coverage_type" => self::$converageType[$converage_type],
            "bodily_injury" => self::$bodilyInjury[$converage_type],
            "property_damage" => self::$propertyDamage[$converage_type],
        );
        //$post_request = http_build_query($fields);
        $post_request = json_encode($fields);
        $header = array(
            "authorization: Token $parameter2",
            "content-type: application/json",
        );
        //echo '<pre>';print_r($post_request);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $post_response = $cm->curl($post_url, $post_request, $header);
        $time_end = CommonToolsMethods::stopwatch();
        //echo '<pre>';print_r($post_response);die();
        //preg_match("/<Response>(.*)<\/Response>/", $post_response, $success);
        $success = json_decode($post_response,TRUE);
        //echo '<pre>';print_r();die();
        if (isset($success['status']) && $success['status'] == 'success') {
            $post_status = '1';
            $redirect_url = '';
            preg_match("/<Price>(.*)<\/Price>/msui", $post_response, $price);
            preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $ping_price);
            $ping_success = json_decode($ping_response,TRUE);
            $post_price = isset($success['price']) ? $success['price'] : $ping_success['price'];
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
        // echo '<pre>';print_r($post_responses);die();
        return $post_responses;
    }
}
