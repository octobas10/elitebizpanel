<?php
class FeedCashLenderController extends Controller
{	/**
	 * This is the default 'index' action that is invoked
	*/
	public $layout ='column1';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{ 
	    $model = new AutoFeedLenders;
		if(isset($_POST['AutoFeedLenders'])){
		$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
		$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
		list($pday1,$pmonth1,$pyear1) = explode("-",@date("d-m-Y",time()+86400));
		list($pday2,$pmonth2,$pyear2) = explode("-",@date("d-m-Y",time()+((86400)*30)));
		 $request ='lead_mode=1&sub_id=feedabc&lender_id='.$_POST['AutoFeedLenders']['feed_lender_name'].'&promo_code='.$_POST['promo_code'].'&time_limit='.$_POST['time_limit'].'&first_name='.$firstname.'&last_name='.$lastname.'&email=mahesh@elitemate.com&gender=0&address=14&city=JACKSONVILLE&state=CA&zip=4544&is_rented=0&stay_in_year=3&stay_in_month=5&home_pay=100&phone=0370105678&mobile=9876543210&dob=15/11/1987&months_at_Bank=11&job_title=worker&employer=Equity+Housing+Group&employerphoneNumber=9876543210&supervisor_name=Daniel&monthly_income=1040&mainIncome=Job&employment_in_month=02&employment_in_year=5&work_phone=9638527410&income_type=1&ssn=123456789&ipaddress=90.215.232.207&loan_amount=500&bankruptcy=0&best_time_contact=1&cosigner=0&agree_credit_check=1&url=elitecashwire.com&comments=comment abc';
		  $link = $_SERVER['HTTP_HOST'] =='localhost' ? "http://localhost/eliteauto/index.php/postTest_process" : "http://staging.axiombpm.com/eliteauto.com/index.php/postTest_process" ;
		  $url = 'http://localhost/eliteauto/index.php/postTest_process';
		//$url = "http://staging.axiombpm.com/eliteauto.com/index.php/postTest_process";
		  $response = CommonMethods::curl($url,$request);
		}
	     $feeds = CHtml::listData(AutoFeedLenders::model()->findAll(array('order' => 'feed_lender_name')), 'id', 'feed_lender_name');
         $feedvendor = CHtml::listData(AutoFeedVendor::model()->findAll(),'id','id');		
	   // $this->render('index',array('model'=>$model,'lenders'=>$lenders));
		    $criteria = new CDbCriteria;
			$criteria->order = 'createdAt DESC';
            $total = FeedVendorTransactions::model()->count();
            $pages = new CPagination($total);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $posts = AutoFeedLenders::model()->findAll($criteria);
			//$posts = FeedLenderTransactions::model()->search();
			//print_r($posts); exit;
            $this->render('index', array(
                'posts' => $posts,
                'pages' => $pages,
				'model'=>$model,
				'feeds'=>$feeds,
				'feedvendor' =>$feedvendor,
            ));
	}
}	
