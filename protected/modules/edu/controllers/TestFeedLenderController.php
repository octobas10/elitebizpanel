<?php
class TestFeedLenderController extends Controller
{	/**
	 * This is the default 'index' action that is invoked
	*/
	public $layout ='column1';
	public function actionIndex(){
		$FeedLenders_model = new EduFeedLenders;
		$AffiliateUser_model = new AffiliateUser;
		$Submission_model = new Submissions();

		if(isset($_POST['testformsubmit'])){
			
			if(strlen($_POST['Submissions']['dob_month'])=='1'){
				$dob_month = '0'.$_POST['Submissions']['dob_month'];
			}else{
				$dob_month = $_POST['Submissions']['dob_month'];
			}
			if(strlen($_POST['Submissions']['dob_day'])==1){
				$dob_day = '0'.$_POST['Submissions']['dob_day'];
			}else{
				$dob_day = $_POST['Submissions']['dob_day'];
			}
			$dob = $dob_month.'/'.$dob_day.'/'.$_POST['Submissions']['dob_year'];
			
			$_POST['dob'] = $dob;
			$_POST['source'] = $_SERVER['SERVER_NAME'];
			
// 			echo '<pre>';print_r($_POST);echo '</pre>';exit;
			
			FeedpostProcessController::pingFeedLenders('testfeedlender');
		}
		$feed_lenders = EduFeedLenders::model()->findAll(array('order'=>'feed_lender_name'));
		$feed_lender_name = CHtml::listData($feed_lenders, 'id', 'feed_lender_name');
		array_unshift($feed_lender_name, "--Select--");
		
		$feed_vendors = EduFeedVendors::model()->findAll(array('order'=>'username'));
		
		$promo_code = CHtml::listData(AffiliateUser::model()->findAll(),'id','id');
		
	    $criteria = new CDbCriteria;
		$criteria->order = 'date DESC';
		$total = AffiliateTransactions::model()->count();
        $pages = new CPagination($total);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $posts = FeedLenderTransactions::model()->findAll($criteria);
        
        $this->render('index', array(
        	'posts' => $posts,
            'pages' => $pages,
			'FeedLenders_model'=>$FeedLenders_model,
        	'AffiliateUser_model'=>$AffiliateUser_model,
        	'Submission_model'=>$Submission_model,
			'feed_lender_name'=>$feed_lender_name,
			'feed_lenders'=>$feed_lenders,
			'feed_vendors'=>$feed_vendors,
			'promo_code' =>$promo_code,
		));
	}
}
