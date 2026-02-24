<?php
/* Post(after ping) Process */
error_reporting(E_ALL);
ini_set('display_errors', 1);
class TestingController extends Controller{
	public function actionIndex(){
		$_POST = $_REQUEST;
		$process = 'inorganic';
		Yii::app()->session['ping_type'] = 'post';
		$ping_id = Yii::app()->request->getParam('ping_id');
		$promo_code = Yii::app()->request->getParam('promo_code');
		/** Check Ping Id Status. Actually Ping Exist or not */
		LeadsController::check_Ping_Id_Existence($ping_id);
		/** Add affiliate transaction in the affiliate transaction table */ 
		//LeadsController::actionAffiliateTransaction($_POST,$process);
		//$affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
		/** Validation check function check required field and other validation */
		LeadsController::actionValidationCheck($_POST,$process);
		/** Give duplicate lead error if lead is dublicate else insert new data */ 
		LeadsController::actionCheckDuplicate($_POST,$process);
	}
}
		
