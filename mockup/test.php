<?php
echo $_SERVER['REMOTE_ADDR'];
echo '<br>';
echo $_SERVER['SERVER_ADDR'];
if($_SERVER['REMOTE_ADDR']=='192.168.1.188' && $_SERVER['SERVER_ADDR']=='192.168.1.188'){
	echo 'just before get lenders';exit;
}