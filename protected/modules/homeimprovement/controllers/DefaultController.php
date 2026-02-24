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
		$this->redirect(array('/homeimprovement/affiliates/login'));
	}
	public function actionRemoveme(){
		$response = array();
		if(!empty($_POST)){
			extract($_POST);
			if($email!=''){
				$user = Yii::app()->dbHomeimprovement->createCommand()
				->select('email')
				->from('homeimprovement_email_supression_list')
				->where('email=:email', array(':email'=>$email))
				->queryRow();
				if(empty($user)){
					Yii::app()->dbHomeimprovement->createCommand()->insert('homeimprovement_email_supression_list',array('email'=>$email));
					$response['success'][]='Email Added Successfully';
				}else{
					$response['fail'][]='Email Already Exist';
				}
			}
			if($phone!=''){
				$user = Yii::app()->dbHomeimprovement->createCommand()
				->select('phone')
				->from('homeimprovement_phone_supression_list')
				->where('phone=:phone', array(':phone'=>$phone))
				->queryRow();
				if(empty($user)){
					Yii::app()->dbHomeimprovement->createCommand()->insert('homeimprovement_phone_supression_list',array('phone'=>$phone));
					$response['success'][]='Phone Added Successfully';
				}else{
					$response['fail'][]='Phone Already Exist';
				}
			}
		}
		$this->render('removeme', array('response'=>$response));
	}
	public function actionPrivacy(){
		$this->layout='';
		$this->setPageTitle('Elite Auto Cash - Privacy Policy');
		$this->render('privacy');
	}
	public function actionAgreement(){
		$this->layout='';
		$this->setPageTitle('Elite Auto Cash Affiliate Agreement');
		$this->render('agreement');
	}
	public function actionWebsiteterm(){
		$this->layout='';
		$this->setPageTitle('Elite Auto Cash Website Term');
		$this->render('websiteterm');
	}
}
?>
