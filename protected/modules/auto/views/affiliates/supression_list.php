<?php
$this->breadcrumbs = array(
	'Supression List' 
);
?>
<style>
.add_supression_list_form {
  margin: 40px 0 0 0;
}
div.supression {
   margin: 10px;
   text-align: center;
}
div.supression a {
	font-size: 16px;
	margin: 0 15px;
}
.supression button {
	padding: 3px;
}
.success_msg{font-size: 16px;color:green;margin: 10px 0;}
</style>
<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".success_msg").animate({opacity: 1.0}, 2000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>
<h4>Supression List</h4>
<div class="content">
<div class="supression">
<a href="?email_suprression_list=1"><button class="supression_button">Download Email Supression List</button></a>&nbsp;
<a href="?phone_supression_list=1"><button class="supression_button">Download Phone Supression List</button></a>
</div>
<hr>
<?php if(Yii::app()->user->getState('roles')==1){?>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="success_msg">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<div class="add_supression_list_form">
<form action="" method="POST">
<table border="0" cellspacing="0" class="data" style="width: 100%;">
<tr>
	<td>
	<label for="textarea"><b>Enter Email(s) to add in supression list. </b></label>
	</td>
	<td>
	<textarea name="emails_text" id="emails_text" class="round full-width-textarea" style="width:354px; height:42px;"></textarea>
	</td>
	<td>
	<input type="submit" name="emails" value="Remove Email(s)" class="round blue ic-right-arrow">
	</td>
</tr>
<tr>
	<td><label for="textarea"><b>Enter Telephone(s) to add in supression list. </b></label></td>
	<td><textarea name="phones_text" id="phones_text" class="round full-width-textarea" style="width:354px; height:42px;"></textarea></td>
	<td><input type="submit" name="phones" value="Remove Telephone(s)" class="round blue ic-right-arrow">	</td>
</tr>
</table>
</form>
</div>
<?php }?>
</div>
