<?php
/**
 * This is the model class for table "edu_lender_transactions".
 *
 * The followings are the available columns in table 'edu_lender_transactions':
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
class LenderTransactions extends EModuleActiveRecord {
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
		return 'edu_lender_transactions';
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
				'id, date, ping_request, ping_response, ping_status, time, cap',
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
	public function browselendertransction(){
		$criteria = new CDbCriteria();
		$lender_id = Yii::app()->getRequest()->getParam('lender_id');
		$ping_response = Yii::app()->getRequest()->getParam('ping_status');
		$post_sent = Yii::app()->getRequest()->getParam('post_sent');
		$post_status = Yii::app()->getRequest()->getParam('post_status');
		/**
		 * @description : way of retrieving dates changed
		*/
		if(isset($_SESSION['date_search_criteria']) && !empty($_SESSION['date_search_criteria'])) {
			if($_SESSION['date_search_criteria'] == Yii::app()->getRequest()->getParam('date',date('Y-m-d'))) {
			} else {
				//URL contains page text
				if(strpos(Yii::app()->request->requestUri, 'page') !== false){
				}else {
				//URL didn't contains page text
					if(date('Y-m-d')==Yii::app()->getRequest()->getParam('date',date('Y-m-d'))) {
					} else {
						$_SESSION['date_search_criteria'] = Yii::app()->getRequest()->getParam('date',date('Y-m-d'));
					}
				}
			}
		} else {
			$_SESSION['date_search_criteria'] = Yii::app()->getRequest()->getParam('date',date('Y-m-d'));
		}
		$filter = explode(' - ',$_SESSION['date_search_criteria']);
		// print_r($filter);
		// print_r($_SESSION['date_search_criteria']);
		$count = count($filter);
		$sdate = ($count == 2) ? date("Y-m-d", strtotime($filter[0])).' 00:00:00' : date("Y-m-d", strtotime($filter[0])).' 00:00:00';
		$edate = ($count == 2) ? date("Y-m-d", strtotime($filter[1])).' 23:59:59' : date("Y-m-d", strtotime($filter[0])).' 23:59:59';
		$curr_start_date = Date("Y-m-d")." 00:00:00";
		$curr_end_date = Date("Y-m-d")." 23:59:59";
		$where[] = $lender_id ? "lender_id = '".$lender_id."'" : '';
		$where[] = ($ping_response != '') ? "ping_status = '".$ping_response."'" : '';
		$where[] = ($post_sent == '1') ? "post_request != ' '" : '';
		$where[] = ($post_sent == '0') ? "post_request = ' '" : '';
		$where[] = ($post_status != '') ? "post_status = '".$post_status."'" : '';
		$where[] = ($sdate && $edate) ? "`date` BETWEEN '".$sdate."' AND '".$edate."'" : '';
		/*echo '<pre>';
		print_r($where);
		exit;*/
		$order = "date DESC";
		$where = array_filter($where);
		$where = (count($where) > 0) ? '' . implode(' AND ',$where) : '';
		$criteria->condition = $where;
		$criteria->order = 'date DESC';
		//echo '<pre>';print_r($criteria);exit;
		return $criteria;
	}
	/**
	 * Fetch exit_url if provided associated with the affiliate transaction id
	 */
	public function exit_url($affiliate_trans_id){
		$where = "affiliate_transactions_id = '$affiliate_trans_id' AND post_status='1'";
		$exiturl = parent::getDbConnection()->createCommand()
		->select('exit_url')
		->from('edu_lender_transactions')
		->where($where)
		->queryScalar();
		return $exiturl;
	}
	/**
	 * Fetch the ping data associated with the ping id provided.
	 */
	public function get_Lender_Pigned_With_This_Ping_Id($affiliate_trans_id){
		$affiliate_trans_id =  isset($affiliate_trans_id) ? $affiliate_trans_id : '0';
		$dbCommand = parent::getDbConnection()->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('a.id as lender_trans_id,a.lender_name,a.ping_request,a.ping_response, a.ping_status,a.ping_price,a.ping_time,a.post_request,a.post_response,a.post_status,a.post_price,a.post_time,a.exit_url, b.id, b.name,b.status,b.static_lead_price, b.ping_url_test,b.ping_url_live,b.post_url_test,b.post_url_live,b.parameter1,b.parameter2,b.parameter3,b.submission_cap, b.accepted_cap,b.paused_vendor,b.posting_timelimit')
		->from('edu_lender_transactions a')
		->join('edu_lender_details b', 'a.lender_name = b.name')
		->where('`a`.`affiliate_transactions_id`=' . $affiliate_trans_id . ' AND `a`.`ping_status`=1')
		->order('a.ping_price DESC');
		$dataReader=$dbCommand->queryAll();
		return $dataReader;
	}
	
	/**
	 * Specific Lender Report (Displayed Lender Dashboard when they logged in)
	 */
	public function specific_lender_report(){
		$lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
		$lender_name = $lender->user_name;
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
		->select("lender_name , DATE(date) AS date , COUNT(id) AS ping_sent , SUM(ping_status=1) as ping_accepted , SUM(post_request!='') as post_sent , SUM(post_status=1) as post_accepted , SUM(is_returned=1) as lead_returned , SUM(IF((post_status=1 AND (is_returned=0 OR is_returned IS NULL)), ping_price , 0)) as revenue , (SUM(ping_price) / SUM(ping_status=1)) AS average_ping_price")
		->from('edu_lender_transactions')
		->where("lender_name = '".$lender_name."' AND `date` BETWEEN '".$sdate."' AND '".$edate."'")
		->group("DATE(date)")
		->order("date DESC");
		return $dbRows = $dbCommand->queryAll();
	}
	/**
	 * Lead info report for lender when they logins
	 */
	public function leadinfo_for_specfic_lender(){
		$lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
		$lender_name = $lender->user_name;
		$lender_name = (Yii::app()->user->getState('usertype')=='lender') ? $lender_name : Yii::app()->request->getParam('lender_name');
		$ping_status = Yii::app()->request->getParam('ping_status');
		$post_sent = Yii::app()->request->getParam('post_sent');
		$post_status = Yii::app()->request->getParam('post_status');
		$lead_returned = Yii::app()->request->getParam('lead_returned');
		$final = Yii::app()->request->getParam('final');
		$date = Yii::app()->request->getParam('date');
		$where[] = $lender_name ? "lender_name = '".$lender_name."'" : '';
		$where[] = ($ping_status==1) ? "ping_status = 1" : '';
		$where[] = ($post_sent==1) ? "post_request != '' " : '';
		$where[] = ($post_status==1) ? "post_status = 1" : '';
		$where[] = ($lead_returned==1) ? "is_returned = 1" : '';
		$where[] = ($final==1) ? "post_status = 1 AND is_returned = 0" : '';
		$where[] = "date BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$criteria=new CDbCriteria();
		$criteria->select = 'id,lender_name,date,ping_request,ping_response,post_request,post_response';
		$criteria->condition = $where;
		return $criteria;
	}
	/**
	 * Lender Stats for Admin
	 */
	public function lender_stats(){
		$lender_name = Yii::app()->request->getParam('lender_name');
		$days = 7;
		$sdate= date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-$days,date('Y'))).' 00:00:00';
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
		$where[] = $lender_name ? "lender_name = '".$lender_name."'" : '';
		$where[] = "`date` BETWEEN '".$sdate."' AND '".$edate."'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$groupby[] = "lender_name";
		$groupby[] = "DATE(date)";
		$groupby = array_filter($groupby);
		$groupby = (count($groupby) > 0) ? ''.implode(' , ', $groupby) : '';
		$orderby = "lender_name ASC";
		$dbCommand = parent::getDbConnection()->createCommand()
		->select("lender_name , DATE(date) AS date , COUNT(id) AS ping_sent , SUM(ping_status=1) as ping_accepted , SUM(post_request!='') as post_sent , SUM(post_status=1) as post_accepted , SUM(is_returned=1) as lead_returned , SUM(IF((post_status=1 AND (is_returned=0 OR is_returned IS NULL)), ping_price , 0)) as revenue , (SUM(ping_price) / SUM(ping_status=1)) AS average_ping_price")
		->from('edu_lender_transactions')
		->where($where)
		->group($groupby)
		->order($orderby);
		return $dbRows = $dbCommand->queryAll();
	}
	/**
	 * Lender Report For Admin (Diplayed under the menu Lenders -> Lender Report)
	 */
	public function lender_reports(){
		$lender = Yii::app()->getRequest()->getParam('lender');
		$promo_code = Yii::app()->getRequest()->getParam('promo_code');
		$filter_date = explode(' - ',Yii::app()->getRequest()->getParam('filter_date',date('n/j/Y')));
		$count =  count($filter_date);
		$start_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[0])).' 00:00:00' : date("Y-m-d", strtotime($filter_date[0])).' 00:00:00';
		$end_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[1])).' 23:59:59' : date("Y-m-d", strtotime($filter_date[0])).' 23:59:59';
		$where = [];
		$where[] = $lender ? "lender_id = '".$lender."'" : '';
		$where[] = " `date` BETWEEN '".$start_date."' AND '".$end_date."'";
		$where[] = "`post_status` = 1";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$groupby = "lender_id,a.post_price";
		$lender_data = parent::getDbConnection()->createCommand()
		->select('lender_name,COUNT(a.id) as leads, a.post_price as lead_price, b.margin, SUM(CASE WHEN `is_returned` = 1 THEN 1 ELSE 0 END ) AS returned')
		->from('edu_lender_transactions as a')
		->join('edu_affiliate_user as b', 'a.promo_code=b.id')
		->where($where)
		->group($groupby)
		->order($order)
		->queryAll();
		//ECHO $lender_data->getText();exit;
		if(!empty($lender_data)){ 
			return $lender_data;
		}else{
			[];
		}
	}
	public function lender_reports_submission(){
		$lender_details = new LenderDetails();
		$Buyers = $lender_details->GetAllLenders();
		$lender_id = Yii::app()->getRequest()->getParam('lender');
		$filter_date = explode(' - ',Yii::app()->getRequest()->getParam('filter_date',date('n/j/Y')));
		$count =  count($filter_date);
		$sdate = ($count == 2) ? date("Y-m-d", strtotime($filter_date[0])).' 00:00:00' : date("Y-m-d", strtotime($filter_date[0])).' 00:00:00';
		$edate = ($count == 2) ? date("Y-m-d", strtotime($filter_date[1])).' 23:59:59' : date("Y-m-d", strtotime($filter_date[0])).' 23:59:59';
		$where = array();
		$where[] = $lender_id ? "lender_id = ".$lender_id."" : '';
		$where[] = "`sub_date` BETWEEN '".$sdate."' AND '".$edate."'";
		$where[] = "`lead_status` = 1";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$groupby = "lender_id,lender_lead_price";
		$rawData1 = parent::getDbConnection()->createCommand()
		->select('lender_id as lender_name,count(a.id) as leads, a.lender_lead_price as lead_price,b.margin,SUM(CASE WHEN `is_returned` = 1 THEN 1 ELSE 0 END ) AS returned')
		->from('edu_submissions as a')
		->join('edu_affiliate_user as b', 'a.promo_code=b.id')
		->where($where)
		->group($groupby)
		->order($order)
		->queryAll();
		$lender_array = [];
		foreach ($rawData1 as $rawData) {
			$lender_name = $Buyers[$rawData['lender_name']];
			$rawData['lender_name'] =  $Buyers[$rawData['lender_name']];
			$lender_array[] =  $rawData;
		}
		return $lender_array;
	}
	/**
      * @description : Lender Monthly Report For Admin (Diplayed under the menu Lenders -> Lender Monthly Report)
      * @since : 17-10-2016
     */
	public function lender_monthly_reports(){
		$lender = Yii::app()->getRequest()->getParam('lender');
		$promo_code = Yii::app()->getRequest()->getParam('promo_code');
		$filter_date = explode(' - ',Yii::app()->getRequest()->getParam('filter_date',date('n/j/Y')));
		$count =  count($filter_date);
		$start_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[0])).' 00:00:00' : date("Y-m-d", strtotime($filter_date[0])).' 00:00:00';
		$end_date = ($count == 2) ? date("Y-m-d", strtotime($filter_date[1])).' 23:59:59' : date("Y-m-d", strtotime($filter_date[0])).' 23:59:59';
		$where = [];
		$where[] = $lender ? "a.lender_id = '".$lender."'" : '';
		$where[] = $promo_code ? "a.promo_code = '".$promo_code."'" : '';
		$where[] = "a.date BETWEEN '".$start_date."' AND '".$end_date."'";
		$where[] = "a.post_status = 1";
		$where[] = "b.deleted = 0";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$groupby = "b.campus_id";
		$lender_data = parent::getDbConnection()->createCommand()
		->select('lender_name,count(a.id) as leads, a.post_price as lead_price, SUM(CASE WHEN a.is_returned = 1 THEN 1 ELSE 0 END ) AS returned,SUM(CASE WHEN a.is_returned is NULL THEN 1 ELSE 0 END ) AS valid,a.campus_code,b.campus_id')
		->from('edu_lender_transactions as a')
		->join('campuses b', 'a.campus_code = b.campus_code')
		->where($where)
		->group($groupby)
		->order($order)
		->queryAll();
		//ECHO $lender_data->getText();exit;
		if(!empty($lender_data)){
			return $lender_data;
		}else{
			[];
		}
	}
}
