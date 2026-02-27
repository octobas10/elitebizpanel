<?php
$this->breadcrumbs = array('Email Creatives', 'Preview');
$emailCreativesUrl = $this->createUrl('emailcreatives');
// Live/base URL for email creative images (same logic as creatives.php)
$backEnd = isset(Yii::app()->params['backEnd']) ? Yii::app()->params['backEnd'] : '';
$httphost = isset(Yii::app()->params['httphost']) ? Yii::app()->params['httphost'] : '';
if ($backEnd !== '' && preg_match('#^https?://#', $backEnd)) {
	$assetsBaseUrl = rtrim($backEnd, '/');
} elseif ($httphost !== '' && $backEnd !== '') {
	$assetsBaseUrl = rtrim($httphost, '/') . '/' . ltrim($backEnd, '/');
} else {
	$assetsBaseUrl = Yii::app()->request->hostInfo . rtrim(Yii::app()->request->baseUrl, '/');
}
$imgSrc = $assetsBaseUrl . '/email_creatives/' . (isset($creatives['image_name']) ? $creatives['image_name'] : '');
$embedSnippet = '<p>Find A New Or Used Car Loan Quickly&nbsp;<a href="http://www.elitemortgagefinder.com">Click Here</a></p>
<p><a href="http://www.elitemortgagefinder.com" target="_blank"><img alt="Get a payday advance up to $1500" src="' . $imgSrc . '"></a></p>
<p>Please apply at <a href="http://www.elitemortgagefinder.com" target="_blank">http://www.elitemortgagefinder.com</a> and we will match you with the best lender in the area that accepts your auto loan application.&nbsp;<a href="http://www.elitemortgagefinder.com" target="_blank">Click Here</a><br></p>
<p>elitemortgagefinder.com<br> 138-07 82nd Drive <br> Briarwood, NY 11435<br> Update Email Settings <a style="text-decoration: underline; text-underline: single" href="http://www.elitecashwire.com/removeme.php">http://www.elitecashwire.com/removeme.php</a></p>';
?>
<section class="affiliates-creatives-section mortgage-dashboard-section view-email-creative-page">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">Email creative preview</h1>
			<p class="affiliates-page-subtitle">Preview and copy the HTML to paste into your email draft.</p>
		</div>
		<div class="affiliates-page-actions">
			<a href="<?php echo CHtml::encode($emailCreativesUrl); ?>" class="btn btn-default">Back to Email Creatives</a>
		</div>
	</header>

	<?php if (empty($creatives) || !isset($creatives['image_name'])): ?>
		<div class="portlet">
			<div class="portlet-content">
				<p class="dashboard-empty-state-hint">This creative could not be found.</p>
			</div>
		</div>
	<?php else: ?>
		<div class="view-email-creative-preview portlet">
			<div class="portlet-decoration"><span class="portlet-title">Preview</span></div>
			<div class="portlet-content">
				<div class="view-email-creative-preview-inner">
					<p>Find A New Or Used Car Loan Quickly&nbsp;<a href="http://www.elitemortgagefinder.com">Click Here</a></p>
					<p><a href="http://www.elitemortgagefinder.com" target="_blank" rel="noopener"><img alt="Get a payday advance up to $1500" src="<?php echo CHtml::encode($imgSrc); ?>"></a></p>
					<p>Please apply at <a href="http://www.elitemortgagefinder.com" target="_blank" rel="noopener">http://www.elitemortgagefinder.com</a> and we will match you with the best lender in the area that accepts your auto loan application.&nbsp;<a href="http://www.elitemortgagefinder.com" target="_blank" rel="noopener">Click Here</a><br></p>
					<p>elitemortgagefinder.com<br> 138-07 82nd Drive <br> Briarwood, NY 11435<br> Update Email Settings <a style="text-decoration: underline; text-underline: single" href="http://www.elitecashwire.com/removeme.php">http://www.elitecashwire.com/removeme.php</a></p>
				</div>
			</div>
		</div>

		<div class="view-email-creative-embed portlet">
			<div class="portlet-decoration"><span class="portlet-title">Copy and paste into your email draft</span></div>
			<div class="portlet-content">
				<pre class="view-email-creative-code" id="view-email-creative-code" aria-label="Embed code"><?php echo CHtml::encode($embedSnippet); ?></pre>
				<textarea id="view-email-creative-embed-source" class="view-email-creative-embed-source" readonly="readonly" aria-hidden="true"><?php echo CHtml::encode($embedSnippet); ?></textarea>
				<div class="view-email-creative-actions">
					<button type="button" class="btn btn-primary" id="view-email-creative-copy" data-clipboard-target="view-email-creative-embed-source">Copy to clipboard</button>
					<span class="view-email-creative-copy-feedback" id="view-email-creative-copy-feedback" role="status" aria-live="polite"></span>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>
<script>
(function() {
	var btn = document.getElementById('view-email-creative-copy');
	var source = document.getElementById('view-email-creative-embed-source');
	var feedback = document.getElementById('view-email-creative-copy-feedback');
	if (!btn || !source) return;
	btn.addEventListener('click', function() {
		var text = source.value;
		if (typeof navigator !== 'undefined' && navigator.clipboard && navigator.clipboard.writeText) {
			navigator.clipboard.writeText(text).then(function() {
				if (feedback) { feedback.textContent = 'Copied.'; feedback.classList.add('view-email-creative-copy-ok'); }
				setTimeout(function() { if (feedback) { feedback.textContent = ''; feedback.classList.remove('view-email-creative-copy-ok'); } }, 2000);
			}).catch(function() {
				fallbackCopy();
			});
		} else {
			fallbackCopy();
		}
		function fallbackCopy() {
			source.select();
			source.setSelectionRange(0, 99999);
			try {
				document.execCommand('copy');
				if (feedback) { feedback.textContent = 'Copied.'; feedback.classList.add('view-email-creative-copy-ok'); }
				setTimeout(function() { if (feedback) { feedback.textContent = ''; feedback.classList.remove('view-email-creative-copy-ok'); } }, 2000);
			} catch (e) {
				if (feedback) feedback.textContent = 'Copy failed. Select the code above and copy manually.';
			}
		}
	});
})();
</script>
