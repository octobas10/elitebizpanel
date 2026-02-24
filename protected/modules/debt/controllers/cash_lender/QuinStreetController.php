<?php
class QuinStreetController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static $creditRating = [
        1=>'Excellent',
        2=>'Good',
        3=>'Fair',
        4=>'Poor',
    ];
    public static $emloymentStatus = [
        1=>'7',//Employed
        2=>'7',//Employed
        3=>'3',//Self Employed
        4=>'5',//Not Employed
        5=>'6',//Other
        6=>'6',//Other
        7=>'6',//Other
    ];
    public static $TimeAtResidence = ['Less than 1 year.','1 to 2 years','More 3 years','Less than 1 year.','1 to 2 years','More 3 years','More 3 years'];
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $domain_url = null) {
        // PING REQUEST
        $promo_code = Yii::app()->request->getParam('promo_code');
        $sub_id = Yii::app()->request->getParam('sub_id');
        if(($sub_id == '2337' ||  $sub_id == '2623' || $sub_id == '2631')){
        }else{
            $submission_model = new Submissions();
            $zip_code = Yii::app()->request->getParam('zip');
            $city_state = $submission_model->getCityStateFromZip($zip_code);
            $OriginalUrl = Yii::app()->request->getParam('url');
            $debt_amount = Yii::app()->request->getParam('debt_amount');
            if($debt_amount < 2000 OR $debt_amount > 1000000){
                $debt_amount = ['10000', '200000'][date('N') % 2];
            }
            $fields = [
                'LoanPurpose'=> 'Debt Consolidation',
                'CashOut' => Yii::app()->request->getParam('debt_amount'), 
                'Income'=> Yii::app()->request->getParam('income'),
                'CreditRating'=>self::$creditRating[Yii::app()->request->getParam('credit_rating', '1')],
                'EmploymentStatus' => self::$emloymentStatus[Yii::app()->request->getParam('employment_type', '1')],
                'OwnHome' => Yii::app()->request->getParam('is_rented')=='0' ? 'Renter' : 'Homeowner',
                'TimeAtResidence' => self::$TimeAtResidence[date('w')],
                'Email'=> Yii::app()->request->getParam('email','null'),
                'Dob' => date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))),
                'Fname' => Yii::app()->request->getParam('first_name','null'),
                'Lname' => Yii::app()->request->getParam('last_name','null'),
                'HomePhone'=>  Yii::app()->request->getParam('phone','null'),
                'Street' => Yii::app()->request->getParam('address','null'),
                'PostalCode' => Yii::app()->request->getParam('zip'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => Yii::app()->request->getParam('state',$city_state['state']),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text','Concent Text..'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid','4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1'),
                'ap_token' => Yii::app()->request->getParam('trustedformcerturl',$OriginalUrl),
                'getTYLink' => 'yes',
                'AFN' => $p1 ? $p1 : 'MindBodySoul_PLDP_Debt',
                'AF' => $p2 ? $p2 : '118164444',
                'SSN' => Yii::app()->request->getParam('ssn'),
                'AFFID' => $promo_code,
                'AFFID2' => $sub_id,
            ];
            //echo '<pre>';print_r($fields);exit;
            $purchase = true;
            $AuthorizationCode = 'Basic ZHJlZGR5:QnJzbm5yczY4Iw== Token MjAzMDY2MTA=';
            $username='UUZkUTZUWmtOVWpYdHpLNkJs';
            $password='JHdCcHdrMzFVendoYktCZWUy';
            $token='MTE4MTY0NDQ0MjMwODIwMjQ=';
            //$AuthorizationCode = "Basic $username:$password Token $token";
            /*$ipaddress = Yii::app()->request->getParam('ipaddress');
            $user_agent = Yii::app()->request->getParam('user_agent');
            $header = ["Content-Type: application/json","True-Client-IP:$ipaddress","User-Agent: $user_agent",$AuthorizationCode];*/
            $header = [
                "authorization: $AuthorizationCode",
                "content-type: application/json",
            ];
            //echo '<pre>';print_r($header);exit;
            $purchase = true;
            if($debt_amount < 10000){
                $purchase = false;
            }
            if($purchase == true){
                $pingData['ping_request'] = json_encode($fields);
                $pingData['header'] = $header;
                $pingData['ping_url'] = 'https://guidetolenders.quinstage.com/plpost.jsp';
                //$pingData['ping_url'] = 'https://securegtl.quinstreet.com/plpost.jsp';
                return $pingData;
            }else{
                $pingData['ping_request'] = false;
                return $pingData;
            }
        }
		
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
    	$result = json_decode($ping_response,TRUE);
        if (isset($result['Status']) && $result['Status']=='Success' ) {
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
    public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status) {
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
        $OriginalUrl = Yii::app()->request->getParam('url');
        $phone = Yii::app()->request->getParam('phone');
        $phone2 = Yii::app()->request->getParam('phone2');
        $ping_result = json_decode($ping_response,TRUE);
        $debt_amount = Yii::app()->request->getParam('debt_amount');
        if($debt_amount < 2000 OR $debt_amount > 1000000){
            $debt_amount = ['10000', '200000'][date('N') % 2];
        }
        $fields = [
            'LeadID' => $ping_result['LeadID'],
            'LoanPurpose'=> 'Debt Consolidation',
            'CashOut' => $debt_amount, 
            'Income'=> Yii::app()->request->getParam('income'),
            'CreditRating'=>self::$creditRating[Yii::app()->request->getParam('credit_rating', '1')],
            'EmploymentStatus' => self::$emloymentStatus[Yii::app()->request->getParam('employment_type', '1')],
            'OwnHome' => Yii::app()->request->getParam('is_rented')=='0' ? 'Renter' : 'Homeowner',
            'TimeAtResidence' => self::$TimeAtResidence[date('w')],
            'Email'=> Yii::app()->request->getParam('email'),
            'Dob' => date('m/d/Y',strtotime(Yii::app()->request->getParam('dob'))),
            'Fname' => Yii::app()->request->getParam('first_name'),
            'Lname' => Yii::app()->request->getParam('last_name'),
            'HomePhone'=>  ($phone2 == null or $phone2 == '' or $phone2 == 'null') ? $phone : $phone2,
            'PostalCode' => Yii::app()->request->getParam('zip'),
            'Street' => Yii::app()->request->getParam('address'),
            'City' => Yii::app()->request->getParam('city',$city_state['city']),
            'State' => Yii::app()->request->getParam('state',$city_state['state']),
            'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text','Concent Text..'),
            'LeadIdToken' => Yii::app()->request->getParam('universal_leadid','4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1'),
            'ap_token' => Yii::app()->request->getParam('trustedformcerturl',$OriginalUrl),
            'getTYLink' => 'yes',
            'AFN' => $p1 ? $p1 : 'MindBodySoul_PLDP_Debt',
            'AF' => $p2 ? $p2 : '118164444',
            'SSN' => Yii::app()->request->getParam('ssn'),
            'AFFID' => Yii::app()->request->getParam('promo_code'),
            'AFFID2' => Yii::app()->request->getParam('sub_id'),
        ];
        
        /* if($debt_amount >= '10000' AND $debt_amount < '15000'){
            $commission = '10';
        }else if($debt_amount >= '15000' AND $debt_amount < '20000'){
            $commission = '15';
        }else if($debt_amount >= '20000' AND $debt_amount < '25000'){
            $commission = '20';
        }else if($debt_amount >= '25000' AND $debt_amount < '30000'){
            $commission = '25';
        }else if($debt_amount >= '30000' AND $debt_amount < '40000'){
            $commission = '35';
        }else if($debt_amount >= '40000' AND $debt_amount < '50000'){
            $commission = '40';
        }else if($debt_amount >= '50000' AND $debt_amount < '60000'){
            $commission = '50';
        }else if($debt_amount >= '60000'){
            $commission = '65';
        } */
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        if($credit_rating == '1'){
            $commission = '18.00';
        }else if($credit_rating == '2'){
            $commission = '14.00';
        }else if($credit_rating == '3'){
            $commission = '4.00';
        }else if($credit_rating == '4'){
            $commission = '2.00';
        }
        //echo '<pre>';print_r($fields);exit;
        $post_request = json_encode($fields);
        $cm = new CommonMethods();
        $start_time = CommonToolsMethods::stopwatch();
        //$AuthorizationCode = 'Basic ZHJlZGR5:QnJzbm5yczY4Iw== Token MjAzMDY2MTA=';
        $username='UUZkUTZUWmtOVWpYdHpLNkJs';
        $password='JHdCcHdrMzFVendoYktCZWUy';
        $token='MTE4MTY0NDQ0MjMwODIwMjQ=';
        //$AuthorizationCode = "Basic $username:$password Token $token";
        /*$ipaddress = Yii::app()->request->getParam('ipaddress');
        $user_agent = Yii::app()->request->getParam('user_agent');
        $header = ["Content-Type: application/json","True-Client-IP:$ipaddress","User-Agent: $user_agent",$AuthorizationCode];*/
        $header = [
            "authorization: $AuthorizationCode",
            "content-type: application/json",
        ];
        $post_url = 'https://guidetolenders.quinstage.com/plpost.jsp';
        $post_response = $cm->curl($post_url,$post_request,$header);
        $time_end = CommonToolsMethods::stopwatch();
        $result = json_decode($post_response,TRUE);
        //mail('octobas@gmail.com','Debt QS Post Response','post response-->:'.$post_response);
        if (isset($result['Status']) && $result['Status']=='Success' ) {
            $post_status = '1';
            $ping_price = isset($ping_result['Commision']) ? $ping_result['Commision'] : 0;
            $post_price = isset($result['Commision']) ? $result['Commision'] : $commission;
            // OVERRIGHT COMMISSION TO POST PRICE
            //mail('octobas@gmail.com','Debt Commission From Sam(QS)','post price:'.$post_price.' Commision:'.$commission);
            $redirect_url = $result['TYPageLink'];
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