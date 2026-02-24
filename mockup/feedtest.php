<?php
//echo '$_SERVER["HTTP_HOST"]=='.$_SERVER['HTTP_HOST'];
if($_SERVER['HTTP_HOST'] =='192.168.1.163'){
	$link = '/ElitePanel.com';
}elseif($_SERVER['HTTP_HOST'] =='staging.axiombpm.com'){
	$link = '/elitepanel.com';
}else{
	$link = '';
}
?>
<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/auto/feedpostProcess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit1" value="Post to Elitecashwire(dev)"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
list($pday1,$pmonth1,$pyear1) = explode("-",date("d-m-Y",time()+86400));
list($pday2,$pmonth2,$pyear2) = explode("-",date("d-m-Y",time()+((86400)*30)));
$request ='sub_id=abc123&vendor_id=1&first_name='.$firstname.'&last_name='.$lastname.'&email=mahesh@elitemate.com&gender=M&address=14&city=JACKSONVILLE&state=CA&zip=4544&phone=0370105678&cell=9876543210&dob=15/11/1987&source=www.elitecashwire.com&REMOTE_ADDR='.$_SERVER['HTTP_HOST'];
echo "<b>Please use this simulation to test any lender Post/Ping by giving your onw values.</b><br>";
echo "<table>";
$posting_instruction = explode("&",$request);
foreach ($posting_instruction as $string){
	$newstring = explode("=",$string);
	echo "<tr>";
	echo "<td>".ucfirst(str_replace("_"," ",$newstring[0]))."</td>";
	echo "<td>".'<input type="text" name="'.$newstring[0].'" value="'.$newstring[1].'">'."</td>";;	
	echo "</tr>";
}
echo "</table>";
?>
<input type="submit" value="Post to Elite Auto"> 
</form>
<!--$this->respond($context, 'Rejected'-->
