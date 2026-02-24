<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $model LenderAffiliateSettings */

$this->breadcrumbs=array(
	'Campus Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Manage Lender Affiliate Setting', 'url'=>array('index')),
	array('label'=>'Create Affiliate Setting', 'url'=>array('create')),
	array('label'=>'Update Affiliate Setting', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Affiliate Setting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name' => 'Campus Name',
			'value' => $model->campus_name,
         ),
		 array(
			'name' => 'Monthly Limit',
			'value' => $model->monthly_limit,
         ),
		 array(
			'name' => 'Weekly Limit',
			'value' => $model->weekly_limit,
         ),
		 array(
			'name' => 'Daily Limit',
			'value' => $model->daily_limit,
         ),		
	),
)); ?>
