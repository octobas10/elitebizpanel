<?php
class BusinessloansModule extends CWebModule {
    public function init() {
        $this->layout = '/layout/main';
        $this->setImport(array(
            'businessloans.models.*',
            'businessloans.components.*',
            'application.modules.businessloans.controllers.cash_lender.*',
            'businessloans.controllers.*'
        ));
        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'businessloans/default/error'
            ),
            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('/businessloans/affiliates/login')
            )
        ));
        Yii::app()->user->setStateKeyPrefix('_businessloans');
    }
    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $route = $controller->id . '/' . $action->id;
            Yii::app()->params['campaign'] = 'businessloans';
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
            if (Yii::app()->user->isGuest && !in_array($route, $publicPages)) {
                if (Yii::app()->getModule('businessloans')->user->isGuest) {
                    Yii::app()->getModule('businessloans')->user->loginRequired();
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
//Yii::app()->dbBusinessLoans->close();