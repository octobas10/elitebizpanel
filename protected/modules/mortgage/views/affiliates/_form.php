<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */
/* @var $form CActiveForm */
?>
<div class="affiliate-form">
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'auto-affiliate-user-form',
	'enableAjaxValidation' => false,
));
?>

	<?php if (Yii::app()->user->id == 1): ?>
		<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Account')); ?>
		<?php if ($model->isNewRecord): ?>
		<div class="form-row">
			<?php echo $form->labelEx($model, 'status'); ?>
			<div class="btn-group" data-toggle="buttons">
				<?php foreach ($GLOBALS['status'] as $status_key => $status): ?>
				<label class="btn btn-default <?php echo ($model->status == $status_key) ? 'active' : ''; ?>">
					<input type="radio" name="AffiliateUser[status]" value="<?php echo $status_key; ?>" <?php echo ($model->status == $status_key) ? 'checked="checked"' : ''; ?>>
					<?php echo $status; ?>
				</label>
				<?php endforeach; ?>
			</div>
			<?php echo $form->error($model, 'status'); ?>
		</div>
		<?php endif; ?>
		<div class="form-row">
			<?php echo $form->labelEx($model, 'is_inorganic'); ?>
			<?php
			$checked = ($model->is_inorganic == '1');
			$iconO = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09L18 18.75l-.813-2.846z"/></svg>';
			$iconI = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 4.5m9-4.5v9l-9 5.25M3 7.5l9 4.5M3 7.5v9l9 5.25m0-9v9"/></svg>';
			?>
			<label class="tw-switch inline-flex cursor-pointer select-none rounded-full border border-gray-300 bg-gray-100 p-0.5 w-fit">
				<input type="checkbox" name="AffiliateUser[is_inorganic]" value="1" class="sr-only tw-switch-input"<?php echo $checked ? ' checked' : ''; ?>>
				<span class="tw-switch-off flex flex-1 items-center justify-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition"><?php echo $iconO; ?> Organic</span>
				<span class="tw-switch-on flex flex-1 items-center justify-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition"><?php echo $iconI; ?> Inorganic</span>
			</label>
		</div>
		<div class="form-row">
			<?php echo $form->labelEx($model, 'user_name'); ?>
			<?php echo $form->textField($model, 'user_name', array('size' => 50, 'maxlength' => 50, 'autocomplete' => 'off', 'readonly' => $model->isNewRecord ? false : true, 'class' => 'form-input')); ?>
			<?php echo $form->error($model, 'user_name'); ?>
		</div>
		<?php $this->endWidget(); ?>
	<?php endif; ?>

	<?php if ($model->isNewRecord): ?>
		<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Password')); ?>
		<div class="form-row">
			<?php echo $form->labelEx($model, 'password'); ?>
			<?php echo $form->passwordField($model, 'password', array('size' => 50, 'maxlength' => 50, 'autocomplete' => 'off', 'class' => 'form-input')); ?>
			<?php echo $form->error($model, 'password'); ?>
		</div>
		<?php $this->endWidget(); ?>
	<?php endif; ?>

	<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Profile')); ?>
	<div class="row-fluid">
		<div class="span6">
			<div class="form-row">
				<?php echo $form->labelEx($model, 'email'); ?>
				<?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255, 'class' => 'form-input')); ?>
				<?php echo $form->error($model, 'email'); ?>
			</div>
			<div class="form-row">
				<?php echo $form->labelEx($model, 'first_name'); ?>
				<?php echo $form->textField($model, 'first_name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-input')); ?>
				<?php echo $form->error($model, 'first_name'); ?>
			</div>
			<div class="form-row">
				<?php echo $form->labelEx($model, 'last_name'); ?>
				<?php echo $form->textField($model, 'last_name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-input')); ?>
				<?php echo $form->error($model, 'last_name'); ?>
			</div>
		</div>
		<div class="span6">
			<div class="form-row">
				<?php echo $form->labelEx($model, 'company_name'); ?>
				<?php echo $form->textField($model, 'company_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-input')); ?>
				<?php echo $form->error($model, 'company_name'); ?>
			</div>
			<div class="form-row">
				<?php echo $form->labelEx($model, 'phone'); ?>
				<?php echo $form->textField($model, 'phone', array('size' => 32, 'maxlength' => 10, 'minlength' => 10, 'class' => 'form-input')); ?>
				<?php echo $form->error($model, 'phone'); ?>
			</div>
		</div>
	</div>
	<?php $this->endWidget(); ?>

	<?php if (Yii::app()->user->id == 1): ?>
		<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Caps & limits')); ?>
		<div class="row-fluid">
			<div class="span6">
				<div class="form-row">
					<?php echo $form->labelEx($model, 'cap_limit'); ?>
					<?php echo $form->textField($model, 'cap_limit', array('size' => 32, 'class' => 'form-input')); ?>
					<?php echo $form->error($model, 'cap_limit'); ?>
				</div>
				<div class="form-row">
					<?php echo $form->labelEx($model, 'bucket_limit'); ?>
					<?php $bucket_limit = ($model->bucket_limit == '' || $model->bucket_limit == 0) ? '100' : $model->bucket_limit; ?>
					<?php echo $form->textField($model, 'bucket_limit', array('value' => $bucket_limit, 'size' => 60, 'maxlength' => 255, 'class' => 'form-input')); ?>
					<?php echo $form->error($model, 'bucket_limit'); ?>
				</div>
			</div>
			<div class="span6">
				<div class="form-row">
					<?php echo $form->labelEx($model, 'margin'); ?>
					<?php $model->margin = ($model->margin == '') ? '10' : $model->margin; ?>
					<?php echo $form->dropDownList($model, 'margin', $model->margin_percent(), array('class' => 'form-input', 'options' => array($model->margin => array('selected' => 'selected')))); ?>
					<?php echo $form->error($model, 'margin'); ?>
				</div>
				<div class="form-row">
					<?php echo $form->labelEx($model, 'min_bid_price'); ?>
					<?php echo $form->textField($model, 'min_bid_price', array('size' => 10, 'class' => 'form-input')); ?>
					<?php echo $form->error($model, 'min_bid_price'); ?>
				</div>
			</div>
		</div>
		<?php $this->endWidget(); ?>

		<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Pixel')); ?>
		<div class="form-row">
			<?php echo $form->labelEx($model, 'pixel_type'); ?>
			<?php
			$pixelChecked = ($model->pixel_type == '1');
			$iconCode = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"/></svg>';
			$iconServer = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5 0a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z"/></svg>';
			?>
			<label class="tw-switch inline-flex cursor-pointer select-none rounded-full border border-gray-300 bg-gray-100 p-0.5 w-fit">
				<input type="checkbox" name="AffiliateUser[pixel_type]" value="1" class="sr-only tw-switch-input"<?php echo $pixelChecked ? ' checked' : ''; ?>>
				<span class="tw-switch-off flex flex-1 items-center justify-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition"><?php echo $iconCode; ?> HTML Pixel</span>
				<span class="tw-switch-on flex flex-1 items-center justify-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition"><?php echo $iconServer; ?> Server Side</span>
			</label>
		</div>
		<div class="form-row form-row-full">
			<?php echo $form->labelEx($model, 'pixel_code'); ?>
			<span class="form-hint">(HTML Pixel: image, script or iframe code; Server Side: URL)</span>
			<?php echo $form->textArea($model, 'pixel_code', array('rows' => 6, 'class' => 'form-input form-input-wide')); ?>
			<?php echo $form->error($model, 'pixel_code'); ?>
		</div>
		<div class="form-row">
			<?php echo $form->labelEx($model, 'dup_days'); ?>
			<?php echo $form->textField($model, 'dup_days', array('class' => 'form-input')); ?>
			<?php echo $form->error($model, 'dup_days'); ?>
		</div>
		<div class="form-row">
			<label for="AffiliateUser_isAdmin">Is Admin</label>
			<?php
			$adminChecked = ($model->isAdmin == '1');
			$iconUser = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>';
			$iconShield = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>';
			?>
			<label class="tw-switch inline-flex cursor-pointer select-none rounded-full border border-gray-300 bg-gray-100 p-0.5 w-fit">
				<input type="checkbox" name="AffiliateUser[isAdmin]" value="1" id="AffiliateUser_isAdmin" class="sr-only tw-switch-input"<?php echo $adminChecked ? ' checked' : ''; ?>>
				<span class="tw-switch-off flex flex-1 items-center justify-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition"><?php echo $iconUser; ?> No</span>
				<span class="tw-switch-on flex flex-1 items-center justify-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition"><?php echo $iconShield; ?> Yes</span>
			</label>
		</div>
		<?php $this->endWidget(); ?>
	<?php endif; ?>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
		<?php echo CHtml::link('Cancel', $model->isNewRecord ? array('index') : array('view', 'id' => $model->id), array('class' => 'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

<style>
.affiliate-form .form-row { margin-bottom: 1em; }
.affiliate-form .form-row label:not(.tw-switch) { display: block; margin-bottom: 0.25em; font-weight: 600; }
.affiliate-form .form-input { width: 100%; max-width: 400px; box-sizing: border-box; }
.affiliate-form .form-input-wide { max-width: 100%; min-height: 120px; }
.affiliate-form .form-hint { font-size: 0.85em; color: #666; display: block; margin-bottom: 0.25em; }
.affiliate-form .form-actions { margin-top: 1.5em; padding-top: 1em; border-top: 1px solid #eee; }
.affiliate-form .form-actions .btn { margin-right: 0.5em; }
.affiliate-form [data-toggle=buttons] > .btn > input[type=radio],
.affiliate-form [data-toggle=buttons] > .btn > input[type=checkbox] { display: none; }
.affiliate-form .btn-group .btn { margin-bottom: 0; }
.affiliate-form div.toggle { margin-bottom: 0.5em; }
/* Tailwind-style switch: active segment uses primary */
.affiliate-form .tw-switch { display: inline-flex; min-width: 1px; }
.affiliate-form .tw-switch .tw-switch-off { color: #6b7280; }
.affiliate-form .tw-switch .tw-switch-on { color: #6b7280; }
.affiliate-form .tw-switch:not(:has(.tw-switch-input:checked)) .tw-switch-off { background: #244E6A; color: #fff; }
.affiliate-form .tw-switch:has(.tw-switch-input:checked) .tw-switch-on { background: #244E6A; color: #fff; }
</style>
<script>
(function(){
	var group = document.querySelector('.affiliate-form .btn-group');
	if (group) {
		group.addEventListener('click', function(e) {
			var btn = e.target.closest('.btn');
			if (!btn) return;
			group.querySelectorAll('.btn').forEach(function(b){ b.classList.remove('active'); b.querySelector('input') && b.querySelector('input').removeAttribute('checked'); });
			btn.classList.add('active');
			var input = btn.querySelector('input');
			if (input) input.setAttribute('checked', 'checked');
		});
	}
})();
</script>
