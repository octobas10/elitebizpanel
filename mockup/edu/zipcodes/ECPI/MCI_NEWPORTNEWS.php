<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['23011','23021','23025','23035','23045','23050','23056','23061','23062','23064','23066','23068','23070','23071','23072','23076','23089','23109','23119','23125','23128','23130','23156','23163','23168','23186','23188','23304','23314','23315','23432','23437','23487','23601','23602','23603','23604','23605','23606','23607','23608','23651','23661','23662','23663','23664','23665','23666','23668','23669','23690','23691','23692','23693','23696','23839','23846','23866','23878','23881','23883','23888','23890','23898','23899'];
$lender_id='26';
$campus_code='MCI_NEWPORTNEWS';
$programs = ['DENTAL','DMS','HCADMIN','MEDASSDP','MEDASST','MEDRAD','PAMEDIC','PHYTHER','PRACNURS','RN'];

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