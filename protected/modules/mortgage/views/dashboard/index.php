<?php
$this->breadcrumbs = array('Dashboard');
$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
$name = Yii::app()->user->name;

// Precompute summary totals for admin dashboard
$summary_lead_total = $summary_revenue_buyer = $summary_revenue_seller = $summary_profit_total = 0;
if (isset($leads) && is_array($leads) && !empty($leads) && isset($revenue_buyer) && isset($revenue_seller) && isset($profit)) {
	foreach ($leads as $date => $lead) {
		$summary_lead_total += !empty($leads[$date]) ? (int)$leads[$date] : 0;
		$summary_revenue_seller += isset($revenue_seller[$date]) ? (float)$revenue_seller[$date] : 0;
		$summary_revenue_buyer += isset($revenue_buyer[$date]) ? (float)$revenue_buyer[$date] : 0;
		$summary_profit_total += isset($profit[$date]) ? (float)$profit[$date] : 0;
	}
}
$summary_roi = $summary_revenue_buyer > 0 ? round(($summary_profit_total / $summary_revenue_buyer) * 100, 1) : 0;

// IF LOGGED IN USER IS ADMIN
if(Yii::app()->user->getState('roles')=='1'){
	$default_date = date('Y-m-d', strtotime("-7 day")) . ' - ' . date('Y-m-d');
	$date_filter = Yii::app()->getRequest()->getParam('date_filter', $default_date);
?>
<main id="mortgage-dashboard-admin" class="mortgage-dashboard-main">
	<h1 class="dashboard-page-title">Dashboard</h1>

	<section class="dashboard-summary-kpi" aria-label="Overview metrics">
	<div class="dashboard-kpi-grid">
		<div class="dashboard-kpi-card">
			<p class="dashboard-kpi-label">Total revenue</p>
			<p class="dashboard-kpi-value dashboard-kpi-value-neutral">$<?php echo number_format($summary_revenue_buyer, 2); ?></p>
			<p class="dashboard-kpi-meta">Lender price / revenue</p>
		</div>
		<div class="dashboard-kpi-card">
			<p class="dashboard-kpi-label">Total cost</p>
			<p class="dashboard-kpi-value dashboard-kpi-value-neutral">$<?php echo number_format($summary_revenue_seller, 2); ?></p>
			<p class="dashboard-kpi-meta">Affiliate price / cost</p>
		</div>
		<div class="dashboard-kpi-card">
			<p class="dashboard-kpi-label">Net profit</p>
			<p class="dashboard-kpi-value <?php echo $summary_profit_total >= 0 ? 'dashboard-kpi-value-success' : 'dashboard-kpi-value-danger'; ?>">$<?php echo number_format($summary_profit_total, 2); ?></p>
			<p class="dashboard-kpi-meta">After costs</p>
		</div>
		<div class="dashboard-kpi-card">
			<p class="dashboard-kpi-label">ROI</p>
			<p class="dashboard-kpi-value <?php echo $summary_roi >= 0 ? 'dashboard-kpi-value-success' : 'dashboard-kpi-value-danger'; ?>"><?php echo $summary_roi; ?>%</p>
			<p class="dashboard-kpi-meta">Return on revenue</p>
		</div>
	</div>
</section>

<section class="dashboard-filters-section" aria-label="Filters">
	<div class="dashboard-toolbar-card">
		<?php $form = $this->beginWidget('CActiveForm', array('id' => 'campaign_reports', 'enableAjaxValidation' => false)); ?>
		<div class="dashboard-toolbar-inner">
			<div class="dashboard-toolbar-row dashboard-toolbar-row-main">
				<div class="dashboard-toolbar-group">
					<label class="dashboard-toolbar-label" id="filter-date-label" for="Filter_date">Date range</label>
					<div class="dashboard-toolbar-picker-wrap">
						<?php
						$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
							'id' => 'Filter_date',
							'name' => 'date_filter',
							'value' => $date_filter,
							'options' => array('arrows' => true, 'closeOnSelect' => true),
							'htmlOptions' => array('class' => 'inputClass', 'aria-describedby' => 'filter-date-label'),
						));
						?>
					</div>
				</div>
				<?php echo CHtml::submitButton('Apply filters', array('name' => 'apply_filter', 'class' => 'btn btn-primary dashboard-apply-btn dashboard-toolbar-btn')); ?>
				<a href="<?php echo Yii::app()->createUrl('mortgage/dashboard/index'); ?>" class="btn btn-default dashboard-clear-btn dashboard-toolbar-btn">Clear</a>
				<button type="button" class="btn btn-default dashboard-toolbar-btn" id="dashboard-export-csv" aria-label="Export table as CSV">Export CSV</button>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</section>

<section class="dashboard-metrics-row" aria-label="Submission metrics">
	<div class="dashboard-metrics summary">
		<ul class="dashboard-metrics-list">
			<li class="metric-card metric-card-with-sparkline">
				<div class="metric-card-main">
					<span class="summary-icon" aria-hidden="true"><img src="<?php echo $baseUrl; ?>/img/group.png" width="32" height="32" alt=""></span>
					<div class="metric-card-content">
						<span class="summary-number"><?php // echo number_format($week_submissions); ?>—</span>
						<span class="summary-title">Last 7 days submission</span>
						<span class="metric-change metric-change-neutral" aria-label="Change">—</span>
					</div>
				</div>
				<div class="metric-sparkline" aria-hidden="true"><span class="metric-sparkline-bar" style="width: 60%;"></span></div>
			</li>
			<li class="metric-card metric-card-with-sparkline">
				<div class="metric-card-main">
					<span class="summary-icon" aria-hidden="true"><img src="<?php echo $baseUrl; ?>/img/group.png" width="32" height="32" alt=""></span>
					<div class="metric-card-content">
						<span class="summary-number"><?php // echo number_format($week_accepted); ?>—</span>
						<span class="summary-title">Last 30 days submission</span>
						<span class="metric-change metric-change-neutral" aria-label="Change">—</span>
					</div>
				</div>
				<div class="metric-sparkline" aria-hidden="true"><span class="metric-sparkline-bar" style="width: 75%;"></span></div>
			</li>
			<li class="metric-card metric-card-with-sparkline">
				<div class="metric-card-main">
					<span class="summary-icon" aria-hidden="true"><img src="<?php echo $baseUrl; ?>/img/group.png" width="32" height="32" alt=""></span>
					<div class="metric-card-content">
						<span class="summary-number"><?php // echo number_format(Submissions::model()->count()); ?>—</span>
						<span class="summary-title">Total submission to date</span>
						<span class="metric-change metric-change-neutral" aria-label="Change">—</span>
					</div>
				</div>
				<div class="metric-sparkline" aria-hidden="true"><span class="metric-sparkline-bar" style="width: 90%;"></span></div>
			</li>
		</ul>
	</div>
</section>

<section class="dashboard-section dashboard-section-campaign" aria-labelledby="campaign-performance-heading">
	<h2 id="campaign-performance-heading" class="dashboard-section-title">Campaign performance</h2>
	<div class="row-fluid">
		<div class="span12">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title' => '<span class="portlet-icon" aria-hidden="true">📊</span> Mortgage / Refinance',
			));
			if (is_array($leads) && !empty($leads)) {
			$lead_total = $revenue_seller_total = $revenue_buyer_total = $profit_total = 0;
			$margin_total = 0;
		?>
		<div class="dashboard-table-wrap">
			<table id="campaign-performance-table" class="dashboard-table dashboard-table-sortable table table-striped table-hover table-bordered" data-export-title="Campaign Performance">
				<thead>
					<tr>
						<th class="dashboard-th sortable" data-sort="date" aria-sort="none">Date <span class="sort-indicator" aria-hidden="true"></span></th>
						<th class="dashboard-th sortable" data-sort="num" aria-sort="none">Leads <span class="sort-indicator" aria-hidden="true"></span></th>
						<th class="dashboard-th sortable" data-sort="num" aria-sort="none">Lender Price/Revenue <span class="sort-indicator" aria-hidden="true"></span></th>
						<th class="dashboard-th sortable" data-sort="num" aria-sort="none">Affiliate Price/Cost <span class="sort-indicator" aria-hidden="true"></span></th>
						<th class="dashboard-th sortable" data-sort="profit" aria-sort="none">Profit <span class="sort-indicator" aria-hidden="true"></span></th>
						<th class="dashboard-th sortable" data-sort="num" aria-sort="none">Profit Margin <span class="sort-indicator" aria-hidden="true"></span></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$margin = '0';
					foreach ($leads as $date => $lead) {
						if (isset($revenue_buyer[$date]) && $revenue_buyer[$date] != 0 && isset($profit[$date])) {
							$margin = number_format(($profit[$date] / $revenue_buyer[$date]) * 100, 2);
						}
						$row_profit = isset($profit[$date]) ? (float)$profit[$date] : 0;
						$row_margin_pct = isset($revenue_buyer[$date]) && $revenue_buyer[$date] != 0 ? min(100, max(0, ($row_profit / $revenue_buyer[$date]) * 100)) : 0;
						if (!empty($leads[$date])) {
							echo '<tr data-profit="' . (float)$row_profit . '" data-margin="' . (float)$row_margin_pct . '">';
							echo '<td>' . htmlspecialchars($date) . '</td>';
							echo '<td class="text-right">' . (int)$leads[$date] . '</td>';
							echo '<td class="text-right">$' . number_format(isset($revenue_buyer[$date]) ? $revenue_buyer[$date] : 0, 2) . '</td>';
							echo '<td class="text-right">$' . number_format(isset($revenue_seller[$date]) ? $revenue_seller[$date] : 0, 2) . '</td>';
							echo '<td class="text-right ' . ($row_profit >= 0 ? 'profit-positive' : 'profit-negative') . '">$' . number_format($row_profit, 2) . '</td>';
							echo '<td class="dashboard-margin-cell"><div class="dashboard-margin-bar-wrap"><div class="dashboard-margin-bar" style="width:' . (float)$row_margin_pct . '%;" role="presentation"></div><span class="dashboard-margin-pct">' . $margin . '%</span></div></td>';
							echo '</tr>';
						}
						$lead_total += !empty($leads[$date]) ? (int)$leads[$date] : 0;
						$revenue_seller_total += isset($revenue_seller[$date]) ? (float)$revenue_seller[$date] : 0;
						$revenue_buyer_total += isset($revenue_buyer[$date]) ? (float)$revenue_buyer[$date] : 0;
						$profit_total += $row_profit;
					}
					$margin_total = $revenue_buyer_total > 0 ? ($profit_total / $revenue_buyer_total) * 100 : 0;
				?>
				</tbody>
				<tfoot>
					<tr class="dashboard-tfoot-row">
						<th>Total</th>
						<th class="text-right"><?php echo number_format($lead_total); ?></th>
						<th class="text-right">$<?php echo number_format($revenue_buyer_total, 2); ?></th>
						<th class="text-right">$<?php echo number_format($revenue_seller_total, 2); ?></th>
						<th class="text-right <?php echo $profit_total >= 0 ? 'profit-positive' : 'profit-negative'; ?>">$<?php echo number_format($profit_total, 2); ?></th>
						<th class="text-right"><?php echo round($margin_total, 2); ?>%</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<?php
		} else {
			echo '<div class="dashboard-empty-state dashboard-empty-state-enhanced" role="status">
				<div class="dashboard-empty-state-illus" aria-hidden="true">
					<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false"><rect width="80" height="80" rx="40" fill="var(--portal-empty-bg)"/><path d="M40 24v32M28 40h24" stroke="var(--portal-empty-stroke)" stroke-width="2" stroke-linecap="round"/></svg>
				</div>
				<p class="dashboard-empty-state-title">No campaign data for this date range</p>
				<p class="dashboard-empty-state-hint">Try selecting a different date range using the date picker above, or check back once leads are submitted.</p>
				<button type="button" class="btn btn-default dashboard-empty-state-action" onclick="document.getElementById(\'Filter_date\').focus()">Change date range</button>
			</div>';
		}
		$this->endWidget();
		?>
		</div>
	</div>
</section>

<script>
(function() {
	var exportCsvBtn = document.getElementById('dashboard-export-csv');
	var table = document.getElementById('campaign-performance-table');
	var pickerWrap = document.querySelector('.mortgage-portal .dashboard-toolbar-picker-wrap');

	// Prev/Next: parse input (Y-m-d), shift range, update value (plugin can fail on Y-m-d parse)
	if (pickerWrap) {
		pickerWrap.addEventListener('click', function(e) {
			var link = e.target.closest('a');
			if (!link || (!link.classList.contains('ui-daterangepicker-prev') && !link.classList.contains('ui-daterangepicker-next'))) return;
			e.preventDefault();
			e.stopPropagation();
			var input = document.getElementById('Filter_date');
			if (!input || !input.value) return;
			var parts = input.value.split(/\s*-\s*/);
			if (parts.length !== 2) return;
			var startStr = parts[0].trim();
			var endStr = parts[1].trim();
			var start = parseYmd(startStr);
			var end = parseYmd(endStr);
			if (!start || !end) return;
			var diffMs = end.getTime() - start.getTime();
			var diffDays = Math.round(diffMs / 86400000) + 1;
			var shift = link.classList.contains('ui-daterangepicker-prev') ? -diffDays : diffDays;
			start.setDate(start.getDate() + shift);
			end.setDate(end.getDate() + shift);
			input.value = formatYmd(start) + ' - ' + formatYmd(end);
			input.dispatchEvent(new Event('change', { bubbles: true }));
		}, true);
	}
	function parseYmd(s) {
		var m = s.match(/^(\d{4})-(\d{2})-(\d{2})$/);
		if (!m) return null;
		var d = new Date(parseInt(m[1], 10), parseInt(m[2], 10) - 1, parseInt(m[3], 10));
		return isNaN(d.getTime()) ? null : d;
	}
	function formatYmd(d) {
		var y = d.getFullYear();
		var m = (d.getMonth() + 1);
		var day = d.getDate();
		return y + '-' + (m < 10 ? '0' : '') + m + '-' + (day < 10 ? '0' : '') + day;
	}

	if (exportCsvBtn && table) {
		exportCsvBtn.addEventListener('click', function() {
			var rows = table.querySelectorAll('tr');
			var csv = [];
			for (var i = 0; i < rows.length; i++) {
				var cells = rows[i].querySelectorAll('th, td');
				var row = [];
				for (var j = 0; j < cells.length; j++) {
					row.push('"' + (cells[j].textContent || '').replace(/"/g, '""') + '"');
				}
				csv.push(row.join(','));
			}
			var blob = new Blob([csv.join('\r\n')], { type: 'text/csv;charset=utf-8;' });
			var a = document.createElement('a');
			a.href = URL.createObjectURL(blob);
			a.download = 'campaign-performance-' + (new Date().toISOString().slice(0,10)) + '.csv';
			a.click();
			URL.revokeObjectURL(a.href);
		});
	}

	if (table && table.querySelectorAll('.dashboard-th.sortable').length) {
		var thead = table.querySelector('thead tr');
		thead.addEventListener('click', function(e) {
			var th = e.target.closest('.sortable');
			if (!th) return;
			var col = Array.prototype.indexOf.call(thead.querySelectorAll('th'), th);
			var tbody = table.querySelector('tbody');
			var asc = th.getAttribute('aria-sort') !== 'ascending';
			thead.querySelectorAll('th').forEach(function(h) {
				h.setAttribute('aria-sort', h === th ? (asc ? 'ascending' : 'descending') : 'none');
			});
			var trs = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
			var sortType = th.getAttribute('data-sort');
			trs.sort(function(a, b) {
				var ac = a.children[col];
				var bc = b.children[col];
				var av, bv;
				if (sortType === 'date') {
					av = (ac && ac.textContent) ? ac.textContent.trim() : '';
					bv = (bc && bc.textContent) ? bc.textContent.trim() : '';
					return asc ? (av < bv ? -1 : av > bv ? 1 : 0) : (bv < av ? -1 : bv > av ? 1 : 0);
				}
				if (sortType === 'profit' && a.getAttribute && b.getAttribute) {
					av = parseFloat(a.getAttribute('data-profit')) || 0;
					bv = parseFloat(b.getAttribute('data-profit')) || 0;
				} else {
					av = parseFloat((ac && ac.textContent) ? ac.textContent.replace(/[$,%\s]/g, '') : 0) || 0;
					bv = parseFloat((bc && bc.textContent) ? bc.textContent.replace(/[$,%\s]/g, '') : 0) || 0;
				}
				return asc ? (av - bv) : (bv - av);
			});
			trs.forEach(function(tr) { tbody.appendChild(tr); });
		});
	}
})();
</script>

</main>

<!-- Ping sent and Ping Accepted for Affiliates -->
<div class="row-fluid">
	<div class="span9 fullwidth">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array('title' => '
			        <span class="icon-picture"></span>Ping Sent by Affiliates / Ping Accepted for Affiliates'
				));
			if(count($affiliates_pingpost_dates)){?>
			<table id="myTable" class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<th class="header" style="vertical-align: middle;" width="10%" rowspan="3">Date</th>
					<th class="header" style="text-align: center;" width="90%" colspan="<?php echo count($affiliates)*2;?>">Affiliates</th>
				</tr>
				<tr>
					<?php
						foreach($affiliates as $vid => $affiliate_name){
							echo '<th style="text-align:center;width:'.(round(90/count($affiliates))).'%" colspan="2">'.$affiliate_name.'('.$vid.')</th>';
						}
						?>
				</tr>
				<tr>
					<?php foreach($affiliates as $vid => $affiliate_name){?>
					<td>Ping Sent</td>
					<td>Ping Accepted</td>
					<?php }?>
				</tr>
			</thead>
			<tbody> 
				<?php
					if($affiliates_pingpost_dates){
					$total_vendor_sale = $total_vendor_acceptance = [];
						foreach($affiliates_pingpost_dates as $date){
							echo '<tr><td>'.$date.'</td>';
							foreach($affiliates as $vid => $affiliate_name){
								$pings = (!empty($affiliates_statistics[$vid][$date]['ping_sent']) ? $affiliates_statistics[$vid][$date]['ping_sent'] : 0);
								$accepted_pings = (!empty($affiliates_statistics[$vid][$date]['ping_accepted']) ? $affiliates_statistics[$vid][$date]['ping_accepted'] : 0);
								echo '<td align=right style="">'.$pings.'</td>'.'<td align=right style="">'.$accepted_pings.'</td>';
							}
							echo '</tr>';
						}
					}
					?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header">Total</th>
					<?php
						foreach($affiliates as $vid => $affiliate_name){
							$total_pings = array_sum(array_column($affiliates_statistics[$vid],'ping_sent'));
						  	$total_accepted_pings = array_sum(array_column($affiliates_statistics[$vid],'ping_accepted'));
							echo '<th class="header" align=right>'.$total_pings.'</th>'.'<th class="header" align=right>'.$total_accepted_pings.'</th>';
						}
						?>
				</tr>
			</tfoot>
		</table>
		<?php
			}else{
				echo '<div class="dashboard-empty-state dashboard-empty-state-enhanced" role="status">
				<div class="dashboard-empty-state-illus" aria-hidden="true">
					<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false"><rect width="80" height="80" rx="40" fill="var(--portal-empty-bg)"/><path d="M40 24v32M28 40h24" stroke="var(--portal-empty-stroke)" stroke-width="2" stroke-linecap="round"/></svg>
				</div>
				<p class="dashboard-empty-state-title">No data for this period</p>
				<p class="dashboard-empty-state-hint">Try selecting a different date range above, or check back once leads are submitted.</p>
				<button type="button" class="btn btn-default dashboard-empty-state-action" onclick="document.getElementById(\'Filter_date\').focus()">Change date range</button>
			</div>';
			}
			$this->endWidget(); ?>
	</div>
</div>
<!-- Posts Sent and Post Accepted for Affiliates -->
<div class="row-fluid">
	<div class="span9 fullwidth">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array(
				'title' => '<span class="icon-picture"></span>Posts Sent by Affiliates / Post Accepted for Affiliates'));
			if(count($affiliates_pingpost_dates)){?>
		<table id="myTable" class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<th class="header" style="vertical-align: middle;" width="10%" rowspan="3">Date</th>
					<th class="header" style="text-align: center;" width="90%" colspan="<?php echo count($affiliates)*2;?>">Affiliates</th>
				</tr>
				<tr>
					<?php
						foreach($affiliates as $vid => $affiliate_name){
							echo '<th style="text-align:center;width:'.(round(90/count($affiliates))).'%" colspan="2">'.$affiliate_name.'('.$vid.')</th>';
						}
						?>
				</tr>
				<tr>
					<?php foreach($affiliates as $vid => $affiliate_name){?>
					<td>Post Sent</td>
					<td>Post Accepted</td>
					<?php }?>
				</tr>
			</thead>
			<tbody> 
				<?php
					
					if($affiliates_pingpost_dates){
					$total_vendor_sale = $total_vendor_acceptance =[];
					foreach($affiliates_pingpost_dates as $date){
						echo '<tr><td>'.$date.'</td>';
						foreach($affiliates as $vid => $affiliate_name){
							$posts=(!empty($affiliates_statistics[$vid][$date]['post_sent']) ? $affiliates_statistics[$vid][$date]['post_sent'] : 0);
							$accepted_posts = (!empty($affiliates_statistics[$vid][$date]['post_accepted']) ? $affiliates_statistics[$vid][$date]['post_accepted'] : 0);
							echo '<td align=right style="">'.$posts.'</td>'.'<td align=right style="">'.$accepted_posts.'</td>';
						}
						echo '</tr>';
					}
					}
					?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header">Total</th>
					<?php
						foreach($affiliates as $vid => $affiliate_name){
							$total_posts = array_sum(array_column($affiliates_statistics[$vid],'post_sent'));
						  $total_accepted_post = array_sum(array_column($affiliates_statistics[$vid],'post_accepted'));
							echo '<th class="header" align=right>'.$total_posts.'</th>'.'<th class="header" align=right>'.$total_accepted_post.'</th>';
						}
						?>
				</tr>
			</tfoot>
		</table>
		<?php
			}else{
				echo '<div class="dashboard-empty-state dashboard-empty-state-enhanced" role="status">
				<div class="dashboard-empty-state-illus" aria-hidden="true">
					<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false"><rect width="80" height="80" rx="40" fill="var(--portal-empty-bg)"/><path d="M40 24v32M28 40h24" stroke="var(--portal-empty-stroke)" stroke-width="2" stroke-linecap="round"/></svg>
				</div>
				<p class="dashboard-empty-state-title">No data for this period</p>
				<p class="dashboard-empty-state-hint">Try selecting a different date range above, or check back once leads are submitted.</p>
				<button type="button" class="btn btn-default dashboard-empty-state-action" onclick="document.getElementById(\'Filter_date\').focus()">Change date range</button>
			</div>';
			}
			$this->endWidget(); ?>
	</div>
</div>
<!-- Ping sent and Ping Accepted to Lenders -->
<div class="row-fluid">
	<div class="span9 fullwidth">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array(
				'title' => '<span class="icon-picture"></span>Ping Sent to Lenders / Ping Accepted by Lenders'));
			if(count($lenders_pingpost_dates)){?>
		<table id="myTable" class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<th class="header" style="vertical-align: middle;" width="10%" rowspan="3">Date</th>
					<th class="header" style="text-align: center;" width="90%" colspan="<?php echo count($lenders)*2;?>">Lenders</th>
				</tr>
				<tr>
					<?php
						foreach($lenders as $lender_id){
							echo '<th style="text-align:center;width:'.(round(90/count($lenders))).'%" colspan="2">'.$Buyers[$lender_id].'('.$lender_id.')</th>';
						}
						?>
				</tr>
				<tr>
					<?php foreach($lenders as $lender_id){?>
					<td>Ping Sent</td>
					<td>Ping Accepted</td>
					<?php }?>
				</tr>
			</thead>
			<tbody>
				<?php
					$total_lender_sale = $total_lender_acceptance = [];
					foreach($lenders_pingpost_dates as $date){
						echo '<tr><td>'.$date.'</td>';
						foreach($lenders as $lender_id){
							$pings = (!empty($lenders_statistics[$lender_id][$date]['ping_sent']) ? $lenders_statistics[$lender_id][$date]['ping_sent'] : 0);
							$accepted_pings = (!empty($lenders_statistics[$lender_id][$date]['ping_accepted']) ? $lenders_statistics[$lender_id][$date]['ping_accepted'] : 0);
							echo '<td align=right style="">'.$pings.'</td>'.'<td align=right style="">'.$accepted_pings.'</td>';
						}
						echo '</tr>';
					}
					?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header">Total</th>
					<?php
						foreach($lenders as $lender_id){
							$total_pings=array_sum(array_column($lenders_statistics[$lender_id],'ping_sent'));
						  $total_accepted_ping = array_sum(array_column($lenders_statistics[$lender_id],'ping_accepted'));
							echo '<th class="header" align=right>'.$total_pings.'</th>'.'<th class="header" align=right>'.$total_accepted_ping.'</th>';
						}
						?>
				</tr>
			</tfoot>
		</table>
		<?php
			}else{
				echo '<div class="dashboard-empty-state dashboard-empty-state-enhanced" role="status">
				<div class="dashboard-empty-state-illus" aria-hidden="true">
					<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false"><rect width="80" height="80" rx="40" fill="var(--portal-empty-bg)"/><path d="M40 24v32M28 40h24" stroke="var(--portal-empty-stroke)" stroke-width="2" stroke-linecap="round"/></svg>
				</div>
				<p class="dashboard-empty-state-title">No data for this period</p>
				<p class="dashboard-empty-state-hint">Try selecting a different date range above, or check back once leads are submitted.</p>
				<button type="button" class="btn btn-default dashboard-empty-state-action" onclick="document.getElementById(\'Filter_date\').focus()">Change date range</button>
			</div>';
			}
			$this->endWidget(); ?>
	</div>
</div>
<!-- Posts Sent and Post Accepted to Lenders -->
<div class="row-fluid">
	<div class="span9 fullwidth">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array(
						'title' => '<span class="icon-picture"></span>Posts Sent to Lenders / Post Accepted by Lenders'));
			if(count($lenders_pingpost_dates)){?>
		<table id="myTable" class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<th class="header" style="vertical-align: middle;" width="10%" rowspan="3">Date</th>
					<th class="header" style="text-align: center;" width="90%" colspan="<?php echo count($lenders)*2;?>">Lenders</th>
				</tr>
				<tr>
					<?php
						foreach($lenders as $lender_id){
							echo '<th align=center style="text-align:center;width:'.(round(90/count($lenders))).'%" colspan="2">'.$Buyers[$lender_id].'('.$lender_id.')</th>';
						}
						?>
				</tr>
				<tr>
					<?php foreach($lenders as $lender_id){?>
					<td>Post Sent</td>
					<td>Post Accepted</td>
					<?php }?>
				</tr>
			</thead>
			<tbody> 
				<?php
					$total_lender_sale = $total_lender_acceptance = [];
					foreach($lenders_pingpost_dates as $date){
						echo '<tr><td>'.$date.'</td>';
						foreach($lenders as $lender_id){
							$posts = (!empty($lenders_statistics[$lender_id][$date]['post_sent']) ? $lenders_statistics[$lender_id][$date]['post_sent'] : 0);
							$accepted_posts = (!empty($lenders_statistics[$lender_id][$date]['post_accepted']) ? $lenders_statistics[$lender_id][$date]['post_accepted'] : 0);
							echo '<td align=right style="">'.$posts.'</td>'.'<td align=right style="">'.$accepted_posts.'</td>';
						}
						echo '</tr>';
					}
					?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header">Total</th>
					<?php
						foreach($lenders as $lender_id){
							$total_posts=array_sum(array_column($lenders_statistics[$lender_id],'post_sent'));
						  $total_accepted_post = array_sum(array_column($lenders_statistics[$lender_id],'post_accepted'));
							echo '<th class="header" align=right>'.$total_posts.'</th>'.'<th class="header" align=right>'.$total_accepted_post.'</th>';
						}
						?>
				</tr>
			</tfoot>
		</table>
		<?php
			}else{
				echo '<div class="dashboard-empty-state dashboard-empty-state-enhanced" role="status">
				<div class="dashboard-empty-state-illus" aria-hidden="true">
					<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false"><rect width="80" height="80" rx="40" fill="var(--portal-empty-bg)"/><path d="M40 24v32M28 40h24" stroke="var(--portal-empty-stroke)" stroke-width="2" stroke-linecap="round"/></svg>
				</div>
				<p class="dashboard-empty-state-title">No data for this period</p>
				<p class="dashboard-empty-state-hint">Try selecting a different date range above, or check back once leads are submitted.</p>
				<button type="button" class="btn btn-default dashboard-empty-state-action" onclick="document.getElementById(\'Filter_date\').focus()">Change date range</button>
			</div>';
			}
			$this->endWidget(); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php
		
		$this->beginWidget('zii.widgets.CPortlet',array(
				'title' => '
				<span class="icon-picture"></span>Pings of Last 15 Days'
		));
		// FOR LENDERS BAR CHART
		$res1 = LenderAffiliateTransaction::specific_lender_ping_report_last_15days();
		$res2 = LenderAffiliateTransaction::specific_lender_post_report_last_15days();
		$affiliate_results = AffiliateDailyCounts::specific_affiliate_report_last_15days();
		// FOR AFFILIATES BAR CHART.. CODONG IS YET TO BE DONE, SAME QUERY
		// FOR AFFILIATES PIE CHART
		$pingpost_results['ping_sent'] = $pingpost_results['ping_duplicate'] = $pingpost_results['ping_accepted'] = $pingpost_results['post_sent'] = $pingpost_results['post_duplicate'] = $pingpost_results['post_accepted'] = 0;
		if($affiliate_results){
			foreach($affiliate_results as $results){
				$pingpost_results['ping_sent'] += $results['ping_sent'];
				$pingpost_results['ping_duplicate'] += $results['ping_duplicate'];
				$pingpost_results['ping_accepted'] += $results['ping_accepted'];
				$pingpost_results['post_sent'] += $results['post_sent'];
				$pingpost_results['post_duplicate'] += $results['post_duplicate'];
				$pingpost_results['post_accepted'] += $results['post_accepted'];
			}
		}
		$ping_sent = $ping_duplicate = $ping_accepted = $ping_rejected_pie = 0;
		$post_sent = $post_duplicate = $post_accepted = $post_rejected_pie = 0;
		if (isset($pingpost_results) && !empty($pingpost_results)) {
			$ping_sent = $pingpost_results['ping_sent'];
			if ($ping_sent > 0) {
				$ping_duplicate = round($pingpost_results['ping_duplicate'] * 100 / $ping_sent);
				$ping_accepted = round($pingpost_results['ping_accepted'] * 100 / $ping_sent);
			}
			$ping_rejected_pie = round(100 - ($ping_duplicate + $ping_accepted));
			$post_sent = $pingpost_results['post_sent'];
			if ($post_sent > 0) {
				$post_duplicate = round($pingpost_results['post_duplicate'] * 100 / $post_sent);
				$post_accepted = round($pingpost_results['post_accepted'] * 100 / $post_sent);
			}
			$post_rejected_pie = round(100 - ($post_duplicate + $post_accepted));
		}
		?>
		<div style="padding-left:20px;">
			<script>
			window.onload = function () {
					var chart = new CanvasJS.Chart("chartContainer", {
					exportEnabled: true,
					animationEnabled: true,
					title:{
						text: "Total Ping Sent vs Total Ping Accepts for Last 15 Days for All Buyers"
					},
					subtitles: [{
						text: "Click Legend to Hide or Unhide Data Series"
					}], 
					axisX: {
						title: "Buyers"
					},
					axisY: {
						title: "Sent - Leads",
						titleFontColor: "#4F81BC",
						lineColor: "#4F81BC",
						labelFontColor: "#4F81BC",
						tickColor: "#4F81BC"
					},
					axisY1: {
						title: "Sent - Leads",
						titleFontColor: "#4F81BC",
						lineColor: "#4F81BC",
						labelFontColor: "#4F81BC",
						tickColor: "#4F81BC"
					},
					axisY2: {
						title: "Accepted - Leads",
						titleFontColor: "#C0504E",
						lineColor: "#C0504E",
						labelFontColor: "#C0504E",
						tickColor: "#C0504E"
					},
					toolTip: {
						shared: true
					},
					legend: {
						cursor: "pointer",
						itemclick: toggleDataSeries
					},
					data: [
					{
						type: "column",
						name: "Total Sent",
						showInLegend: true,      
						yValueFormatString: "#,##0.# Leads",
						dataPoints: [
							<?php foreach ($res1 as $row) { ?>
							{ label: "<?=$Buyers[$row->lender_id]?>",  y: <?=$row->ping_sent?> },
							<?php } ?>
						]
					},
					{
						name: "Total Rejected",
						type: "column",
						showInLegend: true,      
						yValueFormatString: "#,##0.# Leads",
						dataPoints: [
							<?php foreach ($res1 as $row) { 
							$ping_rejected = $row->ping_sent - $row->ping_accepted;
							?>
							{ label: "<?=$Buyers[$row->lender_id]?>",  y: <?=$ping_rejected?> },
							<?php } ?>
						]
					},
					{
						name: "Total Accepted",
						type: "column",
						showInLegend: true,      
						yValueFormatString: "#,##0.# Leads",
						dataPoints: [
							<?php foreach ($res1 as $row) { ?>
							{ label: "<?=$Buyers[$row->lender_id]?>",  y: <?=$row->ping_accepted?> },
							<?php } ?>
						]
					},
					
					
					]
				});
				chart.render();
				function toggleDataSeries(e) {
					if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
						e.dataSeries.visible = false;
					} else {
						e.dataSeries.visible = true;
					}
					e.chart.render();
				}
				//GRAPH 1
				var chart1 = new CanvasJS.Chart("chartContainer1", {
				exportEnabled: true,
				animationEnabled: true,
				title:{
					text: "Total Post Sent vs Total Post Accepts for Last 15 Days for All Buyers"
				},
				subtitles: [{
					text: "Click Legend to Hide or Unhide Data Series"
				}], 
				axisX: {
					title: "Buyers"
				},
				axisY: {
					title: "Sent - Leads",
					titleFontColor: "#4F81BC",
					lineColor: "#4F81BC",
					labelFontColor: "#4F81BC",
					tickColor: "#4F81BC"
				},
				axisY1: {
					title: "Sent - Leads",
					titleFontColor: "#4F81BC",
					lineColor: "#4F81BC",
					labelFontColor: "#4F81BC",
					tickColor: "#4F81BC"
				},
				axisY2: {
					title: "Accepted - Leads",
					titleFontColor: "#C0504E",
					lineColor: "#C0504E",
					labelFontColor: "#C0504E",
					tickColor: "#C0504E"
				},
				toolTip: {
					shared: true
				},
				legend: {
					cursor: "pointer",
					itemclick: toggleDataSeries1
				},
				data: [
				{
					type: "column",
					name: "Total Sent",
					showInLegend: true,      
					yValueFormatString: "#,##0.# Leads",
					dataPoints: [
						<?php foreach ($res2 as $row) { ?>
						{ label: "<?=$Buyers[$row->lender_id]?>",  y: <?=$row->post_sent?> },
						<?php } ?>
					]
				},
				{
					name: "Total Rejected",
					type: "column",
					showInLegend: true,      
					yValueFormatString: "#,##0.# Leads",
					dataPoints: [
						<?php foreach ($res2 as $row) { 
						$post_rejected = $row->post_sent - $row->post_accepted;
						?>
						{ label: "<?=$Buyers[$row->lender_id]?>",  y: <?=$post_rejected?> },
						<?php } ?>
					]
				},
				{
					name: "Total Accepted",
					type: "column",
					showInLegend: true,      
					yValueFormatString: "#,##0.# Leads",
					dataPoints: [
						<?php foreach ($res2 as $row) { ?>
						{ label: "<?=$Buyers[$row->lender_id]?>",  y: <?=$row->post_accepted?> },
						<?php } ?>
					]
				},
				]
			});
			chart1.render();
			function toggleDataSeries1(e) {
				if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
					e.dataSeries.visible = false;
				} else {
					e.dataSeries.visible = true;
				}
				e.chart1.render();
			}
			// CHART 2
			// PIE CHART
				var chart3 = new CanvasJS.Chart("chartContainer3", {
				theme: "light2",
				animationEnabled: true,
				title: {
					text: "Shares of Pings by it's Status In Last 15 Days"
				},
				data: [{
					type: "pie",
					indexLabelFontSize: 18,
					radius: 80,
					indexLabel: "{label} - {y}",
					yValueFormatString: "###0.0'%'",
					click: explodePie3,
					dataPoints: [
						{ y: "<?=$ping_accepted?>", label: "Ping Accepted" },
						{ y: "<?=$ping_rejected_pie?>", label: "Ping Rejected"},
						{ y: "<?=$ping_duplicate?>", label: "Ping Duplicate" },
					]
				}]
			});
			chart3.render();
			function explodePie3(e) {
				for(var i = 0; i < e.dataSeries.dataPoints.length; i++) {
					if(i !== e.dataPointIndex)
						e.dataSeries.dataPoints[i].exploded = false;
				}
			}
			// PIE CHART
				var chart4 = new CanvasJS.Chart("chartContainer4", {
				theme: "light2",
				animationEnabled: true,
				title: {
					text: "Shares of Posts by it's Status In Last 15 Days"
				},
				data: [{
					type: "pie",
					indexLabelFontSize: 18,
					radius: 80,
					indexLabel: "{label} - {y}",
					yValueFormatString: "###0.0'%'",
					click: explodePie4,
					dataPoints: [
						{ y: "<?=$post_accepted?>", label: "Post Accepted" },
						{ y: "<?=$post_rejected_pie?>", label: "Post Rejected"},
						{ y: "<?=$post_duplicate?>", label: "Post Duplicate" },
					]
				}]
			});
			chart4.render();
			function explodePie4(e) {
				for(var i = 0; i < e.dataSeries.dataPoints.length; i++) {
					if(i !== e.dataPointIndex)
						e.dataSeries.dataPoints[i].exploded = false;
				}
			}
		}
			</script>
			<div id="chartContainer" style="height: 370px; max-width: 100%; margin: 0 auto;"></div>
		<?php $this->endWidget(); ?>
	</div>
</div>
<div class="row-fluid dashboard-three-cols">
	<div class="span4 dashboard-three-cols__item">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array(
				'title' => "<i class='icon-info-sign'></i>Conversions(Accepted) of Last 15 days"
			));
			?>
		<div id="chartContainer1" style="height: 370px; max-width: 100%; margin: 0 auto;"></div>
		<?php $this->endWidget();?>
	</div>
	<div class="span4 dashboard-three-cols__item">
		<?php
		$this->beginWidget('zii.widgets.CPortlet',array(
			'title' => '<span class="icon-th-list"></span>Today&#39;s Ping Report',
		));
		?>
		<div id="chartContainer3" style="height: 370px; max-width: 100%; margin: 0 auto;"></div>
		<?php $this->endWidget(); ?>
	</div>
	<div class="span4 dashboard-three-cols__item">
		<?php
		$this->beginWidget('zii.widgets.CPortlet',array(
			'title' => '<span class="icon-th-list"></span>Today&#39;s Post Report',
		));
		?>
		<div id="chartContainer4" style="height: 370px; max-width: 100%; margin: 0 auto;"></div>
		<?php $this->endWidget(); ?>
	</div>
</div>
</div>
<?php } elseif(Yii::app()->user->getState('usertype')=='affiliate'){
// IF LOGGED IN USER IS AFFILIATE
?>
<br>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Affiliate Report",));
		$form=$this->beginWidget('CActiveForm',array('id' => 'affiliate_report','enableAjaxValidation' => false));
		?>
		<table class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<td style="width: 100px"><b>Date Range : </b>
						<?php
							$default_date = date('Y-m-d',strtotime("-7 day")).' - '.date('Y-m-d');
							$date_filter = Yii::app()->getRequest()->getParam('date_filter',$default_date);
							$this->widget('ext.EDateRangePicker.EDateRangePicker',array(
								'id' => 'Filter_date',
								'name' => 'date_filter',
								'value' => ''.$date_filter.'',
								'options' => array(
									'arrows' => true,
									'closeOnSelect' => true
								),
								'htmlOptions' => array(
									'class' => 'inputClass'
								)
							));
							?>
					</td>
					<td><b>Action :</b><br>
						<?php echo CHtml::submitButton('Search',array( 'class' => 'btn btn-primary')); ?>
					</td>
				</tr>
			</thead>
		</table>
		<?php $this->endWidget();?>
		<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report">
			<thead>
				<tr>
					<th>Date</th>
					<th>Ping Sent</th>
					<th>Duplicate Ping</th>
					<th>Ping Accepted</th>
					<th>Post Sent</th>
					<th>Post Accepted</th>
					<th>Lead Returned</th>
					<th>Final Leads</th>
					<th>Revenue</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($affiliate_reports as $k => $affiliate_report){
						$date = date('Y-m-d',strtotime(trim($affiliate_report['date'])));
						$final_leads = ($affiliate_report['post_accepted']-$affiliate_report['lead_returned']);
					?>
				<tr>
					<td align="right"><?php echo $date;?></td>
					<td align="right"><?php echo ($affiliate_report['ping_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'">'.$affiliate_report['ping_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliate_report['duplicate_ping']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&duplicate_ping=1">'.$affiliate_report['duplicate_ping'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliate_report['ping_accepted']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&ping_status=1">'.$affiliate_report['ping_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliate_report['post_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&post_sent=1">'.$affiliate_report['post_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliate_report['post_accepted'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&post_status=1">'.$affiliate_report['post_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliate_report['lead_returned'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&lead_returned=1">'.$affiliate_report['lead_returned'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($final_leads)? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&final=1">'.$final_leads.'</a>' : 0;?></td>
					<td align="right">$<?php echo ($affiliate_report['revenue']=='') ? '0.00' : round($affiliate_report['revenue'],2);?></td>
				</tr>
				<?php
					$ping_sent_total += ($affiliate_report['ping_sent']=='') ? 0 : $affiliate_report['ping_sent'];
					$duplicate_ping_total += ($affiliate_report['duplicate_ping']=='') ? 0 : $affiliate_report['duplicate_ping'];
					$ping_accepted_total += ($affiliate_report['ping_accepted']=='') ? 0 : $affiliate_report['ping_accepted'];
					$post_sent_total += ($affiliate_report['post_sent']=='') ? 0 : $affiliate_report['post_sent'];
					$post_accepted_total += ($affiliate_report['post_accepted']=='') ? 0 : $affiliate_report['post_accepted'];
					$lead_returned_total += ($affiliate_report['lead_returned']=='') ? 0 : $affiliate_report['lead_returned'];
					$final_leads_total += $final_leads;
					$revenue_total += ($affiliate_report['revenue']=='') ? 0 : round($affiliate_report['revenue'],2);
					}
					?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header" colspan="">Total</th>
					<th class="header" align="right"><?php echo $ping_sent_total;?></th>
					<th class="header" align="right"><?php echo $duplicate_ping_total;?></th>
					<th class="header" align="right"><?php echo $ping_accepted_total;?></th>
					<th class="header" align="right"><?php echo $post_sent_total;?></th>
					<th class="header" align="right"><?php echo $post_accepted_total;?></th>
					<th class="header" align="right"><?php echo $lead_returned_total;?></th>
					<th class="header" align="right"><?php echo $final_leads_total;?></th>
					<th class="header" align="right">$<?php echo $revenue_total;?></th>
				</tr>
			</tfoot>
		</table>
	</div>
	<?php $this->endWidget(); ?>
</div>
<div class="row-fluid">
	<div class="span6">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array(
					'title' => "
			        <span class='icon-th-list'></span>Pings Report of Last 15 Days for ".$name,
					'titleCssClass' => ''
				));
		$promo_code = Yii::app()->user->id;
		$ping_results = AffiliateDailyCounts::specific_affiliate_pingreport_last_15days($promo_code);
		$post_results = AffiliateDailyCounts::specific_affiliate_postreport_last_15days($promo_code);
		//echo '<pre>';print_r($ping_results);print_r($post_results);exit;
		if(isset($ping_results) && !empty($ping_results)) {
			$ping_sent = $ping_results['ping_sent'];
			$ping_duplicate = round($ping_results['ping_duplicate']*100/$ping_sent);
			$ping_accepted = round($ping_results['ping_accepted']*100/$ping_sent);
			$ping_rejected_pie = round(100 - ($ping_duplicate + $ping_accepted));
		} else {
			$ping_sent = 100;$ping_duplicate = 0;$ping_accepted = 0;$ping_rejected_pie = 0;
		}
		// ping 3d pie
		if(isset($post_results) && !empty($post_results)) {
			$post_sent = $post_results['post_sent'];
			$post_duplicate = round($post_results['post_duplicate']*100/$post_sent);
			$post_accepted = round($post_results['post_accepted']*100/$post_sent);
			$post_rejected_pie = round(100 - ($post_duplicate + $post_accepted));
		} else {
			$post_sent = 100;$post_duplicate = 0;$post_accepted = 0;$post_rejected_pie = 0;
		}
		?>
		<script>
			window.onload = function () {
			// PIE CHART
				var chart3 = new CanvasJS.Chart("chartContainer3", {
				theme: "light2",
				animationEnabled: true,
				title: {
					text: "Shares of Pings by it's Status In Last 15 Days"
				},
				data: [{
					type: "pie",
					indexLabelFontSize: 18,
					radius: 80,
					indexLabel: "{label} - {y}",
					yValueFormatString: "###0.0'%'",
					click: explodePie3,
					dataPoints: [
						{ y: "<?=$ping_accepted?>", label: "Ping Accepted" },
						{ y: "<?=$ping_rejected_pie?>", label: "Ping Rejected"},
						{ y: "<?=$ping_duplicate?>", label: "Ping Duplicate" },
					]
				}]
			});
			chart3.render();
			function explodePie3(e) {
				for(var i = 0; i < e.dataSeries.dataPoints.length; i++) {
					if(i !== e.dataPointIndex)
						e.dataSeries.dataPoints[i].exploded = false;
				}
			}
			// PIE CHART
				var chart4 = new CanvasJS.Chart("chartContainer4", {
				theme: "light2",
				animationEnabled: true,
				title: {
					text: "Shares of Posts by it's Status In Last 15 Days"
				},
				data: [{
					type: "pie",
					indexLabelFontSize: 18,
					radius: 80,
					indexLabel: "{label} - {y}",
					yValueFormatString: "###0.0'%'",
					click: explodePie4,
					dataPoints: [
						{ y: "<?=$post_accepted?>", label: "Post Accepted" },
						{ y: "<?=$post_rejected_pie?>", label: "Post Rejected"},
						{ y: "<?=$post_duplicate?>", label: "Post Duplicate" },
					]
				}]
			});
			chart4.render();
			function explodePie4(e) {
				for(var i = 0; i < e.dataSeries.dataPoints.length; i++) {
					if(i !== e.dataPointIndex)
						e.dataSeries.dataPoints[i].exploded = false;
				}
			}
		}
			</script>
		<div id="chartContainer3" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
		<?php $this->endWidget(); ?>
	</div>
	<div class="span6">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array(
					'title' => "
			        <span class='icon-th-list'></span>Post Report of Last 15 Days for ".$name,
					'titleCssClass' => ''
				));
				?>
		<div id="chartContainer4" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
		<?php $this->endWidget(); ?>
	</div>
</div>
<?php } elseif(Yii::app()->user->getState('usertype')=='lender'){?>
	<br>
	<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Lender Report",));
		$form=$this->beginWidget('CActiveForm',array('id' => 'lender_report','enableAjaxValidation' => false));
		?>
		<table class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<td style="width: 100px"><b>Date Range : </b>
						<?php
							$default_date = date('Y-m-d',strtotime("-7 day")).' - '.date('Y-m-d');
							$date_filter = Yii::app()->getRequest()->getParam('date_filter',$default_date);
							$this->widget('ext.EDateRangePicker.EDateRangePicker',array(
								'id' => 'Filter_date',
								'name' => 'date_filter',
								'value' => ''.$date_filter.'',
								'options' => array(
									'arrows' => true,
									'closeOnSelect' => true
								),
								'htmlOptions' => array(
									'class' => 'inputClass'
								)
							));
							?>
					</td>
					<td><b>Action :</b><br>
						<?php echo CHtml::submitButton('Search',array( 'class' => 'btn btn-primary')); ?>
					</td>
				</tr>
			</thead>
		</table>
		<?php $this->endWidget();?>
		<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report">
			<thead>
				<tr>
					<th>Date</th>
					<th>Ping Sent</th>
					<th>Ping Accepted</th>
					<th>Post Sent</th>
					<th>Post Accepted</th>
					<th>Lead Returned</th>
					<th>Final Leads</th>
					<th>Revenue</th>
					<th>Average Ping Price</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 0;
					foreach($lender_reports as $k => $lender_report){
						$date = date('Y-m-d',strtotime(trim($lender_report['date'])));
						$final_leads = ($lender_report['post_accepted']-$lender_report['lead_returned']);
					?>
				<tr>
					<td align="right"><?php echo $date;?></td>
					<td align="right"><?php echo ($lender_report['ping_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'">'.$lender_report['ping_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lender_report['ping_accepted']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&ping_status=1">'.$lender_report['ping_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lender_report['post_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&post_sent=1">'.$lender_report['post_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lender_report['post_accepted'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&post_status=1">'.$lender_report['post_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lender_report['lead_returned'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&lead_returned=1">'.$lender_report['lead_returned'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($final_leads)? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&final=1">'.$final_leads.'</a>' : 0;?></td>
					<td align="right">$<?php echo ($lender_report['revenue']=='') ? '0.00' : round($lender_report['revenue'],2);?></td>
					<td align="right">$<?php echo ($lender_report['average_ping_price']=='') ? '0.00' : round($lender_report['average_ping_price'],2);?></td>
				</tr>
				<?php
					$ping_sent_total += ($lender_report['ping_sent']=='') ? 0 : $lender_report['ping_sent'];
					$ping_accepted_total += ($lender_report['ping_accepted']=='') ? 0 : $lender_report['ping_accepted'];
					$post_sent_total += ($lender_report['post_sent']=='') ? 0 : $lender_report['post_sent'];
					$post_accepted_total += ($lender_report['post_accepted']=='') ? 0 : $lender_report['post_accepted'];
					$lead_returned_total += ($lender_report['lead_returned']=='') ? 0 : $lender_report['lead_returned'];
					$final_leads_total += $final_leads;
					$revenue_total += ($lender_report['revenue']=='') ? 0 : round($lender_report['revenue'],2);
					$average_ping_price_total += ($lender_report['average_ping_price']=='') ? 0 : round($lender_report['average_ping_price'],2);
					$i++;
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header" colspan="">Total</th>
					<th class="header" align="right"><?php echo $ping_sent_total;?></th>
					<th class="header" align="right"><?php echo $ping_accepted_total;?></th>
					<th class="header" align="right"><?php echo $post_sent_total;?></th>
					<th class="header" align="right"><?php echo $post_accepted_total;?></th>
					<th class="header" align="right"><?php echo $lead_returned_total;?></th>
					<th class="header" align="right"><?php echo $final_leads_total;?></th>
					<th class="header" align="right">$<?php echo $revenue_total;?></th>
					<th class="header" align="right">$<?php echo round(($average_ping_price_total/$i),2);?></th>
				</tr>
			</tfoot>
		</table>
	</div>
	<?php $this->endWidget(); ?>
</div>
<div class="row-fluid">
	<div class="span6">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array(
					'title' => "
			        <span class='icon-th-list'></span>Pings Report of Last 15 Days for ".$name,
					'titleCssClass' => ''
				));
		$lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
		$lender_id = $lender->id;
		$res1 = LenderAffiliateTransaction::specific_lender_ping_report_last_15days($lender_id);
		$res2 = LenderAffiliateTransaction::specific_lender_post_report_last_15days($lender_id);
		?>
		<script>
			window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer", {
				exportEnabled: true,
				animationEnabled: true,
				title:{
					text: "Total Ping Sent vs Total Ping Accepts of Last 15 days for You"
				},
				subtitles: [{
					text: "Click Legend to Hide or Unhide Data Series"
				}], 
				axisX: {
					title: "Buyer"
				},
				axisY: {
					title: "Sent - Leads",
					titleFontColor: "#4F81BC",
					lineColor: "#4F81BC",
					labelFontColor: "#4F81BC",
					tickColor: "#4F81BC"
				},
				axisY2: {
					title: "Accepted - Leads",
					titleFontColor: "#C0504E",
					lineColor: "#C0504E",
					labelFontColor: "#C0504E",
					tickColor: "#C0504E"
				},
				
				toolTip: {
					shared: true
				},
				legend: {
					cursor: "pointer",
					itemclick: toggleDataSeries
				},
				data: [
				{
					type: "column",
					name: "Total Sent",
					showInLegend: true,      
					yValueFormatString: "#,##0.# Leads",
					dataPoints: [
						<?php foreach ($res1 as $row) { ?>
						{ label: "<?=$row['lender']?>",  y: <?=$row['ping_sent']?> },
						<?php } ?>
					]
				},
				{
					name: "Total Accepted",
					type: "column",
					showInLegend: true,      
					yValueFormatString: "#,##0.# Leads",
					dataPoints: [
						<?php foreach ($res1 as $row) { ?>
						{ label: "<?=$row['lender']?>",  y: <?=$row['ping_accepted']?> },
						<?php } ?>
					]
				},
				
				]
			});
			chart.render();
			function toggleDataSeries(e) {
				if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
					e.dataSeries.visible = false;
				} else {
					e.dataSeries.visible = true;
				}
				e.chart.render();
			}
			// graph 1
				var chart1 = new CanvasJS.Chart("chartContainer1", {
				exportEnabled: true,
				animationEnabled: true,
				title:{
					text: "Total Post Sent vs Total Post Accepts of Last 15 days for You"
				},
				subtitles: [{
					text: "Click Legend to Hide or Unhide Data Series"
				}], 
				axisX: {
					title: "Buyer"
				},
				axisY: {
					title: "Sent - Leads",
					titleFontColor: "#4F81BC",
					lineColor: "#4F81BC",
					labelFontColor: "#4F81BC",
					tickColor: "#4F81BC"
				},
				axisY2: {
					title: "Accepted - Leads",
					titleFontColor: "#C0504E",
					lineColor: "#C0504E",
					labelFontColor: "#C0504E",
					tickColor: "#C0504E"
				},
				
				toolTip: {
					shared: true
				},
				legend: {
					cursor: "pointer",
					itemclick: toggleDataSeries1
				},
				data: [
				{
					type: "column",
					name: "Total Sent",
					showInLegend: true,      
					yValueFormatString: "#,##0.# Leads",
					dataPoints: [
						<?php foreach ($res2 as $row) { ?>
						{ label: "<?=$row['lender']?>",  y: <?=$row['post_sent']?> },
						<?php } ?>
					]
				},
				{
					name: "Total Accepted",
					type: "column",
					showInLegend: true,      
					yValueFormatString: "#,##0.# Leads",
					dataPoints: [
						<?php foreach ($res2 as $row) { ?>
						{ label: "<?=$row['lender']?>",  y: <?=$row['post_accepted']?> },
						<?php } ?>
					]
				},
				
				]
			});
			chart1.render();
			function toggleDataSeries1(e) {
				if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
					e.dataSeries.visible = false;
				} else {
					e.dataSeries.visible = true;
				}
				e.chart1.render();
			}
		}
	</script>
	<div style="padding-left:20px;">
		<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
	</div>
		<?php $this->endWidget(); ?>
	</div>
	<div class="span6">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array(
					'title' => "
			        <span class='icon-th-list'></span>Post Report of Last 15 Days for ".$name,
					'titleCssClass' => ''
				));
				?>
		<div style="padding-left:20px;">
		<div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
	</div>
		<?php $this->endWidget(); ?>
	</div>
</div>
<?php } ?>
