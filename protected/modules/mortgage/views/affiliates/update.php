<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */

$this->breadcrumbs = array(
	'Affiliates' => array('index'),
	$model->user_name => array('view', 'id' => $model->id),
	'Update',
);

$this->menu = array(
	array('label' => 'Create New Affiliate', 'url' => array('create')),
	array('label' => 'View This Affiliate', 'url' => array('view', 'id' => $model->id)),
	array('label' => 'List Affiliates', 'url' => array('index')),
);
?>
<div class="affiliate-update-page">
	<div class="page-header clearfix">
		<h4 class="pull-left">Update: <?php echo CHtml::encode($model->user_name); ?></h4>
		<div class="pull-right">
			<?php echo CHtml::link('View', array('view', 'id' => $model->id), array('class' => 'btn btn-default')); ?>
			<?php echo CHtml::link('List', array('index'), array('class' => 'btn btn-default')); ?>
		</div>
	</div>
	<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</div>
