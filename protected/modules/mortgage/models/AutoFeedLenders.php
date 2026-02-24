<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * This is the model class for table "mortgage_feed_lenders".
 *
 * The followings are the available columns in table 'mortgage_feed_lenders':
 * @property integer $id
 * @property string $feed_lender_name
 * @property string $password
 * @property string $parameter1
 * @property string $parameter2
 * @property string $parameter3
 * @property string $paused_vendor
 * @property integer $count
 * @property integer $interval
 * @property integer $delay
 * @property string $status
 * @property string $createdAt
 */
class AutoFeedLenders extends MortgageActive
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mortgage_feed_lender';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('feed_lender_name, password,submission_cap,status,post_url,test_url,interval,delay', 'required'),
			array('submission_cap','numerical','integerOnly'=>true),
			array('feed_lender_name,parameter1, parameter2, parameter3, paused_vendor', 'length', 'max'=>500),
			array('password', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			array('createdAt', 'default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, feed_lender_name, password, parameter1, parameter2, parameter3, paused_vendor, submission_cap, interval, delay, status, createdAt', 'safe', 'on'=>'search'),
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
			'feed_lender_name' => 'Feed Lender Name',
			'password' => 'Password',
			'parameter1' => 'Parameter1',
			'parameter2' => 'Parameter2',
			'parameter3' => 'Parameter3',
			'paused_vendor' => 'Paused Vendor',
			'submission_cap' => 'Submission Cap',
			'interval' => 'Interval',
			'delay' => 'Delay',
			'status' => 'Status',
			'post_url' => 'Post Url',
			'test_url' => 'Test Url',
			'createdAt' => 'Created At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search(){
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('feed_lender_name',$this->feed_lender_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('parameter1',$this->parameter1,true);
		$criteria->compare('parameter2',$this->parameter2,true);
		$criteria->compare('parameter3',$this->parameter3,true);
		$criteria->compare('paused_vendor',$this->paused_vendor,true);
		$criteria->compare('submission_cap',$this->submission_cap);
		$criteria->compare('interval',$this->interval);
		$criteria->compare('delay',$this->delay);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('post_url',$this->post_url,true);
		$criteria->compare('test_url',$this->test_url,true);
		$criteria->compare('createdAt',$this->createdAt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function getStatus($status){
	   if($status==1){
	      return 'Live';
	   }else{
	     return 'Test';
	   }
	
	}
	public static function getPausedListvendor($vendor){
	   if($vendor==""){
	      return 'No Paused vendor';
	   }else{
	     return $vendor;
	   }
	
	}
	public function actionData($id){
		$this->layout='blank';
		$this->render('dialogbox',array(
			'id'=>$id,
		));  
	}
	public function getvendorslist(){
		extract($_REQUEST);
		$update = Yii::app()->dbMortgage->createCommand()->update('mortgage_feed_lenders', array('paused_vendor'=>$val),'id=:id',array(':id'=>$id));
		if($val!=""){
			return $val;
		}
		else {return 'No paused Vendors'; }
		
	}	
	/**
	check cap,interval,all paramater for send lead
	 */
	public function check_caps($feed_lender_name,$promo_code = false){
		// GET INFORMATION OF THE FEED LENDER
		$feedlenderlist = Yii::app()->dbMortgage->createCommand()
		->select('submission_cap,accepted_cap,dailysubmission_capcount,dailyaccepted_capcount,interval,delay,commit_point,limit,status,capdate,paused_vendor')
		->from('mortgage_feed_lenders')
		->where('feed_lender_name=:feed_lender_name', array(':feed_lender_name'=>$feed_lender_name))
		->queryAll();
		
		//echo "<pre>";print_r($feedlenderlist);echo "</pre>";
		
		$cap_limit= $feedlenderlist[0]['submission_cap'];
		$accepted_cap= $feedlenderlist[0]['accepted_cap'];
		$status= $feedlenderlist[0]['status'];
		$capdate= $feedlenderlist[0]['capdate'];
		$todays_all_feeds= $feedlenderlist[0]['dailysubmission_capcount'];
		$todays_accepted_feeds= $feedlenderlist[0]['dailyaccepted_capcount'];
		$interval= $feedlenderlist[0]['interval'];
		$paused_vendor = explode(',', $feedlenderlist[0]['paused_vendor']);
		
		
		if($capdate != @date('Y-m-d')){
			Yii::app()->dbMortgage->createCommand()->update('mortgage_feed_lenders', array(
				'capdate'=>@date('Y-m-d'),
				'dailysubmission_capcount'=>'0',
				'dailyaccepted_capcount' => '0',
			), 'feed_lender_name=:feed_lender_name', array(':feed_lender_name'=>$feed_lender_name));
		}
		
		// GET LAST RECORDS SENT TO THE FEED LENDER
		$intervalcount = Yii::app()->dbMortgage->createCommand()
		->select('timestamp_lastsent')
		->from('mortgage_feed_lenders')
		->where('feed_lender_name=:feed_lender_name', array(':feed_lender_name'=>$feed_lender_name))
		->queryScalar();
		
		$leadseconds = strtotime($intervalcount);
		
		if($promo_code){
			$paused_vendor = in_array($promo_code, $paused_vendor);
		}else{
			$paused_vendor = false;
		}
		
		//echo '<br>status = '.$status.'<br>paused_vendor = '.$paused_vendor.'<br>todays_accepted_feeds = '.$todays_accepted_feeds.'<br>accepted_cap = '.$accepted_cap.'<br>todays_all_feeds = '.$todays_all_feeds.'<br>cap_limit = '.$cap_limit.'<br>interval = '.$interval.'<br>leadseconds='.$leadseconds.'<br>date='.time().'<br>date-leadsecond = '.(time() - $leadseconds);
		
		if($status='0'){
			//echo '<br>status';
			return false;
		}else if($paused_vendor){
			//echo '<br>paused';
			return false;
		}else if($todays_accepted_feeds >= $accepted_cap){
			//echo '<br>accepted';
			return false;
		}else if($todays_all_feeds >= $cap_limit){
			//echo '<br>submission';
			return false;
		}else if($interval >= (time() - $leadseconds)){
			//echo '<br>interval';
			return false;
		}else{
			return true;
		}
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AutoFeedLenders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
}
