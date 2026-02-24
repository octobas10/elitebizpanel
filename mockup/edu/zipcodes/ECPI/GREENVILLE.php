<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['28718','28724','28750','28756','28773','28784','28793','29302','29303','29304','29305','29306','29307','29316','29320','29321','29322','29323','29324','29329','29330','29331','29333','29334','29335','29336','29338','29346','29348','29349','29360','29365','29368','29369','29372','29373','29374','29375','29376','29377','29378','29385','29386','29388','29601','29602','29603','29604','29605','29606','29607','29608','29609','29610','29611','29612','29615','29616','29617','29621','29622','29623','29625','29627','29630','29631','29632','29633','29636','29638','29640','29641','29642','29644','29645','29650','29651','29652','29654','29656','29657','29661','29662','29667','29669','29670','29671','29673','29677','29680','29681','29682','29683','29685','29687','29688','29690','29692','29697','29301','29319','29395','29613','29614','29634'];
$lender_id='26';
$campus_code='GREENVILLE';
$programs = ['CLOUDCOM','CYBNSBS','EET','EETBS','HCADMIN','MECHASSO','MECHATRO','MEDASST','NETSECUR','PRACNURS','RN'];


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