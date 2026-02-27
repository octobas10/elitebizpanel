<?php
$this->breadcrumbs = array('Affiliate User List' => array('index'), 'Affiliate Stats');
$this->menu = array(
	array('label' => 'List Affiliate User', 'url' => array('index')),
);

$filter_date = Yii::app()->request->getParam('filter_date', date('Y-m-d'));
$promo_code = Yii::app()->request->getParam('promo_code');
$indexUrl = $this->createUrl('index');
$start_date = isset($searched_data['filter_date']['start_date']) ? $searched_data['filter_date']['start_date'] : '';
$end_date = isset($searched_data['filter_date']['end_date']) ? $searched_data['filter_date']['end_date'] : '';
$ping_sent_total = 0;
$duplicate_ping_total = 0;
$ping_accepted_total = 0;
$post_sent_total = 0;
$post_accepted_total = 0;
$lead_returned_total = 0;
$final_leads_total = 0;
$revenue_total = 0;
$returndollar_total = 0;
?>
<section class="affiliates-page mortgage-dashboard-section affiliates-stats-page">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">Affiliate Stats</h1>
			<p class="affiliates-page-subtitle">View daily ping, post, and revenue stats by affiliate and date range.</p>
		</div>
		<div class="affiliates-page-actions">
			<a href="<?php echo CHtml::encode($indexUrl); ?>" class="btn btn-default">Back to Affiliate List</a>
		</div>
	</header>

	<div class="stats-filter-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Filters</span>
		</div>
		<div class="portlet-content">
			<?php
			$form = $this->beginWidget('CActiveForm', array('id' => 'affiliate_stats', 'enableAjaxValidation' => false));
			$default_date = date('Y-m-d', strtotime('-7 day')) . ' - ' . date('Y-m-d');
			$date_filter = Yii::app()->getRequest()->getParam('date_filter', $default_date);
			?>
			<div class="stats-filter-grid">
				<div class="stats-filter-group">
					<label class="stats-filter-label" for="Filter_date">Date range</label>
					<div class="stats-filter-field">
						<?php
						$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
							'id' => 'Filter_date',
							'name' => 'date_filter',
							'value' => $date_filter,
							'options' => array('arrows' => true, 'closeOnSelect' => true),
							'htmlOptions' => array('class' => 'inputClass'),
						));
						?>
					</div>
				</div>
				<div class="stats-filter-group">
					<label class="stats-filter-label" for="promo_code">Affiliate</label>
					<div class="stats-filter-field">
						<?php echo CHtml::dropDownList('promo_code', $promo_code, get_affiliate_name_and_promocode(), array('class' => 'inputClass', 'empty' => '— Select affiliate —')); ?>
					</div>
				</div>
				<div class="stats-filter-group stats-filter-actions">
					<label class="stats-filter-label">&nbsp;</label>
					<?php echo CHtml::submitButton('Get Affiliate Stats', array('name' => 'affiliatestats_search', 'id' => 'affiliatestats_search', 'class' => 'btn btn-primary')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>

	<div class="stats-table-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Affiliate stats by date</span>
		</div>
		<div class="portlet-content dashboard-table-wrap">
			<table id="myTable" class="table table-striped table-hover table-bordered table-condensed affiliate_report stats-table">
				<thead>
					<tr>
						<th>Date</th>
						<th class="text-right">Ping Sent</th>
						<th class="text-right">Duplicate Ping</th>
						<th class="text-right">Ping Accepted</th>
						<th class="text-right">Post Sent</th>
						<th class="text-right">Post Accepted</th>
						<th class="text-right">Lead Returned</th>
						<th class="text-right">Final Leads</th>
						<th class="text-right">Revenue</th>
						<th class="text-right">Return $</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($affiliatestats)):
						foreach ($affiliatestats as $k => $affiliatestat):
							$date = date('Y-m-d', strtotime(trim($affiliatestat['date'])));
							$final_leads = (int)(($affiliatestat['post_accepted'] ?: 0) - ($affiliatestat['lead_returned'] ?: 0));
							$ping_sent_total += (int)($affiliatestat['ping_sent'] ?: 0);
							$duplicate_ping_total += (int)($affiliatestat['duplicate_ping'] ?: 0);
							$ping_accepted_total += (int)($affiliatestat['ping_accepted'] ?: 0);
							$post_sent_total += (int)($affiliatestat['post_sent'] ?: 0);
							$post_accepted_total += (int)($affiliatestat['post_accepted'] ?: 0);
							$lead_returned_total += (int)($affiliatestat['lead_returned'] ?: 0);
							$final_leads_total += $final_leads;
							$revenue_total += (float)($affiliatestat['revenue'] ?: 0);
							$returndollar_total += (float)($affiliatestat['returndollar'] ?: 0);
							$leadInfoBase = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/affiliates/leadinfo?date=' . urlencode($date) . '&promo_code=' . urlencode($promo_code);
					?>
					<tr>
						<td><?php echo CHtml::encode($date); ?></td>
						<td class="text-right"><?php echo ($affiliatestat['ping_sent']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '">' . (int)$affiliatestat['ping_sent'] . '</a>' : '0'; ?></td>
						<td class="text-right"><?php echo ($affiliatestat['duplicate_ping']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&duplicate_ping=1">' . (int)$affiliatestat['duplicate_ping'] . '</a>' : '0'; ?></td>
						<td class="text-right"><?php echo ($affiliatestat['ping_accepted']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&ping_status=1">' . (int)$affiliatestat['ping_accepted'] . '</a>' : '0'; ?></td>
						<td class="text-right"><?php echo ($affiliatestat['post_sent']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&post_sent=1">' . (int)$affiliatestat['post_sent'] . '</a>' : '0'; ?></td>
						<td class="text-right"><?php echo ($affiliatestat['post_accepted']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&post_status=1">' . (int)$affiliatestat['post_accepted'] . '</a>' : '0'; ?></td>
						<td class="text-right"><?php echo ($affiliatestat['lead_returned']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&lead_returned=1">' . (int)$affiliatestat['lead_returned'] . '</a>' : '0'; ?></td>
						<td class="text-right"><?php echo $final_leads ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&final=1">' . $final_leads . '</a>' : '0'; ?></td>
						<td class="text-right">$<?php echo number_format(($affiliatestat['revenue'] === '' || $affiliatestat['revenue'] === null) ? 0 : round((float)$affiliatestat['revenue'], 2), 2); ?></td>
						<td class="text-right">$<?php echo number_format(($affiliatestat['returndollar'] === '' || $affiliatestat['returndollar'] === null) ? 0 : round((float)$affiliatestat['returndollar'], 2), 2); ?></td>
					</tr>
					<?php
						endforeach;
					else:
					?>
					<tr>
						<td colspan="10" class="stats-table-empty">Select an affiliate and date range, then click Get Affiliate Stats.</td>
					</tr>
					<?php endif; ?>
				</tbody>
				<?php if (!empty($affiliatestats)): ?>
				<tfoot>
					<tr>
						<th>Total</th>
						<th class="text-right"><?php echo $ping_sent_total; ?></th>
						<th class="text-right"><?php echo $duplicate_ping_total; ?></th>
						<th class="text-right"><?php echo $ping_accepted_total; ?></th>
						<th class="text-right"><?php echo $post_sent_total; ?></th>
						<th class="text-right"><?php echo $post_accepted_total; ?></th>
						<th class="text-right"><?php echo $lead_returned_total; ?></th>
						<th class="text-right"><?php echo $final_leads_total ? '<a target="_blank" rel="noopener noreferrer" href="' . CHtml::encode(Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/leads/lead_info?final=1&posting_type=0&promo_code=' . $promo_code . '&start_date=' . $start_date . '&end_date=' . $end_date) . '">' . $final_leads_total . '</a>' : '0'; ?></th>
						<th class="text-right">$<?php echo number_format(round($revenue_total, 2), 2); ?></th>
						<th class="text-right">$<?php echo number_format(round($returndollar_total, 2), 2); ?></th>
					</tr>
				</tfoot>
				<?php endif; ?>
			</table>
		</div>
	</div>
</section>
