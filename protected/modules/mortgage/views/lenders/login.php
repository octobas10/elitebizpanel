<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array('Login');
?>
<div class="page-header">
	<h1>Login <small>to your account</small></h1>
</div>
<div class="row-fluid">
	<div class="span6 offset3">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>"Buyer Login Into elitemortgagefinder.com Buyer Portal",
			));
			?>
		<p>Please fill out the following form with your login credentials:</p>
		<div class="form">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableClientValidation'=>true,
				'clientOptions'=>array(
				    'validateOnSubmit'=>true,
				),
				)); ?>
			<div class="row username">
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username'); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>
			<div class="row password">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password'); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>
			<div class="row rememberMe">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
			</div>
			<div class="row buttons">
				<?php echo CHtml::submitButton('Login',array('class'=>'btn btn btn-primary')); ?>
			</div>
			<?php $this->endWidget(); ?>
		</div>
		<!-- form -->
		<br>
		<div class="login-links">
			<p class="login-link-block">Are you a Publisher? <a href="<?php echo Yii::app()->createUrl('affiliates/login'); ?>" class="login-link-primary">Publisher login</a></p>
			<p class="login-link-block"><a href="http://www.elitemortgagefinder.com" target="_blank" rel="noopener" class="login-link-external">elitemortgagefinder.com</a></p>
		</div>
		</div>
		<?php $this->endWidget();?>
	</div>
</div>
