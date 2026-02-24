<?php
class DummyLender2Controller extends Controller
{
	public function __construct() {}
	/**
	 * Create Ping Request for Lender 
	 */
	public static function returnPingData($p1 = false, $p2 = false, $p3 = false)
	{
		$pingData = array();
		$fields = array(
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
		$pingData['ping_request'] = http_build_query($fields);
		return $pingData;
	}
	/**
	 * Preg Match the Lender Ping Full XML/JSON Response.
	 */
	public static function returnPingResponse($ping_response)
	{
		$result = json_decode($ping_response);
		if($result->result=='success'){
			$ping_response_info['ping_status'] = '1';
			$ping_response_info['confirmation_id'] = $result->ping_id;
			if ($result->brands) {
				$i=0;
				$brands = (array) $result->brands;
				$ping_price = max(array_column($brands, "payout"));
				$ping_response_info['ping_price'] = trim($ping_price);
				foreach ($result->brands as $brands) {
					$ping_response_info['brands'][$i]['brand_id'] = $brands->lp_brand_id;
					$ping_response_info['brands'][$i]['brand_name'] = $brands->name;
					$ping_response_info['brands'][$i]['bid_price'] = $brands->payout;
					$i++;
				}
			} else {
				$ping_price = 0;
				$ping_response_info['ping_price'] = $ping_price;
				$ping_response_info['ping_status'] = '0';
				$ping_response_info['confirmation_id'] = '';
			}
		}
		//preg_match("/<isValidPost>(.*)<\/isValidPost>/msui", $ping_response, $result);
		/*if (trim($result[1]) == 'true' || trim($result[0]) == 'true') {
			preg_match("/<Price>(.*)<\/Price>/msui", $ping_response, $price);
			preg_match("/<id>(.*)<\/id>/msui", $ping_response, $confirmation_id);
			$ping_price = $price[1];
			$confirmation_id = $confirmation_id[1];
			$ping_response_info['ping_price'] = trim($ping_price);
			$ping_response_info['ping_status'] = '1';
			$ping_response_info['confirmation_id'] = $confirmation_id;
		} else {
			$ping_price = 0;
			$ping_response_info['ping_price'] = $ping_price;
			$ping_response_info['ping_status'] = '0';
			$ping_response_info['confirmation_id'] = '';
		}*/
		return $ping_response_info;
	}
	/**
	 * Send Post Data to Lender 
	 */
	public static function sendPostData($parameter1, $parameter2, $parameter3, $ping_response, $post_url)
	{
		preg_match("/<id>(.*)<\/id>/", $ping_response, $confirmation_id);
		$fields = array(
			'http_referer' => 'www.eliteauto.com',
			'firstName' => Yii::app()->request->getParam('first_name'),
			'lastName' => Yii::app()->request->getParam('last_name'),
			'ssn' => Yii::app()->request->getParam('ssn'),
			'dob' => Yii::app()->request->getParam('dob'),
			'address' => Yii::app()->request->getParam('address'),
			'city' => Yii::app()->request->getParam('city'),
			'state' => Yii::app()->request->getParam('state'),
			'zip' => Yii::app()->request->getParam('zip'),
			'email' => Yii::app()->request->getParam('email'),
			'title' => Yii::app()->request->getParam('job_title'),
			'employer_name' => Yii::app()->request->getParam('employer'),
			'empmonth' => Yii::app()->request->getParam('employment_in_month'),
			'empyear' => Yii::app()->request->getParam('employment_in_month'),
			'empphone' => Yii::app()->request->getParam('work_phone'),
			'mainincome' => Yii::app()->request->getParam('monthly_income')
		);
		if ($confirmation_id != '') {
			$fields['confirmation'] = $confirmation_id;
		}
		$post_request = http_build_query($fields);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$post_full_response = $cm->curl($post_url, $post_request);
		$time_end = CommonToolsMethods::stopwatch();

		preg_match("/<isValidPost>(.*)<\/isValidPost>/", $post_full_response, $success);

		/** Set Post Rejection, For Testing Purpose Only.*/
		//$success[1] = 'false';

		if ($success[1] == 'true') {
			$post_status = '1';
			preg_match("/<redirectURL>(.*)<\/redirectURL>/", $post_full_response, $redirect);
			$redirect_url = isset($redirect[1]) ? $redirect[1] : '';
			preg_match("/<Price>(.*)<\/Price>/msui", $post_full_response, $price);
			$post_price = isset($price[1]) ? $price[1] : '';
		} else {
			$post_status = '0';
			$post_price = '';
			$redirect_url = '';
		}

		$post_time = ($time_end - $start_time);

		$post_response['post_request'] = $post_request;
		$post_response['post_response'] = $post_full_response;
		$post_response['post_status'] = $post_status;
		$post_response['post_price'] = $post_price;
		$post_response['redirect_url'] = $redirect_url;
		$post_response['post_time'] = $post_time;
		return $post_response;
	}
}
