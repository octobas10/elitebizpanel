<?php
$this->breadcrumbs = array('Affiliate User List');
$this->menu = array(
	array(
		'label' => 'Create New Affiliate User',
		'url' => array('create'),
	),
	array(
		'label' => 'Affiliate Stats',
		'url' => array('affiliatestats'),
	),
);

$totalCount = (int) $dataProvider_affiliate->getTotalItemCount();
$createUrl = $this->createUrl('create');
$statsUrl = $this->createUrl('affiliatestats');
$frontEndAuto = isset(Yii::app()->params['frontEndAuto']) ? trim(Yii::app()->params['frontEndAuto']) : '';
$httphost = isset(Yii::app()->params['httphost']) ? rtrim(trim(Yii::app()->params['httphost']), '/') : '';
if ($frontEndAuto !== '' && (strpos($frontEndAuto, 'http://') === 0 || strpos($frontEndAuto, 'https://') === 0)) {
	$promoBaseUrl = $frontEndAuto;
} elseif ($httphost !== '' && $frontEndAuto !== '') {
	$promoBaseUrl = $httphost . '/' . ltrim($frontEndAuto, '/');
} else {
	$promoBaseUrl = 'http://www.elitemortgagefinder.com';
}
?>
<section class="affiliates-page mortgage-dashboard-section">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">Affiliate Users</h1>
			<p class="affiliates-page-subtitle">
				<?php echo $totalCount === 0
					? 'No affiliate users yet. Create one to get started.'
					: Yii::app()->format->number($totalCount) . ' affiliate' . ($totalCount !== 1 ? 's' : '') . ' in total.'; ?>
			</p>
		</div>
		<div class="affiliates-page-actions">
			<a href="<?php echo CHtml::encode($statsUrl); ?>" class="btn btn-default affiliates-page-btn-secondary">Affiliate Stats</a>
			<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary affiliates-page-btn-primary">Create New Affiliate User</a>
		</div>
	</header>

	<div class="affiliates-page-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">All affiliates</span>
		</div>
		<div class="portlet-content">
			<?php if ($totalCount === 0): ?>
				<div class="dashboard-empty-state dashboard-empty-state-enhanced">
					<div class="dashboard-empty-state-icon" aria-hidden="true"></div>
					<h2 class="dashboard-empty-state-title">No affiliate users yet</h2>
					<p class="dashboard-empty-state-hint">Create your first affiliate user to manage promo codes, caps, and margins.</p>
					<div class="dashboard-empty-state-action">
						<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary">Create New Affiliate User</a>
					</div>
				</div>
			<?php else: ?>
				<div class="affiliates-grid-wrap dashboard-table-wrap">
					<?php
					$this->widget('zii.widgets.grid.CGridView', array(
						'id' => 'auto-affiliate-user-grid',
						'dataProvider' => $dataProvider_affiliate,
						'htmlOptions' => array('class' => 'affiliates-grid grid-view'),
						'itemsCssClass' => 'table table-bordered table-striped table-condensed table-hover',
						'columns' => array(
							'id',
							array(
								'name' => 'user_name',
								'value' => function ($data) use ($promoBaseUrl) {
									$url = $data->id
										? $promoBaseUrl . (strpos($promoBaseUrl, '?') !== false ? '&' : '?') . 'promo_code=' . (int) $data->id
										: '#';
									return CHtml::link(CHtml::encode($data->user_name), $url, array('target' => '_blank', 'rel' => 'noopener noreferrer', 'class' => 'affiliates-promo-link'));
								},
								'type' => 'raw',
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'password',
								'value' => '!empty($data->password) ? "••••••" : ""',
								'editable' => array(
									'url' => $this->createUrl('affiliates/UpdateMd5Password'),
									'type' => 'text',
								),
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'status',
								'filter' => $GLOBALS['status'],
								'editable' => array(
									'url' => $this->createUrl('affiliates/UpdateByData'),
									'type' => 'select',
									'source' => $GLOBALS['status'],
								),
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'cap_limit',
								'editable' => array(
									'url' => $this->createUrl('affiliates/UpdateByData'),
								),
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'margin',
								'editable' => array(
									'url' => $this->createUrl('affiliates/UpdateByData'),
									'type' => 'select',
									'source' => $model->margin_percent(),
								),
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'is_inorganic',
								'headerHtmlOptions' => array('class' => 'affiliates-col-type'),
								'filter' => $GLOBALS['affiliate_type'],
								'editable' => array(
									'url' => $this->createUrl('affiliates/UpdateByData'),
									'type' => 'select',
									'source' => $GLOBALS['affiliate_type'],
								),
							),
							array(
								'name' => 'bucket',
								'value' => function ($data) {
									if ($data['is_inorganic']) {
										echo '-';
									} else {
										echo Yii::app()->format->number(round($data['bucket'], 2));
									}
								},
								'htmlOptions' => array('class' => 'text-right'),
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'bucket_limit',
								'editable' => array(
									'url' => $this->createUrl('affiliates/UpdateByData'),
								),
								'htmlOptions' => array('class' => 'text-right'),
							),
							array(
								'class' => 'CButtonColumn',
								'htmlOptions' => array('class' => 'affiliates-actions-cell button-column'),
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
