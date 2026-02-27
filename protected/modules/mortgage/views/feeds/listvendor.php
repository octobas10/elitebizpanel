<?php
/* @var $this FeedController */
/* @var $model AutoFeedVendor */

$this->breadcrumbs = array(
	'Auto Feed Vendors',
);

$this->menu = array(
	array('label' => 'Create List vendor', 'url' => array('createvendor')),
);

$createUrl = $this->createUrl('createvendor');
$dataProvider = $model->search();
$totalCount = (int) $dataProvider->getTotalItemCount();

$buttons = array(
	'header' => 'Options',
	'class' => 'CButtonColumn',
	'template' => '{view} {update} {delete}',
	'viewButtonImageUrl' => false,
	'updateButtonImageUrl' => false,
	'deleteButtonImageUrl' => false,
	'viewButtonLabel' => '',
	'updateButtonLabel' => '',
	'deleteButtonLabel' => '',
	'viewButtonOptions' => array('class' => 'view btn btn-default btn-sm', 'title' => 'View'),
	'updateButtonOptions' => array('class' => 'update btn btn-default btn-sm', 'title' => 'Edit'),
	'deleteButtonOptions' => array('class' => 'delete btn btn-default btn-sm', 'title' => 'Delete'),
	'buttons' => array(
		'view' => array(
			'url' => 'Yii::app()->createUrl("mortgage/feeds/viewvendor", array("id"=>$data->id))',
		),
		'update' => array(
			'url' => 'Yii::app()->createUrl("mortgage/feeds/updatevendor", array("id"=>$data->id))',
		),
		'delete' => array(
			'url' => 'Yii::app()->createUrl("mortgage/feeds/deletevendor", array("id"=>$data->id))',
		),
	),
);
?>
<section class="feeds-listvendor-page mortgage-dashboard-section">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">List Vendors</h1>
			<p class="affiliates-page-subtitle">
				<?php echo $totalCount === 0
					? 'No feed vendors yet. Create one to get started.'
					: Yii::app()->format->number($totalCount) . ' vendor' . ($totalCount !== 1 ? 's' : '') . ' in total.'; ?>
			</p>
		</div>
		<div class="affiliates-page-actions">
			<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary">Create List vendor</a>
		</div>
	</header>

	<div class="affiliates-page-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">All vendors</span>
		</div>
		<div class="portlet-content">
			<?php if ($totalCount === 0): ?>
				<div class="dashboard-empty-state dashboard-empty-state-enhanced">
					<div class="dashboard-empty-state-icon" aria-hidden="true"></div>
					<h2 class="dashboard-empty-state-title">No vendors yet</h2>
					<p class="dashboard-empty-state-hint">Create your first feed vendor to manage usernames and uniqueness settings.</p>
					<div class="dashboard-empty-state-action">
						<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary">Create List vendor</a>
					</div>
				</div>
			<?php else: ?>
				<div class="dashboard-table-wrap">
					<?php
					$this->widget('zii.widgets.grid.CGridView', array(
						'id' => 'auto-feed-vendor-grid',
						'dataProvider' => $dataProvider,
						'filter' => $model,
						'htmlOptions' => array('class' => 'grid-view'),
						'itemsCssClass' => 'table table-bordered table-striped table-condensed table-hover',
						'columns' => array(
							'id',
							'username',
							array(
								'class' => 'ext.editable.EditableColumn',
								'filter' => array(1 => 'Global', 0 => 'Local'),
								'name' => 'uniqueness',
								'editable' => array(
									'type' => 'select',
									'url' => $this->createUrl('autoFeedVendor/updateByData'),
									'source' => array(1 => 'Global', 0 => 'Local'),
								),
							),
							'dup_days',
							$buttons,
						),
					));
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
