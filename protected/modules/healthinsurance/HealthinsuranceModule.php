<?php
class healthinsuranceModule extends CWebModule {
    public function init() {
        $this->layout = '/layout/main';
        $this->setImport(array(
            'healthinsurance.models.*',
            'healthinsurance.components.*',
            'application.modules.healthinsurance.controllers.cash_lender.*',
            'healthinsurance.controllers.*'
        ));
        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'healthinsurance/default/error'
            ),
            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('/healthinsurance/affiliates/login')
            )
        ));
        Yii::app()->user->setStateKeyPrefix('_healthinsurance');
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $route = $controller->id . '/' . $action->id;
            Yii::app()->params['campaign'] = 'healthinsurance';
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
                if (Yii::app()->getModule('healthinsurance')->user->isGuest) {
                    Yii::app()->getModule('healthinsurance')->user->loginRequired();
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

}

Yii::app()->dbHealthinsurance->close();
