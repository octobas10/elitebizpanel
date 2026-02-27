<?php
$this->breadcrumbs = array('Leads' => array('leads/browsetransaction'), 'Browse Lender Transaction');
?>
<?php ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<section class="leads-section mortgage-dashboard-section">
	<header class="leads-page-header">
		<h1 class="leads-page-title">Browse Lender Transaction</h1>
		<p class="leads-page-subtitle">Search lender transactions by date, promo code, lender and ping/post status.</p>
	</header>
<?php
Yii::app()->clientScript->registerScript('search',
	"$('#list_leads_id').submit(function(){
		$('#lender_transaction').yiiGridView('update', {
			data: $(this).serialize() 
		});
		return false;
	});
");
?>
	<div class="row-fluid leads-toolbar-card">
		<div class="span12">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => 'Filters'));
			$form = $this->beginWidget('CActiveForm', array('id' => 'list_leads_id', 'enableAjaxValidation' => false));
			$date = Yii::app()->getRequest()->getParam('date', 'Today');
			$lender_id = Yii::app()->getRequest()->getParam('lender_id');
			$ping_status = Yii::app()->getRequest()->getParam('ping_status');
			$post_sent = Yii::app()->getRequest()->getParam('post_sent');
			$post_status = Yii::app()->getRequest()->getParam('post_status');
			?>
			<div class="leads-filter-form">
				<div class="leads-filter-grid">
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="Filter_date">Date range</label>
						<div class="leads-filter-field">
							<?php
							$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
								'id' => 'Filter_date',
								'name' => 'date',
								'value' => $date,
								'options' => array('arrows' => true, 'closeOnSelect' => true),
								'htmlOptions' => array('class' => 'inputClass')
							));
							?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="promo_code">Promo code</label>
						<div class="leads-filter-field">
							<?php echo CHtml::textField('promo_code', '', array('id' => 'promo_code')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="ping_price">Tier</label>
						<div class="leads-filter-field">
							<?php echo CHtml::textField('ping_price', '', array('id' => 'ping_price')); ?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label" for="lender_id">Lenders</label>
						<div class="leads-filter-field">
							<?php
							echo CHtml::listBox('lender_id', $lender_id,
								CHtml::listData(LenderDetails::model()->findAll(), 'id', 'name'),
								array('empty' => 'All Lenders', 'id' => 'lender_id'));
							?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Ping status</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php
							echo CHtml::radioButtonList('ping_status', $ping_status,
								array('' => 'Any', '1' => 'Accepted', '0' => 'Rejected', '-1' => 'Error'),
								array('labelOptions' => array('style' => 'display:inline')));
							?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Post sent</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php
							echo CHtml::radioButtonList('post_sent', $post_sent,
								array('' => 'Any', '1' => 'Yes', '0' => 'No'),
								array('labelOptions' => array('style' => 'display:inline')));
							?>
						</div>
					</div>
					<div class="leads-filter-group">
						<label class="leads-filter-label">Post status</label>
						<div class="leads-filter-field leads-filter-radios">
							<?php
							echo CHtml::radioButtonList('post_status', $post_status,
								array('' => 'Any', '1' => 'Accepted', '0' => 'Rejected', '-1' => 'Error'),
								array('labelOptions' => array('style' => 'display:inline')));
							?>
						</div>
					</div>
				</div>
				<div class="leads-filter-actions">
					<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary')); ?>
				</div>
			</div>
		<?php
			$this->endWidget();
			$this->endWidget();
			?>
		</div>
	</div>
	<?php
	$dataProvider = new CArrayDataProvider($rawData);
	?>
	<div class="leads-table-wrap">
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'lender_transaction',
		'dataProvider' => $dataProvider,
		'afterAjaxUpdate' => 'more_less',
		'columns' => array(
			array(
				'name' => 'date',
				'header' => 'Date Time',
				'htmlOptions' => array('class' => 'leads-col-date')
			),
			array(
				'name' => 'affiliate_transactions_id',
				'header' => 'Aff Trans Id',
				'value' => 'urldecode($data["affiliate_transactions_id"]." (".$data["promo_code"].")")',
				'htmlOptions' => array('class' => 'leads-col-id')
			),
			array(
				'name' => 'lender_name',
				'header' => 'Lender',
				'htmlOptions' => array('class' => 'leads-col-lender')
			),
			array(
				'name' => 'ping_request',
				'header' => 'Ping Request',
				'value' => 'urldecode($data["ping_request"])',
				'htmlOptions' => array('class' => 'comment more')
			),
			array(
				'name' => 'ping_response',
				'header' => 'Ping Response',
				'value' => 'html_entity_decode($data["ping_response"])',
				'htmlOptions' => array('class' => 'comment more')
			),
			array(
				'name' => 'ping_status',
				'header' => 'Ping Status',
				'type' => 'raw',
				'value' => function($res) {
					$status = isset($res['ping_status']) ? $res['ping_status'] : '';
					$label = $status == '1' ? 'ACCEPTED' : ($status == '0' ? 'REJECTED' : ($status == '-1' ? 'ERROR' : ''));
					$class = $status == '1' ? 'leads-status--accepted' : ($status == '0' ? 'leads-status--rejected' : 'leads-status--error');
					return $label !== '' ? '<span class="leads-status ' . $class . '">' . CHtml::encode($label) . '</span>' : '';
				},
				'htmlOptions' => array('class' => 'leads-col-status')
			),
			array(
				'name' => 'post_request',
				'header' => 'Post Request',
				'value' => 'urldecode($data["post_request"])',
				'htmlOptions' => array('class' => 'comment more')
			),
			array(
				'name' => 'post_response',
				'header' => 'Post Response',
				'value' => 'html_entity_decode($data["post_response"])',
				'htmlOptions' => array('class' => 'comment more')
			),
			array(
				'name' => 'post_status',
				'header' => 'Post Status',
				'type' => 'raw',
				'value' => function($res) {
					$status = isset($res['post_status']) ? $res['post_status'] : '';
					$label = $status == '1' ? 'ACCEPTED' : ($status == '0' ? 'REJECTED' : ($status == '-1' ? 'ERROR' : ''));
					$class = $status == '1' ? 'leads-status--accepted' : ($status == '0' ? 'leads-status--rejected' : 'leads-status--error');
					return $label !== '' ? '<span class="leads-status ' . $class . '">' . CHtml::encode($label) . '</span>' : '';
				},
				'htmlOptions' => array('class' => 'leads-col-status')
			),
			array(
				'name' => 'ping_price',
				'header' => 'Ping Price',
				'htmlOptions' => array('class' => 'leads-col-price')
			)
		)
	));
	?>
	</div>
</section>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
</style>
<script>
	function more_less(){
		var showChar = 120;
	    var ellipsestext = "...";
	    var moretext = "more";
	    var lesstext = "less";
	    $('.more').each(function(){
	        var content = $(this).html();
	        if(content.length > showChar){
	            var c = content.substr(0, showChar);
	            var h = content.substr(showChar, content.length - showChar);
	            var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h;
	            html += '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
	            $(this).html(html);
	        }
	    });
	    $(".morelink").click(function(){
	        if($(this).hasClass("less")){
	            $(this).removeClass("less");
	            $(this).html(moretext);
	        }else{
	            $(this).addClass("less");
	            $(this).html(lesstext);
	        }
	        $(this).parent().prev().toggle();
	        $(this).prev().toggle();
	        return false;
	    });
	}
	$(document).ready(function(){
		more_less();
	});


</script>
