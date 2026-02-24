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
class FeedLenderVendorTransaction extends EModuleActiveRecord {
	public $ping_sent, $post_accepted, $lead_price, $total, $last15dayes_accepted, $last15dayes_submission, $average_ping_price, $revenue =  0;
	public $select_data = 'date,sum(ping_sent) as ping_sent,sum(post_accepted) as post_accepted,sum(post_sent) as post_sent,sum(post_accepted) as post_accepted,sum(lead_price) as lead_price';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LenderUser the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'edu_feed_lenders_vendors_transactions';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('lender,feed_vendor_id','required'),
		);
	}
	/** Check Lender Affiliate Lead Cap */
	public function check_lender_affiliate_cap($promo_code,$lender_id){
		/** Lender cap setting for perticular affilate(promo code)*/
		$where = "`affiliate_user_id`= '$promo_code' AND `lender_details_id`= '$lender_id'";
		$vendor_lender_cap = parent::getDbConnection()->createCommand()
			->select('cap,intervals')
			->from('edu_lender_affiliate_settings')
			->where($where)
			->queryAll();
		if(!empty($vendor_lender_cap)){
			$cap = $vendor_lender_cap[0]['cap'];
			$intervals = $vendor_lender_cap[0]['intervals'];
		}else{
			$cap='';
		}
		/** Todays' Lender submission from perticular affiliate(promo code) */
		$lender_data = LenderDetails::model()->findByPK($lender_id);
		$where1 = "`lender` = '$lender_data->name' AND `promo_code`= '$promo_code' AND DATE(date) = '".date('Y-m-d')."'";
		$submission_of_lender = parent::getDbConnection()->createCommand()
			->select('SUM(`ping_sent`) as todays_submission')
			->from('edu_lenders_affiliates_transactions')
			->where($where1)
			->queryScalar();
		
		/** Calculation of time interval when last lead sent */
		$time_at_last_lead_sent = parent::getDbConnection()->createCommand()
			->select('last_inserted_datetime')
			->from('edu_lenders_affiliates_transactions')
			->where($where1)
			->queryScalar();
		$time_at_last_lead_sent = strtotime($time_at_last_lead_sent);
		$time_now = strtotime(date('Y-m-d H:i:s'));
		$time_elapsed = round(abs($time_at_last_lead_sent - $time_now)/60,2);
		if((empty($time_elapsed) OR $time_elapsed=='')){
			$time_elapsed = 0;
		}
		if($cap){
			if(($time_elapsed > $intervals || $intervals=-1) && ($cap > $submission_of_lender)){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
	/**
	 * Update Lender Affiliate Transaction Table with Ping Status
	 * @param string $lender_name
	 * @param integer $promo_code
	 * @param integer $ping_status
	 * @param float $price
	 */
	public function lender_ping_status_update($lender_name,$promo_code,$ping_status,$price){
		$connection=parent::getDbConnection();
		//$price = isset($price) ? $price : 0;
		$price = isset($price) ? 0 : 0;
		$accept_query = ($ping_status==1) ? ',`ping_accepted`=`ping_accepted`+1' : '';
		
		if($ping_status==1){	
			//update edu_feed_lender table for daily counts and accepted caps 
			$sql_lender_details="UPDATE edu_feed_lenders SET dailysubmission_capcount=if(capdate='".date("Y-m-d")."',dailysubmission_capcount+1,1), dailyaccepted_capcount=if(capdate='".date("Y-m-d")."',dailyaccepted_capcount+1,1),accepted_cap=accepted_cap+1,timestamp_lastsent='".date("Y-m-d h:i:s")."' where feed_lender_name='".$lendername."'";
		}
		else{
			$ping_status=0;	
			//update edu_feed_lender table for daily counts
			$sql_lender_details="UPDATE edu_feed_lenders SET dailysubmission_capcount=if(capdate='".date("Y-m-d")."',dailysubmission_capcount+1,1), timestamp_lastsent='".date("Y-m-d h:i:s")."' where feed_lender_name='".$lendername."'";
		}
		//CURDATE() replaced with date("Y-m-d")
		$sql1="INSERT INTO edu_feed_lenders_vendors_transactions
 VALUES('".$lender_name."',$promo_code,$price,".date('Y-m-d').",1,$ping_status,0,0,now()) on duplicate key update `ping_sent`=`ping_sent`+1 $accept_query";
		//die("1");
		$command=$connection->createCommand($sql1);
		$command_lender_details=$connection->createCommand($sql_lender_details);
		$dataReader=$command->query();
		$dataReader_lender_details=$command_lender_details->query();
	}
	/**
	 * Update Lender Affiliate Transaction Table with Post Status
	 * @param string $lendername
	 * @param integer $promo_code
	 * @param integer $post_status
	 * @param float $price
	 * @param boolean $static_price_direct_post
	 */
	public function lender_post_status_update($lendername,$promo_code,$post_status,$price,$static_price_direct_post=false){
		$connection=parent::getDbConnection();
		$price = isset($price) ? 0 : 0;
		$promo_code = isset($promo_code) ? $promo_code : 2;
		$accept_query = ($post_status==1) ? ',`post_accepted`=`post_accepted`+1' : '';
		if($post_status==1){	
			//update edu_feed_lender table for daily counts and accepted caps 
			$sql_lender_details="UPDATE edu_feed_lenders SET accepted_cap=accepted_cap+1 where feed_lender_name='".$lendername."'";
			$command_lender_details=$connection->createCommand($sql_lender_details);
			$dataReader_lender_details=$command_lender_details->query();
		}
		else{
			$post_status=0;
		}
		
		if($static_price_direct_post==false){
			//CURDATE() replaced with date("Y-m-d")
			$sql1="INSERT INTO edu_feed_lenders_vendors_transactions VALUES('".$lendername."',$promo_code,$price,'".date('Y-m-d')."',1,1,1,$post_status,now()) on duplicate key update `post_sent`=`post_sent`+1 $accept_query";
		//die("2");
		}else if($static_price_direct_post==true){
			//CURDATE() replaced with date("Y-m-d")
			$sql1="INSERT INTO edu_feed_lenders_vendors_transactions VALUES('".$lendername."',$promo_code,$price,'".date('Y-m-d')."',0,0,1,$post_status,now()) on duplicate key update `post_sent`=`post_sent`+1 $accept_query";
			//echo $post_status;
		//die("3");
		}
		$command=$connection->createCommand($sql1);
		$dataReader=$command->query();
	}
	/** 
	 * Get promo_code, lender name and tier price from affiliate_transaction_id
	 */
	public function lender_details_from_affiliate_tranaction_id($affiliate_trans_id){
		$where = "`affiliate_transactions_id` = '$affiliate_trans_id' AND ping_status = '1'";
		$lender_details = parent::getDbConnection()->createCommand()
			->select('promo_code,lender_name,ping_price')
			->from('edu_lender_transactions')
			->where($where)
			->queryAll();
		return $lender_details[0];
	
	}
	/**
	 * Total Looks to Lenders Today (For Admin, Displayed on Graph Module)
	 */
	public function dailyCount(){
		$criteria=new CDbCriteria();
		$criteria->select="lender,sum(ping_sent) AS ping_sent ,SUM(ping_accepted) AS ping_accepted";
		$criteria->condition = "date='".date('Y-m-d')."'";
		$criteria->group = "lender,date";
		$dailyaccepted = $this->findAll($criteria);
		$xml_cat = "";
		$dataset_accept = "";
		$dataset_submission = "";
		$xml_graph = "";
		$xml_category = "";
		$xml_graph .="<graph counttion='Total looks to lenders Today' rotateNames='1' xAxisName='Lenders' yAxisName='Units' decimalPrecision='0' yAxisMinValue='0' yAxisMaxValue='10'  rotateNames='1' numDivLines='3'  showValues='0' formatNumberScale='0' >";
		$xml_cat .= "<categories>";
		$dataset_accept .= "<dataset seriesName='Ping Accepted' color='AFD8F8' showValues='1'>";
		$dataset_submission .= "<dataset seriesName='Ping Sent'  color='F6BD0F' showValues='1'>";
		foreach ($dailyaccepted as $row) {
			$xml_category .="<category name='".$row['lender']."' />";
			$dataset_submission .="<set value='".$row['ping_sent']."' />";
			$dataset_accept .= "<set value='".$row['ping_accepted']."' />";
		}
		$cat = $xml_cat.$xml_category.= "</categories>";
		$dataset_submission .="</dataset>";
		$dataset_accept .="</dataset>";
		return $xml_graph.$cat.$dataset_submission.$dataset_accept.="</graph>";
	}
	/**
	 * Lender Ping Post Statistics (For admin)
	 */
	public function lender_pingpost_statistics(){
		$days = 7;
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-$days,date('Y')));
		$edate = date('Y-m-d');
		$date_filter = Yii::app()->request->getParam('date_filter');
		if(!empty($date_filter)){
			$filter = explode("-",$date_filter);
			$count =  count($filter);
			if($count == 2){
				$sdate = date('Y-m-d',strtotime($filter[0]));
				$edate = date('Y-m-d',strtotime($filter[1]));
			}else{
				$sdate = date('Y-m-d',strtotime($filter[0]));
				$edate = date('Y-m-d',strtotime($filter[0]));
			}
		}
		$criteria = new CDbCriteria();
		$criteria->select = "`lender` , `date` , SUM(`ping_sent`) AS ping_sent , SUM(`ping_accepted`) AS ping_accepted , SUM(`post_sent`) AS post_sent, SUM(`post_accepted`) AS post_accepted";
		$criteria->condition = "`date` <= '".$edate."' AND `date` >= '".$sdate."'";
		$criteria->group = "`date` , `lender`";
		$criteria->order = "`date` DESC";
		return $result = $this->findAll($criteria);
	}
	/**
	 *Search
	 */
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('lender', $this->feed_lender_name);
        $criteria->compare('request', $this->request);
        $criteria->compare('full_response', $this->full_response);
        $criteria->compare('response', $this->response);
        $criteria->compare('post_url', $this->post_url);
        $criteria->compare('statuseatedAt', $this->createdAt);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria
        ));
        
    }
	/**
	 * get all lender_vendor transaction
	 */
		public function browse_lender_vendor_transactions(){
		$criteria = new CDbCriteria();
		$lender_name = Yii::app()->getRequest()->getParam('feed_lender_name');		
		/**
		 * @author : vatsal gadhia
		 * @description : way of retrieving dates changed
		 * @since : 19-09-2016
		*/
		if(isset($_SESSION['date_search_criteria']) && !empty($_SESSION['date_search_criteria'])) {
			if($_SESSION['date_search_criteria'] == Yii::app()->getRequest()->getParam('date',date('m/d/Y'))) {
			} else {
				//URL contains page text
				if(strpos(Yii::app()->request->requestUri, 'page') !== false){
				}else {
				//URL didn't contains page text
					if(date('m/d/Y')==Yii::app()->getRequest()->getParam('date',date('m/d/Y'))) {
					} else {
						$_SESSION['date_search_criteria'] = Yii::app()->getRequest()->getParam('date',date('m/d/Y'));
					}
				}
			}
		} else {
			$_SESSION['date_search_criteria'] = Yii::app()->getRequest()->getParam('date',date('m/d/Y'));
		}
		$filter = explode(' - ',$_SESSION['date_search_criteria']);
		$count = count($filter);
		$start_date = ($count == 2) ? date("Y-m-d", strtotime($filter[0])).' 00:00:00' : date("Y-m-d", strtotime($filter[0])).' 00:00:00';
		$end_date = ($count == 2) ? date("Y-m-d", strtotime($filter[1])).' 23:59:59' : date("Y-m-d", strtotime($filter[0])).' 23:59:59';
		$curr_start_date = Date("Y-m-d")." 00:00:00";
		$curr_end_date = Date("Y-m-d")." 23:59:59";
		/*if($start_date==$curr_start_date && $end_date==$curr_end_date)
		{
			$u_uri = explode("/",Yii::app()->request->requestUri);
			$t_len = count($u_uri);
			if($u_uri[$t_len-2]=="page")
			{
				$start_date = $_SESSION['start_date_search'];
				$end_date = $_SESSION['end_date_search'];
			}
		}
		else
		{
			$_SESSION['start_date_search'] = $start_date;
			$_SESSION['end_date_search'] = $end_date;
		}*/
				
		$where[] = $lender_name ? "lender = '".$lender_name."'" : '';
		$where[] = ($start_date && $end_date) ? "`date` BETWEEN '".$start_date."' AND '".$end_date."'" : '';
		//$where[] = $end_date ? "`date` <= '".$end_date."'" : '';
		
		$order = "date DESC";
		
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		$criteria->select = 'lender,feed_vendor_id,date,ping_sent,ping_accepted,post_sent,post_accepted';
		$criteria->condition = $where;
		$criteria->order = 'date DESC';
		//print_r($criteria);
		return $criteria;
	}
	/**
	 * Specific Lender Ping Report Pie Chart for Last 15 days(Displayed Lender Dashboard)
	 */
	public function specific_lender_ping_report_last_15days(){
		$lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
		$lender_name = $lender->user_name;
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-15,date('Y')));
		$edate = date('Y-m-d');
		$criteria = new CDbCriteria();
		$criteria->select = "lender , SUM(ping_sent) AS ping_sent , SUM(ping_accepted) AS ping_accepted";
		$criteria->condition = "lender = '".$lender_name."' AND `date` <= '".$edate."' AND `date` >= '".$sdate."'";
		$result = $this->find($criteria);
		if(empty($result)){
			return "No Records";
		}
		$ping_sent  = $result['ping_sent'];
		$ping_accepted = $result['ping_accepted'];
		$ping_rejected = $ping_sent - $ping_accepted;
		if($ping_sent == 0){
			return "No Records";
		}else{
			$graph = '<graph baseFontSize = "11" caption="Ping Sent '.$ping_sent.'" showNames="1" yAxisMinValue=\'0\' yAxisMaxValue=\'10\' decimalPrecision=\'0\'  showPercentageValues="1" >';
			$graph .= '<set color="#DAA520" name="Ping Accepted" value="'.$ping_accepted.'"/>';
			$graph .= '<set color="#A52A2A" name="Ping Rejected" value="'.$ping_rejected.'"/></graph>';
			return $graph;
		}
	}
	/**
	 * Specific Lender Post Report Chart for Last 15 days(Displayed Lender Dashboard)
	 */
	public function specific_lender_post_report_last_15days(){
		$lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
		$lender_name = $lender->user_name;
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-15,date('Y')));
		$edate = date('Y-m-d');
		$criteria = new CDbCriteria();
		$criteria->select = "lender , SUM(post_sent) AS post_sent , SUM(post_accepted) AS post_accepted";
		$criteria->condition = "lender = '".$lender_name."' AND `date` <= '".$edate."' AND `date` >= '".$sdate."'";
		$result = $this->find($criteria);
		if(empty($result)){
			return "No Records";
		}
		$post_sent  = $result['post_sent'];
		$post_accepted = $result['post_accepted'];
		$post_rejected = $post_sent - $post_accepted;
		if($post_sent == 0){
			return "No Records";
		}else{
			$graph = '<graph baseFontSize = "11" caption="Post Sent '.$post_sent.'" showNames="1" yAxisMinValue=\'0\' yAxisMaxValue=\'10\' decimalPrecision=\'0\'  showPercentageValues="1" >';
			$graph .= '<set color="#DAA520" name="Post Accepted" value="'.$post_accepted.'"/>';
			$graph .= '<set color="#A52A2A" name="Post Rejected" value="'.$post_rejected.'"/></graph>';
			return $graph;
		}
	}
	/**
	 * Specific Lender Post Report Chart for Last 15 days(Displayed Lender Dashboard)
	 */
	public function specific_feed_lender_post_report_last_15days(){
		$lender = EduFeedLenders::model()->findByPk(Yii::app()->user->id);
		$lender_name = $lender->feed_lender_name;
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-15,date('Y')));
		$edate = date('Y-m-d');

		$dbCommand = parent::getDbConnection()->createCommand()
		->select("COUNT(request) AS post_sent,COUNT( CASE WHEN response='1' THEN request END ) as post_accepted")
		->from('edu_feed_lender_transactions')
		->where("feed_lender_name = '".$lender_name."' AND Date(date) <= '".$edate."' AND Date(date) >= '".$sdate."'");
		$result = $dbCommand->queryAll();
		if(empty($result)){
			return "No Records";
		}
		$post_sent  = $result[0]['post_sent'];
		$post_accepted = $result[0]['post_accepted'];
		$post_rejected = $post_sent - $post_accepted;
		if($post_sent == 0){
			return "No Records";
		}else{
			$graph = '<graph baseFontSize = "11" caption="Post Sent '.$post_sent.'" showNames="1" yAxisMinValue=\'0\' yAxisMaxValue=\'10\' decimalPrecision=\'0\'  showPercentageValues="1" >';
			$graph .= '<set color="#DAA520" name="Post Accepted" value="'.$post_accepted.'"/>';
			$graph .= '<set color="#A52A2A" name="Post Rejected" value="'.$post_rejected.'"/></graph>';
			return $graph;
		}
	}
}
