<?php
class CommonMethods
{
	/**
	 * This show errors to publisher or affiliate response rejected like:Duplicate
	 */
	public function setRespondError($getError, $errortype = 'submission', $process = 'inorganic')
	{
		$start_time = CommonToolsMethods::stopwatch();
		$post_status = '-1';
		$full_response = '<?xml version="1.0"?>';
		if (Yii::app()->session['ping_type'] == 'ping') {
			$full_response .= '<PingResponse>';
		} else {
			$full_response .= '<PostResponse>';
		}
		if ($errortype == 'submission') {
			$errors = '';
			$full_response .= '<Response>REJECTED</Response>';
			foreach ($getError as $key => $value) {
				$errors .= '<Error>' . $value[0] . '</Error>';
			}
			$full_response .= '<Errors>';
			$full_response .= $errors;
			$full_response .= '</Errors>';
			$full_response;
		} else if ($errortype == 'unknown') {
			$post_status = '2';
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Rejected due to unknown reason</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'programofinterestnonavailable') {
			$post_status = '2';
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Program of Interest is not available for the campus</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'zipcodenoninlist') {
			$post_status = '2';
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Postal Code Not In list</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'cap_reached') {
			$post_status = '2';
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Reached the monthly campaign cap for campus</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'inactive_campaign') {
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Inactive campaign</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'duplicatebybuyer') {
			$post_status = '2';
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Duplicate lead On Buyer</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'program_restriction_failed') {
			$post_status = '2';
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Edu Campaign Campus record not found</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'grade_quality_failed') {
			$post_status = '2';
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Grade Quality is below threshold which is labeled as either C-, D+, D or D-</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'lead_filtered') {
			$post_status = '2';
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>The lead has been filtered</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'duplicate') {
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Duplicate lead</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'affiliate_noavailable') {
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>No Affiliate Available(Invalid Promo Code)</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'TestMode') {
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Affiliate is in TestMode</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'iprangelimitcrossed') {
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>IP Range Limit Crossed</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'nopingidfound') {
			$full_response .= '<Response>ERROR</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>No Ping Id Found</Reason>';
			$full_response .= '</Errors>';
		} else if ($errortype == 'inactivecampaigncode') {
			$full_response .= '<Response>ERROR</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Inactive Campaign Code</Reason>';
			$full_response .= '</Errors>';
		}
		if (Yii::app()->session['ping_type'] == 'ping') {
			$full_response .= '</PingResponse>';
		} else {
			$full_response .= '</PostResponse>';
		}
		$time = $this->time_check($start_time);
		if ($errortype != 'affiliate_noavailable') {
			if (Yii::app()->session['ping_type'] == 'ping') {
				AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
					"ping_status" => '-1',
					"ping_response" => $full_response,
					"ping_time" => $time,
				));
			} else {
				AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
					"post_status" => $post_status,
					"post_response" => $full_response,
					"post_time" => $time,
				));
			}
		}
		preg_match("/<Response>(.*)<\/Response>/msui", $full_response, $response);
		if ($process == 'organic') {
			if ($response[0] == 'REJECTED' || $response[1] == 'REJECTED') {
				Yii::app()->getController()->redirect(Yii::app()->params['httphost'] . Yii::app()->params['frontEndAuto'] . '/index.php/coreg');
			}
		} else {
			header('Content-Type: text/xml');
			echo $full_response;
			exit;
		}
		Yii::app()->end();
	}
	public function NoPingFound($ping_id)
	{
		$post_response = '<?xml version="1.0"?>';
		$post_response .= '<PostResponse>';
		$post_response .= '<Response>REJECTED</Response>';
		if ($ping_id) $post_response .= '<Reason>No Ping Found Associate with this Ping Id:' . $ping_id . '</Reason>';
		else $post_response .= '<Reason>You Must Specify ping_id in Post Data</Reason>';
		$post_response .= '</PostResponse>';
		header('Content-Type: text/xml');
		echo $post_response;
		exit;
	}
	public function AlreadyPostSent($ping_id)
	{
		$post_response = '<?xml version="1.0"?>';
		$post_response .= '<PostResponse>';
		$post_response .= '<Response>REJECTED</Response>';
		$post_response .= '<Reason>Already Post Sent Associalted with this Ping Id:' . $ping_id . '</Reason>';
		$post_response .= '</PostResponse>';
		header('Content-Type: text/xml');
		echo $post_response;
		exit;
	}
	public function setRespondErrorExceedTime($affiliate_name, $process = 'organic')
	{
		$start_time = CommonToolsMethods::stopwatch();
		$full_response = '<?xml version="1.0"?>';
		$full_response .= '<PostResponse>';
		$full_response .= '<Response>REJECTED</Response>';
		$full_response .= '<Errors><Reason>Today`s Cap is Full</Reason></Errors>';
		$full_response .= '</PostResponse>';
		$time = $this->time_check($start_time);
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			"post_status" => '-1',
			"post_response" => $full_response,
			"post_time" => $time,
			"redirect" => 'no'
		));
		if ($process == 'inorganic') {
			header('Content-Type: text/xml');
			echo $full_response;
			exit;
		} else {
			Yii::app()->getController()->redirect(Yii::app()->params['httphost'] . Yii::app()->params['frontEndAuto'] . '/index.php/coreg');
		}
	}
	public function setRespondErrorTimeInterval($lender, $interval)
	{
		$start_time = CommonToolsMethods::stopwatch();
		$full_response = "";
		$full_response .= '<?xml version="1.0"?>';
		$full_response .= '<PostResponse>';
		$full_response .= '<Response>REJECTED</Response>';
		$full_response .= '<Errors><Reason>Time interval for Lender ' . $lender . ' is ' . $interval . ' ....</Reason></Errors>';
		$full_response .= '</PostResponse>';
		$time = $this->time_check($start_time);
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			"post_status" => '-1',
			"post_response" => $full_response,
			"post_time" => $time,
			"redirect" => 'no'
		));
	}
	/**
	 * Affiliate Ping Response and Update Affiliate Transaction Table
	 */
	/* public function setAffiliatePingResponse($ping_status,$ping_price,$vendor_ping_price,$ping_time,$applied_margin = '0'){
		if($ping_status == 1){
			$ping_response = '<?xml version="1.0"?>';
			$ping_response .= '<PingResponse>';
			$ping_response .= '<Response>ACCEPTED</Response>';
			$ping_response .= '<Ping_Id>' . Yii::app()->session['affiliate_trans_id'] . '</Ping_Id>';
			$ping_response .= '<Price>' . $vendor_ping_price . '</Price>';
			$ping_response .= '</PingResponse>';
		}else{
			$ping_response = '<?xml version="1.0"?>';
			$ping_response .= '<PingResponse>';
			$ping_response .= '<Response>REJECTED</Response>';
			$ping_response .= '<Reason>No Coverage</Reason>';
			$ping_response .= '</PingResponse>';
		}
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'],array(
			"ping_response" => $ping_response,
			"ping_status" => $ping_status,
			"ping_price" => $ping_price,
			"vendor_ping_price" => $vendor_ping_price,
			"ping_time" => $ping_time 
		));
		header('Content-Type: text/xml');echo $ping_response;exit;
	} */
	public function setAffiliatePingResponse($ping_status, $ping_price, $vendor_ping_price, $ping_time, $applied_margin = '0')
	{
		if ($ping_status == 1) {
			$affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
			$brand_details = LenderBrandDetails::model()->findAllByAttributes(['affiliate_transactions_id' => $affiliate_trans_id]);
			$ping_response = '<?xml version="1.0"?>';
			$ping_response .= '<PingResponse>';
			$ping_response .= '<Response>ACCEPTED</Response>';
			$ping_response .= '<Ping_Id>' . $affiliate_trans_id . '</Ping_Id>';
			$ping_response .= '<Price>' . $vendor_ping_price . '</Price>';
			if ($brand_details) {
				$ping_response .= '<Brands>';
				foreach ($brand_details as $brands) {
					$bid_price = $brands['bid_price'] - (($brands['bid_price'] * $applied_margin) / 100);
					$ping_response .= '<brand>';
					$ping_response .= '<bid_id>' . $brands['id'] . '</bid_id>';
					$ping_response .= '<brand_seller_id>' . $brands['lender_id'] . '</brand_seller_id>';
					$ping_response .= '<brand_id>' . $brands['brand_id'] . '</brand_id>';
					$ping_response .= '<brand_name>' . $brands['brand_name'] . '</brand_name>';
					$ping_response .= '<bid_price>' . $bid_price . '</bid_price>';
					$ping_response .= '</brand>';
				}
				$ping_response .= '</Brands>';
			}
			$ping_response .= '</PingResponse>';
		} else {
			$ping_response = '<?xml version="1.0"?>';
			$ping_response .= '<PingResponse>';
			$ping_response .= '<Response>REJECTED</Response>';
			$ping_response .= '<Reason>No Coverage</Reason>';
			$ping_response .= '</PingResponse>';
		}
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			"ping_response" => $ping_response,
			"ping_status" => $ping_status,
			"ping_price" => $ping_price,
			"vendor_ping_price" => $vendor_ping_price,
			"ping_time" => $ping_time
		));
		header('Content-Type: text/xml');
		echo $ping_response;
		exit;
	}
	/* Added on 07-01-2025 */
	/**
	 * Add Lender, Vendor Price and Redirect URL in Submission Table after Accept
	 */
	public static function saveBrandBuyers($brand = [], $lender_id = 0)
	{
		$log = new LenderBrandDetails();
		$log->customer_id = Yii::app()->session['customer_id'];
		$log->lender_id = $lender_id;
		$log->affiliate_transactions_id = Yii::app()->session['affiliate_trans_id'];
		$log->promo_code = Yii::app()->request->getParam('promo_code');
		$log->brand_id = $brand['brand_id'];
		$log->brand_name = $brand['brand_name'];
		$log->bid_price = $brand['bid_price'];
		$log->date = date('Y-m-d H:i:s');
		$log->insert();
		$id = $log->id;
		return $id;
	}
	/** 
	 * 1. Create affiliate xml accept response
	 * 2. Update affiliate tranaction table with post_status, post_response, post_price, vendor_post_price and post_time
	 * 3. For organic process, run the redirect process, and for inorganic process display that affiliate xml accept response
	 */
	// NO LONGER IN USE.....
	public function setAcceptRespondAuto($lender_lead_price, $vendor_lead_price, $post_time, $process = 'organic', $testcash = false)
	{
		$affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
		//$exit_url = LenderTransactions::model()->exit_url($affiliate_trans_id);
		$res_url = '';
		if ($process == 'inorganic') {
			$affiliate_url = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'] . '/leads/postaccept?affiliate_trans_id=' . $affiliate_trans_id);
			$res_url = '<URL>' . $affiliate_url . '</URL>';
		} else {
			$affiliate_url = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'] . '/leads/successAffiliate?affiliate_trans_id=' . $affiliate_trans_id);
		}
		// ===================== CREATE XML RESPONSE FOR OUR AFFILIATES ==========================//
		$response = '<?xml version="1.0"?>';
		$response .= '<PostResponse>';
		$response .= '<Response>ACCEPTED</Response>';
		$response .= $res_url;
		$response .= '</PostResponse>';
		// ======================================= END ============================================//
		/**
		 * Update response, full_reponse and time in Affliate Transaction
		 */
		AffiliateTransactions::model()->updateByPk($affiliate_trans_id, array(
			'post_status' => '1',
			'post_response' => $response,
			'post_price' => $lender_lead_price,
			'vendor_post_price' => $vendor_lead_price,
			"post_time" => $post_time
		));
		if ($testcash) {
			return $response;
		} elseif ($process == 'inorganic') {
			header('Content-Type: text/xml');
			echo $response;
			exit;
		} else {
			header('Location:' . $affiliate_url);
		}
		Yii::app()->end();
	}
	public function setAcceptRespond($lender_lead_price, $vendor_lead_price, $post_time, $process = 'organic', $testcash = false)
	{
		$affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
		//$affiliate_trans_id = Yii::app()->params['affiliate_trans_id'];
		//$exit_url = LenderTransactions::model()->exit_url($affiliate_trans_id);
		$res_url = '';
		if ($process == 'inorganic') {
			$affiliate_url = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'] . '/leads/postaccept?affiliate_trans_id=' . $affiliate_trans_id);
			$res_url = '<URL>' . $affiliate_url . '</URL>';
		} else {
			$affiliate_url = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'] . '/leads/successAffiliate?affiliate_trans_id=' . $affiliate_trans_id);
			$res_url = '<URL>' . $affiliate_url . '</URL>';
		}
		// ===================== CREATE XML RESPONSE FOR OUR AFFILIATES ==========================//
		$response = '<?xml version="1.0"?>';
		$response .= '<PostResponse>';
		$response .= '<Response>ACCEPTED</Response>';
		$response .= '<Price>' . $vendor_lead_price . '</Price>';
		$response .= $res_url;
		$response .= '</PostResponse>';
		// ======================================= END ============================================//
		/**
		 * Update response, full_reponse and time in Affliate Transaction
		 */
		AffiliateTransactions::model()->updateByPk($affiliate_trans_id, array(
			'post_status' => '1',
			'post_response' => $response,
			'post_price' => $lender_lead_price,
			'vendor_post_price' => $vendor_lead_price,
			"post_time" => $post_time
		));
		if ($testcash) {
			return $response;
		} elseif ($process == 'inorganic') {
			header('Content-Type: text/xml');
			echo $response;
			exit;
		} else {
			header('Location:' . $affiliate_url);
		}
		Yii::app()->end();
	}
	public function edusetAcceptRespond($lender_lead_price, $vendor_lead_price, $post_time, $process = 'organic', $testcash = false)
	{
		//$affiliate_trans_id = Yii::app()->session['affiliate_trans_id'];
		$affiliate_trans_id = Yii::app()->params['affiliate_trans_id'];
		//$exit_url = LenderTransactions::model()->exit_url($affiliate_trans_id);
		/* $to = Yii::app()->request->getParam('email');
		$o_affiliate_user = new AffiliateUser();
		$is_email_exists = $o_affiliate_user->checkSupressionEmailExist($to,1); */
		/*if($is_email_exists == 1 && Yii::app()->request->getParam('lead_mode') == 1) {
			// $unsubscribe_link = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'].'/affiliates/removeemail?email='.$to);
			$unsubscribe_link = 'http://www.higherlearningapp.com/index.php/removeme?id='.$affiliate_trans_id;
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Higher Learning App <support@higherlearningapp.com>' . "\r\n";
			$headers .= 'Bcc: vic@elitemate.com, elitematevic@gmail.com, vic@higherlearningmarketers.com';
			$subject = "You Successfully Submitted Your Information To Higher Learning App";
			$mailmessage = "Hi ".Yii::app()->request->getParam('first_name').",<br /><br />";
			$mailmessage .= "Congratulations! You have successfully submitted your application to Higher Learning App. Please click the confirmation link below to confirm your email address. Please add the email address support@higherlearningapp.com to your white or safe list so we can communicate with you regarding your application. An interested college will be in contact with you very shortly to give you more information about enrollment and financial assistance. If you do not get contacted by a college near you within a few days please email us at support@higherlearningapp.com or write to us at HigherLearningApp.com - 105-10 62nd Road, Suite 1D, Forest Hills, NY 11375. All the best!<br /><br />";
			$mailmessage .= "Have a great day!<br /><br />";
			$mailmessage .= "Sincerely,<br /><br />";
			$mailmessage .= "Higher Learning App<br />";
			$mailmessage .= "support@higherlearningapp.com<br />";
			$mailmessage .= "Helping People Find Nearby Colleges<br /><br />";
			$mailmessage .= "HigherLearningApp.com - 105-10 62nd Road, Suite 1D, Forest Hills, NY 11375<br /><br />";
			$mailmessage .= "<a href='".trim($unsubscribe_link)."'>Unsubscribe Link</a>";
			mail($to, $subject, $mailmessage, $headers);
		}*/

		$res_url = '';
		if ($process == 'inorganic') {
			$affiliate_url = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'] . '/leads/postaccept?affiliate_trans_id=' . $affiliate_trans_id);
			$res_url = '<URL>' . $affiliate_url . '</URL>';
			if (Yii::app()->request->getParam('lead_mode') == 1) {
				AffiliateTransactions::model()->updateByPk($affiliate_trans_id, array('pixel_fired' => '1'));
			}
		} else {
			$affiliate_url = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign'] . '/leads/successAffiliate?affiliate_trans_id=' . $affiliate_trans_id . '&sub_id=' . Yii::app()->request->getParam('sub_id') . '&promo_code=' . Yii::app()->request->getParam('promo_code'));
		}
		// ===================== CREATE XML RESPONSE FOR OUR AFFILIATES ==========================//
		$response = '<?xml version="1.0"?>';
		$response .= '<PostResponse>';
		$response .= '<Response>ACCEPTED</Response>';
		$response .= $res_url;
		$response .= '</PostResponse>';
		// ======================================= END ============================================//
		/**
		 * Update response, full_reponse and time in Affliate Transaction
		 */
		$sub_id2 = Yii::app()->request->getParam('sub_id2');
		if (isset($sub_id2) && !empty($sub_id2)) {
			$_POST['sub_id2'] = $sub_id2;
		} else {
			$_POST['sub_id2'] = '';
		}
		AffiliateTransactions::model()->updateByPk($affiliate_trans_id, array(
			'post_status' => '1',
			'post_response' => $response,
			'post_price' => $lender_lead_price,
			'vendor_post_price' => $vendor_lead_price,
			'post_time' => $post_time,
			'lead_id' => Yii::app()->request->getParam('universal_leadid'),
			'sub_id2' => $sub_id2
		));
		$customer_id = AffiliateTransactions::model()->findByPK($affiliate_trans_id)->customer_id;
		$model_sub = new Submissions();
		$model_sub->update_lead_status_price($vendor_lead_price, $lender_lead_price, $customer_id, $affiliate_trans_id);
		if ($testcash) {
			return $response;
		} elseif ($process == 'inorganic') {
			header('Content-Type: text/xml');
			echo $response;
			exit;
		} else {
			// header('Location:' . $affiliate_url);
			$ch = curl_init($affiliate_url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_exec($ch);
			curl_close($ch);
		}
		Yii::app()->end();
	}
	/* Currently this function is not used in anywhere */
	public function setRejectRespond()
	{
		$response = '<?xml version="1.0"?><PostResponse><Response>REJECTED</Response><Reason>No Lender Found</Reason></PostResponse>';
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			'post_status' => '0',
			'post_response' => $response
		));
	}
	public function setNoLenderFoundRespond($process = 'organic')
	{
		$response = '<?xml version="1.0"?><PostResponse><Response>REJECTED</Response><Confirmation></Confirmation><Reason>No Lender Found</Reason></PostResponse>';
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			'post_status' => '0',
			'post_response' => $response
		));
		//$customer_id = AffiliateTransactions::model()->findByPK(Yii::app()->session['affiliate_trans_id'])->customer_id;
		//$model_sub = new Submissions();
		//$model_sub->update_ipaddress($customer_id);
		//if($process == 'inorganic'){
		header('Content-Type: text/xml');
		echo $response;
		exit;
		//}
	}
	/**
	 * @functionality : Created function to set response Cap Limit Met
	 */
	public function setCapLimitMet($process = 'organic')
	{
		$response = '<?xml version="1.0"?><PostResponse><Response>REJECTED</Response><Confirmation></Confirmation><Reason>Cap Limit Met</Reason></PostResponse>';
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			'post_status' => '0',
			'post_response' => $response
		));
		//$customer_id = AffiliateTransactions::model()->findByPK(Yii::app()->session['affiliate_trans_id'])->customer_id;
		//$model_sub = new Submissions();
		//$model_sub->update_ipaddress($customer_id);
		//if($process == 'inorganic'){
		header('Content-Type: text/xml');
		echo $response;
		exit;
		//}
	}
	/**
	 * @since : 22-12-2016 06:44 PM
	 * @author : Siddharajsinh Maharaul
	 * @functionality : Created new function to save all reasons for recent created lead.
	 */
	public function setResponse($s_response)
	{
		$response = '<?xml version="1.0"?><PostResponse><Response>REJECTED</Response><Confirmation></Confirmation><Reason>' . $s_response . '</Reason></PostResponse>';
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			'post_status' => '0',
			'post_response' => $response
		));
		//$customer_id = AffiliateTransactions::model()->findByPK(Yii::app()->session['affiliate_trans_id'])->customer_id;
		//$model_sub = new Submissions();
		//$model_sub->update_ipaddress($customer_id);
		//if($process == 'inorganic'){
		header('Content-Type: text/xml');
		echo $response;
		exit;
		//}
	}

	/**
	 * @since : 26-12-2016 11:46 AM
	 * @author : Siddharajsinh Maharaul
	 * @functionality : Created function to save response for paused direct posting
	 */
	public function pausedDirectPost()
	{
		$response = '<?xml version="1.0"?><PostResponse><Response>REJECTED</Response><Confirmation></Confirmation><Reason>Paused Direct Posting</Reason></PostResponse>';
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			'post_status' => '0',
			'post_response' => $response
		));
		//$customer_id = AffiliateTransactions::model()->findByPK(Yii::app()->session['affiliate_trans_id'])->customer_id;
		//$model_sub = new Submissions();
		//$model_sub->update_ipaddress($customer_id);
		//if($process == 'inorganic'){
		header('Content-Type: text/xml');
		echo $response;
		exit;
		//}
	}
	public function edusetInvalidNumber($process = 'organic', $type = '1')
	{
		$contact_type = 'Phone';
		if ($type == 2) {
			$contact_type = "Mobile";
		}
		$response = '<?xml version="1.0"?><PostResponse><Response>REJECTED</Response><Confirmation></Confirmation><Reason>Invalid ' . $contact_type . ' Number</Reason></PostResponse>';
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			'post_status' => '0',
			'post_response' => $response
		));
		//$customer_id = AffiliateTransactions::model()->findByPK(Yii::app()->session['affiliate_trans_id'])->customer_id;
		//$model_sub = new Submissions();
		//$model_sub->update_ipaddress($customer_id);
		//if($process == 'inorganic'){
		header('Content-Type: text/xml');
		echo $response;
		exit;
		//}
	}
	public function edusetVerificationFailed($i_is_address = '1')
	{
		$invalid_type = 'Postal';
		if ($i_is_address == '2') {
			$invalid_type = "Email";
		}
		$response = '<?xml version="1.0"?><PostResponse><Response>REJECTED</Response><Confirmation></Confirmation><Reason>Invalid ' . $invalid_type . ' Address</Reason></PostResponse>';
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			'post_status' => '0',
			'post_response' => $response
		));
		//$customer_id = AffiliateTransactions::model()->findByPK(Yii::app()->session['affiliate_trans_id'])->customer_id;
		//$model_sub = new Submissions();
		//$model_sub->update_ipaddress($customer_id);
		//if($process == 'inorganic'){
		header('Content-Type: text/xml');
		echo $response;
		exit;
		//}
	}
	public function edusetDuplicateIP()
	{
		$response = '<?xml version="1.0"?><PostResponse><Response>REJECTED</Response><Confirmation></Confirmation><Reason>Duplicate Ip-address</Reason></PostResponse>';
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			'post_status' => '0',
			'post_response' => $response
		));
		//$customer_id = AffiliateTransactions::model()->findByPK(Yii::app()->session['affiliate_trans_id'])->customer_id;
		//$model_sub = new Submissions();
		//$model_sub->update_ipaddress($customer_id);
		//if($process == 'inorganic'){
		header('Content-Type: text/xml');
		echo $response;
		exit;
		//}
	}
	public function time_check($start_time)
	{
		return (CommonToolsMethods::stopwatch() - $start_time);
	}
	/**
	 * Add Lender Transaction Log while ping and Update Post Response while Post
	 */
	public static function setDirectLenderTransactionLog($lender_name, $post_price, $post_request, $post_status, $post_response, $time = null, $ping_request = null, $ping_status = null, $ping_response = null, $ping_price = null, $redirected_url = null, $ping_id = null, $lender_id = null)
	{
		if ($ping_id == "") {
			$log = new LenderTransactions();
			$log->lender_name = $lender_name;
			$log->lender_id = $lender_id;
			$log->affiliate_transactions_id = Yii::app()->session['affiliate_trans_id'];
			$log->promo_code = Yii::app()->request->getParam('promo_code');
			$log->customer_id = Yii::app()->session['customer_id'];
			$log->ping_price = $ping_price ? $ping_price : '0.00';
			$log->ping_request = trim($ping_request);
			$log->ping_status = $ping_status;
			$log->ping_response = $ping_response;
			$log->post_request = $post_request ? $post_request : '';
			$log->post_status = $post_status ? $post_status : 0;
			$log->post_response = $post_response ? $post_response : '';
			$log->post_price = $post_price ? $post_price : '0.00';
			$log->post_time = $time ? $time : '0.00';
			$log->exit_url = $redirected_url ? $redirected_url : '';
			$log->ping_time = $time;
			$log->date = date('Y-m-d H:i:s');
			$log->insert();
			$id = Yii::app()->db->getLastInsertID();
			return $id;
		} else {
			LenderTransactions::model()->updateByPk($ping_id, [
				'post_request' => $post_request ? $post_request : '',
				'post_status' => $post_status ? $post_status : '0',
				'post_response' => $post_response ? $post_response : '',
				'post_price' => $lead_price ? $lead_price : '0',
				'exit_url' => $redirected_url ? $redirected_url : '',
				'post_time' => $time ? $time : '0',
				'date' => date('Y-m-d H:i:s')
			]);
		}
	}
	/**
	 * Add Lender Transaction Log while ping and Update Post Response while Post
	 */
	public static function setLenderTransactionLog($lender_name, $lead_price, $post_request, $post_status, $post_response, $time = null, $ping_request = null, $ping_status = null, $ping_response = null, $redirected_url = null, $ping_id = null, $lender_id = null)
	{
		if ($ping_id == "") {
			try{
				$log = new LenderTransactions();
				$log->lender_name = $lender_name;
				$log->lender_id = $lender_id;
				$log->affiliate_transactions_id = Yii::app()->session['affiliate_trans_id'];
				$log->promo_code = Yii::app()->request->getParam('promo_code');
				$log->customer_id = Yii::app()->session['customer_id'];
				$log->ping_price = $lead_price ? $lead_price : '0.00';
				$log->ping_request = trim($ping_request);
				$log->ping_status = $ping_status;
				$log->ping_response = $ping_response;
				$log->post_request = $post_request ? $post_request : '';
				$log->post_status = $post_status ? $post_status : 0;
				$log->post_response = $post_response ? $post_response : '';
				$log->post_price = $lead_price ? $lead_price : '0.00';
				$log->post_time = $time ? $time : '0.00';
				$log->exit_url = $redirected_url ? $redirected_url : '';
				$log->ping_time = $time;
				$log->date = date('Y-m-d H:i:s');
				$log->insert();
				$id = $log->id;
				//$id = Yii::app()->db->getLastInsertID();
			} catch (\Exception $e) {
				echo '<pre>';print_r($e->getMessage());exit;
			}
			//$id = $log->id;
			return $id;
		} else {
			LenderTransactions::model()->updateByPk($ping_id, [
				'post_request' => $post_request ? $post_request : '',
				'post_status' => $post_status ? $post_status : '0',
				'post_response' => $post_response ? $post_response : '',
				'post_price' => $lead_price ? $lead_price : '0',
				'exit_url' => $redirected_url ? $redirected_url : '',
				'post_time' => $time ? $time : '0',
				'date' => date('Y-m-d H:i:s')
			]);
		}
	}
	/* Added on 26-01-2015 */
	/**
	 * Add Lender, Vendor Price and Redirect URL in Submission Table after Accept
	 */
	public static function setLeadPriceInSubmission($lender_id, $lender_lead_price, $vendor_lead_price, $redirect_url)
	{
		$customer_id = AffiliateTransactions::model()->findByPK(Yii::app()->session['affiliate_trans_id'])->customer_id;
		Submissions::model()->updateByPk($customer_id, array(
			'lender_id' => $lender_id,
			'lender_lead_price' => $lender_lead_price,
			'vendor_lead_price' => $vendor_lead_price,
			'redirect_url' => $redirect_url,
			'lead_status' => '1'
		));
	}

	// Feed submission
	public function setRespondFeedSubmissionsError($getError, $errortype = 'submission')
	{
		$errors = '';
		echo '<?xml version="1.0"?>';
		$full_response = "";
		if ($errortype == 'submission') {
			$full_response .= '<Response>REJECTED</Response>';
			foreach ($getError as $key => $value) {
				$errors .= '<error>' . $value[0] . '</error>';
			}
			$full_response .= '<Errors>';
			$full_response .= $errors;
			$full_response .= '</Errors>';
			echo $full_response;
		} else if ($errortype == 'vendor_inactive') {
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Inactive campaign</Reason>';
			$full_response .= '</Errors>';
			echo $full_response;
		} else if ($errortype == 'duplicate') {
			$full_response = "";
			$full_response .= '<Response>REJECTED</Response>';
			$full_response .= '<Errors>';
			$full_response .= '<Reason>Duplicate lead</Reason>';
			echo $full_response .= '</Errors>';
		}
		Yii::app()->end();
	}
	public function setRespondErrorTimeIntervalFeed($lender, $interval)
	{
		$start_time = CommonToolsMethods::stopwatch();
		$full_response = "";
		$full_response .= '<?xml version="1.0"?>';
		$full_response .= '<Response>REJECTED</Response>';
		$full_response .= '<Errors><Reason>Time interval for Feed vendor ' . $lender . ' is ' . $interval . ' ....</Reason></Errors>';
		FeedVendorTransactions::model()->updateByPk(Yii::app()->session['vendor_trans_id'], array(
			"response" => 'Error',
			"full_response" => $full_response
		));
	}
	public function setRespondErrorCapFeed($lender, $cap)
	{
		$start_time = CommonToolsMethods::stopwatch();
		$full_response = "";
		$full_response .= '<?xml version="1.0"?>';
		$full_response .= '<Response>REJECTED</Response>';
		$full_response .= '<Errors><Reason>Current cap for Feed vendor ' . $lender . ' is ' . $cap . ' compleated </Reason></Errors>';
		FeedVendorTransactions::model()->updateByPk(Yii::app()->session['vendor_trans_id'], array(
			"response" => 'Error',
			"full_response" => $full_response
		));
	}
	/**
	 * Add Feed Lender Transaction Record
	 */
	public static function feeds_lender_transaction($feed_lender_name, $post_string, $full_response, $url, $curl_total_time, $response)
	{
		$model = new FeedLenderTransactions();
		$model->feed_lender_name = $feed_lender_name;
		$model->request = $post_string;
		$model->full_response = $full_response;
		$model->response = $response;
		$model->post_url = $url;
		$model->time = $curl_total_time;
		$model->date = new CDbExpression('NOW()');
		$model->insert();
	}
	public function setFeedLenderAcceptRespond($feed_lender_name, $post_string, $full_response, $posturl, $curl_total_time, $response)
	{
		$this->feeds_lender_transaction($feed_lender_name, $post_string, $full_response, $posturl, $curl_total_time, $response);
		Yii::app()->db->createCommand()->update('auto_feed_lenders', array(
			'dailysubmission_capcount' => new CDbExpression('dailysubmission_capcount + 1'),
			'dailyaccepted_capcount' => new CDbExpression('dailyaccepted_capcount + 1'),
			'timestamp_lastsent' => new CDbExpression('NOW()')
		), 'feed_lender_name=:feed_lender_name', array(
			':feed_lender_name' => $feed_lender_name
		));
	}
	public function edusetFeedLenderAcceptRespond($feed_lender_name, $post_string, $full_response, $posturl, $curl_total_time, $response, $vendor_id, $start_time = '')
	{
		/**
		 * Update submission count , accepted count and last sent timestamp in Feed Lender Table
		 */
		$o_edu_feed_lender = new EduFeedLenders();
		$o_edu_feed_lender->updateFeedLenderDetails($feed_lender_name);
		$lender_vendor_trans_model = new FeedLenderVendorTransaction();
		$lender_vendor_trans_model->lender_post_status_update($feed_lender_name, $vendor_id, '1', '0.000', 'true');
		$time_end = CommonToolsMethods::stopwatch();
		$post_time = ($time_end - $start_time);
		$this->setFeedAcceptRespond($post_time, $feed_lender_name, $vendor_id, $posturl, $curl_total_time);
		if (isset(Yii::app()->session['feedpostprocess_after_postprocess'])) {
			// ========== XML RESPONSE WHEN FEED POST PROCESS WAS PROCIDED AFTER POST PROCESS =========//
			$response = '<?xml version="1.0" encoding="ISO-8859-1"?>';
			$response .= '<PostResponse>';
			$response .= '<Response xmlns:xsp="http://apache.org/xsp">REJECTED<Confirmation></Confirmation><Reason>No Lender Found</Reason></Response>';
			$response .= '</PostResponse>';
			unset($_SESSION['feedpostprocess_after_postprocess']);
			session_destroy();
			// ======================================= END ============================================//
		} else if ($response == '1') {
			// ===================== XML RESPONSE ==========================//
			$response = '<?xml version="1.0" encoding="ISO-8859-1"?>';
			$response .= '<PostResponse>';
			$response .= '<Response xmlns:xsp="http://apache.org/xsp">FEED ACCEPTED</Response>';
			$response .= '</PostResponse>';
			// ======================================= END ============================================//
		} else {
			// ===================== XML RESPONSE ==========================//
			$response = '<?xml version="1.0" encoding="ISO-8859-1"?>';
			$response .= '<PostResponse>';
			$response .= '<Response xmlns:xsp="http://apache.org/xsp">FEED REJECTED</Response>';
			$response .= '</PostResponse>';
			// ==========================
		}
		echo $response;
		exit;
	}
	/**
	 * Multi Curl Ping to Lenders
	 */
	public function multi_curl($datas = [])
	{
		$mh = curl_multi_init();
		foreach ($datas as $data) {
			if ($data['ping_request'] != false) {
				${"ch" . $data['lender_id']} = curl_init();
				curl_setopt(${"ch" . $data['lender_id']}, CURLOPT_URL, $data['ping_url']);
				curl_setopt(${"ch" . $data['lender_id']}, CURLOPT_POST, 1);
				curl_setopt(${"ch" . $data['lender_id']}, CURLOPT_POSTFIELDS, $data['ping_request']);
				curl_setopt(${"ch" . $data['lender_id']}, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt(${"ch" . $data['lender_id']}, CURLOPT_CONNECTTIMEOUT, 0);
				curl_setopt(${"ch" . $data['lender_id']}, CURLOPT_TIMEOUT, 1000);
				curl_setopt(${"ch" . $data['lender_id']}, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt(${"ch" . $data['lender_id']}, CURLOPT_SSL_VERIFYHOST, 0);
				if (isset($data['header']) && !empty($data['header'])) {
					curl_setopt(${"ch" . $data['lender_id']}, CURLOPT_HTTPHEADER, $data['header']);
				}
				curl_multi_add_handle($mh, ${"ch" . $data['lender_id']});
			}
		}
		$running = null;
		do {
			curl_multi_exec($mh, $running);
		} while ($running > 0);
		$res_1 = [];
		foreach ($datas as $data) {
			if ($data['ping_request'] != false) {
				$res_1[$data['lender_id']]['ping_response'] = curl_multi_getcontent(${"ch" . $data['lender_id']});
				$info = curl_getinfo(${"ch" . $data['lender_id']});
				$res_1[$data['lender_id']]['ping_time'] = $info['total_time'];
				if (curl_errno(${"ch" . $data['lender_id']})) {
					$res_1[$data['lender_id']]['ping_response'] = "CURL ERROR: " . curl_error(${"ch" . $data['lender_id']});
				} elseif (empty($res_1)) {
					$res_1[$data['lender_id']]['ping_response'] = "CURL TIMEOUT"; // Timeout
				}
			} else {
				$res_1[$data['lender_id']]['ping_response'] = $data['ping_response_filtered'];
			}
		}
		return $res_1;
	}
	/**
	 * Feed Lenders curl posting
	 */
	function curlposting($url, $request, $header, $buffersize = 60, $methodpost = false)
	{
		global $curl_start_time, $curl_total_time;
		$ch = curl_init();
		$curl_start_time = time();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $buffersize);
		if (!empty($header))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		if ($methodpost == false) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		} else {
			curl_setopt($ch, CURLOPT_POST, 0);
		}
		$data = curl_exec($ch);
		curl_close($ch);
		$curl_total_time = (time() - $curl_start_time);
		return $data;
	}
	function curl($url, $request, $header = false, $method = 'post')
	{
		$curl = curl_init();
		if ($method == 'get') {
			curl_setopt($curl, CURLOPT_URL, $url . '?' . $request);
		} else {
			curl_setopt($curl, CURLOPT_URL, $url);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		if ($method == 'get') {
		} else {
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
		}
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($curl, CURLOPT_TIMEOUT, 60);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		if (!empty($header))
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		$response = curl_exec($curl);
		$message = curl_error($curl);
		curl_close($curl);
		return $response;
	}
	/* EDU RELATED COMPONENT METHODS*/
	//feed accepted
	public function setFeedAcceptRespond($post_time, $lendername, $vendor_id, $posturl = '', $curl_total_time = '')
	{
		$feed_lender_trans_id = Yii::app()->session['feed_lender_trans_id'];
		// ===================== XML RESPONSE ==========================//
		$response = '<?xml version="1.0" encoding="ISO-8859-1"?>';
		$response .= '<PostResponse>';
		$response .= '<Response xmlns:xsp="http://apache.org/xsp">FEED ACCEPTED</Response>';
		$response .= '</PostResponse>';
		// ======================================= END ============================================//
		/**
		 * Update Feed Lender Transaction
		 */
		$update = FeedLenderTransactions::model()->updateByPk($feed_lender_trans_id, array(
			'response' => 1,
			'feed_vendor_id' => $vendor_id,
			'full_response' => $response,
			'feed_lender_name' => $lendername,
			'time' => $curl_total_time,
			'post_url' => $posturl
		));
		header('Content-Type: text/xml');
		if (isset(Yii::app()->session['feedpostprocess_after_postprocess'])) {
			// ========== XML RESPONSE WHEN FEED POST PROCESS WAS PROCIDED AFTER POST PROCESS =========//
			$response = '<?xml version="1.0" encoding="ISO-8859-1"?>';
			$response .= '<PostResponse>';
			$response .= '<Response xmlns:xsp="http://apache.org/xsp">REJECTED<Confirmation></Confirmation><Reason>No Lender Found</Reason></Response>';
			$response .= '</PostResponse>';
			unset($_SESSION['feedpostprocess_after_postprocess']);
			session_destroy();
			// ======================================= END ============================================//
		}
		echo $response;
		exit;
	}
	//feed not accepted becasue no lender found
	public function setNoFeedLenderFoundRespond($post_time)
	{
		$feed_lender_trans_id = Yii::app()->session['feed_lender_trans_id'];
		// ===================== XML RESPONSE ==========================//
		$response = '<?xml version="1.0"?>';
		/*$response = '<?xml version="1.0" encoding="ISO-8859-1"?>';*/
		$response .= '<PostResponse>';
		//$response .= '<Response xmlns:xsp="http://apache.org/xsp">FEED REJECTED<Confirmation></Confirmation><Reason>No Lender Found</Reason></Response>';
		$response .= '<Response>REJECTED</Response><Reason>No Lender Found</Reason>';
		$response .= '</PostResponse>';
		// ======================================= END ============================================//
		/**
		 * Update Feed Lender Transaction
		 */
		$update = FeedLenderTransactions::model()->updateByPk($feed_lender_trans_id, array(
			'response' => 0,
			'full_response' => $response,
			'post_time' => $post_time
		));
		header('Content-Type: text/xml');
		if (isset(Yii::app()->session['feedpostprocess_after_postprocess'])) {
			// ========== XML RESPONSE WHEN FEED POST PROCESS WAS PROCIDED AFTER POST PROCESS =========//
			/*$response = '<?xml version="1.0" encoding="ISO-8859-1"?>';*/
			$response = '<?xml version="1.0"?>';
			$response .= '<PostResponse>';
			//$response .= '<Response xmlns:xsp="http://apache.org/xsp">EJECTED<Confirmation></Confirmation><Reason>No Lender Found</Reason></Response>';
			$response .= '<Response>REJECTED</Response><Reason>No Lender Found</Reason>';
			$response .= '</PostResponse>';
			unset($_SESSION['feedpostprocess_after_postprocess']);
			session_destroy();
			// ======================================= END ============================================//
		}
		echo $response;
		exit;
	}
	//feed not accepted becasue paused vendor found
	public function setPausedFeedVendorFoundRespond($post_time)
	{
		$feed_lender_trans_id = Yii::app()->session['feed_lender_trans_id'];
		// ===================== XML RESPONSE ==========================//
		$response = '<?xml version="1.0" encoding="ISO-8859-1"?>';
		$response .= '<PostResponse>';
		$response .= '<Response xmlns:xsp="http://apache.org/xsp">FEED REJECTED<Confirmation></Confirmation><Reason>PAUSED BY LENDER</Reason></Response>';
		$response .= '</PostResponse>';
		// ======================================= END ============================================//
		/**
		 * Update Feed Lender Transaction
		 */
		$update = FeedLenderTransactions::model()->updateByPk($feed_lender_trans_id, array(
			'response' => 0,
			'full_response' => $response,
			'post_time' => $post_time
		));
		header('Content-Type: text/xml');
		//print_r($response);
		if (isset(Yii::app()->session['feedpostprocess_after_postprocess'])) {
			// ========== XML RESPONSE WHEN FEED POST PROCESS WAS PROCIDED AFTER POST PROCESS =========//
			/*$response = '<?xml version="1.0" encoding="ISO-8859-1"?>';*/
			$response = '<?xml version="1.0"?>';
			$response .= '<PostResponse>';
			//$response .= '<Response xmlns:xsp="http://apache.org/xsp">REJECTED<Confirmation></Confirmation><Reason>No Lender Found</Reason></Response>';
			$response .= '<Response>REJECTED</Response><Reason>No Lender Found</Reason></Response>';
			$response .= '</PostResponse>';
			unset($_SESSION['feedpostprocess_after_postprocess']);
			session_destroy();
			// ======================================= END ============================================//
		}
		echo $response;
		exit;
	}
	/**
	 * Add Lender Transaction Log while ping and Update Post Response while Post
	 */
	public static function setLenderTransactionLogEdu($lender_name, $lead_price, $post_request, $post_status, $post_response, $post_time = null, $ping_request = null, $ping_status = null, $ping_response = null, $ping_time = null, $redirected_url = null, $ping_id = null, $campus_code = null, $lender_id = null)
	{
		if ($ping_id == "") {
			$log = new LenderTransactions();
			$log->lender_name = $lender_name;
			$log->lender_id = $lender_id;
			$log->affiliate_transactions_id = Yii::app()->session['affiliate_trans_id'];
			$log->promo_code = Yii::app()->request->getParam('promo_code');
			$log->customer_id = Yii::app()->session['lead_id']; // added on 26 march 2025
			$log->ping_price = $lead_price;
			$log->ping_request = $ping_request;
			$log->ping_status = $ping_status;
			$log->ping_response = $ping_response;
			$log->post_request = $post_request;
			$log->post_price = $lead_price;
			/*$log->post_status = $post_response;
		$log->post_response = $post_full_response;*/
			$log->post_status = $post_status;
			$log->post_response = $post_response;
			$log->exit_url = $redirected_url;
			$log->ping_time = $ping_time;
			$log->campus_code = $campus_code;
			$log->date = date('Y-m-d H:i:s');
			$log->insert();
			//$id = Yii::app()->db->getLastInsertID();
			$id = $log->id;
			return $id;
		} else {
			LenderTransactions::model()->updateByPk($ping_id, array(
				'campus_code' => $campus_code,
				'post_request' => $post_request,
				'post_status' => $post_status,
				'post_response' => $post_response,
				'post_price' => $lead_price,
				'exit_url' => $redirected_url,
				'post_time' => $post_time,
				'date' => date('Y-m-d H:i:s')
			));
		}
	}
	public function setOutsideGeoFootprintRespond()
	{
		$response = '<?xml version="1.0"?><PostResponse><Response>REJECTED</Response><Confirmation></Confirmation><Reason>Outside Geo Footprint</Reason></PostResponse>';
		AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array(
			'post_status' => '0',
			'post_response' => $response
		));
		//$AffiliateTransactions = AffiliateTransactions::model()->findByPK(Yii::app()->session['affiliate_trans_id']);
		//$customer_id = $AffiliateTransactions->customer_id;
		//$model_sub = new Submissions();
		//$model_sub->update_ipaddress($customer_id);
		header('Content-Type: text/xml');
		echo $response;
		exit;
	}
}
