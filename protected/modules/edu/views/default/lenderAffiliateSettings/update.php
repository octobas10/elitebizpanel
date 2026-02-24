<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $model LenderAffiliateSettings */
$this->breadcrumbs=array(
	'Lender Affiliate Setting'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
$this->menu=array(
	//array('label'=>'Manage Lender Affiliate Setting', 'url'=>array('index')),
	array('label'=>'Create Lender Affiliate Setting', 'url'=>array('create')),
	array('label'=>'View Lender Affiliate Setting', 'url'=>array('view', 'id'=>$model->id)),
);
?>
<?php echo $this->renderPartial('update_form', array('model'=>$model,'affiliate'=>$affiliate,'lender'=>$lender)); ?>
