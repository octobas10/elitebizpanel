<style>
    .table_wrapper {
        overflow: hidden;
        overflow-x: auto;
    }
    #edu-feed-lenders-grid {
        width: 1080px;
    }
/*
    #edu-feed-lenders-grid table th {
        min-width: 120px;
    }
*/
</style>

<?php
/* @var $this FeedController */
/* @var $model AutoFeedLenders */
$this->breadcrumbs=array(
	'Edu Feed Lenders'=>array('listlender'),
	'Manage',
);
$this->menu=array(
	array('label'=>'Create Feed Lenders', 'url'=>array('createlender')),
);
?>
<h4>Feed Lenders</h4>
    <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Lender List</div>
</div>
<div class="portlet-content table_wrapper">
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#edu-feed-lenders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php //echo CHtml::ajaxLink('Link',$this->createUrl('edu/feeds/data/id/1'),array('success'=>'function(r){$("#mydialog").html(r).dialog("open"); return false;}'),array('id'=>'showJuiDialog'));?>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchlender',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div id="x"></div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'update-dialog',
		'options'=>array(
			'title'=>'Paused Vendor',
			'autoOpen'=>false,
			'width'=>'585px',
		),
));
?>
<div class="update-dialog-content"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<?php
$updateJS = CHtml::ajax( array(
		'url' => "js:url",
		'data' => "js:form.serialize() + action",
		'type' => 'post',
		'dataType' => 'html',
		'success' => "function( data ){
      		$( 'div.update-dialog-content' ).html( data );
		}"
));

Yii::app()->clientScript->registerScript( 'updateDialog', "
		function updateDialog( url, act ){
			var action = '';
		  	var form = $( 'div.update-dialog-content form' );
		  	if( url == false ){
		  		action = '&action=' + act;
		    	url = form.attr( 'action' );
		  	}
			{$updateJS}
		}"
	);
?>
<?php
$buttons = array(
			'header'=>'Options',
			'class'=>'CButtonColumn','template'=>'{view} {update} {delete}',
			'buttons'=>array(
				'view'=>
					array(					
						'url'=>'Yii::app()->createUrl("edu/feeds/viewlender", array("id"=>$data->id))',								
					),
				'update'=>
					array(
						'url'=>'Yii::app()->createUrl("edu/feeds/updatelender", array("id"=>$data->id))',
					),
				'delete'=>
					array(
						'url'=>'Yii::app()->createUrl("edu/feeds/deletelender", array("id"=>$data->id))',
					),
			),
		);
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'edu-feed-lenders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		'id',
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'id',
			'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array(
			'url' => $this->createUrl('id'),
			)
		),
		'feed_lender_name',
			
		array(
				'template' => '{reply}',
				'header'=>'Paused Vandor',
				'headerHtmlOptions' => array('style' => 'width: 120px'),
				'class'=>'CButtonColumn',
				'buttons'=>array(
						'reply' => array(
							'label' => 'Paused Vendor',
							'url' => 'Yii::app()->createUrl("edu/feeds/data",array( "id" => $data->id ) )',
							'click' => "function( e ){
								e.preventDefault();
								$( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST
						    	updateDialog( $( this ).attr( 'href' ) );
						    	$( '#update-dialog' ).dialog( { title: 'Paused Vendors' } ).dialog( 'open' );
							}"
						),
				),
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'submission_cap',
			//we need not to set value, it will be auto-taken from source
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
			'url' => $this->createUrl('updateByData'),
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'interval',
			//we need not to set value, it will be auto-taken from source
			'headerHtmlOptions' => array('style' => 'width: 90px'),
			'editable' => array(
			'url' => $this->createUrl('updateByData'),
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'delay',
			//we need not to set value, it will be auto-taken from source
			'headerHtmlOptions' => array('style' => 'width: 90px'),
			'editable' => array(
				'url' => $this->createUrl('updateByData'),
			)
		),
		array(
		    'filter' => array(1 => 'Live',0 => 'Inactive', 2 => 'Legacy'),
			'class' => 'ext.editable.EditableColumn',
			'name' => 'status',
			'headerHtmlOptions' => array('style' => 'width: 90px'),
			'editable' => array(
				'type' => 'select',
				'value' =>'EduFeedLenders::getStatus($data->status)',
				'url' => $this->createUrl('updateByData'),
				'source' => array(1 => 'Live',0 => 'Inactive', 2 => 'Legacy'),
			)
		),
		$buttons
	),
)); ?>
        </div>
</div>
