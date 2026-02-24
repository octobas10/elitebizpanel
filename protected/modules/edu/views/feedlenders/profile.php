<style>
.info{font-size: 18px;color:red;margin: 10px 0;}
</style>
<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);

$this->breadcrumbs=array(
	'Update',
);
?>

<h4>Update</h4>
<h5 style="text-align: center;">Username: <?php echo $model->feed_lender_name;?> , Promo Code: <?php echo $model->id;?></h5>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success" role="alert">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php elseif(Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
