<?php
$this->breadcrumbs = array(
	'Lender Details'
);
$this->menu = array(
	array(
		'label' => 'Create New Lender',
		'url' => array(
			'create'
		)
	)
);
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
	'id' => 'update-dialog',
	'options' => array(
		'title' => 'Paused Vendor',
		'autoOpen' => false,
		'width' => '585px'
	)
));
?>
<div class="update-dialog-content"></div>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
$updateJS = CHtml::ajax(array(
	'url' => "js:url",
	'data' => "js:form.serialize() + action",
	'type' => 'post',
	'dataType' => 'html',
	'success' => "function( data ){
		$( 'div.update-dialog-content' ).html( data );
	}"
));
Yii::app()->clientScript->registerScript('updateDialog',"
	function updateDialog(url,act){
		var action = '';
	  	var form = $('div.update-dialog-content form');
	  	if(url == false){
	  		action = '&action=' + act;
	    	url = form.attr('action');
	  	}
		{$updateJS}
	}");
?>
<h4>Lender Details</h4>
<?php
$this->widget('zii.widgets.grid.CGridView',array(
	'id' => 'lender-details-grid',
	'dataProvider' => $dataProvider,
	'filter' => $model,
	'columns' => array(
		'id',
		'user_name',
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'name',
			'editable' => array(
				'url' => $this->createUrl('lenders/UpdateByData')
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'submission_cap',
			'type' => 'textarea',
			'editable' => array(
				'url' => $this->createUrl('lenders/updateByData')
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'hourly_submission_cap',
			'type' => 'textarea',
			'editable' => array(
				'url' => $this->createUrl('lenders/updateByData')
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'accepted_cap',
			'type' => 'textarea',
			'editable' => array(
				'url' => $this->createUrl('lenders/updateByData')
			)
		),
		array(
			'filter' => $GLOBALS['status'],
			'class' => 'ext.editable.EditableColumn',
			'headerHtmlOptions' => array(
				'style' => 'width: 80px'
			),
			'name' => 'status',
			'editable' => array(
				'type' => 'select',
				'value' => 'LenderDetails::getStatus($data->status)',
				'url' => $this->createUrl('lenders/updateByData'),
				'source' => $GLOBALS['status']
			)
		),
		array(
			'template' => '{reply}',
			'header' => 'Paused Vendor',
			'headerHtmlOptions' => array(
				'style' => 'width: 102px'
			),
			'class' => 'CButtonColumn',
			'buttons' => array(
				'reply' => array(
					'label' => 'Paused Vendor',
					'url' => 'Yii::app()->createUrl("autoinsurance/lenders/data",array( "id" => $data->id ) )',
					'click' => "function( e ){
						e.preventDefault();
						$( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST
				    	updateDialog( $( this ).attr( 'href' ) );
				    	$( '#update-dialog' ).dialog( { title: 'Paused Vendors' } ).dialog( 'open' );
					}"
				)
			)
		),
		array(
			'class' => 'CButtonColumn'
		)
	)
));
?>
