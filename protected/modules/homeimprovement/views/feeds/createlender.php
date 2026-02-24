<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */

$this->breadcrumbs=array(
	'Auto Feed Lenders'=>array('listlender'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Feed Lenders', 'url'=>array('listlender')),
);
?>
<?php $this->renderPartial('_formlender', array('model'=>$model)); ?>
