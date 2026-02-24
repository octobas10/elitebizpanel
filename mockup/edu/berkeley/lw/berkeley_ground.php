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

$campus_code = ['GMT','NYC','NWK','MDL'];

// New York City
$campus_NYC = ['AAS_AC','AAS_MG','AAS_CJ','BBA_FN','BBA_GB','BBA_HM','BBA_MK','BS_TM','BBA_AC','BBA_MG','AAS_FN','AAS_MK','BS_CJ','AAS_TM','BBA_BSA'];
// Newark
$campus_NWK = ['AAS_CJ','AAS_MD','C_PCT'];
// Woodbridge
$campus_MDL = ['AAS_MG','AAS_CJ','AAS_MD','BBA_FN','BBA_GB','BBA_HM','BBA_MG','BS_CJ','AAS_FN'];
// Woodland Park
$campus_GMT = ['AAS_AC','AAS_MG','AAS_CJ','AAS_MD','BBA_FN','BBA_GB','BBA_HM','BBA_MK','BS_TM','C_PCT','BBA_AC','BBA_MG','BS_CJ','AAS_FN','AAS_MK','AAS_TM','BBA_BSA'];
 
$lender_id='24';
$sql="UPDATE edu_zipcodes SET status=0 WHERE campus_code<>'ONL' AND lender_id=$lender_id";
mysqli_query($link,$sql);
foreach ($campus_code as $campus){
	$my_array = "campus_$campus";
	//$active_programs = implode("','",$$my_array);
	foreach ($$my_array as $program){
		$sql = "SELECT DISTINCT postal_Code,ECW_Program_code FROM berkeley_active_zipcode_campus WHERE `program_code` ='".$program."' AND `campus_code` ='".$campus."' AND status=1";
		$result = mysqli_query($link,$sql);
		$postal_code = "'";
		while ($row=mysqli_fetch_array($result)) {
		    $postal_code .=str_pad($row['postal_Code'],5, "0",STR_PAD_LEFT)."','";
		    $ecw_program_code = $row['ECW_Program_code'];
		}
		$postal_code = rtrim($postal_code,"'");$postal_code = rtrim($postal_code,",");
		if($postal_code <> ''){
			$sql="UPDATE edu_zipcodes as A SET A.status=1 WHERE (A.program_of_interest_code = '$ecw_program_code' AND A.zipcode IN ($postal_code) AND A.campus_code='".$campus."' AND A.lender_id=$lender_id)";
			$values=mysqli_query($link,$sql);
		}
	}
}
// ===> URLS
//https://elitebizpanel.com/mockup/edu/berkeley/lw/berkeley_ground.php
//https://elitebizpanel.com/mockup/edu/berkeley/lw/berkeley_online.php

// ===> BERKELEY_GROUND_CAMPUS_ZIPCODES_JULY_2025.txt
#	SELECT `zipcode`, `program_of_interest_code`, `campus_code` FROM `edu_zipcodes` WHERE `lender_id`=24 and `status`=1 and `campus_code`!='ONL';

// ===> BERKELEY_ONLINE_NJ_CAMPUS_ZIPCODES_JULY_2025.txt (NJ)
#	SELECT `zipcode`, `program_of_interest_code`, `campus_code` FROM `edu_zipcodes` WHERE status=1 and `lender_id`=24 AND campus_code='ONL' AND state='NJ';
//--- BERKELEY_ONLINE_NY_CAMPUS_ZIPCODES_JULY_2025.txt
#	SELECT `zipcode`, `program_of_interest_code`, `campus_code` FROM `edu_zipcodes` WHERE status=1 and `lender_id`=24 AND campus_code='ONL' AND state='NY';

#======================WHEN THEY GIVES US ZIPCODES====================#
# UPDATE `berkeley_active_zipcode_campus` SET `status`=0 WHERE campus_code='GMT';

# UPDATE `berkeley_active_zipcode_campus` SET `status`=1 WHERE `postal_code` IN (select zipcode from nyc) and `campus_code`='NYC';

# UPDATE `berkeley_active_zipcode_campus` SET `status`=1 WHERE `postal_code` IN (select zipcode from gmt) and `campus_code`='GMT';

# UPDATE `berkeley_active_zipcode_campus` SET `status`=1 WHERE `postal_code` IN (select zipcode from mdl) and `campus_code`='MDL';
