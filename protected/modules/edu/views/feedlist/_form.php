<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auto-feedlist-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Feedlendername'); ?>
		<?php echo $form->textField($model,'Feedlendername',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Feedlendername'); ?>
	</div>
	
    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
