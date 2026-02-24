<?php
class AutoModule extends CWebModule{
	public function init(){
		$this->layout = '/layout/main';
		$this->setImport(array(
			'auto.models.*',
			'auto.components.*',
			'auto.controllers.*'
		));
		$this->setComponents(array(
			'errorHandler' => array(
				'errorAction' => 'auto/default/error'
			),
			'user' => array(
				'class' => 'CWebUser',
				'loginUrl' => Yii::app()->createUrl('/auto/affiliates/login')
			)
		));
		Yii::app()->user->setStateKeyPrefix('_auto');
	}
	public function beforeControllerAction($controller, $action){
		if(parent::beforeControllerAction($controller,$action)){
			$route = $controller->id.'/'.$action->id;
			$publicPages = array(
				'affiliates/login',
				'affiliates/affiliateRegister',
				'default/error',
				'default/removeme',
				'lenders/login',
				'indexProcess/index',
				'postprocess/index',
				'pingprocess/index',
				'pingpostprocess/index',
				'postTestProcess/index',
				'leads/postaccept',
				'leads/successAffiliate',
				'leads/nolenderfound',
				'api/index',
				'api/pingpost',
				'affiliates/pixelCodeDisplay',
				'affiliates/getaffstatus',
				'feedpostProcess/index',
				'testing/index',
				'default/privacy',
				'default/agreement',
				'default/websiteterm',
			);
			if(Yii::app()->user->isGuest&&!in_array($route,$publicPages)){
				if(Yii::app()->getModule('auto')->user->isGuest){
					Yii::app()->getModule('auto')->user->loginRequired();
				}
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
}
//Yii::app()->db->close();