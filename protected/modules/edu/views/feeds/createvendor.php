<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */

$this->breadcrumbs=array(
	'Edu Feed Vendors'=>array('listvendor'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Feed Vendors', 'url'=>array('listvendor')),
);
?>
<h4>Create Vendor</h4>
<?php $this->renderPartial('_formvendor', array('model'=>$model)); ?>
