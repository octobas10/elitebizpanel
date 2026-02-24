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
				'title'=>"Buyer Login Into elitehealthinsurers.com Buyer Portal",
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
		<div class="register_link">
			Are you a <a href="http://www.elitehealthinsurers.com" target="_blank" class="sitelink">elitehealthinsurers.com</a> Publisher <a href="../affiliates/login" class="affilaite_login"> Click Here</a>
		</div>
		</div>
		<?php $this->endWidget();?>
	</div>
</div>
<style>
.row.rememberMe {margin-bottom: 15px;}
.row.rememberMe > input {margin-bottom: 5px;}
.row.rememberMe > label {display: inline;}
.register_link {color: red;font-size: 14px;}
.register_link a {color: green;}
.affilaite_login {color: red;font-size: 14px;}
.affilaite_login a {color: green;}
.affilaite_login {text-decoration: underline;}
</style>
