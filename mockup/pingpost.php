<?php
$header = array("application/x-www-form-urlencoded");
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
if($action=='post'){
	$ping_id = isset($_REQUEST['ping_id']) ? $_REQUEST['ping_id'] : '';
	$url = 'http://local.elitebizpanel.com/index.php/auto/pingpostprocess';
	$request=' lead_mode=1&promo_code=26&ping_id='.$ping_id.'&sub_id=1282&first_name=Claire&last_name=Voyant&gender=M&dob=12%2F27%2F1989&email=email884%40gmail.com&phone=3128372258&address=2441+San+Ramon+Blvd&zip=60654&city=Chicago&state=IL&mobile=9724473839&is_rented=rent&stay_in_month=05&stay_in_year=02&home_pay=200&employer=ATT&job_title=Project+Manager&employment_in_month=11&employment_in_year=02&monthly_income=4000&ssn=564751211&bankruptcy=0&ipaddress=74.122.1.44&cosigner=1&agree_credit_check=1&url=https://eliteautocash.com';
}else{
	$url = 'http://local.elitebizpanel.com/index.php/auto/pingprocess';
	$request='lead_mode=1&promo_code=26&zip=60654&ssn=564751211&monthly_income=4000';
}

$res_3 = curlposting($url,'1', $request,$header,'60');
echo "<b>Post URL : </b>".$url."<br>";
echo "<b>Post Request : </b><pre>".htmlspecialchars($request, ENT_QUOTES)."</pre><br>";
echo "<b>Post Response : </b><pre>".htmlspecialchars($res_3['res'], ENT_QUOTES)."</pre><br>";

function curlposting($url ,$post_type, $request , $header , $buffersize = 50){
	$response = array();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST,'1');
	curl_setopt($ch,CURLOPT_POSTFIELDS,$request);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, $buffersize);
	curl_setopt($ch, CURLOPT_SSLVERSION, 3);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$result = curl_exec($ch);
	curl_close($ch);
	$response['res'] = $result;
	return $response;
}
?>