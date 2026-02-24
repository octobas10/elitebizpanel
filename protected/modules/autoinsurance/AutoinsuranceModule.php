<?php

class autoinsuranceModule extends CWebModule {

    public function init() {
        $this->layout = '/layout/main';
        $this->setImport(array(
            'autoinsurance.models.*',
            'autoinsurance.components.*',
            'application.modules.autoinsurance.controllers.cash_lender.*',
            'autoinsurance.controllers.*'
        ));
        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'autoinsurance/default/error'
            ),
            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('/autoinsurance/affiliates/login')
            )
        ));
        Yii::app()->user->setStateKeyPrefix('_autoinsurance');
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $route = $controller->id . '/' . $action->id;
            Yii::app()->params['campaign'] = 'autoinsurance';
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
                if (Yii::app()->getModule('autoinsurance')->user->isGuest) {
                    Yii::app()->getModule('autoinsurance')->user->loginRequired();
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

}

//Yii::app()->dbAutoinsurance->close();
