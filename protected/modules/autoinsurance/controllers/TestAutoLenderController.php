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
			
			$request = 'lead_mode=' . $_POST['Submissions']['lead_mode'] . '&sub_id=' . $_POST['Submissions']['sub_id'] . '&lender_id=' . $_POST['LenderDetails']['name'] . '&promo_code=' . $_POST['AffiliateUser']['id'] . '&time_limit=300&first_name=' . $_POST['first_name'] . '&last_name=' . $_POST['last_name'] . '&email=' . $_POST['email'] . '&gender=' . $_POST['gender'] . '&address=' . $_POST['address'] . '&city=' . $_POST['Submissions']['city'] . '&state=' . $_POST['Submissions']['state'] . '&zip=' . $_POST['zip'] . '&is_rented=' . $_POST['is_rented'] . '&stay_in_year=' . $_POST['Submissions']['stay_in_year'] . '&stay_in_month=' . $_POST['Submissions']['stay_in_month'] . '&home_pay=' . $_POST['Submissions']['home_pay'] . '&phone=' . $_POST['phone'] . '&mobile=' . $_POST['mobile'] . '&dob=' . $dob . '&job_title=' . $_POST['job_title'] . '&emp_status=permanent&employer=' . $_POST['employer'] . '&supervisor_name=Daniel&monthly_income=' . $_POST['monthly_income'] . '&mainIncome=Job&employment_in_month=' . $_POST['Submissions']['employment_in_month'] . '&employment_in_year=' . $_POST['Submissions']['employment_in_year'] . '&work_phone=7946581361&income_type=' . $_POST['income_type'] . '&ssn=' . $_POST['ssn'] . '&car_year=' . $_POST['Submissions']['car_year'] . '&car_make=' . $_POST['Submissions']['car_make'] . '&car_model=' . $_POST['Submissions']['model'] . '&car_trim=' . $_POST['Submissions']['car_trim'] . '&ipaddress=' . $_SERVER['REMOTE_ADDR'] . '&loan_amount=' . $_POST['loan_amount'] . '&bankruptcy=0&cosigner=1&agree_credit_check=1&url=' . $_SERVER['SERVER_NAME'] . '&user_agent=' . $_SERVER['HTTP_USER_AGENT'] . '&sub_date=' . date('Y-m-d H:i:s') . '&pingpost=' . $_POST['pingpost'] . '';
			
			$url = Yii::app()->params['httphost'] . Yii::app()->params['backEnd'] . '/index.php/' . Yii::app()->params['campaign'] . '/postTestProcess';
			
			$cm = new CommonMethods();
			//echo $request;exit;
			$response = $cm->curl($url,$request);
			//echo $request.'<br><br>'.$url.'<br><br>'.$response;
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
