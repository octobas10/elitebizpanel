<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['23021','23025','23061','23062','23072','23109','23125','23128','23130','23163','23188','23304','23314','23432','23487','23601','23602','23603','23604','23605','23606','23607','23608','23651','23661','23662','23663','23664','23665','23666','23669','23690','23691','23692','23693','23696','23846','23883','23187','23430','23433','23436','23511','23517','23523','23551','23708','23709'];
$lender_id='26';
$campus_code='NEWPORTNEWS';
$programs = ['ACCOUNT','BSBA','CJCIA','CLOUDCOM','CRJBS','CYBNSBS','EET','EETBS','ESET','ESETMEC','HOMELAND','MECHASSO','MECHATRO','MOBDEV','NETSECUR','SOFTDEVE','SOFTDVAS'];


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