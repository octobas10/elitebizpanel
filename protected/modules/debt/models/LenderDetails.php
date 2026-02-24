<?php
/**
 * This is the model class for table "debt_lender_details".
 *
 * The followings are the available columns in table 'debt_lender_details':
 * @property integer $id
 * @property integer $lender_id
 * @property string $name
 * @property string $tier
 * @property double $lead_price
 * @property string $parameter1
 * @property string $parameter2
 * @property string $parameter3
 * @property string $ping_url_test
 * @property string $ping_url_live
 * @property string $ping_string_test
 * @property integer $ping_string_live
 * @property string $post_string_test
 * @property string $post_string_live
 * @property integer $posting_timelimit
 * @property integer $order
 * @property string $status
 */
class LenderDetails extends DebtActive{
	/**   
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LenderDetails the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'debt_lender_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		   array('user_name,name','required'),
			array('user_name','unique'),
			array('email,status,first_name,last_name,company_name,phone,submission_cap,hourly_submission_cap,accepted_cap,note,margin','length'),
			array('status, phone', 'length', 'max'=>32),
			array('email','email'),
			array('phone','numerical','integerOnly'=>true),
		    array('name','unique', 'message'=>'{attribute}:{value} already exists!'),
			array('static_lead_price,parameter1,parameter2,parameter3,post_url_test,post_url_live,ping_url_live,ping_url_test,status,posting_timelimit','length'),
			array('static_lead_price','numerical'),
			array('posting_timelimit','numerical'),
			array('parameter1,parameter2, parameter3,ping_url_test,ping_url_live','length','max'=>255),
			array('id,name,static_lead_price,parameter1,parameter2,parameter3,ping_url_test,ping_url_live, posting_timelimit,active_mode,status,margin','safe', 'on'=>'search'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id' => 'Lender ID',
			'static_lead_price' => 'Static Lead Price',
			'name' => 'Post Name',
			'parameter1' => 'Parameter1',
			'parameter2' => 'Parameter2',
			'parameter3' => 'Parameter3',
			'ping_url_test' => 'Ping test url',
			'ping_url_live' => 'Ping live url',
			'post_url_test' => 'Post test Url',
			'post_url_live' => 'Post live Url',
			'posting_timelimit' => 'Posting Timelimit',
			'user_name' => 'Lender Name',
			'password' => 'Password',
			'paused_vendor' => 'Paused Vendor',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'company_name' => 'Company Name',
			'email' => 'Email',
			'status' => 'Status',
			'createdAt' => 'Created At',
			'active_mode' => 'Mode',
			'margin' => 'Buyer Margin',
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
		//$criteria->compare('lender_id',$this->lender_id);
		$criteria->compare('paused_vendor',$this->paused_vendor,true);
		$criteria->compare('static_lead_price',$this->static_lead_price);
		$criteria->compare('parameter1',$this->parameter1,true);
		$criteria->compare('parameter2',$this->parameter2,true);
		$criteria->compare('parameter3',$this->parameter3,true);
		$criteria->compare('ping_url_test',$this->ping_url_test,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('submission_cap',$this->submission_cap);
		$criteria->compare('hourly_submission_cap',$this->hourly_submission_cap);
		$criteria->compare('accepted_cap',$this->accepted_cap);
		$criteria->compare('ping_url_live',$this->ping_url_live,true);
		$criteria->compare('post_url_test',$this->post_url_test,true);
		$criteria->compare('post_url_live',$this->post_url_live);
		$criteria->compare('posting_timelimit',$this->posting_timelimit);
		$criteria->compare('status',$this->status);
		$criteria->compare('margin',$this->margin);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function getStatus($status){
		if($status==0){
			return 'TestMode';
		}else if($status=='1'){
			return 'Active';
		}else if($status=='-1'){
			return 'Inactive';
		}else{
			return 'Select';
		}
	}
	public function beforeSave(){
		if(parent::beforeSave() && $this->isNewRecord) {
			$this->password = md5($this->password);
		}
	    return true;
	}
	public static function getPausedListaffilate($affilate){
	   if($affilate==""){
			return 'No Paused affilate';
	   }else{
			return $affilate;
	   }
	}
	public function actionData($id){
		$this->layout='blank';
		$this->render('dialogbox',array(
			'id'=>$id,
		));  
	}
	public function actionPausevendorAjax(){
		extract($_REQUEST);
		$connection = yii::app()->dbDebt;
		$sql = "UPDATE debt_lender_details SET paused_vendor  = '$val' WHERE id=$id";
		$command=$connection->createCommand($sql);
		$command->execute();
		if($val!="") echo $val;
		else echo 'No Paused affilate';
	}	
	public function check_acceptCap($lender_id) {
		// SUBMISSION CAP AND ACCEPTED CAP OF LENDER
		$cmd = Yii::app()->dbDebt->createCommand()
			->select('submission_cap,accepted_cap,hourly_submission_cap')
			->from('debt_lender_details')
			->where('id=:lender_id', [':lender_id'=>$lender_id])
			->limit('1');
		$row = $cmd->queryRow();	
		$len_submission_cap = $row['submission_cap'];
		$len_hourly_submission_cap = $row['hourly_submission_cap'];
		$len_accepted_cap = $row['accepted_cap'];
		// TOTAL SUBMISSION AND TOTAL ACCEPTED FOR LENDER TODAY 
		$today = date('Y-m-d');
		$where = "lender_id = $lender_id AND `date` = '".$today."'";
		$cmd = Yii::app()->dbDebt->createCommand()
			->select('SUM(ping_sent) AS total_submission,SUM(post_accepted) AS total_accept')
			->from('debt_lenders_affiliates_transactions')
			->where($where)
			->limit('1');
		$row = $cmd->queryRow();	
		$submission_cap = $row['total_submission'];
		$accept_cap = $row['total_accept'];
		// TOTAL HOURLY SUBMISSION CAP
		$where = "lender_id = $lender_id AND last_inserted_datetime >= DATE_SUB(NOW(),INTERVAL 1 HOUR)";
		$cmd = Yii::app()->dbDebt->createCommand()
			->select('SUM(ping_sent) as hourly_submission_cap')
			->from('debt_lenders_affiliates_transactions')
			->where($where)
			->limit('1');
		$row = $cmd->queryRow();	
		$hourly_submission_cap = $row['hourly_submission_cap'];
		/*if($_SERVER['REMOTE_ADDR'] == '82.36.128.57'){
			echo '<pre>';
			PRINT_R($hourly_submission_cap);
			ECHO '====';
			print_r($submission_cap);
			ECHO '====';
			print_r($accept_cap);
			exit;
		}*/
		// CHECK TRAFFIC IN AND OUT TIME FOR THE LENDER, IF RECORD SET THEN SEND TRUE
		$where = "id= '$lender_id' AND (NOT FIND_IN_SET(DAYOFWEEK(DATE(CURTIME())),traffic_out_days) OR traffic_out_days='' OR traffic_out_days IS NULL) AND (HOUR(CURTIME()) BETWEEN traffic_in_start_time AND traffic_in_end_time OR (traffic_in_start_time='' AND traffic_in_end_time='') OR (traffic_in_start_time IS NULL AND traffic_in_end_time IS NULL))";
		$cmd = Yii::app()->dbDebt->createCommand()
			->select('id')
			->from('debt_lender_details')
			->where($where)
			->limit('1');
		$InoutDays = $cmd->queryRow();
		if(empty($InoutDays['id'])){
			return false;
		}else if($len_submission_cap == '-1' && $len_accepted_cap == '-1' && $len_hourly_submission_cap == '-1'){
			return true;
		}else if($len_hourly_submission_cap != '-1' && $len_hourly_submission_cap <= $hourly_submission_cap){
			return false;
		}else if($len_submission_cap != '-1' && $len_submission_cap <= $submission_cap){
			return false;
		}else if($len_accepted_cap != '-1' && $len_accepted_cap <= $accept_cap){
			return false;
		}else{
			return true;
		}
	}
	public function margin_percent(){
		for($i = 10; $i <= 100; $i++){
			$percent[$i] = $i;
		}
		return array('' => 'Percent') + $percent;
	}
	public function check_paused_vendor($lender_id){
		$where = "id= '$lender_id'";
		$array = Yii::app()->dbDebt->createCommand()
		->select('paused_vendor')
		->from('debt_lender_details')
		->where($where)
		->queryAll();
		$paused_vendor = array();
		foreach ($array as $value){
			foreach ($value as $key=>$value){
				$paused_vendor[] = $value;
			}
		}
		$paused_vendor = explode(',', $paused_vendor[0]);
		return $paused_vendor;
	}
	public function GetAllLenders(){
		$lender_details = Yii::app()->dbDebt->createCommand()
		->select('id,user_name')
		->from('debt_lender_details')
		->queryAll();
		$lenders = [];
		if($lender_details){
			foreach ($lender_details as $lender){
				$lenders[$lender['id']] = $lender['user_name'];
			}
			return $lenders;
		}else{
			return [];
		}
	}
	public function getLenderDetails($user_name) {
        $dbCommand = Yii::app()->dbDebt->createCommand()
                ->select('static_lead_price')
                ->from('debt_lender_details')
                ->where('user_name = "' . $user_name . '"');
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }

}
