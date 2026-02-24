<?php 
$limit = (!empty($_GET['limit'])) ? ' Limit '.$_GET['limit'] : '';
if($_SERVER['HTTP_HOST']=='192.168.1.163'){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$db = "staginga_elitepanel";
}else{
	$dbhost = "localhost";
	$dbuser = "axiom";
	$dbpass = "7anAZewE";
	$db = "eliteautocash";
}
$startdate = date("Y-m-d",strtotime("-90 days"));
$enddate = date("Y-m-d",strtotime("-97 days"));

$connection = mysql_connect($dbhost,$dbuser,$dbpass) or die('Connection to Database Server Error<br>'.mysql_error());
mysql_select_db($db,$connection) or die('Database Selection Error!');

$only_ping_cust_ids = "SELECT * FROM ( SELECT DISTINCT customer_id FROM auto_affiliate_transactions WHERE posting_type = 0 AND ping_request != '' AND post_request = '' AND date <= '$startdate 23:59:59' AND date >= '$enddate 00:00:00' $limit ) AS a";
$delete_query = "DELETE FROM `auto_submissions` WHERE id IN ($only_ping_cust_ids)";
$delete_result = mysql_query($delete_query);

/** Display count of deleted records */
$row_cnt_query = "SELECT ROW_COUNT()";
$row_cnt = mysql_query($row_cnt_query);
//echo'<pre>';print_r(mysql_fetch_array($row_cnt));echo'</pre>';


$cust_id_null = "SELECT * FROM ( SELECT id FROM auto_affiliate_transactions WHERE customer_id IS NULL AND date <= '$startdate 23:59:59' AND date >= '$enddate 00:00:00' $limit ) AS a";
$aff_delete = "DELETE FROM auto_affiliate_transactions WHERE id IN ($cust_id_null)";
mysql_query($aff_delete);

/** Display count of deleted records */
$row_cnt_query = "SELECT ROW_COUNT()";
$row_cnt = mysql_query($row_cnt_query);
//echo'<pre>';print_r(mysql_fetch_array($row_cnt));echo'</pre>';

