<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campus_name')); ?>:</b>
	<?php echo CHtml::encode($data->affiliate_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('daily_limit')); ?>:</b>
	<?php echo CHtml::encode($data->lender_details_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weekly_limit')); ?>:</b>
	<?php echo CHtml::encode($data->lender_details_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monthly_limit')); ?>:</b>
	<?php echo CHtml::encode($data->lender_details_id); ?>
	<br />
</div>
