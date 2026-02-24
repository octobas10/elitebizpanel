<?php
//echo $_SERVER["HTTP_HOST"].'=='.$_SERVER['HTTP_HOST'];exit;
if($_SERVER['HTTP_HOST'] =='192.168.1.163'){
	$link = '/ElitePanel.com';
}elseif($_SERVER['HTTP_HOST'] =='staging.axiombpm.com'){
	$link = '/elitepanel.com';
}else{
	$link = '/ecw/elitebizpanel.com';
}
?>
<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/edu/postprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$firstname ='Nikita';$lastname ='Patel';
$email ='nikita@elitmate.com';

$request ='universal_leadid=e245d5c6-50d6-4165-b709-8cdbe785b344&promo_code=96&sub_id=45155_atech&first_name=justin&last_name=conklin&email=justinc0nklin1991@gmail.com&phone=7065645319&address=255 Oak Lake Drive&city=AUGUSTA&state=GA&zip=30907&gender=M&mobile=7065645319&program_of_interest=ANF&are_you_a_registered_nurse=0&do_you_have_a_teaching_certificate=0&campus=EITHERDA&military=0&ipaddress=75.76.155.233&tcpa_text=Do representatives of Degree America , have your consent to contact you about educational opportunities via e-mail, text, or phone, including your mobile phone if provided? These calls may be placed using an automatic dialer or prerecorded messages and you are not required to provide this consent in order to enroll. Message and data rates may apply. You may withdraw your consent at any time. Please reply Yes to provide your consent. ? (Must be a clear yes). You understand that this consent is not a condition of purchase and that you may revoke this consent at any time.&education_level=4&desired_degree=2&grad_year=2010&dob=01/02/1991&lead_mode=1&repost=1';

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
