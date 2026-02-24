<?php
class FeedLenderTransactions extends autoInsuranceActive {
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
        return 'autoinsurance_feed_lender_transactions';
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
		$feed_lender_name = Yii::app()->getRequest()->getParam('feed_lender_name');
		$response = Yii::app()->getRequest()->getParam('response');
		$filter = explode(' - ',Yii::app()->getRequest()->getParam('date'));
		$count =  count($filter);
		
		$start_date = count($filter) == 2 ?  strtotime($filter[0]." 00:00:00") :  strtotime('today midnight');;
		$end_date = count($filter) == 2 ?  strtotime($filter[1]." 23:23:59") :  strtotime('tomorrow - 1 second');
		
		$where[] = $feed_lender_name ? "feed_lender_name = '".$feed_lender_name."'" : '';
		$where[] = ($response!='') ? "response = '".$response."'" : '';
 		$where[] = $start_date ? "UNIX_TIMESTAMP(`date`) >= ".$start_date."" : '';
 		$where[] = $end_date ? "UNIX_TIMESTAMP(`date`) <= ".$end_date."" : '';
 		
		$order ="date DESC";
		
		$where = array_filter($where);
		$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
		
//  		echo '<pre>'.$where.'</pre>';exit;
		
		return $rawData = Yii::app()->dbAutoinsurance->createCommand()
	    ->select('id,feed_lender_name,date,request,full_response,response,')
	    ->from('autoinsurance_feed_lender_transactions')
		->where($where)
		->order($order)
	    ->queryAll();
	}
    
}
