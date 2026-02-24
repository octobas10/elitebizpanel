<?php
class EtnamericaController extends Controller {
    public static $AccidentType = [
            1 => '5',
            2 => '3',
            3 => '4',
            4 => '2',
            5 => '1',
            6 => '0'
        ];
    public static $Damage = [
            2 => '2',
            3 => '3',
            4 => '0'
        ];

    public static $PrimaryUsage = [
            1 => 'Business',
            2 => 'Commute Work',
            3 => 'Commute School',
            4 => 'Pleasure',
            5 => 'Commute Varies'
        ];

    public static $converageType = [
            1 => 'Superior',
            2 => 'Standard',
            3 => 'Basic',
            4 => 'State Minimum'
        ];
    public static $bodilyInjury = [
            1 => '250/500',
            2 => '100/300',
            3 => '50/100',
            4 => '25/50'
        ];
    public static $vehicleAnnualMileage = [
            1 => '1 to 5,000 miles',
            2 => '5,001 to 7,500 miles',
            3 => '7,501 to 10,000 miles',
            4 => '10,001 to 12,500 miles',
            5 => '12,501 to 15,000 miles',
            6 => '15,001 to 18,000 miles',
            7 => '18,001 to 25,000 miles',
            8 => '25,001 to 50,000 miles',
            9 => '50,001+ miles'
        ];
    public static $vehicleDailyMileage = [
            1 => 'up to 3 miles',
            2 => 'up to 5 miles',
            3 => 'up to 9 miles',
            4 => 'up to 19 miles',
            5 => 'up to 50 miles',
            6 => '51+ miles'
    ];
    public static $maritialStatus = [
            1 => 'Single',
            2 => 'Married',
            3 => 'Separated',
            4 => 'Divorced',
            5 => 'Domestic Partner',
            6 => 'Widowed'
    ];
    public static $creditRating = [
            1 => 'Excellent',
            2 => 'Good',
            3 => 'Average',
            4 => 'Poor',
    ];
    public static $educationList = [
            1 => 'Less than High School',
            2 => 'Some Or No High School',
            3 => 'High School Diploma',
            4 => 'Some College',
            5 => 'Associate Degree',
            6 => 'Bachelors Degree',
            7 => 'Masters Degree',
            8 => 'Doctoral Degree',
            9 => 'Other',
    ];
    public static $driverAccidentDescription = [
            1 => 'Vehicle Hit Vehicle',
            2 => 'Vehicle Hit Pedestrian',
            3 => 'Vehicle Hit Property',
            4 => 'Vehicle Damaged Avoiding Accident',
            5 => 'Other Vehicle Hit Yours',
            6 => 'Not Listed'
    ];
    public static $AccidentDamage = [
            1 => 'People',
            2 => 'Property',
            3 => 'Both',
            4 => 'Not Applicable',
    ];
    public static $occupationListFromBuyer = [
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
        125 => 'Student Living w/Parents'
    ];
    public static $companyListFromBuyer = ["Company Not Listed","21st Century Insurance","AAA Insurance Co.","AABCO","AARP","Access Insurance","Acordia","Aegis Security","Aetna","Affirmative","Aflac","AHCP","AIG","AIU Insurance","Alfa Insurance","All Nation","All Risk","Alleghany Corporation","Allianz","Allied Group","Allied","Allmerica","Allstate Insurance","American Alliance Ins Co","American Automobile Insurance","American Banks","American Casualty","American Deposit Insurance","American Direct Business Insurance","American Economy Ins Co","American Empire Insurance","American Family Insurance","American Financial","American Health Underwriters","American Home Assurance","American Income Life Insurance Company","American Insurance","American International Ins","American International Pacific","American International South","American Manufacturers","American Mayflower Insurance","American Medical Securities","American Motorists Insurance","American National Insurance","American National Property and Casualty","American Premier","American Protection Insurance","American Reliable Ins Co","American Republic","American Savers Plan","American Service Insurance","American Skyline Insurance Company","American Spirit Insurance","American Standard Insurance - OH","American Standard Insurance - WI","American States","Americas Ins. Consultants","AmeriPlan","Ameriprise","Amerisure","Ameritas Life Insurance Company","Amex Assurance Co","Amica Insurance","Amica Mutual Ins Co","Answer Financial","Anthem","API","Arbella","Arizona General","Armed Forces Insurance","Assigned Risk","Associated Indemnity","Associated Insurance Managers","Assurant","Atlanta Casualty","Atlanta Specialty","Atlantic Indemnity","Atlantic Mutual Co","Atlantis","Austin Mutual","Auto Club Insurance Company","Auto Owners","Avomark","AXA Equitable Life Insurance Company","Badger Mutual","Bankers Life and Casualty Company","Banner Life","Berkshire Hathaway","Best Agency USA","Blue Cross / Blue Shield","Bonneville","Boston Old Colony","Builders","Cal Farm Insurance","Calfarm Ins Co","California Casualty and Fire Ins Co","California State Automobile Association","Camden","Capital Choice","Cascade National Ins","Casualty Assurance","Centennial","Century National Ins","Charter Oak","Chartis","Chase Insurance Group","Chicago Insurance","Chubb Group of Ins Co","Church Mutual","Cigna","Cincinnati Insurance Company","Citizens","Clarendon National Insurance","Clarendon","Cloverleaf","CNA","Colonial Penn","Colonial","Combined","Commerce Insurance Group","Commerce West","Commercial Union","Commonwealth","Conseco","Continental Casualty","Continental Divide Insurance","Continental Insurance","Cotton States Insurance","Cottonwood","Country Financial","Countrywide Insurance","Criterion","CSE Insurance Group","CUNA Mutual","Dairyland Insurance","Dakota Fire","Deerbrook","Depositors Emcasc","Direct General Insurance","Dixie","Eagle Ins Co","Ebco General","eFinancial","eHealth","Electric Insurance","Elephant","EMC","Empire Fire and Marine","Employers Fire","Encompass Insurance Company","Ensure","Equitable Life","Erie Insurance Company","Esurance","Evergreen USA RRG","Explorer","Facility","Farm and Ranch","Farm Bureau/Farm Family/Rural","Farmers Insurance","Farmers Union","Farmland","Federal Ins Co","Federated Mutual Insurance Company","Fidelity Insurance Company","Financial Indemnity","Fire and Casualty Insurance Co of CT","Firemans Fund","First Acceptance Insurance","First American","First Financial","First General","First Insurance Company of Hawaii, LTD","First National","FM Global","Ford Motor Credit","Foremost","Foresters","Fortis","Franklin","GAINSCO","Geico Casualty","Geico","General Accident Insurance","General Re","Genworth Financial","Globe","GMAC Insurance","Grange","GRE Harleysville H","Great American Ins Co","Great Way","Great West Casualty Company","Grinnell Mutual","Guaranty National Insurance","Guardian Life Insurance Company of America","Guide One Insurance","Halcyon","Hanover Ins Co","Hanover Lloyds Insurance Company","Happy Days","Hartford Accident and Indemnity","Hawkeye Security","HCC Insurance Holdings","Health Benefits Direct","Health Choice One","Health Net","Health Plus of America","HealthMarkets","HealthShare American","Heritage","Home State County Mutual","Horace Mann","Humana","IAB","IFA Auto Insurance","IGF","IIS Insurance","Infinity Insurance","Infinity Select Insurance","Insphere Insurance Solutions","Insur. of Evanston","Insurance Co of the West","Insurance Insight","Integon","Interstate","Jackson National Life","John Deere","John Hancock Insurance","Kaiser Permanente","Kemper Insurance","Kentucky Central","Kentucky Farm Bureau","Knights of Columbus","Landmark American Insurance","Leader Insurance","Leader National","Leader Preferred Insurance","Leader Specialty Insurance","League General","Liberty Insurance Corp","Liberty Mutual Insurance","Liberty National","Liberty Northwest Insurance","Lincoln Benefit Life","Lincoln National Corporation","LTC Financial Partners","Lumbermens Mutual","Marathon","Markel Corporation","Maryland Casualty","MassMutual Financial Group","Matrix Direct","MEGA Life and Health","Mega/Midwest","Mendota","Merastar","Merchants Insurance Group","Mercury","MetLife Auto and Home","MetLife","Mid Century Insurance","Mid-Continent Casualty","Middlesex Insurance","Midland National Life","Midwest Mutual","Millbank","Millers Mutual","Milwaukee","Minnehoma","Missouri General","Modern Woodmen of America","Mortgage Protection Bureau","Motors","Mountain Laurel","Mutual Insurance","Mutual Of Enumclaw","Mutual of New York","Mutual of Omaha","National Alliance","National Ben Franklin Insurance","National Casualty","National Colonial","National Continental Insurance","National Fire Insurance Company of Hartford","National Health Insurance","National Indemnity","National Merit","National Surety Corp","National Union Fire Insurance","Nationwide General Insurance","Nationwide Mutual Insurance Company","Natl Farmers Union","New England Financial","New Jersey Manufacturers Insurance Company","New York Life Insurance Company","NJ Skylands Insurance","North American","North Pacific","North Pointe","North Shore","Northern Capital","Northern States","Northland","Northwestern Mutual Life","Northwestern Pacific Indemnity","Ohio Casualty","Ohio Security","Olympia","Omega","Omni Insurance","OneBeacon","Oregon Mutual","Orion Insurance","Other","Oxford Health Plans","Pacific Indemnity","Pacific Insurance","Pacific Life","Pacificare","Pafco","Paloverde","Patriot General Insurance","Peak Property and Casualty Insurance","PEMCO Insurance","Penn America","Penn Mutual","Pennsylvania Natl","Philadelphia Insurance Companies","Phoenix","Physicians","Pinnacle","Pioneer Life","Plymouth Rock Assurance","Preferred Mutual","Premier","Prestige","Primerica","Principal Financial","Progressive","Protective Life","Provident","Prudential Insurance Co.","QBE Insurance","Quality","Ramsey","RBC Liberty Insurance","Regal","Reliance Insurance Company","Reliant","Republic Indemnity","Response Insurance","RLI Corp.","Rockford Mutual","Rodney D. Young","Safe Auto Insurance Company","SAFECO","Safeguard","Safeway Insurance","Sea West Insurance","Security Insurance","Security National","Sedgwick James","Selective Insurance","Sentinel Insurance","Sentry Insurance Group","Shelter Insurance Co.","Skandia TIG Tita","Southern Aid and Insurance Company","Spectrum","St. Paul Fire and Marine Ins Co","St. Paul","Standard Fire Insurance Company","Standard Guaranty","Standard Insurance Company","State and County Mutual Fire Insurance","State Auto Ins Co","State Farm County","State Farm Insurance","State Mutual","State National Insurance","Sun Coast","Sun Life Financial","Superior American Insurance","Superior Guaranty Insurance","Superior Insurance","Superior","Sutter","Symetra","The Ahbe Group","The Credo Group","The General","The Hartford","The Regence Group","TIAA-CREF","TICO Insurance","TIG Countrywide Insurance","Titan","Total","Tower","TransAmerica","Travelers Insurance Company","Trinity Universal","Tri-State Consumer Insurance","Trupanion","Trust Hall","Twin City Fire Insurance","Unicare","Unigard Ins","Union","United American","United Financial","United Fire Group","United Security","United Services Automobile Association","Unitrin Direct","Universal Underwriters Insurance","Unum","US Financial","US Health Advisors","USA Benefits/Continental General","USAA","USF and G","Utah Home and Fire","Utica","Vasa North Atlantic","Vigilant","Viking","Wawanesa Mutual","Wellington","Wellpoint","West American","West Bend Mutual","West Coast Life","West Plains","Western and Southern Life","Western Mutual Insurance Group","Western National","Western Southern Life","White Mountains Insurance Group","William Penn","Windsor","Windstar","Wisconsin Mutual","Woodlands Financial Group","Workmens Auto Insurance","World Insurance","Worldwide","Yellow Key","Yosemite","Zurich North America"];
    
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
    public static $vehicleDeductibles = [
            1 => '$0',
            2 => '$50',
            3 => '$100',
            4 => '$250',
            5 => '$500',
            6 => '$1,000',
            7 => '$2,500',
            8 => '$5,000',
    ];
    private function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $pingData = [];
        $p1 = $p1 ? $p1 : 'EF8m9Cyu8PyHqjyKECqG8C_I8grLEFYG8geKECvcScYu8cRL9OSLlWr64Yff';
        $p2 = $p2 ? $p2 : 'EliteMate-Auto-Insurance';
        $p3 = $p3 ? $p3 : '36';
        $submission_model = new Submissions();
        $IPAddress = Yii::app()->request->getParam('ipaddress');
        $user_agent = Yii::app()->request->getParam('user_agent','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15');
        $LeadDateTime = date('Y-m-d H:i:s');
        $Unique_identifier = Yii::app()->session['affiliate_trans_id'];
        $TCPAOptin = Yii::app()->request->getParam('tcpa_optin','No')==1?'Yes':'No';
        $TCPAText = Yii::app()->request->getParam('tcpa_text','By submitting this form');
        $UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
        $SubID = Yii::app()->request->getParam('sub_id');
        $url = Yii::app()->request->getParam('url','https://eliteinsurers.com');
        $promo_code = Yii::app()->request->getParam('promo_code');
        $zip = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip);
        $residence_type = (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own';
        $years_at_residence = Yii::app()->request->getParam('stay_in_year','4').' Years';
        $months_at_residence = Yii::app()->request->getParam('stay_in_month','3').' Months';
        $credit_rating = Yii::app()->request->getParam('credit_rating','3');
        $bankruptcy = Yii::app()->request->getParam('bankruptcy')=='1'?'Yes':'No';
        $coverageType = Yii::app()->request->getParam('coverage_type','3');
        $driver1_hasTAVCs=(Yii::app()->request->getParam('driver1_hasTAVCs')=='0') ? 'No' : 'Yes';
        $driver2_hasTAVCs=(Yii::app()->request->getParam('driver2_hasTAVCs')=='0') ? 'No' : 'Yes';
        
        $medicalPayment = Yii::app()->request->getParam('medical_pay','5');
        $haveInsurance = Yii::app()->request->getParam('insurance_policy')==1?'Yes':'No';
        $insuranceCompany = Yii::app()->request->getParam('insurance_company','1');
        $continuously_insured_period=Yii::app()->request->getParam('continuously_insured_period','1');
        $continuously_insured_period = self::$ContinuouslyInsuredPeriod[$continuously_insured_period];

        $driver1_gender=(Yii::app()->request->getParam('driver1_gender')=='M') ? 'Male' : 'Female';
        $driver1_dob=date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_dob')));
        $driver1_requiredSR22 = Yii::app()->request->getParam('driver1_required_SR22')=='1'?'SR22 Required':'SR22 Required';
        $driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver1_occupation'));
        $age = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('driver1_dob'))));

        $driver2_gender = (Yii::app()->request->getParam('driver2_gender')=='M') ? '1' : '2';
        $driver2_dob = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob')));
        $driver2_maritalStatus = Yii::app()->request->getParam('driver2_marital_status','1');
        $driver2_maritalStatus = $driver2_maritalStatus == 1 ? 'Single' : 'Married';
        $driver2_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver2_occupation'));
        $driver2_requiredSR22 = Yii::app()->request->getParam('driver2_required_SR22','0');
        $age2 = (date('Y') - date('Y',strtotime(Yii::app()->request->getParam('driver2_dob'))));
        $vehicle_comprehensiveDeductible=self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles','4')];
        $vehicle_collisionDeductible =self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles','4')];
        $converage_type = Yii::app()->request->getParam('coverage_type','1');
        $parking = ['Driveway','Private Garage','Parking Garage','Parking Lot','Street'];
        $park_key = array_rand($parking);
        $Collision_Coverage = ['No Coverage','No Deductible'];
        $CC_key = array_rand($Collision_Coverage);
        $Comprehensive_Coverage = ['No Coverage','No Deductible'];
        $CCC_key = array_rand($Comprehensive_Coverage);

        $pastdate = Yii::app()->request->getParam('insurance_expiration_date');
        $insurance_expiration_date_gap = round((time() - strtotime($pastdate))/86400);
        $is_policy_expired = $insurance_expiration_date_gap >30 ? 'Yes' : 'No';
        $current_policy_start_date = date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_start_date',(time()-(rand(360,370)*86400)))));
        $policy_expiry_date = date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_expiration_date',(time()-(rand(10,30)*86400)))));
        $driver1_at_fault = Yii::app()->request->getParam('driver1_accident1_at_fault');
        $is_driver1_at_fault = $driver1_at_fault == 1 ? 'Yes' : 'No';
        $driver2_at_fault = Yii::app()->request->getParam('driver1_accident2_at_fault');
        $is_driver2_at_fault = $driver2_at_fault == 1 ? 'Yes' : 'No';
        $vehicle1_vehicle_ownership = Yii::app()->request->getParam('vehicle1_vehicle_ownership');
        $vehicle2_vehicle_ownership = Yii::app()->request->getParam('vehicle2_vehicle_ownership');
        $vehicle1_vehicle_ownership = $vehicle1_vehicle_ownership == 1 ? 'Owned' : 'Leased';
        $vehicle2_vehicle_ownership = $vehicle2_vehicle_ownership == 1 ? 'Owned' : 'Leased';
        $partner_email = 'sushil@astroriacompany.com';
        $partner_company = 'AstroriaCompany';
        $driver1_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident1_date')),'');
        $driver1_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident2_date')),'');
        $driver2_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident1_date')),'');
        $driver2_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident2_date')),'');
        $ping_request='<?xml version="1.0" encoding="utf-8"?>
                    <Request>
                        <Key>'.$p1.'</Key>
                        <API_Action>pingPostLead</API_Action>
                        <Mode>ping</Mode>
                        <Return_Best_Price>1</Return_Best_Price>
                        <Redirect_URL>'.$url.'</Redirect_URL>
                        <TYPE>'.$p3.'</TYPE>
                        <SRC>'.$p2.'</SRC>
                        <IP_Address>'.$IPAddress.'</IP_Address>
                        <Landing_Page>'.$url.'</Landing_Page>
                        <Sub_ID>'.$SubID.'</Sub_ID>
                        <Pub_ID>'.$promo_code.'</Pub_ID>
                        <Origination_Datetime>'.date('m/d/Y H:i:s').'</Origination_Datetime>
                        <Origination_Timezone>EST / EDT</Origination_Timezone>
                        <TCPA_Optin>'.$TCPAOptin.'</TCPA_Optin>
                        <TCPA_Text>'.$TCPAText.'</TCPA_Text>
                        <Universal_Leadid>'.$Unique_identifier.'</Universal_Leadid>
                        <Bankruptcy>'.$bankruptcy.'</Bankruptcy>
                        <User_Agent>'.$user_agent.'</User_Agent>
                        <Bankruptcy>'.$bankruptcy.'</Bankruptcy>
                        <City>'.$city_state['city'].'</City>
                        <State>'.$city_state['state'].'</State>
                        <Zip>'.$zip.'</Zip>
                        <Credit_Rating>'.self::$creditRating[Yii::app()->request->getParam('credit_rating','2')].'</Credit_Rating>
                        <Have_Insurance>'.$haveInsurance.'</Have_Insurance>
                        <Continuously_Insured_Period>'.$continuously_insured_period.'</Continuously_Insured_Period>
                        <Current_Policy_Start_Date>'.$current_policy_start_date.'</Current_Policy_Start_Date>
                        <Current_Policy_Expiration_Date>'.$policy_expiry_date.'</Current_Policy_Expiration_Date>
                        <Coverage_Type>'.self::$converageType[$converage_type].'</Coverage_Type>
                        <Insurance_Company>'.self::$companyListFromBuyer[Yii::app()->request->getParam('insurance_company','1')].'</Insurance_Company>
                        <Residence_Type>'.$residence_type.'</Residence_Type>
                        <Years_At_Residence>'.$years_at_residence.'</Years_At_Residence>
                        <Months_At_Residence>'.$months_at_residence.'</Months_At_Residence>
                        <Driver1_DOB>'.$driver1_dob.'</Driver1_DOB>
                        <Driver1_Age>'.$age.'</Driver1_Age>
                        <Driver1_Gender>'.$driver1_gender.'</Driver1_Gender>
                        <Driver1_Marital_Status>'.self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status','2')].'</Driver1_Marital_Status>
                        <Driver1_Occupation>'.$driver1_occupation.'</Driver1_Occupation>
                        <Driver1_Education>'.self::$educationList[Yii::app()->request->getParam('driver1_education','4')].'</Driver1_Education>
                        <Driver1_Required_SR22>'.$driver1_requiredSR22.'</Driver1_Required_SR22>
                        <Driver1_License_Status>Active</Driver1_License_Status>
                        <Driver1_Licensed_State>'.$city_state['state'].'</Driver1_Licensed_State>
                        <Driver1_Accident1_Amount>'.Yii::app()->request->getParam('driver1_accident1_amount','1500').'</Driver1_Accident1_Amount>
                        <Driver1_Accident1_At_Fault>'.$is_driver1_at_fault.'</Driver1_Accident1_At_Fault>
                        <Driver1_Accident1_Damage>'.self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage',3)].'</Driver1_Accident1_Damage>
                        <Driver1_Accident1_Description>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident1_description','6')].'</Driver1_Accident1_Description>';
                        if (Yii::app()->request->getParam('driver2_gender')) {
                            $ping_request.='<Driver2_DOB>'.$driver2_dob.'</Driver2_DOB>
                            <Driver2_Age>'.$age2.'</Driver2_Age>
                            <Driver2_Gender>'.$driver2_gender.'</Driver2_Gender>
                            <Driver2_Marital_Status>'.self::$maritialStatus[Yii::app()->request->getParam('driver2_marital_status','2')].'</Driver2_Marital_Status>
                            <Driver2_Occupation>'.$driver2_occupation.'</Driver2_Occupation>
                            <Driver2_Education>'.self::$educationList[Yii::app()->request->getParam('driver2_education','4')].'</Driver2_Education>
                            <Driver2_Required_SR22>'.$driver2_requiredSR22.'</Driver2_Required_SR22>
                            <Driver2_License_Status>Active</Driver2_License_Status>
                            <Driver2_Licensed_State>'.$city_state['state'].'</Driver2_Licensed_State>
                            <Driver2_Accident1_Amount>'.Yii::app()->request->getParam('driver2_accident1_amount','1500').'</Driver2_Accident1_Amount>
                            <Driver2_Accident1_At_Fault>'.$is_driver2_at_fault.'</Driver2_Accident1_At_Fault>
                            <Driver2_Accident1_Damage>'.self::$AccidentDamage[Yii::app()->request->getParam('driver2_accident1_damage')].'</Driver2_Accident1_Damage>
                            <Driver2_Accident1_Description>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident1_description','6')].'</Driver2_Accident1_Description>';
                        }
                        $ping_request.='<Vehicle1_Year>'.Yii::app()->request->getParam('vehicle1_year').'</Vehicle1_Year>
                        <Vehicle1_Make>'.Yii::app()->request->getParam('vehicle1_make').'</Vehicle1_Make>
                        <Vehicle1_Model>'.Yii::app()->request->getParam('vehicle1_model').'</Vehicle1_Model>
                        <Vehicle1_Sub_Model>'.Yii::app()->request->getParam('vehicle1_submodel','No Trim').'</Vehicle1_Sub_Model>
                        <Vehicle1_Vin>'.Yii::app()->request->getParam('vehicle1_vin','1ACBC535*B*******').'</Vehicle1_Vin>
                        <Vehicle1_Vehicle_Ownership>'.$vehicle1_vehicle_ownership.'</Vehicle1_Vehicle_Ownership>
                        <Vehicle1_Primary_Use>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_primary_use','5')].'</Vehicle1_Primary_Use>
                        <Vehicle1_Daily_Mileage>'.self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage','1')].'</Vehicle1_Daily_Mileage>
                        <Vehicle1_Annual_Mileage>'.self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage','1')].'</Vehicle1_Annual_Mileage>
                        <Vehicle1_Collision_Deductible>'.$vehicle_comprehensiveDeductible.'</Vehicle1_Collision_Deductible>
                        <Vehicle1_Comprehensive_Deductible>'.$vehicle_collisionDeductible.'</Vehicle1_Comprehensive_Deductible>';
                        if (Yii::app()->request->getParam('vehicle2_year')) {
                            $request.='<Vehicle2_Year>'.Yii::app()->request->getParam('vehicle2_year').'</Vehicle2_Year>
                            <Vehicle2_Make>'.Yii::app()->request->getParam('vehicle2_make').'</Vehicle2_Make>
                            <Vehicle2_Model>'.Yii::app()->request->getParam('vehicle2_model').'</Vehicle2_Model>
                            <Vehicle2_Sub_Model>'.Yii::app()->request->getParam('vehicle2_submodel','No Trim').'</Vehicle2_Sub_Model>
                            <Vehicle2_Vin>'.Yii::app()->request->getParam('vehicle2_vin','1ACBC535*B*******').'</Vehicle2_Vin>
                            <Vehicle2_Vehicle_Ownership>'.$vehicle2_vehicle_ownership.'</Vehicle2_Vehicle_Ownership>
                            <Vehicle2_Primary_Use>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use','5')].'</Vehicle2_Primary_Use>
                            <Vehicle2_Daily_Mileage>'.self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_daily_mileage','1')].'</Vehicle2_Daily_Mileage>
                            <Vehicle2_Annual_Mileage>'.self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle2_annual_mileage','1')].'</Vehicle2_Annual_Mileage>
                            <Vehicle2_Collision_Deductible>'.$vehicle_comprehensiveDeductible.'</Vehicle2_Collision_Deductible>
                            <Vehicle2_Comprehensive_Deductible>'.$vehicle_collisionDeductible.'</Vehicle2_Comprehensive_Deductible>';
                        }
                    $ping_request.='</Request>';
        
        $header = ["Content-Type: application/xml"];
        $pingData['ping_request'] = $ping_request;
        $pingData['header'] = $header;
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
    public static function sendPostData($parameter1, $parameter2, $parameter3, $ping_response, $post_url, $status) {
        preg_match("/<lead_id>(.*)<\/lead_id>/msui", $ping_response, $confirmation_id);
        $pingData = array();
        $p1 = $p1 ? $p1 : 'EF8m9Cyu8PyHqjyKECqG8C_I8grLEFYG8geKECvcScYu8cRL9OSLlWr64Yff';
        $p2 = $p2 ? $p2 : 'EliteMate-Auto-Insurance';
        $p3 = $p3 ? $p3 : '36';
        $submission_model = new Submissions();
        $IPAddress = Yii::app()->request->getParam('ipaddress');
        $user_agent = Yii::app()->request->getParam('user_agent','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15');
        $address = Yii::app()->request->getParam('address');
        $LeadDateTime = date('Y-m-d H:i:s');
        $Unique_identifier = Yii::app()->session['affiliate_trans_id'];
        $TCPAOptin = Yii::app()->request->getParam('tcpa_optin','No')==1?'Yes':'No';
        $TCPAText = Yii::app()->request->getParam('tcpa_text','By submitting this form');
        $UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
        $SubID = Yii::app()->request->getParam('sub_id');
        $url = Yii::app()->request->getParam('url','https://eliteinsurers.com');
        $promo_code = Yii::app()->request->getParam('promo_code');
        $zip = Yii::app()->request->getParam('zip');
        $phone = Yii::app()->request->getParam('phone');
        $last_4_phone = substr($phone, 6,4);
        $phone2 = Yii::app()->request->getParam('phone2');
        $residence_type = (Yii::app()->request->getParam('is_rented') == 'rent') ? 'Rent' : 'Own';
        $years_at_residence = Yii::app()->request->getParam('stay_in_year','4').' Years';
        $months_at_residence = Yii::app()->request->getParam('stay_in_month','3').' Months';
        $credit_rating = Yii::app()->request->getParam('credit_rating','3');
        $bankruptcy = Yii::app()->request->getParam('bankruptcy')==1?'Yes':'No';
        $coverageType = Yii::app()->request->getParam('coverage_type','3');
        $driver1_hasTAVCs=(Yii::app()->request->getParam('driver1_hasTAVCs') == '0') ? 'No' : 'Yes';
        $driver2_hasTAVCs=(Yii::app()->request->getParam('driver2_hasTAVCs') == '0') ? 'No' : 'Yes';
        $vehicle_comprehensiveDeductible=self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_deductibles','4')];
        $vehicle_collisionDeductible =self::$vehicleDeductibles[Yii::app()->request->getParam('vehicle_collision_deductibles','4')];
        $medicalPayment = Yii::app()->request->getParam('medical_pay','5');
        $haveInsurance = Yii::app()->request->getParam('insurance_policy')==1?'Yes':'No';
        $insuranceCompany = Yii::app()->request->getParam('insurance_company',1);
        $continuously_insured_period=Yii::app()->request->getParam('continuously_insured_period','1');
        $continuously_insured_period = self::$ContinuouslyInsuredPeriod[$continuously_insured_period];
        $driver1_first_name  = Yii::app()->request->getParam('driver1_first_name');
        $driver1_last_name  = Yii::app()->request->getParam('driver1_last_name');
        $address  = Yii::app()->request->getParam('address');
        $email  = Yii::app()->request->getParam('email');
        $driver1_gender = (Yii::app()->request->getParam('driver1_gender')=='M') ? 'Male' : 'Female';
        $driver1_dob  = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_dob')));
        $driver1_requiredSR22  = Yii::app()->request->getParam('driver1_required_SR22')=='1'?'SR22 Required':'SR22 Required';
        $driver1_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver1_occupation'));
        $driver2_gender = (Yii::app()->request->getParam('driver2_gender')=='M') ? '1' : '2';
        $driver2_dob  = date('Y-m-d', strtotime(Yii::app()->request->getParam('driver2_dob')));
        $driver2_maritalStatus = Yii::app()->request->getParam('driver2_marital_status','1');
        $driver2_maritalStatus = $driver2_maritalStatus == 1 ? 'Single' : 'Married';
        $driver2_occupation  = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0],Yii::app()->request->getParam('driver2_occupation'));
        $driver2_requiredSR22 = Yii::app()->request->getParam('driver2_required_SR22')=='1'?'SR22 Required':'SR22 Required';

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
        $current_policy_start_date = date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_start_date',(time()-(rand(360,370)*86400)))));
        $policy_expiry_date = date('m/d/Y',strtotime(Yii::app()->request->getParam('insurance_expiration_date',(time()-(rand(10,30)*86400))  )));
        $a = (time()-(rand(10,30)*86400));
        $driver1_at_fault = Yii::app()->request->getParam('driver1_accident1_at_fault');
        $is_driver1_at_fault = $driver1_at_fault == 1 ? 'Yes' : 'No';
        $driver2_at_fault = Yii::app()->request->getParam('driver2_accident2_at_fault');
        $is_driver2_at_fault = $driver2_at_fault == 1 ? 'Yes' : 'No';
        $vehicle1_vehicle_ownership = Yii::app()->request->getParam('vehicle1_vehicle_ownership');
        $vehicle2_vehicle_ownership = Yii::app()->request->getParam('vehicle2_vehicle_ownership');
        $vehicle1_vehicle_ownership = $vehicle1_vehicle_ownership == 1 ? 'Owned' : 'Leased';
        $vehicle2_vehicle_ownership = $vehicle2_vehicle_ownership == 1 ? 'Owned' : 'Leased';
        $partner_email = 'jim@xananetwork.com';
        $partner_company = 'XanaNetwork';
        $driver1_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident1_date')),'');
        $driver1_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver1_incident2_date')),'');
        $driver2_incidentDate1 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident1_date')),'');
        $driver2_incidentDate2 = date('m/d/Y', strtotime(Yii::app()->request->getParam('driver2_incident2_date')),'');
        $post_request='<?xml version="1.0" encoding="utf-8"?>
                    <Request>
                        <Key>'.$p1.'</Key>
                        <API_Action>pingPostLead</API_Action>
                        <Mode>ping</Mode>
                        <Return_Best_Price>1</Return_Best_Price>
                        <Redirect_URL>'.$url.'</Redirect_URL>
                        <TYPE>'.$p3.'</TYPE>
                        <SRC>'.$p2.'</SRC>
                        <IP_Address>'.$IPAddress.'</IP_Address>
                        <Landing_Page>'.$url.'</Landing_Page>
                        <Sub_ID>'.$SubID.'</Sub_ID>
                        <Pub_ID>'.$promo_code.'</Pub_ID>
                        <Origination_Datetime>'.date('m/d/Y H:i:s').'</Origination_Datetime>
                        <Origination_Timezone>EST / EDT</Origination_Timezone>
                        <TCPA_Optin>'.$TCPAOptin.'</TCPA_Optin>
                        <TCPA_Text>'.$TCPAText.'</TCPA_Text>
                        <Universal_Leadid>'.$Unique_identifier.'</Universal_Leadid>
                        <First_Name>'.Yii::app()->request->getParam('driver1_first_name').'</First_Name>
                        <Last_Name>'.Yii::app()->request->getParam('driver1_last_name').'</Last_Name>
                        <Address>'.Yii::app()->request->getParam('address').'</Address>
                        <City>'.$city_state['city'].'</City>
                        <State>'.$city_state['state'].'</State>
                        <Zip>'.$zip.'</Zip>
                        <Phone_Home>'.Yii::app()->request->getParam('phone').'</Phone_Home>
                        <Email>'.Yii::app()->request->getParam('email').'</Email>
                        <Bankruptcy>'.$bankruptcy.'</Bankruptcy>
                        <User_Agent>'.$user_agent.'</User_Agent>
                        <Bankruptcy>'.$bankruptcy.'</Bankruptcy>
                        <Credit_Rating>'.self::$creditRating[Yii::app()->request->getParam('credit_rating','2')].'</Credit_Rating>
                        <Have_Insurance>'.$haveInsurance.'</Have_Insurance>
                        <Continuously_Insured_Period>'.$continuously_insured_period.'</Continuously_Insured_Period>
                        <Current_Policy_Start_Date>'.$current_policy_start_date.'</Current_Policy_Start_Date>
                        <Current_Policy_Expiration_Date>'.$policy_expiry_date.'</Current_Policy_Expiration_Date>
                        <Coverage_Type>'.self::$converageType[$converage_type].'</Coverage_Type>
                        <Insurance_Company>'.self::$companyListFromBuyer[Yii::app()->request->getParam('insurance_company','1')].'</Insurance_Company>
                        <Residence_Type>'.$residence_type.'</Residence_Type>
                        <Years_At_Residence>'.$years_at_residence.'</Years_At_Residence>
                        <Months_At_Residence>'.$months_at_residence.'</Months_At_Residence>
                        <Driver1_First_Name>'.Yii::app()->request->getParam('driver1_first_name').'</Driver1_First_Name>
                        <Driver1_Last_Name>'.Yii::app()->request->getParam('driver1_last_name').'</Driver1_Last_Name>
                        <Driver1_DOB>'.$driver1_dob.'</Driver1_DOB>
                        <Driver1_Age>'.$age.'</Driver1_Age>
                        <Driver1_Gender>'.$driver1_gender.'</Driver1_Gender>
                        <Driver1_Marital_Status>'.self::$maritialStatus[Yii::app()->request->getParam('driver1_marital_status','2')].'</Driver1_Marital_Status>
                        <Driver1_Occupation>'.$driver1_occupation.'</Driver1_Occupation>
                        <Driver1_Education>'.self::$educationList[Yii::app()->request->getParam('driver1_education','4')].'</Driver1_Education>
                        <Driver1_Required_SR22>'.$driver1_requiredSR22.'</Driver1_Required_SR22>
                        <Driver1_License_Status>Active</Driver1_License_Status>
                        <Driver1_Licensed_State>'.$city_state['state'].'</Driver1_Licensed_State>
                        <Driver1_Accident1_Amount>'.Yii::app()->request->getParam('driver1_accident1_amount','1500').'</Driver1_Accident1_Amount>
                        <Driver1_Accident1_At_Fault>'.$is_driver1_at_fault.'</Driver1_Accident1_At_Fault>
                        <Driver1_Accident1_Damage>'.self::$AccidentDamage[Yii::app()->request->getParam('driver1_accident1_damage',3)].'</Driver1_Accident1_Damage>
                        <Driver1_Accident1_Description>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver1_accident1_description','6')].'</Driver1_Accident1_Description>';
                        if (Yii::app()->request->getParam('driver2_gender')) {
                            $post_request.='<Driver2_DOB>'.$driver2_dob.'</Driver2_DOB>
                            <Driver2_Age>'.$age2.'</Driver2_Age>
                            <Driver2_Gender>'.$driver2_gender.'</Driver2_Gender>
                            <Driver2_Marital_Status>'.self::$maritialStatus[Yii::app()->request->getParam('driver2_marital_status','2')].'</Driver2_Marital_Status>
                            <Driver2_Occupation>'.$driver2_occupation.'</Driver2_Occupation>
                            <Driver2_Education>'.self::$educationList[Yii::app()->request->getParam('driver2_education','4')].'</Driver2_Education>
                            <Driver2_Required_SR22>'.$driver2_requiredSR22.'</Driver2_Required_SR22>
                            <Driver2_License_Status>Active</Driver2_License_Status>
                            <Driver2_Licensed_State>'.$city_state['state'].'</Driver2_Licensed_State>
                            <Driver2_Accident1_Amount>'.Yii::app()->request->getParam('driver2_accident1_amount','1500').'</Driver2_Accident1_Amount>
                            <Driver2_Accident1_At_Fault>'.$is_driver2_at_fault.'</Driver2_Accident1_At_Fault>
                            <Driver2_Accident1_Damage>'.self::$AccidentDamage[Yii::app()->request->getParam('driver2_accident1_damage')].'</Driver2_Accident1_Damage>
                            <Driver2_Accident1_Description>'.self::$driverAccidentDescription[Yii::app()->request->getParam('driver2_accident1_description','6')].'</Driver2_Accident1_Description>';
                        }
                        $post_request.='<Vehicle1_Year>'.Yii::app()->request->getParam('vehicle1_year').'</Vehicle1_Year>
                        <Vehicle1_Make>'.Yii::app()->request->getParam('vehicle1_make').'</Vehicle1_Make>
                        <Vehicle1_Model>'.Yii::app()->request->getParam('vehicle1_model').'</Vehicle1_Model>
                        <Vehicle1_Sub_Model>'.Yii::app()->request->getParam('vehicle1_submodel','No Trim').'</Vehicle1_Sub_Model>
                        <Vehicle1_Vin>'.Yii::app()->request->getParam('vehicle1_vin','1ACBC535*B*******').'</Vehicle1_Vin>
                        <Vehicle1_Vehicle_Ownership>'.$vehicle1_vehicle_ownership.'</Vehicle1_Vehicle_Ownership>
                        <Vehicle1_Primary_Use>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle1_primary_use','5')].'</Vehicle1_Primary_Use>
                        <Vehicle1_Daily_Mileage>'.self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle1_daily_mileage','1')].'</Vehicle1_Daily_Mileage>
                        <Vehicle1_Annual_Mileage>'.self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle1_annual_mileage','1')].'</Vehicle1_Annual_Mileage>
                        <Vehicle1_Collision_Deductible>'.$vehicle_comprehensiveDeductible.'</Vehicle1_Collision_Deductible>
                        <Vehicle1_Comprehensive_Deductible>'.$vehicle_collisionDeductible.'</Vehicle1_Comprehensive_Deductible>';
                        if (Yii::app()->request->getParam('vehicle2_year')) {
                            $post_request.='<Vehicle2_Year>'.Yii::app()->request->getParam('vehicle2_year').'</Vehicle2_Year>
                            <Vehicle2_Make>'.Yii::app()->request->getParam('vehicle2_make').'</Vehicle2_Make>
                            <Vehicle2_Model>'.Yii::app()->request->getParam('vehicle2_model').'</Vehicle2_Model>
                            <Vehicle2_Sub_Model>'.Yii::app()->request->getParam('vehicle2_submodel','No Trim').'</Vehicle2_Sub_Model>
                            <Vehicle2_Vin>'.Yii::app()->request->getParam('vehicle2_vin','1ACBC535*B*******').'</Vehicle2_Vin>
                            <Vehicle2_Vehicle_Ownership>'.$vehicle2_vehicle_ownership.'</Vehicle2_Vehicle_Ownership>
                            <Vehicle2_Primary_Use>'.self::$PrimaryUsage[Yii::app()->request->getParam('vehicle2_primary_use','5')].'</Vehicle2_Primary_Use>
                            <Vehicle2_Daily_Mileage>'.self::$vehicleDailyMileage[Yii::app()->request->getParam('vehicle2_daily_mileage','1')].'</Vehicle2_Daily_Mileage>
                            <Vehicle2_Annual_Mileage>'.self::$vehicleAnnualMileage[Yii::app()->request->getParam('vehicle2_annual_mileage','1')].'</Vehicle2_Annual_Mileage>
                            <Vehicle2_Collision_Deductible>'.$vehicle_comprehensiveDeductible.'</Vehicle2_Collision_Deductible>
                            <Vehicle2_Comprehensive_Deductible>'.$vehicle_collisionDeductible.'</Vehicle2_Comprehensive_Deductible>';
                        }
                    $post_request.='</Request>';
        
        $cm = new CommonMethods();
        $header = ["Content-Type: application/xml"];
        $start_time = CommonToolsMethods::stopwatch();
        $post_response = $cm->curl($post_url, $post_request, $header);
        $time_end = CommonToolsMethods::stopwatch();

        preg_match("/<status>(.*)<\/status>/", $post_response, $success);
        //echo '<pre>';print_r();die();
        if (trim($success[1]) == 'Matched') {
            $post_status = '1';
            preg_match("/<redirect>(.*)<\/redirect>/", $post_response, $redirect);
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
