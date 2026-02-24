<?php

/**
 * This is the model class for table "businessloans_affiliate_daily_counts".
 *
 * The followings are the available columns in table 'businessloans_affiliate_daily_counts':
 * @property integer $id
 * @property string $date
 * @property integer $promo_code
 * @property integer $ping_sent
 * @property integer $ping_accepted
 * @property integer $post_sent
 * @property integer $post_accepted
 */
class AffiliateDailyCounts extends BusinessloansActive
{
	public $user_name,$ping_sent ,$post_sent,$ping_accepted,$post_accepted,$ping_duplicate,$post_duplicate;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AffiliateDailyCounts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'businessloans_affiliate_daily_counts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
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
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
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
	public function search()
	{
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
		$connection=Yii::app()->dbBusinessLoans;
		if(Yii::app()->session['ping_type'] == 'post'){
			$accept_query = ($aff_lead_status==1) ? ' , post_accepted = post_accepted + 1' : '';
			$duplicate_query = ($duplicate==1) ?  ' , post_duplicate = post_duplicate + 1' : '';
			$query = "INSERT INTO businessloans_affiliate_daily_counts VALUES ('".$date."' , $promo_code , 1 , 1 , 1 , 1 , $duplicate , $aff_lead_status) ON DUPLICATE KEY UPDATE post_sent = post_sent + 1 $accept_query $duplicate_query";
		}elseif(Yii::app()->session['ping_type'] == 'directpost'){
			$accept_query = ($aff_lead_status==1) ? ' , post_accepted = post_accepted + 1' : '';
			$duplicate_query = ($duplicate==1) ?  ' , post_duplicate = post_duplicate + 1' : '';
			$query = "INSERT INTO businessloans_affiliate_daily_counts VALUES ('".$date."' , $promo_code , 0 , 0 , 0 , 1 , $duplicate , $aff_lead_status) ON DUPLICATE KEY UPDATE post_sent = post_sent + 1 $accept_query $duplicate_query";
		}else{
			$accept_query = ($aff_lead_status==1) ? ' , ping_accepted = ping_accepted + 1' : '';
			$duplicate_query = ($duplicate==1) ?  ' , ping_duplicate = ping_duplicate + 1' : '';
			$query = "INSERT INTO businessloans_affiliate_daily_counts VALUES ('".$date."' , $promo_code , 1 , $duplicate, $aff_lead_status , 0 , 0 , 0) ON DUPLICATE KEY UPDATE ping_sent = ping_sent + 1 $accept_query $duplicate_query";
		}
		$command=$connection->createCommand($query);
		$dataReader=$command->query();		
	}
	/**
	 * Affiliate Ping Post Statistics
	 */
	public function affiliate_pingpost_statistics(){
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
		$criteria = new CDbCriteria();
		$criteria->alias = "a";
		$criteria->select = "a.* , b.user_name";
		$criteria->join = "LEFT JOIN `businessloans_affiliate_user` AS b ON a.promo_code = b.id";
		$criteria->condition = "`date` BETWEEN '".$sdate."' AND  '".$edate."'";
		$criteria->order = "`date` DESC";
		$result = $this->findAll($criteria);
		if(!empty($result)){
			return $result;
		}else{
			return [];
		}
	}
	/**
	 * Total Ping Sent by Affiliates in Last 15 Days Graph Used on Dashboard 
	 */
	public function pingsoflast15days(){
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-15,date('Y')));
		$edate = date('Y-m-d');
		$criteria = new CDbCriteria();
		$criteria->select = "date , SUM(ping_sent) AS ping_sent";
		$criteria->condition = "`date` BETWEEN '".$sdate."' AND  '".$edate."'";
		$criteria->group = "date";
		$criteria->order = "`date` DESC";
		$result = $this->findAll($criteria);
		$xml_cat = "";
		$xml_cat .="<graph counttion='Total Pings of Last 15 Days' rotateNames='1' xAxisName='Last 15 days' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
		foreach ($result as $row) {
			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
			$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			$xml_cat .='<set name="'.substr($row['date'],0,10).'" value="'.$row['ping_sent'].'" color="'.$color.'"/>';
		}
		return $xml_cat.="</graph>" ;
	}
	/**
	 * Total Conversions in Last 15 Days Graph Used on Dashboard
	 */
	public function conversionsoflast15days(){
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-15,date('Y')));
		$edate = date('Y-m-d');
		$criteria = new CDbCriteria();
		$criteria->select = "date , SUM(post_accepted) AS post_accepted";
		$criteria->condition = "`date` BETWEEN '".$sdate."' AND  '".$edate."'";
		$criteria->group = "date";
		$criteria->order = "`date` DESC";
		$result = $this->findAll($criteria);
		
		$xml_cat = "";
		$xml_cat .="<graph counttion='Total Conversions of Last 15 Days' rotateNames='1' xAxisName='Last 15 days' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
		foreach ($result as $row) {
			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
			$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			$xml_cat .='<set name="'.substr($row['date'],0,10).'" value="'.$row['post_accepted'].'" color="'.$color.'"/>';
		}
		return $xml_cat.="</graph>" ;
	}
	/**
	 * Today's Ping Report (Displayed on admin dashboard) 
	 * Count today's total ping, duplicate pings, rejected pings, and accepted pings
	 */
	public function todayspingreport(){
		$criteria=new CDbCriteria();
		$criteria->select="date , SUM(ping_sent) AS ping_sent , SUM(ping_duplicate) AS ping_duplicate , SUM(ping_accepted) AS ping_accepted";
		$criteria->condition = "date = '".date('Y-m-d')."'";
		$results = $this->find($criteria);
		$ping_sent = $results['ping_sent'];
		$ping_duplicate = $results['ping_duplicate'];
		$ping_accepted = $results['ping_accepted'];
		$ping_rejected = $ping_sent - $ping_duplicate - $ping_accepted;
		if($ping_sent == 0){
			return "No Records";
		}else{
			$graph = '<graph showNames="1" yAxisMinValue=\'0\' yAxisMaxValue=\'10\' decimalPrecision=\'0\' showPercentageValues="0" >';
			$graph .= '<set color="#191970" name="Duplicate Pings" value="'.$ping_duplicate.'"/>';
			$graph .= '<set color="#A52A2A" name="Rejected Pings" value="'.$ping_rejected.'"/>';
			$graph .= '<set color="#215F0A" name="Accepted Pings" value="'.$ping_accepted.'"/></graph>';
			return $graph;
		}
	}
	/**
	 * Today's Post Report (Displayed on admin dashboard) 
	 * Count today's total post, duplicate post, rejected post, and accepted post
	 */
	public function todayspostreport(){
		$criteria=new CDbCriteria();
		$criteria->select="date , SUM(post_sent) AS post_sent , SUM(post_duplicate) AS post_duplicate , SUM(post_accepted) AS post_accepted";
		$criteria->condition = "date = '".date('Y-m-d')."'";
		$results = $this->find($criteria);
		$post_sent = $results['post_sent'];
		$post_duplicate = $results['post_duplicate'];
		$post_accepted = $results['post_accepted'];
		$post_rejected = $post_sent - $post_duplicate - $post_accepted;
		if($post_sent == 0){
			return "No Records";
		}else{
			$graph = '<graph showNames="1" yAxisMinValue=\'0\' yAxisMaxValue=\'10\' decimalPrecision=\'0\' showPercentageValues="0" >';
			$graph .= '<set color="#191970" name="Duplicate Post" value="'.$post_duplicate.'"/>';
			$graph .= '<set color="#A52A2A" name="Rejected Post" value="'.$post_rejected.'"/>';
			$graph .= '<set color="#215F0A" name="Accepted Post" value="'.$post_accepted.'"/></graph>';
			return $graph;
		}
	}
	/**
	 * Specific Affiliate's Ping Report Pie Chart for Last 15 Days(Displayed Affiliate Dashboard)
	 */
	public static function specific_affiliate_pingreport_last_15days(){
		$days = 15;
		$start_date = date('Y-m-d',mktime (0,0,0,date('m'),date('d')-$days,date('Y')));
		$end_date = date('Y-m-d').' 23:59:59';
		$criteria=new CDbCriteria();
		$criteria->select="date,SUM(ping_sent) AS ping_sent,SUM(ping_duplicate) AS ping_duplicate,SUM(ping_accepted) AS ping_accepted";
		if(isset($promo_code) && $promo_code > 0){
			$criteria->condition = "`date` BETWEEN '$start_date' AND '$end_date' AND promo_code = $promo_code";
		}else{
			$criteria->condition = "`date` BETWEEN '$start_date' AND '$end_date'";
		}
		$result = AffiliateDailyCounts::model()->find($criteria);
		//echo '<pre>=====pingsss=======';print_r($criteria);print_r($result);exit;
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
		$start_date = date('Y-m-d',mktime (0,0,0,date('m'),date('d')-$days,date('Y')));
		$end_date = date('Y-m-d').' 23:59:59';
		$criteria=new CDbCriteria();
		$criteria->select="date,SUM(post_sent) AS post_sent,SUM(post_duplicate) AS post_duplicate,SUM(post_accepted) AS post_accepted";
		if(isset($promo_code) && $promo_code > 0){
			$criteria->condition = "`date` BETWEEN '$start_date' AND '$end_date' AND promo_code = $promo_code";
		}else{
			$criteria->condition = "`date` BETWEEN '$start_date' AND '$end_date'";
		}
		$result = AffiliateDailyCounts::model()->find($criteria);
		if(empty($result)){
			return false;
		}else{
			return $result;
		}
	}
}
