<?php
$this->breadcrumbs = array('Supression List');

$emailDownloadUrl = $this->createUrl('supression_list', array('email_suprression_list' => 1));
$phoneDownloadUrl = $this->createUrl('supression_list', array('phone_supression_list' => 1));
$isAdmin = Yii::app()->user->getState('roles') == 1;
?>
<?php
Yii::app()->clientScript->registerScript(
	'supressionSuccessFade',
	'$(".supression-success-msg").animate({opacity: 1}, 2000).fadeOut("slow");',
	CClientScript::POS_READY
);
?>
<section class="supression-list-section mortgage-dashboard-section affiliates-page">
	<header class="supression-list-header affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="supression-list-title affiliates-page-title">Supression List</h1>
			<p class="supression-list-subtitle affiliates-page-subtitle">Download or manage email and phone suppression lists.</p>
		</div>
		<div class="supression-actions affiliates-page-actions">
			<a href="<?php echo htmlspecialchars($emailDownloadUrl); ?>" class="btn btn-default">Download Email Supression List</a>
			<a href="<?php echo htmlspecialchars($phoneDownloadUrl); ?>" class="btn btn-default">Download Phone Supression List</a>
		</div>
	</header>

	<?php if (Yii::app()->user->hasFlash('success')): ?>
		<div class="supression-success-msg" role="status">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php endif; ?>

	<?php if ($isAdmin): ?>
	<div class="supression-form-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Add to supression list</span>
		</div>
		<div class="portlet-content">
			<form action="" method="post">
				<div class="supression-form-row">
					<div class="supression-form-field" style="flex: 1 1 100%;">
						<label class="supression-form-label" for="emails_text">Enter email(s) to add to supression list</label>
						<textarea name="emails_text" id="emails_text" class="round full-width-textarea" placeholder="One per line or comma-separated"></textarea>
					</div>
					<div style="flex: 0 0 auto; align-self: flex-end;">
						<button type="submit" name="emails" value="1" class="btn btn-primary">Remove Email(s)</button>
					</div>
				</div>
				<div class="supression-form-row">
					<div class="supression-form-field" style="flex: 1 1 100%;">
						<label class="supression-form-label" for="phones_text">Enter telephone(s) to add to supression list</label>
						<textarea name="phones_text" id="phones_text" class="round full-width-textarea" placeholder="One per line or comma-separated"></textarea>
					</div>
					<div style="flex: 0 0 auto; align-self: flex-end;">
						<button type="submit" name="phones" value="1" class="btn btn-primary">Remove Telephone(s)</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php endif; ?>
</section>
