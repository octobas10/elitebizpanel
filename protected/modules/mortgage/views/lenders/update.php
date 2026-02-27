<?php
/* @var $this LendersController */
/* @var $model LenderDetails */

$this->breadcrumbs = array(
	'Lender Details' => array('index'),
	$model->name => array('view', 'id' => $model->id),
	'Update',
);

$this->menu = array(
	array('label' => 'Create New Lender', 'url' => array('create')),
	array('label' => 'View this lender', 'url' => array('view', 'id' => $model->id)),
	array('label' => 'Lender Details', 'url' => array('index')),
);

$viewUrl = $this->createUrl('view', array('id' => $model->id));
$indexUrl = $this->createUrl('index');
?>
<section class="lenders-page mortgage-dashboard-section lenders-update-page">
	<header class="lenders-page-header">
		<div class="lenders-page-header-inner">
			<h1 class="lenders-page-title">Edit: <?php echo CHtml::encode($model->name); ?></h1>
			<p class="lenders-page-subtitle">Update lender details and configuration.</p>
		</div>
		<div class="lenders-page-actions">
			<?php echo CHtml::link('View', $viewUrl, array('class' => 'btn btn-default')); ?>
			<?php echo CHtml::link('Back to list', $indexUrl, array('class' => 'btn btn-default')); ?>
		</div>
	</header>

	<div class="lenders-form-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Lender form</span>
		</div>
		<div class="portlet-content">
			<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
		</div>
	</div>
</section>
