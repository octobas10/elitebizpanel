<?php
phpinfo();
exit;

setcookie("firstname",'Devang',time()+86400,'elitebizpanel.com');
setcookie("lastname",'Parekh',time()+86400,'elitebizpanel.com');
if($_REQUEST['action']=='backme'){
	$fname = json_encode($_COOKIE);
	header('location:http://192.168.1.161/test/test.php?fname='.$fname.'&test=testing');
}
exit;
