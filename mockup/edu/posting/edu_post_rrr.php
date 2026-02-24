<?php
//echo $_SERVER["HTTP_HOST"].'=='.$_SERVER['HTTP_HOST'];exit;
if ($_SERVER['HTTP_HOST'] == '192.168.1.163') {
	$link = '/ElitePanel.com';
} elseif ($_SERVER['HTTP_HOST'] == 'staging.axiombpm.com') {
	$link = '/elitepanel.com';
} else {
	$link = '';
}
?>
<form method="POST" action="http://localhost/ecw/elitebizpanel.com/index.php/edu/postprocess" enctype="multipart/form-data" target="_blank">
	<input type="submit" name="submit" value="Ping/Post to Elite Auto">
	<?php
	$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 5);
	$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 5);

	$firstname = 'Nikita';
	$lastname = 'Patel';
	$email = 'nikita@elitmate.com';
	//$request ='lender_id=27&universal_leadid=95D04265-072A-1357-34A8-3B9190DE1D1D&promo_code=96&sub_id=46751_R7kPSGY2aJN&first_name=Nasir&last_name=Miller&email=nasir.iller'.rand(111,999).'@gmail.com&phone=3368583252&address=609+granby+ave&city=HIGH+POINT&state=AL&zip=02048&gender=M&mobile=3368583252&program_of_interest=AHS&are_you_a_registered_nurse=1&do_you_have_a_teaching_certificate=1&campus=SOUTH_UNI_ONL&military=0&ipaddress=172.70.211.84&tcpa_text=By+selecting+yes%2Fmaybe+and+clicking+%26quot%3BAgree+and+continue%26quot%3B%2C+I+consent+to+be+contacted+regarding+educational+opportunities+at+the+phone+number+provided%3A+%2C+using+an+automated+telephone+dialing+system%2C+pre-recorded+voice%2C+and+text+messaging.+I+may+be+contacted+by+Degree+Here%2CLaunch+Your+Degree%2C+Your+Degree+Helper+Consent+is+not+required+as+a+condition+of+using+this+service.ECPI+University+cannot+guarantee+employability+or+earning+potential+for+graduates.&education_level=2&desired_degree=3&url=https%3A%2F%2Fdegree-here.com%2F&dob=06/23/2005&grad_year=2023&lead_mode=1';
	//$request ='universal_leadid=2055FE56-BAC9-48D8-12AB-E330308FB591&promo_code=96&sub_id=46751_R7kPSGY2aJN&first_name=David&last_name=Jones&email=mr.djones2023@gmail.com&phone=2026298084&address=1118+N+Stewart+St&city=ARLINGTON&state=VA&zip=22201&gender=M&mobile=2026298084&program_of_interest=CYBNSBS&are_you_a_registered_nurse=1&do_you_have_a_teaching_certificate=1&campus=NORTHERNVIRGINIA%28MANASSAS%29&military=0&ipaddress=198.46.241.209&tcpa_text=By+selecting+yes%2Fmaybe+and+clicking+%26quot%3BAgree+and+continue%26quot%3B%2C+I+consent+to+be+contacted+regarding+educational+opportunities+at+the+phone+number+provided%3A+%2C+using+an+automated+telephone+dialing+system%2C+pre-recorded+voice%2C+and+text+messaging.+I+may+be+contacted+by+Degree+Here+Consent+is+not+required+as+a+condition+of+using+this+service.+ECPI+University+cannot+guarantee+employability+or+earning+potential+for+graduates.&education_level=2&desired_degree=6&url=https//degree-here.com&dob=01/03/1987&grad_year=2005&lead_mode=1';
	$rand = rand(111, 999);
	/* $request = 'lender_id=29&universal_leadid=FCBF128B-6231-C22B-22D5-B6312BE4ADF5&promo_code=96&sub_id=46731_R7kPtY2aJN&first_name=John&last_name=DoNotCall&email=john.donotcall.' . $rand . '@gmail.com&phone=6467077327&address=47+Celeste+LANE&city=Brampton&state=BC&zip=V6T 0A1&gender=M&mobile=6467077327&program_of_interest=FINMAN&are_you_a_registered_nurse=1&do_you_have_a_teaching_certificate=1&campus=POINTECLAIRE&military=0&ipaddress=199.180.10.223&tcpa_text=do+representatives+of+%26lt%3B+School+Name+%26gt%3B%2C+have+your+consent+to+contact+you+about+educational+opportunities+via+e-mail%2C+text%2C+or+phone+%E2%80%A6%E2%80%A6%E2%80%A6.+including+your+mobile+phone+if+provided%3F+These+calls+may+be+placed+using+an+automatic+dialer+or+prerecorded+messages+and+you+are+not+required+to+provide+this+consent+in+order+to+enroll.+Message+and+data+rates+may+apply.+You+may+withdraw+your+consent+at+any+time.+Please+reply+%E2%80%9CYes%E2%80%9D+to+provide+your+consent%3F&education_level=2&desired_degree=3&url=https://collegeinformationsources.com&grad_year=2023&dob=07/13/2004&lead_mode=1'; */


	echo "<b>Please use this simulation to test any lender Post/Ping by giving your onw values.</b><br>";
	echo "<table>";
	echo "<tr><td>Lead mode</td><td>Test<input type='radio' checked='checked' name='lead_mode' value='0'>
Live<input type='radio' name='lead_mode' value='1'></td></tr>";
	$posting_instruction = explode("&", $request);
	foreach ($posting_instruction as $string) {
		$newstring = explode("=", $string);
		echo "<tr>";
		echo "<td>" . ucfirst(str_replace("_", " ", $newstring[0])) . "</td>";
		echo "<td>" . '<input type="text" name="' . $newstring[0] . '" value="' . $newstring[1] . '">' . "</td>";;
		echo "</tr>";
	}
	echo "</table>";
	?>
	<input type="submit" value="Ping/Post to Elite Auto">
</form>
<!--$this->respond($context, 'Rejected'-->