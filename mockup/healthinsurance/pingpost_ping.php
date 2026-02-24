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
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/healthinsurance/pingprocess


<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/healthinsurance/pingprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$ins_expire_date =  date('Y-m-d',time()+(7*84600)); 
$ins_start_date =  date('Y-m-d',time()-(365*84600)); 

/*$request ='lender=Oceanbeachmedia&lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&vendor_lead_id=667597661&url=https://elitehealthinsurers.com&zip=99999&phone_last_4=0125&income=5700&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&is_rented=1&stay_in_year=3&stay_in_month=2&gender=M&trustedformcerturl=https://cert.trustedform.com/9440aef32d0418b593d4ae8e936a891204739ab4&marital_status=2&education_level=5&is_employed=1&occupation=12&is_student=1&height=186&weight=210&medical_condition=3&dui=0&requested_coverage_type=1&previously_denied=0&is_smoker=0&is_smoker=0&expectant_parent=0&relative_heart=0&relative_cancer=0&number_in_household=4&current_coverage_type=2&insurance_company=10&insurance_expiration_date='.$ins_expire_date.'&insurance_start_date='.$ins_start_date.'&url=https://elitehealthinsurers.com&dob=1990-01-01&comments=nocomments';*/


$request ='lender=Sunshine&lead_mode=1&promo_code=1&sub_id=498083/1004714/&tcpa_optin=1&tcpa_text=By clicking FINISH, you consent to being contacted by one or more of our partner companies regarding their products and services at the phone number/email provided, including a wireless number if provided. Contact methods may include phone calls generated using automated technology, prerecorded voice, text messaging and/or email. I understand that consent is not a condition of purchase. I also have read and agree to the Terms and Conditions and Privacy Policy of this website.&universal_leadid=C3D3207F-A9F6-8067-0E2F-0AA83DDF7D3B&ipaddress=208.198.177.144&user_agent=Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0; Trident/4.0; GTB7.4; InfoPath.3; SV1; .NET CLR 3.1.76908; WOW64; en-US)&vendor_lead_id=L02A9-124CF4A&url=https://medicareplan.com&zip=78374&phone_last_4=&income=85000&trustedformcerturl=&occupation=74&is_rented=1&stay_in_year=5&stay_in_month=05&gender=M&dob=1990-02-20&marital_status=1&education_level=4&is_employed=1&is_student=0&height=165&weight=175&medical_condition=29&dui=0&requested_coverage_type=1&previously_denied=0&is_smoker=0&expectant_parent=0&relative_heart=0&relative_cancer=0&number_in_household=2&current_coverage_type=1&insurance_company=1&insurance_expiration_date=2024-12-26&insurance_start_date=2017-10-26';




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
<a target="_blank" href="pingpost_post.php?ping_id=1234">Send Post For this Ping, If you get success response on ping</a>

<input type="submit" value="Ping/Post to Elite Auto"> 
</form>
<!--$this->respond($context, 'Rejected'-->
