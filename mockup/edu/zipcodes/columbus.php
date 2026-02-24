<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysql_connect($host,$user,$pass) or die("Can not connect.".mysql_error());
mysql_select_db($db) or die("Can not connect.");

$zipcodes = array('43001','43004','43008','43013','43021','43023','43025','43031','43033','43046','43054','43055','43056','43062','43068','43069','43074','43076','43080','43082','43085','43102','43103','43105','43109','43110','43112','43115','43116','43123','43125','43127','43130','43136','43137','43140','43143','43146','43147','43148','43150','43154','43157','43162','43164','43201','43202','43203','43204','43205','43206','43207','43209','43210','43211','43212','43213','43214','43215','43217','43219','43222','43223','43224','43227','43228','43231','43232','43240');
$lender_id='22';
$campus_code='LC';
$programs = array('BAM','MBCD','MEDASS','MSTY');


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