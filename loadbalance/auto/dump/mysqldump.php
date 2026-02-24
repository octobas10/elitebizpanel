<?php
$user='axiom';
$pass='7anAZewE';
$host='localhost';
ini_set('memory_limit','1280M');
ini_set("max_execution_time", "36000");
$tablename = $_GET['table'] ? $_GET['table'] : 'auto_feed_lenders';
$database = 'eliteautocash';
if(isset($tablename) && $tablename !=''){
	$cmd="/usr/bin/mysqldump --user=$user --password=$pass --host=localhost $database $tablename | gzip > /usr/virtual/www.elitebizpanel.com/www/loadbalance/database/$tablename.sql.gzip";

	exec($cmd, $output, $return);
	echo '<pre>.....';print_r($return);exit;
	if ($return != 0) {
		die('Error: ' . implode("\r\n", $output));
	}else{
		echo "dump complete";
	}
}else{
	echo "No Table Selected";

}
//https://elitebizpanel.com/loadbalance/auto/dump/mysqldump.php?table=email_creatives