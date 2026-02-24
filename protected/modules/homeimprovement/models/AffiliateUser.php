<?php
error_reporting(1);
ini_set('display_errors', E_ALL);
/**
 * This is the model class for table "homeimprovement_affiliate_user".
 *
 * The followings are the available columns in table 'homeimprovement_affiliate_user':
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
class AffiliateUser extends HomeimprovementActive {
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
		return 'homeimprovement_affiliate_user';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		   array('user_name,password,','required'),
			array('email,status,first_name,last_name,company_name,phone,isAdmin,is_inorganic,margin,pixel_type,pixel_code','length'),
			array('email','email'),
			array('user_name, password, first_name, last_name', 'length', 'max'=>50),
			array('user_name','unique'),
			array('phone', 'length', 'min'=>10),
			array('phone,bucket_limit,cap_limit','numerical','integerOnly'=>true),
			array('dup_days','numerical','integerOnly'=>true,'min'=>1,'max'=>72),
			array('createdAt','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'),
			array('isAdmin', 'numerical', 'integerOnly'=>true),
			array('min_bid_price', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, user_name, password, isAdmin, email, first_name, last_name, company_name, phone, createdAt, bucket, is_inorganic', 'safe', 'on'=>'search'),
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
			'min_bid_price' => 'Min Bid Price ($)',
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('isAdmin',$this->isAdmin);
		$criteria->compare('min_bid_price',$this->min_bid_price);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('bucket',$this->bucket,true);
		$criteria->compare('bucket_limit',$this->bucket_limit,true);
		$criteria->compare('margin',$this->margin,true);
		$criteria->compare('pixel_type',$this->pixel_type,true);
		$criteria->compare('pixel_code',$this->pixel_code,true);
		$criteria->compare('is_inorganic',$this->is_inorganic,true);
		$criteria->compare('createdAt',$this->createdAt,true);
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
  				$cm->setRespondError('','TestMode',$process);
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
		if(isset($row['cap_limit']) && $row['cap_limit']==-1){
			return true;
		}else{
			$affiliate_cap = $row['cap_limit'];
			/** count total leads send today from affiliate */
			$startdate = date('Y-m-d')." 00:00:00";$enddate = date('Y-m-d')." 23:59:59";
			//$where = "`promo_code`= '$promo_code' AND DATE(sub_date) = '".$startdate."'";
			//$where = "`promo_code`= $promo_code AND sub_date BETWEEN '$startdate' AND '$enddate'";
			$where = "`promo_code`= $promo_code AND sub_date > '$startdate'";
			$total_submission_of_affiliate_today = Yii::app()->dbHomeimprovement->createCommand()->select('COUNT(id)')->from('homeimprovement_submissions')->where($where)->queryScalar();
			return ($affiliate_cap > $total_submission_of_affiliate_today) ? true : false;
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
	public function update_bucket_and_return_pixel_count(){
		$affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
		$model = new LenderAffiliateTransaction();
		$lender_details = $model->lender_details_from_affiliate_tranaction_id($affiliate_trans_id);
		$promo_code = $lender_details['promo_code'];
		$lead_price = $lender_details['ping_price'];
		$aff_data = AffiliateUser::model()->findByPK($promo_code);
		$bucket_limit = $aff_data->bucket_limit+5;  // 5 point of commission
		$bucket = $aff_data->bucket + $lead_price;
		$pixel_count = $aff_data->pixel_count;
	
		$update = Yii::app()->dbHomeimprovement->createCommand()->update('homeimprovement_affiliate_user', array('bucket'=>$bucket), 'id=:id', array(':id'=>$promo_code));
		
		$pixel = 0;
		
		if($update){
			while($bucket>=($bucket_limit)){
				$bucket -= $bucket_limit;
				$pixel++;
				Yii::app()->dbHomeimprovement->createCommand()->update('homeimprovement_affiliate_user', array('bucket'=>$bucket,'pixel_count'=>$pixel_count+1),'id=:id',array(':id'=>$promo_code));
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
}
