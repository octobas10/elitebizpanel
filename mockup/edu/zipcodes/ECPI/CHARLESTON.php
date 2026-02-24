<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['29401','29403','29404','29405','29406','29407','29410','29412','29414','29418','29420','29426','29434','29435','29437','29445','29449','29451','29455','29456','29461','29464','29466','29469','29470','29472','29482','29483','29485','29492','29409','29423','29424','29439','29452'];
$lender_id='26';
$campus_code='CHARLESTON';
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