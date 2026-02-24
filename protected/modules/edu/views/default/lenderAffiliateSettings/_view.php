<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $data LenderAffiliateSettings */
?>
    <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Lender Affiliate Setting Details</div>
</div>
<div class="portlet-content">
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('affiliate_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->affiliate_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lender_details_id')); ?>:</b>
	<?php echo CHtml::encode($data->lender_details_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interval')); ?>:</b>
	<?php echo CHtml::encode($data->interval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cap')); ?>:</b>
	<?php echo CHtml::encode($data->cap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderby')); ?>:</b>
	<?php echo CHtml::encode($data->orderby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('isRoundRobin')); ?>:</b>
	<?php echo CHtml::encode($data->isRoundRobin); ?>
	<br />

	*/ ?>

</div>
        </div>
</div>
