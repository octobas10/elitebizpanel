<?php
/* @var $this LenderUserController */
/* @var $model LenderUser */
$this->breadcrumbs=array(
	'Campus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
$this->menu=array(
	array('label'=>'Create New Campus', 'url'=>array('create')),
	array('label'=>'View This Campus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'List Campus', 'url'=>array('index')),
);
?>
<h4>Update Campus : <?php echo $model->campus_name;?> </h4>
<?php echo $this->renderPartial('_form', array('model'=>$model,'all_programs'=>$all_programs,'programsofcampus'=>$programsofcampus)); ?>
