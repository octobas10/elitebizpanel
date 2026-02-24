<?php
class PXController extends Controller
{
    public function __construct() {}
    /**
     * Create Ping Request for Lender
     */
    public static function getHost($url, $accept_www = false)
    {
        $url = str_replace(["%3A", "%2F"], [':', '/'], $url);
        $URIs = parse_url(trim($url));
        $host = !empty($URIs['host']) ? $URIs['host'] : explode('/', $URIs['path'])[0];
        return $accept_www == false ? str_ireplace('www.', '', $host) : $host;
    }
    public static $not_allowed = [];
    public static $creditRating = [
        1 => 'Excellent',
        2 => 'Good',
        3 => 'Some Problems',
        4 => 'Major Problems',
    ];
    public static function getDebtAmount($debt_amount)
    {
        $debtamount = "$20,001 - 25,000";
        if ($debt_amount >= "100" && $debt_amount < "500") {
            $debtamount = "$501 - 1,000";
        } else if ($debt_amount >= "1000" && $debt_amount <= "2500") {
            $debtamount = "$1,001 - 2,500";
        } else if ($debt_amount >= "2501" && $debt_amount < "5000") {
            $debtamount = "$2,501 - 5,000";
        } else if ($debt_amount >= "5001" && $debt_amount < "10000") {
            $debtamount = "$5,001 - 10,000";
        } else if ($debt_amount >= "10001" && $debt_amount <= "12500") {
            $debtamount = "$10,001 - 12,500";
        } else if ($debt_amount >= "12501" && $debt_amount <= "15000") {
            $debtamount = "$12,501 - 15,000";
        } else if ($debt_amount >= "15001" && $debt_amount <= "17500") {
            $debtamount = "$15,001 - 17,500";
        } else if ($debt_amount >= "175001" && $debt_amount <= "20000") {
            $debtamount = "$17,501 - 20,000";
        } else if ($debt_amount >= "20001" && $debt_amount <= "25000") {
            $debtamount = "$20,001 - 25,000";
        } else if ($debt_amount >= "25001" && $debt_amount <= "30000") {
            $debtamount = "$25,001 - 30,000";
        } else if ($debt_amount >= "30001" && $debt_amount <= "35000") {
            $debtamount = "$30,001 - 35,000";
        } else if ($debt_amount >= "35001" && $debt_amount <= "40000") {
            $debtamount = "$35,001 - 40,000";
        } else if ($debt_amount >= "40001" && $debt_amount <= "45000") {
            $debtamount = "$40,001 - 45,000";
        } else if ($debt_amount >= "45001" && $debt_amount <= "50000") {
            $debtamount = "$45,001 - 50,000";
        } else if ($debt_amount >= "50001") {
            $debtamount = "$50,001 - 60,000";
        }
        return $debtamount;
    }

    public static function hourtoDebtAmount (){
        $hour_debt_amount = [1=>'15000',2=>'16000',3=>'17000',4=>'18000',5=>'19000',6=>'20000',7=>'21000',8=>'22000',9=>'23000',10=>'24000',11=>'25000',12=>'26000',13=>'27000',14=>'28000',15=>'29000',16=>'30000',17=>'31000',18=>'32000',19=>'21000',20=>'22000',21=>'23000',22=>'24000',23=>'25000',24=>'26000'];
        return $hour_debt_amount[(int)date('H')];
    }
   
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null)
    {
        $promo_code = Yii::app()->request->getParam('promo_code');
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $dob = date('Y-m-d', strtotime(Yii::app()->request->getParam('dob')));
        //$debt_amount = Yii::app()->request->getParam('debt_amount');
        $debt_amount = self::hourtoDebtAmount();
        if ($promo_code != 9) {
            $pingData = [];
            $tcpa_text = 'By clicking GET YOUR QUOTE, I agree to the Terms of Service and Privacy Policy, I authorize home improvement companies, their contractors and partner companies to contact me about home improvement offers by phone calls and text messages to the number I provided. I authorize that these marketing communications may be delivered to me using an automatic telephone dialing system or by prerecorded message. I understand that my consent is not a condition of purchase, and I may revoke that consent at any time. Mobile and data charges may apply. California Residents.';
            $user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.94 Chrome/37.0.2062.94 Safari/537.36';
            $fields = [
                "ApiToken" => $p1 ? $p1 : "F20B087B-F0D5-4407-8A3F-7BF1847FE00C",
                "Vertical" => $p2 ? $p2 : "Debtconsolidation",
                "SubId" => Yii::app()->request->getParam('sub_id', 'FB1'),
                "UserAgent" => Yii::app()->request->getParam('user_agent', $user_agent),
                "OriginalUrl" => Yii::app()->request->getParam('url', 'https://elitedebtcleaners.com'),
                "Source" => "Social",
                "JornayaLeadId" => Yii::app()->request->getParam('universal_leadid', ''),
                "TrustedForm" => Yii::app()->request->getParam('trustedformcerturl', ''),
                "SessionLength" => "38",
                "TcpaText" => Yii::app()->request->getParam('tcpa_text', $tcpa_text),
                "VerifyAddress" => "false",
                "SellResponseURL" => Yii::app()->request->getParam('url', 'https://elitedebtcleaners.com'),
                "OriginalCreationDate" => Yii::app()->request->getParam('datetime_stamp', date('Y-m-d H:i:s')),
                "ContactData" => [
                    "FirstName" => Yii::app()->request->getParam('first_name', null),
                    "LastName" => Yii::app()->request->getParam('last_name', null),
                    'City' => $city_state['city'],
                    'State' => $city_state['state'],
                    'ZipCode' => Yii::app()->request->getParam('zip'),
                    'IpAddress' => Yii::app()->request->getParam('ipaddress'),
                ],
                "Person" => [
                    "FirstName" => Yii::app()->request->getParam('first_name', null),
                    "LastName" => Yii::app()->request->getParam('last_name', null),
                    "Gender" => Yii::app()->request->getParam('gender') == 'M' ? 'Male' : 'Female',
                    "BirthDate" => $dob,
                    'CreditRating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '2')],
                    "CreditScore" => "850",
                    "MilitaryOrVeteran" => "No",
                    "BestTimeToCall" => "Morning",
                    "DriversLicenseState" => $city_state['state'],
                    "OwnRented" => Yii::app()->request->getParam('is_rented') == '0' ? 'Rented' : 'Own',
                    "YearsAtResidence" => "5",
                    "MonthsAtResidence" => "0",
                    "Job" => [
                        "YearsEmployedAtCurrentCompany" => "5"
                    ]
                ],
                "PersonalLoan" => [
                    "DebtAmount" => self::getDebtAmount($debt_amount),
                    "RawLoanAmount" => $debt_amount,
                    "LoanAmount" => self::getDebtAmount($debt_amount),
                    "GrossMonthlyIncome" => Yii::app()->request->getParam('income', 2500),
                    "IncomeType" => "Employed",
                    "ExtraInfo" => "",
                    "LoanPurpose" => "Debt Settlement",
                ]
            ];
            $purchase = true;
            $url = Yii::app()->request->getParam('url');
            if (in_array(self::getHost($url), self::$not_allowed)) {
                $purchase = false;
            }
            if ($purchase == true) {
                $pingData['ping_request'] = json_encode($fields);
                //$pingData['ping_request'] = $field_json;
                $pingData['header'] = ["Content-Type: application/json"];
            } else {
                $pingData['ping_request'] = false;
            }
            return $pingData;
        }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response)
    {
        preg_match("/<Success>(.*)<\/Success>/", $ping_response, $success);
        if (trim($success[1]) == 'true') {
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
    public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status)
    {
        $promo_code = Yii::app()->request->getParam('promo_code');
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $dob = date('Y-m-d', strtotime(Yii::app()->request->getParam('dob')));
        //$debt_amount = Yii::app()->request->getParam('debt_amount');
        $debt_amount = self::hourtoDebtAmount();
        //preg_match("/<TransactionId>(.*)<\/TransactionId>/msui", $ping_response, $confirmation_id);
        $xml = simplexml_load_string($ping_response);
        $transactionId = (string)$xml->TransactionId;
        //$ping_id = $confirmation_id[1] ? $confirmation_id[1] : $confirmation_id[0];
        if ($promo_code != 0) {
            $tcpa_text = 'By clicking GET YOUR QUOTE, I agree to the Terms of Service and Privacy Policy, I authorize home improvement companies, their contractors and partner companies to contact me about home improvement offers by phone calls and text messages to the number I provided. I authorize that these marketing communications may be delivered to me using an automatic telephone dialing system or by prerecorded message. I understand that my consent is not a condition of purchase, and I may revoke that consent at any time. Mobile and data charges may apply. California Residents.';
            $user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.94 Chrome/37.0.2062.94 Safari/537.36';
            $fields = [
                "TransactionId" => $transactionId,
                "ApiToken" => $p1 ? $p1 : "F20B087B-F0D5-4407-8A3F-7BF1847FE00C",
                "Vertical" => $p2 ? $p2 : "Debtconsolidation",
                "SubId" => Yii::app()->request->getParam('sub_id', 'FB1'),
                "UserAgent" => Yii::app()->request->getParam('user_agent', $user_agent),
                "OriginalUrl" => Yii::app()->request->getParam('url', 'https://elitedebtcleaners.com'),
                "Source" => "Social",
                "JornayaLeadId" => Yii::app()->request->getParam('universal_leadid', ''),
                "TrustedForm" => Yii::app()->request->getParam('trustedformcerturl', 'https://elitedebtcleaners.com'),
                "SessionLength" => "38",
                "TcpaText" => Yii::app()->request->getParam('tcpa_text', $tcpa_text),
                "VerifyAddress" => "false",
                "SellResponseURL" => Yii::app()->request->getParam('url', 'https://elitedebtcleaners.com'),
                "OriginalCreationDate" => Yii::app()->request->getParam('datetime_stamp', date('Y-m-d H:i:s')),
                "ContactData" => [
                    "FirstName" => Yii::app()->request->getParam('first_name'),
                    "LastName" => Yii::app()->request->getParam('last_name'),
                    "Address" => Yii::app()->request->getParam('address'),
                    "EmailAddress" => Yii::app()->request->getParam('email'),
                    "PhoneNumber" => Yii::app()->request->getParam('phone'),
                    "DayPhoneNumber" => Yii::app()->request->getParam('phone2'),
                    'City' => $city_state['city'],
                    'State' => $city_state['state'],
                    'ZipCode' => Yii::app()->request->getParam('zip'),
                    'IpAddress' => Yii::app()->request->getParam('ipaddress'),
                ],
                "Person" => [
                    "FirstName" => Yii::app()->request->getParam('first_name'),
                    "LastName" => Yii::app()->request->getParam('last_name'),
                    "Gender" => Yii::app()->request->getParam('gender') == 'M' ? 'Male' : 'Female',
                    "BirthDate" => $dob,
                    'CreditRating' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '2')],
                    "CreditScore" => "850",
                    "MilitaryOrVeteran" => "No",
                    "BestTimeToCall" => "Morning",
                    "DriversLicenseState" => $city_state['state'],
                    "OwnRented" => Yii::app()->request->getParam('is_rented') == '0' ? 'Rented' : 'Own',
                    "YearsAtResidence" => "5",
                    "MonthsAtResidence" => "0",
                    "Job" => [
                        "YearsEmployedAtCurrentCompany" => "5"
                    ]
                ],
                "PersonalLoan" => [
                    "DebtAmount" => self::getDebtAmount($debt_amount),
                    "RawLoanAmount" => $debt_amount,
                    "LoanAmount" => self::getDebtAmount($debt_amount),
                    "GrossMonthlyIncome" => Yii::app()->request->getParam('income', 2500),
                    "IncomeType" => "Employed",
                    "LoanPurpose" => "Debt Settlement",
                ]
            ];
            $post_request = json_encode($fields);
            //echo '<pre>';print_r($post_request);
            $cm = new CommonMethods();
            $start_time = CommonToolsMethods::stopwatch();
            //$header = ["application/x-www-form-urlencoded"];
            $header = ["Content-Type: application/json"];
            $post_response = $cm->curl($post_url, $post_request, $header);
            $time_end = CommonToolsMethods::stopwatch();
            preg_match("/<Success>(.*)<\/Success>/", $post_response, $success);
            if (trim($success[1]) == 'true') {
                $post_status = '1';
                preg_match("/<Payout>(.*)<\/Payout>/msui", $post_response, $price);
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
            return $post_responses;
        }
    }
}
