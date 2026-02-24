<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array('Login');
?>
<div class="page-header">
	<h1>Login <small>to your account</small></h1>
</div>
<div class="row">
	 <div class="col-sm-6 col-sm-offset-3">
		 <!--
		/**
		 ** author : vatsal gadhia
		 ** description : Title changed
		 ** date : 03-08-2016
		*/
		-->
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>"Buyer Login Into Higherlearningmarketers.com Education Portal",
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
			<div class="form-group username">
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>
			<div class="form-group password">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>
			<div class="form-group rememberMe">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
			</div>
			<div class="form-group buttons">
				<?php echo CHtml::submitButton('Login',array('class'=>'btn btn btn-primary')); ?>
			</div>
			<?php $this->endWidget(); ?>
		</div>
		<!-- form -->
		<!--
		/**
		 ** author : vatsal gadhia
		 ** description : Title changed
		 ** date : 03-08-2016
		 ** modification : Link and display text changed
		 ** date : 22-08-2016
		*/
		-->
        <div class="register_link">
			<a href="forgotPassword" class="register_here">Forgot Password</a>
		</div>
		<br>
		<div class="register_link">
			Are you a <a href="http://www.higherlearningmarketers.com" target="_blank" class="sitelink">higherlearningmarketers.com</a> Publisher? <a href="../affiliates/login" class="affilaite_login"> Click Here</a>
		</div>
		<br>
		<div class="register_link">
			Are you a <a href="http://www.higherlearningmarketers.com" target="_blank" class="sitelink">higherlearningmarketers.com</a> List Manager? <a href="../feedlenders/login" class="feed_lender_login"> Click Here</a>
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
.feed_lender_login .affilaite_login {text-decoration: underline;}
</style>
