<?php
$this->breadcrumbs = array('Banner Creatives');
$this->menu = array(array('label' => 'Email Creatives', 'url' => array('emailcreatives')));
$emailCreativesUrl = $this->createUrl('emailcreatives');
$isAdmin = Yii::app()->user->getState('roles') == 1;
$promoCode = Yii::app()->user->id;
// Live/base URL for promotional images: use backEnd when it is a full URL, else httphost+backEnd, else current request origin
$backEnd = isset(Yii::app()->params['backEnd']) ? Yii::app()->params['backEnd'] : '';
$httphost = isset(Yii::app()->params['httphost']) ? Yii::app()->params['httphost'] : '';
if ($backEnd !== '' && preg_match('#^https?://#', $backEnd)) {
	$assetsBaseUrl = rtrim($backEnd, '/');
} elseif ($httphost !== '' && $backEnd !== '') {
	$assetsBaseUrl = rtrim($httphost, '/') . '/' . ltrim($backEnd, '/');
} else {
	$assetsBaseUrl = Yii::app()->request->hostInfo . rtrim(Yii::app()->request->baseUrl, '/');
}
?>
<script>
$(document).ready(function(){
	$("#upload").click(function(){
		var private_label = jQuery.trim($("#private_label").val());
		var promotional_text = $("#promotional_text").val();
		var promotional_image = $("#promotional_image").val();
		var error_msg = [], error = 1;
		if(private_label == ''){ error_msg.push("<p>Enter Private Label URL</p>"); error = 0; }
		if(private_label != ''){
			var pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
			if(!pattern.test(private_label)){ error_msg.push("<p>Enter a valid URL starting with http://</p>"); error = 0; }
		}
		if(promotional_text == ''){ error_msg.push("<p>Enter Promotional Text</p>"); error = 0; }
		if(promotional_image == ''){ error_msg.push("<p>Select Promotional Image Banner</p>"); error = 0; }
		if(error == 0){ $("#creatives-error-block").show().html(error_msg.join('')); return false; }
	});
});
</script>
<section class="affiliates-creatives-section mortgage-dashboard-section affiliates-page">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">Banner Creatives</h1>
			<p class="affiliates-page-subtitle">Add banner creatives and copy embed code for your site.</p>
		</div>
		<div class="affiliates-page-actions">
			<a href="<?php echo CHtml::encode($emailCreativesUrl); ?>" class="btn btn-default">Email Creatives</a>
		</div>
	</header>
	<?php if ($isAdmin): ?>
	<div class="creatives-form-card portlet">
		<div class="portlet-decoration"><span class="portlet-title">Add banner creative</span></div>
		<div class="portlet-content">
			<?php if (isset($errors) && !empty($errors)): ?>
				<div id="creatives-error-block" class="creatives-error-block" role="alert">
					<?php foreach ($errors as $err): ?><p><?php echo CHtml::encode($err); ?></p><?php endforeach; ?>
				</div>
			<?php endif; ?>
			<div id="creatives-error-block" class="creatives-error-block" style="display:none;" role="alert"></div>
			<?php echo CHtml::beginForm('', 'post', array('id' => 'creatives', 'enctype' => 'multipart/form-data')); ?>
			<div class="creatives-form-row">
				<label class="creatives-form-label" for="private_label">Private Label URL</label>
				<div class="creatives-form-input"><?php echo CHtml::textField('private_label', '', array('id' => 'private_label', 'placeholder' => 'https://example.com')); ?></div>
			</div>
			<div class="creatives-form-row">
				<label class="creatives-form-label" for="promotional_text">Promotional Text</label>
				<div class="creatives-form-input"><?php echo CHtml::textArea('promotional_text', '', array('id' => 'promotional_text', 'rows' => 3)); ?></div>
			</div>
			<div class="creatives-form-row">
				<label class="creatives-form-label" for="promotional_image">Promotional Image</label>
				<div class="creatives-form-input"><?php echo CHtml::fileField('promotional_image', '', array('id' => 'promotional_image', 'accept' => 'image/*')); ?></div>
			</div>
			<div class="creatives-form-row"><?php echo CHtml::submitButton('Add Creative', array('name' => 'upload', 'id' => 'upload', 'class' => 'btn btn-primary')); ?></div>
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>
	<?php endif; ?>
	<div class="creatives-display-card portlet">
		<div class="portlet-decoration"><span class="portlet-title">Your banner creatives</span></div>
		<div class="portlet-content">
			<?php if (empty($creatives)): ?>
				<div class="dashboard-empty-state dashboard-empty-state-enhanced">
					<p class="dashboard-empty-state-title">No banner creatives yet</p>
					<p class="dashboard-empty-state-hint"><?php echo $isAdmin ? 'Add a creative using the form above.' : 'No creatives have been added.'; ?></p>
				</div>
			<?php else: ?>
			<div class="creatives-promo-grid">
			<?php foreach ($creatives as $creative):
					$linkUrl = $creative['private_label'] . (strpos($creative['private_label'], '?') !== false ? '&' : '?') . 'promo_code=' . $promoCode;
					$imgSrc = $assetsBaseUrl . '/promotional_creatives/' . $creative['image_name'];
					$embedCode = '<a title="' . htmlspecialchars($creative['promotional_text']) . '" href="' . htmlspecialchars($linkUrl) . '"><img src="' . htmlspecialchars($imgSrc) . '" alt="' . htmlspecialchars($creative['promotional_text']) . '" border="0"></a>';
			?>
			<div class="creatives-promo-card">
				<p style="margin:0 0 0.75rem;"><a href="<?php echo CHtml::encode($linkUrl); ?>" target="_blank" rel="noopener"><img src="<?php echo CHtml::encode($imgSrc); ?>" alt="<?php echo CHtml::encode($creative['promotional_text']); ?>" style="max-width:100%;height:auto;border:1px solid var(--portal-border);border-radius:8px;" /></a></p>
				<p class="dashboard-kpi-meta" style="margin:0 0 0.5rem;">Link: <code style="font-size:0.8125rem;padding:0.2em 0.4em;background:var(--portal-header-bg);border-radius:4px;"><?php echo CHtml::encode($linkUrl); ?></code></p>
				<label class="creatives-form-label" style="margin-top:0.75rem;">Embed code</label>
				<pre class="creatives-code-block"><?php echo CHtml::encode($embedCode); ?></pre>
				<?php if ($isAdmin): ?>
				<form action="" method="post" style="margin-top:1rem;" onsubmit="return confirm('Are you sure? This cannot be undone.');">
					<?php echo CHtml::hiddenField('remove_id', $creative['id']); ?>
					<button type="submit" class="btn btn-default">Remove this ad</button>
				</form>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<button type="button" class="scroll-to-top" id="creatives-scroll-to-top" aria-label="Back to top" title="Back to top" style="display:none;">↑</button>
</section>
<script>
(function(){
	var btn = document.getElementById('creatives-scroll-to-top');
	if (!btn) return;
	var section = document.querySelector('.affiliates-creatives-section');
	function onScroll() {
		btn.style.display = (window.pageYOffset > 300) ? '' : 'none';
	}
	function goTop(e) {
		e.preventDefault();
		window.scrollTo({ top: 0, behavior: 'smooth' });
		btn.focus();
	}
	window.addEventListener('scroll', onScroll, { passive: true });
	btn.addEventListener('click', goTop);
})();
</script>
