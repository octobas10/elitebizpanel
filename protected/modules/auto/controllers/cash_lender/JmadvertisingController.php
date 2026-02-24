<?php
class JmadvertisingController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$LeadIDCode=!empty($p1) ? $p1 : '4xyz78b9-0cdc-43a7-98ea-2b680a5313a2';
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
							<SourceID>'.$SOURCEID.'</SourceID>
							<LeadIDCode>4xyz78b9-0cdc-43a7-98ea-2b680a5313a2</LeadIDCode>
							<TCPACompliant>true</TCPACompliant>
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
		$pingData['header'] = array("Authorization: Token 4738556a4a14a5834114c97f914063b2106d4029","Content-Type: application/xml");
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
	public static function sendPostData($parameter1,$parameter2,$parameter3,$ping_response,$post_url,$status){
		$ping_response = json_decode($ping_response);
		if($status == 1 || $status == '1'){
			$confirmation_id = $ping_response->auth_code;
			$PingId = $confirmation_id;
		}else{
			$PingId = $ping_response;
		}
		$loan_term = array('36','48','60','72','84');
		$loan_term_key = array_rand($loan_term);
		$TCPA_TEXT ='By entering my information, I have read and agree to the practices';
		$LeadIDCode=!empty($p1) ? $p1 : '4xyz78b9-0cdc-43a7-98ea-2b680a5313a2';
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
		
		$TYPE = (Yii::app()->request->getParam('is_rented')=='rent') ? 'Rent' : 'Own';
		$ADDRESS = Yii::app()->request->getParam('address');
		$CITY = Yii::app()->request->getParam('city');
		$STATE_PROVINCE = Yii::app()->request->getParam('state');
		$ZIP_POSTAL_CODE = Yii::app()->request->getParam('zip');
		$COUNTRY = 'USA';
		$DownPayment = array('900','1000','1100','1200','1300','1400','1450','1500','1550');
		$down_payment_key = array_rand($DownPayment);
		$MOTHLY_MORTGAGE ='Monthly rent';
		$CREDIT_RATING ='Good';
		//$SSN = 99999;	
		
			$dateformat = date('Y-m-d').'T'.date('H:i:s').'Z';
			$fields = '<?xml version="1.0" encoding="UTF-8"?>
						<AutoFinanceRequest>
							<AuthCode>'.$PingId.'</AuthCode>
							<Meta>
								<OriginallyCreated>'.$dateformat.'</OriginallyCreated>
								<OfferID>13502</OfferID>
								<SourceID>'.$SOURCEID.'</SourceID>
								<LeadIDCode>4xyz78b9-0cdc-43a7-98ea-2b680a5313a2</LeadIDCode>
								<TCPACompliant>true</TCPACompliant>
								<TCPAConsentText>'.$TCPA_TEXT.'</TCPAConsentText>
								<UserAgent></UserAgent>
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
								<ResidenceType>'.$MOTHLY_MORTGAGE.'</ResidenceType>
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
		//$header = array("api-authentication: 4738556a4a14a5834114c97f914063b2106d4029","Content-Type: application/xml");
		$header = array("Authorization: Token 4738556a4a14a5834114c97f914063b2106d4029","Content-Type: application/xml");
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