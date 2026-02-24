<?php
class mortgageModule extends CWebModule {
    public function init() {
        $this->layout = '/layout/main';
        $this->setImport(array(
            'mortgage.models.*',
            'mortgage.components.*',
            'application.modules.mortgage.controllers.cash_lender.*',
            'mortgage.controllers.*'
        ));
        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'mortgage/default/error'
            ),
            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('/mortgage/affiliates/login')
            )
        ));
        Yii::app()->user->setStateKeyPrefix('_mortgage');
    }
    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $route = $controller->id . '/' . $action->id;
            Yii::app()->params['campaign'] = 'mortgage';
            Yii::app()->params['mortgage_lead_types'] = ['1' =>'NewHome','2' =>"Refinance",'3' =>'Home Equity','4' =>'Reverse Mortgage'];
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
                if (Yii::app()->getModule('mortgage')->user->isGuest) {
                    Yii::app()->getModule('mortgage')->user->loginRequired();
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
//Yii::app()->dbMortgage->close();