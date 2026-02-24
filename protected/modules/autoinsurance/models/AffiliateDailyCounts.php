<?php

/**
 * This is the model class for table "autoinsurance_affiliate_daily_counts".
 *
 * The followings are the available columns in table 'autoinsurance_affiliate_daily_counts':
 * @property integer $id
 * @property string $date
 * @property integer $promo_code
 * @property integer $ping_sent
 * @property integer $ping_accepted
 * @property integer $post_sent
 * @property integer $post_accepted
 */
class AffiliateDailyCounts extends autoInsuranceActive
{
	public $user_name,$ping_sent ,$post_sent,$ping_accepted,$post_accepted,$ping_duplicate,$post_duplicate;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AffiliateDailyCounts the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'autoinsurance_affiliate_daily_counts';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, promo_code, ping_sent, ping_accepted, post_sent, post_accepted', 'required'),
			array('promo_code, ping_sent, ping_accepted, post_sent, post_accepted', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, promo_code, ping_sent, ping_accepted, post_sent, post_accepted', 'safe', 'on'=>'search'),
		);
	}
	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id' => 'ID',
			'date' => 'Date',
			'promo_code' => 'Promo Code',
			'ping_sent' => 'Ping Sent',
			'ping_accepted' => 'Ping Accepted',
			'post_sent' => 'Post Sent',
			'post_accepted' => 'Post Accepted',
		);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('promo_code',$this->promo_code);
		$criteria->compare('ping_sent',$this->ping_sent);
		$criteria->compare('ping_accepted',$this->ping_accepted);
		$criteria->compare('post_sent',$this->post_sent);
		$criteria->compare('post_accepted',$this->post_accepted);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Update affiliate's daily count.
	 */
	public function update_affiliate_daily_counts($promo_code,$aff_lead_status,$duplicate=false){
		$date = date('Y-m-d');
		$duplicate = ($duplicate==1) ? 1 : 0;
		$connection=Yii::app()->dbAutoinsurance;
		if(Yii::app()->session['ping_type'] == 'post'){
			$accept_query = ($aff_lead_status==1) ? ' , post_accepted = post_accepted + 1' : '';
			$duplicate_query = ($duplicate==1) ?  ' , post_duplicate = post_duplicate + 1' : '';
			$query = "INSERT INTO autoinsurance_affiliate_daily_counts VALUES ('".$date."' , $promo_code , 1 , 1 , 1 , 1 , $duplicate , $aff_lead_status) ON DUPLICATE KEY UPDATE post_sent = post_sent + 1 $accept_query $duplicate_query";
		}elseif(Yii::app()->session['ping_type'] == 'directpost'){
			$accept_query = ($aff_lead_status==1) ? ' , post_accepted = post_accepted + 1' : '';
			$duplicate_query = ($duplicate==1) ?  ' , post_duplicate = post_duplicate + 1' : '';
			$query = "INSERT INTO autoinsurance_affiliate_daily_counts VALUES ('".$date."' , $promo_code , 0 , 0 , 0 , 1 , $duplicate , $aff_lead_status) ON DUPLICATE KEY UPDATE post_sent = post_sent + 1 $accept_query $duplicate_query";
		}else{
			$accept_query = ($aff_lead_status==1) ? ' , ping_accepted = ping_accepted + 1' : '';
			$duplicate_query = ($duplicate==1) ?  ' , ping_duplicate = ping_duplicate + 1' : '';
			$query = "INSERT INTO autoinsurance_affiliate_daily_counts VALUES ('".$date."' , $promo_code , 1 , $duplicate, $aff_lead_status , 0 , 0 , 0) ON DUPLICATE KEY UPDATE ping_sent = ping_sent + 1 $accept_query $duplicate_query";
		}
		$command=$connection->createCommand($query);
		$dataReader=$command->query();		
	}
	/**
	 * Affiliate Ping Post Statistics
	 */
	public function affiliate_pingpost_statistics(){
		$days = 7;
		$sdate = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-$days,date('Y')));
		$edate = date('Y-m-d').' 23:59:59';
		$date_filter = Yii::app()->request->getParam('date_filter');
		if(!empty($date_filter)){
			$filter = explode(" - ",$date_filter);
			$count =  count($filter);
			if($count == 2){
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[1])).' 23:59:59';
			}else{
				$sdate =  date("Y-m-d", strtotime($filter[0])).' 00:00:00';
				$edate =  date("Y-m-d", strtotime($filter[0])).' 23:59:59';
			}
		}
		$criteria = new CDbCriteria();
		$criteria->alias = "a";
		$criteria->select = "a.* , b.user_name";
		$criteria->join = "LEFT JOIN `autoinsurance_affiliate_user` AS b ON a.promo_code = b.id";
		$criteria->condition = "`date` BETWEEN '".$sdate."' AND '".$edate."'";
		$criteria->order = "`date` DESC";
		return $this->findAll($criteria);
	}
	/**
	 * ALL Affiliate's Ping / Post Report Pie Chart for Last 15 Days(Displayed Affiliate Dashboard)
	 */
	public static function specific_affiliate_report_last_15days($promo_code = null){
		$days = 15;
		$sdate = date('Y-m-d H:i:s',mktime (0,0,0,date('m'),date('d')-$days,date('Y')));
		$edate = date('Y-m-d').' 23:59:59';
		$where[] = $promo_code ? "promo_code = ".$promo_code."" : '0';
		$where[] = "date BETWEEN '".$sdate." 00:00:00' AND '".$edate." 23:59:59'";
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$criteria = new CDbCriteria();
		$criteria->select="promo_code,date,SUM(ping_sent) AS ping_sent,SUM(ping_duplicate) AS ping_duplicate,SUM(ping_accepted) AS ping_accepted,SUM(post_sent) AS post_sent,SUM(post_duplicate) AS post_duplicate,SUM(post_accepted) AS post_accepted";
		$criteria->condition = $where;
		$criteria->group = 'promo_code';
		$result = AffiliateDailyCounts::model()->findAll($criteria);
		if(empty($result)){
			return false;
		}else{
			return $result;
		}
	}
	/**
	 * Specific Affiliate's Ping Report Pie Chart for Last 15 Days(Displayed Affiliate Dashboard)
	 */
	public static function specific_affiliate_pingreport_last_15days($promo_code = 0){
		$days = 15;
		$sdate = date('Y-m-d H:i:s',mktime (0,0,0,date('m'),date('d')-$days,date('Y')));
		$edate = date('Y-m-d').' 23:59:59';
		$criteria=new CDbCriteria();
		$criteria->select="date,SUM(ping_sent) AS ping_sent,SUM(ping_duplicate) AS ping_duplicate,SUM(ping_accepted) AS ping_accepted";
		if(isset($promo_code) && $promo_code>0){
			$criteria->condition = " promo_code = '".$promo_code."'";
		}
		$criteria->condition = "`date` BETWEEN '".$sdate."' AND '".$edate."'";
		$result = AffiliateDailyCounts::model()->find($criteria);
		if(empty($result)){
			return false;
		}else{
			return $result;
		}
	}
	/**
	 * Specific Affiliate's Post Report Pie Chart for Last 15 Days(Displayed Affiliate Dashboard)
	 */
	public static function specific_affiliate_postreport_last_15days($promo_code=0){
		$days = 15;
		$sdate = date('Y-m-d H:i:s',mktime (0,0,0,date('m'),date('d')-$days,date('Y')));
		$edate = date('Y-m-d').' 23:59:59';
		$criteria=new CDbCriteria();
		$criteria->select="date,SUM(post_sent) AS post_sent,SUM(post_duplicate) AS post_duplicate,SUM(post_accepted) AS post_accepted";
		if(isset($promo_code) && $promo_code > 0){
			$criteria->condition = "`date` BETWEEN '$sdate' AND '$edate' AND promo_code = $promo_code";
		}else{
			$criteria->condition = "`date` BETWEEN '$sdate' AND '$edate'";
		}
		$result = AffiliateDailyCounts::model()->find($criteria);
		if(empty($result)){
			return false;
		}else{
			return $result;
		}
	}
}
