<?php
class homeimprovementModule extends CWebModule {
    public function init() {
        $this->layout = '/layout/main';
        $this->setImport(array(
            'homeimprovement.models.*',
            'homeimprovement.components.*',
            'application.modules.homeimprovement.controllers.cash_lender.*',
            'homeimprovement.controllers.*'
        ));
        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'homeimprovement/default/error'
            ),
            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('/homeimprovement/affiliates/login')
            )
        ));
        Yii::app()->user->setStateKeyPrefix('_homeimprovement');
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $route = $controller->id . '/' . $action->id;
            Yii::app()->params['campaign'] = 'homeimprovement';
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
                'api/homeprojects',
                'api/projectproviders',
                'api/tasksbyprojecttype',
                'affiliates/pixelCodeDisplay',
                'affiliates/getaffstatus',
                'feedpostProcess/index',
                'testing/index',
                'default/privacy',
                'default/agreement',
                'default/websiteterm',
            );
            if (Yii::app()->user->isGuest && !in_array($route, $publicPages)) {
                if (Yii::app()->getModule('homeimprovement')->user->isGuest) {
                    Yii::app()->getModule('homeimprovement')->user->loginRequired();
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

}

//Yii::app()->dbHomeimprovement->close();
