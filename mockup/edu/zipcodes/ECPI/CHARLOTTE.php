<?php
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());

$zipcodes = ['28006','28012','28016','28025','28026','28027','28031','28032','28034','28035','28036','28037','28052','28053','28054','28055','28056','28070','28075','28077','28078','28079','28080','28081','28098','28101','28104','28105','28106','28107','28108','28110','28117','28120','28123','28126','28130','28134','28164','28201','28202','28203','28204','28205','28206','28207','28208','28209','28210','28211','28212','28213','28214','28215','28216','28217','28218','28219','28220','28221','28222','28223','28224','28226','28227','28228','28229','28230','28231','28232','28233','28234','28235','28236','28237','28241','28242','28243','28244','28246','28247','28250','28253','28254','28255','28256','28258','28260','28262','28263','28265','28266','28269','28270','28271','28272','28273','28274','28275','28277','28278','28280','28281','28282','28284','28285','28287','28288','28289','28290','28296','28297','28299','28682','29703','29707','29708','29710','29715','29716','29731','29733','29734','29744'];
$lender_id='26';
$campus_code='CHARLOTTE';
$programs = ['CLOUDCOM','CYBNSBS','EET','EETBS','MECHASSO','MECHATRO','MEDASSDP','MEDASST','NETSECUR','PRACNURS','RN'];


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