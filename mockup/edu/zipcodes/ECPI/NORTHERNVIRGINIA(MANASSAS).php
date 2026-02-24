<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['20640','20662','20105','20106','20109','20110','20111','20112','20115','20117','20119','20120','20121','20124','20129','20130','20132','20135','20136','20137','20141','20143','20144','20147','20148','20151','20152','20155','20158','20164','20166','20169','20170','20171','20175','20176','20180','20181','20184','20186','20187','20190','20191','20192','20194','20197','20198','22003','22015','22025','22026','22027','22030','22031','22032','22033','22039','22041','22042','22043','22044','22046','22060','22066','22067','22079','22101','22102','22124','22134','22150','22151','22152','22153','22172','22180','22181','22182','22191','22192','22193','22201','22202','22203','22204','22205','22206','22207','22209','22211','22213','22301','22302','22303','22304','22305','22306','22307','22308','22309','22310','22311','22312','22314','22315','22406','22433','22554','22556','22627','22639','22640','22642','22643','22712','22714','22716','22718','22720','22724','22726','22728','22734','22736','22737','22741','22742','22747'];
$lender_id='26';
$campus_code='NORTHERNVIRGINIA(MANASSAS)';
$programs = ['CLOUDCOM','CYBNSBS','DENTAL','MECHASSO','MECHATRO','MEDASST','MEDRAD','NETSECUR','PRACNURS','RN','SOFTDEVE','SOFTDVAS','SURTECH'];


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