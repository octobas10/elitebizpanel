<?php
error_reporting(1);
ini_set('display_errors', E_ALL);
/**
 * This is the model class for table "edu_affiliate_stat_logs".
 *
 * The followings are the available columns in table 'edu_affiliate_user':
 * @property integer $id
 * @property integer $promo_code
 * @property string $link
 * @property integer $count
 * @property string $date
 */
class AffiliateStatLogs extends EModuleActiveRecord {	
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
		return 'edu_affiliate_stat_logs';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		   array('promo_code,count,link,date','required'),
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
			'promo_code' => 'Promo Code',
			'link' => 'Link',
			'count' => 'Count',
			'date' => 'Date',
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
		$criteria->compare('promo_code',$this->promo_code,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('count',$this->count,true);
		$criteria->compare('date',$this->date,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/** Check Affiliate Status */
  	public function checkAffiliateStatLogs($promo_code,$link) {
  		if (strpos($link, 'undefined') !== false || strpos($link, 'graph') !== false) {
		} else {
	  		$connection=parent::getDbConnection();
			$where = "`promo_code`= '$promo_code' AND `link`= '$link' AND DATE(date) = '".date('Y-m-d')."'";
			$affiliate_stat_count = parent::getDbConnection()->createCommand()->select('COUNT(id) as id')->from('edu_affiliate_stat_logs')->where($where)->queryAll();
			if(isset($affiliate_stat_count) && !empty($affiliate_stat_count) && $affiliate_stat_count[0]['id']>0) {
				$query = "UPDATE `edu_affiliate_stat_logs` SET `count`=`count`+1 WHERE ".$where;
			} else {
				$query = "INSERT INTO edu_affiliate_stat_logs VALUES ('','".$promo_code."', '".$link."' , 1 , '".date('Y-m-d')."')";
			}
			$command=$connection->createCommand($query);
			$dataReader=$command->query();
		}	
	}
	public function affiliate_stat_logs() {
		/*$promo_code = Yii::app()->request->getParam('promo_code');
		$days = 7;
		$sdate = date('Y-m-d');
		$edate = date('Y-m-d');
		$date_filter = Yii::app()->request->getParam('date_filter');
		if(!empty($date_filter)){
			$filter = explode("-",$date_filter);
			$count = count($filter);
			if($count == 2){
				$sdate =  date("Y-m-d", strtotime($filter[0]));
				$edate =  date("Y-m-d", strtotime($filter[1]));
			}elseif($count == 1){
				$sdate =  date("Y-m-d", strtotime($filter[0]));
				$edate =  date("Y-m-d", strtotime($filter[0]));
			}
		}
		
		$where[] = $promo_code ? "promo_code = ".$promo_code : '';
		$where[] = "date >= '".$sdate."'";
		$where[] = "date <= '".$edate."'";
		
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		$orderby = "date DESC";
		
		$dbCommand = parent::getDbConnection()->createCommand()
		->select("DATE(date) AS date, count , link")
		->from('edu_affiliate_stat_logs')
		->where($where)
		->order($orderby);
		return $dbRows = $dbCommand->queryAll();*/
		
		$promo_code = Yii::app()->request->getParam('promo_code');
		$days = 7;
		$sdate = date('Y-m-d');
		$edate = date('Y-m-d');
		$date_filter = Yii::app()->request->getParam('date_filter');
		if(!empty($date_filter)){
			$filter = explode("-",$date_filter);
			$count = count($filter);
			if($count == 2){
				$sdate =  date("Y-m-d", strtotime($filter[0]));
				$edate =  date("Y-m-d", strtotime($filter[1]));
			}elseif($count == 1){
				$sdate =  date("Y-m-d", strtotime($filter[0]));
				$edate =  date("Y-m-d", strtotime($filter[0]));
			}
		}
		$orderby = "date DESC";

		if(Yii::app()->user->getState('roles')!='1' && Yii::app()->user->getState('usertype')=='affiliate') {
			if(empty($date_filter)) {
				$sdate = date('Y-m-d', strtotime('-7 days'));
				$edate = date('Y-m-d');
			}
				$promo_code = Yii::app()->user->id;
		
				$where[] = $promo_code ? "promo_code = ".$promo_code : '';
				$where[] = "date >= '".$sdate."'";
				$where[] = "date <= '".$edate."'";
				
				$where = array_filter($where);
				$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
				$dbCommand = parent::getDbConnection()->createCommand()
				->select("DATE(date) AS date, SUM(count) as count , link")
				->from('edu_affiliate_stat_logs')
				->where($where)
				->order($orderby)
				->group("date");
		} else {
		
			$where[] = $promo_code ? "promo_code = ".$promo_code : '';
			$where[] = "date >= '".$sdate."'";
			$where[] = "date <= '".$edate."'";
			
			$where = array_filter($where);
			$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
			$dbCommand = parent::getDbConnection()->createCommand()
			->select("DATE(date) AS date, count , link")
			->from('edu_affiliate_stat_logs')
			->where($where)
			->order($orderby);
		}
		return $dbRows = $dbCommand->queryAll();
	}
}
