<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysql_connect($host,$user,$pass) or die("Can not connect.".mysql_error());
mysql_select_db($db) or die("Can not connect.");

$zipcodes = array('10001');
$lender_id='23';
//$campus_code='ONLINEDA';
//$campus_code='CAMPUSDA';
$campus_code='EITHERDA';
$programs = array('ANF','AMG','MBA','BCOM','BIS','BL','CM','EBEC','ECOM','FIN','HCMA','HHM','HR','IB','MG','MKT','OPM','OMG','ORMG','RE','RM','SBM','SM','AA','BC','BIZ','CNC','CDC','COSMET','CUA','DRF','ELE','ELECS','ESTN','FNW','GUSM','HCE','HVAC','INTR','LNDSCP','LWEN','LCSM','MTB','MBAR','MNR','NT','PLUB','TNT','TDT','VS','CSE','CSEC','DB','GDE','GNM','IS','IT','NTWK','PRG','SE','TM','TELCOM','WDES','WDEV','AHE','CNI','DE','ECE','EA','EC','ELA','ET','ESLBE','GE','K12E','LRM','SEDU','TECING','TRNING','HA','HNHS','HSC','HS','MEDASS','MBC','MI','MOM','MT','NUR','NAF','PHAR','PT','PT','RADGY','COMM','ENG','FSH','FL','GNRL','GNRLA','HIST','HUMA','MUS','RELG','VAD','WRI','AVI','BIO','ENGING','EM','ES','GNRL','MATH','COUNS','CJ','FORS','GNRL','HLS','LAW','LNP','LS','PS','PSYLGY','PA','PUBS','SW','SOCGY');


foreach ($zipcodes as $zipcode){
	$sql_city_state = "SELECT `city`, `state`,`lat`,`lng` FROM `zipcodes` WHERE `zipcode`='".$zipcode."'";
	$result = mysql_query($sql_city_state);
	$row = mysql_fetch_array($result);
	
	$city = $row['city'];$state = $row['state'];$lat = $row['lat'];$lng = $row['lng'];
	foreach ($programs as $program){
		$sql="INSERT INTO edu_zipcodes (zipcode,lender_id,city,state,program_of_interest_code,campus_code,lng,lat,status) values ('$zipcode','$lender_id','$city','$state','$program','$campus_code','$lat','$lng',1);";
		//echo $sql;
		//echo '<br>';
		$values=mysql_query($sql);
	}
}

