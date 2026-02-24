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
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/debt/postprocess

<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/debt/postprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$ping_id = isset($_GET['ping_id'])?$_GET['ping_id']:40138;
$request ='lender=Turbo&lead_mode=1&promo_code=1&sub_id=2995&datetime_stamp=2025-02-26+11%3A49%3A39&tcpa_optin=1&tcpa_text=By+clicking+the+button+above+and+submitting+your+information+you+are+providing+your+electronic+signature+in+which+you+consent%2C+acknowledge+and+agree+to+the+following%3A+%28a%29+You+agree+to+our+Privacy+Policy+and+Terms+of+Use+that+includes+binding+arbitration+and+consent+to+receive+notices+and+other+communications+electronically.+%28b%29+You+are+providing+express+written+consent+for+us+to+share+your+information+and+connect+you+with+up+to+4+of+our+Premier+Partners.+%28c%29+You+also+give+us+consent+to+share+your+information+with+and+connect+you+to+4+home+services%2C+insurance+and+solar+partners+regarding+related+consumer+services+and+products.+%28d%29+You+give+consent+for+us%2C+or+them+and+authorized+third+parties+calling+on+our%2C+or+their+behalf%2C+to+contact+you+for+marketing+purposes+through+automated+means+%28e.g.+automatic+telephone+dialing+system%2C+SMS%2FMMS+text%2C+artificial+and+pre-recorded+voice+messaging%29+at+the+number%28s%29+and+at+the+email+address+you+have+provided+via+telephone%2C+mobile+device+%28including+SMS+and+MMS%29%2C+even+if+your+telephone+number+is+currently+listed+on+any+state%2C+federal+or+corporate+Do+Not+Call+registry.+You+may+opt-out+from+SMS+or+Text+messages+at+any+time+by+replying+STOP.+Data+and+Msg+rates+may+apply.+You+are+not+required+to+provide+consent+as+a+condition+to+purchase+goods+or+services+and+you+may+revoke+consent+at+any+time.&universal_leadid=3E8507EA-D733-C9DF-5C9D-C86FA72DE324&trustedformcerturl=https%3A%2F%2Fcert.trustedform.com%2Fe8906f59da6f347e5ce13fd0d4f2126487fd132a&ipaddress=172.56.121.12&user_agent=Mozilla%2F5.0+%28Linux%3B+Android+10%3B+moto+g%287%29+power+Build%2FQCOS30.85-18-10%3B+wv%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Version%2F4.0+Chrome%2F132.0.6834.74+Mobile+Safari%2F537.36+%5BFB_IAB%2FFB4A%3BFBAV%2F495.0.0.45.201%3BIABMV%2F1%3B%5D&vendor_lead_id=5BA41476&url=govhomeprograms.com&first_name=CAROL&last_name=MORENO&email=carolbellmoreno@gmail.com&address=31917+MARACITE+LANE&phone=6617534155&zip=91384&ssn=000000000&employment_type=1&income=60000&credit_rating=3&dob=15/12/2000&is_rented=1&debt_amount=15000';
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
