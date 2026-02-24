<?php
class debtModule extends CWebModule {
    public function init() {
        $this->layout = '/layout/main';
        $this->setImport(array(
            'debt.models.*',
            'debt.components.*',
            'application.modules.debt.controllers.cash_lender.*',
            'debt.controllers.*'
        ));
        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'debt/default/error'
            ),
            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('/debt/affiliates/login')
            )
        ));
        Yii::app()->user->setStateKeyPrefix('_debt');
    }
    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $route = $controller->id . '/' . $action->id;
            Yii::app()->params['campaign'] = 'debt';
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
                if (Yii::app()->getModule('debt')->user->isGuest) {
                    Yii::app()->getModule('debt')->user->loginRequired();
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
//Yii::app()->dbDebt->close();