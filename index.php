<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
if (function_exists('opcache_reset')) {
	opcache_reset();
}
ini_set('display_errors', 1);
// change the following paths if necessary
require dirname(__FILE__) . '/vendor/autoload.php';

// Rate limiting via Redis (optional on localhost when Redis is not installed)
$rateLimitOk = true;
$redisHost = getenv('REDIS_HOST') ?: '127.0.0.1';
$redisPort = (int) (getenv('REDIS_PORT') ?: 6379);
try {
	$redisClient = new Predis\Client(['host' => $redisHost, 'port' => $redisPort]);
	$redisClient->connect();
	$ip = $_SERVER['REMOTE_ADDR'];
	$reqCount = $redisClient->incr($ip);
	$ttl = $redisClient->ttl($ip);
	if ($ttl == '-1') {
		$redisClient->expire($ip, 20);
	}
	$rateLimitOk = $reqCount < 60000;
} catch (Throwable $e) {
	// Redis unavailable (e.g. XAMPP without Redis): skip rate limiting so app still runs
	$rateLimitOk = true;
}

if ($rateLimitOk) {
	$config = dirname(__FILE__) . '/protected/config/main.php';
	if (getenv('YII_PATH')) {
		$yii = getenv('YII_PATH');
	} elseif ($_SERVER['HTTP_HOST'] === 'staging.axiombpm.com') {
		$yii = dirname(__FILE__) . '/../yiiframework/yii.php';
		$config = dirname(__FILE__) . '/protected/config/stagingmain.php';
	} else {
		$yiiVendor = dirname(__FILE__) . '/vendor/yiisoft/yii/framework/yii.php';
		$yii = file_exists($yiiVendor) ? $yiiVendor : dirname(__FILE__) . '/../yiiframework1.28/framework/yii.php';
	}

	defined('YII_DEBUG') or define('YII_DEBUG', true);
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
	require_once $yii;
	Yii::createWebApplication($config)->run();
} else {
	$ttl = $redisClient->ttl($ip);
	echo json_encode(['status' => "You have used up all your quota, Try again after {$ttl} seconds "]);
	exit;
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