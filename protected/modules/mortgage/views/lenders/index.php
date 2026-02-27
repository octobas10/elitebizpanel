<?php
$this->breadcrumbs = array('Lender Details');
$this->menu = array(
	array('label' => 'Create New Lender', 'url' => array('create')),
);

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id' => 'update-dialog',
	'options' => array(
		'title' => 'Paused Vendor',
		'autoOpen' => false,
		'width' => '585px',
	),
));
?>
<div class="update-dialog-content"></div>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');

$updateJS = CHtml::ajax(array(
	'url' => 'js:url',
	'data' => 'js:form.serialize() + action',
	'type' => 'post',
	'dataType' => 'html',
	'success' => "function( data ){
		$( 'div.update-dialog-content' ).html( data );
	}",
));
Yii::app()->clientScript->registerScript('updateDialog', "
	function updateDialog(url,act){
		var action = '';
		var form = $('div.update-dialog-content form');
		if(url == false){
			action = '&action=' + act;
			url = form.attr('action');
		}
		{$updateJS}
	}
");
$createUrl = $this->createUrl('create');
$reportUrl = $this->createUrl('lenderreport');
$statsUrl = $this->createUrl('lenderstats');
$totalCount = (int) $dataProvider->getTotalItemCount();
?>
<section class="lenders-page mortgage-dashboard-section">
	<header class="lenders-page-header">
		<div class="lenders-page-header-inner">
			<h1 class="lenders-page-title">Lender Details</h1>
			<p class="lenders-page-subtitle">
				<?php echo $totalCount === 0
					? 'No lenders yet. Create one to get started.'
					: Yii::app()->format->number($totalCount) . ' lender' . ($totalCount !== 1 ? 's' : '') . ' in total.'; ?>
			</p>
		</div>
		<div class="lenders-page-actions">
			<a href="<?php echo CHtml::encode($statsUrl); ?>" class="btn btn-default">Lender Stats</a>
			<a href="<?php echo CHtml::encode($reportUrl); ?>" class="btn btn-default">Lender Report</a>
			<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary">Create New Lender</a>
		</div>
	</header>

	<div class="lenders-page-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">All lenders</span>
		</div>
		<div class="portlet-content">
			<?php if ($totalCount === 0): ?>
				<div class="dashboard-empty-state dashboard-empty-state-enhanced">
					<div class="dashboard-empty-state-icon" aria-hidden="true"></div>
					<h2 class="dashboard-empty-state-title">No lenders yet</h2>
					<p class="dashboard-empty-state-hint">Create your first lender to manage caps, margins, and lead flow.</p>
					<div class="dashboard-empty-state-action">
						<a href="<?php echo CHtml::encode($createUrl); ?>" class="btn btn-primary">Create New Lender</a>
					</div>
				</div>
			<?php else: ?>
				<div class="lenders-grid-wrap dashboard-table-wrap">
					<?php
					$this->widget('zii.widgets.grid.CGridView', array(
						'id' => 'lender-details-grid',
						'dataProvider' => $dataProvider,
						'filter' => $model,
						'htmlOptions' => array('class' => 'lenders-grid grid-view'),
						'itemsCssClass' => 'table table-bordered table-striped table-condensed table-hover',
						'columns' => array(
							'id',
							'user_name',
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'name',
								'editable' => array(
									'url' => $this->createUrl('lenders/UpdateByData'),
								),
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'submission_cap',
								'type' => 'textarea',
								'editable' => array(
									'url' => $this->createUrl('lenders/updateByData'),
								),
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'hourly_submission_cap',
								'type' => 'textarea',
								'editable' => array(
									'url' => $this->createUrl('lenders/updateByData'),
								),
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'accepted_cap',
								'type' => 'textarea',
								'editable' => array(
									'url' => $this->createUrl('lenders/updateByData'),
								),
							),
							array(
								'class' => 'ext.editable.EditableColumn',
								'name' => 'margin',
								'editable' => array(
									'url' => $this->createUrl('lenders/UpdateByData'),
									'type' => 'select',
									'source' => $model->margin_percent(),
								),
							),
							array(
								'filter' => $GLOBALS['status'],
								'class' => 'ext.editable.EditableColumn',
								'headerHtmlOptions' => array('style' => 'width: 80px'),
								'name' => 'status',
								'editable' => array(
									'type' => 'select',
									'value' => 'LenderDetails::getStatus($data->status)',
									'url' => $this->createUrl('lenders/updateByData'),
									'source' => $GLOBALS['status'],
								),
							),
							array(
								'template' => '{reply}',
								'header' => 'Paused Vendor',
								'headerHtmlOptions' => array('style' => 'width: 102px'),
								'class' => 'CButtonColumn',
								'buttons' => array(
									'reply' => array(
										'label' => 'Paused Vendor',
										'url' => 'Yii::app()->createUrl("mortgage/lenders/data", array("id" => $data->id))',
										'click' => "function( e ){
											e.preventDefault();
											$( '#update-dialog' ).children( ':eq(0)' ).empty();
											updateDialog( $( this ).attr( 'href' ) );
											$( '#update-dialog' ).dialog( { title: 'Paused Vendors' } ).dialog( 'open' );
										}",
									),
								),
							),
							array(
								'class' => 'CButtonColumn',
								'htmlOptions' => array('class' => 'button-column'),
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
