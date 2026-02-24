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
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/businessloans/pingprocess


<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/businessloans/pingprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
//Teapot
//QuinStreet
/* $request ='lender=Teapot&lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy......&universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&url=https://elitebusinessloans.com&zip=22942&ssn=023811492&employment_type=1&income=3700&credit_rating=1&is_rented=1&debt_amount=10000&how_long_in_business=2&how_much_want_borrow=100000&bank_name=Bank Of America&bank_aba=023412094&bank_account_number=2203492274274&bank_length_month=42&bank_account_type=1&direct_deposit=1&paycheck_date1=2025-08-03&paycheck_date2=2025-08-10&drivers_license_number=FA3274897&drivers_license_state=LA&other_income_amount=2000&job_title=accountant&rent_mortgage_payment=2200&vehicle_title=1&company_name=Walmart&work_phone=7192234612&comments=nocomments&dob=1990-12-12&trustedformcerturl=https://cert.trustedform.com/e1f90db30e5233566b2b6329c784ab1ed71adf20&first_name=Tony&last_name=Desena&email=tony.elitecashwire@gmail.com&phone=6105551212&address=4+Pennsylvania+Plaza&phone=9493680524&trustedformcerturl=https://cert.trustedform.com/e1f90db30e5233566b2b6329c784ab1ed71adf20'; */

$request = 'lender=Teapot&promo_code=1&sub_id=EBUSLOANSSS&sub_id2=1&ipaddress=84.239.47.19&universal_leadid=&url=https://elitebusinessloans.com&first_name=Thomas&last_name=Nelson&business_name=Transformations+Llc&industry_name=Business+Services+Nec&phone=2037485969&email=t.nelson@transformations.com&address=124+GREAT+PLAIN+RD&zip=06811&credit_rating=1&digital_signature=g&how_long_in_business=4&income=92000&loan_amount=46000&ssn=506609711&debt_amount=&employment_type=1&dob_Year=0&dob_day=&dob_month=&is_rented=0&bank_name=&bank_aba=&bank_account_number=&bank_account_type=0&direct_deposit=1&paycheck_year=0&paycheck_day=&paycheck_month=&payment_frequency=0&drivers_license_number=&drivers_license_state=&job_title=&other_income_amount=&rent_mortgage_payment=&submit=apply+now&xxTrustedFormToken=https://cert.trustedform.com/74630bb87b12b0fc0b9e0edbce00f98085c96105&xxTrustedFormPingUrl=https://ping.trustedform.com/0.dOAzUUsKSX-T36j9MoQqOtv-pa5G5TNcUDZiDwRT5vRXH-RmRAJf7tQDwnRmlGAxHf3w5sE._XXub8TP05gHSYJJiEm2TQ.zkNdElLPnNzNMmhNKOCwbw&paycheck_date1=1969-12-31&paycheck_date2=1969-12-31&lead_mode=1&trustedformcerturl=https://cert.trustedform.com/74630bb87b12b0fc0b9e0edbce00f98085c96105&dob=1969-12-31&datetime_stamp=2025-11-13';

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
