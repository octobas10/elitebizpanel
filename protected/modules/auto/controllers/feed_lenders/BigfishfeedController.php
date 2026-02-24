<?php
class BigfishfeedController extends Controller {
	public static function doConnect($feed_lender_name, $post_string = array(), $parameter1, $parameter2, $parameter3, $posturl, $testurl) {
		$fields = array (
				'clientid' => 117,
				'campaigncode' => 5,
				'firstname' =>$post_string ['first_name'] ,
				'lastname' =>$post_string ['last_name'] ,
				'email' =>$post_string ['email'] ,
				'address' =>$post_string ['address'] ,
				'city' =>$post_string ['city'] ,
				'state' =>$post_string ['state'] ,
				'zip' =>$post_string ['zip'] ,
				'homephone' => isset ( $post_string ['phone'] ) ? $post_string ['phone'] : $post_string ['mobile'],
				'mobilephone' =>isset ( $post_string ['mobile'] ) ? $post_string ['mobile'] : '',
				'dateofbirth' =>$post_string ['dob'] ,
				'gender' =>$post_string ['gender'] ,
				'language' => 'english',
				'comments' => 'ewdfrwe',
				'ip' => $_SERVER ['REMOTE_ADDR'],
				'url' => 'www.elitepanel.com' 
		);
		$cm = new CommonMethods ();
		$post_string = http_build_query ( $fields );
		$header = "";
		$start_time = CommonToolsMethods::stopwatch ();
		$response = '<?xml version="1.0"?><PostResponse><Response>Accepted</Response><Confirmation>1437197110</Confirmation><url>https://www.google.co.in/</url></PostResponse>';
		//$response = $cm->curlposting ( $posturl, $post_string, $header, '60' );
		preg_match ( "/<Response>(.*)<\/Response>/", $response, $success );
		$time_end = CommonToolsMethods::stopwatch ();
		$curl_total_time = ($time_end - $start_time);
		if($success[1] == 'Accepted'){
			$status = '1';
		}else{
			$status = '0';
		}
		$cm->setFeedLenderAcceptRespond ( $feed_lender_name, $post_string, $response, $posturl, $curl_total_time, $status );
		return $status;
	}
}
?>
