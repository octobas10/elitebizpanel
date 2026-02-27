<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model LenderAffiliateSettings */

$this->breadcrumbs = array(
	'Lender Affiliate Setting',
);

$this->menu = array(
	array('label' => 'Create Lender Affiliate Setting', 'url' => array('create')),
);

$createUrl = $this->createUrl('create');
$totalCount = (int) $model->search()->getTotalItemCount();
?>
<section class="lender-affiliate-settings-page mortgage-dashboard-section">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">Affiliate Lender Settings</h1>
			<p class="affiliates-page-subtitle">
				<?php echo $totalCount === 0
					? 'No settings yet. Create one to assign caps per affiliate and lender.'
					: Yii::app()->format->number($totalCount) . ' setting' . ($totalCount !== 1 ? 's' : '') . ' in total.'; ?>
			</p>
		</div>
		<div class="affiliates-page-actions">
			<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary">Create Lender Affiliate Setting</a>
		</div>
	</header>

	<div class="affiliates-page-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Affiliate lender setting list</span>
		</div>
		<div class="portlet-content">
			<?php if ($totalCount === 0): ?>
				<div class="dashboard-empty-state dashboard-empty-state-enhanced">
					<div class="dashboard-empty-state-icon" aria-hidden="true"></div>
					<h2 class="dashboard-empty-state-title">No settings yet</h2>
					<p class="dashboard-empty-state-hint">Create a lender affiliate setting to link affiliates to lenders and set caps.</p>
					<div class="dashboard-empty-state-action">
						<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary">Create Lender Affiliate Setting</a>
					</div>
				</div>
			<?php else: ?>
				<div class="dashboard-table-wrap">
					<?php
					$this->widget('zii.widgets.grid.CGridView', array(
						'id' => 'lender-affiliate-settings-grid',
						'dataProvider' => $model->search(),
						'filter' => $model,
						'htmlOptions' => array('class' => 'grid-view'),
						'itemsCssClass' => 'table table-bordered table-striped table-condensed table-hover',
						'columns' => array(
							array('name' => 'id', 'headerHtmlOptions' => array('style' => 'width: 60px')),
							array(
								'name' => 'affiliate_user_id',
								'value' => '$data->affiliate->user_name',
							),
							array(
								'name' => 'lender_details_id',
								'value' => '$data->lender_details->user_name',
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'cap',
								'headerHtmlOptions' => array('style' => 'width: 60px'),
								'editable' => array(
									'url' => $this->createUrl('lenderAffiliateSettings/updateByData'),
								),
							),
							array(
								'class' => 'CButtonColumn',
								'viewButtonImageUrl' => false,
								'updateButtonImageUrl' => false,
								'deleteButtonImageUrl' => false,
								'viewButtonLabel' => '',
								'updateButtonLabel' => '',
								'deleteButtonLabel' => '',
								'viewButtonOptions' => array('class' => 'view btn btn-default btn-sm', 'title' => 'View'),
								'updateButtonOptions' => array('class' => 'update btn btn-default btn-sm', 'title' => 'Edit'),
								'deleteButtonOptions' => array('class' => 'delete btn btn-default btn-sm', 'title' => 'Delete'),
							),
						),
					));
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
