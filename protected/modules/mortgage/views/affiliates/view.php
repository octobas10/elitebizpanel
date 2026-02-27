<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */
$this->breadcrumbs = array('Affiliates' => array('index'), $model->user_name => array('view', 'id' => $model->id), 'View');
$this->menu = array(
	array('label' => 'Create New Affiliate', 'url' => array('create')),
	array('label' => 'Update This Affiliate', 'url' => array('update', 'id' => $model->id)),
	array('label' => 'Delete This Affiliate', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this affiliate?')),
	array('label' => 'List Affiliates', 'url' => array('index')),
);
?>
<div class="affiliate-view-page">
	<div class="page-header clearfix">
		<h4 class="pull-left">Affiliate: <?php echo CHtml::encode($model->user_name); ?></h4>
		<div class="pull-right btn-toolbar">
			<?php echo CHtml::link('Update', array('update', 'id' => $model->id), array('class' => 'btn btn-primary')); ?>
			<?php echo CHtml::link('List', array('index'), array('class' => 'btn btn-default')); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => 'Profile'));
			$this->widget('zii.widgets.CDetailView', array(
				'data' => $model,
				'attributes' => array(
					'first_name',
					'last_name',
					'company_name',
					'email',
					'phone',
				),
				'htmlOptions' => array('class' => 'table table-striped table-bordered detail-view'),
			));
			$this->endWidget();
			?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => 'Account'));
			$this->widget('zii.widgets.CDetailView', array(
				'data' => $model,
				'attributes' => array(
					'id',
					array(
						'name' => 'status',
						'value' => $model->getStatus($model->status),
					),
					array(
						'name' => 'is_inorganic',
						'label' => 'Affiliate Type',
						'value' => $model->getAffiliateType($model->is_inorganic),
					),
					'user_name',
					'cap_limit',
					'bucket',
					'bucket_limit',
					'min_bid_price',
					array(
						'name' => 'margin',
						'value' => $model->margin . '%',
					),
					array(
						'name' => 'isAdmin',
						'value' => ($model->isAdmin == 1) ? 'Yes' : 'No',
					),
					'createdAt',
				),
				'htmlOptions' => array('class' => 'table table-striped table-bordered detail-view'),
			));
			$this->endWidget();
			?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => 'Pixel'));
			$this->widget('zii.widgets.CDetailView', array(
				'data' => $model,
				'attributes' => array(
					array(
						'name' => 'pixel_type',
						'label' => 'Pixel Type',
						'value' => $model->getAffiliatePixelTypeString($model->pixel_type),
					),
					'pixel_count',
					array(
						'name' => 'pixel_code',
						'type' => 'raw',
						'value' => $model->pixel_code ? '<pre class="pixel-code-block">' . CHtml::encode($model->pixel_code) . '</pre>' : '—',
					),
				),
				'htmlOptions' => array('class' => 'table table-striped table-bordered detail-view'),
			));
			$this->endWidget();
			?>
		</div>
	</div>
</div>
<style>
.affiliate-view-page .page-header { margin-bottom: 1.5em; }
.affiliate-view-page .btn-toolbar .btn { margin-left: 0.5em; }
.affiliate-view-page .detail-view th { width: 30%; }
.affiliate-view-page .pixel-code-block { max-height: 200px; overflow: auto; font-size: 12px; white-space: pre-wrap; word-break: break-all; margin: 0; padding: 8px; background: #f5f5f5; border-radius: 4px; }
</style>
