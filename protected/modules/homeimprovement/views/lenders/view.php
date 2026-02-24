<?php
/* @var $this LenderUserController */
/* @var $model LenderUser */

$this->breadcrumbs=array(
	'Lender Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create New LenderUser', 'url'=>array('create')),
	array('label'=>'Update LenderUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LenderUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'List LenderUser', 'url'=>array('index')),
);
?>
<h4>Lender : <?php echo $model->name;?> </h4>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		array(
            'name' => 'status',
            'value' => $model->getStatus($model->status)
        ),
		'user_name',
		'first_name',
		'last_name',
		'email',
		'phone',
		'company_name',
		'static_lead_price',
		'ping_url_test',
		'ping_url_live',
		'post_url_test',
		'post_url_live',
		'parameter1',
		'parameter2',
		'parameter3',
		'submission_cap',
		'accepted_cap',
		'paused_vendor',
		'posting_timelimit',
		'note',
		'createdAt',
		'margin',
		array(
			'name' => 'lender_pingpost_type',
			'value' => ($model->lender_pingpost_type==1) ? "Direct Buyer" : "Ping Post Buyer"
		),
	),
)); ?>
