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
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/homeimprovement/pingprocess


<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/homeimprovement/pingprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php

$request ='lender=ELocal&lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=C900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=108.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&zip=01472&dob=1985-10-10&project_type=24&task=24_2&project_provider=4&monthly_bill=5&flooring_type=2&room_type=1&number_of_rooms=1&property_type=1&air_type=1&air_sub_type=1&number_of_floors=1&number_of_windows=1&window_style=1&window_age=1&window_condition=1&plumbing_type=5&roof_type=2&roof_shade=3&credit_rating=1&time_frame=1&home_owner=1&project_status=1&loan_amount=100000&comments=nocomments&url=https://www.elitehomeimprovers.com&trustedformcerturl=https://cert.trustedform.com/79146380b5747bdcdf1cc283513a237ba1404566&roofing_type=2&city=Ketchikan&state=MA&job_type=2&siding_type=2';

//$request = 'property_type=2&tcpa_optin=1&comments=Repair - Roofing: Asphalt shingle&promo_code=5&zip=80817&sub_id=1013179&project_type=42&time_frame=1&project_status=1&universal_leadid=A3729424-DBED-A9B2-9E26-1275A78916C4&url=https://bestamericanroofs.com&trustedformcerturl=https://cert.trustedform.com/cbbf8f1316913cdbc43910d939167dea5e1f36be&task=42_1&lead_mode=1&roofing_type=1&home_owner=1&tcpa_text=By submitting this form, I expressly consent to be contacted by a partner in the AcquireCrowd Network with materials for services via direct or electronic mail, phone calls to the phone number provided, text/SMS messages, via automatic/automated dialing system(s), and pre-recorded messages. Consent is not a condition of purchase and may be revoked at any time.&vendor_lead_id=nsz74zf7cnpvm&ipaddress=71.211.144.182&credit_rating=2&user_agent=Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6';

/*

/*$request = 'lender=BlueinkDigital&lead_mode=1&promo_code=1&sub_id=16261878&tcpa_optin=1&tcpa_text=By submitting this form, I consent to receive calls to any wireless or landline telephone number I provide, including live, prerecorded, artificial-voice and autodialed calls, as well as text messages and emails, from up to 5 partners in solar and home improvement,even if your telephone or mobile number is currently listed on any state, federal, or corporate Do Not Call list, I understand that this consent is not required as a condition of purchasing any property, goods or services. Message and data rates may apply. I also have read and agree to the Terms and Conditions and Privacy Policy of this website.&universal_leadid=1356B599-D407-265E-9441-C023426893C4&ipaddress=99.99.4.140&zip=33417&project_type=45&task=45_1&credit_rating=2&time_frame=1&home_owner=1&project_status=0&comments=0&city=WEST PALM BEACH&state=FL&loan_amount=10000&project_provider=1&monthly_bill=6&property_type=1&roof_type=1&roof_shade=1&trustedformcerturl=https://cert.trustedform.com/0e3dd501e6adb2be781389434fc420fd1c61d452&user_agent=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36&vendor_lead_id=W_X1LK042Q&url=https://esolarquotes.com&flooring_type=2&room_type=1&number_of_rooms=1&property_type=1&air_type=1&air_sub_type=1&number_of_floors=1&number_of_windows=1&window_style=1&window_age=1&window_condition=1
&roof_type=2&roof_shade=3';

$request = 'lender=Netway&lead_mode=1&promo_code=2&sub_id=1104, hba_A836&tcpa_optin=1&tcpa_text=By clicking&universal_leadid=47826320-148E-BA50-99CF-71CDF9E39DC9&ipaddress=65.27.210.166&zip=38063&project_type=13&task=13_4&credit_rating=1&time_frame=2&home_owner=1&project_status=1&comments=0&city=RIPLEY&state=TN&loan_amount=10000&trustedformcerturl=https://cert.trustedform.com/b90c4857b7a7bf4f9faed5ce8c182cee4f590bd0&user_agent=Mozilla/5.0 (iPhone; CPU iPhone OS 16_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1&vendor_lead_id=W_KW800624&url=https://home-revivals.us';

$request ='lender=Veerus&lead_mode=1&promo_code=1&sub_id=257&tcpa_optin=1&tcpa_text=By clicking submit I agree to the Terms of Service and Privacy Policy and authorize up to 4 companies, their contractors and partners to contact me with offers about their product or services by telephone calls and emails and artificial voice, and pre-recorded and text messages and using an automated telephone technology, to the number and email I provided above&universal_leadid=A56D38E0-686D-3BAD-2890-87916D8F55C3&ipaddress=174.231.23.179&zip=86406&project_type=45&task=45_1&credit_rating=2&time_frame=1&home_owner=1&project_status=1&comments=0&city=LAKE HAVASU CITY&state=AZ&loan_amount=10000&project_provider=1&monthly_bill=5&property_type=1&roof_type=1&roof_shade=0&trustedformcerturl=https://cert.trustedform.com/35613b52819782f2a09174dd6146a27b1e275867&user_agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/530.35 (KHTML, like Gecko) Chrome/80.0.4000.100 Safari/530.35&vendor_lead_id=316455807&url=https://homeappointments.com';*/

//$request ='lender=Homeappointments&property_type=2&tcpa_optin=1&comments=New+roof+for+new+home+-+Roofing%3A+Other&promo_code=5&zip=33619&sub_id=1013179&project_type=42&time_frame=1&project_status=1&universal_leadid=A7C6F224-7D45-5A00-24A0-A987C5B1FA80&url=https%3A%2F%2Fwww.homepros123.com%2F&trustedformcerturl=https%3A%2F%2Fcert.trustedform.com%2Fe36606325f33acd7a07cdb8010bd2e720df487a9&task=42_9&lead_mode=1&roofing_type=1&home_owner=1&tcpa_text=By+checking+this+box+and+submitting+my+request%2C+I+confirm+that+I+have+read+and+agree+to+the+Terms+of+Use+and+Privacy+Policy+of+this+site+and+that+I+consent+to+receive+marketing+emails%2C+phone+calls%2C+and%2For+text+messages+from+%23%23%23%23%23%23%23%23%23%23+and+its+network+of+home+service+professionals+and+marketing+partners+at+any+telephone+number+or+email+address+provided+by+me%2C+including+my+wireless+number%2C+if+provided.+I+understand+there+may+be+a+charge+by+my+wireless+carrier+for+such+communications.+I+understand+these+communications+may+be+generated+using+an+automatic+telephone+dialing+system+and+may+contain+pre-recorded+messages+relating+to+the+product+and%2For+service+I+am+inquiring+about+to+the+number+I+provided+above.+Consent+is+not+required+to+utilize+services.+I+understand+that+this+authorization+overrides+any+previous+registrations+on+a+federal+or+state+Do+Not+Call+registry.&vendor_lead_id=w8dt5mv7p3hr&ipaddress=147.182.204.218&credit_rating=2&user_agent=Mozilla%2F5.0+%28Windows+NT+10.0%3B+Win64%3B+x64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F119.0.0.0+Safari%2F537.36';

//$request = 'tcpa_optin=1&tcpa_text=By checking this box and submitting my request, I confirm that I have read and agree to the Terms of Use and Privacy Policy of this site and that I consent to receive emails, phone calls and/or text message offers and its network of home service professionals and marketing partners at any telephone number or email address provided by me, including my wireless number, if provided. I understand there may be a charge by my wireless carrier for such communications. I understand these communications may be generated using an autodialer and may contain pre-recorded messages and that consent is not required to utilize services. I understand that this authorization overrides any previous registrations on a federal or state Do Not Call registry.&ipaddress=172.56.184.132&user_agent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9&url=https://www.contractors99.com/landing/yp&zip=95060&monthly_bill=4&roof_shade=3&credit_rating=2&time_frame=1&home_owner=Y&lead_mode=1&promo_code=21&sub_id=710&datetime_stamp=2024-06-05 14:09:58&universal_leadid=1EFE6C9C-15F6-9A98-B96B-EDEB3E09B550&vendor_lead_id=&project_type=45&task=45_1&property_type=1&roof_type=1&trustedformcerturl=https://cert.trustedform.com/c6787586ffee57ce8a3224b35ea4234e3a6a0295&project_provider=1&project_status=2';


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
