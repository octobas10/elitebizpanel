<?php
$host = 'localhost';
if($_SERVER['REMOTE_ADDR'] == '::1'){
	$user = 'root';
	$pass = '12345678';
}else{
	$user = 'axiom';
	$pass = '7anAZewE';
}
$db = 'eliteedu';
ini_set('memory_limit', '1000M');
ini_set("max_execution_time", "30000");

$link = @mysqli_connect($host, $user, $pass, $db) or die("Can not connect." . mysqli_error());

$zipcodes = ['07074', '07436', '07451', '07495', '07608', '07620', '07626', '07627', '07640', '07648', '07653', '07699', '07007', '07021', '07028', '07041', '07051', '07068', '07078', '07096', '07097', '07099', '07303', '07308', '07309', '07311', '07395', '07399', '08810', '08818', '08840', '08855', '08862', '08871', '08884', '08899', '08903', '08905', '08906', '08922', '08933', '08988', '08989', '07701', '07702', '07703', '07704', '07709', '07710', '07711', '07712', '07715', '07716', '07717', '07718', '07719', '07720', '07722', '07723', '07724', '07726', '07727', '07728', '07730', '07733', '07738', '07739', '07746', '07750', '07751', '07752', '07753', '07754', '07755', '07757', '07760', '07762', '07763', '07764', '07765', '07799', '08510', '08514', '08526', '08535', '08555', '08720', '08730', '08736', '08750', '07045', '07802', '07806', '07842', '07845', '07870', '07878', '07926', '07928', '07935', '07946', '07961', '07962', '07963', '07970', '07976', '07980', '07983', '07999', '07015', '07435', '07474', '07477', '07511', '07061', '07091', '07092', '07901', '07902'];
$lender_id = '24';
$campus_code = 'ONL';
$programs = ['CJA','FNA','MCA','FNB','GBB','MGB','MCB','CJB','BACA','ACBA','HMB','ACBA','FNB','GBB','BA'];
$zpcode = implode("','",$zipcodes);
$sql = "UPDATE edu_zipcodes SET status=0 where lender_id=24 AND campus_code='ONL' and `state`='NJ'";
mysqli_query($link, $sql);
foreach ($zipcodes as $zipcode) {
	$sql_city_state = "SELECT `city`, `state`,`lat`,`lng` FROM `zipcodes` WHERE `zipcode`='" . $zipcode . "'";
	$result = mysqli_query($link, $sql_city_state);
	$row = mysqli_fetch_array($result);
	$city = $row['city'];$state = $row['state'];$lat = $row['lat'];$lng = $row['lng'];
	foreach ($programs as $program) {
		$chk_sql = "SELECT id FROM edu_zipcodes WHERE lender_id='$lender_id' and zipcode='$zipcode' AND program_of_interest_code='$program' AND campus_code='$campus_code'";
		$res = mysqli_query($link, $chk_sql);
		$rw = mysqli_fetch_row($res);
		if ($rw) {
			$sql = "UPDATE edu_zipcodes SET status=1 where id=$rw[0]";
			$values = mysqli_query($link, $sql);
		} else {
			$sql = "INSERT INTO edu_zipcodes (zipcode,lender_id,city,state,program_of_interest_code,campus_code,lng,lat,status) values ('$zipcode','$lender_id','$city','$state','$program','$campus_code','$lat','$lng',1);";
			echo $sql;
			echo '<br>';
			$values = mysqli_query($link, $sql);
		}
	}
}

//$values=mysql_query($sql);