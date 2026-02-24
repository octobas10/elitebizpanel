<?php
//echo '$_SERVER["HTTP_HOST"]=='.$_SERVER['HTTP_HOST'];exit;
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
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/mortgage/pingprocess


<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/mortgage/pingprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$request ='lender=HSH&home_equity_type=2&mortgage_lead_type=3&lead_mode=1&promo_code=1&sub_id=112233&tcpa_optin=1&tcpa_text=We take your privacy seriously. By clicking the button, you agree to be matched with partners from our network including Quicken Loans and loanDepot, and consent (not required as a condition to purchase a good/service) for us and/or them to contact you (including through automated means; e.g. autodialing, text and pre-recorded messaging) via telephone, mobile device (including SMS and MMS), and/or email, even if you are on a corporate, state or national Do Not Call Registry. You agree that we can share your personal data with third parties, such as our mortgage partners, service providers and other affiliates, and that we can use this data for marketing and analytics, and to make your experience easier.&universal_leadid=5D81EB59-0057-D92B-E6EB-AEE3F0A871CD&trustedformcerturl=https://cert.trustedform.com/486cd2304371fa3c4ac32897f53a1ec41c87d89d&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36&vendor_lead_id=4d6dbada-a139-4b0b-87e8-e3ab8f33fe17&url=elitemortgagefinder.com&zip=90100&employment_type=1&income=3700&first_interest_rate=4&credit_rating=1&bankruptcy=0&loan_amount=187500&property_value=890000&down_payment=0&spec_home=0&buy_timeframe=3&agent_found=0&property_use=1&estimate_value=500000&num_mortgage_lates=0&va_loan=1&property_desc=1&first_balance=245000&additional_cash=53400&property_state=CA&property_zip=90100&dob=1950-12-29&loan_type=1&ltv_percentage=80';

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
<a target="_blank" href="pingpost_post.php?ping_id=">Send Post For this Ping, If you get success response on ping</a>
</form>
<!--$this->respond($context, 'Rejected'-->
