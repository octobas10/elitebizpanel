<?php
/**
 * This is the model class for table "homeimprovement_lender_transactions".
 *
 * The followings are the available columns in table 'homeimprovement_lender_transactions':
 * @property integer $id
 * @property string $date
 * @property string $name
 * @property string $tier
 * @property string $request
 * @property string $response
 * @property string $full_response
 * @property double $time
 * @property integer $count
 */
class LenderTransactions extends HomeimprovementActive{
	/**
	 * Returns the static model of the specified AR class.
	 * 
	 * @param string $className active record class name.
	 * @return LenderTransactions the static model class
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'homeimprovement_lender_transactions';
	}
	/**
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, ping_request, ping_response, ping_status, ping_time ','required'),
			array('count','numerical','integerOnly' => true ),
			array('time','numerical'),
			array('name','length','max' => 32),
			array('tier','length','max' => 7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, date, ping_request, ping_response, ping_status, time, cap,customer_id',
				'safe',
				'on' => 'search' 
			) 
		);
	}
	/**
	 *
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'affiliate_transactions' => array(self::BELONGS_TO,'AffiliateTransactions','affiliate_transactions_id') 
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id' => 'ID',
			'date' => 'Date',
			'lender_name' => 'Name',
			'customer_id' => 'Customer Id',
			'ping_request' => 'Ping Request',
			'ping_response' => 'Ping Response',
			'ping_status' => 'Ping Status',
			'ping_time' => 'Ping Time',
			'ping_price' => 'Ping Price',
			'psot_request' => 'Post Request',
			'post_response' => 'Post Response',
			'post_status' => 'Post Status',
			'post_time' => 'Post Time',
			'post_price' => 'Post Price',
			'exit_url' => 'Exit URL' 
		);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * 
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search(){
		$criteria = new CDbCriteria();
		$criteria->compare('id',$this->id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('lender_name',$this->lender_name,true);
		$criteria->compare('ping_request',$this->ping_request,true);
		$criteria->compare('ping_response',$this->ping_response,true);
		$criteria->compare('ping_status',$this->ping_status,true);
		$criteria->compare('ping_time',$this->ping_time);
		$criteria->compare('ping_price',$this->ping_price);
		$criteria->compare('post_request',$this->post_request,true);
		$criteria->compare('post_response',$this->post_response,true);
		$criteria->compare('post_status',$this->post_status,true);
		$criteria->compare('post_time',$this->post_time);
		$criteria->compare('post_price',$this->post_price);
		return new CActiveDataProvider($this,array(
			'criteria' => $criteria 
		));
	}
	public $count = 0;
	public $hour = 0;
	public $date = 0;
	/**
	 * Accepted Leads at Hour of the Day (For Admin, Displayed on Graph Module)
	 */
	public function browselendertransction(){
		$lender_id = Yii::app()->getRequest()->getParam('lender_id');
		$promo_code = Yii::app()->getRequest()->getParam('promo_code');
		$ping_price = Yii::app()->getRequest()->getParam('ping_price');
		$ping_response = Yii::app()->getRequest()->getParam('ping_status');
		$post_sent = Yii::app()->getRequest()->getParam('post_sent');
		$post_status = Yii::app()->getRequest()->getParam('post_status');
		$filter = explode(' - ',Yii::app()->getRequest()->getParam('date',date('Y-m-d')));
		$count = count($filter);
		$sdate = ($count == 2) ? date("Y-m-d", strtotime($filter[0])).' 00:00:00' : date("Y-m-d", strtotime($filter[0])).' 00:00:00';
		$edate = ($count == 2) ? date("Y-m-d", strtotime($filter[1])).' 23:59:59' : date("Y-m-d", strtotime($filter[0])).' 23:59:59';
		$where[] = $lender_id ? "lender_id = ".$lender_id : '';
		$where[] = $promo_code ? "promo_code = ".$promo_code : '';
		$where[] = $ping_price ? "ping_price = ".$ping_price : '';
		$where[] = ($ping_response != '') ? "ping_status = '".$ping_response."'" : '';
		$where[] = ($post_sent == '1') ? "post_request != ' '" : '';
		$where[] = ($post_sent == '0') ? "post_request = ' '" : '';
		$where[] = ($post_status != '') ? "post_status = '".$post_status."'" : '';
		$where[] = ($sdate && $edate) ? "`date` BETWEEN '".$sdate."' AND '".$edate."'" : '';
		$order = "date DESC";
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		//echo $where;
		return $rawData = Yii::app()->dbHomeimprovement->createCommand()
		->select('id,promo_code,affiliate_transactions_id,lender_name,date,ping_request,ping_response,ping_status,ping_price,post_request,post_response,post_status,post_price')
		->from('homeimprovement_lender_transactions')
		->where($where)
		->order($order)
		->queryAll();
	}
	/**
	 * Fetch exit_url if provided associated with the affiliate transaction id
	 */
	public function exit_url($affiliate_trans_id){
		$where = "affiliate_transactions_id = '$affiliate_trans_id' AND post_status='1'";
		$exiturl = Yii::app()->dbHomeimprovement->createCommand()
		->select('exit_url')
		->from('homeimprovement_lender_transactions')
		->where($where)
		->queryScalar();
		return $exiturl;
	}
	/**
	 * Fetch the ping data associated with the ping id provided.
	 */
	public function get_Lender_Pigned_With_This_Ping_Id($affiliate_trans_id){
		$affiliate_trans_id =  isset($affiliate_trans_id) ? $affiliate_trans_id : '0';
		$dbCommand = Yii::app()->dbHomeimprovement->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('a.id as lender_trans_id,a.lender_name,a.ping_request,a.ping_response, a.ping_status,a.ping_price,a.ping_time,a.post_request,a.post_response,a.post_status,a.post_price,a.post_time,a.exit_url, b.id, b.name,b.status,b.static_lead_price, b.ping_url_test,b.ping_url_live,b.post_url_test,b.post_url_live,b.parameter1,b.parameter2,b.parameter3,b.submission_cap, b.accepted_cap,b.paused_vendor,b.posting_timelimit')
		->from('homeimprovement_lender_transactions a')
		->join('homeimprovement_lender_details b', 'a.lender_id = b.id')
		->where('`a`.`affiliate_transactions_id`=' . $affiliate_trans_id . ' AND `a`.`ping_status`=1')
		->order('a.ping_price DESC')
		->limit(1);
		$dataReader = $dbCommand->queryAll();
		//echo $qry = $dbCommand->getText();
		//mail('octobas@gmail.com','homeimprovement : multiple ping accepted lenders',$qry);
		return $dataReader;
	}
	/**
	 * Lender Report For Admin (Diplayed under the menu Lenders -> Lender Report)
	 */
	public function lender_reports(){
		$lender_id = Yii::app()->getRequest()->getParam('lender');
		$filter_date = explode(' - ',Yii::app()->getRequest()->getParam('filter_date',date('Y-m-d')));
		$count =  count($filter_date);
		$sdate = ($count == 2) ? date("Y-m-d", strtotime($filter_date[0])).' 00:00:00' : date("Y-m-d", strtotime($filter_date[0])).' 00:00:00';
		$edate = ($count == 2) ? date("Y-m-d", strtotime($filter_date[1])).' 23:59:59' : date("Y-m-d", strtotime($filter_date[0])).' 23:59:59';
		$where = array();
		$where[] = $lender_id ? "lender_id = ".$lender_id."" : '';
		$where[] = "`date` BETWEEN '".$sdate."' AND '".$edate."'";
		$where[] = "`post_status` = 1";
		$order = "date DESC";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$groupby = "lender_id,ping_price";
		$rawData1 = Yii::app()->dbHomeimprovement->createCommand()
		->select('lender_name,count(a.id) as leads, a.ping_price as lead_price,SUM(CASE WHEN `is_returned` = 1 THEN 1 ELSE 0 END ) AS returned')
		->from('homeimprovement_lender_transactions as a')
		->where($where)
		->group($groupby)
		->order($order)
		->queryAll();
		$lender_array = [];
		foreach ($rawData1 as $rawData) {
			$lender_array[$rawData['lender_name']]['transactions'][] =  $rawData;
		}
		return $lender_array;
	}
	/**
	 * Lender Report For Admin (Diplayed under the menu Lenders -> Lender Report)
	 */
	public function lender_reports_submission(){
		$lender_details = new LenderDetails();
		$Buyers = $lender_details->GetAllLenders();
		$lender_id = Yii::app()->getRequest()->getParam('lender');
		$filter_date = explode(' - ',Yii::app()->getRequest()->getParam('filter_date',date('Y-m-d')));
		$count =  count($filter_date);
		$sdate = ($count == 2) ? date("Y-m-d", strtotime($filter_date[0])).' 00:00:00' : date("Y-m-d", strtotime($filter_date[0])).' 00:00:00';
		$edate = ($count == 2) ? date("Y-m-d", strtotime($filter_date[1])).' 23:59:59' : date("Y-m-d", strtotime($filter_date[0])).' 23:59:59';
		$where = array();
		$where[] = $lender_id ? "lender_id = ".$lender_id."" : '';
		$where[] = "`sub_date` BETWEEN '".$sdate."' AND '".$edate."'";
		$where[] = "`lead_status` = 1";
		$order = "sub_date DESC";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$groupby = "lender_id,lender_lead_price";
		$rawData1 = Yii::app()->dbHomeimprovement->createCommand()
		->select('lender_id as lender_name,count(a.id) as leads, a.lender_lead_price as lead_price,SUM(CASE WHEN `is_returned` = 1 THEN 1 ELSE 0 END ) AS returned')
		->from('homeimprovement_submissions as a')
		->where($where)
		->group($groupby)
		->order($order)
		->queryAll();
		$lender_array = [];
		foreach ($rawData1 as $rawData) {
			$lender_name = $Buyers[$rawData['lender_name']];
			$rawData['lender_name'] =  $Buyers[$rawData['lender_name']];
			$lender_array[$lender_name]['transactions'][] =  $rawData;
		}
		return $lender_array;
	} 
	/**
	 * Specific Lender Report (Displayed Lender Dashboard when they logged in)
	 */
	public function specific_lender_report(){
		$lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
		$lender_id = $lender->id;
		$days = 7;
		$sdate = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-$days,date('Y'))).' 00:00:00';
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
		$dbCommand = Yii::app()->dbHomeimprovement->createCommand()
		->select("lender_name , DATE(date) AS date , COUNT(id) AS ping_sent , SUM(ping_status=1) as ping_accepted , SUM(post_request!='') as post_sent , SUM(post_status=1) as post_accepted , SUM(is_returned=1) as lead_returned , SUM(IF((post_status=1 AND (is_returned=0 OR is_returned IS NULL)), ping_price , 0)) as revenue , (SUM(ping_price) / SUM(ping_status=1)) AS average_ping_price")
		->from('homeimprovement_lender_transactions')
		->where("lender_id = '".$lender_id."' AND `date` BETWEEN '".$sdate."' AND '".$edate."'")
		->group("DATE(date)")
		->order("date DESC");
		return $dbRows = $dbCommand->queryAll();
	}
	/**
	 * Lead info report for lender when they logins
	 */
	public function leadinfo_for_specific_lender(){
		$lender_id = (Yii::app()->user->getState('usertype')=='lender') ? Yii::app()->user->id : Yii::app()->request->getParam('lender_id');
		$ping_status = Yii::app()->request->getParam('ping_status');
		$post_sent = Yii::app()->request->getParam('post_sent');
		$post_status = Yii::app()->request->getParam('post_status');
		$lead_returned = Yii::app()->request->getParam('lead_returned');
		$final = Yii::app()->request->getParam('final');
		$date = Yii::app()->request->getParam('date');
		if(!empty($date)){
			$filter = explode(" - ",$date);
			$count = count($filter);
			if($count == 2){
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[1])).' 23:59:59';
			}elseif($count == 1){
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[0])).' 23:59:59';
			}
		}
		$where[] = $lender_id ? "lender_id = ".$lender_id."" : '0';
		$where[] = ($ping_status==1) ? "ping_status = 1" : '';
		$where[] = ($post_sent==1) ? "post_request != '' " : '';
		$where[] = ($post_status==1) ? "post_status = 1" : '';
		$where[] = ($lead_returned==1) ? "is_returned = 1" : '';
		$where[] = ($final==1) ? "post_status = 1 AND is_returned = 0" : '';
		$where[] = "date BETWEEN '".$sdate." 00:00:00' AND '".$edate." 23:59:59'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$criteria = new CDbCriteria();
		$criteria->select = 'id,lender_id,lender_name,date,ping_request,ping_response,ping_price,post_request,post_response,post_price';
		$criteria->condition = $where;
		return $criteria;
	}
	/**
	 * Lender Stats for Admin
	 */
	public function lender_stats(){
		$lender_id = Yii::app()->request->getParam('lender_id');
		$days = 7;
		$sdate = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-$days,date('Y'))).' 00:00:00';
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
		$where[] = $lender_id ? "lender_id = '".$lender_id."'" : '';
		$where[] = "`date` BETWEEN '".$sdate."' AND '".$edate."'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$groupby[] = $lender_id ? "lender_id" : '';
		$groupby[] = "DATE(`date`)";
		$groupby = array_filter($groupby);
		$groupby = (count($groupby) > 0) ? ''.implode(' , ', $groupby) : '';
		$orderby = "date DESC";
		$dbCommand = Yii::app()->dbHomeimprovement->createCommand()
		->select("lender_name , DATE(date) AS date , COUNT(id) AS ping_sent , SUM(ping_status=1) as ping_accepted , SUM(post_request!='') as post_sent , SUM(post_status=1) as post_accepted , SUM(is_returned=1) as lead_returned , SUM(IF((post_status=1 AND (is_returned=0 OR is_returned IS NULL)), ping_price , 0)) as revenue , ROUND(SUM(IF((post_status=1 AND (is_returned=0 OR is_returned IS NULL)), ping_price , 0)) / SUM(CASE WHEN `post_status` = 1 THEN 1 ELSE 0 END ),2) AS average_ping_price")
		->from('homeimprovement_lender_transactions')
		->where($where)
		->group($groupby)
		->order($orderby);
		return $dbCommand->queryAll();
	}
}