<?php
$this->breadcrumbs = array('Leads' => array('leads/browsetransaction'), 'Graph Report');
$baseUrl = Yii::app()->getBaseUrl(true);
$graphBase = $baseUrl . '/index.php/mortgage/graph';
?>
<style>.portlet{height:400px;}</style>
<h4>Graphs &amp; Charts Reports</h4>
<div class="row-fluid">
	<div class="span12">
	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-info-sign'></i> Valid Pings of Last 15 Days",
	));
	?>
	<div style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;">
		<div id="chartdiv_submission15days" style="height:320px;"></div>
	</div>
	<?php $this->endWidget();?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-info-sign'></i> Conversions(Accepted) of Last 15 Days",
	));
	?>
	<div style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;">
		<div id="chartdiv_accepted15days" style="height:320px;"></div>
	</div>
	<?php $this->endWidget();?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-info-sign'></i> Total Looks to Lenders Today",
	));
	?>
	<div style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;">
		<div id="chartdiv_lenderDailyAccept" style="height:320px;"></div>
	</div>
	<?php $this->endWidget();?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-info-sign'></i> Accepted Leads at Hour of the Day",
	));
	?>
	<div style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;">
		<div id="chartdiv_accepted_leads_at_hrs" style="height:320px;"></div>
	</div>
	<?php $this->endWidget();?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-info-sign'></i> Accepted State wise in Last 15 Days",
	));
	?>
	<div style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;">
		<div id="chartdiv_accepted_statewise" style="height:320px;"></div>
	</div>
	<?php $this->endWidget();?>
	</div>
</div>

<script type="text/javascript">
(function() {
	var graphBase = <?php echo json_encode($graphBase); ?>;

	function loadCanvasJS(callback) {
		if (typeof CanvasJS !== 'undefined') {
			callback();
			return;
		}
		var s = document.createElement('script');
		s.src = 'https://cdn.canvasjs.com/canvasjs.min.js';
		s.onload = callback;
		s.onerror = function() {
			var el = document.querySelector('[id^="chartdiv_"]');
			if (el) el.innerHTML = 'Chart library could not be loaded.';
			callback();
		};
		document.head.appendChild(s);
	}

	loadCanvasJS(function() {

	function parseSimpleGraphXml(xmlText) {
		var parser = new DOMParser();
		var doc = parser.parseFromString(xmlText, 'text/xml');
		var sets = doc.getElementsByTagName('set');
		var dataPoints = [];
		for (var i = 0; i < sets.length; i++) {
			var name = sets[i].getAttribute('name') || sets[i].getAttribute('label') || '';
			var value = parseInt(sets[i].getAttribute('value') || '0', 10);
			dataPoints.push({ label: name, y: value });
		}
		return dataPoints;
	}

	function parseMultiSeriesGraphXml(xmlText) {
		var parser = new DOMParser();
		var doc = parser.parseFromString(xmlText, 'text/xml');
		var categories = doc.getElementsByTagName('category');
		var labels = [];
		for (var c = 0; c < categories.length; c++) {
			labels.push(categories[c].getAttribute('name') || '');
		}
		var datasets = doc.getElementsByTagName('dataset');
		var series = [];
		for (var d = 0; d < datasets.length; d++) {
			var seriesName = datasets[d].getAttribute('seriesName') || datasets[d].getAttribute('seriesname') || 'Series ' + (d + 1);
			var sets = datasets[d].getElementsByTagName('set');
			var points = [];
			for (var s = 0; s < sets.length; s++) {
				var val = parseInt(sets[s].getAttribute('value') || '0', 10);
				points.push({ label: labels[s] || '', y: val });
			}
			series.push({ type: 'column', name: seriesName, showInLegend: true, dataPoints: points });
		}
		return series;
	}

	function renderSimpleColumn(containerId, dataUrl, title) {
		fetch(dataUrl)
			.then(function(r) { return r.text(); })
			.then(function(xmlText) {
				var dataPoints = parseSimpleGraphXml(xmlText);
				if (typeof CanvasJS === 'undefined') {
					document.getElementById(containerId).innerHTML = 'CanvasJS not loaded. Ensure the layout includes canvasjs.min.js.';
					return;
				}
				var chart = new CanvasJS.Chart(containerId, {
					theme: 'light2',
					animationEnabled: true,
					title: { text: title || '' },
					axisY: { title: 'Units', includeZero: true },
					axisX: { title: '' },
					data: [{ type: 'column', dataPoints: dataPoints }]
				});
				chart.render();
			})
			.catch(function() {
				document.getElementById(containerId).innerHTML = 'Unable to load chart data.';
			});
	}

	function renderMultiSeriesColumn(containerId, dataUrl, title) {
		fetch(dataUrl)
			.then(function(r) { return r.text(); })
			.then(function(xmlText) {
				var series = parseMultiSeriesGraphXml(xmlText);
				if (typeof CanvasJS === 'undefined') {
					document.getElementById(containerId).innerHTML = 'CanvasJS not loaded. Ensure the layout includes canvasjs.min.js.';
					return;
				}
				var chart = new CanvasJS.Chart(containerId, {
					theme: 'light2',
					animationEnabled: true,
					title: { text: title || '' },
					axisY: { title: 'Units', includeZero: true },
					axisX: { title: '' },
					data: series.length ? series : [{ type: 'column', dataPoints: [] }],
					legend: { cursor: 'pointer' }
				});
				chart.render();
			})
			.catch(function() {
				document.getElementById(containerId).innerHTML = 'Unable to load chart data.';
			});
	}

	// Yii 1.1 action IDs are lowercase
		renderSimpleColumn('chartdiv_submission15days', graphBase + '/submissionlast15days', '');
		renderSimpleColumn('chartdiv_accepted15days', graphBase + '/conversionsoflast15days', '');
		renderMultiSeriesColumn('chartdiv_lenderDailyAccept', graphBase + '/lendersdailycountaccept', '');
		renderMultiSeriesColumn('chartdiv_accepted_leads_at_hrs', graphBase + '/hourlyacceptancerate', '');
		renderSimpleColumn('chartdiv_accepted_statewise', graphBase + '/statewiseacceptance', '');
	});
})();
</script>
