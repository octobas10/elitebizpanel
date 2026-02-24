<?php
/* @var $this LenderUserController */
/* @var $model LenderUser */

$this->breadcrumbs=array(
	'List Campus'=>array('index')
);
$this->menu=array(
	array('label'=>'List Campuses', 'url'=>array('index')),
);
?>
<h4>Create New Campus</h4>
<?php echo $this->renderPartial('_form', array('model'=>$model,'all_programs'=>$all_programs)); ?>
