<?php
$this->breadcrumbs=array('Affiliate Register');
?>
<div class="page-header">
	<h2>Affiliate Registration</h2>
</div>
<div class="row-fluid affiliate-register">
<div class="form">
<?php if(isset($last_inserted_id) && $last_inserted_id!=''){?>
	<div class="affiliate_success">
	<p>Thanks for applying to become an affiliate for Elite Debt Cleaners – Debt Consolidation Affiliate Program.</p>
	<p>Your application is being reviewed by our team. One of our representatives will get back to you via email or telephone to review your affiliate account.</p>
	<p>If you have any questions feel free to email <a href="mailto:support@elitebusinessloans.com">support@elitebusinessloans.com</a> or call 718 938 1203.</p>
	<p>Have a great day! Sincerely, EliteDebtCleaners.com Affiliate Team - We Simplify Your Finances!</p>
	</div>
<?php }else{
	$form=$this->beginWidget('CActiveForm', array(
			'id'=>'auto-affiliate-register-form',
			'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
			'clientOptions'=>array('validateOnSubmit'=>true,),
	)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->PasswordField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
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
	<div class="row">
		<input type="checkbox" name="privacy" required>
        I have read and agree to the elitebusinessloans.com's <a href="../default/privacy" target="_blank" class="errorMessage">Privacy Policy</a>, <a href="../default/websiteterm" target="_blank" class="errorMessage">Website Terms</a> & <a href="../default/agreement" target="_blank" class="errorMessage">Affiliate Terms Agreement</a> and also confirm that I am at least 18 years of age.<br><br>
	</div>
    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? ' Create' : 'Save',array('class'=>'btn btn btn-primary')); ?>
	</div>
<?php $this->endWidget(); }?>
</div><!-- form -->
</div>
<style>
.affiliate_success {
/*     color: green; */
    font-size: 20px;
}
</style>
