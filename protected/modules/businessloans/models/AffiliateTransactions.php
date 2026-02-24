<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors',1);
class AffiliateTransactions extends BusinessloansActive {
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
		return 'businessloans_affiliate_transactions';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('date','required'),
			array('ip','length'),
			array('promo_code','length'),
			array('sub_id','length'),
			//12.7.2017
			array('sub_id2','length'),
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

		$aff_tran_obj=Yii::app()->dbBusinessLoans->createCommand()
			->select('sum(ping_sent) as submissions,sum(post_accepted) as accepted')
			->from('businessloans_lenders_affiliates_transactions t')
			->where($where)
			->queryAll();
		return $aff_tran_obj;
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
	public $total_pings, $rejected_pings, $accepted_pings, $counterror, $duplicate_pings, $count, $new_pings, $accepted, $submissions, $cnt1, $state, $countdup_sub, $count_sub, $date, $leads_submitted, $ping_sent, $ping_accepted, $post_sent, $post_accepted;
	/**
	 * Accepted state wise last 15 days 
	 */
	public function acceptLaststate15days(){
		$start_date=  mktime(0, 0, 0, date('m'), date('d')-15, date('Y'));
		$end_date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$where  = "`af`.`post_status` = '1' AND UNIX_TIMESTAMP(`au`.`sub_date`) >= '".$start_date."' AND UNIX_TIMESTAMP(`au`.`sub_date`) <= '".$end_date."'";
		$accept15days = Yii::app()->dbBusinessLoans->createCommand()
	    	->select(array('count(au.id) as cnt1', 'au.state as state'))
		    ->from('businessloans_affiliate_transactions af')
		    ->join('businessloans_submissions au', 'af.customer_id=au.id')
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
		$leads15days = Yii::app()->dbBusinessLoans->createCommand()
		->select('date(date) as date,promo_code,count(id) as leads_submitted')
		->from('businessloans_affiliate_transactions')
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
			$response = '</PostResponse';
			header('Content-Type: text/xml');echo $response;exit;
		}
    	/** ---------------------- Invalid Affiliate Transaction Id ---------------------- */
	 	$invalid_tras_id=Yii::app()->dbBusinessLoans->createCommand()
    		->select('id')
    		->from('businessloans_affiliate_transactions')
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
			$response = '</PostResponse';
			header('Content-Type: text/xml');echo $response;exit;
		}
		/** ------------------------- Unaccepted Lead -------------------------------------- */
		$unaccept_tras_id=Yii::app()->dbBusinessLoans->createCommand()
			->select('id')
			->from('businessloans_affiliate_transactions')
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
			$response = '</PostResponse';
			header('Content-Type: text/xml');echo $response;exit;
		}
		/** -------------------------- Duplicate Redirection ------------------------------ */
	 	$dup_redirect_tras_id=Yii::app()->dbBusinessLoans->createCommand()
    		->select('id')
    		->from('businessloans_affiliate_transactions')
    		->where(array('and','id='.$affiliate_trans_id,'redirect="yes"'))
  		  	->query();
	 	$dup_redirect_id = count($dup_redirect_tras_id);
		//echo '<pre>';print_r($dup_redirect_id);exit;
		if($dup_redirect_id>5){
			$response = '<?xml version="1.0"?>';
			$response = '<PostResponse>';
			$response .='<Response>ACCEPTED</Response>';
			$response .='<Errors>';
			$response .='<Reason>Already Redirect Redirected:'.$affiliate_trans_id.'</Reason>';
			$response .='</Errors>';
			$response = '</PostResponse';
			header('Content-Type: text/xml');echo $response;exit;
		}
  		/** ------------------- Now this is Valid Affiliate Transaction Id ----------------------------- */
		$AffiliateTransactions = AffiliateTransactions::model()->findByPK($affiliate_trans_id);
		$customer_id = $AffiliateTransactions->customer_id;
  		/** ------------------- Update affiliate transactions table "redirect=yes" ------------------------ */
	 	Yii::app()->dbBusinessLoans->createCommand()->update('businessloans_affiliate_transactions', array(
			'redirect'=>'yes',
		), 'id=:id', array(':id'=>$affiliate_trans_id));

	 	/** -------------------- Update submissions table "redirect=yes" ----------------------------------- */
		Yii::app()->dbBusinessLoans->createCommand()->update('businessloans_submissions', array(
			'redirect'=>'1',
			'redirect_ip'=>$_SERVER['REMOTE_ADDR'],
		), 'id=:id', array(':id'=>$customer_id));
		
		if($process=='organic'){
			/** Update bucket and return pixel count(How many time pixel code will run). */
			$pixel = AffiliateUser::update_bucket_and_return_pixel_count();
		}else{
			$pixel=0;
		}
		$LenderTransactions = new LenderTransactions();
		$exit_url = $LenderTransactions->exit_url($affiliate_trans_id);
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
		$where[] = "a.ping_request != ''";
		
		
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		
		$order = "a.date DESC";
		$groupby = "DATE(a.date),a.promo_code,a.ping_price";
		
		$dbCommand = Yii::app()->dbBusinessLoans->createCommand()
		->select('DATE(a.date) AS date, a.promo_code, a.ping_price, b.user_name, SUM(ping_request != "") as ping_sent , SUM(ping_status=1) as ping_accepted, SUM(post_request != "") as post_sent, SUM(post_status=1) as post_accepted, SUM(is_returned = 1) as returned')
		->from('businessloans_affiliate_transactions as a')
		->join('businessloans_affiliate_user as b','a.promo_code = b.id')
		->where($where)
		->group($groupby)
		->order($order);
		
		$dbRows = $dbCommand->queryAll();
		
		$postedleads = $postedleads_promo_codes = $postedleads_dates = $postedleads_result = $postedleads_ping_prices = array();
		
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
				if (!(in_array(trim($dbRow['ping_price']), $postedleads_ping_prices)))
					$postedleads_ping_prices[] = $dbRow['ping_price'];
				
				$postedleads_result[$dbRow['promo_code']][$dbRow['ping_price']]['post_accepted'] += $dbRow['post_accepted'];
			}
			$postedleads_result[$dbRow['promo_code']]['returned'] += $dbRow['returned'];
		}
		
		$postedleads['postedleads_promo_codes'] = $postedleads_promo_codes;
		$postedleads['postedleads_dates'] = $postedleads_dates;
		$postedleads['postedleads_ping_prices'] = $postedleads_ping_prices;
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
		$dbCommand = Yii::app()->dbBusinessLoans->createCommand()
		->select("DATE(date) AS date, COUNT(id) AS ping_sent ,
			SUM(ping_response regexp 'Duplicate') as duplicate_ping ,
			SUM(ping_status=1) as ping_accepted ,
			SUM(post_request!='') as post_sent,
			SUM(post_status=1) as post_accepted,
			SUM(is_returned=1) as lead_returned,
			SUM(IF((post_status=1 AND (is_returned=0 OR is_returned IS NULL)),vendor_post_price,0)) as revenue")
		->from('businessloans_affiliate_transactions')
		->where("promo_code = ".$promo_code." AND `date` <= '".$edate."' AND `date` >= '".$sdate."'")
		->group("DATE(date)")
		->order("date DESC");
		$dbRows = $dbCommand->queryAll();
		//echo '<pre>';print_r($dbRows);exit;
		if(!empty($dbRows)){
			return $dbRows;
		}else{
			return [];
		}
	}
	/**
	 * Lead info report for affiliate when they logins 
	*/
	public function leadinfo_for_affiliate(){
		$promo_code = Yii::app()->user->id; // Get loged in user promo_code
		$promo_code = (Yii::app()->user->getState('roles')!='1') ? $promo_code : Yii::app()->request->getParam('promo_code');
		$ping_status = Yii::app()->getRequest()->getParam('ping_status');
		$dublicate_ping = Yii::app()->getRequest()->getParam('duplicate_ping');
		$post_sent = Yii::app()->getRequest()->getParam('post_sent');
		$post_status = Yii::app()->getRequest()->getParam('post_status');
		$lead_returned = Yii::app()->getRequest()->getParam('lead_returned');
		$final = Yii::app()->getRequest()->getParam('final');
		$date = Yii::app()->getRequest()->getParam('date');
		$where[] = $promo_code ? "promo_code = ".$promo_code : '';
		$where[] = ($ping_status==1) ? "ping_status = 1" : '';
		$where[] = ($dublicate_ping==1) ? "ping_response regexp 'Duplicate'" : '';
		$where[] = ($post_sent==1) ? "post_request != '' " : '';
		$where[] = ($post_status==1) ? "post_status = 1" : '';
		$where[] = ($lead_returned==1) ? "is_returned = 1" : '';
		$where[] = ($final==1) ? "post_status = 1 AND (is_returned = 0 OR is_returned IS null)" : '';
		$where[] = $date ? "date >= '".$date." 00:00:00'" : '';
		$where[] = $date ? "date <= '".$date." 23:59:59'" : '';
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$criteria=new CDbCriteria();
		$criteria->select = 'id,promo_code,date,ping_request,ping_response,post_request,post_response';
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
		$where[] = $promo_code ? "promo_code = ".$promo_code : '';
		$where[] = "date >= '".$sdate."'";
		$where[] = "date <= '".$edate."'";
		//$where[] = "post_status = '1'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$groupby[] = $promo_code ? "promo_code" : '';
		$groupby[] = "DATE(date)";
		$groupby = array_filter($groupby);
		$groupby = (count($groupby) > 0) ? ''.implode(' , ', $groupby) : '';
		$orderby = "date DESC";
		$dbCommand = Yii::app()->dbBusinessLoans->createCommand()
		->select("DATE(date) AS date, COUNT(id) AS ping_sent , SUM(ping_response regexp 'Duplicate') as duplicate_ping , SUM(ping_status=1) as ping_accepted , SUM(post_request!='') as post_sent , SUM(post_status=1) as post_accepted , SUM(is_returned='1') as lead_returned , SUM(IF((post_status='1' AND (is_returned is null OR is_returned = '0')), vendor_post_price , 0)) as revenue, SUM(IF((post_status='1' AND is_returned='1'), vendor_post_price , 0)) as returndollar")
		->from('businessloans_affiliate_transactions')
		->where($where)
		->group($groupby)
		->order($orderby);
		//echo $dbCommand->getText();exit;
		return $dbRows = $dbCommand->queryAll();
	}
}
