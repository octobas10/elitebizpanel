<?php
$this->pageTitle = Yii::app()->name . ' – Publisher login';
$this->breadcrumbs = array('Login');

$registerUrl = Yii::app()->createUrl('affiliates/affiliateRegister');
$lenderLoginUrl = Yii::app()->createUrl('lenders/login');
$siteUrl = 'http://www.elitemortgagefinder.com';
?>
<div class="login-page">
	<div class="login-card">
		<div class="login-card-header">
			<h1 class="login-card-title">Publisher login</h1>
			<p class="login-card-subtitle">Sign in to the elitemortgagefinder.com Publisher Portal</p>
		</div>

		<div class="login-card-body">
			<p class="login-card-intro">Enter your credentials to continue.</p>

			<?php $form = $this->beginWidget('CActiveForm', array(
				'id' => 'login-form',
				'enableClientValidation' => true,
				'clientOptions' => array('validateOnSubmit' => true),
				'htmlOptions' => array('class' => 'login-form'),
			)); ?>

				<div class="login-form-row">
					<?php echo $form->labelEx($model, 'username', array('class' => 'login-label')); ?>
					<?php echo $form->textField($model, 'username', array('class' => 'login-input', 'autocomplete' => 'username', 'placeholder' => 'Username')); ?>
					<?php echo $form->error($model, 'username', array('class' => 'login-error')); ?>
				</div>

				<div class="login-form-row">
					<?php echo $form->labelEx($model, 'password', array('class' => 'login-label')); ?>
					<?php echo $form->passwordField($model, 'password', array('class' => 'login-input', 'autocomplete' => 'current-password', 'placeholder' => 'Password')); ?>
					<?php echo $form->error($model, 'password', array('class' => 'login-error')); ?>
				</div>

				<div class="login-form-row login-form-row-remember">
					<label class="login-remember">
						<?php echo $form->checkBox($model, 'rememberMe', array('class' => 'login-checkbox')); ?>
						<span><?php echo $model->getAttributeLabel('rememberMe'); ?></span>
					</label>
					<?php echo $form->error($model, 'rememberMe', array('class' => 'login-error')); ?>
				</div>

				<div class="login-form-row login-form-row-submit">
					<?php echo CHtml::submitButton('Sign in', array('class' => 'btn btn-primary login-submit')); ?>
				</div>

			<?php $this->endWidget(); ?>

			<div class="login-links">
				<p class="login-link-block">
					Not a Publisher yet?
					<a href="<?php echo htmlspecialchars($siteUrl); ?>" target="_blank" rel="noopener" class="login-link-external">elitemortgagefinder.com</a>
					<a href="<?php echo htmlspecialchars($registerUrl); ?>" class="login-link-primary">Register here</a>
				</p>
				<p class="login-link-block">
					Are you a Buyer?
					<a href="<?php echo htmlspecialchars($lenderLoginUrl); ?>" class="login-link-primary">Buyer login</a>
				</p>
			</div>
		</div>
	</div>
</div>
