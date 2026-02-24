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

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());
//======> Art and Design
//41518-3D Modeling Animation Art And Design
//41558-3D Modeling Animation Art And Design Year 2	
//41383-3D Modeling, Animation Art & Design	
//41525-Architectural Design Technology	
//41559-Architectural Design Technology Year 2	
//41170-Architecture Design & Technology	
//41524-Game Development And Design	
//41561-Game Development And Design Year 2	
//41516-Graphic Design	
//7425-Graphic Design	
//41562-Graphic Design Year 2	
//41519-Interior Design	
//7428-Interior Design	
//41237-Interior Design With Co-Op	
//41566-Interior Design With Co-Op Year 2	
//41563-Interior Design Year 2	

	



$zipcodes = ['0000'];
$lender_id='29';
$campus_code='EDMONTONCITYCENTRE';
$programs = ['BSN','CLOUDCOM','CYBNSBS','EET','EETBS','MECHASSO','MECHATRO','MEDASSDP','MEDASST','MOBDEV','NETSECUR','PRACNURS','RN','SOFTDEVE','SOFTDVAS'];


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