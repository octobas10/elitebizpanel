<?php
$this->breadcrumbs=array('Affiliate Register');
?>
<div class="page-header">
	<h2>Affiliate Registration</h2>
</div>
<div class="row affiliate-register">
    <div class="col-sm-6 col-sm-offset-3">
        
<div class="form">
<?php if(isset($last_inserted_id) && $last_inserted_id!='') { ?>
	<div class="affiliate_success">
	<p>Thanks for applying to become an affiliate for Higher Learning Marketers.</p>
	<p>Your application is being reviewed by our team. One of our representatives will get back to you via email or telephone to activate your account.</p>
	<p>If you have any questions feel free to email support@higherlearningmarketers.com or call 718 938 1203.</p>
	<p>Have a great day!  higherlearningmarketers.com</p>
	</div>
<?php
	if(isset($model->email) && !empty($model->email)) {
		$to = $model->email;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Higher Learning Marketers <support@higherlearningmarketers.com>' . "\r\n";

		$subject = "Thanks For Registering To Become A Higher Learning App Publisher";

		$mailmessage = "Hello ".ucfirst($model->first_name).",<br><br>Hope you are having a great day!  Thanks for registering to become a Higher Learning App affiliate.  Please allow our affiliate team to review your application.  One of our representatives will get back to your shortly via email or telephone regarding your affiliate account activation.  We might ask for additional information to enable your account.  Wishing you all the best!<br><br>Sincerely,<br><br>Higher Learning Marketers Affiliate Team<br>Support@HigherLearningMarketers.com<br>Helping Colleges Find Qualified Students";

		$email = mail($to, $subject, $mailmessage, $headers);

		//send email copy to admin
		$to = Yii::app()->params['adminEmail'];
		$email = mail($to, $subject, $mailmessage, $headers);

	} else { }
}else{
	$form=$this->beginWidget('CActiveForm', array(
			'id'=>'auto-affiliate-register-form',
			'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
			'clientOptions'=>array('validateOnSubmit'=>true,),
	)); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>50,'maxlength'=>50,'class'=>'form-control','required'=>true)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->PasswordField($model,'password',array('size'=>50,'maxlength'=>50,'class'=>'form-control','required'=>true)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class'=>'form-control','required'=>true)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>50,'maxlength'=>50,'class'=>'form-control','required'=>true)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>50,'maxlength'=>50,'class'=>'form-control','required'=>true)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>32,'maxlength'=>20,'minlength'=>10,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>50,'maxlength'=>30,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>50,'maxlength'=>30,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'zip_code'); ?>
		<?php echo $form->textField($model,'zip_code',array('size'=>5,'maxlength'=>6,'minlength'=>5,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'zip_code'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->urlField($model,'website',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'tax_id'); ?>
		<?php echo $form->textField($model,'tax_id',array('size'=>32,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'tax_id'); ?>
	</div>
	<div class="form-group">
		<input type="checkbox" name="privacy" required>
		I have read and agree to the HigherLearningMarketers.com's <a href="../default/privacy" target="_blank" class="errorMessage">Privacy Policy</a>, <a href="../default/websiteagreement" target="_blank" class="errorMessage">Website Terms</a> & <a href="../default/affiliateagreement" target="_blank" class="errorMessage">Affiliate Terms Agreement</a> and also confirm that I am at least 18 years of age.
	</div>
    <div class="row buttons">
        <div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit Affiliate Application' : 'Save',array('class'=>'btn btn btn-primary')); ?>
	</div>
<?php $this->endWidget(); }?>
</div><!-- form -->
<p><a href="../default/privacy" target="_blank" class="errorMessage">Privacy Policy</a></p>
<p><a href="../default/affiliateagreement" target="_blank" class="errorMessage">Higher Learning Marketers Affiliate Agreement</a></p>
    </div>
</div>
<style>
.affiliate_success {
/*     color: green; */
    font-size: 20px;
}
</style>
