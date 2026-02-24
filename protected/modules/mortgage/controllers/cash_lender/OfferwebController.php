<?php
class OfferwebController extends Controller {
    public static $medicalConditionFromBuyer = ['HighCholesterol','PulmonaryDisease','VascularDisease','AIDSHIV','KidneyDisease','Asthma','Cancer','Depression','Diabetes','HeartDisease','LiverDisease','HighBloodPressure','MentalIllness','Stroke','Alzheimer','AlcoholAbuse'];
    public static $companyListFromBuyer = ['Currently not insured','21st Century','AAA','AARP','AIG','Access Insurance','AETNA','AFLAC','AIU','Alfa Insurance','All Risk','Allianz','Allied','Allstate','American Alliance Insurance','American Family','American Home Assurance','American Insurance','American International Insurance','American International Pacific','American Internacional south','AMS User Group','American International South','American Direct Business Insurance','American Deposit Insurance','American Casualty','American Manufacturers','American Empire Insurance','American Financial','American Health Underwriters','American Mayflower Insurance','American Motorists Insurance','American National','American Premier Insurance','American Protection Insurance','American Automobile Insurance','American Reliable','American Republic','American Savers Plan','American Service Insurance','American Skyline Insurance Company','American Spirit Insurance','American Standard Insurance','AmeriPlan','Ameriprise','Amica','Answer Financial','Anthem','Arbella','Armed Forces Insurance','Associated Indemnity','Assurant','Atlanta Casualty','Atlantic Indemnity','Atlantis','Auto Club Insurance Company','AXA Advisors','Auto Owners','Bankers Life and Casualty','Banner Life','Best Agency USA','Blue Cross / Blue Shield','Brooke Insurance','Commonwealth','Company not listed','Cal Farm Insurance','California State Automobile Association','Chubb','Cigna','Citizens','Clarendon','Clarendon National Insurance','CNA','Colonial Insurance','Comparison Market','Continental Insurance','Cotton States','Country Insurance and Financial Services','County Insurance and Financial Services','Countrywide','Countywide','CSE Insurance Group','Dairyland Insurance','eFinancial','eHealth Insurance Sercies','eHealthInsurance Services','Electric Insurance','Elephant','Equitable Life & Casualty Insurance','Erie Insurance','Esurance','Farm Bureau/Farm Family/Rural','Farmers','FinanceBox.com','Fire and Casualty Insurance Co of CT','Farmers Union','Fidelity Insurance Company','Fidelity National','Foremost','Foresters','Geico','AMSUserGroup','Garden State Life Insurance Company','GMAC','Golden Rule Insurance','Government Employees Insurance','Government Empoyees Insurance','Grange','Great American','Great West','Guaranty National Insurance','Guide One Insurance','Hanover Lloyds Insurance Company','The Hartford','Guardian','Guideone','Hartford AARP','Health Benefits Direct','Health Care Solutions','Health Choice One','Health Net','Health Plus of America','HealthMarkets','HealthShare American','Horace Mann','Horace Mann Insurance','Humana','IFA Auto Insurance','IGF Insurance','IDS','IHIAA','Infinity Insurance','Insurance Insight','Infinity National Insurance','Infinity Select Insurance','Insphere Insurance Solutions','Insurance Shopper, Inc','Insurance.com','Integon','Iroquois Group','John Hancock','Kaiser Permanente','Kemper Lloyds Insurance','Landmark American Insurance','Leader Insurance','Leader Preferred Insurance','Leader Specialty Insurance','Liberty Insurance Corp','Liberty Mutual','Liberty National','Liberty Northwest','Liberty Nothwest','Lincoln Benefit Life','Lumbermens Mutual','Maryland Casualty','Mass Mutual','Matrix Direct','Mercury','MetLife Auto and Home','Metropolitan Insurance Co.','Mid Century Insurance','Continent Casualty','Middlesex Insurance','Midland National Life','Mutual Insurance','National Insurance','Miller Mutual','Modern Woodmen of America','Mutual of New York','Mutual Of Omaha','National Ben Franklin Insurance','National Casualty','Continental Casualty','Continental Divide Insurance','National Continental Insurance','National Fire Insurance','National Health Insurance','National Indemnity','National Union Fire Insurance','Nationwide','New England Financial','New York Life Insurance','Northwestern Mutual Life','Nortwestern Mutual Life','Norhwestern Pacific Indemnity','Northwestern Pacific Indemnity','Omni Insurance','Orion Insurance','Pacific Insurance','Pafco General Insurance','Patriot General Insurance','Peak Property and Casualty Insurance','PEMCO Insurance','Physicians','Penn Mutual','Pennsylvania life','Premier','Primerica','Principal Financial','Progressive','Protective Life','Prudential Insurance Co.','RBC Liberty','Reliance Insurance','Republic Indemnity','Response Insurance','SAFECO','Safeway Insurance','Security Insurance','Senior Market Sales','Sentinel Insurance','Sentry','Shelter','St. Paul Insurance','Standard File Insurance Company','Standard Fire Insurance Company','State and County Mutual Fire Insurance','State Farm','State National','Superior American Insurance','Superior Guaranty Insurance','Superior Insurance','Sure Health Plans','The Ahbe Group','The General','TICO Insurance','TICO Insurance1','TIG Countrywide Insurance','Titan','TransAmerica','Travelers','State Consumer Insurance','Twin City Fire Insurance','UniCare','United Insurance','United American/Farm and Ranch','United Life Group','United Pacific Insurance','United Security','United Services Automobile Association','Unitrin Direct','Universal Underwriters Insurance','US Financial','US Health Group','USA Benefits','USA Benefits','USAA','USF and G','Viking Insurance','Western and Southern Life','Western Mutual','William Penn','Windsor Insurance','Woodlands Financial Group','Zurich North America'];

    public static $occupationListFromBuyer = ['Employeed','Government','Homemaker','Retired','Unemployed','Military','Retail','Sales','Marketing','IT','Medical','Unknown','BusinessOwner','Student','SalesInside','SalesOutside','Scientist','OtherTechnical','MilitaryEnlisted','Architect','Other'];

    public static $userAgentList = ['Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1','Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36','Roku4640X/DVP-7.70 (297.70E04154A)','Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30','Mozilla/5.0 (Linux; Android 5.1; AFTS Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/41.99900.2250.0242 Safari/537.36','Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)','Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US','Mozilla/5.0 (Windows NT 10.0; Win64; x64; XBOX_ONE_ED) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393'];
        
    public static $maritialStatus = [
            1 => 'Single',
            2 => 'Married',
            3 => 'Separated',
            4 => 'Divorced',
            5 => 'Married',
            6 => 'Widowed'
    ];
    public static $creditRating = [
            1 => 'Excellent',
            2 => 'Good',
            3 => 'Average',
            4 => 'Poor',
    ];
    public static $educationList = [
            1 => 'GED',
            2 => 'Some Or No High School',
            3 => 'High School',
            4 => 'Some College',
            5 => 'Associate Degree',
            6 => 'Bachelors Degree',
            7 => 'Masters Degree',
            8 => 'Doctoral Degree',
            9 => 'Unknown',
    ];
    public static $converageType = [
        1 => 'Short Term',
        2 => 'Individual Family',
        3 => 'Medicare Supplement',
        4 => 'COBRA'
    ];
    public static $propertyDescription = [
        1 => 'Single Family',
        2 => 'Multi-Family',
        3 => 'Townhouse',
        4 => 'Condo',
        5 => 'Mobile',
    ];
    public static $mortgageLeadType = [
        1 => 'New Purchase',
        2 => 'Refinance',
        3 => 'Home Equity Loan',
        4 => 'Reverse Mortgage',
    ];
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $pingData = [];
        $p1 = $p1 ? $p1 : '513257';
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
		$promo_code = Yii::app()->request->getParam('promo_code');
        $user_agent_list = self::$userAgentList;
        $user_agent = $user_agent_list[array_rand($user_agent_list)];
        $user_agent = Yii::app()->request->getParam('user_agent',$user_agent);
        $LeadDateTime = date('Y-m-d H:i:s');
        $TCPAOptin = Yii::app()->request->getParam('tcpa_optin','Yes')==1?'Yes':'No';
        $TCPAText = Yii::app()->request->getParam('tcpa_text','By submitting this form');
        $UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        $ipaddress = Yii::app()->request->getParam('ipaddress');
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $estimate_value = Yii::app()->request->getParam('estimate_value');
        $mortgage_Type = self::$mortgageLeadType[Yii::app()->request->getParam('mortgage_lead_type')];
        $mortgage_Type ='Refinance';
        $property_desc = self::$propertyDescription[Yii::app()->request->getParam('property_desc')];
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $additional_cash = Yii::app()->request->getParam('additional_cash',$property_value);
        $estimate_value = Yii::app()->request->getParam('estimate_value');
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage',rand(3,9));
        $is_veteran = Yii::app()->request->getParam('va_loan')=='1'?'Yes':'No';
        $click_id =Yii::app()->session['affiliate_trans_id'];
        $url = Yii::app()->request->getParam('url','http://elitemortgagefinder.com');
		$ping_request ='<lead>
				   <AFID>'.$p1.'</AFID>
				   <SID>'.$promo_code.'</SID>
				   <ADID></ADID>
				   <ClickID>'.$click_id.'</ClickID>
                   <AffiliateReferenceID></AffiliateReferenceID>
                   <_City>'.$city_state['city'].'</_City>
                   <_State>'.$city_state['state'].'</_State>
                   <_PostalCode>'.$zip_code.'</_PostalCode>
                   <LandingPageURL>'.$url.'</LandingPageURL>
                   <TCPAConsentText>'.$TCPAText.'</TCPAConsentText>
                   <xxTrustedFormCertUrl>'.$trustedformcerturl.'</xxTrustedFormCertUrl>
                   <Universal_Lead_ID>'.$UniversalLeadID.'</Universal_Lead_ID>
                   <UA>'.$user_agent.'</UA>
                   <IP>'.$ipaddress.'</IP>
                   <loan_amount>'.$loan_amount.'</loan_amount>
                   <property_value>'.$property_value.'</property_value>
                   <mortgage_lead_type>'.$mortgage_Type.'</mortgage_lead_type>
                   <first_balance>'.$first_balance.'</first_balance>
                   <cash_out>'.$additional_cash.'</cash_out>
                   <purchase_price>'.$estimate_value.'</purchase_price>
                   <veteran_military>'.$is_veteran.'</veteran_military>
                   <property_desc>'.$property_desc.'</property_desc>
				   <s2>'.$SubID.'</s2>
				</lead>';
        $header = ["Content-type: text/xml"];
		$pingData['ping_request'] = $ping_request;
        $pingData['header'] = $header;
        return $pingData;
    }

    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<Accepted>(.*)<\/Accepted>/msui", $ping_response, $result);
        if (trim($result[1]) == 'true' || trim($result[0]) == '1') {
            preg_match("/<Payout>(.*)<\/Payout>/msui", $ping_response, $price);
            preg_match("/<PingId>(.*)<\/PingId>/msui", $ping_response, $confirmation_id);
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
    public static function sendPostData($parameter1, $parameter2, $parameter3, $ping_response, $post_url, $status) {
        $p1 = $p1 ? $p1 : '513257';
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $promo_code = Yii::app()->request->getParam('promo_code');
        $user_agent_list = self::$userAgentList;
        $user_agent = $user_agent_list[array_rand($user_agent_list)];
        $user_agent = Yii::app()->request->getParam('user_agent',$user_agent);
        $LeadDateTime = date('Y-m-d H:i:s');
        $TCPAOptin = Yii::app()->request->getParam('tcpa_optin','Yes')==1?'Yes':'No';
        $TCPAText = Yii::app()->request->getParam('tcpa_text','By submitting this form');
        $UniversalLeadID = Yii::app()->request->getParam('universal_leadid');
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        $ipaddress = Yii::app()->request->getParam('ipaddress');
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $estimate_value = Yii::app()->request->getParam('estimate_value');
        $mortgage_Type = self::$mortgageLeadType[Yii::app()->request->getParam('mortgage_lead_type')];
        $mortgage_Type ='Refinance';
        $property_desc = self::$propertyDescription[Yii::app()->request->getParam('property_desc')];
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $additional_cash = Yii::app()->request->getParam('additional_cash',$property_value);
        $estimate_value = Yii::app()->request->getParam('estimate_value');
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage',rand(3,9));
        $is_veteran = Yii::app()->request->getParam('va_loan')=='1'?'Yes':'No';
        $click_id =Yii::app()->session['affiliate_trans_id'];
        $url = Yii::app()->request->getParam('url','http://elitemortgagefinder.com');
        $first_name = Yii::app()->request->getParam('first_name');
        $last_name = Yii::app()->request->getParam('last_name');
        $email = Yii::app()->request->getParam('email');
        $phone = Yii::app()->request->getParam('phone');
        $address = Yii::app()->request->getParam('address');
        $post_request ='<lead>
                   <AFID>'.$p1.'</AFID>
                   <SID>'.$promo_code.'</SID>
                   <ADID></ADID>
                   <ClickID>'.$click_id.'</ClickID>
                   <AffiliateReferenceID></AffiliateReferenceID>
                   <_FirstName>'.$first_name.'</_FirstName>
                   <_LastName>'.$last_name.'</_LastName>
                   <_Phone>'.$phone.'</_Phone>
                   <_Address>'.$address.'</_Address>
                   <_City>'.$city_state['city'].'</_City>
                   <_State>'.$city_state['state'].'</_State>
                   <_PostalCode>'.$zip_code.'</_PostalCode>
                   <Email>'.$email.'</Email>
                   <LandingPageURL>'.$url.'</LandingPageURL>
                   <TCPAConsentText>'.$TCPAText.'</TCPAConsentText>
                   <xxTrustedFormCertUrl>'.$trustedformcerturl.'</xxTrustedFormCertUrl>
                   <Universal_Lead_ID>'.$UniversalLeadID.'</Universal_Lead_ID>
                   <UA>'.$user_agent.'</UA>
                   <IP>'.$ipaddress.'</IP>
                   <loan_amount>'.$loan_amount.'</loan_amount>
                   <property_value>'.$property_value.'</property_value>
                   <mortgage_lead_type>'.$mortgage_Type.'</mortgage_lead_type>
                   <first_balance>'.$first_balance.'</first_balance>
                   <cash_out>'.$additional_cash.'</cash_out>
                   <purchase_price>'.$estimate_value.'</purchase_price>
                   <veteran_military>'.$is_veteran.'</veteran_military>
                   <property_desc>'.$property_desc.'</property_desc>
                   <s2>'.$SubID.'</s2>
                </lead>';
        $cm = new CommonMethods();
        $header = ["content-type: application/xml"];
        $start_time = CommonToolsMethods::stopwatch();
        $post_response = $cm->curl($post_url, $post_request, $header);
        $time_end = CommonToolsMethods::stopwatch();
		//echo '<pre>';print_r($ping_response);die();
        preg_match("/<status>(.*)<\/status>/", $post_response, $success);
        if (trim($success[1]) == 'Accepted') {
            $post_status = '1';
            preg_match("/<successUrl>(.*)<\/successUrl>/", $post_response, $redirect);
            $redirect_url = isset($redirect[1]) ? $redirect[1] : '';
            preg_match("/<commission>(.*)<\/commission>/msui", $post_response, $price);
            preg_match("/<Payout>(.*)<\/Payout>/msui", $ping_response, $ping_price);
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
