<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysql_connect($host,$user,$pass) or die("Can not connect.".mysql_error());
mysql_select_db($db) or die("Can not connect.");

$zipcodes = array('37010','37015','37023','37028','37032','37035','37036','37040','37041','37042','37043','37044','37050','37051','37052','37055','37058','37061','37073','37079','37080','37101','37142','37146','37171','37175','37178','37181','37191','42204','42216','42220','42223','42232','42234','42236','42240','42241','42254','42262','42265','42266','42286','37165','37172','42280');
$lender_id='22';
$campus_code='CV';
$programs = array('BAM','CJA','MBCD','HAS','MEDASS','HRM','NAA','DAG','MST','MST','PARL');


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