<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['29002','29016','29033','29036','29053','29054','29061','29063','29070','29071','29072','29073','29075','29122','29123','29130','29132','29147','29160','29169','29170','29171','29172','29177','29180','29201','29202','29203','29204','29205','29206','29207','29208','29209','29210','29211','29212','29214','29215','29216','29217','29218','29219','29220','29221','29222','29223','29224','29225','29226','29227','29228','29229','29230','29240','29250','29260','29290','29292','29006','29014','29015','29052','29062','29074','29078','29105','29112','29126','29135','29137','29164'];
$lender_id='26';
$campus_code='COLUMBIA';
$programs = ['CLOUDCOM','CYBNSBS','EET','HCADMIN','MEDASSDP','MEDASST','MOBDEV','NETSECUR','PRACNURS','RN','SOFTDEVE','SOFTDVAS'];


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