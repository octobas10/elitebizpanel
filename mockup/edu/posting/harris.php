<?php
//echo $_SERVER["HTTP_HOST"].'=='.$_SERVER['HTTP_HOST'];exit;
if($_SERVER['HTTP_HOST'] =='192.168.1.163'){
	$link = '/ElitePanel.com';
}elseif($_SERVER['HTTP_HOST'] =='staging.axiombpm.com'){
	$link = '/elitepanel.com';
}else{
	$link = '/elitebizpanel.com';
}
?>
<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/edu/postprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$firstname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
$lastname = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

$firstname ='Nikita';$lastname ='Patel';
$email ='nikita@elitmate.com';



$request ='promo_code=1&password=testleadonly&zip=08343&first_name=Damien&last_name=Martin&email=damienmartin@gmail.com&sub_id=&sub_id2=&ipaddress=172.94.59.204&process=organic&gender=&dob=&phone=2109944899&address=918 john page dr.&program_of_interest=PMA&campus= VRHHSB&grad_year=2007&highest_education=1&start_date=1&learning_peference=2&enrollment_time=0&outstanding_loan=0&military=0&are_you_a_registered_nurse=0&do_you_have_a_teaching_certificate=0&city=SAN ANTONIO&state=TX&mobile=2109944899&universal_leadid=991540BF-658E-3628-D48B-4DA1459965C7&lead_mode=1&lender_id=16&lead_id=991540BF-658E-3628-D48B-4DA1459965C&repost=1&master_degree=0&ged=1';


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
