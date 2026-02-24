<?php
//echo $_SERVER["HTTP_HOST"].'=='.$_SERVER['HTTP_HOST'];exit;
if($_SERVER['HTTP_HOST'] =='192.168.1.163'){
	$link = '/ElitePanel.com';
}elseif($_SERVER['HTTP_HOST'] =='staging.axiombpm.com'){
	$link = '/elitepanel.com';
}else{
	$link = '';
}
//SELECT * FROM `edu_zipcodes` WHERE `zipcode` ='08609' and `campus_code`='MDL'  and `status`=1


//SELECT A.lender_id,A.campus_code,B.Code,B.name FROM `edu_zipcodes` AS A,program_of_interest_tribeca AS B WHERE A.`program_of_interest_code` = B.Code and B.status = 1 and A.status = 1 and A.lender_id = 15 GROUP BY  A.campus_code,B.Code 


//SELECT A.`status`, B.Code,B.name FROM `edu_zipcodes` AS A,program_of_interest_tribeca AS B WHERE A.`program_of_interest_code` = B.Code and B.status = 0 and lender_id = 15 and A.`status`=1

//UPDATE `edu_zipcodes` AS A,program_of_interest_tribeca AS B SET A.status = 0 WHERE A.`program_of_interest_code` = B.Code and B.status = 0 and lender_id = 15 and A.`status`=1

//SELECT A.lender_id,A.campus_code,B.Code,B.name FROM `edu_zipcodes` AS A,program_of_interest_tribeca AS B WHERE A.`program_of_interest_code` = B.Code and B.status = 0 and A.status = 1 and A.lender_id = 15 




?>
<form method="POST" action="https://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/edu/postprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$firstname ='Nikita';$lastname ='Patel';
$email ='nikita@elitmate.com';

$request ='universal_leadid=C1CB9B44-845F-481F-983F-A510A966A327&promo_code=96&sub_id=767_ATECH&first_name=MATEO&last_name=ACEVEDO&email=Mateoacevedo.7%40hotmail.com&phone=9176640407&address=33-33+82+st&city=NEW+YORK&state=NY&zip=10024&gender=M&mobile=9176640407&program_of_interest=IBA&are_you_a_registered_nurse=0&do_you_have_a_teaching_certificate=0&campus=NYC&military=0&ipaddress=68.69.69.54&tcpa_text=Do+representatives+of+Berkeley+College+%2C+have+your+consent+to+contact+you+about+educational+opportunities+via+e-mail%2C+text%2C+or+phone%2C+including+your+mobile+phone+if+provided%3F+These+calls+may+be+placed+using+an+automatic+dialer+or+prerecorded+messages+and+you+are+not+required+to+provide+this+consent+in+order+to+enroll.+Message+and+data+rates+may+apply.+You+may+withdraw+your+consent+at+any+time.+Please+reply+Yes+to+provide+your+consent.+%3F+%28Must+be+a+clear+yes%29.+You+understand+that+this+consent+is+not+a+condition+of+purchase+and+that+you+may+revoke+this+consent+at+any+time.&education_level=1&desired_degree=2&grad_year=2017&dob=11%2F13%2F1999&lead_mode=1&lender_id=24&lead_id=C1CB9B44-845F-481F-983F-A510A966A327&sub_id2=';

$request .="&repost=1";
echo "<b>Please use this simulation to test any lender Post/Ping by giving your onw values.</b><br>";
echo "<table>";
echo "<tr><td>Lead mode</td><td>Test<input type='radio' checked='checked' name='lead_mode' value='0'>
Live<input type='radio' name='lead_mode' value='1'></td></tr>";
$posting_instruction = explode("&",$request);
foreach ($posting_instruction as $string){
	$newstring = explode("=",$string);
	echo "<tr>";
	echo "<td>".ucfirst(str_replace("_"," ",$newstring[0]))."</td>";
	echo "<td>".'<input type="text" name="'.$newstring[0].'" value="'.str_replace(array("%40","+","%2F"),array("@"," ","/"),$newstring[1]).'">'."</td>";;	
	echo "</tr>";
}
echo "</table>";
?>
<input type="submit" value="Ping/Post to Elite Auto"> 
</form>
<!--$this->respond($context, 'Rejected'-->
