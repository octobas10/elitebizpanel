<?php
/*
	** author : 
	** modification : extend class changed from CActiveRecord to EModuleActiveRecord
	** modification date : 02-08-2016
	*/

/**
 ** Author : 
 ** Modification Description : way of getting connection changed (Reason - previous way gives default database connection instead of a database connection set for specific "EDU" module)
 ** Previous Way :- Yii::app()->db
 ** New Way      :- parent::getDbConnection()
 ** Modification Date : 02-08-2016
 **/
class LenderAffiliateTransaction extends EModuleActiveRecord
{
	public $ping_sent, $post_accepted, $lead_price, $total, $last15dayes_accepted, $last15dayes_submission, $average_ping_price, $revenue =  0;
	public $select_data = 'date,sum(ping_sent) as ping_sent,sum(post_accepted) as post_accepted,sum(post_sent) as post_sent,sum(post_accepted) as post_accepted,sum(lead_price) as lead_price';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LenderUser the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'edu_lenders_affiliates_transactions';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lender,promo_code,date', 'required'),
		);
	}
	/** Check Lender Affiliate Lead Cap */
	public function check_lender_affiliate_cap($promo_code, $lender_id)
	{
		/** Lender cap setting for perticular affilate(promo code)*/
		$where = "`affiliate_user_id`= '$promo_code' AND `lender_details_id`= '$lender_id'";
		$vendor_lender_cap = parent::getDbConnection()->createCommand()
			->select('cap,intervals')
			->from('edu_lender_affiliate_settings')
			->where($where)
			->queryAll();
		if (!empty($vendor_lender_cap)) {
			$cap = $vendor_lender_cap[0]['cap'];
			$intervals = $vendor_lender_cap[0]['intervals'];
		} else {
			$cap = '';
		}
		/** Todays' Lender submission from perticular affiliate(promo code) */
		$lender_data = LenderDetails::model()->findByPK($lender_id);
		$where1 = "`lender` = '$lender_data->name' AND `promo_code`= '$promo_code' AND DATE(date) = '" . date('Y-m-d') . "'";
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
		$time_elapsed = round(abs($time_at_last_lead_sent - $time_now) / 60, 2);
		if ((empty($time_elapsed) or $time_elapsed == '')) {
			$time_elapsed = 0;
		}
		if ($cap) {
			if (($time_elapsed > $intervals || $intervals = -1) && ($cap > $submission_of_lender)) {
				return true;
			} else {
				return false;
			}
		} else {
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
	public function lender_ping_status_update($lender_id, $promo_code, $ping_status, $price)
	{
		$connection = parent::getDbConnection();
		$price = $price ? $price : '0';
		$accept_query = ($ping_status == 1) ? ',`ping_accepted`=`ping_accepted`+1' : '';
		if ($ping_status == 1) {
		} else {
			$ping_status = 0;
		}
		$sql1 = "INSERT INTO edu_lenders_affiliates_transactions VALUES($lender_id,$promo_code,$price,'" . date('Y-m-d') . "',1,$ping_status,0,0,now()) on duplicate key update `ping_sent`=`ping_sent`+1 $accept_query";
		$command = $connection->createCommand($sql1);
		$command->query();
	}
	/**
	 * Update Lender Affiliate Transaction Table with Post Status
	 * @param string $lendername
	 * @param integer $promo_code
	 * @param integer $post_status
	 * @param float $price
	 * @param boolean $static_price_direct_post
	 */
	public function lender_post_status_update($lender_id, $promo_code, $post_status, $price, $static_price_direct_post = false)
	{
		$connection = parent::getDbConnection();
		$price = $price ? $price : '0';
		$accept_query = ($post_status == 1) ? ',`post_accepted`=`post_accepted`+1' : '';
		if ($post_status == 1) {
		} else {
			$post_status = 0;
		}
		if ($static_price_direct_post == false) {
			$sql1 = "INSERT INTO edu_lenders_affiliates_transactions VALUES($lender_id,$promo_code,$price,'" . date('Y-m-d') . "',1,1,1,$post_status,now()) on duplicate key update `post_sent`=`post_sent`+1 $accept_query";
		} elseif ($static_price_direct_post == true) {
			$sql1 = "INSERT INTO edu_lenders_affiliates_transactions VALUES($lender_id,$promo_code,$price,'" . date('Y-m-d') . "',0,0,1,$post_status,now()) on duplicate key update `post_sent`=`post_sent`+1 $accept_query";
		}
		$command = $connection->createCommand($sql1);
		$command->query();
	}
	/** 
	 * Get promo_code, lender name and tier price from affiliate_transaction_id
	 */
	/**
	 * @author : 
	 * @modification : query previously based on ping status and it is changed for post status
	 * @modified since : 15-09-2016
	 */
	public function lender_details_from_affiliate_tranaction_id($affiliate_trans_id)
	{
		$where = "`affiliate_transactions_id` = '$affiliate_trans_id' AND post_status = '1'";
		$lender_details = parent::getDbConnection()->createCommand()
			->select('promo_code,lender_name,post_price')
			->from('edu_lender_transactions')
			->where($where)
			->queryAll();
		return $lender_details[0];
	}
	/**
	 * Total Looks to Lenders Today (For Admin, Displayed on Graph Module)
	 */
	public function dailyCount()
	{
		$criteria = new CDbCriteria();
		$criteria->select = "lender,sum(post_sent) AS post_sent ,SUM(post_accepted) AS post_accepted";
		$criteria->condition = "date='" . date('Y-m-d') . "'";
		$criteria->group = "lender,date";
		$dailyaccepted = $this->findAll($criteria);
		$xml_cat = "";
		$dataset_accept = "";
		$dataset_submission = "";
		$xml_graph = "";
		$xml_category = "";
		$xml_graph .= "<graph counttion='Total looks to lenders Today' rotateNames='1' xAxisName='Lenders' yAxisName='Units' decimalPrecision='0' yAxisMinValue='0' yAxisMaxValue='10'  rotateNames='1' numDivLines='3'  showValues='0' formatNumberScale='0' >";
		$xml_cat .= "<categories>";
		$dataset_accept .= "<dataset seriesName='Post Accepted' color='AFD8F8' showValues='1'>";
		$dataset_submission .= "<dataset seriesName='Post Sent'  color='F6BD0F' showValues='1'>";
		foreach ($dailyaccepted as $row) {
			$xml_category .= "<category name='" . $row['lender'] . "' />";
			$dataset_submission .= "<set value='" . $row['post_sent'] . "' />";
			$dataset_accept .= "<set value='" . $row['post_accepted'] . "' />";
		}
		$cat = $xml_cat . $xml_category .= "</categories>";
		$dataset_submission .= "</dataset>";
		$dataset_accept .= "</dataset>";
		return $xml_graph . $cat . $dataset_submission . $dataset_accept .= "</graph>";
	}
	/**
	 * Lender Ping Post Statistics (For admin)
	 */
	public function lender_pingpost_statistics()
	{
		$days = 7;
		$sdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $days, date('Y')));
		$edate = date('Y-m-d');
		$date_filter = Yii::app()->request->getParam('date_filter');
		if (!empty($date_filter)) {
			$filter = explode(" - ", $date_filter);
			$count =  count($filter);
			if ($count == 2) {
				$sdate = date('Y-m-d', strtotime($filter[0]));
				$edate = date('Y-m-d', strtotime($filter[1]));
			} else {
				$sdate = date('Y-m-d', strtotime($filter[0]));
				$edate = date('Y-m-d', strtotime($filter[0]));
			}
		}
		$criteria = new CDbCriteria();
		$criteria->select = "`lender_id` , `date` , SUM(`ping_sent`) AS ping_sent , SUM(`ping_accepted`) AS ping_accepted , SUM(`post_sent`) AS post_sent, SUM(`post_accepted`) AS post_accepted";
		$criteria->condition = "date BETWEEN '" . $sdate . "' AND '" . $edate . "'";
		$criteria->group = "`date` , `lender_id`";
		$criteria->order = "`date` DESC";
		return $result = $this->findAll($criteria);
	}
	/**
	 * Specific Lender Ping Report Pie Chart for Last 15 days(Displayed Lender Dashboard)
	 */
	public function specific_lender_ping_report_last_15days()
	{
		$lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
		$lender_id = $lender->id;
		$sdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 15, date('Y')));
		$edate = date('Y-m-d');
		$criteria = new CDbCriteria();
		$criteria->select = "lender_id,SUM(ping_sent) AS ping_sent , SUM(ping_accepted) AS ping_accepted";
		$criteria->condition = "lender_id = $lender_id AND date BETWEEN '" . $sdate . "' AND '" . $edate . "'";
		$result = $this->find($criteria);
		if (empty($result)) {
			return "No Records";
		}
		$ping_sent  = $result['ping_sent'];
		$ping_accepted = $result['ping_accepted'];
		$ping_rejected = $ping_sent - $ping_accepted;
		if ($ping_sent == 0) {
			return "No Records";
		} else {
			$graph = '<graph baseFontSize = "11" caption="Ping Sent ' . $ping_sent . '" showNames="1" yAxisMinValue=\'0\' yAxisMaxValue=\'10\' decimalPrecision=\'0\'  showPercentageValues="1" >';
			$graph .= '<set color="#DAA520" name="Ping Accepted" value="' . $ping_accepted . '"/>';
			$graph .= '<set color="#A52A2A" name="Ping Rejected" value="' . $ping_rejected . '"/></graph>';
			return $graph;
		}
	}
	/**
	 * Specific Lender Post Report Chart for Last 15 days(Displayed Lender Dashboard)
	 */
	public static function specific_lender_post_report_last_15days()
	{
		$lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
		$lender_id = $lender->id;
		$sdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 15, date('Y')));
		$edate = date('Y-m-d');
		$criteria = new CDbCriteria();
		$criteria->select = "lender_id , SUM(post_sent) AS post_sent , SUM(post_accepted) AS post_accepted";
		$criteria->condition = "lender_id = $lender_id AND date BETWEEN '" . $sdate . "' AND '" . $edate . "'";
		$result = LenderAffiliateTransaction::model()->findAll($criteria);
		return $result;
	}
}
