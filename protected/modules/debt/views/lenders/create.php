<?php
/* @var $this LenderUserController */
/* @var $model LenderUser */

$this->breadcrumbs=array(
	'Lender Users'=>array('index'),
	'Create',
);
$this->menu=array(
	array('label'=>'List Lender', 'url'=>array('index')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
