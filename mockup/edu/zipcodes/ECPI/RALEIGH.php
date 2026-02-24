<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['27228','27231','27243','27278','27312','27501','27502','27503','27508','27509','27510','27511','27512','27513','27514','27515','27516','27517','27518','27519','27520','27522','27523','27525','27526','27527','27528','27529','27539','27540','27541','27543','27544','27545','27557','27559','27560','27562','27565','27571','27572','27576','27581','27583','27587','27588','27591','27592','27593','27596','27597','27601','27602','27603','27604','27605','27606','27607','27608','27609','27610','27611','27612','27613','27614','27615','27616','27617','27619','27620','27622','27623','27624','27626','27627','27628','27629','27636','27650','27658','27661','27675','27701','27702','27703','27704','27705','27707','27709','27712','27713','27715','27717','27722'];

$lender_id='26';
$campus_code='RALEIGH';
$programs = ['CLOUDCOM','CYBNSBS','EET','EETBS','MECHASSO','MECHATRO','MOBDEV','NETSECUR','PRACNURS','SOFTDEVE'];


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