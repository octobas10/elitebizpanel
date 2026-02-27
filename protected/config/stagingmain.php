<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once (dirname(__FILE__).'/params.php');

return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Elite Panel',
	'theme' => 'abound',
	'language' => 'en',
	// preloading 'log' component
	'preload' => array(
		'log'
	),
	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.modules.auto.controllers.cash_lender.*',
		'application.modules.auto.controllers.feed_lenders.*'
	),
	'modules' => array(
		// uncomment the following to enable the Gii tool
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '12345',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array(
				'127.0.0.1',
				'::1'
			)
		),
		'auto',
		'mortgage'
	),
	// application components
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'api/pingpost' => 'mortgage/api/pingpost',
				'api/index' => 'mortgage/api/index',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>'
			)
		),
		
		'db' => array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db'
		),
		// uncomment the following to use a MySQL database
		// http://staging.axiombpm.com/phpMyAdmin
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=staginga_elitepanel',
			'emulatePrepare' => true,
			'username' => 'staginga_elitepe',
			'password' => 'killme69',
			'charset' => 'utf8'
		),
		'dbMortgage' => array(
			'class' => 'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=staginga_elitemortgage', // mortgage tables; create DB or set dbname to existing
			'emulatePrepare' => true,
			'username' => 'staginga_elitepe',
			'password' => 'killme69',
			'charset' => 'utf8'
		),
		
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error'
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning,trace,info'
				),
				// uncomment the following to show log messages on web pages
				array(
					'class' => 'CWebLogRoute',
					'enabled' => YII_DEBUG,
					'levels' => 'error, warning, trace, log, vardump',
					'showInFireBug' => true
				)
			)
			
		)
	),
	
	// application-level parameters that can be accessed
	// using Yii::app()->params['frontEndAuto']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
		'backEnd' => 'elitepanel.com',
		'frontEndAuto' => 'eliteauto.com',
		'httphost' => 'http://staging.axiombpm.com/',
		'campaign' => 'auto'
	)
);
