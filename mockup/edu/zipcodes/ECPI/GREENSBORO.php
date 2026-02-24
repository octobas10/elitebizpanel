<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['27009','27010','27019','27025','27027','27040','27042','27045','27048','27051','27052','27101','27102','27103','27104','27105','27106','27107','27113','27114','27115','27116','27117','27120','27127','27130','27202','27214','27233','27235','27249','27260','27261','27262','27263','27264','27265','27282','27283','27284','27285','27301','27310','27313','27317','27320','27323','27342','27350','27357','27358','27360','27361','27370','27373','27374','27375','27377','27401','27402','27403','27404','27405','27406','27407','27408','27409','27410','27415','27416','27417','27419','27420','27425','27427','27429','27435','27438','27455','27094','27098','27099','27108','27109','27110','27111','27150','27152','27155','27157','27198','27199','27268','27411','27412','27413','27495','27497','27498','27499'];
$lender_id='26';
$campus_code='GREENSBORO';
$programs = ['CLOUDCOM','CYBNSBS','EET','EETBS','MECHASSO','MECHATRO','MEDASST','NETSECUR','PRACNURS'];


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