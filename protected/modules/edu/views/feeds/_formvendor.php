<?php
/* @var $this AutoFeedVendorController */
/* @var $model AutoFeedVendor */
/* @var $form CActiveForm */
?>
    <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">EduFeedVendor</div>
</div>
<div class="portlet-content">
<div class="form">
<div class="row">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auto-feed-vendor-form',
	'enableAjaxValidation'=>false,
)); ?>
    <div class="col-sm-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255,'class'=>'form-control','pattern'=>'[A-Za-z0-9]+','title'=>'Only Alpha Numeric Value is Allowed','readonly'=>($model->isNewRecord)? false : true)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'uniqueness'); ?>
		<?php echo $form->dropDownList($model,'uniqueness',array(1=>'Global',0=>'Local'),array('empty'=>'--Select--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'uniqueness'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'dup_days'); ?>
		<?php echo $form->textField($model,'dup_days',array('class'=>'form-control','pattern'=>'[0-9]{1,3}','min'=>'1','max'=>'365','title'=>'Not a Valid Duplicate Days')); ?>
		<?php echo $form->error($model,'dup_days'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control','pattern'=>'[A-Za-z0-9]+','title'=>'Only Alpha Numeric Value is Allowed')); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>
	
    </div>
    <div class="col-sm-6">
        <div class="form-group">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>55,'maxlength'=>55,'class'=>'form-control','pattern'=>'[A-Za-z]+','title'=>'Only Alphabets Allowed')); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>55,'maxlength'=>55,'class'=>'form-control','pattern'=>'[A-Za-z]+','title'=>'Only Alphabets Allowed')); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>



	<div class="form-group">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>12,'maxlength'=>10,'class'=>'form-control','pattern'=>'[0-9]{10}','title'=>'Not a Valid Number')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
    </div>
        </div>
    <div class="row buttons">
        <div class="col-sm-12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
        </div>
</div>
