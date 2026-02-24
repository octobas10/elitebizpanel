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

$fields = "email,id,xverify_email";
$sql = "SELECT $fields FROM ".$table." WHERE id >= $start_point AND lead_status=1 AND USPS_postal_verified=1 AND xverify_email IS NULL AND is_returned is NULL limit 100";
//echo $sql;echo '<br>';
$values = mysqli_query($link,$sql);
while ($rowr = mysqli_fetch_array($values)) {
	for ($j=0;$j<=$i;$j++){
		if($j==0){
			if($rowr['email']!=='' && !$rowr['xverify_email']){
				$email = $rowr['email'];
				$response = file_get_contents('http://www.xverify.com/services/emails/verify/?email='.$email.'&type=xml&apikey=1000018-2917DC1B&domain=www.elitecashwire.com');
				//echo '<pre>';print_r($response);exit;
				preg_match('/<responsecode>(.*)<\/responsecode>/i', $response, $responsecode);
				preg_match('/<status>(.*)<\/status>/i', $response, $status);
				if ($status[1]=='valid' && $responsecode[1]=='1') {
					$sql1 = "UPDATE `$table` SET `xverify_email`=1 WHERE email ='".$email."'";
					mysqli_query($link,$sql1);
				}else{
					$sql1 = "UPDATE `$table` SET `xverify_email`=0 WHERE email ='".$email."'";
					mysqli_query($link,$sql1);
				}
				echo $sql1;echo '<br>';
			}
		}
	}
	$start_point = $rowr['id'];
}
$fh = fopen($file_name, "w");
fwrite($fh, ($start_point + 1));
fclose($fh);
?>