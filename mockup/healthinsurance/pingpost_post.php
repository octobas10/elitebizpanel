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
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/healthinsurance/pingpostprocess

<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/healthinsurance/pingpostprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$ping_id = isset($_GET['ping_id'])?$_GET['ping_id']:40138;

$ins_expire_date =  date('Y-m-d',time()+(7*84600)); 
$ins_start_date =  date('Y-m-d',time()-(365*84600)); 

$request ='lender=Oceanbeachmedia&ping_id='.$ping_id.'& lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&vendor_lead_id=667597661&url=https://elitehealthinsurers.com&zip=99999&phone_last_4=0125&income=5700&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&is_rented=1&stay_in_year=3&stay_in_month=2&gender=M&trustedformcerturl=https://cert.trustedform.com/9440aef32d0418b593d4ae8e936a891204739ab4&marital_status=2&education_level=5&is_employed=1&occupation=12&is_student=1&height=186&weight=210&medical_condition=3&dui=0&requested_coverage_type=1&previously_denied=0&is_smoker=0&expectant_parent=0&relative_heart=0&relative_cancer=0&number_in_household=4&current_coverage_type=2&insurance_company=10&insurance_expiration_date='.$ins_expire_date.'&insurance_start_date='.$ins_start_date.'&url=https://elitehealthinsurers.com&first_name=Joe&last_name=Deo&email=joe.deo@example.com&address=4+Pennsylvania+Plaza&city=New+York&state=NY&phone=6105551212&phone2=7495215689&dob=1990-01-01&comments=nocomments';

/*$request ='ipaddress=164.109.64.48&tcpa_optin=1&tcpa_text=By+clicking+FINISH%2C+you+consent+to+being+contacted+by+one+or+more+of+our+partner+companies+regarding+their+products+and+services+at+the+phone+number%2Femail+provided%2C+including+a+wireless+number+if+provided.+Contact+methods+may+include+phone+calls+generated+using+automated+technology%2C+prerecorded+voice%2C+text+messaging+and%2For+email.+I+understand+that+consent+is+not+a+condition+of+purchase.+I+also+have+read+and+agree+to+the+Terms+and+Conditions+and+Privacy+Policy+of+this+website.&universal_leadid=F0A5A791-1CAB-2DC2-2484-002BD99DD003&trustedformcerturl=https%3A%2F%2Fcert.trustedform.com%2Ftest9734af96eb35test895000eed2436d40afb8985330b1test&first_name=Melody&last_name=Doves&address=345+E+5Th+St&zip=90011&email=mmdove26@yahoo.com&phone=9047244520&dob=1976-10-02&phone_last_4=&income=0&number_in_household=0&is_rented=1&stay_in_year=2&stay_in_month=1&gender=M&marital_status=1&occupation=123&education_level=9&is_student=0&weight=138&medical_condition=29&dui=0&previously_denied=0&expectant_parent=0&is_smoker=0&relative_heart=0&relative_cancer=0&requested_coverage_type=1&current_coverage_type=1&insurance_company=154&insurance_start_date=2019-04-26&user_agent=Mozilla%2F5.0+%28Linux%3B+Android+7.0%3B+SM-G892A+Build%2FNRD90M%3B+wv%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Version%2F4.0+Chrome%2F60.0.3112.107+Mobile+Safari%2F537.36&url=https%3A%2F%2Fcontractors99.com%2Flanding%2Fyp&is_employed=1&ping_id=1096941&lead_mode=1&sub_id=226&promo_code=6&insurance_expiration_date=2021-11-12&height=156';*/

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
