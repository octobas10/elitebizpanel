<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Elite Biz Panel',
	'theme'=>'abound',
	'preload'=>array('log'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.auto.controllers.cash_lender.*',
	),

	'defaultController'=>'post',

	 // application components
	 'components'=>array(
		'user'=>array(
		 // enable cookie-based authentication
		 'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
		  'urlFormat'=>'path',
		  'showScriptName' => true,
		  'rules'=>array(
			'<controller:\w+>/<id:\d+>'=>'<controller>/view',
			'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
			'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
		  ),
		),
		'db'=>array(
			  'class'=>'CDbConnection',
					  'connectionString' => 'mysql:host=127.0.0.1;dbname=eliteautocash',
					  'emulatePrepare' => true,
					  'username' => 'root',
					  'password' => '12345678',
					  'charset' => 'utf8',
					  'enableProfiling'=>true,
					  'enableParamLogging' => true,
			  //'close' => true,
		),
		'dbAutoinsurance' => array(
			  'class' => 'CDbConnection',
			  'connectionString' => 'mysql:host=127.0.0.1;dbname=eliteautoinsurance',
			  'emulatePrepare' => true,
			  'username' => 'root',
			  'password' => '12345678',
			  'charset' => 'utf8',
			  'enableProfiling' => true,
			  'enableParamLogging' => true
		  ),
		  'dbMortgage' => array(
			  'class' => 'CDbConnection',
			  'connectionString' => 'mysql:host=127.0.0.1;dbname=elitemortgage',
			  'emulatePrepare' => true,
			  'username' => 'root',
			  'password' => '12345678',
			  'charset' => 'utf8',
			  'enableProfiling' => true,
			  'enableParamLogging' => true
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
		'errorHandler'=>array(
		 // use 'site/error' action to display errors
		 'errorAction'=>'site/error',
		),
		'log'=>array(
		 'class'=>'CLogRouter',
		 'routes'=>array(
		  array(
		   'class'=>'CFileLogRoute',
		   'levels'=>'error, warning,trace,info',
		  ),
		  // uncomment the following to show log messages on web pages
		  array(
		  'class'=>'CWebLogRoute',
		  'enabled' => YII_DEBUG,
		  'levels'=>'error, warning, trace, log, vardump',
		  'showInFireBug'=>true,
		  ),
		  
		 ),
		),
	   ),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);