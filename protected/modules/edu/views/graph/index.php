<script src="<?php echo Yii::app()->request->baseUrl; ?>/fusionchart/fusionCharts.js"></script>
<style>
    .portlet{
        height:auto;
    }
    .portlet-content {
        padding: 15px 0 0;
        height: 370px;
    }
    .portlet-content .graph_wrapper {
        overflow: hidden;
        overflow-x: auto;
    }
</style>
<h4>Graphs &amp; Charts Reports</h4>
<div class="row-fluid">
	<div class="span12">
	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-info-sign'></i> Conversions(Accepted) of Last 15 Days",
	));
	?>
	<div class="graph_wrapper"  style="height: 340px;width:100%;margin-top:15px; margin-bottom:15px;">
	<div id="chartdiv_accepted15days" align="center">FusionCharts.</div>
	<script type="text/javascript">
	var chart = new FusionCharts("<?php echo Yii::app()->request->baseUrl; ?>/fusionchart/FCF_Column3D.swf",
			"chart_id_accepted_last_15_days", "1000", "320");
	chart.setDataURL("<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/edu/graph/conversionsoflast15days");
	chart.render("chartdiv_accepted15days");
	</script>
	</div>
	<?php $this->endWidget();?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-info-sign'></i>Total Looks to Lenders Today",
	));
	?>
	<div class="graph_wrapper"  style="height: 340px;width:100%;margin-top:15px; margin-bottom:15px;">
	<div id="chartdiv_lenderDailyAccept" align="center">FusionCharts.</div>
	<script type="text/javascript">
	var chart = new FusionCharts("<?php echo Yii::app()->request->baseUrl; ?>/fusionchart/FCF_StackedColumn3D.swf",
			"chart_id_lenderDaialyAccept", "1000", "320");
	chart.setDataURL("<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/edu/graph/lendersDailycountAccept");
	chart.render("chartdiv_lenderDailyAccept");
	</script>
	</div>
	<?php $this->endWidget();?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-info-sign'></i>Accepted Leads at Hour of the Day",
	));
	?>
	<div class="graph_wrapper"  style="height: 340px;width:100%;margin-top:15px; margin-bottom:15px;">
	<div id="chartdiv_accepted_leads_at_hrs" align="center">FusionCharts.</div>
	<script type="text/javascript">
	var chart = new FusionCharts("<?php echo Yii::app()->request->baseUrl; ?>/fusionchart/FCF_MSColumn3D.swf","chart_id_accepted_leads_at_hrs", "1000", "320");
	chart.setDataURL("<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/edu/graph/hourlyacceptancerate");
	chart.render("chartdiv_accepted_leads_at_hrs");
	</script>
	</div>
	<?php $this->endWidget();?>
	</div>
</div>
<div class="row-fluid">
  <div class="span12">
  	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-info-sign'></i>Accepted State wise in Last 15 Days",
	));
	?>
	<div class="graph_wrapper"  style="height: 340px;width:100%;margin-top:15px; margin-bottom:15px;">
	<div id="chartdiv_accepted_statewise" align="center">FusionCharts.</div>
	<script type="text/javascript">
	var chart = new FusionCharts("<?php echo Yii::app()->request->baseUrl; ?>/fusionchart/FCF_Column3D.swf","chart_id_accepted_statewise", "1000", "320");
	chart.setDataURL("<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/edu/graph/statewiseAcceptance");
	chart.render("chartdiv_accepted_statewise");
	</script>
	</div>
    <?php $this->endWidget();?>
  </div>
</div>
