<?php
/* @var $this FeedsController */
/* @var $model AutoFeedLenders */

$this->breadcrumbs = array(
	'Auto Feed Lenders',
);

$this->menu = array(
	array('label' => 'Create List lender', 'url' => array('createlender')),
);

$createUrl = $this->createUrl('createlender');
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
			'url' => 'Yii::app()->createUrl("mortgage/feeds/viewlender", array("id"=>$data->id))',
		),
		'update' => array(
			'url' => 'Yii::app()->createUrl("mortgage/feeds/updatelender", array("id"=>$data->id))',
		),
		'delete' => array(
			'url' => 'Yii::app()->createUrl("mortgage/feeds/deletelender", array("id"=>$data->id))',
		),
	),
);
?>
<section class="feeds-listlender-page mortgage-dashboard-section">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">List Lenders</h1>
			<p class="affiliates-page-subtitle">
				<?php echo $totalCount === 0
					? 'No feed lenders yet. Create one to get started.'
					: Yii::app()->format->number($totalCount) . ' lender' . ($totalCount !== 1 ? 's' : '') . ' in total.'; ?>
			</p>
		</div>
		<div class="affiliates-page-actions">
			<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary">Create List lender</a>
		</div>
	</header>

	<div class="affiliates-page-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">All lenders</span>
		</div>
		<div class="portlet-content">
			<?php if ($totalCount === 0): ?>
				<div class="dashboard-empty-state dashboard-empty-state-enhanced">
					<div class="dashboard-empty-state-icon" aria-hidden="true"></div>
					<h2 class="dashboard-empty-state-title">No lenders yet</h2>
					<p class="dashboard-empty-state-hint">Create your first feed lender to manage feed lender settings.</p>
					<div class="dashboard-empty-state-action">
						<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary">Create List lender</a>
					</div>
				</div>
			<?php else: ?>
				<div class="dashboard-table-wrap">
					<?php
					$this->widget('zii.widgets.grid.CGridView', array(
						'id' => 'auto-feed-lender-grid',
						'dataProvider' => $dataProvider,
						'filter' => $model,
						'htmlOptions' => array('class' => 'grid-view'),
						'itemsCssClass' => 'table table-bordered table-striped table-condensed table-hover',
						'columns' => array(
							'id',
							'feed_lender_name',
							'parameter1',
							'parameter2',
							'paused_vendor',
							'submission_cap',
							'interval',
							'delay',
							'status',
							'createdAt',
							$buttons,
						),
					));
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
