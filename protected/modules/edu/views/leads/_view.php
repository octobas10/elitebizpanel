<?php
/* @var $this SubmissionsController */
/* @var $data Submissions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lead_mode')); ?>:</b>
	<?php echo CHtml::encode($data->lead_mode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promo_code')); ?>:</b>
	<?php echo CHtml::encode($data->promo_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_id')); ?>:</b>
	<?php echo CHtml::encode($data->sub_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zip')); ?>:</b>
	<?php echo CHtml::encode($data->zip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_rented')); ?>:</b>
	<?php echo CHtml::encode($data->is_rented); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stay_in_year')); ?>:</b>
	<?php echo CHtml::encode($data->stay_in_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stay_in_month')); ?>:</b>
	<?php echo CHtml::encode($data->stay_in_month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_pay')); ?>:</b>
	<?php echo CHtml::encode($data->home_pay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employer')); ?>:</b>
	<?php echo CHtml::encode($data->employer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_title')); ?>:</b>
	<?php echo CHtml::encode($data->job_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employment_in_month')); ?>:</b>
	<?php echo CHtml::encode($data->employment_in_month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employment_in_year')); ?>:</b>
	<?php echo CHtml::encode($data->employment_in_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('work_phone')); ?>:</b>
	<?php echo CHtml::encode($data->work_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('income_type')); ?>:</b>
	<?php echo CHtml::encode($data->income_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monthly_income')); ?>:</b>
	<?php echo CHtml::encode($data->monthly_income); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ssn')); ?>:</b>
	<?php echo CHtml::encode($data->ssn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('loan_amount')); ?>:</b>
	<?php echo CHtml::encode($data->loan_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bankruptcy')); ?>:</b>
	<?php echo CHtml::encode($data->bankruptcy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('best_time_contact')); ?>:</b>
	<?php echo CHtml::encode($data->best_time_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ipaddress')); ?>:</b>
	<?php echo CHtml::encode($data->ipaddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cosigner')); ?>:</b>
	<?php echo CHtml::encode($data->cosigner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agree_credit_check')); ?>:</b>
	<?php echo CHtml::encode($data->agree_credit_check); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_date')); ?>:</b>
	<?php echo CHtml::encode($data->sub_date); ?>
	<br />

	*/ ?>

</div>
