<?php
class DefaultController extends Controller{
	public $layout = '/layouts/column1';
	public function actionIndex(){
		if(!Yii::app()->user->isGuest){
			$this->redirect('../dashboard/index');
		}else{
			$this->redirect('affiliates/login');
		}
	}
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(array('/edu/affiliates/login'));
	}
		/**
		 ** Author : Vatsal Gadhia
		 ** Modification : db component replaced by db_edu so that data can be access from new db of edu module
		 ** Modification Date : 01-08-2016
		**/
	public function actionRemoveme(){	
		$o_affiliate_user = new AffiliateUser();
		$o_affiliate_user->unsetAttributes(); // clear any default values
		$response = array();
		if(!empty($_POST)){
			extract($_POST);
			if($email!=''){
				$o_affiliate_user->actionRemovemeEmail($email);
			}
			if($phone!=''){
				$o_affiliate_user->actionRemovemePhone($phone);
			}
		}
		$this->render('removeme', array('response'=>$response));
	}
	/**
	 * @author : vatsal gadhia
	 * @description : privacy file
	 * @since : 19-09-2016
	**/
	public function actionPrivacy(){
		$this->layout='';
		$this->setPageTitle('Higher Learning App - Privacy Policy');
		$this->render('privacy');
	}
	/**
	 * @author : vatsal gadhia
	 * @description : website agreement file
	 * @since : 19-10-2016
	**/
	public function actionWebsiteAgreement(){
		$this->layout='';
		$this->setPageTitle('Higher Learning Marketers Affiliate Agreement');
		$this->render('websiteagreement');
	}
	/**
	 * @author : vatsal gadhia
	 * @description : affiliates agreement file
	 * @since : 19-10-2016
	**/
	public function actionAffiliateAgreement(){
		$this->layout='';
		$this->setPageTitle('Higher Learning Marketers Affiliate Agreement');
		$this->render('agreement');
	}
}
?>
