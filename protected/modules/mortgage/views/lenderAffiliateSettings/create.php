<?php
$this->breadcrumbs = array(
	'Lender Affiliate Setting' => array('index'),
	'Create',
);
$this->menu = array(
	array('label' => 'Lender Setup', 'url' => array('lenders/index')),
	array('label' => 'Affiliate Setup', 'url' => array('affiliates/index')),
);

$indexUrl = $this->createUrl('index');
$lendersUrl = $this->createUrl('lenders/index');
$affiliatesUrl = $this->createUrl('affiliates/index');
?>
<section class="lender-affiliate-settings-page mortgage-dashboard-section">
	<header class="lenders-page-header">
		<div class="lenders-page-header-inner">
			<h1 class="lenders-page-title">Lender Affiliate Settings</h1>
			<p class="lenders-page-subtitle">Set per-affiliate caps per lender. Only active affiliates are listed.</p>
		</div>
		<div class="lenders-page-actions">
			<a href="<?php echo CHtml::encode($affiliatesUrl); ?>" class="btn btn-default">Affiliate Setup</a>
			<a href="<?php echo CHtml::encode($lendersUrl); ?>" class="btn btn-default">Lender Setup</a>
			<a href="<?php echo CHtml::encode($indexUrl); ?>" class="btn btn-default">View all settings</a>
		</div>
	</header>

	<?php echo $this->renderPartial('_form', array(
		'model' => $model,
		'affiliate' => $affiliate,
		'lender' => $lender,
		'rendring' => isset($rendring) ? $rendring : null,
	)); ?>
</section>
