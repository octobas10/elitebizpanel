<?php
$user='axiom';
$pass='7anAZewE';
$host='localhost';

ini_set('memory_limit','1280M');
ini_set("max_execution_time", "36000");

$tablename = $_GET['table'] ? $_GET['table'] : 'auto_feed_lenders';
$database = 'eliteautoinsurance';
if(isset($tablename) && $tablename !=''){
$cmd="/usr/bin/mysqldump --user=$user --password=$pass --host=localhost $database $tablename | gzip > /usr/virtual/www.elitebizpanel.com/www/loadbalance/database/$tablename.sql.gzip";
//var_dump($cmd);exit;
exec($cmd, $output, $return);
//print_r($return);
if ($return != 0) { //0 is ok
    die('Error: ' . implode("\r\n", $output));
}
echo "dump complete";
}else{
	echo "No Table Selected";
}
//http://localhost/vipul/mysqldump.php?table=elitemate_data_from_rich_1