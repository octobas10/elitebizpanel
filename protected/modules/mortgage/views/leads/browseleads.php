<?php
$this->breadcrumbs = array('Leads' => array('leads/browsetransaction'), 'Browse Leads');
?>
<section class="leads-section mortgage-dashboard-section">
	<header class="leads-page-header">
		<h1 class="leads-page-title">Browse Leads</h1>
		<p class="leads-page-subtitle">Search and export leads by date, affiliate, lender and post status.</p>
	</header>
	<div class="row-fluid leads-toolbar-card">
		<div class="span12">
			<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Filters')); ?>
			<?php
			$form = $this->beginWidget('CActiveForm', array('id' => 'list_leads_id', 'enableAjaxValidation' => false));
			$date = Yii::app()->getRequest()->getParam('filter_date', 'Today');
			$promo_code = Yii::app()->getRequest()->getParam('promo_code');
			$promo_code = is_array($promo_code) ? implode(',', $promo_code) : (isset($promo_code) ? (string) $promo_code : '');
			$lender_name = Yii::app()->getRequest()->getParam('lender_name');
			$lender_name = is_array($lender_name) ? implode("','", $lender_name) : (isset($lender_name) ? (string) $lender_name : '');
			$lead_status = Yii::app()->getRequest()->getParam('lead_status');
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
						<label class="leads-filter-label" for="promo_code">Affiliate (promo code)</label>
						<div class="leads-filter-field">
							<?php echo CHtml::dropDownList('promo_code[]', $promo_code, get_affiliate_name_and_promocode(), array('empty' => 'All Affiliates', 'multiple' => false, 'size' => '6', 'id' => 'promo_code')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="lender_name">Lenders</label>
						<div class="leads-filter-field">
							<?php echo CHtml::listBox('lender_name[]', $lender_name, CHtml::listData(LenderDetails::model()->findAll(), 'name', 'name'), array('empty' => 'All Lenders', 'multiple' => false, 'size' => '6', 'id' => 'lender_name')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Post status</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('lead_status', $lead_status, array('' => 'Any', '1' => ACCEPTED, '0' => REJECTED, '-1' => ERROR, '2' => RETURNED), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
				</div>
				<div class="leads-filter-actions">
					<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary', 'name' => 'search')); ?>
					<?php echo CHtml::submitButton('Export', array('class' => 'btn btn-default', 'name' => 'export')); ?>
					<?php echo CHtml::button('Reset', array('class' => 'btn btn-default', 'id' => 'reset')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
			<?php $this->endWidget(); ?>
		</div>
	</div>

	<?php
	$dataProvider = new CArrayDataProvider($posts); 
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'browse_leads',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => 'sub_date',
            'header' => 'Date Time',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'first_name',
            'header' => 'First Name',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'last_name',
            'header' => 'Last Name',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'email',
            'header' => 'Email',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'ssn',
            'header' => 'SSN',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'ipaddress',
            'header' => 'IP Address',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'promo_code',
            'header' => 'Affiliate',
        		'value' => function($row){
        			$aff_data = get_affiliate_name_and_promocode();
        			echo $aff_data[$row['promo_code']];
				},
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'lead_status',
            'header' => 'Lead Status',
            'value' => function($row){
                echo ($row['is_returned']==1) ? RETURNED : setResponseText($row['lead_status']);
            },
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'lender_id',
            'header' => 'Lender',
	        	'value' => function($row){
	        		$lender_data = get_lender_name_and_lender_id();
        			echo $lender_data[$row['lender_id']];
            },
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
        	'name' => 'lender_lead_price',
        	'header' => 'Price',
        	'htmlOptions' => array(
        		'style' => 'width:150px;'
        	)
       )
        )
	));
	$this->widget('CLinkPager', array('pages' => $pages));
	?>
</section>
<script>
$(document).ready(function(){
	$("#reset").click(function(){
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('ajax'); ?>/?reset=browse_searched_parameters',
			success: function(data) {
				window.location = window.location.pathname;
			}
		});
	});
});
</script>
