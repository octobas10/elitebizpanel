<?php
/* @var $this AutoFeedVendorController */
/* @var $model AutoFeedVendor */

$this->breadcrumbs=array(
	'Auto Feed Vendors'=>array('listvendor'),
	$model->id,
);

$this->menu=array(
	
	array('label'=>'Create List Vendor', 'url'=>array('create')),
	array('label'=>'Update List Vendor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete List Vendor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage List Vendor', 'url'=>array('index')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'uniqueness',
		'dup_days',
		'first_name',
		'last_name',
		'email',
		'company_name',
		'phone',
		'createdAt',
	),
)); ?>
