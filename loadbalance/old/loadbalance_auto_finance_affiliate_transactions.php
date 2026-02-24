<meta http-equiv="Refresh" content="1;url=<?=$_SERVER['PHP_SELF'] ?>" />
<?php
$file_name= $_SERVER['DOCUMENT_ROOT'].'/loadbalance/commitpoint/auto_affiliate_transactions.txt';
$hand = fopen($file_name, 'r+');
$line = fgets($hand);
$start_point = $line ? $line : 0;
//---------------------------------------------------//
if($start_point >= 289527201){
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
$link = mysqli_connect($host,$user,$pass,$db) or die("Can not connect." . mysqli_error());

$limits = 500000;
//---------------------------------------------------//
$qry="REPLACE INTO backup_auto_affiliate_transactions_1 SELECT * FROM auto_affiliate_transactions WHERE `id` > $start_point LIMIT $limits";

echo $qry;
echo '<br>';

$result = mysqli_query($link,$qry);

if($result){
	echo  $sSql = "DELETE FROM auto_affiliate_transactions where id > $start_point LIMIT $limits";
	mysqli_query($link,$sSql);
	rewind($hand);
	ftruncate($hand, filesize($file_name));
	fwrite($hand, ($start_point + $limits));
	fclose($hand);
}
//---------------------------------------------------//
?>