<?php
	/*
	** author : vatsal gadhia
	** modification : extend class changed from CActiveRecord to EModuleActiveRecord
	** modification date : 02-08-2016
	*/
class FeedLenderTransactions extends EModuleActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Country the static model class
     */
    public $feed_lender_name;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'edu_feed_lender_transactions';
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('feed_lender_name','length'),
            array('request','length'),
            array('full_response','length'),
            array('post_url','length'),
            array('response','length'),
            array('createdAt','required')
        );
    }
    
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('feed_lender_name', $this->feed_lender_name);
        $criteria->compare('request', $this->request);
        $criteria->compare('full_response', $this->full_response);
        $criteria->compare('response', $this->response);
        $criteria->compare('post_url', $this->post_url);
        $criteria->compare('statuseatedAt', $this->createdAt);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria
        ));
        
    }
    
	public function browsefeedlendertransction(){
		$criteria = new CDbCriteria();
		$feed_lender_name = Yii::app()->getRequest()->getParam('feed_lender_name');
		$response = Yii::app()->getRequest()->getParam('response');

		
		/**
		 * @author : vatsal gadhia
		 * @description : way of retrieving dates changed
		 * @since : 19-09-2016
		*/
		if(isset($_SESSION['date_search_criteria']) && !empty($_SESSION['date_search_criteria'])) {
			if($_SESSION['date_search_criteria'] == Yii::app()->getRequest()->getParam('date',date('m/d/Y'))) {
			} else {
				//URL contains page text
				if(strpos(Yii::app()->request->requestUri, 'page') !== false){
				}else {
				//URL didn't contains page text
					if(date('m/d/Y')==Yii::app()->getRequest()->getParam('date',date('m/d/Y'))) {
					} else {
						$_SESSION['date_search_criteria'] = Yii::app()->getRequest()->getParam('date',date('m/d/Y'));
					}
				}
			}
		} else {
			$_SESSION['date_search_criteria'] = Yii::app()->getRequest()->getParam('date',date('m/d/Y'));
		}
		$filter = explode(' - ',$_SESSION['date_search_criteria']);
		$count = count($filter);
		$start_date = ($count == 2) ? date("Y-m-d", strtotime($filter[0])).' 00:00:00' : date("Y-m-d", strtotime($filter[0])).' 00:00:00';
		$end_date = ($count == 2) ? date("Y-m-d", strtotime($filter[1])).' 23:59:59' : date("Y-m-d", strtotime($filter[0])).' 23:59:59';
		$curr_start_date = Date("Y-m-d")." 00:00:00";
		$curr_end_date = Date("Y-m-d")." 23:59:59";
		/*if($start_date==$curr_start_date && $end_date==$curr_end_date)
		{
			$u_uri = explode("/",Yii::app()->request->requestUri);
			$t_len = count($u_uri);
			if($u_uri[$t_len-2]=="page")
			{
				$start_date = $_SESSION['start_date_search'];
				$end_date = $_SESSION['end_date_search'];
			}
		}
		else
		{
			$_SESSION['start_date_search'] = $start_date;
			$_SESSION['end_date_search'] = $end_date;
		}*/
		$where[] = $feed_lender_name ? "feed_lender_name = '".$feed_lender_name."'" : '';
		$where[] = ($response!='') ? "response = '".$response."'" : '';
 		$where[] = ($start_date && $end_date) ? "`date` BETWEEN '".$start_date."' AND '".$end_date."'" : '';
		$order ="date DESC";
		
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		
		$criteria->select = 'id,feed_lender_name,date,request,full_response,response';
		$criteria->condition = $where;
		$criteria->order = 'date DESC';
		//print_r($criteria);
		return $criteria;
	}
	
	public function lender_ping_status_update($lender_name,$promo_code,$ping_status,$price){
		$connection=Yii::app()->db;
		$price = isset($price) ? $price : 0;
		$accept_query = ($ping_status==1) ? ',`ping_accepted`=`ping_accepted`+1' : '';
		if($ping_status==1){
		}
		else{ $ping_status=0; }
		$sql1="INSERT INTO edu_lenders_affiliates_transactions VALUES('".$lender_name."',$promo_code,$price,curdate(),1,$ping_status,0,0,now()) on duplicate key update `ping_sent`=`ping_sent`+1 $accept_query";
		//die("1");
		$command=$connection->createCommand($sql1);
		$dataReader=$command->query();
	}
	
	public function lender_post_status_update($lendername,$promo_code,$post_status,$price,$static_price_direct_post=false){
		$connection=Yii::app()->db;
		$price = isset($price) ? $price : 0;
		$accept_query = ($post_status==1) ? ',`post_accepted`=`post_accepted`+1' : '';
		if($post_status==1){
		}
		else{ $post_status=0; }
		if($static_price_direct_post==false){
			$sql1="INSERT INTO edu_lenders_affiliates_transactions VALUES('".$lendername."',$promo_code,$price,curdate(),1,1,1,$post_status,now()) on duplicate key update `post_sent`=`post_sent`+1 $accept_query";
		//die("2");
		}elseif($static_price_direct_post==true){
			$sql1="INSERT INTO edu_lenders_affiliates_transactions VALUES('".$lendername."',$promo_code,$price,curdate(),0,0,1,$post_status,now()) on duplicate key update `post_sent`=`post_sent`+1 $accept_query";
			//echo $post_status;
		//die("3");
		}
		$command=$connection->createCommand($sql1);
		$dataReader=$command->query();
	}
	
	
	public static function actionLenderTransaction($data){
		$feed_vendor_id = ($data['vendor_id']!='') ? $data['vendor_id'] : 0;
		//Pingpost
		if(Yii::app()->request->getParam('ping_id') && Yii::app()->session['ping_type']=='post'){
			$ping_id = $data['ping_id'];
			$feed_lender_trans = FeedLenderTransactions::model()->findByPk($ping_id);
			$feed_lender_trans->request = http_build_query($_POST);
			$feed_lender_trnsaction->feed_vendor_id = $feed_vendor_id;
			if($feed_lender_trans->validate()){
				$feed_lender_trans->save();
				Yii::app()->session['affiliate_trans_id'] = $ping_id;
				Yii::app()->session['feed_lender_trans_id'] = $ping_id;
			}else{
				echo $feed_lender_trans->getErrors();
			}
		}
		//Directpost
		elseif(!Yii::app()->request->getParam('ping_id') && Yii::app()->session['ping_type']=='directpost'){
			$feed_lender_trnsaction = new FeedLenderTransactions();
			$feed_lender_trnsaction->attributes = $data;
			$feed_lender_trnsaction->date = date('Y-m-d H:i:s');
			$feed_lender_trnsaction->request = http_build_query($_POST);
			$feed_lender_trnsaction->feed_vendor_id = $feed_vendor_id;
			$feed_lender_trnsaction->insert();
			Yii::app()->session['affiliate_trans_id'] = $feed_lender_trnsaction->id;//Yii::app()->db->lastInsertID;
			Yii::app()->session['feed_lender_trans_id'] = $feed_lender_trnsaction->id;//Yii::app()->db->lastInsertID;
		}
		//Ping
		else{
			$feed_lender_trnsaction = new FeedLenderTransactions();
			$feed_lender_trnsaction->date = date('Y-m-d H:i:s');
			$feed_lender_trnsaction->request = http_build_query($_POST);
			$feed_lender_trnsaction->feed_vendor_id = $feed_vendor_id;
			$feed_lender_trnsaction->insert();
			Yii::app()->session['affiliate_trans_id'] = $feed_lender_trnsaction->id;//Yii::app()->db->lastInsertID;
			Yii::app()->session['feed_lender_trans_id'] = $feed_lender_trnsaction->id;//Yii::app()->db->lastInsertID;
		}
	}
	/**
	 * Specific Lender Report (Displayed Lender Dashboard when they logged in)
	 */
	public function specific_feed_lender_report(){
		$lender_name = Yii::app()->user->name;
		$days = 7;
		$sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-$days,date('Y'))).' 00:00:00';
		$edate = date('Y-m-d').' 23:59:59';
		$date_filter = Yii::app()->request->getParam('date_filter');
		if(!empty($date_filter)){
			$filter = explode("-",$date_filter);
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
		->select("feed_lender_name as lender_name , DATE(date) AS date , COUNT(request) AS post_sent, COUNT( CASE WHEN response='1' THEN request END ) as post_accepted ,  COUNT( CASE WHEN response='-1' THEN request END ) as lead_returned")
		->from('edu_feed_lender_transactions')
		->where("feed_lender_name = '".$lender_name."' AND `date` <= '".$edate."' AND `date` >= '".$sdate."'")
		->group("DATE(date)")
		->order("date DESC");		
		return $dbRows = $dbCommand->queryAll();
	}

	public function leadinfo_for_specfic_lender(){
		// $lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
		$lender_name = Yii::app()->user->name;
		
		$lender_name = (Yii::app()->user->getState('usertype')=='edulender') ? $lender_name : Yii::app()->request->getParam('lender_name');
		
		
		$post_sent = Yii::app()->request->getParam('post_sent');
		$post_status = Yii::app()->request->getParam('post_status');
		$lead_returned = Yii::app()->request->getParam('lead_returned');
		$final = Yii::app()->request->getParam('final');
		$date = Yii::app()->request->getParam('date');
	
		$where[] = $lender_name ? "feed_lender_name = '".$lender_name."'" : '';
		$where[] = ($post_sent==1) ? "request != '' " : '';
		$where[] = ($post_status==1) ? "response = 1" : '';
		$where[] = ($lead_returned==1) ? "response = 0" : '';
		$where[] = ($final==1) ? "response = 1" : '';
		$where[] = $date ? "date >= '".$date." 00:00:00'" : '';
		$where[] = $date ? "date <= '".$date." 23:59:59'" : '';
	
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
	
		$criteria=new CDbCriteria();
		$criteria->select = 'id,feed_lender_name,date,request,full_response';
		$criteria->condition = $where;
		return $criteria;
	}
}
?>