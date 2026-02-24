<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysql_connect($host,$user,$pass) or die("Can not connect.".mysql_error());
mysql_select_db($db) or die("Can not connect.");

$zipcodes = array('08201','08205','08213');
$lender_id='14';
$campus_code='VRHHSB';
$programs = array('MSHT','DS','PMA','HCS','SUT');


foreach ($zipcodes as $zipcode){
	$sql_city_state = "SELECT `city`, `state` FROM `zipcodes` WHERE `zipcode`='".$zipcode."'";
	$result = mysql_query($sql_city_state);
	$row = mysql_fetch_array($result);
	
	$city = $row['city'];$state = $row['state'];
	foreach ($programs as $program){
		$sql="INSERT INTO edu_zipcodes (zipcode,lender_id,city,state,program_of_interest_code,campus_code,status) values ('$zipcode','$lender_id','$city','$state','$program','$campus_code',1);";
		echo $sql;
		echo '<br>';
	}
}

//$values=mysql_query($sql);