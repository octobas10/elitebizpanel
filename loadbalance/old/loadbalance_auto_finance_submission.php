<meta http-equiv="Refresh" content="1;url=<?=$_SERVER['PHP_SELF'] ?>" />
<?php
$file_name= $_SERVER['DOCUMENT_ROOT'].'/loadbalance/commitpoint/auto_submissions.txt';
$hand = fopen($file_name, 'r+');
$line = fgets($hand);
$start_point = $line ? $line : 0;
//---------------------------------------------------//
if($start_point >= 26500000){
	echo 'over';
	exit;
}
$host = 'localhost';
$user = 'axiom';
$pass = '7anAZewE';
$db = 'eliteautocash';
$file = 'Export';
ini_set('memory_limit','320M');
ini_set("max_execution_time", "3000");
$link = mysqli_connect($host, $user, $pass, $db) or die("Can not connect." . mysqli_error());

$limits = 200000;
//---------------------------------------------------//
$qry="REPLACE INTO backup_auto_submissions SELECT * FROM auto_submissions WHERE `id` > $start_point LIMIT $limits";

//echo $qry;exit;

$result = mysqli_query($link,$qry);

if($result){
	$sSql = "DELETE FROM auto_submissions where id > $start_point LIMIT $limits";
	mysqli_query($link,$sSql);
	rewind($hand);
	ftruncate($hand, filesize($file_name));
	fwrite($hand, ($start_point + $limits));
	fclose($hand);
}
//---------------------------------------------------//
?>