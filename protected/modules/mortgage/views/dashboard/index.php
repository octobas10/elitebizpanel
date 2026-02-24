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
.fullwidth>.portlet>.portlet-content{
	float:left;overflow: auto; padding: 5px;
	/* width:890px; */
}
.fullwidth{
	/* width:890px; */
	width: 100%;
}
</style>
<?php
$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
$name = 	Yii::app()->user->name;
// IF LOGGED IN USER IS ADMIN
if(Yii::app()->user->getState('roles')=='1'){
?>
<div style="clear: both; height: 15px;"></div>
<div class="row-fluid">
	<div class="span9">
		<?php $form=$this->beginWidget('CActiveForm',array('id' => 'campaign_reports','enableAjaxValidation' => false)); ?>
		<table class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<td style="width: 100px"><b>Date Range :</b>
						<?php
							$default_date = date('Y-m-d', strtotime("-7 day")) . ' - ' . date('Y-m-d');
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
						<?php echo CHtml::submitButton('Search',array( 'class'=>'btn btn btn-primary')); ?>
					</td>
				</tr>
			</thead>
		</table>
		<?php $this->endWidget();?>
	</div>
	<div class="span3">
		<div class="summary">
			<ul>
				<li>
					<span class="summary-icon"> <img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Active Members"></span>
					<span class="summary-number"><?php //echo number_format($week_submissions); ?></span>
					<span class="summary-title">Last 7 Days Submission</span>
					<br>
					<span class="summary-icon"> <img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Active Members"></span>
					<span class="summary-number"><?php //echo number_format($week_accepted); ?></span>
					<span class="summary-title">Last 30 Days Submission</span>
					<br>
					<span class="summary-icon"> <img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Active Members"></span>
					<span class="summary-number"><?php /*echo number_format(Submissions::model()->count());*/ ?></span>
					<span class="summary-title">Total Submission Till Today</span>
				</li> 
			</ul>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array('title' => '<span class="icon-picture"></span>Campaign Performance - Mortgage / Refinance'));
			if(is_array($leads)){?>
		<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<th>Date</th>
					<th>Leads</th>
					<th>Lender Price/Revenue</th>
					<th>Affiliate Price/Cost</th>
					<th>Profit</th>
					<th>Profit Margin</th>
				</tr>
			</thead>
			<tbody> 
				<?php
					$lead_total = $revenue_seller_total = $revenue_buyer_total = $profit_total = $margin_total = $margin = '0';
					foreach($leads as $date => $lead){
						if($revenue_buyer[$date]!=0){
							$margin = number_format(($profit[$date]/$revenue_buyer[$date])*100,2);
						}
						if($leads[$date]){
							echo '<tr>
									<td>'.$date.'</td>
									<td align="right">'.(!empty($leads[$date]) ? $leads[$date] : 0).'</td>
									<td align="right">$'.(!empty($revenue_buyer[$date]) ? number_format($revenue_buyer[$date],2) : '0.00').'</td>
									<td align="right">$'.(!empty($revenue_seller[$date]) ? number_format($revenue_seller[$date],2) : '0.00').'</td>
									<td align="right">$'.number_format($profit[$date],2).'</td>
									<td align="right">'.$margin.'%</td>	
								</tr>';
						}
						$lead_total += !empty($leads[$date]) ? $leads[$date] : 0;
						$revenue_seller_total += $revenue_seller[$date];
						$revenue_buyer_total += $revenue_buyer[$date];
						$profit_total += $profit[$date];
						$margin_total = ($profit_total/$revenue_seller_total)*100;
					}
					?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header" colspan="">Total</th>
					<th class="header" align="right"><?=number_format($lead_total); ?></th>
					<th class="header" align="right">$<?=number_format($revenue_buyer_total,2); ?></th>
					<th class="header" align="right">$<?=number_format($revenue_seller_total,2); ?></th>
					<th class="header" align="right">$<?=number_format($profit_total,2); ?></th>
					<th class="header" align="right"><?=round($margin_total,2); ?>%</th>
				</tr>
			</tfoot>
		</table>
		<?php
			}else{echo 'No Data Found';}
			$this->endWidget(); ?>
	</div>
</div>
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
			}else{echo 'No Data Found';}
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
					echo 'No Data Found';
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
					echo 'No Data Found';
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
					echo 'No Data Found';
			}
			$this->endWidget(); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
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
			<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
		<?php $this->endWidget(); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<?php
			$this->beginWidget('zii.widgets.CPortlet',array(
				'title' => "<i class='icon-info-sign'></i>Conversions(Accepted) of Last 15 days"
			));
			?>
		<div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
		<?php $this->endWidget();?>
	</div>
</div>
<div style="float: middle"></div>
<div class="row-fluid">
	<div class="span5">
		<?php
		$this->beginWidget('zii.widgets.CPortlet',array(
			'title' => '<span class="icon-th-list"></span>Today&#39;s Ping Report',
		));
		?>
		<div id="chartContainer3" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
		<?php $this->endWidget(); ?>
	</div>
	<div class="span5">
		<?php
		$this->beginWidget('zii.widgets.CPortlet',array(
			'title' => '<span class="icon-th-list"></span>Today&#39;s Post Report',
		));
		?>
		<div id="chartContainer4" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
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
						<?php echo CHtml::submitButton('Search',array( 'class'=>'btn btn btn-primary')); ?>
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
						<?php echo CHtml::submitButton('Search',array( 'class'=>'btn btn btn-primary')); ?>
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
