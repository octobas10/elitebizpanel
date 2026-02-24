<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */

$this->breadcrumbs=array(
	'Auto Feed Lenders'=>array('listlender'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Feed Lenders', 'url'=>array('create')),
	array('label'=>'Update Feed Lenders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Feed Lender', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FeedLenders', 'url'=>array('index')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'feed_lender_name',
		'password',
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
