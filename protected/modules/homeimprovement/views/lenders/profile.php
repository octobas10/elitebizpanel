<style>
.info{font-size: 18px;color:red;margin: 10px 0;}
</style>
<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>
<h4>Update Affiliate</h4>
<h5 style="text-align: center;">Username: <?php echo $model->user_name;?> , Promo Code: <?php echo $model->id;?></h5>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
