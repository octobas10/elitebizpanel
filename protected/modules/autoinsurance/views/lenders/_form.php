<?php
/* @var $this LenderUserController */
/* @var $model LenderUser */
/* @var $form CActiveForm */
?>
<link href="<?php echo Yii::app()->baseUrl;?>/css/bootstrap2-toggle.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap2-toggle.min.js"></script>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lender-user-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation' => true,
	'clientOptions' => array('validateOnSubmit' => true,'validateOnChange' => false )
)); ?>
<?php echo $form->errorSummary($model); ?>

<div class="row">
	<?php echo $form->labelEx($model,'user_name'); ?>
	<?php echo $form->textField($model,'user_name',array('size'=>50,'maxlength'=>50,'readonly'=>($model->isNewRecord)? false : true)); ?>
	<?php echo $form->error($model,'user_name'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'status',$htmlOptions=array()); ?>
	<div class="btn-group" data-toggle="buttons">
	<?php
		foreach($GLOBALS['status'] as $status_key=>$status){?>
			<a class="btn btn-default <?php echo ($model->status == $status_key) ? 'btn-primary' : '';?>">
			<input type="radio" name="LenderDetails[status]" value="<?php echo $status_key;?>" <?php echo ($model->status == $status_key) ? 'checked="checked"' : '';?>><?php echo $status; ?>
			</a>
		<?php } ?>
	</div>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'name'); ?>
	<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	<?php echo $form->error($model,'name'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'email'); ?>
	<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'email'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'first_name'); ?>
	<?php echo $form->textField($model,'first_name',array('size'=>50,'maxlength'=>50)); ?>
	<?php echo $form->error($model,'first_name'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'last_name'); ?>
	<?php echo $form->textField($model,'last_name',array('size'=>50,'maxlength'=>50)); ?>
	<?php echo $form->error($model,'last_name'); ?>
	<?php echo $form->error($model,'last_name'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'company_name'); ?>
	<?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'company_name'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'phone'); ?>
	<?php echo $form->textField($model,'phone',array('size'=>32,'maxlength'=>12)); ?>
	<?php echo $form->error($model,'phone'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'ping_url_test'); ?>
	<?php echo $form->textField($model,'ping_url_test',array('size'=>32)); ?>
	<?php echo $form->error($model,'ping_url_test'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'ping_url_live'); ?>
	<?php echo $form->textField($model,'ping_url_live',array('size'=>32)); ?>
	<?php echo $form->error($model,'ping_url_live'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'post_url_test'); ?>
	<?php echo $form->textField($model,'post_url_test',array('size'=>32)); ?>
	<?php echo $form->error($model,'post_url_test'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'post_url_live'); ?>
	<?php echo $form->textField($model,'post_url_live',array('size'=>32)); ?>
	<?php echo $form->error($model,'post_url_live'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'parameter1'); ?>
	<?php echo $form->textField($model,'parameter1',array('size'=>32)); ?>
	<?php echo $form->error($model,'parameter1'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'parameter2'); ?>
	<?php echo $form->textField($model,'parameter2',array('size'=>32)); ?>
	<?php echo $form->error($model,'parameter2'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'parameter3'); ?>
	<?php echo $form->textField($model,'parameter3',array('size'=>32)); ?>
	<?php echo $form->error($model,'parameter3'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'submission_cap'); ?>
	<?php echo $form->textField($model,'submission_cap',array('size'=>32,'maxlength'=>32)); ?>
	<?php echo $form->error($model,'submission_cap'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'hourly_submission_cap'); ?>
	<?php echo $form->textField($model,'hourly_submission_cap',array('size'=>32,'maxlength'=>32)); ?>
	<?php echo $form->error($model,'hourly_submission_cap'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'accepted_cap'); ?>
	<?php echo $form->textField($model,'accepted_cap',array('size'=>32,'maxlength'=>32)); ?>
	<?php echo $form->error($model,'accepted_cap'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'posting_timelimit'); ?>
	<?php echo $form->textField($model,'posting_timelimit',array('size'=>32,'maxlength'=>32)); ?>
	<?php echo $form->error($model,'posting_timelimit'); ?>
</div>

<div class="row">
	<label for="LenderDetails_lender_pingpost_type">Lender Type</label>
	<?php $checked = ($model->lender_pingpost_type == '1') ? 'checked=checked' : '';?>
	<input type="checkbox" name="LenderDetails[lender_pingpost_type]" id="lender_pingpost_type" <?php echo $checked;?> data-toggle="toggle" data-on="Direct Post" data-off="Ping Post" data-onstyle="success" data-offstyle="info">
</div>
	
<div class="row static_lead_price">
	<?php echo $form->labelEx($model,'static_lead_price'); ?>
	<?php echo $form->textField($model,'static_lead_price',array('size'=>32,'maxlength'=>32)); ?>
	<?php echo $form->error($model,'static_lead_price'); ?>
</div>

<div style="clear: both;margin-bottom: 10px;"></div>

<div class="row">
	<?php echo $form->labelEx($model,'note'); ?>
	<?php echo $form->textArea($model,'note',array('rows'=>6,'style'=>'width: 900px;')); ?>
	<?php echo $form->error($model,'note'); ?>
</div>

<div style="clear: both;"></div>

<div class="row buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary save','id'=>'lender_submit')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<style>
.errorMessage{
	display: none !important;
}
.radiobutton{
    float: left;
}
#LenderDetails_status > label {
    float: left;
    padding: 0 5px;
}
[data-toggle=buttons]>.btn>input[type=radio], [data-toggle=buttons]>.btn>input[type=checkbox] {
  display: none;
}
.row {
    float: left;
    width: 50%;
}
.btn-group {
    margin-bottom: 9px;
}
input {
    width: 400px;
}
.row.buttons {
    border-top: 1px dotted #ccc;
    margin: 10px;
    padding: 10px;
    text-align: center;
    width: 100%;
}
div.row.buttons input.save {
    width: 15%;
}
</style>
<script>
$(".btn-default").click(function(){
	$(".btn-group a").each(function(index,value){
		$(value).removeClass("btn-primary");
		$(this).children().removeAttr("checked");
	});
	$(this).addClass("btn-primary");
	$(this).children().attr( "checked", "checked" );
});
$('#lender_pingpost_type').change(function(){
	if($(this).prop('checked')==true){
		$(".static_lead_price").show();
	}else{
   	$(".static_lead_price").hide();
	}
});
$("#lender_submit").click(function(){
	if($('#lender_pingpost_type').prop('checked')==true){
		if(parseInt($("#LenderDetails_static_lead_price").val()) == '0.00' || $("#LenderDetails_static_lead_price").val() ==""){
			$("#LenderDetails_static_lead_price").css('border','1px solid red');
			return false;
		}else{
			return true;
		}
	}
});
</script>
