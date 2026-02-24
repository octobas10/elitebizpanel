<?php
/* @var $this AutoFeedVendorController */
/* @var $model AutoFeedVendor */

$this->breadcrumbs=array(
	'Auto Feed Vendors'=>array('listvendor'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create List vendor', 'url'=>array('create')),
	array('label'=>'Manage List vendor', 'url'=>array('index')),
);
?>
<?php $this->renderPartial('_formvendor', array('model'=>$model)); ?>
