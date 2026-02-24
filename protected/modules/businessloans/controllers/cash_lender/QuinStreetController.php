<?php
class QuinStreetController extends Controller
{
    public function __construct() {}
    /**
     * Create Ping Request for Lender
     */
    public static $creditRating = [
        1 => 'Excellent',
        2 => 'Good',
        3 => 'Fair',
        4 => 'Poor',
    ];
    public static $emloymentStatus = [
        1 => '7', //Employed
        2 => '7', //Employed
        3 => '3', //Self Employed
        4 => '5', //Not Employed
        5 => '6', //Other
        6 => '6', //Other
        7 => '6', //Other
    ];
    public static $howLongInBusiness = [
        1 => '2',
        2 => '4',
        3 => '7',
        4 => '10',
        5 => '15',
        6 => '20',
        7 => '25',
    ];
    public static $TimeAtResidence = ['Less than 1 year.', '1 to 2 years', 'More 3 years', 'Less than 1 year.', '1 to 2 years', 'More 3 years', 'More 3 years'];

    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $domain_url = null)
    {
        // PING REQUEST
        $promo_code = Yii::app()->request->getParam('promo_code');
        if (($promo_code <> '0')) {
            $submission_model = new Submissions();
            $zip_code = Yii::app()->request->getParam('zip');
            $city_state = $submission_model->getCityStateFromZip($zip_code);
            $debt_amount = Yii::app()->request->getParam('debt_amount');
            $the_year = date('Y') - Yii::app()->request->getParam('how_long_in_business', 1);
            $howLongInBusiness = date('m/d/Y', mktime(0, 0, 0, rand(1, 11), rand(1, 10), $the_year));
            $fields = [
                "LoanPurpose" => "Business",
                "CashOut" => Yii::app()->request->getParam('debt_amount'),
                "Income" => Yii::app()->request->getParam('income'),
                "CreditRating" => self::$creditRating[Yii::app()->request->getParam('credit_rating', '1')],
                "EmploymentStatus" => self::$emloymentStatus[Yii::app()->request->getParam('employment_type', '1')],
                "Dob" => date('m/d/Y', strtotime(Yii::app()->request->getParam('dob'))),
                "Email" => Yii::app()->request->getParam('email', 'null'),
                "Fname" =>  Yii::app()->request->getParam('first_name', 'null'),
                "Lname" =>  Yii::app()->request->getParam('last_name', 'null'),
                "PostalCode" => Yii::app()->request->getParam('zip'),
                "Street" => Yii::app()->request->getParam('address', 'null'),
                "City" => Yii::app()->request->getParam('city', $city_state['city']),
                "State" => Yii::app()->request->getParam('state', $city_state['state']),
                "OwnHome" => Yii::app()->request->getParam('is_rented') == '0' ? 'Renter' : 'Homeowner',
                "TimeAtResidence" => self::$TimeAtResidence[date('w')],
                "HomePhone" =>  Yii::app()->request->getParam('phone', 'null'),
                "AID" => "104523",
                "AFN" => $p1 ? $p1 : 'MindBodySoul_PLDP_BL',
                "AF" =>  $p2 ? $p2 : '119164644',
                "PhoneConsentLang" =>  Yii::app()->request->getParam('tcpa_text', 'Concent Text..'),
                "getTYLink" => "yes",
                "SSN" => Yii::app()->request->getParam('ssn'),
                "rtno" => "246282611",
                "acno" => "10009867856",
                "bknm" => "",
                "hdd" => "No",
                "ProfitableBusiness" => "Yes",
                "CompanyName" => Yii::app()->request->getParam('company_name', null),
                "StartDate" => $howLongInBusiness,
                "HasBankAccount" => "Yes",
                "BusinessLegalEntityType" => "sole_proprietorship",
                "CrediCardDebtAmount" => ["1000","2000","3000","4000","5000","6000","7000"][date('w')],
                "PLBankruptcyHistory" => "No",
                "AcceptCreditCard" => "No"
            ];
            //echo '<pre>';print_r($fields);exit;
            $purchase = true;
            $AuthorizationCode = 'Basic UUZkUTZUWmtOVWpYdHpLNkJs:JHdCcHdrMzFVendoYktCZWUy Token MTE5MTY0NjQ0MjYwODIwMjU=';
            /* $username='QFdQ6TZkNUjXtzK6Bl';
            $password='$wBpwk31UzwhbKBee2';
            $token='MTE5MTY0NjQ0MjYwODIwMjU=';
            $AuthorizationCode = "Basic $username:$password Token $token"; */
            $header = [
                "authorization: $AuthorizationCode",
                "content-type: application/json",
            ];
            //echo '<pre>';print_r($header);exit;
            $purchase = true;
            if ($debt_amount < 10000) {
                $purchase = false;
            }
            if ($purchase == true) {
                $pingData['ping_request'] = json_encode($fields);
                $pingData['header'] = $header;
                //$pingData['ping_url'] = 'https://guidetolenders.quinstage.com/plpost.jsp';
                $pingData['ping_url'] = 'https://securegtl.quinstreet.com/plpost.jsp';
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
        if (isset($result['Status']) && $result['Status'] == 'Success') {
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
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $ping_result = json_decode($ping_response, TRUE);
        $the_year = date('Y') - Yii::app()->request->getParam('how_long_in_business', 1);
        $howLongInBusiness = date('m/d/Y', mktime(0, 0, 0, rand(1, 11), rand(1, 10), $the_year));
        $fields = [
                "LeadID" => $ping_result['LeadID'],
                "DataCaptureKey" => $ping_result['LeadID'], //Yii::app()->session['affiliate_trans_id'],
                "LoanPurpose" => "Business",
                "CashOut" => Yii::app()->request->getParam('debt_amount'),
                "Income" => Yii::app()->request->getParam('income'),
                "CreditRating" => self::$creditRating[Yii::app()->request->getParam('credit_rating', '1')],
                "EmploymentStatus" => self::$emloymentStatus[Yii::app()->request->getParam('employment_type', '1')],
                "Dob" => date('m/d/Y', strtotime(Yii::app()->request->getParam('dob'))),
                "Email" => Yii::app()->request->getParam('email', 'null'),
                "Fname" =>  Yii::app()->request->getParam('first_name', 'null'),
                "Lname" =>  Yii::app()->request->getParam('last_name', 'null'),
                "PostalCode" => Yii::app()->request->getParam('zip'),
                "Street" => Yii::app()->request->getParam('address', 'null'),
                "City" => Yii::app()->request->getParam('city', $city_state['city']),
                "State" => Yii::app()->request->getParam('state', $city_state['state']),
                "OwnHome" => Yii::app()->request->getParam('is_rented') == '0' ? 'Renter' : 'Homeowner',
                "TimeAtResidence" => self::$TimeAtResidence[date('w')],
                "HomePhone" =>  Yii::app()->request->getParam('phone', 'null'),
                "AID" => Yii::app()->request->getParam('promo_code'),
                "AFN" => $p1 ? $p1 : 'MindBodySoul_PLDP_BL',
                "AF" =>  $p2 ? $p2 : '119164644',
                "PhoneConsentLang" =>  Yii::app()->request->getParam('tcpa_text', 'Concent Text..'),
                "getTYLink" => "yes",
                "SSN" => Yii::app()->request->getParam('ssn'),
                "rtno" => "246282611",
                "acno" => "10009867856",
                "bknm" => "",
                "hdd" => "No",
                "ProfitableBusiness" => "Yes",
                "CompanyName" => Yii::app()->request->getParam('company_name', null),
                "StartDate" => $howLongInBusiness,
                "HasBankAccount" => "Yes",
                "BusinessLegalEntityType" => "sole_proprietorship",
                "CrediCardDebtAmount" => ["1000","2000","3000","4000","5000","6000","7000"][date('w')],
                "PLBankruptcyHistory" => "No",
                "AcceptCreditCard" => "No"
            ];
        $credit_rating = Yii::app()->request->getParam('credit_rating',1);
        if ($credit_rating == '1') {
            $commission = '10.00';
        } else if ($credit_rating == '2') {
            $commission = '8.00';
        } else if ($credit_rating == '3') {
            $commission = '4.00';
        } else if ($credit_rating == '4') {
            $commission = '2.00';
        }
        //echo '<pre>';print_r($fields);exit;
        $post_request = json_encode($fields);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        $AuthorizationCode = 'Basic UUZkUTZUWmtOVWpYdHpLNkJs:JHdCcHdrMzFVendoYktCZWUy Token MTE5MTY0NjQ0MjYwODIwMjU=';
        /* $username='QFdQ6TZkNUjXtzK6Bl';
        $password='$wBpwk31UzwhbKBee2';
        $token='MTE5MTY0NjQ0MjYwODIwMjU=';
        $AuthorizationCode = "Basic $username:$password Token $token"; */
        $header = [
            "authorization: $AuthorizationCode",
            "content-type: application/json",
        ];
        //$post_url = 'https://guidetolenders.quinstage.com/plpost.jsp';
        $post_response = $cm->curl($post_url, $post_request, $header);
        $time_end = CommonToolsMethods::stopwatch();
        $result = json_decode($post_response, TRUE);

        if (isset($result['Status']) && $result['Status'] == 'Success') {
            $post_status = '1';
            $post_price = isset($result['Commision']) ? $result['Commision'] : $commission;
            // OVERRIGHT COMMISSION TO POST PRICE
            //mail('octobas@gmail.com','Debt Commission From Sam(QS)','post price:'.$post_price.' Commision:'.$commission);
            $redirect_url = $result['TYPageLink'];
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
