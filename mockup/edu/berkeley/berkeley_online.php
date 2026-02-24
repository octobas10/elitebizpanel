<?php
$host = 'localhost';
if($_SERVER['REMOTE_ADDR'] == '::1'){
	$user = 'root';
	$pass = '12345678';
}else{
	$user = 'axiom';
	$pass = '7anAZewE';
}
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");
//SELECT count(*) FROM `edu_zipcodes` WHERE lender_id=24  AND status=1 AND campus_code <> 'ONL';
$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$campus_code = ['ONL'];

$campus_ONL = ['AAS_CJ','BBA_FN','BBA_GB','BBA_HM','BBA_MK','BBA_MG','BS_CJ','AAS_FN','AAS_MK','BBA_BSA','BS_TM'];
$lender_id='24';
$sql="UPDATE edu_zipcodes SET status=0 WHERE campus_code='ONL' AND lender_id=$lender_id";
mysqli_query($link,$sql);
foreach ($campus_code as $campus){
	$my_array = "campus_$campus";
	//$active_programs = implode("','",$$my_array);
	foreach ($$my_array as $program){
		$sql = "SELECT DISTINCT postal_Code,ECW_Program_code FROM berkeley_active_zipcode_online WHERE `program_code` ='$program' AND `campus_code` ='$campus'";
		$result = mysqli_query($link,$sql);
		$postal_code = "'";
		while ($row = mysqli_fetch_array($result)) {
			$zipcode = str_pad($row['postal_Code'],5, "0",STR_PAD_LEFT);
			$ecw_program_code = $row['ECW_Program_code'];
			// CHECK IF NEW PROGRAM CODE ARRIVED
			$qry = "SELECT id FROM edu_zipcodes WHERE `program_of_interest_code` ='$ecw_program_code' AND `campus_code` ='$campus' AND `zipcode`='$zipcode' AND lender_id=$lender_id";
			$res = mysqli_query($link, $qry);
			if (mysqli_num_rows($res) === 0) {
			 	$sql_city_state = "SELECT `city`, `state`,`lat`,`lng` FROM `zipcodes` WHERE `zipcode`='$zipcode'";
				$rec = mysqli_query($link,$sql_city_state);
				$ro = mysqli_fetch_assoc($rec);
				$city = $ro['city'];$state = $ro['state'];$lat = $ro['lat'];$lng = $ro['lng'];
				$sq="INSERT INTO edu_zipcodes (`zipcode`, `lender_id`, `city`, `state`,`program_of_interest_code`, `campus_code`, `lng`, `lat`, `status`) VALUES ('$zipcode','$lender_id','$city','$state','$ecw_program_code','$campus', '$lat','$lng','1');";
				$values = mysqli_query($link,$sq);
			}
		    $postal_code .= $zipcode."','";
		}
		$postal_code = rtrim($postal_code,"'");$postal_code = rtrim($postal_code,",");
		if($postal_code <> ''){
			$sql="UPDATE edu_zipcodes as A SET A.status=1 WHERE (A.program_of_interest_code = '$ecw_program_code' AND A.zipcode IN ($postal_code) AND A.campus_code='$campus' AND A.lender_id=$lender_id)";
			mysqli_query($link,$sql);
		}
	}
}
// ===> URLS
//https://elitebizpanel.com/mockup/edu/berkeley/berkeley_ground.php
//https://elitebizpanel.com/mockup/edu/berkeley/berkeley_online.php

// ===> GROUND
#	SELECT `zipcode`, `program_of_interest_code`, `campus_code` FROM `edu_zipcodes` WHERE `lender_id`=24 and `status`=1 and `campus_code`!='ONL';

// ===> ONLINE (NJ)
#	SELECT `zipcode`, `program_of_interest_code`, `campus_code` FROM `edu_zipcodes` WHERE status=1 and `lender_id`=24 AND campus_code='ONL' AND state='NJ';
//---
#	SELECT `zipcode`, `program_of_interest_code`, `campus_code` FROM `edu_zipcodes` WHERE status=1 and `lender_id`=24 AND campus_code='ONL' AND state='NY';
