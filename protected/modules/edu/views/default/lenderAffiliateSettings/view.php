<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $model LenderAffiliateSettings */

$this->breadcrumbs=array(
	'Lender Affiliate Setting'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Manage Lender Affiliate Setting', 'url'=>array('index')),
	array('label'=>'Create Affiliate Setting', 'url'=>array('create')),
	array('label'=>'Update Affiliate Setting', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Affiliate Setting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
    <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Lender Affiliate Setting Details</div>
</div>
<div class="portlet-content">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name' => 'affiliate_user_id',
			'value' => $model->affiliate->user_name,
         ),
		 array(
			'name' => 'lender_details_id',
			'value' => $model->lender_details->user_name,
         ),
// 		'intervals',
		'cap',
// 		'paused_vendor',
// 		'orderby',
		/*array(
			'name' => 'status',
			'value' => $model->getStatus($model->status),
         ),
		 array(
                        'name' => 'isRoundRobin',
                        'value' => $model->getIsroundRobin($model->isRoundRobin),
         ),*/
		
	),
)); ?>
        </div>
</div>
