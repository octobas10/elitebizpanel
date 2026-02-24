<?php
class FeedSubmissionsController extends Controller{
	public static function actionValidationCheck(){
		$data = $_POST; $model = new FeedSubmission();
		$_POST['FeedSubmission'] = $data;
		$model->attributes = $data;
		$model->feed_vendor_id = $data['vendor_id'];
		if(isset($_POST['FeedSubmission'])){
			if (!$model->validate()){
				$cm = new CommonMethods();
				$cm->setRespondFeedSubmissionsError($model->getErrors(),'submission');
			}
		}
	}
	
	public static function actionCheckDuplicate($called_from_interface='feed'){
	    $data = array();
		$model = new FeedSubmission();
		$dbCommand=Yii::app()->db;
		if($called_from_interface=='lead'){
			foreach ($_POST as $key=>$value){
				foreach ($value as $k=>$v){
					$data[$k] = $v;
				}
			}
			$vendor_id = $data['promo_code'];
		}else if($called_from_interface=='feed'){
			$data = $_POST;
			$vendor_id = $data['vendor_id'];
		}
		
		$string = "uniqueness,dup_days";
		$where = "id = ".$vendor_id;
		
		$list = Yii::app()->db->createCommand()
		->select($string)
		->from('auto_feed_vendor')
		->where($where)
		->queryAll();
		
		$condition = "";
	    $day = $list[0]['dup_days']; 
		if($list[0]['uniqueness'] =='0'){
			$condition = " AND feed_vendor_id = ".$vendor_id;
		}

		$string = "COUNT(*) as count";
		$where = "email='".$data['email']."' AND first_name = '".$data['first_name']."' AND last_name ='".$data['last_name']."' AND UNIX_TIMESTAMP(sub_date) > '".strtotime('- '.$day.'days')."' ".$condition;
		
		$dataReader = Yii::app()->db->createCommand()
		->select($string)
		->from('auto_feed_submission')
		->where($where)
		->queryAll();
		
		if($dataReader[0]['count'] > 0){
			$cm = new CommonMethods();
			$cm->setRespondFeedSubmissionsError('','duplicate');
		}else{
			$model->attributes = $data;
			$model->feed_vendor_id = $vendor_id;
			$model->source = isset($data['url']) ? $data['url'] :$data['source'];
			if(!$model->save()){ echo 'Feed Not Save<br><pre>';print_r($model->errors);echo '</pre>';exit; }
		}
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}

	
}
