<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */
/* @var $form CActiveForm */
?>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'auto-feed-lenders-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php 
// if($model->delay){
// 	$model_delay = explode(' ', $model->delay);
// 	$model->delay = $model_delay[0];
// 	$delaytime = $model_delay[1];
// }else {
// 	$delaytime = '';
// }
?>
	<div class="row">
		<?php echo $form->labelEx($model,'feed_lender_name'); ?>
		<?php echo $form->textField($model,'feed_lender_name',array('size'=>60,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'feed_lender_name'); ?>
	</div>
<!-- 	<div class="row"> -->
		<?php //echo $form->labelEx($model,'password'); ?>
		<?php //echo $form->textField($model,'password',array('size'=>60,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'password'); ?>
<!-- 	</div> -->
	<div class="row">
		<?php echo $form->labelEx($model,'parameter1'); ?>
		<?php echo $form->textField($model,'parameter1',array('size'=>60)); ?>
		<?php echo $form->error($model,'parameter1'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'parameter2'); ?>
		<?php echo $form->textField($model,'parameter2',array('size'=>60)); ?>
		<?php echo $form->error($model,'parameter2'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'parameter3'); ?>
		<?php echo $form->textField($model,'parameter3',array('size'=>60)); ?>
		<?php echo $form->error($model,'parameter3'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'post_url'); ?>
		<?php echo $form->textField($model,'post_url',array('size'=>60)); ?>
		<?php echo $form->error($model,'post_url'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'test_url'); ?>
		<?php echo $form->textField($model,'test_url',array('size'=>60)); ?>
		<?php echo $form->error($model,'test_url'); ?>
	</div>
	<?php $model->submission_cap = isset($model->submission_cap) ? $model->submission_cap:'-1'; ?>	
	<div class="row">
		<?php echo $form->labelEx($model,'submission_cap'); ?>
		<?php echo $form->textField($model,'submission_cap'); ?>
		<?php echo $form->error($model,'submission_cap'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'interval'); ?>
		<?php echo $form->textField($model,'interval'); ?>
		<?php echo $form->error($model,'interval'); ?>
		<?php echo CHtml::dropdownlist('intervaltime','intervaltime',array('sec'=>'Second','min'=>'Minutes'));?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'delay'); ?>
		<?php echo $form->textField($model,'delay'); ?>
		<?php echo $form->error($model,'delay'); ?>
		<?php echo CHtml::dropdownlist('delaytime','delaytime',array('HOUR'=>'Hour','DAY'=>'Day'));?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', array(''=>'--Select--','0'=>'Inactive','1'=>'Live','2'=>'Legacy'));?>
		<?php echo $form->error($model,'status'); ?>
	</div>
    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
