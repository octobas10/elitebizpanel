<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysql_connect($host,$user,$pass) or die("Can not connect.".mysql_error());
mysql_select_db($db) or die("Can not connect.");

$zipcodes = array('37012','37016','37018','37020','37026','37034','37037','37046','37059','37060','37064','37067','37085','37091','37095','37118','37127','37128','37129','37130','37132','37133','37144','37149','37153','37160','37162','37174','37179','37180','37183','37190','37355','37360','37167','37019');
$lender_id='22';
$campus_code='MB';
$programs = array('AC','BAM','CJA','HAS','MEDASS');


foreach ($zipcodes as $zipcode){
	$sql_city_state = "SELECT `city`, `state`,`lat`,`lng` FROM `zipcodes` WHERE `zipcode`='".$zipcode."'";
	$result = mysql_query($sql_city_state);
	$row = mysql_fetch_array($result);
	
	$city = $row['city'];$state = $row['state'];$lat = $row['lat'];$lng = $row['lng'];
	foreach ($programs as $program){
		$sql="INSERT INTO edu_zipcodes (zipcode,lender_id,city,state,program_of_interest_code,campus_code,lng,lat,status) values ('$zipcode','$lender_id','$city','$state','$program','$campus_code','$lat','$lng',1);";
		echo $sql;
		echo '<br>';
		$values=mysql_query($sql);
	}
}

//$values=mysql_query($sql);