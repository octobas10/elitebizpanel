<?php
/* @var $this LenderUserController */
/* @var $model LenderUser */
$this->breadcrumbs=array(
	'Lender Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
$this->menu=array(
	array('label'=>'Create New LenderUser', 'url'=>array('create')),
	array('label'=>'View This LenderUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'List LenderUser', 'url'=>array('index')),
);
?>
<h4>Update Lender : <?php echo $model->name;?> </h4>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
