<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */
$this->menu=array(
	array('label'=>'Create AutoAffiliateUser', 'url'=>array('create')),
);
?>
<h1>Auto Affiliate Users</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auto-affiliate-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	    'user_name',
		'id',
		'createdAt',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
