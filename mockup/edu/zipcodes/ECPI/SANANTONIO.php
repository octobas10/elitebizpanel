<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['78002','78009','78015','78023','78039','78052','78054','78056','78063','78066','78069','78073','78101','78108','78109','78112','78124','78148','78150','78152','78154','78163','78201','78202','78203','78204','78205','78206','78207','78208','78209','78210','78211','78212','78213','78214','78215','78216','78217','78218','78219','78220','78221','78222','78223','78224','78225','78226','78227','78228','78229','78230','78231','78232','78233','78234','78235','78236','78237','78238','78239','78240','78241','78242','78243','78244','78245','78246','78247','78248','78249','78250','78251','78252','78253','78254','78255','78256','78257','78258','78259','78260','78261','78263','78264','78265','78266','78268','78269','78270','78278','78279','78280','78283','78284','78285','78288','78289','78291','78292','78293','78294','78295','78296','78297','78298','78299'];
$lender_id='26';
$campus_code='SANANTONIO';
$programs = ['CYBNSBS','EETBS'];


foreach ($zipcodes as $zipcode){
	$sql_city_state = "SELECT `city`, `state`,`lat`,`lng` FROM `zipcodes` WHERE `zipcode`='".$zipcode."'";
	$result = mysqli_query($link,$sql_city_state);
	$row = mysqli_fetch_array($result);
	
	$city = $row['city'];$state = $row['state'];$lat = $row['lat'];$lng = $row['lng'];
	foreach ($programs as $program){
		$sql="INSERT INTO edu_zipcodes (zipcode,lender_id,city,state,program_of_interest_code,campus_code,lng,lat,status) values ('$zipcode','$lender_id','$city','$state','$program','$campus_code','$lat','$lng',1);";
		echo $sql;
		echo '<br>';
		$values=mysqli_query($link,$sql);
	}
}

//$values=mysql_query($sql);