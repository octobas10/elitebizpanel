<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */

$this->breadcrumbs=array(
	'Edu Feed Lenders'=>array('listlender'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Feed Lenders', 'url'=>array('listlender')),
);
?>
<h4>Create Lendor</h4>
<?php $this->renderPartial('_formlender', array('model'=>$model)); ?>
