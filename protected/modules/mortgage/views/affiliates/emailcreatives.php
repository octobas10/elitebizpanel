<?php
$this->breadcrumbs = array('Email Creatives');
$this->menu = array(array('label' => 'Banner Creatives', 'url' => array('creatives')));
$creativesUrl = $this->createUrl('creatives');
$isAdmin = Yii::app()->user->getState('roles') == 1;
$baseUrl = isset(Yii::app()->params['httphost']) && isset(Yii::app()->params['backEnd']) ? (rtrim(Yii::app()->params['httphost'], '/') . '/' . ltrim(Yii::app()->params['backEnd'], '/')) : '';
?>
<script>
$(document).ready(function(){
	$("#upload").click(function(){
		var promotional_image = $("#promotional_image").val();
		var error_msg = [];
		var error = 1;
		if(promotional_image == ''){
			error_msg.push("<p class='error'>Select Promotional Image Banner</p>");
			error = 0;
		}
		if(error == 0){
			var error_msg_str = '';
			$.each(error_msg, function( index, value ) {
				error_msg_str = error_msg_str + value;
			});
			$("#error").show();
			$("#error").html(error_msg_str);
			return false;
		}
	});

	$("#add_subjectlines").click(function(){
		var email_creatives_subject_line = $("#email_creatives_subject_line").val();
		var error_msg = [];
		var error = 1;

		if(email_creatives_subject_line == ''){
			error_msg.push("<p class='error'>Enter Subject Line</p>");
			error = 0;
		}
		if(error == 0){
			var error_msg_str = '';
			$.each(error_msg, function( index, value ) {
				error_msg_str = error_msg_str + value;
			});
			$("#error").show();
			$("#error").html(error_msg_str);
			return false;
		}
	});

	$("#add_fromlines").click(function(){
		var email_creatives_from_line = $("#email_creatives_from_line").val();
		var error_msg = [];
		var error = 1;

		if(email_creatives_from_line == ''){
			error_msg.push("<p class='error'>Enter From Line</p>");
			error = 0;
		}
		if(error == 0){
			var error_msg_str = '';
			$.each(error_msg, function( index, value ) {
				error_msg_str = error_msg_str + value;
			});
			$("#error").show();
			$("#error").html(error_msg_str);
			return false;
		}
	});
});
</script>
<section class="affiliates-creatives-section mortgage-dashboard-section affiliates-page">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">Email Creatives</h1>
			<p class="affiliates-page-subtitle">Upload email banners and manage subject lines and from lines.</p>
		</div>
		<div class="affiliates-page-actions">
			<a href="<?php echo CHtml::encode($creativesUrl); ?>" class="btn btn-default">Banner Creatives</a>
		</div>
	</header>
	<?php if ($isAdmin): ?>
	<div class="creatives-form-card portlet">
		<div class="portlet-decoration"><span class="portlet-title">Add email creative</span></div>
		<div class="portlet-content">
			<?php if (isset($errors) && !empty($errors)): ?>
				<div id="creatives-error-block" class="creatives-error-block" role="alert"><?php foreach ($errors as $err): ?><p><?php echo CHtml::encode($err); ?></p><?php endforeach; ?></div>
			<?php endif; ?>
			<div id="creatives-error-block" class="creatives-error-block" style="display:none;" role="alert"></div>
			<div class="creatives-form-grid">
				<div class="creatives-form-card" style="margin-bottom:0;">
					<h3 class="creatives-display-title">Add banner image</h3>
					<?php echo CHtml::beginForm('', 'post', array('id' => 'creatives', 'enctype' => 'multipart/form-data')); ?>
					<div class="creatives-form-row"><label class="creatives-form-label" for="promotional_image">Banner image</label><div class="creatives-form-input"><?php echo CHtml::fileField('promotional_image', '', array('id' => 'promotional_image', 'accept' => 'image/*')); ?></div></div>
					<div class="creatives-form-row"><?php echo CHtml::submitButton('Upload Banner', array('name' => 'upload', 'id' => 'upload', 'class' => 'btn btn-primary')); ?></div>
					<?php echo CHtml::endForm(); ?>
				</div>

				<div class="creatives-form-card" style="margin-bottom:0;">
					<h3 class="creatives-display-title">Add subject line</h3>
					<?php echo CHtml::beginForm('', 'post', array('id' => 'creatives2', 'enctype' => 'multipart/form-data')); ?>
					<div class="creatives-form-row"><label class="creatives-form-label" for="email_creatives_subject_line">Subject line</label><div class="creatives-form-input"><?php echo CHtml::textField('email_creatives_subject_line', '', array('id' => 'email_creatives_subject_line')); ?></div></div>
					<div class="creatives-form-row"><?php echo CHtml::submitButton('Save', array('name' => 'add_subjectlines', 'id' => 'add_subjectlines', 'class' => 'btn btn-primary')); ?></div>
					<?php echo CHtml::endForm(); ?>
				</div>
				<div class="creatives-form-card" style="margin-bottom:0;">
					<h3 class="creatives-display-title">Add from line</h3>
					<?php echo CHtml::beginForm('', 'post', array('id' => 'creatives3', 'enctype' => 'multipart/form-data')); ?>
					<div class="creatives-form-row"><label class="creatives-form-label" for="email_creatives_from_line">From line</label><div class="creatives-form-input"><?php echo CHtml::textField('email_creatives_from_line', '', array('id' => 'email_creatives_from_line')); ?></div></div>
					<div class="creatives-form-row"><?php echo CHtml::submitButton('Save', array('name' => 'add_fromlines', 'id' => 'add_fromlines', 'class' => 'btn btn-primary')); ?></div>
					<?php echo CHtml::endForm(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="creatives-lines-row">
		<div class="row display_creatives creatives-display-card portlet">
			<div class="portlet-decoration"><span class="portlet-title">Email subject lines</span></div>
			<div class="portlet-content">
<?php if (empty($email_creatives_subject_lines)): ?>
				<p class="dashboard-empty-state-hint">No email subject lines.</p>
<?php else: ?>
				<ul class="creatives-lines-list">
				<?php $i = 1; foreach ($email_creatives_subject_lines as $subject_line): ?>
					<li class="creatives-line-item"><?php echo $i . '. ' . CHtml::encode($subject_line['subject_lines']); ?></li>
				<?php $i++; endforeach; ?>
				</ul>
<?php endif; ?>
			</div>
		</div>
		<div class="row display_creatives creatives-display-card portlet">
			<div class="portlet-decoration"><span class="portlet-title">Email from lines</span></div>
			<div class="portlet-content">
<?php if (empty($email_creatives_from_lines)): ?>
				<p class="dashboard-empty-state-hint">No email from lines available.</p>
<?php else: ?>
				<ul class="creatives-lines-list">
				<?php $j = 1; foreach ($email_creatives_from_lines as $from_line): ?>
					<li class="creatives-line-item"><?php echo $j . '. ' . CHtml::encode($from_line['from_lines']); ?></li>
				<?php $j++; endforeach; ?>
				</ul>
<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="row display_creatives creatives-display-card portlet">
		<div class="portlet-decoration"><span class="portlet-title">Email creatives (banners)</span></div>
		<div class="portlet-content">
<?php if (count($creatives)): ?>
			<ul class="creatives-banner-list">
<?php foreach ($creatives as $creative): ?>
				<li><a href="viewemailcreatives?id=<?php echo $creative['id']; ?>" target="_blank" rel="noopener">
					<img alt="" src="<?php echo CHtml::encode(Yii::app()->params['httphost'] . Yii::app()->params['backEnd']); ?>/email_creatives/<?php echo CHtml::encode($creative['image_name']); ?>">
				</a></li>
<?php endforeach; ?>
			</ul>
<?php else: ?>
			<p class="dashboard-empty-state-hint">No email banners available.</p>
<?php endif; ?>
		</div>
	</div>
</section>
