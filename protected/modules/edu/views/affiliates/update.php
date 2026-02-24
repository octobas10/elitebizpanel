<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */

$this->breadcrumbs=array(
	'Affiliate Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create New Affiliate User', 'url'=>array('create')),
	array('label'=>'View This Affiliate User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'List Affiliate User', 'url'=>array('index')),
);
if(Yii::app()->user->hasFlash('error')): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo Yii::app()->user->getFlash('error'); ?>
			</div>
<?php endif; ?>
<h4>Update Affiliate : <?php echo $model->user_name;?> </h4>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
