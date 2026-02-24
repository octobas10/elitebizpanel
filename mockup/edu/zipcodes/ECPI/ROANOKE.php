<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['24011','24012','24013','24014','24015','24016','24017','24018','24019','24020','24059','24060','24061','24064','24065','24066','24067','24070','24072','24073','24077','24079','24083','24085','24087','24088','24090','24092','24095','24101','24104','24121','24122','24127','24128','24131','24138','24151','24153','24162','24174','24175','24176','24179','24184','24426','24523','24555','24578','24579','24001','24002','24003','24004','24005','24006','24007','24008','24009','24010','24022','24023','24024','24025','24026','24027','24028','24029','24030','24031','24032','24033','24034','24035','24036','24037','24038','24040','24042','24043','24050','24062','24063','24068','24102','24130','24137','24139','24146','24155','24157','24161','24178','24438','24448','24457','24474','24526','24536','24551','24556','24570','24571','24941','24984'];
$lender_id='26';
$campus_code='ROANOKE';
$programs = ['CLOUDCOM','CYBNSBS','MEDASSDP','MEDASST','NETSECUR','PRACNURS','RN'];


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