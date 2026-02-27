<?php
$this->breadcrumbs = array('Leads' => array('leads/browsetransaction'), 'Export Leads');
$data = AffiliateUser::model()->findAll(array('select' => 'id,user_name'));
$aff_data = array();
foreach($data as $value){
	$aff_data[$value->id] = $value->user_name.'('.$value->id.')';
}
natcasesort($aff_data);
$date = Yii::app()->request->getParam('filter_date',date('Y-m-d'));
$promocode = Yii::app()->request->getParam('promo_code');
$lender = Yii::app()->request->getParam('lenders');
$state = Yii::app()->request->getParam('state');
$status = Yii::app()->request->getParam('status','-1');
$monthly_income = Yii::app()->request->getParam('monthly_income');
$stay_in_month = Yii::app()->request->getParam('stay_in_month');
$stay_in_year = Yii::app()->request->getParam('stay_in_year');
$employment_in_month = Yii::app()->request->getParam('employment_in_month');
$employment_in_year = Yii::app()->request->getParam('employment_in_year');
$age = Yii::app()->request->getParam('age');
$order = Yii::app()->request->getParam('order','-1');
$fields = Yii::app()->request->getParam('fields',Yii::app()->params['field']);
$gender = Yii::app()->request->getParam('gender','-1');
$lead_type = Yii::app()->request->getParam('lead_type','-1');
?>
<section class="leads-section mortgage-dashboard-section">
	<header class="leads-page-header">
		<h1 class="leads-page-title">Export Leads</h1>
		<p class="leads-page-subtitle">Filter leads by date, response, gender, state and other criteria, then export to CSV.</p>
	</header>
	<div class="row-fluid leads-toolbar-card">
		<div class="span12">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => 'Filters'));
			$form = $this->beginWidget('CActiveForm', array('id' => 'list_leads_id', 'enableAjaxValidation' => false));
			?>
			<div class="leads-filter-form">
				<div class="leads-filter-grid">
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="Filter_date">Date range</label>
						<div class="leads-filter-field">
							<?php $this->widget('ext.EDateRangePicker.EDateRangePicker', array('id' => 'Filter_date', 'name' => 'filter_date', 'value' => $date, 'options' => array('arrows' => true, 'closeOnSelect' => true), 'htmlOptions' => array('class' => 'inputClass'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Response</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('status', $status, array('-1' => 'Any', '1' => ACCEPTED, '0' => REJECTED), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Gender</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('gender', $gender, array('-1' => 'Any', '1' => 'Male', '0' => 'Female'), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="monthly_income">Min. monthly pay</label>
						<div class="leads-filter-field">
							<?php echo CHtml::textField('monthly_income', $monthly_income, array('id' => 'monthly_income', 'placeholder' => '500', 'maxlength' => '6')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Lead type</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('lead_type', $lead_type, array('-1' => 'Any', '1' => 'Organic', '0' => 'Inorganic'), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="promo_code">Promo code</label>
						<div class="leads-filter-field">
							<?php echo CHtml::dropDownList('promo_code[]', $promocode, $aff_data, array('multiple' => true, 'size' => '6', 'id' => 'promo_code')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="state">State</label>
						<div class="leads-filter-field">
							<?php echo CHtml::dropDownList('state[]', $state, Yii::app()->params['state'], array('multiple' => true, 'size' => '6', 'id' => 'state')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Time at address</label>
						<div class="leads-filter-field">
							<?php echo CHtml::dropDownList('stay_in_month', $stay_in_month, getMonthsArray()); ?>
							<?php echo CHtml::dropDownList('stay_in_year', $stay_in_year, getYearsArray()); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Time at job</label>
						<div class="leads-filter-field">
							<?php echo CHtml::dropDownList('employment_in_month', $employment_in_month, getMonthsArray()); ?>
							<?php echo CHtml::dropDownList('employment_in_year', $employment_in_year, getYearsArray()); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="age">Min. age</label>
						<div class="leads-filter-field">
							<?php echo CHtml::textField('age', $age, array('id' => 'age', 'placeholder' => '18')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Order</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('order', $order, array('-1' => 'Any', 'Asc' => 'Ascending', 'DESC' => 'Descending'), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="fields">Fields to download</label>
						<div class="leads-filter-field">
							<?php echo CHtml::dropDownList('fields[]', $fields, Yii::app()->params['field'], array('multiple' => true, 'size' => '6', 'id' => 'fields')); ?>
						</div>
					</div>
				</div>
				<div class="leads-filter-actions">
					<?php echo CHtml::submitButton('Export', array('class' => 'btn btn-primary', 'name' => 'export')); ?>
					<span class="leads-filter-hint">Use &quot; (double quotes) as text delimiter when opening the file.</span>
				</div>
			</div>
			<?php
			$this->endWidget();
			if (isset($NoDataFound)) {
				echo '<div class="leads-nodata"><p>No data found for this criteria.</p></div>';
			}
			$this->endWidget();
			?>
		</div>
	</div>
</section>
<?php 
function getMonthsArray(){
	for($i=0;$i<=11;$i++){
		$months[] = $i;
	}
	return array(0 => 'Month:') + $months;
}
function getYearsArray(){
	for($i=0;$i<=14;$i++){
		$years[] = $i;
	}
	return array(0 => 'Year:') + $years;
}
?>
