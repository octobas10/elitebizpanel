<?php
$table = basename($_SERVER["SCRIPT_FILENAME"],'.php');
$file_name= "commitpoint/$table.txt";
file_exists(getcwd().'/'.$file_name)?($fh=fopen($file_name,'r+') AND $start_point=fgets($fh)) : ($fh = fopen($file_name,'w') AND fwrite($fh,'0') AND $start_point=0);

if($start_point >= 347540546){
	echo 'over';
	exit;
}
//---------------------------------------------------//
$host = 'localhost';
$db ='elitedebt';
if($_SERVER['REMOTE_ADDR'] == '::1'){
	$user = 'root';
	$pass = '12345678';
}else{
	$user = 'axiom';
	$pass = '7anAZewE';
}
ini_set('memory_limit','320M');
ini_set("max_execution_time", "3000");
$link = mysqli_connect($host,$user,$pass,$db) or die("Can not connect." . mysqli_error());
$limits = 10;

$fileds = '`id`,`post_response`';
$qry = "SELECT $fileds FROM $table WHERE `id` > $start_point AND lender_id=4 AND post_status=1 LIMIT $limits";
echo $qry;
$result = mysqli_query($link,$qry);
if($result){
	while ($row = mysqli_fetch_array($result)) {
		$post_response = json_decode($row['post_response']);
		if(isset($post_response->Status) && $post_response->Status == 'Success'){
			$commision = $post_response->Commision;
			$sSql = "UPDATE $table SET ping_price=$commision,post_price=$commision where id = $row[id]";
			//echo $sSql;echo '<br>';
			mysqli_query($link,$sSql);
		}
	}
	rewind($fh);
	ftruncate($fh,filesize($file_name));
	fwrite($fh, ($start_point + $limits));
	fclose($fh);
}

//---------------------------------------------------//