<?php
class Submissions extends HealthinsuranceActive {
    public $dob_month, $dob_day, $dob_year, $new_car;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function tableName() {
        return 'healthinsurance_submissions';
    }
    public function attributeLabels() {
        return array('id'=>'Customer ID');
    }
    public function rules() {
        $required_data = array();
        $required_data[] = array('lead_mode', 'required', 'message'=>'Lead Mode is required');
        $required_data[] = array('lead_mode', 'in', 'range'=>array('1', '0'), 'message'=>'lead_mode should be 0 or 1');
        $required_data[] = array('promo_code', 'required', 'message'=>'Promo Code is required');
        $required_data[] = array('sub_id', 'required', 'message'=>'Sub Id is required');
        $required_data[] = array('tcpa_optin', 'required', 'message'=>'TCPA Optin is required');
		$required_data[] = array('tcpa_optin', 'in', 'range'=>array('1', '0'), 'message'=>'tcpa_optin should be 0 or 1');
        $required_data[] = array('tcpa_text', 'required', 'message'=>'Tcpa Text is required');
        $required_data[] = array('universal_leadid', 'required', 'message'=>'Universal Lead Id is required');
        $required_data[] = array('zip', 'required', 'message'=>'Zip is required');
        $required_data[] = array('zip', 'numerical', 'integerOnly'=>true, 'message'=>'Zip should be numeric');
        //$required_data[] = array('zip', 'length', 'min'=>5, 'max'=>5, 'message'=>'Zip should be numeric');
        $required_data[] = array('zip', 'match', 'pattern'=>'/^[\-+]?[0-9]*\.?[0-9]+$/', 'message'=>'Invalid Zip');
        $required_data[] = array('universal_leadid', 'required');
		$required_data[] = array('ipaddress', 'required', 'message'=>'ipaddress is required');
        $required_data[] = array('is_rented', 'required');
        $required_data[] = array('is_rented', 'in', 'range'=>array('1', '0'), 'message'=>'residence type should be 0 or 1');
        $required_data[] = array('stay_in_year', 'required');
        $required_data[] = array('stay_in_year', 'numerical', 'integerOnly'=>true, 'message'=>'years at residence should be numeric');
        $required_data[] = array('stay_in_month', 'required');
        $required_data[] = array('stay_in_month', 'numerical', 'integerOnly'=>true, 'message'=>'months at residence should be numeric');
        $required_data[] = array('dob', 'required', 'message'=>'Date Of Birth is required');
        $required_data[] = array('gender', 'required');
        $required_data[] = array('gender', 'in', 'range'=>array('M', 'F'), 'message'=>'gender should be M or F');
        $required_data[] = array('marital_status', 'required');
        $required_data[] = array('marital_status', 'in', 'range'=>range('1', '6'), 'message'=>'marital_status should be between 1, 6');
        $required_data[] = array('education_level', 'required');
        $required_data[] = array('education_level', 'in', 'range'=>range('1', '9'), 'message'=>'education_level should be between 1, 9');
        $required_data[] = array('is_employed', 'required');
		$required_data[] = array('is_employed', 'in', 'range'=>array('1', '0'), 'message'=>'is_employed should be 0 or 1');
		$required_data[] = array('occupation', 'required');
		$required_data[] = array('occupation', 'in', 'range'=>range('1', '125'), 'message'=>'occupation should be between 1, 125');
		$required_data[] = array('is_student', 'required');
		$required_data[] = array('is_student', 'in', 'range'=>array('1', '0'), 'message'=>'is_student should be 0 or 1');
		$required_data[] = array('income', 'required');
		$required_data[] = array('income', 'numerical', 'integerOnly'=>true, 'message'=>'income should be numeric');
		$required_data[] = array('height', 'required');
		$required_data[] = array('height', 'in', 'range'=>range('120', '240'), 'message'=>'height should be in acceptable values');
		$required_data[] = array('height', 'numerical', 'integerOnly'=>true, 'message'=>'height should be numeric and in Centimeters');
		$required_data[] = array('weight', 'required');
		$required_data[] = array('weight', 'in', 'range'=>range('80', '550'), 'message'=>'weight should be in acceptable values');
		$required_data[] = array('weight', 'numerical', 'integerOnly'=>true, 'message'=>'weight should be numeric and in Lbs');
		$required_data[] = array('medical_condition', 'required');
		$required_data[] = array('medical_condition', 'in', 'range'=>range('1', '29'), 'message'=>'medical_condition should be between 1, 29');
		$required_data[] = array('dui', 'required');
		$required_data[] = array('dui', 'in', 'range'=>array('1', '0'), 'message'=>'dui should be 0 or 1');
		$required_data[] = array('previously_denied', 'required');
		$required_data[] = array('previously_denied', 'in', 'range'=>array('1', '0'), 'message'=>'previously_denied should be 0 or 1');
		$required_data[] = array('is_smoker', 'required');
		$required_data[] = array('is_smoker', 'in', 'range'=>array('1', '0'), 'message'=>'is_smoker should be 0 or 1');
		$required_data[] = array('expectant_parent', 'required');
		$required_data[] = array('expectant_parent', 'in', 'range'=>array('1', '0'), 'message'=>'expectant_parent should be 0 or 1');
		$required_data[] = array('relative_heart', 'required');
		$required_data[] = array('relative_heart', 'in', 'range'=>array('1', '0'), 'message'=>'relative_heart should be 0 or 1');
		$required_data[] = array('relative_cancer', 'required');
		$required_data[] = array('relative_cancer', 'in', 'range'=>array('1', '0'), 'message'=>'relative_cancer should be 0 or 1');
		$required_data[] = array('number_in_household', 'required');
		$required_data[] = array('number_in_household', 'numerical', 'integerOnly'=>true, 'message'=>'number_in_household should be numeric');
		$required_data[] = array('requested_coverage_type', 'required');
		$required_data[] = array('requested_coverage_type', 'in', 'range'=>array('1','2','3'), 'message'=>'requested_coverage_type should be 1,2 or 3');
		$required_data[] = array('current_coverage_type', 'in', 'range'=>array('1','2','3'), 'message'=>'current_coverage_type should be 1,2 or 3');
        $required_data[] = array('insurance_company', 'in', 'range'=>range('1', '239'), 'message'=>'insurance_company should be between 1, 239');
		$required_data[] = array('dob', 'required');
		
		//$required_data[] = array('insurance_company', 'required');
		//$required_data[] = array('current_coverage_type', 'required');
		//$required_data[] = array('insurance_start_date', 'required');
		//$required_data[] = array('insurance_expiration_date', 'required');
        $required_data[] = array('dob,insurance_expiration_date,insurance_start_date','validateDate','message'=>'{attribute}: should be in YYYY-mm-dd Format');
        $required_data[] = array('insurance_expiration_date','validateInsuraceExpireDates','message'=>'{attribute}: Must today or In Future');
        $required_data[] = array('insurance_start_date','validateInsuraceStartDates','message'=>'{attribute}: Must in Past');
        //$required_data[] = array('dob', 'type', 'type' =>'date','message'=>'{attribute}: is not a date!','dateFormat'=>'YYYY-mm-dd');
        //$required_data[] = array('phone_last_4', 'required');
        //$required_data[] = array('url', 'required');
        //$required_data[] = array('trustedformcerturl', 'required');
		$required_data[] = array('sub_date','default','on'=>'insert','value'=>date('Y-m-d H:i:s'),'setOnEmpty'=>false);
        if (Yii::app()->session['ping_type'] == 'post' || Yii::app()->session['ping_type'] == 'directpost') {
            $required_data[] = array('first_name', 'required', 'message'=>'First name is required');
            $required_data[] = array('last_name', 'required', 'message'=>'Last name is required');
            $required_data[] = array('email', 'required', 'message'=>'email address is Required');
            $required_data[] = array('email', 'match', 'pattern'=>'/^[A-Za-z0-9-+_\.]+@[A-Za-z0-9-\.]+$/', 'message'=>'Invalid Email address');
            $required_data[] = array('phone', 'required', 'message'=>'Phone is required');
            //$required_data[] = array('phone', 'length', 'min'=>10, 'max'=>10, 'message'=>'phone should be numeric');
            $required_data[] = array('phone', 'match', 'pattern'=>'/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/', 'message'=>'Invalid Phone');
            $required_data[] = array('address', 'required', 'message'=>'Address is required');
        }
        return $required_data;
    }
    public function validateDate($attribute_name,$params) {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->$attribute_name)) {    
            return true;
        }else{
            $this->addError($attribute_name,$attribute_name.' must be in YYY-mm-dd format');
        }
    }
    public function validateInsuraceExpireDates($attribute_name){
        if(strtotime($this->$attribute_name) >= strtotime('-30 days')){
            return true;
        }else{
            $this->addError($attribute_name,$attribute_name.' Must not more than 30 days in the past, the current date, or a future date.');
        }
    }
    public function validateInsuraceStartDates($attribute_name){
        if(strtotime($this->$attribute_name) < time()){
            return true;
        }else{
            $this->addError($attribute_name,$attribute_name.' Must be In Past dates');
        }
    }
    public function getMonthsArray() {
        for ($monthNum = 1; $monthNum <= 12; $monthNum++) {
            $months[$monthNum] = date('F', mktime(0, 0, 0, $monthNum, 1));
        }
        return array(0=>'Month') + $months;
    }

    public function getDaysArray() {
        for ($dayNum = 1; $dayNum <= 31; $dayNum++) {
            $days[$dayNum] = $dayNum;
        }
        return array(0=>'Day') + $days;
    }

    public function getYearsArray() {
        $thisYear = date('Y', time()) - 18;
        for ($yearNum = $thisYear; $yearNum >= 1971; $yearNum--) {
            $years[$yearNum] = $yearNum;
        }
        return array(0=>'Year') + $years;
    }

    public function getStayInMonthArray() {
        for ($monthNum = 1; $monthNum < 12; $monthNum++) {
            $months[$monthNum] = $monthNum;
        }
        return array(0=>'Months') + $months;
    }

    public function getStayInYearArray() {
        for ($yearNum = 0; $yearNum < 21; $yearNum++) {
            $years[$yearNum] = $yearNum;
        }
        return array(0=>'Years') + $years;
    }

    public function getEmpInMonthArray() {
        for ($monthNum = 1; $monthNum < 12; $monthNum++) {
            $months[$monthNum] = $monthNum;
        }
        return array(0=>'Months') + $months;
    }

    public function getEmpInYearArray() {
        for ($yearNum = 0; $yearNum < 21; $yearNum++) {
            $years[$yearNum] = $yearNum;
        }
        return array(0=>'Years') + $years;
    }

	/*public static function valid_dob($attribute,$params){
		if(($params['dob_month'] == "") && ($params['dob_day'] == "") && ($params['dob_year'] == "")){
			return false;
		}else{
			return true;
		}
	}*/
    public static function valid_zip($zip) {
        if (strlen(trim($zip)) < 5 || !preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', trim($zip))) {
            return false;
        } else {
            return true;
        }
    }

    public function USPS_Validation($attribute, $params) {
        $zip = ($this->zip) ? $this->zip : $attribute;
        $flag = 0;
        if (!empty($zip)) {
            $response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $zip . '&sensor=true');
            $resjs = json_decode($response);
            foreach ($resjs->results[0]->address_components as $address_component) {
                if ($address_component->short_name == 'US') {
                    $flag = 1;
                }
            }
        }
        if ($flag == 1) {
            return true;
        } else {
            $this->addError('zip', 'Invalid Zip Code');
            return false;
        }
    }

    public function getCityStateFromZip($zip) {
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
                ->select('zipcode,city,UPPER(state) AS state')
                ->from('zipcodes')
                ->where('zipcode = "' . $zip . '"');
		//echo $queri = $dbCommand->getText();
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
	
	public function getInsuranceCompanyDetailsById($insurance_company_id) {
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
                ->select('insurance_company_id, insurance_company_name')
                ->from('insurance_companies')
                ->where('insurance_company_id = "' . $insurance_company_id . '"');
        //echo $queri = $dbCommand->getText();
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function getMatchingCompanyFromPublisher($companyListFromBuyer,$default_company='Company Not Listed') {
        $insurance_company_id = Yii::app()->request->getParam('insurance_company');
        $InsuranceComapany = $this->getInsuranceCompanyDetailsById($insurance_company_id);
        $pub_company =  trim(preg_quote($InsuranceComapany['insurance_company_name'], '~'));
        $matching_company = preg_grep('~' . $pub_company . '~', $companyListFromBuyer);
        $matching_company = preg_grep ('/^'.$pub_company.' (\w+)/i',$companyListFromBuyer);
        $matching_company_one = is_array($matching_company) ? array_shift($matching_company) : $matching_company;
         $matching_company_one = $matching_company_one == '' ? $default_company : $matching_company_one;
        return $matching_company_one;
    }
    public function getMedicalConditionDetailsById($med_cond_id) {
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
                ->select('medical_condition_id, medical_condition_name')
                ->from('medical_condition')
                ->where('medical_condition_id = "' . $med_cond_id . '"');
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function getMatchingMedicalCondFromPublisher($medicalConditionFromBuyer,$default_medical_condition='None') {
        $medical_cond_company_id = Yii::app()->request->getParam('medical_condition');
        $medCondList = $this->getMedicalConditionDetailsById($medical_cond_company_id);
        $pub_med_cond = trim(preg_quote($medCondList['medical_condition_name'], '~'));
        $matching_company = preg_grep('~' . $pub_med_cond . '~', $medicalConditionFromBuyer);
        $matching_med_cond_one = is_array($matching_company) ? array_shift($matching_company) : $matching_company;
         $matching_med_cond_one = $matching_med_cond_one == '' ? $default_medical_condition : $matching_med_cond_one;
        return $matching_med_cond_one;
    }
    public function getOccupationById($occupation_id) {
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
                ->select('occupation_id, occupation_name')
                ->from('occupations')
                ->where('occupation_id = "' . $occupation_id . '"');
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    /*public function getMatchingOccupationFromPublisher($occupationListFromBuyer,$occupation_id) {
        $Occupations = $this->getOccupationById($occupation_id);
        $pub_occupation = trim(preg_quote($Occupations['occupation_name'], '~'));
        $matching_occupation = preg_grep('~' . $pub_occupation . '~', $occupationListFromBuyer);
        $matching_occupation_one = is_array($matching_occupation) ? array_shift($matching_occupation) : $matching_occupation;
        return $matching_occupation_one;
    }*/
    public function getMatchingOccupationFromPublisher($occupationListFromBuyer,$default_occupation='Other') {
        $occupation_id = Yii::app()->request->getParam('occupation');
        $Occupations = $this->getOccupationById($occupation_id);
        $pub_occupation = trim(preg_quote($Occupations['occupation_name'], '~'));
        $matching_occupation = preg_grep('~' . $pub_occupation . '~', $occupationListFromBuyer);
        $matching_occupation_one = is_array($matching_occupation) ? array_shift($matching_occupation) : $matching_occupation;
        $matching_occupation_one = $matching_occupation_one == '' ? $default_occupation : $matching_occupation_one;
        return $matching_occupation_one;
    }
    public function checkDuplicate($data) {
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
                ->select('id')
                ->from('healthinsurance_submissions')
                ->where("email='" . $data['email'] . "' AND phone=" . $data['phone'] . " AND last_name='" . $data['last_name'] . "' AND UNIX_TIMESTAMP(sub_date)>" . @strtotime('-1 month'))
                ->limit('1');
        $dataReader = $dbCommand->query();
        return $count = count($dataReader);
    }

    public function checkPingDuplicate($data) {
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
                ->select('dup_days')
                ->from('healthinsurance_affiliate_user')
                ->where("id = " . $data['promo_code']);
        $dataReader = $dbCommand->queryRow();
        $dup_days = $dataReader['dup_days'];
        $dup_days = (isset($dup_days) && !empty($dup_days)) ? '-' . $dup_days . ' days' : '-6 months';
        
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
                ->select('id')
                ->from('healthinsurance_submissions')
                ->where("email = '" . $data['email'] . "' AND `sub_date` > '" . date('Y-m-d', strtotime($dup_days)) . " 00:00:00'")
                ->limit('1');
        return false;
    }

    public function afterSave() {
        $id = Yii::app()->dbHealthinsurance->getLastInsertId();
        if ($id != 0)
            AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array("customer_id"=>$id));
    }

    public $cnt = 0;

    /**
     * Valid Pings of Last 15 Days 
     */
    public function submission15days() {
        $criteria = new CDbCriteria();
        $criteria->select = "count(*) AS cnt , sub_date";
        $criteria->group = "date(`sub_date`)";
        $criteria->order = "date(`sub_date`) DESC";
        $criteria->limit = "15";
        $days15 = $this->findAll($criteria);
        $xml_cat = "";
        $xml_cat .= "<graph counttion='Total submissions of last 15 days' rotateNames='1' xAxisName='Last 15 days' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
        foreach ($days15 as $row) {
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
            $xml_cat .= '<set name="' . substr($row['sub_date'], 0, 10) . '" value="' . $row['cnt'] . '" color="' . $color . '"/>';
        }
        return $xml_cat .= "</graph>";
    }

    public $counterror = "";
    public $countdupli = "";
    public $count = "";

    public function exportleads() {
        $orderby = "";
        if ($promo_code = Yii::app()->request->getParam("promo_code")) {
            $promo_codes = implode(",", $promo_code);
            if ($promo_codes) {
                $where[] = "a_sub.promo_code IN (" . $promo_codes . ")";
            }
        }
        if ($stay_in_month = Yii::app()->request->getParam("stay_in_month")) {
            $where[] = "a_sub.stay_in_month = " . $stay_in_month;
        }
        if ($stay_in_year = Yii::app()->request->getParam("stay_in_year")) {
            $where[] = "a_sub.stay_in_year = " . $stay_in_year;
        }
        if ($employment_in_month = Yii::app()->request->getParam("employment_in_month")) {
            $where[] = "a_sub.employment_in_month = " . $employment_in_month;
        }
        if ($employment_in_year = Yii::app()->request->getParam("employment_in_year")) {
            $where[] = "a_sub.employment_in_year = " . $employment_in_year;
        }

        if ($state = Yii::app()->request->getParam("state")) {
            $states = implode("','", $state);
            if ($states) {
                $where[] = "a_sub.state IN ('" . $states . "')";
            }
        }
        if (Yii::app()->request->getParam("status") != '-1') {
            $status = Yii::app()->getRequest()->getParam("status");
            $where[] = "a_sub.lead_status = '" . $status . "'";
        }
		/*if(Yii::app()->request->getParam("gender")!='-1'){
			$gender = Yii::app()->getRequest()->getParam("gender");
			$gender = ($gender=='1') ? 'M' : 'F';
			$where[] = "a_sub.gender = '".$gender."'";
		}*/
        if (Yii::app()->request->getParam("lead_type") != '-1') {
            $lead_type = Yii::app()->getRequest()->getParam("lead_type");
            $where[] = "a_sub.is_organic = '" . $lead_type . "'";
        }
        if ($filter = Yii::app()->request->getParam('filter_date', date("Y-m-d"))) {
            $time_condition = '';
            $filter = explode(' - ', $filter);
            $count = count($filter);
            if ($count == 2) {
                $date1 = date("Y-m-d", strtotime($filter[0])) . ' 00:00:00';
                $date2 = date("Y-m-d", strtotime($filter[1])) . ' 23:59:59';
                $time_condition .= "sub_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";
            } else {
                $date = date("Y-m-d", strtotime($filter[0]));
                $time_condition .= "sub_date BETWEEN '" . $date . " 00:00:00' AND '" . $date . " 23:59:59' ";
            }
            $where[] = $time_condition;
        }
        if ($age = Yii::app()->request->getParam('age')) {
            $where[] = 'YEAR(CURDATE())-YEAR(date_format(str_to_date(dob,"%d/%m/%Y"),"%Y-%m-%d")) > "' . $age . '"';
        }
        if (Yii::app()->request->getParam('order') != '-1') {
            $order = Yii::app()->request->getParam('order');
            $orderby = 'a_sub.id ' . $order;
        }
        if ($fields_requested = Yii::app()->request->getParam('fields')) {
            $fields = "a_sub." . implode(",a_sub.", $fields_requested);
        } else {
            $fields_request = array("id", "promo_code", "first_name", "last_name", "sub_date", "email");
            $fields = '';
            foreach ($fields_request as $value) {
                $fields .= "a_sub." . $value . ',';
            }
        }
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        //echo'<pre>';print_r($where);echo'</pre>';
        $rawData = Yii::app()->dbHealthinsurance->createCommand()
                ->select($fields)
                ->from("healthinsurance_submissions a_sub")
                ->where($where)
                ->order($orderby)
                ->queryAll();
        return $rawData;
    }

    public function browseleads() {
        $criteria = new CDbCriteria();
        if ($promo_code = Yii::app()->getRequest()->getParam('promo_code')) {
            $promo_codes = implode(',', $promo_code);
            if ($promo_codes) {
                $where[] = 'promo_code IN (' . $promo_codes . ')';
            }
        }
        if ($lenders = Yii::app()->getRequest()->getParam('lender_name')) {
            $lenders = implode("','", $lenders);
            $rs = LenderDetails::model()->findAll(array('select'=>'id', 'condition'=>'name IN ("' . $lenders . '") '));
            $lender_ids = '';
            foreach ($rs as $sub_row) {
                $lender_ids .= $sub_row->id . ",";
            }
            $lender_ids = substr($lender_ids, 0, strlen($lender_ids) - 1);
            if ($lender_ids) {
                $where[] = 'lender_id IN (' . $lender_ids . ')';
            }
        }
        if (Yii::app()->getRequest()->getParam('lead_status') != '' && Yii::app()->getRequest()->getParam('lead_status') != '2') {
            $lead_status = Yii::app()->getRequest()->getParam('lead_status');
            $where[] = "lead_status = " . $lead_status;
        }
        if (Yii::app()->getRequest()->getParam('lead_status') == '2') {
            $where[] = "is_returned = 1";
        }
        if ($filter = Yii::app()->getRequest()->getParam('filter_date', date("Y-m-d"))) {
            $time_condition = '';
            $filter = explode(' - ', $filter);
            $count = count($filter);
            if ($count == 2) {
                $date1 = date("Y-m-d", strtotime($filter[0])) . ' 00:00:00';
                $date2 = date("Y-m-d", strtotime($filter[1])) . ' 23:59:59';
                $time_condition = " sub_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";
            } else {
                $date = date("Y-m-d", strtotime($filter[0]));
                $time_condition .= " sub_date >= '" . $date . " 00:00:00' AND sub_date <= '" . $date . " 23:59:59'";
            }
            $where[] = $time_condition;
        }
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        $criteria->condition = $where;
        $criteria->order = 'sub_date DESC';
        return $criteria;
    }

    public function getDurationSubmissions() {
        /* $combine_data_query = 'SELECT SUM(if(sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 WEEK) , 1, 0)) as week_submission, SUM(if(sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 MONTH) , 1, 0)) as month_submission FROM healthinsurance_submissions'; */
        $combine_data_query = 'SELECT t1.week_submission, t2.month_submission
			FROM (SELECT count(*) AS week_submission
			FROM healthinsurance_submissions
			WHERE sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 WEEK)) t1,
			(SELECT count(*) AS month_submission
			FROM healthinsurance_submissions
			WHERE sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 MONTH)) t2';

        $command = Yii::app()->dbHealthinsurance->createCommand($combine_data_query);
        return $row = $command->queryRow();
    }

    public function lead_info_reports() {
        $promo_code = Yii::app()->getRequest()->getParam('promo_code');
        $lender_lead_price = Yii::app()->getRequest()->getParam('lead_price');
        $lender = Yii::app()->getRequest()->getParam('lender');
        $start_date = Yii::app()->getRequest()->getParam('start_date');
        $end_date = Yii::app()->getRequest()->getParam('end_date');
        $is_returned = Yii::app()->getRequest()->getParam('is_returned');
        $final = Yii::app()->getRequest()->getParam('final');
        $posting_type = Yii::app()->getRequest()->getParam('posting_type');
        $lender_id = '';
        if ($lender) {
            $lender_details_model = new LenderDetails();
            $lender_detail = $lender_details_model->find(array('condition'=>"name='" . $lender . "'"));
            $lender_id = isset($lender_detail->id) ? $lender_detail->id : '';
        }
        $where[] = $promo_code ? "promo_code = " . $promo_code : '';
        $where[] = $lender_lead_price ? "lender_lead_price = " . $lender_lead_price : '';
        $where[] = $lender_id ? "lender_id = '" . $lender_id . "'" : '';
        $where[] = $start_date ? "sub_date >= '" . $start_date . " 00:00:00'" : '';
        $where[] = $end_date ? "sub_date <= '" . $end_date . " 23:59:59'" : '';
        $where[] = "lead_status = 1";
        $where[] = isset($posting_type) ? "posting_type = $posting_type" : '';
        $where[] = ($is_returned == 1) ? "is_returned=1" : "";
        $where[] = ($final == 1) ? " (is_returned=0 or is_returned IS NULL)" : "";
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
		//echo '';print_r($where);exit;
        $rawData = Yii::app()->dbHealthinsurance->createCommand()
                ->select('promo_code,first_name,last_name,email,phone,zip,ipaddress,lender_id,sub_date,lender_lead_price,vendor_lead_price')
                ->from('healthinsurance_submissions')
                ->where($where)
                ->order('')
                ->queryAll();
        return $rawData;
    }
    public function affiliate_revenue_statistics(){
        $days = 7;
        $sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-$days,date('Y')));
        $edate = date('Y-m-d');
        $date_filter = Yii::app()->request->getParam('date_filter');
        if(!empty($date_filter)){
            $filter = explode(" - ",$date_filter);
            $count =  count($filter);
            if($count == 2){
                $sdate = date('Y-m-d',strtotime($filter[0]));
                $edate = date('Y-m-d',strtotime($filter[1]));
            }else{
                $sdate = date('Y-m-d',strtotime($filter[0]));
                $edate = date('Y-m-d',strtotime($filter[0]));
            }
        }
        $fields = 'SUM(IF(`is_returned` = "0", `vendor_lead_price`,0)) as total_vendor_price,SUM(`is_returned`) AS returned, DATE(sub_date) as date,promo_code';
        $where = "lead_status=1 AND  `sub_date` <= '".$edate."' AND `sub_date` >= '".$sdate."'";
        $groupby = 'DATE(sub_date),promo_code';
        $orderby = 'sub_date desc';
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
        ->select($fields)
        ->from("healthinsurance_submissions as A")
        ->where($where)
        ->order($orderby)
        ->group($groupby);
        //echo $dbCommand->getText();exit;
        return $rawData = $dbCommand->queryAll();
    }
    public function lender_revenue_statistics(){
        $days = 7;
        $sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-$days,date('Y')));
        $edate = date('Y-m-d');
        $date_filter = Yii::app()->request->getParam('date_filter');
        if(!empty($date_filter)){
            $filter = explode(" - ",$date_filter);
            $count =  count($filter);
            if($count == 2){
                $sdate = date('Y-m-d',strtotime($filter[0]));
                $edate = date('Y-m-d',strtotime($filter[1]));
            }else{
                $sdate = date('Y-m-d',strtotime($filter[0]));
                $edate = date('Y-m-d',strtotime($filter[0]));
            }
        }
        $fields = 'SUM(IF(`is_returned` = "0", `lender_lead_price`,0)) as total_buyer_price,SUM(`is_returned`) AS returned, DATE(sub_date) as date,user_name as lender';
        $where = "lead_status=1 AND  `sub_date` <= '".$edate."' AND `sub_date` >= '".$sdate."'";
        $groupby = 'DATE(sub_date),lender_id';
        $orderby = 'sub_date desc';
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
        ->select($fields)
        ->from("healthinsurance_submissions as A")
        ->join('healthinsurance_lender_details B','A.lender_id = B.id')
        ->where($where)
        ->order($orderby)
        ->group($groupby);
        //echo $dbCommand->getText();exit;
        return $rawData = $dbCommand->queryAll();
    }
    public function lead_info_posted_leads() {
        $promo_code = Yii::app()->getRequest()->getParam('promo_code');
        $ping_status = Yii::app()->getRequest()->getParam('ping_status');
        $post_sent = Yii::app()->getRequest()->getParam('post_sent');
        $post_status = Yii::app()->getRequest()->getParam('post_status');
        $lead_price = Yii::app()->getRequest()->getParam('lead_price');
        $start_date = Yii::app()->getRequest()->getParam('start_date');
        $end_date = Yii::app()->getRequest()->getParam('end_date');
        $is_returned = Yii::app()->getRequest()->getParam('is_returned');
        $posting_type = Yii::app()->getRequest()->getParam('posting_type');
        $where[] = $promo_code ? "promo_code = " . $promo_code : '';
        $where[] = $lead_price ? "ping_price = " . $lead_price . " AND post_status=1" : '';
        $where[] = ($ping_status == 1) ? "ping_status = 1" : '';
        $where[] = ($post_sent == 1) ? "post_request != '' " : '';
        $where[] = ($post_status == 1) ? "post_status = 1" : '';
        $where[] = $start_date ? "date >= '" . $start_date . " 00:00:00'" : '';
        $where[] = $end_date ? "date <= '" . $end_date . " 23:59:59'" : '';
        $where[] = isset($posting_type) ? "posting_type = $posting_type" : '';
        $where[] = $is_returned=='0' ? "(is_returned=0 OR is_returned IS NULL)" : $is_returned;
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        $rawData = Yii::app()->dbHealthinsurance->createCommand()
                ->select('customer_id')
                ->from('healthinsurance_affiliate_transactions')
                ->where($where)
                ->queryAll();
        $customer_id = [1];$subData = [];
        if($rawData){
            foreach ($rawData as $row) {
                $customer_id[] = $row['customer_id'];
            }
            $customer_id = array_filter($customer_id);
            $customer_id = implode(',', $customer_id);
            $subData = Submissions::model()->findAll(["condition" => "id IN ($customer_id) AND promo_code=$promo_code"]);
        }
        return $subData;
    }
    public function campain_performance() {
        $days = 7;
        $sdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $days, date('Y'))) . ' 00:00:00';
        $edate = date('Y-m-d') . ' 23:59:59';
        $date_filter = Yii::app()->request->getParam('date_filter');
        if (!empty($date_filter)) {
            $filter = explode(" - ", $date_filter);
            $count = count($filter);
            if ($count == 2) {
                $sdate = date('Y-m-d', strtotime($filter[0])) . ' 00:00:00';
                $edate = date('Y-m-d', strtotime($filter[1])) . ' 23:59:59';
            } else {
                $sdate = date('Y-m-d', strtotime($filter[0])) . ' 00:00:00';
                $edate = date('Y-m-d', strtotime($filter[0])) . ' 23:59:59';
            }
        }
        $fields = 'COUNT(id) as total,SUM(vendor_lead_price) as vendor_price,SUM(lender_lead_price) as buyer_price, DATE(sub_date) as date';
        $where = 'lead_status=1 AND sub_date BETWEEN "' . $sdate . '" AND "' . $edate . '"';
        $groupby = 'DATE(sub_date)';
        $orderby = 'sub_date desc';
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
                ->select($fields)
                ->from("healthinsurance_submissions a_sub")
                ->where($where)
                ->order($orderby)
                ->group($groupby);
        //echo $dbCommand->getText();exit;
        $rawData = $dbCommand->queryAll();
        $revenue_seller = [];$revenue_buyers =[];$leads = [];$profit = [];
        foreach ($rawData as $row) {
            $revenue_seller[$row['date']]   = ($row['vendor_price']);
            $revenue_buyers[$row['date']]   = ($row['buyer_price']);
            $profit[$row['date']] = (($row['buyer_price'] - $row['vendor_price']));
            $leads[$row['date']] = $row['total'];
        }
        return array(
            'profit' => $profit, 
            'revenue_buyer' => $revenue_buyers, 
            'revenue_seller' => $revenue_seller, 
            'leads' => $leads
        );
    }
    /*public function campain_performance() {
        $days = 7;
        $sdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $days, date('Y'))) . ' 00:00:00';
        $edate = date('Y-m-d') . ' 23:59:59';
        $date_filter = Yii::app()->request->getParam('date_filter');
        if (!empty($date_filter)) {
            $filter = explode(" - ", $date_filter);
            $count = count($filter);
            if ($count == 2) {
                $sdate = date('Y-m-d', strtotime($filter[0])) . ' 00:00:00';
                $edate = date('Y-m-d', strtotime($filter[1])) . ' 23:59:59';
            } else {
                $sdate = date('Y-m-d', strtotime($filter[0])) . ' 00:00:00';
                $edate = date('Y-m-d', strtotime($filter[0])) . ' 23:59:59';
            }
        }
        $fields = 'COUNT(id) as total,SUM(vendor_lead_price) as vendor_price,SUM(lender_lead_price) as buyer_price, DATE(sub_date) as date';
        $where = 'lead_status=1 AND sub_date BETWEEN "' . $sdate . '" AND "' . $edate . '"';
        $groupby = 'DATE(sub_date)';
        $orderby = 'sub_date desc';
        $dbCommand = Yii::app()->dbHealthinsurance->createCommand()
                ->select($fields)
                ->from("healthinsurance_submissions a_sub")
                ->where($where)
                ->order($orderby)
                ->group($groupby);
        //echo $dbCommand->getText();exit;
        $rawData = $dbCommand->queryAll();
        $revenue_seller = [];$revenue_buyers =[];$leads = [];$profit = [];
        foreach ($rawData as $row) {
            $revenue_seller[$row['date']]   = ($row['vendor_price']);
            $revenue_buyers[$row['date']]   = ($row['buyer_price']);
            $profit[$row['date']] = ($row['buyer_price'] - $row['vendor_price']);
            $leads[$row['date']] = $row['total'];
        }
        //echo '<pre>';print_r($leads);exit;
        return array(
            'profit' => $profit, 
            'revenue_buyer' => $revenue_buyers, 
            'revenue_seller' => $revenue_seller, 
            'leads' => $leads
        );
    }*/

    public function search_return_leads() {
        $criteria = new CDbCriteria();
        $criteria->select = 'id,promo_code,first_name,last_name,email,ipaddress,lead_status,lender_id,lender_lead_price,is_returned,sub_date,return_reason';
        if ($field_value = Yii::app()->getRequest()->getParam('field_value')) {
            $field = Yii::app()->getRequest()->getParam('field');
            $field_value = preg_split('/[\s,]+/', $field_value, -1, PREG_SPLIT_NO_EMPTY);
            $field_value = "'" . implode("','", $field_value) . "'";
            if ($field_value) {
                $where[] = $field . ' IN (' . $field_value . ')';
            }
        }
        if ($promo_code = Yii::app()->getRequest()->getParam('promo_code')) {
            $promo_code = preg_split('/[\s,]+/', $promo_code, -1, PREG_SPLIT_NO_EMPTY);
            $promo_codes = implode(',', $promo_code);
            if ($promo_codes) {
                $where[] = 'promo_code IN (' . $promo_codes . ')';
            }
        }
        if ($lenders = Yii::app()->getRequest()->getParam('lenders')) {
            $lenders = implode("','", $lenders);
            $rs = LenderDetails::model()->findAll(array('select'=>'id', 'condition'=>'name IN ("' . $lenders . '") '));
            $lender_id = '';
            foreach ($rs as $lender_row) {
                $lender_id .= $lender_row->id . ",";
            }
            $lender_id = substr($lender_id, 0, strlen($lender_id) - 1);
            if ($lender_id) {
                $where[] = 'lender_id IN (' . $lender_id . ')';
            }
        }
        if ($lead_status = Yii::app()->getRequest()->getParam('lead_status', '1')) {
            $where[] = ($lead_status != 'returned') ? "lead_status = '" . $lead_status . "'" : "is_returned = 1";
        }
        if ($time = Yii::app()->getRequest()->getParam('time', 'hour')) {
            switch ($time) {
                case 'hour':
                    $time_condition = " t.sub_date >=DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 HOUR)";
                    break;
                case 'day':
                    $time_condition = " t.sub_date >=DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 DAY)";
                    break;
                case 'week':
                    $time_condition = " t.sub_date >=DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 WEEK)";
                    break;
                case 'month':
                    $time_condition = " t.sub_date >= DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 MONTH)";
                    break;
                case 'quarter':
                    $time_condition = " t.sub_date >= DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -3 MONTH)";
                    break;
                case 'specific_date':
                    $filter = Yii::app()->getRequest()->getParam('filter');
                    $filter = explode(' - ', $filter);
                    $count = count($filter);
                    if ($count == 2) {
                        $date1 = date("Y-m-d", strtotime($filter[0])) . ' 00:00:00';
                        $date2 = date("Y-m-d", strtotime($filter[1])) . ' 23:59:59';
                        $time_condition = " t.sub_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";
                    } else {
                        $date = date("Y-m-d", strtotime($filter[0]));
                        $time_condition = " t.sub_date >= '" . $date . " 00:00:00' AND t.sub_date <= '" . $date . " 23:59:59'";
                    }
                    break;
                default:
                    $time_condition = " t.sub_date >= DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 HOUR)";
            }
            $where[] = $time_condition;
        }
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        $criteria->condition = $where;
        $criteria->order = 'sub_date DESC';
        return $criteria;
    }
	public function update_returned_leads($returns){
		$retuned_ids = implode(',', $returns);
		$dbCommand = Yii::app()->dbHealthinsurance->createCommand();
		$affiliate_trans_ids_array = $dbCommand->select('id')->from('healthinsurance_affiliate_transactions')->where('customer_id IN ('.$retuned_ids.')')->queryAll();
		//echo $dbCommand->getText();echo '<br>';
		foreach($affiliate_trans_ids_array as $row){
			$aff_trans_ids[] = $row['id'];
		}
		$affiliate_trans_ids = implode(',', $aff_trans_ids);
		//echo $_POST['reason'];
		//$dbCommand->update('healthinsurance_submissions', array('is_returned'=>'1'), 'id IN ('.$retuned_ids.')');
		$dbCommand->update('healthinsurance_submissions', array('is_returned'=>'1','return_reason'=>$_POST['reason']), 'id IN ('.$retuned_ids.')');
		//echo $dbCommand->getText();exit;
		$dbCommand->update('healthinsurance_affiliate_transactions', array('is_returned'=>'1'), 'id IN ('.$affiliate_trans_ids.')');
		$dbCommand->update('healthinsurance_lender_transactions', array('is_returned'=>'1'), 'affiliate_transactions_id IN ('.$affiliate_trans_ids.') AND post_status=1');
		// DISABLED EMAIL TO AFFILIATE WHEN LEAD IS RETURN , ON REQUEST FROM GEOFF(ATOMIC)
		Yii::app()->user->setFlash('success','Leads Returned Successfully.');
	}
    public function warn_affiliate($affname, $affemail, $leadname, $leademail, $leadip, $leadtime, $promo_code = false) {
        $emails = preg_split('/,|;/', $affemail, -1, PREG_SPLIT_NO_EMPTY);
        $to = implode(',', $emails);
        $headers = 'From: support@elitehealthinsurers.com' . "\r\n" .
                'Bcc: ' . VIPUL . ', ' . DEVANG;
        $subject = 'Please remove this returned lead from your Elitehealthinsurance client tally';
        $message = wordwrap('Hello Elitehealthinsurance Affiliate: ' . $affname . '(Promo Code:' . $promo_code . '),
				
	This lead returned (see below). Please subtract this returned lead from your billing report and/or invoice. Please be sure to keep your client redirect rate over 85%. Please inform your clients to wait for the confirmation page to come up on their browser for their loan details. They must wait for the lender\'s URL so we can get compensated. You can log into your Elitehealthinsurance affiliate account at http://elitebizpanel.com/index.php/healthinsurance/default/login. Thanks and all the best!

		Name:      ' . $leadname . '
		Email:     ' . $leademail . '
		IP:        ' . $leadip . '
		Time/Date: ' . $leadtime . '
				
Have a great day!
				
Sincerely,
support@elitehealthinsurers.com
elitehealthinsurers.com Support Team
				
www.elitehealthinsurers.com
We Simplify Your Finances
				
Opt Out
elitehealthinsurers.com
138-07 82nd Drive
Briarwood, NY 11435
http://elitebizpanel.com/index.php/healthinsurance/default/removeme', 70);

        /** Unset the returned ids from post and session */
        unset($_POST['return']);
        if (isset(Yii::app()->session['returned_leads_searched_parameters']['return'])) {
            $session = Yii::app()->session;
            $vars = $session['returned_leads_searched_parameters'];
            $arraylen = count($vars);
            foreach ($vars as $key=>$var) {
                if ($key == 'return') {
                    unset($vars[$key]);
                }
            }
            $session['returned_leads_searched_parameters'] = $vars;
        }
        /** Unset End */
        mail($to, $subject, $message, $headers);
    }
}
