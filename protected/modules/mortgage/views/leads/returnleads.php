<?php
$this->breadcrumbs = array('Leads' => array('leads/browsetransaction'), 'Return Leads');
$promo_code = Yii::app()->getRequest()->getParam('promo_code');
$lenders = Yii::app()->getRequest()->getParam('lenders');
$lead_status = Yii::app()->getRequest()->getParam('lead_status', 1);
$field = Yii::app()->getRequest()->getParam('field', 'email');
$field_value = Yii::app()->getRequest()->getParam('field_value');
$time = Yii::app()->getRequest()->getParam('time', 'hour');
$filter = Yii::app()->getRequest()->getParam('filter', date('m/d/Y'));
?>
<section class="leads-section mortgage-dashboard-section">
	<header class="leads-page-header">
		<h1 class="leads-page-title">Return Leads</h1>
		<p class="leads-page-subtitle">Search accepted or returned leads, then notify the affiliate of bad lead(s) with a reason.</p>
	</header>
	<div class="row-fluid leads-toolbar-card">
		<div class="span12">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => 'Filters'));
			$form = $this->beginWidget('CActiveForm', array('id' => 'return_leads_search', 'enableAjaxValidation' => false));
			?>
			<div class="leads-filter-form">
				<div class="leads-filter-grid">
					<div class="leads-filter-group">
						<label class="leads-filter-label">Time range</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('time', $time, array('hour' => '1 hour', 'day' => '1 day', 'week' => '1 week', 'month' => '1 month', 'quarter' => '3 months', 'specific_date' => 'Specific date'), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group datehide leads-datehide">
						<label class="leads-filter-label" for="Filter_date">Date range</label>
						<div class="leads-filter-field">
							<?php $this->widget('ext.EDateRangePicker.EDateRangePicker', array('id' => 'Filter_date', 'name' => 'filter', 'value' => $filter, 'options' => array('arrows' => true, 'closeOnSelect' => true), 'htmlOptions' => array('class' => 'inputClass'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="promo_code">Promo code</label>
						<div class="leads-filter-field">
							<?php echo CHtml::textField('promo_code', $promo_code, array('id' => 'promo_code')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="lenders">Lenders</label>
						<div class="leads-filter-field">
							<?php echo CHtml::listBox('lenders[]', $lenders, CHtml::listData(LenderDetails::model()->findAll(), 'name', 'name'), array('empty' => 'All Lenders', 'id' => 'lenders')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Post status</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('lead_status', $lead_status, array('1' => ACCEPTED, 'returned' => RETURNED), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Search by field</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('field', $field, array('email' => 'Email', 'first_name' => 'First name', 'last_name' => 'Last name', 'ipaddress' => 'IP address', 'ssn' => 'SS#'), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="field_value">Field value</label>
						<div class="leads-filter-field">
							<?php echo CHtml::textArea('field_value', $field_value, array('id' => 'field_value')); ?>
						</div>
					</div>
				</div>
				<div class="leads-filter-actions">
					<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary')); ?>
					<?php echo CHtml::submitButton('Export', array('class' => 'btn btn-default', 'name' => 'export')); ?>
					<?php echo CHtml::button('Reset', array('class' => 'btn btn-default', 'id' => 'reset')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<?php if (Yii::app()->user->hasFlash('success')): ?>
		<div class="leads-success-msg">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php endif; ?>
	<div class="row-fluid">
		<div class="span12">
			<?php $form = $this->beginWidget('CActiveForm', array('id' => 'return_leads')); ?>
			<p class="leads-summary">Total Result: <?php echo (int) $total; ?></p>
			<div class="leads-table-wrap">
				<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
<tr>
	<th><input type="checkbox" id="selectall" title="Select All"></th>
   <th>IP Address</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Affiliate</th>
	<th>Lead Status</th>
	<th>Lender</th>
	<th>Price</th>
	<th>Date</th>
</tr>
</thead>
<tbody>
<?php
foreach ($posts as $sub_leads) { ?>
	<tr class="post">
	<td><input type="checkbox" class="return" name="returns[]" title="Return this lead" value="<?php echo $sub_leads['id'];?>"></td>
	<td><?php echo urldecode($sub_leads['ipaddress']);?></td>
	<td><?php echo urldecode($sub_leads['first_name']);?></td>
	<td><?php echo urldecode($sub_leads['last_name']);?></td>
	<td><?php echo urldecode($sub_leads['email']);?></td>
	<td><?php $model = AffiliateUser::model()->findByPk($sub_leads['promo_code']); echo $model->user_name.' ('.$sub_leads['promo_code'].')';?></td>
	<td><?php echo ($sub_leads['is_returned']==1) ? $sub_leads['return_reason']  : setResponseText($sub_leads['lead_status'])?></td>
	<td><?php $model = LenderDetails::model()->findByPk($sub_leads['lender_id']);	echo $model->name;?></td>
	<td><?php echo urldecode($sub_leads['lender_lead_price']); ?></td>
	<td><?php echo $sub_leads['sub_date'];?></td>
	</tr>
<?php } ?>
				</tbody>
			</table>
			</div>
			<?php if (count($posts)): ?>
			<div class="leads-notify-card">
				<p class="reson_and_submit">Reason for Returned Lead : <input type="text" name="reason" class="reason" id="reason">&nbsp;&nbsp;
				<?php echo CHtml::submitButton('Notify Affiliate of Bad Lead(s)', array('class' => 'btn btn-primary', 'id' => 'return_leads_submit')); ?><br><br>
				</p>
				<?php if (isset($errors) && !empty($errors)): ?>
					<div id="error" class="leads-error-block" style="display: block;">
						<?php foreach ($errors as $error): ?>
							<p class="error"><?php echo CHtml::encode($error); ?></p>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div id="error" class="leads-error-block" style="display:none;"></div>
			</div>
			<?php endif;
			$this->endWidget();
			?>
		</div>
	</div>
</section>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
.mortgage-portal textarea#field_value { width: 220px; }
.mortgage-portal #reset { width: 78px; }
.infinite_navigation { display: none; }
p.reson_and_submit { text-align: center; }
.mortgage-portal .error { color: var(--portal-danger); }
.mortgage-portal div#error.leads-error-block { margin-left: 0; }
.mortgage-portal p.error { margin: 0; padding: 1px 13px; font-size: 0.9375rem; }
</style>
<?php
Yii::app()->clientScript->registerScript('myHideEffect', '$(".leads-success-msg").animate({opacity: 1.0}, 2000).fadeOut("slow");', CClientScript::POS_READY);
?>
<script>
$(document).ready(function() {
	var showChar = 120;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();
		if(content.length > showChar) {
			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);
			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
			$(this).html(html);
		}
	});
	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
		$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
	if('<?php echo addslashes($time); ?>'=='specific_date') $('.datehide').addClass('visible').show();
	$("input[name=time]").click(function(){
		if(jQuery(this).val()=='specific_date'){
			$('.datehide').addClass('visible').show();
		}else{
			$('.datehide').removeClass('visible').hide();
		}
	});
	$("#reset").click(function(){
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('ajax'); ?>/?reset=returned_leads_searched_parameters',
			success: function(data) {
				window.location = window.location.pathname;
			}
		});
	});
	$('#selectall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.return').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.return').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });

	$("#return_leads_submit").click(function(){
		var atLeastOneIsChecked = $('input[name="returns[]"]:checked').length;
		var reason = $("#reason").val();
		var error_msg = [];
		var error = 1;
		
		if(atLeastOneIsChecked=='0'){
			error_msg.push("<p class='error'>Please select any checkbox(s) from above results</p>");
			error = 0;
		}
		if(reason==''){
			error_msg.push("<p class='error'>Please specify reason to return the lead(s)</p>");
			error = 0;
		}
		if(error == 0){
			var error_msg_str = '';
			$.each(error_msg, function( index, value ) {
				error_msg_str = error_msg_str + value;
			});
			$("#error").show();
			$("#error").html(error_msg_str);
			return false;
		}
	});
});
</script>
