<?php
class LenderAffiliateTransaction extends MortgageActive{
	public $lender_id,$ping_sent,$post_sent,$ping_accepted, $post_accepted, $lead_price, $total, $last15dayes_accepted, $last15dayes_submission, $average_ping_price, $revenue =  0;
	//public $select_data = 'date,sum(ping_sent) as ping_sent,sum(post_accepted) as post_accepted,sum(post_sent) as post_sent,sum(post_accepted) as post_accepted,sum(lead_price) as lead_price';

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
		return 'mortgage_lenders_affiliates_transactions';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('lender_id,promo_code,date','required'),
		);
	}
	/** Check Lender Affiliate Lead Cap */
	public function check_lender_affiliate_cap($promo_code,$lender_id){
		/** Lender cap setting for perticular affilate(promo code)*/
		$where = "`affiliate_user_id`= '$promo_code' AND `lender_details_id`= '$lender_id'";
		$vendor_lender_cap = Yii::app()->dbMortgage->createCommand()
			->select('cap,intervals')
			->from('mortgage_lender_affiliate_settings')
			->where($where)
			->queryAll();
		if(!empty($vendor_lender_cap)){
			$cap = $vendor_lender_cap[0]['cap'];
			$intervals = $vendor_lender_cap[0]['intervals'];
		}else{
			$cap='0';
		}
		/** Todays' Lender submission from perticular affiliate(promo code) */
		/*$lender_data = LenderDetails::model()->findByPK($lender_id);*/
		$where1 = "lender_id = $lender_id AND promo_code= '$promo_code' AND DATE(date) ='".date('Y-m-d')."'";
		$submission_of_lender = Yii::app()->dbMortgage->createCommand()
			->select('SUM(ping_sent) as todays_submission')
			->from('mortgage_lenders_affiliates_transactions')
			->where($where1)
			->queryScalar();
		/** Calculation of time interval when last lead sent */
		$time_at_last_lead_sent = Yii::app()->dbMortgage->createCommand()
			->select('last_inserted_datetime')
			->from('mortgage_lenders_affiliates_transactions')
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
	public function lender_ping_status_update($lender_id,$promo_code,$ping_status,$price){
		$connection=Yii::app()->dbMortgage;
		$price = $price ? $price : '0';
		$accept_query = ($ping_status==1) ? ',`ping_accepted`=`ping_accepted`+1' : '';
		$sql1="INSERT INTO mortgage_lenders_affiliates_transactions VALUES($lender_id,$promo_code,$price,curdate(),1,$ping_status,0,0,now()) on duplicate key update `ping_sent`=`ping_sent`+1 $accept_query, last_inserted_datetime=NOW()";
		$command=$connection->createCommand($sql1);
		$dataReader=$command->query();
	}
	/**
	 * Update Lender Affiliate Transaction Table with Post Status
	 * @param string $lendername
	 * @param integer $promo_code
	 * @param integer $post_status
	 * @param float $price
	 * @param boolean $static_price_direct_post
	 */
	public function lender_post_status_update($lender_id,$promo_code,$post_status,$price,$static_price_direct_post=false){
		$connection=Yii::app()->dbMortgage;
		$price = $price ? $price : '0';
		$accept_query = ($post_status==1) ? ',`post_accepted`=`post_accepted`+1' : '';
		if($static_price_direct_post==false){
			$sql1="INSERT INTO mortgage_lenders_affiliates_transactions VALUES($lender_id,$promo_code,$price,curdate(),1,1,1,$post_status,now()) on duplicate key update `post_sent`=`post_sent`+1 $accept_query, last_inserted_datetime=NOW()";
		}elseif($static_price_direct_post==true){
			$sql1="INSERT INTO mortgage_lenders_affiliates_transactions VALUES($lender_id,$promo_code,$price,curdate(),0,0,1,$post_status,now()) on duplicate key update `post_sent`=`post_sent`+1 $accept_query, last_inserted_datetime=NOW()";
		}
		$command=$connection->createCommand($sql1);
		$dataReader=$command->query();
	}
	/** 
	 * Get promo_code, lender name and tier price from affiliate_transaction_id
	 */
	public function lender_details_from_affiliate_tranaction_id($affiliate_trans_id){
		$where = "`affiliate_transactions_id` = $affiliate_trans_id AND ping_status = '1'";
		$lender_details = Yii::app()->dbMortgage->createCommand()
			->select('promo_code,lender_name,ping_price')
			->from('mortgage_lender_transactions')
			->where($where)
			->queryAll();
		return $lender_details[0];
	
	}
	/**
	 * Total Looks to Lenders Today (For Admin, Displayed on Graph Module)
	 */
	public function dailyCount(){
		$criteria=new CDbCriteria();
		$criteria->select="lender_id,sum(ping_sent) AS ping_sent ,SUM(ping_accepted) AS ping_accepted";
		$criteria->condition = "date='".date('Y-m-d')."'";
		$criteria->group = "lender_id,date";
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
			$xml_category .="<category name='".$row['lender_id']."' />";
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
		$edate = date('Y-m-d',mktime(23,59,59,date('m'),date('d'),date('Y')));
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
		$criteria = new CDbCriteria();
		$criteria->select = "lender_id,date,SUM(CASE WHEN ping_sent > 0 THEN ping_sent ELSE 0 END) AS ping_sent , SUM(CASE WHEN ping_accepted > 0 THEN ping_accepted ELSE 0 END) AS ping_accepted , SUM(CASE WHEN post_sent >0 THEN post_sent ELSE 0 END) AS post_sent, SUM(CASE WHEN post_accepted > 0 THEN post_accepted ELSE 0 END) AS post_accepted";
		$criteria->condition = "date BETWEEN '".$sdate."' AND '".$edate."'";
		$criteria->group = "date , lender_id";
		$criteria->order = "date DESC";
		$result = $this->findAll($criteria);
		if($result){
			return $result;
		}else{
			return [];
		}
	}
	/**
	 * Specific Lender Ping Report Pie Chart for Last 15 days(Displayed Lender Dashboard)
	 */
	public static function specific_lender_ping_report_last_15days($lender_id = null){
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-15,date('Y')));
		$edate = date('Y-m-d');
		$where[] = $lender_id ? "lender_id = ".$lender_id."" : '0';
		$where[] = "date BETWEEN '".$sdate." 00:00:00' AND '".$edate." 23:59:59'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$criteria = new CDbCriteria();
		$criteria->select = "lender_id,SUM(CASE WHEN ping_sent >0 THEN ping_sent ELSE 0 END) AS ping_sent,SUM(CASE WHEN ping_accepted >0 THEN ping_accepted ELSE 0 END) AS ping_accepted";		
		$criteria->condition = $where;
		$criteria->group = 'lender_id';
		$result = LenderAffiliateTransaction::model()->findAll($criteria);
		if(empty($result)){
			return false;
		}else{
			return $result;
		}
	}
	/**
	 * Specific Lender Post Report Chart for Last 15 days(Displayed Lender Dashboard)
	 */
	public static function specific_lender_post_report_last_15days($lender_id = null){
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-15,date('Y')));
		$edate = date('Y-m-d');
		$where[] = $lender_id ? "lender_id = ".$lender_id."" : '0';
		$where[] = "date BETWEEN '".$sdate." 00:00:00' AND '".$edate." 23:59:59'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$criteria = new CDbCriteria();
		$criteria->select = "lender_id,SUM(CASE WHEN post_sent > 0 THEN post_sent ELSE 0 END) AS post_sent,SUM(CASE WHEN post_accepted >0 THEN post_accepted ELSE 0 END) AS post_accepted";
		$criteria->condition = $where;
		$criteria->group = 'lender_id';
		$result = LenderAffiliateTransaction::model()->findAll($criteria);
		if(empty($result)){
			return false;
		}else{
			return $result;
		}
	}



}
