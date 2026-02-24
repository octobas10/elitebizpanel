<?php
class HSHController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0) {
        $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
            case '1':
                $mort_type = 'NEWHOME';
                break;
            case '2':
                $mort_type = 'REFI';
                break;
            case '3':
                $mort_type = 'HOMEEQ';
                break;
            case '4':
                $mort_type = 'REVERSE';
                break;
            default:
                $mort_type = 'REFI';
                break;          
        }
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        switch ($credit_rating) {
            case '1':
                $credit_rat = '0';
                break;
            case '2':
                $credit_rat = '1';
                break;
            case '3':
                $credit_rat = '2';
                break;
            case '4':
                $credit_rat = '3';
                break;        
            default:
                $credit_rat = '0';
                break;
        }
        $property_type = Yii::app()->request->getParam('property_use');
        switch ($property_type) {
            case '1':
                $prop_use = 'Primary Residence';
                break;
            case '2':
                $prop_use = 'Secondary Home';
                break;
            case '3':
                $prop_use = 'Investment Property';
                break;    
            default:
                $prop_use = 'Primary Residence';
                break;
        }
        $property_desc = Yii::app()->request->getParam('property_desc',1);
        switch ($property_desc) {
            case '1':
                $prop_desc = '0';
                break;
            case '2':
                $prop_desc = '1';
                break;
            case '3':
                $prop_desc = '3';
                break;
            case '4':
                $prop_desc = '3';
                break;
            case '5':
                $prop_desc = '5';
                break;
            default:
                $prop_desc = '6';
                break;
        }
        $rate_type = Yii::app()->request->getParam('rate_type');
        switch ($rate_type) {
            case '1':
                $r_type = 'Fixed';
                break;
            case '2':
                $r_type = 'Adjustable';
                break;
            case '3':
                $r_type = 'Fixed/Adjustable';
                break;
            default:
                $r_type = 'Fixed';
                break;
        }
        $first_interest_rate = Yii::app()->request->getParam('first_interest_rate');
        if($first_interest_rate>=0 and $first_interest_rate>=2){
            $fir = '1.0-2.0';
        }else if($first_interest_rate>2 and $first_interest_rate>=3){
            $fir = '2.1-3.0';
        }else if($first_interest_rate>3 and $first_interest_rate>=4){
            $fir = '3.1-4.0';
        }else if($first_interest_rate>4 and $first_interest_rate>=5){
             $fir = '4.1-5.0';
        }else{
             $fir = '5.1+';
        }
        $second_interest_rate = Yii::app()->request->getParam('second_interest_rate');
        if($second_interest_rate>=0 and $second_interest_rate>=2){
            $sir = '1.0-2.0';
        }else if($second_interest_rate>2 and $second_interest_rate>=3){
            $sir = '2.1-3.0';
        }else if($second_interest_rate>3 and $second_interest_rate>=4){
            $sir = '3.1-4.0';
        }else if($second_interest_rate>4 and $second_interest_rate>=5){
             $sir = '4.1-5.0';
        }else{
             $sir = '5.1+';
        }
        preg_match("/<lead_id>(.*)<\/lead_id>/msui",$ping_response,$confirmation_id);
        $zip_code = Yii::app()->request->getParam('zip');
        $zip_code = Yii::app()->request->getParam('property_zip',$zip_code);
        $submission_model = new Submissions();
        $class_name =  str_replace('Controller','',get_class());
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $tcpa_optin = Yii::app()->request->getParam('tcpa_optin');
        $tcpa_optin = $tcpa_optin == 'Yes' || $tcpa_optin == '1'  ? 'Yes' : 'No';
        $loan_amount = (int) Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage');
        $second_balance = Yii::app()->request->getParam('second_balance',$property_value);
        $estimate_value = Yii::app()->request->getParam('estimate_value',$property_value);
        $additional_cash = Yii::app()->request->getParam('additional_cash');
        $down_payment = Yii::app()->request->getParam('down_payment');
        //$bankruptcyFlag = ['84 + months ago','Never in bankruptcy','73-84 months ago','61-72 months ago','49-60 months ago','37-48 months ago','25-36 months ago','13-24 months ago','1-12 months ago','Currently in bankruptcy'];
        // BECAUSE OF BANKRUPCY NOT ALLOWED IN LAST 5 YEARS
        $bankruptcyFlag = ['84 + months ago','Never in bankruptcy','73-84 months ago','61-72 months ago'];
        $bflag_key = array_rand($bankruptcyFlag);
        $purchase = true;
        /*$p2 = '13008';
        $p3 = 'HshTestAffiliate';*/
        $state = Yii::app()->request->getParam('property_state',$city_state['state']);
        $va_loan = Yii::app()->request->getParam('va_loan');
        $loan_type = Yii::app()->request->getParam('loan_type');
		$promo_code = Yii::app()->request->getParam('promo_code');
		$sub_id = Yii::app()->request->getParam('sub_id');
        $sub_id = strlen($sub_id) > 10 ? substr($sub_id,0,10) : $sub_id;  
		$AFFID = $promo_code.'_'.$sub_id;
        $ping_response = '';
        if($mort_type == 'NEWHOME'){
            if($loan_type == '2'){
                $tier10_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'10.000');
                if($tier10_cap_count > 75){
                    $ping_response = 'Daily Cap 75 Met FhaLoan :'.$mort_type;
                    $purchase = false;
                }else if($loan_amount > '750000'){
                    $ping_response = 'loan amount should be less than $725,000 You sent: '.$loan_amount;
                    $purchase = false;
                }else if($property_type != '1'){
                    $ping_response = 'Primary Residence Only';
                    $purchase = false;
                }else if($credit_rating > '2'){
                    $ping_response = 'Credit Rating only Good/Excellent Allowed';
                    $purchase = false;
                }else if($ltv_percentage > '90'){
                    $ping_response = 'Ltv should not be more than 90% You sent: '.$ltv_percentage;
                    $purchase = false;
                }else if(date('l')=='Saturday__' || date('l')=='Sunday__'){
                    // || date('G')>20 || date('G')<12
                    $ping_response = 'No Weekends and Between 9am 5pm PST';
                    $purchase = false;
                }
                //echo $purchase.'==='.$tier10_cap_count.'--'.$mort_type.'--'.$loan_type;exit;
                $AFN = 'ECW_PurchaseFHA';
                $AF = '14304';
                $Username = 'EliteCashWire7';
                $Password = 'ECW2HSH';
                $apitoken = '72ad1cd5ef4fbc4e41477ab9196a2e3b1a8e3a94';
            }else if($sub_id == '968_175' OR $promo_code=='28' OR $promo_code=='26' OR $promo_code=='24' OR $promo_code=='20' OR $promo_code=='2'  OR $promo_code=='35'){
                $tier15_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'15.000');
                if($tier15_cap_count > 10 OR $va_loan=='0'){
                    $ping_response = 'Daily Cap 10 Met:'.$mort_type;
                    $purchase = false;
                }else if($loan_amount < '125000' OR $loan_amount > '700000'){
                    $ping_response = 'loan amount should be more than $125,000 You sent: '.$loan_amount;
                    $purchase = false;
                }else if($credit_rating > '2'){
                    $ping_response = 'Credit Rating only Good/Excellent Allowed';
                    $purchase = false;
                }else if($ltv_percentage != '100'){
                    $ping_response = 'Ltv should not be more than 90% You sent: '.$ltv_percentage;
                    $purchase = false;
                }else if(date('l')=='Saturday' || date('l')=='Sunday'){
                    $ping_response = 'No Weekends and Between 9am 5pm PST';
                    $purchase = false;
                }
                $AFN = 'ECW_VAPurchase';
                $AF = '13347';
                $Username = 'EliteCashWire2';
                $Password = 'ECW2HSH';
                $apitoken = '593b6f11155da943e0b87b53155845777a706e45';
            }else {
                $accepted_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type);
                if($accepted_cap_count >= 100){
                    $ping_response = 'Daily Cap 100 Met:'.$mort_type;
                    $purchase = false;
                }else if($loan_amount < '200000'){
                    $ping_response = 'loan amount should be more than $200,000 You sent: '.$loan_amount;
                    $purchase = false;
                }else if($credit_rating > '2'){
                    $ping_response = 'Credit Rating only Good/Excellent Allowed';
                    $purchase = false;
                }else if($ltv_percentage > '90'){
                    $ping_response = 'Ltv should not be more than 90% You sent: '.$ltv_percentage;
                    $purchase = false;
                }else if(date('l')=='Saturday' || date('l')=='Sunday'){
                    // || date('G')>20 || date('G')<12
                    $ping_response = 'No Weekends and Between 9am 5pm PST';
                    $purchase = false;
                }
                $AFN = 'ECW_Purchase1';
                $AF = '13515';
                $Username = 'EliteCashWire4';
                $Password = 'ECW2HSH';
                $apitoken = '4f247c5b6bcccb9e9fd06587efd17124429c2bf6';
            }
            $fields = [
                'LoanType' => 'NEWHOME',
                'longform' => 'y',
                'amount' => $loan_amount,
                'CreditRating' => $credit_rat,
                'PropState'=>$state,
                'PropUse' => $prop_use,
                'PropValue' => $property_value,
                'PropDesc' => $prop_desc,
                'Military'=> $va_loan == '1' ? 'Yes' : 'No',
                'Foreclosure'=>Yii::app()->request->getParam('bank_foreclosure')=='1' ? 'In foreclosure':'No',
                'bankruptcyFlag_New' => Yii::app()->request->getParam('bankruptcy')=='1'?'Currently in bankruptcy':'Never in bankruptcy',
                'down_payment' => $down_payment,
                'Fname' => Yii::app()->request->getParam('first_name'),
                'Lname' => Yii::app()->request->getParam('last_name'),
                'Street' => Yii::app()->request->getParam('address'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => $state,
                'PostalCode' => Yii::app()->request->getParam('property_zip'),
                'Email' =>Yii::app()->request->getParam('email'),
                'HomePhone' =>Yii::app()->request->getParam('phone'),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid'),
                'AFN' => $AFN,
                'AF' => $AF,
                'WorkPhone' => Yii::app()->request->getParam('phone2'),
                'Dob'=>date("m/d/Y",strtotime(Yii::app()->request->getParam('dob'))),
                'AFFID' => $AFFID,
                'atrk'=>Yii::app()->session['affiliate_trans_id'],
                'ip_address'=>Yii::app()->request->getParam('ipaddress'),
                'useragent'=>Yii::app()->request->getParam('user_agent'),
				'trusted_form'=>Yii::app()->request->getParam('trustedformcerturl'),
            ];
        }else if($mort_type == 'REFI'){
            // THIS IS ONLY FOR REFINANCE (PING)
            $tier7_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'7.000');
            if($loan_type == '2'){
                $tier10_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'10.000');
                if($tier10_cap_count > 75){
                    $ping_response = 'Daily Cap 75 Met FhaLoan :'.$mort_type;
                    $purchase = false;
                }else if($loan_amount > '750000'){
                    $ping_response = 'loan amount should be less than $725,000 You sent: '.$loan_amount;
                    $purchase = false;
                }else if($property_type != '1'){
                    $ping_response = 'Primary Residence Only';
                    $purchase = false;
                }else if($credit_rating > '2'){
                    $ping_response = 'Credit Rating only Good/Excellent Allowed';
                    $purchase = false;
                }else if($ltv_percentage > '90'){
                    $ping_response = 'Ltv should not be more than 90% You sent: '.$ltv_percentage;
                    $purchase = false;
                }else if(date('l')=='Saturday' || date('l')=='Sunday'){
                    $ping_response = 'No Weekends and Between 9am 5pm PST';
                    $purchase = false;
                }
                $AFN = 'ECW_PurchaseFHA';
                $AF = '14304';
                $Username = 'EliteCashWire7';
                $Password = 'ECW2HSH';
                $apitoken = '72ad1cd5ef4fbc4e41477ab9196a2e3b1a8e3a94';
            }else if($sub_id == '968_175' OR $sub_id=='20_702750' OR $sub_id=='24_33' OR $promo_code == '35'  OR $promo_code == '2'){
                $tier15_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'15.000');
                if($tier15_cap_count < 75){
                    // $12 tier is now $15
                    //$state_included = ['AZ','CA','CO','CT','FL','GA','IA','IL','MA','MD','ME','MI','NC','NJ','OH','OR','PA','WA','WI'];
                    $state_excluded = ['NY'];
                    if(in_array($state,$state_excluded)){
                        $ping_response = $state .' State Not Allowed you sent: '.$state;
                        $purchase = false;
                    }else if($loan_amount < '150000'){
                        $ping_response = 'loan amount should not be less than $150,000 You sent: '.$loan_amount;
                        $purchase = false;
                    }else if($credit_rating > '2'){
                        $ping_response = 'Credit Rating only Good/Excellent Allowed';
                        $purchase = false;
                    }else if($ltv_percentage > '85'){
                        $ping_response = 'Ltv should not be more than 85% You sent: '.$ltv_percentage;
                        $purchase = false;
                    }
                    $AFN = 'ECW_Refi3';
                    $AF = '13516';
                    $Username = 'EliteCashWire5';
                    $Password = 'ECW2HSH';
                    $apitoken = '0318dfbedad83f9e3082ea143522770d1bdc9918';
                }else{
                    // $8 tier
                    $AFN = 'ECW_Refi2';
                    $AF = '13514';
                    $Username = 'EliteCashWire3';
                    $Password = 'ECW2HSH';
                    $apitoken = 'a363dfe4df54119d3754d4503e7a08471c55c25f';
                }
            }else if($promo_code == 24 OR $promo_code == 28){
                // $8 tier
                $AFN = 'ECW_Refi2';
                $AF = '13514';
                $Username = 'EliteCashWire3';
                $Password = 'ECW2HSH';
                $apitoken = 'a363dfe4df54119d3754d4503e7a08471c55c25f';
            }else if($tier7_cap_count < '1'){
                $state_included = ['AZ','CO','FL','ID','MT','NM','NV','OR','TN','UT'];
                if($additional_cash < '10000'){
                    $ping_response = 'Cash Out should not be less than $10,000 You sent: '.$additional_cash;
                    $purchase = false;
                }else if($loan_amount < '350000'){
                    $ping_response = 'loan amount should be less than $350,000 You sent: '.$loan_amount;
                    $purchase = false;
                }else if(!in_array($state,$state_included)){
                    $ping_response = $state .' State Not Allowed';
                    $purchase = false;
                }
                $AFN = 'EliteCashWire.com_LeadAPI_Fair';
                $AF = '14838';
                $Username = 'EliteCashWire8';
                $Password = 'ECW2HSH';
                $apitoken = 'e51ffe77a698debd4371b4daabdeffd1bf3a4fe6';
            }else{
                // $5 tier
                $AFN = 'ECW_Refi1';
                $AF = '13283';
                $Username = 'EliteCashWire';
                $Password = 'ECW2HSH';
                $apitoken = 'de036c864ef48b949c160ee5230d47b99cedf8ef';
            }
            $fields = [
                'LoanType' => 'REFI',
                'longform' => 'y',
                'amount' => $loan_amount,
                'CreditRating' => $credit_rat,
                'PropUse' => $prop_use,
                'PropDesc' => $prop_desc,
                'PropValue' => $property_value,
                'PropState'=>$state,
                'Military'=>$va_loan == '1' ? 'Yes' : 'No',
                'down_payment' => $down_payment,
                'PropZip' =>Yii::app()->request->getParam('property_zip',$zip_code),
                'bankruptcyFlag_New' => Yii::app()->request->getParam('bankruptcy')=='1'?'Currently in bankruptcy':'Never in bankruptcy',
                'Foreclosure'=>Yii::app()->request->getParam('bank_foreclosure')=='1' ? 'In foreclosure':'No',
                'MortBalance1' => Yii::app()->request->getParam('first_balance'),
                'SecMortgage' => Yii::app()->request->getParam('second_balance')>'0'?'Yes':'No',
                'MortBalance2' => Yii::app()->request->getParam('second_balance'),
                'Fname' => Yii::app()->request->getParam('first_name'),
                'Lname' => Yii::app()->request->getParam('last_name'),
                'Street' => Yii::app()->request->getParam('address'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => $state,
                'PostalCode' => Yii::app()->request->getParam('property_zip'),
                'Email' =>Yii::app()->request->getParam('email'),
                'HomePhone' =>Yii::app()->request->getParam('phone'),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid'),
                'AFN' => $AFN,
                'AF' => $AF,
                'WorkPhone' => Yii::app()->request->getParam('phone2'),
                'Dob' => date("m/d/Y",strtotime(Yii::app()->request->getParam('dob'))),
                'CashOut' => $additional_cash,
                'VaLoan' => Yii::app()->request->getParam('va_loan')=='1'?'Yes':'No',
                'FhaLoan' => 'No',
                'AFFID' => $AFFID,
                'atrk'=>Yii::app()->session['affiliate_trans_id'],
                'ip_address'=>Yii::app()->request->getParam('ipaddress'),
                'useragent'=>Yii::app()->request->getParam('user_agent'),
				'trusted_form' => Yii::app()->request->getParam('trustedformcerturl'),
            ];
            $ping_response = '';
            $accepted_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type);
            $state_included = ['AL','AK','AZ','AR','CA','CO','CT','DC','FL','GA','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NV','NH','NM','NC','ND','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WI','WY'];
            if(!in_array($state,$state_included)){
                $ping_response = $state .' State Not Allowed you sent: '.$state;
                $purchase = false;
            }else if($accepted_cap_count > 150){
                $ping_response = 'Daily Cap 150 Met:'.$mort_type;
                $purchase = false;
            }else if($loan_amount < 150000){
                $ping_response = 'loan amount should be more than $150,000 You sent: '.$loan_amount;
                $purchase = false;
            }else if($credit_rating > '2'){
                $ping_response = 'Credit Rating only Good/Excellent Allowed';
                $purchase = false;
            }else if($ltv_percentage > '90'){
                $ping_response = 'Ltv should not be more than 90% You sent: '.$ltv_percentage;
                $purchase = false;
            }else if($prop_desc > '1'){
                $ping_response = 'Only Single Family and Multi Family Allowed';
                $purchase = false;
            }
        }else if($mort_type == 'REVERSE'){
            $reverse_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type);
            $state_included = ['CA','FL','LA','MS','MI','MD','NC','NV','OH','PA','SC','TN','TX','VA','WA','WI'];
            $age = date('Y')-date('Y',strtotime(Yii::app()->request->getParam('dob')));
            if($reverse_cap_count > 50){
                $ping_response = 'Daily Cap 50 Met:'.$mort_type;
                $purchase = false;
            }else if($age < 62){
                $ping_response =  'Candidate age should not be less than '.$age;
                $purchase = false;    
            }else if(!in_array($state,$state_included)){
                $ping_response = $state .' State Not Allowed';
                $purchase = false;
            }else if($property_value < '300000'){
                $ping_response = 'property value should be more than $300,000 You sent: '.$property_value;
                $purchase = false;
            }else if($property_type != '1'){
                $ping_response = 'Primary Residence Only';
                $purchase = false;
            }else if($ltv_percentage > '35'){
                $ping_response = 'Ltv should not be more than 35% You sent: '.$ltv_percentage;
                $purchase = false;
            }else if(date('l')=='Saturday' || date('l')=='Sunday'){
                $ping_response = 'No Weekends and Between 7am 5pm EST';
                $purchase = false;
            }
            $AFN = 'ECW_Reverse';
            $AF = '14174';
            $Username = 'EliteCashWire6';
            $Password = 'ECW2HSH';
            $apitoken = 'b3026070bfad2c365d093365b0246447a4d62e19';
            $fields = [
                'LoanType' => 'REVERSE',
                'amount' => $loan_amount,
                'PropState'=>$state,
                'PropDesc' => $prop_desc,
                'PropValue' => $property_value,
                'MortBalance' => Yii::app()->request->getParam('first_balance'),
                'BorrowerAge' => date('Y')-date('Y',strtotime(Yii::app()->request->getParam('dob'))),
                'Fname' => Yii::app()->request->getParam('first_name'),
                'Lname' => Yii::app()->request->getParam('last_name'),
                'Street' => Yii::app()->request->getParam('address'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => $state,
                'PostalCode' => Yii::app()->request->getParam('property_zip'),
                'Email' =>Yii::app()->request->getParam('email'),
                'HomePhone' =>Yii::app()->request->getParam('phone'),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid'),
                'AFN' => $AFN,
                'AF' => $AF,
                'WorkPhone' => Yii::app()->request->getParam('phone2'),
                'ip_address'=>Yii::app()->request->getParam('ipaddress'),
                'useragent'=>Yii::app()->request->getParam('user_agent'),
                'AFFID' => $AFFID,
                'atrk'=>Yii::app()->session['affiliate_trans_id'],
                'trusted_form' => Yii::app()->request->getParam('trustedformcerturl'),
            ];
        }
        if($purchase == true){
            $header = array("Authorization: Basic ".base64_encode($Username).":".base64_encode($Password)." Token ".base64_encode($apitoken));
            $pingData['ping_request'] = http_build_query($fields);
            $pingData['header'] = $header;
            return $pingData;
        }else{
            $pingData['ping_request'] = false;
            $pingData['ping_response_filtered'] = $ping_response;
            return $pingData;
        }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        $success = explode('&', $ping_response);
		$price = explode('=', $success[1]);
		if(strtolower(trim($price[0]))=='commision'  && (int) trim($price[1])>0){
			$price = explode('=', $success[1]);
			$ping_price = isset($price[1]) ? $price[1] : 0;
			$confirmation_id = explode('=', $success[0]);
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
        $ping_success = explode('&', $ping_response);
        $ping_price = explode('=', $ping_success[1]);
        $Mortgage_Type = Yii::app()->request->getParam('mortgage_lead_type');
        switch ($Mortgage_Type) {
            case '1':
                $mort_type = 'NEWHOME';
                break;
            case '2':
                $mort_type = 'REFI';
                break;
            case '3':
                $mort_type = 'HOMEEQ';
                break;
            case '4':
                $mort_type = 'REVERSE';
                break;
            default:
                $mort_type = 'REFI';
                break;          
        }
        $credit_rating = Yii::app()->request->getParam('credit_rating');
        switch ($credit_rating) {
            case '1':
                $credit_rat = '0';
                break;
            case '2':
                $credit_rat = '1';
                break;
            case '3':
                $credit_rat = '2';
                break;
            case '4':
                $credit_rat = '3';
                break;        
            default:
                $credit_rat = '0';
                break;
        }
        $property_type = Yii::app()->request->getParam('property_use');
        switch ($property_type) {
            case '1':
                $prop_use = 'Primary Residence';
                break;
            case '2':
                $prop_use = 'Secondary Home';
                break;
            case '3':
                $prop_use = 'Investment Property';
                break;    
            default:
                $prop_use = 'Primary Residence';
                break;
        }
        $property_desc = Yii::app()->request->getParam('property_desc',1);
        switch ($property_desc) {
            case '1':
                $prop_desc = '0';
                break;
            case '2':
                $prop_desc = '1';
                break;
            case '3':
                $prop_desc = '3';
                break;
            case '4':
                $prop_desc = '3';
                break;
            case '5':
                $prop_desc = '5';
                break;
            default:
                $prop_desc = '6';
                break;
        }
        $rate_type = Yii::app()->request->getParam('rate_type');
        switch ($rate_type) {
            case '1':
                $r_type = 'Fixed';
                break;
            case '2':
                $r_type = 'Adjustable';
                break;
            case '3':
                $r_type = 'Fixed/Adjustable';
                break;
            default:
                $r_type = 'Fixed';
                break;
        }
        $first_interest_rate = Yii::app()->request->getParam('first_interest_rate');
        if($first_interest_rate>=0 and $first_interest_rate>=2){
            $fir = '1.0-2.0';
        }else if($first_interest_rate>2 and $first_interest_rate>=3){
            $fir = '2.1-3.0';
        }else if($first_interest_rate>3 and $first_interest_rate>=4){
            $fir = '3.1-4.0';
        }else if($first_interest_rate>4 and $first_interest_rate>=5){
             $fir = '4.1-5.0';
        }else{
             $fir = '5.1+';
        }
        $second_interest_rate = Yii::app()->request->getParam('second_interest_rate');
        if($second_interest_rate>=0 and $second_interest_rate>=2){
            $sir = '1.0-2.0';
        }else if($second_interest_rate>2 and $second_interest_rate>=3){
            $sir = '2.1-3.0';
        }else if($second_interest_rate>3 and $second_interest_rate>=4){
            $sir = '3.1-4.0';
        }else if($second_interest_rate>4 and $second_interest_rate>=5){
             $sir = '4.1-5.0';
        }else{
             $sir = '5.1+';
        }
        preg_match("/<lead_id>(.*)<\/lead_id>/msui",$ping_response,$confirmation_id);
        $zip_code = Yii::app()->request->getParam('zip');
        $zip_code = Yii::app()->request->getParam('property_zip',$zip_code);
        $submission_model = new Submissions();
        $class_name =  str_replace('Controller','',get_class());
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $tcpa_optin = Yii::app()->request->getParam('tcpa_optin');
        $tcpa_optin = $tcpa_optin == 'Yes' || $tcpa_optin == '1'  ? 'Yes' : 'No';
        $loan_amount = (int) Yii::app()->request->getParam('loan_amount');
        $property_value = Yii::app()->request->getParam('property_value');
        $first_balance = Yii::app()->request->getParam('first_balance',$property_value);
        $is_second_morgage = Yii::app()->request->getParam('second_balance') > 0 ? 'Yes' : 'No';
        $ltv_percentage = Yii::app()->request->getParam('ltv_percentage');
        $second_balance = Yii::app()->request->getParam('second_balance',$property_value);
        $estimate_value = Yii::app()->request->getParam('estimate_value',$property_value);
		$additional_cash = Yii::app()->request->getParam('additional_cash');
		$down_payment = Yii::app()->request->getParam('down_payment');
        //$bankruptcyFlag = ['84 + months ago','Never in bankruptcy','73-84 months ago','61-72 months ago','49-60 months ago','37-48 months ago','25-36 months ago','13-24 months ago','1-12 months ago','Currently in bankruptcy'];
        // BECAUSE OF BANKRUPCY NOT ALLOWED IN LAST 5 YEARS
        $bankruptcyFlag = ['84 + months ago','Never in bankruptcy','73-84 months ago','61-72 months ago'];
        $bflag_key = array_rand($bankruptcyFlag);
        $purchase = true;
        $state = Yii::app()->request->getParam('property_state',$city_state['state']);
        $va_loan = Yii::app()->request->getParam('va_loan');
        $loan_type = Yii::app()->request->getParam('loan_type');
		$promo_code = Yii::app()->request->getParam('promo_code');
		$sub_id = Yii::app()->request->getParam('sub_id');
        $sub_id = strlen($sub_id) > 10 ? substr($sub_id,0,10) : $sub_id;
		$AFFID = $promo_code.'_'.$sub_id;
        if($mort_type == 'NEWHOME'){
            if($loan_type == '2'){
                $tier10_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'10.000');
                if($tier10_cap_count > 50){
                    $post_response = 'Daily Cap 50 Met FhaLoan :'.$mort_type;
                    $purchase = false;
                }else if($loan_amount > '750000'){
                    $post_response = 'loan amount should be less than $725,000 You sent: '.$loan_amount;
                    $purchase = false;
                }else if($property_type != '1'){
                    $post_response = 'Primary Residence Only';
                    $purchase = false;
                }else if($credit_rating > '2'){
                    $post_response = 'Credit Rating only Good/Excellent Allowed';
                    $purchase = false;
                }else if($ltv_percentage > '90'){
                    $post_response = 'Ltv should not be more than 90% You sent: '.$ltv_percentage;
                    $purchase = false;
                }else if(date('l')=='Saturday__' || date('l')=='Sunday___'){
                    // || date('G')>20 || date('G')<12
                    $post_response = 'No Weekends and Between 9am 5pm PST';
                    $purchase = false;
                }
                $AFN = 'ECW_PurchaseFHA';
                $AF = '14304';
                $Username = 'EliteCashWire7';
                $Password = 'ECW2HSH';
                $apitoken = '72ad1cd5ef4fbc4e41477ab9196a2e3b1a8e3a94';
            }else if($sub_id == '968_175' OR $promo_code=='28' OR $promo_code=='26' OR $promo_code=='24' OR $promo_code=='20' OR $promo_code=='2'  OR $promo_code=='35'){
                $tier15_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'15.000');
                if($tier15_cap_count >= 10 OR $va_loan=='0'){
                    $post_response = 'Daily Cap 10 Met:'.$mort_type;
                    $purchase = false;
                }else if($loan_amount < '125000' OR $loan_amount > '700000'){
                    $post_response = 'loan amount should be more than $125,000 You sent: '.$loan_amount;
                    $purchase = false;
                }else if($credit_rating > '2'){
                    $post_response = 'Credit Rating only Good/Excellent Allowed';
                    $purchase = false;
                }else if($ltv_percentage != '100'){
                    $post_response = 'Ltv should not be 100% You sent: '.$ltv_percentage;
                    $purchase = false;
                }else if(date('l')=='Saturday' || date('l')=='Sunday'){
                    $post_response = 'No Weekends and Between 7am 5pm EST';
                    $purchase = false;
                }
                $AFN = 'ECW_VAPurchase';
                $AF = '13347';
                $Username = 'EliteCashWire2';
                $Password = 'ECW2HSH';
                $apitoken = '593b6f11155da943e0b87b53155845777a706e45';
            }else{
                $post_response = '';
                if($loan_amount < '200000'){
                    $post_response = 'loan amount should not be more than $200,000 not'.$loan_amount;
                    $purchase = false;
                }else if($credit_rat > '1'){
                    $post_response = 'Credit Rating only Good/Excellent Allowed';
                    $purchase = false;
                }else if($ltv_percentage > '90'){
                    $post_response = 'Ltv should not be more than 90%  You sent: '.$ltv_percentage;
                    $purchase = false;
                }
                $AFN = 'ECW_Purchase1';
                $AF = '13515';
                $Username = 'EliteCashWire4';
                $Password = 'ECW2HSH';
                $apitoken = '4f247c5b6bcccb9e9fd06587efd17124429c2bf6';
            }
            $fields = [
                'LoanType' => $mort_type,
                'longform' => 'y',
                'amount' => $loan_amount,
                'CreditRating' => $credit_rat,
                'PropState'=>$state,
                'PropUse' => $prop_use,
                'PropValue' => $property_value,
                'PropDesc' => $prop_desc,
                'Military'=>$va_loan == '1' ? 'Yes' : 'No',
                'Foreclosure'=>Yii::app()->request->getParam('bank_foreclosure')=='1' ? 'In foreclosure':'No',
                'bankruptcyFlag_New' =>Yii::app()->request->getParam('bankruptcy')=='1'?'Currently in bankruptcy':'Never in bankruptcy',
                'down_payment' => $down_payment,
                'Fname' => Yii::app()->request->getParam('first_name'),
                'Lname' => Yii::app()->request->getParam('last_name'),
                'Street' => Yii::app()->request->getParam('address'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => $state,
                'PostalCode' => Yii::app()->request->getParam('property_zip'),
                'Email' =>Yii::app()->request->getParam('email'),
                'HomePhone' =>Yii::app()->request->getParam('phone'),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid'),
                'AFN' => $AFN,
                'AF' => $AF,
                'WorkPhone' => Yii::app()->request->getParam('phone2'),
                'Dob' => date("m/d/Y",strtotime(Yii::app()->request->getParam('dob'))),
                'AFFID' => $AFFID,
				'atrk'=>Yii::app()->session['affiliate_trans_id'],
				'ip_address'=>Yii::app()->request->getParam('ipaddress'),
				'useragent'=>Yii::app()->request->getParam('user_agent'),
				'trusted_form' => Yii::app()->request->getParam('trustedformcerturl'),
            ];
        }else if($mort_type == 'REFI'){
             // THIS IS ONLY FOR REFINANCE (POST)
            $tier7_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'7.000');
            if($loan_type == '2'){
                $tier10_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'10.000');
                if($tier10_cap_count > 50){
                    $post_response = 'Daily Cap 50 Met FhaLoan :'.$mort_type;
                    $purchase = false;
                }else if($loan_amount > '750000'){
                    $post_response = 'loan amount should be less than $725,000 You sent: '.$loan_amount;
                    $purchase = false;
                }else if($property_type != '1'){
                    $post_response = 'Primary Residence Only';
                    $purchase = false;
                }else if($credit_rating > '2'){
                    $post_response = 'Credit Rating only Good/Excellent Allowed';
                    $purchase = false;
                }else if($ltv_percentage > '90'){
                    $post_response = 'Ltv should not be more than 90% You sent: '.$ltv_percentage;
                    $purchase = false;
                }else if(date('l')=='Saturday' || date('l')=='Sunday'){
                    // || date('G')>20 || date('G')<12
                    $post_response = 'No Weekends and Between 9am 5pm PST';
                    $purchase = false;
                }
                $AFN = 'ECW_PurchaseFHA';
                $AF = '14304';
                $Username = 'EliteCashWire7';
                $Password = 'ECW2HSH';
                $apitoken = '72ad1cd5ef4fbc4e41477ab9196a2e3b1a8e3a94';
            }else if($sub_id == '968_175' OR $sub_id=='20_702750' OR $sub_id=='24_33' OR $promo_code == '35'  OR $promo_code == '2'){
                $tier15_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type,'15.000');
                if($tier15_cap_count < 75){
                    // $12 tier is now $15
                    //$state_included = ['AZ','CA','CO','CT','FL','GA','IA','IL','MA','MD','ME','MI','NC','NJ','OH','OR','PA','WA','WI'];
                    $state_excluded = ['NY'];
                    if(in_array($state,$state_excluded)){
                        $ping_response = $state .' State Not Allowed you sent: '.$state;
                        $purchase = false;
                    }else if($loan_amount < '150000'){
                        $ping_response = 'loan amount should not be less than $150,000 You sent: '.$loan_amount;
                        $purchase = false;
                    }else if($credit_rating > '2'){
                        $ping_response = 'Credit Rating only Good/Excellent Allowed';
                        $purchase = false;
                    }else if($ltv_percentage > '85'){
                        $ping_response = 'Ltv should not be more than 85% You sent: '.$ltv_percentage;
                        $purchase = false;
                    }
                    $AFN = 'ECW_Refi3';
                    $AF = '13516';
                    $Username = 'EliteCashWire5';
                    $Password = 'ECW2HSH';
                    $apitoken = '0318dfbedad83f9e3082ea143522770d1bdc9918';
                 }else{
                    // $8 tier
                    $AFN = 'ECW_Refi2';
                    $AF = '13514';
                    $Username = 'EliteCashWire3';
                    $Password = 'ECW2HSH';
                    $apitoken = 'a363dfe4df54119d3754d4503e7a08471c55c25f';
                }
            }else if($promo_code == 24  OR $promo_code == 28){
                // $8 tier
                $AFN = 'ECW_Refi2';
                $AF = '13514';
                $Username = 'EliteCashWire3';
                $Password = 'ECW2HSH';
                $apitoken = 'a363dfe4df54119d3754d4503e7a08471c55c25f';
            }else if($tier7_cap_count < '1'){
                $state_included = ['AZ','CO','FL','ID','MT','NM','NV','OR','TN','UT'];
                if($additional_cash < '10000'){
                    $ping_response = 'Cash Out should not be less than $10,000 You sent: '.$additional_cash;
                    $purchase = false;
                }else if($loan_amount < '350000'){
                    $ping_response = 'loan amount should be less than $350,000 You sent: '.$loan_amount;
                    $purchase = false;
                }else if(!in_array($state,$state_included)){
                    $ping_response = $state .' State Not Allowed';
                    $purchase = false;
                }
                $AFN = 'EliteCashWire.com_LeadAPI_Fair';
                $AF = '14838';
                $Username = 'EliteCashWire8';
                $Password = 'ECW2HSH';
                $apitoken = 'e51ffe77a698debd4371b4daabdeffd1bf3a4fe6';
            }else{
                // $5 tier
                $AFN = 'ECW_Refi1';
                $AF = '13283';
                $Username = 'EliteCashWire';
                $Password = 'ECW2HSH';
                $apitoken = 'de036c864ef48b949c160ee5230d47b99cedf8ef';
            }
            $fields = [
                'LoanType' => $mort_type,
                'longform' => 'y',
                'amount' => $loan_amount,
                'CreditRating' => $credit_rat,
                'PropUse' => $prop_use,
                'PropDesc' => $prop_desc,
                'PropValue' => $property_value,
                'PropState'=>$state,
                'Military'=>$va_loan == '1' ? 'Yes' : 'No',
                'down_payment' => $down_payment,
                'PropZip' =>Yii::app()->request->getParam('property_zip',$zip_code),
                'bankruptcyFlag_New' => Yii::app()->request->getParam('bankruptcy')=='1'?'Currently in bankruptcy':'Never in bankruptcy',
                'Foreclosure'=>Yii::app()->request->getParam('bank_foreclosure')=='1' ? 'In foreclosure':'No',
                'MortBalance1' => Yii::app()->request->getParam('first_balance'),
                'SecMortgage' => Yii::app()->request->getParam('second_balance')>'0'?'Yes':'No',
                'MortBalance2' => Yii::app()->request->getParam('second_balance'),
                'Fname' => Yii::app()->request->getParam('first_name'),
                'Lname' => Yii::app()->request->getParam('last_name'),
                'Street' => Yii::app()->request->getParam('address'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => $state,
                'PostalCode' => Yii::app()->request->getParam('property_zip'),
                'Email' =>Yii::app()->request->getParam('email'),
                'HomePhone' =>Yii::app()->request->getParam('phone'),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid'),
                'AFN' => $AFN,
                'AF' => $AF,
                'WorkPhone' => Yii::app()->request->getParam('phone2'),
                'Dob' => date("m/d/Y",strtotime(Yii::app()->request->getParam('dob'))),
                'CashOut' => $additional_cash,
                'VaLoan' => Yii::app()->request->getParam('va_loan')=='1'?'Yes':'No',
                'FhaLoan' => 'No',
                'AFFID' => $AFFID,
				'atrk'=>Yii::app()->session['affiliate_trans_id'],
				'ip_address'=>Yii::app()->request->getParam('ipaddress'),
				'useragent'=>Yii::app()->request->getParam('user_agent'),
				'trusted_form' => Yii::app()->request->getParam('trustedformcerturl'),
            ];
            $post_response = '';
            $state_included = ['AL','AK','AZ','AR','CA','CO','CT','DC','FL','GA','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NV','NH','NM','NC','ND','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WI','WY'];
            if(!in_array($state,$state_included)){
                $post_response = $state .' State Not Allowed';
                $purchase = false;
            }else if($loan_amount < '150000'){
                $post_response = 'loan amount should be more than $150,000 You Sent: '.$loan_amount;
                $purchase = false;
            }else if($credit_rat > '1'){
                $post_response = 'Credit Rating only Good/Excellent Allowed';
                $purchase = false;
            }else if($ltv_percentage > '90'){
                $post_response = 'Ltv should not be more than 90% You sent: '.$ltv_percentage;
                $purchase = false;
            }else if($prop_desc > '1'){
                $post_response = 'Only Single Family and Multi Family Allowed';
                $purchase = false;
            }
        }else if($mort_type == 'REVERSE'){
            $reverse_cap_count = $submission_model->check_accept_by_lender($class_name,$Mortgage_Type);
            $state_included = ['CA','FL','LA','MS','MI','MD','NC','NV','OH','PA','SC','TN','TX','VA','WA','WI'];
            $age = date('Y')-date('Y',strtotime(Yii::app()->request->getParam('dob')));
            if($reverse_cap_count > 50){
                $post_response = 'Daily Cap 50 Met:'.$mort_type;
                $purchase = false;
            }else if($age < 62){
                $post_response =  'Candidate age should not be less than '.$age;
                $purchase = false;    
            }else if(!in_array($state,$state_included)){
                $post_response = $state .' State Not Allowed';
                $purchase = false;
            }else if($property_value < '300000'){
                $post_response = 'Property value should be more than $300,000 You sent: '.$property_value;
                $purchase = false;
            }else if($property_type != '1'){
                $post_response = 'Primary Residence Only';
                $purchase = false;
            }else if($ltv_percentage > '35'){
                $post_response = 'Ltv should not be more than 35% You sent: '.$ltv_percentage;
                $purchase = false;
            }else if(date('l')=='Saturday' || date('l')=='Sunday'){
                $post_response = 'No Weekends and Between 9am 5pm PST';
                $purchase = false;
            }
            $AFN = 'ECW_Reverse';
            $AF = '14174';
            $Username = 'EliteCashWire6';
            $Password = 'ECW2HSH';
            $apitoken = 'b3026070bfad2c365d093365b0246447a4d62e19';
            $fields = [
                'LoanType' => 'REVERSE',
                'amount' => $loan_amount,
                'PropState'=>$state,
                'PropDesc' => $prop_desc,
                'PropValue' => $property_value,
                'MortBalance' => Yii::app()->request->getParam('first_balance'),
                'BorrowerAge' => date('Y')-date('Y',strtotime(Yii::app()->request->getParam('dob'))),
                'Fname' => Yii::app()->request->getParam('first_name'),
                'Lname' => Yii::app()->request->getParam('last_name'),
                'Street' => Yii::app()->request->getParam('address'),
                'City' => Yii::app()->request->getParam('city',$city_state['city']),
                'State' => $state,
                'PostalCode' => Yii::app()->request->getParam('property_zip'),
                'Email' =>Yii::app()->request->getParam('email'),
                'HomePhone' =>Yii::app()->request->getParam('phone'),
                'PhoneConsentLang' => Yii::app()->request->getParam('tcpa_text'),
                'LeadIdToken' => Yii::app()->request->getParam('universal_leadid'),
                'AFN' => $AFN,
                'AF' => $AF,
                'WorkPhone' => Yii::app()->request->getParam('phone2'),
                'ip_address'=>Yii::app()->request->getParam('ipaddress'),
                'useragent'=>Yii::app()->request->getParam('user_agent'),
                'AFFID' => $AFFID,
                'atrk'=>Yii::app()->session['affiliate_trans_id'],
                'trusted_form' => Yii::app()->request->getParam('trustedformcerturl'),
            ];
        }
        $header = array("Authorization: Basic ".base64_encode($Username).":".base64_encode($Password)." Token ".base64_encode($apitoken));
		$post_request = http_build_query($fields);
        if($purchase == true){
            $cm = new CommonMethods();
            $start_time = CommonToolsMethods::stopwatch();
            $post_response = $cm->curl($post_url, $post_request,$header);
            $time_end = CommonToolsMethods::stopwatch();
            $post_response = html_entity_decode($post_response);
            /*if($_SERVER['REMOTE_ADDR']=='82.17.180.215' && $_SERVER['SERVER_ADDR']=='192.168.1.188'){
                mail('octobas@gmail.com','HSH Post Accepted',$post_response);
            }*/
            $success = explode('&', $post_response);
            if(isset($success[2])  && trim($success[2])=='Status=Success'){
                $post_status = '1';
                $price = explode('=', $success[1]);
                $post_price = isset($price[1]) ? $price[1] : $ping_price[1];
            }else{
                $post_status = '0';
                $post_price = '0';
                $redirect_url = '';
            }
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