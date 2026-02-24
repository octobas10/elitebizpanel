<?php
//$url = 'https://responseamerica.net/email_dob?key=1a2b3c&email=octobas@gmail.com';
//echo '<pre>';print_r(file_get_contents($url));exit;
$email = 'octobas@gmail.com';
$result =  getDOBbyEmailSpencer($email);
echo '<pre>Response : ';
print_r($result);
exit;
function getDOBbyEmailSpencer($email) {
    if(!empty($email)){
    	$header = ['Content-Type: application/x-www-form-urlencoded'];
        //echo $url = 'https://responseamerica.net/email_dob?key=1a2b3c&email='.$email;
        $url = 'https://nrc.net/email_dob?key=1a2b3c';
	    $request = 'email='.$email;
	    echo 'Request: '.$url.'&'.$request.'<br>';
        $response = curl($url,$request,$header,'post ');
        $result = json_decode($response,TRUE);
        $dob = $result[0]['dob'];
        if(!empty($dob)){
        	if($dob == 'NOT FOUND'){
	            return false;
	        }else{
	            $dob = substr($dob,0,4)."-".substr($dob,4,2)."-".substr($dob,6,2);
	            return $dob;
	        }	
        }else{
        	return false;	
        }
    }else{
        return false;
    }
}

function curl($url,$request=false,$header=false,$method='post'){
	$curl = curl_init();
	if($method == 'get'){
		curl_setopt($curl,CURLOPT_URL,$url.'?'.$request);
	}else{
		curl_setopt($curl,CURLOPT_URL,$url);
	}
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
	if($method == 'get'){
	}else{	
		curl_setopt($curl,CURLOPT_POST,true);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$request);
	}
	curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);
	curl_setopt($curl,CURLOPT_TIMEOUT,5);
	curl_setopt($curl,CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
	if(!empty($header))
		curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
	$response = curl_exec($curl);
	$message = curl_error($curl);
	curl_close($curl);
	return $response;
}