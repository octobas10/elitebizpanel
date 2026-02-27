<?php /* @var $this Controller */ ?>
<?php $this->beginContent('/layouts/main'); ?>
<div id="content" class="mortgage-portal-content">
	<?php
	$isDashboardIndex = (Yii::app()->controller->id === 'dashboard' && Yii::app()->controller->action->id === 'index');
	if (isset($this->breadcrumbs) && !$isDashboardIndex):
	?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Dashboard', Yii::app()->createUrl('default/index')),
			'htmlOptions'=>array('class'=>'breadcrumb mortgage-portal-breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif; ?>
    
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>
