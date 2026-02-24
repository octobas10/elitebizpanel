<?php
class PXController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function getDownPayment($down_pay){
        if($down_pay ='0'){
            $down_payment ='0%';
        }else if($down_pay>='1' and $down_pay>='5'){
            $down_payment ='5%';
        }else if($down_pay>='6' and $down_pay<='10'){
            $down_payment ='10%';
        }else if($down_pay>='11' and $down_pay<='15'){
            $down_payment ='15%';
        }else if($down_pay>='16' and $down_pay<='20'){
            $down_payment ='20%';
        }else if($down_pay>='21' and $down_pay<='25'){
            $down_payment ='25%';
        }else if($down_pay>='26' and $down_pay<='30'){
            $down_payment ='30%';
        }else if($down_pay>='31' and $down_pay<='40'){
            $down_payment ='40%';
        }else if($down_pay>='41' and $down_pay<='50'){
            $down_payment ='50%';
        }else{
            $down_payment ='More than 50%';
        }
        return $down_payment;
    }
    public static function getCashOut(){
        $cash_out = Yii::app()->request->getParam('additional_cash');
        if($cash_out<='1'){
            $cash_out_bal = '0 (No cash)';
        }else if($cash_out>='1' and $cash_out<='25000'){
            $cash_out_bal = '$1 - 25,000';
        }else if($cash_out>='25001' and $cash_out<='50000'){
            $cash_out_bal = '$25,001 - 50,000';
        }else if($cash_out>='50001' and $cash_out<='75000'){
            $cash_out_bal = '$50,001 - 75,000';
        }else if($cash_out>='75001' and $cash_out<='100000'){
             $cash_out_bal = '$75,001 - 100,000';
        }else if($cash_out>='100001' and $cash_out<='125000'){
            $cash_out_bal = '$100,001 - 125,000';
        }else if($cash_out>='125000' and $cash_out<='150000'){
            $cash_out_bal = '$125,001 - 150,000';
        }else if($cash_out>='200001' and $cash_out<='250000'){
            $cash_out_bal = '$200,001 - 250,000';
        }else if($cash_out>='250001' and $cash_out<='300000'){
            $cash_out_bal = '$250,001 - 300,000';
        }else if($cash_out>='300001' and $cash_out<='350000'){
            $cash_out_bal = '$300,001 - 350,000';
        }else if($cash_out>='350001' and $cash_out<='400000'){
            $cash_out_bal = '$350,001 - 400,000';
        }else if($cash_out>='400001' and $cash_out<='700000'){
            $cash_out_bal = '$400,001 - 450,000';
        }else if($cash_out>='700001' and $cash_out<='950000'){
            $cash_out_bal = '$700,001 - 950,000';
        }else if($cash_out>='950001' and $cash_out<='1450000'){
            $cash_out_bal = '$950,001 - 1,450,000';
        }else if($cash_out>='1450001' and $cash_out<='1950000'){
            $cash_out_bal = '$1,450,001 - 1,950,000';
        }else{
            $cash_out_bal = '$50,001 - 75,000';
        }
        return $cash_out_bal;
    }
    public static function getPropertyBalance($property_balance){
        if($property_balance<='50000'){
            $prop_bal = '$50,000 or less';
        }else if($property_balance>='50001' and $property_balance<='75000'){
            $prop_bal = '$50,001 - 75,000';
        }else if($property_balance>='75001' and $property_balance<='100000'){
            $prop_bal = '$75,001 - 100,000';
        }else if($property_balance>='100001' and $property_balance<='125000'){
            $prop_bal = '$100,001 - 125,000';
        }else if($property_balance>='125001' and $property_balance<='150000'){
             $prop_bal = '$125,001 - 150,000';
        }else if($property_balance>='150001' and $property_balance<='175000'){
            $prop_bal = '$150,001 - 175,000';
        }else if($property_balance>='175001' and $property_balance<='200000'){
            $prop_bal = '$175,001 - 200,000';
        }else if($property_balance>='200001' and $property_balance<='250000'){
            $prop_bal = '$200,001 - 250,000';
        }else if($property_balance>='250001' and $property_balance<='300000'){
            $prop_bal = '$250,001 - 300,000';
        }else if($property_balance>='300001' and $property_balance<='350000'){
            $prop_bal = '$300,001 - 350,000';
        }else if($property_balance>='350001' and $property_balance<='400000'){
            $prop_bal = '$350,001 - 400,000';
        }else if($property_balance>='400001' and $property_balance<='450000'){
            $prop_bal = '$400,001 - 450,000';
        }else if($property_balance>='450001' and $property_balance<='500000'){
            $prop_bal = '$450,001 - 500,000';
        }else if($property_balance>='500001' and $property_balance<='750000'){
            $prop_bal = '$500,001 - 750,000';
        }else if($property_balance>='750001' and $property_balance<='1000000'){
            $prop_bal = '$750,001 - 1,000,000';
        }else if($property_balance>='1000001' and $property_balance<='1500000'){
            $prop_bal = '$1,000,001 - 1,500,000';
        }else if($property_balance>='1500001' and $property_balance<='2000000'){
            $prop_bal = '$1,500,001 - 2,000,000';
        }else if($property_balance>='2000000'){
            $prop_bal = 'Over $2,000,000';
        }else{
            $prop_bal = '$100,001 - 125,000';
        }
        return $prop_bal;
    }
    public static function getMortagageBalance($mortgage_balance){
        if($mortgage_balance<='50000'){
            $mort_bal = '$50,000 or less';
        }else if($mortgage_balance>='50001' and $mortgage_balance<='75000'){
            $mort_bal = '$50,001 - 75,000';
        }else if($mortgage_balance>='75001' and $mortgage_balance<='100000'){
            $mort_bal = '$75,001 - 100,000';
        }else if($mortgage_balance>='100001' and $mortgage_balance<='125000'){
            $mort_bal = '$100,001 - 125,000';
        }else if($mortgage_balance>='125001' and $mortgage_balance<='150000'){
             $mort_bal = '$125,001 - 150,000';
        }else if($mortgage_balance>='150001' and $mortgage_balance<='175000'){
            $mort_bal = '$150,001 - 175,000';
        }else if($mortgage_balance>='175001' and $mortgage_balance<='200000'){
            $mort_bal = '$175,001 - 200,000';
        }else if($mortgage_balance>='200001' and $mortgage_balance<='250000'){
            $mort_bal = '$200,001 - 250,000';
        }else if($mortgage_balance>='250001' and $mortgage_balance<='300000'){
            $mort_bal = '$250,001 - 300,000';
        }else if($mortgage_balance>='300001' and $mortgage_balance<='350000'){
            $mort_bal = '$300,001 - 350,000';
        }else if($mortgage_balance>='350001' and $mortgage_balance<='400000'){
            $mort_bal = '$350,001 - 400,000';
        }else if($mortgage_balance>='400001' and $mortgage_balance<='450000'){
            $mort_bal = '$400,001 - 450,000';
        }else if($mortgage_balance>='450001' and $mortgage_balance<='500000'){
            $mort_bal = '$450,001 - 500,000';
        }else if($mortgage_balance>='500001' and $mortgage_balance<='750000'){
            $mort_bal = '$500,001 - 750,000';
        }else if($mortgage_balance>='750001' and $mortgage_balance<='1000000'){
            $mort_bal = '$750,001 - 1,000,000';
        }else if($mortgage_balance>='1000001' and $mortgage_balance<='1500000'){
            $mort_bal = '$1,000,001 - 1,500,000';
        }else if($mortgage_balance>='1500001' and $mortgage_balance<='2000000'){
            $mort_bal = '$1,500,001 - 2,000,000';
        }else if($mortgage_balance>='2000000'){
             $mort_bal = 'Over $2,000,000';
        }
        return $mort_bal;
    }
    public static function purchaseTimeFrmae(){
        $buy_timeframe = Yii::app()->request->getParam('buy_timeframe');
        switch ($buy_timeframe) {
            case '1':
                $purchase_timeframe = '0-3 months';
                break;
            case '2':
                $purchase_timeframe = '0-3 months';
                break;
            case '3':
                $purchase_timeframe = '3-6 months';
                break;
            case '4':
                $purchase_timeframe = '6-12 months';
                break;
            case '5':
                $purchase_timeframe = '12+ months';
                break;
            default:
                $purchase_timeframe = 'Not sure';
                break;
        }
        return $purchase_timeframe;
    }
    public static function getMortgageLeadType($Mortgage_Type){
        
        switch ($Mortgage_Type) {
                case '1':
                    $mort_type = 'Purchase';
                    break;
                case '2':
                    $mort_type = 'Refinance';
                    break;
                case '3':
                    $mort_type = 'Home equity';
                    break;
                case '4':
                    $mort_type = 'Reverse Mortgage';
                    break;
                default:
                    $mort_type = 'Refinance';
                    break;          
            }
        return $mort_type;
    }
    public static function getCreditRating($credit_rating){
        
        switch ($credit_rating) {
            case '1':
                $CreditRating = 'Excellent';
                break;
            case '2':
                $CreditRating = 'Good';
                break;
            case '3':
                $CreditRating = 'Some Problems';
                break;
            case '4':
                $CreditRating = 'Major Problems';
                break;        
            default:
                $CreditRating = 'Good';
                break;
        }
        return $CreditRating;
    }
    public static function getPropertyType($property_type){
        switch ($property_type) {
            case '1':
                $prop_use = 'Primary home';
                break;
            case '2':
                $prop_use = 'Secondary home';
                break;
            case '3':
                $prop_use = 'Rental property';
                break;    
            default:
                $prop_use = 'Primary Residence';
                break;
        }
        return $prop_use;
    }
    public static function getPropertyDescription($property_desc){
        switch ($property_desc) {
            case '1':
                $prop_desc = 'Single family home';
                break;
            case '2':
                $prop_desc = 'Multi-family home';
                break;
            case '3':
                $prop_desc = 'Townhouse';
                break;
            case '4':
                $prop_desc = 'Condo';
                break;
            case '5':
                $prop_desc = 'Mobile home';
                break;
            default:
                $prop_desc = 'Single family home';
                break;
        }
        return $prop_desc;
    }
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $promo_code = Yii::app()->request->getParam('promo_code');
        if($promo_code != 26 && $promo_code != 0){
            $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
            $mort_type = self::getMortgageLeadType($Mortgage_Type);
            $credit_rating = Yii::app()->request->getParam('credit_rating');
            $CreditRating = self::getCreditRating($credit_rating);
            $property_type = Yii::app()->request->getParam('property_use');
            $prop_use = self::getPropertyType($property_type);
            $property_desc = Yii::app()->request->getParam('property_desc');
            $prop_desc = self::getPropertyDescription($property_desc);
            // === OTHER VARIABLES ====
            $first_mortage = Yii::app()->request->getParam('first_balance');
            $first_mortage_balance = self::getMortagageBalance($first_mortage);
            $second_mortage = Yii::app()->request->getParam('second_balance');
            $second_mortage_balance = self::getMortagageBalance($second_mortage);
            $additional_cash = Yii::app()->request->getParam('additional_cash');
            $cash_out_balance = self::getCashOut($additional_cash);
            $buy_timeframe = Yii::app()->request->getParam('buy_timeframe');
            $purchase_timeframe = self::purchaseTimeFrmae($buy_timeframe);
            $property_value = Yii::app()->request->getParam('property_value');
            $property_value_balance = self::getPropertyBalance($property_value);
            $estimate_value = Yii::app()->request->getParam('estimate_value');
            $total_mort_balance = self::getPropertyBalance($estimate_value);
            $down_payment = Yii::app()->request->getParam('down_payment',0);
            $down_payment_bal = self::getDownPayment($down_payment);
            $property_zip = Yii::app()->request->getParam('property_zip');
            $ZipCode = Yii::app()->request->getParam('zip',$property_zip);
            $submission_model = new Submissions();
            $city_state = $submission_model->getCityStateFromZip($ZipCode);
            $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
            $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
            $second_balance = Yii::app()->request->getParam('second_balance',$property_value);
            $estimate_value = Yii::app()->request->getParam('estimate_value',$property_value);
            // BECAUSE OF BANKRUPCY NOT ALLOWED IN LAST 5 YEARS
            $Time= ['Less than 1 year','Less than 1 year','Less than 1 year','Less than 1 year','Less than 1 year','Less than 1 year','Less than 1 year','1 Year','2 Years','3 Years','4 Years','5 Years','More than 5 years'];
            $State = Yii::app()->request->getParam('property_state',$city_state['state']);
            $va_loan = Yii::app()->request->getParam('va_loan');
            $original_url = Yii::app()->request->getParam('url','https://elitemortgagefinder.com');
            $sub_id = Yii::app()->request->getParam('sub_id');
            $jornayaLeadId = Yii::app()->request->getParam('universal_leadid');
            $tcpa_text = str_replace('&','',Yii::app()->request->getParam('tcpa_text'));
            $TcpaText = htmlspecialchars($tcpa_text);
            $IpAddress = Yii::app()->request->getParam('ipaddress');
            $BirthDate = date("Y-m-d",strtotime(Yii::app()->request->getParam('dob')));
            $MilitaryOrVeteran = $va_loan == '1' ? 'Yes' : 'No';
            $SubId = $promo_code.'_'.$sub_id;
            $bankruptcy = Yii::app()->request->getParam('bankruptcy');
            $bankruptcy = $bankruptcy == 'Yes' || $bankruptcy == '1'  ? 'Yes' : 'No';
            $AnyForeclosure = Yii::app()->request->getParam('bank_foreclosure')=='1'?'Yes':'No';
            $first_interest_rate = Yii::app()->request->getParam('first_interest_rate',rand(3,5));
            $first_interest_rate = round($first_interest_rate / 0.5)*.5;
            $first_interest_rate = number_format( (float) $first_interest_rate,2,'.','');
            $behind_on_payment = Yii::app()->request->getParam('num_mortgage_lates')=='0'?'not behind':'1 month late';
            $loan_amount = Yii::app()->request->getParam('loan_amount');
            $ltv_percentage = Yii::app()->request->getParam('ltv_percentage');
            $CurrentLoanType = Yii::app()->request->getParam('va_loan') == '1' ? 'VA' : 'Not Sure'; 
            $BankruptcyTime = $Time[array_rand($Time)];
            $ForeclosureTime = $Time[array_rand($Time)];
            $LoanType = $mort_type;
            $SecondMortgage = $second_mortage > 0 ? 'Yes' : 'No';
            $ApiToken = $p1 ? $p1 : '8843F529-D96F-4E94-8304-F4C24A509EA9';
            $OriginalUrl = 'https://www.elitemortgagefinder.com';
            //$OriginalUrl = Yii::app()->request->getParam('url',$url);
            $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl',$OriginalUrl);
            $Source ='Social';
            $exluded_states = ['AL','IL','MI','NY','OH','OK','WI'];
            $purchase = true;
            if($loan_amount < '100000'){
                $ping_response = 'loan amount should be more than $100,000 you sent :'.$loan_amount;
                $purchase = false;
            }else if($credit_rating > '2'){
                $ping_response = 'Credit Rating only Good/Excellent Allowed You sent : '.$CreditRating;
                $purchase = false;
            }else if($mort_type == 'Purchase' || $mort_type == 'Reverse Mortgage'){
                $ping_response = 'Mortage Type should only be Refinance Or Home Equity You sent : '.$mort_type;
                $purchase = false;
            }else if($ltv_percentage > '90'){
                $ping_response = 'Ltv should not be more than 90% You sent : '.$ltv_percentage;
                $purchase = false;
            }else if(in_array($State,$exluded_states)){
                $ping_response = 'Not Allowed States AL, IL, MI, NY, OH, OK, WI You sent : '.$State;
                $purchase = false;
            }else if(date('l')=='Sunday'){
                //|| date('G') > 20 || date('G') < 12
                $ping_response = 'No Weekends and Between 9am 5pm PST';
                $purchase = false;
            }
            $ping_request = '<?xml version="1.0" encoding="UTF-8" ?>
                        <Lead>
                            <ApiToken>'.$ApiToken.'</ApiToken>
                            <Vertical>Mortgage</Vertical>
                            <SubId>'.$SubId.'</SubId>
                            <OriginalUrl>'.$OriginalUrl.'</OriginalUrl>
                            <Source>'.$Source.'</Source>
                            <JornayaLeadId>'.$jornayaLeadId.'</JornayaLeadId>
                            <TrustedForm>'.$trustedformcerturl.'</TrustedForm>
                            <SessionLength>38</SessionLength>
                            <TcpaText>'.$TcpaText.'</TcpaText>
                            <VerifyAddress>false</VerifyAddress>
                            <ContactData>
                                <State>'.$State.'</State>
                                <ZipCode>'.$ZipCode.'</ZipCode>
                                <IpAddress>'.$IpAddress.'</IpAddress>
                            </ContactData>
                            <Person>
                                <BirthDate>'.$BirthDate.'</BirthDate>
                                <Gender>Male</Gender>
                                <MilitaryOrVeteran>'.$MilitaryOrVeteran.'</MilitaryOrVeteran>
                                <CreditRating>'.$CreditRating.'</CreditRating>
                            </Person>
                            <Mortgage>
                                <LoanType>'.$LoanType.'</LoanType>
                                <CurrentLoanType>'.$CurrentLoanType.'</CurrentLoanType>
                                <PropertyType>'.$prop_desc.'</PropertyType>
                                <PropertyUse>'.$prop_use.'</PropertyUse>
                                <PropertyValue>'.$property_value_balance.'</PropertyValue>
                                <FirstMortgageBalance>'.$first_mortage_balance.'</FirstMortgageBalance>
                                <SecondMortgage>'.$SecondMortgage.'</SecondMortgage>
                                <SecondMortgageBalance>'.$second_mortage_balance.'</SecondMortgageBalance>
                                <CashOutAmount>'.$cash_out_balance.'</CashOutAmount>
                                <AnyBankruptcy>'.$bankruptcy.'</AnyBankruptcy>
                                <BankruptcyTime>'.$BankruptcyTime.'</BankruptcyTime>
                                <AnyForeclosure>'.$AnyForeclosure.'</AnyForeclosure>
                                <ForeclosureTime>'.$ForeclosureTime.'</ForeclosureTime>
                                <FirstTimeBuyer>No</FirstTimeBuyer>
                                <PurchaseTimeFrame>'.$purchase_timeframe.'</PurchaseTimeFrame>
                                <DownPayment>'.$down_payment_bal.'</DownPayment>
                                <InterestRatePercentage>'.$first_interest_rate.'</InterestRatePercentage>
                                <TotalMortgageBalance>'.$property_value_balance.'</TotalMortgageBalance>
                                <PurchasePrice>'.$total_mort_balance.'</PurchasePrice>
                                <AnyMortgages>No</AnyMortgages>
                                <PurchaseYear>'.rand(3,15).'</PurchaseYear>
                                <BehindOnPayments>'.$behind_on_payment.'</BehindOnPayments>
                                <WhoIsYourLender>PX</WhoIsYourLender>
                                <LoanAmount>'.$loan_amount.'</LoanAmount>
                                <LoanToValue>'.$ltv_percentage.'</LoanToValue>
                                <DownPaymentAmount>1</DownPaymentAmount>
                                <FirstMortgageCalc>1</FirstMortgageCalc>
                                <SecondMortgageCalc>1</SecondMortgageCalc>
                                <PropertyValueCalc>1</PropertyValueCalc>
                            </Mortgage>
                        </Lead>';
            $class_name =  str_replace('Controller','',get_class());
            if( $purchase == true){
                $pingData['ping_request'] = $ping_request;
                $pingData['header'] = ["Content-Type: application/xml"];
                return $pingData;
            }else{
                $pingData['ping_request'] = false;
                $pingData['ping_response_filtered'] = $ping_response;
                return $pingData;
            }
        }
        
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        preg_match("/<Success>(.*)<\/Success>/", $ping_response, $success);
		if(trim($success[1]) == 'true'){
            preg_match("/<Payout>(.*)<\/Payout>/msui", $ping_response, $price);
            preg_match("/<TransactionId>(.*)<\/TransactionId>/msui", $ping_response, $confirmation_id);
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
    public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status) {
        $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        $mort_type = self::getMortgageLeadType($Mortgage_Type);
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        $CreditRating = self::getCreditRating($credit_rating);
        $property_type = Yii::app()->request->getParam('property_use');
        $prop_use = self::getPropertyType($property_type);
        $property_desc = Yii::app()->request->getParam('property_desc');
        $prop_desc = self::getPropertyDescription($property_desc);
        // === OTHER VARIABLES ====
        $first_mortage = Yii::app()->request->getParam('first_balance');
        $first_mortage_balance = self::getMortagageBalance($first_mortage);
        $second_mortage = Yii::app()->request->getParam('second_balance');
        $second_mortage_balance = self::getMortagageBalance($second_mortage);
        $additional_cash = Yii::app()->request->getParam('additional_cash');
        $cash_out_balance = self::getCashOut($additional_cash);
        $buy_timeframe = Yii::app()->request->getParam('buy_timeframe');
        $purchase_timeframe = self::purchaseTimeFrmae($buy_timeframe);
        $property_value = Yii::app()->request->getParam('property_value');
        $property_value_balance = self::getMortagageBalance($property_value);
        $estimate_value = Yii::app()->request->getParam('estimate_value',$property_value);
        $total_mort_balance = self::getMortagageBalance($estimate_value);
        $property_zip = Yii::app()->request->getParam('property_zip');
        $ZipCode = Yii::app()->request->getParam('zip',$property_zip);
        $submission_model = new Submissions();
        $city_state = $submission_model->getCityStateFromZip($ZipCode);
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $second_balance = Yii::app()->request->getParam('second_balance',$property_value);
        $estimate_value = Yii::app()->request->getParam('estimate_value',$property_value);
        // BECAUSE OF BANKRUPCY NOT ALLOWED IN LAST 5 YEARS
        $State = Yii::app()->request->getParam('property_state',$city_state['state']);
        $va_loan = Yii::app()->request->getParam('va_loan');
        $promo_code = Yii::app()->request->getParam('promo_code');
        $sub_id = Yii::app()->request->getParam('sub_id');
        $SubId = $promo_code.'_'.$sub_id;
        $first_mortage = Yii::app()->request->getParam('first_balance');
        $first_mortage_balance = self::getMortagageBalance($first_mortage);
        $second_mortage = Yii::app()->request->getParam('second_balance');
        $second_mortage_balance = self::getMortagageBalance($second_mortage);
        $buy_timeframe = Yii::app()->request->getParam('buy_timeframe');
        $purchase_timeframe = self::purchaseTimeFrmae($buy_timeframe);
        $estimate_value = Yii::app()->request->getParam('estimate_value',$property_value);
        $total_mort_balance = self::getMortagageBalance($estimate_value);
        $down_payment = Yii::app()->request->getParam('down_payment');
        $down_payment_bal = self::getDownPayment($down_payment);
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $second_balance = Yii::app()->request->getParam('second_balance',$property_value);
        $estimate_value = Yii::app()->request->getParam('estimate_value',$property_value);
        // BECAUSE OF BANKRUPCY NOT ALLOWED IN LAST 5 YEARS
        $Time= ['Less than 1 year','Less than 1 year','Less than 1 year','Less than 1 year','Less than 1 year','Less than 1 year','Less than 1 year','1 Year','2 Years','3 Years','4 Years','5 Years','More than 5 years'];
        $State = Yii::app()->request->getParam('property_state',$city_state['state']);
        $va_loan = Yii::app()->request->getParam('va_loan');
        $Source ='Social';
        $OriginalUrl = 'https://elitemortgagefinder.com';
        //$OriginalUrl = Yii::app()->request->getParam('url',$url);
        $sub_id = Yii::app()->request->getParam('sub_id');
        $promo_code = Yii::app()->request->getParam('promo_code');
        $JornayaLeadId = Yii::app()->request->getParam('universal_leadid');
        $tcpa_text = str_replace('&','',Yii::app()->request->getParam('tcpa_text'));
        $TcpaText = htmlspecialchars($tcpa_text);
        $IpAddress = Yii::app()->request->getParam('ipaddress');
        $BirthDate = date("Y-m-d",strtotime(Yii::app()->request->getParam('dob')));
        $MilitaryOrVeteran = $va_loan == '1' ? 'Yes' : 'No';
        $SubId = $promo_code.'_'.$sub_id;
        $bankruptcy = Yii::app()->request->getParam('bankruptcy');
        $bankruptcy = $bankruptcy == 'Yes' || $bankruptcy == '1'  ? 'Yes' : 'No';
        $AnyForeclosure = Yii::app()->request->getParam('bank_foreclosure')=='1'?'Yes':'No';
        $first_interest_rate = Yii::app()->request->getParam('first_interest_rate',rand(3,5));
        $first_interest_rate = round($first_interest_rate / 0.5)*.5;
        $first_interest_rate = number_format( (float) $first_interest_rate, 2, '.', '');
        $behind_on_payment = Yii::app()->request->getParam('num_mortgage_lates')=='0'?'not behind':'1 month late';
        $loan_amount = Yii::app()->request->getParam('loan_amount');
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage');
        $CurrentLoanType = Yii::app()->request->getParam('va_loan') == '1' ? 'VA' : 'Not Sure'; 
        $BankruptcyTime = $Time[array_rand($Time)];
        $ForeclosureTime = $Time[array_rand($Time)];
        $LoanType = $mort_type;
        $SecondMortgage = $second_mortage > 0 ? 'Yes' : 'No';
        $FirstName = Yii::app()->request->getParam('first_name');
        $LastName = Yii::app()->request->getParam('last_name');
        $Address = Yii::app()->request->getParam('address');
        $City = Yii::app()->request->getParam('city',$city_state['city']);
        $City = $City == '' ? 'New York' : $City;
        $Email = Yii::app()->request->getParam('email');
        $PhoneNumber = Yii::app()->request->getParam('phone');
        $DayPhoneNumber = Yii::app()->request->getParam('phone2');
        $first_name = Yii::app()->request->getParam('first_name');
        $Gender = $submission_model->getGender($first_name);
        $Gender = $Gender == 'M' ? 'Male' : 'Female';
        $trustedformcerturl = Yii::app()->request->getParam('trustedformcerturl',$OriginalUrl);
        $ApiToken = $p1 ? $p1 : '8843F529-D96F-4E94-8304-F4C24A509EA9';
        preg_match("/<TransactionId>(.*)<\/TransactionId>/msui",$ping_response,$confirmation_id);
        $post_request = '<?xml version="1.0" encoding="UTF-8" ?>
                <Lead>
                        <ApiToken>'.$ApiToken.'</ApiToken>
                        <Vertical>Mortgage</Vertical>
                        <SubId>'.$SubId.'</SubId>
                        <OriginalUrl>'.$OriginalUrl.'</OriginalUrl>
                        <Source>'.$Source.'</Source>
                        <JornayaLeadId>'.$JornayaLeadId.'</JornayaLeadId>
                        <TrustedForm>'.$trustedformcerturl.'</TrustedForm>
                        <SessionLength>38</SessionLength>
                        <TcpaText>'.$TcpaText.'</TcpaText>
                        <VerifyAddress>false</VerifyAddress>
                        <TransactionId>'.$confirmation_id[1].'</TransactionId>
                    <ContactData>
                        <FirstName>'.$FirstName.'</FirstName>
                        <LastName>'.$LastName.'</LastName>
                        <Address>'.$Address.'</Address>
                        <City>'.$City.'</City>
                        <EmailAddress>'.$Email.'</EmailAddress>
                        <PhoneNumber>'.$PhoneNumber.'</PhoneNumber>
                        <DayPhoneNumber>'.$DayPhoneNumber.'</DayPhoneNumber>
                        <State>'.$State.'</State>
                        <ZipCode>'.$ZipCode.'</ZipCode>
                        <IpAddress>'.$IpAddress.'</IpAddress>
                    </ContactData>
                    <Person>
                        <BirthDate>'.$BirthDate.'</BirthDate>
                        <Gender>'.$Gender.'</Gender>
                        <MilitaryOrVeteran>'.$MilitaryOrVeteran.'</MilitaryOrVeteran>
                        <CreditRating>'.$CreditRating.'</CreditRating>
                    </Person>
                    <Mortgage>
                        <LoanType>'.$LoanType.'</LoanType>
                            <CurrentLoanType>'.$CurrentLoanType.'</CurrentLoanType>
                            <PropertyType>'.$prop_desc.'</PropertyType>
                            <PropertyUse>'.$prop_use.'</PropertyUse>
                            <PropertyValue>'.$property_value_balance.'</PropertyValue>
                            <FirstMortgageBalance>'.$first_mortage_balance.'</FirstMortgageBalance>
                            <SecondMortgage>'.$SecondMortgage.'</SecondMortgage>
                            <SecondMortgageBalance>'.$second_mortage_balance.'</SecondMortgageBalance>
                            <CashOutAmount>'.$cash_out_balance.'</CashOutAmount>
                            <AnyBankruptcy>'.$bankruptcy.'</AnyBankruptcy>
                            <BankruptcyTime>'.$BankruptcyTime.'</BankruptcyTime>
                            <AnyForeclosure>'.$AnyForeclosure.'</AnyForeclosure>
                            <ForeclosureTime>'.$ForeclosureTime.'</ForeclosureTime>
                            <FirstTimeBuyer>No</FirstTimeBuyer>
                            <PurchaseTimeFrame>'.$purchase_timeframe.'</PurchaseTimeFrame>
                            <DownPayment>'.$down_payment_bal.'</DownPayment>
                            <InterestRatePercentage>'.$first_interest_rate.'</InterestRatePercentage>
                            <TotalMortgageBalance>'.$property_value_balance.'</TotalMortgageBalance>
                            <PurchasePrice>'.$total_mort_balance.'</PurchasePrice>
                            <AnyMortgages>No</AnyMortgages>
                            <PurchaseYear>'.rand(3,15).'</PurchaseYear>
                            <BehindOnPayments>'.$behind_on_payment.'</BehindOnPayments>
                            <WhoIsYourLender>PX</WhoIsYourLender>
                            <LoanAmount>'.$loan_amount.'</LoanAmount>
                            <LoanToValue>'.$ltv_percentage.'</LoanToValue>
                            <DownPaymentAmount>1</DownPaymentAmount>
                            <FirstMortgageCalc>1</FirstMortgageCalc>
                            <SecondMortgageCalc>1</SecondMortgageCalc>
                            <PropertyValueCalc>1</PropertyValueCalc>
                    </Mortgage>
                </Lead>';
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $header = array("Content-Type: application/xml");
        $post_response = $cm->curl($post_url,$post_request,$header);
        $time_end = CommonToolsMethods::stopwatch();
        $post_response = html_entity_decode($post_response);
        //echo '<pre>';print_r();die();
        preg_match("/<Success>(.*)<\/Success>/", $post_response, $success);
        if(trim($success[1]) == 'true'){
            $post_status = '1';
            preg_match("/<Payout>(.*)<\/Payout>/msui",$post_response,$price);
            preg_match("/<Payout>(.*)<\/Payout>/msui", $ping_response, $ping_price );
            $post_price = isset($price[1]) ? $price[1] : $ping_price[1];
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
        return $post_responses;
    }
}