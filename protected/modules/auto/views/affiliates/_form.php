<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */
/* @var $form CActiveForm */
?>
<link href="<?php echo Yii::app()->baseUrl;?>/css/bootstrap2-toggle.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap2-toggle.min.js"></script>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auto-affiliate-user-form',
	'enableAjaxValidation'=>false,
));?>

<?php if(Yii::app()->user->id==1){?>
	<?php if($model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($model,'status',$htmlOptions=array()); ?>
		<div class="btn-group" data-toggle="buttons">
			<?php
			foreach($GLOBALS['status'] as $status_key=>$status){?>
			<a class="btn btn-default <?php echo ($model->status == $status_key) ? 'btn-primary' : '';?>">
				<input type="radio" name="AffiliateUser[status]" value="<?php echo $status_key;?>"  
					<?php echo ($model->status == $status_key) ? 'checked="checked"' : '';?>><?php echo $status; ?>
			</a>
			<?php } ?>
		</div>
	</div>
	<?php }?>
	<div class="row">
		<?php echo $form->labelEx($model,'is_inorganic',$htmlOptions=array()); ?>
		<?php $checked = ($model->is_inorganic == '1') ? 'checked=checked' : '';?>
		<input type="checkbox"  name="AffiliateUser[is_inorganic]" <?php echo $checked;?> data-toggle="toggle" 
			data-on="Inorganic" data-off="Organic" data-onstyle="success" data-offstyle="info">
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>50,'maxlength'=>50,'autocomplete' => 'off','readonly'=>($model->isNewRecord)? false : true)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>
	
<?php }?>

<?php if($model->isNewRecord){?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50,'autocomplete' => 'off')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
<?php }?>
	
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
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>32,'maxlength'=>10,'minlength'=>10)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
	
<?php if(Yii::app()->user->id==1){?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'cap_limit'); ?>
		<?php echo $form->textField($model,'cap_limit',array('size'=>32)); ?>
		<?php echo $form->error($model,'cap_limit'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'bucket_limit'); ?>
		<?php $bucket_limit = ($model->bucket_limit == '' || $model->bucket_limit == 0) ? '100' : $model->bucket_limit;?>
		<?php echo $form->textField($model,'bucket_limit',array('value'=>$bucket_limit),array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'bucket_limit'); ?>
	</div>
	
	<div class="row">
		<div>
		<?php echo $form->labelEx($model,'margin'); ?>
		<?php $model->margin = ($model->margin == '') ? '10' : $model->margin;?>
		<?php echo $form->dropDownList($model,'margin', $model->margin_percent(),array('class'=>'date'),
				array('options' => array($model->margin=>array('selected'=>'selected')))); ?>
		<?php echo $form->error($model,'margin'); ?>
		</div>
		<div>
		<?php echo $form->labelEx($model,'min_bid_price'); ?>
		<?php echo $form->textField($model,'min_bid_price',array('size'=>3)); ?>
		<?php echo $form->error($model,'min_bid_price'); ?>
		</div>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'pixel_type'); ?>
		<?php $checked = ($model->pixel_type == '1') ? 'checked=checked' : '';?>
		<input type="checkbox"  name="AffiliateUser[pixel_type]" <?php echo $checked;?> data-toggle="toggle" 
			data-on="Server Side" data-off="HTML Pixel" data-onstyle="success" data-offstyle="info">
	</div>
	
	<div style="clear: both;"></div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pixel_code'); ?><span class="pixel_code_hint">(In HTML Pixel there can be image, script or iframe code, and in Server Side Pixel there can be URL)</span>
		<?php echo $form->textArea($model,'pixel_code',array('rows'=>6,'style'=>'width: 850px;')); ?>
		<?php echo $form->error($model,'pixel_code'); ?>
	</div>
	
	<div style="clear: both;"></div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'dup_days'); ?>
		<?php echo $form->textField($model,'dup_days',array('')); ?>
		<?php echo $form->error($model,'dup_days'); ?>
	</div>
	
	<div class="row">
		<label for="AffiliateUser_isAdmin" class="">Is Admin</label>
		<?php $checked = ($model->isAdmin == '1') ? 'checked=checked' : '';?>
		<input type="checkbox"  name="AffiliateUser[isAdmin]" <?php echo $checked;?> data-toggle="toggle" data-on="Yes"
			 data-off="No" data-onstyle="success" data-offstyle="info">
	</div>
	
<?php } ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary save')); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->
<style>
label.inline_label {
  float: left;
  margin-right: 5px;
}
.inline_checkbox{
  margin: 0 !important;
}
.radiobutton{
    float: left;
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
div.toggle {
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
.pixel_code_hint {
    font-size: 11px;
}
</style>
<script>
$(".btn-default").click(function(){
	$(".btn-group a").each(function(index,value){
		$(value).removeClass("btn-primary");
		$(this).children().removeAttr("checked");
	});
	$(this).addClass("btn-primary");
	//$(this).animate({$(this).addClass("btn-primary")})
	$(this).children().attr( "checked", "checked" );
});
</script>
