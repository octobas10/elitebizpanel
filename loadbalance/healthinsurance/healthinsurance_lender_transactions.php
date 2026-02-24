<meta http-equiv="Refresh" content="1;url=<?=$_SERVER['PHP_SELF'] ?>" />
<?php
$table = basename($_SERVER["SCRIPT_FILENAME"],'.php');
//$table = basename(__FILE__);
$file_name= "commitpoint/$table.txt";
file_exists(getcwd().'/'.$file_name)?($fh=fopen($file_name,'r+') AND $start_point=fgets($fh)) : ($fh = fopen($file_name,'w') AND fwrite($fh,'0') AND $start_point=0);

if($start_point >= 138936739){
	echo 'over';
	exit;
}
//---------------------------------------------------//
$host = 'localhost';$user = 'axiom';$pass = '7anAZewE';$db = 'elitehealthinsurance';
ini_set('memory_limit','320M');
ini_set("max_execution_time", "3000");


$link = mysqli_connect($host,$user,$pass,$db) or die("Can not connect." . mysqli_error());
$limits = 200000;
//---------------------------------------------------//

$id = 'id';
echo $qry="REPLACE INTO ".'backup_'.$table." SELECT * FROM $table WHERE `$id` > $start_point LIMIT $limits";
$result = mysqli_query($link,$qry);

if($result){
	$sSql = "DELETE FROM $table where $id > $start_point LIMIT $limits";
	//echo $sSql;echo '<br>';
	mysqli_query($link,$sSql);
	rewind($fh);
	ftruncate($fh,filesize($file_name));
	fwrite($fh, ($start_point + $limits));
	fclose($fh);
}

//---------------------------------------------------//