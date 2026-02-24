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
Action : http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/debt/pingprocess


<form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/debt/pingprocess" enctype="multipart/form-data" target="_blank">
<input type="submit" name="submit" value="Ping/Post to Elite Auto"> 
<?php
$request ='lender=Turbo&lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes&universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=107.150.30.112&first_name=test&last_name=desena&email=tony.elitecashwire.com&address=1239 Lesbury Avenue&phone=7139381203&dob=1990-10-20&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&url=https://elitedebtcleaners.com&zip=90100&ssn=023811492&employment_type=1&income=3700&credit_rating=1&is_rented=1&loan_amount=100000&comments=nocomments&trustedformcerturl=https://cert.trustedform.com/8716ddbf37681a830c9b512f76a5c582d52c3ee9&debt_amount=100000';



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
