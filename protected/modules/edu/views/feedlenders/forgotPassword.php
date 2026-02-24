<?php
$this->pageTitle=Yii::app()->name . ' - Forgot Password';
// $this->breadcrumbs=array('Login');
if(isset($email) && !empty($email)) {
		$to = $email;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Higher Learning Marketers <support@higherlearningapp.com>' . "\r\n";
		$subject = "Higher Learning App Publisher-Reset Password";
		$mailmessage = "Hello ,<br><br>Hope you are having a great day!  Your new password for Higher Learning App Publisher is <b>".$pass."</b>";
		$email = mail($to, $subject, $mailmessage, $headers);
  
	} else { }
?>
<div class="page-header">
	<h1>Forgot Password </h1>
</div>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
        <?php if(isset($email) && !empty($email)){?>
	<div id="error" style="display: block !important;">
	
		<p class='success' style="color:green;">New Password is sent to your registered email address.</p>
	
	</div>
<?php } ?>
              <?php if(isset($error) && !empty($error)){?>
	<div id="error" style="display: block !important;">
	
		<p class='error' style="color:red;">Entered email is not registered with us</p>
	
	</div>
<?php } ?>

		<!--
		/**
		 ** author : vatsal gadhia
		 ** description : Title changed
		 ** date : 03-08-2016
		 ** modification : widget title text changed
		 ** date : 22-08-2016
		*/
		-->
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>"List Manager Login Into higherlearningmarketers.com Lead Management Portal",
			));
			?>
		<div class="form">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableClientValidation'=>true,
				'clientOptions'=>array(
				    'validateOnSubmit'=>true,
				),
				)); ?>
			<div class="username form-group">
				<?php echo $form->labelEx($model,'email',array('class'=>'inline_label')); ?>
				<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
			</div>
			
			<div class=" buttons form-group">
				<?php echo CHtml::submitButton('Send Password',array('class'=>'btn btn btn-primary')); ?>
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
			Are you a <a href="http://www.higherlearningmarketers.com" target="_blank" class="sitelink">higherlearningmarketers.com</a> Affiliate? <a href="../affiliates/login" class="affilaite_login"> Click Here</a>
		</div>
		<br>
		<div class="register_link">
			Are you a <a href="http://www.higherlearningmarketers.com" target="_blank" class="sitelink">higherlearningmarketers.com</a> Lead Buyer? <a href="../lenders/login" class="lender_login"> Click Here</a>
		</div>
		<?php $this->endWidget();?>
	</div>
</div>
<style>
    div.form > form .row{
        margin:0;
    }
.register_link {color: red;font-size: 14px;}
.register_link a {color: green;}
.register_here{text-decoration: underline;}
.row.rememberMe {margin-bottom: 15px;}
.row.rememberMe > input {margin-bottom: 5px;}
.row.rememberMe > label {display: inline;}
.lender_link {color: red;font-size: 14px;}
.lender_link a {color: green;}
.feed_lender_login .lender_login {text-decoration: underline;}
</style>
