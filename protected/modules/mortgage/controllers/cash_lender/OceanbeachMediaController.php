<?php
class OceanbeachMediaController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$pingData = array();
        $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
            case '1':
                $mort_type = 'New purchase';
                break;
            case '2':
                $mort_type = 'Rate/Term';
                break;
            case '3':
                $mort_type = 'Not Sure';
                break;
            case '4':
                $mort_type = 'Reverse';
                break;        
            default:
                $mort_type = 'New purchase';
                break;
        }
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        switch ($credit_rating) {
            case '1':
                $credit_rat = 'Excellent';
                break;
            case '2':
                $credit_rat = 'Good';
                break;
            case '3':
                $credit_rat = 'Fair';
                break;
            case '4':
                $credit_rat = 'Poor';
                break;        
            default:
                $credit_rat = 'Good';
                break;
        }
        $property_type = Yii::app()->request->getParam('property_use');
        switch ($property_type) {
            case '1':
                $prop_use = 'Primary Residence';
                break;
            case '2':
                $prop_use = 'Secondary Residence';
                break;
            case '3':
                $prop_use = 'Investment Property';
                break;    
            default:
                $prop_use = 'Primary Residence';
                break;
        }
        $property_desc = Yii::app()->request->getParam('property_desc');
        switch ($property_desc) {
            case '1':
                $prop_desc = 'Single Family';
                break;
            case '2':
                $prop_desc = 'Multi Family';
                break;
            case '3':
                $prop_desc = 'Townhome';
                break;
            case '4':
                $prop_desc = 'Condo';
                break;
            case '5':
                $prop_desc = 'Manufactured';
                break;
            default:
                $prop_desc = 'Other';
                break;
        }
        $rate_type = Yii::app()->request->getParam('rate_type');
        switch ($rate_type) {
            case '1':
                $r_type = 'Fixed Rate';
                break;
            case '2':
                $r_type = 'Adjustable Rate';
                break;
            case '3':
                $r_type = 'Fixed/Adjustable';
                break;
            default:
                $r_type = 'Fixed Rate';
                break;
        }
        
        $employment_status = Yii::app()->request->getParam('employment_type');
        switch ($employment_status) {
            case '1':
                $emp_status = 'Full-time employed';
                break;
            case '2':
                $emp_status = 'Part-time employed';
                break;
            case '3':
                $emp_status = 'Fixed Income';
                break;
            case '4':
                $emp_status = 'Social Security';
                break;    
            default:
                $emp_status = 'Other';
                break;
        }
        $buy_timeframe = Yii::app()->request->getParam('buy_timeframe');
        switch ($buy_timeframe) {
            case '1':
                $purchase_timeframe = 'Immediately';
                break;
            case '2':
                $purchase_timeframe = 'One month';
                break;
            case '3':
                $purchase_timeframe = 'Two months';
                break;
            case '4':
                $purchase_timeframe = 'Three months';
                break;
            case '5':
                $purchase_timeframe = 'No time constraint';
                break;
            default:
                $purchase_timeframe = 'Unknown';
                break;
        }
        
        $home_equity_type = Yii::app()->request->getParam('home_equity_type');
        switch ($home_equity_type) {
            case '1':
                $home_equi_type = 'Second Mortgage';
                break;
            case '2':
                $home_equi_type = 'HELOC';
                break;
            case '3':
                $home_equi_type = 'Not Sure';
                break;
            default:
                $home_equi_type = 'Other';
                break;
        }

        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $ipaddress = Yii::app()->request->getParam('ipaddress');
        $state = $city_state['state'];
        $city = $city_state['city'];
        $tcpa_text = Yii::app()->request->getParam('tcpa_text','By entering my information, I have read and agree to the practices');
        $tcpa_optin = Yii::app()->request->getParam('tcpa_optin');
        $tcpa_optin = $tcpa_optin == 'Yes' || $tcpa_optin == '1'  ? true : false;
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage',rand(3,9));
		
        $dateformat = date('Y-m-d').'T'.date('H:i:s').'Z';
        $SOURCEID = Yii::app()->request->getParam('promo_code');
        $OfferID=!empty($p2) ? $p2 : '13502';
        $UNIVERSAL_LEADID = Yii::app()->request->getParam('universal_leadid');
        $USER_AGENT='Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36';
        $TCPA_TEXT ='By entering my information, I have read and agree to the practices';
        $dob = Yii::app()->request->getParam('dob');
        $income = Yii::app()->request->getParam('income');
        $va_loan = Yii::app()->request->getParam('va_loan')=='1' ? 'true' : 'false';
        $bankruptcy = Yii::app()->request->getParam('bankruptcy');
        $bankruptcy = $bankruptcy == 'Yes' || $bankruptcy == '1'  ? 'true' : 'false';
        $down_payment_percentage = Yii::app()->request->getParam('down_payment');
        $spec_home = Yii::app()->request->getParam('spec_home');
        $agent_found = Yii::app()->request->getParam('agent_found');
        $first_balance = Yii::app()->request->getParam('first_balance');
        $first_interest_rate = Yii::app()->request->getParam('first_interest_rate');
        $second_balance = Yii::app()->request->getParam('second_balance');
        $second_interest_rate = Yii::app()->request->getParam('second_interest_rate');
        $property_state = Yii::app()->request->getParam('property_state');
        $property_zip = Yii::app()->request->getParam('property_zip');
        $additional_cash = Yii::app()->request->getParam('additional_cash');
        $estimate_value = Yii::app()->request->getParam('estimate_value');
        $bank_foreclosure = Yii::app()->request->getParam('bank_foreclosure');
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        $landing_page = Yii::app()->request->getParam('url','https://www.elitemortgagefinder.com.com');
        $ping_request = '<?xml version="1.0" encoding="UTF-8"?>
            <MortgageRequest>
                <Meta>
                    <OriginallyCreated>'.$dateformat.'</OriginallyCreated>
                    <SourceID>'.$SOURCEID.'</SourceID>
                    <OfferID>'.$OfferID.'</OfferID>
                    <LeadIDCode>'.$UNIVERSAL_LEADID.'</LeadIDCode>
                    <TrustedFormCertUrl>'.$trustedformcerturl.'</TrustedFormCertUrl>
                    <UserAgent>'.$USER_AGENT.'</UserAgent>
                    <LandingPageURL>'.$landing_page.'</LandingPageURL>
                    <TCPACompliant>true</TCPACompliant>
                    <TCPAConsentText>'.$tcpa_text.'</TCPAConsentText>
                </Meta>
                <Contact>
                    <PhoneLastFour></PhoneLastFour>
                    <ZipCode>'.$zip_code.'</ZipCode>
                    <IPAddress>'.$ipaddress.'</IPAddress>
                </Contact>
                <Data>
                    <BirthDate>'.$dob.'</BirthDate>
                    <EmploymentStatus>'.$emp_status.'</EmploymentStatus>
                    <AnnualIncome>'.$income.'</AnnualIncome>
                    <IsMilitary>false</IsMilitary>
                    <VALoan>'.$va_loan.'</VALoan>
                    <CreditRating>'.$credit_rat.'</CreditRating>
                    <Bankruptcy>'.$bankruptcy.'</Bankruptcy>
                    <LoanAmount>'.$loan_amount.'</LoanAmount>
                    <RateType>'.$r_type.'</RateType>
                    <LTVPercent>'.$ltv_percentage.'</LTVPercent>
                    <NumMortgageLates>0</NumMortgageLates>
                    <MortgageInfo>';
                    if($Mortgage_Type == 1){
                        $ping_request .='<NewPurchase>
                            <DownPaymentPercent>'.$down_payment_percentage.'</DownPaymentPercent>
                            <SpecHome>'.$spec_home.'</SpecHome>
                            <PurchaseTimeframe>'.$purchase_timeframe.'</PurchaseTimeframe>
                            <AgentFound>'.$agent_found.'</AgentFound>
                        </NewPurchase>';
                    }
                    if($Mortgage_Type == 2){
                        $ping_request .='<Refinance>
                            <FirstBalance>'.$first_balance.'</FirstBalance>
                            <FirstInterestRate>'.$first_interest_rate.'</FirstInterestRate>
                            <SecondBalance>'.$second_balance.'</SecondBalance>
                            <SecondInterestRate>'.$second_interest_rate.'</SecondInterestRate>
                        </Refinance>';
                    }
                    if($Mortgage_Type == 3){
                        $ping_request .='<HomeEquityLoan>
                            <HomeEquityType>'.$home_equi_type.'</HomeEquityType>
                            <AdditionalCash>'.$additional_cash.'</AdditionalCash>
                            <FirstBalance>'.$first_balance.'</FirstBalance>
                            <FirstInterestRate>'.$first_interest_rate.'</FirstInterestRate>
                            <SecondBalance>'.$second_balance.'</SecondBalance>
                            <SecondInterestRate>'.$second_interest_rate.'</SecondInterestRate>
                        </HomeEquityLoan>';
                    }
                    if($Mortgage_Type == 4){
                        $ping_request .='<Reverse>
                            <FirstBalance>'.$first_balance.'</FirstBalance>
                            <FirstInterestRate>'.$first_interest_rate.'</FirstInterestRate>
                            <SecondBalance>'.$second_balance.'</SecondBalance>
                            <SecondInterestRate>'.$second_interest_rate.'</SecondInterestRate>
                        </Reverse>';
                    }
            $ping_request .='</MortgageInfo>
                    <PropertyInfo>
                        <ZipCode>'.$zip_code.'</ZipCode>
                        <PropertyType>'.$prop_desc.'</PropertyType>
                        <PropertyUse>'.$prop_use.'</PropertyUse>
                        <EstimateValue>'.$estimate_value.'</EstimateValue>
                        <BankForeclosure>'.$bank_foreclosure.'</BankForeclosure>
                    </PropertyInfo>
                </Data>
            </MortgageRequest>';
		$pingData['ping_request'] = $ping_request;
        $pingData['header'] = array("Authorization: Token 145b0ff5526061a8d1995ac4a6a377a95a65f804","Content-Type: application/xml");
		return $pingData;
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        $ping_response = json_decode($ping_response);
        if($ping_response->status == 'success' || strtolower($ping_response->status) == 'success') {
            $ping_price = isset($ping_response->price) ? $ping_response->price : 0;
            $confirmation_id = $ping_response->auth_code;
            $ping_response_info['ping_price'] = trim($ping_price);
            $ping_response_info['ping_status'] = '1';
            $ping_response_info['confirmation_id'] = $confirmation_id;
        }else {
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
	    $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
            case '1':
                $mort_type = 'New purchase';
                break;
            case '2':
                $mort_type = 'Rate/Term';
                break;
            case '3':
                $mort_type = 'Not Sure';
                break;
            case '4':
                $mort_type = 'Reverse';
                break;        
            default:
                $mort_type = 'New purchase';
                break;
        }
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        switch ($credit_rating) {
            case '1':
                $credit_rat = 'Excellent';
                break;
            case '2':
                $credit_rat = 'Good';
                break;
            case '3':
                $credit_rat = 'Fair';
                break;
            case '4':
                $credit_rat = 'Poor';
                break;        
            default:
                $credit_rat = 'Good';
                break;
        }
        $property_type = Yii::app()->request->getParam('property_use');
        switch ($property_type) {
            case '1':
                $prop_use = 'Primary Residence';
                break;
            case '2':
                $prop_use = 'Secondary Residence';
                break;
            case '3':
                $prop_use = 'Investment Property';
                break;    
            default:
                $prop_use = 'Primary Residence';
                break;
        }
        $property_desc = Yii::app()->request->getParam('property_desc');
        switch ($property_desc) {
            case '1':
                $prop_desc = 'Single Family';
                break;
            case '2':
                $prop_desc = 'Multi Family';
                break;
            case '3':
                $prop_desc = 'Townhome';
                break;
            case '4':
                $prop_desc = 'Condo';
                break;
            case '5':
                $prop_desc = 'Manufactured';
                break;
            default:
                $prop_desc = 'Other';
                break;
        }
        $rate_type = Yii::app()->request->getParam('rate_type');
        switch ($rate_type) {
            case '1':
                $r_type = 'Fixed Rate';
                break;
            case '2':
                $r_type = 'Adjustable Rate';
                break;
            case '3':
                $r_type = 'Fixed/Adjustable';
                break;
            default:
                $r_type = 'Fixed Rate';
                break;
        }
        $employment_status = Yii::app()->request->getParam('employment_type');
        switch ($employment_status) {
            case '1':
                $emp_status = 'Full-time employed';
                break;
            case '2':
                $emp_status = 'Part-time employed';
                break;
            case '3':
                $emp_status = 'Fixed Income';
                break;
            case '4':
                $emp_status = 'Social Security';
                break;    
            default:
                $emp_status = 'Other';
                break;
        }
        $buy_timeframe = Yii::app()->request->getParam('buy_timeframe');
        switch ($buy_timeframe) {
            case '1':
                $purchase_timeframe = 'Immediately';
                break;
            case '2':
                $purchase_timeframe = 'One month';
                break;
            case '3':
                $purchase_timeframe = 'Two months';
                break;
            case '4':
                $purchase_timeframe = 'Three months';
                break;
            case '5':
                $purchase_timeframe = 'No time constraint';
                break;
            default:
                $purchase_timeframe = 'Unknown';
                break;
        }
        $home_equity_type = Yii::app()->request->getParam('home_equity_type');
        switch ($home_equity_type) {
            case '1':
                $home_equi_type = 'Second Mortgage';
                break;
            case '2':
                $home_equi_type = 'HELOC';
                break;
            case '3':
                $home_equi_type = 'Not Sure';
                break;
            default:
                $purchase_timeframe = 'Other';
                break;
        }

        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $ipaddress = Yii::app()->request->getParam('ipaddress');
        $state = $city_state['state'];
        $city = $city_state['city'];
        $tcpa_text = Yii::app()->request->getParam('tcpa_text','By entering my information, I have read and agree to the practices');
        $tcpa_optin = Yii::app()->request->getParam('tcpa_optin');
        $tcpa_optin = $tcpa_optin == 'Yes' || $tcpa_optin == '1'  ? true : false;
        $ipaddress = Yii::app()->request->getParam('ipaddress');
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage',rand(3,9));
        
        $dateformat = date('Y-m-d').'T'.date('H:i:s').'Z';
        $SOURCEID = Yii::app()->request->getParam('promo_code');
        $OfferID=!empty($p2) ? $p2 : '13502';
        $UNIVERSAL_LEADID = Yii::app()->request->getParam('universal_leadid');
        $USER_AGENT='Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36';
        $dob = Yii::app()->request->getParam('dob');
        $income = Yii::app()->request->getParam('income');
        $va_loan = Yii::app()->request->getParam('va_loan')=='1' ? 'true' : 'false';
        $bankruptcy = Yii::app()->request->getParam('bankruptcy');
        $bankruptcy = $bankruptcy == 'Yes' || $bankruptcy == '1'  ? 'true' : 'false';
        $down_payment_percentage = Yii::app()->request->getParam('down_payment');
        $spec_home = Yii::app()->request->getParam('spec_home');
        $agent_found = Yii::app()->request->getParam('agent_found');
        $first_balance = Yii::app()->request->getParam('first_balance');
        $first_interest_rate = Yii::app()->request->getParam('first_interest_rate');
        $second_balance = Yii::app()->request->getParam('second_balance');
        $second_interest_rate = Yii::app()->request->getParam('second_interest_rate');
        $property_state = Yii::app()->request->getParam('property_state');
        $property_zip = Yii::app()->request->getParam('property_zip');
        $additional_cash = Yii::app()->request->getParam('additional_cash');
        $estimate_value = Yii::app()->request->getParam('estimate_value');
        $bank_foreclosure = Yii::app()->request->getParam('bank_foreclosure');
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl');
        $landing_page = Yii::app()->request->getParam('url','https://www.elitemortgagefinder.com.com');
        $first_name = Yii::app()->request->getParam('first_name');
        $last_name = Yii::app()->request->getParam('last_name');
        $email = Yii::app()->request->getParam('email');
        $address = Yii::app()->request->getParam('address');
        $phone = Yii::app()->request->getParam('phone');
        $phone2 = Yii::app()->request->getParam('phone2');

        $ping_response = json_decode($ping_response);
        $confirmation_id = $ping_response->auth_code;
        preg_match("/<AuthCode>(.*)<\/AuthCode>/msui",$ping_response,$confirmation_id);
        $post_request = '<?xml version="1.0" encoding="UTF-8"?>
            <MortgageRequest>
                <AuthCode>'.$confirmation_id.'</AuthCode>
                <Meta>
                    <OriginallyCreated>'.$dateformat.'</OriginallyCreated>
                    <SourceID>'.$SOURCEID.'</SourceID>
                    <OfferID>'.$OfferID.'</OfferID>
                    <LeadIDCode>'.$UNIVERSAL_LEADID.'</LeadIDCode>
                    <TrustedFormCertUrl>'.$trustedformcerturl.'</TrustedFormCertUrl>
                    <UserAgent>'.$USER_AGENT.'</UserAgent>
                    <LandingPageURL>'.$landing_page.'</LandingPageURL>
                    <TCPACompliant>true</TCPACompliant>
                    <TCPAConsentText>'.$tcpa_text.'</TCPAConsentText>
                </Meta>
                <Contact>
                    <FirstName>'.$first_name.'</FirstName>
                    <LastName>'.$last_name.'</LastName>
                    <Email>'.$email.'</Email>
                    <Phone>'.$phone.'</Phone>
                    <Address>'.$address.'</Address>
                    <City>'.$city.'</City>
                    <State>'.$state.'</State>
                    <ZipCode>'.$zip_code.'</ZipCode>
                    <IPAddress>'.$ipaddress.'</IPAddress>
                </Contact>
                <Data>
                    <BirthDate>'.$dob.'</BirthDate>
                    <EmploymentStatus>'.$emp_status.'</EmploymentStatus>
                    <AnnualIncome>'.$income.'</AnnualIncome>
                    <IsMilitary>false</IsMilitary>
                    <VALoan>'.$va_loan.'</VALoan>
                    <CreditRating>'.$credit_rat.'</CreditRating>
                    <Bankruptcy>'.$bankruptcy.'</Bankruptcy>
                    <LoanAmount>'.$loan_amount.'</LoanAmount>
                    <RateType>'.$r_type.'</RateType>
                    <LTVPercent>'.$ltv_percentage.'</LTVPercent>
                    <NumMortgageLates>0</NumMortgageLates>
                    <MortgageInfo>';
                        if($Mortgage_Type == 1){
                        $post_request .='<NewPurchase>
                            <DownPaymentPercent>'.$down_payment_percentage.'</DownPaymentPercent>
                            <SpecHome>'.$spec_home.'</SpecHome>
                            <PurchaseTimeframe>'.$purchase_timeframe.'</PurchaseTimeframe>
                            <AgentFound>'.$agent_found.'</AgentFound>
                        </NewPurchase>';
                    }
                    if($Mortgage_Type == 2){
                        $post_request .='<Refinance>
                            <FirstBalance>'.$first_balance.'</FirstBalance>
                            <FirstInterestRate>'.$first_interest_rate.'</FirstInterestRate>
                            <SecondBalance>'.$second_balance.'</SecondBalance>
                            <SecondInterestRate>'.$second_interest_rate.'</SecondInterestRate>
                        </Refinance>';
                    }
                    if($Mortgage_Type == 3){
                        $post_request .='<HomeEquityLoan>
                            <HomeEquityType>'.$home_equi_type.'</HomeEquityType>
                            <AdditionalCash>'.$additional_cash.'</AdditionalCash>
                            <FirstBalance>'.$first_balance.'</FirstBalance>
                            <FirstInterestRate>'.$first_interest_rate.'</FirstInterestRate>
                            <SecondBalance>'.$second_balance.'</SecondBalance>
                            <SecondInterestRate>'.$second_interest_rate.'</SecondInterestRate>
                        </HomeEquityLoan>';
                    }
                    if($Mortgage_Type == 4){
                        $post_request .='<Reverse>
                            <FirstBalance>'.$first_balance.'</FirstBalance>
                            <FirstInterestRate>'.$first_interest_rate.'</FirstInterestRate>
                            <SecondBalance>'.$second_balance.'</SecondBalance>
                            <SecondInterestRate>'.$second_interest_rate.'</SecondInterestRate>
                        </Reverse>';
                    }
                    $post_request .='</MortgageInfo>
                    <PropertyInfo>
                        <Address>'.$address.'</Address>
                        <City>'.$city.'</City>
                        <State>'.$state.'</State>
                        <ZipCode>'.$zip_code.'</ZipCode>
                        <PropertyType>'.$prop_desc.'</PropertyType>
                        <PropertyUse>'.$prop_use.'</PropertyUse>
                        <EstimateValue>'.$estimate_value.'</EstimateValue>
                        <BankForeclosure>'.$bank_foreclosure.'</BankForeclosure>
                    </PropertyInfo>
                </Data>
            </MortgageRequest>';
		//echo '<pre>';print_r($post_request);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
        $header = array("Authorization: Token 145b0ff5526061a8d1995ac4a6a377a95a65f804","Content-Type: application/xml");
		$post_response = $cm->curl($post_url,$post_request,$header);
		$time_end = CommonToolsMethods::stopwatch();
        $post_response = html_entity_decode($post_response);
		//echo '<pre>';print_r();die();

        $post_res = json_decode($post_response);
        if($post_res->status == 'success' || strtolower($post_res->status) == 'success') {
            $post_status = '1';
            $post_price = isset($post_res->price) ? $post_res->price : $ping_price;
        }else{
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