<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */

$this->breadcrumbs=array(
	'Auto Feed Lenders'=>array('listvendor'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Feed Lenders', 'url'=>array('listvendor')),
);
?>
<?php $this->renderPartial('_formvendor', array('model'=>$model)); ?>
