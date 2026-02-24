<?php
class Demo1Controller extends Controller {
    public static function doConnect($feed_lender_name, $post_string = array(), $parameter1, $parameter2, $parameter3, $posturl, $testurl,$vendor_id,$start_time='') {
    	$fields = array(
    		'http_referer' => 'http://elitebizpanel.com/index.php/edu/postprocess?',
            'firstName' => Yii::app()->request->getParam('first_name'),
            'lastName' => Yii::app()->request->getParam('last_name'),
            'ssn' => Yii::app()->request->getParam('ssn'),
            'dob' => Yii::app()->request->getParam('dob'),
            'address' => Yii::app()->request->getParam('address'),
            'city' => Yii::app()->request->getParam('city'),
            'state' => Yii::app()->request->getParam('state'),
            'zip' => Yii::app()->request->getParam('zip'),
            'email' => Yii::app()->request->getParam('email')
    	);
		$cm = new CommonMethods ();
		$post_string = http_build_query ( $fields );
		$header = "";
		$start_time = CommonToolsMethods::stopwatch ();
		/*$response = '<?xml version="1.0"?><PostResponse><Response>Accepted</Response><Confirmation>1437197110</Confirmation><url>https://www.google.co.in/</url></PostResponse>';*/
		$response = '<?xml version="1.0"?><PostResponse><Response>Accepted</Response></PostResponse>';
		//$response = $cm->curlposting ( $posturl, $post_string, $header, '60' );
		preg_match ( "/<Response>(.*)<\/Response>/", $response, $success );
		$time_end = CommonToolsMethods::stopwatch ();
		$curl_total_time = ($time_end - $start_time);
		if($success[1] == 'Accepted'){
			$status = '1';
		}else{
			$status = '0';
		}
		$cm->edusetFeedLenderAcceptRespond($feed_lender_name, $post_string, $response, $posturl, $curl_total_time, $status,$vendor_id,$start_time);
		return $status;
    }
}
?>
