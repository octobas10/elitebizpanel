<?php
$this->breadcrumbs = array('Leads' => array('leads/browsetransaction'), 'Browse Transaction');
$filter = Yii::app()->getRequest()->getParam('filter',date('m/d/Y'));
$promo_code = Yii::app()->getRequest()->getParam('promo_code');
$lender_id = Yii::app()->getRequest()->getParam('lender_id');
$mortgage_lead_type = Yii::app()->getRequest()->getParam('mortgage_lead_type');
$ping_status = Yii::app()->getRequest()->getParam('ping_status');
$post_status = Yii::app()->getRequest()->getParam('post_status');
$field = Yii::app()->getRequest()->getParam('field','email');
$field_value = Yii::app()->getRequest()->getParam('field_value');
$time = Yii::app()->getRequest()->getParam('time','hour');
$post_request = Yii::app()->getRequest()->getParam('post_request');
?>
<section class="leads-section test-auto-lender-page mortgage-dashboard-section" id="top">
	<header class="leads-page-header">
		<h1 class="leads-page-title">Browse Transaction</h1>
		<p class="leads-page-subtitle">Search and view affiliate and lender transactions by date, promo code, lead type and status.</p>
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
						<label class="leads-filter-label">Time range</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('time', $time, array(
								'hour' => '1 hour',
								'day' => '1 day',
								'week' => '1 week',
								'month' => '1 month',
								'quarter' => '3 months',
								'specific_date' => 'Specific date'
							), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group datehide leads-datehide">
						<label class="leads-filter-label" for="Filter_date">Date range</label>
						<div class="leads-filter-field">
							<?php
							$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
								'id' => 'Filter_date',
								'name' => 'filter',
								'value' => $filter,
								'options' => array('arrows' => true, 'closeOnSelect' => true),
								'htmlOptions' => array('class' => 'inputClass'),
							));
							?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="promo_code">Promo code</label>
						<div class="leads-filter-field">
							<?php echo CHtml::textField('promo_code', $promo_code, array('id' => 'promo_code')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Lead type</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('mortgage_lead_type', $mortgage_lead_type, array('' => 'All', '1' => 'New Home', '2' => 'Refinance', '3' => 'Home Equity', '4' => 'Reverse Mortgage'), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Ping response</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('ping_status', $ping_status, array('' => 'Any', '1' => 'Accepted', '0' => 'Rejected', '-1' => 'Error'), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Post delivery</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('post_request', $post_request, array('' => 'Any', '1' => 'Yes', '0' => 'No'), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Post response</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('post_status', $post_status, array('' => 'Any', '1' => 'Accepted', '0' => 'Rejected', '-1' => 'Error'), array('labelOptions' => array('style' => 'display:inline'))); ?>
						</div>
						<div id="lender_id" style="display:none; margin-top:0.5rem;">
							<label class="leads-filter-label">Lender</label>
							<?php echo CHtml::listBox('lender_id', $lender_id, CHtml::listData(LenderDetails::model()->findAll(), 'id', 'name'), array('empty' => 'All Lenders')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Search by field</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php echo CHtml::radioButtonList('field', $field, array('email' => 'Email', 'first_name' => 'First name', 'last_name' => 'Last name', 'ipaddress' => 'IP address', 'universal_leadid' => 'Jornaya'), array('labelOptions' => array('style' => 'display:inline'))); ?>
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
					<?php echo CHtml::button('Reset', array('class' => 'btn btn-default', 'id' => 'reset')); ?>
				</div>
			</div>
			<?php $this->endWidget(); $this->endWidget(); ?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="leads-table-wrap">
				<table id="posts" class="table table-striped table-hover test-auto-lender-results">
<thead>
	<tr><th colspan="4" class="test-auto-lender-count"><?php echo (int) $total; ?> record(s)</th></tr>
	<tr>
		<th>Date</th>
		<th>Affiliate (Code)</th>
		<th>Affiliate Transaction</th>
		<th>Lender Transaction</th>
	</tr>
</thead>
<tbody>
<?php foreach ($posts as $aff_trans) { ?>
	<tr class="post">
		<td><?php echo CHtml::encode($aff_trans['date']); ?></td>
		<td><?php
			$model = AffiliateUser::model()->findByPk($aff_trans['promo_code']);
			$name = $model ? CHtml::encode($model->user_name) : '—';
			$code = CHtml::encode($aff_trans['promo_code']);
			?><span class="txn-affiliate-name"><?php echo $name; ?></span> <span class="txn-promo-code">(<?php echo $code; ?>)</span></td>
		<td>
			<div class="txn-block txn-block--affiliate">
				<?php
				$s = isset($aff_trans['ping_status']) ? $aff_trans['ping_status'] : '';
				$p_cls = $s === '1' ? 'leads-status--accepted' : ($s === '0' ? 'leads-status--rejected' : 'leads-status--error');
				$p_lbl = $s === '1' ? (defined('ACCEPTED') ? ACCEPTED : 'ACCEPTED') : ($s === '0' ? (defined('REJECTED') ? REJECTED : 'REJECTED') : ($s === '-1' ? (defined('ERROR') ? ERROR : 'ERROR') : '—'));
				$s2 = isset($aff_trans['post_status']) ? $aff_trans['post_status'] : '';
				$po_cls = $s2 === '1' ? 'leads-status--accepted' : ($s2 === '0' ? 'leads-status--rejected' : 'leads-status--error');
				$po_lbl = $s2 === '1' ? (defined('ACCEPTED') ? ACCEPTED : 'ACCEPTED') : ($s2 === '0' ? (defined('REJECTED') ? REJECTED : 'REJECTED') : ($s2 === '-1' ? (defined('ERROR') ? ERROR : 'ERROR') : '—'));
				?>
				<div class="txn-status-row">
					<span class="txn-status-item"><strong>Ping</strong> <span class="leads-status <?php echo $p_cls; ?>"><?php echo CHtml::encode($p_lbl); ?></span></span>
					<span class="txn-status-item"><strong>Post</strong> <span class="leads-status <?php echo $po_cls; ?>"><?php echo CHtml::encode($po_lbl); ?></span></span>
				</div>
				<?php if (!empty($aff_trans['ping_request'])) { ?>
				<details class="txn-detail">
					<summary>Ping Request</summary>
					<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars(urldecode($aff_trans['ping_request']), ENT_QUOTES, 'UTF-8'); ?></div>
				</details>
				<?php } ?>
				<?php if (!empty($aff_trans['ping_time']) && $aff_trans['ping_time'] !== '0.0000') { ?>
				<details class="txn-detail">
					<summary>Ping response time</summary>
					<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($aff_trans['ping_time'], ENT_QUOTES, 'UTF-8'); ?></div>
				</details>
				<?php } ?>
				<?php if (!empty($aff_trans['ping_response'])) { ?>
				<details class="txn-detail">
					<summary>Ping Response</summary>
					<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($aff_trans['ping_response'], ENT_QUOTES, 'UTF-8'); ?></div>
				</details>
				<?php } ?>
				<?php if (!empty($aff_trans['post_request'])) { ?>
				<details class="txn-detail">
					<summary>Post Request</summary>
					<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars(urldecode($aff_trans['post_request']), ENT_QUOTES, 'UTF-8'); ?></div>
				</details>
				<?php } ?>
				<?php if (!empty($aff_trans['post_response'])) { ?>
				<details class="txn-detail">
					<summary>Post Response</summary>
					<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($aff_trans['post_response'], ENT_QUOTES, 'UTF-8'); ?></div>
				</details>
				<?php } ?>
				<?php if (!empty($aff_trans['post_time']) && $aff_trans['post_time'] !== '0.0000') { ?>
				<details class="txn-detail">
					<summary>Post response time</summary>
					<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($aff_trans['post_time'], ENT_QUOTES, 'UTF-8'); ?></div>
				</details>
				<?php } ?>
			</div>
		</td>
		<td>
			<div class="txn-lenders">
			<?php foreach ($aff_trans->lender_trnas as $len_trans) {
				$ls = isset($len_trans['ping_status']) ? $len_trans['ping_status'] : '';
				$lp_cls = $ls === '1' ? 'leads-status--accepted' : ($ls === '0' ? 'leads-status--rejected' : 'leads-status--error');
				$lp_lbl = $ls === '1' ? (defined('ACCEPTED') ? ACCEPTED : 'ACCEPTED') : ($ls === '0' ? (defined('REJECTED') ? REJECTED : 'REJECTED') : ($ls === '-1' ? (defined('ERROR') ? ERROR : 'ERROR') : '—'));
				$ls2 = isset($len_trans['post_status']) ? $len_trans['post_status'] : '';
				$lpo_cls = $ls2 === '1' ? 'leads-status--accepted' : ($ls2 === '0' ? 'leads-status--rejected' : 'leads-status--error');
				$lpo_lbl = $ls2 === '1' ? (defined('ACCEPTED') ? ACCEPTED : 'ACCEPTED') : ($ls2 === '0' ? (defined('REJECTED') ? REJECTED : 'REJECTED') : ($ls2 === '-1' ? (defined('ERROR') ? ERROR : 'ERROR') : '—'));
			?>
				<div class="txn-lender-card">
					<div class="txn-lender-header">
						<div class="txn-lender-header-main">
							<span class="txn-lender-name"><?php echo CHtml::encode($len_trans['lender_name']); ?></span>
							<span class="txn-lender-badges">
								<span class="txn-status-item"><strong>Ping</strong> <span class="leads-status <?php echo $lp_cls; ?>"><?php echo CHtml::encode($lp_lbl); ?></span></span>
								<span class="txn-status-item"><strong>Post</strong> <span class="leads-status <?php echo $lpo_cls; ?>"><?php echo CHtml::encode($lpo_lbl); ?></span></span>
							</span>
						</div>
						<span class="txn-lender-price">Ping: <?php echo '$' . CHtml::encode($len_trans['ping_price']); ?> · Post: <?php echo '$' . CHtml::encode($len_trans['post_price']); ?></span>
					</div>
					<div class="txn-lender-details">
						<?php if (!empty($len_trans['ping_request'])) { ?>
						<details class="txn-detail">
							<summary>Ping Data</summary>
							<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars(urldecode($len_trans['ping_request']), ENT_QUOTES, 'UTF-8'); ?></div>
						</details>
						<?php } ?>
						<?php if (!empty($len_trans['ping_response'])) { ?>
						<details class="txn-detail">
							<summary>Ping Response</summary>
							<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($len_trans['ping_response'], ENT_QUOTES, 'UTF-8'); ?></div>
						</details>
						<?php } ?>
						<?php if (!empty($len_trans['ping_time']) && $len_trans['ping_time'] !== '0.00') { ?>
						<details class="txn-detail">
							<summary>Ping Time</summary>
							<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($len_trans['ping_time'], ENT_QUOTES, 'UTF-8'); ?></div>
						</details>
						<?php } ?>
						<?php if (!empty($len_trans['post_request'])) { ?>
						<details class="txn-detail">
							<summary>Post Data</summary>
							<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars(urldecode($len_trans['post_request']), ENT_QUOTES, 'UTF-8'); ?></div>
						</details>
						<?php } ?>
						<?php if (!empty($len_trans['post_response'])) { ?>
						<details class="txn-detail">
							<summary>Post Response</summary>
							<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars(html_entity_decode($len_trans['post_response']), ENT_QUOTES, 'UTF-8'); ?></div>
						</details>
						<?php } ?>
						<?php if (!empty($len_trans['post_time']) && $len_trans['post_time'] !== '0.00') { ?>
						<details class="txn-detail">
							<summary>Post Time</summary>
							<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($len_trans['post_time'], ENT_QUOTES, 'UTF-8'); ?></div>
						</details>
						<?php } ?>
						<?php if (!empty($len_trans['exit_url'])) { ?>
						<details class="txn-detail">
							<summary>Exit URL (Redirect)</summary>
							<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($len_trans['exit_url'], ENT_QUOTES, 'UTF-8'); ?></div>
						</details>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			</div>
		</td>
	</tr>
<?php } ?>
</tbody>
				</table>
				<?php if (isset($pages) && $pages->pageCount > 1): ?>
				<div class="pager">
					<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<style>
.mortgage-portal textarea#field_value { width: 200px; }
.mortgage-portal #reset { width: 78px; }
.infinite_navigation { display: none; }
</style>
<script>
$(document).ready(function() {
	$("input[name=post_status]").change(function(){
		if($(this).val()=='1'){
			$('#lender_id').show();
		}else{
			$('#lender_id').hide();
		}
	});
	if('<?php echo addslashes($post_status); ?>'=="1"){ $('#lender_id').show();}else{$('#lender_id').hide();}
	if('<?php echo addslashes($time); ?>'=='specific_date') $('.datehide').addClass('visible').show();
	$("input[name=time]").click(function(){
		if($(this).val()=='specific_date'){
			$('.datehide').addClass('visible').show();
		}else{
			$('.datehide').removeClass('visible').hide();
		}
	});
	$("#reset").click(function(){
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('ajax'); ?>/?reset=browse_searched_parameters',
			success: function() {
				window.location = window.location.pathname;
			}
		});
	});
});
</script>
