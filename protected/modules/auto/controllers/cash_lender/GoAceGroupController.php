<?php
class GoAceGroupController extends Controller {
	public function __construct() {
	}
	/**
	 * Create Ping Request for Lender
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0){
		$pingData = array();
		$AffiliateID = !empty($p1) ? $p1 : 'ap002419';
		$Password = !empty($p2) ? $p2 : 'emate';
		$ZIP_POSTAL_CODE = Yii::app()->request->getParam('zip');
		$GROSS_MONTHLY_INCOME = Yii::app()->request->getParam('monthly_income');
		$SSN = Yii::app()->request->getParam('ssn');
		//$ZIP_POSTAL_CODE = 99999;
		$fields = '<?xml version="1.0" encoding="UTF-8" ?> 
					<AutoFinancePing>
						<AffiliateID>'.$AffiliateID.'</AffiliateID>
						<Password>'.$Password.'</Password>
						<ZipCode>'.$ZIP_POSTAL_CODE.'</ZipCode>
						<Country>USA</Country>
						<Tier>dynamic</Tier>
						<SSN>'.$SSN.'</SSN>
						<MonthlyIncome>'.$GROSS_MONTHLY_INCOME.'</MonthlyIncome>
						<TestMode>false</TestMode>
					</AutoFinancePing>';

		$pingData['ping_request'] = $fields;
		$pingData['header'] = array('Content-Type: application/xml');
        return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response){
		$ping_response = html_entity_decode($ping_response);
		preg_match("/<Accept>(.*)<\/Accept>/msui", $ping_response, $result);
		if (trim($result[1]) == 'yes'){
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $price );
			preg_match("/<ReservationCode>(.*)<\/ReservationCode>/msui", $ping_response, $confirmation_id );
			$ping_price = isset($price[1]) ? $price[1] : 0;
			$confirmation_id = $confirmation_id [1];
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
		//$ping_response = html_entity_decode($ping_response);
		if($status == 1 || $status == '1'){
			preg_match("/<ReservationCode>(.*)<\/ReservationCode>/msui", $ping_response, $confirmation_id);
			$PingId = $confirmation_id[1];
		}else{
			$PingId = $ping_response;
		}
		$loan_term = array('36','48','60','72','84');
		$loan_term_key = array_rand($loan_term);
		$AffiliateID = !empty($parameter1) ? $parameter1 : 'ap002419';
		$Password = !empty($parameter2) ? $parameter2 : 'emate';
		$LeadDate = date('Y-m-d H:i:s');
		// Lead_Metadata
		$SOURCE_ID = Yii::app()->request->getParam('url','www.eliteautocash.com');
		$PROMO_CODE = Yii::app()->request->getParam('promo_code');
		$LeadID = rand(1111,9999);
		$LEAD_SOURCE_IP = Yii::app()->request->getParam('ipaddress');
		
		$monthly_pay_arr = array('1500','1600','1700','1800','1900','2000','2100','2200','2400','2500');
		$monthly_pay_key = array_rand($monthly_pay_arr);
		$MONTHLY_PAYMENT = Yii::app()->request->getParam('home_pay');
		$MONTHLY_PAYMENT = $MONTHLY_PAYMENT < 1500 ? $monthly_pay_arr[$monthly_pay_key] : $MONTHLY_PAYMENT;
		
		// Lead_Data
		$EMAIL = Yii::app()->request->getParam('email');
		$SSN = Yii::app()->request->getParam('ssn');
		$FIRST_NAME = Yii::app()->request->getParam('first_name');
		$LAST_NAME = Yii::app()->request->getParam('last_name');
		$DOB = explode('-',date('Y-m-d',strtotime(Yii::app()->request->getParam('dob'))));
		$HOME_PHONE = Yii::app()->request->getParam('phone');
		$WORK_PHONE = Yii::app()->request->getParam('work_phone',Yii::app()->request->getParam('phone'));
		$MOBILE_PHONE = Yii::app()->request->getParam('mobile');
		$YEARS_AT_RES = Yii::app()->request->getParam('stay_in_year','4');
		$MONTHS_AT_RES = Yii::app()->request->getParam('stay_in_month','3');
		$BANKRUPTCY = Yii::app()->request->getParam('bankruptcy','false');
		$COSIGNER_AVAILABLE = Yii::app()->request->getParam('cosigner','true');
		$GROSS_MONTHLY_INCOME = Yii::app()->request->getParam('monthly_income');
		// EMPLOYMENT_INFO
		$EMPLOYER_NAME = Yii::app()->request->getParam('employer');
		$YEARS_AT_EMP = Yii::app()->request->getParam('employment_in_year',rand(1,5));
		$MONTHS_AT_EMP = Yii::app()->request->getParam('employment_in_month',rand(1,11));
		$JOB_TITLE = Yii::app()->request->getParam('job_title');
		
		$TYPE = (Yii::app()->request->getParam('is_rented')=='rent') ? 'Rent' : 'Own/Buying';
		$ADDRESS = Yii::app()->request->getParam('address');
		$CITY = Yii::app()->request->getParam('city');
		$STATE_PROVINCE = Yii::app()->request->getParam('state');
		$ZIP_POSTAL_CODE = Yii::app()->request->getParam('zip');
		$COUNTRY = 'USA';
		$DownPayment = array('900','1000','1100','1200','1300','1400','1450','1500','1550');
		$down_payment_key = array_rand($DownPayment);
		//$SSN = 99999;	
		$fields = '<?xml version="1.0" encoding="UTF-8" ?> 
						<AutoFinanceLead> 
							<AffiliateID>'.$AffiliateID.'</AffiliateID> 
							<Password>'.$Password.'</Password> 
							<Tier>dynamic</Tier>
							<ReservationCode>'.$PingId.'</ReservationCode> 
							<PassThrough></PassThrough>
							<SubID>'.$PROMO_CODE.'</SubID>
							<LeadDate>'.$LeadDate.'</LeadDate>
							<LeadID>'.$LeadID.'</LeadID>
							<FirstName>'.$FIRST_NAME.'</FirstName> 
							<MiddleInitial></MiddleInitial>
							<LastName>'.$LAST_NAME.'</LastName> 
							<SSN>'.$SSN.'</SSN> 
							<BirthMonth>'.$DOB[1].'</BirthMonth> 
							<BirthDay>'.$DOB[2].'</BirthDay> 
							<BirthYear>'.$DOB[0].'</BirthYear> 
							<HomePhone>'.$HOME_PHONE.'</HomePhone>
							<WorkPhone>'.$WORK_PHONE.'</WorkPhone>
							<CellPhone>'.$MOBILE_PHONE.'</CellPhone>
							<EmailAddress>'.$EMAIL.'</EmailAddress> 
							<BestContactMethod>Email</BestContactMethod> 
							<BestContactTime>Morning</BestContactTime>
							<YearsAtAddress>'.$YEARS_AT_RES.'</YearsAtAddress>
							<MonthsAtAddress>'.$MONTHS_AT_RES.'</MonthsAtAddress>
							<StreetAddress>'.$ADDRESS.'</StreetAddress>
							<City>'.$CITY.'</City>
							<State>'.$STATE_PROVINCE.'</State>
							<ZipCode>'.$ZIP_POSTAL_CODE.'</ZipCode>
							<Country>'.$COUNTRY.'</Country>
							<ResidenceType>'.$TYPE.'</ResidenceType> 
							<HousingPayment></HousingPayment>
							<YearsAtPrevAddress>'.$YEARS_AT_RES.'</YearsAtPrevAddress>
							<MonthsAtPrevAddress>'.$MONTHS_AT_RES.'</MonthsAtPrevAddress>
							<PrevStreetAddress>'.$ADDRESS.'</PrevStreetAddress>
							<PrevCity>'.$CITY.'</PrevCity>
							<PrevState>'.$STATE_PROVINCE.'</PrevState>
							<PrevZipCode>'.$ZIP_POSTAL_CODE.'</PrevZipCode>
							<EmploymentType>W2 Employee</EmploymentType>
							<YearsAtEmployer>'.$YEARS_AT_EMP.'</YearsAtEmployer>
							<MonthsAtEmployer>'.$MONTHS_AT_EMP.'</MonthsAtEmployer>
							<Employer>'.$EMPLOYER_NAME.'</Employer> 
							<Occupation>'.$JOB_TITLE.'</Occupation> 
							<EmployerPhone>'.$WORK_PHONE.'</EmployerPhone>
							<MonthlyIncome>'.$MONTHLY_PAYMENT.'</MonthlyIncome>
							<OtherMonthlyIncome></OtherMonthlyIncome>
							<OtherIncomeSource></OtherIncomeSource>
							<YearsAtPrevEmployer></YearsAtPrevEmployer>
							<MonthsAtPrevEmployer></MonthsAtPrevEmployer>
							<PrevEmployer></PrevEmployer>
							<PrevEmployerPhone></PrevEmployerPhone>
							<HaveCheckingAccount>U</HaveCheckingAccount>
							<HaveSavingsAccount>U</HaveSavingsAccount>
							<BankName></BankName>
							<DownPayment>'.$DownPayment[$down_payment_key].'</DownPayment>
							<PreferredVehicleType></PreferredVehicleType>
							<TradeVIN></TradeVIN>
							<TradeYear></TradeYear>
							<TradeMake></TradeMake>
							<TradeModel></TradeModel>
							<TradeMileage></TradeMileage>
							<TradeAmountOwed></TradeAmountOwed>
							<TradeLienHolder></TradeLienHolder>
							<CoBuyerAvailable></CoBuyerAvailable>
							<Authorization>yes</Authorization>
							<OptOut>Y</OptOut>
							<IPAddress>'.$LEAD_SOURCE_IP.'</IPAddress>
						</AutoFinanceLead>';
				
		$post_request = $fields;
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$header = array('Content-Type: application/xml');
		$post_response = $cm->curl($post_url,$post_request,$header);
		$time_end = CommonToolsMethods::stopwatch();
		$post_response = html_entity_decode($post_response);
		preg_match("/<Accept>(.*)<\/Accept>/", $post_response, $success);
		if(trim($success[1]) == 'yes'){
			$post_status = '1';
			preg_match("/<Price>(.*)<\/Price>/msui",$post_response,$price);
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $ping_price );
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