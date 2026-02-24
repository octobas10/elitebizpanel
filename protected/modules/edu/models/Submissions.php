<?php
	/*
	** author : vatsal gadhia
	** modification : extend class changed from CActiveRecord to EModuleActiveRecord
	** modification date : 02-08-2016
	*/
	/**
	 ** Author : Vatsal Gadhia
	 ** Modification Description : way of getting connection changed (Reason - previous way gives default database connection instead of a database connection set for specific "EDU" module)
		** Previous Way :- Yii::app()->db
		** New Way      :- parent::getDbConnection()
	 ** Modification Date : 02-08-2016
	**/
class Submissions extends EModuleActiveRecord {
	public $dob_month,$dob_day,$dob_year,$new_car;
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	public function tableName(){
		return 'edu_submissions';
	}
	public function attributeLabels(){
		return array('id' => 'Customer ID');
	}
	public function rules(){
		$required_data = array();
		$required_data[] = array('lead_mode','required','message'=>'Lead Mode is required');
		$required_data[] = array('lead_mode', 'in', 'range'=>array('1', '0'), 'message'=>'lead_mode should be 0 or 1');
		$required_data[] = array('promo_code','required','message'=>'Promo Code is required');
		/**
		 * @since : 26-12-2016 12:32 PM
		 * 
		 * @functionality : Added line for sub_id save and update
		 */
		$required_data[] = array('sub_id','safe', 'except' => array('create', 'update'));
		//$required_data[] = array('sub_id','length','message'=>'Sub Id is required');
		//$required_data[] = array('zip','USPS_Validation','message'=>'Invalid Zip');
		$required_data[] = array('zip','required','message'=>'Zip is required');
		//$required_data[] = array('zip','numerical','integerOnly'=>true,'message'=>'Zip should be numeric');
		//$required_data[] = array('zip','length','min'=>5,'max'=>5,'message'=>'Zip should be numeric');
		//$required_data[] = array('zip','match','pattern'=>'/^[\-+]?[0-9]*\.?[0-9]+$/','message'=>'Invalid Zip');
		$required_data[] = array('city','length');
		$required_data[] = array('state', 'length');
		//$required_data[] = array('ssn','required','message'=>'SSN is required');
		//$required_data[] = array('ssn', 'length','is' => 9,'message'=>'SSN should be 9 character long');
		//$required_data[] = array('ssn','numerical','integerOnly'=>true,'message'=>'SSN should be numeric');
		//$required_data[] = array('monthly_income','required','message'=>'Monthly Income is required');
		$required_data[] = array('ipaddress','length');
		$required_data[] = array('highest_education','safe', 'except' => array('create', 'update'));
		$required_data[] = array('start_date','safe', 'except' => array('create', 'update'));
		$required_data[] = array('learning_peference','safe', 'except' => array('create', 'update'));
		$required_data[] = array('enrollment_time','safe', 'except' => array('create', 'update'));
		$required_data[] = array('outstanding_loan','safe', 'except' => array('create', 'update'));
		$required_data[] = array('sub_date','default','on'=>'insert','value'=>date('Y-m-d H:i:s'),'setOnEmpty'=>false);
		$required_data[] = array('is_campus_cap','default','on'=>'insert','value'=>'0','setOnEmpty'=>false);
		$required_data[] = array('universal_leadid','safe', 'except' => array('create', 'update'));
		$required_data[] = array('sub_id2','safe', 'except' => array('create', 'update'));
		if(Yii::app()->session['ping_type'] == 'post'|| Yii::app()->session['ping_type']  == 'directpost'){
			$required_data[] = array('first_name','required','message'=>'First name is required');
			$required_data[] = array('last_name','required','message'=>'Last name is required');
			$required_data[] = array('email','required','message'=>'email address is Required');
			$required_data[] = array('email','match','pattern'=>'/^[A-Za-z0-9-+_\.]+@[A-Za-z0-9-\.]+$/','message'=>'Invalid Email address');
			$required_data[] = array('phone','required','message'=>'Phone is required');
			/**
			 * author : vatsal gadhia
			 * description : phone max value change to 20
			 * date : 22-08-2016
			 */
			$required_data[] = array('phone','length','min'=>10,'max'=>20,'message'=>'phone should be numeric');
			//$required_data[] = array('phone','match','pattern'=>'/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/','message'=>'Invalid Phone');
			$required_data[] = array('mobile','required','message'=>'Mobile is required');
			$required_data[] = array('mobile','length','min'=>10,'max'=>20,'message'=>'Mobile should be numeric');
			
			$required_data[] = array('universal_leadid','required','message'=>'universal_leadid is required');
			$required_data[] = array('universal_leadid','length','min'=>1,'max'=>36,'message'=>'universal_leadid should be maximum 36 digits long');
			
			$required_data[] = array('education_level','required','message'=>'education_level is required');
			$required_data[] = array('education_level', 'in', 'range' => range('1', '9'), 'message' => 'education_level should be between 1, 9');

			//$required_data[] = array('desired_degree','required','message'=>'desired_degree is required');
			//$required_data[] = array('desired_degree', 'in', 'range' => range('1', '6'), 'message' => 'desired_degree should be between 1, 6');

			
			
			$required_data[] = array('address','required','message'=>'Address is required');
			
			/*
			** author : vatsal gadhia
			** modification description : gender field changed to safe field as if not required in new interface
			** modification date : 01-08-2016
			*/
			
			//$required_data[] = array('gender','required','message'=>'Gender is Required');
			//$required_data[] = array('gender','in','range'=>array('M','F'),'allowEmpty'=>true,'message'=>'gender should be M or F');
			$required_data[] = array('gender','safe', 'except' => array('create', 'update'));
			//$required_data[] = array('dob','required','message'=>'Date of birth is required');
			//$required_data[] = array('dob','match','pattern'=>'/^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/','message'=>'Invalid DOB Format');
			$required_data[] = array('dob','safe', 'except' => array('create', 'update'));
			//$required_data[] = array('mobile','length');
			$required_data[] = array('program_of_interest','required','message'=>'Program of Interest is required');
			//$required_data[] = array('master_degree','required','message'=>'Master Degree is required');
			//$required_data[] = array('master_degree','numerical','integerOnly'=>true,'message'=>'Master Degree should be numeric (1-yes : 0-no)');
			//$required_data[] = array('master_degree','length','min'=>1,'max'=>1,'message'=>'Master Degree should be numeric (1-yes : 0-no)');
			//$required_data[] = array('ged','required','message'=>'Ged is required');
			//$required_data[] = array('ged','numerical','integerOnly'=>true,'message'=>'Ged should be numeric');
			//$required_data[] = array('ged','length','min'=>2,'max'=>2,'message'=>'Ged should be numeric');
			//$required_data[] = array('ged','required','message'=>'Ged is required');
			//$required_data[] = array('speak_english','required','message'=>'Speak English is required');
			//$required_data[] = array('speak_english','numerical','integerOnly'=>true,'message'=>'Speak English should be numeric (1-yes : 0-no)');
			//$required_data[] = array('speak_english','length','min'=>1,'max'=>1,'message'=>'Speak English should be numeric (1-yes : 0-no)');
			$required_data[] = array('campus','required','message'=>'Campus is required');
			$required_data[] = array('military','required','message'=>'Military is required');
			$required_data[] = array('military','numerical','integerOnly'=>true,'message'=>'Military should be numeric');
			$required_data[] = array('military','length','min'=>1,'max'=>1,'message'=>'Military should be numeric');
			$required_data[] = array('grad_year','required','message'=>'Graduation Year is required');
			$required_data[] = array('grad_year','numerical','integerOnly'=>true,'message'=>'Graduation Year should be numeric','min'=>date("Y")-20,'max'=>date("Y")+1);
			$required_data[] = array('grad_year','length','min'=>4,'max'=>4,'message'=>'Graduation Year should be numeric');
			
			//$required_data[] = array('do_you_have_a_teaching_certificate','required','message'=>'do_you_have_a_teaching_certificate is required');
			//$required_data[] = array('are_you_a_registered_nurse','required','message'=>'are_you_a_registered_nurse is required');
			//$required_data[] = array('tcpa_text','required','message'=>'tcpa_text is required');
			
		}
		return $required_data;
	}
	public function getMonthsArray(){
		for($monthNum = 1; $monthNum <= 12; $monthNum++){
			$months[$monthNum] = date('F', mktime(0, 0, 0, $monthNum, 1));
		}
		return array(0 => 'Month') + $months;
	}
	public function getDaysArray(){
		for($dayNum = 1; $dayNum <= 31; $dayNum++){
			$days[$dayNum] = $dayNum;
		}
		return array(0 => 'Day') + $days;
	}
	public function getYearsArray(){
		$thisYear = date('Y', time()) - 18;
		for($yearNum = $thisYear; $yearNum >= 1971; $yearNum--){
			$years[$yearNum] = $yearNum;
		}
		return array(0 => 'Year') + $years;
	}
	public function getStayInMonthArray(){
		for($monthNum = 1; $monthNum < 12; $monthNum++){
			$months[$monthNum] =$monthNum;
		}
		return array(0 => 'Months') + $months;
	}
	public function getStayInYearArray(){
		for($yearNum = 0; $yearNum < 21; $yearNum++){
			$years[$yearNum] = $yearNum;
		}
		return array(0 => 'Years') + $years;
	}
	public function getEmpInMonthArray(){
		for($monthNum = 1; $monthNum < 12; $monthNum++){
			$months[$monthNum] =$monthNum;
		}
		return array(0 => 'Months') + $months;
	}
	public function getEmpInYearArray(){
		for($yearNum = 0; $yearNum < 21; $yearNum++){
			$years[$yearNum] = $yearNum;
		}
		return array(0 => 'Years') + $years;
	}
	public static function valid_dob($attribute,$params){
		if(($params['dob_month'] == "") && ($params['dob_day'] == "") && ($params['dob_year'] == "")){
			return false;
		}else{
			return true;
		}
	}
	public static function valid_zip($zip){
		if(strlen(trim($zip)) < 5 || !preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', trim($zip))){
			return false;
		}else {
			return true;
		}
	}
	/*public function USPS_Validation($attribute,$params){
		$zip = ($this->zip) ? $this->zip : $attribute;
		$flag = 0;
		if(!empty($zip)){
			$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$zip.'&sensor=true');
			$resjs = json_decode($response);
			foreach($resjs->results[0]->address_components as $address_component){
				if($address_component->short_name == 'US'){
					$flag = 1;
				}
			}
		}
		if($flag==1){
			return true;
		}else{
			$this->addError('zip','Invalid Zip Code');
			return false;
		}
	}*/
	public function getCityStateFromZip($zip){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('zipcode,city,UPPER(state) AS state')
		->from('zipcodes')
		->where('zipcode = '.$zip);
		$dataReader=$dbCommand->queryRow();
		return $dataReader;
	}
//	public function checkDuplicate($data){
//		$dbCommand = parent::getDbConnection()->createCommand()
//		->select('id as count')
//		->from('edu_submissions')
//		->where("email = '".$data['email']."' AND phone = '".$data['phone']."' AND last_name ='".$data['last_name']."' AND UNIX_TIMESTAMP(sub_date) > ".@strtotime('-1 month')." LIMIT 1");
//		$dataReader=$dbCommand->queryRow();
//		return $dataReader['count'];
//	}
    /*public function checkDuplicate($data){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('dup_days')
		->from('edu_affiliate_user')
		->where("id = ".$data['promo_code']);
		$dataReader=$dbCommand->queryRow();
		$dup_days = $dataReader['dup_days'];
		
		$dup_days = (isset($dup_days) && !empty($dup_days)) ? '-'.$dup_days.' days' : '-1 month'; 

		$dbCommand = parent::getDbConnection()->createCommand()
		->select('id as count')
		->from('edu_submissions')
		->where("email = '".$data['email']."' AND phone = '".$data['phone']."' AND last_name ='".$data['last_name']."' AND lead_status=1 AND sub_date > '".date('Y-m-d',strtotime($dup_days))." 00:00:00'"." LIMIT 1");
		$dataReader=$dbCommand->queryRow();
		return $dataReader['count'];
	}*/
	public function checkDuplicate($data){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('dup_days')
		->from('edu_affiliate_user')
		->where("id = ".Yii::app()->request->getParam("promo_code"));
		$dataReader=$dbCommand->queryRow();
		$dup_days = $dataReader['dup_days'];
		$dup_days = (isset($dup_days) && !empty($dup_days)) ? '-'.$dup_days.' days' : '-1 month'; 
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('id as count')
		->from('edu_submissions')
		//->where("email = '".$email."' AND phone = '".$phone."' AND last_name ='".$last_name."' AND lead_status=1 AND sub_date > '".date('Y-m-d',strtotime($dup_days))." 00:00:00'"." LIMIT 1");
		->andWhere("email=:email",array(':email'=>Yii::app()->request->getParam("email")))
		->andWhere("phone=:phone",array(':phone'=>Yii::app()->request->getParam("phone")))
		->andWhere("last_name=:last_name",array(':last_name'=>Yii::app()->request->getParam("last_name")))
		->andWhere("sub_date>=:sub_date",array(':sub_date' =>  date('Y-m-d',strtotime($dup_days))." 00:00:00'"  ))
		->limit(1);
		//echo $qry = $dbCommand->getText();exit;
		$dataReader = $dbCommand->queryRow();
		//echo '<pre>'; print_r($dataReader);exit;
		return $dataReader['count'];
	}
	
	/**
	 * @since : 14-12-2016 12:25 PM
	 * 
	 * @functionality : Changed method to get passed $Ip_address to check with promo code
	 */
	public function checkDuplicateIP($promo_code,$ip_address=''){
		$ip_address = (!empty($ip_address) ? $ip_address : $_SERVER['REMOTE_ADDR'] );
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('count(id) as ip_count')
		->from('edu_submissions')
		->where("promo_code = ".$promo_code." AND ipaddress = '".$ip_address."' AND lead_status=1");
		$dataReader=$dbCommand->queryRow();
		return $dataReader['ip_count'];
	}
	public function checkPingDuplicate($data){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('dup_days')
		->from('edu_affiliate_user')
		->where("id = ".$data['promo_code']);
		$dataReader=$dbCommand->queryRow();
		$dup_days = $dataReader['dup_days'];
		
		$dup_days = (isset($dup_days) && !empty($dup_days)) ? '-'.$dup_days.' days' : '-6 months'; 
		
		/*$dbCommand = parent::getDbConnection()->createCommand()
		->select('COUNT(id) as count')
		->from('edu_submissions')
		->where("ssn = ".$data['ssn']." AND `sub_date` > '".date('Y-m-d',strtotime($dup_days))." 00:00:00'");
		$dataReader=$dbCommand->queryRow();
		return $dataReader['count'];*/
		
		$dbCommand = parent::getDbConnection()->createCommand()
					->select('id')
					->from('edu_submissions')
					->where("ssn = ".$data['ssn']." AND `sub_date` > '".date('Y-m-d',strtotime($dup_days))." 00:00:00'");
		$dataReader = $dbCommand->queryRow();
		return $count = count($dataReader);
	}
	
	public function afterSave(){
	   /*$id = parent::getDbConnection()->getLastInsertId();
	   if($id!=0) AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'],array("customer_id"=>$id)); */

		/**
		 * @author : vatsal gadhia
		 * @description : code to get max id from submission table
		 * @since : 16-09-2016
		 */
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('MAX(bl_sub.id) as id')
		->from("edu_submissions bl_sub");
		
		$rawData = $dbCommand->queryAll();
	   	if($rawData[0]['id']!=0) {
		   	AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'],array("customer_id"=>$rawData[0]['id']));
			Yii::app()->session['submission_id'] = $rawData[0]['id'];
	   	}
	}
	public $cnt = 0;
	/**
	 * Valid Pings of Last 15 Days 
	 */
	public function submission15days(){
		$criteria=new CDbCriteria();
		$criteria->select = "count(*) AS cnt , sub_date";
		$criteria->group = "date(`sub_date`)";
		$criteria->order = "date(`sub_date`) DESC";
		$criteria->limit = "15";
		$days15 = $this->findAll($criteria);
		$xml_cat = "";
		$xml_cat .="<graph counttion='Total submissions of last 15 days' rotateNames='1' xAxisName='Last 15 days' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
		foreach ($days15 as $row) {
			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
			$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			$xml_cat .='<set name="'.substr($row['sub_date'],0,10).'" value="'.$row['cnt'].'" color="'.$color.'"/>';
		}
		return $xml_cat.="</graph>" ;
	}
	public $counterror = "";
	public $countdupli = "";
	public $count = "";
	public function exportleads(){
		$orderby = "id ASC";
		if($promo_code = Yii::app()->request->getParam("promo_code")){
			$promo_codes = implode(",", $promo_code);
			if($promo_codes){
				$where[] = "promo_code IN (".$promo_codes.")";
			}
		}
		/*if($state = Yii::app()->request->getParam("state")){
			$states = implode("','", $state);
			if($states){
				$where[] = "a_sub.state IN ('".$states."')";
			}
		}*/
		if(Yii::app()->request->getParam("status")!='-1'){
			/**
             * @since : 18-11-2016 05:01 PM
             * @functionality : Checked for returned status request to export return leads
             */
            if(Yii::app()->request->getParam("status") == '-2'){
                $where[] = "is_returned = 1";
            }else{
                $status = Yii::app()->getRequest()->getParam("status");
                $where[] = "lead_status = '".$status."'";
            }
		}
		/*if(Yii::app()->request->getParam("gender")!='-1'){
			$gender = Yii::app()->getRequest()->getParam("gender");
			$gender = ($gender=='1') ? 'M' : 'F';
			$where[] = "a_sub.gender = '".$gender."'";
		}*/
		/*if(Yii::app()->request->getParam("lead_type")!='-1'){
			$lead_type = Yii::app()->getRequest()->getParam("lead_type");
			$where[] = "a_sub.is_organic = '".$lead_type."'";
		}*/
		if($filter = Yii::app()->request->getParam('filter_date',date("Y-m-d"))){
			$time_condition = '';
			$filter = explode(' - ',$filter);
			$count =  count($filter);
			if($count == 2){
				$date1 =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$date2 =  date("Y-m-d", strtotime($filter[1])).' 23:59:59';
				$time_condition .="sub_date BETWEEN '".$date1."' AND '".$date2."' ";
			}else{
				$date =  date("Y-m-d", strtotime($filter[0]));
				$time_condition .="sub_date BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59' ";
			}
			$where[] = $time_condition;
		}
		/*if($age = Yii::app()->request->getParam('age')){
			//CURDATE() replaced with date("Y-m-d")
			$where[] = 'YEAR('.date("Y-m-d").')-YEAR(date_format(str_to_date(dob,"%d/%m/%Y"),"%Y-%m-%d")) > "'.$age.'"';
		}*/
		if(Yii::app()->request->getParam('order')!='-1'){
			$order = Yii::app()->request->getParam('order');
			$orderby = 'id '.$order;
		}
		if($fields_requested = Yii::app()->request->getParam('fields')){
			$fields = implode(",",$fields_requested);
		}else{
			$fields_request = array("id","promo_code","first_name","last_name","sub_date","email");
			$fields = '';
			foreach ($fields_request as $value){
				$fields .= $value.',';
			}
		}
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		// print_r($fields);
		// print_r($where); die();
		$rawData = parent::getDbConnection()->createCommand()
		->select($fields)
		->from("edu_submissions")
		->where($where)
		->order($orderby)
		->queryAll();
		// print_r($rawData);
		return $rawData;
	}
	public function browseleads(){
		$criteria = new CDbCriteria();
		if($promo_code = Yii::app()->getRequest()->getParam('promo_code')){
			if(!is_array($promo_code)){ $promo_code = explode(' ', $promo_code); }
			$promo_codes = implode(',', $promo_code);
			if($promo_codes){
				$where[] = 'promo_code IN ('.$promo_codes.')';
			}
		}
		if($lenders = Yii::app()->getRequest()->getParam('lender_name')){
			/*$lenders = implode("','",$lenders);
			$rs =  LenderDetails::model()->findAll(array('select'=>'id','condition'=>'name IN ("'.$lenders.'") '));
			$lender_ids = '';
			foreach($rs as $sub_row){
				$lender_ids .= $sub_row->id.",";
			}
			$lender_ids = substr($lender_ids,0,strlen($lender_ids)-1);
			if($lender_ids){
				$where[] = 'lender_id IN ('.$lender_ids.')';
			}*/
			if(!is_array($lenders)){ $lenders = explode(' ', $lenders); }
			$lenders = implode(',', $lenders);
			if($lenders){
				$where[] = 'lender_id IN ('.$lenders.')';
			}
		}
		if(Yii::app()->getRequest()->getParam('lead_status')!='' && Yii::app()->getRequest()->getParam('lead_status')!='2'){
			$lead_status = Yii::app()->getRequest()->getParam('lead_status');
			$where[] = "lead_status = ".$lead_status;
		}
		if(Yii::app()->getRequest()->getParam('lead_status')=='2'){
			$where[] = "is_returned = 1";
		}
		if($filter = Yii::app()->getRequest()->getParam('filter_date',date("Y-m-d"))){
			$time_condition = '';
			$filter = explode(' - ',$filter);
			$count =  count($filter);
			if($count == 2){
				$date1 =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$date2 =  date("Y-m-d", strtotime($filter[1])).' 23:59:59';
				$time_condition =" sub_date BETWEEN '".$date1."' AND '".$date2."' ";
			}else{
				$date =  date("Y-m-d", strtotime($filter[0]));
				$time_condition .=" sub_date >= '".$date." 00:00:00' AND sub_date <= '".$date." 23:59:59'";
			}
			$where[] = $time_condition;
		}
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		$criteria->condition = $where;
		$criteria->order = 'sub_date DESC';
		return $criteria;
	}	
	public function getDurationSubmissions(){
		//CURDATE() replaced with date("Y-m-d")
		$combine_data_query = 'SELECT SUM(if(sub_date >= DATE_SUB(date("Y-m-d"),INTERVAL 1 WEEK) , 1, 0)) as week_submission, SUM(if(sub_date >= DATE_SUB('.date("Y-m-d").',INTERVAL 1 MONTH) , 1, 0)) as month_submission FROM edu_submissions';
		$command = parent::getDbConnection()->createCommand($combine_data_query);
		return $row = $command->queryRow();
	}
	public function lead_info_reports(){
		$promo_code = Yii::app()->getRequest()->getParam('promo_code');
		$campus = Yii::app()->getRequest()->getParam('campus');
		$lender_lead_price = Yii::app()->getRequest()->getParam('lead_price');
		$lender = Yii::app()->getRequest()->getParam('lender');
		$start_date = Yii::app()->getRequest()->getParam('start_date');
		$end_date = Yii::app()->getRequest()->getParam('end_date');
		$is_returned = Yii::app()->getRequest()->getParam('is_returned');
		$valid = Yii::app()->getRequest()->getParam('valid');
		$final = Yii::app()->getRequest()->getParam('final');
		$posting_type = Yii::app()->getRequest()->getParam('posting_type');
		$lender_id = '';
		if($lender){
			$lender_details_model = new LenderDetails();
			$lender_detail = $lender_details_model->find(array('condition'=>'name="'.$lender.'"'));
			$lender_id = isset($lender_detail->id) ? $lender_detail->id : '';
		}
		$where[] = $promo_code ? "promo_code = ".$promo_code : '';
		$where[] = $campus ? " campus = '".$campus."'" : '';
		$where[] = $lender_lead_price ? "lender_lead_price = ".$lender_lead_price : '';
		$where[] = $lender_id ? "lender_id = '".$lender_id."'" : '';
		$where[] = $start_date ? "sub_date >= '".$start_date." 00:00:00'" : '';
		$where[] = $end_date ? "sub_date <= '".$end_date." 23:59:59'" : '';
		$where[] = "lead_status = 1";
		$where[] = isset($posting_type) ? "posting_type = $posting_type" : '';
		$where[] = ($is_returned==1) ? "is_returned=1" : ""; 
		$where[] = ($valid==1) ? "is_returned is null" : ""; 
		$where[] = ($final==1) ? " is_returned IS NULL" : ""; 
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$orderby = 'sub_date desc';
		//echo '<pre>';print_r($where);exit;
		$rawData = parent::getDbConnection()->createCommand()
		->select('promo_code,first_name,last_name,email,campus,program_of_interest,zip,ipaddress,lender_id,sub_date,lender_lead_price')
		->from('edu_submissions')
		->where($where)
		->order($orderby)
		->queryAll();
		return $rawData;
	}
	public function lead_info_posted_leads(){
		$promo_code = Yii::app()->getRequest()->getParam('promo_code');
		$ping_status = Yii::app()->getRequest()->getParam('ping_status');
		$post_sent = Yii::app()->getRequest()->getParam('post_sent');
		$post_status = Yii::app()->getRequest()->getParam('post_status');
		$lead_price = Yii::app()->getRequest()->getParam('lead_price');
		$start_date = Yii::app()->getRequest()->getParam('start_date');
		$end_date = Yii::app()->getRequest()->getParam('end_date');
		$is_returned = Yii::app()->getRequest()->getParam('is_returned');
		$posting_type = Yii::app()->getRequest()->getParam('posting_type');
		$where[] = $promo_code ? "promo_code = ".$promo_code : '';
		$where[] = $lead_price ? "post_price = ".$lead_price." AND post_status=1" : '';
		// $where[] = ($ping_status==1) ? "ping_status = 1" : '';
		$where[] = ($post_sent==1) ? "post_request != '' " : '';
		$where[] = ($post_status==1) ? "post_status = 1" : '';
		$where[] = $start_date ? "date >= '".$start_date." 00:00:00'" : '';
		$where[] = $end_date ? "date <= '".$end_date." 23:59:59'" : '';
		$where[] = $is_returned=='0' ? "(is_returned=0 OR is_returned IS NULL)" : $is_returned;
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$rawData = parent::getDbConnection()->createCommand()
		->select('customer_id')
		->from('edu_affiliate_transactions')
		->where($where)
		->order('')
		->queryAll();
		$customer_id = [1];$subData = [];
		if($rawData){
			foreach($rawData as $row){
				$customer_id[] = $row['customer_id'];
			}
			$customer_id = array_filter($customer_id);
			$customer_id = implode(',', $customer_id);
			$subData = Submissions::model()->findAll(["condition"=>"id IN ($customer_id)"]);
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
		$dbCommand = parent::getDbConnection()->createCommand()
                ->select($fields)
                ->from("edu_submissions a_sub")
                ->where($where)
                ->order($orderby)
                ->group($groupby);
		//echo $dbCommand->getText();exit;
        $rawData = $dbCommand->queryAll();
        $revenue_seller = [];$revenue_buyers =[];$leads = [];$profit = [];
        foreach ($rawData as $row) {
			$revenue_seller[$row['date']] 	= ($row['vendor_price']);
			$revenue_buyers[$row['date']] 	= ($row['buyer_price']);
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
	public function search_return_leads(){
		$criteria = new CDbCriteria();
		$criteria->select = 't.id,t.promo_code,t.first_name,t.last_name,t.email,t.ipaddress,t.lead_status,t.lender_id,t.lender_lead_price,t.is_returned,t.sub_date,edu_len_d.name as lender_id,edu_aff_d.user_name as gender,return_reason';
		$criteria->join = 'LEFT JOIN edu_lender_details edu_len_d on edu_len_d.id=t.lender_id';
		$criteria->join .= ' JOIN edu_affiliate_user edu_aff_d on edu_aff_d.id=t.promo_code';
		if($field_value = Yii::app()->getRequest()->getParam('field_value')){
			$field = "t.".Yii::app()->getRequest()->getParam('field');
			$field_value = preg_split('/[\s,]+/', $field_value, -1, PREG_SPLIT_NO_EMPTY);
			$field_value = "'".implode("','",$field_value)."'";
			if($field_value){
				$where[] = $field.' IN ('.$field_value.')';
			}
		}
		//echo '<pre>';print_r($_POST);exit;
		if($promo_code = Yii::app()->getRequest()->getParam('promo_code')){
			$promo_code = preg_split('/[\s,]+/', $promo_code, -1, PREG_SPLIT_NO_EMPTY);
			$promo_codes = implode(',', $promo_code);
			if($promo_codes){
				$where[] = 't.promo_code IN ('.$promo_codes.')';
			}
		}
		$USPS_postal_verified = Yii::app()->getRequest()->getParam('USPS_postal_verified');
		if($USPS_postal_verified == '1' OR $USPS_postal_verified == '0'){
			$where[] = 't.USPS_postal_verified = '.$USPS_postal_verified.'';
		}
		$xverify_email = Yii::app()->getRequest()->getParam('xverify_email');
		if($xverify_email == '1' OR $xverify_email == '0'){
			$where[] = 't.xverify_email = '.$xverify_email.'';
		}
		//echo '<pre>';print_r($where);exit;
		if($lenders = Yii::app()->getRequest()->getParam('lenders')){
			$lenders = implode("','",$lenders);
			$rs =  LenderDetails::model()->findAll(array('select'=>'id','condition'=>'name IN ("'.$lenders.'") '));
			$lender_id = '';
			foreach($rs as $lender_row){
				$lender_id .= $lender_row->id.",";
			}
			$lender_id = substr($lender_id,0,strlen($lender_id)-1);
			if($lender_id){
				$where[] = 't.lender_id IN ('.$lender_id.')';
			}
		}
		$lead_status = Yii::app()->getRequest()->getParam('lead_status',1);
		$is_returned = Yii::app()->getRequest()->getParam('is_returned');
		
		if($is_returned == '1'){
			$where[] =  "t.is_returned = '".$is_returned."'";
		}else if($is_returned == '0'){
			$where[] =  "t.is_returned is null ";
		}
		$where[] =  "t.lead_status = '".$lead_status."'";
		//echo'<pre>';print_r($where);echo'</pre>';exit; 
		
		if($time = Yii::app()->getRequest()->getParam('time','hour')){
			switch($time){
				case 'hour':
					$time_condition =" t.sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 HOUR)";
					break;
				case 'day':
					$time_condition =" t.sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 DAY)";
					break;
				case 'week':
					$time_condition =" t.sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 WEEK)";
					break;
				case 'month':
					$time_condition =" t.sub_date >= DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 MONTH)";
					break;
				case 'quarter':
					$time_condition =" t.sub_date >= DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -3 MONTH)";
					break;
				case 'specific_date':
					$filter = Yii::app()->getRequest()->getParam('filter');
					$filter = explode(' - ',$filter);
					$count =  count($filter);
					if($count == 2){
						$date1 =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
						$date2 =  date("Y-m-d", strtotime($filter[1])).' 23:59:59';
						$time_condition =" t.sub_date BETWEEN '".$date1."' AND '".$date2."' ";
					}else{
						$date =  date("Y-m-d", strtotime($filter[0]));
						$time_condition =" t.sub_date >= '".$date." 00:00:00' AND t.sub_date <= '".$date." 23:59:59'";
					}
					break;
				default:
					$time_condition =" t.sub_date >= DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 HOUR)";
			}
			$where[] = $time_condition;
		}
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		//echo '<pre>';print_r($where);exit;
		$criteria->condition = $where;
		$criteria->order = 't.sub_date DESC';
		return $criteria;
	}
	public function update_returned_leads($returns){
		$retuned_ids = implode(',', $returns);
		$dbCommand = parent::getDbConnection()->createCommand();
//		$affiliate_trans_ids_array = $dbCommand->select('id')->from('edu_affiliate_transactions')->where('customer_id IN ('.$retuned_ids.')')->queryAll();
        $affiliate_trans_ids_array = $dbCommand->select('edu_aff_tra.id,edu_aff_tra.vendor_post_price,edu_aff_tra.promo_code,edu_aff_user.bucket,edu_aff_user.bucket_limit,edu_aff_user.pixel_count')->from('edu_affiliate_transactions edu_aff_tra')->join('edu_affiliate_user edu_aff_user', 'edu_aff_tra.promo_code=edu_aff_user.id')->where('customer_id IN ('.$retuned_ids.')')->queryAll();
		foreach($affiliate_trans_ids_array as $row){
			$aff_trans_ids[] = $row['id'];
			if(isset($row['promo_code']) && !empty($row['promo_code']) && isset($row['vendor_post_price']) && !empty($row['vendor_post_price']) && isset($row['bucket_limit']) && !empty($row['bucket_limit'])) {
				$i_cut_from_bucket = ($row['vendor_post_price'] % $row['bucket_limit']);
				$i_cut_from_count = floor(($row['vendor_post_price'] / $row['bucket_limit']));
				$i_changed_bucket = $row['bucket'] - $i_cut_from_bucket;
				$i_changed_pixel_count = $row['pixel_count'] - $i_cut_from_count;
				if($i_changed_pixel_count<0){
					$i_changed_pixel_count = 0;
				}
				if($i_changed_bucket<0){
					$i_changed_bucket = 0;
				}

				$dbCommand->update('edu_affiliate_user', array('pixel_count'=>$i_changed_pixel_count,'bucket'=>$i_changed_bucket),'id=:id',array(':id' => $row['promo_code']));
				unset($row['promo_code'],$row['vendor_post_price'],$row['bucket_limit'],$i_changed_bucket,$i_changed_pixel_count);
			}
		}
		/**
		 * @since : 17-11-2016 12:27 PM
		 * 
		 * @functionality : Check for return reason set or not.
		 */
		$s_reason = (Yii::app()->getRequest()->getPost('reason') ? Yii::app()->getRequest()->getPost('reason') : NULL);
		$affiliate_trans_ids = implode(',', $aff_trans_ids);
		$dbCommand->update('edu_submissions', array('is_returned'=>'1','return_reason'=>$_POST['reason']), 'id IN ('.$retuned_ids.')');
		/**
		 * @since : 17-11-2016 12:27 PM
		 * 
		 * @functionality : Update Reject reason for return leads
		 */
		$dbCommand->update('edu_affiliate_transactions', array('is_returned'=>'1','return_reason' => $s_reason), 'id IN ('.$affiliate_trans_ids.')');
		$dbCommand->update('edu_lender_transactions', array('is_returned'=>'1'), 'affiliate_transactions_id IN ('.$affiliate_trans_ids.') AND post_status=1');
		// DISABLED EMAIL TO AFFILIATE WHEN LEAD IS RETURN , ON REQUEST FROM GEOFF(ATOMIC)
		/*$dbCommand = parent::getDbConnection()->createCommand()
			->select('CONCAT(a.first_name, " ", a.last_name) AS leadname, a.email AS leademail, a.ipaddress AS leadip, a.promo_code, a.sub_date AS leadtime,CONCAT(b.first_name, " ", b.last_name) AS affname, b.email AS affemail')
			->from('edu_submissions as a')
			->join('edu_affiliate_user as b','a.promo_code = b.id')
			->where('a.id IN ('.$retuned_ids.')');
		
		$dbRows = $dbCommand->queryAll();
		foreach($dbRows as $dbrow){
			$this->warn_affiliate($dbrow['affname'], $dbrow['affemail'], $dbrow['leadname'], $dbrow['leademail'], $dbrow['leadip'], $dbrow['leadtime'], $dbrow['promo_code']);
		}*/
		Yii::app()->user->setFlash('success','Leads Returned Successfully.');
	}
	/**
	  * @author : vatsal gadhia
	  * @description : code to update lead status, lender and vendors price and lender_id, ipaddress
	  * @since : 17-09-1992
	*/
	public function update_lead_status_price($vendor_lead_price='',$lender_lead_price='',$customer_id='',$affiliate_trans_id=''){
		$lender_id = 0;
		$ledner_trans_dbCommand = parent::getDbConnection()->createCommand()
		->select('lender_name')
		->from('edu_lender_transactions')
		->where('affiliate_transactions_id = '.$affiliate_trans_id);
		$t_ledner_trans=$ledner_trans_dbCommand->queryRow();
		
		if(isset($t_ledner_trans) && !empty($t_ledner_trans)) {
			$lender_name = $t_ledner_trans['lender_name'];
			$ledner_details_dbCommand = parent::getDbConnection()->createCommand()
			->select('id')
			->from('edu_lender_details')
			->where('name = "'.$lender_name.'"');
			$t_ledner_details=$ledner_details_dbCommand->queryRow();
			if(isset($t_ledner_details) && !empty($t_ledner_details)) {
				$lender_id = $t_ledner_details['id'];
			}
		}

		$ipaddress = Yii::app()->request->getParam("ipaddress");
		if(empty($ipaddress)) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		}
		$dbCommand = parent::getDbConnection()->createCommand();
		$dbCommand->update('edu_submissions', array('lender_lead_price' => $lender_lead_price,'vendor_lead_price' => $vendor_lead_price,'lead_status' => '1','lender_id'=>$lender_id,'ipaddress'=>$ipaddress),'id=:id',array(':id' => $customer_id));
	}
	public function warn_affiliate($affname, $affemail, $leadname, $leademail, $leadip, $leadtime,$promo_code=false) {
		$emails = preg_split('/,|;/', $affemail, -1, PREG_SPLIT_NO_EMPTY);
		$to = implode(',', $emails);
		$headers = 'From: support@higherlearningmarketers.com'."\r\n".
				'Bcc: '.VIPUL.', '.DEVANG;
		$subject = 'Please remove this returned lead from your Higher Learning Marketers client tally';
		$message = wordwrap('Hello Higher Learning Marketers Affiliate: '.$affname.'(Promo Code:'.$promo_code.'),
				
	This lead returned (see below). Please subtract this returned lead from your billing report and/or invoice. Please be sure to keep your client redirect rate over 85%. Please inform your clients to wait for the confirmation page to come up on their browser for their loan details. They must wait for the lender\'s URL so we can get compensated. You can log into your Higher Learning Marketers affiliate account at http://elitebizpanel.com/index.php/edu/default/login. Thanks and all the best!

		Name:      '.$leadname.'
		Email:     '.$leademail.'
		IP:        '.$leadip.'
		Time/Date: '.$leadtime.'
				
Have a great day!
				
Sincerely,
support@higherlearningmarketers.com
higherlearningmarketers.com Support Team
				
http://www.higherlearningmarketers.com/
We Simplify Your Finances
				
Opt Out
higherlearningmarketers.com
138-07 82nd Drive
Briarwood, NY 11435
http://elitebizpanel.com/index.php/edu/default/removeme', 70);
	
		/** Unset the returned ids from post and session */ 
		unset($_POST['return']);
		if(isset(Yii::app()->session['returned_leads_searched_parameters']['return'])){
			$session = Yii::app()->session;
			$vars = $session['returned_leads_searched_parameters'];
			
			$arraylen = count($vars);
			foreach($vars as $key=>$var){
				if($key == 'return'){
					unset($vars[$key]);
				}
			}
		   $session['returned_leads_searched_parameters'] = $vars;
		}
		/** Unset End */
		
		mail($to, $subject, $message, $headers);
	}

	public function update_campus_cap($affiliate_trans_id='',$i_is_campus_cap=''){
		if(isset($i_is_campus_cap) && !empty($i_is_campus_cap) && $i_is_campus_cap=='1') {
			$i_is_campus_cap = '0';

			$dbCommand = parent::getDbConnection()->createCommand();
			$dbCommand_aff = parent::getDbConnection()->createCommand();
			
			/**
			 * @since : 26-12-2016 11:55 AM
			 * 
			 * @functionality : Get customer id from getCustomerId function
			 */
			$customer_id = $this -> getCustomerId($affiliate_trans_id);
			
			$dbCommand->update('edu_submissions', array('is_campus_cap' => $i_is_campus_cap),'id=:id',array(':id' => $customer_id));
			return $dbCommand_aff->select('eat.id,eat.post_request,eat.ip')->from('edu_affiliate_transactions eat')
							->where('eat.customer_id IN ('.$customer_id.')')->queryAll();
		} else {
			/**
			 * @since : 13-12-2016 01:14 PM
			 * 
			 * @functionality : Added condition for is_campus_cap = 3
			 */
			if(isset($i_is_campus_cap) && !empty($i_is_campus_cap) && $i_is_campus_cap=='2') {
				$i_is_campus_cap = '2';
			}else if(isset($i_is_campus_cap) && !empty($i_is_campus_cap) && $i_is_campus_cap=='3') {
				$i_is_campus_cap = '3';
			} else {
				$i_is_campus_cap = '1';
			}
			if(!empty($affiliate_trans_id)) {
				$AffiliateTransactions = AffiliateTransactions::model()->findByPK($affiliate_trans_id);
				$customer_id = $AffiliateTransactions->customer_id;

				$dbCommand = parent::getDbConnection()->createCommand();
				$dbCommand->update('edu_submissions', array('is_campus_cap' => $i_is_campus_cap),'id=:id',array(':id' => $customer_id));
			}
		}
	}
	
	/**
	 * @since : 26-12-2016 11:55 AM
	 * 
	 * @functionality : Get customer id using transaction id from affiliate transaction table
	 */
	public function getCustomerId($affiliate_trans_id){		
		$AffiliateTransactions = AffiliateTransactions::model()->findByPK($affiliate_trans_id);
		return $AffiliateTransactions->customer_id;
	}

	/**
	  * @author : Vatsal Gadhia
	  * @description : function to get affiliate transaction id using submission id
	  * @since : 27-12-2016 19:35 PM
	 */
	public function getAffiliateTransactionId($submission_id){		
		$dbCommand_aff = parent::getDbConnection()->createCommand();
		$where = "customer_id = ".$submission_id;
		$dbCommand_aff = parent::getDbConnection()->createCommand()
			->select('id')
			->from('edu_affiliate_transactions')
			->where($where);
		return $dbCommand_aff->queryAll();
	}
	
	/**
	  * @author : Vatsal Gadhia
	  * @description : is_no_search parameter added to avoid search parameters
	  * @since : 28-12-2016 10:35 AM
	 */
	public function campus_cap_rejected_leads($id='',$is_no_search='0') {
		$criteria = new CDbCriteria();
		$criteria->select = 't.*,edu_at.post_response as military';
		if(isset($id) && !empty($id)) {
			if(is_array($id)) {
				$t_customer_ids = array();
				foreach ($id as $i_id) {
					$t_customer_ids[] = $this -> getCustomerId($i_id);
				}
				$where[] = 't.id IN ('.implode(',',$t_customer_ids).')';
			} else {
				$customer_id = $this -> getCustomerId($id);
				$where[] = 't.id='.$customer_id;
			}
		} else {
			$questionable_lead = Yii::app()->request->getParam('ltype');
			if($questionable_lead == 1){
				$where[] = 't.is_questionable=1';
			}
			$where[] = 't.lead_status=0';
			$where[] = 't.is_returned=0';
		}

		$is_reposted = Yii::app()->getRequest()->getParam('is_reposted');
		if((isset($is_reposted) && !empty($is_reposted)) || $is_no_search==1) {
		} else {
			$field_value = Yii::app()->getRequest()->getParam('field_value');
			if(isset($field_value) && !empty($field_value)) {
			} else if(isset($_SESSION['browse_searched_campus_cap']['field_value']) && !empty($_SESSION['browse_searched_campus_cap']['field_value'])) {
				$field_value = $_SESSION['browse_searched_campus_cap']['field_value'];
			}
			if(isset($field_value) && !empty($field_value)) {
				$field = Yii::app()->getRequest()->getParam('field');
				if(isset($field) && !empty($field)) {
				} else if(isset($_SESSION['browse_searched_campus_cap']['field']) && !empty($_SESSION['browse_searched_campus_cap']['field'])) {
					$field = $_SESSION['browse_searched_campus_cap']['field'];
				}			
				$where[] = 't.'.$field.' LIKE "%'.$field_value.'%"';
			}

			$campus = Yii::app()->getRequest()->getParam('campus');
			if(isset($campus) && !empty($campus) && $campus!='all'){
				$where[] = 't.campus = "'.$campus.'"';
			}

			$promo_code = Yii::app()->getRequest()->getParam('promo_code');
			if(isset($promo_code) && !empty($promo_code)) {
			} else if(isset($_SESSION['browse_searched_campus_cap'])) {
				$promo_code = $_SESSION['browse_searched_campus_cap']['promo_code'];
			}
			if(isset($promo_code) && !empty($promo_code)) {
				$promo_code = preg_split('/[\s,]+/', $promo_code, -1, PREG_SPLIT_NO_EMPTY);
				$promo_codes = implode(',', $promo_code);
				if($promo_codes){
					$where[] = 't.promo_code IN ('.$promo_codes.')';
				}
			}

			$time = Yii::app()->getRequest()->getParam('time');
			if(isset($time) && !empty($time)) {
			} else if(isset($_SESSION['browse_searched_campus_cap'])) {
				$time = $_SESSION['browse_searched_campus_cap']['time'];
			} else {
				$time = Yii::app()->getRequest()->getParam('time','hour');
			}

			if(isset($time) && !empty($time)) {
				switch($time){
					case 'hour':
						$time_condition =" t.sub_date >=DATE_ADD('".date('Y-m-d')."', INTERVAL -1 HOUR)";
						break;
					case 'day':
						$time_condition =" t.sub_date >=DATE_ADD('".date('Y-m-d')."', INTERVAL -1 DAY)";
						break;
					case 'week':
						$time_condition =" t.sub_date >=DATE_ADD('".date('Y-m-d')."', INTERVAL -1 WEEK)";
						break;
					case 'month':
						$time_condition =" t.sub_date >= DATE_ADD('".date('Y-m-d')."', INTERVAL -1 MONTH)";
						break;
					case 'quarter':
						$time_condition =" t.sub_date >= DATE_ADD('".date('Y-m-d')."', INTERVAL -3 MONTH)";
						break;
					case 'specific_date':
						$filter = Yii::app()->getRequest()->getParam('filter');
						if(isset($filter) && !empty($filter)) {
						} else if(isset($_SESSION['browse_searched_campus_cap'])) {
							$filter = $_SESSION['browse_searched_campus_cap']['filter'];
						}
						$filter = explode(' - ',$filter);
						$count =  count($filter);
						if($count == 2){
							$date1 =  date("Y-m-d", strtotime($filter[0]));
							$date2 =  date("Y-m-d", strtotime($filter[1]));
							$time_condition =" t.sub_date BETWEEN '".$date1."' AND '".$date2."' ";
						}else{
							$date =  date("Y-m-d", strtotime($filter[0]));
							$time_condition .=" CAST(t.sub_date AS date)='".$date."'";
						}
						break;
					default:
						$time_condition =" t.sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 HOUR)";
				}
				$where[] = $time_condition;
			}
		}
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		$criteria->join = 'JOIN edu_affiliate_transactions edu_at on edu_at.customer_id = t.id';
		$criteria->condition = $where;
		$criteria->order = 't.sub_date DESC';
		//print_r($criteria);exit;
		return $criteria;
	}
	
	/**
	 * @since : 05-12-2016 05:30 PM
	 * 
	 * @functionality : Added function to mark lead questionable
	 */
	public function markQuestionableLead($i_id){
		$dbCommand = parent::getDbConnection()->createCommand();
		$dbCommand->update('edu_submissions', array('is_questionable' => '1'),'id=:id',array(':id' => $i_id));
	}

	/**
	  * @author : Vatsal Gadhia
	  * @description : update ip address in edu_submissions
	  * @since : 12-06-2015
	 */
	public function update_ipaddress($customer_id=''){
		if(isset($customer_id) && !empty($customer_id)) {
			$ipaddress = Yii::app()->request->getParam("ipaddress");
			if(empty($ipaddress)) {
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			}
			$dbCommand = parent::getDbConnection()->createCommand();
			$dbCommand->update('edu_submissions', array('ipaddress'=>$ipaddress),'id=:id',array(':id' => $customer_id));
		}
	}
	
	/**
	 * @since : 09-12-2016 01:43 PM
	 * 
	 * @functionality : Get Details About Rejected Lead
	 */
	public function getRejectedLeadDetails($id){
		$criteria = new CDbCriteria();
		$criteria->select = 't.*,edu_at.post_response as outstanding_loan';
		$where[] = 't.id='.$id;
		$where[] = 't.redirect!="yes"';
		$where[] = 't.lead_status=0';
		$where[] = 't.is_returned=0';
		//$where[] = 't.is_campus_cap IN (1,2,3)';
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		$criteria->join = 'JOIN edu_affiliate_transactions edu_at on edu_at.customer_id = t.id';
		$criteria->condition = $where;
		$criteria->order = 't.sub_date DESC';
		return $criteria;
	}
	
	/**
	 * @since : 13-12-2016 01:32 PM
	 * 
	 * @functionality : Created Function To Make Lead Reposted
	 */
	public function updateLeadToRepostLead($i_submisson_id){
		if(!empty($i_submisson_id)) {
			$dbCommand = parent::getDbConnection()->createCommand();
			$dbCommand->update('edu_submissions', array('is_reposted' => 1),'id=:id',array(':id' => $i_submisson_id));
		}
	}
	
	/**
	 * @since : 23-12-2016 02:54 PM
	 * 
	 * @functionality : Get questionable leads and filter according to passed parameter
	 */
	public function getQuestionableLeads(){
		$promo_code = Yii::app()->request->getParam("promo_code");
		$sub_id = Yii::app()->request->getParam("sub_id");
		if(!empty($promo_code)){
			$where[] = "promo_code = '".$promo_code."'";	
		}
		if(!empty($sub_id)){
			$where[] = "sub_id = '".$sub_id."'";	
		}
		$where[] = "is_questionable = '1'";
		//$where[] = "is_campus_cap in (1,2,3)";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		/**
		 * @since : 27-12-2016 10:30 AM
		 * 
		 * @functionality : Added order by variable to display latest record first
		 */
		$orderby = 'id desc';
		$groupby[] = "promo_code";
		$groupby = array_filter($groupby);
		$groupby = (count($groupby) > 0) ? ''.implode(' , ', $groupby) : '';
		$dbCommand = parent::getDbConnection()->createCommand()
		->select("count(id) as questionable_leads,(select concat(user_name,' (',id,')') from edu_affiliate_user where id = promo_code) as affiliate_name")
		->from('edu_submissions')
		->where($where)
		->group($groupby)
		->order($orderby);
		//echo $dbCommand->getText();exit;
		return $dbRows = $dbCommand->queryAll();
	}
	
	/**
	  * @author : Vatsal Gadhia
	  * @description : get all sub_ids for particular promo_code
	  * @since : 13-01-2017 11:40
	 */
	public function getSubIDFromPromoCode($i_promo_code) {
		if(isset($i_promo_code) && !empty($i_promo_code)) {
			$dbCommand = parent::getDbConnection()->createCommand()
			->select("DISTINCT(if (sub_id = '' OR sub_id = ' ' OR sub_id = null, null, sub_id)) as sub_id")
			->from('edu_submissions')
			->where('promo_code='.$i_promo_code.' AND sub_id IS NOT NULL');
			return $dbCommand->queryAll();
		}
		return false;
	}
	public function getCampusByCampusCode($campus_code)
	{
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('campus_name')
		->from('campuses')
		->where("campus_code = '".$campus_code."'");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader)){
			return $dataReader;
		}else{
			return false;
		}
	}
}
