<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */

$this->breadcrumbs = array(
	'Affiliate Users' => array('index'),
	'Create',
);

$this->menu = array(
	array('label' => 'List Affiliate User', 'url' => array('index')),
);

$indexUrl = $this->createUrl('index');
?>
<section class="affiliates-create-page mortgage-dashboard-section">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">Create New Affiliate</h1>
			<p class="affiliates-page-subtitle">Add a new affiliate user and set promo code, caps, and margins.</p>
		</div>
		<div class="affiliates-page-actions">
			<a href="<?php echo CHtml::encode($indexUrl); ?>" class="btn btn-default">Back to list</a>
		</div>
	</header>

	<div class="affiliates-page-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Affiliate details</span>
		</div>
		<div class="portlet-content">
			<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
		</div>
	</div>
</section>
