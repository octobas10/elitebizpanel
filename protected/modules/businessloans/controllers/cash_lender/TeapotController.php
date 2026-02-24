<?php
class TeapotController extends Controller
{
    public function __construct() {}
    /**
     * Create Ping Request for Lender
     */
    static $user_agent_list = ['Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1','Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36','Roku4640X/DVP-7.70 (297.70E04154A)','Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30','Mozilla/5.0 (Linux; Android 5.1; AFTS Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/41.99900.2250.0242 Safari/537.36','Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)','Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US','Mozilla/5.0 (Windows NT 10.0; Win64; x64; XBOX_ONE_ED) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393'];
    public static $creditRating = [
        0 => 'GOOD',
        1 => 'EXCELLENT',
        2 => 'GOOD',
        3 => 'FAIR',
        4 => 'POOR',
    ];
    public static $emloymentStatus = [
        0 => '6',
        1 => '7', //Employed
        2 => '7', //Employed
        3 => '3', //Self Employed
        4 => '5', //Not Employed
        5 => '6', //Other
        6 => '6', //Other
        7 => '6', //Other
    ];
    public static $paymentFrequency = [
        0 => 'BIWEEKLY',
        1 => 'WEEKLY',
        2 => 'BIWEEKLY',
        3 => 'TWICEMONTHLY',
        4 => 'MONTHLY',
    ];
    public static $employmentType = [
        0 => 'EMPLOYMENT',
        1 => 'EMPLOYMENT',
        2 => 'EMPLOYMENT',
        3 => 'SELF_EMPLOYMENT',
        4 => 'BENEFITS',
        5 => 'EMPLOYMENT',
        6 => 'EMPLOYMENT',
        7 => 'BENEFITS',
    ];
    public static $bankAccountType = [
        0 => 'CHECKING',
        1 => 'SAVING',
    ];
    public static $TimeAtResidence = ['3', '6', '9', '12', '15', '18', '21', '24', '27', '30', '36', '50', '60'];

    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $domain_url = null)
    {
        $promo_code = Yii::app()->request->getParam('promo_code');
        $sub_id = Yii::app()->request->getParam('sub_id');
        if (($promo_code <> '0')) {
            $submission_model = new Submissions();
            $zip_code = Yii::app()->request->getParam('zip');
            $city_state = $submission_model->getCityStateFromZip($zip_code);
            $user_agent_list = self::$user_agent_list;
		    $user_agent = $user_agent_list[array_rand($user_agent_list)];
            $paycheck_date1 = mktime(0,0,0,date('m'),date('d')-date('N'),date('Y'));
            $paycheck_date2 = ($paycheck_date1 + 14 * 86400);
            $fields = [
                'apiId' => $p1 ? $p1 : 'F57A10009E884447B3549F81A15F1E1E',
                'apiPassword' =>  $p2 ? $p2 : 'd34a1b0',
                'productId' => $p3 ? $p3 : '19',
                'price' => '0.01',
                'userIp' => Yii::app()->request->getParam('ipaddress'),
                'userAgent' => Yii::app()->request->getParam('user_agent') ?: $user_agent,
                'activeMilitary' => 'NO',
                'address' => Yii::app()->request->getParam('address'),
                'consentEmailSms' => 'NO',
                'dob' => Yii::app()->request->getParam('dob'),
                'email' => Yii::app()->request->getParam('email'),
                'firstName' => Yii::app()->request->getParam('first_name',null),
                'homePhone' => Yii::app()->request->getParam('phone',null),
                'incomeNetMonthly' =>  Yii::app()->request->getParam('income'),
                'incomePaymentFrequency' => self::$paymentFrequency[Yii::app()->request->getParam('payment_frequency', 1)],
                'incomeType' => self::$employmentType[Yii::app()->request->getParam('employment_type', 1)],
                'lastName' => Yii::app()->request->getParam('last_name',null),
                'loanAmount' => Yii::app()->request->getParam('how_much_want_borrow', '100000') ?: '100000',
                'ssn' => Yii::app()->request->getParam('ssn', null),
                'zip' => Yii::app()->request->getParam('zip', null),
                'DebtAmount' => Yii::app()->request->getParam('debt_amount', '100000') ?: '100000',
                'MonthlyPayment' => 'Yes',
                'addressLengthMonths' => self::$TimeAtResidence[date('g')],
                'bankAba' => Yii::app()->request->getParam('bank_aba', null),
                'bankAccountLengthMonths' => Yii::app()->request->getParam('bank_length_month', '30'),
                'bankAccountNumber' => Yii::app()->request->getParam('bank_account_number', null),
                'bankAccountType' => self::$bankAccountType[Yii::app()->request->getParam('bank_account_type',['CHECKING', 'SAVING'][date('N') % 2])],
                'bankDirectDeposit' => Yii::app()->request->getParam('direct_deposit', 1) == '1' ? 'YES' : 'NO',
                'bankName' => Yii::app()->request->getParam('bank_name', 'NA'),
                'bankPhone' =>Yii::app()->request->getParam('work_phone', 8888888888),
                'cellPhone' => Yii::app()->request->getParam('work_phone', 8888888888),
                'city' => $city_state['city'],
                'coApplicant' => 'NO',
                'coApplicantIncome' => null,
                'comment' => Yii::app()->request->getParam('comments', null),
                'contactTime' => 'EVENING',
                'creditScore' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '1')],
                'debtType' => 'OTHER',
                'driversLicenseNumber' => Yii::app()->request->getParam('drivers_license_number', rand(11111111,999999999)),
                'driversLicenseState' => Yii::app()->request->getParam('drivers_license_state') ?: $city_state['state'],
                'incomeNextDate1' => Yii::app()->request->getParam('paycheck_date1') ?: $paycheck_date1,
                'incomeNextDate2' => Yii::app()->request->getParam('paycheck_date2') ?: $paycheck_date2,
                'incomeOther' => Yii::app()->request->getParam('other_income_amount', 1000) ?: '1000',
                'isCitizen' => 'YES',
                'jobTitle' => Yii::app()->request->getParam('job_title', 'Seller'),
                'jornayaLeadId' => Yii::app()->request->getParam('universal_leadid', null),
                'leadid_token' => null,
                'loanReason' => 'MOVING',
                'loanTerm' => '12',
                'ownHome' => 'YES',
                'rentOrMortgagePayment' => Yii::app()->request->getParam('rent_mortgage_payment', 1000) ?: '1000',
                'state' => $city_state['state'],
                'trustedFormURL' => Yii::app()->request->getParam('trustedformcerturl', null),
                'vehicleTitle' => null,
                'workCompanyName' => Yii::app()->request->getParam('company_name', 'NA'),
                'workPhone' =>  Yii::app()->request->getParam('work_phone', 5555555555),
                'workTimeAtEmployer' => self::$TimeAtResidence[date('w')],
                'income_source' => 'Full Time Employed',
                'consentSMS' => 'YES',
                'FBP' => '',
                'FBC' => $sub_id,
                //'testMode' => '1',
                'clickid' => Yii::app()->session['affiliate_trans_id'],
                'source' => $promo_code,
                'webSiteUrl' => Yii::app()->request->getParam('url'),
            ];
            echo '<pre>';print_r($fields);exit;
            $purchase = true;
            $header = ["content-type: application/json"];
            $purchase = true;
            if ($debt_amount < 10000) {
                $purchase = false;
            }
            if ($purchase == true) {
                $pingData['ping_request'] = json_encode($fields);
                $pingData['header'] = $header;
                return $pingData;
            } else {
                $pingData['ping_request'] = false;
                return $pingData;
            }
        }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response)
    {
        $result = json_decode($ping_response, TRUE);
        if (isset($result['status']) && $result['status_text'] == 'sold') {
            $ping_price = isset($result['Commision']) ? $result['Commision'] : 0;
            $ping_response_info['ping_price'] = trim($ping_price);
            $ping_response_info['ping_status'] = '1';
            $ping_response_info['confirmation_id'] = $result['LeadID'];
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
        $sub_id = Yii::app()->request->getParam('sub_id');
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $user_agent_list = self::$user_agent_list;
        $user_agent = $user_agent_list[array_rand($user_agent_list)];
        $paycheck_date1 = mktime(0,0,0,date('m'),date('d')-date('N'),date('Y'));
        $paycheck_date2 = ($paycheck_date1 + 14 * 86400);

        $fields = [
            'apiId' => $p1 ? $p1 : 'F57A10009E884447B3549F81A15F1E1E',
            'apiPassword' =>  $p2 ? $p2 : 'd34a1b0',
            'productId' => $p3 ? $p3 : '19',
            'price' => '0.01',
            'userIp' => Yii::app()->request->getParam('ipaddress'),
            'userAgent' => Yii::app()->request->getParam('user_agent') ?: $user_agent,
            'activeMilitary' => 'NO',
            'address' => Yii::app()->request->getParam('address'),
            'consentEmailSms' => 'NO',
            'dob' => Yii::app()->request->getParam('dob'),
            'email' => Yii::app()->request->getParam('email'),
            'firstName' => Yii::app()->request->getParam('first_name', null),
            'homePhone' => Yii::app()->request->getParam('phone', null),
            'incomeNetMonthly' =>  Yii::app()->request->getParam('income'),
            'incomePaymentFrequency' => self::$paymentFrequency[Yii::app()->request->getParam('payment_frequency', 1)],
            'incomeType' => self::$employmentType[Yii::app()->request->getParam('employment_type', 1)],
            'lastName' => Yii::app()->request->getParam('last_name', null),
            'loanAmount' => Yii::app()->request->getParam('how_much_want_borrow', '100000') ?: '100000',
            'ssn' => Yii::app()->request->getParam('ssn', null),
            'zip' => Yii::app()->request->getParam('zip', null),
            'DebtAmount' =>Yii::app()->request->getParam('debt_amount', '100000') ?: '100000',
            'MonthlyPayment' => 'Yes',
            'addressLengthMonths' => self::$TimeAtResidence[date('g')],
            'bankAba' => Yii::app()->request->getParam('bank_aba', null),
            'bankAccountLengthMonths' => Yii::app()->request->getParam('bank_length_month', '30'),
            'bankAccountNumber' => Yii::app()->request->getParam('bank_account_number', null),
            'bankAccountType' => self::$bankAccountType[Yii::app()->request->getParam('bank_account_type',['CHECKING', 'SAVING'][date('N') % 2])],
            'bankDirectDeposit' => Yii::app()->request->getParam('direct_deposit', 1) == '1' ? 'YES' : 'NO',
            'bankName' => Yii::app()->request->getParam('bank_name', 'NA'),
            'bankPhone' =>Yii::app()->request->getParam('work_phone', 8888888888),
            'cellPhone' => Yii::app()->request->getParam('work_phone', 8888888888),
            'city' => $city_state['city'],
            'coApplicant' => 'NO',
            'coApplicantIncome' => null,
            'comment' => Yii::app()->request->getParam('comments', null),
            'contactTime' => 'EVENING',
            'creditScore' => self::$creditRating[Yii::app()->request->getParam('credit_rating', '1')],
            'debtType' => 'OTHER',
            'driversLicenseNumber' => Yii::app()->request->getParam('drivers_license_number', rand(11111111,999999999)),
            'driversLicenseState' => Yii::app()->request->getParam('drivers_license_state') ?: $city_state['state'],
            'incomeNextDate1' => Yii::app()->request->getParam('paycheck_date1') ?: $paycheck_date1,
            'incomeNextDate2' => Yii::app()->request->getParam('paycheck_date2') ?: $paycheck_date2,
            'incomeOther' => Yii::app()->request->getParam('other_income_amount', 1000) ?: '1000',
            'isCitizen' => 'YES',
            'jobTitle' => Yii::app()->request->getParam('job_title', null),
            'jornayaLeadId' => Yii::app()->request->getParam('universal_leadid', null),
            'leadid_token' => null,
            'loanReason' => 'MOVING',
            'loanTerm' => '12',
            'ownHome' => 'YES',
            'rentOrMortgagePayment' => Yii::app()->request->getParam('rent_mortgage_payment', 1000) ?: '1000',
            'state' => $city_state['state'],
            'trustedFormURL' => Yii::app()->request->getParam('trustedformcerturl', null),
            'vehicleTitle' => null,
            'workCompanyName' => Yii::app()->request->getParam('company_name', 'NA'),
            'workPhone' =>  Yii::app()->request->getParam('work_phone', 5555555555),
            'workTimeAtEmployer' => self::$TimeAtResidence[date('w')],
            'income_source' => 'Full Time Employed',
            'consentSMS' => 'YES',
            'FBP' => '',
            'FBC' => $sub_id,
            //'testMode' => '1',
            'clickid' => Yii::app()->session['affiliate_trans_id'],
            'source' => $promo_code,
            'webSiteUrl' => Yii::app()->request->getParam('url'),
        ];
        //echo '<pre>';print_r($fields);exit;
        $post_request = json_encode($fields);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $header = ["content-type: application/json"];
        $post_response = $cm->curl($post_url, $post_request, $header);
        $time_end = CommonToolsMethods::stopwatch();
        $result = json_decode($post_response, TRUE);
        //mail('octobas@gmail.com','Debt QS Post Response','post response-->:'.$post_response);
        if (isset($result['status']) && $result['status_text'] == 'sold') {
            $post_status = '1';
            $post_price = isset($result['price']) ? $result['price'] : 0;
            $redirect_url = $result['redirect_url'];
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
