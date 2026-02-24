<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */
$this->breadcrumbs=array(
	'Auto Affiliate Users'=>array('view', 'id'=>$model->id),
	$model->id,
);
$this->menu=array(
	array('label'=>'Create New Affiliate User', 'url'=>array('create')),
	array('label'=>'Update This User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete This User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'List Affiliate User', 'url'=>array('index')),
);
?>
<h4>Affiliate : <?php echo $model->user_name;?> </h4>
<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name' => 'status',
			'value' => $model->getStatus($model->status)
		),
		array(
			'name' => 'is_inorganic',
			'label' => 'Affiliate Type',
			'value' => $model->getAffiliateType($model->is_inorganic)
		),
		'user_name',
		'email',
		'first_name',
		'last_name',
		'company_name',
		'phone',
		'cap_limit',
		'bucket',
		'bucket_limit',
		'min_bid_price',
		array(
			'name' => 'pixel_type',
			'label' => 'Pixel Type',
			'value' => $model->getAffiliatePixelTypeString($model->pixel_type)
		),
 		'pixel_count',
		'pixel_code',
		array(
			'name' => 'margin',
			'value' => $model->margin.'%'
		),
		array(
			'name' => 'isAdmin',
			'value' => ($model->isAdmin==1) ? "Yes" : "No"
		),
		'createdAt'
	),
));
?>
