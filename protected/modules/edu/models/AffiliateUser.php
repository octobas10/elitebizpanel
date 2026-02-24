<?php
error_reporting(1);
ini_set('display_errors', E_ALL);
/**
 * This is the model class for table "edu_affiliate_user".
 *
 * The followings are the available columns in table 'edu_affiliate_user':
 * @property string $id
 * @property string $status
 * @property string $user_name
 * @property string $password
 * @property integer $isAdmin
 * @property string $last_log
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $phone
 * @property string $createdAt
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
class AffiliateUser extends EModuleActiveRecord {	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AutoAffiliateUser the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'edu_affiliate_user';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		   array('user_name,password,email,first_name,last_name','required'),
			array('email,status,first_name,last_name,company_name,phone,isAdmin,is_inorganic,margin,pixel_type,pixel_code','length'),
			array('email','email'),
			array('user_name, password, first_name, last_name', 'length', 'max'=>50),
			array('user_name,email','unique'),
			array('phone', 'length', 'min'=>10),
			array('phone,bucket_limit,cap_limit','numerical','integerOnly'=>true),
			array('zip_code,website,street,city,state,tax_id','safe', 'except' => array('create', 'update')),
			array('zip_code','numerical','integerOnly'=>true),
			array('zip_code','length','min'=>5,'max'=>6),
			array('dup_days','numerical','integerOnly'=>true,'min'=>1,'max'=>72),
			array('createdAt','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'),
			array('isAdmin', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, user_name, password, isAdmin, email, first_name, last_name, company_name, phone, createdAt, bucket, is_inorganic, street, city, state, zip_code, website, tax_id', 'safe', 'on'=>'search'),
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
			'id' => 'Promo Code',
			'status' => 'Status',
			'user_name' => 'User Name',
			'password' => 'Password',
			'isAdmin' => 'Is Admin',
			'last_log' => 'Last Log',
			'email' => 'Email',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'company_name' => 'Company Name',
			'phone' => 'Phone',
			'dup_days' => 'Duplicate Check Days',
			'cap_limit' => 'Cap Limit',
			'bucket' => 'Bucket',
			'bucket_limit' => 'Bucket Limit',
			'pixel_type' => 'Pixel Type',
			'pixel_code' => 'Pixel Code',
			'margin' => 'Margin (%)',
			'is_inorganic' => 'Affiliate Type',
			'createdAt' => 'Created At',
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
		$criteria->compare('id',$this->id,false);
		/**
		 * @Author : Siddharajsinh Maharaul
		 * @Date : 31-12-2016 10:23 AM
		 * @functionality : Strict search enabled
		 */
		$criteria->compare('status',$this->status,false);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('isAdmin',$this->isAdmin);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('phone',$this->phone,true);
		/**
		 * @Author : Siddharajsinh Maharaul
		 * @Date : 31-12-2016 10:23 AM
		 * @functionality : Strict search enabled
		 */
		$criteria->compare('bucket',$this->bucket,false);
		$criteria->compare('bucket_limit',$this->bucket_limit,true);
		/**
		 * @Author : Siddharajsinh Maharaul
		 * @Date : 31-12-2016 10:23 AM
		 * @functionality : Strict search enabled
		 */
		$criteria->compare('margin',$this->margin,false);
		$criteria->compare('pixel_type',$this->pixel_type,true);
		$criteria->compare('pixel_code',$this->pixel_code,true);
		$criteria->compare('is_inorganic',$this->is_inorganic,true);
		$criteria->compare('createdAt',$this->createdAt,true);
		/**
		 * @Author : Siddharajsinh Maharaul
		 * @Date : 31-12-2016 10:23 AM
		 * @functionality : Strict search enabled
		 */
		$criteria->compare('cap_limit',$this->cap_limit,false);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeSave() {
		if(parent::beforeSave() && $this->isNewRecord) {
			$this->password = md5($this->password);
		}
	    return true;
	}
	/** Check Affiliate Status */
  	public function checkAffiliateStatus($promo_code,$process = 'organic'){
  		$cm = new CommonMethods();
  		if($promo_code){
  			$criteria=new CDbCriteria;
  			$criteria->select='status';
  			$criteria->condition = 'id='.$promo_code;
  			$row = AffiliateUser::model()->find($criteria);
  			if(empty($row)){
  				$cm->setRespondError('','affiliate_noavailable',$process);
  			}elseif($row['status']=='-1'){
  				$cm->setRespondError('','inactive_campaign',$process);
  			}elseif($row['status']=='0'){
  				// $cm->setRespondError('','TestMode',$process);
  				Yii::app()->session['lead_mode'] = 0;
  			}elseif($row['status']=='1'){
  				Yii::app()->session['lead_mode'] = 1;
  			}
  		}else{
  			$cm->setRespondError('','affiliate_noavailable',$process);
  		}
	}
	/** Check Affiliate IP Block Value */
  	public function checkAffiliateIPBlock($promo_code,$process = 'organic'){
  		$cm = new CommonMethods();
  		if($promo_code){
  			$criteria=new CDbCriteria;
  			$criteria->select='allow_duplicate_ip';
  			$criteria->condition = 'id='.$promo_code;
  			$row = AffiliateUser::model()->find($criteria);
  			if(empty($row)){
  				$cm->setRespondError('','affiliate_noavailable',$process);
  			}elseif($row['allow_duplicate_ip']=='1'){
  				// Yii::app()->session['ip_blocking_enabled'] = 0;
  				return true;
  			}elseif($row['allow_duplicate_ip']=='0'){
  				// Yii::app()->session['ip_blocking_enabled'] = 1;
  				return false;
  			}
  		}else{
  			$cm->setRespondError('','affiliate_noavailable',$process);
  		}
	}
	/** Check Affiliate Lead Cap */
	public function check_affiliate_cap($promo_code){
	  $criteria=new CDbCriteria;
	  $criteria->select='cap_limit';
	  $criteria->condition = 'id='.$promo_code;
	  $row = AffiliateUser::model()->find($criteria);
	  //return false if affiliates's cap_limit not found
	  if(isset($row) && !empty($row)) {
	   if(isset($row['cap_limit']) && $row['cap_limit']==-1){
		return true;
	   }else{
		/** count total leads send today from affiliate */
		$startdate = date('Y-m-d')." 00:00:00";$enddate = date('Y-m-d')." 23:59:59";
		$where = "`promo_code`= $promo_code AND sub_date > '$startdate'";
		//$where = "`promo_code`= $promo_code AND DATE(sub_date) = '$startdate";
		//$where = "`promo_code`= '$promo_code' AND sub_date BETWEEN '$startdate' AND '$enddate'";
		$total_submission_of_affiliate_today = parent::getDbConnection()->createCommand()->select('count(id)')->from('edu_submissions')->where($where)->queryScalar();
		return ($affiliate_cap > $total_submission_of_affiliate_today) ? true : false;
	   }
	  }else{
		return false;
	  }
	}
	public function margin_percent(){
		for($i = 10; $i <= 100; $i++){
			$percent[$i] = $i;
		}
		return array('' => 'Percent') + $percent;
	}
	/**
	 * Update Bucket and Return Pixel Count(How many time pixel code will display).
	 */
	public function update_bucket_and_return_pixel_count($affiliate_transaction_id=''){
		if(isset($affiliate_transaction_id) && !empty($affiliate_transaction_id)) {
			$affiliate_trans_id = $affiliate_transaction_id;
		} else {
			$affiliate_trans_id = $_SESSION['affiliate_trans_id'];
		}
		$model = new LenderAffiliateTransaction();
		$lender_details = $model->lender_details_from_affiliate_tranaction_id($affiliate_trans_id);
		$promo_code = $lender_details['promo_code'];
		$lead_price = $lender_details['post_price'];
		$aff_data = AffiliateUser::model()->findByPK($promo_code);
		$bucket_limit = $aff_data->bucket_limit;
		$bucket = $aff_data->bucket + $lead_price;
		$pixel_count = $aff_data->pixel_count;
	
		$update = parent::getDbConnection()->createCommand()->update('edu_affiliate_user', array('bucket'=>$bucket), 'id=:id', array(':id'=>$promo_code));
		
		$pixel = 0;
		
		if($update){
			$i_status = 0;
			while($bucket>=($bucket_limit)){
				$i_status = 1;
				$bucket -= $bucket_limit;
				$pixel++;
				$pixel_count++;
				parent::getDbConnection()->createCommand()->update('edu_affiliate_user', array('bucket'=>$bucket,'pixel_count'=>$pixel_count),'id=:id',array(':id'=>$promo_code));
			}
			if($i_status==1){
				$model_aff_trnsaction = new AffiliateTransactions();
				$model_aff_trnsaction -> updateAffiliateTransactions(array('pixel_fired'=>'1'),$affiliate_transaction_id);
			}
		}
		return $pixel;
	}
	
	public function get_pixel($affiliate_trans_id) {
		$pixel_code = '';
		$aff_trans_model = AffiliateTransactions::model()->findByPk($affiliate_trans_id);
		$promo_code = $aff_trans_model->promo_code;
		$aff_user_model = AffiliateUser::model()->findByPk($promo_code);
		$pixel_code = $aff_user_model->pixel_code;
		
		if(strlen($pixel_code) > 0 && $pixel_code != 'NULL' && $pixel_code != ''){
			$patterns = array('/ebpleadid/', '/ebpsubid/', '/ebptransid/');
			$replacements = array($aff_trans_model->customer_id, $aff_trans_model->sub_id, $affiliate_trans_id);
			$pixel_code = urldecode($pixel_code);
			$pixel_code = preg_replace($patterns, $replacements, $pixel_code);
		}
		return $pixel_code;
	}
	public static function getStatus($status){
		switch($status){
			case 0: $txt = 'Test';break;
			case 1: $txt = 'Active';break;
			case -1: $txt = 'Inactive';break;
			default: $txt = 'Select';
		}
		return $txt;
	}
	public static function getAffiliateType($affiliate_type){
		return ($affiliate_type==0) ? 'Organic' : 'Inorganic';
	}
	public static function getAffiliatePixelType($affiliate_trans_id){
		$aff_trans_model = AffiliateTransactions::model()->findByPk($affiliate_trans_id);
		$promo_code = $aff_trans_model->promo_code;
		$aff_user_model = AffiliateUser::model()->findByPk($promo_code);
		return $pixel_type = $aff_user_model->pixel_type;
	}
	public static function getAffiliatePixelTypeString($pixel_type){
		return ($pixel_type==0) ? 'HTML Pixel' : 'Server Sider Pixel';
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : download supression list of email or phone as per the request
	 ** Date : 02-08-2016
	**/
	public function downloadSupressionList($fields,$table){
		$query_data = '';
		if(isset($fields) && !empty($fields) && isset($table) && !empty($table)){
			$query_data = parent::getDbConnection()->createCommand()
			->select($fields)
			->from($table)
			->queryAll();
		}
		return $query_data;
	}
	
	/**
	 * @author : Vatsal Gadhia
	 * @description : check email is already available in supression list or not
	 * @since : 02-08-2016
	**/
	/**
	  * @author : Vatsal Gadhia
	  * @description : $is_check_only parameter passed so that new record is not inserted when we are just checking that email is exist or not
	  * @since : 23-12-2016 13:17 PM
	 */
	public function checkSupressionEmailExist($email,$is_check_only=0){
		if(isset($email) && !empty($email)) {
			$email_supression = parent::getDbConnection()->createCommand()->select('email')
				->from('edu_email_supression_list')
				->where("`email`='". $email."'")
				->query();
				if($email_supression->rowCount==0){
					if($is_check_only==1) {
						return 1;
					} else {
						parent::getDbConnection()->createCommand()->insert('edu_email_supression_list',array('email'=>$email));
						Yii::app()->user->setFlash('success','Emails Added Successfully');
					}
				}
				else{
					if($is_check_only==1) {
						return 2;
					} else {
						Yii::app()->user->setFlash('error','Error Occured. Email Already Available');
					}
				}
		}else{
			if($is_check_only==1) {
				return 3;
			} else {
				Yii::app()->user->setFlash('error','Invalid Argument');
			}
		}
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : check phone is already available in supression list or not
	 ** Date : 02-08-2016
	**/
	public function checkSupressionPhoneExist($phone){
		if(isset($phone) && !empty($phone)) {
			$phone_supression = parent::getDbConnection()->createCommand()->select('phone')
			->from('edu_phone_supression_list')
			->where("phone=". $phone)
			->query();
			if($phone_supression->rowCount==0){
				parent::getDbConnection()->createCommand()->insert('edu_phone_supression_list',array('phone'=>$phone));
				Yii::app()->user->setFlash('success','Phone Added Successfully');
			}
			else{
				Yii::app()->user->setFlash('error','Error Occured. Phone Already Available');
			}
		}else{
			Yii::app()->user->setFlash('error','Invalid Argument');
		}
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : view all creatives
	 ** Date : 02-08-2016
	**/
	public function actionCreatives(){
			$creatives = parent::getDbConnection()->createCommand()->select('id,private_label,promotional_text,image_name,promo_code,c_date')
			->from('edu_promotional_creatives')
			->where('')
			->order('c_date desc')
			->queryAll();
		return $creatives;
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : add creatives
	 ** Date : 02-08-2016
	**/
	public function actionAddCreatives($private_label,$promotional_text,$save_name,$promo_code){
		if(isset($private_label) && !empty($private_label) && isset($promotional_text) && !empty($promotional_text) && isset($save_name) && !empty($save_name) && isset($promo_code) && !empty($promo_code)) {
			$res = parent::getDbConnection()->createCommand()->insert($table='edu_promotional_creatives',$columns=array('private_label'=>$private_label,'promotional_text'=>$promotional_text,'image_name'=>$save_name,'promo_code'=>$promo_code,'c_date'=>date('Y-m-d H:i:s')));
			return $res;
		}else{
			Yii::app()->user->setFlash('error','Invalid Argument');
		}
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : remove creatives
	 ** Date : 02-08-2016
	**/
	public function actionRemoveCreatives($condition){
		if(isset($condition) && !empty($condition)) {
			$res = parent::getDbConnection()->createCommand()->delete($table='edu_promotional_creatives',$conditions=$condition,$params=array());
			return $res;
		}else{
			Yii::app()->user->setFlash('error','Invalid Argument');
		}
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : view specific email creatives
	 ** Date : 02-08-2016
	**/
	public function actionViewEmailCreatives($where){
		$creatives = parent::getDbConnection()->createCommand()->select('id,image_name,promo_code,c_date,creative_from_line,creative_subject_line')
		->from('edu_email_creatives')
		->where($where)
		->order('c_date desc')
		->queryRow();
		return $creatives;
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : view all email creatives
	 ** Date : 02-08-2016
	**/
	public function actionEmailCreatives(){
		$creatives = parent::getDbConnection()->createCommand()->select('id,image_name,promo_code,c_date')
		->from('edu_email_creatives')
		->order('c_date desc')
		->queryAll();
		return $creatives;
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : view all email creatives subject
	 ** Date : 02-08-2016
	**/
	public function actionEmailCreativesSubject(){
		$email_creatives_subject_lines = parent::getDbConnection()->createCommand()->select('id,subject_lines,promo_code,c_date')
		->from('edu_email_creatives_subject_lines')
		->order('c_date desc')
		->queryAll();
		return $email_creatives_subject_lines;
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : view all email creatives from
	 ** Date : 02-08-2016
	**/
	public function actionEmailCreativesFrom(){
		$email_creatives_from_lines = parent::getDbConnection()->createCommand()->select('id,from_lines,promo_code,c_date')
		->from('edu_email_creatives_from_lines')
		->order('c_date desc')
		->queryAll();
		return $email_creatives_from_lines;
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : add email creatives
	 ** Date : 02-08-2016
	**/
	public function actionAddEmailCreatives($save_name,$promo_code,$email_creatives_subject_line='',$email_creatives_from_line=''){
		if(isset($save_name) && !empty($save_name) && isset($promo_code) && !empty($promo_code)) {
			$res = parent::getDbConnection()->createCommand()->insert($table='edu_email_creatives',$columns=array('image_name'=>$save_name,'creative_subject_line'=>$email_creatives_subject_line,'creative_from_line'=>$email_creatives_from_line,'promo_code'=>$promo_code,'c_date'=>date('Y-m-d H:i:s')));
			return $res;
		}else{
			Yii::app()->user->setFlash('error','Invalid Argument');
		}
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : view all email creatives subject and from as per request
	 ** Date : 02-08-2016
	**/
	public function actionAddEmailCreativesSubjectFrom($email_creatives_subject_from_line,$promo_code,$option){
		$res = '';
		if(isset($option) && !empty($option)) {
			if($option == 1) {
				$res = parent::getDbConnection()->createCommand()->insert($table='edu_email_creatives_subject_lines',$columns=array('subject_lines'=>$email_creatives_subject_from_line,'promo_code'=>$promo_code,'c_date'=>date('Y-m-d H:i:s')));
			} elseif($option == 2) {
				$res = parent::getDbConnection()->createCommand()->insert($table='edu_email_creatives_from_lines',$columns=array('from_lines'=>$email_creatives_subject_from_line,'promo_code'=>$promo_code,'c_date'=>date('Y-m-d H:i:s')));
			}else{
				Yii::app()->user->setFlash('error','Invalid Argument');
			}
		}else{
			Yii::app()->user->setFlash('error','Invalid Argument');
		}
		return $res;
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : remove email creatives
	 ** Date : 02-08-2016
	**/
	public function actionRemoveEmailCreatives($condition){
		if(isset($condition) && !empty($condition)) {
			$res = parent::getDbConnection()->createCommand()->delete($table='edu_email_creatives',$conditions=$condition,$params=array());
			return $res;
		}else{
			Yii::app()->user->setFlash('error','Invalid Argument');
		}
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : remove email
	 ** Date : 02-08-2016
	**/
	public function actionRemovemeEmail($email){
		if(isset($email) && !empty($email)) {
			$user = parent::getDbConnection()->createCommand()
				->select('email')
				->from('edu_email_supression_list')
				->where('email=:email', array(':email'=>$email))
				->queryRow();
				if(empty($user)){
					parent::getDbConnection()->createCommand()->insert('edu_email_supression_list',array('email'=>$email));
					$response['success'][]='Email Added Successfully';
				}else{
					$response['fail'][]='Email Already Exist';
				}
				return $response;
		}else{
			$response['fail'][]='Invalid Argument';
			return $response;
		}
	}
	
	/**
	 ** Author : Vatsal Gadhia
	 ** Description : remove phone
	 ** Date : 02-08-2016
	**/
	public function actionRemovemePhone($phone){
		if(isset($phone) && !empty($phone)) {
			$user = parent::getDbConnection()->createCommand()
				->select('phone')
				->from('edu_phone_supression_list')
				->where('phone=:phone', array(':phone'=>$phone))
				->queryRow();
				if(empty($user)){
					parent::getDbConnection()->createCommand()->insert('edu_phone_supression_list',array('phone'=>$phone));
					$response['success'][]='Phone Added Successfully';
				}else{
					$response['fail'][]='Phone Already Exist';
				}
				return $response;
		}else{
			$response['fail'][]='Invalid Argument';
			return $response;
		}
	}
       public function actionCheckAffiliateEmail($email){
		if(isset($email) && !empty($email)) {
				$email_supression = parent::getDbConnection()->createCommand()->select('email')
					->from('edu_affiliate_user')
					->where("`email`='". $email."'")
					->query();
         
					if($email_supression->rowCount>0){
						$response['success']='1';
                       
                        $MIN_SESSION_ID = 1000000000;
$MAX_SESSION_ID = 9999999999;

$randId = mt_rand($MIN_SESSION_ID, $MAX_SESSION_ID);

$response['pass']=$randId;
                        $update = parent::getDbConnection()->createCommand()->update('edu_affiliate_user', array('password'=>md5($randId)), 'email=:email', array('email'=>$email));
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
	 * @author : Vatsal Gadhia
	 * @description : update UpdateAt field when affiliates details updated through "UpdateByData()"
	 * @since : 21-09-2016
	*/
	public function actionAffiliateUpdatedat($id) {
		parent::getDbConnection()->createCommand()->update('edu_affiliate_user', array('updatedAt'=>date('Y-m-d H:i:s')), 'id=:id', array(':id'=>$id));
	}
	
	/**
	 * @author : Vatsal Gadhia
	 * @description : compare password before upadte
	 * @since : 27-09-2016
	*/
	public function actionCheckPassword($password,$id) {
		if(isset($password) && !empty($password) && isset($id) && !empty($id)) {
			$t_affiliate_details = parent::getDbConnection()->createCommand()->select('id')
			->from('edu_affiliate_user')
			->where("id=".$id." AND password='".$password."'")
			->queryAll();
			if(isset($t_affiliate_details) && !empty($t_affiliate_details)) {
				//return false if password is same as password stored in database
				return false;
			} else {
				//return true if password is not same as password stored in database so that we can convert it using md5
				return true;
			}
		}
		return false;
	}
   /** verify Affiliate Status */
	//return 1 = active affiliate
	//return 2 = test affiliate
	//return 3 = inactive affiliate
  	public function verifyAffiliateStatus($promo_code){
  		if($promo_code){
  			$criteria=new CDbCriteria;
  			$criteria->select='status';
  			$criteria->condition = 'id='.$promo_code;
  			$row = AffiliateUser::model()->find($criteria);
  			if(empty($row)){
  				return 3;
  			}elseif($row['status']=='1'){
  				return 1;
  			}elseif($row['status']=='0'){
  				return 2;
  			}
  			return 3;
  		}else{
  			return 3;
  		}
	}

	

	public function changeDuplicateIP($id,$duplicate) {
		if(parent::getDbConnection()->createCommand()->update('edu_affiliate_user', array('allow_duplicate_ip'=>$duplicate), 'id=:id', array(':id'=>$id))) {
			return true;
		}
		return false;
	}

	/* public function checkUSPSPostalAddress($address,$city,$state,$zip,$is_insert='0',$is_valid='0',$s_response='') {
		if(isset($is_insert) && $is_insert=='1') {
			parent::getDbConnection()->createCommand()->insert('edu_address_verification',array('address'=>$address,'city'=>$city,'state'=>$state,'zip_code'=>$zip,'is_valid'=>$is_valid,'response'=>$s_response,'response_date_time'=>date('Y-m-d H:i:s'),'api'=>'1'));
		} else {
			$msg = '3';
			$postal_verification = parent::getDbConnection()->createCommand()->select('id,is_valid')
				->from('edu_address_verification')
				->where("address='".$address."' AND city='".$city."' AND state='".$state."' AND zip_code='".$zip."' LIMIT 1")
				->queryAll();
				if(isset($postal_verification) && !empty($postal_verification)) {
					if($postal_verification[0]['is_valid']==1) {
						//valid
						$msg = '1';
					} else {
						//not valid
						$msg = '2';
					}
				}
			return $msg;
		}
	} */

	public function getAllowedVerification() {
		$allowed_verification = parent::getDbConnection()->createCommand()->select('verify_phone,verify_email,verify_address')
				->from('edu_affiliate_verification')
				->queryAll();
		return $allowed_verification;
	}

	public function updateAllowedVerification($verify_phone,$verify_email,$verify_address,$update='0') {
		if($update=='1') {
			if(parent::getDbConnection()->createCommand()->update('edu_affiliate_verification', array('verify_phone'=>$verify_phone,'verify_email'=>$verify_email,'verify_address'=>$verify_address,'date_modified'=>date('Y-m-d H:i:s')))) {
				return true;
			}
		} else {
			if(parent::getDbConnection()->createCommand()->insert('edu_affiliate_verification',array('verify_phone'=>$verify_phone,'verify_email'=>$verify_email,'verify_address'=>$verify_address,'date_created'=>date('Y-m-d H:i:s')))) {
				return true;
			}
		}
		return false;
	}
	
}
