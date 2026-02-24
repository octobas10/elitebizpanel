<?php
?>
<style>
.add_supression label {
	display: inline-block;
}
.add_supression input[type="text"] {
    width: 22%;
}
.add_supression input {
   margin: 7px;
}
.add_supression input[type="button"],input[type="submit"] {
   padding: 2px;
/*    width: 90px; */
}
button.supression_button{
	padding: 2px;
}
#email_error, #phone_error{
	color:red;
}
.content {
    min-height: 640px;
}
</style>
<script>
function check_valid_email(email){
	var email = $.trim(email);
	var ph = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+\.([A-Z]{2}|com|org|net|gov|edu|us|info|biz|ca|cet)$";
	return email.match(ph);
}
function check_valid_phone(phone){
	var phone = $.trim(phone);
	var ph = "^[2-9]{1}[0-9]{2}[2-9]{1}[0-9]{6}$";
	return phone.match(ph);
}
$(document).ready(function(){
	$("#remove_email").click(function(){
		var email = $("#email").val();
		var valid_email = check_valid_email(email);
		if(email == ''){
			 $("#email_error").html('<label>Enter Email ID</label>');
			 return;
		}
		else if(!valid_email){
			$("#email_error").html('<label>Enter Valid Email ID</label>');
			return;
		}
		else if(email != ''){
			$("#email_error").html('');
		}
		else if(valid_email){
			$("#email_error").html('');
		}
		//submit the form
		$("#removeme_form").submit();
	});
	$("#remove_phone").click(function(){
		var phone = $("#phone").val();
		var valid_phone = check_valid_phone(phone);
		if(phone == ''){
			 $("#phone_error").html('<label>Enter Phone No</label>');
			 return;
		}
		else if(!valid_phone){
			$("#phone_error").html('<label>Enter Valid Phone</label>');
			return;
		}
		else if(phone != ''){
			$("#phone_error").html('');
		}
		else if(valid_phone){
			$("#phone_error").html('');
		}
		//submit the form
		$("#removeme_form").submit();
	});
});
</script>
<div class="content">
<div class="add_supression">
<h4>Add Records in Supression List</h4>
<?php
foreach($response as $status=>$messages){
	$font_color = ($status=='fail') ? 'color:red;' : 'color:green;';
	foreach($messages as $msg){
		echo '<span style="'.$font_color.'">'.$msg.'</span><br>';
	}
}?>
<?php echo CHtml::beginForm($action='',$method='post',$htmlOptions=array('id'=>'removeme_form'));?>
<?php echo CHtml::label($label='Enter your email address if you choose not to receive any more emails.', $for='email', $htmlOptions=array());?>
<br>
<?php echo CHtml::textField($label='email','',$htmlOptions=array('id'=>'email','maxlength'=>'35'));?>
<?php echo CHtml::button($label='REMOVE MY EMAIL', $htmlOptions=array('id'=>'remove_email'));?>
<div id="email_error"></div>
<br>
<?php echo CHtml::label($label='Enter your telephone if you choose not to receive telephone calls and text messages from EliteBizPanel.com', $for='phone', $htmlOptions=array());?>
<br>
<?php echo CHtml::textField($label='phone','',$htmlOptions=array('id'=>'phone','maxlength'=>'10'));?>
<?php echo CHtml::button($label='REMOVE MY PHONE', $htmlOptions=array('id'=>'remove_phone'));?>
<div id="phone_error"></div>
<br>
<?php //echo CHtml::submitButton($label='Add Record', $htmlOptions=array('name'=>'add_record'));?>
<?php echo CHtml::endForm();?>
</div>
</div>
