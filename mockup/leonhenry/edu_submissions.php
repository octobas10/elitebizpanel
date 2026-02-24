<meta http-equiv="Refresh" content="0;url=<?=$_SERVER['PHP_SELF'] ?>" />
<?php
error_reporting(1);
$table = basename($_SERVER["SCRIPT_FILENAME"],'.php');
$file_name= "$table.txt";
file_exists(getcwd().'/'.$file_name)?($fh=fopen($file_name,'r+') AND $start_point=fgets($fh)) : ($fh = fopen($file_name,'w') AND fwrite($fh,'0') AND $start_point=0);

$host = 'localhost';$user = 'axiom';$pass = '7anAZewE';$db = 'eliteedu';

ini_set('memory_limit','1024M');ini_set("max_execution_time", "5000");
$link = mysqli_connect($host, $user, $pass,$db) or die("Can not connect." . mysql_error());

$i = 6;
$fields = "address,city,state,zip,USPS_postal_verified,id";
$sql = "SELECT $fields FROM ".$table." WHERE USPS_postal_verified is NULL AND id >= ".$start_point." ORDER BY id ASC LIMIT 100";
//echo $sql;exit;

$values = mysqli_query($link,$sql);
while ($rowr = mysqli_fetch_array($values)){
	//echo '<pre>';print_r($rowr);exit;
	if($rowr['USPS_postal_verified']==1){
		$istrue =1;
	}else{
		$istrue=USPSPostalAddressVerification($rowr['address'],$rowr['city'],$rowr['state'],$rowr['zip']);
		mysqli_query($link,"UPDATE $table SET USPS_postal_verified = '".$istrue."' WHERE id =".$rowr['id']."");
	}
	$start_point = $rowr['id'];
}

$fh = fopen($file_name, "w");
fwrite($fh, ($start_point + 1));
fclose($fh);

function USPSPostalAddressVerification($address,$city,$state,$zip){
	$postalAddr['address']=$address;
	$postalAddr['city']=$city;
	$postalAddr['state']=$state;
	$postalAddr['zip']=$zip;
	if(is_array($postalAddr)){
		$address = $postalAddr['address'];
		$city = $postalAddr['city'];
		$state = $postalAddr['state'];
		$zip = $postalAddr['zip'];
		$AddressValidateRequest = '<AddressValidateRequest USERID="238ELITE1679">';	
		$AddressValidateRequest .='<Address ID="1"><Address1></Address1><Address2>'.$address.'</Address2><City>'.$city.'</City><State>'.$state.'</State><Zip5>'.$zip.'</Zip5><Zip4></Zip4></Address>';
		$AddressValidateRequest .= "</AddressValidateRequest>";
		$ch = curl_init("http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=".urlencode($AddressValidateRequest));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		$AddressValidateResponse = curl_exec($ch);
		//print_r($AddressValidateResponse);
		curl_close($ch);
		$response = simplexml_load_string($AddressValidateResponse);
		if(isset($response->Address->Error->Description)){
			return 0;
		}else{
			return 1;
		}
	}else{
		return 0;
	}
}