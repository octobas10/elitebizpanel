<style>
	.grid-view table.items td {
		font-family: Carrois Gothic, sans-serif;
		font-size: 1em;
	}

	.portlet-title {
		font-size: 16px;
	}

	.stat_title {
		font-size: 24px;
		margin-top: 25px;
		margin-bottom: 20px;
	}

	.summary ul li {
		height: 52px;
		float: left;
		width: 100%;
	}

	.affiliate_report a {
		color: #08c;
		text-decoration: none;
	}

	.fix_portlet .portlet-content {
		padding: 15px 0 0;
		height: 370px;
	}

	.portlet-content .graph_wrapper {
		overflow: hidden;
		overflow-x: auto;
	}

	/*
    .portlet-content embed {
        width: 100%;
    }
*/
	.tiles_wrapper {
		margin-bottom: 20px;
	}
</style>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/fusionchart/fusionCharts.js"></script>
<?php
$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
$name = Yii::app()->user->name;
// IF LOGGED IN USER IS ADMIN
if (Yii::app()->user->getState('roles') == '1') {  ?>
	<div class="row tiles_wrapper">
		<div class="col-sm-4">
			<div class="panel panel-default" style="margin-top:20px;padding:10px;">
				<div class="media">
					<div class="media-left">
						<a href="#">
							<img src="<?php echo $baseUrl; ?>/img/group.png" width="40" height="40" alt="Active Members">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo number_format($week_affs); /*echo number_format($week_submissions);*/ ?></h4>
						Last 7 Days Submission
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default" style="margin-top:20px;padding:10px;">
				<div class="media">
					<div class="media-left">
						<a href="#">
							<img src="<?php echo $baseUrl; ?>/img/group.png" width="40" height="40" alt="Active Members">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo number_format($month_affs); /*echo number_format($week_accepted);*/ ?></h4>
						Last 30 Days Submission
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default" style="margin-top:20px;padding:10px;">
				<div class="media">
					<div class="media-left">
						<a href="#">
							<img src="<?php echo $baseUrl; ?>/img/group.png" width="40" height="40" alt="Active Members">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo number_format(AffiliateTransactions::model()->count()); /*echo number_format(Submissions::model()->count());*/ ?></h4>
						Total Submission Till Today
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--<div style="clear: both; height: 15px;"></div>-->
	<div class="row-fluid">
		<div class="clearfix">
			<?php $form = $this->beginWidget('CActiveForm', array('id' => 'campaign_reports', 'enableAjaxValidation' => false)); ?>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered table-condensed">
					<thead>
						<tr>
							<td style="width: 100px"><b>Date Range :</b>
								<?php
								$default_date = date('Y-m-d', strtotime("-7 day")) . ' - ' . date('Y-m-d');
								$date_filter = Yii::app()->getRequest()->getParam('date_filter', $default_date);
								$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
									'id' => 'Filter_date',
									'name' => 'date_filter',
									'value' => '' . $date_filter . '',
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
								<?php echo CHtml::submitButton('Search', array('class' => 'btn btn btn-primary')); ?>
							</td>
						</tr>
					</thead>
				</table>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="clearfix">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => '<span class="icon-picture"></span>Campaign Performance - Edu'));
			if (is_array($leads)) { ?>
				<div class="table-responsive">
					<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<th>Date</th>
								<th style="text-align:right">Leads</th>
								<th style="text-align:right">Lender Price/Revenue</th>
								<th style="text-align:right">Affiliate Price/Cost</th>
								<th style="text-align:right">Profit</th>
								<th style="text-align:right">Profit Margin</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$lead_total = $revenue_seller_total = $revenue_buyer_total = $profit_total = $margin_total = $margin = '0';
							if (!empty($leads)) {
								foreach ($leads as $date => $lead) {
									if ($revenue_buyer[$date] != 0) {
										$margin = number_format(($profit[$date] / $revenue_buyer[$date]) * 100, 2);
									}
									if ($leads[$date]) {
										echo '<tr>
									<td>' . $date . '</td>
									<td align="right">' . (!empty($leads[$date]) ? $leads[$date] : 0) . '</td>
									<td align="right">$' . (!empty($revenue_buyer[$date]) ? number_format($revenue_buyer[$date], 2) : '0.00') . '</td>
									<td align="right">$' . (!empty($revenue_seller[$date]) ? number_format($revenue_seller[$date], 2) : '0.00') . '</td>
									<td align="right">$' . number_format($profit[$date], 2) . '</td>
									<td align="right">' . $margin . '%</td>	
								</tr>';
									}
									$lead_total += !empty($leads[$date]) ? $leads[$date] : 0;
									$revenue_seller_total += $revenue_seller[$date];
									$revenue_buyer_total += $revenue_buyer[$date];
									$profit_total += $profit[$date];
									$margin_total = ($profit_total / $revenue_seller_total) * 100;
								}
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th class="header" colspan="">Total</th>
								<th class="header" align="right" style="text-align:right"><?= number_format($lead_total); ?></th>
								<th class="header" align="right" style="text-align:right">$<?= number_format($revenue_buyer_total, 2); ?></th>
								<th class="header" align="right" style="text-align:right">$<?= number_format($revenue_seller_total, 2); ?></th>
								<th class="header" align="right" style="text-align:right">$<?= number_format($profit_total, 2); ?></th>
								<th class="header" align="right" style="text-align:right"><?= round($margin_total, 2); ?>%</th>
							</tr>
						</tfoot>
					</table>
				</div>
			<?php
			} else {
				echo 'No Data Found';
			}
			$this->endWidget(); ?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="clearfix">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title' => '<span class="icon-picture"></span>Posts Sent by Affiliates / Post Accepted for Affiliates'
			));
			if (count($affiliates_pingpost_dates)) { ?>
				<div class="table-responsive">
					<table id="myTable" class="table table-striped table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<th class="header" style="vertical-align: middle;" width="10%" rowspan="3">Date</th>
								<th class="header" style="text-align: center;" width="90%" colspan="<?php echo count($affiliates) * 2; ?>">Affiliates</th>
							</tr>
							<tr>
								<?php
								foreach ($affiliates as $vid => $affiliate_name) {
									echo '<th style="text-align:center;width:' . (round(90 / count($affiliates))) . '%" colspan="2">' . $affiliate_name . '(' . $vid . ')</th>';
								}
								?>
							</tr>
							<tr>
								<?php foreach ($affiliates as $vid => $affiliate_name) { ?>
									<td align=right>Post Sent</td>
									<td align=right>Post Accepted</td>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
							$total_vendor_sale = $total_vendor_acceptance = array();
							foreach ($affiliates_pingpost_dates as $date) {
								echo '<tr><td>' . $date . '</td>';
								foreach ($affiliates as $vid => $affiliate_name) {
									$posts = (!empty($affiliates_statistics[$vid][$date]['post_sent']) ? $affiliates_statistics[$vid][$date]['post_sent'] : 0);
									$accepted_posts = (!empty($affiliates_statistics[$vid][$date]['post_accepted']) ? $affiliates_statistics[$vid][$date]['post_accepted'] : 0);
									$total_vendor_sale[$vid] += $posts;
									$total_vendor_acceptance[$vid] += $accepted_posts;
									echo '<td align=right style="">' . $posts . '</td>' . '<td align=right style="">' . $accepted_posts . '</td>';
								}
								echo '</tr>';
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th class="header">Total</th>
								<?php
								foreach ($affiliates as $vid => $affiliate_name) {
									echo '<th style="text-align:right" class="header" align=right>' . $total_vendor_sale[$vid] . '</th>' . '<th style="text-align:right" class="header" align=right>' . $total_vendor_acceptance[$vid] . '</th>';
								}
								?>
							</tr>
						</tfoot>
					</table>
				</div>
			<?php
			} else {
				echo 'No Data Found';
			}
			$this->endWidget(); ?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="clearfix">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title' => '<span class="icon-picture"></span>Posts Sent to Lenders / Post Accepted by Lenders'
			));
			if (count($lenders_pingpost_dates)) { ?>
				<div class="table-responsive">
					<table id="myTable" class="table table-striped table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<th class="header" style="vertical-align: middle;" width="10%" rowspan="3">Date</th>
								<th class="header" style="text-align: center;" width="90%" colspan="<?php echo count($lenders) * 2; ?>">Lenders</th>
							</tr>
							<tr>
								<?php
								foreach ($lenders as $lender_id) {
									echo '<th align=center style="text-align:center;width:' . (round(90 / count($lenders))) . '%" colspan="2">' . $Buyers[$lender_id] . '(' . $lender_id . ')</th>';
								}
								?>
							</tr>
							<tr>
								<?php foreach ($lenders as $lender_id) { ?>
									<td align=right>Post Sent</td>
									<td align=right>Post Accepted</td>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
							$total_lender_sale = $total_lender_acceptance = [];
							foreach ($lenders_pingpost_dates as $date) {
								echo '<tr><td>' . $date . '</td>';
								foreach ($lenders as $lender_id) {
									$posts = (!empty($lenders_statistics[$lender_id][$date]['post_sent']) ? $lenders_statistics[$lender_id][$date]['post_sent'] : 0);
									$accepted_posts = (!empty($lenders_statistics[$lender_id][$date]['post_accepted']) ? $lenders_statistics[$lender_id][$date]['post_accepted'] : 0);
									$total_lender_sale[$lender_id] += $posts;
									$total_lender_acceptance[$lender_id] += $accepted_posts;
									echo '<td align=right style="">' . $posts . '</td>' . '<td align=right style="">' . $accepted_posts . '</td>';
								}
								echo '</tr>';
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th class="header">Total</th>
								<?php
								foreach ($lenders as $lender_id) {
									echo '<th class="header" align=right style="text-align:right">' . $total_lender_sale[$lender_id] . '</th>' . '<th class="header" align=right style="text-align:right">' . $total_lender_acceptance[$lender_id] . '</th>';
								}
								?>
							</tr>
						</tfoot>
					</table>
				</div>
			<?php
			} else {
				echo 'No Data Found';
			}
			$this->endWidget(); ?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="fix_portlet clearfix">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title' => "<i class='icon-info-sign'></i>Conversions(Accepted) of Last 15 days"
			));
			$graph1 = AffiliateDailyCounts::conversionsoflast15days();
			$graph2 = AffiliateDailyCounts::todayspostreport();
			$results = AffiliateDailyCounts::specific_affiliate_postreport_last_15days();
			if (isset($results) && !empty($results)) {
				$post_sent = $results[0]['post_sent'];
				if ($post_sent > 0) {
					$post_duplicate = round($results[0]['post_duplicate'] * 100 / $post_sent);
					$post_accepted = round($results[0]['post_accepted'] * 100 / $post_sent);
				}
				$post_rejected = round(100 - ($post_duplicate + $post_accepted));
			} else {
				$post_sent = 100;
				$post_duplicate = 0;
				$post_accepted = 0;
				$post_rejected = 0;
			}
			?>
			<div style="padding-left:20px;">
				<script>
					window.onload = function() {
						var chart = new CanvasJS.Chart("chartContainer", {
							animationEnabled: true,
							exportEnabled: true,
							theme: "light1", // "light1", "light2", "dark1", "dark2"
							title: {
								text: "Total Accepted of last 15 days"
							},
							data: [{
								type: "column", //change type to bar, line, area, pie, etc
								//indexLabel: "{y}", //Shows y value on all Data Points
								indexLabelFontColor: "#5A5757",
								indexLabelPlacement: "outside",
								dataPoints: [
									<?php foreach ($graph1 as $row) { ?> {
											label: "<?= date('Y-m-d', strtotime($row['date'])) ?>",
											y: <?= $row['post_accepted'] ?>
										},
									<?php } ?>
								]
							}]
						});
						chart.render();
						//GRAPH 1
						var chart1 = new CanvasJS.Chart("chartContainer1", {
							exportEnabled: true,
							animationEnabled: true,
							title: {
								text: "Total Sent vs Total Accepts for Last 7 Days for All Pubs"
							},
							subtitles: [{
								text: "Click Legend to Hide or Unhide Data Series"
							}],
							axisX: {
								title: "Promo Code(s)"
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
							data: [{
									type: "column",
									name: "Total Sent",
									showInLegend: true,
									yValueFormatString: "#,##0.# Leads",
									dataPoints: [
										<?php foreach ($graph2 as $row) { ?> {
												label: "<?= $row['promo_code'] ?>",
												y: <?= $row['post_sent'] ?>
											},
										<?php } ?>
									]
								},
								{
									name: "Total Accepted",
									type: "column",
									showInLegend: true,
									yValueFormatString: "#,##0.# Leads",
									dataPoints: [
										<?php foreach ($graph2 as $row) { ?> {
												label: "<?= $row['promo_code'] ?>",
												y: <?= $row['post_accepted'] ?>
											},
										<?php } ?>
									]
								},
							]
						});
						chart1.render();

						function toggleDataSeries(e) {
							if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
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
								text: "Shares of Leads by it's Status In Last 15 Days"
							},
							data: [{
								type: "pie",
								indexLabelFontSize: 18,
								radius: 80,
								indexLabel: "{label} - {y}",
								yValueFormatString: "###0.0'%'",
								click: explodePie,
								dataPoints: [{
										y: <?= $post_duplicate; ?>,
										label: "Duplicate"
									},
									{
										y: <?= $post_accepted; ?>,
										label: "Accepted"
									},
									{
										y: <?= $post_rejected; ?>,
										label: "Rejected"
									},
								]
							}]
						});
						chart3.render();

						function explodePie(e) {
							for (var i = 0; i < e.dataSeries.dataPoints.length; i++) {
								if (i !== e.dataPointIndex)
									e.dataSeries.dataPoints[i].exploded = false;
							}
						}
					}
				</script>
				<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<div style="float: middle"></div>
	<div class="row-fluid">
		<div class="fix_portlet clearfix">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title' => '<span class="icon-th-list"></span>Today&#39;s Post Report',
			));
			?>
			<div style="padding-left:20px;">
				<div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<div style="float: middle"></div>
	<div class="row-fluid">
		<div class="clearfix">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title' => "
			        <span class='icon-th-list'></span>Post Report of Last 15 Days for " . $name,
				'titleCssClass' => ''
			));
			?>
			<div style="padding-left:20px;">
				<div id="chartContainer3" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
<?php } else if (Yii::app()->user->getState('usertype') == 'affiliate') { ?>
	<div class="row-fluid">
		<div class="clearfix">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => "Affiliate Report",));
			$form = $this->beginWidget('CActiveForm', array('id' => 'affiliate_report', 'enableAjaxValidation' => false));
			?>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered table-condensed">
					<thead>
						<tr>
							<td style="width: 100px"><b>Date Range : </b>
								<?php
								$default_date = date('n/j/Y', strtotime("-7 day")) . ' - ' . date('n/j/Y');
								$date_filter = Yii::app()->getRequest()->getParam('date_filter', $default_date);
								$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
									'id' => 'Filter_date',
									'name' => 'date_filter',
									'value' => '' . $date_filter . '',
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
								<?php echo CHtml::submitButton('Search', array('class' => 'btn btn btn-primary')); ?>
							</td>
						</tr>
					</thead>
				</table>
			</div>
			<?php $this->endWidget(); ?>
			<div class="table-responsive">
				<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report">
					<thead>
						<tr>
							<th>Date</th>
							<th style="text-align:right">Post Sent</th>
							<th style="text-align:right">Post Accepted</th>
							<th style="text-align:right">Lead Returned</th>
							<th style="text-align:right">Lead Rejected</th>
							<th style="text-align:right">Lead Duplicate</th>
							<th style="text-align:right">Final Leads</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i_rejected_leads = 0;
						foreach ($affiliate_reports as $k => $affiliate_report) {
							$date = date('Y-m-d', strtotime(trim($affiliate_report['date'])));
							$final_leads = ($affiliate_report['post_accepted'] - $affiliate_report['lead_returned']);
						?>
							<tr>
								<td align="left"><?php echo $date; ?></td>
								<td align="right"><?php echo ($affiliate_report['post_sent']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/affiliates/leadinfo?date=' . $date . '&post_sent=1">' . $affiliate_report['post_sent'] . '</a>' : 0; ?></td>
								<td align="right"><?php echo ($affiliate_report['post_accepted']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/affiliates/leadinfo?date=' . $date . '&post_status=1">' . $affiliate_report['post_accepted'] . '</a>' : 0; ?></td>
								<td align="right"><?php echo ($affiliate_report['lead_returned']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/affiliates/leadinfo?date=' . $date . '&lead_returned=1">' . $affiliate_report['lead_returned'] . '</a>' : 0; ?></td>
								<td align="right"><?php echo ($affiliate_report['lead_rejected']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/affiliates/leadinfo?date=' . $date . '&lead_rejected=1">' . $affiliate_report['lead_rejected'] . '</a>' : 0; ?></td>
								<td align="right"><?php echo ($affiliate_report['post_duplicate']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/affiliates/leadinfo?date=' . $date . '&post_status=-1">' . $affiliate_report['post_duplicate'] . '</a>' : 0; ?></td>
								<td align="right"><?php echo ($final_leads) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/affiliates/leadinfo?date=' . $date . '&final=1">' . $final_leads . '</a>' : 0; ?></td>
							</tr>
						<?php
							$post_sent_total += ($affiliate_report['post_sent'] == '') ? 0 : $affiliate_report['post_sent'];
							$post_accepted_total += ($affiliate_report['post_accepted'] == '') ? 0 : $affiliate_report['post_accepted'];
							$lead_returned_total += ($affiliate_report['lead_returned'] == '') ? 0 : $affiliate_report['lead_returned'];
							$lead_duplicated_total += ($affiliate_report['post_duplicate'] == '') ? 0 : $affiliate_report['post_duplicate'];
							$i_rejected_leads += ($affiliate_report['lead_rejected'] == '') ? 0 : $affiliate_report['lead_rejected'];
							$final_leads_total += $final_leads;
							$revenue_total += ($affiliate_report['revenue'] == '') ? 0 : round($affiliate_report['revenue'], 2);
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th class="header" colspan="">Total</th>
							<th class="header" style="text-align:right"><?php echo $post_sent_total; ?></th>
							<th class="header" style="text-align:right"><?php echo $post_accepted_total; ?></th>
							<th class="header" style="text-align:right"><?php echo $lead_returned_total; ?></th>
							<th class="header" style="text-align:right"><?php echo $i_rejected_leads; ?></th>
							<th class="header" style="text-align:right"><?php echo $lead_duplicated_total; ?></th>
							<th class="header" style="text-align:right"><?php echo $final_leads_total; ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
	<div class="row-fluid">
		<div class="clearfix">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => "Stat Logs",));
			$form = $this->beginWidget('CActiveForm', array('id' => 'affiliate_report', 'enableAjaxValidation' => false));
			?>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered table-condensed">
				</table>
			</div>
			<?php $this->endWidget(); ?>
			<div class="table-responsive">
				<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report">
					<thead>
						<tr align="right">
							<td colspan="2" align="right"><a href="../affiliates/affiliatestatlogs">View Detailed Statastics</a></td>
						</tr>
						<tr>
							<th>Date</th>
							<th>Total Gross Clicks</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($t_affiliate_stat_logs) && !empty($t_affiliate_stat_logs)) {
							$total_count = 0;
							foreach ($t_affiliate_stat_logs as $t_affiliate_stat_log) {
								$total_count += $t_affiliate_stat_log['count'];
								echo '<tr>';
								echo '<td>' . date('Y-m-d', strtotime(trim($t_affiliate_stat_log['date']))) . '</td>';
								echo '<td>' . $t_affiliate_stat_log['count'] . '</td>';
								echo '</tr>';
							}
						} else {
							echo "<tr><th colspan='3'>No Stats Found Within Last 7 Days</th></tr>";
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th class="header">Total</th>
							<th class="header"><?php echo $total_count; ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
	<div class="row-fluid">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title' => "
				<span class='icon-th-list'></span>Post Report of Last 7 Days for " . $name,
			'titleCssClass' => ''
		));
		$id =  Yii::app()->user->id;
		$res2 = AffiliateDailyCounts::todayspostreport($id);
		$results = AffiliateDailyCounts::specific_affiliate_postreport_last_15days($id);
		if (isset($results) && !empty($results)) {
			$post_sent = $results[0]['post_sent'];
			$post_duplicate = round($results[0]['post_duplicate'] * 100 / $post_sent);
			$post_accepted = round($results[0]['post_accepted'] * 100 / $post_sent);
			$post_rejected = round(100 - ($post_duplicate + $post_accepted));
		} else {
			$post_sent = 100;
			$post_duplicate = 0;
			$post_accepted = 0;
			$post_rejected = 0;
		}
		?>
		<script>
			window.onload = function() {
				var chart1 = new CanvasJS.Chart("chartContainer1", {
					exportEnabled: true,
					animationEnabled: true,
					title: {
						text: "Total Sent vs Total Accepts of Last 7 days for You"
					},
					subtitles: [{
						text: "Click Legend to Hide or Unhide Data Series"
					}],
					axisX: {
						title: "Promo Code"
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
					data: [{
							type: "column",
							name: "Total Sent",
							showInLegend: true,
							yValueFormatString: "#,##0.# Leads",
							dataPoints: [
								<?php foreach ($res2 as $row) { ?> {
										label: "<?= $row['promo_code'] ?>",
										y: <?= $row['post_sent'] ?>
									},
								<?php } ?>
							]
						},
						{
							name: "Total Accepted",
							type: "column",
							showInLegend: true,
							yValueFormatString: "#,##0.# Leads",
							dataPoints: [
								<?php foreach ($res2 as $row) { ?> {
										label: "<?= $row['promo_code'] ?>",
										y: <?= $row['post_accepted'] ?>
									},
								<?php } ?>
							]
						},

					]
				});
				chart1.render();

				function toggleDataSeries(e) {
					if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
						e.dataSeries.visible = false;
					} else {
						e.dataSeries.visible = true;
					}
					e.chart1.render();
				}

				// PIE CHART
				var chart3 = new CanvasJS.Chart("chartContainer3", {
					theme: "light2",
					animationEnabled: true,
					title: {
						text: "Shares of Leads by it's Status In Last 15 Days"
					},
					data: [{
						type: "pie",
						indexLabelFontSize: 18,
						radius: 80,
						indexLabel: "{label} - {y}",
						yValueFormatString: "###0.0'%'",
						click: explodePie,
						dataPoints: [{
								y: <?= $post_duplicate; ?>,
								label: "Duplicate"
							},
							{
								y: <?= $post_accepted; ?>,
								label: "Accepted"
							},
							{
								y: <?= $post_rejected; ?>,
								label: "Rejected"
							},
						]
					}]
				});
				chart3.render();

				function explodePie(e) {
					for (var i = 0; i < e.dataSeries.dataPoints.length; i++) {
						if (i !== e.dataPointIndex)
							e.dataSeries.dataPoints[i].exploded = false;
					}
				}
			}
		</script>
		<div style="padding-left:20px;">
			<div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
		</div>

		<?php $this->endWidget(); ?>
		<div class="row-fluid">
			<div class="clearfix">
				<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title' => "
						<span class='icon-th-list'></span>Post Report of Last 15 Days for " . $name,
					'titleCssClass' => ''
				));
				?>
				<div style="padding-left:20px;">
					<div id="chartContainer3" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
				</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	<?php } else if (Yii::app()->user->getState('usertype') == 'lender') { ?>
		<div class="row-fluid">
			<div class="clearfix">
				<?php
				$this->beginWidget('zii.widgets.CPortlet', array('title' => "Lender Report",));
				$form = $this->beginWidget('CActiveForm', array('id' => 'lender_report', 'enableAjaxValidation' => false));
				?>
				<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<td style="width: 100px"><b>Date Range : </b>
									<?php
									$default_date = date('n/j/Y', strtotime("-7 day")) . ' - ' . date('n/j/Y');
									$date_filter = Yii::app()->getRequest()->getParam('date_filter', $default_date);
									$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
										'id' => 'Filter_date',
										'name' => 'date_filter',
										'value' => '' . $date_filter . '',
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
									<?php echo CHtml::submitButton('Search', array('class' => 'btn btn btn-primary')); ?>
								</td>
							</tr>
						</thead>
					</table>
				</div>
				<?php $this->endWidget(); ?>
				<div class="table-responsive">
					<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report">
						<thead>
							<tr>
								<th>Date</th>
								<th style="text-align:right">Post Sent</th>
								<th style="text-align:right">Post Accepted</th>
								<th style="text-align:right">Lead Returned</th>
								<th style="text-align:right">Final Leads</th>
								<th style="text-align:right">Revenue</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 0;
							foreach ($lender_reports as $k => $lender_report) {
								$date = date('Y-m-d', strtotime(trim($lender_report['date'])));
								$final_leads = ($lender_report['post_accepted'] - $lender_report['lead_returned']);
							?>
								<tr>
									<td><?php echo $date; ?></td>
									<td align="right"><?php echo ($lender_report['post_sent']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/lenders/leadinfo?date=' . $date . '&post_sent=1">' . $lender_report['post_sent'] . '</a>' : 0; ?></td>
									<td align="right"><?php echo ($lender_report['post_accepted']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/lenders/leadinfo?date=' . $date . '&post_status=1">' . $lender_report['post_accepted'] . '</a>' : 0; ?></td>
									<td align="right"><?php echo ($lender_report['lead_returned']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/lenders/leadinfo?date=' . $date . '&lead_returned=1">' . $lender_report['lead_returned'] . '</a>' : 0; ?></td>
									<td align="right"><?php echo ($final_leads) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/lenders/leadinfo?date=' . $date . '&final=1">' . $final_leads . '</a>' : 0; ?></td>
									<td align="right">$<?php echo ($lender_report['revenue'] == '') ? '0.00' : round($lender_report['revenue'], 2); ?></td>
								</tr>
							<?php
								$post_sent_total += ($lender_report['post_sent'] == '') ? 0 : $lender_report['post_sent'];
								$post_accepted_total += ($lender_report['post_accepted'] == '') ? 0 : $lender_report['post_accepted'];
								$lead_returned_total += ($lender_report['lead_returned'] == '') ? 0 : $lender_report['lead_returned'];
								$final_leads_total += $final_leads;
								$revenue_total += ($lender_report['revenue'] == '') ? 0 : round($lender_report['revenue'], 2);
								$i++;
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th class="header" colspan="">Total</th>
								<th class="header" align="right" style="text-align:right"><?php echo $post_sent_total; ?></th>
								<th class="header" align="right" style="text-align:right"><?php echo $post_accepted_total; ?></th>
								<th class="header" align="right" style="text-align:right"><?php echo $lead_returned_total; ?></th>
								<th class="header" align="right" style="text-align:right"><?php echo $final_leads_total; ?></th>
								<th class="header" align="right" style="text-align:right">$<?php echo $revenue_total; ?></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
		<div class="row-fluid">
			<div class="clearfix">
				<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title' => "
			        <span class='icon-th-list'></span>Post Report of Last 15 Days for " . $name,
					'titleCssClass' => ''
				));
				$lender = LenderDetails::model()->findByPk(Yii::app()->user->id);
				$lender_id = $lender->id;
				$res2 = LenderAffiliateTransaction::specific_lender_post_report_last_15days($lender_id);
				?>
				<script>
					window.onload = function() {
						var chart1 = new CanvasJS.Chart("chartContainer1", {
							exportEnabled: true,
							animationEnabled: true,
							title: {
								text: "Total Sent vs Total Accepts of Last 15 days for You"
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
							data: [{
									type: "column",
									name: "Total Sent",
									showInLegend: true,
									yValueFormatString: "#,##0.# Leads",
									dataPoints: [
										<?php foreach ($res2 as $row) { ?> {
												label: "<?= $row['lender'] ?>",
												y: <?= $row['post_sent'] ?>
											},
										<?php } ?>
									]
								},
								{
									name: "Total Accepted",
									type: "column",
									showInLegend: true,
									yValueFormatString: "#,##0.# Leads",
									dataPoints: [
										<?php foreach ($res2 as $row) { ?> {
												label: "<?= $row['lender'] ?>",
												y: <?= $row['post_accepted'] ?>
											},
										<?php } ?>
									]
								},

							]
						});
						chart1.render();

						function toggleDataSeries(e) {
							if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
								e.dataSeries.visible = false;
							} else {
								e.dataSeries.visible = true;
							}
							e.chart1.render();
						}
					}
				</script>
				<div style="padding-left:20px;">
					<div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
				</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	<?php } elseif (Yii::app()->user->getState('usertype') == 'edulender') { ?>
		<div class="row-fluid">
			<div class="clearfix">
				<?php
				$this->beginWidget('zii.widgets.CPortlet', array('title' => "Feed Lender Report",));
				$form = $this->beginWidget('CActiveForm', array('id' => 'lender_report', 'enableAjaxValidation' => false));
				?>
				<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<td style="width: 100px"><b>Date Range : </b>
									<?php
									$default_date = date('n/j/Y', strtotime("-7 day")) . ' - ' . date('n/j/Y');
									$date_filter = Yii::app()->getRequest()->getParam('date_filter', $default_date);
									$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
										'id' => 'Filter_date',
										'name' => 'date_filter',
										'value' => '' . $date_filter . '',
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
									<?php echo CHtml::submitButton('Search', array('class' => 'btn btn btn-primary')); ?>
								</td>
							</tr>
						</thead>
					</table>
				</div>
				<?php $this->endWidget(); ?>
				<div class="table-responsive">
					<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report">
						<thead>
							<tr>
								<th>Date</th>
								<th style="text-align:right;">Post Sent</th>
								<th style="text-align:right;">Post Accepted</th>
								<th style="text-align:right;">Final Leads</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 0;
							foreach ($feed_lender_reports as $k => $lender_report) {
								$date = date('Y-m-d', strtotime(trim($lender_report['date'])));
								$final_leads = ($lender_report['post_accepted'] - $lender_report['lead_returned']);
							?>
								<tr>
									<td><?php echo $date; ?></td>
									<td align="right"><?php echo ($lender_report['post_sent']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/feeds/leadinfo?date=' . $date . '&post_sent=1">' . $lender_report['post_sent'] . '</a>' : 0; ?></td>
									<td align="right"><?php echo ($lender_report['post_accepted']) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/feeds/leadinfo?date=' . $date . '&post_status=1">' . $lender_report['post_accepted'] . '</a>' : 0; ?></td>
									<td align="right"><?php echo ($final_leads) ? '<a target="_blank" href="' . Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']) . '/feeds/leadinfo?date=' . $date . '&final=1">' . $final_leads . '</a>' : 0; ?></td>
								</tr>
							<?php
								$post_sent_total += ($lender_report['post_sent'] == '') ? 0 : $lender_report['post_sent'];
								$post_accepted_total += ($lender_report['post_accepted'] == '') ? 0 : $lender_report['post_accepted'];
								$lead_returned_total += ($lender_report['lead_returned'] == '') ? 0 : $lender_report['lead_returned'];
								$final_leads_total += $final_leads;
								$revenue_total += ($lender_report['revenue'] == '') ? 0 : round($lender_report['revenue'], 2);
								$i++;
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th class="header" colspan="">Total</th>
								<th class="header" style="text-align:right;"><?php echo $post_sent_total; ?></th>
								<th class="header" style="text-align:right;"><?php echo $post_accepted_total; ?></th>
								<th class="header" style="text-align:right;"><?php echo $final_leads_total; ?></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
		<div class="row-fluid">
			<div class="clearfix">
				<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title' => "
			        <span class='icon-th-list'></span>Post Report of Last 15 Days for " . $name,
					'titleCssClass' => ''
				));
				?>
				<div style="height: 300px; width: 100%; margin-top: 15px; margin-bottom: 15px;">
					<div id="chartdiv_accepted_pie_chart" align="center">FusionCharts.</div>
					<script type="text/javascript">
						var chart = new FusionCharts("<?php echo Yii::app()->request->baseUrl; ?>/fusionchart/FCF_Pie3D.swf", "chart_id_accepted_pie_chart", "500", "300");
						chart.setDataURL("<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/edu/graph/feedlenderpostreportlast15days");
						chart.render("chartdiv_accepted_pie_chart");
					</script>
					<div id='chart_div'></div>
				</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	<?php } ?>