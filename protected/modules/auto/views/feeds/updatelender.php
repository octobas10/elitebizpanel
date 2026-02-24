<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */

$this->breadcrumbs=array(
	'Auto Feed Lenders'=>array('listlender'),$model->id=>array('view','id'=>$model->id),'Update');
// MENU TO THE LEFT 
$this->menu=array(
	array('label'=>'Create Feed Lenders', 'url'=>array('createlender')),
	array('label'=>'Manage Feed Lenders', 'url'=>array('listlender')),
);
?>
<?php $this->renderPartial('_formlender', array('model'=>$model)); ?>
