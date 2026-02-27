<?php
/* @var $this LendersController */
/* @var $model LenderDetails */
/* @var $form CActiveForm */
?>
<link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap2-toggle.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap2-toggle.min.js"></script>

<div class="lenders-form">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'lender-user-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => true,
	'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>
<?php echo $form->errorSummary($model); ?>

	<div class="lenders-form-grid">
		<div class="lenders-form-section">
			<h3 class="lenders-form-section-title">Overview &amp; status</h3>
			<div class="row">
				<?php echo $form->labelEx($model, 'user_name'); ?>
				<?php echo $form->textField($model, 'user_name', array('size' => 50, 'maxlength' => 50, 'readonly' => $model->isNewRecord ? false : true, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'user_name'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'status', $htmlOptions = array()); ?>
				<div class="btn-group" data-toggle="buttons">
					<?php foreach ($GLOBALS['status'] as $status_key => $status): ?>
						<a class="btn btn-default <?php echo ($model->status == $status_key) ? 'btn-primary' : ''; ?>">
							<input type="radio" name="LenderDetails[status]" value="<?php echo CHtml::encode($status_key); ?>" <?php echo ($model->status == $status_key) ? 'checked="checked"' : ''; ?>><?php echo CHtml::encode($status); ?>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'name'); ?>
				<?php echo $form->textField($model, 'name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'name'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'company_name'); ?>
				<?php echo $form->textField($model, 'company_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'company_name'); ?>
			</div>
		</div>

		<div class="lenders-form-section">
			<h3 class="lenders-form-section-title">Contact</h3>
			<div class="row">
				<?php echo $form->labelEx($model, 'email'); ?>
				<?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'email'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'first_name'); ?>
				<?php echo $form->textField($model, 'first_name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'first_name'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'last_name'); ?>
				<?php echo $form->textField($model, 'last_name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'last_name'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'phone'); ?>
				<?php echo $form->textField($model, 'phone', array('size' => 32, 'maxlength' => 12, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'phone'); ?>
			</div>
		</div>

		<div class="lenders-form-section lenders-form-section--full">
			<h3 class="lenders-form-section-title">URLs</h3>
			<div class="row">
				<?php echo $form->labelEx($model, 'ping_url_test'); ?>
				<?php echo $form->textField($model, 'ping_url_test', array('size' => 80, 'class' => 'form-control lenders-form-input-url')); ?>
				<?php echo $form->error($model, 'ping_url_test'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'ping_url_live'); ?>
				<?php echo $form->textField($model, 'ping_url_live', array('size' => 80, 'class' => 'form-control lenders-form-input-url')); ?>
				<?php echo $form->error($model, 'ping_url_live'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'post_url_test'); ?>
				<?php echo $form->textField($model, 'post_url_test', array('size' => 80, 'class' => 'form-control lenders-form-input-url')); ?>
				<?php echo $form->error($model, 'post_url_test'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'post_url_live'); ?>
				<?php echo $form->textField($model, 'post_url_live', array('size' => 80, 'class' => 'form-control lenders-form-input-url')); ?>
				<?php echo $form->error($model, 'post_url_live'); ?>
			</div>
		</div>

		<div class="lenders-form-section">
			<h3 class="lenders-form-section-title">Caps &amp; limits</h3>
			<div class="row">
				<?php echo $form->labelEx($model, 'submission_cap'); ?>
				<?php echo $form->textField($model, 'submission_cap', array('size' => 32, 'maxlength' => 32, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'submission_cap'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'hourly_submission_cap'); ?>
				<?php echo $form->textField($model, 'hourly_submission_cap', array('size' => 32, 'maxlength' => 32, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'hourly_submission_cap'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'accepted_cap'); ?>
				<?php echo $form->textField($model, 'accepted_cap', array('size' => 32, 'maxlength' => 32, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'accepted_cap'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'posting_timelimit'); ?>
				<?php echo $form->textField($model, 'posting_timelimit', array('size' => 32, 'maxlength' => 32, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'posting_timelimit'); ?>
			</div>
		</div>

		<div class="lenders-form-section">
			<h3 class="lenders-form-section-title">Type, margin &amp; parameters</h3>
			<div class="row">
				<label for="lender_pingpost_type">Lender type</label>
				<?php $checked = ($model->lender_pingpost_type == '1') ? 'checked="checked"' : ''; ?>
				<input type="checkbox" name="LenderDetails[lender_pingpost_type]" id="lender_pingpost_type" <?php echo $checked; ?> data-toggle="toggle" data-on="Direct Post" data-off="Ping Post" data-onstyle="success" data-offstyle="info">
			</div>
			<div class="row static_lead_price"<?php echo ($model->lender_pingpost_type != '1') ? ' style="display:none;"' : ''; ?>>
				<?php echo $form->labelEx($model, 'static_lead_price'); ?>
				<?php echo $form->textField($model, 'static_lead_price', array('size' => 32, 'maxlength' => 32, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'static_lead_price'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'margin'); ?>
				<?php $model->margin = ($model->margin == '') ? '10' : $model->margin; ?>
				<?php echo $form->dropDownList($model, 'margin', $model->margin_percent(), array('class' => 'form-control')); ?>
				<?php echo $form->error($model, 'margin'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'parameter1'); ?>
				<?php echo $form->textField($model, 'parameter1', array('size' => 32, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'parameter1'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'parameter2'); ?>
				<?php echo $form->textField($model, 'parameter2', array('size' => 32, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'parameter2'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model, 'parameter3'); ?>
				<?php echo $form->textField($model, 'parameter3', array('size' => 32, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'parameter3'); ?>
			</div>
		</div>

		<div class="lenders-form-section lenders-form-section--full">
			<h3 class="lenders-form-section-title">Notes</h3>
			<div class="row">
				<?php echo $form->labelEx($model, 'note'); ?>
				<?php echo $form->textArea($model, 'note', array('rows' => 4, 'class' => 'form-control lenders-form-textarea')); ?>
				<?php echo $form->error($model, 'note'); ?>
			</div>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary save', 'id' => 'lender_submit')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- .lenders-form -->

<script>
(function($){
	$(".lenders-form .btn-group .btn").on("click", function(e){
		e.preventDefault();
		$(".lenders-form .btn-group .btn").removeClass("btn-primary");
		$(".lenders-form .btn-group input[type=radio]").prop("checked", false);
		$(this).addClass("btn-primary");
		$(this).find("input[type=radio]").prop("checked", true);
	});
	$("#lender_pingpost_type").on("change", function(){
		if($(this).prop("checked") === true){
			$(".static_lead_price").show();
		} else {
			$(".static_lead_price").hide();
		}
	});
	$("#lender_submit").on("click", function(){
		if($("#lender_pingpost_type").prop("checked") === true){
			var val = $("#LenderDetails_static_lead_price").val();
			if(val === "" || parseFloat(val) === 0){
				$("#LenderDetails_static_lead_price").css("border", "2px solid var(--portal-danger, #ef4444)");
				return false;
			}
		}
		$("#LenderDetails_static_lead_price").css("border", "");
		return true;
	});
})(jQuery);
</script>
