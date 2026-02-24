<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $model LenderAffiliateSettings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lender-affiliate-settings-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'affiliate_user_id'); ?>
		<?php echo $form->dropDownList($model,'affiliate_user_id',$affiliate); ?>
		<?php echo $form->error($model,'affiliate_user_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'lender_details_id'); ?>
		<?php echo $form->dropDownList($model,'lender_details_id',$lender); ?>
		<?php echo $form->error($model,'lender_details_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'cap'); ?>
		<?php echo $form->textField($model,'cap',array('size'=>5)); ?>
		<?php echo $form->error($model,'cap'); ?>
	</div>
	<!--<div class="row">
		<?php echo $form->labelEx($model,'intervals'); ?>
		<?php echo $form->textField($model,'intervals',array('size'=>5)); ?>
		<?php echo $form->error($model,'intervals'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'orderby'); ?>
		<?php echo $form->textField($model,'orderby',array('size'=>5)); ?>
		<?php echo $form->error($model,'orderby'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(1=>'Active',0=>'Inactive')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	<div class="row">
		<?php //echo $form->labelEx($model,'isRoundRobin'); ?>
		<?php //echo $form->dropDownList($model,'isRoundRobin',array(0=>'No',1=>'Yes')); ?>
		<?php //echo $form->error($model,'isRoundRobin'); ?>
	</div> -->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
