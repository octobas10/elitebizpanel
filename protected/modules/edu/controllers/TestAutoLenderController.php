<?php
class TestAutoLenderController extends Controller{
	public $layout = 'column1';
	public function actionIndex(){
		$LenderDetails_model = new LenderDetails();
		$AffiliateUser_model = new AffiliateUser();
		$Submission_model = new Submissions();
		if(isset($_POST['testformsubmit'])){
			if(strlen($_POST['Submissions']['dob_month']) == '1'){
				$dob_month = '0' . $_POST['Submissions']['dob_month'];
			}else{
				$dob_month = $_POST['Submissions']['dob_month'];
			}
			if(strlen($_POST['Submissions']['dob_day']) == 1){
				$dob_day = '0' . $_POST['Submissions']['dob_day'];
			}else{
				$dob_day = $_POST['Submissions']['dob_day'];
			}
			$dob = $dob_month . '/' . $dob_day . '/' . $_POST['Submissions']['dob_year'];
			
			$request = 'lead_mode=' . $_POST['Submissions']['lead_mode'] . '&sub_id=' . $_POST['Submissions']['sub_id'] . '&lender_id=' . $_POST['LenderDetails']['name'] . '&promo_code=' . $_POST['AffiliateUser']['id'] . '&first_name=' . $_POST['first_name'] . '&last_name=' . $_POST['last_name'] . '&email=' . $_POST['email'] . '&gender=' . $_POST['gender'] . '&address=' . $_POST['address'] . '&city=' . $_POST['Submissions']['city'] . '&state=' . $_POST['Submissions']['state'] . '&zip=' . $_POST['zip'] . '&mobile=' . $_REQUEST['mobile'] . '&dob=' . $dob . '&phone=' . $_POST['zip'] . '&ssn=' . $_POST['ssn'] . '&program_of_interest=' . $_POST['program_of_interest'] . '&master_degree=' . $_POST['master_degree'] . '&ged=' . $_POST['ged'] . '&speak_english=' . $_POST['speak_english'] . '&campus=' . $_POST['campus'] . '&ipaddress=' . $_SERVER['REMOTE_ADDR'] . '&url=' . $_SERVER['SERVER_NAME'] . '&user_agent=' . $_SERVER['HTTP_USER_AGENT'] . '&sub_date=' . date('Y-m-d H:i:s') . '&pingpost=' . $_POST['pingpost'] . '';
			
			$url = Yii::app()->params['httphost'] . Yii::app()->params['backEnd'] . '/index.php/' . Yii::app()->params['campaign'] . '/postTestProcess';
			$cm = new CommonMethods();
			//echo $request;exit;
			$response = $cm->curl($url,$request);
			//echo $request.'<br><br>'.$url.'<br><br>'.$response;exit;
			
		}
		
		$criteria = new CDbCriteria();
		$criteria->order = 'date DESC';
		$total = AffiliateTransactions::model()->count();
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		
		//echo '<pre>';print_r($pages);echo '</pre>';
		
		
		$posts = AffiliateTransactions::model()->findAll($criteria);
		$this->render('index',array(
			'posts' => $posts,
			'pages' => $pages,
			'LenderDetails_model' => $LenderDetails_model,
			'AffiliateUser_model' => $AffiliateUser_model,
			'Submission_model' => $Submission_model 
		));
	}
}
