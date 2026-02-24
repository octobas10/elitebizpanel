<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
opcache_reset();
ini_set('display_errors', 1);
// change the following paths if necessary
require dirname(__FILE__) .'/vendor/autoload.php';
$redisClient = new Predis\Client();
$ip = $_SERVER['REMOTE_ADDR'];
$reqCount = $redisClient->incr($ip);
$ttl = $redisClient->ttl($ip);
if($ttl == '-1') {
	$redisClient->expire($ip,20);
}
if($reqCount < 60000){
	if($_SERVER['HTTP_HOST']=='192.168.4.164' || $_SERVER['HTTP_HOST']=='localhost'){
		//$yii=dirname(__FILE__).'/../yiiframework/yii.php';
		$yii=dirname(__FILE__).'/../yiiframework1.28/framework/yii.php';
		$config=dirname(__FILE__).'/protected/config/main.php';
	}else if($_SERVER['HTTP_HOST']=='staging.axiombpm.com'){
		$yii=dirname(__FILE__).'/../yiiframework/yii.php';
		$config=dirname(__FILE__).'/protected/config/stagingmain.php';
	}else{
		//$yii=dirname(__FILE__).'/../../yiiframework/yii.php';
		$yii=dirname(__FILE__).'/../../yiiframework1.17/yii.php';
		$config=dirname(__FILE__).'/protected/config/main.php';
	}

	// remove the following lines when in production mode
	defined('YII_DEBUG') or define('YII_DEBUG',true);
	// specify how many levels of call stack should be shown in each log message
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
	require_once($yii);
	Yii::createWebApplication($config)->run();
}else{
	$ttl = $redisClient->ttl($ip);
	echo json_encode(['status' => "You have used up all your quota, Try again after {$ttl} seconds "]);
	exit();
}
/*
$protected = dirname(__FILE__);
$yii       = "$protected/../yiiframework1.28/framework/yii.php";   // EDIT THIS TO TASTE
$config    = "$protected/protected/config/console.php";

define('YII_DEBUG', false);

require_once( $yii );
require_once( "$protected/protected/components/MyConsoleApplication.php" );

// Yii::createConsoleApplication($config)->run();    // DELETE THIS
$app = new MyConsoleApplication($config);            // ADD THIS
$app->run();*/