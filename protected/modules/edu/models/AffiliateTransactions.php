<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors',1);
class AffiliateTransactions extends EModuleActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'edu_affiliate_transactions';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		/**
		 * @since : 17-11-2016 12:19 PM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Added field rules for "return_reason" field.
		 */
		return array(
			array('date','required'),
			array('ip','length'),
			array('promo_code','length'),
			array('sub_id','length'),
			array('customer_id','length'),
			array('ping_request','length'),
			array('ping_response','length'),
			array('ping_status','length'),
			array('ping_time','length'),
			array('ping_price','length'),
			array('post_request','length'),
			array('post_response','length'),
			array('post_status','length'),
			array('post_time','length'),			
			array('return_reason','safe', 'except' => array('create', 'update'))
		);
	}
	
	/**
     * @return array relational rules.
    */
    public function relations() {
        return array(
            'lender_trnas' => array(self::HAS_MANY, 'LenderTransactions', 'affiliate_transactions_id', 'order'=>'lender_trnas.ping_price DESC'),
        		'submissions' => array(self::HAS_ONE, 'Submissions', '', 'on' => 't.customer_id=submissions.id'),
        );
    }
	/*
	** Vatsal Gadhia - code get affiliate transaction counts
	*/
	public function getDurationAffiliateTransactions(){
		//CURDATE() replaced with date("Y-m-d")
		$combine_data_query = 'SELECT SUM(if(date >= DATE_SUB("'.date("Y-m-d").'",INTERVAL 1 WEEK) , 1, 0)) as week_submission, SUM(if(date >= DATE_SUB("'.date("Y-m-d").'",INTERVAL 1 MONTH) , 1, 0)) as month_submission FROM edu_affiliate_transactions';
		$command = parent::getDbConnection()->createCommand($combine_data_query);
		return $row = $command->queryRow();
	}
	/**
	 * Affiliate Transactions when he logins 
	 */
	public function browse_aff_transction() {
		$id =  Yii::app()->user->id;
		$where[] = 'promo_code = '.$id;
		if($time = Yii::app()->getRequest()->getParam('time','hour')){
			switch($time){
				case 'hour':
					$time_condition =" t.date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 HOUR)";
					break;
				case 'day':
					$time_condition =" t.date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 DAY)";
					break;
				case 'week':
					$time_condition =" t.date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 WEEK)";
					break;
				case 'month':
					$time_condition =" t.date >= DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 MONTH)";
					break;
				case 'quarter':
					$time_condition =" t.date >= DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -3 MONTH)";
					break;
				case 'specific_date':
					$filter = Yii::app()->getRequest()->getParam('filter');
					$filter = explode(' - ',$filter);
					$count =  count($filter);
					if($count == 2){
						$date1 =  date("Y-m-d", strtotime($filter[0]));
						$date2 =  date("Y-m-d", strtotime($filter[1]));
						$time_condition =" t.date BETWEEN '".$date1."' AND '".$date2."' ";
					}else{
						$date =  date("Y-m-d", strtotime($filter[0]));
						$time_condition .=" CAST(t.date AS date)='".$date."'";
					}
					break;
				default:
					$time_condition =" t.date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 HOUR)";
			}
			$where[] = $time_condition;
		}
		//echo $where;
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';

		$aff_tran_obj=parent::getDbConnection()->createCommand()
			->select('sum(ping_sent) as submissions,sum(post_accepted) as accepted')
			->from('edu_lenders_affiliates_transactions')
			->where($where)
			->queryAll();
		return $aff_tran_obj;
	}
        function findAffiliatetransaction($affiliate_trans_id){
        $AffiliateTransactions = AffiliateTransactions::model()->findByPK($affiliate_trans_id);
        
       // var_dump($AffiliateTransactions);
        return $AffiliateTransactions;
    }
	public function browse_search_transction(){
		$criteria = new CDbCriteria();
		$time_con_sub = '';
		if($time = Yii::app()->getRequest()->getParam('time','hour')){
			switch($time){
				case 'hour':
					$time_condition =" t.date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 HOUR)";
					$time_con_sub =" sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 HOUR)";
					break;
				case 'day':
					$time_condition =" t.date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 DAY)";
					$time_con_sub =" sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 DAY)";
					break;
				case 'week':
					$time_condition =" t.date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 WEEK)";
					$time_con_sub =" sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 WEEK)";
					break;
				case 'month':
					$time_condition =" t.date >= DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 MONTH)";
					$time_con_sub =" sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 MONTH)";
					break;
				case 'quarter':
					$time_condition =" t.date >= DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -3 MONTH)";
					$time_con_sub =" sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -3 MONTH)";
					break;
				case 'specific_date':
					$filter = Yii::app()->getRequest()->getParam('filter');
					$filter = explode(' - ',$filter);
					$count =  count($filter);
					if($count == 2){
						$date1 =  date("Y-m-d", strtotime($filter[0]))." 00:00:00";
						$date2 =  date("Y-m-d", strtotime($filter[1]))." 23:59:59";
						$time_condition =" t.date BETWEEN '".$date1."' AND '".$date2."' ";
						$time_con_sub =" sub_date BETWEEN '".$date1."' AND '".$date2."' ";
					}else{
						$date =  date("Y-m-d", strtotime($filter[0]));
						$time_condition .=" CAST(t.date AS date)='".$date."'";
						$time_con_sub .=" CAST(sub_date AS date)='".$date."'";
					}
					break;
				default:
					$time_condition =" t.date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 HOUR)";
					$time_con_sub =" sub_date >=DATE_ADD('".date('Y-m-d H:i:s')."', INTERVAL -1 HOUR)";
			}
			$where[] = $time_condition;
		}
		$lender = "";
		if(($lender_id = Yii::app()->getRequest()->getParam('lender_id')) && Yii::app()->getRequest()->getParam('post_status')!=''){
			$lender = " AND lender_id = '".$lender_id."'";
		}
		if(($field_value = Yii::app()->getRequest()->getParam('field_value')) OR $lender!=""){
			$field = Yii::app()->getRequest()->getParam('field');
			$field_value_array = preg_split('/[\s,]+/', $field_value, -1, PREG_SPLIT_NO_EMPTY);
			if(sizeof($field_value_array)>0)$field_value = "'".implode("','",$field_value_array)."'";
			if($field_value!='') $search_box = " AND ". $field." IN (".$field_value.")";
			$rs =  Submissions::model()->findAll(array('select'=>'id','condition'=>$time_con_sub.''.$lender.''.$search_box));
			$customer_id = '';
			foreach($rs as $sub_row){
				$customer_id .= $sub_row->id.",";
			}
			$customer_id = substr($customer_id,0,strlen($customer_id)-1);

			if($customer_id){
				$where[] = 'customer_id IN ('.$customer_id.')';
			}
		}
		if($promo_code = Yii::app()->getRequest()->getParam('promo_code')){
			$promo_code = preg_split('/[\s,]+/', $promo_code, -1, PREG_SPLIT_NO_EMPTY);
			$promo_codes = implode(',', $promo_code);
			if($promo_codes){
				$where[] = 'promo_code IN ('.$promo_codes.')';
			}
		}
		if($post_request = Yii::app()->getRequest()->getParam('post_request')){
			$where[] = ($post_request == '1') ? "post_request != ' '" : '';
			$where[] = ($post_request == '0') ? "post_request = ' '" : '';
		}
		if(Yii::app()->getRequest()->getParam('ping_status')!=''){
			$ping_status = Yii::app()->getRequest()->getParam('ping_status');
			$where[] = "ping_status = '".$ping_status."'";
		}
		if(Yii::app()->getRequest()->getParam('post_status')!=''){
			$post_status = Yii::app()->getRequest()->getParam('post_status');
			$where[] = "post_status = '".$post_status."'";
		}
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		$criteria->condition = $where;
		$criteria->order = 'date DESC';
		return $criteria;
	}
	public $total_pings, $rejected_pings, $accepted_pings, $counterror, $duplicate_pings, $count, $new_pings, $accepted, $submissions, $cnt1, $state, $countdup_sub, $count_sub, $date, $leads_submitted, $ping_sent, $ping_accepted, $post_sent, $post_accepted ,$post_duplicate;
	/**
	 * Accepted state wise last 15 days 
	 */
	public function acceptLaststate15days(){
		$start_date=  mktime(0, 0, 0, date('m'), date('d')-15, date('Y'));
		$end_date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$where  = "`af`.`post_status` = '1' AND UNIX_TIMESTAMP(`au`.`sub_date`) >= '".$start_date."' AND UNIX_TIMESTAMP(`au`.`sub_date`) <= '".$end_date."' AND au.lead_mode=1";
		$accept15days = parent::getDbConnection()->createCommand()
	    	->select(array('count(au.id) as cnt1', 'au.state as state'))
		    ->from('edu_affiliate_transactions af')
		    ->join('edu_submissions au', 'af.customer_id=au.id')
		    ->where($where)
			->group('state')
			->order('cnt1 DESC')
			->limit(15)
		    ->queryAll();
		$xml_cat1 = "";
		$xml_cat1 .="<graph counttion='Accepted statewise in last 15 days' rotateNames='1' xAxisName='States' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
		foreach ($accept15days as $row) {
			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
			$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			$xml_cat1 .='<set name="'.$row['state'].'" value="'.$row['cnt1'].'" color="'.$color.'"/>';
		}
		return $xml_cat1.="</graph>" ;
	}
	/**
	 * Leads Submitted Per Affiliate in Last 15 Days
	 */
	public function leads_submitted_per_affiliate_last15days(){
		$start_date=  mktime(0, 0, 0, date('m'), date('d')-15, date('Y'));
		$end_date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$where  = "UNIX_TIMESTAMP(`date`) >= '".$start_date."' AND UNIX_TIMESTAMP(`date`) <= '".$end_date."'";
		$leads15days = parent::getDbConnection()->createCommand()
		->select('date(date) as date,promo_code,count(id) as leads_submitted')
		->from('edu_affiliate_transactions')
		->where($where)
		->group('promo_code')
		->limit(15)
		->queryAll();
		$xml_cat1 = "";
		$xml_cat1 .="<graph counttion='Accepted statewise in last 15 days' rotateNames='1' xAxisName='States' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
		foreach ($leads15days as $row) {
			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
			$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			echo '<pre>';print_r($row);echo '</pre>';
		}
		return $xml_cat1.="</graph>" ;
	}
	/**
	 * Log Redirect
	 */
	public function log_redirect($affiliate_trans_id,$process) { 
		$response = '';
		/** ---------------------- Missing Affiliate Transaction Id ----------------------- */
		if(!$affiliate_trans_id){
			$response = '<?xml version="1.0" encoding="utf-8"?>';
			$response = '<PostResponse>';
			$response .='<Response>REJECTED</Response>';
			$response .='<Errors>';
			$response .='<Reason>Redirect without trans_id.</Reason>';
			$response .='</Errors>';
			$response .= '</PostResponse>';
			header('Content-Type: text/xml');echo $response;exit;
		}
    	/** ---------------------- Invalid Affiliate Transaction Id ---------------------- */
	 	$invalid_tras_id=parent::getDbConnection()->createCommand()
    		->select('id')
    		->from('edu_affiliate_transactions')
    		->where('id=:id', array(':id'=>$affiliate_trans_id))
    		->query();
		$invaliid = count($invalid_tras_id);
		if($invaliid < 1){
			$response = '<?xml version="1.0" encoding="utf-8"?>';
			$response = '<PostResponse>';
			$response .='<Response>REJECTED</Response>';
			$response .='<Errors>';
			$response .='<Reason>Redirect trans_id not found:'.$affiliate_trans_id.'</Reason>';
			$response .='</Errors>';
			$response .= '</PostResponse>';
			header('Content-Type: text/xml');echo $response;exit;
		}
		/** ------------------------- Unaccepted Lead -------------------------------------- */
		$unaccept_tras_id=parent::getDbConnection()->createCommand()
			->select('id')
			->from('edu_affiliate_transactions')
			->where(array('and','id='.$affiliate_trans_id,'post_status="1"'))
			->query();
		$unacceptid = count($unaccept_tras_id);
		if($unacceptid < 1){
			$response = '<?xml version="1.0" encoding="utf-8"?>';
			$response = '<PostResponse>';
			$response .='<Response>REJECTED</Response>';
			$response .='<Errors>';
			$response .='<Reason>Lead was not accepted:'.$affiliate_trans_id.'</Reason>';
			$response .='</Errors>';
			$response .= '</PostResponse>';
			header('Content-Type: text/xml');echo $response;exit;
		}
		/** -------------------------- Duplicate Redirection ------------------------------ */
	 	$dup_redirect_tras_id=parent::getDbConnection()->createCommand()
    		->select('id')
    		->from('edu_affiliate_transactions')
    		->where(array('and','id='.$affiliate_trans_id,'redirect="yes"'))
  		  	->query();
	 	$dup_redirect_id = count($dup_redirect_tras_id);  
		if($dup_redirect_id>0){
			
			$response = '<PostResponse>';
			$response .='<Response>ACCEPTED</Response>';
			$response .='<Errors>';
			$response .='<Reason>Already Redirect Redirected:'.$affiliate_trans_id.'</Reason>';
			$response .='</Errors>';
			$response .= '</PostResponse>';
		//	header('Content-Type: text/xml');echo $response;exit;
		}
		
  		/** ------------------- Now this is Valid Affiliate Transaction Id ----------------------------- */
		$AffiliateTransactions = AffiliateTransactions::model()->findByPK($affiliate_trans_id);
		$customer_id = $AffiliateTransactions->customer_id;
  		 
  		/** ------------------- Update affiliate transactions table "redirect=yes" ------------------------ */
	 	$valid_redirect_tras_id=parent::getDbConnection()->createCommand()->update('edu_affiliate_transactions', array(
			'redirect'=>'yes',
		), 'id=:id', array(':id'=>$affiliate_trans_id));

	 	/** -------------------- Update submissions table "redirect=yes" ----------------------------------- */
		$submission_redirect=parent::getDbConnection()->createCommand()->update('edu_submissions', array(
			'redirect'=>'yes',
			'redirect_ip'=>$_SERVER['REMOTE_ADDR'],
		), 'id=:id', array(':id'=>$customer_id));
		
		if($process=='organic'){
			$AffiliateStatus=AffiliateUser::verifyAffiliateStatus($AffiliateTransactions->promo_code);
			if($AffiliateStatus==1) {
				/** Update bucket and return pixel count(How many time pixel code will run). */
				$pixel = AffiliateUser::update_bucket_and_return_pixel_count($affiliate_trans_id);
			} else if($AffiliateStatus==2) {
				$pixel = 0;
			} else {
				$pixel = 0;
			}
		}else{
			$pixel=0;
		}
		
		$exit_url = LenderTransactions::exit_url($affiliate_trans_id);
		return array($exit_url,$pixel,$response);
	}
	/**
	 * Posted Leads Search Function
	 */
		public function search_posted_leads(){
		$criteria = new CDbCriteria();
		$criteria->select = 'promo_code, SUM(ping_request != "") as ping_sent , SUM(ping_status = 1) as ping_accepted, SUM(post_request != "") as post_sent, SUM(post_status = 1) as post_accepted';
		if($promo_code = Yii::app()->getRequest()->getParam('promo_code')){
			$promo_code = preg_split('/[\s,]+/', $promo_code, -1, PREG_SPLIT_NO_EMPTY);
			$promo_codes = implode(',', $promo_code);
			if($promo_codes){
				$where[] = 'promo_code IN ('.$promo_codes.')';
			}
		}
		
		$filter = Yii::app()->getRequest()->getParam('filter_date',date("Y-m-d"));
		$filter = explode(' - ',$filter);
		$count =  count($filter);
		if($count == 2){
			$start_date =  date("Y-m-d", strtotime($filter[0]));
			$end_date =  date("Y-m-d", strtotime($filter[1]));
		}else{
			$start_date =  date("Y-m-d", strtotime($filter[0]));
			$end_date =  date("Y-m-d", strtotime($filter[0]));
		}
		
		$where[] = $start_date ? "date >= '".$start_date." 00:00:00'" : '';
		$where[] = $end_date ? "date <= '".$end_date." 23:59:59'" : '';
		/**
		  * @author : vatsal gadhia
		  * @decription : ping_request field commented as if it is not required for edu module
		  * @since : 19-09-2016
		  * @modification : ping_price field replaced by post_price field
		  * @modified since : 19-09-2016
		 */
		//$where[] = "a.ping_request != ''";
		
		
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		
		$order = "a.date DESC";
		$groupby = "DATE(a.date),a.promo_code,a.post_price";
		
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('DATE(a.date) AS date, a.promo_code, a.post_price, b.user_name, SUM(ping_request != "") as ping_sent , SUM(ping_status=1) as ping_accepted, SUM(post_request != "") as post_sent, SUM(post_status=1) as post_accepted, SUM(is_returned = 1) as returned')
		->from('edu_affiliate_transactions as a')
		->join('edu_affiliate_user as b','a.promo_code = b.id')
		->where($where)
		->group($groupby)
		->order($order);
		
		$dbRows = $dbCommand->queryAll();
		
		$postedleads = $postedleads_promo_codes=$postedleads_dates = $postedleads_result = $postedleads_post_prices = array();
		
		foreach($dbRows as $dbRow){
			if (!(in_array(trim($dbRow['promo_code']), $postedleads_promo_codes)))
				$postedleads_promo_codes[$dbRow['promo_code']] = $dbRow['user_name'];
			
			if (!(in_array(trim($dbRow['date']), $postedleads_dates)))
				$postedleads_dates[] = $dbRow['date'];
			
			$postedleads_result[$dbRow['promo_code']]['total_ping_sent'] +=  $dbRow['ping_sent'];
			$postedleads_result[$dbRow['promo_code']]['total_ping_accepted'] +=  $dbRow['ping_accepted'];
			$postedleads_result[$dbRow['promo_code']]['total_post_sent'] +=  $dbRow['post_sent'];
			$postedleads_result[$dbRow['promo_code']]['total_post_accepted'] +=  $dbRow['post_accepted'];
			
			if($dbRow['post_accepted']){
				if (!(in_array(trim($dbRow['post_price']), $postedleads_post_prices)))
					$postedleads_post_prices[] = $dbRow['post_price'];
				
				$postedleads_result[$dbRow['promo_code']][$dbRow['post_price']]['post_accepted'] += $dbRow['post_accepted'];
			}
			$postedleads_result[$dbRow['promo_code']]['returned'] += $dbRow['returned'];
		}
		$postedleads['postedleads_promo_codes'] = $postedleads_promo_codes;
		$postedleads['postedleads_dates'] = $postedleads_dates;
		$postedleads['postedleads_post_prices'] = $postedleads_post_prices;
		$postedleads['postedleads_result'] = $postedleads_result;
		return $postedleads;
	}
	/**
	 * Specific Affiliate Reports.(Displayed on affilite dashboard when affiliate login)
	 */
	public function specific_affiliate_report(){
		$promo_code = Yii::app()->user->id; // Get loged in user promo_code
		$days = 7;
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-$days,date('Y'))).' 00:00:00';
		$edate = date('Y-m-d').' 23:59:59';
		$date_filter = Yii::app()->request->getParam('date_filter');
		if(!empty($date_filter)){
			$filter = explode(" - ",$date_filter);
			$count = count($filter);
			if($count == 2){
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[1])).' 23:59:59';
			}elseif($count == 1){
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[0])).' 23:59:59';
			}
		}
		$dbCommand = parent::getDbConnection()->createCommand()
		->select("DATE(date) AS date, COUNT(id) AS ping_sent , SUM(ping_response regexp 'Duplicate') as duplicate_ping , SUM(ping_status=1) as ping_accepted , COUNT(CASE WHEN post_status IN (0,1) or (pixel_fired=1 && post_status = 1) THEN 0 END) AS 'post_sent',  COUNT(CASE WHEN (post_response regexp 'Duplicate') && post_status = -1 THEN 0 END) AS 'post_duplicate', COUNT(CASE WHEN (pixel_fired=1 && post_status = 1) or (is_organic=0 && post_status = 1) THEN 0 END) AS 'post_accepted', COUNT(CASE WHEN is_returned=1 && pixel_fired=1 THEN 0 END) AS 'lead_returned', SUM(IF((post_status=1 AND (is_returned=0 OR is_returned IS NULL)), vendor_post_price , 0)) as revenue, SUM(post_status = 0) as lead_rejected")
		->from('edu_affiliate_transactions')
		->where("promo_code = ".$promo_code."  AND `date` <= '".$edate."' AND `date` >= '".$sdate."' ")
		->group("DATE(date)")
		->order("date DESC");
		//echo "--->".$qry = $dbCommand->getText();exit;
		$dbRows = $dbCommand->queryAll();
		//echo '<pre>';print_r($dbRows);exit;
		
		
		return $dbRows = $dbCommand->queryAll();
	}
	/**
	 * Lead info report for affiliate when they logins 
	*/
	public function leadinfo_for_affiliate(){
		$b_admin_affiliate_report_flag = Yii::app()->getRequest()->getParam('AdminAffiliateReport');
		$promo_code = Yii::app()->user->id; // Get loged in user promo_code
		$promo_code = (Yii::app()->user->getState('roles')!='1') ? $promo_code : Yii::app()->request->getParam('promo_code');
		$ping_status = Yii::app()->getRequest()->getParam('ping_status');
		$dublicate_ping = Yii::app()->getRequest()->getParam('duplicate_ping');
		$post_sent = Yii::app()->getRequest()->getParam('post_sent');
		$post_status = Yii::app()->getRequest()->getParam('post_status');
		$lead_returned = Yii::app()->getRequest()->getParam('lead_returned');
		$start_date = Yii::app()->getRequest()->getParam('start_date');
		$end_date = Yii::app()->getRequest()->getParam('end_date');
		$i_lead_rejected = Yii::app()->getRequest()->getParam('lead_rejected');
		$final = Yii::app()->getRequest()->getParam('final');
		$date = Yii::app()->getRequest()->getParam('date');

		$where[] = $promo_code ? "promo_code = ".$promo_code : '';
		$where[] = ($ping_status==1) ? "ping_status = 1" : '';
		$where[] = ($dublicate_ping==1) ? "ping_response regexp 'Duplicate'" : '';
		//$where[] = ($post_sent==1) ? "post_request != '' " : '';
		//$where[] = ($post_status==1) ? "post_status = 1" : '';
		/**
		 * @since : 29-11-2016 03:45 PM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Checked role of admin for pixel_fired condition
		 */
		 /**
		 * @since : 14-12-2016 06:31 PM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Added condition for checking if request came from admin affiliate report page
		 */
		if(Yii::app()->user->getState('roles')!='1' || ($b_admin_affiliate_report_flag == 1)){
			$where[] = ($post_sent==1) ? "(post_status != 1 or (pixel_fired=1 && post_status = 1))" : '';
			if($post_status==1){
					$where[] =  "post_status = 1 and pixel_fired=1";
			}	if($post_status==-1){
					$where[] =  "post_status = -1 and post_response regexp 'Duplicate'";
			}else{
					$where[] = '';
			}
		}else{
				$where[] = ($post_status==1) ? "post_status = 1" : '';
		}
		if(Yii::app()->user->getState('roles')!='1' || ($b_admin_affiliate_report_flag == 1)){
			$where[] = ($lead_returned==1) ? "is_returned = 1 and pixel_fired=1" : '';
		}else{
			$where[] = ($lead_returned==1) ? "is_returned = 1" : '';
		}
		$where[] = ($i_lead_rejected==1) ? "post_status = 0 " : '';
		if(Yii::app()->user->getState('roles')!='1' || ($b_admin_affiliate_report_flag == 1)){
			$where[] = ($final==1) ? "post_status = 1 AND pixel_fired=1 AND (is_returned=0 OR is_returned IS NULL)" : '';
		}else{
			$where[] = ($final==1) ? "post_status = 1 AND (is_returned=0 OR is_returned IS NULL)" : '';
		}
		$where[] = $date ? "date >= '".$date." 00:00:00'" : '';
		$where[] = $date ? "date <= '".$date." 23:59:59'" : '';
		if($start_date && $end_date){
				if(isset($promo_code) && !empty($promo_code)) {
					$where[] = "promo_code = ".$promo_code;
				} else {
					$t_active_aff_ids = parent::getDbConnection()->createCommand()
					->select("GROUP_CONCAT(id) as id")
					->where('status=1')
					->from('edu_affiliate_user')
					->queryAll();
					if(isset($t_active_aff_ids) && !empty($t_active_aff_ids) && isset($t_active_aff_ids[0]['id']) && !empty($t_active_aff_ids[0]['id'])) {
						$where[] = "promo_code IN (".$t_active_aff_ids[0]['id'].")";
					}
				}
				$where[] = $start_date ? "date >= '".$start_date." 00:00:00'" : '';
				$where[] = $end_date ? "date <= '".$end_date." 23:59:59'" : '';
		}
		$where[] = "post_request LIKE '%lead_mode=1%'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$criteria=new CDbCriteria();
		$criteria->select = 'id,promo_code,date,ping_request,ping_response,post_request,post_response,sub_id,return_reason';
		$criteria->condition = $where;
		return $criteria;
	}
	/**
	 * Affiliate Stats
	 */
	public function affiliate_stats(){
		$promo_code = Yii::app()->request->getParam('promo_code');
		$days = 7;
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-$days,date('Y'))).' 00:00:00';
		$edate = date('Y-m-d').' 23:59:59';
		$date_filter = Yii::app()->request->getParam('date_filter');
		if(!empty($date_filter)){
			$filter = explode(" - ",$date_filter);
			$count = count($filter);
			if($count == 2){
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[1])).' 23:59:59';
			}elseif($count == 1){
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[0])).' 23:59:59';
			}
		}
		
		// $where[] = $promo_code ? "promo_code = ".$promo_code : '';
		if(isset($promo_code) && !empty($promo_code)) {
			$where[] = "promo_code = ".$promo_code;
		} else {
			$t_active_aff_ids = parent::getDbConnection()->createCommand()
			->select("GROUP_CONCAT(id) as id")
			->where('status=1')
			->from('edu_affiliate_user')
			->queryAll();
			if(isset($t_active_aff_ids) && !empty($t_active_aff_ids) && isset($t_active_aff_ids[0]['id']) && !empty($t_active_aff_ids[0]['id'])) {
				$where[] = "promo_code IN (".$t_active_aff_ids[0]['id'].")";
			}
		}
		$where[] = "date >= '".$sdate."'";
		$where[] = "date <= '".$edate."'";
		$where[] = "post_request LIKE '%lead_mode=1%'";
		
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		
		//$groupby[] = $promo_code ? "promo_code" : '';
		/**
		 * @since : 29-11-2016 03:20 PM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Added Promo code in group by in all condition
	 	*/
		$groupby[] = "promo_code";
		$groupby[] = "DATE(date)";
		$groupby = array_filter($groupby);
		$groupby = (count($groupby) > 0) ? ''.implode(' , ', $groupby) : '';
		
		$orderby = "date DESC";
		/**
		 * @since : 29-11-2016 03:20 PM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Added Affiliate name field fetched using subquery of edu_affiliate_user and promo_code
		*/
		$dbCommand = parent::getDbConnection()->createCommand()
		->select("DATE(date) AS date, COUNT(id) AS ping_sent , SUM(ping_response regexp 'Duplicate') as duplicate_ping , SUM(ping_status=1) as ping_accepted , SUM(post_request!='') as post_sent , SUM(post_status=1) as post_accepted , SUM(is_returned=1) as lead_returned , SUM(IF((post_status=1 AND (is_returned is null or is_returned='0')), vendor_post_price , 0)) as revenue,(select user_name from edu_affiliate_user where id = edu_affiliate_transactions.promo_code) as affiliate_name,promo_code,COUNT(CASE WHEN pixel_fired=1 && post_status = 1 THEN 0 END) AS 'affiliate_post_accepted', COUNT(CASE WHEN is_returned=1 && pixel_fired=1 THEN 0 END) AS 'affiliate_lead_returned'")
		->from('edu_affiliate_transactions')
		->where($where)
		->group($groupby)
		->order($orderby);
		return $dbRows = $dbCommand->queryAll();
	}

	function updateAffiliateTransactions($t_field_value,$i_id){
			parent::getDbConnection()->createCommand()->update('edu_affiliate_transactions',$t_field_value, 'id ='.$i_id);
	}
	function getStates(){
			$dbCommand = parent::getDbConnection()->createCommand()
			->select("distinct(state)")
			->from('edu_zipcodes');
			return $dbRows = $dbCommand->queryAll();
	}
	function getZipcodes(){
			$dbCommand = parent::getDbConnection()->createCommand()
			->select("distinct(zipcode)")
			->from('edu_zipcodes')
			->order('zipcode');
			return $dbRows = $dbCommand->queryAll();
	}
	function getLeadsWithFilter(){
				$lead_status = Yii::app()->request->getParam('lead_status');
				$s_state = Yii::app()->request->getParam('state');
				$zip_code = Yii::app()->request->getParam('zipcode');
				/**
				 * @since : 21-12-2016 09:14 PM
				 * @author : Siddharajsinh Maharaul
				 * @functionality : added condition for all to check request for all or for particular Status,State or Zipcode
				 */
				if(!empty($lead_status) && ($lead_status != 'all')){
						if($lead_status == 1){
								$where[] = " s.lead_status = 1 ";
						}else if($lead_status == 2){
								$where[] = " (s.lead_status = 0 or s.is_returned = 1) ";
						}else if($lead_status == 3){
								$where[] = " at.post_response like '%No Lender Found%' ";
						}
				}
				if(!empty($s_state) && ($s_state != 'all')){
						$where[] = " s.state = '".$s_state."' ";
				}
				if(!empty($zip_code) && ($zip_code != 'all')){
						$where[] = " s.zip = '".$zip_code."' ";
				}
				$where = array_filter($where);
				$where = (count($where) > 0) ? 'where '.implode(' AND ', $where) : '';
				$sql = "SELECT DISTINCT s.email as email,s.first_name,s.last_name,s.state,s.zip,date_format(s.sub_date,'%Y/%m/%d') as sub_date
        FROM edu_submissions s
        INNER JOIN edu_affiliate_transactions at ON at.customer_id = s.id
				".$where."
				group by s.id";
        return parent::getDbConnection()->createCommand($sql)->queryAll();
	}
	
	/**
	 * @since : 14-12-2016 05:09 PM
	 * @author : Siddharajsinh Maharaul
	 * @functionality : Get Affiliate Report for lead sent,accepted,rejected,duplicate and final leads
	 */
	public function getAffiliateReport(){
		$promo_code = Yii::app()->request->getParam('promo_code');
		$days = 7;
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-$days,date('Y'))).' 00:00:00';
		$edate = date('Y-m-d').' 23:59:59';
		$date_filter = Yii::app()->request->getParam('date_filter');
		if(!empty($date_filter)){
			$filter = explode(" - ",$date_filter);
			$count = count($filter);
			if($count == 2){
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[1])).' 23:59:59';
			}elseif($count == 1){
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[0])).' 23:59:59';
			}
		}
		if(isset($promo_code) && !empty($promo_code)) {
			$where[] = "promo_code = ".$promo_code;
		} else {
			$t_active_aff_ids = parent::getDbConnection()->createCommand()
			->select("GROUP_CONCAT(id) as id")
			->where('status=1')
			->from('edu_affiliate_user')
			->queryAll();
			if(isset($t_active_aff_ids) && !empty($t_active_aff_ids) && isset($t_active_aff_ids[0]['id']) && !empty($t_active_aff_ids[0]['id'])) {
				$where[] = "promo_code IN (".$t_active_aff_ids[0]['id'].")";
			}
		}
		$where[] = "date >= '".$sdate."'";
		$where[] = "date <= '".$edate."'";
		$where[] = "post_request LIKE '%lead_mode=1%'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$groupby[] = "promo_code";
		$groupby[] = "DATE(date)";
		$groupby = array_filter($groupby);
		$groupby = (count($groupby) > 0) ? ''.implode(' , ', $groupby) : '';

		$orderby = "date DESC";
		$dbCommand = parent::getDbConnection()->createCommand()
		->select("DATE(date) AS date, COUNT(id) AS ping_sent , SUM(ping_response regexp 'Duplicate') as duplicate_ping , SUM(ping_status=1) as ping_accepted , COUNT(CASE WHEN post_status!=1 or (pixel_fired=1 && post_status = 1) THEN 0 END) AS 'post_sent', COUNT(CASE WHEN post_response regexp 'Duplicate' && post_status=-1 THEN 0 END) AS 'post_duplicate', COUNT(CASE WHEN pixel_fired=1 && post_status = 1 THEN 0 END) AS 'post_accepted', COUNT(CASE WHEN is_returned=1 && pixel_fired=1 THEN 0 END) AS 'lead_returned', SUM(IF((post_status=1 AND (is_returned=0 OR is_returned IS NULL)), vendor_post_price , 0)) as revenue, SUM(post_status = 0) as lead_rejected,(select user_name from edu_affiliate_user where id = promo_code) as affiliate_name,promo_code")
		->from('edu_affiliate_transactions')
		->where($where)
		->group($groupby)
		->order($orderby);
		return $dbRows = $dbCommand->queryAll();
	}
}
