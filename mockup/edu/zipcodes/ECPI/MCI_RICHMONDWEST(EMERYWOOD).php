<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['22427','22514','22534','22546','22580','23005','23009','23015','23023','23024','23030','23038','23039','23047','23059','23060','23063','23065','23069','23075','23086','23102','23103','23106','23111','23116','23117','23124','23126','23129','23140','23146','23148','23150','23153','23161','23177','23192','23219','23220','23221','23222','23223','23226','23227','23228','23229','23230','23231','23233','23238','23250','23294','23002','23027','23112','23113','23114','23120','23139','23160','23173','23224','23225','23234','23235','23236','23237','23298','23803','23805','23806','23824','23830','23831','23832','23833','23834','23836','23838','23840','23841','23842','23850','23860','23875','23885','23804'];
$lender_id='26';
$campus_code='MCI_RICHMONDWEST(EMERYWOOD)';
$programs = ['DENTAL','DMS','HCADMIN','MEDASST','PHYTHER','PRACNURS','RN','SURTECH'];


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