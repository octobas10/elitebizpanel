<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysql_connect($host,$user,$pass) or die("Can not connect.".mysql_error());
mysql_select_db($db) or die("Can not connect.");

$zipcodes = array('37011','37013','37014','37027','37029','37031','37048','37049','37062','37063','37065','37066','37068','37069','37070','37072','37075','37076','37082','37086','37087','37090','37115','37116','37121','37122','37135','37138','37143','37152','37184','37187','37188','37189','37201','37203','37204','37205','37206','37207','37208','37209','37211','37212','37213','37214','37215','37216','37217','37218','37219','37220','37221','37222','37227','37228','37229','37230','37232','37235','37241','37243','37250','37210','37202','37088','37167','37024'	);
$lender_id='22';
$campus_code='NV';
$programs = array('BAM','MBCD','HAS','MEDASS','NAA');


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