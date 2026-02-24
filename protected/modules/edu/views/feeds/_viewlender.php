<?php
/* @var $this AutoFeedLendersController */
/* @var $data AutoFeedLenders */
?>
    <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Lendor Details</div>
</div>
<div class="portlet-content">
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('feed_lender_name')); ?>:</b>
	<?php echo CHtml::encode($data->feed_lender_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parameter1')); ?>:</b>
	<?php echo CHtml::encode($data->parameter1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parameter2')); ?>:</b>
	<?php echo CHtml::encode($data->parameter2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parameter3')); ?>:</b>
	<?php echo CHtml::encode($data->parameter3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paused_vendor')); ?>:</b>
	<?php echo CHtml::encode($data->paused_vendor); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('count')); ?>:</b>
	<?php echo CHtml::encode($data->count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interval')); ?>:</b>
	<?php echo CHtml::encode($data->interval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delay')); ?>:</b>
	<?php echo CHtml::encode($data->delay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdAt')); ?>:</b>
	<?php echo CHtml::encode($data->createdAt); ?>
	<br />

	*/ ?>

</div>
        </div>
</div>
