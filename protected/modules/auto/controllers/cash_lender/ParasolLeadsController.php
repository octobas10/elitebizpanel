<?php
class ParasolLeadsController extends Controller {
	public static $user_agent_list = ['Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246','Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1','Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36','Roku4640X/DVP-7.70 (297.70E04154A)','Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30','Mozilla/5.0 (Linux; Android 5.1; AFTS Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/41.99900.2250.0242 Safari/537.36','Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)','Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US','Mozilla/5.0 (Windows NT 10.0; Win64; x64; XBOX_ONE_ED) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393'];

	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$UNIVERSAL_LEADID = Yii::app()->request->getParam('universal_leadid');
		$OfferID=!empty($p2) ? $p2 : '13502';
		$SOURCE_ID = Yii::app()->request->getParam('url','www.eliteautocash.com');
		$SOURCEID = Yii::app()->request->getParam('promo_code');
		$ZIP_POSTAL_CODE = Yii::app()->request->getParam('zip');
		$GROSS_MONTHLY_INCOME = Yii::app()->request->getParam('monthly_income');
		$SSN = Yii::app()->request->getParam('ssn');
		$SSN = substr($SSN,0,3).'-'.substr($SSN,3,2).'-'.substr($SSN,5,4);
		$USER_AGENT='Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36';
		$TCPA_TEXT ='By entering my information, I have read and agree to the practices';
		$dateformat = date('Y-m-d').'T'.date('H:i:s').'Z';
		$fields = '<?xml version="1.0" encoding="UTF-8"?>
					<AutoFinanceRequest>
						<Meta>
							<OriginallyCreated>'.$dateformat.'</OriginallyCreated>
							<OfferID>'.$OfferID.'</OfferID>
							<SourceID>'.$SOURCEID.'</SourceID>';
							if($UNIVERSAL_LEADID !="" AND $UNIVERSAL_LEADID > '0'){
								$fields .= '<LeadIDCode>'.$UNIVERSAL_LEADID.'</LeadIDCode>';
							}
							$fields .= '<TCPACompliant>true</TCPACompliant>
							<UserAgent>'.$USER_AGENT.'</UserAgent>
							<LandingPageURL>https://www.eliteautocash.com</LandingPageURL>
							<TCPAConsentText>'.$TCPA_TEXT.'</TCPAConsentText>
						</Meta>
						<Contact>
							<PhoneLastFour></PhoneLastFour>
							<ZipCode>'.$ZIP_POSTAL_CODE.'</ZipCode>
						</Contact>
						<Data>
							<SSN>'.$SSN.'</SSN>
							<Income>'.$GROSS_MONTHLY_INCOME.'</Income>
						</Data>
					</AutoFinanceRequest>';

		$pingData['ping_request'] = $fields;
		$token = $p2 ? $p2 : '0bbd700c4f770e6918e348d3551cbdfc49f3199c';
		$pingData['header'] = ["Authorization: Token $token","Content-Type: application/xml"];
		//echo '<pre>';print_r($pingData);exit;
        return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		$ping_response = json_decode($ping_response);
		if (trim($ping_response->status) == 'success'){
			$ping_price = isset($ping_response->price) ? $ping_response->price : 0;
			$confirmation_id = $ping_response->auth_code;
			$ping_response_info['ping_price'] = trim($ping_price);
			$ping_response_info['ping_status'] = '1';
			$ping_response_info['confirmation_id'] = $confirmation_id;
		}else{
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
	public static function sendPostData($p1,$p2,$p3,$ping_response,$post_url,$status){
		$ping_response = json_decode($ping_response);
		if($status == 1 || $status == '1'){
			$confirmation_id = $ping_response->auth_code;
			$PingId = $confirmation_id;
		}else{
			$PingId = $ping_response;
		}
		$submission_model = new Submissions();
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		
		$loan_term = array('36','48','60','72','84');
		$loan_term_key = array_rand($loan_term);
		$TCPA_TEXT ='By entering my information, I have read and agree to the practices';
		$UNIVERSAL_LEADID = Yii::app()->request->getParam('universal_leadid');
		$OfferID=!empty($p2) ? $p2 : '13502';
		
		$LeadDate = date('Y-m-d H:i:s');
		// Lead_Metadata
		$SOURCE_ID = Yii::app()->request->getParam('url','www.eliteautocash.com');
		$SOURCEID = Yii::app()->request->getParam('promo_code');
		$LeadID = rand(1111,9999);
		$LEAD_SOURCE_IP = Yii::app()->request->getParam('ipaddress');
		
		$monthly_pay_arr = array('1500','1600','1700','1800','1900','2000','2100','2200','2400','2500');
		$monthly_pay_key = array_rand($monthly_pay_arr);
		$MONTHLY_PAYMENT = Yii::app()->request->getParam('home_pay');
		$MONTHLY_PAYMENT = $MONTHLY_PAYMENT < 1500 ? $monthly_pay_arr[$monthly_pay_key] : $MONTHLY_PAYMENT;
		
		// Lead_Data
		$EMAIL = Yii::app()->request->getParam('email');
		$SSN = Yii::app()->request->getParam('ssn');
		$SSN = substr($SSN,0,3).'-'.substr($SSN,3,2).'-'.substr($SSN,5,4);
		$FIRST_NAME = Yii::app()->request->getParam('first_name');
		$LAST_NAME = Yii::app()->request->getParam('last_name');
		$DOB = date('Y-m-d',strtotime(Yii::app()->request->getParam('dob')));
		$HOME_PHONE = Yii::app()->request->getParam('phone');
		$WORK_PHONE = Yii::app()->request->getParam('work_phone',Yii::app()->request->getParam('phone'));
		$MOBILE_PHONE = Yii::app()->request->getParam('mobile');
		$YEARS_AT_RES = Yii::app()->request->getParam('stay_in_year','4');
		$MONTHS_AT_RES = Yii::app()->request->getParam('stay_in_month','3');
		$TOTAL_MONTHS_AT_RES = $YEARS_AT_RES*12+$MONTHS_AT_RES;
		$BANKRUPTCY = Yii::app()->request->getParam('bankruptcy','false');
		$COSIGNER_AVAILABLE = Yii::app()->request->getParam('cosigner','true');
		$CREDIT_CHECK = Yii::app()->request->getParam('agree_credit_check','false');
		$GROSS_MONTHLY_INCOME = Yii::app()->request->getParam('monthly_income');
		// EMPLOYMENT_INFO
		$EMPLOYER_NAME = Yii::app()->request->getParam('employer');
		$YEARS_AT_EMP = Yii::app()->request->getParam('employment_in_year',rand(1,5));
		$MONTHS_AT_EMP = Yii::app()->request->getParam('employment_in_month',rand(1,11));
		$TOTAL_MONTHS_AT_EMP =$YEARS_AT_EMP*12+$MONTHS_AT_EMP;
		$JOB_TITLE = Yii::app()->request->getParam('job_title');
		
		$RESIDENCE_TYPE = (Yii::app()->request->getParam('is_rented')=='rent') ? 'Rent' : 'Own';
		$ADDRESS = Yii::app()->request->getParam('address');
		$CITY = Yii::app()->request->getParam('city',$city_state['city']);
		$STATE_PROVINCE = Yii::app()->request->getParam('state',$city_state['state']);
		$ZIP_POSTAL_CODE = Yii::app()->request->getParam('zip');
		$COUNTRY = 'USA';
		$DownPayment = array('900','1000','1100','1200','1300','1400','1450','1500','1550');
		$down_payment_key = array_rand($DownPayment);
		$MOTHLY_MORTGAGE ='Monthly rent';
		$CREDIT_RATING ='Good';
		//$SSN = 99999;	
		$dateformat = date('Y-m-d').'T'.date('H:i:s').'Z';
		$user_agent_list = self::$user_agent_list;
		$USER_AGENT = $user_agent_list[array_rand($user_agent_list)];
		$TRUSTED_FORM_CERT_URL = Yii::app()->request->getParam('trustedformcerturl');
		
		$fields = '<?xml version="1.0" encoding="UTF-8"?>
					<AutoFinanceRequest>
						<AuthCode>'.$PingId.'</AuthCode>
						<Meta>
							<OriginallyCreated>'.$dateformat.'</OriginallyCreated>
							<OfferID>'.$OfferID.'</OfferID>
							<SourceID>'.$SOURCEID.'</SourceID>';
							if($UNIVERSAL_LEADID !="" AND $UNIVERSAL_LEADID > '0'){
								$fields .= '<LeadIDCode>'.$UNIVERSAL_LEADID.'</LeadIDCode>';
							}
							$fields .= '<TCPACompliant>true</TCPACompliant>
							<trusted_form_cert_url>'.$TRUSTED_FORM_CERT_URL.'</trusted_form_cert_url>
							<TCPAConsentText>'.$TCPA_TEXT.'</TCPAConsentText>
							<UserAgent>'.$USER_AGENT.'</UserAgent>
							<LandingPageURL>https://www.eliteautocash.com</LandingPageURL>
						</Meta>
						<Contact>
							<FirstName>'.$FIRST_NAME.'</FirstName>
							<LastName>'.$LAST_NAME.'</LastName>
							<Email>'.$EMAIL.'</Email>
							<Phone>'.$HOME_PHONE.'</Phone>
							<Address>'.$ADDRESS.'</Address>
							<City>'.$CITY.'</City>
							<State>'.$STATE_PROVINCE.'</State>
							<ZipCode>'.$ZIP_POSTAL_CODE.'</ZipCode>
							<IPAddress>'.$LEAD_SOURCE_IP.'</IPAddress>
						</Contact>
						<Data>
							<SSN>'.$SSN.'</SSN>
							<Income>'.$GROSS_MONTHLY_INCOME.'</Income>
							<Birthdate>'.$DOB.'</Birthdate>
							<MonthsAtResidence>'.$TOTAL_MONTHS_AT_RES.'</MonthsAtResidence>
							<ResidencePayment>'.$MONTHLY_PAYMENT.'</ResidencePayment>
							<ResidenceType>'.$RESIDENCE_TYPE.'</ResidenceType>
							<Employer>'.$EMPLOYER_NAME.'</Employer>
							<MonthsAtEmployer>'.$TOTAL_MONTHS_AT_EMP.'</MonthsAtEmployer>
							<JobTitle>'.$JOB_TITLE.'</JobTitle>
							<Bankruptcy>'.$BANKRUPTCY.'</Bankruptcy>
							<HasCosigner>'.$COSIGNER_AVAILABLE.'</HasCosigner>
							<CreditRating>'.$CREDIT_RATING.'</CreditRating>
							<CreditCheck>'.$CREDIT_CHECK.'</CreditCheck>
						</Data>
					</AutoFinanceRequest>';
		$post_request = $fields;
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$token = $p2 ? $p2 : '0bbd700c4f770e6918e348d3551cbdfc49f3199c';
		$header = ["Authorization: Token $token","Content-Type: application/xml"];
		$post_response = $cm->curl($post_url,$post_request,$header);
		$time_end = CommonToolsMethods::stopwatch();
		$post_res = json_decode($post_response);
		if (trim($post_res->status) == 'success'){
			$post_status = '1';
			$post_price = isset($post_res->price) ? $post_res->price : $ping_response->price;
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