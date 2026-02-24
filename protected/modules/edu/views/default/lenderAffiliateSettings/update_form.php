<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $model LenderAffiliateSettings */
/* @var $form CActiveForm */
?>
    <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Lender Affiliate Setting Update</div>
</div>
<div class="portlet-content">
<div class="form">
<div class="row">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lender-affiliate-settings-form',
	'enableAjaxValidation'=>false,
)); ?>
    <div class="col-sm-4">
	<div class="form-group">
		<?php echo $form->labelEx($model,'affiliate_user_id'); ?>
		<?php echo $form->dropDownList($model,'affiliate_user_id',$affiliate,array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'affiliate_user_id'); ?>
	</div>
    </div>
    <div class="col-sm-4">
	<div class="form-group">
		<?php echo $form->labelEx($model,'lender_details_id'); ?>
		<?php echo $form->dropDownList($model,'lender_details_id',$lender,array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'lender_details_id'); ?>
	</div>
    </div>
    <div class="col-sm-4">
	<div class="form-group">
		<?php echo $form->labelEx($model,'cap'); ?>
		<?php echo $form->textField($model,'cap',array('size'=>5,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'cap'); ?>
	</div>
    </div>
	<!--<div class="form-group">
		<?php echo $form->labelEx($model,'intervals'); ?>
		<?php echo $form->textField($model,'intervals',array('size'=>5)); ?>
		<?php echo $form->error($model,'intervals'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'orderby'); ?>
		<?php echo $form->textField($model,'orderby',array('size'=>5)); ?>
		<?php echo $form->error($model,'orderby'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(1=>'Active',0=>'Inactive')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	<div class="form-group">
		<?php //echo $form->labelEx($model,'isRoundRobin'); ?>
		<?php //echo $form->dropDownList($model,'isRoundRobin',array(0=>'No',1=>'Yes')); ?>
		<?php //echo $form->error($model,'isRoundRobin'); ?>
	</div> -->
    </div>
	<div class="row buttons">
        <div class="col-sm-12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary')); ?>
	</div>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
        </div>
