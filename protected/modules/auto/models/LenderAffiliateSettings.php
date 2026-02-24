<?php
/**
 * This is the model class for table "auto_lender_affiliate_settings".
 *
 * The followings are the available columns in table 'auto_lender_affiliate_settings':
 * @property integer $id
 * @property integer $affiliate_user_id
 * @property integer $lender_details_id
 * @property integer $intervals
 * @property integer $count
 * @property integer $orderby
 * @property integer $status
 * @property string $isRoundRobin
 */
class LenderAffiliateSettings extends CActiveRecord{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LenderAffiliateSettings the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'auto_lender_affiliate_settings';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('affiliate_user_id,lender_details_id,intervals,cap,orderby,status,isRoundRobin','required'),
			array('affiliate_user_id, lender_details_id, intervals,cap,orderby,status','numerical','integerOnly'=>true),
			array('isRoundRobin','length','max'=>1),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, affiliate_user_id, lender_details_id, intervals,cap,orderby,status,isRoundRobin','safe', 'on'=>'search'),
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		   'affiliate' => array(self::BELONGS_TO,'AffiliateUser', 'affiliate_user_id'),
		   'lender_details' => array(self::BELONGS_TO,'LenderDetails', 'lender_details_id'),
		  
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id' => 'ID',
			'affiliate_user_id' => 'Affiliate',
			'lender_details_id' => 'Lender',
			'intervals' => 'Interval',
			'cap' => 'Cap',
			'orderby' => 'Orderby',
			'status' => 'Status',
			'isRoundRobin' => 'Is Round Robin',
		);
	}

	/**
	 * 
	 * @param unknown $vendor
	 * @return string|unknown
	 */
	public static function getPausedListvendor($vendor){
		if($vendor==""){
			return 'No Paused vendor';
	   	}else{
	   		return $vendor;
		}
	}
	
	/**
	 * 
	 * @param unknown $id
	 */
	public function actionData($id){
		$this->layout='blank';
		$this->render('dialogbox',array(
			'id'=>$id,
		));  
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
		$criteria->compare('affiliate_user_id',$this->affiliate_user_id);
		$criteria->compare('lender_details_id',$this->lender_details_id);
		$criteria->compare('intervals',$this->intervals);
		$criteria->compare('cap',$this->cap);
		$criteria->compare('orderby',$this->orderby);
		$criteria->compare('status',$this->status);
		$criteria->compare('isRoundRobin',$this->isRoundRobin,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 
	 * @param unknown $status
	 * @return string
	 */
	public static function getStatus($status){
	   if($status==1){
	      return 'Active';
	   
	   }else{
	      return 'InActive';
	   }
	}
	
	/**
	 * 
	 * @param unknown $status
	 * @return string
	 */
	public static function getIsroundRobin($status){
	   if($status==1){
	      return 'Yes';
	   
	   }else{
	      return 'No';
	   }
	}
	
	/**
	 * 
	 * @param unknown $id
	 */
	public function findcapoflender($id){
		return $cap = Yii::app()->db->createCommand()
	    ->select('cap')
	    ->from('auto_lender_affiliate_settings')
		->where('id=:id', array(':id'=>$id))
	    ->queryScalar();
	}
	
	/**
	 * 
	 */
	public function actionPausevendorAjax(){
		extract($_REQUEST);
		$connection = yii::app()->db;
		$sql = "UPDATE auto_lender_affiliate_settings SET paused_vendor  = '$val' WHERE id=$id";
		$command=$connection->createCommand($sql);
		$command->execute();
		if($val!="") 
		echo $val;
		else echo 'No Paused vendor';
	}
}
