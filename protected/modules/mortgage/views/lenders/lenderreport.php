<?php
$this->breadcrumbs = array('Lender Details' => array('index'), 'Lender Report');
$this->menu = array(
	array('label' => 'Lender Setup', 'url' => array('index')),
	array('label' => 'Lender Stats', 'url' => array('lenderstats')),
);

$MORTGAGE_LEAD_TYPES = isset(Yii::app()->params['mortgage_lead_types']) ? Yii::app()->params['mortgage_lead_types'] : array(1 => 'New Home', 2 => 'Refinance', 3 => 'Home Equity', 4 => 'Reverse Mortgage');
$filter_date = Yii::app()->request->getParam('filter_date', date('Y-m-d'));
$lender = Yii::app()->request->getParam('lender');
$mortgage_lead_type = Yii::app()->getRequest()->getParam('mortgage_lead_type');
$indexUrl = $this->createUrl('index');
$statsUrl = $this->createUrl('lenderstats');
$start_date = isset($searched_data['filter_date']['start_date']) ? $searched_data['filter_date']['start_date'] : '';
$end_date = isset($searched_data['filter_date']['end_date']) ? $searched_data['filter_date']['end_date'] : '';
$campaignBase = Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']);
?>
<section class="lenders-page mortgage-dashboard-section lenders-report-page">
	<header class="lenders-page-header">
		<div class="lenders-page-header-inner">
			<h1 class="lenders-page-title">Lender Report</h1>
			<p class="lenders-page-subtitle">Leads accepted by lender and mortgage type with totals and profit.</p>
		</div>
		<div class="lenders-page-actions">
			<a href="<?php echo CHtml::encode($statsUrl); ?>" class="btn btn-default">Lender Stats</a>
			<a href="<?php echo CHtml::encode($indexUrl); ?>" class="btn btn-default">Lender Setup</a>
		</div>
	</header>

	<div class="stats-filter-card portlet portlet--filters-collapsible">
		<div class="portlet-decoration">
			<span class="portlet-title">Filters</span>
		</div>
		<div class="portlet-content">
			<?php
			$form = $this->beginWidget('CActiveForm', array('id' => 'lender_reports', 'enableAjaxValidation' => false));
			?>
			<div class="stats-filter-grid">
				<div class="stats-filter-group">
					<label class="stats-filter-label" for="Filter_date">Date range</label>
					<div class="stats-filter-field">
						<?php
						$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
							'id' => 'Filter_date',
							'name' => 'filter_date',
							'value' => $filter_date,
							'options' => array('arrows' => true, 'closeOnSelect' => true),
							'htmlOptions' => array('class' => 'inputClass'),
						));
						?>
					</div>
				</div>
				<div class="stats-filter-group">
					<label class="stats-filter-label" for="lender">Lender</label>
					<div class="stats-filter-field">
						<?php echo CHtml::dropDownList('lender', $lender, CHtml::listData(LenderDetails::model()->findAll(), 'id', 'name'), array('class' => 'inputClass', 'empty' => 'All Lenders')); ?>
					</div>
				</div>
				<div class="stats-filter-group">
					<label class="stats-filter-label">Mortgage type</label>
					<div class="stats-filter-field leads-filter-radios">
						<?php echo CHtml::radioButtonList('mortgage_lead_type', $mortgage_lead_type, array('' => 'All', '1' => 'New Home', '2' => 'Refinance', '3' => 'Home Equity', '4' => 'Reverse Mortgage'), array('labelOptions' => array('style' => 'display:inline'))); ?>
					</div>
				</div>
				<div class="stats-filter-group stats-filter-actions">
					<label class="stats-filter-label">&nbsp;</label>
					<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>

	<div class="stats-table-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Report by lender and mortgage type</span>
		</div>
		<div class="portlet-content dashboard-table-wrap">
			<table class="table table-striped table-hover table-bordered table-condensed lenders-report-table">
				<thead>
					<tr>
						<th>Lender</th>
						<th>Mortgage Lead Type</th>
						<th>Lead Price</th>
						<th class="text-right">Leads Accepted</th>
						<th class="text-right">Total Accepted</th>
						<th class="text-right">Returned</th>
						<th class="text-right">Grand Total</th>
						<th class="text-right">Turn Over / Profit Sum</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$column_vise_leads_sum = 0;
					$column_vise_total_accepted_sum = 0;
					$column_vise_total_returned_leads = 0;
					$total_turn_over = 0;
					$column_vise_grand_total = 0;
					if (!empty($lender_array)):
						foreach ($lender_array as $lender_name => $lender_lead_price):
							$count = isset($lender_lead_price['transactions']) ? count($lender_lead_price['transactions']) : 0;
							$rowspan = $count > 1 ? ' rowspan="' . $count . '" style="vertical-align: middle;"' : '';
							$i = 0;
							if (!empty($lender_lead_price['transactions'])):
								foreach ($lender_lead_price['transactions'] as $lead_prices):
									$lead_price = $lead_prices['lead_price'];
									$leads = $lead_prices['leads'];
									$column_vise_leads_sum += $leads;
									$is_first = ($i === 0);
									if ($is_first) {
										$column_vise_total_accepted_sum += $lender_lead_price['total_accepted_leads'];
										$column_vise_total_returned_leads += $lender_lead_price['total_returned_leads'];
										$column_vise_grand_total += $lender_lead_price['grand_total'];
										$total_turn_over += round($lender_lead_price['turn_over'], 2);
									}
					?>
					<tr>
						<?php if ($is_first): ?><td<?php echo $rowspan; ?> width="120px"><?php echo CHtml::encode($lender_name); ?></td><?php endif; ?>
						<td width="120px"><?php echo CHtml::encode($MORTGAGE_LEAD_TYPES[$lead_prices['mortgage_lead_type']] ?? ''); ?></td>
						<td width="120px">$<?php echo CHtml::encode($lead_price); ?></td>
						<td class="text-right" width="120px"><a target="_blank" rel="noopener noreferrer" href="<?php echo $campaignBase; ?>/leads/lead_info?lead_price=<?php echo urlencode($lead_price); ?>&lender=<?php echo urlencode($lender_name); ?>&start_date=<?php echo urlencode($start_date); ?>&end_date=<?php echo urlencode($end_date); ?>"><?php echo $leads; ?></a></td>
						<?php if ($is_first): ?>
						<td<?php echo $rowspan; ?> class="text-right" width="120px"><a target="_blank" rel="noopener noreferrer" href="<?php echo $campaignBase; ?>/leads/lead_info?&lender=<?php echo urlencode($lender_name); ?>&start_date=<?php echo urlencode($start_date); ?>&end_date=<?php echo urlencode($end_date); ?>"><?php echo $lender_lead_price['total_accepted_leads']; ?></a></td>
						<td<?php echo $rowspan; ?> class="text-right" width="120px"><a target="_blank" rel="noopener noreferrer" href="<?php echo $campaignBase; ?>/leads/lead_info?&lender=<?php echo urlencode($lender_name); ?>&start_date=<?php echo urlencode($start_date); ?>&end_date=<?php echo urlencode($end_date); ?>&is_returned=1"><?php echo $lender_lead_price['total_returned_leads']; ?></a></td>
						<td<?php echo $rowspan; ?> class="text-right" width="120px"><a target="_blank" rel="noopener noreferrer" href="<?php echo $campaignBase; ?>/leads/lead_info?&lender=<?php echo urlencode($lender_name); ?>&start_date=<?php echo urlencode($start_date); ?>&end_date=<?php echo urlencode($end_date); ?>&final=1"><?php echo $lender_lead_price['grand_total']; ?></a></td>
						<td<?php echo $rowspan; ?> class="text-right" width="120px">$<?php echo number_format(round($lender_lead_price['turn_over'], 2), 2); ?></td>
						<?php endif; ?>
					</tr>
					<?php
									$i++;
								endforeach;
							endif;
						endforeach;
					?>
					<tr>
						<td><strong>Total</strong></td>
						<td></td>
						<td></td>
						<td class="text-right"><strong><?php echo $column_vise_leads_sum; ?></strong></td>
						<td class="text-right"><strong><?php echo $column_vise_total_accepted_sum; ?></strong></td>
						<td class="text-right"><strong><?php echo $column_vise_total_returned_leads; ?></strong></td>
						<td class="text-right"><strong><?php echo $column_vise_grand_total; ?></strong></td>
						<td class="text-right"><strong>$<?php echo number_format($total_turn_over, 2); ?></strong></td>
					</tr>
					<?php else: ?>
					<tr>
						<td colspan="8" class="stats-table-empty">Set filters and click Search to view the report.</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
