<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysql_connect($host,$user,$pass) or die("Can not connect.".mysql_error());
mysql_select_db($db) or die("Can not connect.");

$zipcodes = array('37022','37141','37148','42101','42102','42103','42104','42120','42122','42123','42127','42128','42133','42134','42135','42140','42141','42156','42159','42160','42164','42166','42170','42171','42201','42202','42206','42207','42210','42214','42252','42256','42259','42261','42273','42274','42275','42276','42285','42321','42323','42326','42337','42349','42721','42749','42762','42163','42130','42131','42320','42130','42131');
$lender_id='22';
$campus_code='BG';
$programs = array('AC','BAM','CJA','MBCD','MEDASS','ELET');


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

