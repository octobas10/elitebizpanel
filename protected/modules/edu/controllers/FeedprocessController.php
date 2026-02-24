<?php
/* Direct Post */
error_reporting(E_ALL);
ini_set('display_errors', 1);
class FeedprocessController extends Controller{	
	public function actionIndex(){
		$_POST = $_REQUEST;
		$cm = new CommonMethods();
		/** start the clock to mesure ping post time */
		$start_time = CommonToolsMethods::stopwatch();
		FeedpostProcessController::pingFeedLenders('lead');
		$time_end = CommonToolsMethods::stopwatch();
		$post_time = ($time_end - $start_time);
		$cm->setNoFeedLenderFoundRespond($post_time);
		exit;
	}
}
