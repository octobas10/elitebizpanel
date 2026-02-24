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
Action : https://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/homeimprovement/postprocess

<form method="POST" action="https://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/homeimprovement/postprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$ping_id = isset($_GET['ping_id'])?$_GET['ping_id']:40138;
$request ='lender=AstoriaCompany&lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&first_name=Joe&last_name=Deo&email=joe.deo@example.com&address=4+Pennsylvania+Plaza&phone=6105551212&phone2=7495215689&dob=01/01/1980&zip=22942&project_type=45&task=1_5&project_provider=5&monthly_bill=5&property_type=2&roof_type=2&roof_shade=3&credit_rating=1&time_frame=0&home_owner=1&project_status=1&loan_amount=100000&comments=nocomments&url=https://elitehomeimprovers.com';
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
