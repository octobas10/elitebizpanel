<style>    
    .table_wrapper{
        overflow: hidden;
        overflow-x: auto;
    }
</style>
<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */

$this->breadcrumbs=array(
	'Edu Feed Lenders'=>array('listlender'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Feed Lenders', 'url'=>array('create')),
	array('label'=>'Update Feed Lenders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Feed Lender', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FeedLenders', 'url'=>array('index')),
);
?>
    <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Vendor Details</div>
</div>
<div class="portlet-content table_wrapper">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'feed_lender_name',
		'email',
		'parameter1',
		'parameter2',
		'parameter3',
		'paused_vendor',
		'submission_cap',
		'interval',
		'delay',
		'status',
		'createdAt',
	),
)); ?>
        </div>
</div>
