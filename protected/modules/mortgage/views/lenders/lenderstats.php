<?php
$this->breadcrumbs = array('Lender Details' => array('index'), 'Lender Stats');
$this->menu = array(
	array('label' => 'Lender Setup', 'url' => array('index')),
	array('label' => 'Lender Report', 'url' => array('lenderreport')),
);

$indexUrl = $this->createUrl('index');
$reportUrl = $this->createUrl('lenderreport');
$default_date = date('Y-m-d', strtotime('-7 day')) . ' - ' . date('Y-m-d');
$date_filter = Yii::app()->getRequest()->getParam('date_filter', $default_date);
$lender_id = Yii::app()->request->getParam('lender_id');
$ping_sent_total = 0;
$ping_accepted_total = 0;
$post_sent_total = 0;
$post_accepted_total = 0;
$lead_returned_total = 0;
$final_leads_total = 0;
$revenue_total = 0;
$average_ping_price_total = 0;
$avg_ping_price = 0;
$i = 0;
if (!empty($lenderstats)) {
	foreach ($lenderstats as $lenderstat) {
		$ping_sent_total += (int)($lenderstat['ping_sent'] ?: 0);
		$ping_accepted_total += (int)($lenderstat['ping_accepted'] ?: 0);
		$post_sent_total += (int)($lenderstat['post_sent'] ?: 0);
		$post_accepted_total += (int)($lenderstat['post_accepted'] ?: 0);
		$lead_returned_total += (int)($lenderstat['lead_returned'] ?: 0);
		$final_leads = (int)(($lenderstat['post_accepted'] ?: 0) - ($lenderstat['lead_returned'] ?: 0));
		$final_leads_total += $final_leads;
		$revenue_total += (float)($lenderstat['revenue'] ?: 0);
		$average_ping_price_total += (float)($lenderstat['average_ping_price'] ?: 0);
		$i++;
	}
	if ($i > 0 && $average_ping_price_total > 0) {
		$avg_ping_price = round($average_ping_price_total / $i, 2);
	}
}
$campaignBase = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']);
?>
<section class="lenders-page mortgage-dashboard-section lenders-stats-page">
	<header class="lenders-page-header">
		<div class="lenders-page-header-inner">
			<h1 class="lenders-page-title">Lender Stats</h1>
			<p class="lenders-page-subtitle">View daily ping, post, and revenue stats by lender and date range.</p>
		</div>
		<div class="lenders-page-actions">
			<a href="<?php echo CHtml::encode($reportUrl); ?>" class="btn btn-default">Lender Report</a>
			<a href="<?php echo CHtml::encode($indexUrl); ?>" class="btn btn-default">Lender Setup</a>
		</div>
	</header>

	<div class="stats-filter-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Filters</span>
		</div>
		<div class="portlet-content">
			<?php
			$form = $this->beginWidget('CActiveForm', array('id' => 'lender_stats', 'enableAjaxValidation' => false));
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
					<label class="stats-filter-label" for="lender_id">Lender</label>
					<div class="stats-filter-field">
						<?php echo CHtml::dropDownList('lender_id', $lender_id, CHtml::listData(LenderDetails::model()->findAll(), 'id', 'name'), array('class' => 'inputClass', 'empty' => '— Select lender —')); ?>
					</div>
				</div>
				<div class="stats-filter-group stats-filter-actions">
					<label class="stats-filter-label">&nbsp;</label>
					<?php echo CHtml::submitButton('Get Lender Stats', array('name' => 'lenderstats_search', 'id' => 'lenderstats_search', 'class' => 'btn btn-primary')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>

	<div class="stats-table-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Lender stats by date</span>
		</div>
		<div class="portlet-content dashboard-table-wrap">
			<table id="myTable" class="table table-striped table-hover table-bordered table-condensed affiliate_report stats-table">
				<thead>
					<tr>
						<th>Date</th>
						<th class="text-right">Ping Sent</th>
						<th class="text-right">Ping Accepted</th>
						<th class="text-right">Post Sent</th>
						<th class="text-right">Post Accepted</th>
						<th class="text-right">Lead Returned</th>
						<th class="text-right">Final Leads</th>
						<th class="text-right">Revenue</th>
						<th class="text-right">Average Ping Price</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($lenderstats)): ?>
						<?php foreach ($lenderstats as $k => $lenderstat):
							$date = date('Y-m-d', strtotime(trim($lenderstat['date'])));
							$final_leads = (int)(($lenderstat['post_accepted'] ?: 0) - ($lenderstat['lead_returned'] ?: 0));
							$leadInfoBase = $campaignBase . '/lenders/leadinfo?date=' . urlencode($date) . '&lender_id=' . urlencode($lender_id);
						?>
						<tr>
							<td><?php echo CHtml::encode($date); ?></td>
							<td class="text-right"><?php echo ($lenderstat['ping_sent']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '">' . (int)$lenderstat['ping_sent'] . '</a>' : '0'; ?></td>
							<td class="text-right"><?php echo ($lenderstat['ping_accepted']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&ping_status=1">' . (int)$lenderstat['ping_accepted'] . '</a>' : '0'; ?></td>
							<td class="text-right"><?php echo ($lenderstat['post_sent']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&post_sent=1">' . (int)$lenderstat['post_sent'] . '</a>' : '0'; ?></td>
							<td class="text-right"><?php echo ($lenderstat['post_accepted']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&post_status=1">' . (int)$lenderstat['post_accepted'] . '</a>' : '0'; ?></td>
							<td class="text-right"><?php echo ($lenderstat['lead_returned']) ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&lead_returned=1">' . (int)$lenderstat['lead_returned'] . '</a>' : '0'; ?></td>
							<td class="text-right"><?php echo $final_leads ? '<a target="_blank" rel="noopener noreferrer" href="' . $leadInfoBase . '&final=1">' . $final_leads . '</a>' : '0'; ?></td>
							<td class="text-right">$<?php echo number_format(($lenderstat['revenue'] === '' || $lenderstat['revenue'] === null) ? 0 : round((float)$lenderstat['revenue'], 2), 2); ?></td>
							<td class="text-right">$<?php echo number_format(($lenderstat['average_ping_price'] === '' || $lenderstat['average_ping_price'] === null) ? 0 : round((float)$lenderstat['average_ping_price'], 2), 2); ?></td>
						</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="9" class="stats-table-empty">Select a lender and date range, then click Get Lender Stats.</td>
						</tr>
					<?php endif; ?>
				</tbody>
				<?php if (!empty($lenderstats)): ?>
				<tfoot>
					<tr>
						<th>Total</th>
						<th class="text-right"><?php echo $ping_sent_total; ?></th>
						<th class="text-right"><?php echo $ping_accepted_total; ?></th>
						<th class="text-right"><?php echo $post_sent_total; ?></th>
						<th class="text-right"><?php echo $post_accepted_total; ?></th>
						<th class="text-right"><?php echo $lead_returned_total; ?></th>
						<th class="text-right"><?php echo $final_leads_total ? '<a target="_blank" rel="noopener noreferrer" href="' . CHtml::encode($campaignBase . '/lenders/leadinfo?date_filter=' . urlencode($date_filter) . '&final=1&lender_id=' . $lender_id) . '">' . $final_leads_total . '</a>' : '0'; ?></th>
						<th class="text-right">$<?php echo number_format(round($revenue_total, 2), 2); ?></th>
						<th class="text-right">$<?php echo number_format($avg_ping_price, 2); ?></th>
					</tr>
				</tfoot>
				<?php endif; ?>
			</table>
		</div>
	</div>
</section>
