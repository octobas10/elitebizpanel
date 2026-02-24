<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['27917','27921','27926','27929','27950','27956','27958','27973','27976','23320','23321','23322','23323','23325','23433','23434','23435','23436','23451','23452','23453','23454','23455','23457','23459','23460','23461','23462','23463','23464','23502','23503','23504','23505','23507','23508','23509','23510','23511','23513','23517','23518','23521','23523','23701','23702','23703','23704','23707','23708','23709'];
$lender_id='26';
$campus_code='MCI_VIRGINIABEACH';
$programs = ['DENTAL','HCADMIN','MEDASSDP','MEDASST','PRACNURS','RN'];


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