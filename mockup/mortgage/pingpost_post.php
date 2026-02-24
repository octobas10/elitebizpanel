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
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/mortgage/pingpostprocess

<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/mortgage/pingpostprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$ping_id = $_GET['ping_id'];

$request ='lender=HSH&home_equity_type=2&mortgage_lead_type=3&ping_id='.$ping_id.'&lead_mode=1&promo_code=1&sub_id=112233&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&url=https://elitemortgagefinder.com&first_name=Joe&last_name=Deo&email=jwackens@gmail.com&address=4+Pennsylvania+Plaza&phone=6105551212&phone2=7495215689&zip=90100&dob=1992-07-06&employment_type=1&income=3700&credit_rating=1&bankruptcy=0&loan_amount=187500&property_value=890000&down_payment=10&spec_home=1&buy_timeframe=1&agent_found=0&property_state=CA&property_zip=90100&property_use=1&property_desc=1&estimate_value=1500000&rate_type=1&ltv_percentage=80&bank_foreclosure=0&num_mortgage_lates=1&va_loan=1&comments=nocomments&first_interest_rate=4.50&second_interest_rate=6.50&first_balance=245000&second_balance=13500&dob=1969-12-31&additional_cash=53400&trustedformcerturl=https://cert.trustedform.com/80778e3aa3f7c2ea738e8ca3c62ca179913d6191&universal_leadid=AA8F4EE4-E5F4-3016-5468-C1FF635A7C30';



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
