<?php
$promo_code = Yii::app()->user->id;
if(isset($_POST['spport_submit']) && $_POST['support_question']!=''){
	extract($_POST);
	/*echo '<pre>';print_r($_POST);echo '</pre>';*/
	$to = 'devang.parekh@axiombpm.com, vipul.bhandari@axiombpm.com' . ', ';
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: EliteBizPanel <support@elitebizpanel.com>' . "\r\n";
	
	$subject = "New Support Query in EliteBizPanel";
	
	$mailmessage = "Hello Admin, We have new support query from following affiliate.<br><br>";
	$mailmessage = $mailmessage."<b>Promo Code : </b>".$promo_code."<br><br>";
	$mailmessage = $mailmessage."<b>Support Question : </b>".$support_question."<br><br>";
	
	$email = mail($to, $subject, $mailmessage, $headers);
	
	if($email){}else{}
	
}
?>
<h4>Support :</h4>
<form name="support_form" id="support_form" class="support_form" method="post">
<span style="font-size: 18px;">Your Question : </span><br>
<textarea name="support_question" style="width: 500px;height: 100px;"></textarea><br>
<input type="submit" name="spport_submit" value="Submit Question">

</form>
