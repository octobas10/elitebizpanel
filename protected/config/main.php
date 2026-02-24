<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once( dirname(__FILE__) . '/params.php');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'EliteBizPanel',
    'theme' => 'abound',
    'language' => 'en',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.auto.controllers.cash_lender.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '12345',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'edu' => array(
            'db' => array(
                'class' => 'CDbConnection',
                'connectionString' => 'mysql:host=127.0.0.1;dbname=eliteedu',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '12345678',
                'charset' => 'utf8',
                'enableProfiling' => true,
                'enableParamLogging' => true,
            ),
        ),
        'auto',
        'autoinsurance',
        'mortgage',
        'debt',
        'healthinsurance',
        'homeimprovement',
        'businessloans'
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=eliteautocash',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '12345678',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'dbAutoinsurance' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=eliteautoinsurance',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '12345678',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'dbMortgage' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=elitemortgage',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '12345678',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'dbDebt' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=elitedebt',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '12345678',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'dbHealthinsurance' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=elitehealthinsurance',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '12345678',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true
        ),
        'dbHomeimprovement' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=elitehomeimprovement',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '12345678',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true
        ),
        'dbBusinessLoans' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=elitebusinessloans',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '12345678',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning,trace,info',
                ),
                // uncomment the following to show log messages on web pages
                array(
                    'class' => 'CWebLogRoute',
                    'enabled' => YII_DEBUG,
                    'levels' => 'error, warning, trace, log, vardump',
                    'showInFireBug' => true,
                ),

            ),
        ),
    ),

    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'backEnd' => 'https://www.elitebizpanel.com',
        'frontEndAuto' => 'https://www.eliteautocash.com',
        'httphost' => '',
        'campaign' => 'auto',
        'auto_ping_cap' => '200',
        'autoinsurance_ping_cap' => '200',
        'edu_ping_cap' => '200',
        'mortgage_ping_cap' => '200',
        'healthinsurance_ping_cap' => '200',
        'homeimprovement_ping_cap' => '200',
        'debt_ping_cap' => '200',
        'businessloans_ping_cap' => '200',
    ),
    //'params'=>require(dirname(__FILE__).'/params.php'),
);
