<?php
/**
 * This is the model class for table "edu_lender_details".
 *
 * The followings are the available columns in table 'edu_lender_details':
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
 * @property string $verify_phone
 * @property string $verify_email
 * @property string $verify_address
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
class LenderDetails extends EModuleActiveRecord {
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
		return 'edu_lender_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		   array('user_name,name,password','required'),
			array('user_name','unique'),
			array('email,status,first_name,last_name,company_name,phone,submission_cap,accepted_cap,note','length'),
			array('status, phone,verify_phone,verify_email,verify_address,no_check_geo_footprint', 'length', 'max'=>32),
			array('email','email'),
			array('phone','numerical','integerOnly'=>true),
		   array('name','unique', 'message'=>'{attribute}:{value} already exists!'),
			array('static_lead_price,parameter1,parameter2,parameter3,post_url_test,post_url_live,ping_url_live,ping_url_test,status,posting_timelimit','length'),
			array('static_lead_price','numerical'),
			array('posting_timelimit','numerical'),
			array('parameter1,parameter2, parameter3,ping_url_test,ping_url_live','length','max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,name,static_lead_price,parameter1,parameter2,parameter3,ping_url_test,ping_url_live, posting_timelimit,active_mode,status,verify_phone,verify_email,verify_address,no_check_geo_footprint','safe', 'on'=>'search'),
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
			'verify_phone' => 'Verify Phone',
			'verify_email' => 'Verify Email',
			'verify_address' => 'Verify Address',
			'no_check_geo_footprint' => 'No Check Geo Footprint',
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
		$criteria->compare('accepted_cap',$this->accepted_cap);
		$criteria->compare('ping_url_live',$this->ping_url_live,true);
		$criteria->compare('post_url_test',$this->post_url_test,true);
		$criteria->compare('post_url_live',$this->post_url_live);
		$criteria->compare('posting_timelimit',$this->posting_timelimit);
		$criteria->compare('status',$this->status);
		$criteria->compare('verify_phone',$this->verify_phone);
		$criteria->compare('verify_email',$this->verify_email);
		$criteria->compare('verify_address',$this->verify_address);
		$criteria->compare('no_check_geo_footprint',$this->no_check_geo_footprint);
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
		$connection = parent::getDbConnection();
		$sql = "UPDATE edu_lender_details SET paused_vendor  = '$val' WHERE id=$id";
		$command=$connection->createCommand($sql);
		$command->execute();
		if($val!="") echo $val;
		else echo 'No Paused affilate';
	}	
	public function check_acceptCap($lender_name) {
		/** SUBMISSION CAP AND ACCEPTED CAP OF LENDER*/
		$sub_aceept_cap = parent::getDbConnection()->createCommand()
			->select('submission_cap,accepted_cap')
			->from('edu_lender_details')
			->where('user_name=:lender_name', array(':lender_name'=>$lender_name))
			->queryAll();
		$submission_cap = $sub_aceept_cap[0]['submission_cap'];
		$accepted_cap = $sub_aceept_cap[0]['accepted_cap'];
		//echo'<pre>';print_r('<br>submission_cap=>'.$submission_cap.'<br>accepted_cap=>'.$accepted_cap);echo'</pre>';
		/** TOTAL SUBMISSION AND TOTAL ACCEPTED FOR LENDER TODAY */
		$where = "`lender`= '$lender_name' AND DATE(date) = '".date('Y-m-d')."'";
		$totalsub_accept_cap = parent::getDbConnection()->createCommand()
			->select('SUM(`ping_sent`) as total_sub,SUM(`post_accepted`) as total_accept')
			->from('edu_lenders_affiliates_transactions')
			->where($where)
			->queryAll();
		$sub_cap = $totalsub_accept_cap[0]['total_sub'];
		$accep_cap = $totalsub_accept_cap[0]['total_accept'];
		// CHECK TRAFFIC IN AND OUT TIME FOR THE LENDER, IF RECORD SET THEN SEND TRUE
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('id')
		->from('edu_lender_details')
		->where("`user_name`= '$lender_name' AND NOT FIND_IN_SET(DAYOFWEEK('".date('Y-m-d')."'),traffic_out_days) AND (HOUR(CURTIME()) BETWEEN traffic_in_start_time AND traffic_in_end_time OR (traffic_in_start_time='' AND traffic_in_end_time='') OR (traffic_in_start_time IS NULL AND traffic_in_end_time IS NULL))");
		$InoutDays = $dbCommand->queryAll();
		// CHECK TRAFFIC IN AND OUT TIME FOR THE LENDER
		//mail('tony.elitecashwire@gmail.com','Lender Details model',$InoutDays[0]['id']);
		if(empty($InoutDays[0]['id'])){   # IF RECORD FOUND ( IF GOES IN IF CONDITION) THEN SEND "FALSE" MEANING REMOVE THAT LENDER TO SEND TRAFFIC
			return false;
		}else if($submission_cap == '-1' && $accepted_cap == '-1'){
			return true;
		}else if($submission_cap != '-1'){
			if($submission_cap > $sub_cap){
				if($accepted_cap == '-1') return true;
				elseif($accepted_cap > $accep_cap) return true;
			}else return false;
		}else if($accepted_cap > $accep_cap){
			return true;
		}else{
			return false;
		}
	}
	public function check_paused_vendor($lender_id){
		$where = "id= '$lender_id'";
		$array = parent::getDbConnection()->createCommand()
		->select('paused_vendor')
		->from('edu_lender_details')
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
		$lender_details = parent::getDbConnection()->createCommand()
		->select('id,user_name')
		->from('edu_lender_details')
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
	/**
	 * @author : Vatsal Gadhia
	 * @description : check if lender email is exist or not if exist then change password and send it to lender
	 * @since : 19-10-2016
	*/
	public function actionCheckLenderEmail($email){
		if(isset($email) && !empty($email)) {
			$email_supression = parent::getDbConnection()->createCommand()->select('email')
				->from('edu_lender_details')
				->where("`email`='". $email."'")
				->query();
     
				if($email_supression->rowCount>0){
					$response['success']='1';
                   
                    $MIN_SESSION_ID = 1000000000;
					$MAX_SESSION_ID = 9999999999;

					$randId = mt_rand($MIN_SESSION_ID, $MAX_SESSION_ID);
					$response['pass']=$randId;
                    $update = parent::getDbConnection()->createCommand()->update('edu_lender_details', array('password'=>md5($randId)), 'email=:email', array('email'=>$email));
				}
				else{
					$response='The email address you entered ('. $email.') is not registered.';
				}
		}else{
			$response='Invalid Argument';
			
		}
		return $response;
	}

	/**
      * @author : vatsal gadhia
      * @description : Paused/Resume Affiliates
      * @since : 26-10-2016
     */
	public function actionPauseAffiliates($affilate_id,$id,$resume_all=0){
		$connection = parent::getDbConnection();
		if($resume_all==1) {
			$sql = "UPDATE edu_lender_details SET paused_vendor = '' WHERE id=$id";
		} else {
			$sql = "UPDATE edu_lender_details SET paused_vendor = '".$affilate_id."' WHERE id=$id";
		}
		$command=$connection->createCommand($sql);
		if($command->execute()) {
			return true;
		}
		return false;
	}	
}
