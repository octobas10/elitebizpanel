<?php
/*
 * /protected/components/CommonToolsMethods.php
 * 
 */
class CommonToolsMethods
{
	/**
	 * stopwatch
	 * Gives a precise time, recalculated as PHP runs, not just once at the
	 * beginning. Useful to for timing parts of the script.
	 *
	 * @return float Seconds since the UNIX epoch began
	 **/
	public static function stopwatch()
	{
		list($usec, $sec) = explode(' ', @microtime());
		return ((float)$usec + (float)$sec);
	}

	public static function getDOBbyEmailSpencer($email)
	{
		if (!empty($email)) {
			$header = ['Content-Type: application/x-www-form-urlencoded'];
			//$url = 'https://responseamerica.net/email_dob?key=1a2b3c&email='.$email;
			$url = 'https://nrc.net/email_dob?key=1a2b3c&email=' . $email;
			//$response = file_get_contents($url);
			$response = self::curl($url, '', $header, 'get');
			$result = json_decode($response, TRUE);
			if ($result) {
				$dob = $result[0]['dob'];
				if ($dob == 'NOT FOUND') {
					return false;
				} else {
					$dob = substr($dob, 0, 4) . "-" . substr($dob, 4, 2) . "-" . substr($dob, 6, 2);
					return $dob;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public static function curl($url, $request = false, $header = false, $method = 'post')
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		if ($method == 'get') {
		} else {
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
		}
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($curl, CURLOPT_TIMEOUT, 5);
		//curl_setopt($curl,CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		if (!empty($header))
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		$response = curl_exec($curl);
		$message = curl_error($curl);
		curl_close($curl);
		return $response;
	}
}
