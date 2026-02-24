<?php
class EduModule extends CWebModule{
	/*
	** author : vatsal gadhia
	** modification : getDbConnection() removed from comments
	** modification date : 25-07-2016
	** latest modification : getDbConnection() placed in comments
	** latest modification date : 01-08-2016
	*/
	public $db;
	/*public function getDbConnection(){
		return Yii::app()->moduleDb;
	}*/
	public function init(){
		$this->layout = '/layout/main';
		$this->setImport(array(
			'edu.models.*',
			'edu.components.*',
			'edu.controllers.*'
		));
		$this->setComponents(array(
			'errorHandler' => array(
				'errorAction' => 'edu/default/error'
			),
			'user' => array(
				'class' => 'CWebUser',
				'loginUrl' => Yii::app()->createUrl('/edu/affiliates/login')
			)
		));
		Yii::app()->user->setStateKeyPrefix('_edu');
                   Yii::app()->theme = 'neon';
      //  Yii::app()->params['httphost']='http://www.elitebizpanel.com';
        Yii::app()->params['frontEndAuto']='https://www.elitebizpanel.com';
        Yii::app()->params['campaign']='edu';
	}
	public function beforeControllerAction($controller, $action){
		if(parent::beforeControllerAction($controller,$action)){
			$route = $controller->id.'/'.$action->id;
			$publicPages = array(
				'affiliates/login',
				'affiliates/affiliateRegister',
				'affiliates/landingpage',
                'affiliates/forgotPassword',
				'affiliates/searchcampus',
				'affiliates/checkzipcode',
				'affiliates/phoneverify',
				'default/error',
				'default/removeme',
				'default/privacy',
				'default/websiteagreement',
				'default/affiliateagreement',
				'lenders/login',
				'lenders/forgotPassword',
				'indexProcess/index',
				'postprocess/index',
				'pingprocess/index',
				'feedprocess/index',
				'pingpostprocess/index',
				'postTestProcess/index',
				'leads/postaccept',
				'leads/successAffiliate',
				'leads/nolenderfound',
				'api/index',
				'api/pingpost',
				'affiliates/pixelCodeDisplay',
				'affiliates/programofinterestusingcampuscode',
				'affiliates/checkgeofootprint',
				'affiliates/getcampusporgramfromzipcode',
				'affiliates/getaffstatus',
				'feedpostProcess/index',
				'testing/index',
				'feedlenders/login',
				'feedlenders/forgotPassword',
			);
			//echo '<pre>';print_r($route);print_r($publicPages);exit;
			if(Yii::app()->user->isGuest&&!in_array($route,$publicPages)){
				if(Yii::app()->getModule('edu')->user->isGuest){
					Yii::app()->getModule('edu')->user->loginRequired();
				}
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
}
