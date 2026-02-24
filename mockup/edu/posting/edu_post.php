<?php
//echo '$_SERVER["HTTP_HOST"]=='.$_SERVER['HTTP_HOST'];
if($_SERVER['HTTP_HOST'] =='192.168.1.163'){
	$link = '/ElitePanel.com';
}elseif($_SERVER['HTTP_HOST'] =='staging.axiombpm.com'){
	$link = '/elitepanel.com';
}else{
	$link = '';
}
?>
<form method="POST" action="http://localhost/elitebizpanel.com/index.php/edu/postprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$request ='5AC3E63EEE5C&promo_code=96&sub_id=767_ATECH&first_name=DONALD&last_name=HYLTON&email=donaldhylton@gmail.com&phone=7325568855&address=401+w+sylvania+ave&city=NEPTUNE&state=NJ&zip=07753&gender=M&mobile=7325568855&program_of_interest=HMB&are_you_a_registered_nurse=0&do_you_have_a_teaching_certificate=0&campus=MDL&military=0&ipaddress=148.74.133.145&tcpa_text=Do+representatives+of+Berkeley+College+%2C+have+your+consent+to+contact+you+about+educational+opportunities+via+e-mail%2C+text%2C+or+phone%2C+including+your+mobile+phone+if+provided%3F+These+calls+may+be+placed+using+an+automatic+dialer+or+prerecorded+messages+and+you+are+not+required+to+provide+this+consent+in+order+to+enroll.+Message+and+data+rates+may+apply.+You+may+withdraw+your+consent+at+any+time.+Please+reply+Yes+to+provide+your+consent.+%3F+%28Must+be+a+clear+yes%29.+You+understand+that+this+consent+is+not+a+condition+of+purchase+and+that+you+may+revoke+this+consent+at+any+time.&education_level=2&desired_degree=3&grad_year=1998&dob=05%2F05%2F1963&lead_mode=1&repost=1';

$request .= '&repost=1&sub_id=123&gender=M';

echo "<b>Please use this simulation to test any lender Post/Ping by giving your onw values.</b><br>";
echo "<table>";
echo "<tr><td>Lead mode</td><td>Test<input type='radio' checked='checked' name='lead_mode' value='0'>
Live<input type='radio' name='lead_mode' value='1'></td></tr>";
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
