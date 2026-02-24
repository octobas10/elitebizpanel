<?php
/* @var $this AutoAffiliateUserController */
/* @var $model AutoAffiliateUser */

$this->breadcrumbs=array(
	'Affiliate Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Affiliate User', 'url'=>array('index')),
);
?>
<div class="row">
    <div class="col-sm-12">
        <h4>Create New Affiliate</h4>
    </div>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
