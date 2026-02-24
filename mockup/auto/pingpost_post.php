<?php
//echo '$_SERVER["HTTP_HOST"]=='.$_SERVER['HTTP_HOST'];
if($_SERVER['HTTP_HOST'] == 'elitebizpanel.com'){
	$link = '';
}else if($_SERVER['HTTP_HOST'] =='192.168.1.163'){
	$link = '/ElitePanel.com';
}elseif($_SERVER['HTTP_HOST'] =='staging.axiombpm.com'){
	$link = '/elitepanel.com';
}else{
	$link = '/ecw/elitebizpanel.com';
}
?>
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/auto/pingpostprocess

<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/auto/pingpostprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$ssn = $_GET['ssn'];
$request ='lender=DummyLender1&ping_id=1234&promo_code=1&sub_id=1282&first_name='.$firstname.'&last_name='.$lastname.'&gender=M&dob=05/07/1986&email='.$firstname.$lastname.'@gmail.com&phone=2124656741&address=4+Pennsylvania+Plaza&zip=35222&city=Schenectady&state=NY&mobile=9724473839&is_rented=rent&stay_in_month=05&stay_in_year=02&home_pay=200&employer=EliteCashWire&job_title=Developer&employment_in_month=01&employment_in_year=01&monthly_income=4000&ssn='.$ssn.'&bankruptcy=0&ipaddress=127.0.0.1&cosigner=1&agree_credit_check=1&url=https://eliteautocash.com&universal_leadid=4xyz78b9-0cdc-43a7-98ea-2b680a5313a2';
echo "<b>Please use this simulation to test any lender Post/Ping by giving your onw values.</b><br>";
echo "<table>";
echo "<tr><td>Lead mode</td><td>Test<input type='radio' name='lead_mode' value='0'>
Live<input type='radio' name='lead_mode' value='1' checked='checked' ></td></tr>";
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
<input type="submit" value="Ping/Post to Elite Auto"> 
</form>
<!--$this->respond($context, 'Rejected'-->
