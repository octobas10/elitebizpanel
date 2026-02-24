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
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/homeimprovement/pingpostprocess

<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/homeimprovement/pingpostprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$ping_id = $_GET['ping_id'];
$firstname = 'tony';
$lastname = 'desena';
$request ='lender=ExpressRevenue&ping_id='.$ping_id.'&lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=C900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=108.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&zip=01472&first_name='.$firstname.'&last_name='.$lastname.'&email='.$firstname.'.'.$lastname.'@gmail.com&address=4+Pennsylvania+Plaza&phone=7189381203&phone2=7189381203&dob=1985-10-10&project_type=13&task=13_3&project_provider=4&monthly_bill=5&flooring_type=2&room_type=1&number_of_rooms=1&property_type=1&air_type=1&air_sub_type=1&number_of_floors=1&number_of_windows=1&window_style=1&window_age=1&window_condition=1&plumbing_type=5&roof_type=2&roof_shade=3&credit_rating=1&time_frame=1&home_owner=1&project_status=1&loan_amount=100000&comments=nocomments&url=https://elitehomeimprovers.com&trustedformcerturl=https://cert.trustedform.com/79146380b5747bdcdf1cc283513a237ba1404566&city=Ketchikan&state=AK&job_type=2&siding_type=2&roofing_type=2';

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
