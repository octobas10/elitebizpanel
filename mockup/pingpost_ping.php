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
<form method="POST" action="https://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/auto/pingprocess" enctype="multipart/form-data" target="_blank">
<?php
$ssn = rand(111111111,999999999);
$request ='promo_code=27&zip=35222&ssn='.$ssn.'&monthly_income=4200';

echo "<b>Please use this simulation to test any lender Post/Ping by giving your onw values.</b><br>";
echo "<table>";
echo "<tr><td colspan='2'><b>Ping URL : </b> <input type='text' readonly='readonly' size='70' value='https://".$_SERVER['HTTP_HOST'] .$link."/index.php/auto/pingprocess'/></td></td></tr>";
echo "<tr><td>Lead mode</td><td>Test<input type='radio' checked='checked' name='lead_mode' value='0'>
Live<input type='radio' name='lead_mode' value='1'></td></tr>";
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
<input type="submit" value="PING NOW"> 
<a target="_blank" href="pingpost_post.php?ssn=<?php echo $ssn?>">Send Post For this Ping, If you get success response on ping</a>
</form>
<!--$this->respond($context, 'Rejected'-->
