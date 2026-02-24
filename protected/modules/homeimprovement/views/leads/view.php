<?php
/* @var $this SubmissionsController */
/* @var $model Submissions */

$this->menu=array(
	array('label'=>'List Submissions', 'url'=>array('index')),
	array('label'=>'Create Submissions', 'url'=>array('create')),
	array('label'=>'Update Submissions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Submissions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Submissions', 'url'=>array('admin')),
);
?>

<h1>Customer <?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lead_mode',
		'promo_code',
		'sub_id',
		'first_name',
		'last_name',
		'gender',
		'address',
		'city',
		'state',
		'zip',
		'is_rented',
		'stay_in_year',
		'stay_in_month',
		'home_pay',
		'email',
		'phone',
		'mobile',
		'dob',
		'employer',
		'job_title',
		'employment_in_month',
		'employment_in_year',
		'work_phone',
		'income_type',
		'monthly_income',
		'ssn',
		'loan_amount',
		'bankruptcy',
		'best_time_contact',
		'ipaddress',
		'cosigner',
		'agree_credit_check',
		'url',
		'comments',
		'sub_date',
	),
)); ?>
