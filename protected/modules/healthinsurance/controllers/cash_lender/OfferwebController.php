<?php
class OfferwebController extends Controller {
    public static $medicalConditionFromBuyer = ['None','AIDS / HIV','Alzheimer Disease','Asthma','Cancer','Cholesterol','Depression','Diabetes','Heart Disease','High Blood Pressure','Kidney Disease','Liver Disease','Mental Illness','Pulmonary Disease','Stroke','Ulcer','Vascular Disease','Other'];
    
    public static $companyListFromBuyer = ["Company Not Listed","21st Century Insurance","AAA Insurance Co.","AABCO","AARP","Access Insurance","Acordia","Aegis Security","Aetna","Affirmative","Aflac","AHCP","AIG","AIU Insurance","Alfa Insurance","All Nation","All Risk","Alleghany Corporation","Allianz","Allied Group","Allied","Allmerica","Allstate Insurance","American Alliance Ins Co","American Automobile Insurance","American Banks","American Casualty","American Deposit Insurance","American Direct Business Insurance","American Economy Ins Co","American Empire Insurance","American Family Insurance","American Financial","American Health Underwriters","American Home Assurance","American Income Life Insurance Company","American Insurance","American International Ins","American International Pacific","American International South","American Manufacturers","American Mayflower Insurance","American Medical Securities","American Motorists Insurance","American National Insurance","American National Property and Casualty","American Premier","American Protection Insurance","American Reliable Ins Co","American Republic","American Savers Plan","American Service Insurance","American Skyline Insurance Company","American Spirit Insurance","American Standard Insurance - OH","American Standard Insurance - WI","American States","Americas Ins. Consultants","AmeriPlan","Ameriprise","Amerisure","Ameritas Life Insurance Company","Amex Assurance Co","Amica Insurance","Amica Mutual Ins Co","Answer Financial","Anthem","API","Arbella","Arizona General","Armed Forces Insurance","Assigned Risk","Associated Indemnity","Associated Insurance Managers","Assurant","Atlanta Casualty","Atlanta Specialty","Atlantic Indemnity","Atlantic Mutual Co","Atlantis","Austin Mutual","Auto Club Insurance Company","Auto Owners","Avomark","AXA Equitable Life Insurance Company","Badger Mutual","Bankers Life and Casualty Company","Banner Life","Berkshire Hathaway","Best Agency USA","Blue Cross / Blue Shield","Bonneville","Boston Old Colony","Builders","Cal Farm Insurance","Calfarm Ins Co","California Casualty and Fire Ins Co","California State Automobile Association","Camden","Capital Choice","Cascade National Ins","Casualty Assurance","Centennial","Century National Ins","Charter Oak","Chartis","Chase Insurance Group","Chicago Insurance","Chubb Group of Ins Co","Church Mutual","Cigna","Cincinnati Insurance Company","Citizens","Clarendon National Insurance","Clarendon","Cloverleaf","CNA","Colonial Penn","Colonial","Combined","Commerce Insurance Group","Commerce West","Commercial Union","Commonwealth","Conseco","Continental Casualty","Continental Divide Insurance","Continental Insurance","Cotton States Insurance","Cottonwood","Country Financial","Countrywide Insurance","Criterion","CSE Insurance Group","CUNA Mutual","Dairyland Insurance","Dakota Fire","Deerbrook","Depositors Emcasc","Direct General Insurance","Dixie","Eagle Ins Co","Ebco General","eFinancial","eHealth","Electric Insurance","Elephant","EMC","Empire Fire and Marine","Employers Fire","Encompass Insurance Company","Ensure","Equitable Life","Erie Insurance Company","Esurance","Evergreen USA RRG","Explorer","Facility","Farm and Ranch","Farm Bureau/Farm Family/Rural","Farmers Insurance","Farmers Union","Farmland","Federal Ins Co","Federated Mutual Insurance Company","Fidelity Insurance Company","Financial Indemnity","Fire and Casualty Insurance Co of CT","Firemans Fund","First Acceptance Insurance","First American","First Financial","First General","First Insurance Company of Hawaii, LTD","First National","FM Global","Ford Motor Credit","Foremost","Foresters","Fortis","Franklin","GAINSCO","Geico Casualty","Geico","General Accident Insurance","General Re","Genworth Financial","Globe","GMAC Insurance","Grange","GRE Harleysville H","Great American Ins Co","Great Way","Great West Casualty Company","Grinnell Mutual","Guaranty National Insurance","Guardian Life Insurance Company of America","Guide One Insurance","Halcyon","Hanover Ins Co","Hanover Lloyds Insurance Company","Happy Days","Hartford Accident and Indemnity","Hawkeye Security","HCC Insurance Holdings","Health Benefits Direct","Health Choice One","Health Net","Health Plus of America","HealthMarkets","HealthShare American","Heritage","Home State County Mutual","Horace Mann","Humana","IAB","IFA Auto Insurance","IGF","IIS Insurance","Infinity Insurance","Infinity Select Insurance","Insphere Insurance Solutions","Insur. of Evanston","Insurance Co of the West","Insurance Insight","Integon","Interstate","Jackson National Life","John Deere","John Hancock Insurance","Kaiser Permanente","Kemper Insurance","Kentucky Central","Kentucky Farm Bureau","Knights of Columbus","Landmark American Insurance","Leader Insurance","Leader National","Leader Preferred Insurance","Leader Specialty Insurance","League General","Liberty Insurance Corp","Liberty Mutual Insurance","Liberty National","Liberty Northwest Insurance","Lincoln Benefit Life","Lincoln National Corporation","LTC Financial Partners","Lumbermens Mutual","Marathon","Markel Corporation","Maryland Casualty","MassMutual Financial Group","Matrix Direct","MEGA Life and Health","Mega/Midwest","Mendota","Merastar","Merchants Insurance Group","Mercury","MetLife Auto and Home","MetLife","Mid Century Insurance","Mid-Continent Casualty","Middlesex Insurance","Midland National Life","Midwest Mutual","Millbank","Millers Mutual","Milwaukee","Minnehoma","Missouri General","Modern Woodmen of America","Mortgage Protection Bureau","Motors","Mountain Laurel","Mutual Insurance","Mutual Of Enumclaw","Mutual of New York","Mutual of Omaha","National Alliance","National Ben Franklin Insurance","National Casualty","National Colonial","National Continental Insurance","National Fire Insurance Company of Hartford","National Health Insurance","National Indemnity","National Merit","National Surety Corp","National Union Fire Insurance","Nationwide General Insurance","Nationwide Mutual Insurance Company","Natl Farmers Union","New England Financial","New Jersey Manufacturers Insurance Company","New York Life Insurance Company","NJ Skylands Insurance","North American","North Pacific","North Pointe","North Shore","Northern Capital","Northern States","Northland","Northwestern Mutual Life","Northwestern Pacific Indemnity","Ohio Casualty","Ohio Security","Olympia","Omega","Omni Insurance","OneBeacon","Oregon Mutual","Orion Insurance","Other","Oxford Health Plans","Pacific Indemnity","Pacific Insurance","Pacific Life","Pacificare","Pafco","Paloverde","Patriot General Insurance","Peak Property and Casualty Insurance","PEMCO Insurance","Penn America","Penn Mutual","Pennsylvania Natl","Philadelphia Insurance Companies","Phoenix","Physicians","Pinnacle","Pioneer Life","Plymouth Rock Assurance","Preferred Mutual","Premier","Prestige","Primerica","Principal Financial","Progressive","Protective Life","Provident","Prudential Insurance Co.","QBE Insurance","Quality","Ramsey","RBC Liberty Insurance","Regal","Reliance Insurance Company","Reliant","Republic Indemnity","Response Insurance","RLI Corp.","Rockford Mutual","Rodney D. Young","Safe Auto Insurance Company","SAFECO","Safeguard","Safeway Insurance","Sea West Insurance","Security Insurance","Security National","Sedgwick James","Selective Insurance","Sentinel Insurance","Sentry Insurance Group","Shelter Insurance Co.","Skandia TIG Tita","Southern Aid and Insurance Company","Spectrum","St. Paul Fire and Marine Ins Co","St. Paul","Standard Fire Insurance Company","Standard Guaranty","Standard Insurance Company","State and County Mutual Fire Insurance","State Auto Ins Co","State Farm County","State Farm Insurance","State Mutual","State National Insurance","Sun Coast","Sun Life Financial","Superior American Insurance","Superior Guaranty Insurance","Superior Insurance","Superior","Sutter","Symetra","The Ahbe Group","The Credo Group","The General","The Hartford","The Regence Group","TIAA-CREF","TICO Insurance","TIG Countrywide Insurance","Titan","Total","Tower","TransAmerica","Travelers Insurance Company","Trinity Universal","Tri-State Consumer Insurance","Trupanion","Trust Hall","Twin City Fire Insurance","Unicare","Unigard Ins","Union","United American","United Financial","United Fire Group","United Security","United Services Automobile Association","Unitrin Direct","Universal Underwriters Insurance","Unum","US Financial","US Health Advisors","USA Benefits/Continental General","USAA","USF and G","Utah Home and Fire","Utica","Vasa North Atlantic","Vigilant","Viking","Wawanesa Mutual","Wellington","Wellpoint","West American","West Bend Mutual","West Coast Life","West Plains","Western and Southern Life","Western Mutual Insurance Group","Western National","Western Southern Life","White Mountains Insurance Group","William Penn","Windsor","Windstar","Wisconsin Mutual","Woodlands Financial Group","Workmens Auto Insurance","World Insurance","Worldwide","Yellow Key","Yosemite","Zurich North America"];
        
    public static $occupationListFromBuyer = ['Unemployed','Administrative Clerical','Business Owner','Certified Public Accountant','Clergy','Dentist','Disabled','Engineer','Homemaker','Lawyer','Manager/Supervisor','Military Officer','Military Enlisted','Minor','Other Non-Technical','Physician','Professional Salaried','Retail','Retired','Sales, Inside','Sales, Outside','Scientist','Security','Self Employed','Skilled/Semi Skilled','Student'];

    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $pingData = [];
        $p1 = $p1 ? $p1 : '513257';
        $age=date('Y')-date('Y',strtotime(Yii::app()->request->getParam('dob')));
        if($age < '65'){
            $ping_url = 'https://offerweb.linktrustleadgen.com/Lead/435091/ping';//health
        }else{
            $ping_url = 'https://offerweb.linktrustleadgen.com/Lead/435089/ping';//medicare
        }
		$promo_code = Yii::app()->request->getParam('promo_code');
        $height_cm = Yii::app()->request->getParam('height');
        $total_inches = $height_cm/2.54;
        $height_feet = intval($total_inches/12);
        $height_inches = round($total_inches%12);
        $weight = Yii::app()->request->getParam('weight');
        $click_id =Yii::app()->session['affiliate_trans_id'];
        $submission_model = new Submissions();
        $insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
        $medicalCondition = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
        $first_name = Yii::app()->request->getParam('first_name');
        $last_name = Yii::app()->request->getParam('last_name');
        $address = Yii::app()->request->getParam('address');
        $phone = Yii::app()->request->getParam('phone');
        $email = Yii::app()->request->getParam('email');
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $phone_last_4 = Yii::app()->request->getParam('phone_last_4');
        $dob_year = date('Y',strtotime(Yii::app()->request->getParam('dob')));
        $dob_month = date('m',strtotime(Yii::app()->request->getParam('dob')));
        $dob_day = date('d',strtotime(Yii::app()->request->getParam('dob')));
        $gender = Yii::app()->request->getParam('gender')=='M'?'Male':'Female';
        $ipaddress = Yii::app()->request->getParam('ipaddress');
        $universal_leadid = Yii::app()->request->getParam('universal_leadid');
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        $user_agent = Yii::app()->request->getParam('user_agent');
        $tcpa_optin = Yii::app()->request->getParam('tcpa_optin','Yes')==1?'Yes':'No';
        $tcpa_text = Yii::app()->request->getParam('tcpa_text','By submitting this form');
        $landing_page = Yii::app()->request->getParam('url','https://eliltehealthinsurer.com');
        $sub_id = Yii::app()->request->getParam('sub_id');

        $income = Yii::app()->request->getParam('income','1500');
        if($income == '0' OR $income == '0'){
            $income = '1500';
        }
        if($phone_last_4 == '1234' || $phone_last_4 == '0000'){
            $phone_last_4 = '';
        }
        $is_smoker = Yii::app()->request->getParam('is_smoker','Yes')==1?'Yes':'No';
        $is_student = Yii::app()->request->getParam('is_student','Yes')==1?'Yes':'No';
        $occupation = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0]);
        $dateformat = date('Y-m-d').'T'.date('H:i:s').'Z';
        $pingData = [];
        //<DateTime>'.$dateformat.'</DateTime>
        $ping_request ='<lead>
                <AFID>'.$p1.'</AFID>
                <SID>'.$promo_code.'</SID>
                <ADID></ADID>
                <AffiliateReferenceID></AffiliateReferenceID>
                <_FirstName>'.$first_name.'</_FirstName>
                <_LastName>'.$last_name.'</_LastName>
                <Last4Numbers>'.$phone_last_4.'</Last4Numbers>
                <_Phone>'.$phone.'</_Phone>
                <Email>'.$email.'</Email>
                <_Address>'.$address.'</_Address>
                <_City>'.$city_state['city'].'</_City>
                <_State>'.$city_state['state'].'</_State>
                <_PostalCode>'.$zip_code.'</_PostalCode>
                <Gender>'.$gender.'</Gender>
                <DOBM>'.$dob_month.'</DOBM>
                <DOBD>'.$dob_day.'</DOBD>
                <DOBY>'.$dob_year.'</DOBY>
                <Income>'.$income.'</Income>
                <Smoker>'.$is_smoker.'</Smoker>
                <Occupation>'.$occupation.'</Occupation>
                <Student>'.$is_student.'</Student>
                <HeightFeet>'.$height_feet.'</HeightFeet>
                <HeightInches>'.$height_inches.'</HeightInches>
                <Weight>'.$weight.'</Weight>
                <IP>'.$ipaddress.'</IP>
                <xxTrustedFormCertUrl>'.$trustedformcerturl.'</xxTrustedFormCertUrl>
                <Universal_Lead_ID>'.$universal_leadid.'</Universal_Lead_ID>
                <UA>'.$user_agent.'</UA>
                <TCPAConsentText>'.$tcpa_optin.'</TCPAConsentText>
                <LandingPageURL>'.$landing_page.'</LandingPageURL>
                <s2>'.$sub_id.'</s2>
            </lead>';
        
        $purchase = true;
        
        if($purchase == true){
            $header = ["Content-type: text/xml"];
            $pingData['ping_request'] = $ping_request;
            $pingData['ping_url'] = $ping_url;
            $pingData['header'] = $header;
            return $pingData;
        }else{
            return [];
        }
    }

    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        $result = json_decode($ping_response,TRUE);
        if (trim($result['Accepted']) == 'true' || trim($result['Accepted']) == '1') {
            $ping_price=isset($result['AcceptedPings'][0]['Payout'])?$result['AcceptedPings'][0]['Payout']:0;
            $confirmation_id = $result['AcceptedPings'][0]['PingId'];
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
        $p1 = $p1 ? $p1 : '513257';
        $age=date('Y')-date('Y',strtotime(Yii::app()->request->getParam('dob')));
        if($age < '65'){
            $post_url = 'https://offerweb.linktrustleadgen.com/Lead/435091/Post';//health
        }else{
            $post_url = 'https://offerweb.linktrustleadgen.com/Lead/435089/Post';//medicare
        }
        $result = json_decode($ping_response,TRUE);
        $confirmation_id = $result['AcceptedPings'][0]['PingId'];

        $promo_code = Yii::app()->request->getParam('promo_code');
        $height_cm = Yii::app()->request->getParam('height');
        $total_inches = $height_cm/2.54;
        $height_feet = intval($total_inches/12);
        $height_inches = round($total_inches%12);
        $weight = Yii::app()->request->getParam('weight');
        $click_id =Yii::app()->session['affiliate_trans_id'];
        $submission_model = new Submissions();
        $insuranceCompany = $submission_model->getMatchingCompanyFromPublisher(self::$companyListFromBuyer,self::$companyListFromBuyer[0]);
        $medicalCondition = $submission_model->getMatchingMedicalCondFromPublisher(self::$medicalConditionFromBuyer,self::$medicalConditionFromBuyer[0]);
        $first_name = Yii::app()->request->getParam('first_name');
        $last_name = Yii::app()->request->getParam('last_name');
        $address = Yii::app()->request->getParam('address');
        $phone = Yii::app()->request->getParam('phone');
        $email = Yii::app()->request->getParam('email');
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $phone_last_4 = Yii::app()->request->getParam('phone_last_4');
        $dob_year = date('Y',strtotime(Yii::app()->request->getParam('dob')));
        $dob_month = date('m',strtotime(Yii::app()->request->getParam('dob')));
        $dob_day = date('d',strtotime(Yii::app()->request->getParam('dob')));
        $gender = Yii::app()->request->getParam('gender')=='M'?'Male':'Female';
        $ipaddress = Yii::app()->request->getParam('ipaddress');
        $universal_leadid = Yii::app()->request->getParam('universal_leadid');
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        $user_agent = Yii::app()->request->getParam('user_agent');
        $tcpa_optin = Yii::app()->request->getParam('tcpa_optin','Yes')==1?'Yes':'No';
        $tcpa_text = Yii::app()->request->getParam('tcpa_text','By submitting this form');
        $landing_page = Yii::app()->request->getParam('url','https://eliltehealthinsurer.com');
        $sub_id = Yii::app()->request->getParam('sub_id');
        $income = Yii::app()->request->getParam('income','1500');
        if($income == '0' OR $income == '0'){
            $income = '1500';
        }
        $is_smoker = Yii::app()->request->getParam('is_smoker','Yes')==1?'Yes':'No';
        $is_student = Yii::app()->request->getParam('is_student','Yes')==1?'Yes':'No';
        $occupation = $submission_model->getMatchingOccupationFromPublisher(self::$occupationListFromBuyer,self::$occupationListFromBuyer[0]);
        $dateformat = date('Y-m-d').'T'.date('H:i:s').'Z';
        $postData = [];
        $post_request ='<lead>
                <PingId>'.$confirmation_id.'</PingId>
                <AFID>'.$p1.'</AFID>
                <SID>'.$promo_code.'</SID>
                <ADID></ADID>
                <AffiliateReferenceID></AffiliateReferenceID>
                <_FirstName>'.$first_name.'</_FirstName>
                <_LastName>'.$last_name.'</_LastName>
                <Last4Numbers>'.$phone_last_4.'</Last4Numbers>
                <_Phone>'.$phone.'</_Phone>
                <Email>'.$email.'</Email>
                <_Address>'.$address.'</_Address>
                <_City>'.$city_state['city'].'</_City>
                <_State>'.$city_state['state'].'</_State>
                <_PostalCode>'.$zip_code.'</_PostalCode>
                <Gender>'.$gender.'</Gender>
                <DOBM>'.$dob_month.'</DOBM>
                <DOBD>'.$dob_day.'</DOBD>
                <DOBY>'.$dob_year.'</DOBY>
                <Income>'.$income.'</Income>
                <Smoker>'.$is_smoker.'</Smoker>
                <Occupation>'.$occupation.'</Occupation>
                <Student>'.$is_student.'</Student>
                <DateTime>'.$dateformat.'</DateTime>
                <HeightFeet>'.$height_feet.'</HeightFeet>
                <HeightInches>'.$height_inches.'</HeightInches>
                <Weight>'.$weight.'</Weight>
                <IP>'.$ipaddress.'</IP>
                <xxTrustedFormCertUrl>'.$trustedformcerturl.'</xxTrustedFormCertUrl>
                <Universal_Lead_ID>'.$universal_leadid.'</Universal_Lead_ID>
                <UA>'.$user_agent.'</UA>
                <TCPAConsentText>'.$tcpa_optin.'</TCPAConsentText>
                <LandingPageURL>'.$landing_page.'</LandingPageURL>
                <s2>'.$sub_id.'</s2>
            </lead>';

        $cm = new CommonMethods();
        $header = ["content-type: application/xml"];
        $start_time = CommonToolsMethods::stopwatch();
        $post_url = $post_url.'?PingId='.$confirmation_id;
        $post_response = $cm->curl($post_url, $post_request, $header);
        $time_end = CommonToolsMethods::stopwatch();
		//echo '<pre>';print_r($ping_response);die();

        $result = json_decode($post_response,TRUE);
        $result_ping = json_decode($ping_response,TRUE);
        if (trim($result['status']) == 'Accepted' || trim($result['status']) == 'accepted') {
            $post_status = '1';
            $ping_price=isset($result_ping['AcceptedPings'][0]['Payout'])?$result_ping['AcceptedPings'][0]['Payout']:0;
            $post_price=isset($result_ping['AcceptedPings'][0]['Payout'])?$result['AcceptedPings'][0]['Payout']:0;
            $post_price = isset($post_price) ? $post_price : $ping_price;
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
